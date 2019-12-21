<?php

class Core extends CI_Model {

    var $facebook;
    var $timezones = array(
        '(GMT-12:00) International Date Line West' => 'Pacific/Wake',
        '(GMT-11:00) Midway Island' => 'Pacific/Apia',
        '(GMT-11:00) Samoa' => 'Pacific/Apia',
        '(GMT-10:00) Hawaii' => 'Pacific/Honolulu',
        '(GMT-09:00) Alaska' => 'America/Anchorage',
        '(GMT-08:00) Pacific Time (US &amp; Canada); Tijuana' => 'America/Los_Angeles',
        '(GMT-07:00) Arizona' => 'America/Phoenix',
        '(GMT-07:00) Chihuahua' => 'America/Chihuahua',
        '(GMT-07:00) La Paz' => 'America/Chihuahua',
        '(GMT-07:00) Mazatlan' => 'America/Chihuahua',
        '(GMT-07:00) Mountain Time (US &amp; Canada)' => 'America/Denver',
        '(GMT-06:00) Central America' => 'America/Managua',
        '(GMT-06:00) Central Time (US &amp; Canada)' => 'America/Chicago',
        '(GMT-06:00) Guadalajara' => 'America/Mexico_City',
        '(GMT-06:00) Mexico City' => 'America/Mexico_City',
        '(GMT-06:00) Monterrey' => 'America/Mexico_City',
        '(GMT-06:00) Saskatchewan' => 'America/Regina',
        '(GMT-05:00) Bogota' => 'America/Bogota',
        '(GMT-05:00) Eastern Time (US &amp; Canada)' => 'America/New_York',
        '(GMT-05:00) Indiana (East)' => 'America/Indiana/Indianapolis',
        '(GMT-05:00) Lima' => 'America/Bogota',
        '(GMT-05:00) Quito' => 'America/Bogota',
        '(GMT-04:00) Atlantic Time (Canada)' => 'America/Halifax',
        '(GMT-04:00) Caracas' => 'America/Caracas',
        '(GMT-04:00) La Paz' => 'America/Caracas',
        '(GMT-04:00) Santiago' => 'America/Santiago',
        '(GMT-03:30) Newfoundland' => 'America/St_Johns',
        '(GMT-03:00) Brasilia' => 'America/Sao_Paulo',
        '(GMT-03:00) Buenos Aires' => 'America/Argentina/Buenos_Aires',
        '(GMT-03:00) Georgetown' => 'America/Argentina/Buenos_Aires',
        '(GMT-03:00) Greenland' => 'America/Godthab',
        '(GMT-02:00) Mid-Atlantic' => 'America/Noronha',
        '(GMT-01:00) Azores' => 'Atlantic/Azores',
        '(GMT-01:00) Cape Verde Is.' => 'Atlantic/Cape_Verde',
        '(GMT) Casablanca' => 'Africa/Casablanca',
        '(GMT) Edinburgh' => 'Europe/London',
        '(GMT) Greenwich Mean Time : Dublin' => 'Europe/London',
        '(GMT) Lisbon' => 'Europe/London',
        '(GMT) London' => 'Europe/London',
        '(GMT) Monrovia' => 'Africa/Casablanca',
        '(GMT+01:00) Amsterdam' => 'Europe/Berlin',
        '(GMT+01:00) Belgrade' => 'Europe/Belgrade',
        '(GMT+01:00) Berlin' => 'Europe/Berlin',
        '(GMT+01:00) Bern' => 'Europe/Berlin',
        '(GMT+01:00) Bratislava' => 'Europe/Belgrade',
        '(GMT+01:00) Brussels' => 'Europe/Paris',
        '(GMT+01:00) Budapest' => 'Europe/Belgrade',
        '(GMT+01:00) Copenhagen' => 'Europe/Paris',
        '(GMT+01:00) Ljubljana' => 'Europe/Belgrade',
        '(GMT+01:00) Madrid' => 'Europe/Paris',
        '(GMT+01:00) Paris' => 'Europe/Paris',
        '(GMT+01:00) Prague' => 'Europe/Belgrade',
        '(GMT+01:00) Rome' => 'Europe/Berlin',
        '(GMT+01:00) Sarajevo' => 'Europe/Sarajevo',
        '(GMT+01:00) Skopje' => 'Europe/Sarajevo',
        '(GMT+01:00) Stockholm' => 'Europe/Berlin',
        '(GMT+01:00) Vienna' => 'Europe/Berlin',
        '(GMT+01:00) Warsaw' => 'Europe/Sarajevo',
        '(GMT+01:00) West Central Africa' => 'Africa/Lagos',
        '(GMT+01:00) Zagreb' => 'Europe/Sarajevo',
        '(GMT+02:00) Athens' => 'Europe/Istanbul',
        '(GMT+02:00) Bucharest' => 'Europe/Bucharest',
        '(GMT+02:00) Cairo' => 'Africa/Cairo',
        '(GMT+02:00) Harare' => 'Africa/Johannesburg',
        '(GMT+02:00) Helsinki' => 'Europe/Helsinki',
        '(GMT+02:00) Istanbul' => 'Europe/Istanbul',
        '(GMT+02:00) Jerusalem' => 'Asia/Jerusalem',
        '(GMT+02:00) Kyiv' => 'Europe/Helsinki',
        '(GMT+02:00) Minsk' => 'Europe/Istanbul',
        '(GMT+02:00) Pretoria' => 'Africa/Johannesburg',
        '(GMT+02:00) Riga' => 'Europe/Helsinki',
        '(GMT+02:00) Sofia' => 'Europe/Helsinki',
        '(GMT+02:00) Tallinn' => 'Europe/Helsinki',
        '(GMT+02:00) Vilnius' => 'Europe/Helsinki',
        '(GMT+03:00) Baghdad' => 'Asia/Baghdad',
        '(GMT+03:00) Kuwait' => 'Asia/Riyadh',
        '(GMT+03:00) Moscow' => 'Europe/Moscow',
        '(GMT+03:00) Nairobi' => 'Africa/Nairobi',
        '(GMT+03:00) Riyadh' => 'Asia/Riyadh',
        '(GMT+03:00) St. Petersburg' => 'Europe/Moscow',
        '(GMT+03:00) Volgograd' => 'Europe/Moscow',
        '(GMT+03:30) Tehran' => 'Asia/Tehran',
        '(GMT+04:00) Abu Dhabi' => 'Asia/Muscat',
        '(GMT+04:00) Baku' => 'Asia/Tbilisi',
        '(GMT+04:00) Muscat' => 'Asia/Muscat',
        '(GMT+04:00) Tbilisi' => 'Asia/Tbilisi',
        '(GMT+04:00) Yerevan' => 'Asia/Tbilisi',
        '(GMT+04:30) Kabul' => 'Asia/Kabul',
        '(GMT+05:00) Ekaterinburg' => 'Asia/Yekaterinburg',
        '(GMT+05:00) Islamabad' => 'Asia/Karachi',
        '(GMT+05:00) Karachi' => 'Asia/Karachi',
        '(GMT+05:00) Tashkent' => 'Asia/Karachi',
        '(GMT+05:30) Chennai' => 'Asia/Calcutta',
        '(GMT+05:30) Kolkata' => 'Asia/Calcutta',
        '(GMT+05:30) Mumbai' => 'Asia/Calcutta',
        '(GMT+05:30) New Delhi' => 'Asia/Calcutta',
        '(GMT+05:45) Kathmandu' => 'Asia/Katmandu',
        '(GMT+06:00) Almaty' => 'Asia/Novosibirsk',
        '(GMT+06:00) Astana' => 'Asia/Dhaka',
        '(GMT+06:00) Dhaka' => 'Asia/Dhaka',
        '(GMT+06:00) Novosibirsk' => 'Asia/Novosibirsk',
        '(GMT+06:00) Sri Jayawardenepura' => 'Asia/Colombo',
        '(GMT+06:30) Rangoon' => 'Asia/Rangoon',
        '(GMT+07:00) Bangkok' => 'Asia/Bangkok',
        '(GMT+07:00) Hanoi' => 'Asia/Bangkok',
        '(GMT+07:00) Jakarta' => 'Asia/Bangkok',
        '(GMT+07:00) Krasnoyarsk' => 'Asia/Krasnoyarsk',
        '(GMT+08:00) Beijing' => 'Asia/Hong_Kong',
        '(GMT+08:00) Chongqing' => 'Asia/Hong_Kong',
        '(GMT+08:00) Hong Kong' => 'Asia/Hong_Kong',
        '(GMT+08:00) Irkutsk' => 'Asia/Irkutsk',
        '(GMT+08:00) Kuala Lumpur' => 'Asia/Singapore',
        '(GMT+08:00) Perth' => 'Australia/Perth',
        '(GMT+08:00) Singapore' => 'Asia/Singapore',
        '(GMT+08:00) Taipei' => 'Asia/Taipei',
        '(GMT+08:00) Ulaan Bataar' => 'Asia/Irkutsk',
        '(GMT+08:00) Urumqi' => 'Asia/Hong_Kong',
        '(GMT+09:00) Osaka' => 'Asia/Tokyo',
        '(GMT+09:00) Sapporo' => 'Asia/Tokyo',
        '(GMT+09:00) Seoul' => 'Asia/Seoul',
        '(GMT+09:00) Tokyo' => 'Asia/Tokyo',
        '(GMT+09:00) Yakutsk' => 'Asia/Yakutsk',
        '(GMT+09:30) Adelaide' => 'Australia/Adelaide',
        '(GMT+09:30) Darwin' => 'Australia/Darwin',
        '(GMT+10:00) Brisbane' => 'Australia/Brisbane',
        '(GMT+10:00) Canberra' => 'Australia/Sydney',
        '(GMT+10:00) Guam' => 'Pacific/Guam',
        '(GMT+10:00) Hobart' => 'Australia/Hobart',
        '(GMT+10:00) Melbourne' => 'Australia/Sydney',
        '(GMT+10:00) Port Moresby' => 'Pacific/Guam',
        '(GMT+10:00) Sydney' => 'Australia/Sydney',
        '(GMT+10:00) Vladivostok' => 'Asia/Vladivostok',
        '(GMT+11:00) Magadan' => 'Asia/Magadan',
        '(GMT+11:00) New Caledonia' => 'Asia/Magadan',
        '(GMT+11:00) Solomon Is.' => 'Asia/Magadan',
        '(GMT+12:00) Auckland' => 'Pacific/Auckland',
        '(GMT+12:00) Fiji' => 'Pacific/Fiji',
        '(GMT+12:00) Kamchatka' => 'Pacific/Fiji',
        '(GMT+12:00) Marshall Is.' => 'Pacific/Fiji',
        '(GMT+12:00) Wellington' => 'Pacific/Auckland',
        '(GMT+13:00) Nuku alofa' => 'Pacific/Tongatapu',
    );

