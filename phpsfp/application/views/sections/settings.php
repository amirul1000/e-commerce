    <div id="content" class="cf">
        <div id="sidebar">
            <ul class="list">
                <li class="item"><a href="<?=site_url('index.php/dashboard');?>" title="" class="link ico dashboard<?=($this->uri->segment(1) == 'dashboard')? ' active':'';?>"><?=LNG_MENU_DASHBOARD;?></a></li>
                <li class="item"><a href="<?=site_url('index.php/schedule');?>" title="" class="link ico schedule<?=($this->uri->segment(1) == 'schedule')? ' active':'';?>"><?=LNG_MENU_SCHEDULES;?></a></li>
                <li class="item"><a href="<?=site_url('index.php/groups');?>" title="" class="link ico users<?=($this->uri->segment(1) == 'groups')? ' active':'';?>"><?=LNG_MENU_GROUPS;?></a></li>
<?php
    if($check_admin)
    {
?>
                <li class="item"><a href="<?=site_url('index.php/users');?>" title="" class="link ico users<?=($this->uri->segment(1) == 'users')? ' active':'';?>"><?=LNG_MENU_USERS;?></a></li>
<?php
    }
?>
                <li class="item"><a href="<?=site_url('index.php/settings');?>" title="" class="link ico settings<?=($this->uri->segment(1) == 'settings')? ' active':'';?>"><?=LNG_MENU_SETTINGS;?></a></li>
            </ul>
        </div>
        <div id="general">
