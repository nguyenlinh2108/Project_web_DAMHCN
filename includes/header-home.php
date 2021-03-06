<?php
if(!isset($_SESSION))
{
    session_start();
}
require_once __DIR__ . "/../utils/function.php";
require_once __DIR__ . "/../utils/mystring.php";
require_once __DIR__ . "/../db/db.php";
$db = db::getInstance();


if (isset($_COOKIE['product_cart'])) {
    $product_cards = json_decode($_COOKIE['product_cart']);
}

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    if(isset($_POST['search-content']) && $_POST['search-content'] !== "")
    {
        $searchcontent = $_POST['search-content'];
        header("Location: search.php?searchcontent=$searchcontent");
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>The Pods - World's best handcrafted chocolate</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="../public/images/three-pods-shortcut-logo.png" rel="shortcut icon">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../public/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="../public/slick/slick-theme.css">
    <link rel="stylesheet" href="../public/font/styles.css">
    <link rel="stylesheet" href="../public/css/style.css">


    <script type="text/javascript" src="../public/js/jquery.min.js"></script>
    <script type="text/javascript" src="../public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../public/js/isotope.pkgd.min.js"></script>
    <script src="../public/slick/slick.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="../public/js/js.js"></script>

    <!--    <script type="text/javascript" src="../public/js/velocity.min.js"></script>-->
    <!--    <script type="text/javascript" src="../public/js/modernizr.js"></script>-->
    <!---->
    <!--    <script type="text/javascript" src="../public/css/vendor/bootstrap.js"></script>-->

</head>
<body>
<header class="navbar-top">
    <nav class="navbar navbar-light">
        <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar1">
        </button>
        <div class="collapse navbar-toggleable-xs" id="exCollapsingNavbar1">
            <a class="navbar-brand hidden-md-up text-xs-center" href="#"><img src="../public/images/logo.png" alt=""></a>
            <ul class="nav navbar-nav text-xs-center">
                <li class="nav-item active">
                    <a class="nav-link nav-link-home" href="../index.php">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-home" href="../products.php">Products</a>
                </li>

                <li class="nav-item search">
                    <a class="nav-link nav-link-home" href="javascript:void(0)"><span class="fa fa-search"></span> Search</a>
                    <form class="search-form" name="search-form" method="POST">
                        <input type="search"  name="search-content" placeholder="Search here..." class="none-outline form-control">
                        <button type="submit" class="btn btn-search" ><span class="fa fa-search"></span></button>
                    </form>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav-link-home" href="../our_story.php">Our Story</a>
                </li>

                <!-- <li class="nav-item">
                    <a class="nav-link nav-link-home" href="press.php">Press</a>
                </li> -->
                <!--					<li class="nav-item">-->
                <!--						<a class="nav-link nav-link-home" href="recipes.php">Recipes</a>-->
                <!--					</li>-->
                <li class="nav-item hidden-sm-down">
                    <a class="navbar-brand text-sm-center" href="../index.php">
                        <img class="img-size" src="../public/images/logo.png" alt="">
                        <p class="text-sm-center">World's best<br>handcrafed chocolate</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link nav-link-home" href="../contact.php">Contact</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav-link-home" href="../cart.php"><span class="fa fa-shopping-cart"></span> Cart<?php if(isset($product_cards)) echo "(" . count($product_cards) . ")" ?></a>
                </li>
                <?php
                if (isset($_SESSION['customer_login']['success']) && $_SESSION['customer_login']['success']) {
                    $db->select_one("SELECT * FROM customer WHERE id={$_SESSION['customer_login']['id']}");
                    $name = $db->getResult()->name;
                    ?>
                    <li class="nav-item">
                        <div class="dropdown navbar-top-home">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                                <img style="border-radius: 50%;overflow: hidden;margin-left: -10px;height: 45px;width: 45px;display: inline;margin: 2px 6px 2px -8px;" src="/public/upload/users/default/avatar_male.jpg">
                                <span class="caret">
                                     <?= $name ?>
                                </span>
                            </button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="../inf-acc.php">Account management</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="../logout_customer.php">Logout</a></li>
                            </ul>
                        </div>
                    </li>
                    <?php
                } else
                {
                    ?>
                    <li class="nav-item">
                    <a class="nav-link nav-link-home" href="<?php if(containsString(curentUrl(), "/login.php")){
                        echo "javascript: void()";
                    } else {
                        echo "login.php?continue=" . urlencode(curentUrl());
                    }?>">
                        <span class="fa fa-chevron-circle-right"></span> Login/Sign up</a>
                    </li><?php
                }
                ?>
            </ul>
        </div>
    </nav>
</header>

<header class="navbar-scroll">
    <nav class="navbar navbar-light">
        <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar2">
        </button>
        <div class="collapse navbar-toggleable-xs" id="exCollapsingNavbar2">
            <a class="navbar-brand hidden-sm-up text-xs-center" href="#"><img src="../public/images/logo.png" alt=""></a>
            <ul class="nav navbar-nav text-xs-center">
                <li class="nav-item hidden-sm-down">
                    <a class="navbar-brand" href="../index.php">
                        <p class="the-pods">THE PODS</p>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="../index.php">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../products.php">Products</a>
                </li>

                <li class="nav-item search">
                    <a class="nav-link" href="javascript:void(0)"><span class="fa fa-search"></span> Search</a>
                    <form class="search-form" name="search-form" method="POST">
                        <input name="search-content" type="search" placeholder="Search here..." class="none-outline form-control">
                        <button type="submit" class="btn btn-search"><span class="fa fa-search"></span></button>
                    </form>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../our_story.php">Our Story</a>
                </li>

                <!-- <li class="nav-item">
                    <a class="nav-link" href="press.php">Press</a>
                </li> -->
                <!--					<li class="nav-item">-->
                <!--						<a class="nav-link" href="recipes.php">Recipes</a>-->
                <!--					</li>-->
                <li class="nav-item">
                    <a class="nav-link" href="../contact.php">Contact</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../cart.php"><span class="fa fa-shopping-cart"></span> Cart<?php if(isset($product_cards)) echo "(" . count($product_cards) . ")" ?></a>
                </li>
                <?php
                if (isset($_SESSION['customer_login']['success']) && $_SESSION['customer_login']['success']) {
                    $db->select_one("SELECT * FROM customer WHERE id={$_SESSION['customer_login']['id']}");
                    $name = $db->getResult()->name;
                    ?>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                                <img style="border-radius: 50%;overflow: hidden;margin-left: -10px;height: 45px;width: 45px;display: inline;margin: 2px 6px 2px -8px;" src="/public/upload/users/default/avatar_male.jpg">
                                <span class="caret">
                                     <?= $name ?>
                                </span>
                            </button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="../inf-acc.php">Account management</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="../logout_customer.php">Logout</a></li>
                            </ul>
                        </div>
                    </li>
                    <?php
                } else
                {
                    ?>
                    <li class="nav-item">
                    <a class="nav-link" href="<?php if(containsString(curentUrl(), "/login.php")){
                        echo "javascript: void()";
                    } else {
                        echo "login.php?continue=" . urlencode(curentUrl());
                    }?>">
                        <span class="fa fa-chevron-circle-right"></span> Login/Sign up</a>
                    </li><?php
                }
                ?>
            </ul>
        </div>
    </nav>
</header>