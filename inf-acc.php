<?php include('includes/header.php'); ?>

	<div class="container-fluid" style="margin-top: 40px;">
		<div class="container">
			<div class="row bd-sign">
				<div class="col-sm-8 push-sm-2">
					<div class="card card-block cart-height">
						<form id="acc-infor">
							<h3 class="card-title text-xs-center">My Account Information</h3>
							<div class="row text-xs-center text-sm-left">
								<p class="name col-sm-6">Name: <span>John Smith</span></p>
								<p class="email col-sm-6">Email: <span>john@gmail.com</span></p>
							</div>
							<div class="row text-xs-center text-sm-left">
								<p class="phone col-sm-6">Phone Number: <span>+91 1234 5678</span></p>
								<p class="birthday col-sm-6">Birthdare: <span>26/03/1990</span></p>
							</div>
							<div class="row text-xs-center text-sm-left">
								<p class="address col-sm-6">Address: <span>125 Fifth Avenue, Manhattan</span></p>
								<p class="city-country col-sm-6">City, country: <span>New York</span></p>
							</div>
							<div class="row text-xs-center text-sm-left">
								<p class="stapro col-sm-6">State/Province: <span>123456</span></p>
								<p class="postal col-sm-6">Postal Code: <span>123456</span></p>
							</div>
							<div class="row text-xs-center">
								<p class="password col-sm-12 text-xs-center">Password: <span>***********</span></p>
							</div>
							<div class="row text-xs-center text-sm-left">
								<button type="button" class="edit-acc btn-none col-sm-6">Edit Account Information</button>
								<button type="button" class="edit-pass btn-none col-sm-6">Change your password</button>
							</div>
						</form>
						<form id="change-infor" style="display: none">
							<h3 class="card-title text-xs-center">Change Account Information</h3>
							<div class="row">
								<fieldset class="form-group col-sm-12">
									<label for="InputFirstName">*First Name</label>
									<input required type="text" class="form-control" id="InputFirstName" value="John">
								</fieldset>
								<fieldset class="form-group col-sm-12">
									<label for="InputLasttName">*Last Name</label>
									<input required type="text" class="form-control" id="InputLasttName" value="Smith">
								</fieldset>
							</div>
							<div class="row">
								<fieldset class="form-group col-sm-6">
									<label for="InputBirth">*Birthdate</label>
									<input required type="date" class="form-control" id="InputBirth" value="1990-03-06">
								</fieldset>
								<fieldset class="form-group col-sm-6">
									<label for="InputAddress">*Address</label>
									<input required type="text" class="form-control" id="InputAddress" value="125 Fifth Avenue, Manhattan">
								</fieldset>
							</div>
							<div class="row">
								<fieldset class="form-group col-sm-6">
									<label for="InputCity">*City</label>
									<input required type="text" class="form-control" id="InputCity" value="New York">
								</fieldset>
								<fieldset class="form-group col-sm-6">
									<label for="InputCountry">*Country</label>
									<input required type="text" class="form-control" id="InputCountry" value="New York">
								</fieldset>
							</div>
							<div class="row">
								<fieldset class="form-group col-sm-6">
									<label for="InputStaPro">*State/Province</label>
									<input required type="number" class="form-control" id="InputStaPro" value="123456">
								</fieldset>
								<fieldset class="form-group col-sm-6">
									<label for="InputPosCod">*Postal Code</label>
									<input required type="number" class="form-control" id="InputPosCod" value="123456">
								</fieldset>
							</div>
							<div class="row">
								<fieldset class="form-group col-sm-6">
									<label for="InputEmail2">*Email Address</label>
									<input required type="text" class="form-control" id="InputEmail" value="john@gmail.com">
								</fieldset>
								<fieldset class="form-group col-sm-6">
									<label for="InputPhone">*Phone Number</label>
									<input required type="text" class="form-control" id="InputPhone" value="+91 1234 5678">
								</fieldset>
							</div>
							<button type="submit" class="btn btn-chocolate text-xs-center">Change Information <span class="fa fa-chevron-circle-right"></span></button>
						</form>
						<form id="change-pass" style="display: none">
							<h3 class="card-title text-xs-center">Change Password</h3>
							<div class="row">
								<fieldset class="form-group col-sm-12">
									<label for="InputPassword2">*Current Password</label>
									<input required type="password" class="form-control" id="InputPassword2" placeholder="Password">
								</fieldset>
								<fieldset class="form-group col-sm-12">
									<label for="InputPassword2">*New Password</label>
									<input required type="password" class="form-control" id="InputPassword2" placeholder="New Password">
								</fieldset>
								<fieldset class="form-group col-sm-12">
									<label for="InputPassword2">*Comfirm Password</label>
									<input required type="password" class="form-control" id="InputPassword2" placeholder="Comfirm Password">
								</fieldset>
							</div>
							<button type="submit" class="btn btn-chocolate text-xs-center">Change Password <span class="fa fa-chevron-circle-right"></span></button>
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
						<img src="public/images/three-pods-logo.png" alt="">
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
	

	<script type="text/javascript">
		
	</script>
	
</body>
</html>