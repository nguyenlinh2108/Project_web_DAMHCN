<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/25/2018
 * Time: 5:43 PM
 */
ob_start();
require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/db/db.php";
$db = db::getInstance();
if ($db->select("SELECT * FROM type_product")) {
    $types = $db->getResult();//Danh sách các loại sản phẩm
}
$mess = "";
if(isset($_GET['searchcontent']) && $_GET['searchcontent']!==""){
    $description = $_GET['searchcontent'];
    if($db->select("SELECT * FROM product WHERE name LIKE '%".$description."%' OR description  LIKE '%".$description."%'"))
    {
        $productsearchs = $db->getResult();
        $mess = "Kết quả tìm kiếm với từ khóa: ".$description;
    }else{
        $mess = "Không có kết quả nào";
    }
}else{
    header("Location: index.php");
    exit();
}
?>
<div class="container-fluid products-shop">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3 mt-3">
                <?php
                if($mess !== ""){
                    echo $mess;
                }
                ?>
            </div>
            <div class="col-md-9 col-sm-9 mt-3">
                <div class="grid row show-products">
                    <?php
                    if(isset($productsearchs) && is_array($productsearchs))
                    {
                        foreach ($productsearchs as $productsearch)
                        {
                            ?>
                            <div class="element-item button<?= $productsearch->id ?> ?> col-md-4 col-sm-6 col-xs-6">
                                <figure class="product-box text-xs-center">
                                    <div class="quick-view">
                                        <img class="img-fluid"
                                             src="public/upload/product/<?= $productsearch->image ?>"
                                             alt="">
                                        <div class="bg-gray"></div>
                                        <a href="product.php?id=<?= $productsearch->id ?>"
                                           class="btn btn-chocolate cd-trigger"> Xem thêm <span
                                                class="fa fa-chevron-circle-right"></span></a>
                                    </div>
                                    <figcaption><p><?php echo $productsearch->name ?></p><span
                                            class="price-product"><?= $productsearch->unit_price ?>
                                            đ</span></figcaption>
                                </figure>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div><!-- end container -->
</div><!-- end ... -->

<?php
require_once __DIR__ . "/includes/link-menu.php";
ob_flush();
?>
<div id="toTop">
    <span class="fa fa-chevron-up"></span>
</div>
<div id="toDown">
    <span class="fa fa-chevron-down"></span>
</div>