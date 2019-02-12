<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 2/2/2019
 * Time: 10:32 AM
 */
?>

<?php
if(isset($task->id)) {
    ?>
    <div class="modal-header">
        Update Task #<?= $task->id ?>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
        <form id="form-task" name="form-user">
            <input type="hidden" class="form-control" id="user_to" name="user_to" value="<?= $this->session->nik ?>">
            <input type="hidden" class="form-control" id="status" name="status" value="progress">
            <input type="hidden" class="form-control" name="id" value="<?= $task->id ?>">
            <!--            <input type="hidden" class="form-control" id="status" name="status" value="pending">-->
            <div class="form-group">
                <label for="nik">Date: <i style="color:red">*</i></label>
                <div class="input-group input-daterange">
                    <input style="background-color: white" type="text" value="<?= $task->date_from ?>" id="date_from" name="date_from" class="form-control" autocomplete="off" readonly>
                    <div class="input-group-addon">to</div>
                    <input style="background-color: white" type="text" id="date_to" value="<?= $task->date_to ?>" name="date_to" class="form-control" autocomplete="off" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="role">Assign From: <i style="color:red">*</i></label>
                <select class="form-control select-nik" id="user_from" name="user_from" required>
                    <option disabled selected>Select NIK</option>
                    <?php
                    foreach ($users as $user) {
                        ?>
                        <option value="<?= $user->nik ?>"<?=$task->user_from == $user->nik ? ' selected="selected"' : '';?>><?= $user->nik ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="nik">Title: <i style="color:red">*</i></label>
                <input value="<?= $task->remark ?>" autocomplete="off" type="text" class="form-control" id="remark" name="remark" required>
            </div>

            <div class="form-group">
                <label for="nik">Description: <i style="color:red">*</i></label>
                <input value="<?= $task->description ?>" autocomplete="off" type="text" class="form-control" id="description" name="description" required>
            </div>

    </div>
    <div class="modal-footer">
        <button id="update-task" type="submit" class="btn btn-info">Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>
<?php } else {?>
    <div class="modal-header">
        Create New Task
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
        <form id="form-task" name="form-user">
            <input type="hidden" class="form-control" id="user_to" name="user_to" value="<?= $this->session->nik ?>">
            <input type="hidden" class="form-control" id="status" name="status" value="progress">
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
                <label for="role">Assign From: <i style="color:red">*</i></label>
                <select class="form-control select-nik" id="user_from" name="user_from" required>
                    <option disabled selected value="">Select NIK</option>
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
        <button id="submit-task" type="submit" class="btn btn-info">Save</button>
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

    $('#submit-task').click(function(){
        var date_from = $("#date_from").val();
        var date_to = $("#date_to").val();
        var remark = $("#remark").val();
        var description = $("#description").val();
        var user_to = $("#user_from").children("option:selected").val();
        if (date_from == ""  || date_to == "" || user_to == "" || remark == "" || description == "") {
            alert("All required fields cannot be empty!");
        }
        else {
            $.ajax({
                url: "<?php echo base_url(); ?>/Mytask/create",
                type: 'post',
                data: $("#form-task").serialize(),
                success: function (a) {
                    alert("Data saved successful");
                    $("#form-task")[0].reset();
                    $('#modal-task').modal('hide');
                    $("#mytask-table-list").html(a);
                    $('#timeline-dashboard').load("<?php echo base_url(); ?>/Site/timeline");
                }
            });
        }
    });

    $('#update-task').click(function(){
        var date_from = $("#date_from").val();
        var date_to = $("#date_to").val();
        var remark = $("#remark").val();
        var description = $("#description").val();
        var user_to = $("#user_to").children("option:selected").val();
        if (date_from == ""  || date_to == "" || user_to == "" || remark == "" || description == "") {
            alert("All required fields cannot be empty!");
        }
        else {
            $.ajax({
                url: "<?php echo base_url(); ?>/Mytask/update",
                type: 'post',
                data: $("#form-task").serialize(),
                success: function (a) {
                    alert("Data updated successful");
                    $("#form-task")[0].reset();
                    $('#modal-task').modal('hide');
                    $("#mytask-table-list").html(a);
                }
            });
        }
    });
</script>