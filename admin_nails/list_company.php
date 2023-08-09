<?php
include_once "./header.php";
require_once "../model/company.php";

$company = new Company();
$getAllCompany = $company->getAllCompany();

if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $path = 'https';
    $server = $_SERVER['HTTPS_HOST'];
} else {
    $path = 'http';
    $server = $_SERVER['HTTP_HOST'];
}

if(isset($_SESSION['success'])){
    $str = $_SESSION['success'];
    $message = "
    <div class='alert alert-success alert-dismissible alert-alt solid fade show'>
        <button type='button' class='close h-100' data-dismiss='alert' aria-label='Close'><span><i class='mdi mdi-close'></i></span>
        </button>
        <strong>Success! </strong> $str.
    </div>
    ";
}

if(isset($_SESSION['error'])){
    $str = $_SESSION['error'];
    $message = "
    <div class='alert alert-danger alert-dismissible alert-alt solid fade show'>
        <button type='button' class='close h-100' data-dismiss='alert' aria-label='Close'><span><i class='mdi mdi-close'></i></span>
        </button>
        <strong>Wrong! </strong> $str.
    </div>
    ";
    unset($_SESSION['error']);
}

$urlCom = "$path://$server/booking_nail/template_nails/index.php?id=";
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All list of companies</h1>
        <a id="myBtn" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Add new company</a>
    </div>

    <?php if(isset($message)){echo $message;} ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Registered companies</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered custom-table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th width="20%">Logo</th>
                            <th>Hotline</th>
                            <th>Time Start</th>
                            <th>Time End</th>
                            <th>Address</th>
                            <th>Status Price</th>
                            <th>Link</th>
                            <th>Function</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($getAllCompany as $item) {
                        ?>
                            <tr>
                                <td><?= $item['id'] ?></td>
                                <td><?= $item['company_name'] ?></td>
                                <td>
                                    <img src="../template_nails/img/company/<?= $item['img_company'] ?>" width="200px" height="150px" alt="<?= $item['img_company'] ?>">
                                </td>
                                <td><?= $item['hotline'] ?></td>
                                <td><?= $item['time_start'] ?></td>
                                <td><?= $item['time_end'] ?></td>
                                <td><?= $item['address'] ?></td>
                                <td><?php
                                    if ($item['status'] == 1) {
                                        echo "Show";
                                    } else {
                                        echo "Hidden";
                                    }
                                    ?></td>
                                <td>
                                    <a target="_blank" href="<?=$urlCom . $item['rand_id']?>" style="text-decoration: underline;">Go to</a>
                                </td>
                                <td>
                                <a href="./edit_company.php?id=<?=$item['id']?>" class="icon edit"><i class='bx bx-edit'></i></a>
                                <a onclick="if(CheckForm() == false) return false" href="./action/delete_company.php?id=<?=$item['id']?>" class="icon delete"><i class='bx bxs-message-square-x'></i></a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Modal -->
<div id="newModal" class="modal1" data-display="false">
    <!-- Modal content -->
    <div class="modal-content">
        <form id="form_company" action="action/add_company.php" onsubmit="return validate();" method="post" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add New Company</h5>
                <button type="button" data-modal="close" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="company_name"><b>Name Company:</b></label>
                    <input type="text" class="form-control" name="company_name" placeholder="Enter name company..." required>
                </div>
                <div class="form-group">
                    <label for="image">Choose Image:</label>
                    <input type="file" name="image" class="form-control" required>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label for="mo_ta"><b>Start working hours:</b></label>
                            <input type="text" name="time_start" id="time_start" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label for="address"><b>End of work:</b></label>
                            <input type="text" name="time_end" id="time_end" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label for="mo_ta"><b>Hotline:</b></label>
                            <input id="valid-phone" type="text" class="form-control phone_company" name="hotline" placeholder="Enter hotline..." required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label for="address"><b>Password:</b></label>
                            <div class="input-group">
                                <input type="password" class="form-control pwd" name="password" placeholder="Enter password..." required>
                                <span class="input-group-btn">
                                    <button class="btn btn-default reveal" type="button"><i class='bx bx-low-vision'></i></button>
                                </span>          
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="form-group">
                            <label for="address"><b>Address:</b></label>
                            <input type="text" class="form-control" name="address" placeholder="Enter hotline..." required>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <label for="day_start"><b>Work from:</b></label>
                        <select class="form-control" name="day_start">
                            <option value="Sunday">Sunday</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <label for="day_end"><b>To:</b></label>
                        <select class="form-control" name="day_end">
                            <option value="Sunday">Sunday</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label for="mo_ta"><b>Status:</b></label>
                            <select name="status" class="form-control">
                                <option value="1">Show</option>
                                <option value="0">Hidden</option>
                            </select>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button id="btnAddVehicle" type="submit" class="btn btn-primary">Add New</button>
            </div>
        </form>
    </div>
</div>
<!-- End of Content Wrapper -->
<?php include_once "./footer.php"; ?>