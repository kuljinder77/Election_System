<?php


session_start();


?>

<html>

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
<header  style= " text-align: center;"><img src="headerlogo.png" width= "400px">
<h4>Welcome &nbsp <?php echo $_SESSION["username"];  ?></h4>
<?php
	include("menu.html");
?>
</header>


<?php
	//$date = date("Y-m-d");
	
	$query = "select electionname , electionid , electiondate , electionresultdate , description from election" ;
		
	$con = mysqli_connect('localhost','root','','election1');
	$rows = mysqli_query( $con , $query);

	if(mysqli_num_rows($rows) >0)
		{
			echo "<table border=1> <tr><th>Election Name</th><th>Election Id</th><th>Election Date</th><th>Election Result</th><th> Description</th><th>Choose Election</th></tr>";
		
			while($i = mysqli_fetch_assoc($rows))
			{
					echo "<tr><td>". $i["electionname"] ."</td><td>". $i["electionid"] ."</td><td>" .$i["electiondate"] ."</td><td> ".$i["electionresultdate"]." </td><td>". $i["description"] ."</td><td><a href=selectvoteparty.php?opt=U&id=$i[electionid]>SELECT</a></td></tr>";
					
			}
			echo "</table>";
			
	
		
	}
	?>



</body><?php  include ("footer.html"); ?>
</html>