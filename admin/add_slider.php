<?php
require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/../db/db.php";
$db = db::getInstance();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = "";
    if (!isset($_POST['link'])) {
        $message .= "<P class='alert alert-danger'>Bạn đã nhập thiếu Link ảnh slider</P>";//tại sao t thấy c thêm cái classs message để làm gì
    }
    if (!isset($_FILES['img'])) {
        $message .= "<p class='alert alert-danger'>Bạn chưa upload ảnh</p>";
    } else {
        $file_name = $_FILES['img']['name'];
        $file_type = substr($file_name, strrpos($file_name, "."));
        if (!in_array($file_type, [".jpg", ".png", ".jpeg", ".jpe", "gif"])) {
            $message .= "<p class='alert alert-danger'>File bạn upload lên không phải là ảnh</p>";
        } else {
            $new_file_name = substr($file_name, 0, strrpos($file_name, ".")) . "" . date('d_m_Y_H_i_s') . $file_type;
            $new_file = __DIR__ . '/../public/upload/' . $new_file_name;
            move_uploaded_file($_FILES['img']['tmp_name'], $new_file);
            if (!file_exists($new_file)) {
                $message .= "<p class='alert alert-danger'>Upload ảnh bị lỗi</p>";
            }
        }
    }
    if ($message == "") {
        if ($db->select_one("SELECT * FROM slide WHERE link = '" . db::validSql($_POST['link'])
            . "'")) {
            $message .= "<p class='alert alert-danger'>Link Slider đã tồn tại</p>";
        } elseif ($db->select_one("SELECT * FROM slide WHERE image = '" . db::validSql($new_file_name)
            . "'")) {
            $message .= "<p class='alert alert-danger'>Ảnh slider đã tồn tại</p>";
        } elseif ($db->insert("slide", ["link" => $_POST['link'], "image" => $new_file_name,])) {
            $message .= "<p class='alert alert-success'>Thêm thành công</p>";
            unset($_POST);
        } else $message .= "<p class='alert alert-danger'>Thêm thất bại</p>";
    }
}
?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h3>Thêm mới Slider</h3>
            <form method="POST" name="frm_add" id="frm_add" enctype="multipart/form-data">
                <div id="message">
                    <?php
                    if (isset($message)) {
                        echo $message;
                    }
                    ?>
                </div>
                <div class="form-group" id="input-name">
                    <label>Link</label>
                    <input type="text" name="link"
                           value="<?php if (isset($_POST['link'])) echo $_POST['link']; ?>"
                           class="form-control" placeholder="Link ảnh slider">
                </div>
                <div class="form-group" id="img">
                    <label>Ảnh</label>
                    <input type="file" name="img" value="">
                </div>
                <input type="submit" name="btnSubmit" class="btn btn-primary" value="Thêm mới">
            </form>
            <script>
                $(document).ready(function () {
                    $("#frm_add input[name='btnSubmit']").click(function (event) {
                        event.preventDefault();
                        $(".message").remove();
                        var isValidInput = true;

                        let inputName = $("#input-name input").val();
                        let label = $("#input-name label").text();

                        if (inputName.trim() === "") {
                            isValidInput = false;
                            $("#input-name").append("<p class='alert alert-danger'>Không thể để trống trường " + label + " </p>");
                        }
                        //Kiểm tra input ảnh
                        let image = $('#img input').val();//Đường dẫn tới ảnh trên máy người dùng
                        if (image === "") {
                            isValidInput = false;
                            $('#img').append("<p class='alert alert-danger message'>Bạn chưa chọn ảnh</p>");
                        } else {
                            let file_type = image.substr(image.lastIndexOf("."));//Phần mở rộng của file
                            if (![".jpg", ".png", ".jpeg", "jpe", "gif"].includes(file_type)) {//Nếu không thuộc 1 trong số này thì không phải là ảnh
                                isValidInput = false;
                                $('#img').append("<p class='alert alert-danger message'>File bạn chọn không phải là ảnh</p>");
                            }
                        }
                        //Nếu các trường input hợp lệ thì submit form
                        if (isValidInput) {
                            $('#frm_add').submit();
                        }
                    });
                })
                ;
            </script>
        </div>
    </div>
<?php require_once __DIR__ . "/includes/footer.php" ?>