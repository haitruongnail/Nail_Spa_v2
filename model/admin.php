<?php
require_once "database.php";

class Admin extends Database{
    /**
     * Login for Admin
     */
    function login($email, $password){
        $sql = parent::$connection->prepare("SELECT * FROM admin WHERE `admin`.`email` = ? AND `admin`.`password` = ?");
        $sql->bind_param('ss', $email, $password);
        return parent::select($sql);
    }
    /**
     * Login for owner company
     */
    function loginOwner($phone, $password){
        $sql = parent::$connection->prepare("SELECT * FROM company WHERE `company`.`hotline` = ? AND `company`.`password` = ?");
        $sql->bind_param('ss', $phone, $password);
        return parent::select($sql);
    }
}