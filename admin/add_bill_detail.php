<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/11/2018
 * Time: 4:49 PM
 */
require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/../db/db.php";
$db = db::getInstance();
if ($db->select("SELECT * FROM bill  ")) {
    $hoadons = $db->getResult();
}
if ($db->select("SELECT * FROM product")) {
    $sanphams = $db->getResult();
}
$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['mahd'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu mã hóa đơn</p>";
    }
    if (!isset($_POST['masp'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu mã sản phẩm</p>";
    }
    if (!isset($_POST['soluong'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu số lượng</p>";
    } elseif (!is_numeric($_POST['soluong'])) {
        $message .= "<p class='alert alert-danger message'>Số lượng không hợp lệ</p>";
    }
    if (!isset($_POST['gia'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu giá</p>";
    } elseif (!is_numeric($_POST['gia'])) {
        $message .= "<p class='alert alert-danger message'>Giá không hợp lệ</p>";
    }
    if ($message === "") {
        if ($db->insert("bill_detail", [
            "id_bill" => $_POST['mahd'],
            "id_product" => $_POST['masp'],
            "quantity" => $_POST['soluong'],
            "price" => $_POST['gia'],
        ])) {
            $message .= "<p class='alert alert-success'>Thêm thành công</p>";
            unset($_POST);
        } else $message .= "<p class='alert alert-danger'>Thêm thất bại</p>";
    }
}
?>
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12" id="my_pad_top">
        <a href="list_bill_detail.php" class="btn btn-primary" >Về trang danh sách hóa đơn chi tiết</a>
        <a href="index.php" class="btn btn-primary" style="float: right">Về trang chủ</a>
        <h3>Thêm mới hóa đơn chi tiết</h3>
        <form id="frm_add" method="POST" name="frm_add" enctype="multipart/form-data">
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <div class="form-group">
                <label>Mã hóa đơn</label>
                <input type="text" hidden name="mahd" value="">
                <select id="select-mahd" title="Chọn mã hóa đơn" class="selectpicker show-tick">
                    <?php
                    if (isset($hoadons) && is_array($hoadons)) {
                        foreach ($hoadons as $hoadon) {
                            ?>
                            <option value="<?php echo $hoadon->id; ?>" <?php if (isset($_POST['mahd']) && $_POST['mahd'] === $hoadon->id) echo "selected"; ?> > <?php echo $hoadon->customer_id; ?> </option>
                            <?php

                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Mã sản phẩm</label>
                <input type="text" hidden name="masp" value="">
                <select id="select-masp" class="selectpicker show-tick" data-width="auto" title="Chọn mã sản phẩm">
                    <?php
                    if (isset($sanphams) && is_array($sanphams)) {
                        foreach ($sanphams as $sanpham) {
                            ?>
                            <option value="<?php echo $sanpham->id; ?>" <?php if (isset($_POST['masp']) && $_POST['masp'] === $sanpham->id) echo "selected"; ?>><?php echo $sanpham->name; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Số lượng</label>
                <input type="text" class="form-control"
                       name="soluong" value="<?php if (isset($_POST['soluong'])) echo $_POST['soluong']; ?>"
                       placeholder="Số lượng">
            </div>
            <div class="form-group">
                <label>Giá</label>
                <input type="text" class="form-control"
                       name="gia" value="<?php if (isset($_POST['gia'])) echo $_POST['gia']; ?>"
                       placeholder="Giá">
            </div>
            <input type="submit" name="btnSubmit" class="btn btn-primary" value="Thêm">
        </form>
        <script>
            $(document).ready(function () {
                //bắt sự kiện click vào nút thêm mới
                $("#frm_add input[name='btnSubmit']").click(function (event) {
                    event.preventDefault();//ngăn tự động submit form
                    //Nếu các trường input hợp lệ thì submit form
                    if (checkInput()) {
                        $('#frm_add').submit();
                    }
                });


                //Bắt sự kiện khi gõ vào các trường input
                $("input").keyup(function () {
                    checkInput();
                });

                //Bắt sự kiện khi lựa chọn 1 option trong các trường select là khi mình chọn 1 option nó đã check rồi check tất cả luôn á ukok
                $(".selectpicker").change(function () {
                    checkInput();
                });
            });

            //Hàm kiểm tra các giá trị đầu vào và hiển thị thông báo lỗi nếu có
            function checkInput() {
                $(".message").remove(); //Xóa hết tất cả các thông báo trước uk, nhưng  class message không có trong thông báo
                var isValidInput = true;//biến kiểm tra xem các input có hợp lệ không
                //Duyệt qua tất cả các input của form
                $("#frm_add .form-group:has(input[type='text'])").not($(".form-group:has(.selectpicker)")).each(function () {
                    let input = $(this).find("input[type='text']");//giá trị input
                    let label = $(this).find("label").text();//nhãn nằm trong thẻ label
                    if (typeof input.val() === "string") {//Nếu trường input là string (text)
                        if (input.val() == null || input.val().trim() === "") {//Nếu giá trị input rỗng
                            isValidInput = false;
                            $(this).append("<p class='alert alert-danger message'>Không thể để trống trường " + label + "</p>");
                        } else if (label === "Số lượng" && !isUnsignedNumber(input.val())) {
                            //Kiểm tra xem giá trị input có là số không
                            isValidInput = false;
                            $(this).append("<p class='alert alert-danger message'>Bạn phải nhập " + label + " là số.</p>");
                        } else if (label === "Giá" && !isUnsignedNumber(input.val())) {
                            //Kiểm tra xem giá trị input có là số không
                            isValidInput = false;
                            $(this).append("<p class='alert alert-danger message'>Bạn phải nhập " + label + " là số.</p>");
                        }
                    }

                });
                //Duyệt qua các trường select (có thể chọn giá trị option đó)
                $("#frm_add .form-group:has(.selectpicker)").each(function () {
                    let label = $(this).find("label").text();//Nhãn (nằm trong thẻ label)
                    let selectpicker = $(this).find(".selectpicker").selectpicker('val');//Lấy giá trị đang được chọn
                    if (selectpicker === "") {
                        isValidInput = false;
                        $(this).append("<p class='alert alert-danger message'>Bạn chưa chọn " + label + "</p>");
                    } else {
                        $(this).find("input").attr("value", selectpicker);//Truyền vào trường input
                    }
                });
                return isValidInput; //đây hả uk chạy đi
            }
            //Hàm kiểm tra xem 1 chuỗi có phải là 1 số không âm không
            function isUnsignedNumber(str) {
                return /^\d+$/.test(str);
            }
        </script>
    </div>
</div>
<?php require_once __DIR__ . "/includes/footer.php"; ?>
