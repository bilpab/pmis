<?php include('config.php');?>
<?php
if (isset($_POST['add'])){
  
$bio_id = $_POST['BioId'];
$username = $_POST['Username'];
$password = md5($_POST['Password']);
$lastname = $_POST['Lastname'];
$firstname = $_POST['Firstname'];
$middlename = $_POST['Middlename'];

	
//employee tbl
$bio_id = $_POST['BioId'];
$lastname = $_POST['Lastname'];
$firstname = $_POST['Firstname'];
$middlename = $_POST['Middlename'];

//prepare the SQL statement

$sql = "INSERT INTO tbl_user (bio_id,username,password,lastname,firstname,middlename,reg_date) 
VALUES (:bio_id,:username,:password,:lastname,:firstname,:middlename,NOW())";
$query = $connect->prepare($sql);
$query->bindparam(':bio_id', $bio_id);
$query->bindparam(':username', $username);
$query->bindparam(':password', $password);
$query->bindparam(':lastname', $lastname);
$query->bindparam(':firstname', $firstname);
$query->bindparam(':middlename', $middlename);
$query->execute();
	
$sql_employees = "INSERT INTO employees (bio_id,lastname,firstname,middlename,reg_now) 
VALUES (:bio_id,:lastname,:firstname,:middlename,NOW())";
$query = $connect->prepare($sql_employees);
$query->bindparam(':bio_id', $bio_id);
$query->bindparam(':lastname', $lastname);
$query->bindparam(':firstname', $firstname);
$query->bindparam(':middlename', $middlename);
$query->execute();
	
$lastInsertId = $connect->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Record inserted successfully');</script>";
echo "<script>window.location.href=''</script>";
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
echo "<script>window.location.href=''</script>";
}

}

?>

<!DOCTYPE html>
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	
</head>

<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="index.php"><b>SCCH</b>PMIS</a>
  </div>

  <div class="register-box-body">
	  
    <p class="login-box-msg">Register a new membership</p>
	  
	  
	<form action="" method="post">
	  <div class="form-group has-feedback">
        <input type="text" name="bio_id" class="form-control" placeholder="Please Enter your Biometric ID"
			   data-toggle="tooltip" data-html="true" title="Kindly ask Payroll clerk for your Biometric ID">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
		<div class="row">
        <!-- /.col -->
		<div class="col-xs-4"></div>
        <div class="col-xs-4">
          <button type="submit" name="search" value="Seach Data" class="btn btn-primary btn-block btn-flat">Search</button>
        </div>
        <!-- /.col -->
      </div>
	  
	</form>
	 <?php
	  if(isset($_POST['search'])){
		  $bioid = $_POST['bio_id'];
		  $sql= "SELECT *, id,bio_id,plastname,pfirstname,pmiddlename FROM biom_employee where bio_id='$bioid'";
		  $qry = $connect->prepare($sql);
		  $qry->execute();
		  $fetch = $qry->fetchAll();
		  foreach ($fetch as $search);
		  {
			  
			?>  
		  
	  &nbsp;
	  
    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="BioId" class="form-control" value="<?php echo $search['bio_id']?>" readonly>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">	
        <input type="text" name="Username" class="form-control" placeholder="Username" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
	  <div class="form-group has-feedback">
        <input type="text" name="Lastname" class="form-control" value="<?php echo $search['plastname']?>" readonly>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
	  <div class="form-group has-feedback">
        <input type="text" name="Firstname" class="form-control" value="<?php echo $search['pfirstname']?>" readonly>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
	  <div class="form-group has-feedback">
        <input type="text" name="Middlename" class="form-control" value="<?php echo $search['pmiddlename']?>" readonly>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
		<?php
		}
		  
	  }
	  ?>
		&nbsp;
      <div class="form-group has-feedback">
        <input type="password" name="Password" id="Password" class="form-control" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      
      <div class="row">
        <!-- /.col -->
		<div class="col-xs-4"></div>
        <div class="col-xs-4">
          <button type="submit" name="add" onclick="return valid();" id="add" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    

     <a href="login.php" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
