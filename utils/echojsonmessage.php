<?php
/**
 * Created by Long
 * Date: 12/18/2018
 * Time: 8:53 PM
 */

function echo_message($success, $message = null)
{
    $res = ['success' => $success];
    if ($message != null) $res['message'] = $message;
    echo json_encode($res);
    exit();
}

function echo_success($message = null)
{
    echo_message(true, $message);
}

function echo_error($message = null)
{
    echo_message(false, $message);
}