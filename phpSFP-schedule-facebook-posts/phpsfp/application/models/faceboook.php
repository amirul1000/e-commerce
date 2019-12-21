<?php

class Faceboook extends CI_Model {

    var $app_id         = '';
    var $app_secret     = '';
    var $app_version    = '';
    var $app_token      = '';
    var $app_general    = 1;
    var $pages_limit    = '';
    var $groups_limit   = '';
    var $retry_limit    = '';
    var $ap_enabled     = 0;
    var $ap_posts_limit = 0;
    var $ap_posts_time  = 0;
    var $track_clicks   = '';
    var $post_admin     = '';
    var $role_auto      = 0;
    var $random_time    = 0;
    var $upload_limit   = 0;
    var $send_interval  = 60;

    function __construct()
    {
        parent::__construct();
    }

    function settings($id_user = false)
    {
        $qsettings_general = $this->db->query("SELECT app_id, app_secret, app_version, app_token, pages_limit, groups_limit, retry_limit, ap_enabled, ap_posts_limit, ap_posts_time, track_clicks, post_admin, role_auto, random_time, upload_limit, send_interval FROM settings_general WHERE id='1' LIMIT 1");
        if($qsettings_general->num_rows() > 0)
        {
            $this->app_id         = $qsettings_general->row()->app_id;
            $this->app_secret     = $qsettings_general->row()->app_secret;
            $this->app_version    = str_replace('v', '', $qsettings_general->row()->app_version);
            $this->app_token      = $qsettings_general->row()->app_token;
            $this->pages_limit    = $qsettings_general->row()->pages_limit;
            $this->groups_limit   = $qsettings_general->row()->groups_limit;
            $this->retry_limit    = 1; //$qsettings_general->row()->retry_limit;
            $this->ap_enabled     = $qsettings_general->row()->ap_enabled;
            $this->ap_posts_limit = $qsettings_general->row()->ap_posts_limit;
            $this->ap_posts_time  = $qsettings_general->row()->ap_posts_time;
            $this->track_clicks   = $qsettings_general->row()->track_clicks;
            $this->post_admin     = $qsettings_general->row()->post_admin;
            $this->role_auto      = $qsettings_general->row()->role_auto;
            $this->random_time    = $qsettings_general->row()->random_time;
            $this->upload_limit   = $qsettings_general->row()->upload_limit;
            $this->send_interval  = $qsettings_general->row()->send_interval;
        }

        $id_user   = !empty($id_user)? $id_user:$this->encrypt->decode($this->session->userdata('username'));
        $qsettings = $this->db->query("SELECT app_id, app_secret, app_version, app_default, pages_limit, groups_limit, ap_enabled, ap_posts_limit, ap_posts_time FROM settings WHERE id_user='".$id_user."' LIMIT 1");
        if($qsettings->num_rows() > 0)
        {
            $qusers = $this->db->query("SELECT access FROM users WHERE id='".$id_user."' LIMIT 1");
            $admin  = ($qusers->num_rows() > 0)? $qusers->row()->access:0;
            if($qsettings->row()->app_default == 1 && empty($admin))
            {
                $this->app_id         = $qsettings->row()->app_id;
                $this->app_secret     = $qsettings->row()->app_secret;
                $this->app_version    = str_replace('v', '', $qsettings->row()->app_version);
                $this->app_general    = 0;
                $this->ap_enabled     = $qsettings->row()->ap_enabled;
                $this->ap_posts_limit = $qsettings->row()->ap_posts_limit;
                $this->ap_posts_time  = $qsettings->row()->ap_posts_time;
            }

            if(!empty($qsettings->row()->pages_limit))
            {
                $this->pages_limit = $qsettings->row()->pages_limit;
            }

            if(!empty($qsettings->row()->groups_limit))
            {
                $this->groups_limit = $qsettings->row()->groups_limit;
            }
        }
    }

    function token_time($access_token, $time)
    {
        $access_token_info = $this->general->custom_file_get_contents('https://graph.facebook.com/oauth/access_token_info?client_id='.$this->app_id.'&access_token='.$access_token);
        $access_token_info = json_decode($access_token_info);

        if(isset($access_token_info->access_token) && isset($access_token_info->expires_in))
        {
            return timespan($time - $access_token_info->expires_in, $time);
        }
            else if(isset($access_token_info->access_token) && !isset($access_token_info->expires_in))
        {
            return LNG_TOKEN_NOT_EXPIRE;
        }
            else
        {
            return LNG_TOKEN_NOT_EXPIRE_TIME;
        }
    }

