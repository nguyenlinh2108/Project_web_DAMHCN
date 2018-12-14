<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/7/2018
 * Time: 5:02 PM
 */
include "includes/header.php";
?>
    <h3>Danh sách khách hàng</h3>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="order_by_group" style="margin-bottom: 20px">
                <div style="padding: 6px 12px;"><label>Tìm kiếm với:</label></div>
                <div class="form-group" style="float: left" id="div_search">
                    <input style="width: auto" type="text" class="form-control" id="search_content" placeholder="Nhập nội dung">
                    <div id="div_gender"></div>
                </div>
                <div style="float: left; padding: 6px 12px;"><label>Tìm kiếm theo:</label></div>
                <div style="float: left">
                    <select id="search_field" class="selectpicker show-tick" data-width="auto" title="Danh mục tìm kiếm">
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

            <label id="total_record">Tổng cộng có: </label>
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
                </tbody>
            </table>
            <ul id="pagination" class="pagination"></ul>
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

        //Thu thập các input đầu vào truyền vào các biến search_content và search_field
        function getInputData() {
            search_content = $("#search_content").val();
            if (search_content != null) search_content = search_content.trim();
            if (search_content === "") search_content = null;
            search_field = $('#search_field').selectpicker('val');
            if(search_field === "gender"){
                search_content = $('#gender_search_field').selectpicker('val');
            }
        }


        $( document ).ready(function() {
            doAjax(0);//Tìm kiếm lần đầu khi vừa load trang xong

            //Bắt sự kiện khi gõ vào trường input search thì kiểm tra giá trị đầu vào luôn
            $("#search_content").keyup(function(){
                checkInput();
            });

            //Bắt sự kiện khi lựa chọn 1 option trong trường lựa chọn tìm kiếm theo
            $( "#search_field" ).change(function() {
                search_field = $('#search_field').selectpicker('val');
                if(search_field === "gender"){//Nếu là tìm kiếm theo giới tính thì chuyển input sang select gender option
                    tranform_search_field_to_selectpicker();
                } else {//Còn không thì chuyển lại sang text input
                    revert_tranform_search_field_from_selectpicker();
                }

                checkInput();
            });

            //Bắt sự kiện khi enter ở trường input thì tìm kiếm luôn
            $('#search_content').keypress(function (e) {
                if (e.which == 13) {
                    $('#filter_button').click();
                    return false;    //<---- Add this line
                }
            });
        });

        //Chuyển trường input từ text field to select option field khi chọn tìm kiếm theo giới tính
        function tranform_search_field_to_selectpicker() {
            var gender_selectpicker =
                "<div style=\"float: left\">" +
                "<select id=\"gender_search_field\" class=\"selectpicker show-tick\" data-width=\"auto\">\n" +
                "<option value=\"Nam\">Nam</option>\n" +
                "<option value=\"Nữ\">Nữ</option>\n" +
                "<option value=\"Khác\">Khác</option>\n" +
                "</select>" +
                "</div>";
            $("#div_gender").append(gender_selectpicker);
            $("#search_content").attr("type","hidden");//Ẩn trường input text đi

            $(".selectpicker").selectpicker();//Phải chạy lệnh này để kích hoạt selectpicker, vì mình vừa thêm mới
        }

        //Chuyển ngược lại hàm tranform_search_field_to_selectpicker
        //Tức là chuyển input search sang text
        function revert_tranform_search_field_from_selectpicker() {
            $("#div_gender").html("");
            $("#search_content").attr("type","text");
        }


        //Kiểm tra giá trị đầu vào
        function checkInput() {
            getInputData();
            $('.alert-danger').remove();

            var isValidInput = true;
            switch (search_field) {
                case "gender":
                    if (search_content == null || !["nam", "nữ", "khác"].includes(search_content.toLowerCase())) {
                        isValidInput = false;
                        $('#order_by_group').append("<p class='alert alert-danger'>Giới tính không hợp lệ<br>Các giá trị cho phép: Nam, Nữ, Khác</p>");
                    }
                    break;
                case "phone":
                    if (search_content == null || !isUnsignedNumber(search_content)) {
                        isValidInput = false;
                        $('#order_by_group').append("<p class='alert alert-danger'>Số điện thoại không hợp lệ</p>");
                    }
                    break;
            }
            return isValidInput;
        }

        //Hàm kiểm tra xem 1 chuỗi có phải là 1 số không âm không
        function isUnsignedNumber(str) {
            return /^\d+$/.test(str);
        }

        //Tìm kiếm
        function doAjax(startInput = 0) {
            if (pending) return;
            if (type == null) return;
            start = startInput;
            if (startInput === 0) {
                if (!checkInput()) return;
            }


            let new_ajax_url = AJAX_URL + "?type=" + type;
            if (search_content != null) new_ajax_url += "&" + search_field + "=" + encodeURI(search_content);
            new_ajax_url += "&start=" + startInput + "&limit=" + limit;

            //Nếu url cũ giống url mới thì không tìm kiếm
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
                                $('#total_record').html("<p style='color:red'>Không có kết quả</p>");
                                $('#pagination li').remove();//Xóa pagination cũ đi
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

        //Xóa 1 bản ghi
        function remove(id) {
            if (confirm('Are you sure?')) {
                $.ajax({
                    url: AJAX_URL + "?type=remove&id=" + id,
                    dataType: 'json',
                    complete: function (response) {
                        if (response.status === 200) {
                            if(response.responseText === "true"){
                                $('#' + id).remove();
                                alert("Xóa thành công");
                            } else {
                                alert("Xóa thất bại");
                            }

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

        //Build phân trang
        function buildPanitation(total) {
            $('#total_record').text("Tổng cộng có " + total + " kết quả");
            $('#pagination li').remove();//Xóa pagination cũ đi

            var pagination = "";
            var per_page = Math.ceil(total / limit);
            if (total > 1) {
                var current_page = (start / limit) + 1;
                //nếu không phải trang đầu tiên thì hiển thị trang trước
                if (current_page !== 1) {
                    pagination += "<li><a href='javascript: doAjax(0)'>Back</a></li>";
                }
                //hiển thị những phần còn lại của trang
                for (let i = 1; i <= per_page; i++) {
                    if (i !== current_page) {
                        pagination += "<li><a href='javascript: doAjax(" + (limit * (i - 1)) + ")'>" + i + "</a></li>";
                    } else {
                        pagination += "<li class='active'><a>" + i + "</a></li>";
                    }
                }
                //nếu không phải trang cuối cùng thì hiển thị mút next
                if (current_page !== per_page) {
                    pagination += "<li><a href='javascript: doAjax(" + (limit * (per_page - 1)) + ")'>Next</a></li>";
                }
            }
            $('#pagination').append(pagination);
        }

        //Build dữ liệu
        function buildResult(response) {
            if ((typeof response).toLowerCase() !== "object" || response == null || !response.hasOwnProperty("data") || response.data.length === 0) return;
            var total = response.total;
            buildPanitation(total);

            var data = response.data;
            if (data.length < limit) moreResult = false;

            // if (start === 0) {//Dùng khi load thêm dữ liệu mà không làm mất dữ liệu cũ, còn dùng pagination thì phải xóa dữ liệu cũ đi
            $('#search-result tr[id]').remove();
            // }

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