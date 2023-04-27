<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>HANDICRAFT</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  
 <!--   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 -->
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="dashboard.php">HANDICRAFT</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="dashboard.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-sitemap"></i>
            <span class="nav-link-text">Category</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseMulti">
            <li>
              <a href="addcategory.php">Add-Category</a>
            </li>
            <li>
              <a href="viewcategory.php">Manage Category</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti1" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-sitemap"></i>
            <span class="nav-link-text">Sub Category</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseMulti1">
            <li>
              <a href="addsubcategory.php">Add sub Categorys</a>
            </li>
            <li>
              <a href="viewsubcategory.php">Manage sub Category</a>
            </li>
          </ul>
        </li>
  
   <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-shopping-basket"></i>
            <span class="nav-link-text">Product</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
              <a href="addproduct.php">Add Product</a>
            </li>
            <li>
              <a href="viewproduct.php">Manage Product</a>
            </li>
          </ul>
     </li>
        
       <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example1">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExample1" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">City</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExample1">
            <li>
              <a  href="city.php">Add City</a>
            </li>
            <li>
              <a href="viewcity.php">Manage City</a>
            </li>
          </ul>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example2">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExample2" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">Area</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExample2">
            <li>
              <a  href="area.php">Add Area</a>
            </li>
            <li>
              <a href="viewarea.php"> Area </a>
            </li>
          </ul>
        </li>

        

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example2">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExample3" data-parent="#exampleAccordion">
            <i class="fa fa-phone"></i>
            <span class="nav-link-text">Contact</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExample3">
            <li>
              <a  href="managequery.php">Manage Query</a>
            </li>
          </ul>
        </li>

  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">Account</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePages">
            <li>
              <a href="admin.php">Registration </a>
            </li>
            <li>
              <a href="changepass.php">Change Password </a>
            </li>
            
          </ul>
        </li>

</ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2"  href="maildisplay.php" >
            <i class="fa fa-fw fa-envelope"></i>
            <span class="d-lg-none">Messages
              <span class="badge badge-pill badge-primary"></span>
            </span>
            <span class="indicator text-warning d-none d-lg-block">
              <?php
                $conn=mysqli_connect("localhost","root","","shopping")or die("database not connected");
                $query = mysqli_query($conn, "SELECT * FROM mail");
                $row = mysqli_num_rows($query);
                ?>
              <i class="fa fa-fw fa-circle"><?php echo $row; ?></i>
            </span>
          </a>    
        </li>
        
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  
<?php

	include('footer.php');

?>