<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/7/2018
 * Time: 10:48 PM
 */
ob_start();
include "includes/header.php";
?>
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12 col-sm-12">
            <?php
            require_once  __DIR__ . "/../db/db.php";
            $db = db::getInstance();
            if(isset($_GET['id']) && filter_var($_GET['id'],FILTER_VALIDATE_INT, array('min_range'=>1)) )
            {
                $id = $_GET['id'];
                $query_id = "SELECT * FROM payment WHERE id={$id}";
                $db->select_one($query_id);
                $name = $db->getResult()->name;
            }
            else
            {
                header('Location: list_payment.php');
                exit();
            }
            if($_SERVER['REQUEST_METHOD']=='POST')
            {
                $errors = array();
                if(empty($_POST['name']))
                {
                    $errors[]='name';
                }
                else
                {
                    $name = $_POST['name'];
                }
                if(empty($errors))
                {
                    $query = "UPDATE payment
                                SET name='{$name}'
                                WHERE id={$id}";

                    if($db->execute($query))
                    {
                        echo "<p>Sửa thành công.</p>";
                    }
                    else
                    {
                        echo "<p>Bạn chưa sửa gì.</p>";
                    }
                }
                else
                {
                    $message = "<p>Bạn hãy nhập đầy đủ thông tin!</p>";
                }
            }
            ?>
            <form method="POST" name="frmedit_payment">

                <h3>Sửa phương thức thanh toán</h3>
                <div class="form-group">
                    <label>Tên</label>
                    <input type="text" name="ten" value="<?php if(isset($name)) echo  $name; ?>" class="form-control" placeholder="Tên phương thức thanh toán">
                    <?php
                        if(isset($errors) && in_array('name', $errors))
                        {
                            echo "<p>Bạn chưa nhập tên!</p>";
                        }
                    ?>
                </div>
                <input type="submit" name="submit" class="btn btn-primary" value="Sửa">
            </form>
        </div>
    </div>
<?php
    include "includes/footer.php";
    ob_flush();
?>

