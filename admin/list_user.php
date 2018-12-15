<?php
    include "includes/header.php";
?>
<?php require_once  __DIR__ . "/../db/db.php"; ?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h3>Danh sách quản trị viên</h3>
        <a href="add_user.php" class="btn btn-primary" style="float: right">Thêm mới</a>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Mã</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Giới tính</th>
                <th>Avartar</th>
                <th>Password</th>
                <th>Phone</th>
                <th>Địa chỉ</th>
                <th>Level</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $db = db::getInstance();
            //đặt số bản ghi cần thiết:
            $limit = 20;
            //xác định vị trí bắt đầu:
            if(isset($_GET['s']) && filter_var($_GET['s'], FILTER_VALIDATE_INT, array('min_range'=>1)))
            {
                $start=$_GET['s'];
            }
            else
            {
                $start = 0;
            }
            if(isset($_GET['p']) && filter_var($_GET['p'], FILTER_VALIDATE_INT, array('min_range'=>1)))
            {
                $per_page=$_GET['p'];
            }
            else
            {
                if($db->select_one("SELECT count(id) FROM user"))
                {
                    $total = $db->getResult()->{'count(id)'};
                    $per_page = ceil (intval($total)/$limit);
                }
                else
                {
                    $per_page = 1;
                }
            }
            $query="SELECT id, name, email, gender, avatar, password, phone, address, level
                        FROM user ORDER BY id ASC LIMIT {$start},{$limit}"; //n,m: n: số bản ghi đc lấy ra, m:tổng số bản ghi được lấy ra
            if($db->select($query))
            {
                foreach ($db->getResult() as $obj)
                {
                    ?>
                    <tr>
                        <td><?php echo $obj->id; ?></td>
                        <td><?php echo $obj->name; ?></td>
                        <td><?php echo $obj->email; ?></td>
                        <td><?php echo $obj->gender; ?></td>
                        <td>
                            <a href="edit_image_user.php?id=<?php echo $obj->id; ?>">
                                <img src="../public/upload/users/<?php echo $obj->avatar; ?>" width="100px">
                                Edit image
                            </a>
                        </td>
                        <td><?php echo $obj->password; ?></td>
                        <td><?php echo $obj->phone; ?></td>
                        <td><?php echo $obj->address; ?></td>
                        <td><?php echo $obj->level; ?></td>
                        <td><a href="edit_user.php?id=<?php echo $obj->id; ?>"><img width="16px" src="../public/images/icon_edit.png"></a></td>
                        <td><a href="delete_user.php?id=<?php echo $obj->id; ?>" onclick="return confirm('Bạn có thực sự muốn xóa không?')"><img width="16px" src="../public/images/icon_delete.png"></a></td>
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
                echo "<li><a href='list_user.php?s=".($start - $limit)."&p={$per_page}'>Back</a></li>";
            }
            //hiển thị những phần còn lại của trang
            for($i=1; $i <= $per_page; $i++)
            {
                if($i != $current_page)
                {
                    echo "<li><a href='list_user.php?s=".($limit*($i - 1))."&p={$per_page}'>{$i}</a></li>";
                }
                else
                {
                    echo "<li class='active'><a>{$i}</a></li>";
                }
            }
            //nếu không phải trang cuối cùng thì hiển thị mút next
            if($current_page != $per_page)
            {
                echo "<li><a href='list_user.php?s=".($start + $limit)."&p={$per_page}'>Next</a></li>";
            }
        }
        echo "</ul>";
        ?>
    </div>
</div>
<?php include "includes/footer.php"?>