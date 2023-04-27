<?php 

		$conn = mysqli_connect("localhost","root","","shopping");
		
		if(isset($_POST['d']))
		{

			$data = $_POST['d'];
			
			$q = "select * from product where product_name like '%".$data."%' OR
			product_price like '%".$data."%' ";

			$exe = mysqli_query($conn,$q);
			echo '<table border=3>';
			while($row = mysqli_fetch_assoc($exe))
			{
				?>
					<tr><td><?php echo $row['product_name']; ?></td><td><?php echo $row['product_price']; ?></td></tr>


				<?php
			}

			echo '</table>';
		}


		

?>
