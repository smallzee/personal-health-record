<?php
  require_once 'core/db.php';
  if(!admin())
  {
    header("location:login.php");
    exit();
  }

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
    $date_added = time();

    if (isset($_FILES['image'])){
        $file = $_FILES['image'];
        $file_name = $file['name'];

        $size = $file['size'];

        if ($size > 1048576){
            set_flash("Maximum image size should br 1MB","danger");
            header("location:new_patient.php");
        }

        $path = pathinfo($file_name,PATHINFO_EXTENSION);
        if (!in_array($path,array('jpg','png','jpeg'))){
            set_flash("Image file extension should be jpg,png,jpeg ","danger");
            header("location:new_patient.php");
        }
    }

    $image = time().$file_name;
    $folder = "../img/";

    $im = $folder.$image;

    if (move_uploaded_file($file['tmp_name'],$im)) {

        $in = $db->prepare("INSERT INTO patient(name, phone, email, address, town, blood_group, genotype, dob, gender, kin_name, kin_phone, kin_address, date_added,image) VALUES(:name,:phone,:email,:address,:town,:blood_group,:genotype,:dob,:gender,:kin_name,:kin_phone,:kin_address,:date_added,:image)");

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
            'date_added' => time(),
            'image'=>$image
        ));

        $in_id = $db->lastInsertId();
        $in->closeCursor();

        $patient_id = "LTH-" . $in_id;

        $up = $db->query("UPDATE patient SET patient_id = '$patient_id' WHERE id = '$in_id'");
        $up->closeCursor();

        set_flash("Patient record added successfully", "info");
        //header("location:new_patient.php");
        //exit();
    }
  }

  $page_title = "Add New Patient";
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

          <form action="" method="post" enctype="multipart/form-data">
            <?php flash(); ?>
            <div class="form-group">
              <label>Patient Name</label>
              <input type="text" name="name" class="form-control" required="" placeholder="Enter Patient Name">
            </div>
            

            <div class="form-group">
              <label>Patient Phone</label>
              <input type="text" name="phone" class="form-control" required="" placeholder="Enter Patient Phone Number">
            </div>

            <div class="form-group">
              <label>Patient Email</label>
              <input type="email" name="email" class="form-control" required="" placeholder="Enter Patient Email Address">
            </div>

            <div class="form-group">
              <label>Contact Address</label>
              <textarea name="address" required="" class="form-control" required="" placeholder="Contact Address"></textarea>
            </div>


            <div class="form-group">
              <label>Home Town</label>
              <input type="text" name="town" class="form-control" required="" placeholder="Home Town">
            </div>


            <div class="form-group">
              <label>Blood Group</label>
              <select class="form-control" required="" name="blood_group">
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
                <option value="">Genotype</option>
                <option>AA</option>
                <option>AS</option>                
                <option>SC</option>
                <option>SS</option>
              </select>
            </div>

            <div class="form-group">
              <label>DOB</label>
              <input type="date" name="dob" required="" class="form-control">
            </div>

            <div class="form-group">
              <label>Gender</label>
              <select class="form-control" required="" class="form-control" name="gender">
                <option value="">Gender</option>
                <option>Male</option>
                <option>Female</option>
              </select>
            </div>


            <div class="form-group">
              <label>Next of Kin Name</label>
              <input type="text" name="kin_name" required="" class="form-control" placeholder="Next of Kin Name">
            </div>


            <div class="form-group">
              <label>Next of Kin Phone Number</label>
              <input type="text" name="kin_phone" required="" class="form-control" placeholder="Next of Kin Phone Number">
            </div>

            <div class="form-group">
              <label>Next of Kin Contact Address</label>
              <textarea name="kin_address" required="" class="form-control" required="" placeholder="Next of Kin Contact Address"></textarea>
            </div>


              <div class="form-group">
                  <label for="">Image</label>
                  <input type="file" name="image" accept="image/*" id="">
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