<?php

class Link extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function template_url($url)
    {
        return site_url('application/views/'.$url);
    }

}

?>