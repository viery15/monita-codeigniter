<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 2/2/2019
 * Time: 1:13 PM
 */
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Monitoring</title>
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
                                <h2 class="title-1">Monitoring</h2>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">Employee To Monitoring</div>
                                <div class="card-body">
                                    <form id="form-monitoring" novalidate="novalidate">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">NIK:</label>
                                            <select class="select-nik" id="nik-form" name="user_from" required>
                                                <option disabled selected>Select NIK</option>
                                                <?php
                                                foreach ($users as $user) {
                                                    ?>
                                                    <option value="<?= $user->nik?>"><?= $user->nik ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Filter by:</label><br>
                                            <label class="radio-inline">
                                                <input class="type" value="all" type="radio" name="radio" checked>All &nbsp;&nbsp;&nbsp;
                                            </label>
                                            <label class="radio-inline">
                                                <input class="type" value="mytask" type="radio" name="radio">Only mytask &nbsp;&nbsp;&nbsp;
                                            </label>
                                            <label class="radio-inline">
                                                <input class="type" value="myrequest" type="radio" name="radio">Only myrequest
                                            </label>
                                        </div>
                                        <div>
                                            <button id="btn-submit" type="button" class="btn btn-md btn-info">
                                                <span id="payment-button-amount">Submit</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="content-monitoring"></div>

                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
        <?php $this->load->view("_partials/copyright.php") ?>
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
        $(".select-nik").select2({
            width: 'resolve'
        });

        $("#btn-submit").click(function(){
            var nik = $("#nik-form option:selected").val();
            var type = $(".type:checked").val();
           $.ajax({
               url : "<?php echo base_url(); ?>/Monitoring/search/"+nik,
               data : {'nik':nik,'type':type},
               success : function (html) {
                   $("#content-monitoring").html(html);
               }
           });
        });
    });
</script>

