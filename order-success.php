<?php
include('includes/header.php');
require_once __DIR__ . "/db/db.php";

$db::getInstance();

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
			</div><!-- end row -->
		</div><!-- end container -->
	</div><!-- end ... -->
	
	<div class="container-fluid">
		<div class="container order-received">
			<div class="row">
				<div class="col-md-10 push-md-1">
					<h2>Your order has been received</h2>
					<h3>Thank you for your purchase</h3>
					<p>Your order number is: <?php if(isset($_GET['bill_id'])) echo $_GET['bill_id'] ?></p>
					<p>You will receive an order confirmation email with details of your order and a link to track its progress</p>
					<p>Click here to print a copy of your order confirmation</p>
				</div>
				<div class="col-md-10 push-md-1 text-sm-right text-xs-center">
					<a href="products.php" class="btn btn-chocolate">Continue shopping</a>
				</div>
			</div><!-- end row -->
		</div><!-- end container -->
	</div><!-- end ... -->


	<?php include ("includes/link-menu.php");?>

	<div id="toTop">
		<span class="fa fa-chevron-up"></span>
	</div>
	<div id="toDown">
		<span class="fa fa-chevron-down"></span>
	</div>
	
	
</body>
</html>