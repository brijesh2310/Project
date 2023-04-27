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
        <li class="breadcrumb-item active" style="color: red">Add Category</li>
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
    <div align="center"> 
    <form method="POST" enctype="multipart/form-data">
      <table style="height: 200px;">
        <tr>
      <th>
      <label>Category Name :</label>
    </th>
      <td>
        <input class="form-control" type="text" name="catname">
      </td>
    </tr>

            <div class="clearfix"></div>
            <br>
    <tr>
      <th>
      <label>Category Image :</label>
    </th>
      <td>
        <input class="form-control" type="FILE" name="img">
      </td>
    </tr>
    <td align="center" colspan="2">
            <button class="btn btn-danger button" type="submit" name="insert">ADD</button>
      </td>
            <div class="clearfix"></div>
</table>
  </form>
</div>
  </body>
</html>


<?php
if(isset($_POST['insert']))
{

    $name=$_POST['catname'];

    $g=$_FILES['img']['name'];
    $g1=$_FILES['img']['tmp_name'];
    $path="image/".$g;

    move_uploaded_file($g1, $path);
    

    $res=mysqli_query($conn,"INSERT INTO category(category_name,category_img)VALUES('$name','$path')");


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