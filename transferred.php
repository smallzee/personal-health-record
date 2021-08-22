<?php
require_once 'core/all.php';

if(isset($_POST['ok'])){

    $sql = $db->prepare("SELECT * FROM patient WHERE patient_id = :patient_id and hospital_id= :hospital_id");
    $sql->execute(
        array(
            'patient_id' => $_POST['patient_id'],
            'hospital_id' => $_POST['hospital_id']
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
        $_SESSION['transferred'] = $id;
        $_SESSION['transferred_name'] = get_hospital($_POST['hospital_id'],'name');
        //$_SESSION['admin_role'] = 1;
        $sql->closeCursor();
        header("location:admin/dashboard.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title> Transferred Login</title>
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
                    <h3 class="page-header"><i class="fa fa-lock"></i> Transferred  Login</h3>
                    <form action="" method="post" role='form' class="has-success">
                        <?php flash(); ?>
                        <div class="form-group">
                            <label>Hospital Name</label>
                            <select name="hospital_id" class="form-control" id="">
                                <option value="">Select</option>
                                <?php
                                    $sql = $db->query("SELECT * FROM hospital ORDER BY name");
                                    while ($rs = $sql->fetch(PDO::FETCH_ASSOC)){
                                        ?>
                                        <option value="<?= $rs['id'] ?>"><?= ucwords($rs['name']) ?></option>
                                    <?php
                                    }
                                ?>
                            </select>

                        </div>

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