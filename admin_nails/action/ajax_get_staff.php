<?php
session_start();
require_once  "../../model/config.php";
require_once "../../model/database.php";
require_once  "../../model/booking.php";

if(isset($_GET['id_service'])){
    $id_service = $_GET['id_service'];

    $booking = new Booking();
    $getInfoByCompany = $booking->getInfoByCompany($id_service);
    
    echo json_encode($getInfoByCompany);
}
