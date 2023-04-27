<?php
	$conn=mysqli_connect("localhost","root","","shopping")or die("database not connected");

	$error_txt_old_pass=0;
	$error_txt_new_pass=0;
	$error_txt_repass=0;
	$old_wrong=0;
	$not_match=0;
	$success=0;

if(isset($_POST['btn_submit']))
{
	$old_pass=$_POST['txt_old_pass'];
	$new_pass=$_POST['txt_new_pass'];
	$re_pass=$_POST['txt_repass'];
	if(empty($old_pass))
	{
		$error_txt_old_pass=1;
	}
	if(empty($new_pass))
	{
		$error_txt_new_pass=1;
	}
	if(empty($re_pass))
	{
		$error_txt_repass=1;
	}
	if($error_txt_old_pass==0 && $error_txt_new_pass==0 &&$error_txt_repass==0)
	{
		$r=mysqli_query($conn,"select * from admin where password='$old_pass'");
		$num=mysqli_num_rows($r);
		
		if($num>0)
		{
			if($new_pass==$re_pass)
			{
				mysqli_query($conn,"update admin set password='$new_pass' where password='$old_pass'");
				$success=1;			
			}
			else
			{
				$not_match=1;
			}
		}
		else
		{
			$old_wrong=1;
		}
	}
}
	include "header.php";
?>
<div class="content-wrapper">
      <div class="container-fluid">
      
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="header.php">Home</a>
        </li>
        <li class="breadcrumb-item active">Change Password</li>
      </ol>
     
      </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
				<table>
					<tr>
						<td>
							<form class="form-horizontal" method = "post" enctype="multipart/form-data" action = "<?php $_PHP_SELF ?>">
							<div class="form-group">
							<label class="control-label col-md-3">Old Password</label>

							<div class="col-md-8">
							  <input type="password" name="txt_old_pass"  class="form-control">
							</div>
							<div align="center">
								<?php
								if($error_txt_old_pass==1)
								{
									echo "<font color='red'>Enter the Old Password</font>";
								}
								else if($old_wrong==1)
								{
									echo "<font color='red'>Old Password is wrong</font>";
								}
								?>
							</div>
						  </div>
							<div class="form-group">
							<label class="control-label col-md-3">New Password</label>

							<div class="col-md-8">
							  <input type="password" name="txt_new_pass"  class="form-control">
							</div>
							<div align="center">
								<?php
								if($error_txt_new_pass==1)
								{
									echo "<font color='red'>Enter the New Password</font>";
								}
								?>
							</div>
						  </div>
						  <div class="form-group">
							<label class="control-label col-md-3">Re-Type Password</label>

							<div class="col-md-8">
							  <input type="password" name="txt_repass"  class="form-control">
							</div><br><br><br>
							<div align="center">
								<?php
								if($error_txt_repass==1)
								{
									echo "<font color='red'>Enter the Re-Type Password";
								}
								else if($not_match==1)
								{
									echo "<font color='red'>Password Does not match</font>";
								
								}
								?>
							</div>
						  </div>
						</td>
						
					</tr>
					<tr>
						<td colspan="2">
						<div class="row">
							<div class="col-md-8 col-md-offset-3">
								<center><button type="submit" name="btn_submit" class="btn btn-primary icon-btn"><i class="fa fa-fw fa-lg fa-check-circle"></i>Change</button>&nbsp;&nbsp;&nbsp;<a href="dashboard.php" class="btn btn-default icon-btn"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
							</div><br><br>
							<div align="center">
							<?php
						if($success==1)
						{
							echo "<font color='green'><h2>Password changed</h2></font>";
						}
						?>
						</div>
						</div>
						</td>
						</form>
					</tr>
				</table>
              </div><br><br>
              
            </div>
                
    </div>
	 <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/essential-plugins.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/pace.min.js"></script>
    <script src="js/main.js"></script>

</body>
</html>