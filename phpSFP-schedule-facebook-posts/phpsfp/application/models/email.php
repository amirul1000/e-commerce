<?php

class Email extends CI_Model {

    var $protocol = array(1 => 'mail', 2 => 'sendmail', 3 => 'smtp');

    function __construct()
    {
        parent::__construct();
    }

    private function config($settings)
    {
        $config['protocol'] = $this->protocol[$settings['protocol']];
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset']  = 'utf-8';
        $config['mailtype'] = 'html';
        $config['wordwrap'] = FALSE;

        if($settings['protocol'] == 3)
        {
            $config['smtp_host'] = $settings['smtp_host'];
            $config['smtp_user'] = $settings['smtp_user'];
            $config['smtp_pass'] = $settings['smtp_pass'];
            $config['smtp_port'] = $settings['smtp_port'];
        }

        return $config;
    }

    private function settings()
    {
        $return = array();
        $qemail = $this->db->query("SELECT protocol, smtp_host, smtp_user, smtp_pass, smtp_port, from_name, from_email FROM email WHERE id='1'");

        $return['protocol']   = $qemail->row()->protocol;
        $return['smtp_host']  = $qemail->row()->smtp_host;
        $return['smtp_user']  = $qemail->row()->smtp_user;
        $return['smtp_pass']  = $qemail->row()->smtp_pass;
        $return['smtp_port']  = $qemail->row()->smtp_port;
        $return['from_name']  = $qemail->row()->from_name;
        $return['from_email'] = $qemail->row()->from_email;

        return $return;
    }

    private function fn_send($to_email, $subject, $message)
    {
        $settings = $this->settings();
        $this->load->library('email', NULL, 'ci_email');

        $this->ci_email->initialize($this->config($settings));
        $this->ci_email->from($settings['from_email'], $settings['from_name']);
        $this->ci_email->to($to_email);
        $this->ci_email->subject($subject);
        $this->ci_email->message($message);
        $this->ci_email->send();
    }

    public function send($to_email, $subject, $message)
    {
        $this->fn_send($to_email, $subject, $this->template($message));
    }

    private function template($message)
    {
        return "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n"
                ."<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\">\n"
                ."<head>\n"
                ."<title></title>\n"
                ."<style type=\"text/css\">\n"
                ."<!--\n"
                ."#template { width: 618px; padding: 10px 15px; border: 1px solid #CCC; background: #FFF; font-family: Tahoma; font-size: 11px; color: #2B3539; line-height: 20px; }\n"
                ."#template a:link { color: #3B5998; text-decoration: none; }\n"
                ."#template a:visited { color: #3B5998; text-decoration: none; }\n"
                ."#template a:hover { color: #73B35F; text-decoration: none; }\n"
                ."#template a:active { color: #73B35F; text-decoration: none; }\n"
                ."#template p { margin: 0; padding: 5px 0 5px 0; }\n"
                .".titlu  { font-size: 14px; font-family: Arial; padding: 5px 0; font-weight: bold; color: #283135; }\n"
                ."-->\n"
                ."</style>\n"
                ."</head>\n"
                ."<body>\n"
                ."<div id=\"template\">\n"
                .$message
                ."<div id=\"footerNewsletter\">".LNG_COPYRIGHT." &copy; ".date("Y", time())." ".$this->config->item('platform').". ".LNG_ALL_RIGHTS_RESERVED."</div>\n"
                ."</div>\n"
                ."</body>\n"
                ."</html>\n";
    }
}

?>