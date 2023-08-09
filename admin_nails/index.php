<?php
include_once "./header.php";
require_once "../model/company.php";
require_once "../model/booking.php";
require_once "../model/service.php";
require_once "../model/staff.php";
require_once "../model/user.php";

$booking = new Booking();
if(isset($_SESSION['owner'])){
    $company = new Company();

    $getServiceByCompany = $company->getServiceByCompany($current_user['id']);
    $total_service = count($getServiceByCompany);

    $getStaffByCompanyId = $company->getStaffByCompanyId($current_user['id']);
    $total_staff = count($getStaffByCompanyId);
    
    $getBookingByCompany = $booking->getBookingByCompany($current_user['id']);
    $total_customer = count($getBookingByCompany);
    $total_booking = count($getBookingByCompany);

}else if(isset($_SESSION['admin'])){
    $service = new Service();
    $getAllService = $service->getAllService();
    $total_service = count($getAllService);

    $staff = new Staff();
    $getAllStaff = $staff->getAllStaff();
    $total_staff = count($getAllStaff);

    $user = new User();
    $getAllUser = $user->getAllUser();
    $total_customer = count($getAllUser);

    $user = new User();
    $getAllUser = $user->getAllUser();
    $total_customer = count($getAllUser);

    $getAllBooking = $booking->getAllBooking();
    $total_booking = count($getAllBooking);
}
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800"><?php if(isset($_SESSION['owner'])){echo $current_user['company_name'];} else if(isset($_SESSION['admin'])){echo "Dashboard";} ?></h1>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total service</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php if(isset($total_service)){echo $total_service;} ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Total Staff</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php if(isset($total_staff)){echo $total_staff;} ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Customer
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php if(isset($total_customer)){echo $total_customer;} ?></div>
                                        </div>
                                        <!-- <div class="col">
                                            <div class="progress progress-sm mr-2">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Total Booking</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php if(isset($total_booking)){echo $total_booking;} ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

            <?php if(isset($_SESSION['owner'])){ ?>
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Booking list of user</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Service</th>
                                        <th>Staff</th>
                                        <th>Date duration</th>
                                        <th>Time duration</th>
                                        <th>Username</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($getBookingByCompany as $item) {
                                    ?>
                                        <tr>
                                            <td><?= $count++ ?></td>
                                            <td><?= $item['name_service'] ?></td>
                                            <td><?= $item['user_name'] ?></td>
                                            <td><?= $item['date_duration'] ?></td>
                                            <td><?= $item['time_duration'] ?></td>
                                            <td><?= $item['fullname'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if(isset($_SESSION['admin'])){ ?>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Booking list of user</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Company</th>
                                        <th>Service</th>
                                        <th>Staff</th>
                                        <th>Date duration</th>
                                        <th>Time duration</th>
                                        <th>Username</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($getAllBooking as $item) {
                                    ?>
                                        <tr>
                                            <td><?= $count++ ?></td>
                                            <td><?= $item['company_name'] ?></td>
                                            <td><?= $item['name_service'] ?></td>
                                            <td><?= $item['user_name'] ?></td>
                                            <td><?= $item['date_duration'] ?></td>
                                            <td><?= $item['time_duration'] ?></td>
                                            <td><?= $item['fullname'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>

        </div>
        <!-- /.container-fluid -->

<!-- End of Content Wrapper -->
<?php include_once "./footer.php"; ?>