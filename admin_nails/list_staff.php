<?php
include_once "./header.php";
require_once "../model/staff.php";
require_once "../model/company.php";
require_once "../model/service.php";

$staff = new Staff();
$getAllStaff = $staff->getAllStaff();

$company = new Company();
$getAllCompany = $company->getAllCompany();

$service = new Service();
$getAllService = $service->getAllService();

if(isset($_SESSION['owner'])){
    $getAllStaff = $company->getStaffByCompanyId($current_user['id']);
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
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All list of staffs</h1>
        <a id="myBtn" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Add new staff</a>
    </div>
    <?php if(isset($message)){echo $message;} ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Registered staff</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered custom-table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Staff name</th>
                            <th width="20%">Avatar</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Birth</th>
                            <th>Gender</th>
                            <?php if(isset($_SESSION['admin'])){ ?>
                                <th>Company</th>
                            <?php } ?>
                            <th>Service</th>
                            <th>Function</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($getAllStaff as $item) {
                            $getStaffByCode = $staff->getStaffByCode($item['code']);
                            // var_dump($getStaffByCode);
                            $nameService = "";
                            foreach($getStaffByCode as $data){
                                $itemName = $data['name_service'];
                                $nameService .= "$itemName, ";
                            }
                        ?>
                            <tr>

                                <td><?= $count++ ?></td>
                                <td><?= $item['user_name'] ?></td>
                                <td>
                                    <img src="../template_nails/img/staff/<?= $item['avatar'] ?>" width="200px" height="150px" alt="<?= $item['avatar'] ?>">
                                </td>
                                <td><?= $item['phone'] ?></td>
                                <td><?= $item['email'] ?></td>
                                <td><?= $item['address'] ?></td>
                                <td><?= $item['birth'] ?></td>
                                <td><?= $item['gender'] ?></td>
                                <?php if(isset($_SESSION['admin'])){ ?>
                                    <td><?= $item['company_name'] ?></td>
                                <?php } ?>
                                <td><?= $nameService ?></td>
                                <td>
                                <a href="./edit_staff.php?id=<?=$item['staff_id']?>" class="icon edit"><i class='bx bx-edit'></i></a>    
                                <a onclick="if(CheckForm() == false) return false" href="./action/delete_staff.php?id=<?=$item['code']?>" class="icon delete"><i class='bx bxs-message-square-x'></i></a></td>
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
        <form action="action/add_staff.php" method="post" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add New Staff</h5>
                <button type="button" data-modal="close" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="company_name"><b>Name staff:</b></label>
                    <input type="text" class="form-control" name="staff_name" placeholder="Enter name staff..." required>
                </div>
                <div class="form-group">
                    <label for="image">Choose Avatar:</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="form-group">
                            <label for="phone"><b>Phone:</b></label>
                            <input type="text" name="phone" class="form-control" placeholder="Enter staff phone..." required>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="form-group">
                            <label for="email"><b>Email:</b></label>
                            <input type="email" name="email" class="form-control" placeholder="Enter email...">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="form-group">
                            <label for="birth"><b>Birth:</b></label>
                            <input type="date" name="birth" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="form-group">
                            <label for="gender"><b>Gender:</b></label>
                            <select name="gender" class="form-control">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address"><b>Address:</b></label>
                    <input type="text" class="form-control" name="address" placeholder="Enter hotline...">
                </div>
                <div class="row">
                    
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label for="company_name"><b>Name company:</b></label>
                            <select id="select-company" name="company_id" class="form-control">
                                <?php foreach($getAllCompany as $item){ 
                                    if(isset($_SESSION['owner'])){
                                        $com_id = $current_user['id'];
                                        if($com_id == $item['id']){ ?>
                                            <option value="<?=$item['id'] ?>" selected><?=$item['company_name'] ?></option>
                                    <?php }else{ ?>
                                            <option value="<?=$item['id'] ?>" hidden><?=$item['company_name'] ?></option>
                                    <?php }}else{ ?>
                                        <option value="<?=$item['id'] ?>"><?=$item['company_name'] ?></option>
                                <?php }} ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">                                                                              
                        <div class="form-group">
                            <label for="service_id"><b>Type Nail:</b></label>
                            <select id="select-service" name="service_id" class="selectpicker form-control" multiple data-live-search="true">
                                
                            </select>
                            <input type="text" id="listid_service" name="listid_service"  hidden>
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