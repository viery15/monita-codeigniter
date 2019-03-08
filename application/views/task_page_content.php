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
        <?= nl2br(str_replace('  ', ' &nbsp;', htmlspecialchars($task->description))) ?>
        <br><br>
        <?php
        if ($task->status == 'pending' && $task->user_to == $this->session->nik && $this->session->role != 'admin') {
            ?>
            <button type="button" id="<?= $task->id ?>" class="btn-approve btn btn-sm btn-success"><i class="fa fa-check"></i> Approve</button>
            <button type="button" id="<?= $task->id ?>" class="btn-reject btn btn-sm btn-danger"><i class="fa fa-close"></i> Reject</button>
        <?php } ?>

        <?php
        if ($task->status == 'pending' && $task->user_from == $this->session->nik && $this->session->role != 'admin') {
            ?>
            <button type="button" id="<?= $task->id ?>" class="btn-update btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-request"><i class="fa fa-pencil-square"></i> Update</button>
            <button type="button" id="<?= $task->id ?>" class="btn-delete btn btn-sm btn-danger"><i class="fa fa-close"></i> Delete</button>
        <?php } ?>

        <?php
        if ($task->status == 'pending' && 'admin' == $this->session->role) {
            ?>
            <button type="button" id="<?= $task->id ?>" class="btn-approve btn btn-sm btn-success"><i class="fa fa-check"></i> Approve</button>
            <button type="button" id="<?= $task->id ?>" class="btn-reject btn btn-sm btn-danger"><i class="fa fa-close"></i> Reject</button>
        <?php } ?>

        <?php
        if ($task->status == 'progress' && $task->user_to == $this->session->nik) {
            ?>
            <button id="<?= $task->id ?>" type="button" class="btn-done btn btn-sm btn-success"><i class="fa fa-check-circle"></i> Done</button>
            <button id="<?= $task->id ?>" class="btn btn-danger btn-sm btn-cancel"><i class="fa fa-close"></i> Cancel</button>
        <?php } ?>

        <?php
        if ($task->status == 'progress' && 'admin' == $this->session->role && $task->user_to != $this->session->nik) {
            ?>
            <button id="<?= $task->id ?>" type="button" class="btn-done btn btn-sm btn-success"><i class="fa fa-check-circle"></i> Done</button>
            <button id="<?= $task->id ?>" class="btn btn-danger btn-sm btn-cancel"><i class="fa fa-close"></i> Cancel</button>
        <?php } ?>

        <?php
        if ($task->status == 'rejected' && $task->user_from == $this->session->nik) {
            ?>
            <button id="<?= $task->id ?>" type="button" class="btn-resend btn btn-sm btn-warning"><i class="fa fa-refresh"></i> Resend Request</button>
        <?php } ?>

        <?php
        if ($task->status == 'canceled' && $task->user_from == $this->session->nik) {
            ?>
            <button id="<?= $task->id ?>" type="button" class="btn-resend btn btn-sm btn-warning"><i class="fa fa-refresh"></i> Resend Request</button>
        <?php } ?>

        <?php
        if ($task->status == 'canceled' && $task->user_from != $this->session->nik && $this->session->role == 'admin') {
            ?>
            <button id="<?= $task->id ?>" type="button" class="btn-resend btn btn-sm btn-warning"><i class="fa fa-refresh"></i> Resend Request</button>
        <?php } ?>


        <?php
        if ($task->status == 'rejected' && 'admin' == $this->session->role && $task->user_to != $this->session->nik) {
            ?>
            <button id="<?= $task->id ?>" type="button" class="btn-resend btn btn-sm btn-warning"><i class="fa fa-refresh"></i> Resend Request</button>
        <?php } ?>

        <?php
        if ('admin' == $this->session->role) {
            ?>
            <button type="button" id="<?= $task->id ?>" class="btn-update btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-request"><i class="fa fa-pencil-square"></i> Update</button>
            <button type="button" id="<?= $task->id ?>" class="btn-delete btn btn-sm btn-danger"><i class="fa fa-close"></i> Delete</button>
        <?php } ?>

    </div>
    <div class="card-footer">
        <i class="fa fa-tags" aria-hidden="true"></i> <?= $task->category ?>&nbsp;
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
        <?php
        if ($this->session->nik != $task->user_to && $this->session->nik != $task->user_from && $this->session->role == 'admin') {
            ?>
            <i class="fa fa-user" aria-hidden="true"></i> <?= $task->user_from ?> -> <?= $task->user_to ?> &nbsp;
        <?php } ?>
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
        <button style="background-color:<?= $color ?>; color:<?= $font_color ?>" class="btn btn-sm" type="button"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i><?= ucfirst($task->status) ?></button>
    </div>
</div>

<script>
    $(".btn-cancel").click(function(){
        $(".close").click();
        var id_task = $(this).attr('id');
        var page = 'page detail';
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
                    if (page == 'page detail') {
                        $("#task-content").html(a);
                    }
                    else {
                        $("#mytask-table-list").html(a);
                    }
                    $('#modal-loading').modal('toggle');
                    alert("Data canceled successful");
                }
            });
        }
    })

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
