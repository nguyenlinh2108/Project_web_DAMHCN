<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/8/2018
 * Time: 2:05 PM
 */
require_once  __DIR__ . "/includes/header.php";
require_once  __DIR__ .  "/../db/db.php";
$db = db::getInstance();
?>
<div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <h3>Danh sách các loại sản phẩm</h3>
        <a href="add_type_product.php" class="btn btn-primary" style="float: right">Thêm mới</a>
        <table class="table table-hover">
            <thead>
            <tr>
                <td>Mã</td>
                <td>Tên</td>
                <td>Mô tả</td>
                <td>Ảnh</td>
                <td>Edit</td>
                <td>Delete</td>
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
                if ($db->select_one("SELECT count(id) as total FROM type_product")) {
                    $total = $db->getResult()->total;
                    $per_page = ceil(intval($total) / $limit);
                } else {
                    $per_page = 1;
                }
            }
            if ($db->select("SELECT id, name, description, image
                        FROM type_product ORDER BY id ASC LIMIT {$start},{$limit}"))
            {
                foreach ($db->getResult() as $obj)
                {
            ?>
            <tr>
                <td><?php echo $obj->id; ?></td>
                <td><?php echo $obj->name; ?></td>
                <td><?php echo $obj->description; ?></td>
                <td><?php echo $obj->image; ?></td>
                <td><a href="edit_type_product.php?id=<?php echo $obj->id ?>"><img width="16px" src="../public/images/icon_edit.png"></a>
                </td>
                <td><a href="delete_type_product.php?id=<?php echo $obj->id ?>"><img width="16px" src="../public/images/icon_delete.png"></a>
                </td>
            </tr>
            <?php
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once __DIR__ . "/includes/footer.php"; ?>
