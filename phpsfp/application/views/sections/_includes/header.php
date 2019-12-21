<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?=$this->config->item('platform');?></title>
<meta name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=1,width=device-width"/>
<link rel="shortcut icon" type="image/x-icon" href="<?=$this->link->template_url('img/favicon.ico');?>">
<link rel="stylesheet" type="text/css" media="screen" href="<?=$this->link->template_url('css/main.css');?>?v=10" />
<link rel="stylesheet" type="text/css" media="screen" href="<?=$this->link->template_url('css/flick/jquery-ui-1.10.4.custom.min.css');?>" />
<link rel="stylesheet" type="text/css" media="screen" href="<?=$this->link->template_url('css/jquery-ui-timepicker-addon.css');?>" />
<link rel="stylesheet" type="text/css" media="screen" href="<?=$this->link->template_url('css/loadie.css');?>" />
<script type="text/javascript" src="<?=$this->link->template_url('js/jquery.js');?>"></script>
<script type="text/javascript" src="<?=$this->link->template_url('js/jquery.ui.js');?>"></script>
<script type="text/javascript" src="<?=$this->link->template_url('js/jquery-ui-timepicker-addon.js');?>"></script>
<script type="text/javascript" src="<?=$this->link->template_url('js/jquery.form.min.js');?>"></script>
<script type="text/javascript" src="<?=$this->link->template_url('js/jquery.loadie.min.js');?>"></script>
<script type="text/javascript" src="<?=$this->link->template_url('js/main.js');?>?v=10"></script>
<script type="text/javascript" src="<?=$this->link->template_url('js/jquery.functions.js');?>?v=10"></script>
<script type="text/javascript">
    var site_url = '<?=site_url();?>';
    var LNG_DTP_currentText = '<?=LNG_DTP_currentText;?>';
    var LNG_DTP_closeText = '<?=LNG_DTP_closeText;?>';
    var LNG_DTP_timeOnlyTitle = '<?=LNG_DTP_timeOnlyTitle;?>';
    var LNG_DTP_timeText = '<?=LNG_DTP_timeText;?>';
    var LNG_DTP_hourText = '<?=LNG_DTP_hourText;?>';
    var LNG_DTP_minuteText = '<?=LNG_DTP_minuteText;?>';
    var LNG_DTP_secondText = '<?=LNG_DTP_secondText;?>';
    var LNG_DTP_millisecText = '<?=LNG_DTP_millisecText;?>';
    var LNG_DTP_microsecText = '<?=LNG_DTP_microsecText;?>';
    var LNG_DTP_timezoneText = '<?=LNG_DTP_timezoneText;?>';
</script>
</head>
<body>

<div id="main">

    <div id="header">
        <div class="inner">
            <a href="<?=site_url();?>" title="" id="logo"></a>
            <ul id="menu">
<?php
    if($fbaccess['user'] && isset($fbaccess['batch_response']['user_info']['id']))
    {
?>
                <li class="user">
                    <span class="img"><img src="https://graph.facebook.com/<?=$fbaccess['batch_response']['user_info']['id'];?>/picture" width="23" height="23" alt=""></span>
                    <span class="name"><a href="https://facebook.com/<?=$fbaccess['batch_response']['user_info']['id'];?>" target="_blank" style="color:#FFFFFF;" title=""><?=$fbaccess['batch_response']['user_info']['name'];?></a></span>
                    <div class="dropdown">
                        <ul class="links">
                            <li><a class="modal" href="#add-user" onclick="check_token_permissions();" title=""><?=LNG_SETTINGS;?></a></li>
                            <li><a id="jsrnt" href="javascript:void(0);" onclick="renew_token('jsrnt');" title=""><?=LNG_RENEW_ACCESS_TOKEN;?></a></li>
                            <li><a href="<?=site_url('index.php/dashboard/fblogout');?>" title=""><?=LNG_LOGOUT_FROM_FACEBOOK;?></a></li>
                        </ul>
                    </div>
                </li>
<?php
    }
        else
    {
?>
                <li><a href="#add-user" onclick="load_frame_login_via_at();" title="" class="link modal"><?=LNG_LOGIN_VIA_AT;?></a></li>
<?php
    }
?>
                <li><a href="<?=site_url('index.php/login/logout');?>" title="" class="link"><?=LNG_LOGOUT;?></a></li>
            </ul>
        </div>
    </div>
