<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/15/2018
 * Time: 2:22 PM
 */
ob_start();
require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/../db/db.php";
require_once __DIR__ . "/class/auth.php";

$db = db::getInstance();

if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
    $id = $_GET['id'];
    if ($db->select_one("SELECT * FROM user WHERE id={$id}")) {
        $name_db = $db->getResult()->name;
        $email_db = $db->getResult()->email;
        $gender_db = $db->getResult()->gender;
        $avatar_db = $db->getResult()->avatar;
        $phone_db = $db->getResult()->phone;
        $address_db = $db->getResult()->address;
        $level_db = $db->getResult()->level;
    } else {
        //Không có bản ghi nào có id như vậy
        header('Location: list_user.php');
        exit();
    }
} else {
    header('Location: list_user.php');
    exit();
}

$level_array = ['Quản trị viên', 'Biên tập viên'];
$gender_array = ['Nam', 'Nữ', 'Khác'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = "";
    if (!isset($_POST['name'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu tên</p>";
    }
    if (!isset($_POST['email'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu email</p>";
    } else if (!strpos($_POST['email'], "@") || !strpos($_POST['email'], ".")) {//Email phải có ít nhất dấu $ và dấu .
        $message .= "<p class='alert alert-danger message'>Email không hợp lệ</p>";
    }
    if (!isset($_POST['gender'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu giới tính</p>";
    } else if (!in_array($_POST['gender'], $gender_array)) {
        $message .= "<p class='alert alert-danger message'>Giới tính không hợp lệ</p>";
    }
    if (!isset($_POST['phone'])) {
        $message .= "<p class='alert alert-danger message'>Bạn chưa nhập số điện thoại</p>";
    } else if (!is_numeric($_POST['phone'])) {
        $message .= "<p class='alert alert-danger message'>Số điện thoại không hợp lệ</p>";
    }
    if (!isset($_POST['address'])) {
        $message .= "<p class='alert alert-danger message'>Bạn chưa nhập địa chỉ</p>";
    }
    if (!isset($_POST['level'])) {
        $message .= "<p class='alert alert-danger message'>Bạn chưa chọn quyền</p>";
    } else if (!in_array($_POST['level'], $level_array)) {
        $message .= "<p class='alert alert-danger message'>Quyền bạn nhập không hợp lệ</p>";
    }

    if ($message === "") {
        if(
            $_POST['name'] === $name_db &&
            $_POST['email'] === $email_db &&
            $_POST['gender'] === $gender_db &&
            $_POST['phone'] === $phone_db &&
            $_POST['address'] === $address_db &&
            $_POST['level'] === $level_db
        ){
            $message = "<p class='alert alert-danger message'>Bạn chưa thay đổi gì</p>";
        }else if($db->update("user",
            [
                "name"=>$_POST['name'],
                "email"=>$_POST['email'],
                "gender"=>$_POST['gender'],
                "phone"=>$_POST['phone'],
                "address"=>$_POST['address'],
                "level"=>$_POST['level'],
            ],
            "id={$id}"))
        {
            $name_db = $_POST['name'];
            $email_db = $_POST['email'];
            $gender_db = $_POST['gender'];
            $phone_db = $_POST['phone'];
            $address_db = $_POST['address'];
            $level_db = $_POST['level'];
            $message = "<p class='alert alert-success message'>Sửa thành công</p>";
        }else{
            $message = "<p class='alert alert-danger message'>Sửa không thành công</p>";
        }
    }
}
?>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" id="my_pad_top">
            <a href="list_user.php" class="btn btn-primary" >Về trang danh sách User</a>
            <a href="index.php" class="btn btn-primary" style="float: right">Về trang chủ</a>
            <form name="frmadd_user" id="frmadd_user" method="POST" enctype="multipart/form-data">
                <?php
                if(isset($message))
                {
                    echo $message;
                }
                ?>
                <h3>Chỉnh sửa User</h3>
                <div class="form-group">
                    <label>Mã</label>
                    <input type="text" name="name" value="<?php if(isset($id)) echo $id; ?>"
                           class="form-control" placeholder="Mã" disabled>
                </div>
                <div class="form-group">
                    <label>Tên</label>
                    <input type="text" name="name" value="<?php if(isset($name_db)) echo $name_db; ?>"
                           class="form-control" placeholder="Tên">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" value="<?php if(isset($email_db)) echo $email_db; ?>"
                           class="form-control" placeholder="Email">
                </div>
                <div class="form-group">
                    <label>Giới tính</label>
                    <input type="text" hidden name="gender" value="">
                    <select id="select-status" class="selectpicker show-tick" data-width="auto" title="Chọn giới tính">
                        <?php
                        foreach ($gender_array as $gender){
                            ?>
                            <option value="<?= $gender ?>" <?php if(isset($gender_db) && $gender_db === $gender) echo "selected"; ?>><?= ucfirst($gender) ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <p>Ảnh đại diện</p>
                    <img src="../public/upload/<?php if(isset($avatar_db)) echo $avatar_db; ?>">
                </div>
               <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" name="phone" value="<?php if(isset($phone_db)) echo $phone_db; ?>"
                           class="form-control" placeholder="Số điện thoại">
                </div>
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input type="text" name="address" value="<?php if(isset($address_db)) echo $address_db; ?>"
                           class="form-control" placeholder="Địa chỉ">
                </div>
                <div class="form-group">
                    <label>Quyền</label>
                    <input type="text" hidden name="level" value="">
                    <select id="select-status" class="selectpicker show-tick" data-width="auto" title="Chọn quyền">
                        <?php
                        foreach ($level_array as $level){
                            ?>
                            <option value="<?= $level ?>" <?php if(isset($level_db) && $level_db === $level) echo "selected"; ?>><?= ucfirst($level) ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

                <input type="submit" name="btnSubmit" class="btn btn-primary" value="Sửa">
            </form>
            <script>
                $(document).ready(function () {

                    //bắt sự kiện click vào nút thêm mới
                    $("#frmadd_user input[name='btnSubmit']").click(function (event) {
                        event.preventDefault();//ngăn tự động submit form
                        //Nếu các trường input hợp lệ thì submit form
                        if (checkInput()) {
                            $('#frmadd_user').submit();
                        }
                    });

                    //Bắt sự kiện khi gõ vào các trường input
                    $("input").keyup(function(){
                        checkInput();
                    });

                    //Bắt sự kiện khi lựa chọn 1 option trong các trường select
                    $( ".selectpicker" ).change(function() {
                        checkInput();
                    });

                    //Bắt sự kiện khi lựa chọn 1 file trong trường input file
                    $( "input[type='file']" ).change(function() {
                        checkInput();
                    });
                });

                //Hàm kiểm tra các giá trị đầu vào và hiển thị thông báo lỗi nếu có
                function checkInput() {
                    $(".message").remove();//Xóa hết tất cả các thông báo trước
                    var isValidInput = true;//biến kiểm tra xem các input có hợp lệ không
                    //Duyệt qua tất cả các input của form
                    $("#frmadd_user .form-group:has(input[type='text'])").not( $(".form-group:has(.selectpicker)")).each(function () {
                        let input = $(this).find("input[type='text']");//Giá trị input
                        let label = $(this).find("label").text();//Nhãn (nằm trong thẻ label)
                        if (typeof input.val() === "string") {//Nếu trường input là string (text)
                            if (input.val() == null || input.val().trim() === "") {//Nếu giá trị input rỗng
                                isValidInput = false;
                                $(this).append("<p class='alert alert-danger message'>Không thể để trống trường " + label + "</p>");
                            } else if (label === "Số điện thoại" && !isUnsignedNumber(input.val())) {
                                //Kiểm tra xem giá trị input có là số không đối với các nhãn Số điện thoại
                                isValidInput = false;
                                $(this).append("<p class='alert alert-danger message'>Bạn phải nhập " + label + " là số</p>");
                            } else if (label === "Email" && !isValidEmail(input.val())) {
                                //Kiểm tra xem giá trị input có là email hợp lệ không đối với các nhãn Email
                                isValidInput = false;
                                $(this).append("<p class='alert alert-danger message'>Bạn phải nhập " + label + " hợp lệ</p>");
                            }
                        }
                    });
                    //Duyệt qua các trường select (có thể chọn giá trị option đó)
                    $("#frmadd_user .form-group:has(.selectpicker)").each(function () {
                        let label = $(this).find("label").text();//Nhãn (nằm trong thẻ label)
                        let selectpicker = $(this).find(".selectpicker").selectpicker('val');//Lấy giá trị đang được chọn
                        if (selectpicker === "") {
                            isValidInput = false;
                            $(this).append("<p class='alert alert-danger message'>Bạn chưa chọn " + label + "</p>");
                        } else {
                            $(this).find("input").attr("value", selectpicker);//Truyền vào trường input
                        }
                    });
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
<?php
require_once __DIR__. "/includes/footer.php";
ob_flush();
?>