<?php

class Users extends CI_Controller {

    var $controller = 'users';

    function __construct()
    {
        parent::__construct();
        include('__construct.php');
        if(!$this->general->admin()) die(LNG_ACCESS_DENIED);
    }

    public function index($status = 'all', $page = 1)
    {
        if(is_numeric($status))
        {
            $page   = $status;
            $status = 'all';
        }

        $view['controller'] = $this->controller;
        $view['status']     = $status;
        $view['users']      = $this->profiles->listing($page, $status);
        $view['records']    = $this->profiles->pagination($status);
        $view['pagination'] = $this->pages->config('index.php/users/index'.(!empty($status)? '/'.$status:''), '', $page,  $view['records']);
        $data['data']       = $view;
        $data['content']    = "users";

        $this->load->view('template', $data);
    }

    function load_frame()
    {
        echo $this->profiles->load_frame();
    }

    function add_user()
    {
        echo $this->profiles->add_user();
    }

    function edit_user()
    {
        echo $this->profiles->edit_user();
    }

    function delete_user()
    {
        echo $this->profiles->delete_user();
    }

    function status_user()
    {
        echo $this->profiles->status_user();
    }

}

?>