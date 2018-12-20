<?php
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

<div class="location">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="titles text-xs-center">
                    <p>Craving of our chocolate? Call us now!</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid map">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-map">
                        <div class="info">
                            <span class="icon"><span class="fa fa-map-marker"></span></span>
                            <span class="up-info">Location</span>
                            <span class="down-info">125 Fifth Avenue, Manhattan, NY</span>
                        </div>
                        <div class="info">
                            <span class="icon"><span class="fa fa-phone"></span></span>
                            <span class="up-info">Call us</span>
                            <span class="down-info">+91 1234 5678</span>
                        </div>
                        <div class="info">
                            <span class="icon"><span class="fa fa-envelope"></span></span>
                            <span class="up-info">Email us</span>
                            <span class="down-info">info@thepodschocolate.com</span>
                        </div>
                        <div class="info">
                            <span class="icon"><span class="fa fa-clock-o"></span></span>
                            <span class="up-info">Hours</span>
                            <span class="down-info">Mon to Sat: from 9AM to 7PM</span>
                        </div>
                    </div>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d96745.58232614279!2d-74.0157608355791!3d40.73343599914576!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259a3b1643503%3A0x371b9c766285dbb9!2s125+5th+Ave%2C+New+York%2C+NY+10003%2C+Hoa+K%E1%BB%B3!5e0!3m2!1svi!2sin!4v1506735472294" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div><!-- end map -->
</div><!-- end location -->

<div class="container-fluid link-menu">
    <div class="row">
        <div class="col-md-3 col-sm-12 col-xs-12 up-one text-xs-center">
            <a class="the-pods-footer" href="index.php">
                <img src="public/images/three-pods-logo.png" alt="">
                <p>THE PODS</p>
            </a>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-6 up-one">
            <p class="title-footer">ABOUT US</p>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="ours_tory.php">Our story</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="press.php">Press</a></li>
                <li><a href="recipes.php">Recipes</a></li>
                <li><a href="phoga.php">Gallery</a></li>
            </ul>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-6 up-one">
            <p class="title-footer">PRODUCTS</p>
            <ul>
                <li><a href="">Chocolates</a></li>
                <li><a href="">Handmade chocolate</a></li>
                <li><a href="">Baking & cooking chocolate</a></li>
                <li><a href="">Season specialties</a></li>
                <li><a href="">Gift sets</a></li>
            </ul>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-6 up-one">
            <p class="title-footer">SUPPORT</p>
            <ul>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="latest-news.php">Latest News</a></li>
                <li><a href="">Privacy policy</a></li>
                <li><a href="">Gift cards</a></li>
                <li><a href="">FAQ</a></li>
            </ul>
        </div>
<!--        <div class="col-md-3 col-sm-3 col-xs-6 up-one">-->
<!--            <p class="title-footer">SUBSCRIBE OUR NEWSLETTER!</p>-->
<!--            <p class="details-footer">Let us update to you our news & promotion. <br> 25% discount code for any new subscription.</p>-->
<!--            <input type="email" placeholder="Enter your e-mail here" class="d-block mb-2">-->
<!--            <a href="" type="submit" class="btn btn-chocolate ">SUBSCRIBE <span class="fa fa-chevron-circle-right"></span></a>-->
<!--        </div>-->
    </div><!-- end row -->
</div><!-- end ... -->

<footer>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12 down text-xs-center">
                    <p>&copy; Copyright 2017 Lilystreat.  All rights reserved.</p>
                </div>
            </div><!-- end row -->
        </div>
    </div>
</footer><!-- end ... -->

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