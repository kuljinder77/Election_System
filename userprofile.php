<?php


session_start();
$username = $_SESSION["username"];


?>

<html>
<header  style= " text-align: center;"><img src="headerlogo.png" width= "400px">
<h4>Welcome &nbsp <?php echo $_SESSION["username"];  ?></h4>
<?php

include("menu.html");
?>


</header>
<style>
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



tr:nth-child(even) {
    background-color: #00cccc;
}
</style>


<body>
<?php

	$query = "select userid,username ,firstname ,emailid , lastname , phonenumber , address ,city ,province from users where username = '$username'";
	$con = mysqli_connect('localhost','root','','election1');
	$rows = mysqli_query( $con , $query);

	if(mysqli_num_rows($rows) >0)
		{
			
			while($i = mysqli_fetch_assoc($rows))
			{
				echo "<table border=1> <tr><td>First Name</td><td>". $i["firstname"] ."</td></tr><tr><td>Last Name</td><td>". $i["lastname"] ."</td></tr>";
		
				echo "<tr><td>Email Id</td><td>". $i["emailid"] ."</td></tr><tr><td>Phone Number</td><td>". $i["phonenumber"] ."</td></tr><tr><td>Address</td><td>" .$i["address"] ."</td></tr><tr><td>City</td><td>". $i["city"] ." </td></tr>";
		
			}
			echo "</table>";
	
		
	}
	?>

</body>
<?php  include ("footer.html"); ?>
</html>