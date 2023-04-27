<?php

include('header.php');

?>


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

<body>
                    <?php
                        $conn = mysqli_connect("localhost","root","","shopping");
                if(isset($_GET['aid']))
                  {
                 $result=mysqli_query($conn,"SELECT * FROM product WHERE `product_id`='".$_GET['aid']."'");
                 $row=mysqli_fetch_array($result,MYSQLI_BOTH);
                  }
                    ?>
<br>
<div class="container" style="background-color: white">
    <div style="background-color: white;color: black">
    <div class="container col-sm-4">
        <img class="image image" src="<?php echo $row['product_img'];?>" width="250px" height="300px">
    </div>

        <div class="container col-sm-8">

                                    <h1 style="margin-top: 60px;font-size: 50px">&nbsp <?php echo $row['product_name'];?></h1><br>
                                  
                                     <div>
                                        <h2>&nbsp &nbsp <i class="fa fa-inr"></i><?php echo $row['product_price'];?></h2>
                                    </div><br>
                         <div class="row">
                                <div class="col-sm-3"><h2>&nbsp &nbsp Discription :</h2></div>
                                <div class="col-sm-9"> <div style="font-size: 20px;margin-left: 28px">
                                    <?php echo $row['product_desc']; ?>
                                </div>
                            </div>

                               
                        </div>
                      
               
                         <form method="post" action="addcart.php?action=add&&p_id=<?php echo $row['product_id']; ?>">
                        <div style="font-size: 17px">
                    Quantity:<input type="number" id="quantity" value="1" min="1" max="10" name="quantity" style="width:33px;margin-right:20px;margin-left: 15px"/> 
                </div>
                    <br><br>
                    


                               
                        <div class="row"  style="margin-top:25px">
                        <h4 style="width:280px;" ><b style="color:#F6c">
</b></h4>
    <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-cart"></span>Add to cart</button>
    
<h4 style="width:280px;" ><b style="color:#F6c"></b></h4>
 
                        </form>
 
                        </div>
            </div>  
    
</div></div>
<br>
</body>
                    <div class="col-sm-12" style="height: 50px;"></div>
    <!-- /new_arrivals -->
    <!--// Single -->
<?php

    include('footer.php');

?>