<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 2/2/2019
 * Time: 9:59 AM
 */
?>

<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 1/31/2019
 * Time: 2:59 PM
 */
?>


<?php header('Access-Control-Allow-Origin: *'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("_partials/head.php") ?>
    <?php $this->load->view("_partials/js.php") ?>
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
                                <h2 class="title-1">My Tasks</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <br><br>
                                <button type="button" class="btn btn-info btn-create-req" data-toggle="modal" data-target="#modal-task"><i class="fa fa-plus"></i> Create New Task</button>
                                <br><br>
                                <div id="mytask-table-list">
                                    <?php $this->load->view("mytask_table_list.php") ?>
                                </div>
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
<div id="modal-task" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div id="content-modal"></div>
        </div>

    </div>
</div>

<!-- MODAL COMMENT-->
<div id="modal-comment" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div id="content-comment"></div>
        </div>
    </div>
</div>

<!-- Jquery JS-->
<script src="<?php echo base_url('js/main.js') ?>"></script>

</body>

</html>
<!-- end document-->
<script type="text/javascript">
    $(document).ready(function() {
        $('.btn-create-req').click(function(){
            $('#content-modal').load("<?php echo base_url(); ?>/Mytask/form_add");
        });
    });

</script>

