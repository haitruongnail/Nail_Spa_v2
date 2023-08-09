<?php
require_once "database.php";

class User extends Database{
    /**
     * Admin
     * Get all list of user
     */
    function getAllUser(){
        $sql = parent::$connection->prepare("SELECT * FROM user ORDER BY user.id DESC");
        return parent::select($sql);
    }
    /**
     * 
     */
    function insert($fullname, $phone, $email, $desc,$ip_user){
        $sql = parent::$connection->prepare("INSERT INTO `user`(`fullname`, `phone`, `email`, `description`,`ip_user`) VALUES (?, ?, ?, ?, ?)");
        $sql->bind_param('sssss', $fullname, $phone, $email, $desc,$ip_user);
        if($sql->execute() === true){
            return self::$connection->insert_id;
        }
    }
    /**
     * 
     */
    function getUserById($id){
        $sql = parent::$connection->prepare("SELECT * FROM user WHERE user.`id` = ?");
        $sql->bind_param('i', $id);
        return parent::select($sql);
    }
    /**
     * 
     */
    function update($id, $fullname, $phone, $email, $desc){
        $sql = parent::$connection->prepare("UPDATE `user` SET `fullname`= ? ,`phone`= ? ,`email`= ? ,`description`= ?   WHERE `id` = ?");
        $sql->bind_param('ssssi',$fullname, $phone, $email, $desc, $id);
        return $sql->execute();
    }
    /**
     *  
     */
    function delete($id){
        $sql = parent::$connection->prepare("DELETE FROM `user` WHERE `id` = ?");
        $sql->bind_param('i', $id);
        return $sql->execute();
    }
    /**
     * 
     */
    function getUserByPhone($phone){
        $sql = parent::$connection->prepare("SELECT * FROM user WHERE user.`phone` = ?");
        $sql->bind_param('s', $phone);
        return parent::select($sql);
    }
}