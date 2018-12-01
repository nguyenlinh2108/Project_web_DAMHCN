<?php include('includes/header.php'); ?>
	
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
					<div class="content free-join-ship">
						<div class="container">
							<div class="row">
								<div class="col-sm-12">
									<p class="join-ship">FREE TO JOIN. FREE TO SHIP</p>
									<p>Join us and get free shipping <a href="login.php">Log in</a></p>
								</div>
							</div>
						</div>
					</div>
					<div class="title-cart">
						<div class="container">
							<div class="row">
								<div class="col-sm-12">
									<h2>Your cart (<span class="quantum">2</span>)</h2>
								</div>
							</div>
						</div>
					</div>
					<div class="content">
						<div class="container">
							<div class="row product-cart">
								<div class="col-sm-12 col-md-4 push-md-1">
									<img src="images/product-2.png" alt="" class="img-fluid">
								</div>
								<div class="col-sm-12 col-md-6 push-md-1">
									<p class="name-product">Chocolate truffle box</p>
									<span class="price-product">30.00</span>
									<span class="price-qty-total" style="opacity: 0">60.00</span>
									<div class="handle-counter" id="handleCounter">
										<button type="button" class="counter-minus btn btn-chocolate"><span class="fa fa-minus"></span></button>
										<input class="quarity" type="text" value="2" min="1">
										<button type="button" class="counter-plus btn btn-chocolate"><span class="fa fa-plus"></span></button>
									</div>
									<button class="remove-product btn btn-chocolate">Remove</button>
									<a href="#" class="cuztomize">Cuztomize</a>
								</div>
							</div><!-- end row -->
						</div>
					</div><!-- end content -->
					<div class="content">
						<div class="container">
							<div class="row product-cart">
								<div class="col-sm-12 col-md-4 push-md-1">
									<img src="images/product-11.png" alt="" class="img-fluid">
								</div>
								<div class="col-sm-12 col-md-6 push-md-1">
									<p class="name-product">Pin tree & gifts chocolate</p>
									<span class="price-product">20.00</span>
									<span class="price-qty-total" style="opacity: 0">40.00</span>
									<div class="handle-counter" id="handleCounter2">
										<button type="button" class="counter-minus btn btn-chocolate"><span class="fa fa-minus"></span></button>
										<input class="quarity" type="text" value="2" min="1">
										<button type="button" class="counter-plus btn btn-chocolate"><span class="fa fa-plus"></span></button>
									</div>
									<button class="remove-product btn btn-chocolate">Remove</button>
									<a href="#" class="cuztomize">Cuztomize</a>
								</div>
							</div><!-- end row -->
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
									<a class="promocode" href="javascript:void(0)">Do you have a promo code? <span class="fa fa-chevron-down"></span></a>
									<input class="promo form-control" type="text" placeholder="Promo code here...">
									<script type="text/javascript">
										$('a.promocode').click(function() {
											$('input.promo').slideDown();
											$('a.promocode').slideUp();
										})
									</script>
									<hr>
								</div>
								<div class="col-sm-12">
									<div class="row">
										<div class="col-xs-6 col-sm-6">
											<p class="subtotal">Subtotal</p>
										</div>
										<div class="col-xs-3 push-xs-3 col-sm-5 push-sm-1  col-md-5 push-md-1 col-lg-5 push-lg-2">
											<span class="price-subtotal totals-value" id="cart-subtotal">100.00</span>
										</div>
									</div>
									<hr style="margin-bottom: 2px">
								</div>
								<div class="col-sm-12">
									<div class="row">
										<div class="col-sm-12">
											<span class="estam">Estamated Shipping and Handing</span>
										</div>
										<div class="col-xs-8 col-sm-6">
											<select class="custom-select">
												<option selected>Open this select menu</option>
												<option value="1">One</option>
												<option value="2">Two</option>
												<option value="3">Three</option>
											</select>
										</div>
										<div class="col-xs-3 push-xs-1 col-sm-5 push-sm-1  col-md-5 push-md-1 col-lg-5 push-lg-2">
											<span class="price-shipping totals-value" id="cart-shipping">2.00</span>
										</div>
									</div>
									<hr>
								</div>
								<div class="col-sm-12">
									<div class="row">
										<div class="col-xs-6 col-sm-6">
											<p class="tax">Tax</p>
										</div>
										<div class="col-xs-3 push-xs-3 col-sm-5 push-sm-1  col-md-5 push-md-1 col-lg-5 push-lg-2">
											<span class="price-tax totals-value" id="cart-tax">2.00</span>
										</div>
									</div>
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

								<div class="col-sm-12">
									<div class="row">
										<div class="col-sm-12">
											<a href="checkout.php" class="btn btn-block btn-chocolate btn-checkout">Check out</a>
										</div>
									</div>
								</div>
								<div class="col-sm-12 text-xs-center">
									<p style="font-size: 20px; margin-bottom: 0;">or</p>
								</div>

								<div class="col-sm-12">
									<div class="row">
										<div class="col-sm-12">
											<button class="btn btn-block btn-chocolate btn-checkout paypal">Check out with <img src="images/paypal.png" alt=""></button>
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
									<p>YOUR ORDER QUALIFIES FOR FREE SHIPPING. Join us for free shipping on every order, every time.</p>
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
							<img class="img-fluid" src="images/product-1.png" alt="">
							<div class="bg-gray"></div>
							<a href="add-to-cart.php" class="btn btn-chocolate cd-trigger">quick view <span class="fa fa-chevron-circle-right"></span></a>
						</div>
						<figcaption><p>Artisan chocolate box</p><span class="price-product">Contact for price & order</span></figcaption>
					</figure>
					<figure class="product-box text-xs-center">
						<div class="quick-view">
							<img class="img-fluid" src="images/product-6.png" alt="">
							<div class="bg-gray"></div>
							<a href="add-to-cart.php" class="btn btn-chocolate cd-trigger">quick view <span class="fa fa-chevron-circle-right"></span></a>
						</div>
						<figcaption><p>Chewy salted caramel box</p><span class="price-product">from $9.00</span></figcaption>
					</figure>
					<figure class="product-box text-xs-center">
						<div class="quick-view">
							<img class="img-fluid" src="images/product-12.png" alt="">
							<div class="bg-gray"></div>
							<a href="add-to-cart.php" class="btn btn-chocolate cd-trigger">quick view <span class="fa fa-chevron-circle-right"></span></a>
						</div>
						<figcaption><p>Coffee & caramel bar</p><span class="price-product">$7.50</span></figcaption>
					</figure>
					<figure class="product-box text-xs-center">
						<div class="quick-view">
							<img class="img-fluid" src="images/product-5.png" alt="">
							<div class="bg-gray"></div>
							<a href="add-to-cart.php" class="btn btn-chocolate cd-trigger">quick view <span class="fa fa-chevron-circle-right"></span></a>
						</div>
						<figcaption><p>Chocolate powder</p><span class="price-product">$20.00</span></figcaption>
					</figure>
					<figure class="product-box text-xs-center">
						<div class="quick-view">
							<img class="img-fluid" src="images/product-2.png" alt="">
							<div class="bg-gray"></div>
							<a href="add-to-cart.php" class="btn btn-chocolate cd-trigger">quick view <span class="fa fa-chevron-circle-right"></span></a>
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
		$(function ($) {
			var options = {
				minimum: 1,
                // maximize: 100,
                onChange: valChanged,
                onMinimum: function(e) {
                	console.log('reached minimum: '+e)
                },
                onMaximize: function(e) {
                	console.log('reached maximize'+e)
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
					onChange: function(){},
					onMinimum: function(){},
					onMaximize: function(){}
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
					if (maximize==null||num < maximize) {
						$input.val(num + 1)
						changeVal(num + 1)
					}
				})
				var keyUpTime
				$input.keyup(function () {
					clearTimeout(keyUpTime)
					keyUpTime = setTimeout(function() {
						var num = $input.val()
						if (num == ''){
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
						}else if (maximize!=null&&num > maximize) {
							$input.val(maximize)
							changeVal(maximize)
						} else {
							changeVal(num)
						}
					},300)
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
					} else if (maximize!=null&&num >= maximize) {
						$btnPlugs.prop('disabled', true)
						onMaximize.call(this, num)
					}
					onChange.call(this, num)
				}
				return $handleCounter
			};
		})(jQuery)



		$(document).ready(function() {




			/* Set rates + misc */
			var shippingRate = 2.00; 
			var fadeTime = 300;
			var taxRate = 0.02;


			/* Assign actions */
			$('input.quarity').change( function() {
				updateQuantity(this);
			});

			$('button.remove-product').click( function() {
				removeItem(this);
			});


			/* Recalculate cart */
			function recalculateCart()
			{
				var subtotal = 0;

				/* Sum up row totals */
				$('.product').each(function () {
					subtotal += parseFloat($(this).children('span.price-qty-total').text());
				});
				$('span.price-qty-total').each(function(){
		    			subtotal += parseFloat($(this).text());  // Or this.innerphp, this.innerText
		    		});
				/* Calculate totals */
				var shipping = (subtotal > 0 ? shippingRate : 0);
				var tax = taxRate * subtotal;
				var total = subtotal + shipping + tax;

				/* Update totals display */
				$('span.totals-value').fadeOut(fadeTime, function() {
					$('span#cart-subtotal').php(subtotal.toFixed(2));
					$('span#cart-tax').php(tax.toFixed(2));
					$('span#cart-total').php(total.toFixed(2));
					$('span.totals-value').fadeIn(fadeTime);
				});
			}

			/* Update quantity */
			function updateQuantity(quantityInput)
			{
				/* Calculate line price */
				var productRow = $(quantityInput).parent().parent();
				var price = parseFloat(productRow.children('span.price-product').text());
				var quantity = $(quantityInput).val();
				var linePrice = price * quantity;

				/* Update line price display and recalc cart totals */
				productRow.children('span.price-qty-total').each(function () {
					$(this).fadeOut(fadeTime, function() {
						$(this).text(linePrice.toFixed(2));
						recalculateCart();
						$(this).fadeIn(fadeTime);
					});
				});  
			}


			/* Remove item from cart */
			function removeItem(removeButton)
			{
				/* Remove row from DOM and recalc cart total */
				var productRow = $(removeButton).parent().parent();
				productRow.slideUp(fadeTime, function() {
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
</php>