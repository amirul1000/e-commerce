<?php

class Settings extends CI_Controller {

    var $controller = 'settings';

    function __construct()
    {
        parent::__construct();
        include('__construct.php');
    }

    public function index()
    {
        $view['controller']   = $this->controller;
        $view['timezones']    = $this->core->timezones();
        $view['facebook_app'] = $this->settingss->facebook_app();
        $view['account']      = $this->settingss->account();
        $view['mail']         = $this->settingss->mail();
        $data['data']         = $view;
        $data['content']      = "settings";

        $this->load->view('template', $data);
    }

}

?>