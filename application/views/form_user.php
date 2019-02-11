<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 1/31/2019
 * Time: 9:49 AM
 */
?>

<?php
if(isset($id)) {
?>
    <div class="modal-header">
        Update User #<?= $id ?>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
        <form id="form-user">
            <div class="form-group">
                <label for="nik">NIK: <i style="color:red">*</i></label>
                <input type="hidden" class="form-control" id="id" name="id" value="<?= $id ?>">
                <input type="text" class="form-control" id="nik" name="nik" value="<?= $nik ?>">
            </div>

            <div class="form-group">
                <label for="nik">Email: <i style="color:red">*</i></label>
                <input autocomplete="off" type="email" class="form-control" id="email" name="email" value="<?= $email ?>" required>
            </div>

            <div class="form-group">
                <label for="role">Role: <i style="color:red">*</i></label>
                <select class="form-control" id="role" name="role">
                    <option disabled>Select role</option>
                    <option value="admin"<?=$role == 'admin' ? ' selected="selected"' : '';?>>Admin</option>
                    <option value="user"<?=$role == 'user' ? ' selected="selected"' : '';?>>User</option>
                </select>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button id="update-user" type="submit" class="btn btn-info">Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>
<?php } else {?>
    <div class="modal-header">
        Create New User
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
<div class="modal-body">
    <form id="form-user" name="form-user">
        <div class="form-group">
            <label for="nik">NIK: <i style="color:red">*</i></label>
            <input autocomplete="off" type="text" class="form-control" id="nik" name="nik" value="" required>
        </div>

        <div class="form-group">
            <label for="nik">Email: <i style="color:red">*</i></label>
            <input autocomplete="off" type="email" class="form-control" id="email" name="email" value="" required>
        </div>

        <div class="form-group">
            <label for="role">Role: <i style="color:red">*</i></label>
            <select class="form-control" id="role" name="role" required>
                <option disabled selected>Select role</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
        </div>
</div>
<div class="modal-footer">
    <button id="submit-user" type="submit" class="btn btn-info">Submit</button>
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </form>
</div>

<?php } ?>

<script type="text/javascript">
    $('#submit-user').click(function(){
        var nik = $("#nik").val();
        if (nik == "") {
            alert("Make sure all form fields are filled");
        }
        else {

        $.ajax({
           url : "<?php echo base_url(); ?>/Users/create",
           type : 'post',
           data : $("#form-user").serialize(),
           success : function (a) {
               alert("Create user sukses");
               $("#form-user")[0].reset();
               $('#modal-user').modal('hide');
               $("#user-table-list").html(a);

           },
           error : function(e) {
               alert("Make sure all form fields are filled");
           }
        });
        }
    });

    $('#update-user').click(function(){
        $.ajax({
            url : "<?php echo base_url(); ?>/Users/update",
            type : 'post',
            data : $("#form-user").serialize(),
            success : function (a) {
                alert("Update user sukses");
                $("#form-user")[0].reset();
                $('#modal-user').modal('hide');
                $("#user-table-list").html(a);
            }
        });
    });
</script>