<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/1/2018
 * Time: 9:08 PM
 */
require_once __DIR__ . "/../../db/db.php";
require_once __DIR__ . "/../../config.php";

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
                $this->avatar = $result->avatar;
                $this->phone = $result->phone;
                $this->address = $result->address;
                $this->level = $result->level;
            }
        }
    }


}