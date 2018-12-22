<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once __DIR__ . "/db/db.php";

$db = db::getInstance();

if (isset($_POST['product']) && isset($_POST['quantity'])) {
    $product = intval($_POST['product']);
    $quantity = intval($_POST['quantity']);
    if (!isset($_SESSION['cart'])) $_SESSION['cart'] = array();

    //Nếu hàng đã trong giỏ thì công thêm vào
    if (isset($_SESSION['cart'][$product])) {
        $quantity = $quantity + $_SESSION['cart'][$product];
    }
    $_SESSION['cart'][$product] = $quantity;
}

unset($_POST);
unset($_REQUEST);

require_once __DIR__ . "/includes/header.php";
?>
<div class="container-fluid">
    <div class="container title-order">
        <div class="row">
            <div class="col-md-8 col-sm-6">
                <a class="prev-page" href="products.php"><span class="fa fa-chevron-left"></span> continue shopping</a>
            </div>
            <div class="col-md-2 col-sm-3 text-xs-right">
                <a href="" class="number-phone"><span class="fa fa-mobile"></span> 0123456789</a>
            </div>
            <div class="col-md-2 col-sm-3 text-xs-right">
                <a href="" class="live-chat"><span class="fa fa-comments-o"></span> Live chat</a>
            </div>
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end ... -->

<div class="container-fluid your-cart">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-8 left-cart">
                <div class="title-cart">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2>Your cart (<span class="quantum"><?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?></span>)</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content">
                    <div class="container">
                        <?php
                        if(isset($_SESSION['cart'])) foreach ($_SESSION['cart'] as $product_id => $quantity) {
                            if ($db->select_one("SELECT * FROM product where id = {$product_id}")) {
                                ?>
                                <div id="<?= $product_id ?>" class="row product-cart">
                                    <div class="col-sm-12 col-md-4 push-md-1">
                                        <img src="public/upload/product/<?= $db->getResult()->image ?>" alt="" class="img-fluid">
                                    </div>
                                    <div class="product-info col-sm-12 col-md-6 push-md-1">
                                        <p class="name-product"><?= $db->getResult()->name ?></p>
                                        <span class="price-product"><?= $db->getResult()->unit_price ?></span>
                                        <span class="price-qty-total" style="opacity: 100"><?= intval($db->getResult()->unit_price) * intval($quantity)?></span>
                                        <div class="handle-counter">
                                            <button type="button" class="counter-minus btn btn-chocolate"><span
                                                        class="fa fa-minus"></span></button>
                                            <input class="quantity" type="text" value="<?= $quantity ?>">
                                            <button type="button" class="counter-plus btn btn-chocolate"><span
                                                        class="fa fa-plus"></span></button>
                                        </div>
                                        <button class="remove-product btn btn-chocolate" onclick="removeItem(this)">Bỏ khỏi giỏ hàng</button>
                                    </div>
                                </div>

                                <?php
                            } else {
                                continue;
                            }

                        }
                        ?>

                    </div>
                </div><!-- end content -->
            </div><!-- end left cart -->
            <div class="col-sm-6 col-md-4 right-cart">
                <div class="content bg-content-price">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2>SUMMARY</h2>
                                <hr>
                            </div>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6">
                                        <p class="total">Total</p>
                                    </div>
                                    <div class="col-xs-3 push-xs-3 col-sm-5 push-sm-1  col-md-5 push-md-1 col-lg-5 push-lg-2">
                                        <span class="price-total totals-value" id="cart-total">104.00</span>
                                    </div>
                                </div>
                                <hr>
                            </div>

                            <div class="col-sm-12" style="margin-bottom: 20px;">
                                <div class="row" >
                                    <div class="col-sm-12">
                                        <a href="checkout.php" class="btn btn-block btn-chocolate btn-checkout">Check
                                            out</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- emd-content -->
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <h3 style="margin-top: 1rem">FREE SHIPPING</h3>
                                <p>YOUR ORDER QUALIFIES FOR FREE SHIPPING. Join us for free shipping on every order,
                                    every time.</p>
                            </div>
                        </div><!-- end row -->
                    </div>
                </div><!-- end content -->
            </div><!-- end right cart -->
        </div><!-- end row -->
    </div>
</div><!-- end cart -->


