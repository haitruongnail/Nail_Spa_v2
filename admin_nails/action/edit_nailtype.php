<?php
session_start();
require_once  "../../model/config.php";
require_once "../../model/database.php";
require_once  "../../model/nailtype.php";


$target_dir =  "../../template_nails/img/nailtype/";

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
        header('location: ../list_nailtype.php');exit;
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
        header('location: ../list_nailtype.php');exit;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $image = $target_name_file;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    $image = $target_name_file;
}


if(isset($_POST['type_id']) && isset($_POST['type_name']) && isset($_POST['description']) && isset($_POST['status']) && isset($_POST['id_company'])){
    $type_id = $_POST['type_id'];
    $type_name = $_POST['type_name'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $id_company = $_POST['id_company'];

    try{
        $nailtype = new NailType();
        // var_dump($image);die();
        $update = $nailtype->update($type_id,$id_company ,$type_name, $image, $description,$status);
        header('location: ../list_nailtype.php');
    } catch(Throwable $err){
        $_SESSION['error'] = "This item cannot be editted! Please check the information and try again!";
        header('location: ../list_nailtype.php');
    }
}