<?php

	include "header.php";
	$conn=mysqli_connect("localhost","root","","shopping")or die("database not connected")


?>
<div class="content-wrapper">
      <div class="container-fluid">
      
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="header.php">Home</a>
        </li>
        <li class="breadcrumb-item active">Manage Order</li>
      </ol>
     
      </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="table-responsive">
				
                <table id="sampleTable" class="table table-hover table-bordered">
                  <thead>
                    <tr>
						<th>Name</th>
						<th>Email</th>
						<th>Mobile_no</th>
						<th>Billing address</th>
						<th>Shipping address</th>
						<th>City</th>
						<th>State</th>
						<th>Pincode</th>
						<th>Payment method</th>
						<th>card no</th>
						<th>expiry date</th>
						
						<th>Product name</th>
						<th>Product quantity</th>
						<th>Product price</th>
						<th>Total price</th>
						<th>Order date</th>
						<th>Action</th>
					</tr>
                  </thead>
				  <tbody>
				   <?php
				$result=mysqli_query($conn,"select * from payment ");
				while($row=mysqli_fetch_array($result))
				{
				?>
                 			<tr>	
									<td><?php echo $row['name']; ?></td>
									<td><?php echo $row['email']; ?></td>
									<td><?php echo $row['mobile_no']; ?></td>
									<td><?php echo $row['billing_address']; ?></td>		
									<td><?php echo $row['shipping_address']; ?></td>
									<td><?php echo $row['city']; ?></td>
									<td><?php echo $row['state']; ?></td>
									<td><?php echo $row['pincode']; ?></td>
									<td><?php echo $row['payment_method']; ?></td>
									<td><?php echo $row['card_no']; ?></td>
									<td><?php echo $row['expiry_date']; ?></td>
									<td><?php echo $row['product_name']; ?></td>
									<td><?php echo $row['product_quantity']; ?></td>
									<td><?php echo $row['product_price']; ?></td>
									<td><?php echo $row['total_price']; ?></td>
									<td><?php echo $row['order_date']; ?></td>
									<td><a href="deleteorder.php?did=<?php echo $row['a_id']; ?>">Delete</td>
							</tr>
					<?php
						}
						?>
							
				</tbody>
				</table>
              </div>
            </div>
          </div>
        </div>
      </div>
	</div>
   
	</body>
</html>