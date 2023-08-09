<?php
session_start();
require_once  "../../model/config.php";
require_once "../../model/database.php";
require_once  "../../model/staff.php";
require_once  "../../model/service.php";


$target_dir =  "../../template_nails/img/staff/";

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
    $_SESSION['error'] = "Sorry, your file was not uploaded.";
    header('location: ../list_staff.php');exit;
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $image = $target_name_file;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    $image = $target_name_file;
}

// var_dump($_POST['birth']);die();

if(isset($_POST['staff_id']) && isset($_POST['staff_name']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['birth']) && isset($_POST['gender']) && isset($_POST['address']) && isset($_POST['company_id']) && isset($_POST['listid_service'])){
    $staff_id = $_POST['staff_id'];
    $staff_name = $_POST['staff_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $birth = $_POST['birth'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $company_id = $_POST['company_id'];
    $service_id = $_POST['listid_service'];

    $listSer = explode(',', $service_id);

    $staff = new Staff();
    $getStaffById = $staff->getStaffById($staff_id);

    $codeStaff = $getStaffById[0]['code'];

    $getStaffByCode = $staff->getStaffByCode($codeStaff);
    
    // var_dump($listSer);die();
    try{
        foreach($getStaffByCode as $item){
            $delete = $staff->delete($item['ID_staff']);
        }

        foreach($listSer as $idSer){
            $insert = $staff->insert($codeStaff,$staff_name,$image, $phone,$email,$address,$birth,$gender,$company_id,$idSer);
        }
        // $update = $staff->update($staff_id,$staff_name,$image, $phone,$email,$address,$birth,$gender,$company_id,$service_id);

        header('location: ../list_staff.php');
    } catch(Throwable $err){
        $_SESSION['error'] = "This item cannot be editted! Please check the information and try again!";
        header('location: ../list_staff.php');
    }
}