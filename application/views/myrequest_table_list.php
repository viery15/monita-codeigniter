<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 2/4/2019
 * Time: 9:41 AM
 */
?>
<table id="table-request" class="table table-hover table-data3" style="width:100%">
    <thead>
    <tr>
        <th>Date Start</th>
        <th>Assign To</th>
        <th>Remark</th>
        <th>Description</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($myrequest as $request){
        ?>
        <tr>
            <td><?= date("d M Y", strtotime($request->date_from)) ?></td>
            <td><?= $request->user_to ?></td>
            <td><?= ucfirst($request->remark) ?></td>
            <td><?= ucfirst($request->description) ?></td>
            <td><?= ucfirst($request->status) ?></td>
            <td width="20%">
                <?php
                    if ($request->status == "pending") {
                ?>
                    <button title="Update" type="button" class="btn btn-warning btn-update" data-toggle="modal" data-target="#modal-request" id="<?= $request->id ?>"><i class="fa fa-pencil-square-o"></i></button>
                    <button title="Delete" type="button" class="btn btn-danger btn-delete" id="<?= $request->id ?>"><i class="fa fa-trash"></i></button>
                <?php } ?>

                <?php
                if ($request->status == "rejected") {
                    ?>
                    <button title="Resend Request" type="button" class="btn btn-warning btn-resend" id="<?= $request->id ?>"><i class="fa fa-refresh"></i></button>
                <?php } ?>
            </td>
        </tr>
    <?php } ?>

    </tbody>
    <tfoot>
    <tr>
        <th>Date Start</th>
        <th>Assign To</th>
        <th>Remark</th>
        <th>Description</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </tfoot>
</table>

<script type="text/javascript" language="JavaScript">
    $(document).ready(function(){
        $('#table-request').DataTable({
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
                    url: "<?php echo base_url(); ?>/Myrequest/delete",
                    type: 'post',
                    data: {'id': id},
                    success: function (a) {
                        alert("Delete request success");
                        $("#myrequest-table-list").html(a);
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
                        $("#myrequest-table-list").html(a);
                    }
                });
            }
        });

        $('.btn-update').click(function(){
            var id = $(this).attr('id');
//            alert(id);
            $('#content-modal').load("<?php echo base_url(); ?>/Myrequest/form_update/"+id);
        });
    });
</script>
