<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/11/2018
 * Time: 9:37 PM
 */
require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/class/auth.php";
require_once __DIR__ . "/../db/db.php";
$db = db::getInstance();
$gender_array = ['Nam', 'Nữ', 'Khác'];
$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['name'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu tên</p>";
    } else if (strlen($_POST['name']) < 2) {
        $message .= "<p class='alert alert-danger message'>Tên bạn nhập quá ngắn</p>";
    }
    if (!isset($_POST['gender'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu giới tính</p>";
    } else if (!in_array($_POST['gender'], $gender_array)) {
        $message .= "<p class='alert alert-danger message'>Giới tính không hợp lệ</p>";
    }
    if (!isset($_POST['email'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu email</p>";
    } else if (!strpos($_POST['email'], "@") || !strpos($_POST['email'], ".")) {//Email phải có ít nhất dấu @ và dấu .
        $message .= "<p class='alert alert-danger message'>Email không hợp lệ</p>";
    }
    if (!isset($_POST['password'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu mật khẩu</p>";
    } else if (!isset($_POST['repassword'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã chưa nhập lại mật khẩu</p>";
    } else if (strlen($_POST['repassword']) < 3) {
        $message .= "<p class='alert alert-danger message'>Mật khẩu quá ngắn, ít nhất 3 ký tự</p>";
    } else if ($_POST['password'] !== $_POST['repassword']) {
        $message .= "<p class='alert alert-danger message'>Mật khẩu bạn nhập không khớp</p>";
    }
    if (!isset($_POST['address'])) {
        $message .= "<p class='alert alert-danger message'>Bạn chưa nhập địa chỉ</p>";
    }
    if (!isset($_POST['phone'])) {
        $message .= "<p class='alert alert-danger message'>Bạn chưa nhập số điện thoại</p>";
    } else if (!is_numeric($_POST['phone'])) {
        $message .= "<p class='alert alert-danger message'>Số điện thoại không hợp lệ</p>";
    }
    if (!isset($_POST['birthday'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu ngày sinh</p>";
    } else if (DateTime::createFromFormat('d-m-Y', $_POST['birthday']) === FALSE) {
        $message .= "<p class='alert alert-danger message'>Ngày sinh không hợp lệ</p>";
    } else {
        $birthday = DateTime::createFromFormat('d-m-Y', $_POST['birthday']);
        $birthdaySql = $birthday->format("Y/m/d");
    }
    if ($message === "") {
        if ($db->select_one("SELECT * FROM customer WHERE email = '" . db::validSql($_POST['email']) . "'")) {
            $message .= "<p class='alert alert-danger'>Email đã tồn tại.</p>";
        } else if ($db->select_one("SELECT * FROM customer WHERE phone = '" . db::validSql($_POST['phone']) . "'")) {
            $message .= "<p class='alert alert-danger'>Số điện thoại đã tồn tại.</p>";
        } else if ($db->insert("customer", [
            "name" => $_POST['name'],
            "email" => $_POST['email'],
            "gender" => $_POST['gender'],
            "password" => auth::getMD5Password($_POST['password']),
            "address" => $_POST['address'],
            "phone" => $_POST['phone'],
            "birthday" => $birthdaySql,
            "note" => ((isset($_POST['note']) && $_POST['note'] != "") ? $_POST['note'] : null),
        ])) {
            $message .= "<p class='alert alert-success'>Thêm thành công khách hàng " . $_POST['name'] . "</p>";
            unset($_POST);
        } else $message .= "<p class='alert alert-danger'>Thêm thất bại</p>";
    }
}
?>

    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
            <h3>Thêm mới Khách hàng</h3>
            <form id="frm_add" method="POST" name="frm_add">
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
                           name="address" value="<?php if (isset($_POST['address'])) echo $_POST['address']; ?>"
                           placeholder="Địa chỉ">
                </div>
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" class="form-control"
                           name="phone" value="<?php if (isset($_POST['phone'])) echo $_POST['phone']; ?>"
                           placeholder="Số điện thoại">
                </div>
                <div class="form-group" id="ngaysinh">
                    <label>Ngày sinh</label>
                    <div id="datepicker" class="input-group date" data-provide="datepicker"
                         data-date-format="dd-mm-yyyy">
                        <input type="text" class="form-control" name="birthday"
                               value="<?php if (isset($_POST['birthday'])) echo $_POST['birthday'] ?>">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
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
                           placeholder="Điểm tích lũy">
                </div>
                <input type="submit" name="btnSubmit" class="btn btn-primary" value="Thêm mới">
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
                    //Bắt sự kiện khi lựa chọn 1 option trong các trường select
                    $(".selectpicker").change(function () {
                        checkInput();
                    });
                    //Bắt sự kiện khi lựa chọn ngày sinh
                    $("#datepicker").change(function () {
                        checkInput();
                    });
                });
                //Hàm kiểm tra các giá trị đầu vào và hiển thị thông báo lỗi nếu có
                function checkInput() {
                    $(".message").remove(); //Xóa hết tất cả các thông báo trước uk, nhưng  class message không có trong thông báo
                    var isValidInput = true;//biến kiểm tra xem các input có hợp lệ không
                    //Duyệt qua tất cả các input của form
                    $(".form-group:has(input[type='text'])").each(function () {
                        let input = $(this).find("input[type='text']");//giá trị input
                        let label = $(this).find("label").text();//nhãn nằm trong thẻ label
                        if (typeof input.val() === "string") {//Nếu trường input là string (text)
                            if (label === "Ghi chú" || label === "Ngày sinh") {//bỏ qua trường này
                            } else if (input.val() == null || input.val().trim() === "") {//Nếu giá trị input rỗng
                                isValidInput = false;
                                $(this).append("<p class='alert alert-danger message'>Không thể để trống trường " + label + "</p>");
                            } else if ((label === "Số điện thoại" || label === "Điểm tích lũy") && !isUnsignedNumber(input.val())) {
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
                    //Duyệt qua các trường select (có thể chọn giá trị option đó)
                    $(".form-group:has(.selectpicker)").each(function () {
                        $(this).find(".message").remove();//Xóa hết tất cả các thông báo trước
                        let label = $(this).find("label").text();//Nhãn (nằm trong thẻ label)
                        let selectpicker = $(this).find(".selectpicker").selectpicker('val');//Lấy giá trị đang được chọn
                        if (selectpicker === "") {
                            isValidInput = false;
                            $(this).append("<p class='alert alert-danger message'>Bạn chưa chọn " + label + "</p>");
                        } else {
                            $(this).find("input").attr("value", selectpicker);//Truyền vào trường input
                        }
                    });
                    //Kiểm tra mật khẩu và nhập lại mật khẩu
                    let inputPassword = $('#input-password');
                    let pass = inputPassword.find("input").val();//Giá trị password người dùng nhập vào
                    let inputRepassword = $('#input-repassword');
                    let repass = inputRepassword.find("input").val();//Giá trị password nhập lại người dùng nhập vào
                    if (pass === "") {
                        isValidInput = false;
                        inputPassword.append("<p class='alert alert-danger message'>Bạn chưa nhập mật khẩu</p>");
                    } else if (pass.length < 3) {
                        isValidInput = false;
                        inputPassword.append("<p class='alert alert-danger message'>Mật khẩu quá ngắn, ít nhất 3 ký tự</p>");
                    }
                    else if (repass === "") {
                        isValidInput = false;
                        inputRepassword.append("<p class='alert alert-danger message'>Bạn chưa nhập lại mật khẩu</p>");
                    } else if (pass !== repass) {
                        isValidInput = false;
                        inputRepassword.append("<p class='alert alert-danger message'>Mật khẩu nhập lại không khớp</p>");
                    }
                    //Duyệt trường datepicker
                    let input = $("#datepicker").datepicker('getFormattedDate');
                    let label = $("#ngaysinh").find("label").text();
                    $("#ngaysinh input[name='birthday']").val();
                    if (input === "") {
                        //
                        isValidInput = false;
                        $("#ngaysinh").append("<p class='alert alert-danger message'>Không thể để trống trường " + label + "</p>");
                    }
                    return isValidInput;
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
