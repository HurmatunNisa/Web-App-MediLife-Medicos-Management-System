<?php
  require "db_connection.php";
  if($con) {
    $name = ucwords($_GET["name"]);
    $id = ucwords($_GET["id"]);
    $exp_date = strtoupper($_GET["exp_date"]);
    $quantity = strtoupper($_GET["quantity"]);
    $batch_id = strtoupper($_GET["batch_id"]);
    $mrp = ucwords($_GET["mrp"]);
    $rate = ucwords($_GET["rate"]);
    $min_stock = ucwords($_GET["min_stock"]);
    $max_stock = ucwords($_GET["max_stock"]);
    $stock_in_date = ucwords($_GET["stock_in_date"]);
    // $stock_out_date = ucwords($_GET["stock_out_date"]);
    $suppliers_name = $_GET["suppliers_name"];

    $query = "SELECT * FROM medicines_stock WHERE UPPER(NAME) = '".strtoupper($name)."'
     AND UPPER(EXPIRY_DATE) = '".strtoupper($exp_date)."' 
     AND UPPER(BATCH_ID) = '".strtoupper($batch_id)."'
     AND UPPER(QUANTITY) = '".strtoupper($quantity)."'  
     AND UPPER(MRP) = '".strtoupper($mrp)."'  
     AND UPPER(RATE) = '".strtoupper($rate)."'  
     AND UPPER(MIN_STOCK_LVL) = '".strtoupper($min_stock)."'  
     AND UPPER(Max_STOCK_LVL) = '".strtoupper($max_stock)."' 
     AND UPPER(STOCK_IN_DATE) = '".strtoupper($stock_in_date)."'  
      AND UPPER(SUPPLIER_NAME) = '".strtoupper($suppliers_name)."'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    if($row)
      echo "Medicine $name with $max_stock quantity already exists by supplier $suppliers_name!";
    else {
      $query = "INSERT INTO medicines_stock (NAME, PRODUCT_ID, EXPIRY_DATE ,BATCH_ID,QUANTITY,MRP, RATE,MIN_STOCK_LVL,
      Max_STOCK_LVL, STOCK_IN_DATE,SUPPLIER_NAME) VALUES('$name','$id', '$exp_date','$batch_id', '$quantity','$mrp','$rate',
      '$min_stock','$max_stock','$stock_in_date' , '$suppliers_name')";
      $result = mysqli_query($con, $query);
      if(!empty($result))
  			echo "$name added...";
  		else
  			echo "Failed to add $name!";
    }
  }
?>
