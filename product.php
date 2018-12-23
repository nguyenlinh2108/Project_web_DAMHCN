<?php
$current_page = basename(__FILE__, '.php');

require_once __DIR__ . "/includes/header.php";
require_once  __DIR__ . "/db/db.php";
$db = db::getInstance();

if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range'=>1)))
{
    $product_id = $_GET['id'];
    if($db->select_one("SELECT * FROM product WHERE id={$product_id}"))
    {
        $name = $db->getResult()->name;
        $image = $db->getResult()->image;
        $price = $db->getResult()->unit_price;
        $description = $db->getResult()->description;
        $id_type = $db->getResult()->type;
    }

}
?>
	
	<div class="container-fluid">
		<div class="container title-order">
			<div class="row">
				<div class="col-md-8 col-sm-6">
		        	<a class="prev-page" href="products.php"><span class="fa fa-chevron-left"></span> continue shopping</a>
		        </div>
		    </div>
		</div>
	</div>

	<div class="container-fluid add-to-cart">
		<div class="container">
			<div class="row">
				<div class="col-md-6 detail-product-img">
					<div class="sp-loading"><img src="public/upload/product/<?php echo $image; ?>" alt=""></div>
					<div class="sp-wrap">
						<a href="public/upload/product/<?php echo $image; ?>"><img src="public/upload/product/<?php echo $image; ?>" alt=""></a>

					</div>
				</div>
				<div class="col-md-5 push-md-1">
					<form class="choise-size" method="post" action="cart.php">
                        <input type="text" hidden name="product" value="<?php if(isset($product_id)) echo $product_id ?>">
						<h3 style="font-family: 'BradleyHandITCTTBold'"><?php echo $name; ?></h3>
						<div class="form-group row">
							<div class="product-info col-xs-12">
								<span style="display: block!important;" class="price-product" ><?php echo $price; ?></span>
								<span class="price-qty-total" id="price-qty-total"><?= intval($price) ?></span>
								<p>Số lượng</p>
								<div class="handle-counter" id="handleCounter">
									<button type="button" class="counter-minus btn btn-chocolate"><span class="fa fa-minus"></span></button>
									<input style="width: 60px;" class="quantity" name="quantity" type="number" value="1">
									<button type="button" class="counter-plus btn btn-chocolate"><span class="fa fa-plus"></span></button>
								</div>
								<button id="button_add_to_cart" type="submit" class="btn btn-chocolate add-button">Thêm vào giỏ hàng</button>
							</div>
						</div>
					</form>
					<p><?php echo $description; ?></p>
				</div>
			</div><!-- end row -->
		</div>
	</div><!-- end ... -->
	<div class="container-fluid see-other-products">
		<div class="container">
            <?php
            if(isset($id_type) && filter_var($id_type, FILTER_VALIDATE_INT,array('min_range'>=1)))
            {
            if($db->select("SELECT * FROM product WHERE type={$id_type} and soluong > 0 and id <> {$product_id}"))
            {
                $product_sames = $db->getResult();
            }
            if(isset($product_sames) && is_array($product_sames))
            {
            ?>
            <div class="row">
                <div class="col-xs-12">
                    <hr>
                    <p>You might also like</p>
                </div>
            </div>
            <div class="row">
                <section class="regular slider">
                    <?php
                    foreach ($product_sames as $product_same)
                    {
                        if($product_same->soluong > 0)
                        {
                            ?>
                            <figure class="product-box text-xs-center">
                                <div class="quick-view">
                                    <img style="height: 217px;" class="img-fluid" src="public/upload/product/<?php echo $product_same->image; ?>" alt="">
                                    <div class="bg-gray"></div>
                                    <a href="product.php?id=<?php echo $product_same->id; ?>" class="btn btn-chocolate cd-trigger">quick view <span class="fa fa-chevron-circle-right"></span></a>
                                </div>
                                <figcaption><p><?php echo $product_same->name; ?></p><span class="price-product"><?php echo $product_same->unit_price; ?></span></figcaption>
                            </figure>
                            <?php
                        }
                    }
            }
            }
                    ?>
                </section>
            </div><!-- end row -->
		</div><!-- end container -->
	</div><!-- end ... -->