<?php
    if($data['facebook_app']['app_default'] == 1)
    {
?>
            <div class="container">
                <form name="facebookappsettings" action="<?=site_url('index.php/settings');?>" method="post">
                    <input type="hidden" name="facebook_app" value="submit" />
                    <h2><?=LNG_FACEBOOK_APP_SETTINGS;?></h2>
                    <div class="wrap">
                        <table class="table-1">
<?php
        if($check_admin)
        {
?>
                            <tr>
                                <td class="txt-wrap">
                                    <label class="lbl-3"><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank" style="color:#3B59BA;"><?=LNG_PURCHASE_CODE;?></a></label>
                                </td>
                                <td class="field-wrap" colspan="2">
                                    <div class="input-1 w300 lt">
                                        <input type="password" id="field_purchase_code" name="field_purchase_code" value="<?=$data['facebook_app']['field_purchase_code'];?>"/>
                                    </div>
                                    <div class="info tooltip lt">
                                        <div class="popup v2">
                                            <div class="inner">
                                                <p><?=LNG_PURCHASE_CODE_INFO;?></p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
<?php
            if(isset($data['facebook_app']['purchase_code_rsp']) && !empty($data['facebook_app']['purchase_code_rsp']))
            {
?>
                            <tr>
                                <td class="txt-wrap">
                                    <label class="lbl-3">&nbsp;</label>
                                </td>
                                <td colspan="2" class="field-wrap-info">
                                    <p class="ico error"><?=$data['facebook_app']['purchase_code_rsp'];?></p>
                                </td>
                            </tr>
<?php
            }
?>
                            <tr>
                                <td colspan="2">
                                    <div class="options cf" style="padding: 10px 0;"></div>
                                </td>
                            </tr>
<?php
        }
?>
                            <tr>
                                <td class="txt-wrap">
                                    <label class="lbl-3"><?=LNG_FIELD_APP_ID;?></label>
                                </td>
                                <td class="field-wrap" colspan="2">
                                    <div class="input-1 w300 lt<?=$data['facebook_app']['error']['class_app_id'];?>">
                                        <input type="text" id="field_app_id" name="field_app_id" value="<?=$data['facebook_app']['field_app_id'];?>"/>
                                    </div>
                                    <div class="info tooltip lt">
                                        <div class="popup v2">
                                            <div class="inner">
                                                <p><?=LNG_FIELD_APP_ID_INFO;?></p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="txt-wrap">
                                    <label class="lbl-3"><?=LNG_FIELD_APP_SECRET;?></label>
                                </td>
                                <td class="field-wrap" colspan="2">
                                    <div class="input-1 w300 lt<?=$data['facebook_app']['error']['class_app_secret'];?>">
                                        <input type="password" id="field_app_secret" name="field_app_secret" value="<?=$data['facebook_app']['field_app_secret'];?>"/>
                                    </div>
                                    <div class="info tooltip lt">
                                        <div class="popup v2">
                                            <div class="inner">
                                                <p><?=LNG_FIELD_APP_SECRET_INFO;?></p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
<?php
        if(isset($data['facebook_app']['token']))
        {
?>
                            <tr>
                                <td class="txt-wrap">
                                    <label class="lbl-3"><?=LNG_FIELD_APP_TOKEN;?></label>
                                </td>
                                <td class="field-wrap-info" colspan="2">
                                    <p class="ico <?=(!$data['facebook_app']['token']['exists'] || !$data['facebook_app']['token']['valid'])? 'error':'ok';?>"><?=LNG_APPLICATION_ACCESS_TOKEN_IS;?> <?=(!$data['facebook_app']['token']['exists'])? LNG_APPLICATION_ACCESS_TOKEN_IS_V1:(($data['facebook_app']['token']['valid'])? LNG_APPLICATION_ACCESS_TOKEN_IS_V2:LNG_APPLICATION_ACCESS_TOKEN_IS_V3);?></p>
<?php
            if(!$data['facebook_app']['token']['exists'] || !$data['facebook_app']['token']['valid'])
            {
?>
                                    <p><?=LNG_APPLICATION_ACCESS_TOKEN_INFO_1;?> <a class="link" href="<?=site_url('index.php/dashboard');?>"><?=LNG_APPLICATION_ACCESS_TOKEN_INFO_2;?></a> <?=LNG_APPLICATION_ACCESS_TOKEN_INFO_3;?></p>
<?php
            }
?>
                                </td>
                            </tr>
<?php
        }

        if($check_admin)
        {
?>
                            <tr>
                                <td colspan="2">
                                    <div class="options cf">
                                        <p class="lt"><?=LNG_FACEBOOK_USERS_PAGE_GROUP_LIMITS;?></p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="txt-wrap">
                                    <label class="lbl-3"><?=LNG_FIELD_PAGES;?></label>
                                </td>
                                <td class="field-wrap" colspan="2">
                                    <div class="input-1 w300 lt">
                                        <input type="text" id="field_limit_pages" name="field_limit_pages" value="<?=$data['facebook_app']['field_limit_pages'];?>"/>
                                    </div>
                                    <div class="info tooltip lt">
                                        <div class="popup v2">
                                            <div class="inner">
                                                <p><?=LNG_FIELD_PAGES_INFO;?></p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="txt-wrap">
                                    <label class="lbl-3"><?=LNG_FIELD_GROUPS;?></label>
                                </td>
                                <td class="field-wrap" colspan="2">
                                    <div class="input-1 w300 lt">
                                        <input type="text" id="field_limit_groups" name="field_limit_groups" value="<?=$data['facebook_app']['field_limit_groups'];?>"/>
                                    </div>
                                    <div class="info tooltip lt">
                                        <div class="popup v2">
                                            <div class="inner">
                                                <p><?=LNG_FIELD_GROUPS_INFO;?></p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
<?php
        }
?>
                            <tr>
                                <td colspan="2">
                                    <div class="options cf">
                                        <p class="lt"><?=LNG_POSTING_OPTIONS;?></p>
                                    </div>
                                </td>
                            </tr>
<?php
        if($check_admin)
        {
?>
                            <tr>
                                <td class="txt-wrap">
                                    <label class="lbl-3"><?=LNG_FIELD_SEND_INTERVAL;?></label>
                                </td>
                                <td class="field-wrap" colspan="2">
                                    <div class="input-1 w300 lt">
                                        <input type="text" id="field_send_interval" name="field_send_interval" value="<?=$data['facebook_app']['field_send_interval'];?>"/>
                                    </div>
                                    <div class="info tooltip lt">
                                        <div class="popup v2">
                                            <div class="inner">
                                                <p><?=LNG_FIELD_SEND_INTERVAL_INFO;?></p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="txt-wrap">
                                    <label class="lbl-3"><?=LNG_FIELD_TRACK_CLICKS;?></label>
                                </td>
                                <td class="field-wrap" colspan="2">
                                    <div class="input-1 w300 select lt">
                                        <input type="text" id="js_name_tracking" value="<?=($data['facebook_app']['field_track_clicks'] == 1)? LNG_ENABLED:LNG_DISABLED;?>" disabled="disabled" />
                                        <input type="hidden" id="js_input_tracking" name="field_track_clicks" value="<?=$data['facebook_app']['field_track_clicks'];?>" />
                                        <div class="dropdown">
                                            <ul>
                                                <li><a href="javascript:void(0);" onclick="update_select('1', '<?=LNG_ENABLED;?>', 'tracking')" title=""><?=LNG_ENABLED;?></a></li>
                                                <li><a href="javascript:void(0);" onclick="update_select('0', '<?=LNG_DISABLED;?>', 'tracking')" title=""><?=LNG_DISABLED;?></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="info tooltip lt">
                                        <div class="popup v2">
                                            <div class="inner">
                                                <p><?=LNG_FIELD_TRACK_CLICKS_INFO;?></p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="txt-wrap">
                                    <label class="lbl-3"><?=LNG_FIELD_RANDOM_SEND_INTERVAL;?></label>
                                </td>
                                <td class="field-wrap" colspan="2">
                                    <div class="input-1 w300 select lt">
                                        <input type="text" id="js_name_random_time" value="<?=($data['facebook_app']['field_random_time'] == 1)? LNG_ENABLED:LNG_DISABLED;?>" disabled="disabled" />
                                        <input type="hidden" id="js_input_random_time" name="field_random_time" value="<?=$data['facebook_app']['field_random_time'];?>" />
                                        <div class="dropdown">
                                            <ul>
                                                <li><a href="javascript:void(0);" onclick="update_select('1', '<?=LNG_ENABLED;?>', 'random_time')" title=""><?=LNG_ENABLED;?></a></li>
                                                <li><a href="javascript:void(0);" onclick="update_select('0', '<?=LNG_DISABLED;?>', 'random_time')" title=""><?=LNG_DISABLED;?></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="info tooltip lt">
                                        <div class="popup v2">
                                            <div class="inner">
                                                <p><?=LNG_FIELD_RANDOM_SEND_INTERVAL_INFO;?></p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
<?php
        }
?>
                            <tr>
                                <td class="txt-wrap">
                                    <label class="lbl-3"><?=LNG_FIELD_AUTOPAUSE;?></label>
                                </td>
                                <td class="field-wrap" colspan="2">
                                    <div class="input-1 w300 select lt">
                                        <input type="text" id="js_name_ap_enabled" value="<?=($data['facebook_app']['field_ap_enabled'] == 1)? LNG_ENABLED:LNG_DISABLED;?>" disabled="disabled" />
                                        <input type="hidden" id="js_input_ap_enabled" name="field_ap_enabled" value="<?=$data['facebook_app']['field_ap_enabled'];?>" />
                                        <div class="dropdown">
                                            <ul>
                                                <li><a href="javascript:void(0);" onclick="update_select('1', '<?=LNG_ENABLED;?>', 'ap_enabled')" title=""><?=LNG_ENABLED;?></a></li>
                                                <li><a href="javascript:void(0);" onclick="update_select('0', '<?=LNG_DISABLED;?>', 'ap_enabled')" title=""><?=LNG_DISABLED;?></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="info tooltip lt">
                                        <div class="popup v2">
                                            <div class="inner">
                                                <p><?=LNG_FIELD_AUTOPAUSE_INFO;?></p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="txt-wrap">
                                    <label class="lbl-3"><?=LNG_FIELD_AUTOPAUSE_X_POSTS;?></label>
                                </td>
                                <td class="field-wrap" colspan="2">
                                    <div class="input-1 w300 lt">
                                        <input type="text" id="field_ap_posts_limit" name="field_ap_posts_limit" value="<?=$data['facebook_app']['field_ap_posts_limit'];?>"/>
                                    </div>
                                    <div class="info tooltip lt">
                                        <div class="popup v2">
                                            <div class="inner">
                                                <p><?=LNG_FIELD_AUTOPAUSE_X_POSTS_INFO;?></p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="txt-wrap">
                                    <label class="lbl-3"><?=LNG_FIELD_AUTOPAUSE_X_MINUTES;?></label>
                                </td>
                                <td class="field-wrap" colspan="2">
                                    <div class="input-1 w300 lt">
                                        <input type="text" id="field_ap_posts_time" name="field_ap_posts_time" value="<?=$data['facebook_app']['field_ap_posts_time'];?>"/>
                                    </div>
                                    <div class="info tooltip lt">
                                        <div class="popup v2">
                                            <div class="inner">
                                                <p><?=LNG_FIELD_AUTOPAUSE_X_MINUTES_INFO;?></p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
<?php
        if($check_admin)
        {
?>
                            <tr>
                                <td colspan="2">
                                    <div class="options cf">
                                        <p class="lt"><?=LNG_GENERAL_OPTIONS;?></p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="txt-wrap">
                                    <label class="lbl-3"><?=LNG_FIELD_AUTO_ROLE;?></label>
                                </td>
                                <td class="field-wrap" colspan="2">
                                    <div class="input-1 w300 select lt">
                                        <input type="text" id="js_name_role" value="<?=($data['facebook_app']['field_role_auto'] == 1)? LNG_ENABLED:LNG_DISABLED;?>" disabled="disabled" />
                                        <input type="hidden" id="js_input_role" name="field_role_auto" value="<?=$data['facebook_app']['field_role_auto'];?>" />
                                        <div class="dropdown">
                                            <ul>
                                                <li><a href="javascript:void(0);" onclick="update_select('1', '<?=LNG_ENABLED;?>', 'role')" title=""><?=LNG_ENABLED;?></a></li>
                                                <li><a href="javascript:void(0);" onclick="update_select('0', '<?=LNG_DISABLED;?>', 'role')" title=""><?=LNG_DISABLED;?></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="info tooltip lt">
                                        <div class="popup v2">
                                            <div class="inner">
                                                <p><?=LNG_FIELD_AUTO_ROLE_INFO;?></p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="txt-wrap">
                                    <label class="lbl-3"><?=LNG_FIELD_UPLOAD_SIZE_LIMIT;?></label>
                                </td>
                                <td class="field-wrap" colspan="2">
                                    <div class="input-1 w300 lt">
                                        <input type="text" id="field_limit_upload" name="field_limit_upload" value="<?=$data['facebook_app']['field_limit_upload'];?>"/>
                                    </div>
                                    <div class="info tooltip lt">
                                        <div class="popup v2">
                                            <div class="inner">
                                                <p><?=LNG_FIELD_UPLOAD_SIZE_LIMIT_INFO;?></p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="txt-wrap">
                                    <label class="lbl-3"><?=LNG_FILED_NEW_USERS_OWN_F_APP;?></label>
                                </td>
                                <td class="field-wrap" colspan="2">
                                    <div class="input-1 w300 select lt">
                                        <input type="text" id="js_name_newusers_app" value="<?=($data['facebook_app']['field_newusers_app'] == 1)? LNG_ENABLED:LNG_DISABLED;?>" disabled="disabled" />
                                        <input type="hidden" id="js_input_newusers_app" name="field_newusers_app" value="<?=$data['facebook_app']['field_newusers_app'];?>" />
                                        <div class="dropdown">
                                            <ul>
                                                <li><a href="javascript:void(0);" onclick="update_select('1', '<?=LNG_ENABLED;?>', 'newusers_app')" title=""><?=LNG_ENABLED;?></a></li>
                                                <li><a href="javascript:void(0);" onclick="update_select('0', '<?=LNG_DISABLED;?>', 'newusers_app')" title=""><?=LNG_DISABLED;?></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="info tooltip lt">
                                        <div class="popup v2">
                                            <div class="inner">
                                                <p><?=LNG_FILED_NEW_USERS_OWN_F_APP_INFO;?></p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="txt-wrap">
                                    <label class="lbl-3"><?=LNG_FIELD_NEW_USERS_CREATE_ACCOUNT;?></label>
                                </td>
                                <td class="field-wrap" colspan="2">
                                    <div class="input-1 w300 select lt">
                                        <input type="text" id="js_name_newusers_crt" value="<?=($data['facebook_app']['field_newusers_crt'] == 0)? LNG_NO:(($data['facebook_app']['field_newusers_crt'] == 1)? LNG_YES:LNG_APPROVED_BY_ADMIN);?>" disabled="disabled" />
                                        <input type="hidden" id="js_input_newusers_crt" name="field_newusers_crt" value="<?=$data['facebook_app']['field_newusers_crt'];?>" />
                                        <div class="dropdown">
                                            <ul>
                                                <li><a href="javascript:void(0);" onclick="update_select('0', '<?=LNG_NO;?>', 'newusers_crt')" title=""><?=LNG_NO;?></a></li>
                                                <li><a href="javascript:void(0);" onclick="update_select('1', '<?=LNG_YES;?>', 'newusers_crt')" title=""><?=LNG_YES;?></a></li>
                                                <li><a href="javascript:void(0);" onclick="update_select('2', '<?=LNG_APPROVED_BY_ADMIN;?>', 'newusers_crt')" title=""><?=LNG_APPROVED_BY_ADMIN;?></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="info tooltip lt">
                                        <div class="popup v2">
                                            <div class="inner">
                                                <p><?=LNG_FIELD_NEW_USERS_CREATE_ACCOUNT_INFO;?></p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="txt-wrap">
                                    <label class="lbl-3"><?=LNG_FIELD_LANGUAGE;?></label>
                                </td>
                                <td class="field-wrap" colspan="2">
                                    <div class="input-1 w300 select lt">
                                        <input type="text" id="js_name_language" value="<?=strtoupper($data['facebook_app']['field_language']);?>" disabled="disabled" />
                                        <input type="hidden" id="js_input_language" name="field_language" value="<?=$data['facebook_app']['field_language'];?>" />
                                        <div class="dropdown">
                                            <ul>
<?php
            $languages = $this->language->get();
            if(!empty($languages))
            {
                foreach($languages as $language)
                {
?>
                                                <li><a href="javascript:void(0);" onclick="update_select('<?=$language['id'];?>', '<?=strtoupper($language['id']);?>', 'language')" title=""><?=strtoupper($language['id']);?></a></li>
<?php
                }
            }
?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="info tooltip lt">
                                        <div class="popup v2">
                                            <div class="inner">
                                                <p><?=LNG_FIELD_LANGUAGE_INFO;?></p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
<?php
        }
?>
                            <tr>
                                <td colspan="2">
                                    <div class="options cf">
<?php
        if($data['facebook_app']['error']['error'] == 2)
        {
?>
                                        <p class="lt msg ok"><?=LNG_SETTINGS_SAVED;?></p>
<?php
        }

        foreach($data['facebook_app']['errors'] as $error)
        {
?>
                                        <p class="lt msg error"><?=$error;?></p>
<?php
        }
?>
                                        <a href="javascript:document.facebookappsettings.submit();" title="" class="btn rt"><?=LNG_SAVE_SETTINGS;?></a>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
<?php
    }
