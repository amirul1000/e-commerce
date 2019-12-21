<?php

class Schedules extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    /*
    |--------------------------------------------------------------------------
    | Listing
    |--------------------------------------------------------------------------
    |
    */

    function filter_date($data)
    {
        $list          = array();
        $list['start'] = '';
        $list['end']   = '';

        if(!empty($data) && !is_numeric($data))
        {
            $filter_date = explode(',', $data);
            if(isset($filter_date))
            {
                $list['start'] = str_replace('-', '/', $filter_date[0]);
                $list['end']   = str_replace('-', '/', $filter_date[1]);
            }
        }

        return $list;
    }

    function filter($filter_date)
    {
        $admin     = $this->general->admin();
        $id_user   = isset($_GET['user'])? (int)$_GET['user']:0;
        $sql_admin = empty($admin)? " AND posts.id_users='".$this->general->id_user()."'":(!empty($id_user)? " AND posts.id_users='".$id_user."'":"");

        $query_interval = '';
        $date = $this->filter_date($filter_date);
        if(!empty($date['start']) && !empty($date['end']))
        {
            $query_interval = " AND posts.timestamp >= ".$this->core->date_to_timestamp($date['start'])." AND posts.timestamp <= ".($this->core->date_to_timestamp($date['end']) + (23*60*60) + (59*60) + 59);
        }

        return $sql_admin.$query_interval;
    }

    function pagination($filter_date)
    {
        $qposts = $this->db->query("SELECT COUNT(id) AS total FROM posts WHERE 1=1 ".$this->filter($filter_date));
        return $qposts->row()->total;
    }

    function format_permalink($id_post, $type, $id_wall, $ptype)
    {
        if(empty($id_post))
        {
            return 'javascript:void(0);';
        }
            else if($type == 2 && !in_array($ptype, array(4,5)))
        {
            return 'https://www.facebook.com/groups/'.str_replace('_', '/permalink/', $id_post).'/';
        }
            else
        {
            $id_post = (strpos($id_post, "_") !== false)? substr(strstr($id_post, "_"), 1):$id_post;

            if($ptype == '1' || $ptype == '2')
            {
                return 'https://www.facebook.com/'.$id_wall.'/posts/'.$id_post;
            }
                else if($ptype == '3' || $ptype == '4')
            {
                return 'https://www.facebook.com/photo.php?fbid='.$id_post;
            }
                else if($ptype == '5')
            {
                return 'https://www.facebook.com/photo.php?v='.$id_post;
            }
        }
    }

    function listing($id_post = false, $page = 1, $filter_date = false)
    {
        $list   = array();
        $qposts = $this->db->query("SELECT posts.id, posts.user_id, posts.user_name, posts.access_token, posts.type as ptype, posts.timestamp, posts.timestamp_pause, users.name FROM posts, users WHERE posts.id_users=users.id ".$this->filter($filter_date).(!empty($id_post)? " AND posts.id='".(int)$id_post."'":"")." ORDER BY posts.id DESC ".$this->pages->set_limit($page));
        if($qposts->num_rows() > 0)
        {
            foreach($qposts->result() as $post)
            {
                $qjobs = $this->db->query("SELECT id, id_wall, page_access_token, name, type, clicks, status, error_log, permalink, timestamp FROM cronjobs WHERE cronjobs.id_post='".$post->id."' ORDER BY id ASC");

                $jobs_num_rows = $qjobs->num_rows();
                if($jobs_num_rows > 0)
                {
                    $list[$post->id]['id']          = $post->id;
                    $list[$post->id]['user_id']     = $post->user_id;
                    $list[$post->id]['fbuser_name'] = $post->user_name;
                    $list[$post->id]['user_name']   = $post->name;
                    $list[$post->id]['token_et']    = 0;
                    $list[$post->id]['date']        = date('m-d-Y H:i', $post->timestamp);
                    $list[$post->id]['posted']      = 0;
                    $list[$post->id]['clicks']      = 0;
                    $list[$post->id]['date_end']    = 0;
                    $list[$post->id]['pause']       = empty($post->timestamp_pause)? 'pause':'play';

                    $sent = 0;
                    $i = $date_end = 1;
                    $total_clicks = 0;
                    $cron_estimate = 5;
                    foreach($qjobs->result() as $job)
                    {
                        $list[$post->id]['jobs'][$job->id]['id']        = $job->id;
                        $list[$post->id]['jobs'][$job->id]['id_wall']   = $job->id_wall;
                        $list[$post->id]['jobs'][$job->id]['name']      = stripslashes($job->name);
                        $list[$post->id]['jobs'][$job->id]['clicks']    = $job->clicks;
                        $list[$post->id]['jobs'][$job->id]['posted']    = $job->status;
                        $list[$post->id]['jobs'][$job->id]['permalink'] = ($job->status == 1)? $this->format_permalink($job->permalink, $job->type, $job->id_wall, $post->ptype):'javascript:void(0);';
                        $list[$post->id]['jobs'][$job->id]['error']     = $job->error_log;
                        $list[$post->id]['jobs'][$job->id]['date']      = ($job->status == 1)? date('m-d-Y H:i', $job->timestamp):date('m-d-Y H:i', strtotime('+'.$cron_estimate.' minutes', $job->timestamp));

                        if($i % 5 == 0) $cron_estimate += 5;
                        if($i == $jobs_num_rows) $date_end = $list[$post->id]['jobs'][$job->id]['date'];
                        if($job->status) $sent++;
                        $total_clicks += $job->clicks;
                        $i++;
                    }

                    $list[$post->id]['posted']   = $sent.'/'.$jobs_num_rows;
                    $list[$post->id]['clicks']   = $total_clicks;
                    $list[$post->id]['date_end'] = $date_end;
                }
            }
        }

        return $list;
    }

    /*
    |--------------------------------------------------------------------------
    | Add a schedule post
    |--------------------------------------------------------------------------
    |
    */

    function add()
    {
        $field_allempty = $class_allempty = $title_allempty = "";
        $field_ptype = $class_ptype = $title_ptype = "";
        $field_message = $class_message = $title_message = "";
        $field_link = $class_link = $title_link = "";
        $field_picture = $class_picture = $title_picture = "";
        $field_name = $class_name = $title_name = "";
        $field_caption = $class_caption = $title_caption = "";
        $field_description = $class_description = $title_description = "";
        $field_date = $class_date = $title_date = "";
        $field_interval = "";
        $status = $status_error = "";
        $field_pages = $field_groups = array();
        $field_repeat_check = "";
        $field_delete_check = "";
        $field_repeat_date = $class_repeat_date = $title_repeat_date = "";
        $errors = array();
        $error = 0;
        $current_time = $this->core->timestamp();

        if($this->input->post('schedule_post') == "submit")
        {
            $field_ptype        = (int)$this->input->post('field_ptype');
            $field_message      = $this->general->xss_post($this->input->post('field_message'));
            $field_link         = $this->general->xss_post($this->input->post('field_link'));
            $field_picture      = $this->general->xss_post($this->input->post('field_picture'));
            $field_name         = $this->general->xss_post($this->input->post('field_name'));
            $field_caption      = $this->general->xss_post($this->input->post('field_caption'));
            $field_description  = $this->general->xss_post($this->input->post('field_description'));
            $field_pages        = isset($_POST['field_pages'])? $_POST['field_pages']:array();
            $field_groups       = isset($_POST['field_groups'])? $_POST['field_groups']:array();
            $field_date         = $this->input->post('field_date');
            $field_interval     = (int)$this->input->post('field_interval');
            $field_repeat_check = isset($_POST['field_repeat_check'])? 1:0;
            $field_delete_check = isset($_POST['field_delete_check'])? 1:0;
            $field_repeat_date  = $this->input->post('field_repeat_date');

            if($field_ptype == '1' && empty($field_message))
            {
                $errors[]      = LNG_TEXT_POST_MESSAGE_REQUIRED;
                $class_message = ' error';
                $error         = 1;
            }
                else if($field_ptype == '2')
            {
                if(empty($field_link))
                {
                    $errors[]      = LNG_LINK_POST_LINK_REQUIRED;
                    $class_link    = ' error';
                    $error         = 1;
                }
                    else
                {
                    $spintax = $this->general->spintax_check($field_link);
                    $spintax = explode('|', $spintax);
                    if(count($spintax) > 1)
                    {
                        foreach($spintax as $item)
                        {
                            if($this->general->validate_url($item) == false)
                            {
                                $errors[]   = LNG_LINK_INVALID_CHECK_SPINTAX;
                                $class_link = ' error';
                                $error      = 1;
                                break;
                            }
                        }
                    }
                        else if($this->general->validate_url($field_link) == false)
                    {
                        $errors[]   = LNG_LINK_INVALID;
                        $class_link = ' error';
                        $error      = 1;
                    }
                }
            }
                else if($field_ptype == '3' || $field_ptype == '4')
            {
                if(empty($field_picture))
                {
                    $errors[]      = LNG_IMAGE_POST_IMAGE_REQUIRED;
                    $class_picture = ' error';
                    $error         = 1;
                }
                    else
                {
                    $spintax = $this->general->spintax_check($field_picture);
                    $spintax = explode('|', $spintax);
                    if(count($spintax) > 1)
                    {
                        foreach($spintax as $item)
                        {
                            if($this->general->validate_url($item) == false)
                            {
                                $errors[]      = LNG_IMAGE_INVALID_CHECK_SPINTAX;
                                $class_picture = ' error';
                                $error         = 1;
                                break;
                            }
                        }
                    }
                        else if($this->general->validate_url($field_picture) == false)
                    {
                        $errors[]      = LNG_IMAGE_INVALID;
                        $class_picture = ' error';
                        $error         = 1;
                    }
                }
            }
                else if($field_ptype == '5')
            {
                if(empty($field_picture))
                {
                    $errors[]      = LNG_VIDEO_POST_VIDEO_REQUIRED;
                    $class_picture = ' error';
                    $error         = 1;
                }
                    else
                {
                    $spintax = $this->general->spintax_check($field_picture);
                    $spintax = explode('|', $spintax);
                    if(count($spintax) > 1)
                    {
                        foreach($spintax as $item)
                        {
                            if($this->general->validate_url($item) == false)
                            {
                                $errors[]      = LNG_VIDEO_INVALID_CHECK_SPINTAX;
                                $class_picture = ' error';
                                $error         = 1;
                                break;
                            }
                        }
                    }
                        else if($this->general->validate_url($field_picture) == false)
                    {
                        $errors[]      = LNG_VIDEO_INVALID;
                        $class_picture = ' error';
                        $error         = 1;
                    }
                        else
                    {
                        $video = $this->general->video_file_url($field_picture);
                        if($video['error'])
                        {
                            $errors[]      = LNG_VIDEO_IS_COPYRIGHT;
                            $class_picture = ' error';
                            $error         = 1;
                        }
                            else
                        {
                            $field_picture = $video['file_url'];
                        }
                    }
                }
            }

            if($field_date == "")
            {
                $error      = 1;
                $class_date = ' error';
                $title_date = '-';
            }

            if(empty($field_date))
            {
                $errors[] = LNG_VALID_DATETIME_REQUIRED;
                $error    = 1;
            }

            if(empty($field_pages) && empty($field_groups))
            {
                $errors[] = LNG_SELECT_PAGE_GROUP;
                $error    = 1;
            }

            if(!empty($field_date) && floor(($current_time - $this->core->human_unix_v2($field_date)) / 3600) > 1)
            {
                $errors[] = LNG_START_DATE_IN_PAST;
                $error    = 1;
            }

            if(empty($error))
            {
                #initialization
                $this->faceboook->settings();
                $id_user      = $this->general->id_user();
                $time         = $this->core->human_unix_v2($field_date);
                $time_repeat  = ($field_repeat_check)? $this->core->human_unix_v2($field_repeat_date):'';
                $fb_token_ext = $this->session->userdata('fb_sdk_token_ext');
                $fb_token_ext = !empty($fb_token_ext)? '###1':'';
                $fb_token     = $this->session->userdata('fb_sdk_token');
                $fb_user      = $this->session->userdata('fb_sdk_user');
                $fb_user      = json_decode($fb_user, true);
                $fb_user_id   = isset($fb_user['id'])?   $fb_user['id']:0;
                $fb_user_name = isset($fb_user['name'])? $fb_user['name']:'Unknown';

                if(!empty($field_pages))
                {
                    $this->db->query("INSERT INTO posts(id_users, user_id, user_name, access_token, type, message, link, picture, name, caption, description, `interval`, timestamp, timestamp_repeat, `delete`) VALUES('".$id_user."', '".$fb_user_id."', '".$this->general->xss_post($fb_user_name)."', '".$fb_token.$fb_token_ext."', '".$field_ptype."', '".$field_message."', '".$field_link."', '".$field_picture."', '".$field_name."', '".$field_caption."', '".$field_description."', '".$field_interval."', '".$time."', '".$time_repeat."', '".$field_delete_check."')");
                    $last_insert_id = $this->db->insert_id();

                    $interval  = 0;
                    $randomize = ($this->faceboook->random_time)? round($field_interval/2):0;
                    $operator  = array("-", "+");
                    foreach($field_pages as $page)
                    {
                        shuffle($operator);
                        if(!empty($field_interval)) $interval += (($operator[0] == '+')? $field_interval+$randomize:$field_interval-$randomize);

                        $exp_page = explode('||', $page);

                        if(isset($exp_page[0]) && !empty($exp_page[0]))
                        {
                            $this->db->query("INSERT INTO cronjobs(id_post, id_wall, name, type, page_access_token, timestamp) VALUES('".$last_insert_id."', '".$exp_page[0]."', '".$this->general->xss_post(addslashes(urldecode($exp_page[1])))."', '".( str_replace(array('pages', 'groups', 'friends'), array(1,2,3), $exp_page[2]) )."', '".(isset($exp_page[3])? $exp_page[3].$fb_token_ext:0)."', '".($time + $interval)."')");
                        }
                    }
                }

                if(!empty($field_groups))
                {
                    foreach($field_groups as $id_group)
                    {
                        $qgroup = $this->db->query("SELECT user_id, user_name, access_token FROM groups WHERE id='".(int)$id_group."' AND id_user='".$id_user."'");
                        if($qgroup->num_rows() > 0) //&& $fb_user_id != $qgroup->row()->user_id)
                        {
                            $this->db->query("INSERT INTO posts(id_users, user_id, user_name, access_token, type, message, link, picture, name, caption, description, `interval`, timestamp, timestamp_repeat, `delete`) VALUES('".$id_user."', '".$qgroup->row()->user_id."', '".$this->general->xss_post($qgroup->row()->user_name)."', '".$qgroup->row()->access_token."', '".$field_ptype."', '".$field_message."', '".$field_link."', '".$field_picture."', '".$field_name."', '".$field_caption."', '".$field_description."', '".$field_interval."', '".$time."', '".$time_repeat."', '".$field_delete_check."')");

                            $last_insert_id = $this->db->insert_id();
                            $interval  = 0;
                            $randomize = ($this->faceboook->random_time)? round($field_interval/2):0;
                            $operator  = array("-", "+");

                            $qgroups = $this->db->query("SELECT id_wall, name, page_access_token, type FROM groups_data WHERE id_group='".(int)$id_group."' AND id_user='".$id_user."'");
                            foreach($qgroups->result() as $group)
                            {
                                shuffle($operator);
                                if(!empty($field_interval)) $interval += (($operator[0] == '+')? $field_interval+$randomize:$field_interval-$randomize);

                                $this->db->query("INSERT INTO cronjobs(id_post, id_wall, name, type, page_access_token, timestamp) VALUES('".$last_insert_id."', '".$group->id_wall."', '".$this->general->xss_post(addslashes($group->name))."', '".$group->type."', '".$group->page_access_token."', '".($time + $interval)."')");
                            }
                        }
                    }
                }

                #reset
                $field_allempty = $class_allempty = $title_allempty = "";
                $field_message = $class_message = $title_message = "";
                $field_link = $class_link = $title_link = "";
                $field_picture = $class_picture = $title_picture = "";
                $field_name = $class_name = $title_name = "";
                $field_caption = $class_caption = $title_caption = "";
                $field_description = $class_description = $title_description = "";
                $status = $status_error = "";
                $field_pages = $field_groups = array();
                $errors = array();

                $error = 2;
            }
        }

        if($error == 0)
        {
            #initialization
        	$this->faceboook->settings();

            $data['field_ptype']        = 1;
            $data['field_message']      = "";
            $data['field_link']         = "";
            $data['field_picture']      = "";
            $data['field_name']         = "";
            $data['field_caption']      = "";
            $data['field_description']  = "";
            $data['field_pages']        = array();
            $data['field_groups']       = array();
            $data['field_date']         = mdate("%m/%d/%Y %H:%i", $current_time);
            $data['field_interval']     = $this->faceboook->send_interval;
            $data['field_repeat_check'] = 0;
            $data['field_delete_check'] = 0;
            $data['field_repeat_date']  = mdate("%m/%d/%Y %H:%i", $current_time);
            $data['errors']             = array();
        }
            else
        {
            $data['field_ptype']        = ($field_ptype != "")?        $field_ptype:"";
            $data['field_message']      = ($field_message != "")?      $field_message:"";
            $data['field_link']         = ($field_link != "")?         $field_link:"";
            $data['field_picture']      = ($field_picture != "")?      $field_picture:"";
            $data['field_name']         = ($field_name != "")?         $field_name:"";
            $data['field_caption']      = ($field_caption != "")?      $field_caption:"";
            $data['field_description']  = ($field_description != "")?  $field_description:"";
            $data['field_pages']        = ($field_pages != "")?        $field_pages:"";
            $data['field_groups']       = ($field_groups != "")?       $field_groups:"";
            $data['field_date']         = ($field_date != "")?         $field_date:"";
            $data['field_interval']     = ($field_interval != "")?     $field_interval:"";
            $data['field_repeat_check'] = ($field_repeat_check != "")? $field_repeat_check:"";
            $data['field_delete_check'] = ($field_delete_check != "")? $field_delete_check:"";
            $data['field_repeat_date']  = ($field_repeat_date != "")?  $field_repeat_date:"";
            $data['errors']             = $errors;
        }

        $data['error'] = array(
            'class_allempty'    => $class_allempty,
            'title_allempty'    => $title_allempty,
            'class_message'     => $class_message,
            'title_message'     => $title_message,
            'class_link'        => $class_link,
            'title_link'        => $title_link,
            'class_picture'     => $class_picture,
            'title_picture'     => $title_picture,
            'class_name'        => $class_name,
            'title_name'        => $title_name,
            'class_caption'     => $class_caption,
            'title_caption'     => $title_caption,
            'class_description' => $class_description,
            'title_description' => $title_description,
            'class_date'        => $class_date,
            'title_date'        => $title_date,
            'class_repeat_date' => $class_repeat_date,
            'title_repeat_date' => $title_repeat_date,
            'error'             => $error
        );

        return $data;
    }

    /*
    |--------------------------------------------------------------------------
    | Delete schedules
    |--------------------------------------------------------------------------
    |
    */

    function preview()
    {
        if(isset($_POST['id']))
        {
            #initialization
            $refresh  = '';
            $id       = (int)$this->input->post('id');
            $id_users = $this->general->id_user();
            $admin    = $this->general->admin();

            $qposts = $this->db->query("SELECT user_id, user_name, message, link, picture, name, caption, description FROM posts WHERE id='".(int)$id."'".( empty($admin)? " AND id_users='".$id_users."'":"" ));

            if($qposts->num_rows() > 0)
            {
                $data['fb_name']     = $qposts->row()->user_name;
                $data['fb_image']    = 'https://graph.facebook.com/'.$qposts->row()->user_id.'/picture';
                $data['message']     = $qposts->row()->message;
                $data['link']        = $qposts->row()->link;
                $data['picture']     = $qposts->row()->picture;
                $data['name']        = $qposts->row()->name;
                $data['caption']     = $qposts->row()->caption;
                $data['description'] = $qposts->row()->description;

                $refresh = $this->load->view('sections/frame-preview', $data, true);
            }

            return json_encode(array('result' => 'ok', 'refresh' => $refresh));
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Delete schedules
    |--------------------------------------------------------------------------
    |
    */

    function delete_post($id)
    {
        $id_users  = $this->general->id_user();
        $admin     = $this->general->admin();
        $sql_admin = empty($admin)? " AND posts.id_users='".$id_users."'":"";

        $this->db->query("DELETE error_log FROM cronjobs, error_log, posts WHERE cronjobs.id=error_log.id_cron AND cronjobs.id_post=posts.id AND posts.id='".(int)$id."'".$sql_admin);
        $this->db->query("DELETE cronjobs FROM cronjobs, posts WHERE cronjobs.id_post=posts.id AND posts.id='".(int)$id."'".$sql_admin);
        $this->db->query("DELETE posts FROM posts WHERE id='".(int)$id."'".$sql_admin);
    }

    function delete_job($id, $id_post)
    {
        #initialization
        $id_users  = $this->general->id_user();
        $admin     = $this->general->admin();
        $sql_admin = empty($admin)? " AND posts.id_users='".$id_users."'":"";

        $this->db->query("DELETE error_log FROM cronjobs, error_log, posts WHERE cronjobs.id=error_log.id_cron AND cronjobs.id_post=posts.id AND cronjobs.id='".(int)$id."'".$sql_admin);
        $this->db->query("DELETE cronjobs FROM cronjobs, posts WHERE cronjobs.id_post=posts.id AND cronjobs.id='".(int)$id."'".$sql_admin);

        $qposts = $this->db->query("SELECT cronjobs.id FROM cronjobs, posts WHERE cronjobs.id_post=posts.id AND posts.id='".(int)$id_post."'".$sql_admin);
        if($qposts->num_rows() == 0)
        {
            $this->db->query("DELETE posts FROM posts WHERE id='".(int)$id_post."'".$sql_admin);

            return 0;
        }
            else
        {
            return 1;
        }
    }

    function ajax()
    {
        if(isset($_POST['action']) && isset($_POST['id']))
        {
            $refresh = 0;

            if($_POST['action'] == 'delete-post')
            {
                $this->delete_post($_POST['id']);
            }
                else if($_POST['action'] == 'delete-job')
            {
                $refresh = $this->delete_job($_POST['id'], $_POST['id_post']);
            }

            return json_encode(array('result' => 'ok', 'refresh' => $refresh));
        }
    }

    function token_etime()
    {
        if(isset($_POST['id']))
        {
            $qposts = $this->db->query("SELECT id_users, access_token FROM posts WHERE id='".(int)$_POST['id']."'");
            if($qposts->num_rows() > 0)
            {
                $this->faceboook->settings($qposts->row()->id_users);
                $token_time = $this->faceboook->token_time($qposts->row()->access_token, $this->core->timestamp());
            }
                else
            {
                $token_time = LNG_TOKEN_NOT_EXPIRE_TIME;
            }

            return json_encode(array('result' => 'ok', 'refresh' => $token_time));
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Load cron error_log
    |--------------------------------------------------------------------------
    |
    */

    function cron_errorlog()
    {
        if(isset($_POST['id_cron']))
        {
            #initialization
            $id_cron    = (int)$this->input->post('id_cron');
            $qerror_log = $this->db->query("SELECT id, error FROM error_log WHERE id_cron='".$id_cron."' ORDER BY id ASC");
            $qcronjobs = $this->db->query("SELECT name FROM cronjobs WHERE id='".$id_cron."' LIMIT 1");

            $data['title'] = ($qcronjobs->num_rows() > 0)? $qcronjobs->row()->name:'-';
            foreach($qerror_log->result() as $errors)
            {
                $data['errors'][$errors->id]['id']    = $errors->id;
                $data['errors'][$errors->id]['error'] = $errors->error;
            }

            return json_encode(array('result' => 'ok', 'refresh' => $this->load->view('sections/frame-cron-errors', $data, true)));
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Load frame schedule / edit posts
    |--------------------------------------------------------------------------
    |
    */

    function load_frame_schedule()
    {
        if(isset($_POST['id_post']))
        {
            #initialization
            $id_post = (int)$this->input->post('id_post');
            $admin   = $this->general->admin();
            $sql_admin = empty($admin)? " AND posts.id_users='".$this->general->id_user()."'":"";

            $qposts = $this->db->query("SELECT id, user_name, type, message, link, picture, name, caption, description FROM posts WHERE id='".$id_post."'".$sql_admin." LIMIT 1");

            if($qposts->num_rows() > 0)
            {
                $data['title']       = LNG_EDIT_POST.' #'.$qposts->row()->id.' - '.$qposts->row()->user_name;
                $data['ptype']       = empty($qposts->row()->type)? 1:$qposts->row()->type;
                $data['message']     = $qposts->row()->message;
                $data['link']        = $qposts->row()->link;
                $data['picture']     = $qposts->row()->picture;
                $data['name']        = $qposts->row()->name;
                $data['caption']     = $qposts->row()->caption;
                $data['description'] = $qposts->row()->description;
                $data['button']      = 'edit_post('.$id_post.');';
            }
                else
            {
                return json_encode(array('result' => 'ok', 'refresh' => ''));
            }

            return json_encode(array('result' => 'ok', 'refresh' => $this->load->view('sections/frame-loadpost', $data, true)));
        }
    }

    function edit_post()
    {
        if($this->input->post('formpost') == 'submit')
        {
            $done       = 0;
            $error      = 0;
            $errors     = $errors_list = array();

            $id_post     = (int)$this->input->post('id');
            $ptype       = (int)$this->input->post('ptype');
            $message     = $this->general->xss_post($this->input->post('message'));
            $link        = $this->general->xss_post($this->input->post('link'));
            $picture     = $this->general->xss_post($this->input->post('picture'));
            $name        = $this->general->xss_post($this->input->post('name'));
            $caption     = $this->general->xss_post($this->input->post('caption'));
            $description = $this->general->xss_post($this->input->post('description'));

            if($ptype == '1' && empty($message))
            {
                $error = $errors['message'] = 1;
                $errors_list = LNG_TEXT_POST_MESSAGE_REQUIRED;
            }
                else if($ptype == '2')
            {
                if(empty($link))
                {
                    $error = $errors['link'] = 1;
                    $errors_list = LNG_LINK_POST_LINK_REQUIRED;
                }
                    else
                {
                    $spintax = $this->general->spintax_check($link);
                    $spintax = explode('|', $spintax);
                    if(count($spintax) > 1)
                    {
                        foreach($spintax as $item)
                        {
                            if($this->general->validate_url($item) == false)
                            {
                                $error = $errors['link'] = 1;
                                $errors_list = LNG_LINK_INVALID_CHECK_SPINTAX;
                                break;
                            }
                        }
                    }
                        else if($this->general->validate_url($link) == false)
                    {
                        $error = $errors['link'] = 1;
                        $errors_list = LNG_LINK_INVALID;
                    }
                }
            }
                else if($ptype == '3' || $ptype == '4')
            {
                if(empty($picture))
                {
                    $error = $errors['picture'] = 1;
                    $errors_list = LNG_IMAGE_POST_IMAGE_REQUIRED;
                }
                    else
                {
                    $spintax = $this->general->spintax_check($picture);
                    $spintax = explode('|', $spintax);
                    if(count($spintax) > 1)
                    {
                        foreach($spintax as $item)
                        {
                            if($this->general->validate_url($item) == false)
                            {
                                $error = $errors['picture'] = 1;
                                $errors_list = LNG_IMAGE_INVALID_CHECK_SPINTAX;
                                break;
                            }
                        }
                    }
                        else if($this->general->validate_url($picture) == false)
                    {
                        $errors[]      = LNG_IMAGE_INVALID;
                        $class_picture = ' error';
                        $error         = 1;
                    }
                }
            }
                else if($ptype == '5')
            {
                if(empty($picture))
                {
                    $error = $errors['picture'] = 1;
                    $errors_list = LNG_VIDEO_POST_VIDEO_REQUIRED;
                }
                    else
                {
                    $spintax = $this->general->spintax_check($picture);
                    $spintax = explode('|', $spintax);
                    if(count($spintax) > 1)
                    {
                        foreach($spintax as $item)
                        {
                            if($this->general->validate_url($item) == false)
                            {
                                $error = $errors['picture'] = 1;
                                $errors_list = LNG_VIDEO_INVALID_CHECK_SPINTAX;
                                break;
                            }
                        }
                    }
                        else if($this->general->validate_url($picture) == false)
                    {
                        $error = $errors['picture'] = 1;
                        $errors_list = LNG_VIDEO_INVALID;
                    }
                        else
                    {
                        $video = $this->general->video_file_url($picture);
                        if($video['error'])
                        {
                            $error = $errors['picture'] = 1;
                            $errors_list = LNG_VIDEO_IS_COPYRIGHT;
                        }
                            else
                        {
                            $picture = $video['file_url'];
                        }
                    }
                }
            }

            if(empty($error))
            {
                $this->db->query("UPDATE posts SET type='".$ptype."', message='".$message."', link='".$link."', picture='".$picture."', name='".$name."', caption='".$caption."', description='".$description."' WHERE id='".$id_post."'");
                $done = 1;
            }

            return json_encode(array('result' => 'ok', 'errors' => $errors, 'errors_list' => $errors_list, 'done' => $done));
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Load frame repeat post / repeat posts
    |--------------------------------------------------------------------------
    |
    */

    function load_frame_repeatpost()
    {
        if(isset($_POST['id_post']))
        {
            #initialization
            $id_post      = (int)$this->input->post('id_post');
            $current_time = $this->core->timestamp();
            $admin        = $this->general->admin();
            $sql_admin    = empty($admin)? " AND posts.id_users='".$this->general->id_user()."'":"";

            $qposts = $this->db->query("SELECT id, user_name, type, message, link, picture, name, caption, description, `interval`, timestamp_repeat, `delete` FROM posts WHERE id='".$id_post."'".$sql_admin." LIMIT 1");

            if($qposts->num_rows() > 0)
            {
                $data['title']        = LNG_REPEAT_POST.' #'.$qposts->row()->id.' - '.$qposts->row()->user_name;
                $data['ptype']        = empty($qposts->row()->type)? 1:$qposts->row()->type;
                $data['message']      = $qposts->row()->message;
                $data['link']         = $qposts->row()->link;
                $data['picture']      = $qposts->row()->picture;
                $data['name']         = $qposts->row()->name;
                $data['caption']      = $qposts->row()->caption;
                $data['description']  = $qposts->row()->description;
                $data['date']         = mdate("%m/%d/%Y %H:%i", $current_time);
                $data['interval']     = $qposts->row()->interval;
                $data['repeat_check'] = empty($qposts->row()->timestamp_repeat)? 0:1;
                $data['delete_check'] = empty($qposts->row()->delete)? 0:1;
                $data['repeat_date']  = mdate("%m/%d/%Y %H:%i", (($data['repeat_check'])? $qposts->row()->timestamp_repeat:$current_time));
                $data['button']       = 'repeat_post('.$id_post.');';
            }
                else
            {
                return json_encode(array('result' => 'ok', 'refresh' => ''));
            }

            return json_encode(array('result' => 'ok', 'refresh' => $this->load->view('sections/frame-loadrepeatpost', $data, true)));
        }
    }

    function repeat_post()
    {
        if($this->input->post('formpost') == 'submit' || $this->input->post('formpost') == 'submit-clone')
        {
            $done   = 0;
            $error  = 0;
            $errors = $errors_list = array();

            $id_post            = (int)$this->input->post('id');
            $ptype              = (int)$this->input->post('ptype');
            $message            = $this->general->xss_post($this->input->post('message'));
            $link               = $this->general->xss_post($this->input->post('link'));
            $picture            = $this->general->xss_post($this->input->post('picture'));
            $name               = $this->general->xss_post($this->input->post('name'));
            $caption            = $this->general->xss_post($this->input->post('caption'));
            $description        = $this->general->xss_post($this->input->post('description'));
            $field_date         = $this->input->post('data');
            $field_interval     = (int)$this->input->post('imput_interval');
            $field_repeat_check = (int)$this->input->post('repeat_check');
            $field_delete_check = (int)$this->input->post('delete_check');
            $field_repeat_date  = $this->input->post('date_repeat');
            $clone              = ($this->input->post('formpost') == 'submit-clone')? 1:0;
            $current_time       = $this->core->timestamp();

            if($ptype == '1' && empty($message))
            {
                $error = $errors['message'] = 1;
                $errors_list = LNG_TEXT_POST_MESSAGE_REQUIRED;
            }
                else if($ptype == '2')
            {
                if(empty($link))
                {
                    $error = $errors['link'] = 1;
                    $errors_list = LNG_LINK_POST_LINK_REQUIRED;
                }
                    else
                {
                    $spintax = $this->general->spintax_check($link);
                    $spintax = explode('|', $spintax);
                    if(count($spintax) > 1)
                    {
                        foreach($spintax as $item)
                        {
                            if($this->general->validate_url($item) == false)
                            {
                                $error = $errors['link'] = 1;
                                $errors_list = LNG_LINK_INVALID_CHECK_SPINTAX;
                                break;
                            }
                        }
                    }
                        else if($this->general->validate_url($link) == false)
                    {
                        $error = $errors['link'] = 1;
                        $errors_list = LNG_LINK_INVALID;
                    }
                }
            }
                else if($ptype == '3' || $ptype == '4')
            {
                if(empty($picture))
                {
                    $error = $errors['picture'] = 1;
                    $errors_list = LNG_IMAGE_POST_IMAGE_REQUIRED;
                }
                    else if($this->general->validate_url($picture) == false)
                {
                    $error = $errors['picture'] = 1;
                    $errors_list = LNG_IMAGE_INVALID;
                }
            }
                else if($ptype == '5')
            {
                if(empty($picture))
                {
                    $error = $errors['picture'] = 1;
                    $errors_list = LNG_VIDEO_POST_VIDEO_REQUIRED;
                }
                    else
                {
                    $spintax = $this->general->spintax_check($picture);
                    $spintax = explode('|', $spintax);
                    if(count($spintax) > 1)
                    {
                        foreach($spintax as $item)
                        {
                            if($this->general->validate_url($item) == false)
                            {
                                $error = $errors['picture'] = 1;
                                $errors_list = LNG_VIDEO_INVALID_CHECK_SPINTAX;
                                break;
                            }
                        }
                    }
                        else if($this->general->validate_url($picture) == false)
                    {
                        $error = $errors['picture'] = 1;
                        $errors_list = LNG_VIDEO_INVALID;
                    }
                        else
                    {
                        $video = $this->general->video_file_url($picture);
                        if($video['error'])
                        {
                            $error = $errors['picture'] = 1;
                            $errors_list = LNG_VIDEO_IS_COPYRIGHT;
                        }
                            else
                        {
                            $picture = $video['file_url'];
                        }
                    }
                }
            }

            if(!empty($field_date) && floor(($current_time - $this->core->human_unix_v2($field_date)) / 3600) > 1)
            {
                $errors['date'] = 1;
                $error          = 1;
                $errors_list    = LNG_START_DATE_IN_PAST;
            }

            if(empty($error))
            {
                #initialization
                $this->faceboook->settings();
                $time = $this->core->human_unix_v2($field_date);
                $time_repeat = ($field_repeat_check)? $this->core->human_unix_v2($field_repeat_date):'';

                if($clone == 1)
                {
                    #clone post
                    $qposts = $this->db->query("SELECT id_users, user_id, user_name, access_token FROM posts WHERE id='".$id_post."' LIMIT 1");
                    if($qposts->num_rows() > 0)
                    {
                        $this->db->query("INSERT INTO posts(id_users, user_id, user_name, access_token, type, message, link, picture, name, caption, description, `interval`, timestamp, timestamp_repeat, `delete`) VALUES('".$qposts->row()->id_users."', '".$qposts->row()->user_id."', '".$this->general->xss_post($qposts->row()->user_name)."', '".$qposts->row()->access_token."', '".$ptype."', '".$message."', '".$link."', '".$picture."', '".$name."', '".$caption."', '".$description."', '".$field_interval."', '".$time."', '".$time_repeat."', '".$field_delete_check."')");
                        $id_post_new = $this->db->insert_id();

                        $interval  = 0;
                        $randomize = ($this->faceboook->random_time)? round($field_interval/2):0;
                        $operator  = array("-", "+");
                        $qcronjobs = $this->db->query("SELECT id_wall, name, type, page_access_token FROM cronjobs WHERE id_post='".$id_post."' ORDER BY id ASC");
                        foreach($qcronjobs->result() as $row)
                        {
                            shuffle($operator);
                            if(!empty($field_interval)) $interval += (($operator[0] == '+')? $field_interval+$randomize:$field_interval-$randomize);

                            $this->db->query("INSERT INTO cronjobs(id_post, id_wall, name, type, page_access_token, timestamp) VALUES('".$id_post_new."', '".$row->id_wall."', '".$this->general->xss_post(addslashes(urldecode($row->name)))."', '".$row->type."', '".$row->page_access_token."', '".($time + $interval)."')");
                        }
                    }
                }
                    else
                {
                    #update reposted post
                    $this->db->query("UPDATE posts SET type='".$ptype."', message='".$message."', link='".$link."', picture='".$picture."', name='".$name."', caption='".$caption."', description='".$description."', `interval`='".$field_interval."', timestamp='".$time."', timestamp_repeat='".$time_repeat."', timestamp_pause='', cntposts='0', `delete`='".$field_delete_check."' WHERE id='".$id_post."'");

                    $interval  = 0;
                    $randomize = ($this->faceboook->random_time)? round($field_interval/2):0;
                    $operator  = array("-", "+");
                    $qposts    = $this->db->query("SELECT id FROM cronjobs WHERE id_post='".$id_post."' ORDER BY id ASC");
                    foreach($qposts->result() as $posts)
                    {
                        shuffle($operator);
                        if(!empty($field_interval)) $interval += (($operator[0] == '+')? $field_interval+$randomize:$field_interval-$randomize);

                        $this->db->query("DELETE FROM error_log WHERE id_cron='".$posts->id."'");
                        $this->db->query("UPDATE cronjobs SET timestamp='".($time + $interval)."', status='0', error_log='', permalink='', retry='0' WHERE id='".$posts->id."'");
                    }
                }

                $done = 1;
            }

            return json_encode(array('result' => 'ok', 'errors' => $errors, 'errors_list' => $errors_list, 'done' => $done));
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Pause / Resume post
    |--------------------------------------------------------------------------
    |
    */

    function pause_post()
    {
        if(isset($_POST['id']))
        {
            #initialization
            $pause   = 1;
            $id_post = (int)$this->input->post('id');
            $qposts  = $this->db->query("SELECT posts.timestamp_pause FROM posts, users WHERE posts.id_users=users.id AND posts.id='".$id_post."' ".((!$this->general->admin())? " AND posts.id_users='".$this->general->id_user()."'":"")." LIMIT 1");
            if($qposts->num_rows() > 0)
            {
                if(empty($qposts->row()->timestamp_pause))
                {
                    $this->db->query("UPDATE posts SET timestamp_pause='".time()."' WHERE id='".$id_post."'");
                }
                    else
                {
                    $pause = 0;
                    $time  = time() - $qposts->row()->timestamp_pause;

                    $this->db->query("UPDATE posts SET timestamp_repeat=timestamp_repeat+".$time." WHERE id='".$id_post."' AND timestamp_repeat!=''");
                    $this->db->query("UPDATE cronjobs SET timestamp=timestamp+".$time." WHERE id_post='".$id_post."' AND status!='1'");
                    $this->db->query("UPDATE posts SET timestamp_pause='' WHERE id='".$id_post."'");
                }
            }

            return json_encode(array('result' => 'ok', 'pause' => $pause));
        }
    }

    function pause_completed($user_id)
    {
        $qposts = $this->db->query("SELECT posts.id FROM posts, cronjobs WHERE posts.id_users=".$user_id." AND posts.id=cronjobs.id_post AND posts.timestamp_repeat='' AND timestamp_pause='' GROUP BY posts.id HAVING MIN(cronjobs.status) > '0'");

        foreach($qposts->result() as $post)
        {
            $this->db->query("UPDATE posts SET timestamp_pause='".time()."' WHERE id='".$post->id."'");
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Repeat post until
    |--------------------------------------------------------------------------
    |
    */

    function repeat_post_until($user_id, $user_gmt_zone, $random_time)
    {
        $qjobs = $this->db->query("SELECT posts.id, posts.interval FROM posts, cronjobs WHERE posts.id_users=".$user_id." AND posts.id=cronjobs.id_post AND posts.timestamp_repeat!='' AND posts.timestamp_repeat > ".$this->core->timestamp($user_gmt_zone)." GROUP BY posts.id HAVING MIN(cronjobs.status) > '0'");
        foreach($qjobs->result() as $post)
        {
            #initialization
            $current_time   = $this->core->timestamp($user_gmt_zone);
            $field_date     = mdate("%m/%d/%Y %H:%i", $current_time);
            $time           = $this->core->human_unix_v2($field_date);
            $field_interval = $post->interval;

            #update reposted post
            $this->db->query("UPDATE posts SET timestamp='".$time."' WHERE id='".$post->id."'");

            $interval  = 0;
            $randomize = ($random_time)? round($field_interval/2):0;
            $operator  = array("-", "+");
            $qposts    = $this->db->query("SELECT id FROM cronjobs WHERE id_post='".$post->id."' ORDER BY id ASC");
            foreach($qposts->result() as $posts)
            {
                shuffle($operator);
                if(!empty($field_interval)) $interval += (($operator[0] == '+')? $field_interval+$randomize:$field_interval-$randomize);

                $this->db->query("DELETE FROM error_log WHERE id_cron='".$posts->id."'");
                $this->db->query("UPDATE cronjobs SET timestamp='".($time + $interval)."', status='0', error_log='', permalink='', retry='0' WHERE id='".$posts->id."'");
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Delete scheduled post after it's finished posting
    |--------------------------------------------------------------------------
    |
    */

    function delete_completed($user_id)
    {
        $qposts = $this->db->query("SELECT posts.id FROM posts, cronjobs WHERE posts.id_users=".$user_id." AND posts.id=cronjobs.id_post AND posts.timestamp_repeat='' AND posts.delete='1' GROUP BY posts.id HAVING MIN(cronjobs.status) > '0'");

        foreach($qposts->result() as $post)
        {
            $this->db->query("DELETE error_log FROM cronjobs, error_log WHERE cronjobs.id=error_log.id_cron AND cronjobs.id_post='".$post->id."'");
            $this->db->query("DELETE cronjobs FROM cronjobs WHERE id_post='".$post->id."'");
            $this->db->query("DELETE posts FROM posts WHERE id='".$post->id."'");
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Load frame images, upload & delete images
    |--------------------------------------------------------------------------
    |
    */

    function upload()
    {
        if(isset($_POST))
        {
            $check_file = $this->upload->check('ImageFile');
            if(!empty($check_file))
            {
                return json_encode(array('message' => $check_file, 'picture' => ''));
            }
                else
            {
                $picture = array();
                $uploads = $this->upload->file('ImageFile');
                foreach($uploads as $upload)
                {
                    if(!empty($upload)) $picture[] = site_url($this->upload->path.'/'.$upload);
                }

                return json_encode(array('message' => '', 'picture' => implode('|', $picture)));
            }
        }
    }

}

?>