    function access()
    {
        $list = array();
        $loginUrl = $logoutUrl = $batch_response = '';
        $segment = $this->uri->segment(1);

        $this->settings();
        $this->config->set_item('facebook_app_id', $this->app_id);
        $this->config->set_item('facebook_app_secret', $this->app_secret);
        $this->config->set_item('facebook_app_version', $this->app_version);
        $this->config->set_item('facebook_redirect_url', site_url('index.php/'.(!empty($segment)? $segment:'dashboard')));
        $this->load->library('facebook');

        $user = $this->facebook->getUser();

        # redirect CSRF
        if($user && isset($_GET['code']) && ($segment == 'dashboard' || $segment == 'groups'))
        {
            # ftester
            if($this->app_general == 1 && $this->role_auto == 1)
            {
                $role       = $this->facebook->getRole($user['id']);
                $id_fb_user = $this->general->id_fb_user();

                if($role == 'administrators' && $this->general->admin())
                {
                    $this->db->query("UPDATE settings_general SET app_token='".$this->session->userdata('fb_sdk_token')."' WHERE id='1'");
                }
                    else if($role == '' && !empty($id_fb_user))
                {
                    $ftester = $this->facebook->api('/'.$this->app_id.'/roles', 'POST', array('access_token' => $this->app_token, 'user' => $id_fb_user, 'role' => 'testers'));
                    if(isset($ftester['success']))
                    {
                        $this->logout('?ftester');
                    }
                }
            }

            # fbdata
            $this->fbdata($user['id'], 'update');

            redirect('index.php/'.$segment);
        }

        if($user)
        {
            $logoutUrl  = $this->facebook->getLogoutUrl();
            $fb_user_id = $this->general->info('fb_user_id');

            /*
            if(!empty($fb_user_id) && $fb_user_id != $user['id'])
            {
                $this->session->unset_userdata('fb_sdk_token');
                redirect('index.php/dashboard/index/error_fb_user_id/'.$user['id']);
            }
            */

            $batch_response = $this->fbdata($user['id']);
        }
            else
        {
            $loginUrl = $this->facebook->getLoginUrl();
        }

        $list['user']           = $user;
        $list['loginUrl']       = $loginUrl;
        $list['logoutUrl']      = $logoutUrl;
        $list['batch_response'] = $batch_response;

        return $list;
    }

    function fbdata($user_id, $action = false, $groups = false)
    {
        $qfbdata = $this->db->query("SELECT data FROM fbdata WHERE user_id='".$user_id."' LIMIT 1");
        if($qfbdata->num_rows() > 0)
        {
            if($action == 'update')
            {
                $batch_response = $this->facebook->batch_request($user_id, $this->groups_limit, $this->pages_limit, $groups);

                if($this->app_version > 0 && empty($groups)) //if($this->app_version > 2.3 && empty($groups))
                {
                    $data = json_decode($qfbdata->row()->data, true);
                    $batch_response['groups']['data'] = $data['groups']['data'];
                }

                $this->db->query("UPDATE fbdata SET data='".addslashes(json_encode($batch_response))."' WHERE user_id='".$user_id."'");
            }
                else
            {
                return json_decode($qfbdata->row()->data, true);
            }
        }
            else
        {
            $batch_response = $this->facebook->batch_request($user_id, $this->groups_limit, $this->pages_limit, $groups);
            $this->db->query("INSERT INTO fbdata(user_id, data) VALUES('".$user_id."', '".addslashes(json_encode($batch_response))."')");

            return $batch_response;
        }
    }

    function logout($id = false)
    {
        $this->session->unset_userdata('fb_sdk_token_ext');
        $this->session->unset_userdata('fb_sdk_token');
        $this->session->unset_userdata('fb_sdk_user');
        redirect('index.php/dashboard'.$id);
    }

