<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 2/4/2019
 * Time: 9:41 AM
 */
?>
<table id="table-request" class="table table-hover table-data3" style="width:100%">
    <thead id="table-myrequest">
    <tr>
        <th>Start Date</th>
        <th>Assign To</th>
        <th>Category</th>
        <th>Title</th>
        <th>Description</th>
        <th>Status</th>
        <th width="21%">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($myrequest as $request){
        ?>
        <tr>
            <td><?= date("d M Y", strtotime($request->date_from)) ?></td>
            <td><?= $request->user_to ?></td>
            <td><?= strtoupper($request->category) ?></td>
            <td><?= ucfirst($request->remark) ?></td>
            <td><?= ucfirst($request->description) ?></td>
            <td><?= ucfirst($request->status) ?></td>
            <td >
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
                <button title="Comment" type="button" class="btn btn-info btn-comment" data-toggle="modal" data-target="#modal-comment" id="<?= $request->id ?>"><i class="fa fa-comments"></i></button>
            </td>
        </tr>
    <?php } ?>

    </tbody>

</table>
<?php
$date_now = date('d M Y');
?>
<script type="text/javascript" language="JavaScript">
    $(document).ready(function(){
        $('#table-request').DataTable({
            dom: 'Bfrtip',

            buttons: [{
                extend: 'pdf',
                title: 'Requests of '+ <?= $this->session->nik ?>+' (per <?= $date_now ?>)',
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
                filename: 'Requests of '+ <?= $this->session->nik ?>+' (per <?= $date_now ?>)',
            }, {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4]
                },
                title: 'Requests of '+ <?= $this->session->nik ?>+' (per <?= $date_now ?>)',
                filename: 'Requests of '+ <?= $this->session->nik ?>+' (per <?= $date_now ?>)',
            }],

            "fnDrawCallback": function( oSettings ) {
                $('.btn-update').click(function(){
                    var id = $(this).attr('id');
                    $('#content-modal').load("<?php echo base_url(); ?>/Myrequest/form_update/"+id);
                });

                $('.btn-comment').click(function(){
                    var id = $(this).attr('id');
                    $('#content-modal-comment').load("<?php echo base_url(); ?>/Myrequest/form_comment/"+id);
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
                            beforeSend: function () {
                                $('#loading').click();
                            },
                            success: function (a) {
                                $('#modal-loading').modal('toggle');
                                alert("Data resent successful");
                                $("#myrequest-table-list").html(a);
                            }
                        });
                    }
                });
            }
        });
    });
</script>