    function __construct()
    {
        parent::__construct();
    }

    function timezones($id = NULL)
    {
        $list = array();
        foreach($this->timezones as $key => $value)
        {
            $list[$value] = $key.' - '.mdate("%h:%i %a", $this->timestamp($value));
        }

        return $list;
    }

    function timestamp($gmt_zone = 0)
    {
        if(empty($gmt_zone))
        {
            $qusers = $this->db->query("SELECT gmt_zone FROM users WHERE id='".$this->general->id_user()."' LIMIT 1");
            $gmt_zone = ($qusers->num_rows() > 0)? $qusers->row()->gmt_zone:0;
        }

        $timezone = new DateTimeZone($gmt_zone);
        $offset   = $timezone->getOffset(new DateTime("now"));

        return strtotime(gmdate("M d Y H:i:s", time())) + $offset;
    }

    function human_unix($date, $time)
    {
        if(!empty($date) && !empty($time))
        {
            $date = explode('/', $date);
            if(count($date) == 3)
            {
                return human_to_unix($date[2].'-'.$date[0].'-'.$date[1].' '.$time);
            }
        }

        return 0;
    }

    function human_unix_v2($date)
    {
        return !empty($date)? @strtotime($date):0;
    }

    function date_to_timestamp($datetime = NULL, $delimitator = '/')
    {
        $datetime = explode('@', $datetime);
        $date     = $datetime[0];
        $hours    = 0;
        $minutes  = 0;
        $seconds  = 0;

        if(isset($datetime[1]))
        {
            list($hours, $minutes) = explode(':', $datetime[1]);
        }

        list($month, $day, $year) = explode($delimitator, $date);
        return mktime((int)$hours, (int)$minutes, (int)$seconds, (int)$month, (int)$day, (int)$year);
    }

