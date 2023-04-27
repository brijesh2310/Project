<?php
include("header.php");

	include "database.php";
?>
<script>
function buy()
{
	var a=document.getElementById('quantity').value;
	window.location='bynow.php?pid=<?php echo $_GET['pid']; ?>&qty='+a;
}
</script>

<style type="text/css">
    .image
{
    padding: 0px;
   
    transition: transform .2s; 
    
    margin-top:15px;
    margin-bottom:15px;  
}

.image:hover 
{
    transform: scale(1.1); 
}
</style>

<div class="row" style="background-color:#E9ECF3">

<div class="col-sm-4 col-sm-offset-2" >
<?php
				if(isset($_GET['pid']))
				{
				$proid=$_GET['pid'];
				$res=mysqli_query($conn,"select * from product inner join category on product.category_name=category.category_name where product_id='$proid'");
				$r=mysqli_fetch_array($res);
				?>
   <h4 style="color:#F6C;font-size:25px;"><?php echo $r['product_name']; ?></h4>
   <br />
    <img src="<?php echo $r['product_img']; ?>" style="width:300px; height:350px;border:2px solid #396791;" class="img img-rounded">
    <br />
	<br>
	<h4 align="justify" style="color:#F6C; margin-left:100px;"><b><?php echo $r['product_price']; ?>.00 &#8377;</b></h4>
</div>

<div class="col-sm-6" style="padding-top:30px;">
   <h4 style="padding-top:30px;"><b style="color:#F6c"> Product detail:</b></h4><br>
   <h4 style="color:#111;width:280px;">
   <?php echo $r['product_desc']; ?></h4><br><br>
   <h4 style="width:280px;" ><b style="color:#F6c"> Product Category:</b>
   <br />
   <?php echo $r['category_name']; ?></h4>
   <br>

<form method="post" action="addcart.php?action=add&&p_id=<?php echo $row['product_id']; ?>">
   <b style="color:#F6c;font-size:19px;">Quantity:</b>	
<input type="number" min="1" value="1" id="quantity" name="quantity" style="width:50px;"><br /><br />

    <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-cart"></span>Add to cart</button>
  
</form>
</div>
<?php
}
?>
</div>
</div>


<?php
include("footer.php");
?>
