<?php
$current_page = basename(__FILE__, '.php');

require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/db/db.php";
$db = db::getInstance();
$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($db->insert("contact", [
        "name" => $_POST['name'],
        "email" => $_POST['email'],
        "phone" => $_POST['sdt'],
        "message" => trim($_POST['noidung']),
    ])) {
        $message .= "<p class='alert message'>Cảm ơn bạn đã gửi phản hồi cho chúng tôi</p>";
        unset($_POST);
    } else $message .= "<p class='alert alert-danger message'>Thêm thất bại</p>";
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
                    <form method="POST" action="" onclick="">
                        <fieldset class="form-group col-sm-8 push-sm-2">
                            <label for="InputName">*Name:</label>
                            <input required type="text" class="form-control"  name="name"
                                   id="InputName" placeholder="John">
                        </fieldset>
                        <fieldset class="form-group col-sm-8 push-sm-2">
                            <label for="InputEmail">*Email:</label>
                            <input required type="text" class="form-control" name="email"
                                   id="InputEmail" placeholder="john@gmail.com">
                        </fieldset>
                        <fieldset class="form-group col-sm-8 push-sm-2">
                            <label for="InputPhoneNumber">*Phone number:</label>
                            <input required type="text" class="form-control" name="sdt"
                                   id="InputPassword" placeholder="+8413465263">
                        </fieldset>
                        <fieldset class="form-group col-sm-8 push-sm-2">
                            <label for="InputMessage">*Message:</label>
                            <textarea class="form-control" style="display: block; width: 100%" rows="10"  name="noidung"
                                      placeholder="Write something..."></textarea>
                        </fieldset>
                        <button type="submit" class="btn btn-chocolate sent">Send <span class="fa fa-chevron-circle-right"></span></button>
                    </form>
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