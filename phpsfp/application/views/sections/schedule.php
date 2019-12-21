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
                <h2><?=!empty($data['by_user'])? LNG_QUEUE_SCHEDULES_BY.' '.$data['by_user']:LNG_QUEUE_SCHEDULES;?> (<?=$data['records'];?>)</h2>
                <div class="wrap">
                    <div class="filter v2 cf">
<?php
    $current_time = $this->core->timestamp();
    $filter_date  = $this->schedules->filter_date($data['filter_date']);
?>
                        <span class="txt lt"><?=LNG_SHOW;?></span>
                        <label class="lbl-2 lt"><input type="radio" id="js_all_queues" value="0" name="radio_queue"<?=empty($data['filter_date'])? ' checked="checked"':'';?>><?=LNG_ALL_QUEUES;?></label>
                        <label class="lbl-2 lt"><input type="radio" id="js_interval_queues" value="1" name="radio_queue"<?=!empty($data['filter_date'])? ' checked="checked"':'';?>><?=LNG_QUEUES_BETWEEN;?></label>
                        <div class="field-wrap rsp-field-wrap lt">
                            <div class="input-1 calendar lt"><input id="datepicker-2" type="text" value="<?=!empty($filter_date['start'])? $filter_date['start']:mdate('%m/%d/%Y', $current_time);?>" /></div>
                            <span class="dash lt">-</span>
                            <div class="input-1 calendar lt"><input id="datepicker-3" type="text" value="<?=!empty($filter_date['end'])? $filter_date['end']:mdate('%m/%d/%Y', $current_time);?>" /></div>
                        </div>
                        <a href="javascript:void(0);" onclick="filter();" title="" class="btn rt"><span class="ico refresh"><?=LNG_FILTER;?></span></a>
                    </div>
<?php
    foreach($data['schedules'] as $post)
    {
?>
                    <div class="toggle-wrap" id="frame<?=$post['id'];?>">
                        <div class="heading">
                            <div class="queue">
                                <p class="txt"><?=$post['fbuser_name'];?> <?=LNG_FROM;?> <?=$post['date'];?></p>
                                <ul class="tools">
                                    <li>
                                        <a href="javascript:void(0);" onclick="token_etime(<?=$post['id'];?>);" class="btn-ico info tooltip lt">
                                            <div class="popup v2">
                                                <div class="inner">
                                                    <p><?=LNG_TOKEN_EXPIRE_TIME;?> <strong id="token<?=$post['id'];?>"><?=LNG_TOKEN_EXPIRE_TIME_CLICK;?></strong></p>
                                                    <p><?=LNG_PLATFORM_USER;?> <strong><?=$post['user_name'];?></strong></p>
                                                    <p><?=LNG_START_DATE;?>: <?=$post['date'];?><br /><?=LNG_ESTIMATED_END_DATE;?> <?=$post['date_end'];?></p>
                                                    <p><?=LNG_POSTED;?> <?=$post['posted'];?></p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <!--
                                    <li>
                                        <a href="#preview_post" class="btn-ico info preview modal lt" onclick="preview_post(<?=$post['id'];?>);">
                                            <div class="popup v2">
                                                <div class="inner">
                                                    <p>Preview the scheduled post</p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    -->
                                    <li>
                                        <div class="btn-ico graph tooltip lt">
                                            <div class="popup v2">
                                                <div class="inner">
                                                    <p><?=LNG_TOTAL_CLICKS_ON_LINK;?> <strong><?=$post['clicks'];?></strong></p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li><a class="btn-ico edit modal" title="" onclick="load_frame_schedule(<?=$post['id'];?>);" href="#edit-post"></a></li>
                                    <li><a class="btn-ico schedule modal" title="<?=LNG_RESCHEDULE;?>" onclick="load_frame_repeatpost(<?=$post['id'];?>);" href="#edit-post"></a></li>
                                    <li>
                                        <span id="loader-fpause-<?=$post['id'];?>" class="loader" style="display:none;"></span>
                                        <a href="javascript:void(0);" onclick="pause_post(<?=$post['id'];?>);" id="button-fpause-<?=$post['id'];?>" class="btn-ico <?=$post['pause'];?> tooltip lt">
                                            <div class="popup v2">
                                                <div class="inner">
                                                    <p><?=LNG_PAUSE_RESUME_SCHEDULED_POST;?></p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li><a href="javascript:void(0);" onclick="if(confirm('<?=LNG_CONFIRM_QUEUE_DELETE;?>')){delete_post(<?=$post['id'];?>); }" title="" class="btn-ico delete"></a></li>
                                </ul>
                            </div>
                            <a href="#" title="" class="toggle"></a>
                        </div>
                        <div class="content v2 cf">
<?php
        if(count($post['jobs']) > 10)
        {
?>
                            <div class="scroller">
<?php
        }

        foreach($post['jobs'] as $job)
        {
?>
                                <div class="group" id="frame_group<?=$job['id'];?>">
                                    <p class="txt"><a style="color: #333333;" href="https://facebook.com/<?=$job['id_wall'];?>" target="_blank" title="<?=LNG_CLICK_TO_VIEW_PAGE_GROUP;?>"><?=$job['name'];?></a></p>
                                    <ul class="tools">
                                        <li>
<?php
            if($job['error'] != '')
            {
?>
                                            <div class="btn-ico error tooltip lt">
                                                <div class="popup v2">
                                                    <div class="inner">
                                                        <a class="modal" href="#cron-error" onclick="cron_errorlog(<?=$job['id'];?>);" style="color:#FFF;">
                                                            <?=LNG_ERROR_ON_POST;?> <?=$job['date'];?>
                                                            <br />
                                                            <strong><?=LNG_CLICK_FOR_DETAILS;?></strong>
                                                            <br />
                                                            <br />
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
<?php
            }
                else
            {
?>
                                            <a class="btn-ico <?=($job['posted'] == 1)? 'ok':'warning';?> tooltip lt" href="<?=$job['permalink'];?>"<?=($job['posted'] == 1)? ' target="_blank"':'';?>>
                                                <div class="popup v2">
                                                    <div class="inner">
                                                        <p><?=($job['posted'] == 1)? LNG_POSTED_ON:LNG_ESTIMATED_POST_TIME;?>: <?=$job['date'];?><?=($job['posted'] == 1)? '<br/>'.LNG_CLICK_TO_GO_TO_POST:'';?></p>
                                                    </div>
                                                </div>
                                            </a>
<?php
            }
?>
                                        </li>
                                        <li>
                                            <div class="btn-ico graph tooltip lt">
                                                <div class="popup v2">
                                                    <div class="inner">
                                                        <p><?=LNG_CLICKS_ON_LINK;?> <strong><?=$job['clicks'];?></strong></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li><a href="javascript:void(0);" onclick="if(confirm('<?=LNG_CONFIRM_QUEUE_JOB_DELETE;?>')){delete_job(<?=$post['id'];?>, <?=$job['id'];?>);}" title="" class="btn-ico delete"></a></li>
                                    </ul>
                                </div>
<?php
        }

        if(count($post['jobs']) > 10)
        {
?>
                            </div>
<?php
        }
?>
                        </div>
                    </div>
<?php
    }
?>
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
                </div>
            </div>
        </div>
    </div>
