<?php
/**
 * Created by Long
 * Date: 12/18/2018
 * Time: 5:04 PM
 */

require_once __DIR__ . "/../../db/db.php";

$db = db::getInstance();

if (!isset($_GET['type'])) return;

$start = (isset($_GET['start']) && is_numeric($_GET['start']) && intval($_GET['start']) >= 0) ? intval($_GET['start']) : 0;
$limit = (isset($_GET['limit']) && is_numeric($_GET['limit']) && intval($_GET['limit']) >= 0) ? intval($_GET['limit']) : 10;
$id = (isset($_GET['id']) && is_numeric($_GET['id']) && intval($_GET['id']) >= 0) ? intval($_GET['id']) : null;

header('Content-Type: application/json');

switch ($_GET['type']) {

    case "edit-image":
        {
            if ($id == null) {
                echo_error("Mising id");
            }


            if (!empty($_FILES['img'])) {
                $file_name = $_FILES['img']['name'];
                // lấy phần mở rộng của file
                //hàm substr là cắt file
                //hàm strrpos là tìm vị trí xuất hiện cuối cùng của 1 chuỗi trong 1 chuỗi, trả về một số nguyên
                $file_type = substr($file_name, strrpos($file_name, "."));
                if (!in_array(strtolower($file_type), [".jpg", ".png", ".jpeg", ".jpe", ".gif"])) {
                    echo_error("Chỉ được upload file ảnh ($file_type)" );
                } else {
                    $new_file_name = substr($file_name, 0, strrpos($file_name, ".")) . " " . date('d_m_Y H_i_s') . $file_type;
                    $new_file = __DIR__ . '/../../public/upload/product/' . $new_file_name;

                    if (move_uploaded_file($_FILES['img']['tmp_name'], $new_file)) {

                        if (!$db->select_one("SELECT * FROM product WHERE id = {$id}")) {
                            echo_error("Sản phẩm không tồn tại");
                        } else {
                            if ($db->update("product", ["image" => $new_file_name], "id = {$id}")) {
                                echo_success($new_file_name);
                            } else echo_error("Không thể sửa ảnh");
                        }

                    } else {
                        echo_error();
                    }
                }
            } else {
                echo_error("Mising file");
            }
        }
}

function echo_message($success, $message = null)
{
    $res = ['success' => $success];
    if ($message != null) $res['message'] = $message;
    echo json_encode($res);
    exit();
}

function echo_success($message = null)
{
    echo_message(true, $message);
}

function echo_error($message = null)
{
    echo_message(false, $message);
}