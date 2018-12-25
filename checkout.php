<?php
include('includes/header.php');
ob_start();
require_once __DIR__ . "/admin/class/auth.php";
require_once __DIR__ . "/db/db.php";
$db = db::getInstance();
if (isset($_SESSION['customer_login'])) {
    $id = $_SESSION['customer_login']['id'];
    if ($db->select_one("SELECT * FROM customer WHERE id={$id}")) {
        {
            $name_db = $db->getResult()->name;
            $gender_db = $db->getResult()->gender;
            $email_db = $db->getResult()->email;
            $address_db = $db->getResult()->address;
            $phone_db = $db->getResult()->phone;
            $birthday_db = $db->getResult()->birthday;
            $note_db = $db->getResult()->note;
            $point_db = $db->getResult()->point;
        }
    } else {
        header('Location: index.php');
        exit();
    }
} else {
    header('Location: index.php');
    exit();
}
$product_cards = array();
if (isset($_COOKIE['product_cart'])) {
    $product_cards = json_decode($_COOKIE['product_cart']);
}

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
	
	<div class="container-fluid" style="margin-top: 40px">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<h2 class="text-xs-center">check out</h2>
				</div>
			</div><!-- end row -->
		</div><!-- end container -->
	</div><!-- end ... -->


	<div class="container-fluid checkout">
		<div class="container">
			<div class="row">
				<div class="col-sm-8 left-checkout">
					<div class="content">
						<div class="row title-content active title-1">
							<h2 class="col-xs-7 ">1. Shipping</h2>
							<div class="col-xs-5 text-xs-right">
								<button type="button" class="btn btn-chocolate border edit-1">edit</button>
							</div>
						</div>
						<div class="detail-content shipping-1">
                            <fieldset class="form-group col-xs-10 push-xs-1">
                                <i style="font-size: 15px; color: firebrick;">Đơn hàng sẽ được gửi đến địa chỉ trong thông tin tài khoản của bạn.
                                    Muốn thay đổi địa chỉ gửi hãy vào thay đổi tronng thông tin tài khoản!</i>
                            </fieldset>
							<form>
								<div class="form-group row">
									<label class="col-xs-3 push-xs-1" for="InputFirstName">*Name</label>
									<div class="col-xs-7 push-xs-1">
										<input required type="text" class="form-control"
                                               value="<?php if(isset($name_db)) echo $name_db; ?>" readonly
                                               id="InputFirstName" placeholder="John">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-xs-3 push-xs-1" for="InputLasttName">*Email</label>
									<div class="col-xs-7 push-xs-1">
										<input required type="text" class="form-control"
                                               value="<?php if(isset($email_db)) echo $email_db; ?>" readonly
                                               id="InputLasttName" placeholder="john@gmail.com">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-xs-3 push-xs-1" for="InputAddress">*Address</label>
									<div class="col-xs-7 push-xs-1">
										<input required type="text" class="form-control"
                                               value="<?php if(isset($address_db)) echo $address_db; ?>" readonly
                                               id="InputAddress" placeholder="125 Fifth Avenue, Manhattan">
									</div>
								</div>
                                <div class="form-group row">
                                    <label class="col-xs-3 push-xs-1" for="InputPhone">*Phone Number</label>
                                    <div class="col-xs-7 push-xs-1">
                                        <input required type="text" class="form-control"
                                               value="<?php if(isset($phone_db)) echo $phone_db; ?>" readonly
                                               id="InputPhone" placeholder="+91 1234 5678">
                                    </div>
                                </div>
								<div class="form-group row">
									<label class="col-xs-3 push-xs-1" for="InputCity">*Point</label>
									<div class="col-xs-7 push-xs-1">
										<input required type="text" class="form-control"
                                               value="<?php if(isset($point_db)) echo $point_db; ?>" readonly
                                               id="InputCity" placeholder="0">
									</div>
								</div>
								<div class="row">
									<div class="col-xs-11 text-xs-right">
										<button type="button" class="btn btn-chocolate next-checkout next-1">Next</button>
									</div>
								</div>
							</form>
						</div><!-- end detail content -->
					</div><!-- end-content -->
					<div class="content">
						<div class="row title-content title-2">
							<h2 class="col-xs-7">2. Payment</h2>
							<div class="col-xs-5  text-xs-right">
								<button type="button" class="btn btn-chocolate border edit-2">edit</button>
							</div>
						</div>
						<div class="detail-content payment-2">
							<form>
                                <fieldset class="form-group col-xs-10 push-xs-1">
                                    <input id="radio-payment" name="radio" type="checkbox" class="check-box-payment">
                                    <span class="">Change to ATM</span>
                                </fieldset>
                                <div class="check-box">
                                    <h3 class="col-xs-7 push-xs-1">CREDIT CARD INFORMATION</h3>
                                    <div class="form-group row">
                                        <label class="col-xs-3 push-xs-1" for="InputChooseCard">*Card type</label>
                                        <div class="col-xs-7 push-xs-1">
                                            <label class="custom-control custom-radio">
                                                <input id="radio1" name="radio" type="radio" class="custom-control-input">
                                                <span class="custom-control-indicator"></span>
                                            </label>
                                            <label class="custom-control custom-radio">
                                                <input id="radio2" name="radio" type="radio" class="custom-control-input">
                                                <span class="custom-control-indicator bg-check-1"></span>
                                            </label>
                                            <label class="custom-control custom-radio">
                                                <input id="radio3" name="radio" type="radio" class="custom-control-input">
                                                <span class="custom-control-indicator bg-check-2"></span>
                                            </label>
                                            <label class="custom-control custom-radio">
                                                <input id="radio4" name="radio" type="radio" class="custom-control-input">
                                                <span class="custom-control-indicator bg-check-3"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <fieldset class="form-group col-xs-10 push-xs-1">
                                            <label for="InputNameCard">*Name on card</label>
                                            <input required type="text" class="form-control" id="InputNameCard" placeholder="John Smith">
                                        </fieldset>
                                    </div>
                                    <div class="row">
                                        <fieldset class="form-group col-xs-5 push-xs-1">
                                            <label for="InputCardNumber">*Card number</label>
                                            <input required type="text" class="form-control" id="InputCardNumber" placeholder="54116462154">
                                        </fieldset>
                                        <fieldset class="form-group col-xs-5 push-xs-1">
                                            <label for="InputSecurityCode">*Security code</label>
                                            <input required type="text" class="form-control" id="InputSecurityCode" placeholder="4654564asd">
                                        </fieldset>
                                    </div>
                                    <div class="row">
                                        <fieldset class="form-group col-xs-10 push-xs-1">
                                            <label for="InputExDate">*Expiration date</label>
                                            <input required type="date" class="form-control" id="InputExdate1" placeholder="4654564asd">
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="no-check">
                                    <h3 class="col-xs-7 push-xs-1">COD</h3>
                                    <fieldset class="form-group col-xs-10 push-xs-1">
                                        <i style="font-size: 15px; color: firebrick;">Đơn hàng sẽ được gửi đến địa chỉ trong thông tin tài khoản của bạn.
                                            Muốn thay đổi địa chỉ gửi hãy vào thay đổi tronng thông tin tài khoản!</i>
                                    </fieldset>
                                </div>
                                <div class="row">
                                    <div class="col-xs-11 text-xs-right">
                                        <button type="button" class="btn btn-chocolate next-checkout next-2">Next</button>
                                    </div>
                                </div>
							</form>
						</div><!-- end detail content -->
					</div><!-- end-content -->
					<div class="content">
						<div class="row title-content title-3">
							<h2 class="col-xs-7">3. Preview</h2>
							<div class="col-xs-5  text-xs-right">
								<button type="button" class="btn btn-chocolate border edit-3">edit</button>
							</div>
						</div>
						<div class="detail-content preview-3">
							<div class="row">
								<div class="col-xs-10 push-xs-1">
									<h3>The order will be shipped to:</h3>
									<p>Name: <span class="fullname"><?php if(isset($name_db)) echo $name_db; ?></span></p>
									<p>Address: <span class="address"><?php if(isset($address_db)) echo $address_db; ?></span></p>
									<p>Phone number: <span class="phone-number"><?php if(isset($phone_db)) echo $phone_db; ?></span></p>
									<button type="button" class="btn btn-chocolate next-checkout border">Modify</button>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-10 push-xs-1">
									<h3>The order will be pay with:</h3>

									<p><span class="Card-name"></span></p>
									<p>Card number: <span class="card-number"></span></p>
									<p>Code: <span class="code"></span></p>

									<h3>Card holder:</h3>
									<p>Name: <span class="fullname"></span></p>
									<p>Address: <span class="address"></span></p>
									<p>City, Country: <span class="city-country"></span></p>
									<button type="button" class="btn btn-chocolate next-checkout border">Modify</button>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-11 text-xs-right">
									<a href="order-success.php" class="btn btn-chocolate next-checkout">complete</a>
								</div>
							</div>
						</div><!-- end detail content -->
					</div><!-- end-content -->
				</div><!-- end left -->

            <div class="col-sm-4 right-checkout">
                <div class="content">
                    <div class="title-content">
                        <h2>summary</h2>
                    </div>
                    <div class="detail-content">
                        <div class="row">
                            <div class="col-xs-6 push-xs-1 col-sm-10 push-sm-1 col-md-6 push-md-1">
                                <p class="total">Total</p>
                            </div>
                            <div class="col-xs-3 push-xs-2 col-sm-10 push-sm-1 col-md-4 push-md-1 col-lg-3 push-lg-2 text-xs-right">
                                <span class="price-total totals-value" id="cart-total">102.00</span>
                            </div>
                        </div>
                    </div>
                </div><!-- end-content -->
                <div class="content">
                    <div class="title-content">
                        <h2>In your cart</h2>
                    </div>
                    <div class="detail-content">
                        <?php
                        $string_id_product_cart = "";
                        foreach ($product_cards as $product_card) {
                            $product_id = $product_card->product_id;
                            $quantity = isset($product_card->quantity) ? $product_card->quantity : 0;
                            $string_id_product_cart .= $product_id . ",";
                            if ($db->select_one("SELECT * FROM product where id = {$product_id}")) {
                                ?>
                                <div class="row added-product mt-0">
                                    <div class="col-xs-5 push-xs-1 col-sm-10 col-lg-5">
                                        <img src="public/upload/product/<?= $db->getResult()->image ?>" alt="" class="img-fluid">
                                    </div>
                                    <div class="col-xs-5 push-xs-1 col-sm-10 col-lg-5">
                                        <p class="name-product"><?= $db->getResult()->name ?></p>
                                        <span class="price-product"><?= $db->getResult()->unit_price ?></span>
                                        <span class="qty" style="padding-bottom: 25px">Qty:<?= $quantity ?></span>
                                        <a href="cart.php" class="cuztomize">Cuztomize</a>
                                    </div>
                                </div>
                                <?php
                            } else {
                                continue;
                            }
                        }
                        ?>
                    </div>
                </div><!-- end-content -->
            </div><!-- end right -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end ... -->
	
	<?php
		include('includes/link-menu.php');
		//include('includes/connect.php');
		ob_flush();
	?>


	<div id="toTop">
		<span class="fa fa-chevron-up"></span>
	</div>
	<div id="toDown">
		<span class="fa fa-chevron-down"></span>
	</div>
	
	<script type="text/javascript">
        $(document).ready(function () {
            var priceTotalDiv = $(this).find(".price-total");//Tổng số tiền phải trả
            var priceTotal = 0;
            $('.added-product').each(function () {
                var priceProduct = parseInt($(this).find(".price-product").text());//Giá sản phẩm
                var quantity = parseInt($(this).find(".qty").text().replace("Qty:",""));//Input Số sản phẩm đang trong giỏ
                priceTotal += priceProduct*quantity;
            });
            priceTotalDiv.text(priceTotal);
        });
    </script>
</body>
</html>