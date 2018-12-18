<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/15/2018
 * Time: 4:41 PM
 */
session_start();

session_destroy();
session_unset();

header("location: /admin/login.php");
exit;