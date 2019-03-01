<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 2/4/2019
 * Time: 8:34 AM
 */
?>

<table id="example" class="table table-hover table-data3" style="width:100%">
    <thead>
    <tr>
        <th>NIK</th>
        <th>Email</th>
        <th>Role</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($users as $user) {
        ?>
        <tr>
            <td><?= $user->nik ?></td>
            <td><?= $user->email ?></td>
            <td><?= ucfirst($user->role) ?></td>
            <td width="20%">
                <button type="button" class="btn btn-warning btn-update" data-toggle="modal" data-target="#modal-user" id="<?= $user->id ?>"><i class="fa fa-pencil-square-o"></i></button>
                <button type="button" class="btn btn-danger btn-delete" id="<?= $user->id ?>"><i class="fa fa-trash"></i></button>
            </td>
        </tr>
    <?php } ?>
    </tbody>
    <tfoot>
    <tr>
        <th>NIK</th>
        <th>Email</th>
        <th>Role</th>
        <th>Action</th>
    </tr>
    </tfoot>
</table>
<?php
$date_now = date('d M Y');
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#example').DataTable({

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

        $("#example").on("click", ".btn-update", function(){
            var id = $(this).attr('id');
            $('#content-modal').load("<?php echo base_url(); ?>/Users/form_update/"+id);
        });
    });
</script>