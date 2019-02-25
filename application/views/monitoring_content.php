<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 2/2/2019
 * Time: 3:56 PM
 */


?>
<div class="row">
    <div class="col-lg-12">
        <div class="au-card m-b-30">
            <div class="au-card-inner">
                <?php
                    $count_done = count((array)$done);
                    $count_progress = count((array)$progress);
                ?>
                <div id="container" style="min-width: 310px; height: 400px; margin-top: 0 auto"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive m-b-40">
            <table id="list-data" class="table table-borderless table-data3" style="width:100%">
                <thead>
                <tr>
                    <th scope="col">Start Date</th>
                    <th scope="col">Category</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Assign From</th>
                    <th scope="col">Status</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($done as $done) {
                ?>
                <tr>
                    <td><?= date('d M Y', strtotime($done->date_from))  ?></td>
                    <td><?= strtoupper($done->category) ?></td>
                    <td><?= ucfirst($done->remark) ?></td>
                    <td><?= ucfirst($done->description)  ?></td>
                    <td><?= ucfirst($done->user_from)  ?></td>
                    <td><?= ucfirst($done->status)  ?></td>
                </tr>
                <?php } ?>

                <?php
                foreach ($progress as $progress) {
                    ?>
                    <tr>
                        <td><?= date('d M Y', strtotime($progress->date_from))  ?></td>
                        <td><?= strtoupper($done->category) ?></td>
                        <td><?= ucfirst($progress->remark) ?></td>
                        <td><?= ucfirst($progress->description)  ?></td>
                        <td><?= ucfirst($progress->user_from)  ?></td>
                        <td><?= ucfirst($progress->status)  ?></td>
                    </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                    <th scope="col">Start Date</th>
                    <th scope="col">Category</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Assign From</th>
                    <th scope="col">Status</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<script>
    $('#list-data').DataTable();

    $(function () {
        Highcharts.setOptions({
            colors: ['#308dc5', '#50B432',]
        });

        Highcharts.chart('container', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Summary of '+ <?= $nik ?>+'\'s Tasks'
            },

            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b> : ' + this.point.y + ' ('+ Math.round(this.percentage*100)/100 + ' %)';
                        },

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
                    y: <?php echo json_encode($count_done,JSON_NUMERIC_CHECK) ?>,
                    sliced: true,
                    selected: true
                }, {
                    name: 'On Progress',
                    y: <?php echo json_encode(count($progress),JSON_NUMERIC_CHECK) ?>,
                }]
            }]
        });
    });
</script>
