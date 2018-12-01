<?php include('includes/header.php'); ?>

	<div class="container-fluid log-forgot">
		<div class="container">
			<div class="row bd-sign">
				<div class="col-sm-6 push-sm-3 log">
					<div class="card card-block cart-height col-sm-10 push-sm-1">
						<h3 class="card-title text-xs-center">Login</h3>
						<form method="POST" action="inf-acc.html">
							<fieldset class="form-group">
								<label for="InputEmail">*Email Address:</label>
								<input required type="text" class="form-control" id="InputEmail" placeholder="john@gmail.com">
							</fieldset>
							<fieldset class="form-group">
								<label for="InputPassword">*Password</label>
								<input required type="password" class="form-control" id="InputPassword" placeholder="Password">
							</fieldset>
							<fieldset class="form-group">
								<input class="form-check-inline" type="checkbox" value="">
								Keep my login information
							</fieldset>
							<fieldset class="form-group">
								<button type="button" class="forgot-pass btn-none">Forgot Password</button>
							</fieldset>
							<fieldset class="form-group">
								<button type="button" class="creat-acc btn-none">Create account</button>
							</fieldset>
							<button type="submit" class="btn btn-chocolate">Login <span class="fa fa-chevron-circle-right"></span></button>
						</form>
					</div>
				</div>
				<div class="col-sm-6 push-sm-3 forgot">
					<div class="card card-block cart-height col-sm-10 push-sm-1">
						<h3 class="card-title text-xs-center">Forgot Password</h3>
						<p class="card-text ">Because of security procedures, we cannot retrieve your password and send it to you. However, we can reset the password and send you the new one. Please note that the password is reset as soon as this is requested. The new password will be sent to the address specified when the account was setup.</p>
						<form>
							<fieldset class="form-group">
								<label for="InputEmail1">*Email Address:</label>
								<input required type="text" class="form-control" id="InputEmail1" placeholder="john@gmail.com">
							</fieldset>
							<fieldset class="form-group">
								<button type="button" class="log-in btn-none">Login</button>
							</fieldset>
							<fieldset class="form-group">
								<button type="button" class="creat-acc btn-none">Create account</button>
							</fieldset>
							<button type="submit" class="btn btn-chocolate text-xs-center">Reset <span class="fa fa-chevron-circle-right"></span></button>
						</form>
					</div>
				</div>
			</div>
		</div><!-- end container -->
	</div><!-- end ... -->
	

	<div class="container-fluid create-acc">
		<div class="container">
			<div class="row bd-sign">
				<div class="col-sm-8 push-sm-2">
					<div class="card card-block cart-height">
						<h3 class="card-title text-xs-center">New Member Registration</h3>
						<form method="POST" action="inf-acc.html">
							<div class="row">
								<fieldset class="form-group col-sm-6">
									<label for="InputFirstName">*First Name</label>
									<input required type="text" class="form-control" id="InputFirstName" placeholder="John">
								</fieldset>
								<fieldset class="form-group col-sm-6">
									<label for="InputLasttName">*Last Name</label>
									<input required type="text" class="form-control" id="InputLasttName" placeholder="Smith">
								</fieldset>
							</div>
							<div class="row">
								<fieldset class="form-group col-sm-6">
									<label for="InputBirth">*Birthdate</label>
									<input required type="date" class="form-control" id="InputBirth" placeholder="26/03/1990">
								</fieldset>
								<fieldset class="form-group col-sm-6">
									<label for="InputAddress">*Address</label>
									<input required type="text" class="form-control" id="InputAddress" placeholder="125 Fifth Avenue, Manhattan">
								</fieldset>
							</div>
							<div class="row">
								<fieldset class="form-group col-sm-6">
									<label for="InputCity">*City</label>
									<input required type="text" class="form-control" id="InputCity" placeholder="NewYork">
								</fieldset>
								<fieldset class="form-group col-sm-6">
									<label for="InputCountry">*Country</label>
									<input required type="text" class="form-control" id="InputCountry" placeholder="NewYork">
								</fieldset>
							</div>
							<div class="row">
								<fieldset class="form-group col-sm-6">
									<label for="InputStaPro">*State/Province</label>
									<input required type="number" class="form-control" id="InputStaPro" placeholder="123456">
								</fieldset>
								<fieldset class="form-group col-sm-6">
									<label for="InputPosCod">*Postal Code</label>
									<input required type="number" class="form-control" id="InputPosCod" placeholder="123456">
								</fieldset>
							</div>
							<div class="row">
								<fieldset class="form-group col-sm-6">
									<label for="InputEmail2">*Email Address</label>
									<input required type="text" class="form-control" id="InputEmail" placeholder="john@gmail.com">
								</fieldset>
								<fieldset class="form-group col-sm-6">
									<label for="InputPhone">*Phone Number</label>
									<input required type="text" class="form-control" id="InputPhone" placeholder="+91 1234 5678">
								</fieldset>
							</div>
							<div class="row">
								<fieldset class="form-group col-sm-6">
									<label for="InputPassword2">*Password</label>
									<input required type="password" class="form-control" id="InputPassword2" placeholder="Password">
								</fieldset>
								<fieldset class="form-group col-sm-6">
									<label for="InputPassword2">*Comfirm Password</label>
									<input required type="password" class="form-control" id="InputPassword2" placeholder="Password">
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
							<button type="submit" class="btn btn-chocolate text-xs-center">Create Account <span class="fa fa-chevron-circle-right"></span></button>
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
						<img src="images/three-pods-logo.png" alt="">
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
					<p class="details-footer">Let us update to you our news & promotion. <br> 25% discount code for any new subscription.</p>
					<input type="email" placeholder="Enter your e-mail here" class="d-block mb-2">
					<a href="" type="submit" class="btn btn-chocolate ">SUBSCRIBE <span class="fa fa-chevron-circle-right"></span></a>
				</div>
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