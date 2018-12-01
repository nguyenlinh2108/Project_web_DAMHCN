	<?php
		include(__DIR__ . "/includes/header.php");
		include(__DIR__ . "/includes/slide.php");
		include(__DIR__ . "/includes/products.php");
		include(__DIR__ . "/includes/best-seller.php");
		include(__DIR__ . "/includes/event.php");
		include(__DIR__ . "/includes/news.php");
	?>

	<div class="pho-gal">
		<div class="container-fluid pho-gal">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-xs-12">
						<div class="titles text-xs-center">
							<h2><span class="cho-left"></span>  Photo Gallery  <span class="cho-right"></span></h2>
							<ul>
								<li><a href="">Chocolate</a></li>
								<li><a href="">Store</a></li>
								<li><a href="">Classes</a></li>
								<li><a href="">The making</a></li>
							</ul>
						</div>
					</div>
				</div><!-- end row -->
			</div><!-- end container -->
		</div>
		<div class="container-fluid bg-photo">
			<div class="container">
				<div class="photos">
					<div class="photo">
						<figure>
							<img src="public/images/photo-1.png" alt="" class="">
						</figure>
					</div>
					<div class="photo photo-w2">
						<figure>
							<img src="public/images/photo-2.png" alt="" class="">
						</figure>
					</div>
					<div class="photo">
						<figure>
							<img src="public/images/photo-3.png" alt="" class="">
						</figure>
					</div>
					<div class="photo photo-w3">
						<figure>
							<img src="public/images/photo-4.png" alt="" class="">
						</figure>
					</div>
					<div class="photo photo-w3">
						<figure>
							<img src="public/images/photo-5.png" alt="" class="">
						</figure>
					</div>
					<div class="photo photo-w3">
						<figure>
							<img src="public/images/photo-6.png" alt="" class="">
						</figure>
					</div>
					<div class="photo photo-w3">
						<figure>
							<img src="public/images/product-2.png" alt="" class="">
						</figure>
					</div>
					<div class="photo photo-w3">
						<figure>
							<img src="public/images/product-3.png" alt="" class="">
						</figure>
					</div>
					<div class="photo photo-w3">
						<figure>
							<img src="public/images/product-4.png" alt="" class="">
						</figure>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 push-md-4 text-xs-center see-all-photo">
						<a style="margin-bottom: 30px" href="phoga.php" class="btn btn-chocolate">see all the photo <span class="fa fa-chevron-circle-right"></span></a>
					</div>
				</div>
			</div>
		</div>
	</div><!-- end pho-gal -->

	<?php
		include('includes/location.php');
		include('includes/subcribe.php');
		include('includes/footer.php');
		include('includes/connect.php');
	?>

	<div id="toTop">
		<span class="fa fa-chevron-up"></span>
	</div>
	<div id="toDown">
		<span class="fa fa-chevron-down"></span>
	</div>
	

	<script type="text/javascript">
		$('.photos').isotope({
		  // options
		  itemSelector: '.photo',
		  layoutMode: 'masonry'
		});
	</script>

</body>
</html>