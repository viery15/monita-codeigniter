<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 2/10/2019
 * Time: 11:55 AM
 */
?>


<?php header('Access-Control-Allow-Origin: *'); ?>

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
                            <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                                <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');">
                                    <div class="bg-overlay bg-overlay--blue"></div>
                                    <h3>
                                        <i class="fa fa-tasks"></i>Notification of My Tasks</h3>
                                </div>
                                <div class="au-task js-list-load">
                                    <div class="au-task-list">

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
                                                <h5 class="task">
                                                    <?php
                                                    if ($task->type == 'new'){
                                                    ?>
                                                    <a href="#">You got a new task from <?= $task->user_from ?></a>
                                                    <?php } ?>

                                                    <?php
                                                    if ($task->type == 'comment task'){
                                                        ?>
                                                        <a href="#"><?= $task->user_from ?> comment on your task </a>
                                                    <?php } ?>
                                                </h5>
                                                <span class="time"><?= date('d M Y h:i a',strtotime($task->created_at)) ?></span>
                                            </div>
                                        </div>
                                        <?php } ?>

                                    </div>
                                </div>


                            </div>
                    </div>

<!--                        // NOTIF REQUEST-->
                        <div class="col-lg-6">
                            <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                                <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');">
                                    <div class="bg-overlay bg-overlay--blue"></div>
                                    <h3>
                                        <i class="fa fa-tasks"></i>Notification of My Requests</h3>
                                </div>
                                <div class="au-task js-list-load">
                                    <div class="au-task-list">
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
                                            if ($req->type == 'comment request'){
                                            ?>
                                            <div id="<?= $req->id_task ?>" class="au-task__item au-task__item--success btn-notif" style="cursor:pointer;">
                                            <?php } ?>

                                                <div class="au-task__item-inner">
                                                    <h5 class="task">
                                                        <?php
                                                        if ($req->type == 'approve'){
                                                            ?>
                                                            <a href="#">Your request has been approved by <?= $req->user_from ?></a>
                                                        <?php } ?>

                                                        <?php
                                                        if ($req->type == 'reject'){
                                                            ?>
                                                            <a href="#">Your request has been rejected by <?= $req->user_from ?></a>
                                                        <?php } ?>

                                                        <?php
                                                        if ($req->type == 'done'){
                                                            ?>
                                                            <a href="#">Your request to <?= $req->user_from ?> is completed</a>
                                                        <?php } ?>

                                                        <?php
                                                        if ($req->type == 'comment request'){
                                                            ?>
                                                            <a href="#"><?= $req->user_from ?> comment on your task </a>
                                                        <?php } ?>
                                                    </h5>
                                                    <span class="time"><?= date('d M Y h:i a',strtotime($req->created_at)) ?></span>
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
</script>