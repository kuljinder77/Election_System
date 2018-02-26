<?php
session_start();
function uploadImage()
	{
		if(isset($_FILES['imgStudent']))
		{
	      $errors= array();
	      $file_name = $_FILES['imgStudent']['name'];
	      $file_size = $_FILES['imgStudent']['size'];
	      $file_tmp = $_FILES['imgStudent']['tmp_name'];
	      $file_type = $_FILES['imgStudent']['type'];
	      $file_ext=strtolower(end(explode('.',$_FILES['imgStudent']['name'])));
	      
	      $expensions= array("jpeg","jpg","png");
	      
	      if(in_array($file_ext,$expensions) === false){
	         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
	      }
	      
	      if($file_size > 2097152) {
	         $errors[]='File size must be excately 2 MB';
	      }
	      
	      if(empty($errors)==true) {
	         move_uploaded_file($file_tmp,"images/".$file_name);
	         return true;
	      }else{
	      	print_r($errors);
	        return false;
	      }
   		}
   		return false;
	}
if(!empty($_POST["register-user"])) 
{
	/* Form Required Field Validation */
	foreach($_POST as $key=>$value) {
		if(empty($_POST[$key])) {
		$error_message = "All Fields are required";
		break;
		}
	}
	

	

	
	

	

	if(!isset($error_message)) {
		require_once("dbcontroller.php");
		$db_handle = new DBController();
		$query = "INSERT INTO election (electionid,electionname,electiondate,electionresultdate , description) VALUES
		('" . $_POST["electionid"] . "', '" . $_POST["electionname"] . "','" . $_POST["electiondate"] . "', '" . $_POST["electionresultdate"] . "' , '". $_POST["description"] ."')";
		$result = $db_handle->insertQuery($query);
		if(!empty($result)) {
			$error_message = "";
			$success_message = "Election registered successfully! Refreshing  Please Wait..";	
			unset($_POST);
			header( "refresh:3;url=admin.php" );
		} else {
			$error_message = "Problem in registration. Try Again!";	
		}
	}
	
}

?>
<html>
<head>
<title> Election Registeration</title>
<style>
body{
	
	font-family:calibri;
}
.error-message {
	padding: 7px 10px;
	background: #fff1f2;
	
	border: #ffd5da 1px solid;
	color: #d6001c;
	border-radius: 4px;
}
.success-message {
	padding: 7px 10px;
	
	background: #cae0c4;
	border: #c3d0b5 1px solid;
	color: #027506;
	border-radius: 4px;
}
.demo-table {
	background: lightgrey;
	width: 600px;
	border-spacing: initial;
	text-align:center;
	word-break: break-word;
	table-layout: auto;
	line-height: 1.8em;
	color: #333;
	border-radius: 4px;
	padding: 20px 40px;
}
.demo-table td {
	padding: 15px 0px;
}
.demoInputBox {
	padding: 10px 30px;
	border: #a9a9a9 1px solid;
	border-radius: 4px;
}
.btnRegister {
	padding: 10px 30px;
	background-color: #3367b2;
	border: 0;
	color: #FFF;
	cursor: pointer;
	border-radius: 4px;
	margin-left: 10px;
}
</style>
</head><header  style= " text-align: center;"><img src="headerlogo.png" width= "400px">
<h4>Welcome &nbsp <?php echo $_SESSION["username"];  ?></h4>
<?php

include("adminmenu.html");
?>


</header>
<body>


<form name="frmRegistration" method="post" action="">
<table border="0" width="500" align="center" class="demo-table">
<?php if(!empty($success_message)) { ?>	
<div class="success-message"><?php if(isset($success_message)) echo $success_message; ?><img src="images/loader.gif" width = "40px"></div>
<?php } ?>
<?php if(!empty($error_message)) { ?>	
<div class="error-message"><?php if(isset($error_message)) echo $error_message; ?></div>
<?php } ?>
<tr>
<td>Election Name</td>
<td><input type="text" class="demoInputBox" name="electionname" value="<?php if(isset($_POST['electionname'])) echo $_POST['electionname']; ?>"></td>
</tr>
<tr>
<td>Election Id</td>
<td><input type="text" class="demoInputBox" name="electionid" value="<?php if(isset($_POST['electionid'])) echo $_POST['electionid']; ?>"></td>
</tr>
<tr>
<td>Election Date</td>
<td><input type="date" class="demoInputBox" name="electiondate" value="<?php if(isset($_POST['electiondate'])) echo $_POST['electiondate']; ?>"></td>
</tr>
<tr>
<td>Election Result Date</td>
<td><input type="date" class="demoInputBox" name="electionresultdate" value="<?php if(isset($_POST['electionresultdate'])) echo $_POST['electionresultdate']; ?>"></td>
</tr>
<tr>
<td>Election Description</td>
<td><input type="text" class="demoInputBox" name="description" value="<?php if(isset($_POST['description'])) echo $_POST['description']; ?>"></td>
</tr>


<tr style="text-align:center;">
<td colspan=2> <input type="submit" name="register-user" value="Add Election" class="btnRegister"></td>
</tr>
</table>
</form>
</body><?php  include ("footer2.html"); ?></html>