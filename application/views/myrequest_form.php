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
        Update Request #<?= $request->id ?>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
        <form id="form-request" name="form-user">
            <input type="hidden" class="form-control" id="user_from" name="user_from" value="<?= $this->session->nik ?>">
            <input type="hidden" class="form-control" id="status" name="status" value="pending">
            <input type="hidden" class="form-control" name="id" value="<?= $request->id ?>">
            <!--            <input type="hidden" class="form-control" id="status" name="status" value="pending">-->
            <!-- <div class="form-group">
                <label for="nik">Date Range: <i style="color:red">*</i></label>
                <div class="input-group input-daterange">
                    <input style="height:28px;padding:0.5%;background-color: white" type="text" value="<?= $request->date_from ?>" id="date_from" name="date_from" class="form-control" autocomplete="off" readonly>
                    <div class="input-group-addon" style="padding:4px;height:28px;width:32px">to</div>
                    <input style="height:28px;padding:0.5%;background-color: white" type="text" id="date_to" value="<?= $request->date_to ?>" name="date_to" class="form-control" autocomplete="off" readonly>
                </div>
            </div> -->
            <div class="form-group">
                <label for="cc-payment" class="control-label mb-1">Date Period:</label>
                <input value="<?= date('m/d/Y', strtotime($request->date_from)) ?> - <?= date('m/d/Y', strtotime($request->date_to)) ?>" id="daterange" style="padding:0.5%" class="form-control" type="text" name="daterange" />
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
                <label for="role">Category: <i style="color:red">*</i></label>
                <select class="form-control select-category" id="category" name="category" required>
                    <option disabled selected>Select Category</option>
                    <?php
                    foreach ($category as $category) {
                        ?>
                        <option value="<?= $category->label ?>"<?=$request->category == $category->label ? ' selected="selected"' : '';?>><?= $category->label ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="nik">Title: <i style="color:red">*</i></label>
                <input style="padding: 0.5%;" value="<?= $request->remark ?>" autocomplete="off" type="text" class="form-control" id="remark" name="remark" required>
            </div>

            <div class="form-group">
                <label for="comment">Description: <i style="color:red">*</i></label>
                <textarea class="form-control" rows="3" id="description" name="description" required><?= $request->description ?></textarea>
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
            <!-- <div class="form-group">
                <label for="nik">Date: <i style="color:red">*</i></label>
                <div class="input-group input-daterange">
                    <input style="height:28px;background-color: white" type="text" id="date_from" name="date_from" class="form-control" autocomplete="off" readonly>
                    <div class="input-group-addon" style="padding:4px;height:28px;width:32px">to</div>
                    <input style="height:28px;background-color: white" type="text" id="date_to" name="date_to" class="form-control" autocomplete="off" readonly>
                </div>
            </div> -->
            <div class="form-group">
                <label for="cc-payment" class="control-label mb-1">Date : <i style="color:red">*</i></label>
                <input id="daterange" style="padding:0.5%" class="form-control" type="text" name="daterange" />
            </div>
            <div class="form-group">
                <label for="role">Assign To: <i style="color:red">*</i></label>
                <select class="form-control select-nik" id="user_to" name="user_to" required>
                    <option disabled selected value="">Select NIK</option>
                    <?php
                        foreach ($users as $user) {
                    ?>
                    <option value="<?= $user->nik ?>"><?= $user->nik ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="role">Category: <i style="color:red">*</i></label>
                <select class="form-control select-category" id="category" name="category" required>
                    <option disabled selected value="">Select Category</option>
                    <?php
                    foreach ($category as $category) {
                        ?>
                        <option value="<?= $category->label ?>"><?= $category->label ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="nik">Title: <i style="color:red">*</i></label>
                <input style="padding: 0.5%" autocomplete="off" type="text" class="form-control" id="remark" name="remark" required>
            </div>

            <div class="form-group">
                <label for="comment">Description: <i style="color:red">*</i></label>
                <textarea class="form-control" rows="3" id="description" name="description" required></textarea>
            </div>

    </div>
    <div class="modal-footer">
        <button id="submit-request" type="submit" class="btn btn-info">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </form>
    </div>

<?php } ?>

<script type="text/javascript">
    $('input[name="daterange"]:eq(0)').daterangepicker();

    $(".select-nik").select2({
        width: 'resolve' // need to override the changed default
    });
    $(".select-category").select2({
        width: 'resolve' // need to override the changed default
    });
    $('.input-daterange input').each(function() {
        $(this).datepicker();
    });

    $('#submit-request').click(function(){

        var remark = $("#remark").val();
        var description = $("#description").val();
        var user_to = $("#user_to").children("option:selected").val();
        var category = $("#category").children("option:selected").val();
        if (user_to == "" || remark == "" || description == "" || category == "") {
            alert("All required fields cannot be empty!");
        }
        else {
            $.ajax({
                url: "<?php echo base_url(); ?>/Myrequest/create",
                type: 'post',
                data: $("#form-request").serialize(),
                dataType : 'json',
                beforeSend: function () {
                    $('#modal-request').modal('hide');
                    $('#modal-task').modal('hide');
                    $('#loading').click();
                },
                success: function (a) {
                    alert(a.msg + " and " + a.msg_email);
                    $('#modal-loading').modal('toggle');
                    $("#form-request")[0].reset();
                    $("#myrequest-table-list").load("<?php echo base_url(); ?>/Myrequest/loadRequestTable");
                    $('#timeline-dashboard').load("<?php echo base_url(); ?>/Site/timeline");
                }
            });
        }
    });

    $('#update-user').click(function(){
        var remark = $("#remark").val();
        var description = $("#description").val();
        var user_to = $("#user_to").children("option:selected").val();
        var category = $("#category").children("option:selected").val();
        if (user_to == "" || remark == "" || description == "" || category == "") {
            alert("All required fields cannot be empty!");
        }
        else {
            $.ajax({
                url: "<?php echo base_url(); ?>/Myrequest/update",
                type: 'post',
                data: $("#form-request").serialize(),
                success: function (a) {
                    alert("Data updated successful");
                    $("#form-request")[0].reset();
                    $('#modal-request').modal('hide');
                    $('#modal-task').modal('hide');
                    $("#myrequest-table-list").html(a);
                    $('#timeline-dashboard').load("<?php echo base_url(); ?>/Site/timeline");
                }
            });
        }
    });
</script>
