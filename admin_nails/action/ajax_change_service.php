<?php
session_start();
require_once  "../../model/config.php";
require_once "../../model/database.php";
require_once  "../../model/booking.php";

if(isset($_GET['service_id'])){
    $service_id = $_GET['service_id'];

    $booking = new Booking();
    $getInfoByService = $booking->getInfoByService($service_id);
    echo json_encode($getInfoByService);
}
