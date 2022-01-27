<?php
session_start();
include_once('connect_db.php');
if(isset($_SESSION['username'])){
	$id=$_SESSION['cashier_id'];
	$fname=$_SESSION['first_name'];
	$lname=$_SESSION['last_name'];
	$sid=$_SESSION['staff_id'];
	$user=$_SESSION['username'];
}
else
{
	header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $user;?> -  Pharmacy Management System</title>
	<link rel="stylesheet" type="text/css" href="style/mystyle.css">
	<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" /> 
	<link rel="stylesheet" href="style/table.css" type="text/css" media="screen" /> 
	<script type="text/javascript" SRC="js/jquery-1.4.2.min.js"></script>
</head>
<body>
<div id="content">
<div id="header">
<?php include_once('header.php');?>
<div id="left_column">
<div id="button"> 	
		<ul>
			<li><a href="cashier.php">Dashboard</a></li>
			<li><a href="payment.php"target="_top">Process payment</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>	
</div>
</div>
<div id="main">
-- <div id="tabbed_box" class="tabbed_box">  
    <h4> Manage Payments</h4> 
<hr/>	
    <div class="tabbed_area">  
      
        <ul class="tabs">  
            <!-- <li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1">Process payments</a></li>  
               -->
        </ul>      
 <script>
	$(document).ready(function()
	{
	$("#invoice_no").change(function() 
		{	
			var invoice_no=$("#invoice_no").val();
			if(invoice_no.length >0)		
				{
					$.ajax(
				{
					type: "POST", url: "check.php", data: 'invoice_no='+invoice_no , success: function(msg)
									
					{  
					$("#viewer2").ajaxComplete(function(event, request, settings)
						{ 							
								if(msg)
								{ 
									
									$(this).html(msg);
							
								} 
								else
								{
									alert('NO such file exists');
									$(this).html('<font color="red"><strong>Invoice does not exist</strong></font>');
								}	   
						});
					}    
				}); 
				}
		});		
		});		
</script>
<?php
	$_SESSION['invoice_no']=$invoice_no;
	$_SESSION['amount']=$amount;
	$_SESSION['payType']=$payType;
	$_SESSION['serial_no']=$serial_no;
	?>
	<div id="content_1" class="content"> 
	<div id="viewer1"><span id="viewer2"></span></div>
		<form name="myform" onsubmit="return validateForm(this);"  method="post" >
		<table width="220" height="106" border="0" >
			
			<tr><td ><input name="invoice_no" type="number"  placeholder="Property ID" required="required" id="invoice_no" /></td></tr>
			<tr><td ><input name="email" type="email" placeholder="customer email" required="required" id="email"/></td></tr> 			
			<tr><td>
		
			<fieldset>
               <span >
               <legend id="requirements">Requirements</hr> </legend>
               
                <input type="checkbox" name='list[]' value="Submitted"  id="kebeleId" required> 
                <label for="kebeleId">kebele Id</label><br>
                <input type="checkbox" name='list[]' value="submitted" id="Photograph" required> 
                <label for="Photograph">Photograph</label><br>
                <input type="checkbox" name='list[]' value="Made Half Payment"id="payment" required>
                <label for="payment">Made Half Payment</label> <br>
   
               </span>
            </fieldset>
			
			</td></tr>  
			<tr><td><input type="submit" name="save" value="Reserve Property" />
           <br></td></tr>
		</table>
</form>         
	</div>  
    </div>  
</div>
</div>
<?php include_once('footer.php');?>
</div>
</body>
</html>
