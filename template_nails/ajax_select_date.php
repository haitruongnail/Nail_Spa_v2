<?php
session_start();
require_once '../model/config.php';
require_once '../model/database.php';
require_once '../model/staff.php';


if(isset($_GET['id']) && isset($_GET['staff'])){
    $company_id = $_GET['id'];
    $staff_id = $_GET['staff'];

    header("location: select_date.php?id=$company_id&staff_id=$staff_id");
}