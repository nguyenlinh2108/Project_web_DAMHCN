<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/14/2018
 * Time: 10:03 PM
 */

require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/../db/db.php";

$db = db::getInstance();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = "";
    if (!isset($_POST['name'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu tên loại sản phẩm</p>";
    }
    if (!isset($_POST['description'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu mô tả loại sản phẩm</p>";
    }

    if (!isset($_FILES['img'])) {
        $message .= "<p class='alert alert-danger message'>Bạn chưa upload ảnh loại sản phẩm</p>";
    } else if ($_FILES['img']['error'] > 0) {
        $message .= "<p class='alert alert-danger message'>Upload ảnh loại sản phẩm bị lỗi</p>";
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
        if ($db->select_one("SELECT * FROM type_product WHERE name = '" . db::validSql($_POST['name'])
            . "' AND description = '" . db::validSql($_POST['description']). "'")) {
            $message .= "<p class='alert alert-danger'>Loại sản phẩm đã tồn tại.</p>";
        } else if ($db->insert("type_product", [
            "name" => $_POST['name'],
            "description" => $_POST['description'],
            "image" => $new_file_name,
        ])) {
            $message .= "<p class='alert alert-success'>Thêm thành công loại sản phẩm " . $_POST['name'] . "</p>";
            unset($_POST);
        } else $message .= "<p class='alert alert-danger'>Thêm thất bại</p>";
    }
}

?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="my_pad_top">
            <a href="list_type_product.php" class="btn btn-primary" >Về trang danh sách loại sản phẩm</a>
            <a href="index.php" class="btn btn-primary" style="float: right">Về trang chủ</a>
            <form name="form_product" id="form_product" method="POST" enctype="multipart/form-data">
                <div id="message">
                    <?php
                    if (isset($message)) {
                        echo $message;
                    }
                    ?>
                </div>
                <h3>Thêm mới loại sản phẩm</h3>

                <div class="form-group">
                    <label>Tên</label>
                    <input type="text" name="name" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>"
                           class="form-control" placeholder="Tên">
                </div>
                <div class="form-group">
                    <label>Mô tả</label>
                    <input type="text" name="description"
                           value="<?php if (isset($_POST['description'])) echo $_POST['description']; ?>"
                           class="form-control" placeholder="Mô tả">
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
                        $("#form_product .form-group:has(input[type='text'])").not($(".form-group:has(.selectpicker)")).each(function () {

                            let input = $(this).find("input[type='text']");//Giá trị input
                            let label = $(this).find("label").text();//Nhãn (nằm trong thẻ label)

                            if (typeof input.val() === "string") {//Nếu trường input là string (text)
                                $(this).find(".message").remove();//Xóa hết tất cả các thông báo trước
                                if (input.val() == null || input.val().trim() === "") {//Nếu giá trị input rỗng
                                    isValidInput = false;
                                    $(this).append("<p class='alert alert-danger message'>Không thể để trống trường " + label + "</p>");
                                }
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
?>