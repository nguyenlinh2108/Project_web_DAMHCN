<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/12/2018
 * Time: 8:27 PM
 */

require_once __DIR__ . "/../db/db.php";
$db = db::getInstance();
if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range'=>1)))
{
    $id = $_GET['id'];
    $query = "DELETE FROM bill_detail WHERE id={$id}";
    if($db->execute($query)){
        header('Location: list_bill_detail.php');
    }else{
        echo "Không xóa được";
    }
}else{
    header('Location: list_bill_detail.php');
}