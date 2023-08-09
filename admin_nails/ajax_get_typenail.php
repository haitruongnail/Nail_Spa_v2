<?php
require_once '../model/config.php';
require_once '../model/database.php';
require_once '../model/company.php';
require_once '../model/nailtype.php';

if(isset($_GET['id_company'])){
    $idCom = $_GET['id_company'];//Get id company

    $nailtype = new NailType();

    $getTypeByCompany = $nailtype->getTypeByCompany($idCom);

    echo json_encode($getTypeByCompany);
}