<?php
include('includes/link-menu.php');
//include('includes/connect.php');
?>

<div id="toTop">
    <span class="fa fa-chevron-up"></span>
</div>
<div id="toDown">
    <span class="fa fa-chevron-down"></span>
</div>
<script src="public/js/smoothproducts.js" type="text/javascript" charset="utf-8" async defer></script>
<script type="text/javascript">
    <?php
    if (isset($_SESSION['customer_login']['success']) && $_SESSION['customer_login']['success']) {
        echo "var isLogin = true;";
    } else {
        echo "var isLogin = false;";
    }
    ?>

    $('#button_add_to_cart').click(function (event) {
        event.preventDefault();
        if (isLogin == false) {
            alert("Bạn chưa đăng nhập");
        } else {
            $('form.choise-size').submit();
        }
    });


    //u might also like
    $(".regular").slick({
        dots: true,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1
    });
    //click vào sẽ hiển thị ảnh sản phẩm lên
    $(window).load(function () {
        $('.sp-wrap').smoothproducts();
    });

    $(document).ready(function () {
        $('.form-group .product-info').each(function () {
            var priceProdut = parseInt($(this).find(".price-product").text());
            var quantityInput = $(this).find(".quantity");
            var quantity = parseInt(quantityInput.val());
            var minusButton = $(this).find("button.counter-minus");
            var plusButton = $(this).find("button.counter-plus");
            var priceProductTotal = $(this).find(".price-qty-total");

            plusButton.click(function (event) {
                quantityInput.val(++quantity);
                priceProductTotal.text(priceProdut * quantity);
                updateTotal();
            });

            minusButton.click(function (event) {
                if(quantity >=1) {
                    quantityInput.valueOf(--quantity);
                    priceProductTotal.text(priceProdut * quantity);
                    updateTotal();
                }
            });
        });
    });


</script>

<script type="text/javascript">



    $(document).ready(function () {
        /* Set rates + misc */
        var shippingRate = 2.00;
        var fadeTime = 300;
        var taxRate = 0.02;


        /* Assign actions */
        $('input.quantity').change(function () {
            updateQuantity(this);
        });

        $('button.remove-product').click(function () {
            removeItem(this);
        });


        /* Recalculate cart */
        function recalculateCart() {
            var subtotal = 0;

            /* Sum up row totals */
            $('.product').each(function () {
                subtotal += parseFloat($(this).children('span.price-qty-total').text());
            });
            $('span.price-qty-total').each(function () {
                subtotal += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
            });
            /* Calculate totals */
            var shipping = (subtotal > 0 ? shippingRate : 0);
            var tax = taxRate * subtotal;
            var total = subtotal + shipping + tax;

            /* Update totals display */
            $('span.totals-value').fadeOut(fadeTime, function () {
                $('span#cart-subtotal').html(subtotal.toFixed(2));
                $('span#cart-tax').html(tax.toFixed(2));
                $('span#cart-total').html(total.toFixed(2));
                $('span.totals-value').fadeIn(fadeTime);
            });
        }

        /* Update quantity */
        function updateQuantity(quantityInput) {
            /* Calculate line price */
            var productRow = $(quantityInput).parent().parent();
            var price = parseFloat(productRow.children('span.price-product').text());
            var quantity = $(quantityInput).val();
            var linePrice = price * quantity;

            /* Update line price display and recalc cart totals */
            productRow.children('span.price-qty-total').each(function () {
                $(this).fadeOut(fadeTime, function () {
                    $(this).text(linePrice.toFixed(2));
                    recalculateCart();
                    $(this).fadeIn(fadeTime);
                });
            });
        }


        /* Remove item from cart */
        function removeItem(removeButton) {
            /* Remove row from DOM and recalc cart total */
            var productRow = $(removeButton).parent().parent();
            productRow.slideUp(fadeTime, function () {
                productRow.remove();
                recalculateCart();
            });
        }

    });
    $(".regular").slick({
        dots: true,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1
    });
</script>
</body>
</html>