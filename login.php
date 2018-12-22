<?php include('includes/header.php'); ?>

	<div class="container-fluid log-forgot">
		<div class="container">
			<div class="row bd-sign">
				<div class="col-sm-6 push-sm-3 log">
					<div class="card card-block cart-height col-sm-10 push-sm-1">
						<h3 class="card-title text-xs-center">Login</h3>
						<form method="POST" action="inf-acc.php">
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
						<form method="POST" action="inf-acc.php">
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
	




<?php
require_once __DIR__ . "/includes/link-menu.php";
//require_once __DIR__ . "/includes/connect.php";
?>

	<div id="toTop">
		<span class="fa fa-chevron-up"></span>
	</div>
	<div id="toDown">
		<span class="fa fa-chevron-down"></span>
	</div>
	
	
</body>
</html>