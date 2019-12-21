<?php

class Dashboard extends CI_Controller {

    var $controller = 'dashboard';

    function __construct()
    {
        parent::__construct();
        include('__construct.php');
    }

    public function index($response = false)
    {
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
        {
            echo $this->schedules->upload();
        }
            else
        {
            $view['controller']    = $this->controller;
            $view['schedule_post'] = $this->schedules->add();
            $view['response']      = $response;
            $data['data']          = $view;
            $data['content']       = "dashboard";

            $this->load->view('template', $data);
        }
    }

    public function load_frame_login_via_at()
    {
        echo $this->faceboook->load_frame_login_via_at();
    }

    public function login_via_at()
    {
        echo $this->faceboook->login_via_at();
    }

    public function load_frame_invite()
    {
        echo $this->faceboook->load_frame_invite();
    }

    public function send_invite()
    {
        echo $this->faceboook->send_invite();
    }

    public function load_frame_import_groups()
    {
        echo $this->faceboook->load_frame_import_groups();
    }

    public function import_groups()
    {
        echo $this->faceboook->import_groups();
    }

    public function renew_token()
    {
        echo $this->faceboook->renew_tokens();
    }

    public function check_token_permissions()
    {
        echo $this->faceboook->check_token_permissions();
    }

    public function fblogout()
    {
        $this->faceboook->logout();
    }

}

?>