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

          <li>
            <a href="search.php"><i class="fa fa-search"></i> Search Patient</a>
          </li>
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">              
              <span class="hidden-xs"><i class="fa fa-user"></i> <?php echo $admin_name; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">                
                <p><?php echo $admin_name ?> - <?php echo $admin_role; ?></p>
              </li>              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="password.php" class="btn btn-default btn-flat">Update Password</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->          
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
          <a href="index.php">
            <i class="fa fa-dashboard "></i> <span>Dashboard</span>
          </a>          
        </li>

          <li class="header">PATIENTS</li>

          <li>
              <a href="patient.php">
                  <i class="fa fa-file-o text-aqua"></i> <span>All Patient</span>
              </a>
          </li>
          <li>
              <a href="edit_patient.php">
                  <i class="fa fa-pencil text-aqua"></i> <span>Edit Patient</span>
              </a>
          </li>
          <li>
              <a href="new_patient.php">
                  <i class="fa fa-plus text-aqua"></i> <span>Add New Patient</span>
              </a>
          </li>

          <li class="header">DOCTORS</li>
          <li>
              <a href="all_doctors.php">
                  <i class="fa fa-th text-success"></i> <span>All Doctors</span>
              </a>
          </li>

          <li>
              <a href="edit_doctor.php">
                  <i class="fa fa-folder-o text-success"></i> <span>Edit Doctor</span>
              </a>
          </li>

          <li>
              <a href="add_doctor.php">
                  <i class="fa fa-plus text-success"></i> <span>Add New Doctor</span>
              </a>
          </li>

          <li class="header">HEALTH RECORD</li>

          <li>
             <a href="new_record.php">
               <i class="fa fa-edit text-blue"></i> <span>New Medical Record</span>
             </a>
        </li>

          <li class="header">HOSPITAL</li>

          <li>
              <a href="add_hospital.php">
                  <i class="fa fa-plus text-blue"></i> <span>Hospital</span>
              </a>
          </li>

          <li>
              <a href="all_hospital.php">
                  <i class="fa fa-plus text-blue"></i> <span>All Hospitals</span>
              </a>
          </li>


          <li class="header">SETTINGS</li>


        <li>
            <a href="password.php"><i class="fa fa-circle text-blue"></i>
                <span>Update Password</span>
            </a>
        </li>

        <li>
            <a href="logout.php"><i class="fa fa-sign-out text-red"></i>
                <span>Logout</span>
            </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>