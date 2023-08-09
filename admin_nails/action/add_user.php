<?php
session_start();
require_once  "../../model/config.php";
require_once "../../model/database.php";
require_once  "../../model/user.php";


$user = new User();

if(isset($_POST['fullname']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['description'])){
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $description = $_POST['description'];
    $ip_user = 'null';

    // var_dump($birth);die();
    try{
        $insert = $user->insert($fullname, $phone,$email,$description,$ip_user);
        header('location: ../list_user.php');
    } catch(Throwable $err){
        $_SESSION['error'] = "This item cannot be add new! Please check the information and try again!";
        header('location: ../list_user.php');
    }
}