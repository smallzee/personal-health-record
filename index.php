<?php
	include_once 'core/all.php';
	
	if(isset($_POST['ok']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];

		$sql = $db->prepare("SELECT NULL FROM admin WHERE username = :u AND password = :p");
		$sql->execute(array(
			'u' => $username,
			'p' => md5($password)
		));

		$total = $sql->rowCount();
		if($total == 0){
			set_flash("Invalid login details","danger");
			header("location:index.php");
			exit();
		}else{
			$_SESSION['admin'] = $username;
			header("location:admin/index.php");
			exit();
		}
	}

	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Personal Health Record</title>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="IE=Edge"/> 		
	<meta name="viewport" content="width=device-width,initial-scale=1.0" />		
	<link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="lib/font-awesome/font-awesome.min.css">	
</head>
<body>

<div class="bg">
	<img src="img/bg1.jpg" class="img-responsive" width="100%">
</div>
<div class="bg-overlay">&nbsp;</div>


<div class="container">
	<div class="row left-index" style="margin-top: 150px;">
		<!--<div class="">-->
		<div class="col-md-7">			
			<p align="center">
				<img src="img/lth-logo.png" class="img-responsive">
			</p>
			
			<p align="center" style="color: #fff; font-size: 1.5em;">
			    DESIGN AND IMPLEMENTATION OF PERSONAL HEALTH RECORD
			</p>

			<h4 align="center" style="color: #fff;">
				Design By
			</h4>

			<h4 align="center" style="color: #fff;">

			</h4>

			<h3 class="page-header text-center" style="color: #fff;">
				Supervised By
			</h3>
		</div>

		<div class="col-md-5">
			<div class="bgs" style="padding: 20px; background-color: rgba(0,0,0,0.5); margin-top: 10px; color: #fff; border-radius: 4px;">
				<div class="admin-page">
						<form action="" method="post" role="form">
							<h3 class="page-header">Admin Login</h3>
							<div class="form-group">
								<label for="username">Username</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-user"></i>
									</span>
									<input type="text" name="username" id="username" class="form-control admin-input" required="" placeholder="Admin Username">
								</div>
							</div>

							<div class="form-group">
								<label for="password">Password</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-lock"></i>
									</span>
									<input type="password" name="password" id="password" class="form-control admin-input" required="" placeholder="Admin Password">
								</div>
							</div>
							<div class="form-group">
								<input type="submit" name="ok" class="btn btn-primary" value="Login">
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