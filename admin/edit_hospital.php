<?php
require_once 'core/db.php';
if(!admin())
{
    header("location:login.php");
    exit();
}

if (!isset($_GET['id']) or empty($_GET['id'])){
    header("location:index.php");
    exit();
}
$hospital_id = $_GET['id'];
$sql = $db->query("SELECT * FROM hospital WHERE id='$hospital_id'");
$rs = $sql->fetch(PDO::FETCH_ASSOC);


if(isset($_POST['ok'])){
    $name = $_POST['name'];
    $address = $_POST['address'];

    $errors = array();

    if (!preg_match("/^[a-zA-Z]/", $name))
    {
        $errors[] = "Invalid hospital name, it should be only characters";
    }


    if(count($errors) == 0){

        $db->query("UPDATE hospital SET name='$name', address='$address' WHERE id='$hospital_id'");

        set_flash("Hospital details updated successfully","info");
        header("location:edit_hospital.php?id=$hospital_id");
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

$page_title = "Add New Hospital";
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
                            <label>Hospital Name</label>
                            <input type="text" value="<?= $rs['name'] ?>" name="name" class="form-control" required="" placeholder="Enter Hospital Name">
                        </div>

                        <div class="form-group">
                            <label>Hospital Address</label>
                            <input type="text" value="<?= $rs['address'] ?>" name="address" class="form-control" required="" placeholder="Enter Hospital Address">
                        </div>

                        <div class="form-group">
                            <input type="submit" name="ok" class="btn btn-info" value="Update">
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