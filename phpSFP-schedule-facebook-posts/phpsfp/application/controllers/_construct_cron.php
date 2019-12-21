<?php

    $this->load->helper(array('cookie', 'date', 'encryption_url'));
    $this->load->library(array('encrypt', 'pagination'));
    $this->load->model(array('core', 'faceboook', 'general', 'link', 'pages', 'profiles', 'schedules', 'settingss'));

?>