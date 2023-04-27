<?php
	include('header.php');

?>
<!DOCTYPE html>
<html>
<head>
	<title>Product Detail</title>
<link rel="stylesheet" type="text/css" href="http://cdn.webrupee.com/font">
    <script src=http://cdn.webrupee.com/js type=”text/javascript”></script>
<style>
.image{
   
    transition: transform .2s; /* Animation */
    
    margin-top:25px;
    margin-bottom: 25px;  
}

.image:hover {
    transform: scale(1.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}
.col-sm-3{
	margin:14px;
}

.display
{
	margin:14px;
	border:1px solid black;
	height:350px;
	padding:20px;
	border-radius:7px;
	height: 390px;
}

</style>
</head>
<body>
</body>
</html>

<?php
	
		$conn = mysqli_connect("localhost","root","","shopping");

		if(isset($_GET['sub']))
		{
			$count=0;
			$name=$_GET['sub'];
			$q = "select * from product where subcategory_name='$name' and category_name='Electronics'";

        	echo "<div class='container card-group'>";
			$res = mysqli_query($conn,$q);

		while($row = mysqli_fetch_assoc($res))
		{
			
			if($count==9)
			{
				break;
			}
			$count++;
			//print_r($row);
?>
						
			<div class="col-sm-4" style="text-align: center;padding-top: 10px; ">
				<div class="display">
					<a href="electronics.php?aid=<?php echo $row['product_id']; ?>">
					<div class="image"><img src="<?php echo $row['product_img']; ?>" width="150" height="150">
					</div><br>

					<div><p><b><?php echo $row['product_name']; ?></b></p></div><br>

					<div><h3><i class="fa fa-inr"></i>.<?php echo $row['product_price']; ?></h3></div></a>

					<form method="post" action="addcart.php?action=add&&p_id=<?php echo $row['product_id']; ?>">

					Quantity:<input type="number" id="quantity" value="1" min="1" max="10" name="quantity" style="width:33px;margin-right:20px;"/> <br><br>
					<div><button type="submit" class="btn btn-info">Add to Cart</button> </h3></div>
					
					</form>
				</div>
			</div>
<?php 

		}
		//if($count%6==0)
			echo "</div>";

	}
?>
			
<?php

    include('footer.php');

?>