<?php

class Login extends CI_Controller {

    var $controller = 'login';

    function __construct()
    {
        parent::__construct();

        $this->load->library(array('encrypt'));
        $this->load->helper(array('cookie', 'string'));
        $this->load->model(array('link', 'general', 'language', 'auth', 'email'));
        $this->general->update();
    }

    public function index($message = false)
    {
        $this->language->set();
        $this->auth->cookie();

        $view['controller'] = $this->controller;
        $view['login']      = $this->auth->auth();
        $view['message']    = $message;
        $data['data']       = $view;
        $data['content']    = "login";

        $this->load->view($this->config->item('view_page_source').'login', $data);
    }

    public function create()
    {
        $this->language->set();
        $this->auth->cookie();

        $view['controller'] = $this->controller;
        $view['create']     = $this->auth->create();
        $data['data']       = $view;
        $data['content']    = "create";

        $this->load->view($this->config->item('view_page_source').'login', $data);
    }

    public function recover()
    {
        $this->language->set();
        $this->auth->cookie();

        $view['controller'] = $this->controller;
        $view['recover']    = $this->auth->recover();
        $data['data']       = $view;
        $data['content']    = "recover";

        $this->load->view($this->config->item('view_page_source').'login', $data);
    }

    public function response($code = false)
    {
        $this->language->set();
        $this->auth->response($code);
    }

    function logout()
    {
        $this->language->set();
        $this->auth->logout();
    }

}

?>