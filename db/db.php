<?php
/**
 * Created by Long
 * Date: 12/1/2018
 * Time: 9:06 PM
 */
require_once __DIR__ . "/../config.php";

class db
{
    public $_dbh = '';
    public $_cursor = NULL;
    private $kq;//Lưu trữ dữ liệu sau khi select

    //Trả về dữ liệu select được
    public function getResult()
    {
        return $this->kq;
    }

    //Hàm khởi tạo
    private function __construct()
    {
    //echo "Create new database\n";debug
        $this->_dbh = new PDO('mysql:dbname=' . $GLOBALS['CONFIG_DATABASE']['SCHEMA'] . ';host=' . $GLOBALS['CONFIG_DATABASE']['HOST'], $GLOBALS['CONFIG_DATABASE']['USERNAME'], $GLOBALS['CONFIG_DATABASE']['PASSWORD']);
        $this->_dbh->query('set names "utf8"');
    }

    // Hold an instance of the class
    private static $instance;

    /**
     * The singleton method
     *
     * Cách sử dụng
     * $db = db::getInstance();
     *
     * @return db
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new db();
        }
        return self::$instance;
    }


    /**
     * Thực thi 1 câu truy vẫn có trả về dữ liệu(select)
     * @param $sql: câu truy vấn
     * @return bool|null|PDOStatement
     */
    private function executeQuery($sql)
    {
        $this->_cursor = $this->_dbh->prepare($sql);
        $this->_cursor->execute();
        return $this->_cursor;
    }


    /**
     * Thực thi 1 câu truy vẫn không trả về dữ liệu(update,delete,insert...)
     *
     * @param $sql
     * @return bool
     */
    public function execute($sql)
    {
        try {
            $this->_cursor = $this->_dbh->prepare($sql);
            $bo = $this->_cursor->execute();
            return $bo;
        } catch (Exception $ex) {
            return false;
        }

    }

    /**
     * Thực thi câu truy vấn select
     *
     * @param $sql
     * @return bool
     *
     * Cách sử dụng
     *
     * if($db->select("SELECT id, name FROM anime WHERE name like 'Kill me baby'")){
     *     for($db->getResult() as $anime) {
     *         echo "Id: $anime->id\n";
     *         echo "Name: $anime->name";
     *     }
     * } else echo "Error or empty data";
     */
    public function select($sql)
    {
        if (!$result = $this->executeQuery($sql)) return false;
        $array = $result->fetchAll(PDO::FETCH_OBJ);
        if (is_array($array) && count($array) > 0) {
            $this->kq = $array;
            return true;
        } else return false;
    }

    /**
     * Tương tự hàm select nhưng chỉ load ra 1 bản ghi
     *
     * @param $sql
     * @return bool
     */
    public function select_one($sql)
    {
        if (!$result = $this->executeQuery($sql)) return false;
        $array = $result->fetch(PDO::FETCH_OBJ);
        if ($array != null) {
            $this->kq = $array;
            return true;
        } else return false;
    }


    /**
     * Hàm này dùng để insert 1 bản ghi vào database
     *
     * Ví dụ:
     * if($db->insert("anime", array("id" => 5, "name" => "Dragon Ball"))){
     *     echo "Success";
     * } else echo "Fail";
     *
     *
     * @param $table: bảng muốn insert dữ liệu
     * @param $cols: dữ liệu insert vào, là 1 mảng, có cấu trúc
     * [
     *     {tên cột 1} => {giá trị cột 1},
     *     {tên cột 3} => {giá trị cột 2},
     *     {tên cột 3} => {giá trị cột 3},
     *     ...
     * ]
     * @return bool
     */
    public function insert($table, $cols)
    { //Truy vấn insert
        if (!is_array($cols)) {
            return false;
        }
        $totalColumn = count($cols);
        if ($totalColumn == 0) {
            return false;
        }

        $str_colName = "";//Tên các cột
        $str_colValue = "";//Giá trị các cột
        $colNames = array_keys($cols);
        for ($i = 0; $i < $totalColumn; $i++) {
            $colName = $colNames[$i];
            $colValue = $cols[$colName];
            if ($colName != null && $colValue != null) {
                $str_colValue .= "\"" . db::validSql($colValue) . "\"";
                $str_colName .= trim($colName);
                if ($i < $totalColumn - 1) {
                    $str_colName .= ", ";
                    $str_colValue .= ", ";
                }
            }
        }
        $str_colValue = trim($str_colValue);
        $str_colName = trim($str_colName);

        while (substr($str_colName, strlen($str_colName) - 1) == ",") {
            $str_colName = trim(substr($str_colName, 0, strlen($str_colName) - 1));
        }
        while (substr($str_colValue, strlen($str_colValue) - 1) == ",") {
            $str_colValue = trim(substr($str_colValue, 0, strlen($str_colValue) - 1));
        }
        while (substr($str_colName, 0, 1) == ",") {
            $str_colName = trim(substr($str_colName, 1));
        }
        while (substr($str_colValue, 0, 1) == ",") {
            $str_colValue = trim(substr($str_colValue, 1));
        }

        $sql = "INSERT INTO " . $table . "(" . $str_colName . ")" . " VALUES " . "(" . $str_colValue . ");";

        return $this->execute($sql);//Thực thi câu lệnh insert
    }

