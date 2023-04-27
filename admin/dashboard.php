<?php

  include('header.php');

?>

<?php
$conn=mysqli_connect("localhost","root","","shopping")or die("database not connected")
?>
<?php 
  if(isset($_GET['did']))
  {
    $id=$_GET['did'];
    $delete="delete from registration where id='".$id."'";
    mysqli_query($conn,$delete);
    ?>
    <script>
      window.location="dashboard.php";
    </script>
    <?php
  }
?>

<div class="content-wrapper">
      <div class="container-fluid">
      
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="header.php">Home</a>
        </li>
        <li class="breadcrumb-item active">Dashbord</li>
      </ol>
     
      </div>
        <div class="row">    
      <div class="col-sm-6" style="height:100px;font-size:40px;padding-top:40px;">
      <a href="manageuser.php" ><center>User<center></a><span class="badge" style="font-size:30px;">
      <?php 
      $r=mysqli_query($conn,"SELECT * FROM registration");
      $num_rows=mysqli_num_rows($r);
      echo "$num_rows \n";
      ?></span>
      </div>

      <div class="col-sm-6" style="height:100px;font-size:40px;padding-top:40px;">
      <a href="manageorder.php"><center>Total order<center></a> <span class="badge" style="font-size:30px;">
      <?php 
      $res=mysqli_query($conn,"SELECT * FROM payment");
      $num_rows=mysqli_num_rows($res);
      echo "$num_rows \n";
          
      ?>
      </span>
                  
          </div>
   </div>
<!DOCTYPE html>
<html>
  <head>
     <style type="text/css">
      .button{
       background-color: white;
       border: none;
       color: black;
      }
      .button:hover{
      background-color: green;
       color: white;
       }
     </style>
   <title>Dash bord</title>
  </head>
  <body>
  </body>
</html>
</div>



<?php

  include('footer.php');

?>