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
        <li class="breadcrumb-item active">SubCategory</li>
      </ol>
     
      </div>

<!DOCTYPE html>
<html>
  <head>
    <style type="text/css">
      .button{
       background-color: white;
       color: black;
       border: none;
      }
      .button:hover{
      background-color: #4CAF50;
       color: white;
       }
     </style>
   <title>add category</title>

  </head>
  <body>
      <form method="POST" enctype="multipart/form-data">
      <table style="height: 200px;" align="center">
        <tr>
          <th><label>Subcategory Name :</label></th>
      <td>
        <input class="form-control" type="text" name="name">
      </td>
    </tr>
            <div class="clearfix"></div>
            
    <tr>
      <th>
      <label>Subcategory Image :</label>
      </th>
      <td>
        <input class="form-control" type="FILE" name="img">
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


<?php
if(isset($_POST['insert']))
{

    $name=$_POST['name'];
    $cname=$_POST['catname'];

    $g=$_FILES['img']['name'];
    $g1=$_FILES['img']['tmp_name'];
    $path="image/".$g;

    move_uploaded_file($g1, $path);
    

    $res=mysqli_query($conn,"INSERT INTO sub_category(subcategory_name,subcategory_img,category_name)VALUES('$name','$path','$cname')");


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