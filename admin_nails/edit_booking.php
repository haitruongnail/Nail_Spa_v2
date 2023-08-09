<?php
include_once "./header.php";
require_once  "../model/booking.php";
require_once  "../model/company.php";
require_once  "../model/service.php";
require_once  "../model/staff.php";
require_once  "../model/user.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header('location: ' . $url . '/404.php');
}
//Created new object
$booking = new Booking();
$getBookingById = $booking->getBookingById($id);

$company = new Company();
$getAllCompany = $company->getAllCompany();

$service = new Service();
$getAllService = $service->getAllService();

$staff = new Staff();
$getAllStaff = $staff->getAllStaff();

$user = new User();
$getAllUser = $user->getAllUser();


if(isset($_SESSION['owner'])){
    $getAllCompany = $company->getCompanyById($current_user['id']);
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manager all booking</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="p-4 d-flex justify-content-start align-items-center">
            <form action="action/edit_booking.php" method="post" style="min-width: 70%;" enctype="multipart/form-data">
                <input type="number" name="booking_id" value="<?= $id ?>" hidden>
                <input type="number" id="edit-company" value="<?= $getBookingById[0]['company_id'] ?>" hidden>
                <input type="number" id="edit-service" value="<?= $getBookingById[0]['service_id'] ?>" hidden>
                <input type="number" id="edit-staff" value="<?= $getBookingById[0]['staff_id'] ?>" hidden>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="form-group">
                            <label for="company_id"><b>Comapany name:</b></label>
                            <select name="company_id" id="set_company" class="form-control">
                                <?php foreach($getAllCompany as $item){ 
                                    if(isset($_SESSION['owner'])){
                                        $com_id = $current_user['id'];
                                        if($com_id == $item['id']){ ?>
                                            <option class="companyDiv" value="<?=$item['id'] ?>" selected><?=$item['company_name'] ?></option>
                                    <?php }else{ ?>
                                            <option class="companyDiv" value="<?=$item['id'] ?>" hidden><?=$item['company_name'] ?></option>
                                    <?php }}else{ ?>
                                        <option class="companyDiv" value="<?=$item['id'] ?>"><?=$item['company_name'] ?></option>
                                <?php }} ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="form-group">
                            <label for="service_id"><b>Service:</b></label>
                            <select name="service_id" id="set_service" class="form-control">
                                <?php foreach($getAllService as $item){ ?>
                                    <option value="<?=$item['ID_service']?>"><?=$item['name_service']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="form-group">
                            <label for="staff_id"><b>Staff:</b></label>
                            <select name="staff_id" id="set_staff" class="form-control">
                                <?php foreach($getAllStaff as $item){ 
                                    if(isset($_SESSION['owner'])){
                                        $com_id = $current_user['id'];
                                        if($com_id == $item['id']){ ?>
                                            <option value="<?=$item['id'] ?>" selected><?=$item['user_name'] ?></option>
                                    <?php }else{ ?>
                                            <option value="<?=$item['id'] ?>" hidden><?=$item['user_name'] ?></option>
                                    <?php }}else{ ?>
                                        <option value="<?=$item['id']?>"><?=$item['user_name']?></option>
                                <?php }} ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label for="mo_ta"><b>Date duration:</b></label>
                            <input type="date" name="date_duration" class="form-control" value="<?=$getBookingById[0]['date_duration']?>">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label for="address"><b>End of work:</b></label>
                            <input type="text" name="time_duration" id="time_completion" class="form-control" value="<?=$getBookingById[0]['time_duration']?>">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label for="address"><b>Choose Customer:</b></label>
                            <select name="user_id" class="form-control">
                                <?php foreach($getAllUser as $item){ ?>
                                    <option class="userDiv" value="<?=$item['id']?>"><?=$item['fullname']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<script>

    for (var i = 0; i < document.querySelectorAll('.companyDiv').length; i++) {
        if (document.querySelectorAll('.companyDiv')[i].value == '<?= $getBookingById[0]['company_id']; ?>') {
            document.querySelectorAll('.companyDiv')[i].selected = true;
            break;
        }
    }
    for (var i = 0; i < document.querySelectorAll('.typeDiv').length; i++) {
        if (document.querySelectorAll('.typeDiv')[i].value == '<?= $getBookingById[0]['service_id']; ?>') {
            document.querySelectorAll('.typeDiv')[i].selected = true;
        }
        else{
            document.querySelectorAll('.typeDiv')[i].hidden = true
        }
    }
    for (var i = 0; i < document.querySelectorAll('.userDiv').length; i++) {
        if (document.querySelectorAll('.userDiv')[i].value == '<?= $getBookingById[0]['user_id']; ?>') {
            document.querySelectorAll('.userDiv')[i].selected = true;
            break;
        }
    }
    for (var i = 0; i < document.querySelectorAll('.staffDiv').length; i++) {
        if (document.querySelectorAll('.staffDiv')[i].value == '<?= $getBookingById[0]['staff_id']; ?>') {
            document.querySelectorAll('.staffDiv')[i].selected = true;
        }
        else{
            document.querySelectorAll('.staffDiv')[i].hidden = true
        }
    }
</script>
<?php
include "./footer.php";
?>