<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



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




