<?php
session_start();

if (isset($_SESSION['customer_login']['success']) && $_SESSION['customer_login']['success']) {
    header("location: " . (isset($_GET['continue']) ? $_GET['continue'] : "/"));
    return;
}

require_once __DIR__ . "/db/db.php";
require_once __DIR__ . "/admin/class/auth.php";

$db = db::getInstance();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        unset($_SESSION['customer_login']);
        $message = "";
        if (!isset($_POST['email'])) {
            $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu email</p>";
        } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $message .= "<p class='alert alert-danger message'>Email không hợp lệ</p>";
        }

        if (!isset($_POST['password'])) {
            $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu password</p>";
        }

        if ($message === "") {
            if ($db->select_one("SELECT * FROM customer WHERE email = '" . db::validSql($_POST['email']) . "' AND password = '" . auth::getMD5Password($_POST['password']) . "'")) {
                $_SESSION['customer_login']['success'] = true;
                $_SESSION['customer_login']['id'] = $db->getResult()->id;
                unset($_POST);
                header("location: " . (isset($_GET['continue']) ? $_GET['continue'] : "/"));
                return;
            } else {
                $_SESSION['customer_login']['success'] = false;
                $message = "<p class='alert alert-danger'>Sai email hoặc mật khẩu</p>";
            }
        }
    } else if (isset($_POST['signup'])) {
        $message = "";

        if (!isset($_POST['name'])) {
            $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu tên</p>";
        }

        if (!isset($_POST['birthday'])) {
            $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu ngày sinh</p>";
        } else {
            $birthday = DateTime::createFromFormat('d-m-Y', $_POST['birthday']);
            if ($birthday == null) $birthday = DateTime::createFromFormat('Y-m-d', $_POST['birthday']);
            if ($birthday == null) {
                $message .= "<p class='alert alert-danger message'>Ngày sinh không hợp lệ</p>";
            } else {
                $birthdaySql = $birthday->format("Y/m/d");
                $birthdayNormal = $birthday->format("d-m-Y");
            }
        }

        if (!isset($_POST['email'])) {
            $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu email</p>";
        } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $message .= "<p class='alert alert-danger message'>Email không hợp lệ</p>";
        }
        if (!isset($_POST['phone'])) {
            $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu số điện thoại</p>";
        } else if (!is_numeric($_POST['phone'])) {
            $message .= "<p class='alert alert-danger message'>Số điện thoại không hợp lệ</p>";
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

        if ($message === "") {
            if ($db->select_one("SELECT * FROM customer WHERE email = '" . db::validSql($_POST['email']) . "'")) {
                $message .= "<p class='alert alert-danger'>Email đã tồn tại.</p>";
            } else if ($db->select_one("SELECT * FROM customer WHERE phone = '" . db::validSql($_POST['phone']) . "'")) {
                $message .= "<p class='alert alert-danger'>Số điện thoại đã tồn tại.</p>";
            } else if ($db->insert("customer", [
                "name" => $_POST['name'],
                "email" => $_POST['email'],
                "password" => auth::getMD5Password($_POST['password']),
                "address" => $_POST['address'],
                "phone" => $_POST['phone'],
                "birthday" => $birthdaySql,
            ])) {
                if ($db->select_one("SELECT * FROM customer WHERE email = '" . db::validSql($_POST['email']) . "' AND password = '" . auth::getMD5Password($_POST['password']) . "'")) {
                    $_SESSION['customer_login']['success'] = true;
                    $_SESSION['customer_login']['id'] = $db->getResult()->id;
                    unset($_POST);
                    header("location: " . (isset($_GET['continue']) ? $_GET['continue'] : "/"));
                    return;
                } else {
                    $_SESSION['customer_login']['success'] = false;
                    $message = "<p class='alert alert-danger'>Đăng ký thất bại</p>";
                }

            } else $message .= "<p class='alert alert-danger'>Đăng ký thất bại</p>";
        }
    }
}


