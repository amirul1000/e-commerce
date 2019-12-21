<?php

class Schedule extends CI_Controller {

    var $controller = 'schedule';

    function __construct()
    {
        parent::__construct();
        include('__construct.php');
    }

    public function index($filter_date = false, $page = 1)
    {
        if(is_numeric($filter_date))
        {
            $page = $filter_date;
            $filter_date = false;
        }

        $id_user = isset($_GET['user'])? (int)$_GET['user']:0;

        $view['controller']  = $this->controller;
        $view['filter']      = !empty($id_user)? '?user='.$id_user:'';
        $view['by_user']     = $this->general->info_user('name', $id_user);
        $view['filter_date'] = $filter_date;
        $view['schedules']   = $this->schedules->listing($id_post = false, $page, $filter_date);
        $view['records']     = $this->schedules->pagination($filter_date);
        $view['pagination']  = $this->pages->config('index.php/schedule/index'.(!empty($filter_date)? '/'.$filter_date:''), $view['filter'], $page,  $view['records']);
        $data['data']        = $view;
        $data['content']     = "schedule";

        $this->load->view('template', $data);
    }

    function preview()
    {
        echo $this->schedules->preview();
    }

    function ajax()
    {
        echo $this->schedules->ajax();
    }

    function token_etime()
    {
        echo $this->schedules->token_etime();
    }

    function cron_errorlog()
    {
        echo $this->schedules->cron_errorlog();
    }

    function load_frame_schedule()
    {
        echo $this->schedules->load_frame_schedule();
    }

    function edit_post()
    {
        echo $this->schedules->edit_post();
    }

    function load_frame_repeatpost()
    {
        echo $this->schedules->load_frame_repeatpost();
    }

    function repeat_post()
    {
        echo $this->schedules->repeat_post();
    }

    function pause_post()
    {
        echo $this->schedules->pause_post();
    }

}

?>