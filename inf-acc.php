<?php
session_start();
ob_start();
require_once __DIR__ . "/admin/class/auth.php";
require_once __DIR__ . "/db/db.php";
$db = db::getInstance();
$gender_array = ['Nam', 'Nữ', 'Khác'];

$name_db = "";
$gender_db = "";
$email_db = "";
$address_db = "";
$phone_db = "";
$birthday_db = "";
$note_db = "";
$point_db = "";
if (isset($_SESSION['customer_login'])) {
    $id = $_SESSION['customer_login']['id'];
    if ($db->select_one("SELECT * FROM customer WHERE id={$id}")) {
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
    } else {
        header('Location: index.php');
    }
} else {
    header('Location: index.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['change-info-customer'])) {
        $message = "";
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
            $birthdaySql = $birthday->format("Y-m-d");
        }
        if ($message === "") {
            if (
                $_POST['name'] == $name_db
                && $_POST['gender'] == $gender_db
                && $_POST['email'] == $email_db
                && $_POST['address'] == $address_db
                && $_POST['phone'] == $phone_db
                && $birthdaySql == $birthday_db
//                && $_POST['note'] === $note_db
//                && $_POST['point'] === $point_db
            ) {
                $message = "<p class='alert alert-danger message'>Bạn chưa thay đổi gì</p>";
            } else if ($db->update('customer',
                [
                    "name" => $_POST['name'],
                    "gender" => $_POST['gender'],
                    "email" => $_POST['email'],
                    "address" => $_POST['address'],
                    "phone" => $_POST['phone'],
                    "birthday" => $birthdaySql,
                    "note" => $_POST['note'],
                    "point" => $_POST['point'],
                ],
                "id={$id}")) {
                $name_db = $_POST['name'];
                $gender_db = $_POST['gender'];
                $email_db = $_POST['email'];
                $address_db = $_POST['address'];
                $phone_db = $_POST['phone'];
                $birthday_db = $_POST['birthday'];
                $note_db = $_POST['note'];
                $point_db = $_POST['point'];
                $message = "<p class='alert alert-success message'>Sửa thành công</p>";
            } else {
                $message = "<p class='alert alert-danger message'>Sửa không thành công</p>";
            }
        }
    } else if (isset($_POST['change-pass-customer'])) {
        $message = "";
        if (!isset($_POST['password'])) {
            $message .= "<p class='alert alert-danger'>Bạn đã nhập thiếu mật khẩu</p>";
        } else if (!isset($_POST['repassword'])) {
            $message .= "<p class='alert alert-danger'>Bạn đã chưa nhập lại mật khẩu</p>";
        } else if (strlen($_POST['repassword']) < 3) {
            $message .= "<p class='alert alert-danger'>Mật khẩu quá ngắn, ít nhất 3 ký tự</p>";
        } else if ($_POST['password'] !== $_POST['repassword']) {
            $message .= "<p class='alert alert-danger'>Mật khẩu bạn nhập không khớp</p>";
        }

        if ($message === "") {
            if ($db->update("customer", ['password' => auth::getMD5Password($_POST['password'])], "id = {$id}")) {
                $message .= "<p class='alert alert-success'>Thay đỗi mật khẩu thành công</p>";
            } else {
                $message .= "<p class='alert alert-danger'>Thay đỗi mật khẩu thất bại</p>";
            }
        }
    }
}


include('includes/header.php');
?>

