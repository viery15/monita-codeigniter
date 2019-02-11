<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 1/31/2019
 * Time: 10:55 PM
 */
?>


<?php
if(isset($request->id)) {
    ?>
    <div class="modal-header">
        Update User #<?= $request->id ?>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
        <form id="form-request" name="form-user">
            <input type="hidden" class="form-control" id="user_from" name="user_from" value="<?= $this->session->nik ?>">
            <input type="hidden" class="form-control" id="status" name="status" value="pending">
            <input type="hidden" class="form-control" name="id" value="<?= $request->id ?>">
            <!--            <input type="hidden" class="form-control" id="status" name="status" value="pending">-->
            <div class="form-group">
                <label for="nik">Date Range: <i style="color:red">*</i></label>
                <div class="input-group input-daterange">
                    <input style="background-color: white" type="text" value="<?= $request->date_from ?>" id="date_from" name="date_from" class="form-control" autocomplete="off" readonly>
                    <div class="input-group-addon">to</div>
                    <input style="background-color: white" type="text" id="date_to" value="<?= $request->date_to ?>" name="date_to" class="form-control" autocomplete="off" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="role">Assign To: <i style="color:red">*</i></label>
                <select class="form-control select-nik" id="user_to" name="user_to" required>
                    <option disabled selected>Select NIK</option>
                    <?php
                    foreach ($users as $user) {
                        ?>
                        <option value="<?= $user->nik ?>"<?=$request->user_to == $user->nik ? ' selected="selected"' : '';?>><?= $user->nik ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="nik">Title: <i style="color:red">*</i></label>
                <input value="<?= $request->remark ?>" autocomplete="off" type="text" class="form-control" id="remark" name="remark" required>
            </div>

            <div class="form-group">
                <label for="nik">Description: <i style="color:red">*</i></label>
                <input value="<?= $request->description ?>" autocomplete="off" type="text" class="form-control" id="description" name="description" required>
            </div>

    </div>
    <div class="modal-footer">
        <button id="update-user" type="submit" class="btn btn-info">Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>
<?php } else {?>
    <div class="modal-header">
        Create New Request
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
        <form id="form-request" name="form-user">
            <input type="hidden" class="form-control" id="user_from" name="user_from" value="<?= $this->session->nik ?>">
            <input type="hidden" class="form-control" id="status" name="status" value="pending">
<!--            <input type="hidden" class="form-control" id="status" name="status" value="pending">-->
            <div class="form-group">
                <label for="nik">Date: <i style="color:red">*</i></label>
                <div class="input-group input-daterange">
                    <input style="background-color: white" type="text" id="date_from" name="date_from" class="form-control" autocomplete="off" readonly>
                    <div class="input-group-addon">to</div>
                    <input style="background-color: white" type="text" id="date_to" name="date_to" class="form-control" autocomplete="off" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="role">Assign To: <i style="color:red">*</i></label>
                <select class="form-control select-nik" id="user_to" name="user_to" required>
                    <option disabled selected>Select NIK</option>
                    <?php
                        foreach ($users as $user) {
                    ?>
                    <option value="<?= $user->nik ?>"><?= $user->nik ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="nik">Title: <i style="color:red">*</i></label>
                <input autocomplete="off" type="text" class="form-control" id="remark" name="remark" required>
            </div>

            <div class="form-group">
                <label for="nik">Description: <i style="color:red">*</i></label>
                <input autocomplete="off" type="text" class="form-control" id="description" name="description" required>
            </div>

    </div>
    <div class="modal-footer">
        <button id="submit-request" type="submit" class="btn btn-info">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </form>
    </div>

<?php } ?>

<script type="text/javascript">
    $(".select-nik").select2({
        width: 'resolve' // need to override the changed default
    });
    $('.input-daterange input').each(function() {
        $(this).datepicker();
    });

    $('#submit-request').click(function(){
        $.ajax({
            url : "<?php echo base_url(); ?>/Myrequest/create",
            type : 'post',
            data : $("#form-request").serialize(),
            success : function (a) {
                alert("Create request success");
                $("#form-request")[0].reset();
                $('#modal-request').modal('hide');
                $("#myrequest-table-list").html(a);
                $('#modal-task').modal('hide');
                $('#timeline-dashboard').load("<?php echo base_url(); ?>/Site/timeline");
            }
        });
    });

    $('#update-user').click(function(){
        $.ajax({
            url : "<?php echo base_url(); ?>/Myrequest/update",
            type : 'post',
            data : $("#form-request").serialize(),
            success : function (a) {
                alert("Update request success");
                $("#form-request")[0].reset();
                $('#modal-request').modal('hide');
                $('#modal-task').modal('hide');
                $("#myrequest-table-list").html(a);
                $('#timeline-dashboard').load("<?php echo base_url(); ?>/Site/timeline");
            }
        });
    });
</script>

