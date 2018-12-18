<?php
/**
 * Created by Long
 * Date: 12/18/2018
 * Time: 9:00 PM
 */

require_once __DIR__ . "/mystring.php";

/**
 * Hàm này nhận lưu ảnh được truyền lên vào thư mục $dir
 * $name: tên của name trong $_FILE
 *
 * Kết quả trả về là 1 mảng gồm
 * success: true/false: thành công hay thất bại
 * message: thông tin thêm
 * new_file_name: tên của file được lưu vào thư mục $dir nếu thành công
 */
function saveImage($name, $dir)
{
    if (!empty($_FILES[$name])) {
        $file_name = $_FILES[$name]['name'];

        // lấy phần mở rộng của file
        $file_type = substr($file_name, strrpos($file_name, "."));

        if (!in_array(strtolower($file_type), [".jpg", ".png", ".jpeg", ".jpe", ".gif"])) {
            return ['success' => false, 'message' => "Chỉ được upload file ảnh ($file_type)"];
        } else {
            $new_file_name = substr($file_name, 0, strrpos($file_name, ".")) . " " . date('d_m_Y H_i_s') . $file_type;
            $new_file_name = clean_filename($new_file_name);//clean_filename: Loại bỏ các ký tự đặt biệt khỏi tên file
            $new_file = $dir . $new_file_name;

            if (move_uploaded_file($_FILES[$name]['tmp_name'], $new_file)) {
                return ['success' => true, 'message' => "Upload thành công file $file_name", 'new_file_name' => $new_file_name];
            } else {
                return ['success' => false, 'message' => "Không thể upload file $file_name"];
            }
        }
    } else {
        return ['success' => false, 'message' => 'Bạn chưa upload file'];
    }
}