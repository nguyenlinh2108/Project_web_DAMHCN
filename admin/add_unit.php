<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/12/2018
 * Time: 2:18 PM
 */

require_once __DIR__ . "/includes/header.php";
require_once  __DIR__ . "/../db/db.php";
$db = db::getInstance();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['name'])) {
        $message = "<p class='alert alert-danger'>Bạn hãy nhập đầy đủ thông tin</p>";
    } else {
        $name = trim($_POST['name']);
        if($db->select_one("SELECT * FROM unit WHERE name = '" . db::validSql($name) . "'")){
            $message = "<p class='alert alert-danger message'>Thêm mới không thành công! Tên $name đã tồn tại!</p>";
        }
        else if ($db->insert("unit", ['name' => $name])) {
            $message = "<p class='alert alert-success message'>Thêm mới thành công. $name</p>";
        } else {
            $message = "<p class='alert alert-danger message'>Thêm mới thất bại</p>";
        }
    }
}
?>
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12 col-sm-12">
        <div id="message">
            <?php if(isset($message)) echo $message ?>
        </div>
        <form method="POST" name="frmadd_payment" id="frmadd_payment">
            <h3>Thêm mới đơn vị sản phẩm</h3>
            <div class="form-group">
                <label>Tên</label>
                <input id="name" type="text" name="name" class="form-control" placeholder="Tên phương thức thanh toán">
                <div id="name-message"></div>
            </div>
            <input type="submit" name="btnSubmit" class="btn btn-primary" value="Thêm">
        </form>
        <script>
            $(document).ready(function () {
                $("#frmadd_payment input[name='btnSubmit']").click(function (event) {
                    event.preventDefault();

                    var newName = $('#name').val().trim();//Lấy giá trị input name

                    if (newName === "") {
                        $('.message').remove();
                        $('#name-message').append("<p class='alert alert-danger'>Không thể để trống</p>");
                        return;
                    }


                    $('#frmadd_payment').submit();
                });
            });
        </script>
    </div>
</div>
<?php require_once __DIR__ . "/includes/footer.php"; ?>
