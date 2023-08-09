<?php
session_start();
require_once  "../../model/config.php";
require_once "../../model/database.php";
require_once  "../../model/staff.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

try{
    $staff = new Staff();
    $delete = $staff->deleteByCode($id);

    header('location: ../list_staff.php');
} catch(Throwable $err){
    $_SESSION['error'] = "This item cannot be deleted! Please check the information and try again!";
    header('location: ../list_staff.php');
}