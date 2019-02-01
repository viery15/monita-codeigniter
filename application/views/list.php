<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 1/30/2019
 * Time: 11:59 AM
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('_partials/head.php') ?>
</head>

<body id="page-top">

<?php $this->load->view("_partials/navbar.php") ?>
<div id="wrapper">

    <?php $this->load->view("_partials/sidebar.php") ?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <?php $this->load->view("_partials/breadcrumb.php") ?>

            <!-- DataTables -->
            <div class="card mb-3">
                <div class="card-header">
                    <a href="<?php echo site_url('admin/products/add') ?>"><i class="fas fa-plus"></i> Add New</a>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Photo</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td width="150">
                                        <?php echo $user->nik ?>
                                    </td>
                                    <td>
                                        <?php echo $user->role ?>
                                    </td>
                                    <td>

                                    </td>
                                    <td class="small">

                                    <td width="250">
                                        <a href="<?php echo site_url('admin/products/edit/'.$user->id) ?>"
                                           class="btn btn-small"><i class="fas fa-edit"></i> Edit</a>
                                        <a onclick="deleteConfirm('<?php echo site_url('admin/products/delete/'.$user->id) ?>')"
                                           href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <?php $this->load->view("_partials/footer.php") ?>

    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->


<?php $this->load->view("_partials/js.php") ?>

</body>

</html>
