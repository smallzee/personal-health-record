<?php
  require_once 'core/db.php';
  if(!admin())
  {
    header("location:login.php");
    exit();
  }

  $page_title = "All Patient";
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
          <h3>All Patient</h3>
          <?php flash(); ?>
          <table class="table table-bordered" id="tables">
            <thead>
              <tr>
                <th>Sn</th>
                <th>Image</th>
                <th>Patient No</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Blood Group</th>
                <th>Genotype</th>
                <th>Age</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $sql = $db->query("SELECT * FROM patient");
                $n = 0;
                while($rs = $sql->fetch(PDO::FETCH_ASSOC)){
                  ?>
                  <tr>
                    <td>
                      <?php echo ++$n; ?>
                    </td>
                      <td><img src="../img/<?= $rs['image'] ?>" style="width: 50px; height: 50px; border-radius: 10px;" alt=""></td>
                    <td>
                      <?php echo $rs['patient_id']; ?>
                    </td>
                    <td>
                      <?php echo $rs['name']; ?>
                    </td>
                    <td>
                      <?php echo $rs['phone']; ?>
                    </td>
                    <td>
                      <?php echo $rs['email']; ?>
                    </td>
                    <td>
                      <?php echo $rs['blood_group']; ?>
                    </td>
                    <td>
                      <?php echo $rs['genotype']; ?>
                    </td>
                    <td>
                      <?php
                        $year = substr($rs['dob'],0,4);
                        $now = date("Y");

                        $age = $now - $year;
                        echo $age;
                      ?>
                    </td>
                    <td>
                      <a href="view_patient.php?id=<?php echo $rs['id']; ?>" class="btn btn-info btn-sm"><i class="fa fa-folder-o"></i> View Record</a>
                    </td>
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