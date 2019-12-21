<?php

    $this->load->helper(array('cookie', 'date', 'encryption_url'));
    $this->load->library(array('encrypt', 'pagination'));
    $this->load->model(array('core', 'faceboook', 'general', 'groupsm', 'language', 'link', 'pages', 'profiles', 'schedules', 'settingss', 'upload'));
    $this->general->check_user();
    $this->general->update();
    $this->language->set();

?>