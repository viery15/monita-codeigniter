<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 2/4/2019
 * Time: 10:01 AM
 */
?>
<table id="example" class="table table-hover table-data3" style="width:100%">
    <thead>
    <tr>
        <th>Start Date</th>
        <th>Assign From</th>
        <th>Category</th>
        <th>Title</th>
        <th>Description</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($mytask as $task){
        ?>
        <tr>
            <td><?= date("d M Y", strtotime($task->date_from)) ?></td>
            <td><?= $task->user_from ?></td>
            <td><?= ucfirst($task->category) ?></td>
            <td><?= ucfirst($task->remark) ?></td>
            <td><?= ucfirst($task->description) ?></td>
            <td><?= ucfirst($task->status) ?></td>
            <td width="20%">
                <?php
                    if ($task->status == 'progress') {
                ?>
                <button title="Done" type="button" class="btn btn-success btn-done" id="<?= $task->id ?>"><i class="fa fa-check-square"></i></button>
                <button title="Cancel" type="button" class="btn btn-danger btn-cancel" id="<?= $task->id ?>"><i class="fa fa-close"></i></button>
                <?php } ?>

                <?php
                if ($task->status == 'pending') {
                    ?>
                    <button title="Approve" type="button" class="btn btn-success btn-approve" id="<?= $task->id ?>"><i class="fa fa-check"></i></button>
                    <button title="Reject" type="button" class="btn btn-danger btn-reject" id="<?= $task->id ?>"><i class="fa fa-close"></i></button>
                <?php } ?>
                <button title="Comment" type="button" class="btn btn-info btn-comment" data-toggle="modal" data-target="#modal-comment" id="<?= $task->id ?>"><i class="fa fa-comments"></i></button>
            </td>
        </tr>
    <?php } ?>

    </tbody>
</table>
<?php
$date_now = date('d M Y');
?>
<script language="JavaScript" type="text/javascript">
    $(document).ready(function(){
        $('#example').DataTable({
            dom: 'Bfrtip',

            buttons: [{
                extend: 'pdf',
                title: 'Tasks of '+ <?= $this->session->nik ?>+' (per <?= $date_now ?>)',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4]
                },
                customize: function ( doc ) {
                    doc.content[1].table.widths = [
                        '20%',
                        '20%',
                        '20%',
                        '20%',
                        '20%'
                    ]
                },
                filename: 'Tasks of '+ <?= $this->session->nik ?>+' (per <?= $date_now ?>)',
            }, {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4]
                },
                title: 'Tasks of '+ <?= $this->session->nik ?>+' (per <?= $date_now ?>)',
                filename: 'Tasks of '+ <?= $this->session->nik ?>+' (per <?= $date_now ?>)',
            }],
        });

        $('.btn-delete').click(function(){
            var id = $(this).attr('id');
            if (confirm('Are you sure you want to delete this?')) {
                $.ajax({
                    url: "<?php echo base_url(); ?>/Mytask/delete",
                    type: 'post',
                    data: {'id': id},
                    success: function (a) {
                        alert("Data deleted successful");
                        $('#modal-task').modal('hide');
                        $("#mytask-table-list").html(a);
                    }
                });
            }
        });

        $("#example").on("click", ".btn-approve", function(){
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
                        $("#mytask-table-list").html(a);
                    }
                });
            }
        });

        $("#example").on("click", ".btn-done", function(){
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
                        $("#mytask-table-list").html(a);
                    }
                });
            }
        });

        $("#example").on("click", ".btn-reject", function(){
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
                        $("#mytask-table-list").html(a);
                    }
                });
            }
        });

        $("#example").on("click", ".btn-comment", function(){
            var id = $(this).attr('id');
            $('#content-modal-comment').load("<?php echo base_url(); ?>/Myrequest/form_comment/"+id);
        });


        $("#example").on("click", ".btn-cancel", function(){
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
        });
    });
</script>
