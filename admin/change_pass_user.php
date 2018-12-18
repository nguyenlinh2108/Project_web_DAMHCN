<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/18/2018
 * Time: 1:35 PM
 */
ob_start();
require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/../db/db.php";
$db = db::getInstance();
if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT,array('min_range'=>1)))
{
    $id = $_GET['id'];
    if($db->select_one("SELECT * FROM user WHERE id={$id}"))
    {
        $password_db = $db->getResult()->password;
    }
    else{
        header('Location: index.php');
        exit();
    }
}else {
    header('Location: index.php');
    exit();
}
$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['old_password'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu mật khẩu</p>";
    } else if (!isset($_POST['new_password'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã chưa nhập mật khẩu mới</p>";
    } else if (strlen($_POST['new_password']) < 3) {
        $message .= "<p class='alert alert-danger message'>Mật khẩu quá ngắn, ít nhất 3 ký tự</p>";
    } else if ($_POST['new_password'] !== $_POST['re_new_password']) {
        $message .= "<p class='alert alert-danger message'>Mật khẩu bạn nhập không khớp</p>";
    }
    if ($message === "") {
        if ($db->select_one("SELECT * FROM user WHERE password = '" . db::validSql($_POST['new_password']) . "'")) {
            $message .= "<p class='alert alert-danger'>Mật khẩu mới giống mật khẩu cũ.</p>";
        } else if ($db->update('customer',["password"=>$_POST['new_password']],"id={$id}")) {
            $message .= "<p class='alert alert-success'>Thay đổi mật khẩu thành công</p>";
            unset($_POST);
        } else $message .= "<p class='alert alert-danger'>Thay đổi mật khẩu thất bại</p>";
    }
}
?>

<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12" id="my_pad_top">
        <a href="index.php" class="btn btn-primary" style="float: right">Về trang chủ</a>
        <form id="frm_edit" method="POST" name="frm_edit">
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <h3>Đổi mật khẩu</h3>
            <div class="form-group" id="input-old-password">
                <label>Mật khẩu cũ</label>
                <input type="password" name="old_password"
                       value="<?php if (isset($_POST['old_password'])) echo $_POST['old_password']; ?>"
                       class="form-control" placeholder="Mật khẩu cũ">
            </div>
            <div class="form-group" id="input-new-password">
                <label>Mật khẩu mới</label>
                <input type="password" name="new_password"
                       value="<?php if (isset($_POST['new_password'])) echo $_POST['new_password']; ?>"
                       class="form-control" placeholder="Mật khẩu mới">
            </div>
            <div class="form-group" id="input-re-new-password">
                <label>Nhập lại mật khẩu mới</label>
                <input type="password" name="re_new_password"
                       value="<?php if (isset($_POST['re_new_password'])) echo $_POST['re_new_password']; ?>"
                       class="form-control" placeholder="Nhập lại mật khẩu mới">
            </div>
            <input type="submit" name="btnSubmit" class="btn btn-primary" value="Thay đổi">
        </form>
        <script>
            $(document).ready(function () {
                //bắt sự kiện click vào nút thêm mới
                $("#frm_edit input[name='btnSubmit']").click(function (event) {
                    event.preventDefault();//ngăn tự động submit form
                    //Nếu các trường input hợp lệ thì submit form
                    if (checkInput()) {
                        $('#frm_edit').submit();
                    }
                });
                //Bắt sự kiện khi gõ vào các trường input
                $("input").keyup(function () {
                    checkInput();
                });
            });
            //Hàm kiểm tra các giá trị đầu vào và hiển thị thông báo lỗi nếu có
            function checkInput() {
                $(".message").remove(); //Xóa hết tất cả các thông báo trước uk, nhưng  class message không có trong thông báo
                var isValidInput = true;//biến kiểm tra xem các input có hợp lệ không
                //Kiểm tra mật khẩu và nhập lại mật khẩu
                let inputOldPassword = $('#input-old-password');
                let oldpass = inputOldPassword.find("input").val();//Giá trị password người dùng nhập vào

                let inputNewPassword = $('#input-new-password');
                let newpass = inputNewPassword.find("input").val();

                let inputReNewpassword = $('#input-re-new-password');
                let repass = inputReNewpassword.find("input").val();
                if(oldpass === "")
                {
                    isValidInput = false;
                    inputOldPassword.append("<p class='alert alert-danger message'>Bạn chưa nhập mật khẩu cũ</p>");
                }else if(newpass === "")
                {
                    isValidInput = false;
                    inputNewPassword.append("<p class='alert alert-danger message'>Bạn chưa nhập mật khẩu mới</p>");
                }else if(newpass.length < 3)
                {
                    isValidInput = false;
                    inputNewPassword.append("<p class='alert alert-danger message'>Mật khẩu quá ngắn, ít nhất 3 ký tự</p>");
                }else if (repass === "") {
                    isValidInput = false;
                    inputReNewpassword.append("<p class='alert alert-danger message'>Bạn chưa nhập lại mật khẩu</p>");
                } else if (newpass !== repass) {
                    isValidInput = false;
                    inputReNewpassword.append("<p class='alert alert-danger message'>Mật khẩu nhập lại không khớp</p>");
                }
                return isValidInput;
            }
        </script>
    </div>
</div>
<?php
require_once __DIR__ . "/includes/footer.php";
ob_flush();
?>
