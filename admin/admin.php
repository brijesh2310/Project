<?php
	include("header.php");
 $conn=mysqli_connect("localhost","root","","shopping") or die("can't connect database");
?>

<div class="content-wrapper">
     <div class="container-fluid">
      
      <ol class="breadcrumb">
       	 <li class="breadcrumb-item">
          <a href="header.php">Home</a>
        	</li>
        	<li class="breadcrumb-item active" style="color: red">Add Category</li>
      </ol>
	</div>


<!DOCTYPE html>
	<html>
   		<head>
     	<style type="text/css">
      		.button{
       		background-color: white;
       		color: black;
       		border: none;
      		}
      		.button:hover{
      		background-color: #4CAF50;
       		color: white;
       		}
     	</style>
   		<title>admin registration</title>
   	

<!-- Form Validation Starts -->
<script type="text/javascript">
	function validateForm(){
		var uname = document.forms["myform"]["name"];
		var uemail = document.forms["myform"]["email"];
		var umobile = document.forms["myform"]["mobile"];
		var uaddr = document.forms["myform"]["address"];
		var upass = document.forms["myform"]["password"];
		var uconfpass = document.forms["myform"]["confpassword"];

		/* Name Validation */
		var regex1 = /^[a-zA-Z ]*$/;
		if(uname.value == ""){
			document.getElementById("msg1").innerHTML = "* Please fill this field";
			uname.focus();
			return false;
		}else if(regex1.test(uname.value) == false){
			document.getElementById("msg1").innerHTML = "Name must be in alphabets only";
			uname.focus();
			return false;
		}else{
			document.getElementById("msg1").innerHTML = "";
		}

		/* Email Validation */
		var regex2 = /^(([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5}){1,25})*$/;
		if(uemail.value == ""){
			document.getElementById("msg2").innerHTML = "* Please fill this field";
			uemail.focus();
			return false;
		}else if(regex2.test(uemail.value) == false){
			document.getElementById("msg2").innerHTML = "Invalid Email";
			uemail.focus();
			return false;
		}else{
			document.getElementById("msg2").innerHTML = "";
		}

		/* Mobile Validation */
		var regex3 = /^([0-9]{10})*$/;
		if(umobile.value == ""){
			document.getElementById("msg3").innerHTML = "* Please fill this field";
			umobile.focus();
			return false;
		}else if(regex3.test(umobile.value) == false){
			document.getElementById("msg3").innerHTML = "Mobile must be in 10 digits";
			umobile.focus();
			return false;
		}else{
			document.getElementById("msg3").innerHTML = "";
		}

		/* Address Validation */
		if(uaddr.value == ""){
			document.getElementById("msg4").innerHTML = "* Please fill this field";
			uaddr.focus();
			return false;
		}else{
			document.getElementById("msg4").innerHTML = "";
		}

		/* Password Validation */
		if(upass.value == ""){
			document.getElementById("msg6").innerHTML = "* Please fill this field";
			upass.focus();
			return false;
		}else{
			document.getElementById("msg6").innerHTML = "";
		}

		/* Confirm Password Validation */
		if(uconfpass.value == ""){
			document.getElementById("msg7").innerHTML = "* Please fill this field";
			uconfpass.focus();
			return false;
		}else if(uconfpass.value != upass.value){
			document.getElementById("msg7").innerHTML = "Confirm password must be same as password";
			uconfpass.focus();
			return false;
		}else{
			document.getElementById("msg7").innerHTML = "";
		}
	}
</script>
<!-- Form Validation Ends -->
		</head>
	<body>
	<!-- main -->
	<div align="center"> 
    <form method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
      	<table style="height: 200px;">
		<h1>Admin Registration</h1>
		<div class="main-w3lsrow">
			<!-- login form -->
			<tr>
     			 <th>
     				 <label>Name :</label>
   				 </th>
    			<td>
       				 <input class="form-control" type="text" name="name">
       				 <label id="msg1"></label>
      			</td>
    		</tr> 
			<tr>
     			 <th>
     				 <label>Email :</label>
   				 </th>
    			<td>
       				 <input class="form-control" type="text" name="email">
       				 <label id="msg2"></label>
      			</td>
    		</tr> 
							
			<tr>
     			 <th>
     				 <label>Mobile :</label>
   				 </th>
    			<td>
       				 <input class="form-control" type="text" name="mobile">
       				 <label id="msg3"></label>
      			</td>
    		</tr> 
			<tr>
     			 <th>
     				 <label>Address :</label>
   				 </th>
    			<td>
       				 <input class="form-control" type="text" name="address">
       				 <label id="msg4"></label>
      			</td>
    		</tr> 
			<tr>
     			 <th>
     				 <label>Password :</label>
   				 </th>
    			<td>
       				 <input class="form-control" type="password" name="password">
       				 <label id="msg6"></label>
      			</td>
    		</tr> 
			<tr>
     			 <th>
     				 <label>Confirm Password :</label>
   				 </th>
    			<td>
       				 <input class="form-control" type="password" name="confpassword">
       				 <label id="msg7"></label>
      			</td>
    		</tr>  
			<td align="center" colspan="2">
            <button class="btn btn-danger button" type="submit" name="submit">ADD</button>
      		</td>
            <div class="clearfix"></div>
    	  </div>
		</table>
 	 </form>
	</div>
</div>	
	<!-- //main --> 
</body>
</html>

<?php
  if(isset($_POST['submit']))
  {
  	$name=$_POST['name'];
  	$email=$_POST['email'];
  	$mobile=$_POST['mobile'];
  	$address=$_POST['address'];
  	$password=$_POST['password'];

  	mysqli_query($conn,"insert into admin(name,email,password,address,mobile)values('$name','$email','$password','$address','$mobile')");
  }
?>
</div>
