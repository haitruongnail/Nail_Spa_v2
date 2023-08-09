<?php
include_once "./header.php";
require_once "../model/company.php";
require_once  "../model/nailtype.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    header('location: ' . $url .'/404.php');
}
$company = new Company();
$getAllCompany = $company->getAllCompany();

//Created new type of product
$nailtype = new NailType();
//Get all type 
$getTypeById = $nailtype->getTypeById($id);

?>
            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Manager type of services</h1>
                </div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="p-4 d-flex justify-content-start align-items-center">
                        <form action="action/edit_nailtype.php" method="post" class="w-75" enctype="multipart/form-data">
                            <input type="number" name="type_id" value="<?=$id?>" hidden>
                            <div class="form-group">
                                <label for="type_name"><b>Choose Company:</b></label>
                                <select name="id_company" class="form-control">
                                    <?php foreach($getAllCompany as $item){
                                        
                                        if(isset($_SESSION['owner'])){
                                        $com_id = $current_user['id'];
                                        if($com_id == $item['id']){ ?>
                                                <option class="divCompany" value="<?=$item['id']?>"><?=$item['company_name']?></option>
                                        <?php }else{ ?>
                                                <option class="divCompany" value="<?=$item['id']?>" hidden><?=$item['company_name']?></option>
                                        <?php }}else{ ?>
                                            <option class="divCompany" value="<?=$item['id']?>"><?=$item['company_name']?></option>
                                    <?php }} ?>
                                </select>
                            </div>
                            <div class="form-group w-75">
                                <label for="">Name:</label>
                                <input type="text" name="type_name" class="form-control" value="<?=$getTypeById[0]['type_name']?>" required>
                            </div>
                            <div class="form-group">
                                <label for="">Chọn hình ảnh:</label><br>
                                <img src="../template_nails/img/nailtype/<?=$getTypeById[0]['img_type']?>" height="300px" id="img_thumbnail" alt="<?=$getTypeById[0]['img_type']?>">
                                <input id="change_img" type="file" name="image" class="form-control" value="<?=$getTypeById[0]['img_type']?>">
                                <input type="text" value="<?=$getTypeById[0]['img_type']?>" name="name_img_product" hidden>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" placeholder="Enter your note..."><?=$getTypeById[0]['description']?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="mo_ta"><b>Status:</b></label>
                                <select name="status" class="form-control w-50">
                                    <option class="optionDiv" value="0">Hidden</option>
                                    <option class="optionDiv" value="1">Show</option>
                                </select>
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
        if ( document.querySelectorAll('.optionDiv')[i].value == '<?=$getTypeById[0]['status'];?>') {
            document.querySelectorAll('.optionDiv')[i].selected = true;
            break;
        }
    }

    for (var i = 0; i < document.querySelectorAll('.divCompany').length; i++) {
    if ( document.querySelectorAll('.divCompany')[i].value == '<?=$getTypeById[0]['id_company'];?>') {
        document.querySelectorAll('.divCompany')[i].selected = true;
        break;
    }
    }

</script>
<?php
include "./footer.php";
?>