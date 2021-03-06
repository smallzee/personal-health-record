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

  if (isset($_POST['transfer'])){
      $hospital_id = $_POST['hospital_id'];

      $db->query("UPDATE patient SET hospital_id='$hospital_id' WHERE id='$id'");

      set_flash("Patient has been transferred to ".get_hospital($hospital_id,'name'),'info');
      header("location:view_patient.php?id=$id");
      exit();
  }

  include_once 'head.php';
  include_once 'menu.php';
?>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Transfer Patient</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="" method="post">
                        <div class="form-group">
                            <label for="">Hospital Name</label>
                            <select name="hospital_id" id="" class="form-control" required>
                                <option value="" disabled selected>Select</option>
                                <?php
                                    $sql = $db->query("SELECT * FROM hospital ORDER BY name");
                                    while ($res = $sql->fetch(PDO::FETCH_ASSOC)){
                                        ?>
                                        <option value="<?= $res['id'] ?>"> <?= ucwords($res['name']) ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Transfer" name="transfer" id="">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
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

        <?php flash() ?>

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

            <table class="table table-bordered">
                <tr>
                    <td>Name</td>
                    <td><?php echo $rs['name']; ?></td>
                </tr>
                <tr>
                    <td>Phone Number</td>
                    <td><?php
                        echo $rs['phone'];
                        ?></td>
                </tr>
                <tr>
                    <td>Email Address</td>
                    <td><?php echo $rs['email']; ?></td>
                </tr>
                <tr>
                    <td>Contact Address</td>
                    <td><?php echo $rs['address']; ?></td>
                </tr>
                <tr>
                    <td>Home Town</td>
                    <td> <?php echo $rs['town']; ?></td>
                </tr>
                <tr>
                    <td>Blood Group</td>
                    <td> <?php echo $rs['blood_group']; ?></td>
                </tr>
                <tr>
                    <td>Genotype</td>
                    <td><?php echo $rs['genotype']; ?></td>
                </tr>
                <tr>
                    <td>Date Of Birth</td>
                    <td><?php echo $rs['dob']; ?></td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td><?php echo $rs['gender']; ?></td>
                </tr>
                <?php if ($rs['hospital_id'] != 0): ?>
                    <tr>
                        <td>Transferred Hospital Name</td>
                        <td><?php echo ucwords(get_hospital($rs['hospital_id'],'name')); ?></td>
                    </tr>
                    <tr>
                        <td>Transferred Hospital Address</td>
                        <td><?php echo get_hospital($rs['hospital_id'],'address'); ?></td>
                    </tr>
                <?php endif; ?>
            </table>

            <h5 class="page-header">Patient Next Of Kin</h5>
            <table class="table table-bordered">
                <tr>
                    <td>Next of Kin Name</td>
                    <td> <?php echo $rs['kin_name']; ?></td>
                </tr>
                <tr>
                    <td>Next of Kin Phone</td>
                    <td><?php echo $rs['kin_phone']; ?></td>
                </tr>
                <tr>
                    <td>Next of Kin Address</td>
                    <td><?php echo $rs['kin_address']; ?></td>
                </tr>
            </table>

           <h3>Medical Record</h3>

            <a href="" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary" style="margin-bottom: 20px;">Transfer Patient</a>

            <table class="table table-bordered" id="tables">
                <thead>
                <tr>
                    <th>SN</th>
                    <th>Doctor Treatment</th>
                    <th>Doctor In-Charge</th>
                    <th>Specialist</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>SN</th>
                    <th>Doctor Treatment</th>
                    <th>Doctor In-Charge</th>
                    <th>Specialist</th>
                    <th>Date</th>
                </tr>
                </tfoot>
                <tbody>
                <?php
                $sn =1;
                $patient_id = $rs['patient_id'];
                $records = $db->query("SELECT * FROM medical_history WHERE patient_id = '$patient_id'");

                while ($recs = $records->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <tr>
                        <td><?= $sn++ ?></td>
                        <td><?php echo nl2br($recs['comment']); ?></td>
                        <td><?php echo doctor($recs['doctor_id'],"name"); ?></td>
                        <td><?= doctor($recs['doctor_id'],'speciality') ?></td>
                        <td><?php echo date("F d y, h:i a",$recs['date_added']); ?></td>
                    </tr>
                    <?php
                }


                ?>
                </tbody>
            </table>

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