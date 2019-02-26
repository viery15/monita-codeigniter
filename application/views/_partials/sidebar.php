<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo" style="background: #1e7fe8;">
        <a href="#" style="width: 83%;">
            <img src="<?php echo base_url('images/icon/monita3.png') ?>" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="<?php echo $this->uri->segment(1) == 'dashboard' ? 'active': '' ?>">
                    <a href="<?php echo base_url(); ?>dashboard">
                    <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                <li class="<?php echo $this->uri->segment(1) == 'mycalendar' ? 'active': '' ?>">
                    <a href="<?php echo base_url(); ?>mycalendar">
                        <i class="fas fa-calendar-alt"></i> My Calendar</a>
                </li>
                <li class="<?php echo $this->uri->segment(1) == 'mytask' ? 'active': '' ?>">
                    <a href="<?php echo base_url(); ?>mytask"><i class="fas fa-list-alt"></i> My Task</a>
                </li>
                <li class="<?php echo $this->uri->segment(1) == 'myrequest' ? 'active': '' ?>">
                    <a href="<?php echo base_url(); ?>myrequest"><i class="fas fa-outdent"></i> My Request</a>
                </li>
                <li class="<?php echo $this->uri->segment(1) == 'monitoring' ? 'active': '' ?>">
                    <a href="<?php echo base_url(); ?>monitoring">
                    <i class="fas fa-laptop"></i>Monitoring</a>
                </li>
                <?php
                if ($this->session->role == 'admin') {
                ?>
                <li class="<?php echo $this->uri->segment(1) == 'category' ? 'active': '' ?>">
                    <a href="<?php echo base_url(); ?>category">
                    <i class="fas fa-tag"></i> Category</a>
                </li>
                <li class="<?php echo $this->uri->segment(1) == 'users' ? 'active': '' ?>">
                    <a href="<?php echo base_url(); ?>users">
                    <i class="fas fa-user"></i> Users</a>
                </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</aside>
