<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/18/2018
 * Time: 9:53 AM
 */
ob_start();
require_once  __DIR__ . "/includes/header.php";
require_once  __DIR__ . "/../db/db.php";
require_once  __DIR__ . "/class/admin.php";
$db = db::getInstance();
if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range'=>1)))
{
    $id = $_GET['id'];
    $admin = new admin($id);
}else{
    header('Location: index.php');
    exit();
}
?>
<div class="row">
    <div class="col-lg-6">
        <h2>Thông tin cá nhân</h2>
        <table class="table table-bordered" >
            <tr>
                <td><label>Tên</label></td>
                <td><?php echo $admin->name; ?></td>
            </tr>
            <tr>
                <td><label>Email</label></td>
                <td><?php echo $admin->email; ?></td>
            </tr>
            <tr>
                <td><label>Giới tính</label></td>
                <td><?php echo $admin->gender; ?></td>
            </tr>
            <tr>
                <td><label>Avatar</label></td>
                <td>
                    <img src="../public/upload/users/<?php echo $admin->avatar; ?>" width="100px">
                    <p><a href="edit_image_user.php?id=<?php echo $admin->id; ?>">Chỉnh sửa avatar</a></p>
                </td>
            </tr>
            <tr>
                <td><label>Số điện thoại</label></td>
                <td><?php echo $admin->phone; ?></td>
            </tr>
            <tr>
                <td><label>Địa chỉ</label></td>
                <td><?php echo $admin->address; ?></td>
            </tr>
            <tr>
                <td><label>Vai trò</label></td>
                <td><?php echo $admin->level; ?></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center"><a class="btn btn-info" href="edit_profile_user.php?id=<?php echo $admin->id; ?>">Chỉnh sửa thông tin</a></td>
            </tr>
        </table>

    </div>
</div>
<?php
require_once __DIR__ . "/includes/footer.php";
ob_flush();
?>
