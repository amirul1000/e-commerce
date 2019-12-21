<?php

class Groupsm extends CI_Model {

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

    function pagination()
    {
        $qgroups = $this->db->query("SELECT COUNT(id) AS total FROM groups WHERE id_user='".$this->general->id_user()."'");
        return $qgroups->row()->total;
    }

    function listing($page = 1)
    {
        $list   = array();
        $qgroups = $this->db->query("SELECT id, name, user_id, user_name, timestamp FROM groups WHERE id_user='".$this->general->id_user()."' ORDER BY id DESC ".$this->pages->set_limit($page));
        if($qgroups->num_rows() > 0)
        {
            foreach($qgroups->result() as $group)
            {
                $list[$group->id]['id']        = $group->id;
                $list[$group->id]['user_id']   = $group->user_id;
                $list[$group->id]['name']      = $group->name;
                $list[$group->id]['user_name'] = $group->user_name;
                $list[$group->id]['timestamp'] = date('m-d-Y', $group->timestamp);
            }
        }

        return $list;
    }

    function listing_groups()
    {
        $list    = array();
        $id_user = $this->general->id_user();
        $qgroups = $this->db->query("SELECT id, name, user_id, user_name, timestamp FROM groups WHERE id_user='".$id_user."'");

        foreach($qgroups->result() as $group)
        {
            $list[$group->user_id]['id']                              = $group->user_id;
            $list[$group->user_id]['name']                            = $group->user_name;
            $list[$group->user_id]['groups'][$group->id]['id']        = $group->id;
            $list[$group->user_id]['groups'][$group->id]['name']      = $group->name;
            $list[$group->user_id]['groups'][$group->id]['timestamp'] = date('m-d-Y', $group->timestamp);
        }

        return $list;
    }

    function get_data($id_group, $id_user, $user_id)
    {
        $list['batch_response']['groups']['data'] = array();
        $list['batch_response']['mpages']['data'] = array();

        $fbaccess = $this->faceboook->access();
        if(isset($fbaccess['batch_response']) && isset($fbaccess['batch_response']['user_info']['id']) && $fbaccess['batch_response']['user_info']['id'] == $user_id)
        {
            if(isset($fbaccess['batch_response']['groups']['data']))
            {
                foreach($fbaccess['batch_response']['groups']['data'] as $group)
                {
                    $list['batch_response']['groups']['data'][$group['id']]['id']   = $group['id'];
                    $list['batch_response']['groups']['data'][$group['id']]['name'] = $group['name'];
                }
            }
            if(isset($fbaccess['batch_response']['mpages']['data']))
            {
                foreach($fbaccess['batch_response']['mpages']['data'] as $page)
                {
                    $list['batch_response']['mpages']['data'][$page['id']]['id']           = $page['id'];
                    $list['batch_response']['mpages']['data'][$page['id']]['name']         = $page['name'];
                    $list['batch_response']['mpages']['data'][$page['id']]['access_token'] = $page['access_token'];
                }
            }
        }

        $qgroups = $this->db->query("SELECT id_wall, name, page_access_token, type FROM groups_data WHERE id_group='".$id_group."' AND id_user='".$id_user."'");
        foreach($qgroups->result() as $group)
        {
            if($group->type == 2)
            {
                $list['batch_response']['groups']['data'][$group->id_wall]['id']           = $group->id_wall;
                $list['batch_response']['groups']['data'][$group->id_wall]['name']         = $group->name;
                $list['batch_response']['groups']['data'][$group->id_wall]['checked']      = 1;
            }
                else
            {
                $list['batch_response']['mpages']['data'][$group->id_wall]['id']           = $group->id_wall;
                $list['batch_response']['mpages']['data'][$group->id_wall]['name']         = $group->name;
                $list['batch_response']['mpages']['data'][$group->id_wall]['access_token'] = $group->page_access_token;
                $list['batch_response']['mpages']['data'][$group->id_wall]['checked']      = 1;
            }
        }

        return $list;
    }

    /*
    |--------------------------------------------------------------------------
    | Load frame add/edit group
    |--------------------------------------------------------------------------
    |
    */

