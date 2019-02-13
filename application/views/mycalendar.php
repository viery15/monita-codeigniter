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
                            <div class="au-card m-b-30">
                                <div class="au-card-inner">
                                    <div id="container"></div>
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
<div id="modal-user" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">

            <div id="content-modal"></div>

        </div>

    </div>
</div>

<!-- Jquery JS-->
<script src="<?php echo base_url('js/main.js') ?>"></script>

</body>

</html>
<!-- end document-->
<script type="text/javascript">
    // Set to 00:00:00:000 today
    var today = new Date(),
        day = 1000 * 60 * 60 * 24,
        map = Highcharts.map,
        dateFormat = Highcharts.dateFormat,
        series,
        cars;

    // Set to 00:00:00:000 today
    today.setUTCHours(0);
    today.setUTCMinutes(0);
    today.setUTCSeconds(0);
    today.setUTCMilliseconds(0);
    today = today.getTime();

    cars = [{
        model: 'Nissan Leaf',
        current: 0,
        deals: [{
            rentedTo: 'Lisa Star',
            from: today - 1 * day,
            to: today + 5 * day
        }, {
            rentedTo: 'Shane Long',
            from: today - 1 * day,
            to: today + 5 * day
        }, {
            rentedTo: 'Jack Coleman',
            from: today + 9 * day,
            to: today + 360 * day
        }]
    }, {
        model: 'Jaguar E-type',
        current: 0,
        deals: [{
            rentedTo: 'Martin Hammond',
            from: today - 2 * day,
            to: today + 1 * day
        }, {
            rentedTo: 'Linda Jackson',
            from: today - 2 * day,
            to: today + 1 * day
        }, {
            rentedTo: 'Robert Sailor',
            from: today + 2 * day,
            to: today + 6 * day
        }]
    }, {
        model: 'Volvo V60',
        current: 0,
        deals: [{
            rentedTo: 'Mona Ricci',
            from: today + 0 * day,
            to: today + 3 * day
        }, {
            rentedTo: 'Jane Dockerman',
            from: today + 3 * day,
            to: today + 4 * day
        }, {
            rentedTo: 'Bob Shurro',
            from: today + 6 * day,
            to: today + 8 * day
        }]
    }, {
        model: 'Volkswagen Golf',
        current: 0,
        deals: [{
            rentedTo: 'Hailie Marshall',
            from: today - 1 * day,
            to: today + 1 * day
        }, {
            rentedTo: 'Morgan Nicholson',
            from: today - 3 * day,
            to: today - 2 * day
        }, {
            rentedTo: 'William Harriet',
            from: today + 2 * day,
            to: today + 3 * day
        }]
    }, {
        model: 'Peugeot 208',
        current: 0,
        deals: [{
            rentedTo: 'Harry Peterson',
            from: today - 1 * day,
            to: today + 2 * day
        }, {
            rentedTo: 'Emma Wilson',
            from: today + 3 * day,
            to: today + 4 * day
        }, {
            rentedTo: 'Ron Donald',
            from: today + 5 * day,
            to: today + 6 * day
        }]
    }];

    // Parse car data into series.
    series = cars.map(function (car, i) {
        var data = car.deals.map(function (deal) {
            return {
                id: 'deal-' + i,
                rentedTo: deal.rentedTo,
                start: deal.from,
                end: deal.to,
                y: i
            };
        });
        return {
            name: car.model,
            data: data,
            current: car.deals[car.current]
        };
    });

    Highcharts.ganttChart('container', {
        series: series,
        title: {
            text: 'Car Rental Schedule'
        },
        tooltip: {
            pointFormat: '<span>Rented To: {point.rentedTo}</span><br/><span>From: {point.start:%e. %b}</span><br/><span>To: {point.end:%e. %b}</span>'
        },
        navigator: {
            enabled: true,
            liveRedraw: true,
            series: {
                type: 'gantt',
                pointPlacement: 0.5,
                pointPadding: 0.25
            },
            yAxis: {
                min: 0,
                max: 3,
                reversed: true,
                categories: []
            }
        },
        scrollbar: {
            enabled: true
        },
        rangeSelector: {
            enabled: true,
            selected: 0
        },
        xAxis: {
            currentDateIndicator: true
        },
        yAxis: {
            type: 'category',
            grid: {
                columns: [{
                    title: {
                        text: 'Model'
                    },
                    categories: map(series, function (s) {
                        return s.name;
                    })
                }, {
                    title: {
                        text: 'Rented To'
                    },
                    categories: map(series, function (s) {
                        return s.current.rentedTo;
                    })
                }]
            }
        }
    });
</script>
