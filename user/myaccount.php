<?php
	include("header.php");

  	include_once 'database.php';

    if(isset($_SESSION['email']))
    {
    	$query = mysqli_query($conn,"select * from registration where email = '".$_SESSION['email']."'")or die( mysqli_error($conn));
		$row = mysqli_fetch_array($query);

    }else{
    	 echo "<script>document.location='login.php';</script>";
    }

  if(isset($_POST['update']))
  {
  	$name=$_POST['name'];
  	$mobile=$_POST['mobile'];
  	$address=$_POST['address'];
  	$gender = $_POST['gender'];
  	$city = $_POST['cname'];
  	$area = $_POST['aname'];
  	$postalcode = $_POST['postalcode'];

  
  	$query1 = mysqli_query($conn,"update registration set 
  								name = '$name',
  								address = '$address',
  								mobile = '$mobile',
  								city = '$city',
  								gender = '$gender',
  								postalcode = '$postalcode',
  								area = '$area'
  								where email = '".$_SESSION['email']."'");
 	if($query1)
 	{
 		 echo "<script>document.location='myaccount.php';</script>";
 	}
  }

?>

	<!--content-->
		<div class="content">
				<!--login-->
			<div class="login">
		<div class="main-agileits">
				<div class="form-w3agile form1">
					<h3>Account</h3>
					<form action="" method="post">
						<div class="key">
							<i class="fa fa-user" aria-hidden="true"></i>
							<input  type="text" placeholder="Username" name="name"  onblur="if (this.value == '') {this.value = '';}" required="" value="<?php echo $row['name']; ?>">
							<div class="clearfix"></div>
						</div>
						<div class="key">
							<i class="fa fa-envelope" aria-hidden="true"></i>
							<input  type="text" placeholder="Email" name="email"  onblur="if (this.value == '') {this.value = '';}" required="" value="<?php echo $row['email']; ?>" disabled>
							<div class="clearfix"></div>
						</div>

						<div class="key">
							<textarea  style="width: 370px; height: 45px;" placeholder="Address"  name="address"  onblur="if (this.value == '') {this.value = '';}" required=""><?php echo $row['address']; ?></textarea>
							<div class="clearfix"></div>
						</div>

						<div class="key">
							 <select name ="cname" class="form-control">
        					<?php

         						 $conn = mysqli_connect("localhost","root","","shopping");
          						  $q = "select * from city";
          						  $results = mysqli_query($conn,$q);
           						 while($rows = mysqli_fetch_array($results))
           						 {
            				  ?>

              				<option value="<?php echo $rows['1']; ?>" <?php if( ucfirst($row['city']) ==  ucfirst($rows['1'])){ echo "selected"; } ?> ><?php echo $rows['1']; ?></option>
            				<?php
            				}

        					?>
      
      						</select>
							<div class="clearfix"></div>
						</div>

						<div class="key">
							 <select name ="aname" class="form-control">
        					<?php

         						 $conn = mysqli_connect("localhost","root","","shopping");
          						  $q = "select * from area";
          						  $result = mysqli_query($conn,$q);
           						 while($rowa = mysqli_fetch_array($result))
           						 {
            				  ?>

              				<option value="<?php echo $rowa['1']; ?>" <?php if( ucfirst($row['area']) ==  ucfirst($rowa['1'])){ echo "selected"; } ?> ><?php echo $rowa['1']; ?></option>
            				<?php
            				}

        					?>
      
      						</select>
							<div class="clearfix"></div>
						</div>

						<div class="key">
							<i class="fa fa-lock" aria-hidden="true"></i>
							<input  type="text" placeholder="postal code" name="postalcode"  onblur="if (this.value == '') {this.value = '';}" required="" value="<?php echo $row['postalcode']; ?>"	>
							<div class="clearfix"></div>
						</div>
							<div class="col-sm-3"></div>
							<?php 
							$male = '';
							$female = '';
								if($row['gender'] == 'male')
								{
									$male = 'checked';
								}else{
									$female = 'checked';
								}
							?>
								<div class="col-sm-3">
						 			<label><input type="radio"  name="gender" value="male" <?php echo $male; ?>>Male</label>
								</div>
								<div class="col-sm-4">
               			 			<label><input type="radio"  name="gender" value="female" <?php echo $female; ?>>Female</label>
               					</div>
               				<div class="clearfix"></div>
						<div class="key">
							<i class="fa fa-envelope" aria-hidden="true"></i>
							<input  type="text" name="mobile" placeholder="Mobile"  onblur="if (this.value == '') {this.value = '';}" required=""  value="<?php echo $row['mobile']; ?>">
							<div class="clearfix"></div>
						</div>
						<a href="login.php?redirect=checkout.php">
						<input type="submit" value="update" name="update" ></a>
					</form>
				</div>
				
			</div>
		</div>
				<!--login-->
		</div>
		
		
<?php include("footer.php"); ?>				
</body>
</html>