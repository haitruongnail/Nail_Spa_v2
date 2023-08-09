<?php
include_once "./header.php";
require_once  "../model/company.php";
require_once  "../model/nailtype.php";
require_once  "../model/service.php";
require_once  "../model/staff.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header('location: ' . $url . '/404.php');
}
//Created new object
$staff = new Staff();
$getStaffById = $staff->getStaffById($id);

$service = new Service();
//Get all type 
$getAllService = $service->getAllService();

$company = new Company();
$getAllCompany = $company->getAllCompany();

?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manager Your Staff</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="p-4 d-flex justify-content-start align-items-center">
            <form action="action/edit_staff.php" method="post" style="min-width: 70%;" enctype="multipart/form-data">
                <input type="number" name="staff_id" value="<?= $id ?>" hidden>
                <input id="code_staff" type="number" name="code_staff" value="<?= $getStaffById[0]['code']?>" hidden>
                <?php 
                $getStaffByCode = $staff->getStaffByCode($getStaffById[0]['code']);
                $arrService = [];
                $nameService = [];
                foreach($getStaffByCode as $item){
                    array_push($arrService,$item['service_id']);
                    array_push($nameService,$item['name_service']);
                }

                $arrService = json_encode($arrService);
                $nameService = json_encode($nameService);
                ?>
                <input type="json" value="<?=$arrService?>" id="array_service" hidden>
                <input type="json" value='<?=$nameService?>' id="array_name_service" hidden>
                <div class="form-group">
                    <label for="company_name"><b>Name staff:</b></label>
                    <input type="text" class="form-control" name="staff_name" value="<?=$getStaffById[0]['user_name']?>" required>
                </div>
                <div class="form-group">
                    <label for="image">Choose Avatar:</label>
                    <img src="../template_nails/img/staff/<?= $getStaffById[0]['avatar'] ?>" height="300px" id="img_thumbnail" alt="<?= $getStaffById[0]['avatar'] ?>">
                    <input id="change_img" type="file" name="image" class="form-control" value="<?= $getStaffById[0]['avatar'] ?>">
                    <input type="text" value="<?= $getStaffById[0]['avatar'] ?>" name="name_img_product" hidden>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="form-group">
                            <label for="phone"><b>Phone:</b></label>
                            <input type="text" name="phone" class="form-control"  value="<?=$getStaffById[0]['phone']?>" required>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="form-group">
                            <label for="email"><b>Email:</b></label>
                            <input type="email" name="email" class="form-control"  value="<?=$getStaffById[0]['email']?>">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="form-group">
                            <label for="birth"><b>Birth:</b></label>
                            <input type="date" name="birth" class="form-control" value="<?=$getStaffById[0]['birth']?>" required>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="form-group">
                            <label for="gender"><b>Gender:</b></label>
                            <select name="gender" class="form-control">
                                <option class="genderDiv" value="Male">Male</option>
                                <option class="genderDiv" value="Female">Female</option>
                                <option class="genderDiv" value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address"><b>Address:</b></label>
                    <input type="text" class="form-control" name="address"  value="<?=$getStaffById[0]['address']?>">
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label for="company_name"><b>Name company:</b></label>
                            <select data-page="edit" id="select-company" name="company_id" class="form-control">
                                <?php foreach($getAllCompany as $item){ 
                                    if(isset($_SESSION['owner'])){
                                        $com_id = $current_user['id'];
                                        if($com_id == $item['id']){ ?>
                                            <option class="companyDiv" value="<?=$item['id'] ?>" selected><?=$item['company_name'] ?></option>
                                    <?php }}else{ ?>
                                        <option class="companyDiv" value="<?=$item['id'] ?>"><?=$item['company_name'] ?></option>
                                <?php }} ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">                                                                              
                        <div class="form-group">
                            <label for="service_id"><b>Type Nail:</b></label>
                            <select data-page="edit" id="select-service" name="service_id" class="selectpicker form-control" multiple data-live-search="true">
                                
                            </select>
                            <input type="text" id="listid_service" name="listid_service"  hidden>
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
    var reader;
    let change_img = document.querySelector("#change_img");
    let img_thumbnail = document.querySelector("#img_thumbnail");
    change_img.onchange = e => {
        files = e.target.files;
        reader = new FileReader();
        reader.onload = function() {
            document.querySelector("#img_thumbnail").src = reader.result;
            document.querySelector('#img_thumbnail').style = 'width: 300px;';
            document.querySelector('#img_thumbnail').style = 'height: 300px;';
        }
        reader.readAsDataURL(files[0]);
    }
</script>

<script>

    for (var i = 0; i < document.querySelectorAll('.genderDiv').length; i++) {
        if (document.querySelectorAll('.genderDiv')[i].value == '<?= $getStaffById[0]['gender']; ?>') {
            document.querySelectorAll('.genderDiv')[i].selected = true;
            break;
        }
    }
    for (var i = 0; i < document.querySelectorAll('.companyDiv').length; i++) {
        if (document.querySelectorAll('.companyDiv')[i].value == '<?= $getStaffById[0]['company_id']; ?>') {
            document.querySelectorAll('.companyDiv')[i].selected = true;
            break;
        }
    }
</script>
<?php
include "./footer.php";
?>