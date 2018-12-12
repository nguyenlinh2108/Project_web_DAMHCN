<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/12/2018
 * Time: 3:00 PM
 */

require_once __DIR__ . "/../db/db.php";
$db = db::getInstance();
if(isset($_GET['id']) && filter_var($_GET['id'],FILTER_VALIDATE_INT, array('min_range'=>1)))
{
    $id = $_GET['id'];

    $query = "DELETE FROM bill WHERE id={$id}";
    if($db->execute($query))
    {
        header('Location: list_bill.php');
    }else
    {
        require_once __DIR__ . "/includes/header.php";
        echo " <br>";
        ?>
        <h2>Không xóa được vì hóa đơn này vẫn còn tồn tại trong bảng hóa đơn chi tiết</h2>
        <a href="list_bill.php" class="btn btn-primary">Quay lại danh sách hóa đơn</a>
        <?php
        require_once __DIR__ . "/includes/footer.php";
    }
}
else
{
    header('Location: list_bill.php');
}
?>