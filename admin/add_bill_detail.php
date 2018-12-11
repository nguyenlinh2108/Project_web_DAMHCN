<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/11/2018
 * Time: 4:49 PM
 */
require_once  __DIR__ . "/includes/header.php";
require_once  __DIR__ . "/../db/db.php";
$db = db::getInstance();
if($db->select("SELECT * FROM bill  "))
{
    $hoadons = $db->getResult();
}
if($db->select("SELECT * FROM product"))
{
    $sanphams = $db->getResult();
}


?>
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
        <h3>Thêm mới hóa đơn chi tiết</h3>
        <form id="frm_add" method="POST" name="frm_add" enctype="multipart/form-data">
            <div class="form-group">
                <label>Mã hóa đơn</label>
                <input type="text" hidden name="mahd" value="">
                <select id="select-mahd" title="Chọn mã hóa đơn" class="selectpicker show-tick" ơ
                >
                    <?php
                    if(isset($hoadons) && is_array($hoadons))
                    {
                        foreach ($hoadons as $hoadon)
                        {
                            ?>
                            <option value="<?php echo $hoadon->id; ?>" <?php if(isset($_POST['mahd']) && $_POST['mahd'] === $hoadon->id) echo "selected"; ?> > <?php echo $hoadon->customer_id; ?> </option>
                            <?php

                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Mã sản phẩm</label>
                <input type="text" hidden  name="masp" value="">
                <select id="select-masp" class="selectpicker show-tick" data-width="auto" title="Chọn mã sản phẩm">
                    <?php
                    if(isset($sanphams) && is_array($sanphams))
                    {
                        foreach ($sanphams as $sanpham)
                        {
                            ?>
                            <option value="<?php echo $sanpham->id; ?>" <?php if(isset($_POST['masp']) && $_POST['masp']===$sanpham->id) echo "selected";?>><?php echo $sanpham->name; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Số lượng</label>
                <input type="text" class="form-control"
                       name="soluong" value=""
                       placeholder="Số lượng">
            </div>
            <div class="form-group">
                <label>Giá</label>
                <input type="text" class="form-control"
                       name="gia" value=""
                       placeholder="Giá">
            </div>
            <input type="submit" name="btnsubmit" class="btn btn-primary">
            <a href="index.php" class="btn btn-primary">Hủy</a>
        </form>
    </div>
</div>
<?php require_once  __DIR__ . "/includes/footer.php"; ?>