    /**
     * Hàm này dùng để cập nhật dữ liệu của 1 bản ghi đã tồn tại trong csdl
     *
     * Ví dụ:
     * Bên trên ở hàm insert ta đã thêm 1 bản ghi có id = 5, name là Dragon Ball,
     * giờ ta muốn đỗi tên thành Dragon Boy
     *
     * if($db->update("anime", array("name" => "Dragon Boy"), "id = 5")){
     *     echo "Success";
     * } else echo "Fail";
     *
     * @param $table: bảng muốn cập nhật
     * @param $cols: giá trị cập nhật, tương tự như tham số #cols ở hàm insert bên trên
     * @param $condition: điều kiện để cập nhật bản ghi
     * @return bool
     */
    public function update($table, $cols, $condition)
    {
        if (!is_array($cols)) {
//        echo "$cols is not array";
            return false;
        }
        $totalColumn = count($cols);
        if ($totalColumn == 0) {
//            echo "Number of column == 0";
            return false;
        }


        $set = "";
        $colNames = array_keys($cols);
        for ($i = 0; $i < $totalColumn; $i++) {
            $colName = $colNames[$i];
            $colValue = $cols[$colName];

            if ($colName != null && $colValue != null) {
                $set .= $colName . " = \"" . db::validSql($colValue) . "\"";
                if ($i < $totalColumn - 1) {
                    $set .= ", ";
                }
            }
        }
        //Loại bỏ các dấu , thừa trong set
        $set = trim($set);
        while (substr($set, strlen($set) - 1) == ",") {
            $set = trim(substr($set, 0, strlen($set) - 1));
        }
        while (substr($set, 0, 1) == ",") {
            $set = trim(substr($set, 1));
        }

        if ($condition == null || trim($condition) == "") {
            $condition = "1";
        }
        $sql = "UPDATE " . $table . " SET " . $set . " WHERE " . $condition;

        return $this->execute($sql);//Thực thi câu lệnh update
    }

    /**
     * Hàm này là sự kết hợp giữa insert và update
     * Nếu điều kiện $condition thỏa mãn, nghĩa là đã có 1 bản ghi tồn tại trong csdl
     * thì hàm sẽ cập nhật giá trị cho bản ghi đó nếu có sự khác biệt giữa dữ liệu trong csdl và sữ liệu input đầu vào
     * Còn nếu chưa có bản ghi nào thì hàm sẽ insert 1 bản ghi mới vào
     *
     * Ví dụ:
     *
     * Giả sử ta chưa có bản ghi nào vói id = 5
     * thực hiện
     * if($db->inodate("anime", array("id" => 5, "name" => "Dragon Boy"), "id = 5")){
     *     echo "Success";
     * } else echo "Fail";
     * sẽ insert 1 bản ghi với id = 5, name là Dragon Boy
     *
     * Còn nếu đã có bản ghi có id là 5 trong csdl thì sẽ cập nhật lại giá trị id và name nếu có sự khác biệt
     * (cụ thể: nếu id trong csdl khác 5 và name trong csdl khác Dragon Boy)
     *
     * @param $table
     * @param $cols: tương tự ở hàm insert hay update
     * @param $condition: điều kiện để xác định bản ghi
     * @return bool
     */
    public function inodate($table, $cols, $condition)
    {
        if (!is_array($cols)) {
//        echo "$cols is not array";
            return false;
        }
        $totalColumn = count($cols);
        if ($totalColumn == 0) {
//            echo "Number of column == 0";
            return false;
        }
        $colNames = array_keys($cols);
        $str_colName = implode(", ", $colNames);//Tên các cột

        //Loại bỏ các dấu , thừa trong set
        $str_colName = trim($str_colName);
        while (substr($str_colName, strlen($str_colName) - 1) == ",") {
            $str_colName = trim(substr($str_colName, 0, strlen($str_colName) - 1));
        }
        while (substr($str_colName, 0, 1) == ",") {
            $str_colName = trim(substr($str_colName, 1));
        }

        if ($this->select($str_colName, $table, $condition)) {
            $kq = (array)$this->kq[0];
            $update_array = array();
            for ($i = 0; $i < $totalColumn; $i++) {
                $colName = $colNames[$i];
                $colValueDB = trim($kq[$colName]);
                $colValueUpdate = trim($cols[$colName]);
                if (($colValueDB == null && $colValueUpdate != null) || $colValueUpdate != $colValueDB) {
                    $update_array[$colName] = $colValueUpdate;
                }
            }
            if (count($update_array) > 0) {
//            echo "Update to database\n";
                return $this->update($table, $update_array, $condition);
            } else {
//            echo "Nothing to update\n";
                return true;
            }

        } else {
            return $this->insert($table, $cols);
        }
    }


    /**
     * Chuẩn hóa các giá trị input đầu vào (bắt buộc phải validate các giá trị đầu vào nếu là string)
     *
     * Ví dụ:
     * $a = "con_ga'_con"
     * $b = db::validSql($a);
     * => $b = con_ga\'_con
     *
     * @param $value
     * @return mixed|null
     */
    public static function validSql($value)
    {
        if ($value == null) {
            return null;
        }
        //Các câu lệnh sau phải đúng thứ tự
        $value = str_replace("\\", "\\\\", $value);
        $value = str_replace("\"", "\\\"", $value);
        $value = str_replace("\'", "\\\'", $value);
        $value = str_replace("'", "\'", $value);
        return $value;
    }


    /**
     * Hủy bỏ kết nối (không cần thiết)
     */
    public function disconnect()
    {
        $this->_dbh = NULL;
    }

}