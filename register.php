<?php
if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size = $_FILES['image']['size'];
      $file_tmp = $_FILES['image']['tmp_name'];
      $file_type = $_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152) {
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true) {
         move_uploaded_file($file_tmp,"images/".$file_name);
         echo "Success";
      }else{
         print_r($errors);
      }
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
	/* Password Matching Validation */
	if($_POST['password'] != $_POST['confirm_password']){ 
	$error_message = 'Passwords should be same<br>'; 
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
		$query = "INSERT INTO users (username,password,emailid,firstname,lastname,phonenumber,gender,address,city,province,postalcode,createdon,updatedon) VALUES
		('" . $_POST["username"] . "', '" .md5( $_POST["password"]) . "','" . $_POST["emailid"] . "', '" . $_POST["firstname"] . "', '" . ($_POST["lastname"]) . "','" . $_POST["phonenumber"] . "' ,  '" . $_POST["gender"] . "', '" . $_POST["address"] . "', '" . $_POST["city"] . "', '" . $_POST["province"] . "', '" . $_POST["postalcode"] . "', '" . date('Y-m-d h:i:sa') . "', '" . date('Y-m-d h:i:sa') . "')";
		$result = $db_handle->insertQuery($query);
		if(!empty($result)) {
			$error_message = "";
			$success_message = "You have registered successfully! Please wait ";	
			
			session_start();
			$_SESSION["username"] = $_POST["username"];
			header( "refresh:2;url=normaluser.php" );
		} else {
			$error_message = "Problem in registration. Try Again!";	
		}
	}
	
}

?>
<html>
<head>
<title>Registeration</title>
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
</head>
<header  style= " text-align: center;"><img src="headerlogo.png" width= "400px">
<br><br><hr>
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
<td>User Name</td>
<td><input type="text" class="demoInputBox" name="username" value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>"></td>
</tr>
<tr>
<td>First Name</td>
<td><input type="text" class="demoInputBox" name="firstname" value="<?php if(isset($_POST['firstname'])) echo $_POST['firstname']; ?>"></td>
</tr>
<tr>
<td>Last Name</td>
<td><input type="text" class="demoInputBox" name="lastname" value="<?php if(isset($_POST['lastname'])) echo $_POST['lastname']; ?>"></td>
</tr>
<tr>
<td>Password</td>
<td><input type="password" class="demoInputBox" name="password" value=""></td>
</tr>
<tr>
<td>Confirm Password</td>
<td><input type="password" class="demoInputBox" name="confirm_password" value=""></td>
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
<td>Phone</td>
<td><input type="text" class="demoInputBox" name="phonenumber" value="<?php if(isset($_POST['phonenumber'])) echo $_POST['phonenumber']; ?>"></td>
</tr>
<tr>
<td>Postal code</td>
<td><input type="text" class="demoInputBox" name="postalcode" value="<?php if(isset($_POST['postalcode'])) echo $_POST['postalcode']; ?>"></td>
</tr>
<tr>
<td>Gender</td>
<td><input type="radio" name="gender" value="Male" <?php if(isset($_POST['gender']) && $_POST['gender']=="Male") { ?>checked<?php  } ?>> Male
<input type="radio" name="gender" value="Female" <?php if(isset($_POST['gender']) && $_POST['gender']=="Female") { ?>checked<?php  } ?>> Female
</td>
</tr>

<tr style="text-align:center;">
<td colspan=2> <input type="submit" name="register-user" value="Register" class="btnRegister"></td>
</tr>
</table>
</form>
</body><?php  include ("footer2.html"); ?></html>