<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/17/2018
 * Time: 7:42 PM
 */
ob_start();
error_reporting(0);
require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/../db/db.php";
$db = db::getInstance();
if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range'=>1)))
{
    $id = $_GET['id'];
    if($db->select_one("SELECT * FROM  slide WHERE id={$id}"))
    {
        $image_db = $db->getResult()->image;
    }else{
        header('Location: list_slider.php');
        exit();
    }
}else{
    header('Location: list_slider.php');
    exit();
}
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $message = "";
    if (!isset($_FILES['img_slider'])) {
        $message .= "<p class='alert alert-danger message'>Bạn chưa upload ảnh</p>";
    } else if ($_FILES['img_slider']['error'] > 0) {
        $message .= "<p class='alert alert-danger message'>Upload ảnh bị lỗi</p>";
    } else {
        $file_name = $_FILES['img_slider']['name'];

        // lấy phần mở rộng của file
        //hàm substr là cắt file
        //hàm strrpos là tìm vị trí xuất hiện cuối cùng của 1 chuỗi trong 1 chuỗi, trả về một số nguyên
        $file_type = substr($file_name, strrpos($file_name, "."));
        if (!in_array($file_type, [".jpg", ".png", ".jpeg", "jpe", "gif",".JPG", ".PNG", ".JPEG", "JPE", "GIF" ])) {
            $message .= "<p class='alert alert-danger message'>File bạn upload lên không phải là ảnh</p>";
        } else {
            $new_file_name = substr($file_name, 0, strrpos($file_name, ".")) . " " . date('d_m_Y H_i_s') . $file_type;
            $new_file = __DIR__ . '/../public/upload/slider/' . $new_file_name;
            move_uploaded_file($_FILES['img_slider']['tmp_name'], $new_file);
            if (!file_exists($new_file)) {//Nếu file không tồn tại
                $message .= "<p class='alert alert-danger message'>Upload ảnh bị lỗi</p>";
            }
        }
    }

    if($message === "")
    {
        if($db->update("slide",["image"=>$new_file_name], "id={$id}"))
        {
            if(!unlink(__DIR__ . '/../public/upload/slider/'.$image_db))
            {
                $message .= "<p class='alert alert-danger message'>Ảnh cũ không tồn tại trong thư mục: public/upload/slider/ </p>
                             <p class='alert alert-success message'>Ảnh mới đã được thêm vào.</p>";
            }else{
                $message .= "<p class='alert alert-success message'>Ảnh mới đã được thêm vào.</p>";
            }
        }else{
            $message .= "<p class='alert alert-danger message'>Sửa không thành công</p>";
        }
    }
}

?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="my_pad_top">
        <a href="list_slider.php" class="btn btn-primary" >Về trang danh sách slider</a>
        <a href="index.php" class="btn btn-primary" style="float: right">Về trang chủ</a>
        <form name="form_edit" id="form_edit" method="POST" enctype="multipart/form-data">
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <h3>Chỉnh sửa ảnh của slider </h3>
            <div class="form-group">
                <p>Mã slider</p>
                <input type="text" value="<?php if(isset($id)) echo $id; ?>" disabled class="form-control">
            </div>
            <div class="form-group">
                <p>Ảnh</p>
                <input type="file" name="img_slider" value="">
            </div>
            <input type="submit" name="btnSubmit" class="btn btn-primary" value="Sửa">
        </form>
        <script>
            $(document).ready(function () {

                //bắt sự kiện click vào nút thêm mới
                $("#form_edit input[name='btnSubmit']").click(function (event) {
                    event.preventDefault();//ngăn tự động submit form
                    //Nếu các trường input hợp lệ thì submit form
                    if (checkInput()) {
                        $('#form_edit').submit();
                    }
                });

                //Bắt sự kiện khi lựa chọn 1 file trong trường input file
                $( "input[type='file']" ).change(function() {
                    checkInput();
                });
            });

            //Hàm kiểm tra các giá trị đầu vào và hiển thị thông báo lỗi nếu có
            function checkInput() {
                $(".message").remove();//Xóa hết tất cả các thông báo trước
                var isValidInput = true;//biến kiểm tra xem các input có hợp lệ không

                //Kiểm tra input ảnh
                let inputFile = $('.form-group:has(input[type="file"])');
                let image = inputFile.find("input[type='file']").val();//Đường dẫn tới ảnh trên máy người dùng
                if (image === "") {
                    isValidInput = false;
                    inputFile.append("<p class='alert alert-danger message'>Bạn chưa chọn ảnh</p>");
                } else {
                    let file_type = image.substr(image.lastIndexOf("."));//Phần mở rộng của file
                    if (![".jpg", ".png", ".jpeg", "jpe", "gif", ".JPG", ".PNG", ".JPEG", "JPE", "GIF"].includes(file_type)) {//Nếu không thuộc 1 trong số này thì không phải là ảnh
                        isValidInput = false;
                        inputFile.append("<p class='alert alert-danger message'>File bạn chọn không phải là ảnh</p>");
                    }
                }
                return isValidInput;
            }
        </script>
    </div>
</div>
<?php
require_once __DIR__ . "/includes/footer.php";
ob_flush();
?>
