<?php
  include('header.php');
?>
<div class="content-wrapper">
      <div class="container-fluid">
      
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Home</a>
        </li>
        <li class="breadcrumb-item active" style="color: red;">Update Product</li>
      </ol>
     
      </div>


<?php
  $conn=mysqli_connect("localhost","root","","shopping")or die("database not connected");


   if(isset($_POST['insert']))
   {


      $code=$_POST['code'];
      $name=$_POST['name'];
      $price=$_POST['price'];

      $g=$_FILES['img']['name'];
      $g1=$_FILES['img']['tmp_name'];
      $path="image/".$g;

      move_uploaded_file($g1, $path);
      
        $desc=$_POST['desc'];

      $sname=$_POST['scatname'];
      $cname=$_POST['catname'];


    if($_FILES['img']['name']==''){

      $result=mysqli_query($conn,"UPDATE product SET product_code='$code',product_name='$name',product_price='$price',product_desc='$desc',subcategory_name='$sname',category_name='$cname' WHERE product_id='".$_GET['id']."'");
    }else{

      $result=mysqli_query($conn,"UPDATE product SET product_code='$code',product_name='$name',product_price='$price',product_img='$path',product_desc='$desc',subcategory_name='$sname',category_name='$cname' WHERE product_id='".$_GET['id']."'");
      echo "<script>document.location='viewproduct.php';</script>";
    }
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
        $result=mysqli_query($conn,"SELECT * FROM product WHERE product_id='".$_GET['id']."'");
        $row=mysqli_fetch_array($result);
      }
      ?>


      <tr>
      <th>
      <label>Product code :</label>
    </th>
      <td>
        <input class="form-control" type="text" placeholder="Enter code" name="code"  value="<?php echo $row['product_code']; ?>">
      </td>
    </tr>
          <div class="clearfix"></div>
    <tr>
      <th>
      <label>Product Name :</label>
    </th>
      <td>
        <input class="form-control" type="text" placeholder="Enter Product Name" name="name"  value="<?php echo $row['product_name']; ?>">
      </td>
    </tr>
          <div class="clearfix"></div>
    <tr>
      <th>
      <label>Product Price :</label>
      </th>
      <td>
        <input class="form-control" type="text" placeholder="Enter Product Price" name="price"  value="<?php echo $row['product_price']; ?>">
      </td>
    </tr>
          <div class="clearfix"></div>
    <tr>
      <th>
      <label>Product Image :</label>
      </th>
      <td>
        <input class="form-control" type="FILE" name="img"  value=""><img src="<?php echo $row['product_img']; ?>"height="50px;" alt="">
      </td>
    </tr>
            <div class="clearfix"></div>
             <tr>
      <th>
      <label>Product desc :</label>
      </th>
      <td><textarea class="form-control" name="desc" placeholder="Enter desc"></textarea></td>
    </tr>
    <tr>
      <th>
      <label>Subcategory Name :</label>
      </th>
      <td>
        
        <select name ="scatname" class="form-control">
        <?php
          $conn = mysqli_connect("localhost","root","","shopping");
            $q = "select * from sub_category";
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
      <td align="center" colspan="2">
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
  include('footer.php');
?>