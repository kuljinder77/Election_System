
<?php 
	
	$con = mysqli_connect('localhost','root','','election1');
	
	if(isset($_GET["opt"]) && isset($_GET["id"]))
	{
		$opt = $_GET["opt"];
		$id = $_GET["id"];
		if($opt == "D")
		{
			$q = "DELETE FROM users WHERE userid='$id'";
			$result = mysqli_query($con,$q);
			header('location: admin.php');
		}
	}
	
?>