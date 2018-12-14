<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/12/2018
 * Time: 10:22 PM
 */
ob_start();
require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/../db/db.php";

$db = db::getInstance();

if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range'=>1)))
{
    $id = $_GET['id'];
    if($db->select_one("SELECT * FROM product WHERE id={$id}"))
    {
        $name_db = $db->getResult()->name;
        $type_db = $db->getResult()->type;
        $description_db = $db->getResult()->description;
        $unit_price_db = $db->getResult()->unit_price;
        $unit_id_db = $db->getResult()->unit_id;
        $soluong_db = $db->getResult()->soluong;
        $promption_price_db = $db->getResult()->promotion_price;
        $image_db = $db->getResult()->image;
    }else{
        header('Location: list_product.php');
        exit();
    }
}else{
    header('Location: list_product.php');
    exit();
}

if ($db->select("SELECT * FROM type_product")) {
    $types = $db->getResult();//Danh sách các loại sản phẩm
}

if ($db->select("SELECT * FROM unit")) {
    $units = $db->getResult();//Danh sách các đơn vị sản phẩm
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = "";
    if (!isset($_POST['name'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu tên sản phẩm</p>";
    }
    if (!isset($_POST['type'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu loại sản phẩm</p>";
    } else if (!is_numeric($_POST['type'])) {
        $message .= "<p class='alert alert-danger message'>Loại sản phẩm phải là số</p>";
    }
    if (!isset($_POST['description'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu mô tả sản phẩm</p>";
    }
    if (!isset($_POST['unit_price'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu giá sản phẩm</p>";
    } else if (!is_numeric($_POST['unit_price'])) {
        $message .= "<p class='alert alert-danger message'>Giá sản phẩm phải là số</p>";
    }
    if (!isset($_POST['unit_id'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu unit id sản phẩm</p>";
    } else if (!is_numeric($_POST['unit_id'])) {
        $message .= "<p class='alert alert-danger message'>unit id phải là số</p>";
    }
    if (!isset($_POST['promotion_price'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu giá khuyến mãi của sản phẩm</p>";
    } else if (!is_numeric($_POST['promotion_price'])) {
        $message .= "<p class='alert alert-danger message'>Giá khuyễn mãi phải là số</p>";
    }

    if (!isset($_FILES['img'])) {
        $message .= "<p class='alert alert-danger message'>Bạn chưa upload ảnh sản phẩm</p>";
    } else if ($_FILES['img']['error'] > 0) {
        $message .= "<p class='alert alert-danger message'>Upload ảnh sản phẩm bị lỗi</p>";
    } else {
        $file_name = $_FILES['img']['name'];

        // lấy phần mở rộng của file
        //hàm substr là cắt file
        //hàm strrpos là tìm vị trí xuất hiện cuối cùng của 1 chuỗi trong 1 chuỗi, trả về một số nguyên
        $file_type = substr($file_name, strrpos($file_name, "."));
        if (!in_array($file_type, [".jpg", ".png", ".jpeg", "jpe", "gif"])) {
            $message .= "<p class='alert alert-danger message'>File bạn upload lên không phải là ảnh</p>";
        } else {
            $new_file_name = substr($file_name, 0, strrpos($file_name, ".")) . " " . date('d_m_Y H_i_s') . $file_type;
            $new_file = __DIR__ . '/../public/upload/' . $new_file_name;
            move_uploaded_file($_FILES['img']['tmp_name'], $new_file);
            if (!file_exists($new_file)) {//Nếu file không tồn tại
                $message .= "<p class='alert alert-danger message'>Upload ảnh sản phẩm bị lỗi</p>";
            }
        }

    }

    if ($message === "") {
        if(
            $_POST['name'] === $name_db &&
            $_POST['type'] === $type_db &&
            $_POST['description'] === $description_db &&
            $_POST['unit_price'] === $unit_price_db &&
            $_POST['unit_id'] === $unit_id_db &&
            $_POST['soluong'] === $soluong_db &&
            $_POST['promotion_price'] === $promption_price_db &&
            $_FILES['img']['name'] === $image_db
        ){
            $message = "<p class='alert alert-danger message'>Bạn chưa thay đổi gì</p>";
        }else if($db->update("product",
            [
                "name"=>$_POST['name'],
                "type"=>$_POST['type'],
                "description"=>$_POST['description'],
                "unit_price"=>$_POST['unit_price'],
                "unit_id"=>$_POST['unit_id'],
                "soluong"=>$_POST['soluong'],
                "promotion_price"=>$_POST['promotion_price'],
                "image"=>$new_file_name,
            ],
            "id={$id}")){
            $name_db = $_POST['name'];
            $type_db = $_POST['type'];
            $description_db = $_POST['description'];
            $unit_price_db = $_POST['unit_price'];
            $unit_id_db = $_POST['unit_id'];
            $soluong_db = $_POST['soluong'];
            $promption_price_db = $_POST['promotion_price'];
            $image_db = $_FILES['img']['name'];
            $message = "<p class='alert alert-success message'>Sửa thành công</p>";
        }else{
            $message = "<p class='alert alert-danger message'>Sửa không thành công</p>";
        }
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
                    <input type="text" name="name" value="<?php if (isset($name_db)) echo $name_db; ?>"
                           class="form-control" placeholder="Tên">
                </div>

                <?php
                if (isset($types) && is_array($types)) {
                    ?>
                    <div class="form-group">
                        <label>Loại</label>
                        <input type="text" hidden name="type" value="">
                        <select id="select-type" class="selectpicker show-tick" data-width="auto" title="Chọn một loại">
                            <?php
                            foreach ($types as $type) {
                                ?>
                                <option value="<?= $type->id ?>" <?php if (isset($type_db) && $type_db === $type->id) echo "selected"; ?> ><?= $type->name ?></option>
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
                        <select id="select-unit" class="selectpicker show-tick" data-width="auto" title="Chọn một loại">
                            <?php
                            foreach ($units as $unit) {
                                ?>
                                <option value="<?= $unit->id ?>" <?php if (isset($unit_id_db) && $unit_id_db === $unit->id) echo "selected"; ?> ><?= ucfirst($unit->name) ?></option>
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
                           value="<?php if (isset($description_db)) echo $description_db; ?>"
                           class="form-control" placeholder="Mô tả">
                </div>

                <div class="form-group">
                    <label>Giá</label>
                    <input type="text" name="unit_price"
                           value="<?php if (isset($unit_price_db)) echo $unit_price_db; ?>"
                           class="form-control" placeholder="Giá mỗi đơn vị">
                </div>

                <div class="form-group">
                    <label>Số lượng</label>
                    <input type="text" name="soluong"
                           value="<?php if (isset($soluong_db)) echo $soluong_db; ?>"
                           class="form-control" placeholder="Số lượng">
                </div>

                <div class="form-group">
                    <label>Giá khuyến mãi</label>
                    <input type="text" name="promotion_price"
                           value="<?php if (isset($promption_price_db)) echo $promption_price_db; ?>"
                           class="form-control" placeholder="Giá khuyến mãi">
                </div>

                <div class="form-group">
                    <label>Ảnh</label>
                    <input type="file" name="img" value=""><?php if (isset($image_db)) echo $image_db; ?>
                </div>

                <input type="submit" name="btnSubmit" class="btn btn-primary" value="Sửa">
                <a href="index.php" class="btn btn-primary">Hủy</a>
            </form>

            <script>
                $(document).ready(function () {
                    $("#form_product input[name='btnSubmit']").click(function (event) {//bắt sự kiện click vào nút thêm mới

                        event.preventDefault();//ngăn tự động submit form

                        var isValidInput = true;//biến kiểm tra xem các input có hợp lệ không
                        //Duyệt qua tất cả các input của form
                        $("#form_product .form-group:has(input[type='text'])").not($(".form-group:has(.selectpicker)")).each(function () {

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

                        //Kiểm tra input ảnh
                        let inputFile = $('.form-group:has(input[type="file"])');
                        inputFile.find(".message").remove();//Xóa hết tất cả các thông báo trước
                        let image = inputFile.find("input[type='file']").val();//Đường dẫn tới ảnh trên máy người dùng
                        if (image === "") {
                            isValidInput = false;
                            inputFile.append("<p class='alert alert-danger message'>Bạn chưa chọn ảnh</p>");
                        } else {
                            let file_type = image.substr(image.lastIndexOf("."));//Phần mở rộng của file
                            if (![".jpg", ".png", ".jpeg", "jpe", "gif"].includes(file_type)) {//Nếu không thuộc 1 trong số này thì không phải là ảnh
                                isValidInput = false;
                                inputFile.append("<p class='alert alert-danger message'>File bạn chọn không phải là ảnh</p>");
                            }
                        }

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
ob_flush();
?>