    function load_frame()
    {
        if(isset($_POST['id']))
        {
            #initialization
            $id = (int)$this->input->post('id');

            if($id == 0)
            {
                $data['title']    = LNG_ADD_GROUP;
                $data['button']   = 'add_group();';
                $data['fbaccess'] = $this->faceboook->access();
            }
                else if($id > 0)
            {
                $qgroups = $this->db->query("SELECT id, id_user, user_id, name FROM groups WHERE id='".$id."' LIMIT 1");
                if($qgroups->num_rows() > 0)
                {
                    $data['title']    = LNG_EDIT_GROUP.' '.$qgroups->row()->name;
                    $data['name']     = $qgroups->row()->name;
                    $data['fbaccess'] = $this->get_data($id, $qgroups->row()->id_user, $qgroups->row()->user_id);
                    $data['checked']  = 1;
                    $data['button']   = 'edit_group('.$id.');';
                }
                    else
                {
                    return json_encode(array('result' => 'ok', 'refresh' => ''));
                }
            }

            return json_encode(array('result' => 'ok', 'refresh' => $this->load->view('sections/frame-loadgroup', $data, true)));
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Add/edit/delete group
    |--------------------------------------------------------------------------
    |
    */

    function add_group()
    {
        if($this->input->post('formuser') == 'submit')
        {
            $done        = 0;
            $error       = 0;
            $errors      = $errors_list = array();
            $name        = $this->general->xss_post($this->input->post('name'), TRUE);
            $field_pages = $this->input->post('pages');

            $fields = array('name' => $name);
            foreach($fields as $key => $value)
            {
                if($value == "")
                {
                    $error        = 1;
                    $errors[$key] = 1;
                }
            }

            if(empty($name) || empty($field_pages))
            {
                $errors_list = LNG_ALL_FIELDS_REQUIRED;
                $error       = 1;
            }

            if(empty($error))
            {
                #initialization
                $fb_token_ext = $this->session->userdata('fb_sdk_token_ext');
                $fb_token_ext = !empty($fb_token_ext)? '###1':'';
                $fb_token     = $this->session->userdata('fb_sdk_token');
                $fb_user      = $this->session->userdata('fb_sdk_user');
                $fb_user      = json_decode($fb_user, true);
                $fb_user_id   = isset($fb_user['id'])? $fb_user['id']:0;
                $fb_user_name = isset($fb_user['name'])? $fb_user['name']:'Unknown';
                $id_user      = $this->general->id_user();

                $this->db->query("INSERT INTO groups(id_user, user_id, user_name, access_token, name, timestamp) VALUES('".$id_user."', '".$fb_user_id."', '".$this->general->xss_post($fb_user_name)."', '".$fb_token.$fb_token_ext."', '".$name."', '".$this->core->timestamp()."')");

                $last_insert_id = $this->db->insert_id();
                if(!empty($field_pages))
                {
                    foreach($field_pages as $page)
                    {
                        $exp_page = explode('||', $page);
                        if(isset($exp_page[0]) && !empty($exp_page[0]))
                        {
                            $this->db->query("INSERT INTO groups_data(id_group, id_user, id_wall, name, type, page_access_token) VALUES('".$last_insert_id."', '".$id_user."', '".$exp_page[0]."', '".$this->general->xss_post(addslashes(urldecode($exp_page[1])))."', '".( str_replace(array('pages', 'groups', 'friends'), array(1,2,3), $exp_page[2]) )."', '".(isset($exp_page[3])? $exp_page[3].$fb_token_ext:0)."')");
                        }
                    }
                }

                $done = 1;
            }

            return json_encode(array('result' => 'ok', 'errors' => $errors, 'errors_list' => $errors_list, 'done' => $done));
        }
    }

    function edit_group()
    {
        if($this->input->post('formuser') == 'submit')
        {
            $done        = 0;
            $error       = 0;
            $errors      = $errors_list = array();
            $id_group    = (int)$this->input->post('id');
            $name        = $this->general->xss_post($this->input->post('name'), TRUE);
            $field_pages = $this->input->post('pages');
            $id_user     = $this->general->id_user();

            $fields = array('name' => $name);
            foreach($fields as $key => $value)
            {
                if($value == "")
                {
                    $error        = 1;
                    $errors[$key] = 1;
                }
            }

            if(empty($name) || empty($field_pages))
            {
                $errors_list = LNG_ALL_FIELDS_REQUIRED;
                $error       = 1;
            }

            if(empty($error))
            {
                $this->db->query("UPDATE groups SET name='".$name."' WHERE id='".$id_group."' AND id_user='".$id_user."'");

                if(!empty($field_pages))
                {
                    $this->db->query("DELETE FROM groups_data WHERE id_group='".$id_group."' AND id_user='".$id_user."'");
                    foreach($field_pages as $page)
                    {
                        $exp_page = explode('||', $page);
                        if(isset($exp_page[0]) && !empty($exp_page[0]))
                        {
                            $this->db->query("INSERT INTO groups_data(id_group, id_user, id_wall, name, type, page_access_token) VALUES('".$id_group."', '".$id_user."', '".$exp_page[0]."', '".$this->general->xss_post(addslashes(urldecode($exp_page[1])))."', '".( str_replace(array('pages', 'groups', 'friends'), array(1,2,3), $exp_page[2]) )."', '".(isset($exp_page[3])? $exp_page[3]:0)."')");
                        }
                    }
                }

                $done = 1;
            }

            return json_encode(array('result' => 'ok', 'errors' => $errors, 'errors_list' => $errors_list, 'done' => $done));
        }
    }

    function delete_group()
    {
        #initialization
        $id_group = (int)$this->input->post('id');
        $id_user  = $this->general->id_user();
        $refresh  = 0;

        if(!empty($id_group))
        {
            $this->db->query("DELETE FROM groups WHERE id='".$id_group."' AND id_user='".$id_user."'");
            $this->db->query("DELETE FROM groups_data WHERE id_group='".$id_group."' AND id_user='".$id_user."'");
            $refresh = 1;
        }

        return json_encode(array('result' => 'ok', 'refresh' => $refresh));
    }

}

?>