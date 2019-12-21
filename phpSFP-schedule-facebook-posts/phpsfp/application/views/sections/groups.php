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
                <h2><?=LNG_MANAGE_GROUPS;?></h2>
                <div class="wrap">
<?php
    if(!empty($data['groups']))
    {
?>
                    <table class="table-2">
                        <tr class="heading">
                            <td><?=LNG_GROUP_NAME;?></td>
                            <td class="rsp-group-fid"><?=LNG_FACEBOOK_ID;?></td>
                            <td class="rsp-group-fname"><?=LNG_FACEBOOK_NAME;?></td>
                            <td width="120"><?=LNG_DATE;?></td>
<?php
        if(!$fbaccess['user'])
        {
?>
                            <td width="120"><a href="<?=$fbaccess['loginUrl'];?>&redirect_uri=<?=urlencode(site_url('index.php/groups'));?>" onclick="load_frame_group(0);" title="" class="btn rt"><span class="ico user"><?=LNG_ADD_GROUP;?></span></a></td>
<?php
        }
            else
        {
?>
                            <td width="120"><a href="#add-user" onclick="load_frame_group(0);" title="" class="btn rt modal"><span class="ico user"><?=LNG_ADD_GROUP;?></span></a></td>
<?php
        }
?>
                        </tr>
<?php
        foreach($data['groups'] as $group)
        {
?>
                        <tr id="frame_group_<?=$group['id'];?>">
                            <td><?=$group['name'];?></td>
                            <td class="rsp-group-fid"><?=$group['user_id'];?></td>
                            <td class="rsp-group-fname"><?=$group['user_name'];?></td>
                            <td><?=$group['timestamp'];?></td>
                            <td>
                                <ul class="tools rt">
                                    <li><a href="#add-user" onclick="load_frame_group(<?=$group['id'];?>);" title="" class="btn-ico edit modal"></a></li>
                                    <li><a href="javascript:void(0);" onclick="if(confirm('<?=LNG_CONFIRM_GROUP_DELETE;?>')){ delete_group(<?=$group['id'];?>); }" title="" class="btn-ico delete"></a></li>
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
        if($this->settingss->fapp_valid() == 0)
        {
?>
                    <p class="msg-box"><?=LNG_CONFIGURE_FACEBOOK_APP;?></p>
<?php
        }
            else
        {
            if(!$fbaccess['user'])
            {
?>
                    <p><?=LNG_NO_GROUPS_TO_MANAGE_1;?> <a href="<?=$fbaccess['loginUrl'];?>&redirect_uri=<?=urlencode(site_url('index.php/groups'));?>" onclick="load_frame_group(0);" title=""><strong><?=LNG_NO_GROUPS_TO_MANAGE_2;?></strong></a> <?=LNG_NO_GROUPS_TO_MANAGE_3;?></p><br />
<?php
            }
                else
            {
?>
                    <p><?=LNG_NO_GROUPS_TO_MANAGE_1;?> <a href="#add-user" onclick="load_frame_group(0);" title="" class="modal"><strong><?=LNG_NO_GROUPS_TO_MANAGE_2;?></strong></a> <?=LNG_NO_GROUPS_TO_MANAGE_3;?></p><br />
<?php
            }
        }
    }
?>
                </div>
            </div>
        </div>
    </div>
