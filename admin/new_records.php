<?php
  require_once 'core/db.php';
  if(!is_hospital())
  {
    header("location:../transferred.php");
    exit();
  }

  if(isset($_POST['ok'])){
    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $comment = $_POST['comment'];
    $date_added = time();

    $in = $db->prepare("INSERT INTO medical_history(patient_id, doctor_id, comment, date_added) VALUES(:patient_id, :doctor_id, :comment, :date_added)");

    $in->execute(array(
      'patient_id' => $patient_id,
      'doctor_id' => $doctor_id,
      'comment' => $comment,
      'date_added' => time()
    ));


    set_flash("Patient medical record added successfully","info");
    header("location:new_record.php");
    exit();
  }

  $page_title = "Add New Medical Record";
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
              <label>Patient ID</label>
              <select class="form-control select2_single" name="patient_id" required="">
                <option value="">Select Patient Id</option>
                <?php
                $id = get_patient('id');
                  $pat = $db->query("SELECT patient_id,name FROM patient WHERE id='$id'");
                  while($pat_rs = $pat->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <option value="<?php echo $pat_rs['patient_id']; ?>"><?php echo $pat_rs['name'] ?> - <?php echo $pat_rs['patient_id']; ?></option>
                    <?php
                  }
                ?>
              </select>
            </div>
            

            <div class="form-group">
              <label>Doctor Name</label>
              <select class="form-control select2_single" name="doctor_id" required="">
                <option value="">Select Doctor Name</option>
                <?php
                $hospital_id = get_patient('hospital_id');
                  $pat = $db->query("SELECT id,name FROM doctor WHERE hospital_id='$hospital_id'");
                  while($pat_rs = $pat->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <option value="<?php echo $pat_rs['id']; ?>"><?php echo $pat_rs['name'] ?></option>
                    <?php
                  }
                ?>
              </select>
            </div>
            

            <div class="form-group">
              <label>Medical Record Information</label>
              <textarea name="comment" required="" class="form-control" placeholder="Medical Record Information"></textarea>
            </div>


            

            <div class="form-group">
              <input type="submit" name="ok" class="btn btn-info" value="Submit">
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