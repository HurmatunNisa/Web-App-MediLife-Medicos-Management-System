<?php
  require "db_connection.php";
  if($con) {
    $name = ucwords($_GET["name"]);
    $packing = strtoupper($_GET["packing"]);
    $generic_name = ucwords($_GET["generic_name"]);
    $product_type = $_GET["product_type"];
    $product_strength = $_GET["product_strength"];
    $price = $_GET["price"];

    $query = "SELECT * FROM medicines WHERE UPPER(NAME) = '".strtoupper($name)."'
     AND UPPER(PACKING) = '".strtoupper($packing)."' 
     AND UPPER(PRODUCT_TYPE) = '".strtoupper($product_type)."'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    if($row)
      echo "Medicine $name with $packing already exists by type $product_type!";
    else {
      $query = "INSERT INTO medicines (NAME, PACKING, GENERIC_NAME, PRODUCT_TYPE, STRENGTH, PRICE)
       VALUES('$name', '$packing', '$generic_name', '$product_type', '$product_strength', '$price')";
      $result = mysqli_query($con, $query);
      if(!empty($result))
  			echo "$name added...";
  		else
  			echo "Failed to add $name!";
    }
  }
?>
