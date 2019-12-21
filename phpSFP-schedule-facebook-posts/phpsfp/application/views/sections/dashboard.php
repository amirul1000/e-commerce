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
        if($data['schedule_post']['error']['error'] == 2)
        {
?>
            <p class="msg-box ok"><?=LNG_SCHEDULE_SUCCESS;?></p>
<?php
        }

        foreach($data['schedule_post']['errors'] as $error)
        {
?>
            <p class="msg-box error"><?=LNG_ERROR;?>: <?=$error;?></p>
<?php
        }
?>
            <form id="MyUploadForm" name="schedulepost" action="<?=site_url('index.php/dashboard');?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="schedule_post" value="submit" />
                <div class="container">
                    <h2><?=LNG_WHATS_ON_YOUR_MIND;?></h2>
                    <div class="wrap responsive">
                        <div class="filter">
                            <span class="txt"><?=LNG_PUBLISH;?>:</span>
                            <label class="lbl-2"><input type="radio" name="field_ptype" onclick="ptype(1);" value="1"<?=($data['schedule_post']['field_ptype'] == 1)? ' checked="checked"':'';?>><?=LNG_TYPE_TEXT_POST;?></label>
                            <label class="lbl-2"><input type="radio" name="field_ptype" onclick="ptype(2);" value="2"<?=($data['schedule_post']['field_ptype'] == 2)? ' checked="checked"':'';?>><?=LNG_TYPE_LINK;?></label>
                            <label class="lbl-2"><input type="radio" name="field_ptype" onclick="ptype(3);" value="3"<?=($data['schedule_post']['field_ptype'] == 3)? ' checked="checked"':'';?>><?=LNG_TYPE_IMAGE;?></label>
                            <label class="lbl-2"><input type="radio" name="field_ptype" onclick="ptype(5);" value="5"<?=($data['schedule_post']['field_ptype'] == 5)? ' checked="checked"':'';?>><?=LNG_TYPE_VIDEO;?></label>
                        </div>
                        <script type="text/javascript">$(document).ready(function(){ ptype(<?=$data['schedule_post']['field_ptype'];?>); });</script>
                        <div id="ptype_field_link" style="display:none;">
                            <table class="table-1">
                                <tr>
                                    <td class="txt-wrap">
                                        <label class="lbl-3"><?=LNG_FIELD_LINK_URL;?></label>
                                    </td>
                                    <td class="field-wrap" colspan="2">
                                        <div class="input-1 w300 lt<?=$data['schedule_post']['error']['class_allempty'].$data['schedule_post']['error']['class_link'];?>"><input type="text" id="field_link" name="field_link" value="<?=$data['schedule_post']['field_link'];?>"/></div>
                                        <div class="info v1 tooltip lt">
                                            <div class="popup v1">
                                                <div class="inner">
                                                    <p><?=LNG_FIELD_LINK_URL_INFO;?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div id="ptype_field_message" style="display:none;">
                            <table class="table-1">
                                <tr>
                                    <td class="txt-wrap">
                                        <label class="lbl-3" id="ptype_field_message_label_1"><?=LNG_FIELD_MESSAGE;?></label>
                                        <label class="lbl-3" id="ptype_field_message_label_3"><?=LNG_FIELD_IMAGE_DESCRIPTION;?></label>
                                    </td>
                                    <td class="field-wrap">
                                        <div class="textarea-1 w300 lt<?=$data['schedule_post']['error']['class_message'];?>"><textarea id="field_message" name="field_message"><?=$data['schedule_post']['field_message'];?></textarea></div>
                                        <div class="info v1 tooltip lt">
                                            <div class="popup v1">
                                                <div class="inner">
                                                    <p id="ptype_field_message_p_1"><?=LNG_FIELD_MESSAGE_INFO;?></p>
                                                    <p id="ptype_field_message_p_3"><?=LNG_FIELD_IMAGE_DESCRIPTION_INFO;?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <!-- <a href="#preview" onclick="preview();" title="" class="btn rt modal"><span class="ico preview">Post preview</span></a> -->
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div id="ptype_field_name" style="display:none;">
                            <table class="table-1">
                                <tr>
                                    <td class="txt-wrap">
                                        <label class="lbl-3" id="ptype_field_name_label_2"><?=LNG_FIELD_LINK_TITLE;?></label>
                                        <label class="lbl-3" id="ptype_field_name_label_5"><?=LNG_FIELD_VIDEO_TITLE;?></label>
                                    </td>
                                    <td class="field-wrap" colspan="2">
                                        <div class="input-1 w300 lt<?=$data['schedule_post']['error']['class_allempty'];?>"><input type="text" id="field_name" name="field_name" value="<?=$data['schedule_post']['field_name'];?>"/></div>
                                        <div class="info v1 tooltip lt">
                                            <div class="popup v1">
                                                <div class="inner">
                                                    <p id="ptype_field_name_p_2"><?=LNG_FIELD_LINK_TITLE_INFO;?></p>
                                                    <p id="ptype_field_name_p_5"><?=LNG_FIELD_VIDEO_TITLE_INFO;?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div id="ptype_field_description" style="display:none;">
                            <table class="table-1">
                                <tr>
                                    <td class="txt-wrap">
                                        <label class="lbl-3" id="ptype_field_description_label_2"><?=LNG_FIELD_LINK_DESCRIPTION;?></label>
                                        <label class="lbl-3" id="ptype_field_description_label_5"><?=LNG_FIELD_VIDEO_DESCRIPTION;?></label>
                                    </td>
                                    <td class="field-wrap" colspan="2">
                                        <div class="textarea-1 w300 lt<?=$data['schedule_post']['error']['class_allempty'];?>"><textarea id="field_description" name="field_description"><?=$data['schedule_post']['field_description'];?></textarea></div>
                                        <div class="info v1 tooltip lt">
                                            <div class="popup v1">
                                                <div class="inner">
                                                    <p id="ptype_field_description_p_2"><?=LNG_FIELD_LINK_DESCRIPTION_INFO;?></p>
                                                    <p id="ptype_field_description_p_5"><?=LNG_FIELD_VIDEO_DESCRIPTION_INFO;?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div id="ptype_field_caption" style="display:none;">
                            <table class="table-1">
                                <tr>
                                    <td class="txt-wrap">
                                        <label class="lbl-3"><?=LNG_FIELD_LINK_CAPTION;?></label>
                                    </td>
                                    <td class="field-wrap" colspan="2">
                                        <div class="input-1 w300 lt<?=$data['schedule_post']['error']['class_allempty'];?>"><input type="text" id="field_caption" name="field_caption" value="<?=$data['schedule_post']['field_caption'];?>"/></div>
                                        <div class="info v1 tooltip lt">
                                            <div class="popup v1">
                                                <div class="inner">
                                                    <p><?=LNG_FIELD_LINK_CAPTION_INFO;?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div id="ptype_field_picture" style="display:none;">
                            <table class="table-1">
                                <tr>
                                    <td class="txt-wrap">
                                        <label class="lbl-3" id="ptype_field_picture_label_2"><?=LNG_FIELD_PICTURE_URL;?></label>
                                        <label class="lbl-3" id="ptype_field_picture_label_3"><?=LNG_FIELD_IMAGE_URL;?></label>
                                        <label class="lbl-3" id="ptype_field_picture_label_5"><?=LNG_FIELD_VIDEO_URL;?></label>
                                    </td>
                                    <td class="field-wrap" colspan="2">
                                        <div class="input-1 w300 lt<?=$data['schedule_post']['error']['class_allempty'].$data['schedule_post']['error']['class_picture'];?>"><input type="text" id="field_picture" name="field_picture" value="<?=$data['schedule_post']['field_picture'];?>" /></div>
                                        <div class="info v3 lt">
                                            <input type="file" class="ImageFile" name="ImageFile[]" id="file1" multiple />
                                            <input type="file" class="ImageFile" name="ImageFile[]" id="file2" />
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <table class="table-1">
                            <tr>
                                <td colspan="3">
                                    <div class="options cf">
                                        <label class="lbl-3 lt"><?=LNG_START_DATE;?></label>
                                        <div class="input-1 calendar lt<?=$data['schedule_post']['error']['class_date'];?>"><input id="datepicker-1" type="text" name="field_date" value="<?=$data['schedule_post']['field_date'];?>"/></div>
                                        <label class="lbl-3 lt"><?=LNG_SEND_INTERVAL_SECONDS;?></label>
                                        <div class="input-1 w300 lt rsp-sendint" style="width: 50px;">
                                            <input type="text" value="<?=$data['schedule_post']['field_interval'];?>" name="field_interval" />
                                        </div>
                                        <a href="javascript:document.schedulepost.submit();" title="" class="btn rt"><span class="ico publish"><?=LNG_PUBLISH_POST;?></span></a>
                                    </div>
                                    <div class="options cf">
                                        <label class="lbl-4 lt">
                                            <input type="checkbox" name="field_repeat_check" value="1"<?=($data['schedule_post']['field_repeat_check'])? ' checked="checked"':'';?> />
                                            <?=LNG_REPEAT_POST_UNTIL;?>
                                        </label>
                                        <div class="input-1 calendar lt<?=$data['schedule_post']['error']['class_repeat_date'];?>"><input id="datepicker-repeat" type="text" name="field_repeat_date" value="<?=$data['schedule_post']['field_repeat_date'];?>"<?=($data['schedule_post']['field_repeat_check'])? '':' disabled="disabled"';?> /></div>
                                        <label class="lbl-4 lt">
                                            <input type="checkbox" name="field_delete_check" value="1"<?=($data['schedule_post']['field_delete_check'])? ' checked="checked"':'';?> />
                                            <?=LNG_DELETE_POST_AFTER_FINISH;?>
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
<?php
    $list_groups = $this->groupsm->listing_groups();
    if(!empty($list_groups))
    {
?>
                <div class="container">
                    <h2><?=LNG_DEFINED_GROUPS;?></h2>
                    <div class="wrap">
<?php
        foreach($list_groups as $group_account)
        {
?>
                        <div class="toggle-wrap">
                            <div class="heading">
                                <h3><?=$group_account['name'];?> (<?=count($group_account['groups']);?>)</h3>
                                <a href="#" title="" class="toggle"></a>
                            </div>
                            <div class="content cf">
<?php
            foreach($group_account['groups'] as $group)
            {
?>
                                <div class="box">
                                    <input type="checkbox" class="idGroupsv2" name="field_groups[]" value="<?=$group['id'];?>" />
                                    <a href="#" title="" class="img"><img src="<?=$this->link->template_url('content/picture.png');?>" alt=""></a>
                                    <div class="details">
                                        <a class="modal" href="#add-user" onclick="load_frame_group(<?=$group['id'];?>);" target="_blank" title=""><?=$group['name'];?></a>
                                        <p><?=$group['timestamp'];?></p>
                                    </div>
                                </div>
<?php
            }
?>
                            </div>
                        </div>
<?php
        }
?>
                    </div>
                </div>
<?php
    }

    #CONNECT FACEBOOK TO POST FROM FACEBOOK
    if(!$fbaccess['user'])
    {
?>
                <div>
<?php
        if($this->settingss->fapp_valid() == 0)
        {
?>
                    <p class="msg-box"><?=LNG_CONFIGURE_FACEBOOK_APP;?></p>
<?php
        }
            else
        {
            $fb_user_id = $this->general->info('fb_user_id');
?>
                    <p class="msg-box"><?=!empty($fb_user_id)? LNG_LOGIN_WITH_ACCOUNT_ID.' '.$fb_user_id:LNG_LOGIN_WITH_FACEBOOK_ACCOUNT;?>.</p>
<?php
            if(!empty($response) && $response == 'error_fb_user_id')
            {
?>
                    <p class="msg-box error"><?=LNG_LOGIN_WITH_ACCOUNT_ID;?> <?=$fb_user_id;?>. <?=LNG_FACEBOOK_LOGIN_ID;?>: <?=$this->uri->segment(4);?></p>
<?php
            }

            if(isset($_GET['ftester']))
            {
?>
                    <p class="msg-box error"><?=LNG_FACEBOOK_TESTER_INVITE;?></p>
                    <script type="text/javascript">
                        $(document).ready(function(){
                            load_frame_invite();
                            $('#add-user').fadeIn(150);
                            $('#mask').fadeIn(150);
                        });
                    </script>
<?php
            }
?>
                    <div class="fb-login">
                        <a href="<?=$fbaccess['loginUrl'];?>" title=""><img src="<?=$this->link->template_url('content/fb_login.png');?>" width="70" height="22" alt=""></a>
                    </div>
<?php
        }
?>
                </div>
<?php
    }
        else
    {
?>
                <div class="container">
                    <h2><?=LNG_PUBLISH_GROUPS_PAGES;?></h2>
                    <div class="wrap">
                        <div class="filter">
                            <span class="txt"><?=LNG_PUBLISH_POST_TO;?>:</span>
                            <label class="lbl-2"><input type="checkbox" id="groups" name="checkall_groups"><?=LNG_ALL_GROUPS;?></label>
                            <label class="lbl-2"><input type="checkbox" id="pages" name="checkall_pages"><?=LNG_ALL_LIKED_PAGES;?></label>
                            <label class="lbl-2"><input type="checkbox" id="mpages" name="checkall_mpages"><?=LNG_ALL_MANAGED_PAGES;?></label>
                        </div>
<?php
    if(isset($fbaccess['user']) && isset($fbaccess['batch_response']['user_info']['id']))
    {
?>
                        <div class="toggle-wrap">
                            <div class="heading">
                                <h3><?=LNG_PROFILE;?></h3>
                                <a href="#" title="" class="toggle"></a>
                            </div>
                            <div class="content cf">
                                <div class="box">
                                    <input type="checkbox" name="field_pages[]" value="<?=$fbaccess['batch_response']['user_info']['id'].'||'.$this->general->xss_post($fbaccess['batch_response']['user_info']['name']).'||pages||0';?>" />
                                    <a href="http://facebook.com/<?=$fbaccess['batch_response']['user_info']['id'];?>" target="_blank" title="" class="img"><img src="https://graph.facebook.com/<?=$fbaccess['batch_response']['user_info']['id'];?>/picture" width="50" height="50" alt=""></a>
                                    <div class="details">
                                        <a href="http://facebook.com/<?=$fbaccess['batch_response']['user_info']['id'];?>" target="_blank" title="<?=$this->general->xss_post($fbaccess['batch_response']['user_info']['name']);?>"><?=$this->general->strlenchar($fbaccess['batch_response']['user_info']['name'], 28);?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
<?php
    }
?>
                        <div class="toggle-wrap">
                            <div class="heading">
                                <h3><?=LNG_GROUPS;?> (<?=isset($fbaccess['batch_response']['groups']['data'])? count($fbaccess['batch_response']['groups']['data']):0;?>) - <a style="color:#3b59ba;" class="modal" title="" onclick="load_frame_import_groups();$('html,body').scrollTop(0);" href="#add-user"><?=LNG_IMPORT_GROUPS_FILE;?></a></h3>
                                <a href="#" title="" class="toggle"></a>
                            </div>
                            <div class="content cf">
<?php
        if(!isset($fbaccess['batch_response']['groups']['data']))
        {
?>
                               <p><?=LNG_GROUPS_FACEBOOK_ERROR;?></p>
                               <br />
<?php
        }
            elseif(isset($fbaccess['batch_response']['groups']['error']))
        {
?>
                               <p><?=LNG_FACEBOOK_ERROR;?> <?=print_r($fbaccess['batch_response']['groups']['error']);?></p>
                               <br />
<?php
        }
            else
        {
            $fbaccess['batch_response']['groups']['data'] = $this->general->record_sort($fbaccess['batch_response']['groups']['data'], 'name');
            foreach($fbaccess['batch_response']['groups']['data'] as $group)
            {
?>
                                <div class="box">
                                    <input type="checkbox" class="idGroups" name="field_pages[]" value="<?=$group['id'].'||'.$this->general->xss_post(urlencode($group['name'])).'||groups';?>" />
                                    <a href="#" title="" class="img"><img src="https://graph.facebook.com/<?=$group['id'];?>/picture" width="50" height="50" alt=""></a>
                                    <div class="details">
                                        <a href="http://facebook.com/<?=$group['id'];?>" target="_blank" title="<?=$this->general->xss_post($group['name']);?>"><?=$this->general->strlenchar($group['name'], 28);?></a>
                                    </div>
                                </div>
<?php
            }
        }
?>
                            </div>
                        </div>
                        <div class="toggle-wrap">
                            <div class="heading">
                                <h3><?=LNG_LIKED_PAGES;?> (<?=isset($fbaccess['batch_response']['pages']['data'])? count($fbaccess['batch_response']['pages']['data']):0;?>)</h3>
                                <a href="#" title="" class="toggle"></a>
                            </div>
                            <div class="content cf">
<?php
        if(!isset($fbaccess['batch_response']['pages']['data']))
        {
?>
                               <p><?=LNG_PAGES_FACEBOOK_ERROR;?></p>
                               <br />
<?php
        }
            elseif(isset($fbaccess['batch_response']['pages']['error']))
        {
?>
                               <p><?=LNG_FACEBOOK_ERROR;?> <?=print_r($fbaccess['batch_response']['pages']['error']);?></p>
                               <br />
<?php
        }
            else
        {
            $fbaccess['batch_response']['pages']['data'] = $this->general->record_sort($fbaccess['batch_response']['pages']['data'], 'name');
            foreach($fbaccess['batch_response']['pages']['data'] as $page)
            {
?>
                                <div class="box">
                                    <input type="checkbox" class="idPages" name="field_pages[]" value="<?=$page['id'].'||'.$this->general->xss_post($page['name']).'||pages';?>" />
                                    <a href="http://facebook.com/<?=$page['id'];?>" target="_blank" title="" class="img"><img src="https://graph.facebook.com/<?=$page['id'];?>/picture" width="50" height="50" alt=""></a>
                                    <div class="details">
                                        <a href="http://facebook.com/<?=$page['id'];?>" target="_blank" title="<?=$this->general->xss_post($page['name']);?>"><?=$this->general->strlenchar($page['name'], 28);?></a>
                                        <p><?=$page['category'];?></p>
                                    </div>
                                </div>
<?php
            }
        }
?>
                            </div>
                        </div>
                        <div class="toggle-wrap">
                            <div class="heading">
                                <h3><?=LNG_MANAGED_PAGES;?> (<?=isset($fbaccess['batch_response']['mpages']['data'])? count($fbaccess['batch_response']['mpages']['data']):0;?>)</h3>
                                <a href="#" title="" class="toggle"></a>
                            </div>
                            <div class="content cf">
<?php
        if(!isset($fbaccess['batch_response']['mpages']['data']))
        {
?>
                               <p><?=LNG_MANAGED_PAGES_FACEBOOK_ERROR;?></p>
                               <br />
<?php
        }
            elseif(isset($fbaccess['batch_response']['mpages']['error']))
        {
?>
                               <p><?=LNG_FACEBOOK_ERROR;?> <?=print_r($fbaccess['batch_response']['mpages']['error']);?></p>
                               <br />
<?php
        }
            else
        {
            $fbaccess['batch_response']['mpages']['data'] = $this->general->record_sort($fbaccess['batch_response']['mpages']['data'], 'name');
            foreach($fbaccess['batch_response']['mpages']['data'] as $page)
            {
?>
                                <div class="box">
                                    <input type="checkbox" class="idMPages" name="field_pages[]" value="<?=$page['id'].'||'.$this->general->xss_post($page['name']).'||pages||'.$page['access_token'];?>" />
                                    <a href="http://facebook.com/<?=$page['id'];?>" target="_blank" title="" class="img"><img src="https://graph.facebook.com/<?=$page['id'];?>/picture" width="50" height="50" alt=""></a>
                                    <div class="details">
                                        <a href="http://facebook.com/<?=$page['id'];?>" target="_blank" title="<?=$this->general->xss_post($page['name']);?>"><?=$this->general->strlenchar($page['name'], 28);?></a>
                                        <p><?=$page['category'];?></p>
                                    </div>
                                </div>
<?php
            }
        }
?>
                            </div>
                        </div>
                    </div>
                </div>
<?php
    }
?>
            </form>
        </div>
    </div>
