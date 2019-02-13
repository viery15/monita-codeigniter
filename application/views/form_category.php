<?php
if(isset($id)) {
?>
    <div class="modal-header">
        Update Category #<?= $id ?>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
        <form id="form-category">
          <div class="form-group">
              <label for="nik">Label: <i style="color:red">*</i></label>
              <input type="hidden" value="<?= $id ?>" name="id" class="form-control" id="id">
              <input autocomplete="off" type="text" class="form-control" id="label" name="label" value="<?= $label ?>" required>
          </div>

          <div class="form-group">
              <label for="nik">Name: <i style="color:red">*</i></label>
              <input autocomplete="off" type="text" class="form-control" id="name" name="name" value="<?= $name ?>" required>
          </div>
        </form>
    </div>
    <div class="modal-footer">
        <button id="update-category" type="submit" class="btn btn-info">Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>
<?php } else {?>
    <div class="modal-header">
        Create New Category
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
<div class="modal-body">
    <form id="form-category" name="form-user">
        <div class="form-group">
            <label for="nik">Label: <i style="color:red">*</i></label>
            <input autocomplete="off" type="text" class="form-control" id="label" name="label" value="" required>
        </div>

        <div class="form-group">
            <label for="nik">Name: <i style="color:red">*</i></label>
            <input autocomplete="off" type="text" class="form-control" id="name" name="name" value="" required>
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
        var label = $("#label").val();
        var name = $("#name").val();
        if (label == "" || name == "") {
          alert("All required fields cannot be empty!");
        }
        else {
          $.ajax({
              url: "<?php echo base_url(); ?>/Category/create",
              type: 'post',
              data: $("#form-category").serialize(),
              success: function (a) {
                  alert("Data saved successful");
                  $("#form-category")[0].reset();
                  $('#modal-category').modal('hide');
                  $("#category-table-list").html(a);
              },
          });
        }
    });

    $('#update-category').click(function(){
        var label = $("#label").val();
        var name = $("#name").val();
        if (label == "" || name == "") {
          alert("All required fields cannot be empty!");
        }
        else {
          $.ajax({
              url: "<?php echo base_url(); ?>Category/update",
              type: 'post',
              data: $("#form-category").serialize(),
              success: function (a) {
                  alert("Data updated successful");
                  $("#form-category")[0].reset();
                  $('#modal-category').modal('hide');
                  $("#category-table-list").html(a);
              },
          });
        }
    });
</script>
