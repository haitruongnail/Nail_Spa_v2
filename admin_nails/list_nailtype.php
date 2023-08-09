<?php
include_once "./header.php";
require_once "../model/nailtype.php";
require_once "../model/service.php";
require_once "../model/company.php";

$nailtype = new NailType();
$getAllType = $nailtype->getAllType();


$service = new Service();
$getAllService = $service->getAllService();

$company = new Company();
$getAllCompany = $company->getAllCompany();

if(isset($_SESSION['owner'])){
    $getAllType = $nailtype->getTypeByCompany($current_user['id']);
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
        <h1 class="h3 mb-0 text-gray-800">All list of type of services</h1>
        <div>
            <a id="myBtn" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Add new type</a>
            <a id="myBtnService" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Add new service</a>
        </div>
    </div>

    <?php if(isset($message)){echo $message;} ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Registered type of services</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered custom-table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Company</th>
                            <th>Name</th>
                            <th width="20%">Image</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Function</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($getAllType as $item) {
                        ?>
                            <tr>

                                <td><?= $count++ ?></td>
                                <td><?= $item['company_name'] ?></td>
                                <td><?= $item['type_name'] ?></td>
                                <td>
                                    <img src="../template_nails/img/nailtype/<?= $item['img_type'] ?>" width="200px" height="150px" alt="<?= $item['img_type'] ?>">
                                </td>
                                <td><?= $item['description'] ?></td>
                                <td><?php
                                    if ($item['status'] == 1) {
                                        echo "Show";
                                    } else {
                                        echo "Hidden";
                                    }
                                    ?></td>
                                <td>
                                <a href="./edit_nailtype.php?id=<?=$item['id']?>" class="icon edit"><i class='bx bx-edit'></i></a>    
                                <a onclick="if(CheckForm() == false) return false" href="./action/delete_nailtype.php?id=<?=$item['id']?>" class="icon delete"><i class='bx bxs-message-square-x'></i></a></td>
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
        <form action="action/add_nailtype.php" method="post" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add New Type</h5>
                <button type="button" data-modal="close" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="type_name"><b>Choose Company:</b></label>
                    <select name="id_company" class="form-control">
                        <?php foreach($getAllCompany as $item){ 
                            if(isset($_SESSION['owner'])){
                                $com_id = $current_user['id'];
                                if($com_id == $item['id']){ ?>
                                    <option value="<?=$item['id']?>"><?=$item['company_name']?></option>
                            <?php }}else{ ?>
                                <option value="<?=$item['id']?>"><?=$item['company_name']?></option>
                        <?php }} ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="type_name"><b>Name type:</b></label>
                    <input type="text" class="form-control" name="type_name" placeholder="Enter name type...">
                </div>
                <div class="form-group">
                    <label for="image">Choose Image:</label>
                    <input type="file" name="image" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" placeholder="Enter your note..."></textarea>
                </div>
                <div class="form-group">
                    <label for="status"><b>Status:</b></label>
                    <select name="status" class="form-control w-50">
                        <option value="1">Show</option>
                        <option value="0">Hidden</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btnAddVehicle" type="submit" class="btn btn-primary">Add New</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal -->
<div id="modalService" class="modal1" data-display="false">
    <!-- Modal content -->
    <div class="modal-content">
        <form action="action/add_service.php" method="post" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add New Service</h5>
                <button type="button" data-modal="close" class="close1">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="company_name"><b>Name service:</b></label>
                    <input type="text" class="form-control" name="service_name" placeholder="Enter name service...">
                </div>
                <div class="form-group">
                    <label for="image">Choose Image:</label>
                    <input type="file" name="image" class="form-control" required>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label for="mo_ta"><b>Price($):</b></label>
                            <input type="number" class="form-control" name="price" placeholder="0">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label for="time_completion"><b>Time completion:</b></label>
                            <input type="text" name="time_completion" id="time_completion" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label for="company_name"><b>Name company:</b></label>
                            <select id="select-company" name="company_name" class="form-control">
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
                            <label for="type_id"><b>Type Nail:</b></label>
                            <select id="select-type" name="type_id" class="form-control">
                                <?php foreach($getAllType as $item){ ?>
                                    <option value="<?=$item['id'] ?>"><?=$item['type_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label for="status"><b>Status:</b></label>
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