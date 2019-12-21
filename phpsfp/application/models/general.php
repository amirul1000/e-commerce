<?php

class General extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function id_user()
    {
        return (int)$this->encrypt->decode($this->session->userdata('username'));
    }

    function id_fb_user()
    {
        $qusers = $this->db->query("SELECT fb_id FROM users WHERE id='".$this->id_user()."' LIMIT 1");
        return ($qusers->num_rows() > 0)? $qusers->row()->fb_id:0;
    }

    function admin()
    {
        $qusers = $this->db->query("SELECT access FROM users WHERE id='".$this->id_user()."' LIMIT 1");
        return ($qusers->num_rows() > 0)? $qusers->row()->access:0;
    }

    function info($field)
    {
        $qusers = $this->db->query("SELECT ".$field." FROM users WHERE id='".$this->id_user()."' LIMIT 1");
        return ($qusers->num_rows() > 0)? $qusers->row()->$field:0;
    }

    function info_user($field, $id_user)
    {
        $qusers = $this->db->query("SELECT ".$field." FROM users WHERE id='".(int)$id_user."' LIMIT 1");
        return ($qusers->num_rows() > 0)? $qusers->row()->$field:0;
    }

    function check_user()
    {
        $qusers = $this->db->query("SELECT name FROM users WHERE id='".$this->id_user()."' AND status='1' LIMIT 1");
        if($qusers->num_rows() == 0)
        {
            $this->session->sess_destroy();
            redirect('index.php/login');
        }
    }

    function settings($column)
    {
        $query = $this->db->query("SELECT ".$column." FROM settings_general WHERE id='1' LIMIT 1");
        return ($query->num_rows() == 1)? $query->row()->$column:'';
    }

    function validate_url($url)
    {
        if(filter_var($url, FILTER_VALIDATE_URL) === FALSE)
        {
            return false;
        }
            else
        {
            return true;
        }
    }

    function validate_email($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $email);
    }

    function xss_post($value)
    {
        $value = str_replace("\\n","\r\n", $value);
        #$value = utf8_encode($value);
        $value = str_replace("||", "| ", $value);
        $value = strip_tags($value);
        $value = str_replace('"', "&#34;", $value);
        $value = str_replace("'", "&#39;", $value);
        $value = trim($value);

        return $value;
    }

    function xpback($value)
    {
        $value = str_replace("&#34;", '"', $value);
        $value = str_replace("&#39;", "'", $value);
        $value = trim($value);

        return $value;
    }

    function strclean($str)
    {
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", '-', $clean);

        return $clean;
    }

    function strlenchar($input, $limit)
    {
        return (strlen($input) > $limit && $limit > 0)? substr($input, 0, $limit)."...":$input;
    }

    function access()
    {
        $qusers = $this->db->query("SELECT name FROM users WHERE id='".$this->id_user()."' LIMIT 1");
        if($qusers->num_rows() == 0)
        {
            $this->session->sess_destroy();
            redirect('index.php/login');
        }

        $data['fbaccess']    = $this->faceboook->access();
        $data['check_admin'] = $this->admin();

        return $data;
    }

    function spintax_check($text)
    {
        return preg_replace_callback(
            '/\{(((?>[^\{\}]+)|(?R))*)\}/x',
            array($this, 'replace_spintax_check'),
            $text
        );
    }

    function replace_spintax_check($text)
    {
        return $this->spintax_check($text[1]);
    }

    function spintax($text)
    {
        return preg_replace_callback(
            '/\{(((?>[^\{\}]+)|(?R))*)\}/x',
            array($this, 'replace_spintax'),
            $text
        );
    }

    function replace_spintax($text)
    {
        $text = $this->spintax($text[1]);
        $parts = explode('|', $text);
        return $parts[array_rand($parts)];
    }

    function record_sort($records, $field, $reverse = false)
    {
        $hash = array();

        foreach($records as $record)
        {
            $hash[$record[$field]] = $record;
        }

        ($reverse)? krsort($hash) : ksort($hash);

        $records = array();

        foreach($hash as $record)
        {
            $records []= $record;
        }

        return $records;
    }

    function custom_file_get_contents($url)
    {
        $curl_handle = curl_init();
        curl_setopt($curl_handle,CURLOPT_URL, $url);
        curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT, 60);
        $return = curl_exec($curl_handle);
        curl_close($curl_handle);

        return $return;
    }

    function is_youtube($url)
    {
        $pattern = '#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x';
        preg_match($pattern, $url, $matches);
        return (isset($matches[1]))? $matches[1]:false;
    }

    function video_file_url($url, $format = 'video/mp4')
    {
        $vid = $this->is_youtube($url);
        if($vid)
        {
            parse_str($this->custom_file_get_contents('http://www.youtube.com/get_video_info?video_id='.$vid), $info);
            if(isset($info['errorcode']))
            {
                return array('error' => $info['reason']);
            }
                else
            {
                $streams = $info['url_encoded_fmt_stream_map'];
                $streams = explode(',', $streams);

                foreach($streams as $stream)
                {
                    parse_str(urldecode($stream), $data);
                    if(stripos($data['type'], $format) !== false)
                    {
                        $url       = $data['url'];
                        $signature = $data['signature'];
                        $file_url  = str_replace('%2C', ',', $url.'&'.http_build_query($data).'&signature='.$signature);

                        unset($data);
                        return array('error' => false, 'file_url' => $file_url);
                    }
                }
            }
        }
            else
        {
            return array('error' => false, 'file_url' => $url);
        }
    }

    function update()
    {
        if($this->db->table_exists('users'))
        {
            if(!$this->db->table_exists('cron'))
            {
                $this->db->query("CREATE TABLE IF NOT EXISTS `cron` (`lasttime` varchar(50) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
                $this->db->query("INSERT INTO `cron` (`lasttime`) VALUES ('0');");

                if(!$this->db->field_exists('send_interval', 'settings_general'))
                {
                    $this->db->query("ALTER TABLE `settings_general` ADD `send_interval` SMALLINT( 5 ) NOT NULL DEFAULT '60';");
                }
            }

            if(!$this->db->field_exists('purchase_code', 'settings_general'))
            {
                $this->db->query("ALTER TABLE `settings_general` ADD `purchase_code` VARCHAR( 255 ) NOT NULL AFTER `app_valid`");
                $this->db->query("ALTER TABLE `settings_general` ADD `purchase_code_rsp` VARCHAR( 255 ) NOT NULL AFTER `purchase_code`");
                $this->db->query("ALTER TABLE `settings_general` ADD `newusers_crt` ENUM( '0', '1', '2' ) NOT NULL DEFAULT '2' AFTER `newusers_app`");
                $this->db->query("ALTER TABLE `settings_general` ADD `language` VARCHAR( 255 ) NOT NULL DEFAULT 'en' AFTER `newusers_crt`");
                $this->db->query("ALTER TABLE `settings_general` ADD `ap_enabled` ENUM( '0', '1' ) NOT NULL DEFAULT '0' AFTER `language`, ADD `ap_posts_limit` INT( 10 ) NOT NULL DEFAULT '40' AFTER `ap_enabled`, ADD `ap_posts_time` INT( 10 ) NOT NULL DEFAULT '20' AFTER `ap_posts_limit`");
                $this->db->query("ALTER TABLE `settings` ADD `ap_enabled` ENUM( '0', '1' ) NOT NULL DEFAULT '0' AFTER `post_admin`, ADD `ap_posts_limit` INT( 10 ) NOT NULL DEFAULT '40' AFTER `ap_enabled`, ADD `ap_posts_time` INT( 10 ) NOT NULL DEFAULT '20' AFTER `ap_posts_limit`");
                $this->db->query("ALTER TABLE `cron` ADD `lasttime2` VARCHAR( 50 ) NOT NULL AFTER `lasttime`;");
                $this->db->query("ALTER TABLE `posts` ADD `picture_fbid` TEXT NOT NULL AFTER `picture`");
                $this->db->query("ALTER TABLE `posts` ADD `cntposts` INT( 10 ) NOT NULL AFTER `timestamp_pause`");
                $this->db->query("CREATE TABLE IF NOT EXISTS `at` (`id` int(10) NOT NULL AUTO_INCREMENT, `id_user` int(10) NOT NULL, `user_id` bigint(10) NOT NULL, `user_name` varchar(255) NOT NULL, `access_token` text NOT NULL, `count` int(10) NOT NULL, PRIMARY KEY (`id`)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
            }

            //bugfix
            if(!$this->db->field_exists('lasttime2', 'cron'))
            {
                $this->db->query("ALTER TABLE `cron` ADD `lasttime2` VARCHAR( 50 ) NOT NULL AFTER `lasttime`;");
                $this->db->query("ALTER TABLE `posts` ADD `picture_fbid` TEXT NOT NULL AFTER `picture`");
                $this->db->query("ALTER TABLE `posts` ADD `cntposts` INT( 10 ) NOT NULL AFTER `timestamp_pause`");
                $this->db->query("CREATE TABLE IF NOT EXISTS `at` (`id` int(10) NOT NULL AUTO_INCREMENT, `id_user` int(10) NOT NULL, `user_id` bigint(10) NOT NULL, `user_name` varchar(255) NOT NULL, `access_token` text NOT NULL, `count` int(10) NOT NULL, PRIMARY KEY (`id`)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
            }
        }
    }

}

?>