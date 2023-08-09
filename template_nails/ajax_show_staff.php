<?php
require_once '../model/config.php';
require_once '../model/database.php';
require_once '../model/company.php';
require_once '../model/staff.php';

if(isset($_GET['company_id']) && isset($_GET['service_id'])){
    $rand_id = $_GET['company_id'];//Rand id
    $service_id = $_GET['service_id'];

    $company = new Company();
    $getCompanyByRandId = $company->getCompanyByRandId($rand_id);

    $id_com = $getCompanyByRandId[0]['id'];

    $staff = new Staff();
    $getStaffByCompanyAndService = $staff->getStaffByCompanyAndService($id_com, $service_id);

    echo json_encode($getStaffByCompanyAndService);
}