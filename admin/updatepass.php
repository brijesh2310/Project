


<?php
	include('dbcon.php');
	session_start();
	
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/php; charset=utf-8" />
		<title>Fashion Paradise</title>
		<link href="css/style.css" rel="stylesheet" type="text/css"  media="all" />
		<link href='//fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/responsiveslides.css">
		<script src="js/jquery.min.js"></script>
		<script src="js/responsiveslides.min.js"></script>
		  
</head>
<style>
body {font-family: Arial;}
* {box-sizing: border-box}

/* Full-width input fields */
input[type=text], input[type=password] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
    background-color: #ddd;
    outline: none;
}

hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
}

/* Set a style for all buttons */
button {
    background-color:#FF3333;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
}

button:hover {
    opacity:1;
}



.cancelbtn, .Loginbtn {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
.container {
    padding: 16px;
}

/* Clear floats */
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
    .cancelbtn, .Loginbtn {
       width: 100%;
    }
}
</style>
<body>

		<div class="wrap">
			
			</div>

<form action="" style="color:#FFFFFF;" method="post">
  <div class="container" style="width:500px; color:#FFFFFF;margin-left:300px;">
    <h3 align="center" style="font-size:30px; color:#F50">Reset Password</h3>
    
	<label><b>Email  : </b></label>
    <input type="text" value="<?php if(isset($_SESSION['email_otp'])) echo $_SESSION['email_otp']; ?>" placeholder="Enter Email" style="color:#000;" name="otp" disabled>

    <label><b> New Password : </b></label>
    <input type="password" placeholder="New Password" name="new" style="color:#000;" required>
    <label><b>Confirm Password : </b></label>
    <input type="password" placeholder="Confirm Password" name="confirm" style="color:#000;" required>

	
	
    <div class="clearfix">
      
      <button type="submit" class="Loginbtn" style="width:50%;margin-left:130px;"  name="submitpass">Change Password</button>
    </div
  ></div>
</form>
<?php

	if(isset($_POST['submitpass']))
	{
		$new = $_POST['new'];
		$pass = $_POST['confirm'];


		if($new == $pass)
		{
				

				$q = "UPDATE `admin` SET `password`= '$pass' WHERE `email`= '".$_SESSION["email_otp"]."'";
				mysqli_query($db,$q);
				echo '<script>alert("Password Updated Successfully.");</script>';
				echo '<script>window.location = "index.php";</script>'; 
		}
		else{
			echo '<script>alert("Password Does not Matched.please try again.");</script>';
		}

	}

			
			
			
					
			
						

?>
</body>
</html>