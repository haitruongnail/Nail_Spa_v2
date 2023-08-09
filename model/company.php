<?php
require_once "database.php";

class Company extends Database{
    /**
     * Admin
     * Get all list of companies
     */
    function getAllCompany(){
        $sql = parent::$connection->prepare("SELECT * FROM company ORDER BY `id` DESC");
        return parent::select($sql);
    }
    /**
     * 
     */
    function insert($rand_id, $name, $img, $hotline, $address,$time_start,$time_end, $status, $password, $day_start, $day_end){
        $sql = parent::$connection->prepare("INSERT INTO `company`(`rand_id`, `company_name`, `img_company`, `hotline`, `address`, `time_start`, `time_end`, `status`, `password`, `day_start`, `day_end`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param('issssssisss', $rand_id, $name, $img, $hotline, $address, $time_start,$time_end, $status, $password, $day_start, $day_end);
        return $sql->execute();
    }
    /**
     * 
     */
    function getCompanyById($id){
        $sql = parent::$connection->prepare("SELECT * FROM company WHERE `id` = ?");
        $sql->bind_param('i', $id);
        return parent::select($sql);
    }
    /**
     * 
     */
    function getCompanyByRandId($rand_id){
        $sql = parent::$connection->prepare("SELECT * FROM company WHERE `rand_id` = ?");
        $sql->bind_param('i', $rand_id);
        return parent::select($sql);
    }
    /**
     * 
     */
    function update($id,$name, $img, $hotline, $address,$time_start,$time_end, $status, $password, $day_start, $day_end){
        $sql = parent::$connection->prepare("UPDATE `company` SET `company_name`= ? ,`img_company`= ? ,`hotline`= ? ,`address`= ? , `time_start` = ?, `time_end` = ?,`status`= ?, `password` = ?, `day_start` = ?, `day_end` = ? WHERE `id` = ?");
        $sql->bind_param('ssssssisssi', $name, $img, $hotline, $address,$time_start,$time_end, $status, $password, $day_start, $day_end, $id);
        return $sql->execute();
    }
    /**
     *  
     */
    function delete($id){
        $sql = parent::$connection->prepare("DELETE FROM `company` WHERE `id` = ?");
        $sql->bind_param('i', $id);
        return $sql->execute();
    }
    /**
     * 
     */
    function getServiceByCompany($company_id){
        $sql = parent::$connection->prepare("SELECT *, services.id as ID_service, services.status as status FROM company INNER JOIN services ON company.id = services.company_id inner join nailtype on nailtype.id = services.type_id WHERE company.`id` = ?");
        $sql->bind_param('i', $company_id);
        return parent::select($sql);
    }
    /**
     * Get id different
     */
    function getServiceDifferentId($company_id){
        $sql = parent::$connection->prepare("SELECT *, services.id as ID_service FROM company INNER JOIN services ON company.id = services.company_id inner join nailtype on nailtype.id = services.type_id WHERE company.`rand_id` = ? GROUP BY services.type_id ");
        $sql->bind_param('i', $company_id);
        return parent::select($sql);
    }
    // function getServiceDifferentId($company_id){
    //     $sql = parent::$connection->prepare("SELECT *, services.id as ID_service FROM company INNER JOIN services ON company.id = services.company_id inner join nailtype on nailtype.id = services.type_id WHERE company.`id` = ? GROUP BY services.type_id ");
    //     $sql->bind_param('i', $company_id);
    //     return parent::select($sql);
    // }
    /**
     * 
     */
    function getServiceByTypeAndCompany($type_id, $company_id){
        $sql = parent::$connection->prepare("SELECT *, services.id as ID_service, services.status as price_status FROM company INNER JOIN services ON company.id = services.company_id inner join nailtype on nailtype.id = services.type_id WHERE services.type_id = ? and services.company_id = ?");
        $sql->bind_param('ii', $type_id, $company_id);
        return parent::select($sql);
    }
    /**
     * 
     */
    function getCompanyByPhone($phone){
        $sql = parent::$connection->prepare("SELECT * FROM company WHERE company.`hotline` = ?");
        $sql->bind_param('s', $phone);
        return parent::select($sql);
    }
    /**
     * 
     */
    function getFullInfoCompany($phone){
        $sql = parent::$connection->prepare("SELECT * FROM company WHERE company.`hotline` = ?");
        $sql->bind_param('s', $phone);
        return parent::select($sql);
    }
    /**
     * 
     */
    function getStaffByCompanyId($company_id){
        $sql = parent::$connection->prepare("SELECT *, staff.id as staff_id FROM staff INNER JOIN services ON staff.service_id = services.id WHERE staff.`company_id` = ? GROUP by staff.code");
        $sql->bind_param('i', $company_id);
        return parent::select($sql);
    }
    /**
     * 
     */
    function getUserByCompany($company_id){
        $sql = parent::$connection->prepare("SELECT * FROM booking INNER JOIN company ON booking.company_id = company.id INNER JOIN user ON user.id = booking.user_id WHERE booking.`company_id` = ?");
        $sql->bind_param('i', $company_id);
        return parent::select($sql);
    }
}