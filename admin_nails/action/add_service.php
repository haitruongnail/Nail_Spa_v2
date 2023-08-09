<?php
session_start();
require_once  "../../model/config.php";
require_once "../../model/database.php";
require_once  "../../model/service.php";


$target_dir =  "../../template_nails/img/service/";
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
        header('location: ../list_service.php');exit;
    }
}


// Allow certain file formats
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    $uploadOk = 0;
    $_SESSION['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    header('location: ../list_service.php');exit;
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
        header('location: ../list_service.php');exit;
    }
}

$service = new Service();

if(isset($_POST['service_name']) && isset($_POST['price']) && isset($_POST['time_completion']) && isset($_POST['type_id']) && isset($_POST['company_name']) && isset($_POST['status'])){
    $service_name = $_POST['service_name'];
    $price = $_POST['price'];
    $time_completion = $_POST['time_completion'];
    $type_id = $_POST['type_id'];
    $company_name = $_POST['company_name'];
    $status = $_POST['status'];

    // var_dump($service_name,$image, $price,$time_completion,$type_id,$company_name,$status);die();
    try{
        $insert = $service->insert($service_name,$image, $price,$time_completion,$type_id,$company_name,$status);
        header('location: ../list_service.php');
    } catch(Throwable $err){
        $_SESSION['error'] = "This item cannot be add new! Please check the information and try again!";
        header('location: ../list_service.php');
    }
}