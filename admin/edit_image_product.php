<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/14/2018
 * Time: 2:45 PM
 */
ob_start();
error_reporting(0);
require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/../db/db.php";
$db = db::getInstance();

if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range'=>1)))
{
    $id = $_GET['id'];
    if($db->select_one("SELECT * FROM product WHERE id={$id}"))
    {
        $image = $db->getResult()->image;
        $name = $db->getResult()->name;
    }else{
        header('Location: list_product.php');
        exit();
    }
}else{
    header('Location: list_product.php');
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = "";
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
            $new_file_name === $name
        ){
            $message = "<p class='alert alert-danger message'>Bạn chưa thay đổi gì</p>";
        }else if($db->update("product",
            [
                "image"=>$new_file_name,
            ],
            "id={$id}"))
        {
            if(!unlink('../public/upload/'.$image))
            {
                $message= "<p class='alert alert-danger message' style='margin-top: 15px;'>Ảnh ".$image." không tồn tại trong thư mục /public/upload/ </p>
                            <p class='alert alert-success message'>Ảnh mới đã được thêm vào.</p>
                            ";
                $image = $new_file_name;
            }
        }else{
            $message = "<p class='alert alert-danger message'>Sửa không thành công</p>";
        }
    }
}
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="my_pad_top">
        <a href="list_product.php" class="btn btn-primary" >Về trang danh sách sản phẩm</a>
        <a href="index.php" class="btn btn-primary" style="float: right">Về trang chủ</a>
        <form name="form_product" id="form_product" method="POST" enctype="multipart/form-data">
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <h3>Chỉnh sửa ảnh của sản phẩm: <?php if(isset($name)) echo $name; ?> </h3>
            <div class="form-group">
                <p>Mã sản phẩm</p>
                <input type="text" value="<?php if(isset($id)) echo $id; ?>" disabled class="form-control">
            </div>
            <div class="form-group">
                <p>Ảnh cũ</p>
                <img src="../public/upload/<?php if(isset($image)) echo $image; ?>" style="width: 25%;">
            </div>
            <div class="form-group">
                <p>Ảnh mới</p>
                <img src="../public/upload/<?php if(isset($new_file_name)) echo $new_file_name; ?>" style="width: 25%;">
                <input type="file" name="img" value="">
            </div>
            <input type="submit" name="btnSubmit" class="btn btn-primary" value="Sửa">
        </form>
        <script>
            $(document).ready(function () {
                $("#form_product input[name='btnSubmit']").click(function (event) {

                    event.preventDefault();//ngăn tự động submit form

                    var isValidInput = true;//biến kiểm tra xem các input có hợp lệ không
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

        </script>
    </div>
</div>
<?php
    require_once __DIR__ . "/includes/footer.php";
    ob_flush();
?>
