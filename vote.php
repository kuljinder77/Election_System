<?php
session_start();


if(isset($_GET["opt"]) && isset($_GET["id"]) && isset($_GET["electionid"]))
	{
		$con = mysqli_connect('localhost','root','','election1');
		$opt = $_GET["opt"];
		$partyid = $_GET["id"];
		$username = $_SESSION["username"];
		$electionid = $_GET["electionid"];
		if($opt == "U")
		{
			
			$q1 = "SELECT * FROM candidate WHERE partyaffiliationid='$partyid'";
			
			$result1 = mysqli_query($con,$q1);
			if(mysqli_num_rows($result1) > 0)
			{
			
			while($i = mysqli_fetch_assoc($result1))
			{
				$candidateid = $i["candidateid"]; 
				$candidatename = $i["candidatename"]; 
				$emailid = $i["emailid"]; 
				$gender = $i["gender"]; 
				$city = $i["city"]; 
				$province = $i["province"]; 
				$postalcode = $i["postalcode"]; 
				$dateofbirth = $i["birthdate"]; 
				$websitelink = $i["websitelink"]; 
				$address = $i["address"]; 
				$education = $i["education"];
			}
			}
			
			
	}
	
	}
	


	if(!empty($_POST["vote"]))  {
		
		
		
		
		
		$query ="INSERT INTO vote (candidateid,electionid,votes ,username) VALUES ($candidateid , $electionid , 1 , '". $_SESSION["username"] ."')";
		$row = mysqli_query($con,$query);
		if(!empty($row)) {
			$error_message = "";
			$success_message = "Voted successfully!!!Refreshing!!!!!";	
			unset($_POST);
			header( "refresh:3;url=normaluser.php" );
		} else {
			$error_message = "Already voted";	
		}
	}
	
	


?>
<html>
<head><header  style= " text-align: center;"><img src="headerlogo.png" width= "400px">
<h4>Welcome &nbsp <?php echo $_SESSION["username"];  ?></h4>
<?php

include("menu.html");
?>


</header>

<style>

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
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
	width:50%;
	margin-left: 25%;
    
	
}

td, th {
    border: 1px solid #dddddd;
    text-align: center;
	
    padding: 8px;
}
button
{
	margin : 10px;
	height : 40px;
	text-align : center ;
	border-radius : 5px;

}



tr:nth-child(even) {
	
    background-color: #00cccc;
    
}
</style>
</head>
</header>
<body>

<table>
<?php if(!empty($success_message)) { ?>	
<div class="success-message"><?php if(isset($success_message)) echo $success_message; ?></div>
<?php } ?>
<?php if(!empty($error_message)) { ?>	
<div class="error-message"><?php if(isset($error_message)) echo $error_message; ?></div>
<?php } ?>
<tr><td>Candidate Name</td><td><?php  echo $candidatename ;  ?></td></tr>
<tr><td>Candidate Id</td><td><?php  echo $candidateid ;  ?></td></tr>
<tr><td>Party Id</td><td><?php  echo $partyid ;  ?></td></tr>
<tr><td>Gender</td><td><?php  echo $gender ;  ?></td></tr>
<tr><td>Email Id</td><td><?php  echo $emailid ;  ?></td></tr>
<tr><td>Birth Date</td><td><?php  echo $dateofbirth ;  ?></td></tr>
<tr><td>Website</td><td><?php  echo $websitelink ;  ?></td></tr>
<tr><td>Address</td><td><?php  echo $address , $city  ;  ?></td></tr>
<tr><td>Province</td><td><?php  echo $province ;  ?></td></tr>
<tr><td>Education</td><td><?php  echo $education ;  ?></td></tr>
<tr style="text-align:center;"><td colspan=2><form method = "POST"><input type = "submit" name= "vote" value = "VOTE"></form></td></tr>
</table>


</body></html>