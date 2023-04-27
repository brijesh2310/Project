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
        <li class="breadcrumb-item active" style="color: red">Add City</li>
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
   <title>add city</title>
   </head>
  <body>
    <div align="center"> 
    <form method="POST" enctype="multipart/form-data">
      <table style="height: 200px;">
        <tr>
      <th>
      <label>City Name :</label>
    </th>
      <td>
        <input class="form-control" type="text" name="cname">
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
  </body>
</html>


<?php
if(isset($_POST['insert']))
{

    $name=$_POST['cname'];

    $res=mysqli_query($conn,"INSERT INTO city(city_name)VALUES('$name')");


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