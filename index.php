<?php
$current_page = basename(__FILE__, '.php');

require_once(__DIR__ . "/includes/header-home.php");
require_once(__DIR__ . "/includes/slide.php");
require_once(__DIR__ . "/includes/products.php");
// require_once(__DIR__ . "/includes/best-seller.php");
// require_once(__DIR__ . "/includes/event.php");
//require_once(__DIR__ . "/includes/news.php");
require_once __DIR__ . "/db/db.php";
$db = db::getInstance();
if ($db->select("SELECT * FROM type_product ORDER BY RAND() LIMIT 5")) {
    $types = $db->getResult();//Danh sách các loại sản phẩm
}
?>

<div class="pho-gal">
    <div class="container-fluid pho-gal">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="titles text-xs-center">
                        <h2><span class="cho-left"></span> Photo Gallery <span class="cho-right"></span></h2>
                        <ul>
                            <?php
                            if (isset($types) && is_array($types)) {
                                $i = 0;
                                foreach ($types as $type) {
                                    ?>
                                    <li><a href=""><?php echo $type->name; ?></a></li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div><!-- end row -->
        </div><!-- end container -->
    </div>
    <div class="container-fluid bg-photo">
        <div class="container">
            <div class="photos">
                <?php
                if (isset($types) && is_array($types)) {
                    $i = 0;
                    foreach ($types as $type) {
                        ?>
                        <div class="photo">
                            <figure>
                                <img src="public/upload/type_product/<?php echo $type->image; ?>" alt="" class="">
                            </figure>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            <div class="row">
                <div class="col-md-4 push-md-4 text-xs-center see-all-photo">
                    <a style="margin-bottom: 30px" href="phoga.php" class="btn btn-chocolate">see all the photo <span
                                class="fa fa-chevron-circle-right"></span></a>
                </div>
            </div>
        </div>
    </div>
</div><!-- end pho-gal -->

<?php
//include('includes/location.php');
//include('includes/subcribe.php');
include('includes/footer.php');
//include('includes/connect.php');
?>

<div id="toTop">
    <span class="fa fa-chevron-up"></span>
</div>
<div id="toDown">
    <span class="fa fa-chevron-down"></span>
</div>


<!--	<script type="text/javascript">-->
<!--		$('.photos').isotope({-->
<!--		  // options-->
<!--		  itemSelector: '.photo',-->
<!--		  layoutMode: 'masonry'-->
<!--		});-->
<!--	</script>-->

</body>
</html>