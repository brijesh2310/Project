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
        <li class="breadcrumb-item active">Manage User</li>
      </ol>
     
      </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
               
				<table  id="sampleTable" class="table table-hover table-bordered">
					<thead>
					<tr> 

						
						
						<th>Name</th>
						<th>Email</th>
						<th>Password</th>
						<th>Address</th>
						<th>City</th>
						<th>Area</th>
						<th>Postal code</th>
						<th>Gender</th>
						<th>Mobile</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
							
				 <?php
				$result=mysqli_query($conn,"select * from Registration ");
				while($row=mysqli_fetch_array($result))
				{
				?>
								<tr>
									
										<td><?php echo $row['name']; ?></td>
										<td><?php echo $row['email']; ?></td>
										<td><?php echo $row['password']; ?></td>
										<td><?php echo $row['address']; ?></td>
										<td><?php echo $row['city']; ?></td>
										<td><?php echo $row['area']; ?></td>
										<td><?php echo $row['postalcode']; ?></td>
										<td><?php echo $row['gender']; ?></td>
										<td><?php echo $row['mobile']; ?></td>
										<td><a href="deleteuser.php?did=<?php echo $row['registration_id']; ?>">Delete</td>	
										
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
    <!-- Javascripts-->
	</body>
</html>