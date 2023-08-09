<?php
session_start();
require_once  "../../model/config.php";
require_once "../../model/database.php";
require_once  "../../model/user.php";


if(isset($_POST['fullname']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['description']) && isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $description = $_POST['description'];

    // var_dump($time_start);die();
    try{
        $user = new User();
        $update = $user->update($user_id, $fullname, $phone, $email, $description);

        header('location: ../list_user.php');
    } catch(Throwable $err){
        $_SESSION['error'] = "This item cannot be editted! Please check the information and try again!";
        header('location: ../list_user.php');
    }
}