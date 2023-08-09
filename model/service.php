<?php
require_once "database.php";

class Service extends Database{
    /**
     * Admin
     * Get all list of companies
     */
    function getAllService(){
        $sql = parent::$connection->prepare("SELECT *, services.id as ID_service, services.status as status FROM services INNER JOIN nailtype ON services.type_id = nailtype.id INNER JOIN company ON company.id = nailtype.id_company ORDER BY services.`id` DESC");
        return parent::select($sql);
    }
    /**
     * 
     */
    function insert($name, $img, $price, $time, $typeId, $company_id, $status){
        $sql = parent::$connection->prepare("INSERT INTO `services`(`name_service`, `img_service`, `price`, `time_completion`, `type_id`, `company_id`, `status`) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param('ssisiii', $name, $img, $price, $time, $typeId, $company_id, $status);
        return $sql->execute();
    }
    /**
     * 
     */
    function getServiceById($id){
        $sql = parent::$connection->prepare("SELECT *, services.id as ID_service, services.status as status FROM services INNER JOIN nailtype ON services.type_id = nailtype.id INNER JOIN company ON company.id = nailtype.id_company WHERE services.`id` = ?");
        $sql->bind_param('i', $id);
        return parent::select($sql);
    }
    /**
     * 
     */
    function getServiceByCompany($idCom){
        $sql = parent::$connection->prepare("SELECT *, services.id as ID_service, services.status as status FROM services INNER JOIN nailtype ON services.type_id = nailtype.id INNER JOIN company ON company.id = nailtype.id_company WHERE company.`id` = ?");
        $sql->bind_param('i', $idCom);
        return parent::select($sql);
    }
    /**
     * 
     */
    function update($id, $name, $img, $price, $time, $typeId, $company_id, $status){
        $sql = parent::$connection->prepare("UPDATE `services` SET `name_service`= ? ,`img_service`= ? ,`price`= ? ,`time_completion`= ? ,`type_id`= ? , `company_id` = ?, `status`= ? WHERE `id` = ?");
        $sql->bind_param('ssisiiii',$name, $img, $price, $time, $typeId, $company_id, $status, $id);
        return $sql->execute();
    }
    /**
     *  
     */
    function delete($id){
        $sql = parent::$connection->prepare("DELETE FROM `services` WHERE `id` = ?");
        $sql->bind_param('i', $id);
        return $sql->execute();
    }


}