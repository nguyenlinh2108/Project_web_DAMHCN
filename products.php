<?php
require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/db/db.php";
$db = db::getInstance();
if ($db->select("SELECT * FROM type_product")) {
    $types = $db->getResult();//Danh sách các loại sản phẩm
}

?>

<div class="container-fluid" style="margin-top: 40px">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="text-xs-center">Products</h2>
            </div>
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end ... -->

<div class="container-fluid products-shop">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3">
                <div class="button-show-menu">
                    <button class="hidden-sm-up btn btn-chocolate show-menu-shop" type="button">Shop</button>
                    <div class="shop-menu button-group filters-button-group">
                        <h2 class="hidden-xs-down">Shop</h2>
                        <ul>
                            <li>
                                <button class="button is-checked" data-filter="*"><span class="circle"></span>Show all
                                </button>
                            </li>
                            <?php
                            if (isset($types) && is_array($types)) {
                                for ($i = 0; $i < count($types); $i++) {
                                    ?>
                                    <li>
                                        <button class="button" data-filter=".button<?= $i ?>"><span
                                                    class="circle"></span><?= $types[$i]->name; ?>
                                        </button>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-sm-9">
                <div class="grid row show-products">
                    <?php
                    if (isset($types) && is_array($types)) {
                        for ($i = 0; $i < count($types); $i++) {
                            $id_type = $types[$i]->id;
                            if ($db->select("SELECT * FROM product WHERE  type = {$id_type}")) {
                                $type_product_selects = $db->getResult();//Danh sách sản phẩm

                                foreach ($type_product_selects as $type_product_select) {
                                    if ($type_product_select->soluong > 0) {
                                        ?>
                                        <div class="element-item button<?= $i ?> col-md-4 col-sm-6 col-xs-6">
                                            <figure class="product-box text-xs-center">
                                                <div class="quick-view">
                                                    <img class="img-fluid"
                                                         src="public/upload/product/<?= $type_product_select->image ?>"
                                                         alt="">
                                                    <div class="bg-gray"></div>
                                                    <a href="add-to-cart.php?id=<?= $type_product_select->id ?>"
                                                       class="btn btn-chocolate cd-trigger">quick view <span
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

    // external js: isotope.pkgd.js

    // init Isotope
    var iso = new Isotope('.grid', {
        itemSelector: '.element-item',
        layoutMode: 'fitRows'
    });

    // filter functions
    var filterFns = {
        // show if number is greater than 50
        numberGreaterThan50: function (itemElem) {
            var number = itemElem.querySelector('.number').textContent;
            return parseInt(number, 10) > 50;
        },
        // show if name ends with -ium
        ium: function (itemElem) {
            var name = itemElem.querySelector('.name').textContent;
            return name.match(/ium$/);
        }
    };

    // bind filter button click
    var filtersElem = document.querySelector('.filters-button-group');
    filtersElem.addEventListener('click', function (event) {
        // only work with buttons
        if (!matchesSelector(event.target, 'button')) {
            return;
        }
        var filterValue = event.target.getAttribute('data-filter');
        // use matching filter function
        filterValue = filterFns[filterValue] || filterValue;
        iso.arrange({filter: filterValue});
    });

    // change is-checked class on buttons
    var buttonGroups = document.querySelectorAll('.button-group');
    for (var i = 0, len = buttonGroups.length; i < len; i++) {
        var buttonGroup = buttonGroups[i];
        radioButtonGroup(buttonGroup);
    }

    function radioButtonGroup(buttonGroup) {
        buttonGroup.addEventListener('click', function (event) {
            // only work with buttons
            if (!matchesSelector(event.target, 'button')) {
                return;
            }
            buttonGroup.querySelector('.is-checked').classList.remove('is-checked');
            event.target.classList.add('is-checked');
        });
    }

    $(window).scroll(function () {
        if ($(window).scrollTop() > 250) {
            $('.button-show-menu').addClass('button-show-menu-fixed');
        }
        else {
            $('.button-show-menu').removeClass('button-show-menu-fixed');
        }
    });
</script>


</body>
</html>