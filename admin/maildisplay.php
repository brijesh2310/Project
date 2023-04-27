<?php

  include('header.php');

?>

  <?php
                $conn=mysqli_connect("localhost","root","","shopping")or die("database not connected");
                $query = mysqli_query($conn, "SELECT * FROM mail");
               
               
                ?>

<div class="content-wrapper">
      <div class="container-fluid">
      
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="header.php">Home</a>
        </li>
        <li class="breadcrumb-item active">mail</li>
      </ol>
     
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
   
<div class="container">
<table class="table">
	<tr class="bg-success">
		<th>Name</th>
		<th class="bg-warning">Email</th>
		<th>Telephone</th>
		<th>Message</th>
	</tr>
	<?php
	 while ( $row = mysqli_fetch_array($query)) {
      ?>
	<tr>
		<th><?php echo $row['name'];?></th>
		<th><?php echo $row['email'];?></th>
		<th><?php echo $row['telephone'];?></th>
		<th><?php echo $row['message'];?></th>
	
	</tr>
	<?php          	
                }
	?>
</table>
</div>
<div align="center">
<a href="dashboard.php"><button class="btn btn-primary">GO TO Back</button></a>
</div>
  </body>
</html>


</div>



<?php

  include('footer.php');

?>