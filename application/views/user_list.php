
<?php header('Access-Control-Allow-Origin: *'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("_partials/head.php") ?>
</head>

<body>
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <?php $this->load->view("_partials/navbar.php") ?>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <?php $this->load->view("_partials/sidebar.php") ?>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <?php $this->load->view("_partials/nav_desktop.php") ?>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Users</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="table-responsive">
                                <br><br>
                                <button type="button" class="btn btn-info btn-create" data-toggle="modal" data-target="#modal-user"><i class="fa fa-plus"></i> Create New User</button>
                                <br><br>
                                <table id="example" class="display nowrap" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>NIK</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($users as $user) {
                                    ?>
                                    <tr>
                                        <td><?= $user->nik ?></td>
                                        <td><?= ucfirst($user->role) ?></td>
                                        <td width="20%">
                                            <button type="button" class="btn btn-warning btn-update" data-toggle="modal" data-target="#modal-user" id="<?= $user->id ?>"><i class="fa fa-pencil-square-o"></i></button>
                                            <button type="button" class="btn btn-danger btn-delete" id="<?= $user->id ?>"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>NIK</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>
    </div>

    <!-- MODAL-->
    <div id="modal-user" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">

                <div id="content-modal"></div>

            </div>

        </div>
    </div>

    <!-- Jquery JS-->
    <?php $this->load->view("_partials/js.php") ?>

</body>

</html>
<!-- end document-->
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                extend: 'pdf',
                title: 'Customized PDF Title',
                filename: 'customized_pdf_file_name'
            }, {
                extend: 'excel',
                title: 'Customized EXCEL Title',
                filename: 'customized_excel_file_name'
            }, {
                extend: 'csv',
                filename: 'customized_csv_file_name'
            }]
        });

        $('.btn-delete').click(function(){
            var id = $(this).attr('id');
            if (confirm('Are you sure you want to delete this?')) {
                $.ajax({
                    url: "<?php echo base_url(); ?>/Users/delete",
                    type: 'post',
                    data: {'id': id},
                    success: function (a) {
                        location.reload();
                    }
                });
            }
        });

        $('.btn-create').click(function(){
            $('#content-modal').load("<?php echo base_url(); ?>/Users/form_add");
        });

        $('.btn-update').click(function(){
            var id = $(this).attr('id');
//            alert(id);
            $('#content-modal').load("<?php echo base_url(); ?>/Users/form_update/"+id);
        });
    });

</script>
