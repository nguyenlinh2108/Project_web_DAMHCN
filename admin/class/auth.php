<?php
/**
 * Created by PhpStorm.
 * User: linh nguyễn
 * Date: 12/1/2018
 * Time: 9:08 PM
 */
require_once __DIR__ . "/../../db/db.php";
require_once __DIR__ . "/../../config.php";

class auth
{
    public $id;
    public $email;
    public $name;
    public $password;
    public $avatar;

    private $db;

    public static function getMD5Password($password)
    {
        return md5($password . ADMIN_SALT_PASSWORD);
    }

    /**
     * admin constructor.
     * @param $email
     * @param $password
     */
    public function __construct($email, $password = null)
    {
        $this->email = $email;
        $this->password = $password;
        $this->db = db::getInstance();
    }

    public function save()
    {
        if ($this->email === null || strlen($this->email) < 4) return false;

        if ($this->password === null || strlen($this->password) < 4) return false;
        return $this->db->inodate("user",
            ["email" => $this->email, "password" => self::getMD5Password($this->password), "avatar" => $this->avatar],
            "email = '" . db::validSql($this->email) . "''");
    }

    public function login()
    {
        if ($this->email === null || strlen($this->email) < 4) return false;

        $sql = "SELECT * FROM user WHERE email like '" . db::validSql($this->email) . "'";
        if (!$this->db->select_one($sql)) return false;
        $result = $this->db->getResult();

        $this->id = $result->id;
        $this->email = $result->email;
        $this->name = $result->name;
        $this->avatar = $result->avatar;
        return true;
    }


}