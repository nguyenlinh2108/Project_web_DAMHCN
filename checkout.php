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
	
	<div class="container-fluid" style="margin-top: 40px">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<h2 class="text-xs-center">check out</h2>
				</div>
			</div><!-- end row -->
		</div><!-- end container -->
	</div><!-- end ... -->
	

	<div class="container-fluid checkout">
		<div class="container">
			<div class="row">
				<div class="col-sm-8 left-checkout">
					<div class="content">
						<div class="row title-content active title-1">
							<h2 class="col-xs-7 ">1. Shipping</h2>
							<div class="col-xs-5 text-xs-right">
								<button type="button" class="btn btn-chocolate border edit-1">edit</button>
							</div>
						</div>
						<div class="detail-content shipping-1">
							<form>
								<div class="form-group row">
									<label class="col-xs-3 push-xs-1" for="InputFirstName">*First Name</label>
									<div class="col-xs-7 push-xs-1">
										<input required type="text" class="form-control" id="InputFirstName" placeholder="John">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-xs-3 push-xs-1" for="InputLasttName">*Last Name</label>
									<div class="col-xs-7 push-xs-1">
										<input required type="text" class="form-control" id="InputLasttName" placeholder="Smith">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-xs-3 push-xs-1" for="InputAddress">*Address</label>
									<div class="col-xs-7 push-xs-1">
										<input required type="text" class="form-control" id="InputAddress" placeholder="125 Fifth Avenue, Manhattan">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-xs-3 push-xs-1" for="InputCity">*City</label>
									<div class="col-xs-7 push-xs-1">
										<input required type="text" class="form-control" id="InputCity" placeholder="NewYork">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-xs-3 push-xs-1" for="InputCountry">*Country</label>
									<div class="col-xs-7 push-xs-1">
										<input required type="text" class="form-control" id="InputConutry" placeholder="NewYork">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-xs-3 push-xs-1" for="InputPhone">*Phone Number</label>
									<div class="col-xs-7 push-xs-1">
										<input required type="text" class="form-control" id="InputPhone" placeholder="+91 1234 5678">
									</div>
								</div>
								<div class="row">
									<div class="col-xs-11 text-xs-right">
										<button type="button" class="btn btn-chocolate next-checkout next-1">Next</button>
									</div>
								</div>
							</form>
						</div><!-- end detail content -->
					</div><!-- end-content -->
					<div class="content">
						<div class="row title-content title-2">
							<h2 class="col-xs-7">2. Payment</h2>
							<div class="col-xs-5  text-xs-right">
								<button type="button" class="btn btn-chocolate border edit-2">edit</button>
							</div>
						</div>
						<div class="detail-content payment-2">
							<h3 class="col-xs-7 push-xs-1">CREDIT CARD INFORMATION</h3>
							<form>
								<div class="form-group row">
									<label class="col-xs-3 push-xs-1" for="InputChooseCard">*Card type</label>
									<div class="col-xs-7 push-xs-1">
										<label class="custom-control custom-radio">
											<input id="radio1" name="radio" type="radio" class="custom-control-input">
											<span class="custom-control-indicator"></span>
										</label>
										<label class="custom-control custom-radio">
											<input id="radio2" name="radio" type="radio" class="custom-control-input">
											<span class="custom-control-indicator bg-check-1"></span>
										</label>
										<label class="custom-control custom-radio">
											<input id="radio3" name="radio" type="radio" class="custom-control-input">
											<span class="custom-control-indicator bg-check-2"></span>
										</label>
										<label class="custom-control custom-radio">
											<input id="radio4" name="radio" type="radio" class="custom-control-input">
											<span class="custom-control-indicator bg-check-3"></span>
										</label>
									</div>
								</div>
								<div class="row">
									<fieldset class="form-group col-xs-10 push-xs-1">
										<label for="InputNameCard">*Name on card</label>
										<input required type="text" class="form-control" id="InputNameCard" placeholder="John Smith">
									</fieldset>
								</div>
								<div class="row">
									<fieldset class="form-group col-xs-5 push-xs-1">
										<label for="InputCardNumber">*Card number</label>
										<input required type="text" class="form-control" id="InputCardNumber" placeholder="54116462154">
									</fieldset>
									<fieldset class="form-group col-xs-5 push-xs-1">
										<label for="InputSecurityCode">*Security code</label>
										<input required type="text" class="form-control" id="InputSecurityCode" placeholder="4654564asd">
									</fieldset>
								</div>
								<div class="row">
									<fieldset class="form-group col-xs-10 push-xs-1">
										<label for="InputExDate">*Expiration date</label>
										<input required type="date" class="form-control" id="InputExdate1" placeholder="4654564asd">
									</fieldset>
								</div>
							</form>
							<h3 class="col-xs-7 push-xs-1" style="margin-top: 30px;">BILLING ADDRESS</h3>
							<form>
							 	<fieldset class="form-group col-xs-10 push-xs-1">
									<input id="radio1" name="radio" type="checkbox" class="check-button">
									<span class="">Same as shipping address</span>
								</fieldset>
							 	<div class="check-box">
									<div class="row">
										<fieldset class="form-group col-xs-5 push-xs-1">
											<label for="InputBollingPhone">*Billing phone</label>
											<input required type="text" class="form-control" id="InputBillingPhone" placeholder="">
										</fieldset>
										<fieldset class="form-group col-xs-5 push-xs-1">
											<p>Your registered number with your payment issuer is required to process your order.</p>
										</fieldset>
									</div>
									<div class="row">
										<fieldset class="form-group col-xs-5 push-xs-1">
											<label for="InputOtherPhone">Other phone</label>
											<input type="text" class="form-control" id="InputOtherPhone" placeholder="">
										</fieldset>
										<fieldset class="form-group col-xs-5 push-xs-1">
											<p>Please provide an alternate number we can call with questions about your order.</p>
										</fieldset>
									</div>
									<div class="row">
										<fieldset class="form-group col-xs-5 push-xs-1">
											<label for="InputEmail">*Email</label>
											<input required type="text" class="form-control" id="InputEmail" placeholder="">
										</fieldset>
										<fieldset class="form-group col-xs-5 push-xs-1">
											<p>This is where we’ll send your order confirmation.</p>
										</fieldset>
									</div>
								</div>
								<div class="no-check-box">
									<div class="form-group row">
										<label class="col-xs-3 push-xs-1" for="InputFirstName">*First Name</label>
										<div class="col-xs-7 push-xs-1">
											<input required type="text" class="form-control" id="InputFirstName" placeholder="John">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-xs-3 push-xs-1" for="InputLasttName">*Last Name</label>
										<div class="col-xs-7 push-xs-1">
											<input required type="text" class="form-control" id="InputLasttName" placeholder="Smith">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-xs-3 push-xs-1" for="InputAddress">*Address</label>
										<div class="col-xs-7 push-xs-1">
											<input required type="text" class="form-control" id="InputAddress" placeholder="125 Fifth Avenue, Manhattan">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-xs-3 push-xs-1" for="InputCity">*City</label>
										<div class="col-xs-7 push-xs-1">
											<input required type="text" class="form-control" id="InputCity" placeholder="NewYork">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-xs-3 push-xs-1" for="InputCountry">*Country</label>
										<div class="col-xs-7 push-xs-1">
											<input required type="text" class="form-control" id="InputConutry" placeholder="NewYork">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-xs-3 push-xs-1" for="InputBillingPhone">*Billing Phone</label>
										<div class="col-xs-7 push-xs-1">
											<input required type="text" class="form-control" id="InputBillingPhone" placeholder="015465666">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-xs-3 push-xs-1" for="InputOtherPhone">Other Phone</label>
										<div class="col-xs-7 push-xs-1">
											<input type="text" class="form-control" id="InputOtherPhone" placeholder="015465666">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-xs-3 push-xs-1" for="InputEmail">*Email</label>
										<div class="col-xs-7 push-xs-1">
											<input required type="text" class="form-control" id="InputEmail" placeholder="john">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-11 text-xs-right">
										<button type="button" class="btn btn-chocolate next-checkout next-2">Next</button>
									</div>
								</div>
							 </form>
						</div><!-- end detail content -->
					</div><!-- end-content -->
					<div class="content">
						<div class="row title-content title-3">
							<h2 class="col-xs-7">3. Preview</h2>
							<div class="col-xs-5  text-xs-right">
								<button type="button" class="btn btn-chocolate border edit-3">edit</button>
							</div>
						</div>
						<div class="detail-content preview-3">
							<div class="row">
								<div class="col-xs-10 push-xs-1">
									<h3>The order will be shipped to:</h3>
									<p>Name: <span class="fullname"></span></p>
									<p>Address: <span class="address"></span></p>
									<p>City, Country: <span class="city-country"></span></p>
									<p>Phone number: <span class="phone-number"></span></p>
									<button type="button" class="btn btn-chocolate next-checkout border">Modify</button>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-10 push-xs-1">
									<h3>The order will be pay with:</h3>
									<p><span class="Card-name"></span></p>
									<p>Card number: <span class="card-number"></span></p>
									<p>Code: <span class="code"></span></p>
									<h3>Card holder:</h3>
									<p>Name: <span class="fullname"></span></p>
									<p>Address: <span class="address"></span></p>
									<p>City, Country: <span class="city-country"></span></p>
									<button type="button" class="btn btn-chocolate next-checkout border">Modify</button>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-11 text-xs-right">
									<a href="order-success.php" class="btn btn-chocolate next-checkout">complete</a>
								</div>
							</div>
						</div><!-- end detail content -->
					</div><!-- end-content -->
				</div><!-- end left -->

				<div class="col-sm-4 right-checkout">
					<div class="content">
						<div class="title-content">
							<h2>summary</h2>
						</div>
						<div class="detail-content">
							<div class="row">
								<div class="col-xs-6 push-xs-1 col-sm-10 push-sm-1 col-md-6 push-md-1">
									<p class="subtotal">Subtotal</p>
								</div>
								<div class="col-xs-3 push-xs-2 col-sm-10 push-sm-1 col-md-4 push-md-1 col-lg-3 push-lg-2 text-xs-right">
									<span class="price-subtotal totals-value" id="cart-subtotal">100.00</span>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-6 push-xs-1 col-sm-10 push-sm-1 col-md-6 push-md-1">
									<p class="eshipping">Estamated Shipping</p>
								</div>
								<div class="col-xs-3 push-xs-2 col-sm-10 push-sm-1 col-md-4 push-md-1 col-lg-3 push-lg-2 text-xs-right">
									<span class="price-shipping totals-value" id="cart-shipping">2.00</span>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-6 push-xs-1 col-sm-10 push-sm-1 col-md-6 push-md-1">
									<p class="total">Total</p>
								</div>
								<div class="col-xs-3 push-xs-2 col-sm-10 push-sm-1 col-md-4 push-md-1 col-lg-3 push-lg-2 text-xs-right">
									<span class="price-total totals-value" id="cart-total">102.00</span>
								</div>
							</div>
						</div>
					</div><!-- end-content -->
					<div class="content">
						<div class="title-content">
							<h2>In your cart</h2>
						</div>
						<div class="detail-content">
							<div class="row added-product mt-0">
								<div class="col-xs-5 push-xs-1 col-sm-10 col-lg-5">
									<img src="images/product-2.png" alt="" class="img-fluid">
								</div>
								<div class="col-xs-5 push-xs-1 col-sm-10 col-lg-5">
									<p class="name-product">Chocolate truffle box</p>
									<span class="price-product">30.00</span>
									<span class="qty">Qty: 2</span>
									<a href="#" class="cuztomize">Cuztomize</a>
								</div>
							</div>
							<div class="row added-product">
								<div class="col-xs-5 col-sm-10 col-lg-5 push-xs-1">
									<img src="images/product-11.png" alt="" class="img-fluid">
								</div>
								<div class="col-xs-5 push-xs-1 col-md-10 col-lg-5">
									<p class="name-product">Pin tree & gifts chocolate</p>
									<span class="price-product">20.00</span>
									<span class="qty">Qty: 2</span>
									<a href="#" class="cuztomize">Cuztomize</a>
								</div>
							</div>
							<div class="row added-product">
								<div class="col-xs-12  text-xs-right">
									<a href="cart.php" class="btn btn-chocolate border">edit</a>
								</div>
							</div>
						</div>
					</div><!-- end-content -->
				</div><!-- end right -->
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
	
	<script type="text/javascript">
		$(document).ready(function() {
			
			/* Set rates + misc */
			var shippingRate = 2.00; 
			var fadeTime = 300;
			
			
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
				var total = subtotal + shipping;
				
				/* Update totals display */
				$('span.totals-value').fadeOut(fadeTime, function() {
					$('span#cart-subtotal').html(subtotal.toFixed(2));
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
		
	</script>   
</body>
</html>