<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/1/2018
 * Time: 8:59 PM
 */
session_start();

if(isset($_SESSION['login']['success']) && $_SESSION['login']['success']){
    header("location: " . (isset($_GET['continue']) ? $_GET['continue'] : "/admin/index.php"));
    return ;
}

if (isset($_POST['email']) && isset($_POST['password'])) {
    require_once __DIR__ . "/class/auth.php";
    $email = $_POST['email'];
    $password = $_POST['password'];
    $auth = new auth($email, $password);
    unset($_SESSION['login']);
    if ($auth->login()) {
        $_SESSION['login']['success'] = true;
        $_SESSION['login']['id'] = $auth->id;
        header("location: " . (isset($_GET['continue']) ? $_GET['continue'] : "/admin/index.php"));
    } else {
        $_SESSION['login']['success'] = false;
        $_SESSION['login']['error_message'] = "Sai email hoặc mật khẩu";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Đăng nhập</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./public/css/login.css">
    <link href="./../public/images/three-pods-shortcut-logo.png" rel="shortcut icon">
    <!--===============================================================================================-->
    <script src="./public/js/login.js"></script>
    <script src="./public/js/jquery.min.js"></script>
    <script src="./public/js/bootstrap.min.js"></script>
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <?php
            if(isset($_SESSION['login']['success'])){
                if($_SESSION['login']['success'] === false){
                    echo "<div style='color: #a94442;background-color: #f2dede;border-color: #ebccd1;padding: 15px;margin-bottom: 20px;   border: 1px solid transparent;'>" . $_SESSION['login']['error_message'] . "</div>";
                } else {
                    header("location: " . (isset($_GET['continue']) ? $_GET['continue'] : "/admin/index.php"));
                }
            }
            ?>
            <form action="#" method="post" class="login100-form validate-form">
					<span class="login100-form-title p-b-26">
						Đăng nhập
					</span>

                <div class="wrap-input100 validate-input" data-validate="Valid email is: a@b.c">
                    <input class="input100" type="text" name="email">
                    <span class="focus-input100" data-placeholder="Email"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
                    <input class="input100" type="password" name="password">
                    <span class="focus-input100" data-placeholder="Password"></span>
                </div>

                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn">
                            Đăng nhập
                        </button>
                    </div>
                </div>

                <div class="text-center p-t-20" style="display: none">
						<span class="txt1">
							Don’t have an account?
						</span>

                    <a class="txt2" href="#">
                        Sign Up
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>

</body>
</html>