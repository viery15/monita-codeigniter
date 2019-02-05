<header class="header-desktop" style="background: #4b9ef9;">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap">
                <form class="form-header" action="" method="POST">
                </form>
                <div class="header-button">
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
