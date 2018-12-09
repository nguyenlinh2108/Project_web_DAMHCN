<?php
require_once  __DIR__ . "/includes/header.php";
require_once  __DIR__ . "/../db/db.php";
$db = db::getInstance();

?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h3>Thêm mới Slider</h3>
        <form method="POST" name="frm_add" id="frm_add" enctype="multipart/form-data">
            <div id="message">

            </div>
            <div class="form-group">
                <label>Link</label>
                <input type="text" name="link"
                        value=""
                        class="form-control" placeholder="Link ảnh slider">
            </div>
            <div class="form-group">
                <label>Ảnh</label>
                <input type="file" name="img" value="">
            </div>
            <input type="submit" name="btnSubmit" class="btn btn-primary" value="Thêm mới">
        </form>
    </div>
</div>
