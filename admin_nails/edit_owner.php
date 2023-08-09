<?php
include_once "./header.php";
require_once  "../model/info_owner.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    header('location: ' . $url .'/404.php');
}
//Created new type of product
$owner = new InfoOwner();
//Get all type 
$getInfoById = $owner->getInfoById($id);

?>
            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Manager infomation of owner company</h1>
                </div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="p-4 d-flex justify-content-start align-items-center">
                        <form action="action/edit_owner.php" method="post" style="min-width: 70%;" enctype="multipart/form-data">
                            <input type="number" name="owner_id" value="<?=$id?>" hidden>
                            <div class="form-group w-75">
                                <label for="">Name:</label>
                                <input type="text" name="company_name" class="form-control" value="<?=$getInfoById[0]['company_name']?>" required>
                            </div>
                            <div class="form-group">
                                <label for="">Chọn hình ảnh:</label>
                                <img src="../template_nails/img/owner/<?=$getInfoById[0]['logo_company']?>" height="300px" id="img_thumbnail" alt="<?=$getInfoById[0]['logo_company']?>">
                                <input id="change_img" type="file" name="image" class="form-control" value="<?=$getInfoById[0]['logo_company']?>">
                                <input type="text" value="<?=$getInfoById[0]['logo_company']?>" name="name_img_product" hidden>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="">Phone:</label>
                                        <input type="text" class="form-control" name="phone" value="<?=$getInfoById[0]['phone']?>">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="address">Address:</label>
                                        <input type="text" class="form-control" name="address" value="<?=$getInfoById[0]['address']?>">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="time_active">Time Active</label>
                                        <div class="row text-center">
                                            <div class="col-lg-5 col-12">
                                                <input name="time_start" type="text" id="time_start" class="form-control" value="<?=$getInfoById[0]['time_start']?>">
                                            </div>
                                            <div class="col-2"> <span style="line-height: 38px;">to</span> </div>
                                            <div class="col-lg-5 col-12">
                                                <input  name="time_end" type="text" id="time_end" class="form-control" value="<?=$getInfoById[0]['time_end']?>">
                                            </div>
                                        </div>
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

<?php
include "./footer.php";
?>