<?php
 include("header.php");	
?>



<!DOCTYPE HTML>
<html>
<body>
	<!--header-->
		<!--banner-->
		<div class="banner1">
			<div class="container">
				<h3><a href="index.php">Home</a> / <span>Contact Us</span></h3>
			</div>
		</div>
	<!--banner-->
		<!--content-->
			<div class="content">
				<!--contact-->
					<div class="mail-w3ls">
						<div class="container">
							<h2 class="tittle">Contact Us</h2>
							<div class="mail-grids">
								<div class="mail-top">
									<div class="col-md-4 mail-grid">
										<i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>
										<h5>Address</h5>
										<p>Shree Hingdaj Handicraft - doshivadi ni poal,opp hemma kangans,tangshal,relif road,kalupur,Ahmedabad</p>
									</div>
									<div class="col-md-4 mail-grid">
										<i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>
										<h5>Phone</h5>
										<p>+91 6353131232</p>
									</div>
									<div class="col-md-4 mail-grid">
										<i class="glyphicon glyphicon-envelope" aria-hidden="true"></i>
										<h5>E-mail</h5>
										<p>E-mail:<a href="mailto:example@mail.com">darshirtmadhu16@gmail.com</a></p>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="map-w3">
								<iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d117502.60587762648!2d72.52087451343834!3d23.025371789388945!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x395e853fc266d52f%3A0xc68654db68fc4b59!2sDoshiwala%20pol%20nake%2C%20Tankshal%20Rd%2C%20opp.%20jj%20bhavsar%2C%20Kalupur%2C%20Ahmedabad%2C%20Gujarat%20380001!3m2!1d23.025342!2d72.59094089999999!5e0!3m2!1sen!2sin!4v1681837785041!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
								</div>
								<!-- <div class="mail-bottom">
									<h4>Get In Touch With Us</h4>
									<form method="post">
					 				<input type="text" name="name" value="Your name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Your name';}">
									 <input type="text" name="email"  value="Your email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Your email';}">
									 <input type="text" name="telephone"  value="Telephone" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Telephone';}">
									 <textarea value="Message:" name="message" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message';}">Message</textarea>
					 				<input type="submit" name="submit" value="Send">
					 				<input type="reset" value="Clear" >

									</form>
								</div> -->
								<div>
   					<div class="contact_right">
   				<div class="mail-bottom">
				   <form method="post" action="mailcon.php">
					 <input type="text" name="name" class="textbox" value="Your name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Your name';}">
					 <input type="text" name="email" class="textbox" value="Your email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Your email';}">
					 <input type="text" name="telephone" class="textbox" value="telephone" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'telephone';}">
					 <textarea value="Message:" name="message" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message';}">Message</textarea>
					 <input type="submit" name="submit" value="Send">
					 <input type="reset" value="Clear" >
				   </form>
			      </div>
   			     </div>
   				</div>
   			</div>
							</div>
						</div>
					</div>
				<!--contact-->
			</div>
		<!--content-->
		<?php include("footer.php"); ?>
</body>
</html>