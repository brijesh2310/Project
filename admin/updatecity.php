<?php

  include('header.php');
?>

<div class="content-wrapper">
      <div class="container-fluid">
      
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="header.php">Home</a>
        </li>
        <li class="breadcrumb-item active">Update City</li>
      </ol>
     
       </div>

<?php
  $conn=mysqli_connect("localhost","root","","shopping")or die("database not connected");

    if(isset($_POST['insert']))
    {

    $name=$_POST['cname'];

      $result=mysqli_query($conn,"UPDATE city SET city_name='$name' WHERE city_id='".$_GET['id']."'");
      //header('location:viewcategory.php');  
      echo "<script>document.location='viewcity.php';</script>";
    }


?>
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
     <form method="POST" enctype="multipart/form-data">
    <table align="center">

      <?php 
        if(isset($_GET['id'])){
        $result=mysqli_query($conn,"SELECT * FROM city WHERE city_id='".$_GET['id']."'");
        $row=mysqli_fetch_array($result);
      }
      ?>

      <tr>
      <th>
      <label>City Name :</label>
    </th>
      <td>
        <input class="form-control" type="text" name="cname" value="<?php echo $row['city_name']; ?>">
      </td>
    </tr>

            <div class="clearfix"></div>
            <br>
    <td align="center" colspan="2">
            <button class="btn btn-danger button" type="submit" name="insert">ADD</button>
      </td>
            <div class="clearfix"></div>
</table>
  </form>
</div>

<?php

  include('footer.php');
?>


