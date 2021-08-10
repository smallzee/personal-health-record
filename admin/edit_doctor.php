<?php
  require_once 'core/db.php';
  if(!admin())
  {
    header("location:login.php");
    exit();
  }

  $page_title = "Edit Doctor";
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
          <?php flash(); ?>
          <table class="table table-bordered" id="tables">
            <thead>
              <tr>
                <th>Sn</th>
                <th>Doctor Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Speciality</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $sql = $db->query("SELECT * FROM doctor");
                $n = 0;
                while($rs = $sql->fetch(PDO::FETCH_ASSOC)){
                  ?>
                  <tr>
                    <td>
                      <?php echo ++$n; ?>
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
                      <?php echo $rs['speciality']; ?>
                    </td>
                    <td>
                      <a href="editing_doctors.php?id=<?php echo $rs['id']; ?>" class="btn btn-default btn-sm"><i class="fa fa-edit"></i> Edit</a>
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