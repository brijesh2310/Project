<!DOCTYPE html>
<html>
<head>
	<title>detail</title>
<style>
	
.image
{
    padding: 0px;
   
    transition: transform .2s; /* Animation */
    
    margin-top:15px;
    margin-bottom:15px;  
}

.image:hover 
{
    transform: scale(1.3); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}

</style>
<script>
function buy_one()
{
	//alert();
	var a=document.getElementById('quantity').value;
	//alert('add');
	window.location.href='bynow.php?qid=<?php echo $_GET['pid'];?>&qty='+a;	
}
</script>
</head>
<body>
</body>
</html>

<?php 
	include('header.php');
	include('dbcon.php');
		$id=$_GET['aid'];
		$q="select * from product where product_id=$id";	
		$rs=mysqli_query($db,$q);
		$row=mysqli_fetch_array($rs,MYSQLI_BOTH);
		echo $row["product_img"]; 
?>


<div class="container-fluid" style="border: 1px solid black;">
	<div class="col-sm-4">
		<img class="image image" src="<?php echo $row['product_img'];?>" width="200" height="300">
	</div>
	
	<form action="addcart.php?action=add&&p_id=<?php echo $row['product_id'];?>" name="frm" method="post">

	<div class="col-sm-8" style="margin-top:50px;">
		<h2><?php echo $row['product_name']; ?></h2>

		<div class="col-sm-5">
		
			<h3>&#8360;.<?php echo $row['product_price']; ?></h3>
			
		<div class="col-sm-10">
				<input type="hidden" name="hidden_price" value="<?php echo $row['product_price'];?>">
				<input type="hidden" value="<?php echo $row['product_name'];?>" name="hidde_name">
				<label>Quantity:</label>
				<input type="number" value="1" id="quantity" name="quantity" class="form-control">
			</div>

			<div class="col-sm-10" style="margin-top:40px">
			
				<button class="btn btn-info" onmouseover="buy_one()">Bynow<span class="glyphicon glyphicon-flash"></span></button>

				<button type="submit" class="btn btn-info">Add to Cart <span class="glyphicon glyphicon-shopping-cart"></span></button>
			</div>
		</div>	
	</div>
</form>
</div>

	
<?php
	include('footer.php');

?>