<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/11/2018
 * Time: 9:37 PM
 */
require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/../db/db.php";
$db = db::getInstance();

require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/../db/db.php";
$db = db::getInstance();
$gender_array = ['Nam', 'Nữ', 'Khác'];
$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['name'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu tên</p>";
    }
    if (!isset($_POST['email'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu email</p>";
    } else if (!strpos($_POST['email'], "@") || !strpos($_POST['email'], ".")) {//Email phải có ít nhất dấu @ và dấu .
        $message .= "<p class='alert alert-danger message'>Email không hợp lệ</p>";
    }
    if (!isset($_POST['sdt'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu số điện thoại</p>";
    } elseif (!is_numeric($_POST['sdt'])) {
        $message .= "<p class='alert alert-danger message'>Số điện thoại không hợp lệ</p>";
    }
    if (!isset($_POST['noidung'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu nội dung phản hồi</p>";
    }
    if ($message === "") {
        if ($db->insert("contact", [
            "name" => $_POST['name'],
            "email" => $_POST['email'],
            "phone" => $_POST['sdt'],
            "message" => $_POST['noidung'],
        ])) {
            $message .= "<p class='alert alert-success'>Thêm thành công</p>";
            unset($_POST);
        } else $message .= "<p class='alert alert-danger'>Thêm thất bại</p>";
    }
}
?>
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
            <h3>Thêm mới Khách hàng</h3>
            <form id="frm_add" method="POST" name="frm_add" enctype="multipart/form-data">
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
                <div class="form-group">
                    <label>Tên</label>
                    <input type="text" class="form-control"
                           name="name" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>"
                           placeholder="Tên">
                </div>
                <div class="form-group">
                    <label>Giới tính</label>
                    <input type="text" hidden name="gender" value="">
                    <select id="select-status" class="selectpicker show-tick" data-width="auto" title="Chọn giới tính">
                        <?php
                        foreach ($gender_array as $gender) {
                            ?>
                            <option value="<?= $gender ?>" <?php if (isset($_POST['gender']) && $_POST['gender'] === $gender) echo "selected"; ?>><?= ucfirst($gender) ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control"
                           name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"
                           placeholder="Email">
                </div>
                <div class="form-group" id="input-password">
                    <label>Mật khẩu</label>
                    <input type="password" name="password"
                           value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>"
                           class="form-control" placeholder="Mật khẩu">
                </div>
                <div class="form-group" id="input-repassword">
                    <label>Nhập lại mật khẩu</label>
                    <input type="password" name="repassword"
                           value="<?php if (isset($_POST['repassword'])) echo $_POST['repassword']; ?>"
                           class="form-control" placeholder="Nhập lại mật khẩu">
                </div>
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input type="text" class="form-control"
                           name="diachi" value="<?php if (isset($_POST['diachi'])) echo $_POST['diachi']; ?>"
                           placeholder="Địa chỉ">
                </div>
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" class="form-control"
                           name="sdt" value="<?php if (isset($_POST['sdt'])) echo $_POST['sdt']; ?>"
                           placeholder="Số điện thoại">
                </div>
                <div class="form-group">
                    <label>Ngày sinh</label>
                    <input type="text" class="form-control"
                           name="sdt" value="<?php if (isset($_POST['sdt'])) echo $_POST['sdt']; ?>"
                           placeholder="Số điện thoại">
                </div>
                <div id="datepicker" class="input-group date" data-provide="datepicker" data-date-format="dd-mm-yyyy">
                    <input type="text" class="form-control" data-provide="datepicker">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label>Ghi chú</label>
                    <input type="text" class="form-control"
                           name="note" value="<?php if (isset($_POST['note'])) echo $_POST['note']; ?>"
                           placeholder="Ghi chú">
                </div>
                <div class="form-group">
                    <label>Điểm tích lũy</label>
                    <input type="text" class="form-control"
                           name="point" value="<?php if (isset($_POST['point'])) echo $_POST['point']; ?>"
                           placeholder="Điêmt tích lũy">
                </div>
                <input type="submit" name="btnSubmit" class="btn btn-primary" value="Thêm">
                <a href="index.php" class="btn btn-primary">Hủy</a>
            </form>
            <script>
                $(document).ready(function () {

                    //bắt sự kiện click vào nút thêm mới
                    $("#frm_add input[name='btnSubmit']").click(function (event) {
                        event.preventDefault();//ngăn tự động submit form
                        //Nếu các trường input hợp lệ thì submit form
                        if (checkInput()) {
                            $('#frm_add').submit();
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
                    //Duyệt qua tất cả các input của form
                    $("#frm_add .form-group:has(input[type='text'])").each(function () {
                        let input = $(this).find("input[type='text']");//giá trị input
                        let label = $(this).find("label").text();//nhãn nằm trong thẻ label
                        if (typeof input.val() === "string") {//Nếu trường input là string (text)
                            if (input.val() == null || input.val().trim() === "") {//Nếu giá trị input rỗng
                                isValidInput = false;
                                $(this).append("<p class='alert alert-danger message'>Không thể để trống trường " + label + "</p>");
                            } else if (label === "Số điện thoại" && !isUnsignedNumber(input.val())) {
                                //Kiểm tra xem giá trị input có là số không
                                isValidInput = false;
                                $(this).append("<p class='alert alert-danger message'>Bạn phải nhập " + label + " là số.</p>");
                            } else if (label === "Email" && !isValidEmail(input.val())) {
                                //Kiểm tra xem giá trị input có là email hợp lệ không đối với các nhãn Email
                                isValidInput = false;
                                $(this).append("<p class='alert alert-danger message'>Bạn phải nhập " + label + " hợp lệ</p>");
                            }
                        }

                    });

                    //Duyệt trường datepicker
                    let input = $("#datepicker").datepicker('getDate');
                    let label = $("#datepicker").find("label");.text();
                    if($("#datepicker").datepicker('getDate') === null){
                        //Kiểm tra xem giá trị input có là email hợp lệ không đối với các nhãn Email
                        isValidInput = false;
                        $("#datepicker").append("<p class='alert alert-danger message'>Bạn phải nhập " + label + " hợp lệ</p>");
                    }


                    return isValidInput; //đây hả uk chạy đi
                }

                //Hàm kiểm tra xem 1 chuỗi có phải là 1 số không âm không
                function isUnsignedNumber(str) {
                    return /^\d+$/.test(str);
                }

                //Kiểm tra xem 1 chuỗi có phải là 1 địa chỉ email hợp lệ không
                function isValidEmail(email) {
                    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    return re.test(String(email).toLowerCase());
                }
            </script>
        </div>
    </div>
<?php require_once __DIR__ . "/includes/footer.php"; ?>