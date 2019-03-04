<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 2/4/2019
 * Time: 1:08 PM
 */
?>
<style type="text/css">
    /* CSS Test begin */
    .image-upload > input
    {
        display: none;
    }

    .image-upload img
    {
        width: 80px;
        cursor: pointer;
    }
    .comment-box {
        margin-top: 30px !important;
    }
    /* CSS Test end */

    .comment-box img {
        width: 50px;
        height: 50px;
    }
    .comment-box .media-left {
        padding-right: 10px;
        width: 65px;
    }
    .comment-box .media-body p {
        border: 1px solid #ddd;
        padding: 10px;
    }
    .comment-box .media-body .media p {
        margin-bottom: 0;
    }
    .comment-box .media-heading {
        background-color: #f5f5f5;
        border: 1px solid #ddd;
        padding: 7px 10px;
        position: relative;
        margin-bottom: -1px;
    }
    .comment-box .media-heading:before {
        content: "";
        width: 12px;
        height: 12px;
        background-color: #f5f5f5;
        border: 1px solid #ddd;
        border-width: 1px 0 0 1px;
        -webkit-transform: rotate(-45deg);
        transform: rotate(-45deg);
        position: absolute;
        top: 10px;
        left: -6px;
    }

    body{ background: #fafafa;}
    .widget-area.blank {
        background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        -ms-box-shadow: none;
        -o-box-shadow: none;
        box-shadow: none;
    }
    body .no-padding {
        padding: 0;
    }
    .widget-area {
        background-color: #fff;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        -ms-border-radius: 4px;
        -o-border-radius: 4px;
        border-radius: 4px;
        -webkit-box-shadow: 0 0 16px rgba(0, 0, 0, 0.05);
        -moz-box-shadow: 0 0 16px rgba(0, 0, 0, 0.05);
        -ms-box-shadow: 0 0 16px rgba(0, 0, 0, 0.05);
        -o-box-shadow: 0 0 16px rgba(0, 0, 0, 0.05);
        box-shadow: 0 0 16px rgba(0, 0, 0, 0.05);
        float: left;
        margin-top: 30px;
        padding: 25px 30px;
        position: relative;
        width: 100%;
    }
    .status-upload {
        background: none repeat scroll 0 0 #f5f5f5;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        -ms-border-radius: 4px;
        -o-border-radius: 4px;
        border-radius: 4px;
        float: left;
        width: 100%;
    }
    .status-upload form {
        float: left;
        width: 100%;
    }
    .status-upload form textarea {
        background: none repeat scroll 0 0 #fff;
        border: medium none;
        -webkit-border-radius: 4px 4px 0 0;
        -moz-border-radius: 4px 4px 0 0;
        -ms-border-radius: 4px 4px 0 0;
        -o-border-radius: 4px 4px 0 0;
        border-radius: 4px 4px 0 0;
        color: #777777;
        float: left;
        font-family: Lato;
        font-size: 14px;
        height: 142px;
        letter-spacing: 0.3px;
        padding: 20px;
        width: 100%;
        resize:vertical;
        outline:none;
        border: 1px solid #F2F2F2;
    }

    .status-upload ul {
        float: left;
        list-style: none outside none;
        margin: 0;
        padding: 0 0 0 15px;
        width: auto;
    }
    .status-upload ul > li {
        float: left;
    }
    .status-upload ul > li > a {
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        -ms-border-radius: 4px;
        -o-border-radius: 4px;
        border-radius: 4px;
        color: #777777;
        float: left;
        font-size: 14px;
        height: 30px;
        line-height: 30px;
        margin: 10px 0 10px 10px;
        text-align: center;
        -webkit-transition: all 0.4s ease 0s;
        -moz-transition: all 0.4s ease 0s;
        -ms-transition: all 0.4s ease 0s;
        -o-transition: all 0.4s ease 0s;
        transition: all 0.4s ease 0s;
        width: 30px;
        cursor: pointer;
    }
    .status-upload ul > li > a:hover {
        background: none repeat scroll 0 0 #606060;
        color: #fff;
    }
    .status-upload form button {
        border: medium none;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        -ms-border-radius: 4px;
        -o-border-radius: 4px;
        border-radius: 4px;
        color: #fff;
        float: right;
        font-family: Lato;
        font-size: 14px;
        letter-spacing: 0.3px;
        margin-right: 9px;
        margin-top: 9px;
        padding: 6px 15px;
    }
    .dropdown > a > span.green:before {
        border-left-color: #2dcb73;
    }
    .status-upload form button > i {
        margin-right: 7px;
    }
</style>
<div class="modal-header">
    Comment Task #<?= $task->remark ?>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
    <?php
        if (!isset($comment[0])) {
    ?>
    No Data Found
    <?php } ?>
    <?php
    foreach ($comment as $comment) {
    ?>
        <div class="media comment-box" style="width: 100%">
            <div class="media-body" style="margin-top:-3%">
                <h4 class="media-heading"><?= $comment->user_comment ?> <small class="text-muted"> - <?= date("d M Y H:i a", strtotime($comment->created_at)) ?></small></h4>
                <p><?= nl2br(str_replace('  ', ' &nbsp;', htmlspecialchars($comment->comment))); ?>
                    <?php
                        if (isset($comment->attachment)) {
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
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </form>
</div>

<script language="JavaScript" type="text/javascript">

    $(".btn-delete-comment").click(function(){
       var id_comment = $(this).attr('id');
       var idtask = <?= $task->id ?>;
       if (confirm('Are you sure you want to delete this comment ?')) {
           $.ajax({
               url: "<?php echo base_url(); ?>/Myrequest/deletecomment",
               type: 'post',
               data: {
                   'id': id_comment,
                   'task_id': idtask
               },
               success: function (a) {
                   alert("Data deleted successful");
                   $('#content-modal-comment').html(a);
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
                url: "<?php echo base_url(); ?>/myrequest/submitcomment",
                type: 'post',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (e) {
                    $('#content-modal-comment').html(e);
                }
            });
        }
    });
</script>
