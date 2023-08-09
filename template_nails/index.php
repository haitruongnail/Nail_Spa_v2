<?php
include_once './header.php';
require_once '../model/company.php';
require_once '../model/service.php';
require_once '../model/staff.php';


$company = new Company();
$service = new Service();
$staff = new Staff();

$getAllCompany = $company->getAllCompany();

if(isset($_GET['id'])){
    $ID_COM = $_GET['id'];
}

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}
if(isset($_SESSION['error-phone'])){
    unset($_SESSION['error-phone']);
}
// if(isset($_POST['staff-orther'])){
//     $staff_id = $_POST['staff-orther'];
    
//     $staff = new Staff();
//     $addServiceToCart = $staff->addServiceToCart($staff_id);

//     $arr = [
//         "company_name"=> $addServiceToCart[0]['company_name'],
//         "type_name"=> $addServiceToCart[0]['type_name'],
//         "name_service"=> $addServiceToCart[0]['name_service'],
//         "time_completion"=> $addServiceToCart[0]['time_completion'],
//         "price"=> $addServiceToCart[0]['price'],
//         "user_name"=> $addServiceToCart[0]['user_name'],
//     ];

//     array_push($_SESSION['cart'], $arr);
// }
?>

<!-- Booking start-->
<section class="booking-nail mb-5 pt-5">
    <div class="container">
        <form action="">
            <div class="row">
                <!--Choose service and staff start-->
                <div class="col-lg-12">
                    <div class="row booking-main">
                        <div class="col-lg-12 text-center mb-3">
                            <h5><b>Choose Service name:</b> </h5>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <div class="d-flex justify-content-center align-items-center flex-wrap">
                                <?php if(isset($_GET['id'])){ ?>
                                    <input type="number" id="guest_com" name="id_com" value="<?=$ID_COM?>" hidden>
                                <?php }else{ ?>
                                <select id="guest" class="guest">
                                    <?php foreach($getAllCompany as $item){ ?>
                                        <option value="<?=$item['id']?>"> <?=$item['company_name']?> </option>
                                    <?php } ?>
                                </select>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card-booking">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a class="active" data-toggle="tab" href="#home">Services</a></li>
                                    <li><a data-toggle="tab" href="#menu1">Staffs</a></li>
                                </ul>

                                <div class="tab-content mt-4">
                                    <div id="home" class="tab-pane fade show active">
                                        <div class="form-parent mb-3">
                                            <div class="icon-search"><i class='bx bx-search'></i></div>
                                            <input type="search" id="search-service" class="form-control" placeholder="Type query" aria-label="Search" />
                                        </div>
                                        <div class="collapse show filter-service">
                                            <!-- <div class="collapse-item">
                                                <a data-toggle="collapse" href="#multiCollapseExample0" role="button" aria-expanded="false" aria-controls="multiCollapseExample0">
                                                    <span>Manicure/Pedicure</span>
                                                    <span class="float-right"><i class='bx bx-chevron-down'></i></span>
                                                </a>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="collapse multi-collapse" id="multiCollapseExample0">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="item-service ">
                                                                        <div class="desc-left">
                                                                            <p>Express Manicure</p>
                                                                            <p><i class='bx bx-time-five'></i> 01 hours 30
                                                                                minutes <span class="space">.</span> <span class="price">$20</span></p>
                                                                        </div>
                                                                        <div class="desc-right">
                                                                            <input type="radio" name="services">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div id="menu1" class="tab-pane fade list-staff">
                                        <!-- <div class="card-staff">
                                            <div class="card-item card-left">
                                                <div class="d-flex align-items-center">
                                                    <img src="./img/room/avatar/avatar-1.jpg" alt="">
                                                    <p class="name ml-3">Thomas</p>
                                                </div>
                                            </div>
                                            <div class="card-item card-right">
                                                <a onclick="showCart();" class="btn btn-primary text-white">BOOK</a>
                                            </div>
                                        </div> -->
                                        
                                    </div>
                                    
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!--Choose service and staff end-->
            </div>
        </form>
    </div>
</section>
<!-- Booking end-->

<!-- Modal -->
<div id="newModal" class="modal1" data-display="false">
    <!-- Modal content -->
    <div class="modal-content">
        <form enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add more service</h5>
                <button type="button" data-modal="close" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row booking-main">
                    <div class="col-lg-12 text-center mb-3">
                        <h5><b>Choose Service name:</b> </h5>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <div class="d-flex justify-content-center align-items-center flex-wrap">
                            <?php if(isset($_GET['id'])){ ?>
                                <input type="number" id="guest_com_toggle" name="id_com" value="<?=$ID_COM?>" hidden>
                            <?php }else{ ?>
                            <select id="guest" class="guest">
                                <?php foreach($getAllCompany as $item){ ?>
                                    <option value="<?=$item['id']?>"> <?=$item['company_name']?> </option>
                                <?php } ?>
                            </select>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card-booking">
                            <ul class="nav nav-tabs">
                                <li class="active"><a class="active" data-toggle="tab" href="#home2">Services</a></li>
                                <li><a data-toggle="tab" href="#menu3">Staffs</a></li>
                            </ul>

                            <div class="tab-content mt-4">
                                <div id="home2" class="tab-pane fade show active">
                                    <div class="form-parent mb-3">
                                        <div class="icon-search"><i class='bx bx-search'></i></div>
                                        <input type="search" id="form1" class="form-control" placeholder="Type query" aria-label="Search" />
                                    </div>
                                    <div class="collapse show filter-service2">
                                        <div class="collapse-item">
                                            <a data-toggle="collapse" href="#services1" role="button" aria-expanded="false" aria-controls="services1">
                                                <span>Manicure/Pedicure</span>
                                                <span class="float-right"><i class='bx bx-chevron-down'></i></span>
                                            </a>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="collapse multi-collapse" id="services1">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="item-service ">
                                                                    <div class="desc-left">
                                                                        <p>Express Manicure</p>
                                                                        <p><i class='bx bx-time-five'></i> 01 hours 30
                                                                            minutes <span class="space">.</span> <span class="price">$20</span></p>
                                                                    </div>
                                                                    <div class="desc-right">
                                                                        <input type="radio" name="services">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="menu3" class="tab-pane fade list-staff2">
                                    <!-- <div class="card-staff">
                                        <div class="card-item card-left">
                                            <div class="d-flex align-items-center">
                                                <img src="./img/room/avatar/avatar-1.jpg" alt="">
                                                <p class="name ml-3">Thomas</p>
                                            </div>
                                        </div>98
                                        <div class="card-item card-right">
                                            <input type="radio" name="staff-orther" class="form-control">
                                        </div>
                                    </div> -->
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a id="btnAddVehicle" data-modal="close" onclick="checkStaffChoose();" class="btn btn-primary">Continue</a>
            </div>
            <!-- <div class="footer-end mt-5">
                <div class="group-btn">
                    <a href="index.php?id=<?=$ID_COM?>" class="back">Back</a>
                    <button type="submit">Continue</button>
                </div>
            </div> -->
        </form>
    </div>
</div>

<?php
include_once './footer.php';
?>