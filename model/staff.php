<?php
require_once "database.php";

class Staff extends Database{
    /**
     * Admin
     * Get all list of companies
     */
    function getAllStaff(){
        $sql = parent::$connection->prepare("SELECT *, staff.id as staff_id FROM staff INNER JOIN company ON staff.company_id = company.id INNER JOIN services ON services.id = staff.service_id GROUP by staff.code");
        return parent::select($sql);
    }
    /**
     * 
     */
    function insert($code,$username, $avatar, $phone, $email, $address, $birth, $gender, $company_id, $service_id){
        $sql = parent::$connection->prepare("INSERT INTO `staff`(`code`,`user_name`, `avatar`, `phone`, `email`, `address`, `birth`, `gender`, `company_id`, `service_id`, `create_at`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, current_date)");
        $sql->bind_param('isssssssii', $code, $username, $avatar, $phone, $email, $address, $birth, $gender, $company_id, $service_id);
        return $sql->execute();
    }
    /**
     * 
     */
    function getStaffById($id){
        $sql = parent::$connection->prepare("SELECT *, staff.id as staff_id, services.id as service_id FROM staff INNER JOIN services ON services.id = staff.service_id inner join nailtype on nailtype.id = services.type_id inner join company on company.id = nailtype.id_company  WHERE staff.`id` = ?");
        $sql->bind_param('i', $id);
        return parent::select($sql);
    }
    /**
     * 
     */
    function checkCodeStaff($code){
        $sql = parent::$connection->prepare("SELECT * FROM staff  WHERE staff.`code` = ?");
        $sql->bind_param('i', $code);
        return parent::select($sql);
    }
    /**
     * 
     */
    function getStaffByCode($code){
        $sql = parent::$connection->prepare("SELECT *,staff.id as ID_staff FROM staff inner join services on services.id = staff.service_id WHERE staff.`code` = ?");
        $sql->bind_param('i', $code);
        return parent::select($sql);
    }
    /**
     * 
     */
    function update($id, $username, $avatar, $phone, $email, $address, $birth, $gender, $company_id, $service_id){
        $sql = parent::$connection->prepare("UPDATE `staff` SET `user_name`= ? ,`avatar`= ? ,`phone`= ? ,`email`= ? ,`address`= ? ,`birth`= ? ,`gender`= ?,`company_id` = ?, `service_id`=?  WHERE `id` = ?");
        $sql->bind_param('sssssssiii',$username, $avatar, $phone, $email, $address, $birth, $gender, $company_id, $service_id, $id);
        return $sql->execute();
    }
    /**
     *  
     */
    function delete($id){
        $sql = parent::$connection->prepare("DELETE FROM `staff` WHERE `id` = ?");
        $sql->bind_param('i', $id);
        return $sql->execute();
    }
    /**
     *  
     */
    function deleteByCode($code){
        $sql = parent::$connection->prepare("DELETE FROM `staff` WHERE `code` = ?");
        $sql->bind_param('i', $code);
        return $sql->execute();
    }
    /**
     * Get staff by id company and id service
     */
    function getStaffByCompanyAndService($company_id, $service_id){
        $sql = parent::$connection->prepare("SELECT * FROM staff WHERE staff.company_id = ? and staff.service_id = ?");
        $sql->bind_param('ii', $company_id, $service_id);
        return parent::select($sql);
    }
    /**
     * function add serive in cart for user
     */
    function addServiceToCart($staff_id){
        $sql = parent::$connection->prepare("SELECT *, staff.id as ID_staff, company.id as ID_company, services.id as ID_service, services.status as price_status FROM staff INNER JOIN company ON staff.company_id = company.id INNER JOIN services ON staff.service_id = services.id INNER JOIN nailtype ON nailtype.id = services.type_id WHERE staff.id = ?");
        $sql->bind_param('i', $staff_id);
        return parent::select($sql);
    }
}