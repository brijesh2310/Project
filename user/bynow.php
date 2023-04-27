<?php
include('header.php');
include('database.php');
$paypal_link = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; //Test PayPal API URL
$paypal_username = 'fashionparadise150@gmail.com';
?>
<br />
<body>
<table class="table table-responcive table-hover table-bordered text-center">
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Product name</th>
            <th class="text-center">Image</th>
            <th class="text-center">Quantity</th>
            <th class="text-center">Price</th>
            <th class="text-center">Total</th>
        </tr>
    <?php
        $i=1;
        $sum=0;
       
        $q=mysqli_query($conn,"SELECT * FROM product WHERE product_id='".$_GET['product_id']."'");
        $row=mysqli_fetch_array($q);
        
        
                ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><img src="<?php echo $row['product_img']; ?>" height="50" width="50"/></td>
                        <td><?php echo $_GET['qty']; ?></td>
                        <td><?php echo $row['product_price']; ?></td>
                        <td><?php echo $result=($row['product_price']*$_GET['qty']);
                        $sum=$sum+$result; ?></td>
                        
                     </tr>
                     
              
        
    </table>
   
        <center>
         <?php 
            if(isset($_SESSION['email']))
            { 
                $_SESSION['product_id']=$_GET['aid'];
                $_SESSION['qty']=$_GET['qty'];
        ?>
        <a href="checkout.php">
        <button class="btn btn-success">Check Out</button></a>
            <?php }else { 
                $_SESSION['product_id']=$_GET['product_id'];
                $_SESSION['qty']=$_GET['qty'];
                ?>
           <a href="login.php?product_id=<?php echo $_GET['product_id']; ?>&qty=<?php echo $_GET['qty']; ?>">
          <!--  <button class="btn btn-success">Check Out</button></a>-->
            <?php } ?>
            
        </center>
        <br />
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="6CE2G224XTVEQ">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</body>

<?php
include('footer.php');
?>