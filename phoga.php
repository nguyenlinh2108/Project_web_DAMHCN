<?php
require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/db/db.php";
$db = db::getInstance();
if ($db->select("SELECT * FROM type_product")) {
    $types = $db->getResult();//Danh sách các loại sản phẩm
}
?>
<div class="container-fluid pho-gal">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="titles text-xs-center">
                    <h2><span class="cho-left"></span> Photo Gallery <span class="cho-right"></span></h2>
                    <ul>
                        <?php
                        if (isset($types) && is_array($types)) {
                            foreach ($types as $type) {
                                ?>
                                <li><a href='list-type-product.php?id=<?= $type->id ?>'><?= $type->name; ?></a></li>
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

<div class="container-fluid">
    <div class="container">
        <div class="photos">
            <?php
            if (isset($types) && is_array($types)) {
                foreach ($types as $type) {
                    ?>
                    <div class="photo photo-w3">
                        <figure>
                            <img src="public/upload/type_product/<?php echo $type->image; ?>" alt="" class="">
                        </figure>
                    </div>
                    <?php
                }
            }
            ?>

        </div>
    </div>
</div>


<?php require_once __DIR__ . "/includes/link-menu.php"; ?>

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


<script type="text/javascript">
    $('.photos').isotope({
        // options
        itemSelector: '.photo',
        layoutMode: 'masonry'
    });
</script>

</body>
</html>