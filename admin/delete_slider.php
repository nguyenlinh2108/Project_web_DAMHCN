<?php
    require_once __DIR__ . "/../db/db.php";

    $db = db::getInstance();
    if(isset($_GET['id']) && filter_var($_GET['id'],FILTER_VALIDATE_INT, array('min_range'=>1)))
    {
    $id = $_GET['id'];
    $query_a = "SELECT * FROM slide WHERE id={$id}";
    if($db->select_one($query_a)){
    $anhInfo = $db->getResult()->image;
    unlink('../public/upload/slider/'.$anhInfo);
    }
    $query = "DELETE FROM slide WHERE id={$id}";
    $db->execute($query);
    header('Location: list_slider.php');
    }
    else
    {
    header('Location: list_slider.php');
    }
?>