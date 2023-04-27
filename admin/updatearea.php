<?php

  include('header.php');
?>

<div class="content-wrapper">
      <div class="container-fluid">
      
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="header.php">Home</a>
        </li>
        <li class="breadcrumb-item active">Update Area</li>
      </ol>
     
       </div>

<?php
  $conn=mysqli_connect("localhost","root","","shopping")or die("database not connected");

    if(isset($_POST['insert']))
    {

    $name=$_POST['aname'];

      $result=mysqli_query($conn,"UPDATE area SET area_name='$name' WHERE area_id='".$_GET['id']."'");
      //header('location:viewcategory.php');  
      echo "<script>document.location='viewarea.php';</script>";
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
        $result=mysqli_query($conn,"SELECT * FROM area WHERE area_id='".$_GET['id']."'");
        $row=mysqli_fetch_array($result);
      }
      ?>

      <tr>
      <th>
      <label>Area Name :</label>
    </th>
      <td>
        <input class="form-control" type="text" name="cname" value="<?php echo $row['area_name']; ?>">
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