?>
            <div class="container">
                <form id="accountsettings" name="accountsettings" action="<?=site_url('index.php/settings');?>#accountsettings" method="post">
                    <input type="hidden" name="account_settings" value="submit" />
                    <h2><?=LNG_GENERAL_ACCOUNT_SETTINGS;?></h2>
                    <div class="wrap">
                        <table class="table-1">
                            <tr>
                                <td class="txt-wrap">
                                    <label class="lbl-3"><?=LNG_FIELD_NAME;?></label>
                                </td>
                                <td class="field-wrap" colspan="2">
                                    <div class="input-1 w300 lt<?=$data['account']['error']['class_name'];?>">
                                        <input type="text" id="field_name" name="field_name" value="<?=$data['account']['field_name'];?>"/>
                                    </div>
                                    <div class="info tooltip lt">
                                        <div class="popup v2">
                                            <div class="inner">
                                                <p><?=LNG_FIELD_NAME_INFO1;?></p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="txt-wrap">
                                    <label class="lbl-3"><?=LNG_FIELD_EMAIL;?></label>
                                </td>
                                <td class="field-wrap" colspan="2">
                                    <div class="input-1 w300 lt<?=$data['account']['error']['class_email'];?>">
                                        <input type="text" id="field_email" name="field_email" value="<?=$data['account']['field_email'];?>"/>
                                    </div>
                                    <div class="info tooltip lt">
                                        <div class="popup v2">
                                            <div class="inner">
                                                <p><?=LNG_FIELD_EMAIL_INFO1;?></p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="txt-wrap">
                                    <label class="lbl-3"><?=LNG_FIELD_TIMEZONE;?></label>
                                </td>
                                <td class="field-wrap" colspan="2">
                                    <div class="input-1 w300 select lt">
                                        <input type="text" id="js_name_timezone" name="field_timezone_d" value="<?=$data['account']['field_timezone_d'];?>" disabled="disabled" />
                                        <input type="hidden" id="js_input_timezone" name="field_timezone" value="<?=$data['account']['field_timezone'];?>" />
                                        <div class="dropdown">
                                            <ul>
