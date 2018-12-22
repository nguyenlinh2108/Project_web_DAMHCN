<?php
require_once __DIR__ . "/../db/db.php";
$db = db::getInstance();
if ($db->select("SELECT * FROM product")) {
    $products = $db->getResult();//Danh sách sản phẩm
}
?>
<div class="container-fluid products">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="titles text-xs-center">
					<h2><span class="cho-left"></span>  Products  <span class="cho-right"></span></h2>
					<p>Having one of the best quality cocoa pods in the world, we proudly present the art of making chocolate with our skillful artisans.</p>
				</div>
			</div>
		</div>
		<div class="row">
			<section class="center1 slider hidden-sm-down">
                <?php
                if(isset($products) && is_array($products))
                {
                    foreach ($products as $product)
                    {
                        if($product->soluong >0) {
                            ?>
                            <div class="item">
                                <div class="bd-item">
                                    <img src="../public/upload/product/<?php echo $product->image; ?>" height="303px">
                                    <p><?php echo $product->name; ?></p>
                                    <span class="price-product"><?php echo $product->unit_price; ?></span>
                                    <a href="../add-to-cart.php?id=<?php echo $product->id; ?>"
                                       class="btn btn-chocolate no-bg">see product <span
                                                class="fa fa-chevron-circle-right"></span></a>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
                ?>
			</section>

			<section class="center2 slider hidden-sm-up">
                <?php
                if(isset($products) && is_array($products))
                {
                    foreach ($products as $product)
                    {
                        if($product->soluong > 0) {
                            ?>
                            <div class="item">
                                <div class="bd-item">
                                    <img src="../public/upload/product/<?php echo $product->image; ?>" height="303px">
                                    <p><?php echo $product->name; ?></p>
                                    <span class="price-product"><?php echo $product->unit_price; ?></span>
                                    <a href="../add-to-cart.php?id=<?php echo $product->id; ?>"
                                       class="btn btn-chocolate no-bg">see product <span
                                                class="fa fa-chevron-circle-right"></span></a>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
                ?>
			</section>

			
			<div class="col-md-4 push-md-4 text-xs-center see-all">
				<a href="../products.php" class="btn btn-chocolate">see all the pods products <span class="fa fa-chevron-circle-right"></span></a>
			</div>
		</div>
	</div>
</div>