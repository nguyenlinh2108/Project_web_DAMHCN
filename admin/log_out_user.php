<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/15/2018
 * Time: 4:41 PM
 */

if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT,array('min_range'=>1)))
{
    $id = $_GET['id'];
    if(isset($_SESSION['login'][$id]))
    {
//
        unset($_SESSION['login']);
        header("location: /admin/login.php");
//        header('Location:/admin/login.php');
    }
}else {
    header('Location: index.php');
    exit();
}

?>