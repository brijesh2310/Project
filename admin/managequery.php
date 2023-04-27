<?php
	
	include "header.php";
$conn=mysqli_connect("localhost","root","","shopping")or die("database not connected");
?>
<div class="content-wrapper">
      <div class="container-fluid">
      
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="header.php">Home</a>
        </li>
        <li class="breadcrumb-item active">Query</li>
      </ol>
     
      </div>
       <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
				                <table id="sampleTable" class="table table-hover table-bordered">
                  <thead>
                    <tr>
						<th>Name</th>
							<th>Email</th>
						  <th>Mobile</th>
						  <th>Message</th>

                    </tr>
                  </thead>
				  <tbody>
				  	 <?php
				$result=mysqli_query($conn,"select * from mail ");
				while($row=mysqli_fetch_array($result))
				{
				?>
				<tr>					<td><?php echo $row['name']; ?></td>
										<td><?php echo $row['email']; ?></td>
										<td><?php echo $row['telephone']; ?></td>
										<td><?php echo $row['message']; ?></td>
												
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