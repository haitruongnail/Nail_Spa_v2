<?php
session_start();
require_once  "../../model/config.php";
require_once "../../model/database.php";
require_once  "../../model/company.php";

if(isset($_GET['company_id'])){
    $company_id = $_GET['company_id'];

    $company = new Company();
    $getServiceByCompany = $company->getServiceByCompany($company_id);
    echo json_encode($getServiceByCompany);
}
