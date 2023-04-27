<?php

$con=mysqli_connect("localhost","root","","shopping");

if(isset($_POST['submit']))
{
	$name=$_POST['name'];
	$email=$_POST['email'];
	$telephone=$_POST['telephone'];
	$message=$_POST['message'];


	mysqli_query($con,"insert into mail(name,email,telephone,message)values('$name','$email','$telephone','$message')");

	require 'PHPMailer/PHPMailerAutoload.php';
	
	$mail = new PHPMailer;
	$mail->isSMTP();   
	$mail->SMTPOptions = array(
		'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
		)
		);                               
	$mail->Host = 'smtp.gmail.com'; 
	$mail->SMTPAuth = true;                              
	$mail->Username = 'fashionparadise150@gmail.com';               
	$mail->Password = 'Paradise@123.';                        
	$mail->SMTPSecure = 'tls';                           
	$mail->Port = 587;                                    
	$mail->setFrom('');
	$mail->addAddress('fashionparadise150@gmail.com');    
	/*$mail->addReplyTo('sagar20.su@gmail.com');*/
	$mail->isHTML(true);                                 
	$mail->Subject = 'Complain Messagesss';
	$mail->Body    = "
	<table>
	<tr>

<th>Name :</th>
<td>".$name."</td>
</tr>
<tr>
<th>Email :</th>
<td>".$email."</td>
</tr>
<tr>
<th>telephone :</th>
<td>".$telephone."</td>
</tr>
<tr>
<th>Message :</th>
<td>".$message."</td>
</tr>
	
		</table>";  
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	
	if(!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		echo "<script>alert('Mail has been sent.');document.location='index.php'</script>";
	}
	}

?>