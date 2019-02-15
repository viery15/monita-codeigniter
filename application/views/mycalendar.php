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

    <script src="https://code.highcharts.com/gantt/highcharts-gantt.js"></script>
    <script src="https://code.highcharts.com/gantt/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/stock/modules/stock.js"></script>
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
                    <br><br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">Search by category</div>
                                <div class="card-body">
                                    <form id="form-monitoring" novalidate="novalidate">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Category:</label>
                                            <select class="select-category" id="category-form" name="category" required>
                                                <option disabled selected>Select Category</option>
                                                <?php
                                                foreach ($category as $category) {
                                                    ?>
                                                    <option value="<?= $category->label?>"><?= $category->name ?></option>
                                                <?php } ?>
                                            </select>
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
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="au-card m-b-30">
                                <div class="au-card-inner">
                                    <div id="calendar-content">
                                        <?php $this->load->view("mycalendar_content.php") ?>
                                    </div>
                                </div>
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

</body>

</html>
<script type="text/javascript">

    $(document).ready(function(){
        $(".select-category").select2({
            width: 'resolve'
        });

        $("#btn-submit").click(function(){
            var category = $("#category-form option:selected").val();
            $.ajax({
                url : "<?php echo base_url(); ?>/Mycalendar/search/"+category,
                success : function (html) {
                    $("#calendar-content").html(html);
                }
            });
        });
    });
</script>
<!-- end document-->

