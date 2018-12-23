<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/23/2018
 * Time: 1:39 AM
 */
session_start();

session_destroy();
session_unset();
header('Location: index.php');
?>
