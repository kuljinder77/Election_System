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
body{
	
	text-align:center;
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



tr:nth-child(even) {
    background-color: #00cccc;
}
</style>


<body>
<h1 style="">About us</h1>
<p>An election is a formal decision-making process by which a population chooses an individual to hold public office. Elections have been the usual mechanism by which modern representative democracy has operated since the 17th century. Elections may fill offices in the legislature, sometimes in the executive and judiciary, and for regional and local government. This process is also used in many other private and business organizations, from clubs to voluntary associations and corporations.</p>
<p>we are providing user interface to vote . User can vote to any party . </p>


</body>
</html>