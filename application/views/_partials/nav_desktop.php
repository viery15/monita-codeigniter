<?php
$this->ci =& get_instance();
$this->ci->load->model('notification_model');
$data = $this->ci->notification_model->getByUserTarget();

?>
<header class="header-desktop" style="background: #4b9ef9;">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap">
                <form class="form-header" action="" method="POST">
                </form>
                <div class="header-button">
                <div class="noti-wrap">
                    <div class="noti__item js-item-menu">
                        <i style="color: white;" class="zmdi zmdi-notifications"></i>
<!--                        <span class="quantity">3</span>-->
                        <div class="notifi-dropdown js-dropdown">
<!--                            <div class="notifi__title">-->
<!--                                <p>You have 3 Notifications</p>-->
<!--                            </div>-->
                            <?php
                            foreach ($data as $data) {
                            ?>
                            <div class="notifi__item notif" id="<?= $data->id_task ?>">
                                    <?php
                                    if ($data->type == 'new') {
                                        ?>
                                <div class="bg-c3 img-cir img-40">
                                        <i class="fa fa-envelope"></i>
                                </div>
                                    <?php } ?>

                                <?php
                                if ($data->type == 'comment task' || $data->type == 'comment request') {
                                    ?>
                                    <div class="bg-c1 img-cir img-40">
                                        <i class="fa fa-comments"></i>
                                    </div>
                                <?php } ?>

                                <?php
                                if ($data->type == 'done') {
                                    ?>
                                    <div class="bg-c1 img-cir img-40">
                                        <i class="fa fa-check-circle"></i>
                                    </div>
                                <?php } ?>

                                <?php
                                if ($data->type == 'cancel') {
                                    ?>
                                    <div class="bg-c2 img-cir img-40">
                                        <i class="fa fa-close"></i>
                                    </div>
                                <?php } ?>

                                <?php
                                if ($data->type == 'reject') {
                                    ?>
                                    <div class="bg-c2 img-cir img-40">
                                        <i class="fa fa-close"></i>
                                    </div>
                                <?php } ?>

                                    <?php
                                    if ($data->type == 'approve') {
                                        ?>
                                        <div class="bg-c1 img-cir img-40">
                                            <i class="fa fa-check"></i>
                                        </div>
                                    <?php } ?>

                                <div class="content">
                                    <?php
                                    if ($data->type == 'new') {
                                    ?>
                                    <p><?= $data->user_from ?> sent you new request </p>
                                    <?php } ?>

                                    <?php
                                    if ($data->type == 'comment task') {
                                        ?>
                                        <p><?= $data->user_from ?> commented your task </p>
                                    <?php } ?>

                                    <?php
                                    if ($data->type == 'cancel') {
                                        ?>
                                        <p><?= $data->user_from ?> canceled your request </p>
                                    <?php } ?>

                                    <?php
                                    if ($data->type == 'comment request') {
                                        ?>
                                        <p><?= $data->user_from ?> commented your request </p>
                                    <?php } ?>

                                    <?php
                                    if ($data->type == 'done') {
                                        ?>
                                        <p><?= $data->user_from ?> completed your request</p>
                                    <?php } ?>

                                    <?php
                                    if ($data->type == 'reject') {
                                        ?>
                                        <p><?= $data->user_from ?> rejected your request </p>
                                    <?php } ?>
                                    <?php
                                    if ($data->type == 'approve') {
                                        ?>
                                        <p><?= $data->user_from ?> approved your request </p>
                                    <?php } ?>
                                    <span class="date"><?= date('d M Y H:i a', strtotime($data->created_at)) ?></span>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="notifi__footer">
                                <a href="<?= base_url() ?>notification">All notifications</a>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="account-wrap">
                        <div class="account-item clearfix js-item-menu">
                            <div class="image">
                                <img src="<?php echo base_url('images/icon/avatar-01.jpg') ?>" alt="John Doe" />
                            </div>
                            <div class="content" >
                                <a class="js-acc-btn" style="color:#e9ecef;" href="#"><?= $this->session->nik ?></a>
                            </div>
                            <div class="account-dropdown js-dropdown">
                                <div class="info clearfix">
                                    <div class="image">
                                        <a href="#">
                                            <img src="<?php echo base_url('images/icon/avatar-01.jpg') ?>" alt="John Doe" />
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h5 class="name">
                                            <a href="#"><?= $this->session->nik ?></a>
                                        </h5>
                                        <span class="email">Last Login: <br><?= $this->session->last_login ?></span>
                                    </div>
                                </div>
                                <div class="account-dropdown__body">
                                    <div class="account-dropdown__item">
                                        <a href="<?php echo base_url(); ?>logout">
                                            <i class="zmdi zmdi-power"></i>Logout</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<script type="text/javascript">
    $(".notif").click(function(){
        var id = $(this).attr("id");
        window.location.href = "<?php echo base_url()?>task/"+id;
    });
</script>
