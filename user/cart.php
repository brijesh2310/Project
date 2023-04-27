<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>


<?php
//session_start();
include('header.php');
include('database.php');
?>
<div class="container-fluid">
    
    <?php
    if(empty($_SESSION['cart_item']))
    {
        echo "<script>alert('Your cart is empty.');</script>";
    ?>
    <div class="col-sm-3 col-sm-offset-1" style="margin-bottom:10px;">
        <a href="index.php"><button class="btn btn-success"><span class="glyphicon glyphicon-chevron-left"></span>&nbsp;Continue Shopping</button></a>
    </div>
    </div><?php }
    else
    { ?>
    <div class="col-sm-3 col-sm-offset-1" style="margin-bottom:10px;">
        <a href="index.php"><button class="btn btn-success"><span class="glyphicon glyphicon-chevron-left"></span>&nbsp;Continue Shopping</button></a>
    </div>
    </div>
    <table border="1" class="table table-responcive table-hover table-bordered text-center">
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Product name</th>
            <th class="text-center">Image</th>
            
            <th class="text-center">Price</th>
            <th class="text-center">Total</th>
            <th class="text-center">Delete</th>
        </tr>
    
        <?php
        $i=1;
        $sum=0;
        if(isset($_SESSION['cart_item']))
        {
            foreach($_SESSION['cart_item'] as $key)
            {
                ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $key['name']; ?></td>
                        <td><img src="<?php echo $key['image']; ?>" height="50" width="50"/></td>
                        <form method="post" action="addtocart.php?action=update&&pro_id=<?php echo $key['code']; ?>">
                        
                            </form>

                        <td><?php echo $key['price']; ?></td>
                        <td><?php echo $result=($key['price']*$key['quantity']);
                        $sum=$sum+$result; ?></td>
                        <td><a href="addtocart.php?action=remove&&pro_id=<?php echo $key['code']; ?>"><button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button></a></td>
                     </tr>
                     
                <?php
            }
        }
        ?>
    </table>
   
    <div class="col-sm-5 col-sm-offset-7" style="margin-bottom:10px;">
        <div style="display:inline-block;"><a href="addtocart.php?action=empty">
            <button class="btn btn-info">Clear cart</button></a></div>
        <div style="display:inline-block;margin-left:40px;"><h4>Grant Total:<?php echo "Rs.".$sum; ?></h4></div>
        <div style="display:inline-block;margin-left:40px;">
        <?php 
            if(isset($_SESSION['email']))
            { ?>
            <a href="checkout.php">
            <button class="btn btn-success">Check Out</button></a>
            <?php }else { ?>
            <a href="login.php?redirect=checkout.php">
            <button class="btn btn-success">Check Out</button></a>
            <?php } ?>
        </div>  
     </div>
      <?php } ?>    
</div>

</body>
<?php include('footer.php');?>
</html>