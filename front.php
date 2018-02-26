<?php

session_start();




if(isset($_POST["submit"])) {
	
		require_once("dbcontroller.php");
		$db_handle = new DBController();
		$query = "select username from users where username = '" . $_POST["username"]. "' AND password = '".md5($_POST["password"])."' ";
		
		$con = mysqli_connect('localhost','root','','election1');
		$rows = mysqli_query( $con , $query);
		if(mysqli_num_rows($rows) >0)
		{
			while($i = mysqli_fetch_assoc($rows))
			{
				$_SESSION['username'] =  $i['username'];
				header("Location: http://localhost/election/normaluser.php");
				

				
			}
			
			
			
		}
		else if ($_POST["username"] == "admin" && $_POST["password"] == "admin")
		{
			$_SESSION['username'] =  "admin";
			header("Location: http://localhost/election/admin.php");
			
		}
		else
		{
			echo "<h3 style = ' background-color: #ff6666 ; color : black ; '>Invalid Username or Password ! Try again !</h3>";
			
		}

		
	
}

?>

<!DOCTYPE html>
<html>

<style>
input
{
	margin : 10px;
	height : 40px;
	text-align : center ;
	border-radius : 5px;

}
img{
	margin : 20px;
	width : 200px;
	
}
button
{
	margin : 10px;
	height : 40px;
	text-align : center ;
	border-radius : 5px;

}

</style>

<header  style= " text-align: center;"><img src="headerlogo.png" width= "400px">

</header>

<body style = "text-align : center ;  background-color : white; margin-left : 10px"><p style ="font-weight : bold ; margin : 40px ; font-size : 25px ;">Log in</p>
<form method = "POST" name = "form1">
<input type = "text" name = "username" placeholder = "Username" required><br>

<input type = "password" name = "password" placeholder = "Password" required><br>

<input type = "submit" name = "submit" value = "Submit" onClick= "submit1();"></form>
<a href = "register.php"><button name = "register" >Register</button></a>





</body>
</html>