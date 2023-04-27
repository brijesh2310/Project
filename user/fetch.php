<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "shopping");
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 // $query = "SELECT * FROM product inner join category on product.p_cat_id=category.category_id inner join subcategory on product.p_subcat_id=subcategory.subcat_id WHERE product_name LIKE '%".$search."%' OR subcategory_name LIKE '%".$search."%'";


$query = "SELECT * FROM product WHERE product_name LIKE '%".$search."%' OR subcategory_name LIKE '%".$search."%' OR category_name LIKE '%".$search."%'";

$result = mysqli_query($connect, $query);
$num=mysqli_num_rows($result);
if($num > 0)
{
 $output .= '
  <div class="table-responsive">
   <table class="table table bordered">
    <tr>
    
     <th>Name</th>
     <th>Image</th>
     <th>Subcategory Name</th>
     <th>Category Name</th>
   
    </tr>
 ';
 while($row = mysqli_fetch_array($result))
 {
 $img=$row["product_img"];
  $output .= '
   <tr>
    <td><a href="pdetail.php?pid='.$row["product_id"].'" style="color:inherit;">'.$row["product_name"].'</a></td>
    <td><img src="'.$img.'" width="80" height="80"></td>
    
    <td>'.$row["subcategory_name"].'</td>
    <td>'.$row["category_name"].'</td>
   
   </tr>
  ';
 }
 echo $output;
}
else
{
 echo 'Data Not Found';
}

}




?>