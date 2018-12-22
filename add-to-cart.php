<?php
require_once __DIR__ . "/includes/header.php";
require_once  __DIR__ . "/db/db.php";
$db = db::getInstance();

if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range'=>1)))
{
    $id = $_GET['id'];
    if($db->select_one("SELECT * FROM product WHERE id={$id}"))
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
						<h3 style="font-family: 'BradleyHandITCTTBold'"><?php echo $name; ?></h3>
						<div class="form-group row">
							<div class="col-xs-12">
								<span class="price-product"><?php echo $price; ?></span>
								<span class="price-qty-total">18.00</span>
								<p>QUANTITY</p>
								<div class="handle-counter" id="handleCounter">
									<button type="button" class="counter-minus btn btn-chocolate"><span class="fa fa-minus"></span></button>
									<input style="width: 60px;" class="quarity" type="number" value="2" min="1">
									<button type="button" class="counter-plus btn btn-chocolate"><span class="fa fa-plus"></span></button>
								</div>
								<button type="submit" class="btn btn-chocolate add-button">ADD TO CART</button>
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
            if($db->select("SELECT * FROM product WHERE type={$id_type} and soluong > 0 and id <> {$id}"))
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
                                    <a href="add-to-cart.php?id=<?php echo $product_same->id; ?>" class="btn btn-chocolate cd-trigger">quick view <span class="fa fa-chevron-circle-right"></span></a>
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
include('includes/connect.php');
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

</script>

<script>
    $(function ($) {
        var options = {
            minimum: 1,
            // maximize: 100,
            onChange: valChanged,
            onMinimum: function (e) {
                console.log('reached minimum: ' + e)
            },
            onMaximize: function (e) {
                console.log('reached maximize' + e)
            }
        }
        $('#handleCounter').handleCounter(options)
        $('#handleCounter2').handleCounter(options)
    })

    function valChanged(d) {
        //            console.log(d)
    }
</script>
<script type="text/javascript">
    (function () {
        'use strict';
        $.fn.handleCounter = function (options) {
            var $input,
                $btnMinus,
                $btnPlugs,
                minimum,
                maximize,
                writable,
                onChange,
                onMinimum,
                onMaximize;
            var $handleCounter = this
            $btnMinus = $handleCounter.find('.counter-minus')
            $input = $handleCounter.find('input.quarity')
            $btnPlugs = $handleCounter.find('.counter-plus')
            var defaultOpts = {
                writable: true,
                minimum: 1,
                maximize: null,
                onChange: function () {
                },
                onMinimum: function () {
                },
                onMaximize: function () {
                }
            }
            var settings = $.extend({}, defaultOpts, options)
            minimum = settings.minimum
            maximize = settings.maximize
            writable = settings.writable
            onChange = settings.onChange
            onMinimum = settings.onMinimum
            onMaximize = settings.onMaximize
            if (!$.isNumeric(minimum)) {
                minimum = defaultOpts.minimum
            }
            if (!$.isNumeric(maximize)) {
                maximize = defaultOpts.maximize
            }
            var inputVal = $input.val()
            if (isNaN(parseInt(inputVal))) {
                inputVal = $input.val(0).val()
            }
            if (!writable) {
                $input.prop('disabled', true)
            }

            changeVal(inputVal)
            $input.val(inputVal)
            $btnMinus.click(function () {
                var num = parseInt($input.val())
                if (num > minimum) {
                    $input.val(num - 1)
                    changeVal(num - 1)
                }
            })
            $btnPlugs.click(function () {
                var num = parseInt($input.val())
                if (maximize == null || num < maximize) {
                    $input.val(num + 1)
                    changeVal(num + 1)
                }
            })
            var keyUpTime
            $input.keyup(function () {
                clearTimeout(keyUpTime)
                keyUpTime = setTimeout(function () {
                    var num = $input.val()
                    if (num == '') {
                        num = minimum
                        $input.val(minimum)
                    }
                    var reg = new RegExp("^[\\d]*$")
                    if (isNaN(parseInt(num)) || !reg.test(num)) {
                        $input.val($input.data('num'))
                        changeVal($input.data('num'))
                    } else if (num < minimum) {
                        $input.val(minimum)
                        changeVal(minimum)
                    } else if (maximize != null && num > maximize) {
                        $input.val(maximize)
                        changeVal(maximize)
                    } else {
                        changeVal(num)
                    }
                }, 300)
            })
            $input.focus(function () {
                var num = $input.val()
                if (num == 0) $input.select()
            })

            function changeVal(num) {
                $input.data('num', num)
                $btnMinus.prop('disabled', false)
                $btnPlugs.prop('disabled', false)
                if (num <= minimum) {
                    $btnMinus.prop('disabled', true)
                    onMinimum.call(this, num)
                } else if (maximize != null && num >= maximize) {
                    $btnPlugs.prop('disabled', true)
                    onMaximize.call(this, num)
                }
                onChange.call(this, num)
            }

            return $handleCounter
        };
    })(jQuery)


    $(document).ready(function () {




        /* Set rates + misc */
        var shippingRate = 2.00;
        var fadeTime = 300;
        var taxRate = 0.02;


        /* Assign actions */
        $('input.quarity').change(function () {
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