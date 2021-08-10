<?php
  require_once 'core/db.php';
  if(!admin())
  {
    header("location:login.php");
    exit();
  }

  if(isset($_POST['ok'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];

    $name = $fname." ".$lname;
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $speciality = $_POST['speciality'];

    $errors = array();

    if (!preg_match("/^[a-zA-Z]/", $fname)) 
    {
      $errors[] = "Invalid doctor first name, it should be only characters";
    }

    if (!preg_match("/^[a-zA-Z]/", $lname)) 
    {
      $errors[] = "Invalid doctor first name, it should be only characters";
    }

    if (strlen($phone) != 11) 
    {
      $errors[] = "Your phone number should be 11 digit number not ".strlen($phone)." digit number";
    }

    if(!is_numeric($phone)){
      $errors[] = "Invalid phone number, only numbers are allowed!";
    }

    if (strlen($email) < 8) 
    {
      $errors[] = "Your email address should be at least 8 characters";
    }

    if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email))
    {
      $errors[] = "Invalid email address";
    }

    if(count($errors) == 0){
        $save = $db->prepare("INSERT INTO doctor(name, phone, email, speciality) VALUES(:name, :phone, :email, :speciality)");
        $save->execute(array(
          'name' => $name,
          'phone' => $phone,
          'email' => $email,
          'speciality' => $speciality
        ));

        set_flash("Doctor added successfully","info");
        header("location:add_doctor.php");
        exit();
    }else{
      $msg = "The following error(s) occur, please fix and try again!<ul>";
      foreach ($errors as $key) {
        $msg .= "<li>$key</li>";
      }

      $msg .= "</ul>";

      set_flash($msg,"warning");
    }


  }

  $page_title = "Add New Doctor";
  $title = $page_title;
  include_once 'head.php';
  include_once 'menu.php';
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $page_title; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $page_title; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo $page_title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>            
          </div>
        </div>
        <div class="box-body">
          <h3><?php echo $page_title; ?></h3>
          <form action="" method="post">
            <?php flash(); ?>
            <div class="form-group">
              <label>Doctor First Name</label>
              <input type="text" name="fname" class="form-control" required="" placeholder="Enter Doctor First Name">
            </div>

            <div class="form-group">
              <label>Doctor Last Name</label>
              <input type="text" name="lname" class="form-control" required="" placeholder="Enter Doctor Last Name">
            </div>

            <div class="form-group">
              <label>Doctor Phone</label>
              <input type="text" name="phone" class="form-control" required="" placeholder="Enter Doctor Phone Number">
            </div>

            <div class="form-group">
              <label>Doctor Email</label>
              <input type="email" name="email" class="form-control" required="" placeholder="Enter Doctor Email Address">
            </div>

            <div class="form-group">
              <label>Speciality</label>
              <input type="text" name="speciality" class="form-control" required="" placeholder="Enter Doctor Speciality">
            </div>

            <div class="form-group">
              <input type="submit" name="ok" class="btn btn-info" value="Add">
            </div>
          </form>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          &nbsp;
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
  include_once 'foot.php';
?>