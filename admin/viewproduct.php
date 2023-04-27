<?php

  include('header.php');

?>
<?php
$conn=mysqli_connect("localhost","root","","shopping")or die("database not connected");
$res=mysqli_query($conn,"SELECT * FROM product");
$id=1;

?>

<div class="content-wrapper">
      <div class="container-fluid">
      
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="header.php">Home</a>
        </li>
        <li class="breadcrumb-item active">View Product</li>
      </ol>
     </div>

<table class="table">
  <thead>
    <tr>
      <th>product_id</th>
      <th>product_code</th>
      <th>product_name</th>
      <th>product_price</th>
      <th>product_img</th>
      <th>product-desc</th>
      <th>subcategory_name</th>
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
    <!-- <td><?php //echo $row['product_id']; ?></td> -->
    <td><?php echo $row['product_code']; ?></td>
    <td><?php echo $row['product_name']; ?></td>
    <td><?php echo $row['product_price']; ?></td>
    <td><img src="<?php echo $row['product_img']; ?>" style="height: 60px;"></td>
    <td><textarea name=""><?php echo $row['product_desc']; ?></textarea></td>
    <td><?php echo $row['subcategory_name']; ?></td>
    <td><?php echo $row['category_name']; ?></td>
    <td><a href="deleteproduct.php?did=<?php echo $row['product_id']; ?>">Delete</td>
    <td><a href="updateproduct.php?id=<?php echo $row['product_id']; ?>">Update</td>
</tr>
<?php
}
?>
</table>

      </div>

<?php

  include('footer.php');

?>