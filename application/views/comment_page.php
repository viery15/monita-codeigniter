<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 2/9/2019
 * Time: 8:42 PM
 */
?>

<?php
foreach ($comment as $comment){
    ?>
    <div class="media comment-box" style="width: 100%;margin-bottom: -20px">
        <div class="media-body">
            <h4 class="media-heading"><?= $comment->user_comment ?> <small class="text-muted"> - <?= date('d M Y h:i a', strtotime($comment->created_at)) ?></small></h4>
            <p style="background-color: white"><?= nl2br(str_replace('  ', ' &nbsp;', htmlspecialchars($comment->comment))); ?>
                <?php
                if (isset($comment->attachment)) {
                    $file = $comment->attachment;
                    ?>
                    <br><br>Attachments :<br><i class="fa fa-file"></i> <a href="<?php echo site_url('Myrequest/download/'.$comment->attachment) ?>"><?= $comment->attachment ?></a>
                <?php } ?>
                <?php
                if ($comment->user_comment == $this->session->nik || $task->user_from == $this->session->nik){
                    ?>
                    <button id="<?= $comment->id ?>" class="pull-right btn btn-default btn-sm btn-delete-comment"><i class="fa fa-trash"></i></button>
                <?php } ?>
            </p>
        </div>
    </div>
<?php } ?>

<div class="row">
    <div class="col-md-12">
        <div class="widget-area no-padding blank">
            <div class="status-upload">
                <form id="form-comment" type="post" enctype="multipart/form-data" name="form">
                    <textarea placeholder="Type your comment here..." id="text-comment" name="comment"></textarea>
                    <ul>
                        <input type="text" value="<?= $task->id ?>" style="display: none">
                        <input type="file" name="attachment" id="attach">
                    </ul>
                    <button type="button" id="<?= $task->id ?>" class="btn btn-success green submit-comment"><i class="fa fa-share"></i> Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    $(".btn-delete-comment").click(function(){
        var id_comment = $(this).attr('id');
        var idtask = <?= $task->id ?>;
        if (confirm('Are you sure you want to delete this comment ?')) {
            $.ajax({
                url: "<?php echo base_url(); ?>/Myrequest/deletecomment2",
                type: 'post',
                data: {
                    'id': id_comment,
                    'task_id': idtask,
                },
                success: function (e) {
                    alert("Data deleted successful");
                    $('#comment-section').html(e);
                }
            });
        }
    });

    $(".submit-comment").click(function(){
        id = $(this).attr("id");
        var comment = $("#text-comment").val();
        if (comment == "") {
            alert("Comment cannot empty");
        }
        else {
            var form = $('#form-comment')[0]; // You need to use standard javascript object here
            var formData = new FormData(form);
            formData.append('task_id', id);
            $.ajax({
                url: "<?php echo base_url(); ?>/myrequest/submitcomment2",
                type: 'post',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (e) {
                    $('#comment-section').html(e);
                }
            });
        }
    });
</script>