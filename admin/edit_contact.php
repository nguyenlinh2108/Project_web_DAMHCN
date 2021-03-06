<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/12/2018
 * Time: 9:15 PM
 */
ob_start();
require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/../db/db.php";
$db = db::getInstance();
$message = "";

if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
    $id = $_GET['id'];
    if ($db->select_one("SELECT * FROM contact WHERE id={$id}")) {
        $name_db = $db->getResult()->name;
        $email_db = $db->getResult()->email;
        $phone_db = $db->getResult()->phone;
        $message_db = $db->getResult()->message;
    } else {
        //Không có bản ghi nào có id như vậy
        header('Location: list_contact.php');
        exit();
    }
} else {
    header('Location: list_contact.php');
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['name'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu tên</p>";
    }
    if (!isset($_POST['email'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu email</p>";
    } else if (!strpos($_POST['email'], "@") || !strpos($_POST['email'], ".")) {//Email phải có ít nhất dấu @ và dấu .
        $message .= "<p class='alert alert-danger message'>Email không hợp lệ</p>";
    }
    if (!isset($_POST['sdt'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu số điện thoại</p>";
    } elseif (!is_numeric($_POST['sdt'])) {
        $message .= "<p class='alert alert-danger message'>Số điện thoại không hợp lệ</p>";
    }
    if (!isset($_POST['noidung'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu nội dung phản hồi</p>";
    }
    if ($message === "") {
        if($_POST['name'] === $name_db
            && $_POST['email'] === $email_db
            && $_POST['sdt'] === $phone_db
            && $_POST['noidung'] === $message_db
        )
        {
            $message = "<p class='alert alert-danger message'>Bạn chưa sửa gì.</p>";
        }else if ($db->update("contact",
            [
                "name" => $_POST['name'],
                "email" => $_POST['email'],
                "phone" => $_POST['sdt'],
                "message" => $_POST['noidung'],
            ],
            "id = {$id}"))
        {
            $name_db = $_POST['name'];
            $email_db = $_POST['email'];
            $phone_db = $_POST['sdt'];
            $message_db = $_POST['noidung'];
            $message = "<p class='alert alert-success message' ;>Sửa thành công.</p>";
        } else {
            $message = "<p class='alert alert-danger message'>Sửa thất bại.</p>";
        }
    }
}
?>
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12" id="my_pad_top">
            <a href="list_contact.php" class="btn btn-primary">Về trang danh sách phản hồi</a>
            <a href="index.php" class="btn btn-primary" style="float: right">Về trang chủ</a>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <h3>Thêm mới phản hồi</h3>
            <form id="frm_add" method="POST" name="frm_add" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Tên</label>
                    <input type="text" class="form-control"
                           name="name" value="<?php if(isset($name_db)) echo $name_db; ?>"
                           placeholder="Tên">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control"
                           name="email" value="<?php if(isset($email_db)) echo $email_db; ?>"
                           placeholder="Email">
                </div>
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" class="form-control"
                           name="sdt" value="<?php if(isset($phone_db)) echo $phone_db; ?>"
                           placeholder="Số điện thoại">
                </div>
                <div class="form-group" id="noidung">
                    <label>Nội dung phản hồi</label>
                    <input type="text" hidden name="noidung" value="<?php if(isset($message_db)) echo $message_db; ?>">
                    <textarea name="noidung" placeholder="Nội dung phản hồi" class="form-control" id="noidung"
                    ><?php if(isset($message_db)) echo trim($message_db) ?></textarea>
                </div>
                <input type="submit" name="btnSubmit" class="btn btn-primary" value="Sửa">
                <a href="index.php" class="btn btn-primary">Hủy</a>
            </form>
            <script>
                $(document).ready(function () {
                    //bắt sự kiện click vào nút thêm mới
                    $("#frm_add input[name='btnSubmit']").click(function (event) {
                        event.preventDefault();//ngăn tự động submit form
                        //Nếu các trường input hợp lệ thì submit form
                        if (checkInput()) {
                            $('#frm_add').submit();
                        }
                    });


                    //Bắt sự kiện khi gõ vào các trường input
                    $("input").keyup(function () {
                        checkInput();
                    });

                    //Bắt sự kiện khi gõ vào trường nội dung
                    $("#noidung").keyup(function () {
                        checkInput();
                    });
                });

                //Hàm kiểm tra các giá trị đầu vào và hiển thị thông báo lỗi nếu có
                function checkInput() {
                    $(".message").remove(); //Xóa hết tất cả các thông báo trước uk, nhưng  class message không có trong thông báo
                    var isValidInput = true;//biến kiểm tra xem các input có hợp lệ không

                    //Duyệt qua tất cả các input của form
                    $("#frm_add .form-group:has(input[type='text'])").not("#noidung").each(function () {
                        let input = $(this).find("input[type='text']");//giá trị input
                        let label = $(this).find("label").text();//nhãn nằm trong thẻ label
                        if (typeof input.val() === "string") {//Nếu trường input là string (text)
                            if (input.val() == null || input.val().trim() === "") {//Nếu giá trị input rỗng
                                isValidInput = false;
                                $(this).append("<p class='alert alert-danger message'>Không thể để trống trường " + label + "</p>");
                            } else if (label === "Số điện thoại" && !isUnsignedNumber(input.val())) {
                                //Kiểm tra xem giá trị input có là số không
                                isValidInput = false;
                                $(this).append("<p class='alert alert-danger message'>Bạn phải nhập " + label + " là số.</p>");
                            } else if (label === "Email" && !isValidEmail(input.val())) {
                                //Kiểm tra xem giá trị input có là email hợp lệ không đối với các nhãn Email
                                isValidInput = false;
                                $(this).append("<p class='alert alert-danger message'>Bạn phải nhập " + label + " hợp lệ</p>");
                            }
                        }

                    });

                    //Check trường textarea
                    let noidungInput = $("#noidung").find("textarea").val().trim();
                    let noidungLabel = $("#noidung").find("label").text();
                    if ((noidungInput === "")) {
                        isValidInput = false;
                        $("#noidung").append("<p class='alert alert-danger message'>Bạn phải nhập " + noidungLabel + " hợp lệ</p>");
                    } else {
                        $("#noidung").find("input").val(noidungInput)//Gán nội dung từ textarea vào input
                    }

                    return isValidInput;
                }
                //Hàm kiểm tra xem 1 chuỗi có phải là 1 số không âm không
                function isUnsignedNumber(str) {
                    return /^\d+$/.test(str);
                }
                //Kiểm tra xem 1 chuỗi có phải là 1 địa chỉ email hợp lệ không
                function isValidEmail(email) {
                    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    return re.test(String(email).toLowerCase());
                }
            </script>
        </div>
    </div>
<?php require_once __DIR__ . "/includes/footer.php";
    ob_flush();
?>