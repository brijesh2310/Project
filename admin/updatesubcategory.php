<?php

  include('header.php')

?>

<div class="content-wrapper">
      <div class="container-fluid">
      
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="header.php">Home</a>
        </li>
        <li class="breadcrumb-item active" style="color: red;">Update SubCategory</li>
      </ol>
     
      </div>

<?php
  $conn=mysqli_connect("localhost","root","","shopping")or die("database not connected");


   if(isset($_POST['insert']))
   {

     $sname=$_POST['scatname'];

      $g=$_FILES['img']['name'];
      $g1=$_FILES['img']['tmp_name'];
      $path="image/".$g;

      move_uploaded_file($g1, $path);
      
    
      $cname=$_POST['catname'];


    if($_FILES['img']['name']==''){

      $result=mysqli_query($conn,"UPDATE sub_category SET subcategory_name='$sname',category_name='$cname' WHERE subcategory_id='".$_GET['id']."'");
    }else{

      $result=mysqli_query($conn,"UPDATE sub_category SET subcategory_name='$sname',subcategory_img='$path',category_name='$cname' WHERE subcategory_id='".$_GET['id']."'");
    }
    echo "<script>document.location='viewsubcategory.php';</script>";
  }

?>

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
   <title>Update Product</title>
  </head>
  <body>
     <form method="POST" enctype="multipart/form-data">
    <table align="center">

      <?php 
        if(isset($_GET['id'])){
        $result=mysqli_query($conn,"SELECT * FROM sub_category WHERE subcategory_id='".$_GET['id']."'");
        $row=mysqli_fetch_array($result);
      }
      ?>


        <tr>
          <th><label>Subcategory Name :</label></th>
      <td>
        <input class="form-control" type="text" name="scatname"  value="<?php echo $row['subcategory_name']; ?>">
      </td>
    </tr>
            <div class="clearfix"></div>

     <tr>
      <th>
      <label>Subcategory Image :</label>
      </th>
      <td>
        <input class="form-control" type="FILE" name="img" value="<?php echo $row['subcategory_img']; ?>">
      </td>
    </tr>
             <div class="clearfix"></div>

   <tr>
      <th>
      <label>Category Name :</label>
     </th>
      <td>
        
        <select name ="catname" class="form-control">
        <?php
          $conn = mysqli_connect("localhost","root","","shopping");
            $q = "select * from category";
            $result = mysqli_query($conn,$q);
            while($row = mysqli_fetch_array($result))
            {
              ?>
              <option value="<?php echo $row['1']; ?>"><?php echo $row['1']; ?></option>
            <?php
            }
        ?>
      </select>   

      </td>
    </tr>
            <div class="clearfix"></div>

          
    <tr>
      <td colspan="2" align="center">
            <button class="btn btn-danger button" type="submit" name="insert">ADD</button>
      </td>
    </tr>
            <div class="clearfix"></div>
  </table>
  </form>


  </body>
</html>
</div>

<?php

  include('footer.php')

?>