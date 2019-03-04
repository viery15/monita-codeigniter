<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 2/28/2019
 * Time: 3:28 PM
 */
?>
<table id="employee-task" class="table table-hover table-data3" style="width:100%">
    <thead>
    <tr>
        <th>Start Date</th>
        <th style="display: none;">End Date</th>
        <th>Category</th>
        <th>Title</th>
        <th style="display: none;">Description</th>
        <th>Assign From</th>
        <th>Assign To</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($tasks as $task) {
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
        <tr>
            <td><?= date('d M Y', strtotime($task->date_from)) ?></td>
            <td style="display: none;"><?= date('d M Y', strtotime($task->date_to)) ?></td>
            <td><?= $task->category ?></td>
            <td><?= $task->remark ?></td>
            <td style="display: none;"><?= $task->description ?></td>
            <td><?= $task->user_from ?></td>
            <td><?= $task->user_to ?></td>
            <td> <button class="btn btn-sm" type="button" style="background-color: <?= $color ?>;color: <?= $text_color ?>"><?= $task->status ?></button> </td>
            <td width="20%">
                <button title="Info" type="button" class="btn btn-info btn-detail" data-toggle="modal" data-target="#modal-info" id="<?= $task->id ?>"><i class="fa fa-eye"></i></button>
            </td>
        </tr>
    <?php } ?>
    </tbody>
    <tfoot>
    <tr>
        <th>Start Date</th>
        <th style="display: none;">End Date</th>
        <th>Category</th>
        <th>Title</th>
        <th style="display: none;">Description</th>
        <th style="display: none;">Assign From</th>
        <th>Assign To</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </tfoot>
</table>
<?php
$date_now = date('d M Y');
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#employee-task').DataTable({
            dom: 'Bfrtip',

            buttons: [{
                extend: 'pdf',
                title: 'Tasks '+' (per <?= $date_now ?>)',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
                },
                customize: function ( doc ) {
//                    doc.content[1].table.widths = [
//                        '20%',
//                        '20%',
//                        '20%',
//                        '20%',
//                        '20%'
//                    ]
                },
                filename: 'Requests of '+ <?= $this->session->nik ?>+' (per <?= $date_now ?>)',
            }, {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
                },
                title: 'Tasks '+' (per <?= $date_now ?>)',
                filename: 'Tasks '+' (per <?= $date_now ?>)',
            }],
        });

        $("#example").on("click", ".btn-delete", function(){
            var id = $(this).attr('id');
            if (confirm('Are you sure you want to delete this?')) {
                $.ajax({
                    url: "<?php echo base_url(); ?>/Users/delete",
                    type: 'post',
                    data: {'id': id},
                    success: function (a) {
                        alert("Delete user sukses");
                        $("#user-table-list").html(a);
                    }
                });
            }
        });

        $("#employee-task").on("click", ".btn-detail", function(){
            var id = $(this).attr('id');
            $('#modal-info-body').load("<?php echo base_url(); ?>/Mycalendar/info/"+id);
        });

      
    });
</script>
