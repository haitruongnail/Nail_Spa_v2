<?php
session_start();
require_once '../model/config.php';
require_once '../model/database.php';
require_once '../model/booking.php';
require_once '../model/staff.php';

$ARR_TIME = [];

if(isset($_GET['date_pick']) && isset($_GET['staff_id'])){
    $staff_id = $_GET['staff_id'];
    $date = $_GET['date_pick'];

    if(isset($_SESSION['cart'])){
        $booking = new Booking();
        $getAllBooking = $booking->getAllBooking();

        $staff = new Staff();
        $addServiceToCart = $staff->addServiceToCart($staff_id);

        $com_id = $addServiceToCart[0]['rand_id'];
        $ser_id = $addServiceToCart[0]['ID_service'];

        foreach($getAllBooking as $item){
            if($item['company_id'] == $com_id && $item['service_id'] == $ser_id && $item['staff_id'] == $staff_id && $item['date_duration'] == $date){
                array_push($ARR_TIME,$item['time_duration']);
            }
        }

        foreach($_SESSION['cart'] as $item){
            if($item['company_id'] == $com_id && $item['service_id'] == $ser_id && $item['staff_id'] == $staff_id && $item['date_duration'] == $date){
                array_push($ARR_TIME,$item['time_duration']);
            }
        }

        // Return current date from the remote server
        $curent_date = date('d-m-y');
        $curent_time = date('h:i:s');

        
        
    }
    // $newArr = array_unique($ARR_TIME,SORT_REGULAR);
    echo json_encode($ARR_TIME);
}