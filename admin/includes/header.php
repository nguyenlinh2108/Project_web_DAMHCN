<?php
session_start();
require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../class/admin.php";

if (isset($_SESSION['login']['success']) && $_SESSION['login']['success']) {
    $id = $_SESSION['login']['id'];
    $admin = new admin($id);
} else {
    unset($_SESSION['login']);
    header("location:/admin/login.php?continue=" . urlencode(curentUrl()));
}

function curentUrl()
{
    $local_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $local_url = preg_replace("/(\/*)$/", "", $local_url);
    // $local_url = explode("?", $local_url)[0];
    return $local_url;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <link rel="icon" href="./../../public/images/three-pods-shortcut-logo.png" type="image/ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Quản trị hệ thống</title>

    <!-- Bootstrap Core CSS -->
    <link href="./public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="./public/css/sb-admin.css" rel="stylesheet">

    <script src="./public/js/jquery.js"></script>
    <script src="./public/js/bootstrap.min.js"></script>

    <!-- Custom Fonts -->
    <link href="./public/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <!-- bootstrap-select https://developer.snapappointments.com/bootstrap-select/examples/ -->
    <script src="./public/js/bootstrap-select.js"></script>
    <link href="./public/css/bootstrap-select.min.css" rel="stylesheet">

<!--    datepicker-->
    <script src="./public/js/bootstrap-datepicker.js"></script>
    <link href="./public/css/datepicker.css" rel="stylesheet">

    <!-- time ago https://github.com/hustcc/timeago.js -->
    <script src="./public/js/timeago/timeago.min.js"></script>
    <script src="./public/js/timeago/timeago.locales.min.js"></script>

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">QUẢN TRỊ HỆ THỐNG</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">


            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span><img style="border-radius: 50%;overflow: hidden;margin-left: -10px;height: 24px;width: 24px;display: inline;margin: 2px 6px 2px -8px;" src="/public/upload/users/<?= $admin->avatar ?>"></span>
                    <span><?= $admin->name ?></span>
                    <span><b class="caret"></b></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="profile_user.php?id=<?= $admin->id ?>"><i class="fa fa-fw fa-user"></i> Profile</a>
                    </li>
                    <li>
                        <a href="change_pass_user.php?id=<?= $admin->id ?>"><i class="fa fa-fw fa-gear"></i>Đổi mật khẩu</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="log_out_user.php?id=<?= $admin->id ?>"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <?php require_once __DIR__ . "/../includes/slidebar.php"; ?>
        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
