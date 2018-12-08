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
?>
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12 col-sm-12">
        <?php
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = array();
            if (empty($_POST['name'])) {
                $errors[] = 'name';
                $message = "<p>Bạn hãy nhập đầy đủ thông tin!</p>";
            } else {
                $name = $_POST['name'];
                if ($db->update("payment", ["name" => $name], "id = {$id}")) {
                    echo "<p>Sửa thành công.</p>";

                } else {
                    echo "<p>Bạn chưa sửa gì.</p>";
                }
            }
        }
        ?>
        <form method="POST" name="frmedit_payment" id="frmedit_payment">

            <h3>Sửa phương thức thanh toán</h3>
            <div class="form-group">
                <label>Tên</label>
                <input id="name" type="text" name="name" value="<?php if (isset($name)) echo $name; ?>"
                       class="form-control" placeholder="Tên phương thức thanh toán">
                <?php
                if (isset($errors['name'])) {
                    echo "<p>Bạn chưa nhập tên!</p>";
                }
                ?>
            </div>
            <input type="submit" name="btnSubmit" class="btn btn-primary" value="Sửa">
        </form>
        <script>
            $(document).ready(function () {
                var oldName = $('#name').val();//Giá trị payment trước khi sửa đỗi

                $("#frmedit_payment input[name='btnSubmit']").click(function (event) {
                    event.preventDefault();

                    var newName = $('#name').val().trim();

                    if (newName === "") {
                        alert("Không thể để trống");
                        return;
                    }
                    else if (newName === oldName) {
                        alert("Bạn chưa sửa gì");
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

