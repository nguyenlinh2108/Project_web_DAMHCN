<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/14/2018
 * Time: 9:43 PM
 */

require_once __DIR__ . "/../db/db.php";

$db = db::getInstance();
if(isset($_GET['id']) && filter_var($_GET['id'],FILTER_VALIDATE_INT, array('min_range'=>1)))
{
    $id = $_GET['id'];
    $query = "DELETE FROM unit WHERE id={$id}";
    $db->execute($query);
    header('Location: list_unit.php');
}
else
{
    header('Location: list_unit.php');
}
?>