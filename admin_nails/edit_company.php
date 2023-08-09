<?php
include_once "./header.php";
require_once  "../model/company.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    header('location: ' . $url .'/404.php');
}
//Created new type of product
$company = new Company();
//Get all type 
$getCompanyById = $company->getCompanyById($id);

?>
            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Manager Company</h1>
                </div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="p-4 d-flex justify-content-start align-items-center">
                        <form action="action/edit_company.php" method="post" class="w-75" enctype="multipart/form-data">
                            <input type="number" name="company_id" value="<?=$id?>" hidden>
                            <div class="form-group w-75">
                                <label for="">Name Company:</label>
                                <input type="text" name="company_name" class="form-control" value="<?=$getCompanyById[0]['company_name']?>" required>
                            </div>
                            <div class="form-group">
                                <label for="">Chọn hình ảnh:</label>
                                <img src="../template_nails/img/company/<?=$getCompanyById[0]['img_company']?>" height="300px" id="img_thumbnail" alt="<?=$getCompanyById[0]['img_company']?>">
                                <input id="change_img" type="file" name="image" class="form-control" value="<?=$getCompanyById[0]['img_company']?>">
                                <input type="text" value="<?=$getCompanyById[0]['img_company']?>" name="name_img_product" hidden>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="mo_ta"><b>Start working hours:</b></label>
                                        <input type="text" name="time_start" id="time_start" class="form-control" value="<?=$getCompanyById[0]['time_start']?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="address"><b>End of work:</b></label>
                                        <input type="text" name="time_end" id="time_end" class="form-control" value="<?=$getCompanyById[0]['time_end']?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="mo_ta"><b>Hotline:</b></label>
                                        <input type="text" class="form-control" name="hotline" value="<?=$getCompanyById[0]['hotline']?>" placeholder="Enter hotline..." required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="address"><b>Password:</b></label>
                                        <div class="input-group">
                                            <input type="password" class="form-control pwd" name="password" placeholder="Enter password..." value="<?=$getCompanyById[0]['password']?>" required>
                                            <span class="input-group-btn">
                                                <button class="btn btn-default reveal" type="button"><i class='bx bx-low-vision'></i></button>
                                            </span>          
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="address"><b>Address:</b></label>
                                        <input type="text" class="form-control" name="address" value="<?=$getCompanyById[0]['address']?>" placeholder="Enter hotline..." required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <label for="day_start"><b>Work from:</b></label>
                                    <select class="form-control" name="day_start">
                                        <option class="dayStart" value="Sunday">Sunday</option>
                                        <option class="dayStart" value="Monday">Monday</option>
                                        <option class="dayStart" value="Tuesday">Tuesday</option>
                                        <option class="dayStart" value="Wednesday">Wednesday</option>
                                        <option class="dayStart" value="Thursday">Thursday</option>
                                        <option class="dayStart" value="Friday">Friday</option>
                                        <option class="dayStart" value="Saturday">Saturday</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <label for="day_end"><b>To:</b></label>
                                    <select class="form-control" name="day_end">
                                        <option class="dayEnd" value="Sunday">Sunday</option>
                                        <option class="dayEnd" value="Monday">Monday</option>
                                        <option class="dayEnd" value="Tuesday">Tuesday</option>
                                        <option class="dayEnd" value="Wednesday">Wednesday</option>
                                        <option class="dayEnd" value="Thursday">Thursday</option>
                                        <option class="dayEnd" value="Friday">Friday</option>
                                        <option class="dayEnd" value="Saturday">Saturday</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="mo_ta"><b>Status:</b></label>
                                        <select name="status" class="form-control">
                                            <option class="optionDiv" value="0">Hidden</option>
                                            <option class="optionDiv" value="1">Show</option>
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
    </script>

<script>
    for (var i = 0; i < document.querySelectorAll('.optionDiv').length; i++) {
        if ( document.querySelectorAll('.optionDiv')[i].value == '<?=$getCompanyById[0]['status'];?>') {
            document.querySelectorAll('.optionDiv')[i].selected = true;
            break;
        }
    }
    for (var i = 0; i < document.querySelectorAll('.dayStart').length; i++) {
        if ( document.querySelectorAll('.dayStart')[i].value == '<?=$getCompanyById[0]['day_start'];?>') {
            document.querySelectorAll('.dayStart')[i].selected = true;
            break;
        }
    }
    for (var i = 0; i < document.querySelectorAll('.dayEnd').length; i++) {
        if ( document.querySelectorAll('.dayEnd')[i].value == '<?=$getCompanyById[0]['day_end'];?>') {
            document.querySelectorAll('.dayEnd')[i].selected = true;
            break;
        }
    }
</script>
<?php
include "./footer.php";
?>