    function renew_tokens()
    {
        $this->settings();
        $this->config->set_item('facebook_app_id', $this->app_id);
        $this->config->set_item('facebook_app_secret', $this->app_secret);
        $this->config->set_item('facebook_app_version', $this->app_version);
        $this->config->set_item('facebook_redirect_url', site_url('index.php/dashboard'));
        $this->load->library('facebook');

        $user = $this->facebook->getUser();

        if($user)
        {
            $user         = $user['id'];
            $fb_token_ext = $this->session->userdata('fb_sdk_token_ext');
            $fb_token_ext = !empty($fb_token_ext)? '###1':'';
            $fb_token     = $this->session->userdata('fb_sdk_token');
            $this->db->query("UPDATE groups SET access_token='".$fb_token.$fb_token_ext."' WHERE user_id='".$user."'");
            $this->db->query("UPDATE posts SET access_token='".$fb_token.$fb_token_ext."' WHERE user_id='".$user."'");

            $queries = array(
                array('method' => 'GET', 'relative_url' => '/'.$user.'/accounts?limit='.$this->pages_limit)
            );

            $batch_response = $this->facebook->api('?batch='.urlencode(json_encode($queries)), 'POST');
            if(isset($batch_response['error']))
            {
                $content = $batch_response['error'];
            }
                else
            {
                $mpages = json_decode($batch_response[0]->body, true);
                if(!isset($mpages['error']))
                {
                    foreach($mpages['data'] as $page)
                    {
                        if(!empty($page['access_token']))
                        {
                            $page['access_token'] = $page['access_token'].$fb_token_ext;
                        }

                        $this->db->query("UPDATE groups, groups_data SET groups_data.page_access_token='".$page['access_token']."' WHERE groups.id=groups_data.id_group AND groups_data.id_wall='".$page['id']."' AND groups.user_id='".$user."'");

                        $this->db->query("UPDATE posts, cronjobs SET cronjobs.page_access_token='".$page['access_token']."' WHERE posts.id=cronjobs.id_post AND cronjobs.id_wall='".$page['id']."' AND posts.user_id='".$user."'");
                    }
                }

                $content = LNG_TOKEN_UPDATE;
            }
        }

        return json_encode(array('result' => 'ok', 'content' => $content));
    }

    function check_token_permissions()
    {
        $this->settings();
        $this->config->set_item('facebook_app_id', $this->app_id);
        $this->config->set_item('facebook_app_secret', $this->app_secret);
        $this->config->set_item('facebook_app_version', $this->app_version);
        $this->config->set_item('facebook_redirect_url', site_url('index.php/dashboard'));
        $this->load->library('facebook');

        $data             = array();
        $data['title']    = LNG_SETTINGS;
        $data['rrequest'] = $this->facebook->getReRequestUrl();
        $data['perms']    = array('public_profile' => false, 'manage_pages' => false, 'publish_pages' => false, 'publish_actions' => false, 'user_likes' => false, 'user_groups' => false, 'user_managed_groups' => false);
        $permissions      = $this->facebook->api('/me/permissions', 'GET', array('access_token' => $this->session->userdata('fb_sdk_token')));

        if(!empty($permissions) && is_array($permissions) && !isset($permissions['error']))
        {
            foreach($permissions as $row)
            {
                if($row->status == 'granted')
                {
                    if($row->permission == 'public_profile') $data['perms']['public_profile'] = true;
                    if($row->permission == 'manage_pages') $data['perms']['manage_pages'] = true;
                    if($row->permission == 'publish_pages') $data['perms']['publish_pages'] = true;
                    if($row->permission == 'publish_actions') $data['perms']['publish_actions'] = true;
                    if($row->permission == 'user_likes') $data['perms']['user_likes'] = true;
                    if($row->permission == 'user_groups') $data['perms']['user_groups'] = true;
                    if($row->permission == 'user_managed_groups') $data['perms']['user_managed_groups'] = true;
                }
            }

            if($this->app_version > 0) //if($this->app_version > 2.3)
            {
                unset($data['perms']['user_groups']);
            }
                else
            {
                unset($data['perms']['user_managed_groups']);
            }
        }
            else if(isset($permissions['error']))
        {
            $data['error'] = $permissions['error'];
        }

        return json_encode(array('result' => 'ok', 'refresh' => $this->load->view('sections/frame-loadpermissions', $data, true)));
    }

