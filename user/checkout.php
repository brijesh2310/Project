<?php
    ob_start();
    //session_start();
    include('header.php');
    include("database.php");
?>
    <div class="container"></div>
<?php
@$mymail=$_SESSION['email']; 

// addt cart code 
if(!isset($_SESSION['email']))
{
//  echo "<script>alert('Please Login');document.location='login.php'</script>";
}
?>

<?php 
$sel="select * from payment where email='".$_SESSION["email"]."'";
$res=mysqli_query($conn,$sel); 
$fetres=mysqli_fetch_object($res); 
@$pname2=$fetres->product_name; 


if(isset($_POST['submit']))
{
    $_SESSION['uid']=$oid=uniqid();
    $_SESSION['unm']=$name=$_POST['name'];
    $email=$_POST['email'];
    $number=$_POST['mobile'];
    $addressbill=$_POST['billing'];
    $addressship=$_POST['shipping'];
    $city=$_POST['city'];
    $state=$_POST['state'];
    $pincode=$_POST['pincode'];
    $payment=$_POST['car'];
    $card=$_POST['card'];
    $date=$_POST['expiry'];
    $fndate=date("Y-m-d");
    $delivery_date=date("Y-m-d",strtotime("+5 days")); 
    
    if(isset($_SESSION['cart_item']))
    {
        $count=0;
        $i=1;
        $product= array();
        $pr=array();
        $priceofprod=array();
        foreach($_SESSION['cart_item'] as $key)
        {
        $p=$key['price'];
            $result=$key['price']*$key['quantity'];
            $product[$count]=$key['name'];
            $count++;
            $price[$count]=$key['price'];
            $count++;
        }
        foreach($_SESSION['cart_item'] as $key)
        {
            $pr[$count]=$key['quantity']; 
            $count++;
            $priceofprod[$count]=$key['price']*$key['quantity'];
            $count++;
        }
        foreach($_SESSION['cart_item'] as $key=>$value)
        {
            @$total=$total+$value['price']*$value['quantity']; 
        }
        $_SESSION["totalpr"]=$total;
        $tpr=$_SESSION['totalpr']*(5/100);
        $tpay=$_SESSION['totalpr']+$_SESSION['totalpr']*(5/100); 
    $pri=implode(",",$price);
    $prod=implode(",", $product);
    $qty=implode(",",$pr); 
    $prodp=implode(",",$priceofprod); 

    if($_POST['car'] == 'card')
    {
            $qr=mysqli_query($conn,"INSERT INTO `payment`(`o_id`, `name`, `email`, `mobile_no`, `billing_address`,
            `shipping_address`, `city`, `state`, `pincode`, `payment_method`, `card_no`, `expiry_date`,`product_name`,
            `product_quantity`, `product_price`, `total_price`) VALUES ('$oid','$name','$email','$number','$addressbill',
            '$addressship','$city','$state','$pincode','$payment','$card','$date','$prod',
            '$qty','$pri','$total')");
        
            //echo "<script>alert('thank you for shopping..');document.location='invoice.php?id=$oid'</script>";
    }
    else
    {
            $qr=mysqli_query($conn,"INSERT INTO `payment`(`o_id`, `name`, `email`, `mobile_no`, `billing_address`,
            `shipping_address`, `city`, `state`, `pincode`, `payment_method`,`product_name`,
            `product_quantity`, `product_price`, `total_price`) VALUES ('$oid','$name','$email','$number','$addressbill',
            '$addressship','$city','$state','$pincode','$payment','$prod','$qty','$pri','$total')");
            
    //  echo "<script>alert('thank you for shopping..');document.location='invoice.php?id=$oid'</script>";
    }

if($qr)
{
//echo "<script>alert('hello');</script>"; 

    $i=1;
    require 'PHPMailer/PHPMailerAutoload.php';
    $mail = new PHPMailer;

    //$mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com;smtp.yahoo.com;smtp.rediffmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'fashionparadise150@gmail.com';                 // SMTP username
    $mail->Password = 'Paradise@123.';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom('fashionparadise150@gmail.com', 'Fashion Paradise');
    $mail->addAddress($email);     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo('fashionparadise150@gmail.com', 'Fashion Paradise');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    $mail->addAttachment('');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = 'Order details';
    $mail->Body ='<h1>Fashion Paradise</h1>';
     $mail->Body    = '<html><body>
                <table style="3">
                    <tr><td>Order Id : </td>
                        <td>'.$oid.'</td>
                        <td colspan="5">.</td>
                        <td>Order Date : </td>
                        <td>'.$fndate.'</td>
                    </tr>
                     <tr>
                        <td>User Name:</td>
                        <td>'.$name.'</td>
                        <td colspan="5">.</td>
                        <td>Shipping Address : </td>
                        <td>'.$addressship.'</td>
                    </tr>

                    <tr>
                        <td>Mobile : </td>
                        <td>'.$number.'</td>
                    </tr>
                </table>';
                $mail->Body.='
                    <h1>Product Details.</h1>
                    <table border=3>
                        <thead>
                            <th>Serial No.</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </thead>
                    <tbody>';
                        $i=1;
                        foreach ($_SESSION['cart_item'] as $prod)
                        {     
                            //$sum=0;
                            $result=$prod['price']*$prod['quantity'];

                            $mail->Body .= '<tr>
                            <td>'. $i .'</td>
                            <td style="padding:2px;">'.$prod['name'].'</td>
                            <td style="padding:2px;">'.$prod['quantity'].'</td>
                            <td style="padding:2px;">&#8377;'.$prod['price'].'</td>
                            <td style="padding:2px;">&#8377;'.$result.'</td></tr>';
                           // $sum=$sum+$result;
                            $i++;
                        }
                        $mail->Body .='<tr>
                        <tbody>
                       <td  colspan="3"><b>Order total</b></td>
                        <td colspan="2"><b>'. round($_SESSION['totalpr']) .'</b></td>
                      </tr>
                      <tr>
                        <td  colspan="3"><b>GST 5%</b></td>
                        <td colspan="2"><b>'. round($tpr) .'</b></td>
                      </tr>
                      <tr>
                       <td colspan="3"><b>Total Payable</b></td>
                        <td colspan="2"><b>'. round($tpay) .'</b></td>
                      </tr>
                      </tbody>
                </table>
                </body></html>';

    $mail->Body.='';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
    if(!$mail->send()) 
    {
        //echo '<script>alert("Internet connection is not available");</script>';
    //    echo 'Mailer Error: ' . $mail->ErrorInfo;
    } 
    else 
    {
        echo '<script>alert("Mail Sent");document.location="invoice.php?id="'.$oid.';</script>';
    }
         echo "<script>alert('Order sucessfully');document.location='invoice.php?id=$oid' </script>";
    }
}
else
{

        if(isset($_SESSION['pid']) && isset($_SESSION['qty']))
        {
            $i=1;
            $q=mysqli_query($conn,"SELECT * FROM `product` WHERE `product_id`='".$_SESSION['pid']."'");
            $row=mysqli_fetch_array($q);
            $result=$row['product_price']*$_SESSION['qty'];
            $pname=$row['product_name'];
            $qty=$_SESSION['qty'];
            $price=$row['product_price'];
            if($payment=='card')
            {
            $q1=mysqli_query($conn,"INSERT INTO `payment`(`o_id`, `name`, `email`, `mobile_no`, `billing_address`,
            `shipping_address`, `city`, `state`, `pincode`, `payment_method`, `card_no`, `expiry_date`,`product_name`,
            `product_quantity`, `product_price`, `total_price`) VALUES ('$oid','$name','$email','$number','$addressbill',
            '$addressship','$city','$state','$pincode','$payment','$card','$date','$pname',
            '$qty','$price','$result')");
                
                echo "<script>alert('thank you for shopping..');document.location='invoice.php?id=$oid'</script>";
                
            }
            else
            {
            $q2=mysqli_query($conn,"INSERT INTO `payment`(`o_id`, `name`, `email`, `mobile_no`, `billing_address`,
            `shipping_address`, `city`, `state`, `pincode`, `payment_method`,`product_name`,
            `product_quantity`, `product_price`, `total_price`) VALUES ('$oid','$name','$email','$number','$addressbill',
            '$addressship','$city','$state','$pincode','$payment','$pname','$qty','$price','$result')");
            
            echo "<script>alert('thank you for shopping..');document.location='invoice.php?id=$oid'</script>";
            }
            include 'PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    //$mail->SMTPDebug = 4;                                 // Enable verbose debug output
    $mail->isSMTP();  
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
        );                                    // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'fashionparadise150@gmail.com';                 // SMTP username
    $mail->Password = 'Paradise@123.';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('fashionparadise150@gmail.com', 'Mailer');
    $mail->addAddress($email);     // Add a recipient
  

   echo '<pre>';

    print_r($_SESSION['email']);

    echo '</pre>';
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Order Details';
    
    $mail->Body ='<h1>Fashion Paradise</h1>';
    $mail->Body    .= '
                       <table border=3>
                       
                            
                            <tr>        
                            <th>Serial No</th>
                            <td>'.$i.'</td>
                            </tr>
                            
                            <tr>
                            <th>Name</th>
                            <td>'.$pname.'</td>
                            </tr>
                            
                            <tr>
                            <th>Quantity</th>
                            <td>'. $qty.'</td>
                            
                            </tr>
                            
                            <tr>
                            <th>Price</th>
                            <td>'. $price.'</td>
                            </tr>
                            
                            <tr>
                            <th>Total price</th>
                            <td>'.$result.'</td>
                            </tr>
                                <thead>
                                <tbody>';
                                
                                
                                                                                                
                                    
                                
    
    
                    
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
        }
}
}

