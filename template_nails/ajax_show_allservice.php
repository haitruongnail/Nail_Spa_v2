<?php
require_once '../model/config.php';
require_once '../model/database.php';
require_once '../model/company.php';
require_once '../model/service.php';

if(isset($_GET['type_id']) && isset($_GET['company_id'])){
    $type_id = $_GET['type_id'];
    $company_id = $_GET['company_id'];

    $company = new Company();
    $getServiceByTypeAndCompany = $company->getServiceByTypeAndCompany($type_id,$company_id);

    echo json_encode($getServiceByTypeAndCompany);
}