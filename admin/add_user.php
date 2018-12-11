<?php
require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/../db/db.php";
require_once __DIR__ . "/class/auth.php";

$db = db::getInstance();

$level_array = ['Quản trị viên', 'Biên tập viên'];
$gender_array = ['Nam', 'Nữ', 'Khác'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = "";
    if (!isset($_POST['name'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu tên</p>";
    }
    if (!isset($_POST['email'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu email</p>";
    } else if (!strpos($_POST['email'], "@") || !strpos($_POST['email'], ".")) {//Email phải có ít nhất dấu $ và dấu .
        $message .= "<p class='alert alert-danger message'>Email không hợp lệ</p>";
    }
    if (!isset($_POST['gender'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu giới tính</p>";
    } else if (!in_array($_POST['gender'], $gender_array)) {
        $message .= "<p class='alert alert-danger message'>Giới tính không hợp lệ</p>";
    }
    if (!isset($_POST['password'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã nhập thiếu mật khẩu</p>";
    } else if (!isset($_POST['repassword'])) {
        $message .= "<p class='alert alert-danger message'>Bạn đã chưa nhập lại mật khẩu</p>";
    }  else if (strlen($_POST['repassword']) < 3) {
        $message .= "<p class='alert alert-danger message'>Mật khẩu quá ngắn, ít nhất 3 ký tự</p>";
    } else if ($_POST['password'] !== $_POST['repassword']) {
        $message .= "<p class='alert alert-danger message'>Mật khẩu bạn nhập không khớp</p>";
    }
    if (!isset($_POST['phone'])) {
        $message .= "<p class='alert alert-danger message'>Bạn chưa nhập số điện thoại</p>";
    } else if (!is_numeric($_POST['phone'])) {
        $message .= "<p class='alert alert-danger message'>Số điện thoại không hợp lệ</p>";
    }
    if (!isset($_POST['address'])) {
        $message .= "<p class='alert alert-danger message'>Bạn chưa nhập địa chỉ</p>";
    }
    if (!isset($_POST['level'])) {
        $message .= "<p class='alert alert-danger message'>Bạn chưa chọn quyền</p>";
    } else if (!in_array($_POST['level'], $level_array)) {
        $message .= "<p class='alert alert-danger message'>Quyền bạn nhập không hợp lệ</p>";
    }

    if (!isset($_FILES['avatar'])) {
        $message .= "<p class='alert alert-danger message'>Bạn chưa upload ảnh đại diện</p>";
    } else if ($_FILES['avatar']['error'] > 0) {
        $message .= "<p class='alert alert-danger message'>Upload ảnh đại diện bị lỗi</p>";
    } else {
        $file_name = $_FILES['avatar']['name'];
        $file_type = substr($file_name, strrpos($file_name, "."));
        if (!in_array($file_type, [".jpg", ".png", ".jpeg", "jpe", "gif"])) {
            $message .= "<p class='alert alert-danger message'>File bạn upload lên không phải là ảnh</p>";
        } else {
            $new_file_name = substr($file_name, 0, strrpos($file_name, ".")) . " " . date('d_m_Y H_i_s') . $file_type;
            $new_file = __DIR__ . '/../public/upload/' . $new_file_name;
            move_uploaded_file($_FILES['avatar']['tmp_name'], $new_file);
            if (!file_exists($new_file)) {//Nếu file không tồn tại
                $message .= "<p class='alert alert-danger message'>Upload ảnh đại diện bị lỗi</p>";
            }
        }

    }

    if ($message === "") {
        if ($db->select_one("SELECT * FROM user WHERE email = '" . db::validSql($_POST['email'])
            . "'")) {
            $message .= "<p class='alert alert-danger'>Email đã tồn tại.</p>";
        }else if ($db->select_one("SELECT * FROM user WHERE phone = '" . db::validSql($_POST['phone'])
            . "'")) {
            $message .= "<p class='alert alert-danger'>Số điện thoại đã tồn tại.</p>";
        } else if ($db->insert("user", [
            "name" => $_POST['name'],
            "email" => $_POST['email'],
            "gender" => $_POST['gender'],
            "password" => auth::getMD5Password($_POST['password']),
            "phone" => $_POST['phone'],
            "address" => $_POST['address'],
            "level" => $_POST['level'],
            "avatar" => $new_file_name,
        ])) {
            $message .= "<p class='alert alert-success'>Thêm thành công user " . $_POST['name'] . "</p>";
            unset($_POST);
        } else $message .= "<p class='alert alert-danger'>Thêm thất bại</p>";
    }
}
?>

<div class="row">
	<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
		<form name="frmadd_user" id="frmadd_user" method="POST" enctype="multipart/form-data">
			<?php 
				if(isset($message))
				{
					echo $message;
				}
			?>
			<h3>Thêm mới User</h3>
			<div class="form-group">
				<label>Tên</label>
				<input type="text" name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>"
                       class="form-control" placeholder="Tên">
			</div>
            <div class="form-group">
				<label>Email</label>
				<input type="text" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>"
                       class="form-control" placeholder="Email">
			</div>
            <div class="form-group">
                <label>Giới tính</label>
                <input type="text" hidden name="gender" value="">
                <select id="select-status" class="selectpicker show-tick" data-width="auto" title="Chọn giới tính">
                    <?php
                    foreach ($gender_array as $gender){
                        ?>
                        <option value="<?= $gender ?>" <?php if(isset($_POST['gender']) && $_POST['gender'] === $gender) echo "selected"; ?>><?= ucfirst($gender) ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
				<label>Ảnh đại diện</label>
                <input type="file" name="avatar" value="">
			</div>
            <div class="form-group" id="input-password">
				<label>Mật khẩu</label>
				<input type="password" name="password" value="<?php if(isset($_POST['password'])) echo $_POST['password']; ?>"
                       class="form-control" placeholder="Mật khẩu">
			</div>
            <div class="form-group" id="input-repassword">
				<label>Nhập lại mật khẩu</label>
				<input type="password" name="repassword" value="<?php if(isset($_POST['repassword'])) echo $_POST['repassword']; ?>"
                       class="form-control" placeholder="Nhập lại mật khẩu">
			</div>
            <div class="form-group">
				<label>Số điện thoại</label>
				<input type="text" name="phone" value="<?php if(isset($_POST['phone'])) echo $_POST['phone']; ?>"
                       class="form-control" placeholder="Số điện thoại">
			</div>
            <div class="form-group">
				<label>Địa chỉ</label>
				<input type="text" name="address" value="<?php if(isset($_POST['address'])) echo $_POST['address']; ?>"
                       class="form-control" placeholder="Địa chỉ">
			</div>
            <div class="form-group">
                <label>Quyền</label>
                <input type="text" hidden name="level" value="">
                <select id="select-status" class="selectpicker show-tick" data-width="auto" title="Chọn quyền">
                    <?php
                    foreach ($level_array as $level){
                        ?>
                        <option value="<?= $level ?>" <?php if(isset($_POST['level']) && $_POST['level'] === $level) echo "selected"; ?>><?= ucfirst($level) ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>

			<input type="submit" name="btnSubmit" class="btn btn-primary" value="Thêm mới">
		</form>
        <script>
            $(document).ready(function () {

                //bắt sự kiện click vào nút thêm mới
                $("#frmadd_user input[name='btnSubmit']").click(function (event) {
                    event.preventDefault();//ngăn tự động submit form
                    //Nếu các trường input hợp lệ thì submit form
                    if (checkInput()) {
                        $('#frmadd_user').submit();
                    }
                });

                //Bắt sự kiện khi gõ vào các trường input
                $("input").keyup(function(){
                    checkInput();
                });

                //Bắt sự kiện khi lựa chọn 1 option trong các trường select
                $( ".selectpicker" ).change(function() {
                    checkInput();
                });

                //Bắt sự kiện khi lựa chọn 1 file trong trường input file
                $( "input[type='file']" ).change(function() {
                    checkInput();
                });
            });

            //Hàm kiểm tra các giá trị đầu vào và hiển thị thông báo lỗi nếu có
            function checkInput() {
                $(".message").remove();//Xóa hết tất cả các thông báo trước
                var isValidInput = true;//biến kiểm tra xem các input có hợp lệ không
                //Duyệt qua tất cả các input của form
                $("#frmadd_user .form-group:has(input[type='text'])").not( $(".form-group:has(.selectpicker)")).each(function () {
                    let input = $(this).find("input[type='text']");//Giá trị input
                    let label = $(this).find("label").text();//Nhãn (nằm trong thẻ label)
                    if (typeof input.val() === "string") {//Nếu trường input là string (text)
                        if (input.val() == null || input.val().trim() === "") {//Nếu giá trị input rỗng
                            isValidInput = false;
                            $(this).append("<p class='alert alert-danger message'>Không thể để trống trường " + label + "</p>");
                        } else if (label === "Số điện thoại" && !isUnsignedNumber(input.val())) {
                            //Kiểm tra xem giá trị input có là số không đối với các nhãn Số điện thoại
                            isValidInput = false;
                            $(this).append("<p class='alert alert-danger message'>Bạn phải nhập " + label + " là số</p>");
                        } else if (label === "Email" && !isValidEmail(input.val())) {
                            //Kiểm tra xem giá trị input có là email hợp lệ không đối với các nhãn Email
                            isValidInput = false;
                            $(this).append("<p class='alert alert-danger message'>Bạn phải nhập " + label + " hợp lệ</p>");
                        }
                    }
                });
                //Duyệt qua các trường select (có thể chọn giá trị option đó)
                $("#frmadd_user .form-group:has(.selectpicker)").each(function () {
                    let label = $(this).find("label").text();//Nhãn (nằm trong thẻ label)
                    let selectpicker = $(this).find(".selectpicker").selectpicker('val');//Lấy giá trị đang được chọn
                    if (selectpicker === "") {
                        isValidInput = false;
                        $(this).append("<p class='alert alert-danger message'>Bạn chưa chọn " + label + "</p>");
                    } else {
                        $(this).find("input").attr("value", selectpicker);//Truyền vào trường input
                    }
                });
                //Kiểm tra mật khẩu và nhập lại mật khẩu
                let inputPassword = $('#input-password');
                let pass =inputPassword.find("input").val();//Giá trị password người dùng nhập vào
                let inputRepassword = $('#input-repassword');
                let repass =inputRepassword.find("input").val();//Giá trị password nhập lại người dùng nhập vào
                if (pass === "") {
                    isValidInput = false;
                    inputPassword.append("<p class='alert alert-danger message'>Bạn chưa nhập mật khẩu</p>");
                } else if (pass.length < 3) {
                    isValidInput = false;
                    inputPassword.append("<p class='alert alert-danger message'>Mật khẩu quá ngắn, ít nhất 3 ký tự</p>");
                }
                else if (repass === "") {
                    isValidInput = false;
                    inputRepassword.append("<p class='alert alert-danger message'>Bạn chưa nhập lại mật khẩu</p>");
                } else if (pass !== repass) {
                    isValidInput = false;
                    inputRepassword.append("<p class='alert alert-danger message'>Mật khẩu nhập lại không khớp</p>");
                }
                //Kiểm tra input ảnh
                let inputFile = $('.form-group:has(input[type="file"])');
                let image = inputFile.find("input[type='file']").val();//Đường dẫn tới ảnh trên máy người dùng
                if (image === "") {
                    isValidInput = false;
                    inputFile.append("<p class='alert alert-danger message'>Bạn chưa chọn ảnh</p>");
                } else {
                    let file_type = image.substr(image.lastIndexOf("."));//Phần mở rộng của file
                    if (![".jpg", ".png", ".jpeg", "jpe", "gif"].includes(file_type)) {//Nếu không thuộc 1 trong số này thì không phải là ảnh
                        isValidInput = false;
                        inputFile.append("<p class='alert alert-danger message'>File bạn chọn không phải là ảnh</p>");
                    }
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
<?php require_once __DIR__. "/includes/footer.php" ?>