    function load_frame_login_via_at()
    {
        $tokens = array();
        $qat    = $this->db->query("SELECT id, user_name FROM at WHERE id_user='".$this->general->id_user()."' ORDER BY count DESC");
        foreach($qat->result() as $row)
        {
            $tokens[$row->id]['id']        = $row->id;
            $tokens[$row->id]['user_name'] = $row->user_name;
        }

        $data['title']  = LNG_LOGIN_VIA_AT;
        $data['button'] = 'login_via_at();';
        $data['tokens'] = $tokens;

        return json_encode(array('result' => 'ok', 'refresh' => $this->load->view('sections/frame-login-via-at', $data, true)));
    }

    function login_via_at()
    {
        if($this->input->post('formloginviaat') == 'submit')
        {
            $done   = 0;
            $error  = 0;
            $errors = $errors_list = array();
            $fb_at  = $this->input->post('fbat', true);
            $fb_at  = preg_replace('/\s+/', '', $fb_at);
            $action = $this->input->post('action', true);

            if(is_numeric($fb_at))
            {
                if($action == 'del')
                {
                    $this->db->query("DELETE FROM at WHERE id_user='".$this->general->id_user()."' AND id='".$fb_at."'");
                    return json_encode(array('result' => 'ok', 'errors' => $errors, 'errors_list' => $errors_list, 'done' => 1));
                }

                $qat = $this->db->query("SELECT access_token FROM at WHERE id_user='".$this->general->id_user()."' AND id='".$fb_at."'");
                if($qat->num_rows() > 0)
                {
                    $this->db->query("UPDATE at SET count=count+1 WHERE id='".$fb_at."'");
                    $fb_at = $qat->row()->access_token;
                }
            }

            $fields = array('fbat' => $fb_at);
            foreach($fields as $key => $value)
            {
                if($value == "")
                {
                    $error        = 1;
                    $errors[$key] = 1;
                }
            }

            if(empty($fb_at))
            {
                $errors_list = LNG_ALL_FIELDS_REQUIRED;
                $error       = 1;
            }

            if(empty($error))
            {
                $this->session->set_userdata('fb_sdk_token', $fb_at);
                $this->session->set_userdata('fb_sdk_token_ext', 1);
                $done = 1;

                $this->settings();
                $this->config->set_item('facebook_app_id', $this->app_id);
                $this->config->set_item('facebook_app_secret', $this->app_secret);
                $this->config->set_item('facebook_app_version', $this->app_version);
                $this->config->set_item('facebook_redirect_url', site_url('index.php/dashboard'));
                $this->load->library('facebook');

                $user = $this->facebook->getUser();

                if(isset($user['name']))
                {
                    $id_user = $this->general->id_user();
                    $qat = $this->db->query("SELECT id FROM at WHERE id_user='".$id_user."' AND access_token='".$fb_at."' LIMIT 1");
                    if($qat->num_rows() == 0)
                    {
                        $fbapi = $this->facebook->api('/app', 'GET', array("access_token" => $fb_at));
                        if(!empty($fbapi) && isset($fbapi['name']))
                        {
                            $user['name'] = $user['name'].' ('.$fbapi['name'].')';
                        }
                        $this->db->query("INSERT INTO at(id_user, user_id, user_name, access_token) VALUES('".$id_user."', '".$user['id']."', '".$this->general->xss_post($user['name'])."', '".$fb_at."')");
                    }
                }
            }

            return json_encode(array('result' => 'ok', 'errors' => $errors, 'errors_list' => $errors_list, 'done' => $done));
        }
    }

    function load_frame_invite()
    {
        $data['title']  = LNG_INVITE_AS_TESTER;
        $data['button'] = 'send_invite();';

        return json_encode(array('result' => 'ok', 'refresh' => $this->load->view('sections/frame-invite', $data, true)));
    }

