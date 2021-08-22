<?php
require_once 'core/all.php';

if(isset($_POST['ok'])){

    $sql = $db->prepare("SELECT * FROM patient WHERE patient_id = :patient_id");
    $sql->execute(
        array(
            'patient_id' => $_POST['patient_id']
        )
    );
    $n = $sql->rowCount();
    //var_dump(md5($_POST['password']."@#$"));
    //exit();

    if($n == 0){
        set_flash("Invalid login details","danger");
        $sql->closeCursor();
    }else{
        $rs = $sql->fetch(PDO::FETCH_ASSOC);
        $id = $rs['id'];
        $_SESSION['patient'] = $id;
        //$_SESSION['admin_role'] = 1;
        $sql->closeCursor();
        header("location:admin/patient_record.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title> Patient Login</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=Edge"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="css/custom.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="css/skins/_all-skins.min.css">
</head>
<body>
<!-- Site wrapper -->
<div class="container" style='margin-top: 45px;'>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="main-bg">
                <div class="inner-bg">
                    <h3 class="page-header"><i class="fa fa-lock"></i> Patient Login</h3>
                    <form action="" method="post" role='form' class="has-success">
                        <?php flash(); ?>
                        <div class="form-group">
                            <label>Patient Id</label>
                            <div class="input-group">
                                <input type="text" name="patient_id" required="" class="form-control" placeholder="Patient Id">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="ok" class="btn btn-success" value="Login">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="lib/jquery/jquery.min.js"></script>
<script type="text/javascript" src="lib/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>