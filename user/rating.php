<!DOCTYPE html>
<html>
<head>
  <title>Fashion Paradise</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- font awesome -->
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">
  <!-- rating star css -->
    <link rel="stylesheet" href="js/ratingstar.css">    
</head>
<body class="container">
<div class="row">
<div class="col-md-12">
  <div class="form-group">
    <div class="form-group has-success has-feedback">
        <label for="name">Customer Name :</label>
        <input type="text" class="form-control" id="name">        
      </div>
      <div class="form-group has-success has-feedback">
        <label for="email">Customer Email :</label>
        <input type="email" class="form-control" id="email">        
      </div>   
      <label for="email">Customer Rating :</label>     
      <div class='starrr' id='rating-customer'></div><br>
      <input type="button" id="submit" class="btn btn-success" value="Register Customer">
      <div class="msg"></div>
  </div>  
</div>

<hr>
<!-- show the student -->
<h2>Customer Details</h2>
<table class="table table-condensed">
  <thead>
    <tr>
      <th>Customer Name</th>
      <th>Customer Email</th>
      <th>Rating</th>
    </tr>
  </thead>
  <tbody>
  <?php 
    $conn = mysqli_connect('localhost','root','','shopping');
    if($qry = mysqli_query($conn,"SELECT * FROM rating")){
      while($show = mysqli_fetch_assoc($qry)){
        echo "<tr>";
          echo "<td>".$show['name']."</td>";          
          echo "<td>".$show['email']."</td>";         
          if($show['rate']==1){ echo "<td><i class='fa fa-star'></i></td>"; }
          if($show['rate']==2){ echo "<td><i class='fa fa-star'></i><i class='fa fa-star'></i></td>"; }
          if($show['rate']==3){ echo "<td><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i></td>"; }
          if($show['rate']==4){ echo "<td><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i></td>"; }
          if($show['rate']==5){ echo "<td><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i></td>"; }
        echo "</tr>";
      }
    }
  ?>
  </tbody>
</table>
  
</div>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- star js -->
<script src="js/ratingstar.js"></script>
<!-- ajax -->
<script>
// rating
var rate;
$('#rating-customer').starrr({
  change: function(e, value){ 
    rate = value;          
    if (value) {
      $('.your-choice-was').show();      
    } else {
      $('.your-choice-was').hide();
    }
  }
});
// ajax submit
$("#submit").click(function(){  
  var name = $('#name').val();
  var email = $('#email').val();

  $.ajax({    
        url: "rate.php",
        type: 'post',
        data: {v1 : name, v2 : email, v3 : rate},
        success: function (status) {
          if(status == 1){
              $('.msg').html('<b>Customer Inserted !</b>');
          }else{
              $('.msg').html('<b>Server side error !</b>');           
          }
        }
    });

});
</script>
</body>
</html>