<div class="container-fluid see-other-products">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <hr>
                <p>You might also like</p>
            </div>
        </div>
        <div class="row">
            <section class="regular slider">
                <figure class="product-box text-xs-center">
                    <div class="quick-view">
                        <img class="img-fluid" src="public/images/product-1.png" alt="">
                        <div class="bg-gray"></div>
                        <a href="product.php" class="btn btn-chocolate cd-trigger">quick view <span
                                    class="fa fa-chevron-circle-right"></span></a>
                    </div>
                    <figcaption><p>Artisan chocolate box</p><span class="price-product">Contact for price & order</span>
                    </figcaption>
                </figure>
                <figure class="product-box text-xs-center">
                    <div class="quick-view">
                        <img class="img-fluid" src="public/images/product-6.png" alt="">
                        <div class="bg-gray"></div>
                        <a href="product.php" class="btn btn-chocolate cd-trigger">quick view <span
                                    class="fa fa-chevron-circle-right"></span></a>
                    </div>
                    <figcaption><p>Chewy salted caramel box</p><span class="price-product">from $9.00</span>
                    </figcaption>
                </figure>
                <figure class="product-box text-xs-center">
                    <div class="quick-view">
                        <img class="img-fluid" src="public/images/product-12.png" alt="">
                        <div class="bg-gray"></div>
                        <a href="product.php" class="btn btn-chocolate cd-trigger">quick view <span
                                    class="fa fa-chevron-circle-right"></span></a>
                    </div>
                    <figcaption><p>Coffee & caramel bar</p><span class="price-product">$7.50</span></figcaption>
                </figure>
                <figure class="product-box text-xs-center">
                    <div class="quick-view">
                        <img class="img-fluid" src="public/images/product-5.png" alt="">
                        <div class="bg-gray"></div>
                        <a href="product.php" class="btn btn-chocolate cd-trigger">quick view <span
                                    class="fa fa-chevron-circle-right"></span></a>
                    </div>
                    <figcaption><p>Chocolate powder</p><span class="price-product">$20.00</span></figcaption>
                </figure>
                <figure class="product-box text-xs-center">
                    <div class="quick-view">
                        <img class="img-fluid" src="public/images/product-2.png" alt="">
                        <div class="bg-gray"></div>
                        <a href="product.php" class="btn btn-chocolate cd-trigger">quick view <span
                                    class="fa fa-chevron-circle-right"></span></a>
                    </div>
                    <figcaption><p>Chocolate truffle box</p><span class="price-product">from $30.00</span></figcaption>
                </figure>
            </section>
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end ... -->

<?php
include('includes/link-menu.php');
include('includes/connect.php');
?>

<div id="toTop">
    <span class="fa fa-chevron-up"></span>
</div>
<div id="toDown">
    <span class="fa fa-chevron-down"></span>
</div>

<script>
    $(document).ready(function () {
        updateTotal();

        $('.product-cart .product-info').each(function () {
            var priceProduct = parseInt($(this).find(".price-product").text());//Giá sản phẩm
            var quantityInput = $(this).find(".quantity");//Input Số sản phẩm đang trong giỏ
            var quantity = parseInt(quantityInput.val());//Số sản phẩm đang trong giỏ
            var minusButton = $(this).find("button.counter-minus");//Nút giảm số lượng sản phẩm
            var plusButton = $(this).find("button.counter-plus");//Nút thêm sản phẩm vào giỏ
            var priceProductTotal = $(this).find(".price-qty-total");//Tổng số tiền phải trả

            //Thêm 1 sản phẩm
            plusButton.click(function (event) {
                quantityInput.val(++quantity);
                priceProductTotal.text(priceProduct * quantity);
                updateTotal();
            });
            //Bỏ bớt 1 sản phẩm
            minusButton.click(function (event) {
                if (quantity >= 1) {
                    quantityInput.val(--quantity);
                    priceProductTotal.text(priceProduct * quantity);
                    updateTotal();
                }
            });
        });
    });
    
    function updateTotal() {
        $('#cart-total').text(0);
        $('.price-qty-total').each(function () {
            $('#cart-total').text(parseInt($('#cart-total').text()) + parseInt($(this).text()));
        });
    }

    /* Set rates + misc */
    var shippingRate = 2.00;
    var fadeTime = 300;
    var taxRate = 0.02;

    /* Remove item from cart */
    function removeItem(removeButton) {
        /* Remove row from DOM and recalc cart total */
        var productRow = $(removeButton).parent().parent();
        productRow.slideUp(fadeTime, function () {
            productRow.remove();
            updateTotal();
        });
    }
    $(".regular").slick({
        dots: true,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1
    });
    
    
    $('.btn-checkout').click(function (event) {
        event.preventDefault();

        alert("Check out");


    })
    
</script>
</body>
