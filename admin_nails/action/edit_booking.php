<?php
session_start();
require_once  "../../model/config.php";
require_once "../../model/database.php";
require_once  "../../model/booking.php";

if(isset($_POST['company_id']) && isset($_POST['service_id']) && isset($_POST['staff_id']) && isset($_POST['date_duration']) && isset($_POST['time_duration']) && isset($_POST['user_id']) && isset($_POST['booking_id'])){
    $company_id = $_POST['company_id'];
    $service_id = $_POST['service_id'];
    $staff_id = $_POST['staff_id'];
    $date_duration = $_POST['date_duration'];
    $time_duration = $_POST['time_duration'];
    $user_id = $_POST['user_id'];
    $booking_id = $_POST['booking_id'];

    // var_dump($birth);die();
    try{
        $booking = new Booking();

        $update = $booking->update($booking_id,$company_id, $service_id,$staff_id,$date_duration,$time_duration,$user_id);
        header('location: ../list_booking.php');
    } catch(Throwable $err){
        $_SESSION['error'] = "This item cannot be editted! Please check the information and try again!";
        header('location: ../list_booking.php');
    }
}