if(isset($_SESSION['email']))
{
    $result=mysqli_query($conn,"SELECT * FROM `registration` WHERE `email`='".$_SESSION['email']."'");
    $row=mysqli_fetch_array($result);
}
?>
<script>
$(document).ready(function(){
    $("#card").hide();
    $("#cash").click(function(){ /^5[1-5][0-9]{14}$|^2(?:2(?:2[1-9]|[3-9][0-9])|[3-6][0-9][0-9]|7(?:[01][0-9]|20))[0-9]{12}$/
        $("#card").hide();
    });
    $("#crd").click(function(){
        $("#card").show();
        $("#crno").val('');
        $("#date").val('');
        $("#cvv").val('');
    });


});
</script>


<div class="row" style="background-color:#F3F3F3;">
<div class="col-sm-6 col-sm-offset-3">
<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <legend class="text-danger col-sm-offset-1"></legend>
        <div class="form-group">
            <label class="control-label col-sm-3">Name:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control"  name="name"  value="<?php echo $row['name']; ?>"/>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-3">Email:</label>
            <div class="col-sm-9">
                <input type="email" class="form-control"  name="email" value="<?php echo $row['email']; ?>"
                            readonly="readonly"/>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">Mobile no:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control"  name="mobile" value="<?php echo $row['mobile']; ?>"/>
            </div>
        </div>        
       
        <div class="form-group">
            <label class="control-label col-sm-3">Billing Address:</label>
            <div class="col-sm-9">
                <textarea class="form-control" rows="3" name="billing" required></textarea>
            </div>
        </div>
        
         <div class="form-group">
            <label class="control-label col-sm-3">Shipping Address:</label>
            <div class="col-sm-9">
                <textarea class="form-control" rows="3" name="shipping" required></textarea>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-3">City:</label>
            <div class="col-sm-9">
                <select name ="city" class="form-control">
                            <?php

                                 $conn = mysqli_connect("localhost","root","","shopping");
                                  $q = "select * from city";
                                  $result = mysqli_query($conn,$q);
                                 while($row = mysqli_fetch_array($result))
                                 {
                              ?>

                            <option value="<?php echo $row['1']; ?>"><?php echo $row['1']; ?></option>
                            <?php
                            }

                            ?>
      
                            </select>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-3">State:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control"  name="state"/>
            </div>
        </div>
        
          <div class="form-group">
            <label class="control-label col-sm-3">Pincode:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control"  min="5" max="6"  name="pincode"/ required>
            </div>
        </div>
        
         <div class="form-group">
            <label class="control-label col-sm-3">Payment method:</label>
            <div class="col-sm-9 radio radio-inline">
               <label class="col-sm-3 col-sm-offset-3"><input type="radio" name="car" id="crd" value="card"/>Card</label> 
               <label class="col-sm-6"><input type="radio" name="car" id="cash"  value="cash"/>Cash on delivery</label>
           <br /><br />
        <span id="card" style="background-color:#060;">
        <div class="form-group">
            <label class="control-label col-sm-3">Card No:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control"  name="card" id="crno"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3">Expiry Date:</label>
            <div class="col-sm-5">
                <input type="date" class="form-control"  name="expiry" id="date"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3">Cvv:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control"  name="cvv" id="cvv"/>
            </div>
        </div>
        </span>
        </div>
        </div> <div class="form-group">            
             <div class="col-sm-offset-3 col-sm-9">
                <input type="submit" class="btn btn-success" name="submit"  value="submit"/>
             </div>
         </div>  
        
    <div class="col-sm-1"></div>

    <div id="paypal-button-container"></div>
             </div>
         </div>  
        
    <div class="col-sm-1"></div>

    
