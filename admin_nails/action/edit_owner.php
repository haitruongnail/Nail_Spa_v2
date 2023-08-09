<?php
session_start();
require_once  "../../model/config.php";
require_once "../../model/database.php";
require_once  "../../model/nailtype.php";
require_once  "../../model/info_owner.php";


$target_dir =  "../../template_nails/img/owner/";

$target_name_file = basename($_FILES["image"]["name"]);

if($target_name_file == ''){
    $target_name_file = $_POST['name_img_product'];
}
$target_file = $target_dir . $target_name_file;

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
        header('location: ../info_owner.php');exit;
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
    header('location: ../info_owner.php');exit;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    $_SESSION['error'] = "Sorry, your file was not uploaded.";
    header('location: ../info_owner.php');exit;
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $image = $target_name_file;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    $image = $target_name_file;
}
// var_dump($_POST['service_name']);die();

if(isset($_POST['owner_id']) && isset($_POST['company_name']) && isset($_POST['phone']) && isset($_POST['time_start']) && isset($_POST['address']) && isset($_POST['time_end'])){
    $owner_id = $_POST['owner_id'];
    $company_name = $_POST['company_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $time_start = $_POST['time_start'];
    $time_end = $_POST['time_end'];

    // var_dump($time_start);die();
    try{
        $owner = new InfoOwner();
        $update = $owner->update($owner_id, $company_name,$image,$phone, $address,$time_start,$time_end);

        header('location: ../info_owner.php');
    } catch(Throwable $err){
        $_SESSION['error'] = "This item cannot be editted! Please check the information and try again!";
        header('location: ../info_owner.php');
    }
}