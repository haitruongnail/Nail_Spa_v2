<?php
session_start();
require_once '../model/config.php';
require_once '../model/database.php';
require_once '../model/staff.php';


if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

if(isset($_GET['staff_id']) && isset($_GET['company_id']) && isset($_GET['service_id']) && isset($_GET['date_duration']) && isset($_GET['time_duration'])){
    $staff_id = $_GET['staff_id'];
    $company_id = $_GET['company_id'];
    $service_id = $_GET['service_id'];
    $date_duration = $_GET['date_duration'];
    $time_duration = $_GET['time_duration'];
    
    for ($i=0; $i < count($_SESSION['cart']); $i++) { 
        if($_SESSION['cart'][$i]['staff_id'] == $staff_id && $_SESSION['cart'][$i]['company_id'] == $company_id && $_SESSION['cart'][$i]['service_id'] == $service_id && $_SESSION['cart'][$i]['date_duration'] == $date_duration && $_SESSION['cart'][$i]['time_duration'] == $time_duration){
            array_splice($_SESSION['cart'], $i, 1);
        }
    }
    
    echo json_encode($_SESSION['cart']);

}