<?php include('includes/header.php'); ?>
	
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
					<div class="sp-loading"><img src="public/images/sp-loading.gif" alt=""><br>LOADING IMAGES</div>
					<div class="sp-wrap">
						<a href="images/product-7.png"><img src="public/images/product-7.png" alt=""></a>
						<a href="images/product-8.png"><img src="public/images/product-8.png" alt=""></a>
						<a href="images/product-13.png"><img src="public/images/product-13.png" alt=""></a>
						<a href="images/product-14.png"><img src="public/images/product-14.png" alt=""></a>
						<a href="images/product-15.png"><img src="public/images/product-15.png" alt=""></a>
						<a href="images/product-16.png"><img src="public/images/product-16.png" alt=""></a>
					</div>
				</div>
				<div class="col-md-5 push-md-1">
					<form class="choise-size" method="post" action="cart.php">
						<h3 style="font-family: 'BradleyHandITCTTBold'">SIGNATURE COLLECTION</h3>
						<div class="form-group row">
							<div class="col-xs-12">
								<span class="price-product">9.00</span>
								<span class="price-qty-total">18.00</span>
								<br>
								<p>SIZE</p>
								<label class="custom-control custom-radio">
									<input id="radio1" name="radio" type="radio" class="custom-control-input">
									<span class="custom-control-indicator" id="pieces-1">4 PIECES</span>
								</label>
								<label class="custom-control custom-radio">
									<input id="radio2" name="radio" type="radio" class="custom-control-input">
									<span class="custom-control-indicator" id="pieces-2">9 PIECES</span>
								</label>
								<label class="custom-control custom-radio">
									<input id="radio3" name="radio" type="radio" class="custom-control-input">
									<span class="custom-control-indicator" id="pieces-3">16 PIECES</span>
								</label>
								<br>
								<label class="custom-control custom-radio">
									<input id="radio4" name="radio" type="radio" class="custom-control-input">
									<span class="custom-control-indicator" id="pieces-4">24 PIECES</span>
								</label>
								<label class="custom-control custom-radio">
									<input id="radio4" name="radio" type="radio" class="custom-control-input">
									<span class="custom-control-indicator" id="pieces-5">32 PIECES</span>
								</label>
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
					<p>The sun-kissed flavors of the Mediterranean are vividly displayed in Zoe's Signature Collection.  Be transported to blue water, gentle winds and sunny skies, with fresh picked lemon, wild mint, Greek Isle spices, and fragrant flowers with flavors like Persephone's Pomegranate, Baklava, Sesame Tahini, and Black Raspberry.</p>
				</div>
			</div><!-- end row -->
		</div>
	</div><!-- end ... -->


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
							<a href="add-to-cart.php" class="btn btn-chocolate cd-trigger">quick view <span class="fa fa-chevron-circle-right"></span></a>
						</div>
						<figcaption><p>Artisan chocolate box</p><span class="price-product">Contact for price & order</span></figcaption>
					</figure>
					<figure class="product-box text-xs-center">
						<div class="quick-view">
							<img class="img-fluid" src="public/images/product-6.png" alt="">
							<div class="bg-gray"></div>
							<a href="add-to-cart.php" class="btn btn-chocolate cd-trigger">quick view <span class="fa fa-chevron-circle-right"></span></a>
						</div>
						<figcaption><p>Chewy salted caramel box</p><span class="price-product">from $9.00</span></figcaption>
					</figure>
					<figure class="product-box text-xs-center">
						<div class="quick-view">
							<img class="img-fluid" src="public/images/product-12.png" alt="">
							<div class="bg-gray"></div>
							<a href="add-to-cart.php" class="btn btn-chocolate cd-trigger">quick view <span class="fa fa-chevron-circle-right"></span></a>
						</div>
						<figcaption><p>Coffee & caramel bar</p><span class="price-product">$7.50</span></figcaption>
					</figure>
					<figure class="product-box text-xs-center">
						<div class="quick-view">
							<img class="img-fluid" src="public/images/product-5.png" alt="">
							<div class="bg-gray"></div>
							<a href="add-to-cart.php" class="btn btn-chocolate cd-trigger">quick view <span class="fa fa-chevron-circle-right"></span></a>
						</div>
						<figcaption><p>Chocolate powder</p><span class="price-product">$20.00</span></figcaption>
					</figure>
					<figure class="product-box text-xs-center">
						<div class="quick-view">
							<img class="img-fluid" src="public/images/product-2.png" alt="">
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
	<script src="public/js/smoothproducts.js" type="text/javascript" charset="utf-8" async defer></script>
	<script type="text/javascript">
		$(".regular").slick({
	        dots: true,
	        infinite: true,
	        slidesToShow: 4,
	        slidesToScroll: 1
	    });
		$(window).load(function() {
			$('.sp-wrap').smoothproducts();
		});
		
	</script>
	
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
		    			subtotal += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
		    		});
				/* Calculate totals */
				var shipping = (subtotal > 0 ? shippingRate : 0);
				var tax = taxRate * subtotal;
				var total = subtotal + shipping + tax;

				/* Update totals display */
				$('span.totals-value').fadeOut(fadeTime, function() {
					$('span#cart-subtotal').html(subtotal.toFixed(2));
					$('span#cart-tax').html(tax.toFixed(2));
					$('span#cart-total').html(total.toFixed(2));
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
</html>