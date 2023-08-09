<?php
require_once '../model/config.php';
require_once '../model/database.php';
require_once '../model/company.php';

if(isset($_GET['phone'])){
    $phone = $_GET['phone'];

    $CHECK = false;

    $company = new Company();
    $getCompanyByPhone = $company->getCompanyByPhone($phone);

    if(count($getCompanyByPhone) === 0){
        $CHECK = true;
    }

    echo json_encode($CHECK);
}