<?php
    foreach($data['timezones'] as $key => $timezone)
    {
?>
                                                <li><a href="javascript:void(0);" onclick="update_select('<?=$key;?>', '<?=$timezone;?>', 'timezone')" title=""><?=$timezone;?></a></li>
<?php
    }
?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="info tooltip lt">
                                        <div class="popup v2">
                                            <div class="inner">
                                                <p><?=LNG_FIELD_TIMEZONE_INFO;?></p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="options cf">
                                        <p class="lt"><?=LNG_CHANGE_ACCOUNT_PASSWORD;?></p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="txt-wrap">
                                    <label class="lbl-3"><?=LNG_FIELD_CURRENT;?></label>
                                </td>
                                <td class="field-wrap" colspan="2">
                                    <div class="input-1 w300 lt<?=$data['account']['error']['class_cpassword'];?>">
                                        <input type="password" id="field_cpassword" name="field_cpassword" value="<?=$data['account']['field_cpassword'];?>" autocomplete="off" />
                                    </div>
                                    <div class="info tooltip lt">
                                        <div class="popup v2">
                                            <div class="inner">
                                                <p><?=LNG_FIELD_CURRENT_INFO;?></p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="txt-wrap">
                                    <label class="lbl-3"><?=LNG_FIELD_NEW;?></label>
                                </td>
                                <td class="field-wrap" colspan="2">
                                    <div class="input-1 w300 lt<?=$data['account']['error']['class_password'];?>">
                                        <input type="password" id="field_password" name="field_password" value="<?=$data['account']['field_password'];?>" autocomplete="off" />
                                    </div>
                                    <div class="info tooltip lt">
                                        <div class="popup v2">
                                            <div class="inner">
                                                <p><?=LNG_FIELD_NEW_INFO;?></p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="txt-wrap">
                                    <label class="lbl-3"><?=LNG_FIELD_RE_NEW;?></label>
                                </td>
                                <td class="field-wrap" colspan="2">
                                    <div class="input-1 w300 lt<?=$data['account']['error']['class_repassword'];?>">
                                        <input type="password" id="field_repassword" name="field_repassword" value="<?=$data['account']['field_repassword'];?>" autocomplete="off" />
                                    </div>
                                    <div class="info tooltip lt">
                                        <div class="popup v2">
                                            <div class="inner">
                                                <p><?=LNG_FIELD_RE_NEW_INFO;?></p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="options cf">
