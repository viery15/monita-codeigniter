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
        <th>Date Start</th>
        <th>Assign From</th>
        <th>Remark</th>
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
            <td><?= ucfirst($task->remark) ?></td>
            <td><?= ucfirst($task->description) ?></td>
            <td><?= ucfirst($task->status) ?></td>
            <td width="20%">
                <?php
                    if ($task->status == 'progress') {
                ?>
                <button title="Done" type="button" class="btn btn-success btn-done" id="<?= $task->id ?>"><i class="fa fa-check"></i></button>
                <?php } ?>

                <?php
                if ($task->status == 'pending') {
                    ?>
                    <button title="Approve" type="button" class="btn btn-success btn-approve" id="<?= $task->id ?>"><i class="fa fa-check"></i></button>
                    <button title="Reject" type="button" class="btn btn-danger btn-reject" id="<?= $task->id ?>"><i class="fa fa-close"></i></button>
                <?php } ?>
            </td>
        </tr>
    <?php } ?>

    </tbody>
    <tfoot>
    <tr>
        <th>Date Start</th>
        <th>Assign From</th>
        <th>Remark</th>
        <th>Description</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </tfoot>
</table>

<script language="JavaScript" type="text/javascript">
    $(document).ready(function(){
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                extend: 'pdf',
                title: 'Customized PDF Title',
                filename: 'customized_pdf_file_name'
            }, {
                extend: 'excel',
                title: 'Customized EXCEL Title',
                filename: 'customized_excel_file_name'
            }, {
                extend: 'csv',
                filename: 'customized_csv_file_name'
            }]
        });

        $('.btn-delete').click(function(){
            var id = $(this).attr('id');
            if (confirm('Are you sure you want to delete this?')) {
                $.ajax({
                    url: "<?php echo base_url(); ?>/Mytask/delete",
                    type: 'post',
                    data: {'id': id},
                    success: function (a) {
                        alert("Delete task success");
                        $('#modal-task').modal('hide');
                        $("#mytask-table-list").html(a);
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
                        $("#mytask-table-list").html(a);
                    }
                });
            }
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
                        $("#mytask-table-list").html(a);
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
                        $("#mytask-table-list").html(a);
                    }
                });
            }
        });
    });
</script>
