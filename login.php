<?php
session_start();
error_reporting(0);
include('config.php');
if(isset($_POST['submit']))
{
$status='Active';
$uname=$_POST['username'];
$password=md5($_POST['password']);
$sql ="SELECT bio_id,username,password,account_type,id FROM tbl_user WHERE username=:uname and password=:password and account_type=(:status)";
$query= $connect -> prepare($sql);
$query-> bindParam(':uname', $uname, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> bindParam(':status', $status, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
 foreach ($results as $result) {
    $status=$result->account_type;
    $_SESSION['id']=$result->id;
  }
if($status=='Inactive')
{
$msg="Account not confirmed. Please contact admin";
} else{
$_SESSION['bio_id']=$_POST['bio_id'];
echo "<script type='text/javascript'> document.location = 'pages/dashboard.php'; </script>";
} }

else{

  echo "<script>alert('Account not confirmed. Please contact admin');</script>";

}

}


?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SCCH|Personnel Management Information System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <style>
	.login-page { 
	  background: url("images/backgroundlogin.jpg") no-repeat center center fixed; 
	  -webkit-background-size: cover;
	  -moz-background-size: cover;
	  -o-background-size: cover;
	  background-size: cover;
	}
  </style>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><b>SCCH</b>PMIS</a>
	 
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Employee Sign-in</p>
	  <div class="row">
	  	<div class="col-lg-12">
		 	<?php if($msg){?><div class="alert alert-danger alert-dismissible"><strong>Error</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
		</div>
	  </div>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="signin">
      <div class="form-group has-feedback">
        <input id="username" type="text" name="username" class="form-control" autocomplete="off" placeholder="Username" required >
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input id="password" type="password" class="form-control" name="password" autocomplete="off" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
		
		 <input type="submit" name="submit" value="Sign in" class="waves-effect waves-light btn teal">
    </form>

    
    <!-- /.social-auth-links -->
	<br>
    <a href="#">I forgot my password</a><br>
    <a href="register.php" class="text-center">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
</body>
</html>
