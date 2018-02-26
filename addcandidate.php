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
	

	/* Email Validation */
	if(!isset($error_message)) {
		if (!filter_var($_POST["emailid"], FILTER_VALIDATE_EMAIL)) {
		$error_message = "Invalid Email Address";
		}
	}

	/* Validation to check if gender is selected */
	if(!isset($error_message)) {
	if(!isset($_POST["gender"])) {
	$error_message = " All Fields are required";
	}
	}

	
	

	

	if(!isset($error_message)) {
		require_once("dbcontroller.php");
		$db_handle = new DBController();
		$query = "INSERT INTO candidate (candidatename,gender,emailid,birthdate,websitelink,address,city,province,postalcode,education,partyaffiliationid) VALUES
		('" . $_POST["canname"] . "', '" . $_POST["gender"] . "','" . $_POST["emailid"] . "', '" . $_POST["dateofbirth"] . "', '" . ($_POST["websitelink"]) . "','" . $_POST["address"] . "', '" . $_POST["city"] . "', '" . $_POST["province"] . "', '" . $_POST["postalcode"] . "', '" . $_POST["education"] . "', '" . $_POST["partyaffiliationid"] . "')";
		$result = $db_handle->insertQuery($query);
		if(!empty($result)) {
			$error_message = "";
			$success_message = "Candidate registered successfully! Refrehing  Please wait..";	
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
<title>Add Candidate</title>
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
<td>Candidate Name</td>
<td><input type="text" class="demoInputBox" name="canname" value="<?php if(isset($_POST['canname'])) echo $_POST['canname']; ?>"></td>
</tr>
<tr>
<td>Date of Birth</td>
<td><input type="date" class="demoInputBox" name="dateofbirth" value="<?php if(isset($_POST['dateofbirth'])) echo $_POST['dateofbirth']; ?>"></td>
</tr>
<tr>
<td>website Link</td>
<td><input type="text" class="demoInputBox" name="websitelink" value="<?php if(isset($_POST['website'])) echo $_POST['website']; ?>"></td>
</tr>
<tr>
<td>Email</td>
<td><input type="text" class="demoInputBox" name="emailid" value="<?php if(isset($_POST['emailid'])) echo $_POST['emailid']; ?>"></td>
</tr>
<tr>
<td>Address</td>
<td><input type="text" class="demoInputBox" name="address" value="<?php if(isset($_POST['address'])) echo $_POST['address']; ?>"></td>
</tr>
<tr>
<td>City</td>
<td><input type="text" class="demoInputBox" name="city" value="<?php if(isset($_POST['city'])) echo $_POST['city']; ?>"></td>
</tr>
<tr>
<td>Province</td>
<td><input type="text" class="demoInputBox" name="province" value="<?php if(isset($_POST['province'])) echo $_POST['province']; ?>"></td>
</tr>
<tr>
<td>Education</td>
<td><input type="text" class="demoInputBox" name="education" value="<?php if(isset($_POST['education'])) echo $_POST['education']; ?>"></td>
</tr>
<tr>
<td>Postal code</td>
<td><input type="text" class="demoInputBox" name="postalcode" value="<?php if(isset($_POST['postalcode'])) echo $_POST['postalcode']; ?>"></td>
</tr>
<tr>
<td>Party Affiliation Id</td>
<td><input type="text" class="demoInputBox" name="partyaffiliationid" value="<?php if(isset($_POST['partyaffiliationid'])) echo $_POST['partyaffiliationid']; ?>"></td>
</tr>
<tr>
<tr>
<td>Gender</td>
<td><input type="radio" name="gender" value="Male" <?php if(isset($_POST['gender']) && $_POST['gender']=="Male") { ?>checked<?php  } ?>> Male
<input type="radio" name="gender" value="Female" <?php if(isset($_POST['gender']) && $_POST['gender']=="Female") { ?>checked<?php  } ?>> Female
</td>
</tr>

<tr style="text-align:center;">
<td colspan=2> <input type="submit" name="register-user" value="Add Candidate" class="btnRegister"></td>
</tr>
</table>
</form>
</body><?php  include ("footer2.html"); ?>
</html>