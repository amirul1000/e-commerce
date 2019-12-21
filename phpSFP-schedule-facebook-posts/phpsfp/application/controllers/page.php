<?php

class Page extends CI_Controller {

    var $controller = 'page';

    function __construct()
    {
        parent::__construct();
        include('__construct.php');
    }

    public function index($page)
    {
        $lang = $this->session->userdata('lang');
        $lang = !empty($lang)? '-'.$lang:'';
        $page = is_file(dirname(dirname(__FILE__)).'/views/sections/pages/'.$page.$lang.'.php')? $page.$lang:$page;

        if(is_file(dirname(dirname(__FILE__)).'/views/sections/pages/'.$page.'.php'))
        {
            $data['data']    = '';
            $data['content'] = 'pages/'.$page;

            $this->load->view('template', $data);
        }
            else
        {
            redirect();
        }
    }

}

?>