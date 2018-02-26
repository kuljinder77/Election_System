<?php


session_start();
if(isset($_GET["opt"]) && isset($_GET["id"]))
	{
		$con = mysqli_connect('localhost','root','','election1');
		$opt = $_GET["opt"];
		$electionid = $_GET["id"];
		
	
	}


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

	$query = "select partyname , partyaffiliationid , partycode , establishedon from partyaffiliation";
		
	$con = mysqli_connect('localhost','root','','election1');
	$rows = mysqli_query( $con , $query);

	if(mysqli_num_rows($rows) >0)
		{
			echo "<table border=1> <tr><th>Party Name</th><th>Party Id</th><th>Party Code</th><th>Established On</th><th>View Candidate</th></tr>";
		
			while($i = mysqli_fetch_assoc($rows))
			{
					echo "<tr><td>". $i["partyname"] ."</td><td>". $i["partyaffiliationid"] ."</td><td>" .$i["partycode"] ."</td><td> ".$i["establishedon"]." </td><td><a href=vote.php?opt=U&id=$i[partyaffiliationid]&electionid=$electionid>View Candidate</a></td></tr>";
		
			}
			echo "</table>";
	
		
	}
	?>



</body><?php  include ("footer.html"); ?>
</html>