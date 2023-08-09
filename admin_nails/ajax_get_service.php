<?php
require_once '../model/config.php';
require_once '../model/database.php';
require_once '../model/company.php';
require_once '../model/service.php';

if(isset($_GET['id_company'])){
    $idCom = $_GET['id_company'];

    $service = new Service();
    $getServiceByCompany = $service->getServiceByCompany($idCom);

    echo json_encode($getServiceByCompany);
}
