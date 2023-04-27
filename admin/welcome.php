<?php
	include "database.php";	
	if(isset($_GET['did']))
	{
		$id=$_GET['did'];
		$delete="delete from registration where id='".$id."'";
		mysqli_query($conn,$delete);
		?>
		<script>
			window.location="welcome.php";
		</script>
		<?php
	}
	include "header.php";
?>
<div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1>Admin</h1>
            <ul class="breadcrumb side">
              <li><i class="fa fa-home fa-lg"></i></li>
              <li>Dasboard</li>
             </ul>
          </div>
		   
        </div>
        <div class="row" style="height:200px;">
          <div class="col-md-12" style="height:200px;">
            
			<div class="col-sm-6" style="height:200px;font-size:40px;background-color:white;width:300px;padding-top:20px;margin:100px;">
			
			<a href="" ><center>User<center></a> <span class="badge" style="font-size:30px;">
			<?php 
			$r=mysqli_query($conn,"SELECT * FROM registration");
			$num_rows=mysqli_num_rows($r);
			echo "$num_rows \n";
					
			?></span>
			</div> 
			<div class="col-sm-6" style="height:200px;font-size:40px;background-color:white;width:300px;margin-left:15px;padding-top:20px;margin:100px;">
			<a href="#"><center>Total order<center></a> <span class="badge" style="font-size:30px;">
			<?php 
			$res=mysqli_query($conn,"SELECT * FROM payment");
			$num_rows=mysqli_num_rows($res);
			echo "$num_rows \n";
					
			?>
			</span>
		              
            </div>
          </div>
        </div>
      </div>

    <!-- Javascripts-->
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/essential-plugins.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/pace.min.js"></script>
    <script src="js/main.js"></script>
    <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
	</body>
</html>