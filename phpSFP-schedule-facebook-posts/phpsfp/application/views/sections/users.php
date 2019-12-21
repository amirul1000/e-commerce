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
            <div class="container">
                <h2><?=LNG_MANAGE_USERS;?> (<?=$data['records'];?>)</h2>
                <div class="wrap">
                    <div class="filter v2 cf">
                        <span class="txt lt"><?=LNG_SEARCH_BY_NAME_USERNAME;?>&nbsp;</span>
                        <div class="field-wrap lt">
                            <div class="input-1 lt"><input id="js_search_user" type="text" value="<?=isset($_GET['user'])? $this->general->xss_post($_GET['user']):'';?>" /></div>
                        </div>
                        <span class="txt lt">&nbsp;<?=LNG_SHOW;?></span>
                        <label class="lbl-2 lt"><input type="radio" id="js_all_users" value="all" name="radio_users"<?=($data['status'] == 'all')? ' checked="checked"':'';?>><?=LNG_ALL_USERS;?></label>
                        <label class="lbl-2 lt"><input type="radio" id="js_active_users" value="active" name="radio_users"<?=($data['status'] == 'active')? ' checked="checked"':'';?>><?=LNG_ACTIVE;?></label>
                        <label class="lbl-2 lt"><input type="radio" id="js_disabled_users" value="inactive" name="radio_users"<?=($data['status'] == 'inactive')? ' checked="checked"':'';?>><?=LNG_INACTIVE;?></label>
                        <a href="javascript:void(0);" onclick="filter_users();" title="" class="btn rt"><span class="ico refresh"><?=LNG_FILTER;?></span></a>
                    </div>
<?php
    if(!empty($data['users']))
    {
?>
                    <table class="table-2">
                        <tr class="heading">
                            <td><?=LNG_NAME;?></td>
                            <td><?=LNG_USERNAME;?></td>
                            <td width="120" class="rsp-user-date"><?=LNG_DATE;?></td>
                            <td width="120" class="rsp-user-last"><?=LNG_LAST_LOGIN;?></td>
                            <td width="30"><?=LNG_STATUS;?></td>
                            <td width="120"><a href="#add-user" onclick="load_frame_user(0);" title="" class="btn rt modal"><span class="ico user"><?=LNG_ADD_USER;?></span></a></td>
                        </tr>
<?php
        foreach($data['users'] as $user)
        {
?>
                        <tr id="frame_user_<?=$user['id'];?>">
                            <td><a style="color:#333333;" href="mailto:<?=$user['email'];?>"><strong><?=$user['name'];?></strong></a></td>
                            <td><?=$user['username'];?></td>
                            <td class="rsp-user-date"><?=$user['timestamp'];?></td>
                            <td class="rsp-user-last"><?=$user['timestamp_login'];?></td>
                            <td>
<?php
            if($user['id'] != 1)
            {
?>
                                <div id="user-status-loader-<?=$user['id'];?>" style="display:none;"><img src="<?=$this->link->template_url('img/ajax-loader-16.gif');?>" width="16" height="16" /></div>
                                <div id="user-status-active-<?=$user['id'];?>" style="cursor:pointer;display:<?=($user['status'])? 'block':'none';?>;"><img src="<?=$this->link->template_url('img/active.png');?>" width="16" height="16" title="<?=LNG_DISABLE_USER;?>" onclick="status_user(<?=$user['id'];?>);" /></div>
                                <div id="user-status-inactive-<?=$user['id'];?>" style="cursor:pointer;display:<?=($user['status'])? 'none':'block';?>;"><img src="<?=$this->link->template_url('img/inactive.png');?>" width="16" height="16" title="<?=LNG_ENABLE_USER;?>" onclick="status_user(<?=$user['id'];?>);" /></div>
<?php
            }
                else
            {
?>
                                <img src="<?=$this->link->template_url('img/idle.png');?>" width="16" height="16" title="" />
<?php
            }
?>
                            </td>
                            <td>
                                <ul class="tools rt">
                                    <li><a href="<?=site_url('index.php/schedule?user='.$user['id']);?>" title="<?=LNG_USER_VIEW_SCHEDULED_POSTS;?>" class="btn-ico schedule"></a></li>
                                    <li><a href="#add-user" onclick="load_frame_user(<?=$user['id'];?>);" title="" class="btn-ico edit modal"></a></li>
<?php
            if($user['id'] != 1)
            {
?>
                                    <li><a href="javascript:void(0);" onclick="if(confirm('<?=LNG_CONFIRM_USER_DELETE;?>')){ delete_user(<?=$user['id'];?>); }" title="" class="btn-ico delete"></a></li>
<?php
            }
?>
                                </ul>
                            </td>
                        </tr>
<?php
        }
?>
                    </table>
                    <div class="nav">
<?php
        if(!empty($data['pagination']))
        {
?>
                        <ul class="pages">
<?php
            if(!empty($data['pagination']['link_prev']))
            {
?>
                            <li><a href="<?=$data['pagination']['link_prev'];?>" title="" class="pag prev"></a></li>
<?php
            }

            foreach ($data['pagination']['pages'] as $page)
            {
?>
                            <li><a href="<?=$page['link']?>"<?=($page['selected'] == 1)? ' class="active"':'';?>><?=$page['id'];?></a></li>
<?php
            }

            if(isset($data['pagination']['last_page']))
            {
?>
                            <li>...</li>
                            <li><a href="<?=$data['pagination']['last_page'];?>"><?=$data['pagination']['nr_pagini'];?></a></li>
<?php
            }

            if(!empty($data['pagination']['link_next']))
            {
?>
                            <li><a href="<?=$data['pagination']['link_next'];?>" title="" class="pag next"></a></li>
<?php
            }
?>
                        </ul>
<?php
        }
?>
                    </div>
<?php
    }
        else
    {
?>
                    <p><?=LNG_NO_USER_TO_MANAGE;?></p><br />
<?php
    }
?>
                </div>
            </div>
        </div>
    </div>
