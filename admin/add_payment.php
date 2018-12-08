<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/8/2018
 * Time: 9:24 AM
 */
require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/../db/db.php";

$db = db::getInstance();
?>
<style type="text/css">
    .required
    {
        color:red;
    }
</style>
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12 col-sm-12">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = array();
            if (empty($_POST['name'])) {
                $errors[] = 'name';
                $message = "<p class='required'>Bạn hãy nhập đầy đủ thông tin</p>";
            } else {

                $name = $_POST['name'];
                if ($db->insert("payment", ['name' => $name])) {
                    echo "<p style='color:green';>Thêm mới thành công</p>";
                    $name = '';
                } else {
                    echo "<p class='required'>Thêm mới không thành công! Tên này đã tồn tại!</p>";
                }
            }
        }
        ?>
        <form method="POST" name="frmadd_payment">
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <h3>Thêm mới phương thức thanh toán</h3>
            <div class="form-group">
                <label>Tên</label>
                <input type="text" name="name" value="<?php if (isset($name)) echo $name; ?>" class="form-control"
                       placeholder="Tên phương thức thanh toán">
                <?php
                if (isset($errors) && in_array('name',$errors)) {
                    echo "<p class='required'>Bạn chưa nhập tên!</p>";
                }
                ?>
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Thêm">
        </form>
    </div>
</div>
<?php require_once __DIR__ . "/includes/footer.php"; ?>
