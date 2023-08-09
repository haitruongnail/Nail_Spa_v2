<?php
session_start();
require_once  "../../model/config.php";
require_once "../../model/database.php";
require_once  "../../model/user.php";
require_once  "../../model/booking.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

try{
    $booking = new Booking();
    $getBookingByUser = $booking->getBookingByUser($id);

    if(count($getBookingByUser) > 0){
        $_SESSION['error'] = "Please make sure this customer no longer has a reservation before deleting!";
        header('location: ../list_user.php');exit;
    }else{
        $user = new User();
        $delete = $user->delete($id);
    
        header('location: ../list_user.php');
    }
} catch(Throwable $err){
    $_SESSION['error'] = "This item cannot be deleted! Please check the information and try again!";
    header('location: ../list_user.php');
}