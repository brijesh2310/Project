<?php

$conn=mysqli_connect("localhost","root","","shopping") or die("could not connect to the database");

if(isset($_GET['id']))
{

	mysqli_query($conn,"DELETE FROM city WHERE city_id='".$_GET['id']."'");
	header('location:viewcity.php');
}

?>