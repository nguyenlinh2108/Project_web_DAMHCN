<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/8/2018
 * Time: 1:19 PM
 */
require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/../db/db.php";
$db = db::getInstance();
?>
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
        <h3>Danh sách hóa đơn chi tiết</h3>
        <a href="add_bill_detail.php" class="btn btn-primary" style="float: right">Thêm mới</a>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Mã</th>
                <th>Mã hóa đơn</th>
                <th>Mã sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $limit = 10;
            //xác định vị trí bắt đầu:
            if (isset($_GET['s']) && filter_var($_GET['s'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
                $start = $_GET['s'];
            } else {
                $start = 0;
            }
            if (isset($_GET['p']) && filter_var($_GET['p'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
                $per_page = $_GET['p'];
            } else {
                if ($db->select_one("SELECT count(id) as total FROM bill_detail")) {
                    $total = $db->getResult()->total;
                    $per_page = ceil(intval($total) / $limit);
                } else {
                    $per_page = 1;
                }
            }
            if ($db->select("SELECT id, id_bill, id_product, quantity, price
                        FROM bill_detail ORDER BY id ASC LIMIT {$start},{$limit}")) {
                foreach ($db->getResult() as $obj) {
                    ?>
                    <tr>
                        <td><?php echo $obj->id; ?></td>
                        <td><?php echo $obj->id_bill; ?></td>
                        <td><?php echo $obj->id_product; ?></td>
                        <td><?php echo $obj->quantity; ?></td>
                        <td><?php echo $obj->price; ?></td>
                        <td><a href="edit_bill_detail.php?id=<?php echo $obj->id ?>"><img width="16px" src="../public/images/icon_edit.png"></a>
                        </td>
                        <td><a href="delete_bill_detail.php?id=<?php echo $obj->id ?>" onclick="return confirm('Bạn có thực sự muốn xóa không?');"><img width="16px" src="../public/images/icon_delete.png"></a>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
            </tbody>
        </table>
        <?php
        echo "<ul class='pagination'>";
        if($per_page > 1)
        {
            $current_page=($start/$limit)+1;
            //nếu không phải trang đầu tiên thì hiển thị trang trước
            if($current_page != 1)
            {
                echo "<li><a href='list_bill.php?s=".($start - $limit)."&p={$per_page}'>Back</a></li>";
            }
            //hiển thị những phần còn lại của trang
            for($i=1; $i <= $per_page; $i++)
            {
                if($i != $current_page)
                {
                    echo "<li><a href='list_bill.php?s=".($limit*($i - 1))."&p={$per_page}'>{$i}</a></li>";
                }
                else
                {
                    echo "<li class='active'><a>{$i}</a></li>";
                }
            }
            //nếu không phải trang cuối cùng thì hiển thị mút next
            if($current_page != $per_page)
            {
                echo "<li><a href='list_bill.php?s=".($start + $limit)."&p={$per_page}'>Next</a></li>";
            }
        }
        echo "</ul>";
        ?>
    </div>
</div>
