<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo" style="background: #1e7fe8;">
        <a href="#" style="width: 83%;">
            <img src="<?php echo base_url('images/icon/monita3.png') ?>" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <?php
                if ($this->session->role == 'admin') {
                  if ($this->uri->segment(1) == 'category' || $this->uri->segment(1) == 'users' || $this->uri->segment(1) == 'manage_task') {
                    $display = 'block';
                  }
                  else {
                    $display = 'none';
                  }
                ?>
                <li class="has-sub" >
                    <a class="js-arrow" href="#">
                        <i class="fas fa-cogs"></i>Manage <i class="pull-right fa fa-angle-down"></i></a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list" style="display:<?= $display ?>">
                      <li class="<?php echo $this->uri->segment(1) == 'manage_task' ? 'active': '' ?>">
                          <a href="<?php echo base_url(); ?>manage_task">
                          <i class="fas fa-th-large"></i> All Task</a>
                      </li>
                      <li class="<?php echo $this->uri->segment(1) == 'category' ? 'active': '' ?>">
                          <a href="<?php echo base_url(); ?>category">
                          <i class="fas fa-tag"></i> Category</a>
                      </li>
                      <li class="<?php echo $this->uri->segment(1) == 'users' ? 'active': '' ?>">
                          <a href="<?php echo base_url(); ?>users">
                          <i class="fas fa-user"></i> Users</a>
                      </li>
                    </ul>
                </li>
                <?php } ?>

                <li class="<?php echo $this->uri->segment(1) == 'dashboard' ? 'active': '' ?>">
                    <a href="<?php echo base_url(); ?>dashboard">
                    <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                <li class="<?php echo $this->uri->segment(1) == 'mytask' ? 'active': '' ?>">
                    <a href="<?php echo base_url(); ?>mytask"><i class="fas fa-list-alt"></i> My Task</a>
                </li>
                <li class="<?php echo $this->uri->segment(1) == 'myrequest' ? 'active': '' ?>">
                    <a href="<?php echo base_url(); ?>myrequest"><i class="fas fa-outdent"></i> My Request</a>
                </li>
                <li class="<?php echo $this->uri->segment(1) == 'monitoring' ? 'active': '' ?>">
                    <a href="<?php echo base_url(); ?>monitoring">
                    <i class="fas fa-laptop"></i>Task Monitor</a>
                </li>
                <li class="<?php echo $this->uri->segment(1) == 'mycalendar' ? 'active': '' ?>">
                    <a href="<?php echo base_url(); ?>mycalendar">
                        <i class="fas fa-calendar-alt"></i> My Calendar</a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
