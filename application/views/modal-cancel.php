<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 2/25/2019
 * Time: 10:30 AM
 */
?>
<div class="modal fade" id="modal-cancel" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Cancel Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="comment">Cancel reason:</label>
                        <textarea class="form-control" rows="5" id="reason"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-cancel" class="btn-sm btn btn-info">Confirm</button>
            </div>
        </div>
    </div>
</div>
<script>
    var id_task;
    $("#btn-cancel").click(function(){
        $(".close").click();
        var reason = $("#reason").val();

        $.ajax({
            url: "<?php echo base_url(); ?>/Mytask/cancel",
            type: 'post',
            data: {
                'id': id_task,
                'reason': reason
            },
            beforeSend: function () {
                $('#loading').click();
            },
            success: function (a) {
                $('#modal-loading').modal('toggle');
                alert("Data canceled successful");
                $("#mytask-table-list").html(a);
            }
        });
    })
</script>