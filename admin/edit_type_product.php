<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/14/2018
 * Time: 9:55 PM
 */
ob_start();
require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/../db/db.php";

$db = db::getInstance();

if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
    $id = $_GET['id'];
    if ($db->select_one("SELECT * FROM type_product WHERE id={$id}")) {
        $name_db = $db->getResult()->name;
        $description_db = $db->getResult()->description;
        $image_db = $db->getResult()->image;
    } else {
        //Không có bản ghi nào có id như vậy
        header('Location: list_type_product.php');
        exit();
    }
} else {
    header('Location: list_type_product.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = "";
    if (!isset($_POST['name'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu tên loại sản phẩm</p>";
    }
    if (!isset($_POST['description'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu mô tả loại sản phẩm</p>";
    }

    if ($message === "") {
        if($name_db === $_POST['name'] && $description_db === $_POST['description'])
        {
            $message = "<p class='alert alert-danger message'>Bạn chưa sửa gì</p>";
        }else if($name_db === $_POST['name']){
            $message = "<p class='alert alert-danger message'>Tên loại sản phẩm đã tồn tại</p>";
        }else if($db->update("type_product",
            [
                "name"=>$_POST['name'],
                "description"=>$_POST['description'],
            ],
            "id={$id}"))
        {
            $name_db = $_POST['name'];
            $description_db = $_POST['description'];
            $message = "<p class='alert alert-success message'>Sửa thành công</p>";
        }
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
                <h3>Chỉnh sửa loại sản phẩm</h3>

                <div class="form-group">
                    <label>Tên</label>
                    <input type="text" name="name" value="<?php if (isset($name_db)) echo $name_db; ?>"
                           class="form-control" placeholder="Tên">
                </div>
                <div class="form-group">
                    <label>Mô tả</label>
                    <input type="text" name="description"
                           value="<?php if (isset($description_db)) echo $description_db; ?>"
                           class="form-control" placeholder="Mô tả">
                </div>
                <div class="form-group">
                    <p>Ảnh</p>
                    <img src="../public/upload/type_product/<?php echo $image_db; ?>" style="width: 25%;">
                </div>

                <input type="submit" name="btnSubmit" class="btn btn-primary" value="Sửa">
            </form>

            <script>
                $(document).ready(function () {
                    $("#form_product input[name='btnSubmit']").click(function (event) {//bắt sự kiện click vào nút thêm mới

                        event.preventDefault();//ngăn tự động submit form

                        var isValidInput = true;//biến kiểm tra xem các input có hợp lệ không
                        //Duyệt qua tất cả các input của form
                        $("#form_product .form-group:has(input[type='text'])").each(function () {

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

                        //Nếu các trường input hợp lệ thì submit form
                        if (isValidInput) $('#form_product').submit();
                    });
                });
            </script>
        </div>
    </div>
<?php
require_once __DIR__ . "/includes/footer.php";
ob_flush();
?>