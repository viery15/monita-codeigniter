<div class="row">
<!--    TIMELINE MY TASKS-->
    <div class="col-lg-6">
        <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
            <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');">
                <div class="bg-overlay bg-overlay--blue"></div>
                <h3>
                    <i class="fa fa-tasks"></i>MY TASKS</h3>
                <button class="au-btn-plus" id="btn-add-task" data-toggle="modal" data-target="#modal-task">
                    <i class="zmdi zmdi-plus"></i>
                </button>
            </div>
            <div class="au-task js-list-load">

                <?php
                    foreach ($mytask as $mytask) {
                ?>

                    <?php
                    if ($mytask->status == 'progress') {

                    ?>
                    <div class="au-task__item au-task__item--primary">
                    <?php } ?>

                    <?php
                    if ($mytask->status == 'done') {

                    ?>
                    <div class="au-task__item au-task__item--success">
                    <?php } ?>

                    <?php
                    if ($mytask->status == 'pending') {

                    ?>
                    <div class="au-task__item au-task__item--warning">
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
                            <h6 style="font-weight: normal"><?= $mytask->description ?></h6>
                            <span class="time"><small><i class="fa fa-user"></i> <?= $mytask->user_from ?></small></span>
                            <span class="time"><small><i class="fa fa-clock"></i> <?= date('d M Y h:i a', strtotime($mytask->updated_at)) ?></small></span>

                            <?php
                            if ($mytask->status == 'done') {
                            ?>
                            <span class="time" style="color: green"><small><i class="fa fa-tag"></i> <?= $mytask->status ?></small></span><br><br>
                            <?php } ?>

                            <?php
                            if ($mytask->status == 'progress') {
                                ?>
                                <span class="time" style="color: blue"><small><i class="fa fa-tag"></i> <?= $mytask->status ?></small></span><br><br>
                            <?php } ?>

                            <?php
                            if ($mytask->status == 'pending') {
                                ?>
                                <span class="time" style="color: darkorange"><small><i class="fa fa-tag"></i> <?= $mytask->status ?></small></span><br><br>
                            <?php } ?>

                            <?php
                            if ($mytask->status == 'rejected') {
                                ?>
                                <span class="time" style="color: red"><small><i class="fa fa-tag"></i> <?= $mytask->status ?></small></span><br><br>
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
                            <?php } ?>
                            <button id="<?= $mytask->id ?>" class="btn btn-info btn-sm btn-comment" data-toggle="modal" data-target="#modal-comment"><i class="fa fa-comments"></i> Comment</button>
                        </div>
                    </div>
                <?php } ?>

                <div class="au-task__footer">
                    <button class="au-btn au-btn-load" id="btn-load-task">load more</button>
                </div>
            </div>
        </div>
    </div>

<!--    TIMELINE MY REQUESTS-->
<div class="col-lg-6">
<div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
    <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');">
        <div class="bg-overlay bg-overlay--blue"></div>
        <h3>
            <i class="fa fa-tasks"></i>MY REQUESTS</h3>
        <button class="au-btn-plus" id="btn-add-req" data-toggle="modal" data-target="#modal-task">
            <i class="zmdi zmdi-plus"></i>
        </button>
    </div>
    <div class="au-task js-list-load">
        <?php
        foreach ($myrequest as $myrequest) {
        ?>

        <?php
        if ($myrequest->status == 'progress') {

        ?>
        <div class="au-task__item au-task__item--primary">
            <?php } ?>

            <?php
            if ($myrequest->status == 'done') {

            ?>
            <div class="au-task__item au-task__item--success">
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
                            <h6 style="font-weight: normal"><?= $myrequest->description ?></h6>
                            <span class="time"><small><i class="fa fa-user"></i> <?= $myrequest->user_to ?></small></span>
                            <span class="time"><small><i class="fa fa-clock"></i> <?= date('d M Y h:i a', strtotime($myrequest->updated_at)) ?></small></span>

                            <?php
                            if ($myrequest->status == 'done') {
                                ?>
                                <span class="time" style="color: green"><small><i class="fa fa-tag"></i> <?= $myrequest->status ?></small></span><br><br>
                            <?php } ?>

                            <?php
                            if ($myrequest->status == 'progress') {
                                ?>
                                <span class="time" style="color: blue"><small><i class="fa fa-tag"></i> <?= $myrequest->status ?></small></span><br><br>
                            <?php } ?>

                            <?php
                            if ($myrequest->status == 'pending') {
                                ?>
                                <span class="time" style="color: darkorange"><small><i class="fa fa-tag"></i> <?= $myrequest->status ?></small></span><br><br>
                            <?php } ?>

                            <?php
                            if ($myrequest->status == 'rejected') {
                                ?>
                                <span class="time" style="color: red"><small><i class="fa fa-tag"></i> <?= $myrequest->status ?></small></span><br><br>
                            <?php } ?>


                            <?php
                            if ($myrequest->status == 'pending') {
                                ?>
                                <button id="<?= $myrequest->id ?>" class="btn btn-warning btn-sm btn-update" data-toggle="modal" data-target="#modal-task"><i class="fa fa-pencil-square-o"></i> Update</button>
                                <button id="<?= $myrequest->id ?>" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-close"></i> Delete</button>
                            <?php } ?>

                            <?php
                            if ($myrequest->status == 'rejected') {
                                ?>
                                <button id="<?= $myrequest->id ?>" class="btn btn-warning btn-sm btn-resend"><i class="fa fa-refresh"></i> Resend</button>
                            <?php } ?>
                            <button id="<?= $myrequest->id ?>" class="btn btn-info btn-sm btn-comment" data-toggle="modal" data-target="#modal-comment"><i class="fa fa-comments"></i> Comment</button>
                        </div>
                    </div>
                    <?php } ?>

                    <div class="au-task__footer">
                        <button class="au-btn au-btn-load" id="btn-load-request">load more</button>
                    </div>
                </div>
            </div>
        </div>
</div>

    <script>
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
                    success: function (a) {
                        alert("success");
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
                    success: function (a) {
                        alert("Reject task success");
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
                    success: function (a) {
                        alert("Approve task success");
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
                        alert("Delete request success");
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
                    success: function (a) {
                        alert("Resend request success");
                        $('#timeline-dashboard').load("<?php echo base_url(); ?>/Site/timeline");
                    }
                });
            }
        });
    </script>