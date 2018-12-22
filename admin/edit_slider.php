<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/7/2018
 * Time: 10:48 PM
 */
ob_start();

require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/../db/db.php";

$db = db::getInstance();

if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
    $id = $_GET['id'];
    if ($db->select_one("SELECT * FROM slide WHERE id={$id}")) {
        $link_db = $db->getResult()->link;
        $img_db = $db->getResult()->image;
    } else {
        //Không có bản ghi nào có id như vậy
        header('Location: list_slider.php');
        exit();
    }
} else {
    header('Location: list_slider.php');
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = "";
    if (empty($_POST['link'])) {
        $message .= "<p>Bạn hãy nhập đầy đủ thông tin!</p>";
    } else {
        if ($_POST['link'] === $link_db) {
            $message .= "<p class='alert alert-danger message'>Bạn chưa sửa gì.</p>";
        } else if ($db->update("slide", ["link" => $_POST['link']], "id = {$id}")) {
            $link_db = $_POST['link'];
            $message .= "<p class='alert alert-success message' ;>Sửa thành công.</p>";
        } else {
            $message .= "<p class='alert alert-danger message'>Sửa thất bại.</p>";
        }
    }
}


?>
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12 col-sm-12" id="my_pad_top">
        <a href="list_slider.php" class="btn btn-primary">Về trang danh sách slider</a>
        <a href="index.php" class="btn btn-primary" style="float: right">Về trang chủ</a>
        <div id="message">
            <?php if (isset($message)) echo $message ?>
        </div>
        <form method="POST" name="frm_edit" id="frm_edit">
            <h3>Sửa Slider</h3>
            <div class="form-group">
                <label>Mã</label>
                <input type="text" name="id" value="<?php if (isset($id)) echo $id; ?>"
                       class="form-control" placeholder="Mã" disabled>
            </div>
            <div class="form-group">
                <label>Link</label>
                <input id="link" type="text" name="link" value="<?php if (isset($link_db)) echo $link_db; ?>"
                       class="form-control" placeholder="Mô tả slider">
                <div id="name-message"></div>
            </div>
            <div class="form-group">
                <p>Ảnh</p>
                <img src="../public/upload/slider/<?php if (isset($img_db)) echo $img_db; ?>" width="100px">
            </div>
            <input type="submit" name="btnSubmit" class="btn btn-primary" value="Sửa">
        </form>
        <script>
            $(document).ready(function () {
                var oldName = $('#link').val();//Giá trị payment trước khi sửa đỗi

                $("#frm_edit input[name='btnSubmit']").click(function (event) {
                    event.preventDefault();

                    var newName = $('#link').val().trim();

                    if (newName === "") {
                        $('.message').remove();//Lệnh này dùng để xóa toàn bộ các class message nhá
                        $('#name-message').append("<p class='alert alert-danger message'>Không thể để trống</p>");
                        return;
                    }
                    else if (newName === oldName) {
                        $('.message').remove();
                        $('#message').append("<p class='alert alert-danger message'>Bạn chưa sửa gì</p>");
                        return;
                    }

                    $("#frm_edit").submit();

                });
            });
        </script>
    </div>
</div>
<?php
require_once __DIR__ . "/includes/footer.php";
ob_flush();
?>

