<?php

  include('header.php');
?>

<div class="content-wrapper">
      <div class="container-fluid">
      
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="header.php">Home</a>
        </li>
        <li class="breadcrumb-item active">Update Category</li>
      </ol>
     
       </div>

<?php
  $conn=mysqli_connect("localhost","root","","shopping")or die("database not connected");

    if(isset($_POST['insert']))
    {

    $name=$_POST['catname'];

    $g=$_FILES['img']['name'];
    $g1=$_FILES['img']['tmp_name'];
    $path="image/".$g;

    move_uploaded_file($g1, $path);
    

    if($_FILES['img']['name']==''){

      $result=mysqli_query($conn,"UPDATE category SET category_name='$name' WHERE category_id='".$_GET['id']."'");
    }
    else
    {

      mysqli_query($conn,"UPDATE category SET category_name='$name',category_img='$path' WHERE category_id='".$_GET['id']."'");
    }
      //header('location:viewcategory.php');  
      echo "<script>document.location='viewcategory.php';</script>";
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
        $result=mysqli_query($conn,"SELECT * FROM category WHERE category_id='".$_GET['id']."'");
        $row=mysqli_fetch_array($result);
      }
      ?>

      <tr>
      <th>
      <label>Category Name :</label>
    </th>
      <td>
        <input class="form-control" type="text" name="catname" value="<?php echo $row['category_name']; ?>">
      </td>
    </tr>

            <div class="clearfix"></div>
            <br>
    <tr>
      <th>
      <label>Category Image :</label>
    </th>
      <td>
        <input class="form-control" type="file" name="img" value="<?php echo $row['category_img']; ?>">
      </td>
    </tr>
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


