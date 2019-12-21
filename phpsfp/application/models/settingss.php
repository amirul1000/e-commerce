<?php

class Settingss extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    /*
    |--------------------------------------------------------------------------
    | Facebook app verification
    |--------------------------------------------------------------------------
    |
    */

    function fapp_valid()
    {
        $qsettings = $this->db->query("SELECT app_valid, app_default FROM settings WHERE id_user='".$this->general->id_user()."' LIMIT 1");
        if($qsettings->num_rows() > 0 && $qsettings->row()->app_default == 1 && !$this->general->admin())
        {
            return $qsettings->row()->app_valid;
        }
            else
        {
            $qsettings_general = $this->db->query("SELECT app_valid FROM settings_general WHERE id='1' LIMIT 1");
            return ($qsettings_general->num_rows() > 0)? $qsettings_general->row()->app_valid:0;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Facebook app settings
    |--------------------------------------------------------------------------
    |
    */

    function facebook_app()
    {
        $field_purchase_code = $class_purchase_code = $title_purchase_code = "";
        $field_app_id = $class_app_id = $title_app_id = "";
        $field_app_secret = $class_app_secret = $title_app_secret = "";
        $field_app_version = $class_app_version = $title_app_version = "";
        $field_limit_pages = $class_limit_pages = $title_limit_pages = "";
        $field_limit_groups = $class_limit_groups = $title_limit_groups = "";
        $field_limit_retry = $class_limit_retry = $title_limit_retry = "";
        $field_track_clicks = $class_track_clicks = $title_track_clicks = "";
        $field_role_auto = $class_role_auto = $title_role_auto = "";
        $field_random_time = $class_random_time = $title_random_time = "";
        $field_ap_enabled = $class_ap_enabled = $title_ap_enabled = "";
        $field_ap_posts_limit = $class_ap_posts_limit = $title_ap_posts_limit = "";
        $field_ap_posts_time = $class_ap_posts_time = $title_ap_posts_time = "";
        $field_newusers_app = $class_newusers_app = $title_newusers_app = "";
        $field_newusers_crt = $class_newusers_crt = $title_newusers_crt = "";
        $field_language = $class_language = $title_language = "";
        $field_limit_upload = $class_limit_upload = $title_limit_upload = "";
        $field_send_interval = $class_send_interval = $title_send_interval = "";
        $app_valid = 1;
        $status = $status_error = "";
        $errors = array();
        $error = 0;
        $admin = $this->general->admin();

        if($this->input->post('facebook_app') == "submit")
        {
            $field_purchase_code  = $this->general->xss_post($this->input->post('field_purchase_code'));
            $field_app_id         = $this->general->xss_post($this->input->post('field_app_id'));
            $field_app_secret     = $this->general->xss_post($this->input->post('field_app_secret'));
            $field_app_version    = 'v2.5';//$this->general->xss_post($this->input->post('field_app_version'));
            $field_limit_pages    = (int)$this->input->post('field_limit_pages');
            $field_limit_groups   = (int)$this->input->post('field_limit_groups');
            $field_limit_retry    = (int)$this->input->post('field_limit_retry');
            $field_limit_retry    = empty($field_limit_retry)? 1:$field_limit_retry;
            $field_track_clicks   = (int)$this->input->post('field_track_clicks');
            $field_role_auto      = (int)$this->input->post('field_role_auto');
            $field_random_time    = (int)$this->input->post('field_random_time');
            $field_ap_enabled     = (int)$this->input->post('field_ap_enabled');
            $field_ap_posts_limit = (int)$this->input->post('field_ap_posts_limit');
            $field_ap_posts_time  = (int)$this->input->post('field_ap_posts_time');
            $field_newusers_app   = (int)$this->input->post('field_newusers_app');
            $field_newusers_crt   = (int)$this->input->post('field_newusers_crt');
            $field_language       = $this->general->xss_post($this->input->post('field_language'));
            $field_limit_upload   = (int)$this->input->post('field_limit_upload');
            $field_send_interval  = (int)$this->input->post('field_send_interval');
            $field_post_admin     = (int)$this->input->post('field_post_admin');
            $facebook_versions    = array('v1.0', 'v2.0', 'v2.1', 'v2.2', 'v2.3', 'v2.4', 'v2.5', 'v2.6', 'v2.7', 'v2.8');

            if($field_app_id == "")
            {
                $error        = 1;
                $class_app_id = ' error';
                $title_app_id = '-';
            }

            if($field_app_secret == "")
            {
                $error            = 1;
                $class_app_secret = ' error';
                $title_app_secret = '-';
            }

            if($field_app_version == "" || !in_array($field_app_version, $facebook_versions))
            {
                //$error             = 1;
                $class_app_version = ' error';
                $title_app_version = '-';
            }

            if(empty($field_app_id) || empty($field_app_secret) || empty($field_app_version))
            {
                $errors[] = LNG_ALL_FIELDS_REQUIRED;
                $error    = 1;
            }
                else if(!in_array($field_app_version, $facebook_versions))
            {
                $errors[] = LNG_INVALID_API_VERSION.': '.implode(', ', $facebook_versions);
                //$error    = 1;
            }

            if(!empty($field_app_id) && !empty($field_app_secret))
            {
                $fappverification = $this->general->custom_file_get_contents('https://graph.facebook.com/'.$field_app_id.'?fields=roles&access_token='.$field_app_id.'|'.$field_app_secret.'');
                $fappverification = @json_decode($fappverification);

                if(!isset($fappverification->roles) && isset($fappverification->error))
                {
                    $class_app_id = $class_app_secret = ' error';
                    $errors[] = LNG_APP_NOT_EXIST;
                    $error    = 1;
                }
            }

            if(empty($error))
            {
                if($admin)
                {
                    $this->db->query("UPDATE settings_general SET app_id='".$field_app_id."', app_secret='".$field_app_secret."', app_version='".$field_app_version."', app_valid='".$app_valid."', purchase_code='".$field_purchase_code."', pages_limit='".$field_limit_pages."', groups_limit='".$field_limit_groups."', retry_limit='".$field_limit_retry."', track_clicks='".$field_track_clicks."', post_admin='".$field_post_admin."', role_auto='".$field_role_auto."', random_time='".$field_random_time."', ap_enabled='".$field_ap_enabled."', ap_posts_limit='".$field_ap_posts_limit."', ap_posts_time='".$field_ap_posts_time."', newusers_app='".$field_newusers_app."', newusers_crt='".$field_newusers_crt."', language='".$field_language."', upload_limit='".$field_limit_upload."', send_interval='".$field_send_interval."' WHERE id='1'");
                }
                    else
                {
                    $qsettings = $this->db->query("SELECT app_id FROM settings WHERE id_user='".$this->general->id_user()."' LIMIT 1");
                    if($qsettings->num_rows() > 0)
                    {
                        $this->db->query("UPDATE settings SET app_id='".$field_app_id."', app_secret='".$field_app_secret."', app_version='".$field_app_version."', app_valid='".$app_valid."', ap_enabled='".$field_ap_enabled."', ap_posts_limit='".$field_ap_posts_limit."', ap_posts_time='".$field_ap_posts_time."' WHERE id_user='".$this->general->id_user()."'");
                    }
                        else
                    {
                        $this->db->query("INSERT INTO settings(id_user, app_id, app_secret, app_version, app_valid, ap_enabled, ap_posts_limit, ap_posts_time) VALUES('".$this->general->id_user()."', '".$field_app_id."', '".$field_app_secret."', '".$field_app_version."', '".$app_valid."', '".$field_ap_enabled."', '".$field_ap_posts_limit."', '".$field_ap_posts_time."')");
                    }
                }

                #reset
                $field_purchase_code = $class_purchase_code = $title_purchase_code = "";
                $field_app_id = $class_app_id = $title_app_id = "";
                $field_app_secret = $class_app_secret = $title_app_secret = "";
                $field_app_version = $class_app_version = $title_app_version = "";
                $status = $status_error = "";
                $errors = array();

                $error = 2;

                redirect('index.php/settings');
            }
        }

        $qsettings = $this->db->query("SELECT app_id, app_secret, app_version, app_default, ap_enabled, ap_posts_limit, ap_posts_time FROM settings WHERE id_user='".$this->general->id_user()."' LIMIT 1");
        $data['app_default'] = !empty($admin)? 1:(($qsettings->num_rows() > 0)? $qsettings->row()->app_default:1);

        # general facebook app
        $qsettings_general = $this->db->query("SELECT app_id, app_secret, app_version, app_token, purchase_code, purchase_code_rsp, pages_limit, groups_limit, retry_limit, track_clicks, post_admin, role_auto, random_time, ap_enabled, ap_posts_limit, ap_posts_time, newusers_app, newusers_crt, language, upload_limit, send_interval FROM settings_general WHERE id='1' LIMIT 1");

        if($qsettings_general->num_rows() > 0 && $admin)
        {
            $data['purchase_code_rsp'] = $qsettings_general->row()->purchase_code_rsp;

            if(!empty($qsettings_general->row()->app_id) && !empty($qsettings_general->row()->app_secret))
            {
                $this->config->set_item('facebook_app_id', $qsettings_general->row()->app_id);
                $this->config->set_item('facebook_app_secret', $qsettings_general->row()->app_secret);
                $this->config->set_item('facebook_app_version', $qsettings_general->row()->app_version);
                $this->config->set_item('facebook_redirect_url', site_url('index.php/dashboard'));
                $this->load->library('facebook');

                if(!empty($qsettings_general->row()->app_token))
                {
                    $checkAccessToken = $this->facebook->checkAccessToken($qsettings_general->row()->app_token);
                    if($checkAccessToken == '1')
                    {
                        $valid = true;
                    }
                }

                $data['token']['exists'] = !empty($qsettings_general->row()->app_token)? true:false;
                $data['token']['valid']  = isset($valid)? true:false;
            }
        }

        if($error == 0 || $error == 2)
        {
            if($qsettings_general->num_rows() > 0)
            {
                $data['field_purchase_code']  = $qsettings_general->row()->purchase_code;
                $data['field_app_id']         = $qsettings_general->row()->app_id;
                $data['field_app_secret']     = $qsettings_general->row()->app_secret;
                $data['field_app_version']    = $qsettings_general->row()->app_version;
                $data['field_limit_pages']    = $qsettings_general->row()->pages_limit;
                $data['field_limit_groups']   = $qsettings_general->row()->groups_limit;
                $data['field_limit_retry']    = $qsettings_general->row()->retry_limit;
                $data['field_track_clicks']   = $qsettings_general->row()->track_clicks;
                $data['field_role_auto']      = $qsettings_general->row()->role_auto;
                $data['field_random_time']    = $qsettings_general->row()->random_time;
                $data['field_ap_enabled']     = $qsettings_general->row()->ap_enabled;
                $data['field_ap_posts_limit'] = $qsettings_general->row()->ap_posts_limit;
                $data['field_ap_posts_time']  = $qsettings_general->row()->ap_posts_time;
                $data['field_newusers_app']   = $qsettings_general->row()->newusers_app;
                $data['field_newusers_crt']   = $qsettings_general->row()->newusers_crt;
                $data['field_language']       = $qsettings_general->row()->language;
                $data['field_limit_upload']   = $qsettings_general->row()->upload_limit;
                $data['field_send_interval']  = $qsettings_general->row()->send_interval;
                $data['field_post_admin']     = $qsettings_general->row()->post_admin;
                $data['errors']               = array();
            }
                else
            {
                $data['field_purchase_code']  = '';
                $data['field_app_id']         = '';
                $data['field_app_secret']     = '';
                $data['field_app_version']    = 'v2.5';
                $data['field_limit_pages']    = 5000;
                $data['field_limit_groups']   = 5000;
                $data['field_limit_retry']    = 5;
                $data['field_track_clicks']   = 0;
                $data['field_role_auto']      = 1;
                $data['field_random_time']    = 1;
                $data['field_ap_enabled']     = 0;
                $data['field_ap_posts_limit'] = 0;
                $data['field_ap_posts_time']  = 0;
                $data['field_newusers_app']   = 1;
                $data['field_newusers_crt']   = 1;
                $data['field_language']       = 'en';
                $data['field_limit_upload']   = 4;
                $data['field_send_interval']  = 60;
                $data['field_post_admin']     = 1;
                $data['errors']               = array();
            }

            if($qsettings->num_rows() > 0 && empty($admin))
            {
                $data['field_app_id']         = $qsettings->row()->app_id;
                $data['field_app_secret']     = $qsettings->row()->app_secret;
                $data['field_app_version']    = $qsettings->row()->app_version;
                $data['field_ap_enabled']     = $qsettings->row()->ap_enabled;
                $data['field_ap_posts_limit'] = $qsettings->row()->ap_posts_limit;
                $data['field_ap_posts_time']  = $qsettings->row()->ap_posts_time;
            }
        }
            else
        {
            $data['field_purchase_code']  = ($field_purchase_code != "")?  $field_purchase_code:"";
            $data['field_app_id']         = ($field_app_id != "")?         $field_app_id:"";
            $data['field_app_secret']     = ($field_app_secret != "")?     $field_app_secret:"";
            $data['field_app_version']    = ($field_app_version != "")?    $field_app_version:"";
            $data['field_limit_pages']    = ($field_limit_pages != "")?    $field_limit_pages:"";
            $data['field_limit_groups']   = ($field_limit_groups != "")?   $field_limit_groups:"";
            $data['field_limit_retry']    = ($field_limit_retry != "")?    $field_limit_retry:"";
            $data['field_track_clicks']   = ($field_track_clicks != "")?   $field_track_clicks:"";
            $data['field_role_auto']      = ($field_role_auto != "")?      $field_role_auto:"";
            $data['field_random_time']    = ($field_random_time != "")?    $field_random_time:"";
            $data['field_ap_enabled']     = ($field_ap_enabled != "")?     $field_ap_enabled:"";
            $data['field_ap_posts_limit'] = ($field_ap_posts_limit != "")? $field_ap_posts_limit:"";
            $data['field_ap_posts_time']  = ($field_ap_posts_time != "")?  $field_ap_posts_time:"";
            $data['field_newusers_app']   = ($field_newusers_app != "")?   $field_newusers_app:"";
            $data['field_newusers_crt']   = ($field_newusers_crt != "")?   $field_newusers_crt:"";
            $data['field_language']       = ($field_language != "")?       $field_language:"";
            $data['field_limit_upload']   = ($field_limit_upload != "")?   $field_limit_upload:"";
            $data['field_send_interval']  = ($field_send_interval != "")?  $field_send_interval:"";
            $data['field_post_admin']     = ($field_post_admin != "")?     $field_post_admin:"";
            $data['errors']               = $errors;
        }

        $data['error'] = array(
            'class_app_id'      => $class_app_id,
            'title_app_id'      => $title_app_id,
            'class_app_secret'  => $class_app_secret,
            'title_app_secret'  => $title_app_secret,
            'class_app_version' => $class_app_version,
            'title_app_version' => $title_app_version,
            'error'             => $error
        );

        return $data;
    }

    /*
    |--------------------------------------------------------------------------
    | Account settings
    |--------------------------------------------------------------------------
    |
    */

    function account()
    {
        $field_name = $class_name = $title_name = "";
        $field_email = $class_email = $title_email = "";
        $field_timezone = $class_timezone = $title_timezone = "";
        $field_timezone_display = $class_timezone_display = $title_timezone_display = "";
        $field_cpassword = $class_cpassword = $title_cpassword = "";
        $field_password = $class_password = $title_password = "";
        $field_repassword = $class_repassword = $title_repassword = "";
        $status = $status_error = "";
        $errors = array();
        $error = 0;

        if($this->input->post('account_settings') == "submit")
        {
            $field_name       = $this->general->xss_post($this->input->post('field_name'));
            $field_email      = $this->general->xss_post($this->input->post('field_email'));
            $field_timezone   = $this->input->post('field_timezone');
            $field_timezone_d = $this->input->post('field_timezone_display');
            $field_cpassword  = $this->general->xss_post($this->input->post('field_cpassword'));
            $field_password   = $this->general->xss_post($this->input->post('field_password'));
            $field_repassword = $this->general->xss_post($this->input->post('field_repassword'));

            if($field_name == "")
            {
                $error      = 1;
                $class_name = ' error';
                $title_name = '-';
            }

            if($field_email == "")
            {
                $error       = 1;
                $class_email = ' error';
                $title_email = '-';
            }

            if($field_timezone == "")
            {
                $error          = 1;
                $class_timezone = ' error';
                $title_timezone = '-';
            }

            if(empty($field_name) || empty($field_email) || empty($field_timezone))
            {
                $errors[] = LNG_ALL_FIELDS_REQUIRED;
                $error    = 1;
            }

            if((!empty($field_cpassword) && !empty($field_password) && !empty($field_repassword)) && $field_password != $field_repassword )
            {
                $qusers = $this->db->query("SELECT password FROM users WHERE id='".$this->general->id_user()."'");
                if($qusers->row()->password != $this->encrypt->sha1($field_cpassword))
                {
                    $class_cpassword = $class_repassword = ' error';
                    $errors[] = LNG_CURRENT_PASSWORD_INVALID;
                    $error    = 1;
                }

                $class_password = $class_repassword = ' error';
                $errors[] = LNG_PASSWORD_CONFIRM_NOT_CORRECT;
                $error    = 1;
            }

            if(empty($error))
            {
                $this->db->query("UPDATE users SET name='".$field_name."', email='".$field_email."', gmt='0', gmt_zone='".$field_timezone."' ".( ((!empty($field_cpassword) && !empty($field_password) && !empty($field_repassword)) && $field_password == $field_repassword )? ", password='".$this->encrypt->sha1($field_password)."'":'' )." WHERE id='".$this->general->id_user()."'");

                #reset
                $field_name = $class_name = $title_name = "";
                $field_email = $class_email = $title_email = "";
                $field_timezone = $class_timezone = $title_timezone = "";
                $field_timezone_display = $class_timezone_display = $title_timezone_display = "";
                $field_password = $class_password = $title_password = "";
                $field_repassword = $class_repassword = $title_repassword = "";
                $status = $status_error = "";
                $errors = array();

                $error = 2;
            }
        }

        if($error == 0 || $error == 2)
        {
            $id_user = $this->general->id_user();
            $qusers = $this->db->query("SELECT name, email, gmt, gmt_zone FROM users WHERE id='".$id_user."' LIMIT 1");

            $data['field_name']       = $qusers->row()->name;
            $data['field_email']      = $qusers->row()->email;
            $data['field_timezone']   = $qusers->row()->gmt_zone;
            $data['field_timezone_d'] = mdate("%h:%i %a", $this->core->timestamp($qusers->row()->gmt_zone)).' '.( !isset($this->core->timezones[$qusers->row()->gmt_zone])? $qusers->row()->gmt_zone:$this->core->timezones[$qusers->row()->gmt_zone]);
            $data['field_cpassword']  = '';
            $data['field_password']   = '';
            $data['field_repassword'] = '';
            $data['errors']           = array();
        }
            else
        {
            $data['field_name']       = ($field_name != "")?       $field_name:"";
            $data['field_email']      = ($field_email != "")?      $field_email:"";
            $data['field_timezone']   = ($field_timezone != "")?   $field_timezone:"";
            $data['field_timezone_d'] = ($field_timezone_d != "")? $field_timezone_d:"";
            $data['field_cpassword']  = ($field_cpassword != "")?  $field_cpassword:"";
            $data['field_password']   = ($field_password != "")?   $field_password:"";
            $data['field_repassword'] = ($field_repassword != "")? $field_repassword:"";
            $data['errors']           = $errors;
        }

        $data['error'] = array(
            'class_name'       => $class_name,
            'title_name'       => $title_name,
            'class_email'      => $class_email,
            'title_email'      => $title_email,
            'class_cpassword'  => $class_cpassword,
            'title_cpassword'  => $title_cpassword,
            'class_password'   => $class_password,
            'title_password'   => $title_password,
            'class_repassword' => $class_repassword,
            'title_repassword' => $title_repassword,
            'error'            => $error
        );

        return $data;
    }

    /*
    |--------------------------------------------------------------------------
    | Mail settings
    |--------------------------------------------------------------------------
    |
    */

    function mail()
    {
        $field_name = $class_name = $title_name = "";
        $field_email = $class_email = $title_email = "";
        $field_protocol = $class_protocol = $title_protocol = "";
        $field_host = $class_host = $title_host = "";
        $field_username = $class_username = $title_username = "";
        $field_password = $class_password = $title_password = "";
        $field_port = $class_port = $title_port = "";
        $status = $status_error = "";
        $errors = array();
        $error = 0;

        if($this->input->post('mail_settings') == "submit")
        {
            $field_name     = $this->general->xss_post($this->input->post('field_name'));
            $field_email    = $this->general->xss_post($this->input->post('field_email'));
            $field_protocol = (int)$this->input->post('field_protocol');
            $field_host     = $this->general->xss_post($this->input->post('field_host'));
            $field_username = $this->general->xss_post($this->input->post('field_username'));
            $field_password = $this->general->xss_post($this->input->post('field_password'));
            $field_port     = $this->general->xss_post($this->input->post('field_port'));

            if($field_name == "")
            {
                $error      = 1;
                $class_name = ' error';
                $title_name = '-';
            }

            if($field_email == "")
            {
                $error       = 1;
                $class_email = ' error';
                $title_email = '-';
            }

            if($field_protocol == 3)
            {
                if($field_host == "")
                {
                    $error      = 1;
                    $class_host = ' error';
                    $title_host = '-';
                }

                if($field_username == "")
                {
                    $error          = 1;
                    $class_username = ' error';
                    $title_username = '-';
                }

                if($field_password == "")
                {
                    $error          = 1;
                    $class_password = ' error';
                    $title_password = '-';
                }

                if($field_port == "")
                {
                    $error      = 1;
                    $class_port = ' error';
                    $title_port = '-';
                }
            }

            if(empty($error))
            {
                $this->db->query("UPDATE email SET from_name='".$field_name."', from_email='".$field_email."', protocol='".$field_protocol."', smtp_host='".$field_host."', smtp_user='".$field_username."', smtp_pass='".$field_password."', smtp_port='".$field_port."' WHERE id='1'");

                #reset
                $field_name = $class_name = $title_name = "";
                $field_email = $class_email = $title_email = "";
                $field_protocol = $class_protocol = $title_protocol = "";
                $field_host = $class_host = $title_host = "";
                $field_username = $class_username = $title_username = "";
                $field_password = $class_password = $title_password = "";
                $field_port = $class_port = $title_port = "";
                $status = $status_error = "";
                $errors = array();
                $error = 2;
            }
        }

        if($error == 0 || $error == 2)
        {
            $query = $this->db->query("SELECT protocol, smtp_host, smtp_user, smtp_pass, smtp_port, from_name, from_email FROM email WHERE id='1' LIMIT 1");

            $data['field_name']     = $query->row()->from_name;
            $data['field_email']    = $query->row()->from_email;
            $data['field_protocol'] = $query->row()->protocol;
            $data['field_host']     = $query->row()->smtp_host;
            $data['field_username'] = $query->row()->smtp_user;
            $data['field_password'] = $query->row()->smtp_pass;
            $data['field_port']     = $query->row()->smtp_port;
            $data['errors']         = array();
        }
            else
        {
            $data['field_name']     = ($field_name != "")?     $field_name:"";
            $data['field_email']    = ($field_email != "")?    $field_email:"";
            $data['field_protocol'] = ($field_protocol != "")? $field_protocol:"";
            $data['field_host']     = ($field_host != "")?     $field_host:"";
            $data['field_username'] = ($field_username != "")? $field_username:"";
            $data['field_password'] = ($field_password != "")? $field_password:"";
            $data['field_port']     = ($field_port != "")?     $field_port:"";
            $data['errors']         = $errors;
        }

        $data['error'] = array(
            'class_name'     => $class_name,
            'title_name'     => $title_name,
            'class_email'    => $class_email,
            'title_email'    => $title_email,
            'class_host'     => $class_host,
            'title_host'     => $title_host,
            'class_username' => $class_username,
            'title_username' => $title_username,
            'class_password' => $class_password,
            'title_password' => $title_password,
            'class_port'     => $class_port,
            'title_port'     => $title_port,
            'error'          => $error
        );

        return $data;
    }

}

?>