<?php

  include('header.php');

$conn=mysqli_connect("localhost","root","","shopping")or die("database not connected");
$res=mysqli_query($conn,"SELECT * FROM city");
$id=1;

?>


<div class="content-wrapper">
      <div class="container-fluid">
      
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="header.php">Home</a>
        </li>
        <li class="breadcrumb-item active">View City</li>
      </ol>
     
      </div>
      


<table class="table">
  <thead>
    <tr>
      <th>id</th>
      <th>city_name</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>
  </thead>


<?php

while ($row=mysqli_fetch_array($res)){
?>
<tr>
    <td><?php echo $id++; ?></td>
    <td><?php echo $row['city_name']; ?></td>
    <td><a href="deletecity.php?id=<?php echo $row['city_id']; ?>">Delete</td>
    <td><a href="updatecity.php?id=<?php echo $row['city_id']; ?>">Update</td>
</tr>
<?php
}
?>
</table>
</div>
<?php

  include('footer.php');

?>