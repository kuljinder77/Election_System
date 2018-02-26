<?php
session_start();
if(isset($_GET["opt"]) && isset($_GET["id"]))
	{
		$con = mysqli_connect('localhost','root','','election1');
		$opt = $_GET["opt"];
		$id = $_GET["id"];
		if($opt == "U")
		{
			
			$q = "SELECT * FROM users WHERE userid='$id'";
			$result = mysqli_query($con,$q);
			if(mysqli_num_rows($result) > 0)
			{
			
			while($i = mysqli_fetch_assoc($result))
			{
				$userid = $i["userid"]; 
				$username = $i["username"]; 
				$emailid = $i["emailid"]; 
				$phonenumber = $i["phonenumber"]; 
				$gender = $i["gender"]; 
				$city = $i["city"]; 
				$province = $i["province"]; 
				$postalcode = $i["postalcode"]; 
				$firstname = $i["firstname"]; 
				$lastname = $i["lastname"]; 
				$address = $i["address"]; 
				$createdon = $i["createdon"];
			}
		}
	}
	
	}
	
if(!empty($_POST["register-user"])) 
{
	$username1 = $_POST["username"];
	$password1 = $_POST["password"];
	$emailid1 = $_POST["emailid"];
	$firstname1 = $_POST["firstname"];
	$lastname1 = $_POST["lastname"];
	$phonenumber1 = $_POST["phonenumber"];
	$gender1 = $_POST["gender"];
	$address1 = $_POST["address"];
	$city1 = $_POST["city"];
	$province1 = $_POST["province"];
	$updatedon1 = date('Y-m-d h:i:sa');
	$postalcode1 = $_POST["postalcode"];
	
	
	
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
		//$query ="UPDATE users SET username = " . $_POST["username"]  . ", password =  " .md5( $_POST["password"]) . ", emailid = " . $_POST["emailid"] . ", firstname = " . $_POST["firstname"] . ", lastname = " . ($_POST["lastname"]) . ", phonenumber =" . $_POST["phonenumber"] . " ,  gender =" . $_POST["gender"] . ", address =" . $_POST["address"] . ", city = " . $_POST["city"] . ",province =" . $_POST["province"] . ", postalcode =" . $_POST["postalcode"] . " , createdon = '$createdon', updatedon =" . date('Y-m-d h:i:sa') . " WHERE userid='$userid'";
		$query = "UPDATE users SET password='$password1',firstname='$firstname1',lastname='$lastname1',username='$username1',gender='$gender1',emailid='$emailid1',phonenumber='$phonenumber1',address='$address1',city='$city1',province='$province1',postalcode='$postalcode1',createdon='$createdon',updatedon='$updatedon1' WHERE userid='$id'";
		$row = mysqli_query($con,$query);
		if(!empty($row)) {
			$error_message = "";
			$success_message = "Data updated successfully!! Refreshing Please Wait.. ";	
			unset($_POST);
			header( "refresh:3;url=admin.php" );
		} else {
			$error_message = "Problem in updation. Try Again!";	
		}
	}
	
}

?>
<html>
<head><header  style= " text-align: center;"><img src="headerlogo.png" width= "400px">
<h4>Welcome &nbsp <?php echo $_SESSION["username"];  ?></h4>
<?php

include("adminmenu.html");
?>


</header>
<title>UPDATE USER DETAILS</title>
<style>
body{
	
	font-family:calibri;
}
.error-message {
	padding: 7px 10px;
	background: #fff1f2;
	margin : 5px;
	border: #ffd5da 1px solid;
	color: #d6001c;
	border-radius: 4px;
}
.success-message {
	padding: 7px 10px;
	margin:5px;
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
<td><input type="text" class="demoInputBox" name="username" value="<?php echo $username ?>"></td>
</tr>
<tr>
<td>First Name</td>
<td><input type="text" class="demoInputBox" name="firstname" value="<?php echo $firstname ?>"></td>
</tr>
<tr>
<td>Last Name</td>
<td><input type="text" class="demoInputBox" name="lastname" value="<?php echo $lastname ?>"></td>
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
<td><input type="text" class="demoInputBox" name="emailid" value="<?php echo $emailid ?>"></td>
</tr>
<tr>
<td>Address</td>
<td><input type="text" class="demoInputBox" name="address" value="<?php echo $address ?>"></td>
</tr>
<tr>
<td>City</td>
<td><input type="text" class="demoInputBox" name="city" value="<?php echo $city ?>"></td>
</tr>
<tr>
<td>Province</td>
<td><input type="text" class="demoInputBox" name="province" value="<?php echo $province ?>"></td>
</tr>
<tr>
<td>Phone</td>
<td><input type="text" class="demoInputBox" name="phonenumber" value="<?php echo $phonenumber ?>"></td>
</tr>
<tr>
<td>Postal code</td>
<td><input type="text" class="demoInputBox" name="postalcode" value="<?php echo $postalcode ?>"></td>
</tr>
<tr>
<td>Gender</td>
<td><input type="radio" name="gender" value="Male" <?php if($gender == "Male") { ?>checked<?php  } ?>> Male
<input type="radio" name="gender" value="Female" <?php if($gender == "Female") { ?>checked<?php  } ?>> Female
</td>
</tr>
<tr style="text-align:center;">
<td colspan=2> <input type="submit" name="register-user" value="Update" class="btnRegister"></td>
</tr>
</table>
</form>
</body><?php  include ("footer2.html"); ?></html>