<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 2/14/2019
 * Time: 2:34 PM
 */

$day_from = date('j', strtotime($date_from));
$day_to = date('j', strtotime($date_to));
///
$month_from = date('n', strtotime($date_from));
$month_to = date('n', strtotime($date_to));

$year_from = date('o', strtotime($date_from));
$year_to = date('o', strtotime($date_to));
?>
<html>
    <head>
        <style type="text/css">
            .table-scroll {
                position:relative;
                max-width:805px;
                margin:auto;
                overflow:hidden;
                border:1px solid #000;
            }
            .table-wrap {
                width:100%;
                overflow:auto;
            }
            .table-scroll table {
                /*width:100%;*/
                margin:auto;
                border-collapse:separate;
                border-spacing:0;
            }
            .table-scroll th, .table-scroll td {
                padding:5px 10px;
                border:1px solid #000;
                background:#fff;
                white-space:nowrap;
                vertical-align:top;
            }
            .table-scroll thead, .table-scroll tfoot {
                background:#f9f9f9;
            }
            .clone {
                position:absolute;
                top:0;
                left:0;
                pointer-events:none;
            }
            .clone th, .clone td {
                visibility:hidden
            }
            .clone td, .clone th {
                border-color:transparent
            }
            .clone tbody th {
                visibility:visible;
                color:red;
            }
            .clone .fixed-side {
                border:1px solid #000;
                background:#eee;
                visibility:visible;
            }
            .clone thead, .clone tfoot{background:transparent;}
        </style>
    </head>
    <body>
    <div id="table-scroll" class="table-scroll" style="font-size: 15px">
        <div class="table-wrap">
            <?php
//            print_r($date_to);
            ?>
            <table class="main-table">
                <thead>
                <tr>
                    <th class="fixed-side" scope="col" rowspan="2">No</th>
                    <th class="fixed-side" scope="col" rowspan="2">Category</th>
                    <th scope="col" rowspan="2">Remark</th>
                    <th scope="col" rowspan="2">Description</th>
                    <th scope="col" rowspan="2">Date Start</th>
                    <th scope="col" rowspan="2">Date End</th>
                    <th scope="col" rowspan="2">Status</th>
                    <?php

                            for ($m = $month_from; $m <= $month_to; $m++) {
                                ?>
                                <?php
                                if ($m > $month_from && $m < $month_to) {
                                    $date = new DateTime('2019-' . $m);
                                    $date->modify('last day of this month');
                                    $count_date = $date->format('d');
                                    $colspan = $count_date;
                                }
                                if ($month_to == $month_from) {
                                    $colspan = ($day_to - $day_from) + 1;
                                }
                                if ($m == $month_from && $month_to > $month_from) {
                                    $date = new DateTime('2019-' . $m);
                                    $date->modify('last day of this month');
                                    $count_date = $date->format('d');
                                    $colspan = $count_date;
                                }

                                if ($m == $month_to && $month_to > $month_from) {
                                    $colspan = $day_to;
                                }
                                if ($m == $month_from && $month_to > $month_from) {
                                    $date = new DateTime('2019-' . $m);
                                    $date->modify('last day of this month');
                                    $count_date = $date->format('d');
                                    $colspan = ($count_date - $day_from)+1;
                                }
                                if ($m == $month_from && $month_to == $month_from) {
                                    $colspan = $day_to;
                                }
                                ?>
                                <th scope="col" colspan="<?= $colspan ?>" style="text-align: center"><?= date('M Y', strtotime($year_from . '-' . $m)) ?></th>
                                <?php

                            }
                    ?>
                </tr>
                <tr>
                    <?php
                        $real_day_to = $day_to;
                            for ($m = $month_from; $m <= $month_to; $m++){
                                if ($m > $month_from && $m < $month_to) {
                                    $date = new DateTime('2019-' . $m);
                                    $date->modify('last day of this month');
                                    $day_to = $date->format('d');
                                    $day_from = 1;
                                }
                                if ($m == $month_from && $month_from < $month_to) {
                                    $date = new DateTime('2019-' . $m);
                                    $date->modify('last day of this month');
                                    $day_to = $date->format('d');
                                }

                                if ($month_from == $month_to){
                                    $day_to = $real_day_to;
                                }
                                if ($m == $month_to){
                                    $day_to = $real_day_to;
                                    $day_from = 1;
                                }
                                for ($i=$day_from; $i <= $day_to ; $i++){
                    ?>
                                    <td><?= $i ?></td>
                    <?php
                                }
                            }
                    ?>
                </tr>

                </thead>
                <tbody>
                <?php
                    $num = 1;
                    foreach ($task as $task){
                ?>
                <tr>
                    <td class="fixed-side"><?= $num ?></td>
                    <td class="fixed-side"><?=  $task->category ?></td>
                    <td ><?=  $task->remark ?></td>
                    <td><?=  $task->description ?></td>
                    <td><?=  date('d M Y', strtotime($task->date_from)) ?></td>
                    <td><?=  date('d M Y', strtotime($task->date_to)) ?></td>
                    <td><?=  $task->status ?></td>
                </tr>
                <?php $num++; } ?>
            </table>
        </div>
    </div>
    </body>
</html>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery(".main-table").clone(true).appendTo('#table-scroll').addClass('clone');
    });
</script>