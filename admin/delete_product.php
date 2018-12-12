<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/12/2018
 * Time: 10:23 PM
 */

require_once __DIR__ . "/../db/db.php";

$db = db::getInstance();
if(isset($_GET['id']) && filter_var($_GET['id'],FILTER_VALIDATE_INT, array('min_range'=>1)))
{
    $id = $_GET['id'];
    $query_a = "SELECT * FROM product WHERE id={$id}";
    if($db->select_one($query_a)){
        $anhInfo = $db->getResult()->image;
        unlink('/../public/upload/'.$anhInfo);
    }
    $query = "DELETE FROM product WHERE id={$id}";
    $db->execute($query);
    header('Location: list_product.php');
}
else
{
    header('Location: list_product.php');
}
?>