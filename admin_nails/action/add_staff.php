<?php
session_start();
require_once  "../../model/config.php";
require_once "../../model/database.php";
require_once  "../../model/staff.php";


$target_dir =  "../../template_nails/img/staff/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
        $_SESSION['error'] = "File is not an image.";
        header('location: ../list_staff.php');exit;
    }
}


// Allow certain file formats
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
    $_SESSION['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    header('location: ../list_staff.php');exit;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $image = basename($_FILES["image"]["name"]);
    } else {
        echo "Sorry, there was an error uploading your file.";
        $_SESSION['error'] = "Sorry, there was an error uploading your file.";
        header('location: ../list_staff.php');exit;
    }
}

$staff = new Staff();

if(isset($_POST['staff_name']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['birth']) && isset($_POST['gender']) && isset($_POST['address']) && isset($_POST['company_id']) && isset($_POST['listid_service'])){
    $staff_name = $_POST['staff_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $birth = $_POST['birth'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $company_id = $_POST['company_id'];
    $service_id = $_POST['listid_service'];

    $listSer = explode(',', $service_id);

    $code = rand(111111,999999);
    while(count($staff->checkCodeStaff($code)) > 0){
        $code = rand(111111,999999);
    }

    try{
        foreach($listSer as $item){
            $insert = $staff->insert($code,$staff_name,$image, $phone,$email,$address,$birth,$gender,$company_id,$item);
        }
        header('location: ../list_staff.php');
    } catch(Throwable $err){
        $_SESSION['error'] = "This item cannot be add new! Please check the information and try again!";
        header('location: ../list_staff.php');
    }
}