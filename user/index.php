<?php
	include("header.php");
	include("dbcon.php");
?>

<!--header-->
		<!--banner-->
		<div class="banner-w3">
			<div class="demo-1">            
				<div id="example1" class="core-slider core-slider__carousel example_1">
					<div class="core-slider_viewport">
						<div class="core-slider_list">
							
								<?php 
								$query = "SELECT * FROM banner";
								$result = mysqli_query($db, $query);
								$num=mysqli_num_rows($result);
								if($num > 0)
								{
									while($row = mysqli_fetch_array($result))
									{
										?>
										<div class="core-slider_item">
								 <img src="image/<?php echo $row['img']?>" class="img-responsive" alt="">
							 </div>
										<?php
								}
							}
								?>
							
							 
						 </div>
					</div>
					<div class="core-slider_nav">
						<div class="core-slider_arrow core-slider_arrow__right"><span style="font-size: 25px;color: white;padding-top: 7px" class="glyphicon glyphicon-chevron-right"></span></div>
						<div class="core-slider_arrow core-slider_arrow__left"><span style="font-size: 25px;color: white;padding-top: 7px" class="glyphicon glyphicon-chevron-left"></span></div>
					</div>
					<div class="core-slider_control-nav"></div>
				</div>
			</div>
			<link href="css/coreSlider.css" rel="stylesheet" type="text/css">
			<script src="js/coreSlider.js"></script>
			<script>
			$('#example1').coreSlider({
			  pauseOnHover: false,
			  interval: 3000,
			  controlNavEnabled: true
			});

			</script>
	</div>

       
    

	<div class="content">
			<!--banner-bottom-->
				<div class="ban-bottom-w3l">
					<div class="container">
						<div class="col-md-6 ban-bottom">
							<div class="ban-top">
								<img src="image/b23.jpg" class="img-responsive" alt=""/>
								<a href="women.php?sub=Batwa"><div class="ban-text">
									<h4>Women Batwas</h4>
								</div></a>
								
							</div>
						</div>
						<div class="col-md-6 ban-bottom3">
							<div class="ban-top">
								<img src="image/c2.jpeg" class="img-responsive" alt=""/>
								<a href="women.php?sub=Clutch"><div class="ban-text1">
									<h4>Clutch's </h4>
								</div></a>
							</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
			</div>

				<div class="col-sm-1"></div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<br>



<?php
	include("footer.php");
?>