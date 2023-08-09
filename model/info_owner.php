<?php
require_once "database.php";

class InfoOwner extends Database{
    /**
     * Admin
     * Get all list of user
     */
    function getAllInfo(){
        $sql = parent::$connection->prepare("SELECT * FROM header ORDER BY header.id DESC");
        return parent::select($sql);
    }
    /**
     * 
     */
    function getInfoById($id){
        $sql = parent::$connection->prepare("SELECT * FROM header WHERE header.`id` = ?");
        $sql->bind_param('i', $id);
        return parent::select($sql);
    }
    /**
     * 
     */
    function update($id, $company_name, $logo_company, $phone, $address, $time_start, $time_end){
        $sql = parent::$connection->prepare("UPDATE `header` SET `company_name`= ? ,`logo_company`= ? ,`phone`= ? ,`address`= ? ,`time_start`= ? ,`time_end`= ?  WHERE `id` = ?");
        $sql->bind_param('ssssssi', $company_name, $logo_company, $phone, $address, $time_start, $time_end, $id);
        return $sql->execute();
    }
}