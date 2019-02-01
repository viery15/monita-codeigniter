<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="<?php echo base_url('images/icon/logo.png') ?>" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li>
                    <a href="<?php echo base_url(); ?>dashboard">
                    <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                <li class="active has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-tasks"></i>Task</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="<?php echo base_url(); ?>mytasks"><i class="fas fa-list-alt"></i> My Tasks</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>myrequest"><i class="fas fa-outdent"></i> My Request</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>monitoring">
                    <i class="fas fa-laptop"></i>Monitoring</a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>Users">
                    <i class="fas fa-user"></i>Users</a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
