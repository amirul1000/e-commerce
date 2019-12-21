<?php

class Upload extends CI_Model {

    var $path = 'content/upload';

    function __construct()
    {
        parent::__construct();
    }

    private function filelimit()
    {
        $this->faceboook->settings();
        return $this->faceboook->upload_limit * (1024 * 1024);
    }

    public function check($inputFile, $image = true)
    {
        $count_files = count($_FILES[$inputFile]['name']);
        if($count_files > 3)
        {
            return @LNG_LIMIT_IMAGE_MAX_FILES;
        }
        for($i = 0; $i < $count_files; $i++)
        {
            if(isset($_FILES[$inputFile]['size'][$i]) && $_FILES[$inputFile]['size'][$i] > $this->filelimit())
            {
                return (str_replace("#limit#", round($this->filelimit() / (1024 * 1024)), LNG_LIMIT_IMAGE_VIDEO_IS." #limit#MB."));
            }
                else if($image && !in_array($_FILES[$inputFile]['type'][$i], array('image/gif', 'image/jpeg', 'image/jpg', 'image/pjpeg', 'image/x-png', 'image/png', 'video/mp4', 'application/octet-stream')))
            {
                return LNG_INVALID_IMAGE_VIDEO;
            }
        }

        return false;
    }

    public function file($inputFile, $nofilelimit = false)
    {
        $path        = $this->path;
        $count_files = isset($_FILES[$inputFile]['name'])? count($_FILES[$inputFile]['name']):0;
        $files       = array();

        if(!file_exists($path)) mkdir($path, 0777, true); else @chmod($path, 0777);

        for($i = 0; $i < $count_files; $i++)
        {
            $filename  = basename($_FILES[$inputFile]['name'][$i]);
            $pathinfo  = pathinfo($filename);
            $file      = $this->general->strclean($pathinfo['filename'].random_string('alnum', 8)).'.'.$pathinfo['extension'];
            $load_file = $path . '/' . $file;

            if($_FILES[$inputFile]['size'][$i] <= $this->filelimit() || $nofilelimit == true)
            {
                if(@move_uploaded_file($_FILES[$inputFile]['tmp_name'][$i], $load_file))
                {
                    $files[] = $file;
                }
            }
        }

        return $files;
    }

}

?>