<?php

class Groups extends CI_Controller {

    var $controller = 'groups';

    function __construct()
    {
        parent::__construct();
        include('__construct.php');
    }

    public function index($page = 1)
    {
        $view['controller'] = $this->controller;
        $view['groups']     = $this->groupsm->listing($page);
        $view['pagination'] = $this->pages->config('index.php/groups/index', '', $page,  $this->groupsm->pagination());
        $data['data']       = $view;
        $data['content']    = "groups";

        $this->load->view('template', $data);
    }

    function load_frame()
    {
        echo $this->groupsm->load_frame();
    }

    function add_group()
    {
        echo $this->groupsm->add_group();
    }

    function edit_group()
    {
        echo $this->groupsm->edit_group();
    }

    function delete_group()
    {
        echo $this->groupsm->delete_group();
    }
}

?>