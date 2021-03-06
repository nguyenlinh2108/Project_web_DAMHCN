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
    if ($db->select_one("SELECT * FROM payment WHERE id={$id}")) {
        $name = $db->getResult()->name;
    } else {
        //Không có bản ghi nào có id như vậy
        header('Location: list_payment.php');
        exit();
    }
} else {
    header('Location: list_payment.php');
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['name'])) {
        $message = "<p>Bạn hãy nhập đầy đủ thông tin!</p>";
    } else {
        if ($_POST['name'] === $name) {
            $message = "<p class='alert alert-danger message'>Bạn chưa sửa gì.</p>";
        } else if ($db->update("payment", ["name" => $_POST['name']], "id = {$id}")) {
            $name = $_POST['name'];
            $message = "<p class='alert alert-success message' ;>Sửa thành công.</p>";
        } else {
            $message = "<p class='alert alert-danger message'>Sửa thất bại.</p>";
        }
    }
}


?>
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12 col-sm-12" id="my_pad_top">
        <a href="list_payment.php" class="btn btn-primary">Về trang danh sách phương thức thanh toán</a>
        <a href="index.php" class="btn btn-primary" style="float: right">Về trang chủ</a>
        <div id="message">
            <?php if (isset($message)) echo $message ?>
        </div>
        <form method="POST" name="frmedit_payment" id="frmedit_payment">
            <h3>Sửa phương thức thanh toán</h3>
            <div class="form-group">
                <label>Tên</label>
                <input id="name" type="text" name="name" value="<?php if (isset($name)) echo $name; ?>"
                       class="form-control" placeholder="Tên phương thức thanh toán">
                <div id="name-message"></div>
            </div>
            <input type="submit" name="btnSubmit" class="btn btn-primary" value="Sửa">
            <a href="list_payment.php" class="btn btn-primary">Hủy</a>
        </form>
        <script>
            $(document).ready(function () {
                var oldName = $('#name').val();//Giá trị payment trước khi sửa đỗi

                $("#frmedit_payment input[name='btnSubmit']").click(function (event) {
                    event.preventDefault();

                    var newName = $('#name').val().trim();

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

                    $("#frmedit_payment").submit();

                });
            });
        </script>
    </div>
</div>
<?php
require_once __DIR__ . "/includes/footer.php";
ob_flush();
?>

