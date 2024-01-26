<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add New Sock</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/suggestions.js"></script>
    <script src="js/validateForm.js"></script>
    <script type="text/javascript" src="js/add_new_purchase.js"></script>
    <script src="js/restrict.js"></script>
  </head>
  <body>
  <?php include("sessionforsidenav.php"); ?>
  <div id="add_new_medicine_model">
      <div class="modal-dialog">
      	<div class="modal-content">
      		<div class="modal-header" style="background-color: #ff5252; color: white">
            <div class="font-weight-bold">Add New Produt</div>
      			<button class="close" style="outline: none;" onclick="document.getElementById('add_new_medicine_model').style.display = 'none';"><i class="fa fa-close"></i></button>
      		</div>
      		<div class="modal-body" style="max-height: 510px; overflow-y: auto;">
            <?php
              include('sections/add_new_medicine.html');
            ?>
      		</div>
      	</div>
      </div>
    </div>
    <!-- including side navigations -->
    

    <div class="container-fluid">
      <div class="container">

        <!-- header section -->
        <?php
          require "php/header.php";
          createHeader('cubes', 'Add Stock', 'Add New Stock');
        ?>
        <!-- header section end -->

        <!-- form content -->
        <div class="row">
          <div class="row col col-md-6">
            <?php
              // form content
              require "sections/add_new_stock.html";
            ?>
          </div>
        </div>

        <hr style="border-top: 2px solid #ff5252;">
        <!-- form content end -->
      </div>
    </div>
  </body>
</html>
