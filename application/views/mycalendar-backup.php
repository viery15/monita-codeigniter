<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 2/11/2019
 * Time: 3:21 PM
 */
?>

<?php header('Access-Control-Allow-Origin: *'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Calendar</title>
    <?php $this->load->view("_partials/head.php") ?>

    <?php $this->load->view("_partials/js.php") ?>
    <style type="text/css" >
        #container {
            max-width: 1200px;
            min-width: 800px;
            /* height: 400px; */
            margin: 1em auto;
        }
        .scrolling-container {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
    </style>
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
                                <h2 class="title-1">My Calendar</h2>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">Task Filter</div>
                                <div class="card-body">
                                    <form id="form-monitoring" novalidate="novalidate">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cc-payment" class="control-label mb-1">Category:</label>
                                                    <select class="select-category" id="category-form" name="category" required>
                                                        <option value="" disabled selected>Select Category</option>
                                                        <option value="all">All Category</option>
                                                        <?php
                                                        foreach ($category as $category) {
                                                            ?>
                                                            <option value="<?= $category->label?>"><?= $category->name ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cc-payment" class="control-label mb-1">Date Period:</label>
                                                    <input id="daterange" style="padding:0.5%" class="form-control" type="text" name="daterange" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 text-right">
                                                <button id="btn-submit" type="button" class="btn btn-md btn-info">
                                                    <span id="payment-button-amount">Submit</span>
                                                </button>

                                                <button id="excel" type="button" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Excel</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="calendar-content">

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
        <?php $this->load->view("_partials/copyright.php") ?>
    </div>
</div>

<!-- Jquery JS-->
<script src="<?php echo base_url('js/main.js') ?>"></script>

<div class="modal fade" id="modal-info" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div id="modal-info-body">

            </div>

        </div>
    </div>
</div>
</body>

</html>
<script type="text/javascript">
    $('input[name="daterange"]:eq(0)').daterangepicker();

    $(document).ready(function(){
        $(".select-category").select2({
            width: 'resolve'
        });

        $("#btn-submit").click(function(){
            var category = $("#category-form option:selected").val();
            var date_range = $('input[name="daterange"]:eq(0)').val();

            if(category == '') {
                alert("All required fields cannot be empty!");
            }
            else {
                $.ajax({
                    url: "<?php echo base_url(); ?>/Mycalendar/search/",
                    type: 'post',
                    data: {'category': category, 'date_range': date_range},
                    success: function (html) {
                        $("#calendar-content").html(html);
                    }
                });
            }
        });

        $("#excel").click(function(){
            var date_range = $('input[name="daterange"]:eq(0)').val();
            var category = $("#category-form option:selected").val();
            $.redirect("Mycalendar/excel", {date_range: date_range, category:category}, "POST");
        });
    });
</script>
<!-- end document-->
