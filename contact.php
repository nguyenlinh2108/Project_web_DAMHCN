<?php
$current_page = basename(__FILE__, '.php');

require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/db/db.php";
$db = db::getInstance();
if (isset($_SESSION['customer_login']['success']) && $_SESSION['customer_login']['success']) {
    $id = $_SESSION['customer_login']['id'];
}
if(isset($id) && filter_var($id, FILTER_VALIDATE_INT, array('min_range'=>1)))
{
    if($db->select_one("SELECT * FROM customer WHERE id={$id}"))
    {
        $name_db = $db->getResult()->name;
        $email_db = $db->getResult()->email;
        $phone_db = $db->getResult()->phone;
    }
}

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
            "message" => trim($_POST['noidung']),
        ])) {
            $message .= "<p class='alert alert-success'>Cảm ơn bạn đã gửi phản hồi cho chúng tôi!</p>";
            unset($_POST);
        } else $message .= "<p class='alert alert-danger'>Gửi thất bại</p>";
    }
}
?>

<div class="container-fluid" style="margin-top: 40px">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="text-xs-center">Contact us & Location</h2>
            </div>
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end ... -->

<div class="container-fluid log-forgot">
    <div class="container">
        <div class="row bd-sign">
            <div class="col-sm-12 push-sm-0 log">
                <div class="card card-block cart-height col-sm-10 push-sm-1">
                    <h3 class="card-title text-xs-center">Contact us</h3>
                    <?php
                    if(isset($message)){
                        echo $message;
                    }
                    ?>
                    <form id="send-contact" method="POST" action="" onclick="" >
                        <fieldset class="form-group col-sm-8 push-sm-2">
                            <label for="InputName">*Name:</label>
                            <input required type="text" class="form-control"  name="name"
                                   value="<?php if(isset($name_db)) echo $name_db; elseif(isset($_POST['name'])) echo $_POST['name']; ?>"
                                   id="InputName" placeholder="John">
                        </fieldset>
                        <fieldset class="form-group col-sm-8 push-sm-2">
                            <label for="InputEmail">*Email:</label>
                            <input required type="text" class="form-control" name="email"
                                   value="<?php if(isset($email_db)) echo $email_db; elseif(isset($_POST['email'])) echo $_POST['email']; ?>"
                                   id="InputEmail" placeholder="john@gmail.com">
                        </fieldset>
                        <fieldset class="form-group col-sm-8 push-sm-2">
                            <label for="InputPhoneNumber">*Phone number:</label>
                            <input required type="text" class="form-control" name="sdt"
                                   value="<?php if(isset($phone_db)) echo $phone_db; elseif(isset($_POST['sdt'])) echo $_POST['sdt']; ?>"
                                   id="InputPassword" placeholder="+8413465263">
                        </fieldset>
                        <fieldset class="form-group col-sm-8 push-sm-2" id="noidung">
                            <label for="InputMessage">*Message:</label>
                            <input type="text" hidden name="noidung" value="">
                            <textarea style="display: block; width: 100%" rows="10"  name="noidung" id="noidung"
                                      value="<?php if(isset($_POST['noidung'])) echo $_POST['noidung']; ?>"
                                      placeholder="Write something..."></textarea>
                        </fieldset>
                        <button type="submit" class="btn btn-chocolate sent" name="btnSubmit" >Send <span class="fa fa-chevron-circle-right"></span></button>
                    </form>
                    <script type="text/javascript">
                        <?php
                        if (isset($_SESSION['customer_login']['success']) && $_SESSION['customer_login']['success']) {
                            echo "var isLogin = true;";
                        } else {
                            echo "var isLogin = false;";
                        }
                        ?>
                        $(document).ready(function () {
                            $('.btn-chocolate').click(function (event) {
                                event.preventDefault();
                                if (isLogin === false) {
                                    alert("Bạn chưa đăng nhập");
                                } else {
                                    if (checkInput()) {
                                        $('#send-contact').submit();
                                    }
                                }
                            });
                            //bắt sự kiện click vào nút thêm mới
                            $("#send-contact input[name='btnSubmit']").click(function (event) {
                                event.preventDefault();//ngăn tự động submit form
                                //Nếu các trường input hợp lệ thì submit form
                                if (checkInput()) {
                                    $('#send-contact').submit();
                                }
                            });


                            //Bắt sự kiện khi gõ vào các trường input
                            $("input").keyup(function () {
                                checkInput();
                            });

                            //Bắt sự kiện khi gõ vào trường nội dung
                            $("#noidung").keyup(function () {
                                checkInput();
                            });
                        });

                        //Hàm kiểm tra các giá trị đầu vào và hiển thị thông báo lỗi nếu có
                        function checkInput() {
                            $(".message").remove(); //Xóa hết tất cả các thông báo trước uk, nhưng  class message không có trong thông báo
                            var isValidInput = true;//biến kiểm tra xem các input có hợp lệ không

                            //Duyệt qua tất cả các input của form
                            $("#send-contact .form-group:has(input[type='text'])").not("#noidung").each(function () {
                                let input = $(this).find("input[type='text']");//giá trị input
                                let label = $(this).find("label").text();//nhãn nằm trong thẻ label
                                if (typeof input.val() === "string") {//Nếu trường input là string (text)
                                    if (input.val() == null || input.val().trim() === "") {//Nếu giá trị input rỗng
                                        isValidInput = false;
                                        $(this).append("<p class='alert alert-danger message'>Không thể để trống trường " + label + "</p>");
                                    } else if (label === "*Phone number" && !isUnsignedNumber(input.val())) {
                                        //Kiểm tra xem giá trị input có là số không
                                        isValidInput = false;
                                        $(this).append("<p class='alert alert-danger message'>Bạn phải nhập " + label + " là số.</p>");
                                    } else if (label === "*Email" && !isValidEmail(input.val())) {
                                        //Kiểm tra xem giá trị input có là email hợp lệ không đối với các nhãn Email
                                        isValidInput = false;
                                        $(this).append("<p class='alert alert-danger message'>Bạn phải nhập " + label + " hợp lệ</p>");
                                    }
                                }

                            });

                            //Check trường textarea
                            let noidungInput = $("#noidung").find("textarea").val().trim();
                            let noidungLabel = $("#noidung").find("label").text();
                            if ((noidungInput === "")) {
                                isValidInput = false;
                                $("#noidung").append("<p class='alert alert-danger message'>Bạn chưa nhập " + noidungLabel + "</p>");
                            } else {
                                $("#noidung").find("input").val(noidungInput)//Gán nội dung từ textarea vào input
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
        </div><!-- end row -->
    </div>
</div><!-- end ... -->

<div class="feedback btn-success">
    Sent
</div>



<?php require_once __DIR__ . "/includes/link-menu.php"; ?>



<!--<div class="connect">-->
<!--    <a href="#"><span class="fa fa-facebook"></span></a>-->
<!--    <a href="#"><span class="fa fa-twitter"></span></a>-->
<!--    <a href="#"><span class="fa fa-google-plus"></span></a>-->
<!--    <a href="#"><span class="fa fa-instagram"></span></a>-->
<!--</div>-->

<div id="toTop">
    <span class="fa fa-chevron-up"></span>
</div>
<div id="toDown">
    <span class="fa fa-chevron-down"></span>
</div>

<script type="text/javascript">

</script>
</body>
</html>