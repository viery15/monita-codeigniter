<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 2/5/2019
 * Time: 10:42 AM
 */
?>

<?php header('Access-Control-Allow-Origin: *'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
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
            <?php
                $count_task_done = count((array)$task_done);
                $count_task_pending = count((array)$task_pending);
                $count_task_progress = count((array)$task_progress);
                $count_task_rejected = count((array)$task_rejected);

                $count_req_done = count((array)$req_done);
                $count_req_pending = count((array)$req_pending);
                $count_req_progress = count((array)$req_progress);
                $count_req_rejected = count((array)$req_rejected);

            ?>
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="overview-wrap">
                                <h2 class="title-1">Dashboard</h2>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="au-card m-b-30">
                                <div class="au-card-inner">
                                    <div id="chart-mytask" style="min-width: 400px; height: 400px; margin-top: 0 auto"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="au-card m-b-30">
                                <div class="au-card-inner">
                                    <div id="chart-myrequest" style="min-width: 400px; height: 400px; margin-top: 0 auto"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="timeline-dashboard">
                    <?php $this->load->view("dashboard_timeline.php") ?>
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
<div id="modal-task" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">

            <div id="content-modal2"></div>

        </div>

    </div>
</div>

<div class="modal fade" id="modal-comment" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="content-modal-comment"></div>
        </div>
    </div>
</div>
<!-- Jquery JS-->
<script src="<?php echo base_url('js/main.js') ?>"></script>
</body>

</html>
<!-- end document-->
<script>
    $(function () {
        Highcharts.setOptions({
            colors: ['#50B432', '#308dc5', '#608dc5', '#108dc5']
        });

        Highcharts.chart('chart-mytask', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Summary of '+ <?= $this->session->nik ?>+'\'s Tasks'
            },

            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    size: 200,
                    dataLabels: {
                        enabled: true,
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: ' + this.point.y + ' ('+ Math.round(this.percentage*100)/100 + ' %)';
                        },
                        distance: 1,

                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                name: 'Count',
                colorByPoint: true,
                data: [{
                    name: 'Done',
                    y: <?php echo json_encode($count_task_done,JSON_NUMERIC_CHECK) ?>,
                    sliced: true,
                    selected: true
                }, {
                    name: 'On Progress',
                    y: <?php echo json_encode($count_task_progress,JSON_NUMERIC_CHECK) ?>,
                },
                {
                    name: 'Pending',
                    y: <?php echo json_encode($count_task_pending,JSON_NUMERIC_CHECK) ?>,
                },
                {
                    name: 'Unapproved',
                    y: <?php echo json_encode($count_task_rejected,JSON_NUMERIC_CHECK) ?>,
                }]
            }]
        });
    });
</script>

<script>
    $(function () {
        Highcharts.setOptions({
            colors: ['#50B432', '#308dc5', '#608dc5', '#108dc5']
        });

        Highcharts.chart('chart-myrequest', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Summary of '+ <?= $this->session->nik ?>+'\'s Requests'
            },

            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    size: 200,
                    dataLabels: {
                        enabled: true,
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: ' + this.point.y + ' ('+ Math.round(this.percentage*100)/100 + ' %)';
                        },
                        distance: 1,

                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                name: 'Count',
                colorByPoint: true,
                data: [{
                    name: 'Done',
                    y: <?php echo json_encode($count_req_done,JSON_NUMERIC_CHECK) ?>,
                    sliced: true,
                    selected: true
                }, {
                    name: 'On Progress',
                    y: <?php echo json_encode($count_req_progress,JSON_NUMERIC_CHECK) ?>,
                },
                    {
                    name: 'Pending',
                    y: <?php echo json_encode($count_req_pending,JSON_NUMERIC_CHECK) ?>,
                },
                {
                    name: 'Unapproved',
                    y: <?php echo json_encode($count_req_rejected,JSON_NUMERIC_CHECK) ?>,
                }]
            }]
        });
    });
</script>
