<?php

	session_start();

	$conn=mysqli_connect("localhost","root","","shopping") or die("Database not connect");

	if(isset($_POST['submit']))
	{
		$email=$_POST['email'];
		$password=$_POST['password'];
	
		$query=mysqli_query($conn,"SELECT * FROM admin WHERE email='$email' AND password='$password'");

		if($row = mysqli_fetch_array($query)) {
			$_SESSION['email']=$email;
			$_SESSION['name'] = $row['name'];

			header('location:dashboard.php');
		}else{

			header('location:index.php');
		}
	}
?>

<html>
<body background="image/background2.jpg" style="background-repeat: no-repeat;background-size: 1400px 660px;">
	<div class="main" style="background:rgba(0,0,0,0.5);color:white;margin-right: 560px;margin-left: 400px " >
		<div style="margin-top: 200px;margin-left: 15px; ">
		<h1 style="background-color: blue;margin-left: -15px;text-align: center">Admin Login</h1>
		<div class="main-w3lsrow">
			<!-- login form -->
			<div class="login-form login-form-left"> 
				<div class="agile-row">
					<div class="login-agileits-top"> 	
						<form method="post"> 
							<p style="font-size: 20px">Email </p>
							<input type="text" class="name" name="email" required=""/>
							<p style="font-size: 20px">Password</p>
							<input type="password" class="password" name="password" required=""/>  
							<label class="anim">
								<input type="checkbox" class="checkbox">
								<span> Remember me ?</span> 
							</label>   
							<input type="submit" value="Login" name="submit"> 
						</form> 	
					</div>
<div class="login-agileits-bottom"> 
						<h6><a href="forgot.php" style="color:white;font-size: 15px">Forgot password?</a></h6>
					</div>					
					<br> 
					</div>
				</div>  
			</div>  
		</div>	
	</div>	
</body>
</html>	