<div id="smart-button-container">
      <div style="text-align: center;">
      </div>
    </div>
  <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
  <script>
    function initPayPalButton() {
      paypal.Buttons({
        style: {
          shape: 'rect',
          color: 'blue',
          layout: 'vertical',
          label: 'buynow',
          
        },

        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{"description":"Nike runners","amount":{"currency_code":"USD","value":599}}]
          });
        },

        onApprove: function(data, actions) {
          return actions.order.capture().then(function(orderData) {
            
            // Full available details
            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

            // Show a success message within this page, e.g.
            const element = document.getElementById('paypal-button-container');
            element.innerHTML = '';
            element.innerHTML = '<h3>Thank you for your payment!</h3>';

            // Or go to another URL:  actions.redirect('thank_you.html');
            
          });
        },

        onError: function(err) {
          console.log(err);
        }
      }).render('#paypal-button-container');
    }
    initPayPalButton();
   
   

  </script>

<script type="text/JavaScript">
    function validation() {

        var mobile_number = document.getElementById('mobile_number').value;
        var state = document.getElementById('state').value;
        var postal_code = document.getElementById('postal_code').value;
        var corr =/^[A-Za-z]+$/;
       



        if ( mobile_number == "")
      {
           document.getElementById('mnumber').innerHTML ="Fill mobile number";
           return false;
      }
      
      if (isNaN(mobile_number))
      {
           document.getElementById('mnumber').innerHTML ="Please Enter only digits";
           return false;
      }

      if ((mobile_number.charAt(0)!=9) && (mobile_number.charAt(0)!=8) && (mobile_number.charAt(0)!=7) && (mobile_number.charAt(0)!=6))
      {
           document.getElementById('mnumber').innerHTML ="wrong  mobile number";
           return false;
      }
           
      if (mobile_number.length!=10)
      {
           document.getElementById('mnumber').innerHTML ="Enter Valid Number";
           return false;
      }
             
      if (state == "")
      {
           document.getElementById('s').innerHTML ="Please Enter state";
           return false;
      }

      if (state.match(corr))
           true;
           else
           {
             document.getElementById('s').innerHTML ="Only Alphabates Allowed";
           return false;
           }
          
      if (state.length<=3)
      {
           document.getElementById('s').innerHTML ="state name length is too short";
           return false;
      }

      if (state.length>=15)
      {
           document.getElementById('s').innerHTML ="state name length is too long";
           return false;
      }
      if (!isNaN(state))
      {
           document.getElementById('s').innerHTML ="Number can not be a name";
           return false;
      }


 
    
      if (postal_code == "")
      {
           document.getElementById('pin').innerHTML ="Enter postal code ";
           return false;
      }
      if (isNaN(postal_code))
      {
           document.getElementById('pin').innerHTML ="Invalid postal code";
           return false;
      }
           
      if (postal_code.length!=6)
      {
           document.getElementById('pin').innerHTML ="enter valid postal code";
           return false;
      }
    

      
    }
</script>


</div>
</div>  
<?php include('footer.php'); ?>