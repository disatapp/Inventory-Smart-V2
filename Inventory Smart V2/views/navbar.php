<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo URL; ?>">Inventory Smart 2</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#"><i class="fa fa-user fa-fw"></i> <?php echo Sessions::get('USERNAME'); ?></a>
                </li>
                <li><a href="<?php echo URL; ?>signup"><i class="fa fa-gear fa-fw"></i> เพิ่มผู้ใช้ใหม่</a>
                </li>
                <li class="divider"></li>
                <li><a href="<?php echo URL; ?>login"><i class="fa fa-sign-out fa-fw"></i> ออกจากระบบ</a>

            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="<?php echo URL; ?>dashboard"><i class="fa fa-dashboard fa-fw"></i> ประกาศ</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> คำสั่งซื้อ<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo URL; ?>order"> ซื้อ</a>
                        </li>
                        <li>
                            <a href="<?php echo URL; ?>order/find"> ค้นหา</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> คำสั่งขาย<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo URL; ?>sell"> ขาย</a>
                        </li>
                        <li>
                            <a href="<?php echo URL; ?>sell/find"> ค้นหา</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> ค้นหาข้อมูล<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo URL; ?>cus"> ลูกค้า</a>
                        </li>
                        <li>
                            <a href="<?php echo URL; ?>parts"> สินค้า</a>
                        </li>
                        <li>
                            <a href="<?php echo URL; ?>suppliers"> บริษัทผู้จัดส่ง</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li> 
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> ท่อเตาบ่ม<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo URL; ?>pipe"> ขาย</a>
                        </li>
                        <li>
                            <a href="<?php echo URL; ?>pipe/manage"> ค้นหาและแก้ไข</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw">print</i><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo URL; ?>printing"> print invoice</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>

