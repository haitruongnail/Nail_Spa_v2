<?php
include_once "./header.php";
require_once  "../model/user.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header('location: ' . $url . '/404.php');
}
//Created new object
$user = new User();
$getUserById = $user->getUserById($id);


?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manager all user</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="p-4 d-flex justify-content-start align-items-center">
            <form action="action/edit_user.php" method="post" style="min-width: 70%;" enctype="multipart/form-data">
                <input type="number" name="user_id" value="<?= $id ?>" hidden>
                <div class="form-group">
                    <label for="fullname"><b>Fullname:</b></label>
                    <input type="text" class="form-control" name="fullname" value="<?=$getUserById[0]['fullname']?>" required>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label for="phone"><b>Phone:</b></label>
                            <input type="text" name="phone" class="form-control" value="<?=$getUserById[0]['phone']?>" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label for="email"><b>Email:</b></label>
                            <input type="email" name="email" class="form-control" value="<?=$getUserById[0]['email']?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description"><b>Description:</b></label>
                    <textarea name="description" class="form-control" placeholder="Enter note..." rows="5"><?=$getUserById[0]['description']?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php
include "./footer.php";
?>