<div class="container-fluid" style="margin-top: 40px;">
    <div class="container">
        <div class="row bd-sign">
            <div class="col-sm-8 push-sm-2">
                <div class="card card-block cart-height">
                    <form id="acc-infor" method="post"
                          action="" <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') echo "style='display: none;'" ?>>
                        <h3 class="card-title text-xs-center">My Account Information</h3>
                        <div class="row text-xs-center text-sm-left">
                            <p class="name col-sm-6">Name:
                                <span><?php if (isset($name_db) && ($name_db !== "")) echo $name_db; ?></span></p>
                            <p class="email col-sm-6">Email:
                                <span><?php if (isset($email_db) && ($email_db !== "")) echo $email_db; ?></span></p>
                        </div>
                        <div class="row text-xs-center text-sm-left">
                            <p class="phone col-sm-6">Phone Number:
                                <span><?php if (isset($phone_db) && ($phone_db !== "")) echo $phone_db; ?></span></p>
                            <p class="birthday col-sm-6">Birthdare:
                                <span><?php if (isset($birthday_db) && ($birthday_db !== "")) echo $birthday_db; ?></span>
                            </p>
                        </div>
                        <div class="row text-xs-center text-sm-left">
                            <p class="address col-sm-6">Address:
                                <span><?php if (isset($address_db) && ($address_db !== "")) echo $address_db; ?></span>
                            </p>
                            <p class="city-country col-sm-6">Sex:
                                <span><?php if (isset($gender_db) && ($gender_db !== "")) echo $gender_db; ?></span></p>
                        </div>
                        <div class="row text-xs-center text-sm-left">
                            <p class="stapro col-sm-6">Note:
                                <span><?php if (isset($note_db) && ($note_db !== "")) echo $note_db; ?></span></p>
                            <p class="postal col-sm-6">Point:
                                <span><?php if (isset($point_db) && ($point_db !== "")) echo $point_db; ?></span></p>
                        </div>
                        <div class="row text-xs-center">
                            <p class="password col-sm-12 text-xs-center">Password: <span>***********</span></p>
                        </div>
                        <div class="row text-xs-center text-sm-left">
                            <button type="button" class="edit-acc btn-none col-sm-6">Edit Account Information</button>
                            <button type="button" class="edit-pass btn-none col-sm-6">Change your password</button>
                        </div>
                    </form>
                    <form id="change-infor" method="POST" action=""
                        <?= "style='display:" . (isset($_POST['change-info-customer']) ? "block" : "none") . "'"; ?>>
                        <input type="text" hidden name="change-info-customer">
                        <h3 class="card-title text-xs-center">Change Account Information</h3>

                        <?php if (isset($_POST['change-info-customer']) && isset($message)) {
                            echo $message;
                        } ?>

                        <div class="row">
                            <fieldset class="form-group col-sm-12">
                                <label for="InputFirstName">*Name</label>
                                <input required type="text" class="form-control"
                                       name="name"
                                       id="InputFirstName"
                                       value="<?php if (isset($name_db) && ($name_db !== "")) echo $name_db; ?>">
                            </fieldset>
                            <fieldset class="form-group col-sm-12">
                                <label for="InputLasttName">*Sex</label>
                                <input required type="text" class="form-control"
                                       name="gender"
                                       id="InputLasttName"
                                       value="<?php if (isset($gender_db) && ($gender_db !== "")) echo $gender_db; ?>">
                            </fieldset>
                        </div>
                        <div class="row">
                            <fieldset class="form-group col-sm-6">
                                <label for="InputEmail2">*Email Address</label>
                                <input required type="text" class="form-control"
                                       name="email"
                                       id="InputEmail"
                                       value="<?php if (isset($email_db) && ($email_db !== "")) echo $email_db; ?>">
                            </fieldset>
                            <fieldset class="form-group col-sm-6">
                                <label for="InputAddress">*Address</label>
                                <input required type="text" class="form-control"
                                       name="address"
                                       id="InputAddress"
                                       value="<?php if (isset($address_db) && ($address_db !== "")) echo $address_db; ?>">
                            </fieldset>
                        </div>
                        <div class="row">
                            <fieldset class="form-group col-sm-6">
                                <label for="InputBirth">*Birthdate</label>
                                <div id="datepicker" class="input-group date" data-provide="datepicker"
                                     data-date-format="dd-mm-yyyy">
                                    <input type="text" class="form-control" name="birthday"
                                           value="<?php
                                           if (isset($birthday_db) && ($birthday_db !== "")) {
                                               //Convert ngày sinh dạng Năm-Tháng-Ngày trong database sang dạng Ngày-Tháng-Năm
                                               $birthday = DateTime::createFromFormat('Y-m-d', $birthday_db);
                                               //Còn đây là hiển thị theo định dạng Ngày-Tháng-Năm từ biến POST mà người dùng gửi lên
                                               if ($birthday == null) $birthday = DateTime::createFromFormat('d-m-Y', $birthday_db);
                                               if ($birthday != null) {
                                                   echo $birthday->format("d-m-Y");
                                               }
                                           }
                                           ?>">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="form-group col-sm-6">
                                <label for="InputPhone">*Phone Number</label>
                                <input required type="text" class="form-control"
                                       name="phone"
                                       id="InputPhone"
                                       value="<?php if (isset($phone_db) && ($phone_db !== "")) echo $phone_db; ?>">
                            </fieldset>
                        </div>
                        <!--							<div class="row">-->
                        <!--								<fieldset class="form-group col-sm-6">-->
                        <!--									<label for="InputStaPro">*State/Province</label>-->
                        <!--									<input required type="number" class="form-control" id="InputStaPro" value="123456">-->
                        <!--								</fieldset>-->
                        <!--								<fieldset class="form-group col-sm-6">-->
                        <!--									<label for="InputPosCod">*Postal Code</label>-->
                        <!--									<input required type="number" class="form-control" id="InputPosCod" value="123456">-->
                        <!--								</fieldset>-->
                        <!--							</div>-->
                        <div class="row">
                            <fieldset class="form-group col-sm-6">
                                <label for="InputCity">*Note</label>
                                <input required type="text" class="form-control"
                                       name="note" readonly
                                       id="InputCity"
                                       value="<?php if (isset($note_db) && ($note_db !== "")) echo $note_db; ?>">
                            </fieldset>
                            <fieldset class="form-group col-sm-6">
                                <label for="InputCountry">*Point</label>
                                <input required type="text" class="form-control"
                                       name="point" readonly
                                       id="InputCountry"
                                       value="<?php if (isset($point_db) && ($point_db !== "")) echo $point_db; ?>">
                            </fieldset>
                        </div>
                        <button type="submit" class="btn btn-chocolate text-xs-center">Change Information <span
                                    class="fa fa-chevron-circle-right"></span></button>
                    </form>
                    <form id="change-pass" method="post" action=""
                        <?= "style='display:" . (isset($_POST['change-pass-customer']) ? "block" : "none") . "'"; ?>>
                        <input type="text" hidden name="change-pass-customer">
                        <h3 class="card-title text-xs-center">Change Password</h3>

                        <?php if (isset($_POST['change-pass-customer']) && isset($message)) {
                            echo $message;
                        } ?>


                        <div class="row">
                            <fieldset class="form-group col-sm-12">
                                <label for="NewPassword">*New Password</label>
                                <input name="password" required type="password" class="form-control" id="NewPassword"
                                       placeholder="New Password">
                            </fieldset>
                            <fieldset class="form-group col-sm-12">
                                <label for="ComfirmPassword">*Comfirm Password</label>
                                <input name="repassword" required type="password" class="form-control"
                                       id="ComfirmPassword" placeholder="Comfirm Password">
                            </fieldset>
                        </div>
                        <button type="submit" class="btn btn-chocolate text-xs-center">Change Password <span
                                    class="fa fa-chevron-circle-right"></span></button>
                    </form>

                </div>
            </div>
        </div>
    </div><!-- end container -->
</div><!-- end ... -->

<?php
require_once __DIR__ . "/includes/link-menu.php";
//require_once __DIR__ . "/includes/connect.php";

?>

<div id="toTop">
    <span class="fa fa-chevron-up"></span>
</div>
<div id="toDown">
    <span class="fa fa-chevron-down"></span>
</div>


<script type="text/javascript">

</script>
<?php ob_flush(); ?>
</body>
</html>