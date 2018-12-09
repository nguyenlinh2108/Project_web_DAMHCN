<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/8/2018
 * Time: 11:50 PM
 */
require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/../db/db.php";

$db = db::getInstance();
if ($db->select("SELECT * FROM payment")) {
    $payments = $db->getResult();
}
if ($db->select("SELECT * FROM customer")) {
    $customers = $db->getResult();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = "";
    if (!isset($_POST['customer'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu mã khách hàng</p>";
    } else if (!is_numeric($_POST['customer'])) {
        $message .= "<p class='alert alert-danger message'>Mã khách hàng phải là số</p>";
    }

    if (!isset($_POST['payment'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu phương thức thanh toán</p>";
    }
    if (!isset($_POST['tongtien'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu tổng tiền</p>";
    } else if (!is_numeric($_POST['tongtien'])) {
        $message .= "<p class='alert alert-danger message'>Tổng tiền phải là số</p>";
    }
    if (!isset($_POST['status'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu trạng thái</p>";
    } else if (!is_numeric($_POST['status'])) {
        $message .= "<p class='alert alert-danger message'>Trạng thái phải là số</p>";
    }

    if ($message === "") {
        if ($db->select_one("SELECT * FROM bill WHERE customer_id = '" . db::validSql($_POST['customer'])
            . "' AND payment = '" . db::validSql($_POST['payment']) . "' AND total = '"
            . db::validSql($_POST['tongtien']) . "' AND status = '" . db::validSql($_POST['status']) . "'")) {
            $message .= "<p class='alert alert-danger'>Hóa đơn đã tồn tại.</p>";
        } else if ($db->insert("bill", [
            "customer_id" => $_POST['customer'],
            "payment" => $_POST['payment'],
            "total" => $_POST['tongtien'],
            "note" => $_POST['note'],
            "status" => $_POST['status'],
        ])) {
            $message .= "<p class='alert alert-success'>Thêm thành công</p>";
            unset($_POST);
        } else $message .= "<p class='alert alert-danger'>Thêm thất bại</p>";
    }
}

?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <form name="form_bill" id="form_bill" method="POST" enctype="multipart/form-data">
                <div id="message">
                    <?php
                    if (isset($message)) {
                        echo $message;
                    }
                    ?>
                </div>
                <h3>Thêm mới hóa đơn</h3>

                <?php
                if (isset($customers) && is_array($customers)) {
                    ?>
                    <div class="form-group">
                        <label>Mã khách hàng</label>
                        <input type="text" hidden name="customer" value="">
                        <select id="select-customer" class="selectpicker show-tick" data-width="auto">
                            <?php
                            foreach ($customers as $customer) {
                                ?>
                                <option value="<?= $customer->id ?>"><?= $customer->name ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <?php
                }
                ?>

                <?php
                if (isset($payments) && is_array($payments)) {
                    ?>
                    <div class="form-group">
                        <label>Phương thức thanh toán</label>
                        <input type="text" hidden name="payment" value="">
                        <select id="select-payment" class="selectpicker show-tick" data-width="auto">
                            <?php
                            foreach ($payments as $payment) {
                                ?>
                                <option value="<?= $payment->id ?>"><?= $payment->name ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <?php
                }
                ?>
                <div class="form-group">
                    <label>Tổng tiền</label>
                    <input type="text" name="tongtien"
                           value="<?php if (isset($_POST['tongtien'])) echo $_POST['tongtien']; ?>"
                           class="form-control" placeholder="Tổng tiền">
                </div>

                <div class="form-group">
                    <label>Ghi chú</label>
                    <input type="text" name="note"
                           value="<?php if (isset($_POST['note'])) echo $_POST['note']; ?>"
                           class="form-control" placeholder="Ghi chú">
                </div>
                <div class="form-group">
                    <label>Trạng thái</label>
                    <input type="text" hidden name="status" value="">
                    <select id="select-status" class="selectpicker show-tick" data-width="auto">
                        <option value="0">Chưa thanh toán</option>
                        <option value="1">Hủy</option>
                        <option value="2">Đang chờ</option>
                        <option value="3">Đang giao hàng</option>
                        <option value="4">Đã thanh toán</option>
                    </select>
                </div>

                <input type="submit" name="btnSubmit" class="btn btn-primary" value="Thêm mới">
            </form>
            <script>
                $(document).ready(function () {
                    $("#form_bill input[name='btnSubmit']").click(function (event) {//bắt sự kiện click vào nút thêm mới
                        event.preventDefault();//ngăn tự động submit form

                        var isValidInput = true;//biến kiểm tra xem các input có hợp lệ không
                        //Duyệt qua tất cả các input của form
                        $("#form_bill .form-group:has(input[type='text'])").not( $(".form-group:has(.selectpicker)")).each(function () {

                                let input = $(this).find("input[type='text']");//Giá trị input
                                let label = $(this).find("label").text();//Nhãn (nằm trong thẻ label)

                                if (typeof input.val() === "string") {//Nếu trường input là string (text)
                                    $(this).find(".message").remove();//Xóa hết tất cả các thông báo trước
                                    if (input.val() == null || input.val().trim() === "") {//Nếu giá trị input rỗng
                                        isValidInput = false;
                                        $(this).append("<p class='alert alert-danger message'>Không thể để trống trường " + label + "</p>");
                                    } else if (label === "Tổng tiền" && !isUnsignedNumber(input.val())) {
                                        //Kiểm tra xem giá trị input có là số không đối với các nhãn Tổng tiền
                                        isValidInput = false;
                                        $(this).append("<p class='alert alert-danger message'>Bạn phải nhập " + label + " là số</p>");
                                    }
                                }

                        });

                        //Duyệt qua các trường select (có thể chọn giá trị option đó)
                       $("#form_bill .form-group:has(.selectpicker)").each(function () {
                            let selectpicker = $(this).find(".selectpicker").selectpicker('val');//Lấy giá trị đang được chọn
                            $(this).find("input").attr("value", selectpicker);//Truyền vào trường input
                        });

                        //Nếu các trường input hợp lệ thì submit form
                        if (isValidInput) {
                            $('#form_bill').submit();
                        }
                    });
                });


                //Hàm kiểm tra xem 1 chuỗi có phải là 1 số không âm không
                function isUnsignedNumber(str) {
                    return /^\d+$/.test(str);
                }
            </script>

        </div>
    </div>
<?php
require_once __DIR__ . "/includes/footer.php";
?>