<?php
session_start();
require "../vendor/autoload.php";

use Twilio\Rest\Client;
use Twilio\Exceptions\TwilioException;

require_once  "../../model/config.php";
require_once "../../model/database.php";
require_once  "../../model/company.php";
require_once  "../../model/user.php";
require_once  "../../model/booking.php";

if(isset($_GET['id'])){
    $id_book = $_GET['id'];

    $booking = new Booking();
    $getBookingById = $booking->getBookingById($id_book);

    $phoneUser = $getBookingById[0]['phone'];
    
    $twilio = new Client('AC0888e04255208c65df4b5dd5fd1cabf7', '56a5f493c8d54317eed3666a2380bcb9');
    try{
        $messFirst = $twilio->messages
        ->create(
            "$phoneUser", // to 84969747473
            [
                "body" => "Sorry we're busy at the time you request the appointment, please make another appointment or call (217)996-8787. DO NOT REPLY TO TEXT, thank you!",
                "from" => "+12179968787", //12542685884
            ]
        );

        if($messFirst){
            $_SESSION['success'] = "Send SMS message successful!";
            header("location: ../list_booking.php");exit;
        }else{
            header("location: ../404.php");
        }

    }catch(TwilioException $err){
        $_SESSION['error'] = "Error sending SMS: ".$err->getCode() . ' : ' . $err->getMessage()."\n";
        header("location: ../404.php");
    }
}else{
    header("location: ../404.php");
}
