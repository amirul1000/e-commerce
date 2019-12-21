<?php

class Language extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function set()
    {
        $lang = $this->session->userdata('lang');

        if(isset($_GET['lang']))
        {
            $lang = strtolower($_GET['lang']);

            if(is_file('language/'.$lang.'.php'))
            {
                $this->session->set_userdata('lang', $lang);
            }
                else
            {
                $lang = $this->general->settings('language');
            }
        }
            else if(!empty($lang) && is_file('language/'.$lang.'.php'))
        {
            $lang = $lang;
        }
            else
        {
            $lang = $this->general->settings('language');
        }

        include_once 'language/'.$lang.'.php';
    }

    function get()
    {
        $array = array();
        $lang  = $this->session->userdata('lang');
        $lang  = !empty($lang)? $lang:$this->general->settings('language');
        if($handle = opendir('language'))
        {
            $i = 0;
            while(false !== ($entry = readdir($handle)))
            {
                if(!in_array($entry, array('.', '..')))
                {
                    $array[$i]['id']       = str_replace('.php', '', $entry);
                    $array[$i]['selected'] = ($lang == $array[$i]['id'])? 1:0;

                    $i++;
                }
            }
            closedir($handle);
        }

        return (count($array) > 1)? $array:array();
    }

}

?>