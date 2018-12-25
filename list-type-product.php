<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/25/2018
 * Time: 10:23 PM
 */
ob_start();
require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/db/db.php";
$db = db::getInstance();
if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range'=>1)))
{
    $id_type = $_GET['id'];
    if($db->select_one("SELECT * FROM type_product WHERE id={$id_type}"))
    {
        $name_type = $db->getResult()->name;
    }
}else{
    header("Location: index.php");
    exit();
}
if ($db->select("SELECT * FROM type_product")) {
    $types = $db->getResult();//Danh sách các loại sản phẩm
}

?>

<div class="container-fluid" style="margin-top: 40px">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="text-xs-center"><?php if(isset($name_type)) echo $name_type; ?></h2>
            </div>
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end ... -->

<div class="container-fluid products-shop">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="grid row show-products">
                    <?php
                    if (isset($id_type)) {
                        if ($db->select("SELECT * FROM product WHERE  type = {$id_type}")) {
                            $type_product_selects = $db->getResult();//Danh sách sản phẩm
                            foreach ($type_product_selects as $type_product_select) {
                                if ($type_product_select->soluong >= 0) {
                                    ?>
                                    <div class="element-item button col-md-3 col-sm-6 col-xs-6">
                                        <figure class="product-box text-xs-center">
                                            <div class="quick-view">
                                                <img class="img-fluid"
                                                     src="public/upload/product/<?= $type_product_select->image ?>"
                                                     alt="">
                                                <div class="bg-gray"></div>
                                                <a href="product.php?id=<?= $type_product_select->id ?>"
                                                   class="btn btn-chocolate cd-trigger"> Xem thêm <span
                                                            class="fa fa-chevron-circle-right"></span></a>
                                            </div>
                                            <figcaption><p><?php echo $type_product_select->name ?></p><span
                                                        class="price-product"><?= $type_product_select->unit_price ?>
                                                    đ</span></figcaption>
                                        </figure>
                                    </div>
                                    <?php
                                }
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end ... -->

<!-- <div class="bg-detail-item"></div>
<div class="container-fluid detail-item">
    <div class="container">
        <div class="row">
            <div class="col-sm-5 col-xs-12 left-item">
                <img src="public/images/product-1.png" alt="" class="img-fluid">
                <span class="close-add hidden-sm-up fa fa-times"></span>
            </div>
            <div class="col-sm-7 col-xs-12 right-item">
                <h3>Artisan chocolate box</h3>
                <span class="close-add hidden-xs-down fa fa-times"></span>
                <p class="inf-product">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem placeat eveniet, enim, delectus est iusto minima praesentium laboriosam rerum expedita temporibus dolorem sunt officia quae eum eos, fugit pariatur quas.</p>
                <span class="price-product">Contact for price & order</span>
                <a href="" class="btn btn-chocolate">Add to cart</a>
            </div>
        </div>
    </div>
</div> -->

<?php require_once __DIR__ . "/includes/link-menu.php";
ob_flush();
?>

<!--	<div class="connect">-->
<!--		<a href="#"><span class="fa fa-facebook"></span></a>-->
<!--		<a href="#"><span class="fa fa-twitter"></span></a>-->
<!--		<a href="#"><span class="fa fa-google-plus"></span></a>-->
<!--		<a href="#"><span class="fa fa-instagram"></span></a>-->
<!--	</div>-->

<div id="toTop">
    <span class="fa fa-chevron-up"></span>
</div>
<div id="toDown">
    <span class="fa fa-chevron-down"></span>
</div>



</body>
</html>
