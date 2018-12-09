<?php
require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/../db/db.php";

$db = db::getInstance();

if ($db->select("SELECT * FROM type_product")) {
    $types = $db->getResult();//Danh sách các loại sản phẩm
}

if ($db->select("SELECT * FROM unit")) {
    $units = $db->getResult();//Danh sách các đơn vị sản phẩm
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = "";
    if (empty($_POST['name'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu tên sản phẩm</p>";
    }
    if (empty($_POST['type'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu loại sản phẩm</p>";
    } else if (!is_numeric($_POST['type'])) {
        $message .= "<p class='alert alert-danger message'>Loại sản phẩm phải là số</p>";
    }
    if (empty($_POST['description'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu mô tả sản phẩm</p>";
    }
    if (empty($_POST['unit_price'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu giá sản phẩm</p>";
    }
    else if (!is_numeric($_POST['unit_price'])) {
        $message .= "<p class='alert alert-danger message'>Giá sản phẩm phải là số</p>";
    }
    if (empty($_POST['unit_id'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu unit id sản phẩm</p>";
    } else if (!is_numeric($_POST['unit_id'])) {
        $message .= "<p class='alert alert-danger message'>unit id phải là số</p>";
    }
    if (empty($_POST['promotion_price'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu giá khuyến mãi của sản phẩm</p>";
    } else if (!is_numeric($_POST['promotion_price'])) {
        $message .= "<p class='alert alert-danger message'>Giá khuyễn mãi phải là số</p>";
    }

    if ($message === "") {
        if ($db->select_one("SELECT * FROM product WHERE name = '" . db::validSql($_POST['name'])
            . "' AND description = '" . db::validSql($_POST['description']) . "' AND unit_price = '"
            . db::validSql($_POST['unit_price']) . "'")) {
            $message .= "<p class='alert alert-danger'>Sản phẩm đã tồn tại.</p>";
        } else if ($db->insert("product", [
            "name" => $_POST['name'],
            "type" => $_POST['type'],
            "description" => $_POST['description'],
            "unit_price" => $_POST['unit_price'],
            "unit_id" => $_POST['unit_id'],
            "soluong" => $_POST['soluong'],
            "promotion_price" => $_POST['promotion_price'],
        ])) {
            $message .= "<p class='alert alert-success'>Thêm thành công</p>";
            unset($_POST);
        } else $message .= "<p class='alert alert-danger'>Thêm thất bại</p>";
    }
}

?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <form name="form_product" id="form_product" method="POST" enctype="multipart/form-data">
                <div id="message">
                    <?php
                    if (isset($message)) {
                        echo $message;
                    }
                    ?>
                </div>
                <h3>Thêm mới sản phẩm</h3>

                <div class="form-group">
                    <label>Tên</label>
                    <input type="text" name="name" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>"
                           class="form-control" placeholder="Tên">
                </div>

                <?php
                if (isset($types) && is_array($types)) {
                    ?>
                    <div class="form-group">
                        <label>Loại</label>
                        <input type="text" hidden name="type" value="">
                        <select id="select-type" class="selectpicker show-tick" data-width="auto">
                            <?php
                            foreach ($types as $type) {
                                ?>
                                <option value="<?= $type->id ?>"><?= $type->name ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <?php
                }
                ?>

                <?php
                if (isset($units) && is_array($units)) {
                    ?>
                    <div class="form-group">
                        <label>Unit</label>
                        <input type="text" hidden name="unit_id" value="">
                        <select id="select-unit" class="selectpicker show-tick" data-width="auto">
                            <?php
                            foreach ($units as $unit) {
                                ?>
                                <option value="<?= $unit->id ?>"><?= ucfirst($unit->name) ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <?php
                }
                ?>
                <div class="form-group">
                    <label>Mô tả</label>
                    <input type="text" name="description"
                           value="<?php if (isset($_POST['description'])) echo $_POST['description']; ?>"
                           class="form-control" placeholder="Mô tả">
                </div>

                <div class="form-group">
                    <label>Giá</label>
                    <input type="text" name="unit_price"
                           value="<?php if (isset($_POST['unit_price'])) echo $_POST['unit_price']; ?>"
                           class="form-control" placeholder="Giá mỗi đơn vị">
                </div>

                <div class="form-group">
                    <label>Số lượng</label>
                    <input type="text" name="soluong"
                           value="<?php if (isset($_POST['soluong'])) echo $_POST['soluong']; ?>"
                           class="form-control" placeholder="Số lượng">
                </div>

                <div class="form-group">
                    <label>Giá khuyến mãi</label>
                    <input type="text" name="promotion_price"
                           value="<?php if (isset($_POST['promotion_price'])) echo $_POST['promotion_price']; ?>"
                           class="form-control" placeholder="Giá khuyến mãi">
                </div>

                <div class="form-group">
                    <label>Ảnh</label>
                    <input type="file" name="img" value="">
                </div>

                <input type="submit" name="btnSubmit" class="btn btn-primary" value="Thêm mới">
            </form>

            <script>
                $(document).ready(function () {
                    $("#form_product input[name='btnSubmit']").click(function (event) {//bắt sự kiện click vào nút thêm mới

                        event.preventDefault();//ngăn tự động submit form

                        var isValidInput = true;//biến kiểm tra xem các input có hợp lệ không
                        //Duyệt qua tất cả các input của form
                        $("#form_product .form-group:has(input[type='text'])").not( $(".form-group:has(.selectpicker)")).each(function () {

                                let input = $(this).find("input[type='text']");//Giá trị input
                                let label = $(this).find("label").text();//Nhãn (nằm trong thẻ label)

                                if (typeof input.val() === "string") {//Nếu trường input là string (text)
                                    $(this).find(".message").remove();//Xóa hết tất cả các thông báo trước
                                    if (input.val() == null || input.val().trim() === "") {//Nếu giá trị input rỗng
                                        isValidInput = false;
                                        $(this).append("<p class='alert alert-danger message'>Không thể để trống trường " + label + "</p>");
                                    } else if ((label === "Giá" || label === "Số lượng" || label === "Giá khuyến mãi") && !isUnsignedNumber(input.val())) {
                                        //Kiểm tra xem giá trị input có là số không đối với các nhãn Giá, Số lượng và Giá khuyến mãi
                                        isValidInput = false;
                                        $(this).append("<p class='alert alert-danger message'>Bạn phải nhập " + label + " là số</p>");
                                    }
                                }

                        });

                        //Duyệt qua các trường select (có thể chọn giá trị option đó)
                        $("#form_product .form-group:has(.selectpicker)").each(function () {
                            let selectpicker = $(this).find(".selectpicker").selectpicker('val');//Lấy giá trị đang được chọn
                            $(this).find("input").attr("value", selectpicker);//Truyền vào trường input
                        });

                        //Nếu các trường input hợp lệ thì submit form
                        if (isValidInput) $('#form_product').submit();
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