<?php
/**
 * Created by Long
 * Date: 12/18/2018
 * Time: 5:04 PM
 */

require_once __DIR__ . "/../../db/db.php";
require_once __DIR__ . "/../../utils/echojsonmessage.php";
require_once __DIR__ . "/../../utils/uploadimage.php";

$db = db::getInstance();

if (!isset($_GET['type'])) return;

$start = (isset($_GET['start']) && is_numeric($_GET['start']) && intval($_GET['start']) >= 0) ? intval($_GET['start']) : 0;
$limit = (isset($_GET['limit']) && is_numeric($_GET['limit']) && intval($_GET['limit']) >= 0) ? intval($_GET['limit']) : 10;
$id = (isset($_GET['id']) && is_numeric($_GET['id']) && intval($_GET['id']) >= 0) ? intval($_GET['id']) : null;

header('Content-Type: application/json');

switch ($_GET['type']) {

    case "get-product-info":
        {
            if ($id == null) {
                echo_error("Mising id");
            }

            if (!$db->select_one("SELECT * FROM product WHERE id = {$id}")) {
                echo_error("Sản phẩm không tồn tại");
            } else {
                echo_success(json_encode($db->getResult()));
            }
        }
    case "edit-image":
        {
            if ($id == null) {
                echo_error("Mising id");
            }

            $upload_status = saveImage('img',   __DIR__ . '/../../public/upload/product/');
            if($upload_status['success']){

                if (!$db->select_one("SELECT * FROM product WHERE id = {$id}")) {
                    echo_error("Sản phẩm không tồn tại");
                } else {
                    if ($db->update("product", ["image" => $upload_status['new_file_name']], "id = {$id}")) {
                        echo_success($upload_status['new_file_name']);
                    } else echo_error("Không thể sửa ảnh");
                }

            } else {
                echo_error($upload_status['message']);
            }
        }
}
