<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 2/25/2019
 * Time: 9:18 PM
 */

if ($task->status == 'pending') {
    $color = '#FFFF00';
    $text_color = 'black';
}

if ($task->status == 'done') {
    $color = '#0000FF';
    $text_color = 'white';
}

if ($task->status == 'rejected') {
    $color = '#000000';
    $text_color = 'white';
}

if ($task->status == 'progress') {
    $color = '#35f235';
    $text_color = 'black';
}

if ($task->status == 'canceled') {
    $color = '#D62222';
    $text_color = 'white';
}

?>
<div class="modal-header">
    <h4 class="modal-title" id="mediumModalLabel">Task Status : <span style="background: <?= $color ?>;color:<?= $text_color ?>"><?= ucfirst($task->status) ?></span></h4>
    <div class="text-right">
        <small>Last updated : <?= date('d M Y H:i',strtotime($task->updated_at)) ?></small>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <div class="au-card recent-report" style="padding-top: 2%;margin-bottom: 3%;padding-bottom: 3%;margin-top: -2%">
                <div class="au-card-inner">
                    <div class="row" style="margin-bottom: 2%">
                        <div class="col-md-12">
                            <b>Category :</b> <br>
                            <?= ucfirst($task->category) ?>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 2%">
                        <div class="col-md-12">
                            <b>Title :</b> <br>
                            <?= ucfirst($task->remark) ?>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 2%">
                        <div class="col-md-12">
                            <b>Employee from :</b> <br>
                            (name of <?= ucfirst($task->user_from) ?>)
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 2%">
                        <div class="col-md-12">
                            <b>Employee to :</b> <br>
                            (name of <?= ucfirst($task->user_to) ?> )
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 2%">
                        <div class="col-md-12">
                            <b>Date from :</b> <br>
                            <?= date('d M Y',strtotime($task->date_from)) ?>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 2%">
                        <div class="col-md-12">
                            <b>Date to :</b> <br>
                            <?= date('d M Y',strtotime($task->date_to)) ?>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 2%">
                        <div class="col-md-12">
                            <b>Estimation day :</b> <br>
                            <?php
                            $start_date1 = date('Y-m-d', strtotime($task->date_from));
                            $end_date1 = date('Y-m-d', strtotime($task->date_to));

                            $start_date = new DateTime($start_date1);
                            $end_date = new DateTime($end_date1);
                            $interval = $start_date->diff($end_date);
                            ?>
                            <?= $interval->days ?>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 2%">
                        <div class="col-md-12">
                            <b>Description :</b> <br>

                            <?= nl2br(str_replace('  ', ' &nbsp;', htmlspecialchars($task->description))) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button id="<?= $task->id ?>" type="button" class="btn-sm manage btn btn-primary" style="width: 49%"><i class="fa fa-cogs"></i> Manage</button>
                            <button type="button" class="btn-sm btn btn-danger btn-close" style="width: 49%"><i class="fa fa-close"></i> Close</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".manage").click(function(){
        var id = $(this).attr('id');
        $.redirect("task/"+id, {}, "POST" , "_blank");
    });

    $(".btn-close").click(function(){
       $("#modal-info").modal("toggle");
    });
</script>