    function cronjobs($flood_limit = 5)
    {
        require_once(dirname(dirname(__FILE__)).'/libraries/facebook/facebook.php');

        $qcron    = $this->db->query("SELECT lasttime FROM cron LIMIT 1");
        $lasttime = ($qcron->num_rows() > 0)? $qcron->row()->lasttime:0;
        $time     = time();

        if(($time - $lasttime) < (1 * 60)) die("CRON - IN PROGRESS");

        $this->db->query("UPDATE cron SET lasttime='".$time."'");

        $qusers = $this->db->query("SELECT id, gmt_zone FROM users WHERE status='1'");
        if($qusers->num_rows() > 0)
        {
            foreach($qusers->result() as $user)
            {
                # - initialization
                $this->faceboook->settings($user->id);
                $this->config->set_item('facebook_app_id', $this->faceboook->app_id);
                $this->config->set_item('facebook_app_secret', $this->faceboook->app_secret);
                $this->config->set_item('facebook_app_version', $this->faceboook->app_version);
                $this->config->set_item('facebook_call', 1);

                $this->facebook = new Facebook();

                $retry_limit    = $this->faceboook->retry_limit;
                $track_clicks   = $this->faceboook->track_clicks;
                $ap_enabled     = $this->faceboook->ap_enabled;
                $ap_posts_limit = $this->faceboook->ap_posts_limit;
                $ap_posts_time  = $this->faceboook->ap_posts_time;
                $timestamp      = $this->timestamp($user->gmt_zone);

                $qposts = $this->db->query("SELECT posts.id, posts.access_token, posts.type as ptype, posts.message, posts.link, posts.picture, posts.picture_fbid, posts.name, posts.caption, posts.description, posts.cntposts FROM posts WHERE posts.id_users=".$user->id." AND posts.timestamp_pause='' AND posts.status='1' ORDER BY posts.timestamp ASC");

                if($qposts->num_rows() > 0)
                {
                    foreach($qposts->result() as $post)
                    {
                        $flood_limit = rand(3,10);
                        $qjobs = $this->db->query("SELECT cronjobs.id_wall, cronjobs.page_access_token, cronjobs.id as id_cron, cronjobs.type FROM cronjobs WHERE cronjobs.id_post='".$post->id."' AND (cronjobs.status='0' OR cronjobs.status='2') AND cronjobs.retry<'".$retry_limit."' AND cronjobs.timestamp<".$timestamp." ORDER BY cronjobs.id ASC LIMIT ".$flood_limit);

                        if($qjobs->num_rows() > 0)
                        {
                            # - initialization
                            $cntposts  = $post->cntposts;
                            foreach($qjobs->result() as $job)
                            {
                                if($cntposts >= $ap_posts_limit && $ap_enabled == 1)
                                {
                                    $time     = $ap_posts_time * 60;
                                    $cntposts = 0;
                                    $this->db->query("UPDATE cronjobs SET timestamp=timestamp+".$time." WHERE id_post='".$post->id."' AND status!='1'");
                                    break;
                                }

                                $access_token    = !empty($job->page_access_token)? $job->page_access_token:$post->access_token;
                                $appsecret_proof = hash_hmac('sha256', $access_token, $this->faceboook->app_secret);

                                $access_token_exp = explode('###', $access_token);
                                $remove_proof     = false;
                                if(count($access_token_exp) == 2)
                                {
                                    $access_token = $access_token_exp[0];
                                    $remove_proof = $access_token_exp[1];
                                }

                                # - track clicks
                                $post->link = ($track_clicks == 1)? site_url('index.php/cron/redirect/'.url_encode($job->id_cron)):$post->link;

                                # - spintax
                                $post->message     = $this->general->spintax($this->general->xpback($post->message));
                                $post->link        = $this->general->spintax($post->link);
                                $post->picture     = $this->general->spintax($post->picture);
                                $post->name        = $this->general->spintax($this->general->xpback($post->name));
                                $post->caption     = $this->general->spintax($this->general->xpback($post->caption));
                                $post->description = $this->general->spintax($this->general->xpback($post->description));

                                # - trigger
                                $fapi = $this->facebook->build($post, $job, $access_token, $appsecret_proof, $remove_proof);
                                if(isset($fapi['id']))
                                {
                                    $this->db->query("UPDATE cronjobs SET status='1', error_log='', permalink='".$fapi['id']."', timestamp='".$timestamp."' WHERE id='".$job->id_cron."'");
                                }
                                    else if(isset($fapi['error']))
                                {
                                    $this->db->query("UPDATE cronjobs SET retry=retry+1, status='2', error_log='0', timestamp=timestamp+600 WHERE id='".$job->id_cron."'");
                                    $this->db->query("INSERT INTO error_log(id_cron, error) VALUE('".$job->id_cron."', '".$this->general->xss_post($fapi['error'])."');");
                                }
                                    else
                                {
                                    $this->db->query("UPDATE cronjobs SET retry=retry+1, status='2', error_log='0', timestamp=timestamp+600 WHERE id='".$job->id_cron."'");
                                    $this->db->query("INSERT INTO error_log(id_cron, error) VALUE('".$job->id_cron."', '".$this->general->xss_post(print_r($fapi['error'],true))."');");
                                }

                                $cntposts++;
                            }

                            # - update cntposts
                            if($ap_enabled == 1)
                            {
                                $this->db->query("UPDATE posts SET cntposts='".$cntposts."' WHERE id='".$post->id."'");
                            }
                        }
                    }
                }

                # - repeat until date
                $this->schedules->repeat_post_until($user->id, $user->gmt_zone, $this->faceboook->random_time);

                # - delete completed
                $this->schedules->delete_completed($user->id);

                # - pause completed
                $this->schedules->pause_completed($user->id);
            }
        }

        echo 'CRON - DONE'."\n";
    }

    function redirect($id)
    {
        $qjobs = $this->db->query("SELECT posts.link, cronjobs.id FROM posts, cronjobs WHERE posts.id=cronjobs.id_post AND posts.status='1' AND cronjobs.status='1' AND cronjobs.id='".((isset($id) && !empty($id))? (int)url_decode($id):0)."'");

        if($qjobs->num_rows() > 0)
        {
            foreach($qjobs->result() as $post)
            {
                if(!empty($post->link))
                {
                    $this->db->query("UPDATE cronjobs SET clicks=clicks+1 WHERE id='".$post->id."'");
                    header('Location: '.$post->link);
                }
            }
        }
    }

}

?>