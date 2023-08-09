<?php
session_start();
require_once  "../../model/config.php";
require_once "../../model/database.php";
require_once  "../../model/service.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

try{
    $service = new Service();
    $delete = $service->delete($id);

    header('location: ../list_service.php');
} catch(Throwable $err){
    $_SESSION['error'] = "This item cannot be deleted! Please check the information and try again!";
    header('location: ../list_service.php');
}