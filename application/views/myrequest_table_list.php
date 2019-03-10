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
        <th style="display: none;">End Date</th>
        <th>Category</th>
        <th>Title</th>
        <th style="display: none;">Description</th>
        <th style="display: none;">Assign From</th>
        <th>Assign To</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($myrequest as $request){
        if ($request->status == 'pending') {
            $color = '#FFFF00';
            $text_color = 'black';
        }

        if ($request->status == 'done') {
            $color = '#0000FF';
            $text_color = 'white';
        }

        if ($request->status == 'rejected') {
            $color = '#000000';
            $text_color = 'white';
        }

        if ($request->status == 'progress') {
            $color = '#35f235';
            $text_color = 'black';
        }

        if ($request->status == 'canceled') {
            $color = '#D62222';
            $text_color = 'white';
        }
        ?>
        <tr>
            <td><?= date("d M Y", strtotime($request->date_from)) ?></td>
            <td style="display: none;"><?= date("d M Y", strtotime($request->date_to)) ?></td>
            <td><?= strtoupper($request->name) ?></td>
            <td><?= ucfirst($request->remark) ?></td>
            <td style="display: none;"><?= ucfirst($request->description) ?></td>
            <td style="display: none;"><?= $request->user_from ?></td>
            <td><?= $request->user_to ?></td>
            <td><button class="btn btn-sm" type="button" style="background-color: <?= $color ?>;color: <?= $text_color ?>"><?= $request->status ?></button></td>
            <td >
                <button title="Info" type="button" class="btn btn-info btn-detail" data-toggle="modal" data-target="#modal-info" id="<?= $request->id ?>"><i class="fa fa-eye"></i></button>
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
            "order": [],

            buttons: [{
                extend: 'pdf',
                title: 'Requests of '+ <?= $this->session->nik ?>+' (per <?= $date_now ?>)',
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
                title: 'Requests of '+ <?= $this->session->nik ?>+' (per <?= $date_now ?>)',
                filename: 'Requests of '+ <?= $this->session->nik ?>+' (per <?= $date_now ?>)',
            }],
        });



        $("#table-request").on("click", ".btn-detail", function(){
            var id = $(this).attr('id');
            $('#modal-info-body').load("<?php echo base_url(); ?>/Mycalendar/info/"+id);
        });




    });
</script>