require_once __DIR__ . "/includes/header.php";
?>
<div class="container-fluid log-forgot" <?php if (isset($_POST['signup'])) echo "style='display: none;'" ?>>
    <div class="container">
        <div class="row bd-sign">
            <div class="col-sm-6 push-sm-3 log">
                <div class="card card-block cart-height col-sm-10 push-sm-1">
                    <h3 class="card-title text-xs-center">Đăng nhập</h3>
                    <?php
                    if (isset($_POST['login']) && isset($message)) echo $message;
                    ?>
                    <form method="POST" action="">
                        <input type="text" hidden name="login">
                        <fieldset class="form-group">
                            <label for="InputEmail">*Email Address:</label>
                            <input value="<?php if (isset($_POST['login']) && isset($_POST['email'])) echo $_POST['email'] ?>"
                                   required type="text" class="form-control" id="InputEmail" name="email"
                                   placeholder="email@examplae.com">
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="InputPassword">*Password</label>
                            <input value="<?php if (isset($_POST['login']) && isset($_POST['password'])) echo $_POST['password'] ?>"
                                   required type="password" class="form-control" id="InputPassword" name="password"
                                   placeholder="Password">
                        </fieldset>
                        <fieldset class="form-group">
                            <button type="button" class="forgot-pass btn-none">Forgot Password</button>
                        </fieldset>
                        <fieldset class="form-group">
                            <button type="button" class="creat-acc btn-none">Create account</button>
                        </fieldset>
                        <button type="submit" class="btn btn-chocolate">Login <span
                                    class="fa fa-chevron-circle-right"></span></button>
                    </form>
                </div>
            </div>
            <div class="col-sm-6 push-sm-3 forgot">
                <div class="card card-block cart-height col-sm-10 push-sm-1">
                    <h3 class="card-title text-xs-center">Forgot Password</h3>
                    <p class="card-text ">Because of security procedures, we cannot retrieve your password and send it
                        to you. However, we can reset the password and send you the new one. Please note that the
                        password is reset as soon as this is requested. The new password will be sent to the address
                        specified when the account was setup.</p>
                    <form>
                        <fieldset class="form-group">
                            <label for="InputEmail1">*Email Address:</label>
                            <input required type="text" class="form-control" id="InputEmail1"
                                   placeholder="john@gmail.com">
                        </fieldset>
                        <fieldset class="form-group">
                            <button type="button" class="log-in btn-none">Login</button>
                        </fieldset>
                        <fieldset class="form-group">
                            <button type="button" class="creat-acc btn-none">Create account</button>
                        </fieldset>
                        <button type="submit" class="btn btn-chocolate text-xs-center">Reset <span
                                    class="fa fa-chevron-circle-right"></span></button>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- end container -->
</div><!-- end ... -->


<div class="container-fluid create-acc" <?php if (isset($_POST['signup'])) echo "style='display: block;'" ?>>
    <div class="container">
        <div class="row bd-sign">
            <div class="col-sm-8 push-sm-2">
                <div class="card card-block cart-height">
                    <h3 class="card-title text-xs-center">Đăng ký tài khoản mới</h3>
                    <?php
                    if (isset($_POST['signup']) && isset($message)) echo $message;
                    ?>
                    <form method="POST" action="">
                        <input type="text" hidden name="signup">
                        <div class="row">
                            <fieldset class="form-group col-sm-6">
                                <label for="InputLasttName">*Name</label>
                                <input value="<?php if (isset($_POST['signup']) && isset($_POST['name'])) echo $_POST['name'] ?>"
                                       name="name" required type="text" class="form-control" id="InputLasttName"
                                       placeholder="Smith">
                            </fieldset>
                        </div>
                        <div class="row">
                            <fieldset class="form-group col-sm-6">
                                <label for="InputBirth">*Birthdate</label>
                                <input value="<?php if (isset($_POST['signup']) && isset($_POST['birthday']) && isset($birthdayNormal)) echo $birthdayNormal ?>"
                                       name="birthday" required type="date" class="form-control" id="InputBirth"
                                       placeholder="26/03/1990">
                            </fieldset>
                            <fieldset class="form-group col-sm-6">
                                <label for="InputAddress">*Address</label>
                                <input value="<?php if (isset($_POST['signup']) && isset($_POST['address'])) echo $_POST['address'] ?>"
                                       name="address" required type="text" class="form-control" id="InputAddress"
                                       placeholder="125 Fifth Avenue, Manhattan">
                            </fieldset>
                        </div>
                        <div class="row">
                            <fieldset class="form-group col-sm-6">
                                <label for="InputEmail2">*Email Address</label>
                                <input value="<?php if (isset($_POST['signup']) && isset($_POST['email'])) echo $_POST['email'] ?>"
                                       name="email" required type="text" class="form-control" id="InputEmail"
                                       placeholder="john@gmail.com">
                            </fieldset>
                            <fieldset class="form-group col-sm-6">
                                <label for="InputPhone">*Phone Number</label>
                                <input value="<?php if (isset($_POST['signup']) && isset($_POST['phone'])) echo $_POST['phone'] ?>"
                                       name="phone" required type="text" class="form-control" id="InputPhone"
                                       placeholder="+91 1234 5678">
                            </fieldset>
                        </div>
                        <div class="row">
                            <fieldset class="form-group col-sm-6">
                                <label for="InputPassword2">*Password</label>
                                <input value="<?php if (isset($_POST['signup']) && isset($_POST['password'])) echo $_POST['password'] ?>"
                                       name="password" required type="password" class="form-control" id="InputPassword2"
                                       placeholder="Password">
                            </fieldset>
                            <fieldset class="form-group col-sm-6">
                                <label for="InputPassword2">*Comfirm Password</label>
                                <input value="<?php if (isset($_POST['signup']) && isset($_POST['repassword'])) echo $_POST['repassword'] ?>"
                                       name="repassword" required type="password" class="form-control"
                                       id="InputPassword2" placeholder="Password">
                            </fieldset>
                        </div>
                        <div class="row">
                            <fieldset class="form-group col-sm-6">
                                <button type="button" class="log-in btn-none">Log in</button>
                            </fieldset>
                            <fieldset class="form-group col-sm-6">
                                <button type="button" class="forgot-pass btn-none">Forgot Password</button>
                            </fieldset>
                        </div>
                        <button type="submit" class="btn btn-chocolate text-xs-center">Create Account <span
                                    class="fa fa-chevron-circle-right"></span></button>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- end container -->
