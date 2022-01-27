<?php
include_once 'connect_db.php';
session_start();
if(isset($_POST['login'])){
	$username=$_POST['username'];
	$password=$_POST['password'];
	$position=$_POST['position'];
	switch($position){
case 'Admin':
	$sql = "SELECT admin_id, username FROM admin WHERE username='$username' AND password='$password'";
	$result=$con->query($sql);
	if($row=$result->fetch())
		{
		$_SESSION['admin_id']=$row['admin_id'];
		$_SESSION['username']=$row['username'];
		header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/admin.php");
		}
		else{
		$message="<font color=red>Invalid login. Try Again</font>";
		}
	
	break;
	
	case 'Pharmacist':
		
		$sql = "SELECT pharmacist_id, first_name,last_name,staff_id,username FROM pharmacist 
		WHERE username='$username' AND password='$password'";
		$result=$con->query($sql);
		if($row=$result->fetch())
		{
			session_start();
			$_SESSION['pharmacist_id']=$row['pharmacist_id'];
			$_SESSION['first_name']=$row['first_name'];
			$_SESSION['last_name']=$row['last_name'];
			$_SESSION['staff_id']=$row['staff_id'];
			$_SESSION['username']=$row['username'];
			header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/pharmacist.php");
			}else{
			$message="<font color=red>Invalid login Try Again</font>";
			}
			
	break;

case 'Cashier':
	$sql = ("SELECT cashier_id, first_name,last_name,staff_id,username FROM cashier WHERE username='$username' AND password='$password'");
	$result=$con->query($sql);
	if($row=$result->fetch())
	{
	session_start();
	$_SESSION['cashier_id']=$row['cashier_id'];
	$_SESSION['first_name']=$row['first_name'];
	$_SESSION['last_name']=$row['last_name'];
	$_SESSION['staff_id']=$row['staff_id'];
	$_SESSION['username']=$row['username'];
	header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/cashier.php");
	}else{
	$message="<font color=red>Invalid login Try Again</font>";
	}
	break;
case 'Manager':
	$sql = ("SELECT manager_id, first_name,last_name,staff_id,username FROM manager WHERE username='$username' AND password='$password'");
	$result=$con->query($sql);
	if($row=$result->fetch())
	{
	session_start();
	$_SESSION['manager_id']=$row['manager_id'];
	$_SESSION['first_name']=$row['first_name'];
	$_SESSION['last_name']=$row['last_name'];
	$_SESSION['staff_id']=$row['staff_id'];
	$_SESSION['username']=$row['username'];
	header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/manager.php");
	}else{
	$message="<font color=red>Invalid login Try Again</font>";
	}
	break;
}
}
echo <<<LOGIN
<!DOCTYPE html>
<html>
<head>
<title>Pharmacy Management System</title>
<link rel="stylesheet" type="text/css" href="style/mystyle_login.css">
<style>
#content {
height: auto;
}
#main{
height: auto;}
</style>
</head>
<body>
<div id="content">
<div id="header">
<h1><img src="images/hd_logo.jpg">Pharmacy Management System</h1>
</div>
<div id="main">

  <section class="container">
  
     <div class="login">
	 <img src="images/hd_logo.jpg">
      <h1>Login here</h1>
	  $message
      <form method="post" action="index.php">
		 <p><input type="text" name="username" value="" placeholder="Username"></p>
        <p><input type="password" name="password" value="" placeholder="Password"></p>
		<p><select name="position">
		<option>--Select position--</option>
			<option>Admin</option>
			<option>Pharmacist</option>
			<option>Cashier</option>
			<option>Manager</option>
			</select></p>
        <p class="submit"><input type="submit" name="login" value="Login"></p>
      </form>
    </div>
    </section>
</div>
<div id="footer" align="Center"> Pharmacy Management System 2021. &copy All Rights Reserved</div>
</div>
</body>
</html>
LOGIN;

?>
