<?php

  include('header.php');

$conn=mysqli_connect("localhost","root","","shopping")or die("database not connected");
$res=mysqli_query($conn,"SELECT * FROM sub_category");
$id=1;

?>


?>


<div class="content-wrapper">
      <div class="container-fluid">
      
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="header.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Dashboard</li>
      </ol>
     </div>

<table class="table">
  <thead>
    <tr>
      <th>id</th>
      <th>subcategory_name</th>
      <th>subcategory_img</th>
      <th>category_name</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>
  </thead>


<?php

while ($row=mysqli_fetch_array($res)){
?>
<tr>
    <td><?php echo $id++; ?></td>
    <td><?php echo $row['subcategory_name']; ?></td>
    <td><img src="<?php echo $row['subcategory_img']; ?>" style="height: 60px;"></td>
    <td><?php echo $row['category_name']; ?></td>
    <td><a href="deletesubcategory.php?id=<?php echo $row['subcategory_id']; ?>">Delete</td>
    <td><a href="updatesubcategory.php?id=<?php echo $row['subcategory_id']; ?>">Update</td>
</tr>
<?php
}
?>
</table>

      </div>

<?php

  include('footer.php');

?>