<?php
/**
 * Created by Long
 * Date: 12/15/2018
 * Time: 1:19 PM
 */
function curentUrl()
{
    $local_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $local_url = preg_replace("/(\/*)$/", "", $local_url);
    // $local_url = explode("?", $local_url)[0];
    return $local_url;
}