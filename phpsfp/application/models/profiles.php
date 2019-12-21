<?php

class Profiles extends CI_Model {

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

    function filter($status)
    {
        if($status == 'active')
        {
            $query_status = " AND status = '1'";
        }
            else if($status == 'inactive')
        {
            $query_status = " AND status = '0'";
        }
            else
        {
            $query_status = "";
        }

        $search = isset($_GET['user'])? $this->general->xss_post($_GET['user']):0;
        if(!empty($search))
        {
            $query_status .= " AND (name LIKE '%".$this->db->escape_like_str($search)."%' OR username LIKE '%".$this->db->escape_like_str($search)."%')";
        }

        return $query_status;
    }

    function pagination($status)
    {
        $qusers = $this->db->query("SELECT COUNT(id) AS total FROM users WHERE 1 ".$this->filter($status));
        return $qusers->row()->total;
    }

    function listing($page = 1, $status = 'all')
    {
        $list   = array();
        $qusers = $this->db->query("SELECT id, name, email, username, fb_user_id, password, gmt, gmt_zone, access, timestamp_login, timestamp, status FROM users WHERE 1 ".$this->filter($status)." ORDER BY id DESC ".$this->pages->set_limit($page));
        if($qusers->num_rows() > 0)
        {
            foreach($qusers->result() as $user)
            {
                $list[$user->id]['id']              = $user->id;
                $list[$user->id]['name']            = $user->name;
                $list[$user->id]['email']           = $user->email;
                $list[$user->id]['username']        = $user->username;
                $list[$user->id]['timestamp_login'] = (!empty($user->timestamp_login))? date('m-d-Y', $user->timestamp_login):'-';
                $list[$user->id]['timestamp']       = date('m-d-Y', $user->timestamp);
                $list[$user->id]['status']          = $user->status;
            }
        }

        return $list;
    }

    /*
    |--------------------------------------------------------------------------
    | Load frame add/edit user
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
                $data['title']  = LNG_ADD_USER;
                $data['button'] = 'add_user();';
            }
                else if($id > 0)
            {
                $qusers = $this->db->query("SELECT users.id, users.name, users.email, users.username, users.fb_user_id, users.fb_id, users.password, users.gmt, users.gmt_zone, users.access, users.timestamp_login, users.timestamp, settings.app_default, settings.pages_limit, settings.groups_limit FROM users LEFT JOIN settings ON users.id=settings.id_user WHERE users.id='".$id."' LIMIT 1");

                if($qusers->num_rows() > 0)
                {
                    $data['title']        = LNG_EDIT_USER.' '.$qusers->row()->name;
                    $data['name']         = $qusers->row()->name;
                    $data['email']        = $qusers->row()->email;
                    $data['username']     = $qusers->row()->username;
                    $data['fbuserid']     = $qusers->row()->fb_user_id;
                    $data['fbid']         = $qusers->row()->fb_id;
                    $data['appdefault']   = $qusers->row()->app_default;
                    $data['limit_pages']  = $qusers->row()->pages_limit;
                    $data['limit_groups'] = $qusers->row()->groups_limit;
                    $data['type']         = ($qusers->row()->access == 1)? LNG_ADMIN:LNG_USER;
                    $data['access']       = $qusers->row()->access;
                    $data['button']       = 'edit_user('.$id.');';
                }
                    else
                {
                    return json_encode(array('result' => 'ok', 'refresh' => ''));
                }
            }

            return json_encode(array('result' => 'ok', 'refresh' => $this->load->view('sections/frame-loaduser', $data, true)));
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Add/edit/delete user
    |--------------------------------------------------------------------------
    |
    */

    function add_user()
    {
        if($this->input->post('formuser') == 'submit')
        {
            $done         = 0;
            $error        = 0;
            $errors       = $errors_list = array();

            $name         = $this->security->sanitize_filename($this->input->post('name'), TRUE);
            $email        = $this->security->sanitize_filename($this->input->post('email'), TRUE);
            $admin        = (int)$this->input->post('admin', true);
            $username     = $this->security->sanitize_filename($this->input->post('username'), TRUE);
            $password     = $this->input->post('password', true);
            $repassword   = $this->input->post('repassword', true);
            $fb_user_id   = $this->input->post('fbuserid', true);
            $fb_id        = $this->input->post('fbid', true);
            $appdefault   = (int)$this->input->post('appdefault', true);
            $limit_pages  = (int)$this->input->post('limit_pages', true);
            $limit_groups = (int)$this->input->post('limit_groups', true);

            $fields = array('name' => $name, 'email' => $email, 'username' => $username, 'password' => $password, 'repassword' => $repassword);
            foreach($fields as $key => $value)
            {
                if($value == "")
                {
                    $error        = 1;
                    $errors[$key] = 1;
                }
            }

            if(!empty($password) && !empty($repassword) && $password != $repassword)
            {
                $error = 1;
                $errors['password'] = $errors['repassword'] = 1;
                $errors_list = LNG_PASSWORD_NOT_MATCH;
            }

            if(empty($name) || empty($email) || empty($username) || empty($password) || empty($repassword))
            {
                $errors_list = LNG_ALL_FIELDS_REQUIRED;
                $error       = 1;
            }
                else if(!empty($username))
            {
                $qusers = $this->db->query("SELECT id FROM users WHERE username='".$username."'");
                if($qusers->num_rows() > 0)
                {
                    $errors['username'] = 1;
                    $errors_list        = LNG_USERNAME_IN_USE;
                    $error              = 1;
                }
            }

            if(empty($error))
            {
                $this->db->query("INSERT INTO users(name, email, username, fb_user_id, fb_id, password, access, timestamp) VALUES('".$name."', '".$email."', '".$username."', '".$fb_user_id."', '".$fb_id."', '".$this->encrypt->sha1($password)."', '".$admin."', '".$this->core->timestamp()."')");
                $this->db->query("INSERT INTO settings(id_user, app_default, pages_limit, groups_limit) VALUES('".$this->db->insert_id()."', '".$appdefault."', '".$limit_pages."', '".$limit_groups."')");
                $done = 1;
            }

            return json_encode(array('result' => 'ok', 'errors' => $errors, 'errors_list' => $errors_list, 'done' => $done));
        }
    }

