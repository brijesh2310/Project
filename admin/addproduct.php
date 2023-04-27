<?php

  include('header.php');

?>

<?php
$conn=mysqli_connect("localhost","root","","shopping")or die("database not connected")
?>


<div class="content-wrapper">
      <div class="container-fluid">
      
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="header.php">Home</a>
        </li>
        <li class="breadcrumb-item active">Add Product</li>
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
   <title>Add Product</title>
  </head>
  <body>
     <form method="POST" enctype="multipart/form-data">
    <table align="center">
      <tr>
      <th>
      <label>Product code :</label>
    </th>
      <td>
        <input class="form-control" type="text" placeholder="Enter code" name="code">
      </td>
    </tr>
          <div class="clearfix"></div>
    <tr>
      <th>
      <label>Product Name :</label>
    </th>
      <td>
        <input class="form-control" type="text" placeholder="Enter Product Name" name="name">
      </td>
    </tr>
          <div class="clearfix"></div>
    <tr>
      <th>
      <label>Product Price :</label>
      </th>
      <td>
        <input class="form-control" type="text" placeholder="Enter Product Price" name="price">
      </td>
    </tr>
          <div class="clearfix"></div>
    <tr>
      <th>
      <label>Product Image :</label>
      </th>
      <td>
        <input class="form-control" type="FILE" name="img">
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


<?php
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

    $res=mysqli_query($conn,"INSERT INTO product(product_code,product_name,product_price,product_img,product_desc,subcategory_name,category_name)VALUES('$code','$name','$price', '$path','$desc','$sname','$cname')");


    if($res==true)
    {
      echo "Data Insert";
    }
    else
    {
      echo "Data Not Insert";
    }
}

?>
</div>



<?php

  include('footer.php');

?>