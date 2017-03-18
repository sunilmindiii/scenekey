<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


if (!function_exists('pass_encrypt')) {

    function pass_encrypt($str) {
        return md5(trim($str));
    }

}


// random number
if (!function_exists('rand_number')) {

    function rand_number() {
        return rand(0, 999999999);
    }

}



if (!function_exists('rand_string')) {

    function rand_string() {
        // ci method
        return random_string('unique');
    }

}


if (!function_exists('getFilePath')) {

    function getFilePath($country_id, $userId) {
        $year = date('Y');
        $month = date('m');
        $prev_path = 'upload_image/' . $country_id . '/' . $userId . '/' . $year . '/' . $month;
        return $prev_path;
    }

}


if (!function_exists('getNewFileName')) {

    function getNewFileName($origFileName) {
        $randnumber = randomString(10);
        $fileExt = array_pop(explode(".", $origFileName));
        return $randnumber . time() . "." . $fileExt;
    }

}


if (!function_exists('randomString')) {

    function randomString($length) {
        return $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }

}
if (!function_exists('Expand_URL')) {

    function Expand_URL($url) {
        $returns = "";
        if (!empty($url)) {
            if (preg_match("/youtu/i", $url) or preg_match("/youtube/i", $url)) {
                if (preg_match("/v=/i", $url))
                    $splits = explode("=", $url);
                else
                    $splits = explode("be/", $url);

                if (!empty($splits[1])) {

                    if (preg_match("/feature/i", $splits[1])) {
                        $splits[1] = str_replace("&feature", "", $splits[1]);
                    }
                    $returns = '<iframe  src="http://www.youtube.com/embed/' . $splits[1] . '" frameborder="0"></iframe>';
                }
            } else if (preg_match("/vimeo/i", $url)) {
                $splits = explode("com/", $url);
                $returns = '<iframe src="http://player.vimeo.com/video/' . $splits[1] . '?title=0&amp;byline=0&amp;portrait=0"  frameborder="0"></iframe>';
            } else if (preg_match("/dailymotion/i", $url)) {
                $splits = explode("video/", $url);
                $splits = explode("_", $splits[1]);
                $returns = '<iframe frameborder="0"  src="http://www.dailymotion.com/embed/video/' . $splits[0] . '"></iframe>';
            } else if (preg_match("/collegehumor/i", $url)) {
                $splits = explode("video/", $url);
                $splits = explode("/", $splits[1]);
                $returns = '<iframe src="http://www.collegehumor.com/e/' . $splits[0] . '" width="410" height="200" frameborder="0"></iframe>';
            } else if (preg_match("/metacafe/i", $url)) {
                $splits = explode("watch/", $url);
                $splits = explode("/", $splits[1]);
                $key = "$splits[0]/$splits[1].swf";
                $returns = '<embed flashVars="playerVars=autoPlay=no" src="http://www.metacafe.com/fplayer/' . $key . '" ></embed>';
            }
        }
        return $returns;
    }

}

