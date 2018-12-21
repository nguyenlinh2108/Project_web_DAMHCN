<?php
require_once __DIR__ . "/../db/db.php";
$db = db::getInstance();
if ($db->select("SELECT * FROM type_product")) {
    $types = $db->getResult();//Danh sách các loại sản phẩm
}
?>
<div class="container-fluid link-menu">
		<div class="row">
			<div class="col-md-3 col-sm-12 col-xs-12 up-one text-xs-center">
				<a class="the-pods-footer" href="index.php">
					<img src="public/images/three-pods-logo.png" alt="">
					<p>THE PODS</p>
				</a>
			</div>
			<div class="col-md-2 col-sm-3 col-xs-6 up-one">
				<p class="title-footer">ABOUT US</p>
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="ours_tory.php">Our story</a></li>
					<li><a href="products.php">Products</a></li>
<!--					<li><a href="press.html">Press</a></li>-->
<!--					<li><a href="recipes.html">Recipes</a></li>-->
					<li><a href="phoga.php">Gallery</a></li>
				</ul>
			</div>
			<div class="col-md-2 col-sm-3 col-xs-6 up-one">
				<p class="title-footer">PRODUCTS</p>
				<ul>
                    <?php
                    if(isset($types) && is_array($types))
                    {
                        foreach ($types as $type)
                        {
                            ?>
                            <li><a href=""><?php echo $type->name; ?></a></li>
                            <?php
                        }
                    }
                    ?>
				</ul>
			</div>
			<div class="col-md-2 col-sm-3 col-xs-6 up-one">
				<p class="title-footer">SUPPORT</p>
				<ul>
					<li><a href="contact.php">Contact</a></li>
<!--					<li><a href="latest-news.html">Latest News</a></li>-->
<!--					<li><a href="">Privacy policy</a></li>-->
<!--					<li><a href="">Gift cards</a></li>-->
<!--					<li><a href="">FAQ</a></li>-->
				</ul>
			</div>
<!--			<div class="col-md-3 col-sm-3 col-xs-6 up-one">-->
<!--				<p class="title-footer">SUBSCRIBE OUR NEWSLETTER!</p>-->
<!--				<p class="details-footer">Let us update to you our news & promotion. <br> 25% discount code for any new subscription.</p>-->
<!--				<input type="email" placeholder="Enter your e-mail here" class="d-block mb-2">-->
<!--				<a href="" type="submit" class="btn btn-chocolate ">SUBSCRIBE <span class="fa fa-chevron-circle-right"></span></a>-->
<!--			</div>-->
		</div><!-- end row -->
	</div><!-- end ... -->

	<footer>
		<div class="container-fluid">
			<div class="container">
				<div class="row">
					<div class="col-md-12 down text-xs-center">
						<p>&copy; THE PODS.</p>
					</div>
				</div><!-- end row -->
			</div>
		</div>
	</footer><!-- end ... -->