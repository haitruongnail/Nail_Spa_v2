<?php
session_start();
require_once '../model/config.php';
require_once '../model/database.php';
require_once '../model/company.php';
require_once '../model/staff.php';
require_once '../model/booking.php';

if(isset($_GET['id']) && isset($_GET['type_id'])){
    $rand_id = $_GET['id'];
    $id_ser = $_GET['type_id'];

    $company = new Company();
    $getCompanyByRandId = $company->getCompanyByRandId($rand_id);

    $id_com = $getCompanyByRandId[0]['id'];

    $ID_STAFF;
    $CHECKING_STAFF = true;

    $currentDate = new DateTime('+1 days');
    $sevenDaysFromNow = new DateTime('+7 days');//random date highest than current date no more than 7 days
    $randomDate = DateTime::createFromFormat('U', rand($currentDate->getTimestamp(), $sevenDaysFromNow->getTimestamp()));

    $staff = new Staff();
    $getStaffByCompanyAndService = $staff->getStaffByCompanyAndService($id_com,$id_ser);

    foreach($getStaffByCompanyAndService as $item){
        if(checkListBookingStaff($item['id']) === true){
            $ID_STAFF = $item['id'];
            $CHECKING_STAFF = false;
            break;
        }
    }
    if($CHECKING_STAFF === true){
        $randomValue = $getStaffByCompanyAndService[array_rand($getStaffByCompanyAndService)];
        $ID_STAFF = $randomValue['id'];
    }
    // var_dump($getStaffByCompanyAndService);die();
    
    header("location: ajax_select_date.php?id=$rand_id&staff=$ID_STAFF");

}

function checkListBookingStaff($staff_id){
    $booking = new Booking();
    $getBookingByStaff = $booking->getBookingByStaff($staff_id);

    if(count($getBookingByStaff) == 0){
        return true;
    }else{
        return false;
    }
}