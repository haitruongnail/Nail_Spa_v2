<?php
session_start();
require_once '../model/config.php';
require_once '../model/database.php';
require_once '../model/staff.php';


if(isset($_GET['date_checked'])){
    $date_pick = $_GET['date_checked'];
    $date_duration = substr($date_pick,0,2) . "-" . substr($date_pick,3,2). "-" . substr($date_pick,6,4);
    $time = strtotime($date_duration);
    $newformat = date('Y-m-d',$time);
}
if(isset($_GET['time_checked']) && $_GET['time_checked'] != ''){
    $time_pick = $_GET['time_checked'];
}else{
    $_SESSION['error'] = "Pick up time services";
    // header('location: select_date.php');
}

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

if(isset($_GET['staff_id'])){
    $staff_id = $_GET['staff_id'];
    
    $staff = new Staff();
    $addServiceToCart = $staff->addServiceToCart($staff_id);
// var_dump($_GET['staff_id']);die();
    $arr = [
        "staff_id"=> $addServiceToCart[0]['ID_staff'],
        "company_id"=> $addServiceToCart[0]['ID_company'],
        "service_id"=> $addServiceToCart[0]['ID_service'],
        "company_name"=> $addServiceToCart[0]['company_name'],
        "type_name"=> $addServiceToCart[0]['type_name'],
        "name_service"=> $addServiceToCart[0]['name_service'],
        "time_completion"=> $addServiceToCart[0]['time_completion'],
        "price"=> $addServiceToCart[0]['price'],
        "user_name"=> $addServiceToCart[0]['user_name'],
        "time_start"=> $addServiceToCart[0]['time_start'],
        "time_end"=> $addServiceToCart[0]['time_end'],
        "date_duration"=> $newformat,
        "time_duration"=> $time_pick,
    ];

    array_push($_SESSION['cart'], $arr);

    echo json_encode($_SESSION['cart']);
}
