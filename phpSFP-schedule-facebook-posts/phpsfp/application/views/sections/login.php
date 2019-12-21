<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?=$this->config->item('platform');?></title>
<meta name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=1,width=device-width"/>
<link rel="shortcut icon" type="image/x-icon" href="<?=$this->link->template_url('img/favicon.ico');?>">
<link rel="stylesheet" type="text/css" media="screen" href="<?=$this->link->template_url('css/main.css');?>?v=9" />
<link rel="stylesheet" type="text/css" media="screen" href="<?=$this->link->template_url('css/jquery.ui.css');?>" />
<script type="text/javascript" src="<?=$this->link->template_url('js/jquery.js');?>"></script>
<script type="text/javascript" src="<?=$this->link->template_url('js/jquery.ui.js');?>"></script>
</head>
<body>
<div id="main">
<?php
    if($content == 'login')
    {
?>
    <div id="login" class="cf">
        <h2><?=LNG_LOGIN;?></h2>
        <form id="login_form" name="login" action="<?=site_url('index.php/login');?>" method="post" autocomplete="off">
            <input type="hidden" name="auth" value="submit" />
            <label class="lbl-1"><?=LNG_FIELD_USERNAME;?></label>
            <div class="input-1<?=$data['login']['error']['class_error'];?>">
                <input type="text" name="username" value="<?=$data['login']['field_username'];?>" />
            </div>
            <label class="lbl-1"><?=LNG_FIELD_PASSWORD;?></label>
            <div class="input-1<?=$data['login']['error']['class_error'];?>">
                <input type="password" name="password" value="<?=$data['login']['field_password'];?>" />
            </div>
<?php
        if($data['message'] == 'recoversent')
        {
?>
            <p class="msg ok"><?=LNG_RECOVER_EMAIL_SENT;?></p>
<?php
        }
            else if($data['message'] == 'recoverok')
        {
?>
            <p class="msg ok"><?=LNG_RECOVER_EMAIL_NEW_PASSWORD;?></p>
<?php
        }
            else if($data['message'] == 'recovererror')
        {
?>
            <p class="msg error"><?=LNG_RECOVER_EMAIL_CODE_INVALID;?></p>
<?php
        }
?>
            <p class="msg error"><?=$data['login']['error']['title_error'];?></p>
            <div class="options cf">
                <ul class="lt">
                    <li><label class="lbl-2"><input type="checkbox" value="1" name="remember"<?=($data['login']['field_remember'])? ' checked="checked"':'';?> /> <?=LNG_KEEP_ME_LOGGED_IN;?></label></li>
                </ul>
                <a href="javascript:document.login.submit();" title="" class="btn rt"><?=LNG_LOGIN;?></a>
            </div>
            <div class="clear"></div>
            <div class="options cf">
                <p class="msg" style="text-align:center;">
<?php
        if(isset($data['login']['newusers_crt']) && $data['login']['newusers_crt'] > 0)
        {
?>
                    <a class="link" href="<?=site_url('index.php/login/create');?>"><?=LNG_CREATE_ACCOUNT;?></a>
                    or
<?php
        }
?>
                    <a class="link" href="<?=site_url('index.php/login/recover');?>"><?=LNG_RECOVER_PASSWORD;?></a>
                </p>
            </div>
            <script type="text/javascript">
                $("#login_form").keydown(function(event)
                {
                    if(event.keyCode == 13) document.login.submit();
                });
            </script>
        </form>
    </div>
<?php
    }
        else if($content == 'create')
    {
?>
    <div id="login" class="cf">
        <h2><?=LNG_CREATE_ACCOUNT;?></h2>
        <form id="create_form" name="login" action="<?=site_url('index.php/login/create');?>" method="post" autocomplete="off">
            <input type="hidden" name="auth" value="submit" />
            <label class="lbl-1"><?=LNG_FIELD_NAME;?></label>
            <div class="input-1<?=$data['create']['error']['class_name'];?>">
                <input type="text" name="name" value="<?=$data['create']['field_name'];?>" />
            </div>
            <label class="lbl-1"><?=LNG_FIELD_EMAIL;?></label>
            <div class="input-1<?=$data['create']['error']['class_email'];?>">
                <input type="text" name="email" value="<?=$data['create']['field_email'];?>" />
            </div>
            <label class="lbl-1"><?=LNG_FIELD_USERNAME;?></label>
            <div class="input-1<?=$data['create']['error']['class_username'];?>">
                <input type="text" name="username" value="<?=$data['create']['field_username'];?>" />
            </div>
            <label class="lbl-1"><a style="color:#1d2a5b;font-weight: bold;" href="http://findmyfbid.com/" target="_blank" rel="nofollow"><?=LNG_FACEBOOK_USER_ID;?></a></label>
            <div class="input-1<?=$data['create']['error']['class_rfbid'];?>">
                <input type="text" name="rfbid" value="<?=$data['create']['field_rfbid'];?>" placeholder="<?=LNG_FACEBOOK_USER_ID_PLACEHOLDER;?>" />
            </div>
            <label class="lbl-1"><?=LNG_FIELD_PASSWORD;?></label>
            <div class="input-1<?=$data['create']['error']['class_password'];?>">
                <input type="password" name="password" value="<?=$data['create']['field_password'];?>" />
            </div>
            <label class="lbl-1"><?=LNG_FIELD_RE_PASSWORD;?></label>
            <div class="input-1<?=$data['create']['error']['class_repassword'];?>">
                <input type="password" name="repassword" value="<?=$data['create']['field_repassword'];?>" />
            </div>
            <p class="msg error"><?=$data['create']['error']['title_error'];?></p>
            <div class="options" class="cf">
                <a href="javascript:document.login.submit();" title="" class="btn rt"><?=LNG_CREATE;?></a>
                <a href="<?=site_url('index.php/login');?>" title="" class="btn rt" style="margin-right:10px;"><?=LNG_CANCEL;?></a>
            </div>
            <script type="text/javascript">
                $("#create_form").keydown(function(event)
                {
                    if(event.keyCode == 13) document.login.submit();
                });
            </script>
        </form>
    </div>
<?php
    }
        else if($content == 'recover')
    {
?>
    <div id="login" class="cf">
        <h2><?=LNG_RECOVER_PASSWORD;?></h2>
        <form id="recover_form" name="login" action="<?=site_url('index.php/login/recover');?>" method="post" autocomplete="off">
            <input type="hidden" name="auth" value="submit" />
            <label class="lbl-1"><?=LNG_RECOVER_PASSWORD_INFO;?></label>
            <br />
            <div class="input-1<?=$data['recover']['error']['class_error'];?>">
                <input type="text" name="email" placeholder="<?=LNG_EMAIL_ADDRESS_PLACEHOLDER;?>" value="<?=$data['recover']['field_email'];?>" />
            </div>
            <p class="msg error"><?=$data['recover']['error']['title_error'];?></p>
            <div class="options" class="cf">
                <a href="javascript:document.login.submit();" title="" class="btn rt"><?=LNG_SEND_EMAIL;?></a>
                <a href="<?=site_url('index.php/login');?>" title="" class="btn rt" style="margin-right:10px;"><?=LNG_CANCEL;?></a>
            </div>
            <script type="text/javascript">
                $("#recover_form").keydown(function(event)
                {
                    if(event.keyCode == 13) document.login.submit();
                });
            </script>
        </form>
    </div>
<?php
    }
?>
    <div id="footer" class="fixedbk">
        <p class="" style="text-align:center;"><?=LNG_COPYRIGHT;?> &#169; <?=date('Y').' '.$this->config->item('platform');?>. <?=LNG_ALL_RIGHTS_RESERVED;?>
            <br/>
<?php
    $languages = $this->language->get();
    if(!empty($languages))
    {
        $i = 1;
        $cnt_languages = count($languages);
        foreach($languages as $language)
        {
?>
            <a href="?lang=<?=$language['id'];?>" style="color:#<?=($language['selected'])? '333;':'3b5998';?>;"><?=strtoupper($language['id']);?></a> <?=($i != $cnt_languages)? '<span style="color:#333;">|</span>':'';?>
<?php
            $i++;
        }
    }
?>
        </p>
    </div>
</div>
</body>
</html>