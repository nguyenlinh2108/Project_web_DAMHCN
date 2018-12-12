<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/7/2018
 * Time: 5:02 PM
 */
include "includes/header.php";
?>
<?php require_once __DIR__ . "/../db/db.php"; ?>
    <h3>Danh sách khách hàng</h3>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="order_by_group" style="margin-bottom: 20px">
                <div style="padding: 6px 12px;"><label>Tìm kiếm với:</label></div>
                <div class="form-group" style="float: left">
                    <input style="width: auto" type="text" class="form-control" id="search_content"
                           placeholder="Nhập nội dung">
                </div>
                <div style="float: left; padding: 6px 12px;"><label>Tìm kiếm theo:</label></div>
                <div style="float: left">
                    <select id="search_field" class="selectpicker show-tick" data-width="auto">
                        <option value="name">Tên</option>
                        <option value="gender">Giới tính</option>
                        <option value="email">Email</option>
                        <option value="address">Địa chỉ</option>
                        <option value="phone">Số điện thoại</option>
                    </select>
                </div>
                <div>
                    <button style="margin-left: 20px" class="btn btn-primary" id="filter_button" onclick="doAjax(0)">Tìm
                        kiếm
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="search-result">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <a href="add_customer.php" class="btn btn-primary" style="float: right">Thêm mới</a>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Mã</th>
                    <th>Tên</th>
                    <th>Giới tính</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                    <th>Phone</th>
                    <th>Ngày sinh</th>
                    <th>Chú thích</th>
                    <th>Điểm tích lũy</th>
                    <th>Block</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Block</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $db = db::getInstance();
                //đặt số bản ghi cần thiết:
                $limit = 10;
                //xác định vị trí bắt đầu:
                if (isset($_GET['s']) && filter_var($_GET['s'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
                    $start = $_GET['s'];
                } else {
                    $start = 0;
                }
                if (isset($_GET['p']) && filter_var($_GET['p'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
                    $per_page = $_GET['p'];
                } else {
                    if ($db->select_one("SELECT count(id) FROM customer")) {
                        $total = $db->getResult()->{'count(id)'};
                        $per_page = ceil(intval($total) / $limit);
                    } else {
                        $per_page = 1;
                    }
                }
                $query = "SELECT id, name, gender, email, password, address, phone, birthday, note, point, time_block 
                        FROM customer ORDER BY id ASC LIMIT {$start},{$limit}"; //n,m: n: số bản ghi đc lấy ra, m:tổng số bản ghi được lấy ra
                if ($db->select($query)) {
                    foreach ($db->getResult() as $obj) {
                        ?>
                        <tr id="<?= $obj->id ?>">
                            <td><?= $obj->id ?></td>
                            <td><?= $obj->name ?></td>
                            <td><?= $obj->gender ?></td>
                            <td><?= $obj->email ?></td>
                            <td><?= $obj->address ?></td>
                            <td><?= $obj->phone ?></td>
                            <td><?= $obj->birthday ?></td>
                            <td><?= $obj->note ?></td>
                            <td><?= $obj->point ?></td>
                            <td><?= $obj->time_block; ?></td>
                            <td><a href="edit_customer.php?id=<?= $obj->id; ?>"><i class="fa fa-edit"></a></td>
                            <td><a href="delete_customer.php?id=<?= $obj->id; ?>"><i class="fa fa-remove"></a></td>
                            <td><a href="block_customer.php?id=<?= $obj->id; ?>"><i class="fa fa-ban"></a></td>
                        </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
            <?php
            echo "<ul class='pagination'>";
            if ($per_page > 1) {
                $current_page = ($start / $limit) + 1;
                //nếu không phải trang đầu tiên thì hiển thị trang trước
                if ($current_page != 1) {
                    echo "<li><a href='list_customer.php?s=" . ($start - $limit) . "&p={$per_page}'>Back</a></li>";
                }
                //hiển thị những phần còn lại của trang
                for ($i = 1; $i <= $per_page; $i++) {
                    if ($i != $current_page) {
                        echo "<li><a href='list_customer.php?s=" . ($limit * ($i - 1)) . "&p={$per_page}'>{$i}</a></li>";
                    } else {
                        echo "<li class='active'><a>{$i}</a></li>";
                    }
                }
                //nếu không phải trang cuối cùng thì hiển thị mút next
                if ($current_page != $per_page) {
                    echo "<li><a href='list_customer.php?s=" . ($start + $limit) . "&p={$per_page}'>Next</a></li>";
                }
            }
            echo "</ul>";
            ?>
        </div>
    </div>
    <script>
        var AJAX_URL = "/admin/ajax/customer.php";

        //Search customer
        var start = 0;
        const limit = 10;
        var moreResult = true;
        var type = "search";
        var pending = false;

        var search_content;
        var search_field;
        getInputData();
        var ajax_url;

        //Thu thập các input đầu vào
        function getInputData() {
            search_content = $("#search_content").val();
            if (search_content != null) search_content = search_content.trim();
            if (search_content === "") search_content = null;
            search_field = $('#search_field').selectpicker('val');
        }

        function doAjax(startInput = 0) {
            if (pending) return;
            if (type == null) return;
            start = startInput;
            if (startInput === 0) {
                getInputData();
            }


            let new_ajax_url = AJAX_URL + "?type=" + type;
            if (search_content != null) new_ajax_url += "&" + search_field + "=" + encodeURI(search_content);
            new_ajax_url += "&start=" + startInput + "&limit=" + limit;

            if (ajax_url === new_ajax_url) {
                console.log("Chưa có thay đỗi gì");
                return;
            }
            else ajax_url = new_ajax_url;

            pending = true;
            $.ajax({
                url: ajax_url,
                type: 'GET',
                complete: function (response) {
                    if (response.status === 200) {
                        if (response.responseText === "null") {
                            moreResult = false;
                            if (startInput === 0) {
                                $('#search-result tr[id]').remove();
                                alert("Không có dữ liệu");
                            }
                        }
                        else {
                            moreResult = true;
                            console.log(response.responseJSON);
                            buildResult(response.responseJSON);
                            start = startInput + limit;
                        }
                    } else if (response.status === 0) {
                        alert("Không thể kết nối tới server");
                    } else {
                        moreResult = false;
                        if (startInput === 0) {
                            alert("Đã có lỗi xảy ra");
                        }
                    }
                    pending = false;
                }
            });
        }

        function remove(id) {
            if (confirm('Are you sure?')) {
                $.ajax({
                    url: AJAX_URL + "?type=remove&id=" + id,
                    dataType: 'json',
                    complete: function (response) {
                        if (response.status === 200) {
                            $('#' + id).remove();
                            console.log(response.responseJSON.message);
                            alert("Xóa thành công");
                        } else {
                            if (response.status === 0) {
                                alert("Không thể kết nối tới server");
                            } else if (response.hasOwnProperty("responseJSON")) {
                                alert(response.responseJSON.message);
                            } else {
                                alert("Đã có lỗi xảy ra");
                            }

                        }
                    }
                });
            }
        }

        function buildResult(data) {
            if ((typeof data).toLowerCase() !== "object" || data == null || data.length === 0) return;
            if (data.length < limit) moreResult = false;

            if (start === 0) {
                $('#search-result tr[id]').remove();
            }

            $('#search-result').show();
            for (var i = 0; i < data.length; i++) {
                var row = "<tr id=\"" + data[i].id + "\">";
                row += "<td>" + data[i].id + "</td>";
                row += "<td>" + data[i].name + "</td>";
                row += "<td class='approval_status'>" + data[i].gender + "</td>";
                row += "<td>" + ((data[i].email == null) ? "Không có" : data[i].email) + "</td>";
                row += "<td>" + ((data[i].address == null) ? "Không có" : data[i].address) + "</td>";
                row += "<td>" + ((data[i].phone == null) ? "Không có" : data[i].phone) + "</td>";
                row += "<td>" + ((data[i].birthday == null) ? "Không có" : data[i].birthday) + "</td>";
                row += "<td>" + ((data[i].note == null || data[i].note === "") ? "Không có" : data[i].note) + "</td>";
                row += "<td>" + data[i].point + "</td>";
                row += "<td>" + ((data[i].time_block == null) ? "Không có" : timeago().format(data[i].time_block, 'vi')) + "</td>";
                row += "<td><a href=\"edit_customer.php?id=" + data[i].id + "\"><i class=\"fa fa-edit\"></a></td>";
                row += "<td><a href=\"javascript: remove(" + data[i].id + ")\"><i class=\"fa fa-remove\"></a></td>";
                row += "<td><a href=\"javascript: block(" + data[i].id + ")\"><i class=\"fa fa-ban\"></a></td>";
                row += "</tr>";
                $('#search-result tbody').append(row);
            }
        }
    </script>

<?php include "includes/footer.php" ?>