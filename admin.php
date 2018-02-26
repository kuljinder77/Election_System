<?php


session_start();


?>

<html>
<header  style= " text-align: center;"><img src="headerlogo.png" width= "400px">
<h4>Welcome &nbsp <?php echo $_SESSION["username"];  ?></h4>
<?php

include("adminmenu.html");
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

	$query = "select userid,username ,firstname ,emailid from users";
		
	$con = mysqli_connect('localhost','root','','election1');
	$rows = mysqli_query( $con , $query);

	if(mysqli_num_rows($rows) >0)
		{
			echo "<table border=1> <tr><th>Select</th><th>Firstname</th><th>Username</th><th>Email Id</th><th>Delete</th></tr>";
		
			while($i = mysqli_fetch_assoc($rows))
			{
					echo "<tr><td><a href=userupdate.php?opt=U&id=" . $i["userid"] .">SELECT</a></td><td>". $i["firstname"] ."</td><td>". $i["username"] ."</td><td>" .$i["emailid"] ."</td><td><a href=user_delete.php?opt=D&id=$i[userid]>DELETE</a> </td></tr>";
		
			}
			echo "</table>";
	
		
	}
	?>

</body><?php  include ("footer.html"); ?>
</html>