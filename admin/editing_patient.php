<?php
  require_once 'core/db.php';
  if(!admin())
  {
    header("location:login.php");
    exit();
  }

  if(!isset($_GET['id'])){
    header("location:patient.php");
    exit();
  }
  $id = $_GET['id'];
  $sql = $db->query("SELECT * FROM patient WHERE id = '$id'");

  if($sql->rowCount() == 0){
    header("location:index.php");
    exit();
  }

  $rs = $sql->fetch(PDO::FETCH_ASSOC);

  if(isset($_POST['ok'])){
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $town = $_POST['town'];
    $blood_group = $_POST['blood_group'];
    $genotype = $_POST['genotype'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $kin_name = $_POST['kin_name'];
    $kin_phone = $_POST['kin_phone'];
    $kin_address = $_POST['kin_address'];

    $in = $db->prepare("UPDATE patient SET name = :name, phone = :phone, email = :email, address = :address, town = :town, blood_group = :blood_group, genotype = :genotype, dob = :dob, gender = :gender, kin_name = :kin_name, kin_phone = :kin_phone, kin_address = :kin_address WHERE id = :id");

    $in->execute(array(
      'name' => $name,
      'phone' => $phone,
      'email' => $email,
      'address' => $address,
      'town' => $town,
      'blood_group' => $blood_group,
      'genotype' => $genotype,
      'dob' => $dob,
      'gender' => $gender,
      'kin_name' => $kin_name,
      'kin_phone' => $kin_phone,
      'kin_address' => $kin_address,
      'id' => $id
    ));

    $in->closeCursor();


    set_flash("Patient record edited successfully","info");
    header("location:edit_patient.php");
    exit();
  }

  $page_title = "Edit Patient - ".$rs['name'];
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
              <label>Patient Name</label>
              <input type="text" name="name" class="form-control" required="" placeholder="Enter Patient Name" value="<?php echo $rs['name']; ?>">
            </div>
            

            <div class="form-group">
              <label>Patient Phone</label>
              <input type="text" name="phone" class="form-control" required="" placeholder="Enter Patient Phone Number" value="<?php echo $rs['phone']; ?>">
            </div>

            <div class="form-group">
              <label>Patient Email</label>
              <input type="email" name="email" class="form-control" required="" placeholder="Enter Patient Email Address" value="<?php echo $rs['email']; ?>">
            </div>

            <div class="form-group">
              <label>Contact Address</label>
              <textarea name="address" required="" class="form-control" required="" placeholder="Contact Address"><?php echo $rs['address']; ?></textarea>
            </div>


            <div class="form-group">
              <label>Home Town</label>
              <input type="text" name="town" class="form-control" required="" placeholder="Home Town" value="<?php echo $rs['town']; ?>">
            </div>


            <div class="form-group">
              <label>Blood Group</label>
              <select class="form-control" required="" name="blood_group">
                <option><?php echo $rs['blood_group']; ?></option>
                <option value="">Blood Group</option>
                <option>A+</option>
                <option>A-</option>
                <option>AB+</option>
                <option>AB-</option>
                <option>B+</option>
                <option>B+</option>
                <option>O+</option>
                <option>O-</option>
              </select>
            </div>


            <div class="form-group">
              <label>Genotype</label>
              <select class="form-control" required="" name="genotype">
                <option><?php echo $rs['genotype']; ?></option>
                <option value="">Genotype</option>
                <option>AA</option>
                <option>AS</option>                
                <option>SC</option>
                <option>SS</option>
              </select>
            </div>

            <div class="form-group">
              <label>DOB</label>
              <input type="date" name="dob" required="" class="form-control" value="<?php echo $rs['dob']; ?>">
            </div>

            <div class="form-group">
              <label>Gender</label>
              <select class="form-control" required="" class="form-control" name="gender">
                <option><?php echo $rs['gender']; ?></option>
                <option value="">Gender</option>
                <option>Male</option>
                <option>Female</option>
              </select>
            </div>


            <div class="form-group">
              <label>Next of Kin Name</label>
              <input type="text" name="kin_name" required="" class="form-control" placeholder="Next of Kin Name" value="<?php echo $rs['kin_name']; ?>">
            </div>


            <div class="form-group">
              <label>Next of Kin Phone Number</label>
              <input type="text" name="kin_phone" required="" class="form-control" placeholder="Next of Kin Phone Number" value="<?php echo $rs['kin_phone']; ?>">
            </div>

            <div class="form-group">
              <label>Next of Kin Contact Address</label>
              <textarea name="kin_address" required="" class="form-control" required="" placeholder="Next of Kin Contact Address"><?php echo $rs['kin_address']; ?></textarea>
            </div>



            <div class="form-group">
              <input type="submit" name="ok" class="btn btn-success" value="Update Record">
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