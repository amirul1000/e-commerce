<?php

class Pages extends CI_Model {

    var $per_page = 12;

    function __construct()
    {
        parent::__construct();
    }

    function config($basepath_link, $filter, $page, $total_rows)
    {
        $config['total_rows']    = $total_rows;
        $config['per_page']      = $this->per_page;
        $config['num_links']     = 5;
        $config['page']          = $page;
        $config['basepath_link'] = $basepath_link;
        $config['filter']        = $filter;

        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    function set_limit($page)
    {
        return " LIMIT ".($page - 1) * $this->per_page.", ".$this->per_page;
    }

}

?>