<?php

$template = $this->general->access();
$template['data'] = $data;

$this->load->view($this->config->item('view_page_source').'_includes/header', $template);
$this->load->view($this->config->item('view_page_source').$content, $data);
$this->load->view($this->config->item('view_page_source').'_includes/footer', $template);

?>