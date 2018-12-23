<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/18/2018
 * Time: 9:53 AM
 */
ob_start();
require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/../db/db.php";
require_once __DIR__ . "/class/admin.php";
$db = db::getInstance();
if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
    $id = $_GET['id'];
    $admin = new admin($id);
} else {
    header('Location: index.php');
    exit();
}
?>
<div class="row">
    <div class="col-lg-6">
        <h2>Thông tin cá nhân</h2>
        <table class="table table-bordered">
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
            <tr id="avatar_tr">
                <td><label>Avatar</label></td>
                <td>
                    <input id="edit_image_input" type="file" style="display: none;"/>
                    <img src="<?php echo $admin->avatar; ?>"
                         style="min-width: 50px; min-height: 100px; max-width: 200px; max-height: 500px">
                    <div>
                        <a id="edit_avatar" href="#">Chỉnh sửa avatar</a>
                    </div>
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
                <td colspan="2" style="text-align: center"><a class="btn btn-info"
                                                              href="edit_profile_user.php?id=<?php echo $admin->id; ?>">Chỉnh
                        sửa thông tin</a></td>
            </tr>
        </table>

    </div>
</div>

<script>
    $(document).ready(function () {

        //Bắt sự kiện khi input file thay đỗi
        var edit_image_input = $('#edit_image_input');
        edit_image_input.change(function () {
            if (edit_image_input.val() !== "") {
                //Send image to server
                send_image(edit_image_input.prop('files')[0]);
            }
        });

        var edit_image = $('#edit_avatar');
        edit_image.click(function () {
            //Get image from computer
            edit_image_input.trigger('click');
        });

    });

    function send_image(file_data) {
        if (file_data == null) return;

        var type = file_data.type;//lấy ra kiểu file

        //kiểm tra kiểu file
        if (type == null
            || !["image/gif", "image/png", "image/jpg", "image/jpeg"].includes(type.toLowerCase())) {
            alert("Chỉ được upload file ảnh (" + type + ")");
        } else {
            let form_data = new FormData();//khởi tạo đối tượng form data
            form_data.append('img', file_data);//thêm files vào trong form data
            //sử dụng ajax post
            $.ajax({
                url: "ajax/user.php?id=<?= $id ?>&type=edit-image", // gửi đến file product.php
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                complete: function (response) {
                    if (response.status === 200) {
                        if (response.responseJSON.success) {
                            if (response.responseJSON.hasOwnProperty("message")) {
                                $("#avatar_tr img").attr("src", "../public/upload/users/" + response.responseJSON.message);
                            }
                            else alert("Sửa hành công");
                        } else {
                            if (response.responseJSON.hasOwnProperty("message")) alert(response.responseJSON.message);
                            else alert("Sửa thất bại");
                        }
                    } else {
                        if (response.status === 0) {
                            alert("Không thể kết nối tới server");
                        } else {
                            alert("Đã có lỗi xảy ra");
                        }
                    }
                }
            });
        }
    }

</script>
<?php
require_once __DIR__ . "/includes/footer.php";
ob_flush();
?>
