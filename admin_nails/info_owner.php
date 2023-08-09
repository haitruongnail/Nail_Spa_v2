<?php
include_once "./header.php";
require_once "../model/info_owner.php";

$owner = new InfoOwner();
$getAllInfo = $owner->getAllInfo();
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Home Page</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Information of owner company</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Logo</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Time Active</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($getAllInfo as $item) {
                        ?>
                            <tr>
                                <td><?= $item['company_name'] ?></td>
                                <td>
                                    <img src="../template_nails/img/owner/<?= $item['logo_company'] ?>" width="200px" height="200px" alt="<?= $item['logo_company'] ?>">
                                </td>
                                <td><?= $item['phone'] ?></td>
                                <td><?= $item['address'] ?></td>
                                <td><?= $item['time_start'] ?> - <?= $item['time_end'] ?></td>
                                <td><a href="./edit_owner.php?id=<?=$item['id']?>" class="icon edit"><i class='bx bx-edit'></i></a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- End of Content Wrapper -->
<?php include_once "./footer.php"; ?>