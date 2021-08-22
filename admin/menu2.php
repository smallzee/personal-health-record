<?php
$admin_name = "Admin";
$admin_role = "Global Admin";
?>
<header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>Pers</b>on</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Personal</b> Health</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

<!--                <li>-->
<!--                    <a href="search.php"><i class="fa fa-search"></i> Search Patient</a>-->
<!--                </li>-->


            </ul>
        </div>
    </nav>
</header>

<!-- =============================================== -->
<!-- =============================================== -->

<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">

        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li>
                <a href="dashboard.php">
                    <i class="fa fa-dashboard "></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="header">PATIENTS</li>

            <li>
                <a href="patients.php">
                    <i class="fa fa-file-o text-aqua"></i> <span>All Patient</span>
                </a>
            </li>
<!--            <li>-->
<!--                <a href="edit_patients.php">-->
<!--                    <i class="fa fa-pencil text-aqua"></i> <span>Edit Patient</span>-->
<!--                </a>-->
<!--            </li>-->

            <li class="header">DOCTORS</li>
            <li>
                <a href="all_doctor.php">
                    <i class="fa fa-th text-success"></i> <span>All Doctors</span>
                </a>
            </li>

            <li>
                <a href="edit_doctors.php">
                    <i class="fa fa-folder-o text-success"></i> <span>Edit Doctor</span>
                </a>
            </li>

            <li>
                <a href="add_doctors.php">
                    <i class="fa fa-plus text-success"></i> <span>Add New Doctor</span>
                </a>
            </li>

            <li class="header">HEALTH RECORD</li>

            <li>
                <a href="new_records.php">
                    <i class="fa fa-edit text-blue"></i> <span>New Medical Record</span>
                </a>
            </li>

            <li>
                <a href="logouts.php"><i class="fa fa-sign-out text-red"></i>
                    <span>Logout</span>
                </a>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>