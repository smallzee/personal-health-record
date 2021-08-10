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
  $sql = $db->query("SELECT * FROM patient WHERE id = '$id' or patient_id = '$id'");

  if($sql->rowCount() == 0){
    header("location:index.php");
    exit();
  }

  $rs = $sql->fetch(PDO::FETCH_ASSOC);

  $page_title = "Patient Record - ".$rs['name'];
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

          <h4>Name</h4>
          <p>
            <?php echo $rs['name']; ?>
          </p>

          <h4>Phone Number</h4>
          <p>
            <?php 
              echo $rs['phone'];
             ?>
          </p>

           <h4>Email Address</h4>
           <p>
             <?php echo $rs['email']; ?>
           </p>

           <h4>Contact Address</h4>
           <p>
             <?php echo $rs['address']; ?>
           </p>

           <h4>Home Town</h4>
           <p>
             <?php echo $rs['town']; ?>
           </p>

           <h4>Blood Group</h4>
           <p>
             <?php echo $rs['blood_group']; ?>
           </p>

           <h4>Genotype</h4>
           <p>
             <?php echo $rs['genotype']; ?>
           </p>

           <h4>DOB</h4>
           <p>
             <?php echo $rs['dob']; ?>
           </p>

           <h4>Gender</h4>
           <p>
             <?php echo $rs['gender']; ?>
           </p>

           <h4>Next of Kin Name</h4>
           <p>
             <?php echo $rs['kin_name']; ?>
           </p>

           <h4>Next of Kin Phone</h4>
           <p>
             <?php echo $rs['kin_phone']; ?>
           </p>

           <h4>Next of Kin Address</h4>
           <p>
             <?php echo $rs['kin_address']; ?>
           </p>


           <h3>Medical Record</h3>
           <?php
            $patient_id = $rs['patient_id'];

            $records = $db->query("SELECT * FROM medical_history WHERE patient_id = '$patient_id'");
            if($records->rowCount() == 0){
              echo "<p>User does not have a medical history!</p>";
            }

            while($recs = $records->fetch(PDO::FETCH_ASSOC)){
              ?>
              <div class="panel panel-default">
                <div class="panel-heading">Date - <?php echo date("F d y, h:i a",$recs['date_added']); ?></div>
                <div class="panel-body">
                  <h3>Doctor Comments</h3>
                  <p>
                    <?php echo nl2br($recs['comment']); ?>
                  </p>
                </div>
                <div class="panel-footer">
                  Doctor in Charge: <?php echo doctor($recs['doctor_id'],"name"); ?>
                </div>
              </div>
              <br>
              <?php
            }
           ?>

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