<?php
require_once "database.php";

class NailType extends Database{
    /**
     * Admin
     * Get all list of companies
     */
    function getAllType(){
        $sql = parent::$connection->prepare("SELECT *,nailtype.id as id FROM nailtype inner join company on company.id = nailtype.id_company ORDER BY nailtype.`id` DESC");
        return parent::select($sql);
    }
    /**
     * 
     */
    function insert($id_company, $name, $img, $desc, $status){
        $sql = parent::$connection->prepare("INSERT INTO `nailtype`(`id_company`,`type_name`, `img_type`, `description`, `status`) VALUES (?, ?, ?, ?, ?)");
        $sql->bind_param('isssi', $id_company, $name, $img, $desc, $status);
        return $sql->execute();
    }
    /**
     * 
     */
    function getTypeById($id){
        $sql = parent::$connection->prepare("SELECT * FROM nailtype WHERE `id` = ?");
        $sql->bind_param('i', $id);
        return parent::select($sql);
    }
    /**
     * 
     */
    function update($id,$id_company, $name, $img, $desc, $status){
        $sql = parent::$connection->prepare("UPDATE `nailtype` SET `id_company` = ?, `type_name`= ? ,`img_type`= ? ,`description`= ? ,`status`= ? WHERE `id` = ?");
        $sql->bind_param('isssii',$id_company, $name, $img, $desc, $status, $id);
        return $sql->execute();
    }
    /**
     *  
     */
    function delete($id){
        $sql = parent::$connection->prepare("DELETE FROM `nailtype` WHERE `id` = ?");
        $sql->bind_param('i', $id);
        return $sql->execute();
    }
    /**
     * 
     */
    function search($com_id, $key){
        //2. Viết câu SQL
        $sql = parent::$connection->prepare("SELECT *, services.id as ID_service FROM company INNER JOIN services ON company.id = services.company_id inner join nailtype on nailtype.id = services.type_id WHERE company.`id` = ? AND nailtype.type_name LIKE ? group by nailtype.id");
        $search = "%{$key}%";
        $sql->bind_param('is',$com_id, $search);
        return parent::select($sql);
    }

        /**
     * 
     */
    function getTypeByCompany($company_id){
        $sql = parent::$connection->prepare("SELECT *,nailtype.id as id FROM nailtype inner join company on company.id = nailtype.id_company WHERE nailtype.`id_company` = ?");
        $sql->bind_param('i', $company_id);
        return parent::select($sql);
    }
}