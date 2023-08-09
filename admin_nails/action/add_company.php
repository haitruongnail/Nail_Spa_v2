<?php
session_start();
require_once  "../../model/config.php";
require_once "../../model/database.php";
require_once  "../../model/company.php";


$target_dir =  "../../template_nails/img/company/";
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
        header('location: ../list_company.php');exit;
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
    header('location: ../list_company.php');exit;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    $_SESSION['error'] = "Sorry, your file was not uploaded.";
    header('location: ../list_company.php');exit;
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $image = basename($_FILES["image"]["name"]);
    } else {
        echo "Sorry, there was an error uploading your file.";
        $_SESSION['error'] = "Sorry, there was an error uploading your file.";
        header('location: ../list_company.php');exit;
    }
}

$company = new Company();
if(isset($_POST['time_start'])){
    $timestart = $_POST['time_start'];
}
if(isset($_POST['time_end'])){
    $timeend = $_POST['time_end'];
}

if(isset($_POST['company_name']) && isset($_POST['hotline']) && isset($_POST['address']) && isset($_POST['status']) && isset($_POST['password']) && isset($_POST['day_start']) && isset($_POST['day_end'])){
    $company_name = $_POST['company_name'];
    $hotline = $_POST['hotline'];
    $address = $_POST['address'];
    $status = $_POST['status'];
    $password = $_POST['password'];

    $day_start = $_POST['day_start'];
    $day_end = $_POST['day_end'];

    $rand_id = rand(1111,9999);

    $getCompanyByRandId = $company->getCompanyByRandId($rand_id);

    while(count($getCompanyByRandId) > 0){
        $rand_id = rand(1111,9999);
    }

    try{
        $insert = $company->insert($rand_id,$company_name,$image, $hotline, $address, $timestart, $timeend,$status,$password, $day_start, $day_end);
        header('location: ../list_company.php');
    } catch(Throwable $err){
        $_SESSION['error'] = "This item cannot be add new! Please check the information and try again!";
        header('location: ../list_company.php');
    }

}