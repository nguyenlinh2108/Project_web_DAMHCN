<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/12/2018
 * Time: 10:14 PM
 */

ob_start();
require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/class/auth.php";
require_once __DIR__ . "/../db/db.php";
$db = db::getInstance();
$gender_array = ['Nam', 'Nữ', 'Khác'];
$message = "";

if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT,array('min_range'=>1)))
{
    $id = $_GET['id'];
    if($db->select_one("SELECT * FROM customer WHERE id={$id}"))
    {
        $name_db = $db->getResult()->name;
        $gender_db = $db->getResult()->gender;
        $email_db = $db->getResult()->email;
        $address_db = $db->getResult()->address;
        $phone_db = $db->getResult()->phone;
        $birthday_db = $db->getResult()->birthday;
        $note_db = $db->getResult()->note;
        $point_db = $db->getResult()->point;
    }
    else{
        header('Location: list_customer.php');
        exit();
    }
}else {
    header('Location: list_customer.php');
    exit();
}

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
        if(
                $_POST['name'] === $name_db &&
                $_POST['gender'] === $gender_db &&
                $_POST['email'] === $email_db &&
                $_POST['address'] === $address_db &&
                $_POST['phone'] === $phone_db &&
                $_POST['birthday'] === $birthday_db &&
                $_POST['note'] === $note_db &&
                $_POST['point'] === $point_db
        )
        {
            $message = "<p class='alert alert-danger message'>Bạn chưa thay đổi gì</p>";
        } else if($db->update('customer',
            [
                "name"=>$_POST['name'],
                "gender"=>$_POST['gender'],
                "email"=>$_POST['email'],
                "address"=>$_POST['address'],
                "phone"=>$_POST['phone'],
                "birthday"=>$birthdaySql,
                "note"=>$_POST['note'],
                "point"=>$_POST['point'],
            ],
            "id={$id}"))
        {
            $name_db = $_POST['name'];
            $gender_db = $_POST['gender'];
            $email_db = $_POST['email'];
            $address_db = $_POST['address'];
            $phone_db = $_POST['phone'];
            $birthday_db = $_POST['birthday'];
            $note_db = $_POST['note'];
            $point_db = $_POST['point'];
            $message = "<p class='alert alert-success message'>Sửa thành công</p>";
        }else{
            $message = "<p class='alert alert-danger message'>Sửa không thành công</p>";
        }
    }
}
?>

    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12" id="my_pad_top">
            <a href="list_customer.php" class="btn btn-primary">Về trang danh sách khách hàng</a>
            <a href="index.php" class="btn btn-primary" style="float: right">Về trang chủ</a>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <h3>Sửa khách hàng</h3>
            <form id="frm_add" method="POST" name="frm_add">
                <div class="form-group">
                    <label>Tên</label>
                    <input type="text" class="form-control"
                           name="name" value="<?php if ($name_db) echo $name_db; ?>"
                           placeholder="Tên">
                </div>
                <div class="form-group">
                    <label>Giới tính</label>
                    <input type="text" hidden name="gender" value="">
                    <select id="select-status" class="selectpicker show-tick" data-width="auto" title="Chọn giới tính">
                        <?php
                        foreach ($gender_array as $gender) {
                            ?>
                            <option value="<?= $gender ?>" <?php if (isset($gender_db) && $gender_db === $gender) echo "selected"; ?>><?= ucfirst($gender) ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control"
                           name="email" value="<?php if (isset($email_db)) echo $email_db; ?>"
                           placeholder="Email">
                </div>
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input type="text" class="form-control"
                           name="address" value="<?php if (isset($address_db)) echo $address_db; ?>"
                           placeholder="Địa chỉ">
                </div>
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" class="form-control"
                           name="phone" value="<?php if (isset($phone_db)) echo $phone_db; ?>"
                           placeholder="Số điện thoại">
                </div>
                <div class="form-group" id="ngaysinh">
                    <label>Ngày sinh</label>
                    <div id="datepicker" class="input-group date" data-provide="datepicker"
                         data-date-format="dd-mm-yyyy">
                        <input type="text" class="form-control" name="birthday"
                               value="<?php
                               if (isset($birthday_db)) {
                                   //Convert ngày sinh dạng Năm-Tháng-Ngày trong database sang dạng Ngày-Tháng-Năm
                                   $birthday = DateTime::createFromFormat('Y-m-d', $birthday_db);
                                   //Còn đây là hiển thị theo định dạng Ngày-Tháng-Năm từ biến POST mà người dùng gửi lên
                                   if($birthday == null) $birthday = DateTime::createFromFormat('d-m-Y', $birthday_db);
                                   if($birthday != null)
                                   {
                                       echo $birthday->format("d-m-Y");
                                   }
                               }
                               ?>">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Ghi chú</label>
                    <input type="text" class="form-control"
                           name="note" value="<?php if (isset($note_db)) echo $note_db; ?>"
                           placeholder="Ghi chú">
                </div>
                <div class="form-group">
                    <label>Điểm tích lũy</label>
                    <input type="text" class="form-control"
                           name="point" value="<?php if (isset($point_db)) echo $point_db; ?>"
                           placeholder="Điểm tích lũy">
                </div>
                <input type="submit" name="btnSubmit" class="btn btn-primary" value="Sửa">
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
<?php
    require_once __DIR__ . "/includes/footer.php";
    ob_flush();
?>