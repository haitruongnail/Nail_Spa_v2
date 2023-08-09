<?php
session_start();
require_once  "../../model/config.php";
require_once "../../model/database.php";
require_once  "../../model/booking.php";
require_once  "../../model/user.php";

if(isset($_POST['array_items']) && isset($_POST['option_spam'])){
    $array_items = $_POST['array_items'];
    $option_spam = $_POST['option_spam'];

    $booking = new Booking();
    $getAllBooking = $booking->getAllBooking();

    $users = new User();

    if($option_spam == "delete_all"){
        $arr_user = [];//array id user impossible delete in booking list
        $user_main = [];//array id user used to delete in users table
    
        foreach ($getAllBooking as $item){
            if(checkTime($item) == 'normal' || checkTime($item) == 'remind'){
                array_push($arr_user, $item['user_id']);
            }
            
        }
        foreach ($getAllBooking as $item){
    
            if(checkTime($item) == 'last'){
                if(count($arr_user) == 0){
                    $delete = $booking->delete($item['booking_id']);
                    array_push($user_main,$item['user_id']);
                }else{
                    for ($i=0; $i < count($arr_user); $i++) { 
                        if($item['user_id'] != $arr_user[$i]){
                            array_push($user_main,$item['user_id']);
                            $delete = $booking->delete($item['booking_id']);
                        }
                    }
                }
            }
        }
        // Convert the array to a string
        $string = implode(',', $user_main);
    
        // Remove duplicates from the string
        $unique_string = array_unique(explode(',', $string));
    
        // Sort the array in ascending order
        sort($unique_string);
    
        //Delete user have id equal with id of element in unique_string
        for ($i=0; $i < count($unique_string); $i++) {
            $delete = $users->delete($unique_string[$i]);
            // var_dump($unique_string[$i]);
        }
        $_SESSION['success'] = "Deleted all overdue bookings and respective users!";
        header("location: ../list_booking.php");exit;
    }else{
        $array = explode(",", $array_items);
        for ($i=0; $i < count($array); $i++) { 
            $delete = $booking->delete($array[$i]);
        }

        $_SESSION['success'] = "Successfully deleted selected object!";
        header("location: ../list_booking.php");exit;
    }
}

function checkTime($item){
    $hour_start = substr($item['time_duration'],0,2);

    $minute_start = substr($item['time_duration'],3,2);

    $period_start = $hour_start  >= 12 ? 'PM' : 'AM';
    $hour_start = $hour_start > 12 ? $hour_start - 12 : $hour_start;
    $hour_start = $hour_start < 10 && strlen($hour_start) < 2 ? '0'.$hour_start : $hour_start;

    $last_time_start = $hour_start . ':' . $minute_start . '' . $period_start;

    $checkRemind = 'normal';//Check date and time of service compare to current date

    // Set the timezone to NewYork
    date_default_timezone_set('america/new_york');
    $today = date("Y-m-d");
    $current_time = date("H:i:s");
    
    if($today == $item['date_duration'] && $current_time < $item['time_duration']){
        $checkRemind = 'remind';
    }
    if($today > $item['date_duration']){
        $checkRemind = 'last';
    }
    if($today == $item['date_duration'] && $current_time >= $item['time_duration']){
        $checkRemind = 'last';
    }

    return $checkRemind;
}