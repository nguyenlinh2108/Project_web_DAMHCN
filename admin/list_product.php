<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/8/2018
 * Time: 11:01 PM
 */
require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/../db/db.php";
$db = db::getInstance();
//đặt số bản ghi cần thiết:
$limit = 100;
//xác định vị trí bắt đầu:
if (isset($_GET['s']) && filter_var($_GET['s'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
    $start = $_GET['s'];
} else {
    $start = 0;
}
if (isset($_GET['p']) && filter_var($_GET['p'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
    $per_page = $_GET['p'];
} else {
    if ($db->select_one("SELECT count(id) FROM product")) {
        $total = $db->getResult()->{'count(id)'};
        $per_page = ceil(intval($total) / $limit);
    } else {
        $per_page = 1;
    }
}
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h3>Danh sách sản phẩm</h3>
        <a href="add_product.php" class="btn btn-primary" style="float: right">Thêm mới</a>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Mã</th>
                <th>Tên</th>
                <th>Loại</th>
                <th>Mô tả</th>
                <th>Giá một SP</th>
                <th>Mã ĐVSP</th>
                <th>Số lượng</th>
                <th>Giảm giá</th>
                <th>Ảnh</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $query = "SELECT id, name, type, description, unit_price, unit_id, soluong, promotion_price, image
                        FROM product ORDER BY id ASC LIMIT {$start},{$limit}"; //n,m: n: số bản ghi đc lấy ra, m:tổng số bản ghi được lấy ra
            if ($db->select($query)) {
                foreach ($db->getResult() as $obj) {
                    ?>
                    <tr id="product_<?= $obj->id ?>">
                        <td><?php echo $obj->id; ?></td>
                        <td><?php echo $obj->name; ?></td>
                        <td><?php echo $obj->type; ?></td>
                        <td><?php echo $obj->description; ?></td>
                        <td><?php echo $obj->unit_price; ?></td>
                        <td><?php echo $obj->unit_id; ?></td>
                        <td><?php echo $obj->soluong; ?></td>
                        <td><?php echo $obj->promotion_price; ?></td>
                        <td>
                            <input class="edit_image_input" type="file" style="display: none;"/>
                            <a href="#" class="edit_image" style="font-size: 10px">
                                <img src="../public/upload/product/<?php echo $obj->image; ?>" width="50px">
                                <p>Edit image</p>
                            </a>
                        </td>

                        <td><a href="edit_product.php?id=<?php echo $obj->id; ?>"><img width="16px"
                                                                                       src="../public/images/icon_edit.png"></a>
                        </td>
                        <td><a href="delete_product.php?id=<?php echo $obj->id; ?>"
                               onclick="return confirm('Bạn có thực sự muốn xóa không?')"><img width="16px"
                                                                                               src="../public/images/icon_delete.png"></a>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
            </tbody>
        </table>
        <script>
            $(document).ready(function () {
                $("tr[id^='product_']").each(function () {
                    let id = $(this).attr("id");
                    id = id.replace("product_", "");
                    let edit_image = $(this).find(".edit_image");
                    let edit_image_input = $(this).find(".edit_image_input");

                    //Bắt sự kiện khi input file thay đỗi
                    edit_image_input.change(function () {
                        if (edit_image_input.val() !== "") {
                            //Send image to server
                            send_image(id, edit_image_input.prop('files')[0]);
                        }
                    });

                    edit_image.click(function () {
                        //Get image from computer
                        edit_image_input.trigger('click');
                    });

                });
            });

            function send_image(id, file_data) {
                if (file_data == null) return;

                var type = file_data.type;//lấy ra kiểu file

                //kiểm tra kiểu file
                if (type == null
                    || !["image/gif", "image/png", "image/jpg", "image/jpeg"].includes(type.toLowerCase())) {
                    alert("Chỉ được upload file ảnh (" + type + ")");
                } else {
                    let form_data = new FormData();//khởi tạo đối tượng form data
                    form_data.append('img', file_data);//thêm files vào trong form data
                    //sử dụng ajax post
                    $.ajax({
                        url: 'ajax/product.php?id=' + id + "&type=edit-image", // gửi đến file product.php
                        dataType: 'json',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        complete: function (response) {
                            if (response.status === 200) {
                                if (response.responseJSON.success) {
                                    if (response.responseJSON.hasOwnProperty("message")) {
                                        $("#product_" + id + " .edit_image img").attr("src", "../public/upload/product/" + response.responseJSON.message);
                                    }
                                    else alert("Sửa hành công");
                                } else {
                                    if (response.responseJSON.hasOwnProperty("message")) alert(response.responseJSON.message);
                                    else alert("Sửa thất bại");
                                }
                            } else {
                                if (response.status === 0) {
                                    alert("Không thể kết nối tới server");
                                } else {
                                    alert("Đã có lỗi xảy ra");
                                }
                            }
                        }
                    });
                }
            }

        </script>
        <?php
        echo "<ul class='pagination'>";
        if ($per_page > 1) {
            $current_page = ($start / $limit) + 1;
            //nếu không phải trang đầu tiên thì hiển thị trang trước
            if ($current_page != 1) {
                echo "<li><a href='list_product.php?s=" . ($start - $limit) . "&p={$per_page}'>Back</a></li>";
            }
            //hiển thị những phần còn lại của trang
            for ($i = 1; $i <= $per_page; $i++) {
                if ($i != $current_page) {
                    echo "<li><a href='list_product.php?s=" . ($limit * ($i - 1)) . "&p={$per_page}'>{$i}</a></li>";
                } else {
                    echo "<li class='active'><a>{$i}</a></li>";
                }
            }
            //nếu không phải trang cuối cùng thì hiển thị mút next
            if ($current_page != $per_page) {
                echo "<li><a href='list_product.php?s=" . ($start + $limit) . "&p={$per_page}'>Next</a></li>";
            }
        }
        echo "</ul>";
        ?>
    </div>
</div>
<?php require_once __DIR__ . "/includes/footer.php"; ?>
