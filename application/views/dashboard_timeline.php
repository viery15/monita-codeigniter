<?php
    $count_mytask = count((array)$mytask);
    $count_myrequest = count((array)$myrequest);

?>
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
<div class="row">
<!--    TIMELINE MY TASKS-->
    <div class="col-lg-6">
        <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
            <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');padding-top: 10px;padding-bottom: 10px">
                <div class="bg-overlay bg-overlay--blue"></div>
                <h3>
                    <i class="fa fa-tasks"></i>MY TASKS</h3>
                <button class="au-btn-plus" id="btn-add-task" data-toggle="modal" data-target="#modal-task">
                    <i class="zmdi zmdi-plus"></i>
                </button>
            </div>
            <div class="au-task js-list-load">
                <?php
                if ($mytask == NULL) {
                    ?>
                    <div  class="au-task__item au-task__item">
                        <div class="au-task__item-inner">
                            <h5 class="task" style="font-weight: normal;">
                                Data not found
                            </h5>
                        </div>
                    </div>
                <?php } ?>

                <?php
                    foreach ($mytask as $mytask) {
                ?>

                    <?php
                    if ($mytask->status == 'progress') {

                    ?>
                    <div class="au-task__item au-task__item--success">
                    <?php } ?>

                    <?php
                    if ($mytask->status == 'done') {

                    ?>
                    <div class="au-task__item au-task__item--primary">
                    <?php } ?>

                    <?php
                    if ($mytask->status == 'pending') {

                    ?>
                    <div class="au-task__item au-task__item--warning">
                    <?php } ?>

                    <?php
                    if ($mytask->status == 'canceled') {

                    ?>
                    <div class="au-task__item au-task__item--danger">
                    <?php } ?>

                    <?php
                    if ($mytask->status == 'rejected') {

                    ?>
                    <div class="au-task__item au-task__item--danger">
                    <?php } ?>

                        <div class="au-task__item-inner">
                            <h5 class="task">
                                <b><?= $mytask->remark ?></b> <br>
                            </h5>
                            <h6 style="font-weight: normal"><?= nl2br(str_replace('  ', ' &nbsp;', htmlspecialchars($mytask->description))); ?></h6>
                            <span class="time"><small><i class="fa fa-tags"></i> <?= $mytask->category ?></small></span>
                            <span class="time"><small><i class="fa fa-user"></i> <?= $mytask->user_from ?></small></span>
                            <span class="time"><small><i class="fa fa-clock"></i> <?= date('d M Y h:i a', strtotime($mytask->updated_at)) ?></small></span>

                            <?php
                            if ($mytask->status == 'done') {
                            ?>
                            <span class="time" style="color: #0000FF"><small><i class="fa fa-exclamation-triangle"></i> <?= $mytask->status ?></small></span><br><br>
                            <?php } ?>

                            <?php
                            if ($mytask->status == 'progress') {
                                ?>
                                <span class="time" style="color: #35f235"><small><i class="fa fa-exclamation-triangle"></i> <?= $mytask->status ?></small></span><br><br>
                            <?php } ?>

                            <?php
                            if ($mytask->status == 'canceled') {
                                ?>
                                <span class="time" style="color: #D62222"><small><i class="fa fa-exclamation-triangle"></i> <?= $mytask->status ?></small></span><br><br>
                            <?php } ?>

                            <?php
                            if ($mytask->status == 'pending') {
                                ?>
                                <span class="time" style="color: #ffa037"><small><i class="fa fa-exclamation-triangle"></i> <?= $mytask->status ?></small></span><br><br>
                            <?php } ?>

                            <?php
                            if ($mytask->status == 'rejected') {
                                ?>
                                <span class="time" style="color: #000000"><small><i class="fa fa-exclamation-triangle"></i> <?= $mytask->status ?></small></span><br><br>
                            <?php } ?>

                            <?php
                            if ($mytask->status == 'pending') {
                            ?>
                            <button id="<?= $mytask->id ?>" class="btn btn-success btn-sm btn-approve"><i class="fa fa-check"></i> Approve</button>
                            <button id="<?= $mytask->id ?>" class="btn btn-danger btn-sm btn-reject"><i class="fa fa-close"></i> Reject</button>
                            <?php } ?>

                            <?php
                            if ($mytask->status == 'progress') {
                                ?>
                                <button id="<?= $mytask->id ?>" class="btn btn-success btn-sm btn-done"><i class="fa fa-check-circle"></i> Done</button>
                                <button id="<?= $mytask->id ?>" class="btn btn-danger btn-sm btn-cancel"><i class="fa fa-close"></i> Cancel</button>
                            <?php } ?>
                            <button id="<?= $mytask->id ?>" class="btn btn-info btn-sm btn-comment" data-toggle="modal" data-target="#modal-comment"><i class="fa fa-comments"></i> Comment</button>
                        </div>
                    </div>
                <?php } ?>
                <?php
                if($count_mytask >= 5){
                ?>
                <div class="au-task__footer">
                    <button class="au-btn au-btn-load" id="btn-load-task">load more</button>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

<!--    TIMELINE MY REQUESTS-->
<div class="col-lg-6">
<div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
    <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');padding-bottom: 10px;padding-top: 10px">
        <div class="bg-overlay bg-overlay--blue"></div>
        <h3>
            <i class="fa fa-tasks"></i>MY REQUESTS</h3>
        <button class="au-btn-plus" id="btn-add-req" data-toggle="modal" data-target="#modal-task">
            <i class="zmdi zmdi-plus"></i>
        </button>
    </div>
    <div class="au-task js-list-load">
        <?php
        if ($myrequest == NULL) {
            ?>
            <div  class="au-task__item au-task__item">
                <div class="au-task__item-inner">
                    <h5 class="task" style="font-weight: normal;">
                        Data not found
                    </h5>
                </div>
            </div>
        <?php } ?>
        <?php
        foreach ($myrequest as $myrequest) {
        ?>

        <?php
        if ($myrequest->status == 'progress') {

        ?>
        <div class="au-task__item au-task__item--success">
            <?php } ?>

            <?php
            if ($myrequest->status == 'done') {

            ?>
            <div class="au-task__item au-task__item--primary">
                <?php } ?>

                <?php
                if ($myrequest->status == 'canceled') {

                ?>
                <div class="au-task__item au-task__item--danger">
                    <?php } ?>

                <?php
                if ($myrequest->status == 'pending') {

                ?>
                <div class="au-task__item au-task__item--warning">
                    <?php } ?>

                    <?php
                    if ($myrequest->status == 'rejected') {

                    ?>
                    <div class="au-task__item au-task__item--danger">
                        <?php } ?>

                        <div class="au-task__item-inner">
                            <h5 class="task">
                                <b><?= $myrequest->remark ?></b> <br>
                            </h5>
                            <h6 style="font-weight: normal"><?= nl2br(str_replace('  ', ' &nbsp;', htmlspecialchars($myrequest->description))); ?></h6>
                            <span class="time"><small><i class="fa fa-tags"></i> <?= $myrequest->category ?></small></span>
                            <span class="time"><small><i class="fa fa-user"></i> <?= $myrequest->user_to ?></small></span>
                            <span class="time"><small><i class="fa fa-clock"></i> <?= date('d M Y h:i a', strtotime($myrequest->updated_at)) ?></small></span>

                            <?php
                            if ($myrequest->status == 'done') {
                                ?>
                                <span class="time" style="color: #0000FF"><small><i class="fa fa-exclamation-triangle"></i> <?= $myrequest->status ?></small></span><br><br>
                            <?php } ?>

                            <?php
                            if ($myrequest->status == 'canceled') {
                                ?>
                                <span class="time" style="color: #D62222"><small><i class="fa fa-exclamation-triangle"></i> <?= $myrequest->status ?></small></span><br><br>
                            <?php } ?>

                            <?php
                            if ($myrequest->status == 'progress') {
                                ?>
                                <span class="time" style="color: #35f235"><small><i class="fa fa-exclamation-triangle"></i> <?= $myrequest->status ?></small></span><br><br>
                            <?php } ?>

                            <?php
                            if ($myrequest->status == 'pending') {
                                ?>
                                <span class="time" style="color: #ffa037"><small><i class="fa fa-exclamation-triangle"></i> <?= $myrequest->status ?></small></span><br><br>
                            <?php } ?>

                            <?php
                            if ($myrequest->status == 'rejected') {
                                ?>
                                <span class="time" style="color: #000000"><small><i class="fa fa-exclamation-triangle"></i> <?= $myrequest->status ?></small></span><br><br>
                            <?php } ?>


                            <?php
                            if ($myrequest->status == 'pending') {
                                ?>
                                <button id="<?= $myrequest->id ?>" class="btn btn-warning btn-sm btn-update" data-toggle="modal" data-target="#modal-task"><i class="fa fa-pencil-square-o"></i> Update</button>
                                <button id="<?= $myrequest->id ?>" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-close"></i> Delete</button>
                            <?php } ?>

                            <?php
                            if ($myrequest->status == 'rejected' || $myrequest->status == 'canceled') {
                                ?>
                                <button id="<?= $myrequest->id ?>" class="btn btn-warning btn-sm btn-resend"><i class="fa fa-refresh"></i> Resend</button>
                            <?php } ?>
                            <button id="<?= $myrequest->id ?>" class="btn btn-info btn-sm btn-comment" data-toggle="modal" data-target="#modal-comment"><i class="fa fa-comments"></i> Comment</button>
                        </div>
                    </div>
                    <?php } ?>

                    <?php
                    if($count_myrequest >= 5){
                        ?>
                    <div class="au-task__footer">
                        <button class="au-btn au-btn-load" id="btn-load-request">load more</button>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
        $count_task_done = count((array)$task_done);
        $count_task_pending = count((array)$task_pending);
        $count_task_progress = count((array)$task_progress);
        $count_task_rejected = count((array)$task_rejected);
        $count_task_canceled = count((array)$task_canceled);

        $count_req_done = count((array)$req_done);
        $count_req_pending = count((array)$req_pending);
        $count_req_progress = count((array)$req_progress);
        $count_req_rejected = count((array)$req_rejected);
        $count_req_canceled = count((array)$req_canceled);

        ?>
</div>

    <script>
        $(".btn-cancel").click(function(){
            $(".close").click();
            var id_task = $(this).attr('id');
            var page = '';
            if (confirm('Are you sure you want to cancel this?')) {
                $.ajax({
                    url: "<?php echo base_url(); ?>/Mytask/cancel",
                    type: 'post',
                    data: {
                        'id': id_task,
                        'page': page
                    },
                    beforeSend: function () {
                        $('#loading').click();
                    },
                    success: function (a) {
                        $('#timeline-dashboard').load("<?php echo base_url(); ?>/Site/timeline");
                        $('#modal-loading').modal('toggle');
                        alert("Data canceled successful");
                    }
                });
            }
        })

        $("#btn-load-request").click(function(){
            window.location.href="<?php echo base_url() ?>myrequest";
        });

        $("#btn-load-task").click(function(){
            window.location.href="<?php echo base_url() ?>mytask";
        });

        $("#btn-add-task").click(function(){
            $('#content-modal2').load("<?php echo base_url(); ?>/Mytask/form_add");
        });

        $("#btn-add-req").click(function(){
            $('#content-modal2').load("<?php echo base_url(); ?>/Myrequest/form_add");
        });

        $('.btn-comment').click(function(){
            var id = $(this).attr('id');
            $('#content-modal-comment').load("<?php echo base_url(); ?>/Myrequest/form_comment/"+id);
        });

        $('.btn-update').click(function(){
            var id = $(this).attr('id');
            $('#content-modal2').load("<?php echo base_url(); ?>/Myrequest/form_update/"+id);
        });

        $('.btn-done').click(function(){
            var id = $(this).attr('id');
            if (confirm('Are you sure done with this request?')) {
                $.ajax({
                    url: "<?php echo base_url(); ?>/Mytask/done",
                    type: 'post',
                    data: {'id': id},
                    beforeSend: function () {
                        $('#loading').click();
                    },
                    success: function (a) {
                        $('#modal-loading').modal('toggle');
                        alert("Success");
                        $('#timeline-dashboard').load("<?php echo base_url(); ?>/Site/timeline");
                    }
                });
            }
        });

        $('.btn-reject').click(function(){
            var id = $(this).attr('id');
            if (confirm('Are you sure you want to reject this?')) {
                $.ajax({
                    url: "<?php echo base_url(); ?>/Mytask/reject",
                    type: 'post',
                    data: {'id': id},
                    beforeSend: function () {
                        $('#loading').click();
                    },
                    success: function (a) {
                        $('#modal-loading').modal('toggle');
                        alert("Data rejected successful");
                        $('#timeline-dashboard').load("<?php echo base_url(); ?>/Site/timeline");
                    }
                });
            }
        });

        $('.btn-approve').click(function(){
            var id = $(this).attr('id');
            if (confirm('Are you sure you want to approve this?')) {
                $.ajax({
                    url: "<?php echo base_url(); ?>/Mytask/approve",
                    type: 'post',
                    data: {'id': id},
                    beforeSend: function () {
                        $('#loading').click();
                    },
                    success: function (a) {
                        $('#modal-loading').modal('toggle');
                        alert("Data approved successful");
                        $('#timeline-dashboard').load("<?php echo base_url(); ?>/Site/timeline");
                    }
                });
            }
        });

        $('.btn-delete').click(function(){
            var id = $(this).attr('id');
            if (confirm('Are you sure you want to delete this?')) {
                $.ajax({
                    url: "<?php echo base_url(); ?>/Myrequest/delete",
                    type: 'post',
                    data: {'id': id},
                    success: function (a) {
                        alert("Data deleted successful");
                        $('#timeline-dashboard').load("<?php echo base_url(); ?>/Site/timeline");
                    }
                });
            }
        });

        $('.btn-resend').click(function(){
            var id = $(this).attr('id');
            if (confirm('Are you sure you want to resend this?')) {
                $.ajax({
                    url: "<?php echo base_url(); ?>/Myrequest/resend",
                    type: 'post',
                    data: {'id': id},
                    beforeSend: function () {
                        $('#loading').click();
                    },
                    success: function (a) {
                        $('#modal-loading').modal('toggle');
                        alert("Data resent successful");
                        $('#timeline-dashboard').load("<?php echo base_url(); ?>/Site/timeline");
                    }
                });
            }
        });
    </script>

    <script>
        $(function () {
            Highcharts.setOptions({
                colors: ['#0000FF', '#35f235', '#FFFF00', '#000000', '#D62222']
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
                        },
                        {
                            name: 'Canceled',
                            y: <?php echo json_encode($count_task_canceled,JSON_NUMERIC_CHECK) ?>,
                        }]
                }]
            });
        });
    </script>

    <script>
        $(function () {
            Highcharts.setOptions({
                colors: ['#0000FF', '#35f235', '#FFFF00', '#000000', '#D62222']
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
                        },
                        {
                            name: 'Canceled',
                            y: <?php echo json_encode($count_req_canceled,JSON_NUMERIC_CHECK) ?>,
                        }]
                }]
            });
        });
    </script>
