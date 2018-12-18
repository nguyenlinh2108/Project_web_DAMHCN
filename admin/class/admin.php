<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/1/2018
 * Time: 9:08 PM
 */
require_once __DIR__ . "/../../db/db.php";
require_once __DIR__ . "/../../config.php";
require_once __DIR__ . "/../../utils/mystring.php";

class admin
{
    public $id;
    public $name;
    public $email;
    public $gender;
    public $avatar;
    public $phone;
    public $address;
    public $level;

    private $db;

    /**
     * admin constructor.
     */
    public function __construct($id)
    {
        $this->id = $id;
        $this->db = db::getInstance();
        if(is_numeric($this->id)){
            if($this->db->select_one("SELECT id, name, email, gender, avatar, phone, address, level, created_at 
                                      FROM user WHERE id = $this->id")){
                $result = $this->db->getResult();
                $this->name = $result->name;
                $this->email = $result->email;
                $this->gender = $result->gender;
                $this->setAvatar($result->avatar, $result->gender);
                $this->phone = $result->phone;
                $this->address = $result->address;
                $this->level = $result->level;
            }
        }
    }

    /**
     * @param mixed $avatar
     */
    public function setAvatar($avatar, $gender)
    {
        if (strlen($avatar) > 3) {
            if (!startsWith($avatar, "http")) $avatar = "/public/upload/users/" . $avatar;
        } else {
            $avatar = "/public/upload/users/default/" . (($gender === "Nữ") ? "avatar_female.jpg" : "avatar_male.jpg");
        }

        $this->avatar = $avatar;
    }


}