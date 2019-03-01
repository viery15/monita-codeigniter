<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 2/10/2019
 * Time: 11:55 AM
 */
?>


<?php header('Access-Control-Allow-Origin: *'); ?>
<div id="body">
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Notification</title>
    <?php $this->load->view("_partials/head.php") ?>
    <?php $this->load->view("_partials/js.php") ?>

</head>

<body>
<div class="page-wrapper">
    <!-- HEADER MOBILE-->
    <?php $this->load->view("_partials/navbar.php") ?>
    <!-- END HEADER MOBILE-->

    <!-- MENU SIDEBAR-->
    <?php $this->load->view("_partials/sidebar.php") ?>
    <!-- END MENU SIDEBAR-->

    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- HEADER DESKTOP-->
        <?php $this->load->view("_partials/nav_desktop.php") ?>
        <!-- HEADER DESKTOP-->

        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="overview-wrap">
                                <h2 class="title-1">Notification</h2>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">

<!--                        // NOTIF TASK-->
                        <div class="col-lg-6">
                            <button type="button" class="btn-clear-task btn btn-default btn-sm"><i class="fa fa-trash"></i> Clear</button>
                            <br><br>
                            <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                                <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');padding-bottom: 10px;padding-top: 10px">
                                    <div class="bg-overlay bg-overlay--blue"></div>
                                    <h3>
                                        <i class="fa fa-tasks"></i>My Tasks</h3>
                                </div>
                                <div class="au-task js-list-load">
                                    <div class="au-task-list">
                                        <?php
                                        if ($notif_task == NULL) {
                                            ?>
                                            <div  class="au-task__item au-task__item">
                                                <div class="au-task__item-inner">
                                                    <h5 class="task" style="font-weight: normal;">
                                                        Data not found
                                                    </h5>
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <?php
                                        foreach ($notif_task as $task){
                                        ?>
                                        <?php
                                        if ($task->type == 'new'){
                                        ?>
                                        <div id="<?= $task->id_task ?>" class="au-task__item au-task__item--warning btn-notif2" style="cursor:pointer;">
                                        <?php } ?>

                                        <?php
                                        if ($task->type == 'comment task'){
                                        ?>
                                        <div id="<?= $task->id_task ?>" class="au-task__item au-task__item--success btn-notif2" style="cursor:pointer;">
                                        <?php } ?>

                                            <div class="au-task__item-inner">

                                                    <?php
                                                    if ($task->type == 'new'){
                                                    ?>
                                                    <?= $task->user_from ?> Sent you new request
                                                    <?php } ?>

                                                    <?php
                                                    if ($task->type == 'comment task'){
                                                        ?>
                                                        <?= $task->user_from ?> comment your task
                                                    <?php } ?>

                                                <span class="time pull-right"><small><?= date('d M Y h:i a',strtotime($task->created_at)) ?>&nbsp;&nbsp;</small></span>
                                            </div>
                                        </div>
                                        <?php } ?>

                                    </div>
                                </div>
                            </div>
                    </div>
<!--                        // NOTIF REQUEST-->
                        <div class="col-lg-6">
                            <button type="button" class="btn-clear-req btn btn-default btn-sm"><i class="fa fa-trash"></i> Clear</button>
                            <br><br>
                            <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                                <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');padding-bottom: 10px;padding-top: 10px">
                                    <div class="bg-overlay bg-overlay--blue"></div>
                                    <h3> <i class="fa fa-tasks"></i>My Requests</h3>
                                </div>
                                <div class="au-task js-list-load">
                                    <div class="au-task-list">
                                        <?php
                                        if ($notif_req == NULL) {
                                        ?>
                                        <div  class="au-task__item au-task__item">
                                            <div class="au-task__item-inner">
                                                <h5 class="task" style="font-weight: normal;">
                                                    Data not found
                                                </h5>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <?php
                                        foreach ($notif_req as $req){
                                            ?>
                                            <?php
                                            if ($req->type == 'approve'){
                                            ?>
                                            <div id="<?= $req->id_task ?>" class="au-task__item au-task__item--success btn-notif" style="cursor:pointer;">
                                            <?php } ?>

                                            <?php
                                            if ($req->type == 'reject'){
                                            ?>
                                            <div id="<?= $req->id_task ?>" class="au-task__item au-task__item--danger btn-notif" style="cursor:pointer;">
                                            <?php } ?>

                                            <?php
                                            if ($req->type == 'done'){
                                            ?>
                                            <div id="<?= $req->id_task ?>" class="au-task__item au-task__item--success btn-notif" style="cursor:pointer;">
                                            <?php } ?>

                                            <?php
                                            if ($req->type == 'cancel'){
                                            ?>
                                            <div id="<?= $req->id_task ?>" class="au-task__item au-task__item--danger btn-notif" style="cursor:pointer;">
                                            <?php } ?>

                                            <?php
                                            if ($req->type == 'comment request'){
                                            ?>
                                            <div id="<?= $req->id_task ?>" class="au-task__item au-task__item--success " style="cursor:pointer;">
                                            <?php } ?>

                                                <div id="<?= $req->id_task ?>" class="au-task__item-inner btn-notif" >

                                                        <?php
                                                        if ($req->type == 'approve'){
                                                            ?>
                                                            <?= $req->user_from ?> approved your request
                                                        <?php } ?>

                                                        <?php
                                                        if ($req->type == 'cancel'){
                                                            ?>
                                                            <?= $req->user_from ?> canceled your request
                                                        <?php } ?>

                                                        <?php
                                                        if ($req->type == 'reject'){
                                                            ?>
                                                            <?= $req->user_from ?> rejected your request
                                                        <?php } ?>

                                                        <?php
                                                        if ($req->type == 'done'){
                                                            ?>
                                                            <?= $req->user_from ?> completed your request
                                                        <?php } ?>

                                                        <?php
                                                        if ($req->type == 'comment request'){
                                                            ?>
                                                            <?= $req->user_from ?> comment your task
                                                        <?php } ?>
                                                    <span class="time pull-right"><small><?= date('d M Y h:i a',strtotime($req->created_at)) ?>&nbsp;&nbsp;</small></span>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
    </div>
</div>

<!-- MODAL-->
<div id="modal-user" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">

            <div id="content-modal"></div>

        </div>

    </div>
</div>

<!-- Jquery JS-->
<script src="<?php echo base_url('js/main.js') ?>"></script>
</body>

</html>
<!-- end document-->
<script type="text/javascript">
    $(".btn-notif").click(function(){
       var id = $(this).attr('id');
       window.location.href = "<?php echo base_url()?>task/"+id;
    });

    $(".btn-notif2").click(function(){
        var id = $(this).attr('id');
        window.location.href = "<?php echo base_url()?>task/"+id;
    });

    $(".btn-clear-req").click(function(){
        if (confirm('Are you sure you want to clear request notification?')) {
            $.ajax({
                url: "<?php echo base_url()?>mytask/clearnotifreq",
                type: 'pos',
                success: function (a) {
                    window.location.href = "<?php echo base_url()?>notification";
                }
            });
        }
    });

    $(".btn-clear-task").click(function(){
        if (confirm('Are you sure you want to clear task notification?')) {
            $.ajax({
                url: "<?php echo base_url()?>mytask/clearnotiftask",
                type: 'pos',
                success: function (a) {
                    window.location.href = "<?php echo base_url()?>notification";
                }
            });
        }
    });
</script>
</div>