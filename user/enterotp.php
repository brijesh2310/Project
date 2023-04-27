<?php
        include('dbcon.php');
        session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>FashionParadise</title>
<link rel="shortcut icon" type="image/png" href="images/bus.png">
<link href='https://fonts.googleapis.com/css?family=Noto+Sans:400,700' rel='stylesheet' type='text/css'>
<link href="https://cdn.phpoll.com/css/main.min.css?v=3.0.3" rel="stylesheet">
</head>
<body class="themed-body">

<div class="container">
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3"></div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3">
            <div class="alert-placeholder"></div>
            <div class="panel panel-success">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center"><h2><b>OTP Prompt</b></h2></div>
                            <form id="register-form" method="post" role="form" autocomplete="off">
                                <div class="form-group">
                                    <label for="email">Enter OTP</label>
                                    <input type="text" name="otp" id="email" tabindex="1" class="form-control" placeholder="Enter OTP Here" value="" autocomplete="off" required />
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                                            <input type="submit" name="submitotp" id="recover-submit" tabindex="2" class="form-control btn btn-success" value="Submit OTP" />
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" class="hide" name="token" id="token" value="47d41878de1dc06d644097d21b9066a4">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="text-center" style="margin-top:25px;">
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

                <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-3482214419652965" data-ad-slot="8758161539" data-ad-format="auto"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.phpoll.com/js/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
</body>
</html>
<?php

    if(isset($_POST['submitotp']))
    {
        $otp = $_POST['otp'];
        
        $email = $_SESSION['email_otp'];
        
        $q = "select * from otp_expiry where email = '$email' and otp = '$otp'";

        $re = mysqli_query($db,$q);
        if(mysqli_num_rows($re) == 1)
        {
            echo '<script>alert("Otp Matched Successfully..");</script>';
            echo '<script>window.location = "updatepass.php";</script>';
        }
        else{
            echo '<script>alert("Invalid OTP..");</script>';
        }

    }
?>
