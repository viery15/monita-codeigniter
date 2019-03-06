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

$year_from = date('Y', strtotime($date_from));
$year_to = date('Y', strtotime($date_to));
?>
<html>
    <head>
        <style type="text/css">
            .table-scroll {
                position:relative;
                /*max-width:805px;*/
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
    <div class="au-card m-b-30">
        <div class="au-card-inner">
            <div style="text-align: center">
                <h4>Task of <?= $this->session->nik ?> (per <?= date('d M Y', strtotime($date_from))  ?> - <?= date('d M Y', strtotime($date_to)) ?>)</h4>
            </div><br>
            <div id="table-scroll" class="table-scroll" style="font-size: 15px">
                <div class="table-wrap">
                    <table class="main-table">
                        <thead>
                        <tr>
                            <th style="vertical-align: middle" class="fixed-side" scope="col" rowspan="2">No</th>
                            <th style="vertical-align: middle" class="fixed-side" scope="col" rowspan="2">Category</th>
                            <th style="vertical-align: middle" class="fixed-side" scope="col" rowspan="2">Title</th>
                            <th style="vertical-align: middle" scope="col" rowspan="2">Info</th>
                            <?php
                            $real_month_to = $month_to;
                            $real_month_from = $month_from;
                            for($y = $year_from; $y <= $year_to; $y++) {
                                if ($y < $year_to) {
                                    $month_to = 12;
                                }
                                else {
                                    if(isset($real_month_to)){
                                        $month_to = $real_month_to;
                                    }
                                }
                                for ($m = $month_from; $m <= $month_to; $m++) {
                                    ?>
                                    <?php
//                            if ($year_to != $year_from && $y == $year_to && $m < $month_to && $m > $month_from){
//                                $date = new DateTime($y.'-' . $m);
//                                $date->modify('last day of this month');
//                                $count_date = $date->format('d');
//                                $colspan = $count_date;
//                            }

                                    if ($year_to != $year_from && $y == $year_from && $m > $month_from){
                                        $date = new DateTime($y.'-' . $m);
                                        $date->modify('last day of this month');
                                        $count_date = $date->format('d');
                                        $colspan = $count_date;
                                    }

                                    if ($year_to != $year_from && $y == $year_from && $m == $month_from){
                                        $date = new DateTime($y.'-' . $m);
                                        $date->modify('last day of this month');
                                        $count_date = $date->format('d');
                                        $colspan = ($count_date - $day_from) + 1;
                                    }

                                    if ($year_to != $year_from && $m < $month_to && $y == $year_to){
                                        $date = new DateTime($y.'-' . $m);
                                        $date->modify('last day of this month');
                                        $count_date = $date->format('d');
                                        $colspan = $count_date;
                                    }

                                    if ($year_to != $year_from && $y == $year_to && $m == $month_to){
                                        $colspan = $day_to;
                                    }

                                    if ($m > $month_from && $m < $month_to && $year_to == $year_from) {
                                        $date = new DateTime($y.'-' . $m);
                                        $date->modify('last day of this month');
                                        $count_date = $date->format('d');
                                        $colspan = $count_date;
                                    }

                                    if ($month_to == $month_from && $year_to == $year_from) {
                                        $colspan = ($day_to - $day_from) + 1;
                                    }

                                    if ($m == $month_from && $month_to > $month_from && $year_to == $year_from) {
                                        $date = new DateTime($y.'-' . $m);
                                        $date->modify('last day of this month');
                                        $count_date = $date->format('d');
                                        $colspan = $count_date;
                                    }

                                    if ($m == $month_to && $month_to > $month_from && $year_to == $year_from) {
                                        $colspan = $day_to;
                                    }
                                    if ($m == $month_from && $month_to > $month_from && $year_to == $year_from) {
                                        $date = new DateTime($y.'-' . $m);
                                        $date->modify('last day of this month');
                                        $count_date = $date->format('d');
                                        $colspan = ($count_date - $day_from) + 1;
                                    }
                                    if ($m == $month_from && $month_to == $month_from && $year_to == $year_from) {
                                        $colspan = $day_to;
                                    }
                                    ?>
                                    <th scope="col" colspan="<?= $colspan ?>"
                                        style="text-align: center"><?= date('M Y', strtotime($y . '-' . $m)) ?></th>
                                    <?php
                                    if ($m == $month_to && $y != $year_to) {
                                        $month_from = 1;
                                    }
                                }
                            }
                            ?>
                        </tr>
                        <tr>
                            <?php
                            $ii = 0;
                            $real_day_to = $day_to;
                            $real_day_from = $day_from;
                            $month_from = date('n', strtotime($date_from));
                            $month_to = date('n', strtotime($date_to));
                            for ($y = $year_from; $y <= $year_to; $y++) {
                                if ($y < $year_to) {
                                    $month_to = 12;
                                }
                                else {
                                    if(isset($real_month_to)){
                                        $month_to = $real_month_to;
                                    }
                                }
                                for ($m = $month_from; $m <= $month_to; $m++) {
                                    //TAHUN TERAKHIR
                                    if ($year_from!= $year_to && $y == $year_to && $m == $month_to){
                                        $date = new DateTime($y.'-' . $m);
                                        $date->modify('last day of this month');
                                        $day_to = $real_day_to;
                                        $day_from = 1;
                                    }
//
                                    if ($year_from!= $year_to && $y == $year_to && $m != $month_to){
                                        $date = new DateTime($y.'-' . $m);
                                        $date->modify('last day of this month');
                                        $day_to = $date->format('d');
                                        $day_from = 1;
                                    }

                                    //TAHUN AWAL

                                    if ($year_from!= $year_to && $y == $year_from && $m > $month_from){
                                        $date = new DateTime($y.'-' . $m);
                                        $date->modify('last day of this month');
                                        $day_to = $date->format('d');
                                        $day_from = 1;
                                    }
//
                                    elseif ($year_from!= $year_to && $y == $year_from && $m == $month_from){
                                        $date = new DateTime($y.'-' . $m);
                                        $date->modify('last day of this month');
                                        $day_to = $date->format('d');
//                                    $day_from = 1;
                                    }

                                    // SATU TAHUN

                                    elseif ($m > $month_from && $m < $month_to && $year_to == $year_from) {
                                        $date = new DateTime($y.'-' . $m);
                                        $date->modify('last day of this month');
                                        $day_to = $date->format('d');
                                        $day_from = 1;
                                    }
                                    elseif ($m == $month_from && $month_from < $month_to && $year_to == $year_from ) {
                                        $date = new DateTime($y.'-' . $m);
                                        $date->modify('last day of this month');
                                        $day_to = $date->format('d');
                                    }

                                    elseif ($month_from == $month_to && $year_to == $year_from) {
                                        $day_to = $real_day_to;
                                    }
                                    elseif ($m == $month_to && $year_to == $year_from) {
                                        $day_to = $real_day_to;
                                        $day_from = 1;
                                    }
                                    for ($i = $day_from; $i <= $day_to; $i++) {
                                        $data_date[$ii] = date('d-m-Y', strtotime($i.'-'.$m.'-'.$y));
                                        $ii++;
                                        ?>
                                        <?php
                                        if (date('D', strtotime($i.'-'.$m.'-'.$y)) == 'Sun' || date('D', strtotime($i.'-'.$m.'-'.$y)) == 'Sat'){
                                        ?>
                                        <td style="background-color: red;color:white"><?= $i ?></td>
                                        <?php } else {?>
                                            <td><?= $i ?></td>
                                        <?php }
                                    }
                                    if ($m == $month_to && $y != $year_to){
                                        $month_from = 1;
                                    }
                                }
                            }
                            ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $num = 1;
                        foreach ($task as $task){
                        if ($task->status == 'progress'){
                            $color = '#35f235';
                        }
                        if ($task->status == 'pending'){
                            $color = '#FFFF00';
                        }
                        if ($task->status == 'done'){
                            $color = '#0000FF';
                        }
                        if ($task->status == 'rejected'){
                            $color = '#000000';
                        }
                        if ($task->status == 'canceled'){
                            $color = '#D62222';
                        }
                        ?>
                        <tr>
                            <td class="fixed-side" ><?= $num ?></td>
                            <td class="fixed-side" ><?=  strtoupper($task->category) ?></td>
                            <td class="fixed-side" ><?=  ucfirst($task->remark) ?></td>
                            <td style="color: <?= $color ?>"><button type="button" id="<?= $task->id ?>" data-toggle="modal" data-target="#modal-info" class="btn btn-info btn-sm btn-detail"><i class="fa fa-eye"></i></button></td>
                            <?php
                            for ($i=0; $i < count($data_date); $i++){
                                ?>

                                <?php
                                if (date('D',strtotime($data_date[$i])) == 'Sun' || date('D',strtotime($data_date[$i])) == 'Sat'){
                                    ?>
                                    <td style="background-color: red"></td>


                                <?php }
                                elseif (strtotime($data_date[$i]) >= strtotime($task->date_from) && strtotime($data_date[$i]) <= strtotime($task->date_to)) {

                                ?>
                                    <td style="background-color: <?= $color ?>"></td>
                                <?php }else { ?>
                                    <td></td>
                                    <?php
                                } }$num++; }
                            ?>
                        </tr>
                        <?php  ?>
                    </table>
                </div>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-md-2">
                <span style="background-color: red">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>  : Weekend
            </div>
            <div class="col-md-2">
                <span style="background-color: #0000FF">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>  : Done
            </div>
            <div class="col-md-2">
                <span style="background-color: #FFFF00">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>  : Pending
            </div>
            <div class="col-md-2">
                <span style="background-color: #35f235">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>  : Progress
            </div>
            <div class="col-md-2">
                <span style="background-color: #D62222">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>  : Cancelled
            </div>
            <div class="col-md-2">
                <span style="background-color: black">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>  : Rejected
            </div>

        </div>
        <br>
        <div class="row">
            <div class="col-md-12" style="color: red">
                * The work days is excluded leave and national holiday
            </div>
        </div>
    </div>

    </body>
</html>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery(".main-table").clone(true).appendTo('#table-scroll').addClass('clone');
    });

    $(".btn-detail").click(function(){
        var id = $(this).attr('id');
        $('#modal-info-body').load("<?php echo base_url(); ?>/Mycalendar/info/"+id);
    });
</script>
