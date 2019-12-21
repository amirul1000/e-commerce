    <div id="footer">
        <p class="copyright"><?=LNG_COPYRIGHT;?> &#169; <?=date('Y').' '.$this->config->item('platform');?>. <?=LNG_ALL_RIGHTS_RESERVED;?></p>
        <ul class="menu">
            <li><a href="<?=site_url('index.php/page/index/about');?>" title=""><?=LNG_ABOUT;?></a></li>
            <li><a href="<?=site_url('index.php/page/index/terms-and-conditions');?>" title=""><?=LNG_TERMS_CONDITIONS;?></a></li>
            <li><a href="<?=site_url('index.php/page/index/privacy-policy');?>" title=""><?=LNG_PRIVACY_POLICY;?></a></li>
            <li><a href="<?=site_url('index.php/login/logout');?>" title=""><?=LNG_LOGOUT;?></a></li>
        </ul>
<?php
    $languages = $this->language->get();
    if(!empty($languages))
    {
?>
        <br/>
        <p>
<?php
        $i = 1;
        $cnt_languages = count($languages);
        foreach($languages as $language)
        {
?>
            <a href="?lang=<?=$language['id'];?>" style="color:#<?=($language['selected'])? '333;':'3b5998';?>;"><?=strtoupper($language['id']);?></a> <?=($i != $cnt_languages)? '<span style="color:#333;">|</span>':'';?>
<?php
            $i++;
        }
?>
        </p>
<?php
    }
?>
    </div>
</div>

<div id="mask"></div>
<div id="modal">
    <div id="modal_loader" style="display:none;">
        <div class="heading">
            <h2><?=LNG_LOADING;?></h2>
        </div>
        <div class="inner cf">
            <p style="text-align:center;">
                <img src="<?=$this->link->template_url('content/ajax-loader.gif');?>" />
            </p>
        </div>
    </div>
    <div id="preview_post" class="window"></div>
    <div id="add-user" class="window"></div>
    <div id="cron-error" class="window"></div>
    <div id="edit-post" class="window"></div>
    <div id="preview" class="window">
        <div class="heading">
            <h2>Post preview</h2>
        </div>
        <div class="inner cf">
            <div class="col lt">
                <span class="img"><img src="<?=($fbaccess['user'])? "https://graph.facebook.com/".(isset($fbaccess['batch_response']['user_info']['id'])? $fbaccess['batch_response']['user_info']['id']:0)."/picture":$this->link->template_url('content/picture.png');?>" width="50" height="50" alt=""></span>
            </div>
            <div class="col rt cf">
                <p class="name"><?=($fbaccess['user'])? $fbaccess['batch_response']['user_info']['name']:"Jhon Doe";?></p>
                <p class="txt-1" id="modal_field_message">&nbsp;</p>
                <span class="img"><img id="modal_field_picture" src="<?=$this->link->template_url('content/no_picture.gif');?>" width="90" height="90" alt=""></span>
                <div class="details">
                    <p class="name" id="modal_field_name">&nbsp;</p>
                    <p class="txt-2" id="modal_field_caption">&nbsp;</p>
                    <p class="txt-2" id="modal_field_description">&nbsp;</p>
                </div>
                <ul>
                    <li><span class="link">Like</span></li>
                    <li><span class="link">Comment</span></li>
                    <li><span class="link">Follow post</span></li>
                    <li>About a minute ago via App</li>
                </ul>
            </div>
        </div>
        <div class="actions">
            <a href="javascript:void(0);" class="btn rt btn-close">Close preview</a>
        </div>
    </div>
</div>

</body>
</html>
<!--memory/load time:<?=$this->benchmark->memory_usage();?>/<?=$this->benchmark->elapsed_time();?> sec-->