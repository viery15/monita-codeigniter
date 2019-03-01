<table id="example" class="table table-hover table-data3" style="width:100%">
    <thead>
    <tr>
        <th>Label</th>
        <th>Name</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($category as $category) {
        ?>
        <tr>
            <td><?= strtoupper($category->label) ?></td>
            <td><?= ucfirst($category->name) ?></td>
            <td width="20%">
                <button type="button" class="btn btn-warning btn-update" data-toggle="modal" data-target="#modal-category" id="<?= $category->id ?>"><i class="fa fa-pencil-square-o"></i></button>
                <button type="button" class="btn btn-danger btn-delete" id="<?= $category->id ?>"><i class="fa fa-trash"></i></button>
            </td>
        </tr>
    <?php } ?>
    </tbody>
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
                    url: "<?php echo base_url(); ?>/Category/delete",
                    type: 'post',
                    data: {'id': id},
                    success: function (a) {
                        alert("Delete successful");
                        $("#category-table-list").html(a);
                    }
                });
            }
        });

        $("#example").on("click", ".btn-update", function(){
                var id = $(this).attr('id');
                $('#content-modal').load("<?php echo base_url(); ?>/Category/form_update/"+id);
        });
    });
</script>
