<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 2/14/2019
 * Time: 2:34 PM
 */


?>
<html>
    <head>

    </head>
    <body>

                <div class="table-responsive">
                    <table id="example" class="table table-hover table-data3 table-bordered">
                      <thead>
                      <tr>
                        <th rowspan="2" style="vertical-align: middle;text-align: center;padding:0px">Ctg</th>
                        <th rowspan="2" style="vertical-align: middle;text-align: center;">Title</th>
                        <th rowspan="2" style="vertical-align: middle;text-align: center;padding:0px">Info</th>
                        <th colspan="12" style="text-align: center"><?= $year ?></th>
                      </tr>
                      <tr>
                        <th style="padding:14px">Jan</th>
                        <th style="padding:14px">Feb</th>
                        <th style="padding:14px">Mar</th>
                        <th style="padding:14px">Apr</th>
                        <th style="padding:14px">Mei</th>
                        <th style="padding:14px">Jun</th>
                        <th style="padding:14px">Jul</th>
                        <th style="padding:14px">Ags</th>
                        <th style="padding:14px">Sep</th>
                        <th style="padding:14px">Okt</th>
                        <th style="padding:14px">Nov</th>
                        <th style="padding:14px">Dec</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php foreach ($task as $task): ?>
                        <?php
                        if ($task->status == 'progress'){
                            $color = '#35f235';
                            $font_color = "black";
                        }
                        if ($task->status == 'pending'){
                            $color = '#FFFF00';
                            $font_color = "black";
                        }
                        if ($task->status == 'done'){
                            $color = '#0000FF';
                            $font_color = "white";
                        }
                        if ($task->status == 'rejected'){
                            $color = '#000000';
                            $font_color = "white";
                        }
                        if ($task->status == 'canceled'){
                            $color = '#D62222';
                            $font_color = "white";
                        }
                        ?>
                        <tr>
                          <td><?= strtoupper($task->category) ?></td>
                          <td><?= $task->remark ?></td>
                          <td style="text-align:center"><button data-toggle="modal" data-target="#modal-info" id="<?= $task->id ?>" type="button" class="btn-detail btn btn-info btn-sm"><i class="fa fa-search"></i></button></td>
                          <?php for ($i=1; $i <= 12; $i++) {
                            $month_from = date('n', strtotime($task->date_from));
                            $month_to = date('n', strtotime($task->date_to));

                            if ($i >= $month_from && $i <= $month_to) {
                          ?>
                            <td style="background-color:<?= $color ?>"></td>
                          <?php
                            }
                            else { ?>
                              <td>&nbsp;</td>
                          <?php } } ?>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                    </table>
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
    $('#example').DataTable({

    });
    jQuery(document).ready(function() {
        jQuery(".main-table").clone(true).appendTo('#table-scroll').addClass('clone');
    });

    $("#example").on("click", ".btn-detail", function(){
        var id = $(this).attr('id');
        $('#modal-info-body').load("<?php echo base_url(); ?>/Mycalendar/info/"+id);
    });
</script>
