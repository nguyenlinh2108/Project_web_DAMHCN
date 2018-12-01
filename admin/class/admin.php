<?php
/**
 * Created by Long
 * Date: 12/1/2018
 * Time: 9:08 PM
 */
require_once __DIR__ . "/../../db/db.php";
require_once __DIR__ . "/../../config.php";

class admin
{
    public $id;
    public $email;
    public $name;
    public $avatar;

    private $db;

    /**
     * admin constructor.
     */
    public function __construct($id)
    {
        $this->id = $id;
        $this->db = db::singleton();
        if(is_numeric($this->id)){
            if($this->db->select_sql_one_row("SELECT id,avatar, name, email, created_at FROM user WHERE id = $this->id")){
                $result = $this->db->kq;
                $this->email = $result->email;
                $this->name = $result->name;
                $this->avatar = $result->avatar;
            }
        }
    }


}