<?php

class Auth extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function cookie()
    {
        if(get_cookie('login'))
        {
            @list($id_user, $password, $access) = @explode("|||", get_cookie('login'));
            $qusers = $this->db->query("SELECT id, access FROM users WHERE id='".(int)$id_user."' AND password='".$this->general->xss_post($this->db->escape_str($password))."' LIMIT 1");
            if($qusers->num_rows() > 0)
            {
                $this->session->set_userdata(array('username' => $id_user, 'access' => $qusers->row()->access, 'logged' => TRUE));
                redirect('index.php/dashboard');
            }
                else
            {
                delete_cookie('login', $this->config->item('link_domain'), $this->config->item('link_basename'), '');
            }
        }
            else
        {
            if($this->session->userdata('logged') == TRUE)
            {
                redirect('index.php/dashboard');
            }
        }
    }

    function auth()
    {
        $field_username = $field_password = $field_remember = "";
        $class_error = $title_error = "";
        $error = 0;
        $current_time = time();

        if($this->input->post('auth') == "submit")
        {
            $field_username = $this->general->xss_post($this->input->post('username'));
            $field_password = $this->general->xss_post($this->input->post('password'));
            $field_remember = $this->general->xss_post($this->input->post('remember'));

            if(empty($field_username) || empty($field_password))
            {
                $error       = 1;
                $class_error = ' error';
                $title_error = LNG_FIELDS_ARE_EMPTY;
            }
                else
            {
                $qusers = $this->db->query("SELECT id, password, access, status FROM users WHERE username='".$field_username."'");
                if($qusers->num_rows() > 0 && $qusers->row()->status == 0)
                {
                    $error       = 1;
                    $class_error = ' error';
                    $title_error = LNG_USER_ACTIVATED_BY_ADMIN;
                }
                    else if($qusers->num_rows() == 0 || ($qusers->num_rows() > 0 && $qusers->row()->password != $this->encrypt->sha1($field_password)))
                {
                    $error       = 1;
                    $class_error = ' error';
                    $title_error = LNG_INCORRECT_USERNAME_OR_PASSWORD;
                }
            }

            if(empty($error))
            {
                $this->session->set_userdata(array('username' => $this->encrypt->encode($qusers->row()->id), 'access' => $qusers->row()->access, 'logged'  => TRUE));

                if(!empty($field_remember))
                {
                    set_cookie(array('name' => 'login', 'value' => $this->encrypt->encode($qusers->row()->id)."|||".$qusers->row()->password."|||".$qusers->row()->access, 'expire' => $current_time + 30 * 86400, 'domain' => '.'.$this->config->item('link_domain'), 'path' => $this->config->item('link_basename'), 'prefix' => ''));
                }

                $this->db->query("UPDATE users SET timestamp_login='".$current_time."' WHERE id='".$qusers->row()->id."'");
                $redirect = $this->session->userdata('redirect');

                if(!empty($redirect))
                {
                    $this->session->unset_userdata(array('redirect' => ''));
                    redirect($redirect);
                }
                    else
                {
                    redirect('index.php/dashboard');
                }
            }
        }

        $qsettings = $this->db->query("SELECT newusers_crt FROM settings_general WHERE id='1' LIMIT 1");
        if($qsettings->num_rows() > 0)
        {
            $data['newusers_crt'] = $qsettings->row()->newusers_crt;
        }

        if($error == 0)
        {
            $data['field_username'] = "";
            $data['field_password'] = "";
            $data['field_remember'] = "";
        }
            else
        {
            $data['field_username'] = ($field_username != "")? $field_username:"";
            $data['field_password'] = ($field_password != "")? $field_password:"";
            $data['field_remember'] = ($field_remember != "")? $field_remember:"";
        }

        $data['error'] = array(
            'class_error' => $class_error,
            'title_error' => $title_error
        );

        return $data;
    }

    function create()
    {
        $field_name = $class_name = $title_name = "";
        $field_email = $class_email = $title_email = "";
        $field_username = $class_username = $title_username = "";
        $field_rfbid = $class_rfbid = $title_rfbid = "";
        $field_password = $class_password = $title_password = "";
        $field_repassword = $class_repassword = $title_repassword = "";
        $class_error = $title_error = "";
        $error = 0;
        $current_time = time();
        $qsettings = $this->db->query("SELECT newusers_app, newusers_crt FROM settings_general WHERE id='1' LIMIT 1");

        # - "create an account" is disabled ?
        if($qsettings->num_rows() > 0 && $qsettings->row()->newusers_crt == 0) redirect('index.php/login');

        if($this->input->post('auth') == "submit")
        {
            $field_name       = $this->general->xss_post($this->input->post('name'));
            $field_email      = $this->general->xss_post($this->input->post('email'));
            $field_username   = $this->general->xss_post($this->input->post('username'));
            $field_rfbid      = (int)$this->input->post('rfbid');
            $field_password   = $this->general->xss_post($this->input->post('password'));
            $field_repassword = $this->general->xss_post($this->input->post('repassword'));

            if(empty($field_name))
            {
                $class_name = ' error';
            }

            if(empty($field_email))
            {
                $class_email = ' error';
            }
                else if(!$this->general->validate_email($field_email))
            {
                $class_email = ' error';
            }

            if(empty($field_username))
            {
                $class_username = ' error';
            }

            if(empty($field_rfbid))
            {
                $class_rfbid = ' error';
            }

            if(empty($field_password))
            {
                $class_password = ' error';
            }

            if(empty($field_repassword))
            {
                $class_repassword = ' error';
            }

            if(empty($field_name) || empty($field_email) || empty($field_username) || empty($field_rfbid) || empty($field_password) || empty($field_repassword))
            {
                $error       = 1;
                $title_error = LNG_ALL_FIELDS_REQUIRED;
            }
                else if(!$this->general->validate_email($field_email))
            {
                $error       = 1;
                $class_email = ' error';
                $title_error = LNG_INVALID_EMAIL_ADDRESS;
            }
                else if($field_password != $field_repassword)
            {
                $error          = 1;
                $class_password = $class_repassword = ' error';
                $title_error    = LNG_PASSWORD_NOT_MATCH;
            }
                else
            {
                $qusers1 = $this->db->query("SELECT id FROM users WHERE username='".$field_username."' LIMIT 1");
                $qusers2 = $this->db->query("SELECT id FROM users WHERE email='".$field_email."' LIMIT 1");
                if($qusers1->num_rows() > 0)
                {
                    $error          = 1;
                    $class_error    = ' error';
                    $class_username = ' error';
                    $title_error    = LNG_USERNAME_IN_USE;
                }
                    else if($qusers2->num_rows() > 0)
                {
                    $error       = 1;
                    $class_error = ' error';
                    $class_email = ' error';
                    $title_error = LNG_EMAIL_IN_USE;
                }
            }

            if(empty($error))
            {
                $app_default = ($qsettings->num_rows() > 0)? $qsettings->row()->newusers_app:0;
                $status      = ($qsettings->num_rows() > 0 && $qsettings->row()->newusers_crt == 1)? 1:0;

                $this->db->query("INSERT INTO users(name, email, username, fb_id, password, access, timestamp, status) VALUES('".$field_name."', '".$field_email."', '".$field_username."', '".$field_rfbid."', '".$this->encrypt->sha1($field_password)."', '0', '".time()."', '".$status."')");
                $insert_id = $this->db->insert_id();
                $this->db->query("INSERT INTO settings(id_user, pages_limit, groups_limit, retry_limit, app_default) VALUES('".$insert_id."', '0', '0', '5', '".$app_default."')");
                if($status == 1)
                {
                    $this->session->set_userdata(array('username' => $this->encrypt->encode($insert_id), 'access' => 0, 'logged'  => TRUE));
                }
                    else
                {
                    $message = LNG_EMAIL_HI.' '.$field_name.','."\n"
                              .'<br/><br/>'.LNG_EMAIL_MESSAGE1."\n"
                              .'<br/><br/>'.LNG_EMAIL_THANKS."\n"
                              .'- '.LNG_EMAIL_THE_TEAM.'<br/><br/>'."\n";

                    @$this->email->send($field_email, LNG_EMAIL_SUBJECT_WELCOME_TO, $message);
                }

                redirect('index.php/dashboard');
            }
        }

        if($error == 0)
        {
            $data['field_name']       = "";
            $data['field_email']      = "";
            $data['field_username']   = "";
            $data['field_rfbid']      = "";
            $data['field_password']   = "";
            $data['field_repassword'] = "";
        }
            else
        {
            $data['field_name']       = ($field_name != "")?       $field_name:"";
            $data['field_email']      = ($field_email != "")?      $field_email:"";
            $data['field_username']   = ($field_username != "")?   $field_username:"";
            $data['field_rfbid']      = ($field_rfbid != "")?      $field_rfbid:"";
            $data['field_password']   = ($field_password != "")?   $field_password:"";
            $data['field_repassword'] = ($field_repassword != "")? $field_repassword:"";
        }

        $data['error'] = array(
            'class_name'       => $class_name,
            'class_email'      => $class_email,
            'class_username'   => $class_username,
            'class_rfbid'      => $class_rfbid,
            'class_password'   => $class_password,
            'class_repassword' => $class_repassword,
            'class_error'      => $class_error,
            'title_error'      => $title_error
        );

        return $data;
    }

    function recover()
    {
        $field_email = $class_error = $title_error = "";
        $error = 0;
        $current_time = time();

        if($this->input->post('auth') == "submit")
        {
            $field_email = $this->general->xss_post($this->input->post('email'));

            if(empty($field_email))
            {
                $error       = 1;
                $class_error = ' error';
                $title_error = LNG_FIELD_IS_EMPTY;
            }
                else
            {
                $qusers = $this->db->query("SELECT id, email FROM users WHERE email='".$field_email."' LIMIT 1");
                if($qusers->num_rows() == 0)
                {
                    $error       = 1;
                    $class_error = ' error';
                    $title_error = LNG_INVALID_EMAIL_ADDRESS;
                }
            }

            if(empty($error))
            {
                $code = random_string('alnum', 20);
                $this->db->query("INSERT INTO recover_password(id_user, code) VALUES('".$qusers->row()->id."', '".$code."')");
                $message = LNG_EMAIL_HI_THERE.','."\n"
                          .'<br/><br/>'.LNG_EMAIL_MESSAGE2."\n"
                          .'<br/><a href="'.site_url('index.php/login/response/'.$code).'">'.LNG_EMAIL_RESET_PASSWORD.'</a>'."\n"
                          .'<br/><br/>'.LNG_EMAIL_MESSAGE3."\n"
                          .LNG_EMAIL_MESSAGE4."\n"
                          .'<br/><br/>'.LNG_EMAIL_THANKS."\n"
                          .'- '.LNG_EMAIL_THE_TEAM.'<br/><br/>'."\n";

                $this->email->send($qusers->row()->email, LNG_EMAIL_SUBJECT_RESET_PASSWORD, $message);
                redirect('index.php/login/index/recoversent');
            }
        }

        if($error == 0)
        {
            $data['field_email'] = "";
        }
            else
        {
            $data['field_email'] = ($field_email != "")? $field_email:"";
        }

        $data['error'] = array(
            'class_error' => $class_error,
            'title_error' => $title_error
        );

        return $data;
    }

    function response($code = false)
    {
        $qrecover_password = $this->db->query("SELECT recover_password.id, recover_password.id_user, users.name, users.email FROM recover_password, users WHERE recover_password.id_user=users.id AND recover_password.code='".$this->general->xss_post($code)."' LIMIT 1");
        if($qrecover_password->num_rows() > 0)
        {
            $password = random_string('alnum', 8);
            $this->db->query("UPDATE users SET password='".$this->encrypt->sha1($password)."' WHERE id='".$qrecover_password->row()->id_user."'");
            $this->db->query("DELETE FROM recover_password WHERE id='".$qrecover_password->row()->id."'");

            $message = LNG_EMAIL_HI.' '.$qrecover_password->row()->name.','."\n"
                      .'<br/><br/>'.LNG_EMAIL_MESSAGE5.': '.$password."\n"
                      .'<br/><br/>'.LNG_EMAIL_THANKS."\n"
                      .'- '.LNG_EMAIL_THE_TEAM.'<br/><br/>'."\n";

            $this->email->send($qrecover_password->row()->email, LNG_EMAIL_SUBJECT_NEW_PASSWORD, $message);
            redirect('index.php/login/index/recoverok');
        }
            else
        {
            redirect('index.php/login/index/recovererror');
        }
    }

    function logout()
    {
        $this->load->model(array('faceboook'));
        $this->session->unset_userdata(array('username' => '', 'access' => '', 'logged' => ''));
        $this->session->sess_destroy();
        delete_cookie('login', $this->config->item('link_domain'), $this->config->item('link_basename'), '');
        $this->faceboook->logout();
        redirect('index.php/login');
    }

}

?>