    function send_invite()
    {
        if($this->input->post('forminvite') == 'submit')
        {
            $done   = 0;
            $error  = 0;
            $errors = $errors_list = array();
            $fb_id  = $this->input->post('fbid', true);

            $fields = array('fbid' => $fb_id);
            foreach($fields as $key => $value)
            {
                if($value == "")
                {
                    $error        = 1;
                    $errors[$key] = 1;
                }
            }

            if(empty($fb_id))
            {
                $errors_list = LNG_ALL_FIELDS_REQUIRED;
                $error       = 1;
            }

            if(empty($error))
            {
                require_once(dirname(dirname(__FILE__)).'/libraries/facebook/facebook.php');

                $this->faceboook->settings();
                $this->config->set_item('facebook_app_id', $this->faceboook->app_id);
                $this->config->set_item('facebook_app_secret', $this->faceboook->app_secret);
                $this->config->set_item('facebook_app_version', $this->faceboook->app_version);
                $this->config->set_item('facebook_call', 1);

                $this->facebook = new Facebook();

                $ftester = $this->facebook->api('/'.$this->app_id.'/roles', 'POST', array('access_token' => $this->app_token, 'user' => $fb_id, 'role' => 'testers'));
                if(isset($ftester['success']))
                {
                    $done = 1;
                }
                    else if(isset($ftester['error']))
                {
                    $error       = 1;
                    $errors_list = $ftester['error'];
                }
                    else
                {
                    $error       = 1;
                    $errors_list = LNG_FACEBOOK_ID_INVALID;
                }
            }

            return json_encode(array('result' => 'ok', 'errors' => $errors, 'errors_list' => $errors_list, 'done' => $done));
        }
    }

    function load_frame_import_groups()
    {
        $data['title']  = LNG_IMPORT_GROUPS_VIA_HTML;
        $data['button'] = 'import_groups();';

        return json_encode(array('result' => 'ok', 'refresh' => $this->load->view('sections/frame-import-groups', $data, true)));
    }

    function import_groups()
    {
        if(isset($_POST))
        {
            $done         = 0;
            $type         = isset($_POST['type'])? 1:0;
            $upload       = $this->upload->file('ImportFile', true);
            $file         = (!empty($upload))? $this->upload->path.'/'.$upload[0]:'';
            $fb_user      = $this->session->userdata('fb_sdk_user');
            $fb_token     = $this->session->userdata('fb_sdk_token');
            $fb_user      = json_decode($fb_user, true);
            $fb_user_name = isset($fb_user['name'])? $fb_user['name']:'Unknown';

            $this->settings();
            $this->config->set_item('facebook_app_id', $this->app_id);
            $this->config->set_item('facebook_app_secret', $this->app_secret);
            $this->config->set_item('facebook_app_version', $this->app_version);
            $this->config->set_item('facebook_redirect_url', site_url('index.php/dashboard'));
            $this->load->library('facebook');

            $user = $this->facebook->getUser();

            if(!empty($file))
            {
                $groups  = array();
                $sgroups = $this->facebook->groups($file);

                if(!empty($sgroups))
                {
                    $i = $k = 0;
                    $batch = array();
                    foreach($sgroups as $group)
                    {
                        if($this->groups_limit == $i) break;

                        $groups[$i]['id']   = $group['id'];
                        $groups[$i]['name'] = $group['name'];

                        $batch[$k][] = $groups[$i]['id'];

                        $i++;
                        if($i % 50 == 0) $k++;
                    }

                    if(!empty($batch) && !empty($type))
                    {
                        $remove = array();
                        foreach($batch as $segment)
                        {
                            $parameters = array();
                            $parameters['access_token'] = $fb_token;
                            $fapi = $this->facebook->api('?ids='.implode(',', $segment).'&fields=id,privacy,owner', 'GET', $parameters);
                            if(!empty($fapi) && is_array($fapi))
                            {
                                foreach($fapi as $object)
                                {
                                    if(isset($object->id) && !empty($object->id))
                                    {
                                        if(isset($object->owner->name) && $object->owner->name == $fb_user_name)
                                        {
                                            //null
                                        }
                                            else if(isset($object->privacy) && $object->privacy != 'OPEN')
                                        {
                                            $remove[] = $object->id;
                                        }
                                    }
                                }
                            }
                        }

                        if(!empty($remove) && !empty($groups))
                        {
                            foreach($groups as $key => $group)
                            {
                                if(in_array($group['id'], $remove))
                                {
                                    unset($groups[$key]);
                                }
                            }
                        }
                    }

                    if(!empty($groups))
                    {
                        $this->fbdata($user['id'], 'update', $groups);
                        @unlink($file);
                        $done = 1;
                    }
                }
            }

            return json_encode(array('done' => $done));
        }
    }

}

?>