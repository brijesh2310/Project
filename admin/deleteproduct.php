

<?php

$conn=mysqli_connect("localhost","root","","shopping") or die("could not connect to the database");

if(isset($_GET['did']))
{

	mysqli_query($conn,"DELETE FROM product WHERE product_id='".$_GET['did']."'");
	header('location:viewproduct.php');
}

?>
