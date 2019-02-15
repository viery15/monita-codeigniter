<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 2/9/2019
 * Time: 11:52 PM
 */


?>

<div class="card">
    <div class="card-header"><b><?= $task->remark ?></b></div>
    <div class="card-body">
        <?= $task->description ?> <br><br>
        <?php
        if ($task->status == 'pending' && $task->user_to == $this->session->nik) {
            ?>
            <button type="button" id="<?= $task->id ?>" class="btn-approve btn btn-sm btn-success"><i class="fa fa-check"></i> Approve</button>
            <button type="button" id="<?= $task->id ?>" class="btn-reject btn btn-sm btn-danger"><i class="fa fa-close"></i> Reject</button>
        <?php } ?>

        <?php
        if ($task->status == 'pending' && $task->user_from == $this->session->nik) {
            ?>
            <button type="button" id="<?= $task->id ?>" class="btn-update btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-request"><i class="fa fa-pencil-square"></i> Update</button>
            <button type="button" id="<?= $task->id ?>" class="btn-delete btn btn-sm btn-danger"><i class="fa fa-close"></i> Delete</button>
        <?php } ?>

        <?php
        if ($task->status == 'progress' && $task->user_to == $this->session->nik) {
            ?>
            <button id="<?= $task->id ?>" type="button" class="btn-done btn btn-sm btn-success"><i class="fa fa-check-circle"></i> Done</button>
        <?php } ?>

        <?php
        if ($task->status == 'rejected' && $task->user_from == $this->session->nik) {
            ?>
            <button id="<?= $task->id ?>" type="button" class="btn-resend btn btn-sm btn-warning"><i class="fa fa-refresh"></i> Resend Request</button>
        <?php } ?>

    </div>
    <div class="card-footer">
        <i class="fa fa-clock" aria-hidden="true"></i> <?= date('d M Y h:i a', strtotime($task->updated_at)) ?> &nbsp;
        <?php
        if ($this->session->nik == $task->user_from) {
            ?>
            <i class="fa fa-user" aria-hidden="true"></i> <?= $task->user_to ?> &nbsp;
        <?php } ?>
        <?php
        if ($this->session->nik == $task->user_to) {
            ?>
            <i class="fa fa-user" aria-hidden="true"></i> <?= $task->user_from ?> &nbsp;
        <?php } ?>
        <i class="fa fa-tag" aria-hidden="true"></i> <?= ucfirst($task->status) ?>
    </div>
</div>

<script>
    $('.btn-delete').click(function(){
        var id = $(this).attr('id');
        if (confirm('Are you sure you want to delete this?')) {
            $.ajax({
                url: "<?php echo base_url(); ?>/Myrequest/delete2",
                type: 'post',
                data: {'id': id},
                success: function (a) {
                    alert("Data deleted successful");
//                    $("#myrequest-table-list").html(a);
                    window.location.href = "<?= base_url(); ?>"
                }
            });
        }
    });

    $('.btn-update').click(function(){
        var id = $(this).attr('id');
        $('#content-modal').load("<?php echo base_url(); ?>/Myrequest/form_update2/"+id);
    });

    $('.btn-resend').click(function(){
        var id = $(this).attr('id');
        if (confirm('Are you sure you want to resend this?')) {
            $.ajax({
                url: "<?php echo base_url(); ?>/Myrequest/resend2",
                type: 'post',
                data: {'id': id},
                beforeSend: function () {
                    $('#loading').click();
                },
                success: function (a) {
                    $('#modal-loading').modal('toggle');
                    alert("Data resent successful");
                    $("#task-content").html(a);
                }
            });
        }
    });

    $('.btn-approve').click(function(){
        var id = $(this).attr('id');
        if (confirm('Are you sure you want to approve this?')) {
            $.ajax({
                url: "<?php echo base_url(); ?>/Mytask/approve2",
                type: 'post',
                data: {'id': id},
                beforeSend: function () {
                    $('#loading').click();
                },
                success: function (a) {
                    $('#modal-loading').modal('toggle');
                    alert("Data approved successful");
                    $("#task-content").html(a);
                }
            });
        }
    });

    $('.btn-done').click(function(){
        var id = $(this).attr('id');
        if (confirm('Are you sure done with this request?')) {
            $.ajax({
                url: "<?php echo base_url(); ?>/Mytask/done2",
                type: 'post',
                data: {'id': id},
                beforeSend: function () {
                    $('#loading').click();
                },
                success: function (a) {
                    $('#modal-loading').modal('toggle');
                    alert("Success");
                    $("#task-content").html(a);
                }
            });
        }
    });

    $('.btn-reject').click(function(){
        var id = $(this).attr('id');
        if (confirm('Are you sure you want to reject this?')) {
            $.ajax({
                url: "<?php echo base_url(); ?>/Mytask/reject2",
                type: 'post',
                data: {'id': id},
                beforeSend: function () {
                    $('#loading').click();
                },
                success: function (a) {
                    $('#modal-loading').modal('toggle');
                    alert("Data rejected successful");
                    $("#task-content").html(a);
                }
            });
        }
    });
</script>
