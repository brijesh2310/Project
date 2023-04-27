<?php
include("header.php");
include("database.php");
if(isset($_GET['id']))
{
  $result = mysqli_query($conn,"SELECT * FROM `payment` WHERE `o_id`='".$_GET['id']."'");
  $row = mysqli_fetch_array($result)
  ?>

<script>
function myFunction() {
  $('#z').hide();
    window.print();
}
</script> 

<body>
<br />
<div class="container-fluid" style="border:double;">
<br>
<!--<button id="z" onClick="myFunction()" style="float:right;"><span class="glyphicon glyphicon-print"></span></button> -->
<div class="row">
<center><h2 class="text-danger">Invoice</h2></center>

</hr>
</div>


<div class="col-sm-12 row" style="margin-bottom:20px;">
  <div class="col-sm-6" style="font-size:18px;">
  <div class="form-group">
          <label class="control-label col-sm-3 col-sm-offset-1">Order ID:</label>
          <?php echo $_GET['id']; ?>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3 col-sm-offset-1">User Name:</label>
           <?php echo $row['name']; ?>
     </div>
     <div class="form-group">
        <label class="control-label col-sm-3 col-sm-offset-1">Mobile No:</label>
           <?php echo $row['mobile_no']; ?>
     </div>
     
     </div>
    
     
     <div class="col-sm-6" style="font-size:18px;">
      <div class="form-group">
        <label class="control-label col-sm-3 col-sm-offset-1">Order Date:</label>
           <?php echo $row['order_date']; ?>
     </div>
      <div class="form-group">
      <label class="control-label col-sm-5 col-sm-offset-1">Shipping Address:</label>
     <?php echo $row['shipping_address']; ?>
      </div>
      </div>
    </div>
    <br />
    <div class="row">
      <table class="table table-responcive table-hover table-bordered text-center">
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Product name</th>
            <th class="text-center">Quantity</th>
            <th class="text-center">Price</th>
            <th class="text-center">Total</th>
         </tr>
         
        <?php
        $i=1;
    $sum=0;
    if(isset($_SESSION['cart_item']))
        {
            foreach($_SESSION['cart_item'] as $key)
            {
        $result=$key['price']*$key['quantity'];
        
        ?>
         <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $key['name']; ?></td>
            <td><?php echo $key['quantity']; ?></td>
            <td><?php echo $key['price']; ?></td>
            <td><?php echo $result;
       $sum=$sum+$result; ?></td>
         </tr>
           
         <?php }} else {
      $q = mysqli_query($conn,"SELECT * FROM `product` WHERE `product_id`='".$_SESSION['pid']."'");
      $r = mysqli_fetch_array($q);
      $re=$r['product_price']*$_SESSION['qty'];
       ?>
         <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $r['product_name']; ?></td>
            <td><?php echo $_SESSION['qty']; ?></td>
            <td><?php echo $r['product_price']; ?></td>
            <td><?php echo $re;?></td>
         </tr>
         
         <?php } ?>
         </table> 
         </div>
         
          <br />  

</div>
</body>
<?php } 
unset($_SESSION['cart_item']);
?>