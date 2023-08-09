<?php
session_start();
require_once '../model/config.php';
require_once '../model/database.php';
require_once '../model/info_owner.php';
require_once '../model/company.php';


if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 180)) {
    // request 5 seconds ago
    session_destroy();
    session_unset();
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time

if(isset($_GET['id'])){
    $ID_COM = $_GET['id'];

    $company = new Company();
    $getAllInfo = $company->getCompanyByRandId($ID_COM);
    // $getAllInfo = $company->getCompanyById($ID_COM);
}else{
    $company = new Company();
    $getAllCompany = $company->getAllCompany();
    $ID_COM = $getAllCompany[0]['rand_id'];
    $getAllInfo = $company->getCompanyByRandId($ID_COM);
    // $getAllInfo = $company->getCompanyById($ID_COM);
}
if( $getAllInfo[0]['day_start'] != '' && $getAllInfo[0]['day_end'] != ''){
    $day_work = $getAllInfo[0]['day_start'] . ' - ' . $getAllInfo[0]['day_end']; 
}else{
    $day_work = "Not update";
}

$time_start = $getAllInfo[0]['time_start']; // example 24-hour time

$time_end = $getAllInfo[0]['time_end']; // example 24-hour time

$hour_start = substr($time_start,0,2);
$hour_end = substr($time_end,0,2);

$minute_start = substr($time_start,3,2);
$minute_end = substr($time_end,3,2);

$period_start = $hour_start  >= 12 ? 'PM' : 'AM';
$hour_start = $hour_start > 12 ? $hour_start - 12 : $hour_start;

$period_end = $hour_end  >= 12 ? 'PM' : 'AM';
$hour_end = $hour_end > 12 ? $hour_end - 12 : $hour_end;
$hour_end = $hour_end < 10 ? '0'.$hour_end : $hour_end;

$last_time_start = $hour_start . ':' . $minute_start . '' . $period_start;
$last_time_end = $hour_end . ':' . $minute_end . '' . $period_end;

//Map location company
$address = 'Any Street, Any City' ; /* Insert address Here */
$address = $getAllInfo[0]['address'] ; /* Insert address Here */
// $address = "79/71/6d Âu Cơ, phường 14, quận 11, thành phố Hồ Chí Minh" ; /* Insert address Here */
// $address = "thôn Hoài Nhơn, xã Phước Hậu, huyện Ninh Phước, tỉnh Ninh Thuận" ; /* Insert address Here */
// $ip_address = $_SERVER['REMOTE_ADDR'];
// echo "Your IP address is: ". $ip_address;
//domain = https://minbooking.keri.vn/

?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8" />
    <meta name="description" content="Sona Template" />
    <meta name="keywords" content="Sona, unica, creative, html" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="shortcut icon" href="./img/undraw_rocket.svg" type="image/x-icon">
    <title>Nail Spa</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;1,300;1,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./css/mobiscroll.javascript.min.css">
    <!-- Css Styles -->
    <link rel="stylesheet" href="css/mdb.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css" />
    <link rel="stylesheet" href="css/flaticon.css" type="text/css" />
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css" />
    <link rel="stylesheet" href="css/nice-select.css" type="text/css" />
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css" />
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css" />
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css" />

    <link rel="stylesheet" href="css/style.css" type="text/css" />

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- <div class="setting-color">
        <div class="group">
            <div class="icon-setting">
                <i class='bx bxs-cog'></i>
            </div>
            <div class="group-color">
                <ul>
                    <li>
                        <button data-color="radial-gradient(45.21% 19.8% at 52.09% 54.51%, #67bfeb 0%, #b2fbfb 100%)" data-button="rgba(0, 132, 188, 0.7)" style="--color: #0084bc;"></button>
                    </li>
                    <li>
                        <button data-color="linear-gradient(90deg, rgba(255,166,158,1) 0%, rgba(233,239,156,0.9809173669467787) 57%)" data-button="#C38154" style="--color: #C38154"></button>
                    </li>
                    <li>
                        <button data-color="linear-gradient(43deg, rgba(146,231,157,1) 0%, rgba(8,161,49,0.9809173669467787) 68%)" data-button="#1B9C85" style="--color: #1B9C85;"></button>
                    </li>
                </ul>
            </div>
        </div>
    </div> -->

    <section>
        <?php if(isset($_GET['id'])){ ?>
            <input type="number" id="guest_com" name="id_com" value="<?=$ID_COM?>" hidden>
        <?php } ?>
        <div class="row m-0 pt-2" style="background: #e9f0fd;">
            <div class="col-lg-12 col-12">
                <div class="d-flex justify-content-center">
                    <a class="logo-company" href="./index.php?id=<?=$ID_COM?>">
                        <img src="./img/company/<?=$getAllInfo[0]['img_company']?>" alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="company-active section-title">
                    <h2 class="name_com"><?=$getAllInfo[0]['company_name']?></h2>
                    <div class="list">
                        <div class="list-child">
                            <div class="dropdown call-phone">
                                <div id="dropdownMenuButton" data-mdb-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-phone'></i> <span class="phone"><?=$getAllInfo[0]['hotline']?></span>
                                </div>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <div class="d-flex align-items-center justify-content-between gap-3">
                                        <span class="info-lg">Call the phone number:</span>
                                        <span class="info-mb">Call <?=$getAllInfo[0]['hotline']?>:</span>
                                        <a target="_blank" href="tel:<?=$getAllInfo[0]['hotline']?>"><i class='bx bx-phone'></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown address-company">
                                <div id="dropdownLocation" data-mdb-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-location-plus' ></i> <span class="address"><?= $getAllInfo[0]['address']?></span>
                                </div>
                                <div class="dropdown-menu" aria-labelledby="dropdownLocation">
                                    <?php 
                                        echo '<iframe width="100%" height="100%" frameborder="0" src="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=' . str_replace(",", "", str_replace(" ", "+", $address)) . '&z=14&output=embed"></iframe>';
                                    ?>
                                </div>
                            </div>
                            <div class="dropdown day-work">
                                <div id="dropdownWork" data-mdb-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-time' ></i> <span class="item-work">
                                        <span><?=$last_time_start?></span> - <span><?=$last_time_end?></span>
                                    </span>
                                </div>
                                <div class="dropdown-menu" aria-labelledby="dropdownWork">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <?=$day_work?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