    function edit_user()
    {
        if($this->input->post('formuser') == 'submit')
        {
            $done         = 0;
            $error        = 0;
            $errors       = $errors_list = array();

            $id_user      = (int)$this->input->post('id');
            $name         = $this->security->sanitize_filename($this->input->post('name'), TRUE);
            $email        = $this->security->sanitize_filename($this->input->post('email'), TRUE);
            $admin        = (int)$this->input->post('admin', true);
            $username     = $this->security->sanitize_filename($this->input->post('username'), TRUE);
            $password     = $this->input->post('password', true);
            $repassword   = $this->input->post('repassword', true);
            $fb_user_id   = $this->input->post('fbuserid', true);
            $fb_id        = $this->input->post('fbid', true);
            $appdefault   = (int)$this->input->post('appdefault', true);
            $limit_pages  = (int)$this->input->post('limit_pages', true);
            $limit_groups = (int)$this->input->post('limit_groups', true);

            $fields = array('name' => $name, 'email' => $email, 'username' => $username);
            foreach($fields as $key => $value)
            {
                if($value == "")
                {
                    $error        = 1;
                    $errors[$key] = 1;
                }
            }

            if(!empty($password) && !empty($repassword) && $password != $repassword)
            {
                $error = 1;
                $errors['password'] = $errors['repassword'] = 1;
                $errors_list = LNG_PASSWORD_NOT_MATCH;
            }

            if(empty($name) || empty($email) || empty($username))
            {
                $errors_list = LNG_ALL_FIELDS_REQUIRED;
                $error       = 1;
            }
                else if(!empty($username))
            {
                $qusers = $this->db->query("SELECT id FROM users WHERE username='".$username."' AND id!='".$id_user."' LIMIT 1");
                if($qusers->num_rows() > 0)
                {
                    $errors['username'] = 1;
                    $errors_list        = LNG_USERNAME_IN_USE;
                    $error              = 1;
                }
            }

            if(empty($error))
            {
                $this->db->query("UPDATE users SET name='".$name."', email='".$email."', username='".$username."', fb_user_id='".$fb_user_id."', fb_id='".$fb_id."' ".( (!empty($password) && !empty($repassword) && $password == $repassword)? ", password='".$this->encrypt->sha1($password)."'":"" )." , access='".$admin."' WHERE id='".$id_user."'");
                $this->db->query("UPDATE settings SET app_default='".$appdefault."', pages_limit='".$limit_pages."', groups_limit='".$limit_groups."' WHERE id_user='".$id_user."'");
                $done = 1;
            }

            return json_encode(array('result' => 'ok', 'errors' => $errors, 'errors_list' => $errors_list, 'done' => $done));
        }
    }

    function delete_user()
    {
        #initialization
        $admin   = $this->general->admin();
        $id_user = (int)$this->input->post('id');
        $refresh = 0;

        if(!empty($admin) && !empty($id_user) && $id_user != '1')
        {
            $this->db->query("DELETE FROM users WHERE id='".$id_user."'");
            $this->db->query("DELETE error_log FROM cronjobs, error_log, posts WHERE cronjobs.id=error_log.id_cron AND cronjobs.id_post=posts.id AND posts.id_users='".$id_user."'");
            $this->db->query("DELETE cronjobs FROM cronjobs, posts WHERE cronjobs.id_post=posts.id AND posts.id_users='".$id_user."'");
            $this->db->query("DELETE FROM posts WHERE id_users='".$id_user."'");
            $this->db->query("DELETE FROM groups WHERE id_user='".$id_user."'");
            $this->db->query("DELETE FROM groups_data WHERE id_user='".$id_user."'");
            $this->db->query("DELETE FROM settings WHERE id_user='".$id_user."'");

            $refresh = 1;
        }

        return json_encode(array('result' => 'ok', 'refresh' => $refresh));
    }

    function status_user()
    {
        #initialization
        $admin   = $this->general->admin();
        $id_user = (int)$this->input->post('id');
        $status  = 0;

        $qusers = $this->db->query("SELECT status FROM users WHERE id='".$id_user."'");
        if($qusers->num_rows() > 0 && !empty($admin))
        {
            $status = ($qusers->row()->status == 1)? 0:1;
            $this->db->query("UPDATE users SET status='".$status."' WHERE id='".$id_user."' AND id!='1'");
        }

        return json_encode(array('result' => 'ok', 'status' => $status));
    }

}

?>