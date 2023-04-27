<?php
	include("header.php");
  	include_once 'database.php';

    if(isset($_POST['submit']))
    {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $city = $_POST['cname'];
        $area = $_POST['aname'];
        $postalcode = $_POST['postalcode'];
        $gender = $_POST['gender'];
		if($email==0){
    	mysqli_query($conn,"insert into registration (name,email,password,address,city,area,postalcode,gender,mobile)values('$name','$email','$password','$address','$city','$area','$postalcode','$gender','$mobile')"); 
    	echo "<script>alert('registration Successful..');document.location='login.php'</script>";
		}else{
			echo "this email is already exiest";
		}
    }
?>

	<!--content-->
		<div class="content">
				<!--login-->
			<div class="login">
		<div class="main-agileits">
				<div class="form-w3agile form1">
					<h3>Register</h3>
					<form action="" method="post">
						<div class="key">
							<i class="fa fa-user" aria-hidden="true"></i>
							<input  type="text" placeholder="Username" name="name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" required="">
							<div class="clearfix"></div>
						</div>
						<div class="key">
							<i class="fa fa-envelope" aria-hidden="true"></i>
							<input  type="text" placeholder="Email" name="email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" required="">
							
							<div class="clearfix"></div>
						</div>
						<div class="key">
							<i class="fa fa-lock" aria-hidden="true"></i>
							<input  type="password" placeholder="Password" name="password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" required="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
							<div class="clearfix"></div>
						</div>
						<div class="key">
							<i class="fa fa-lock" aria-hidden="true"></i>
							<input  type="password" placeholder="Confirm Password" name="confpassword" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" required="">
							<div class="clearfix"></div>
						</div>

						<div class="key">
							<textarea  style="width: 335px; height: 50px;" placeholder="Address"  name="address" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" required=""></textarea>
							<div class="clearfix"></div>
						</div>

						<div class="key">
							 <select name ="cname" class="form-control">
        					<?php

         						 $conn = mysqli_connect("localhost","root","","shopping");
          						  $q = "select * from city";
          						  $result = mysqli_query($conn,$q);
           						 while($row = mysqli_fetch_array($result))
           						 {
            				  ?>

              				<option value="<?php echo $row['1']; ?>"><?php echo $row['1']; ?></option>
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
           						 while($row = mysqli_fetch_array($result))
           						 {
            				  ?>

              				<option value="<?php echo $row['1']; ?>"><?php echo $row['1']; ?></option>
            				<?php
            				}

        					?>
      
      						</select>
							<div class="clearfix"></div>
						</div>

						<div class="key">
							<i class="fa fa-lock" aria-hidden="true"></i>
							<input  type="text" placeholder="postal code" name="postalcode" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" required="">
							<div class="clearfix"></div>
						</div>
							<div class="col-sm-3"></div>
								<div class="col-sm-3">
						 			<label><input type="radio"  name="gender" value="male">Male</label>
								</div>
								<div class="col-sm-4">
               			 			<label><input type="radio"  name="gender" value="female">Female</label>
               					</div>
               				<div class="clearfix"></div>
						<div class="key">
							<i class="fa-solid fa-phone" aria-hidden="true"></i>
							<input  type="text" name="mobile" placeholder="Mobile" onfocus="this.value = '';" min="0" max="10" onblur="if (this.value == '') {this.value = '';}" required="">
							<div class="clearfix"></div>
						</div>
						<a href="login.php?redirect=checkout.php">
						<input type="submit" value="Submit" name="submit"></a>
					</form>
				</div>
				
			</div>
		</div>
				<!--login-->
		</div>
		
		
<?php include("footer.php"); ?>				
</body>
</html>