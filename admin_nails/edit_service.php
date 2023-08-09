<?php
include_once "./header.php";
require_once  "../model/company.php";
require_once  "../model/nailtype.php";
require_once  "../model/service.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header('location: ' . $url . '/404.php');
}
//Created new object
$nailtype = new NailType();
$getAllType = $nailtype->getAllType();

$service = new Service();
//Get all type 
$getServiceById = $service->getServiceById($id);

$company = new Company();
$getAllCompany = $company->getAllCompany();

?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manager Service</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="p-4 d-flex justify-content-start align-items-center">
            <form action="action/edit_service.php" method="post" class="w-75" enctype="multipart/form-data">
                <input type="number" name="service_id" value="<?= $id ?>" hidden>
                <div class="form-group w-75">
                    <label for="">Name Serive:</label>
                    <input type="text" name="service_name" class="form-control" value="<?= $getServiceById[0]['name_service'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="">Chọn hình ảnh:</label><br>
                    <img src="../template_nails/img/service/<?= $getServiceById[0]['img_service'] ?>" height="300px" id="img_thumbnail" alt="<?= $getServiceById[0]['img_service'] ?>">
                    <input id="change_img" type="file" name="image" class="form-control" value="<?= $getServiceById[0]['img_service'] ?>">
                    <input type="text" value="<?= $getServiceById[0]['img_service'] ?>" name="name_img_product" hidden>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label for="price"><b>Price($):</b></label>
                            <input type="number" class="form-control" name="price" value="<?=$getServiceById[0]['price']?>">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label for="time_completion"><b>Time completion:</b></label>
                            <input type="text" name="time_completion" id="time_completion" class="form-control" value="<?=$getServiceById[0]['time_completion']?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label for="company_name"><b>Name company:</b></label>
                            <select data-edit="<?= $getServiceById[0]['type_id'] ?>" id="select-company" name="company_name" class="form-control">
                                <?php foreach($getAllCompany as $item){ 
                                    if(isset($_SESSION['owner'])){
                                        $com_id = $current_user['id'];
                                        if($com_id == $item['id']){ ?>
                                            <option class="optionCompany" value="<?=$item['id'] ?>" selected><?=$item['company_name'] ?></option>
                                    <?php }else{ ?>
                                            <option class="optionCompany" value="<?=$item['id'] ?>" hidden><?=$item['company_name'] ?></option>
                                    <?php }}else{ ?>
                                        <option class="optionCompany" value="<?=$item['id'] ?>"><?=$item['company_name'] ?></option>
                                <?php }} ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">                                                                              
                        <div class="form-group">
                            <label for="type_id"><b>Type Nail:</b></label>
                            <select id="select-type" name="type_id" class="form-control">
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label for="status"><b>Status:</b></label>
                            <select name="status" class="form-control">
                                <option class="statusDiv" value="1">Show</option>
                                <option class="statusDiv" value="0">Hidden</option>
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
    console.log();
</script>

<script>
    for (var i = 0; i < document.querySelectorAll('.optionDiv').length; i++) {
        if (document.querySelectorAll('.optionDiv')[i].value == '<?= $getServiceById[0]['status']; ?>') {
            document.querySelectorAll('.optionDiv')[i].selected = true;
            break;
        }
    }
    for (var i = 0; i < document.querySelectorAll('.companyDiv').length; i++) {
        if (document.querySelectorAll('.companyDiv')[i].value == '<?= $getServiceById[0]['company_id']; ?>') {
            document.querySelectorAll('.companyDiv')[i].selected = true;
            break;
        }
    }
    for (var i = 0; i < document.querySelectorAll('.typeDiv').length; i++) {
        if (document.querySelectorAll('.typeDiv')[i].value == '<?= $getServiceById[0]['type_id']; ?>') {
            document.querySelectorAll('.typeDiv')[i].selected = true;
            break;
        }
    }
    for (var i = 0; i < document.querySelectorAll('.statusDiv').length; i++) {
        if (document.querySelectorAll('.statusDiv')[i].value == '<?= $getServiceById[0]['status']; ?>') {
            document.querySelectorAll('.statusDiv')[i].selected = true;
            break;
        }
    }
    for (var i = 0; i < document.querySelectorAll('.statusDiv').length; i++) {
        if (document.querySelectorAll('.statusDiv')[i].value == '<?= $getServiceById[0]['status']; ?>') {
            document.querySelectorAll('.statusDiv')[i].selected = true;
            break;
        }
    }
    for (var i = 0; i < document.querySelectorAll('.optionCompany').length; i++) {
        if (document.querySelectorAll('.optionCompany')[i].value == '<?= $getServiceById[0]['company_id']; ?>') {
            document.querySelectorAll('.optionCompany')[i].selected = true;
            break;
        }
    }
</script>
<?php
include "./footer.php";
?>