<?php
    if($data['account']['error']['error'] == 2)
    {
?>
                                        <p class="lt msg ok"><?=LNG_SETTINGS_SAVED;?></p>
<?php
    }

    foreach($data['account']['errors'] as $error)
    {
?>
                                        <p class="lt msg error"><?=$error;?></p>
<?php
    }
?>
                                        <a href="javascript:document.accountsettings.submit();" title="" class="btn rt"><?=LNG_SAVE_SETTINGS;?></a>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
<?php
    if($check_admin)
    {
?>
            <div class="container">
                <form id="mailsettings" name="mailsettings" action="<?=site_url('index.php/settings');?>#mailsettings" method="post">
                    <input type="hidden" name="mail_settings" value="submit" />
                    <h2><?=LNG_MAIL_SETTINGS;?></h2>
                    <div class="wrap">
                        <table class="table-1">
                            <tr>
                                <td class="txt-wrap">
                                    <label class="lbl-3"><?=LNG_FIELD_FROM_NAME;?></label>
                                </td>
                                <td class="field-wrap" colspan="2">
                                    <div class="input-1 w300 lt<?=$data['mail']['error']['class_name'];?>">
                                        <input type="text" id="field_name" name="field_name" value="<?=$data['mail']['field_name'];?>"/>
                                    </div>
                                    <div class="info tooltip lt">
                                        <div class="popup v2">
                                            <div class="inner">
                                                <p><?=LNG_FIELD_FROM_NAME_INFO;?></p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="txt-wrap">
                                    <label class="lbl-3"><?=LNG_FIELD_FROM_EMAIL;?></label>
                                </td>
                                <td class="field-wrap" colspan="2">
                                    <div class="input-1 w300 lt<?=$data['mail']['error']['class_email'];?>">
                                        <input type="text" id="field_email" name="field_email" value="<?=$data['mail']['field_email'];?>"/>
                                    </div>
                                    <div class="info tooltip lt">
                                        <div class="popup v2">
                                            <div class="inner">
                                                <p><?=LNG_FIELD_FROM_EMAIL_INFO;?></p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="options cf">
                                        <p class="lt"><strong><?=LNG_FIELD_PROTOCOL;?></strong></p>
                                        <p class="lt">
                                            <input type="radio" name="field_protocol" onclick="$('#div-smpt').hide();" value="1"<?=($data['mail']['field_protocol'] == 1)? ' checked="checked"':'';?> /> <?=LNG_FIELD_PROTOCOL_MAIL;?>
                                            <input type="radio" name="field_protocol" onclick="$('#div-smpt').hide();" value="2"<?=($data['mail']['field_protocol'] == 2)? ' checked="checked"':'';?> /> <?=LNG_FIELD_PROTOCOL_SENDMAIL;?>
                                            <input type="radio" name="field_protocol" onclick="$('#div-smpt').show();" value="3"<?=($data['mail']['field_protocol'] == 3)? ' checked="checked"':'';?> /> <?=LNG_FIELD_PROTOCOL_SMTP;?>
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <div id="div-smpt" style="display:<?=($data['mail']['field_protocol'] == 3)? 'block':'none';?>;">
                            <table class="table-1">
                                <tr>
                                    <td colspan="2">
                                        <div class="options cf">
                                            <p class="lt"><?=LNG_SMTP_OPTIONS;?></p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="txt-wrap">
                                        <label class="lbl-3"><?=LNG_FIELD_SMTP_HOST;?></label>
                                    </td>
                                    <td class="field-wrap" colspan="2">
                                        <div class="input-1 w300 lt<?=$data['mail']['error']['class_host'];?>">
                                            <input type="text" id="field_host" name="field_host" value="<?=$data['mail']['field_host'];?>"/>
                                        </div>
                                        <div class="info tooltip lt">
                                            <div class="popup v2">
                                                <div class="inner">
                                                    <p><?=LNG_FIELD_SMTP_HOST_INFO;?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="txt-wrap">
                                        <label class="lbl-3"><?=LNG_FIELD_SMTP_USERNAME;?></label>
                                    </td>
                                    <td class="field-wrap" colspan="2">
                                        <div class="input-1 w300 lt<?=$data['mail']['error']['class_username'];?>">
                                            <input type="text" id="field_username" name="field_username" value="<?=$data['mail']['field_username'];?>"/>
                                        </div>
                                        <div class="info tooltip lt">
                                            <div class="popup v2">
                                                <div class="inner">
                                                    <p><?=LNG_FIELD_SMTP_USERNAME_INFO;?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="txt-wrap">
                                        <label class="lbl-3"><?=LNG_FIELD_SMTP_PASSWORD;?></label>
                                    </td>
                                    <td class="field-wrap" colspan="2">
                                        <div class="input-1 w300 lt<?=$data['mail']['error']['class_password'];?>">
                                            <input type="password" id="field_password" name="field_password" value="<?=$data['mail']['field_password'];?>"/>
                                        </div>
                                        <div class="info tooltip lt">
                                            <div class="popup v2">
                                                <div class="inner">
                                                    <p><?=LNG_FIELD_SMTP_PASSWORD_INFO;?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="txt-wrap">
                                        <label class="lbl-3"><?=LNG_FIELD_SMTP_PORT;?></label>
                                    </td>
                                    <td class="field-wrap" colspan="2">
                                        <div class="input-1 w300 lt<?=$data['mail']['error']['class_port'];?>">
                                            <input type="text" id="field_port" name="field_port" value="<?=$data['mail']['field_port'];?>"/>
                                        </div>
                                        <div class="info tooltip lt">
                                            <div class="popup v2">
                                                <div class="inner">
                                                    <p><?=LNG_FIELD_SMTP_PORT_INFO;?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <table class="table-1">
                            <tr>
                                <td colspan="2">
                                    <div class="options cf">
<?php
        if($data['mail']['error']['error'] == 2)
        {
?>
                                        <p class="lt msg ok"><?=LNG_SETTINGS_SAVED;?></p>
<?php
        }
            else if($data['mail']['error']['error'] == 1)
        {
?>
                                        <p class="lt msg error"><?=LNG_PLEASE_FILL_EMPTY_FIELDS;?></p>
<?php
        }
?>
                                        <a href="javascript:document.mailsettings.submit();" title="" class="btn rt"><?=LNG_SAVE_SETTINGS;?></a>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
<?php
    }
?>
        </div>
    </div>