</div><!-- end ... -->


<div class="container-fluid link-menu">
    <div class="row">
        <div class="col-md-3 col-sm-12 col-xs-12 up-one text-xs-center">
            <a class="the-pods-footer" href="index.html">
                <img src="public/images/three-pods-logo.png" alt="">
                <p>THE PODS</p>
            </a>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-6 up-one">
            <p class="title-footer">ABOUT US</p>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="ours_tory.html">Our story</a></li>
                <li><a href="products.html">Products</a></li>
                <li><a href="press.html">Press</a></li>
                <li><a href="recipes.html">Recipes</a></li>
                <li><a href="phoga.html">Gallery</a></li>
            </ul>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-6 up-one">
            <p class="title-footer">CHOCOLATE</p>
            <ul>
                <li><a href="">Chocolate</a></li>
                <li><a href="">Handmade chocolate</a></li>
                <li><a href="">Baking & cooking chocolate</a></li>
                <li><a href="">Season specialties</a></li>
                <li><a href="">Gift sets</a></li>
            </ul>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-6 up-one">
            <p class="title-footer">SUPPORT</p>
            <ul>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="latest-news.html">Latest News</a></li>
                <li><a href="">Privacy policy</a></li>
                <li><a href="">Gift cards</a></li>
                <li><a href="">FAQ</a></li>
            </ul>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6 up-one">
            <p class="title-footer">SUBSCRIBE OUR NEWSLETTER!</p>
            <p class="details-footer">Let us update to you our news & promotion. <br> 25% discount code for any new
                subscription.</p>
            <input type="email" placeholder="Enter your e-mail here" class="d-block mb-2">
            <a href="" type="submit" class="btn btn-chocolate ">SUBSCRIBE <span
                        class="fa fa-chevron-circle-right"></span></a>
        </div>
    </div><!-- end row -->
</div><!-- end ... -->

<footer>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12 down text-xs-center">
                    <p>&copy; Copyright 2017 Lilystreat. All rights reserved.</p>
                </div>
            </div><!-- end row -->
        </div>
    </div>
</footer><!-- end ... -->

<div class="connect">
    <a href="#"><span class="fa fa-facebook"></span></a>
    <a href="#"><span class="fa fa-twitter"></span></a>
    <a href="#"><span class="fa fa-google-plus"></span></a>
    <a href="#"><span class="fa fa-instagram"></span></a>
</div>

<div id="toTop">
    <span class="fa fa-chevron-up"></span>
</div>
<div id="toDown">
    <span class="fa fa-chevron-down"></span>
</div>


</body>
</html>