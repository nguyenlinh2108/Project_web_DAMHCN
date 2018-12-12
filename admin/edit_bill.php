<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/12/2018
 * Time: 2:26 PM
 */
ob_start();
require_once __DIR__ . "/includes/header.php";
require_once  __DIR__ . "/../db/db.php";
$db = db::getInstance();
if ($db->select("SELECT * FROM payment")) {
    $payments = $db->getResult();
}
if ($db->select("SELECT * FROM customer")) {
    $customers = $db->getResult();
}
//Danh sách các trạng thái hợp lệ
$status_array = ['chưa thanh toán','hủy','đang chờ','đang giao hàng','đã thanh toán'];
if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range'=>1)))
{
    $id = $_GET['id'];
    if($db->select_one("SELECT * FROM bill WHERE id={$id}"))
    {
        $customer_id_sql = $db->getResult()->customer_id;
        $payment_sql = $db->getResult()->payment;
        $total_sql = $db->getResult()->total;
        $note_sql = $db->getResult()->note;
        $status_sql = $db->getResult()->status;
    }else
    {
        // không có bản ghi nào như vậy
        header('Location: list_bill.php');
        exit();
    }
}else{
    header('Location: list_bill.php');
    exit();
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
    } else if (!in_array($_POST['status'], $status_array)) {
        $message .= "<p class='alert alert-danger message'>Trạng thái không hợp lệ</p>";
    }

    if ($message === "") {
        if($_POST['customer'] === $customer_id_sql
            && $_POST['payment'] === $payment_sql
            && $_POST['tongtien'] === $total_sql
            && $_POST['note'] === $note_sql
            && $_POST['status'] === $status_sql
        )
        {
            $message = "<p class='alert alert-danger message'>Bạn chưa sửa gì.</p>";
        }else if ($db->update("bill",
            [
                "customer_id" => $_POST['customer'],
                "payment" => $_POST['payment'],
                "total" => $_POST['tongtien'],
                "note" => $_POST['note'],
                "status" => $_POST['status'],
            ],
            "id = {$id}"))
        {
            $customer_id_sql = $_POST['customer'];
            $payment_sql = $_POST['payment'];
            $total_sql = $_POST['tongtien'];
            $note_sql = $_POST['note'];
            $status_sql = $_POST['status'];
            $message = "<p class='alert alert-success message' ;>Sửa thành công.</p>";
        } else {
            $message = "<p class='alert alert-danger message'>Sửa thất bại.</p>";
        }
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
            <h3>Chỉnh sửa hóa đơn</h3>

            <?php
            if (isset($customers) && is_array($customers)) {
                ?>
                <div class="form-group">
                    <label>Mã khách hàng</label>
                    <input type="text" hidden name="customer" value="" >
                    <select id="select-customer" class="selectpicker show-tick" data-width="auto" title="Chọn một khách hàng">
                        <?php
                        foreach ($customers as $customer) {
                            ?>
                            <option value="<?= $customer->id ?>" <?php if(isset($customer_id_sql) && $customer_id_sql === $customer->id) echo "selected" ?> ><?= $customer->name ?></option>
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
                    <select id="select-payment" class="selectpicker show-tick" data-width="auto" title="Chọn một phương thức thanh toán">
                        <?php
                        foreach ($payments as $payment) {
                            ?>
                            <option value="<?= $payment->id ?>" <?php if(isset($payment_sql) && $payment_sql === $payment->id) echo "selected" ?> ><?= $payment->name ?></option>
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
                       value="<?php if (isset($total_sql)) echo $total_sql; ?>"
                       class="form-control" placeholder="Tổng tiền">
            </div>

            <div class="form-group">
                <label>Ghi chú</label>
                <input type="text" name="note"
                       value="<?php if (isset($note_sql)) echo $note_sql; ?>"
                       class="form-control" placeholder="Ghi chú">
            </div>
            <div class="form-group">
                <label>Trạng thái</label>
                <input type="text" hidden name="status" value="">
                <select id="select-status" class="selectpicker show-tick" data-width="auto" title="Chọn trạng thái">
                    <?php
                    foreach ($status_array as $status){
                        ?>
                        <option value="<?= $status ?>" <?php if(isset($status_sql) && $status_sql === $status) echo "selected"; ?>><?= ucfirst($status) ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>

            <input type="submit" name="btnSubmit" class="btn btn-primary" value="Sửa">
            <a href="index.php" class="btn btn-primary">Hủy</a>
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
                        $(this).find(".message").remove();//Xóa hết tất cả các thông báo trước
                        let label = $(this).find("label").text();//Nhãn (nằm trong thẻ label)
                        let selectpicker = $(this).find(".selectpicker").selectpicker('val');//Lấy giá trị đang được chọn
                        if (selectpicker === "") {
                            isValidInput = false;
                            $(this).append("<p class='alert alert-danger message'>Bạn chưa chọn " + label + "</p>");
                        } else {
                            $(this).find("input").attr("value", selectpicker);//Truyền vào trường input
                        }
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
ob_flush();
?>
