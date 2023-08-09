<?php
session_start();
require_once  "../../model/config.php";
require_once "../../model/database.php";
require_once  "../../model/booking.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

try{
    $booking = new Booking();
    $delete = $booking->delete($id);

    $_SESSION['success'] = "Delete object successful!";
    header('location: ../list_booking.php');
} catch(Throwable $err){
    $_SESSION['error'] = "This item cannot be deleted! Please check the information and try again!";
    header('location: ../list_booking.php');
}