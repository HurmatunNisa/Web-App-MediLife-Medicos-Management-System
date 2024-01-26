<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

  if(isset($_GET['action']) && $_GET['action'] == "add_row")
    createMedicineInfoRow();

  if(isset($_GET['action']) && $_GET['action'] == "is_supplier")
    isSupplier(strtoupper($_GET['name']), $_GET['contact_number']); 

  if(isset($_GET['action']) && $_GET['action'] == "is_invoice")
    isInvoiceExist(strtoupper($_GET['invoice_number']));

  if(isset($_GET['action']) && $_GET['action'] == "current_invoice_number")
    getInvoiceNumber();

  if(isset($_GET['action']) && $_GET['action'] == "is_new_medicine")
    isNewMedicine(strtoupper($_GET['name']), strtoupper($_GET['packing']));

  if(isset($_GET['action']) && $_GET['action'] == "add_stock")
    addStock();

  if(isset($_GET['action']) && $_GET['action'] == "add_new_purchase")
    addNewPurchase();

  if(isset($_GET['action']) && $_GET['action'] == "medicine_list")
    showMedicineList(strtoupper($_GET['text']));

  if(isset($_GET['action']) && $_GET['action'] == "fill")
    fill(strtoupper($_GET['name']), $_GET['column']);

  if(isset($_GET['action']) && $_GET['action'] == "is_medicine")
    isMedicine(strtoupper($_GET['name']));

  function showMedicineList($text) {
    require 'db_connection.php';
    if($con) {
      if($text == "")
        $query = "SELECT * FROM medicines_stock";
      else
        $query = "SELECT * FROM medicines_stock WHERE UPPER(NAME) LIKE '%$text%'";
      $result = mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result))
        echo '<option value="'.$row['NAME'].'">'.$row['NAME'].'</option>';
    }
  }

  function fill($name, $column) {
    require 'db_connection.php';
    if($con) {
      $query = "SELECT * FROM medicines_stock WHERE UPPER(NAME) = '$name'";
      $result = mysqli_query($con, $query);
      if(mysqli_num_rows($result) != 0) {
        $row = mysqli_fetch_array($result);
        echo $row[$column];
      }
    }
  }

  function isMedicine($name) {
    require "db_connection.php";
    if($con) {
      $query = "SELECT * FROM medicines_stock WHERE UPPER(NAME) = '$name'";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      echo ($row) ? "true" : "false";
    }
  }

  function isSupplier($name) {
    require "db_connection.php";
    if($con) {
      $query = "SELECT * FROM suppliers WHERE UPPER(NAME) = '$name'";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      echo ($row) ? "true" : "false";
    }
  }

  function getInvoiceNumber() {
    require 'db_connection.php';
    if($con) {
      $query = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'pharmacy' AND TABLE_NAME = 'purchases';";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      echo $row['AUTO_INCREMENT'];
    }
  }

  function isInvoiceExist($invoice_number) {
    require "db_connection.php";
    if($con) {
      $query = "SELECT * FROM purchases WHERE INVOICE_NUMBER = $invoice_number";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      echo ($row) ? "true" : "false";
    }
  }

  function isNewMedicine($name, $batch_id) {
    require "db_connection.php";
    if($con) {
      $query = "SELECT * FROM medicines_stock WHERE UPPER(NAME) = '$name' AND UPPER(BATCH_ID) = '$batch_id'";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      echo ($row) ? "false" : "true";
    }
  }

  function addStock() {
    echo"Hey";
    require "db_connection.php";
    $name = ucwords($_GET['name']);
    $expiry_date = $_GET['expiry_date'];
    $batch_id = strtoupper($_GET['batch_id']);
    $quantity = $_GET['quantity'];
    $mrp = $_GET['mrp'];
    $rate = $_GET['rate'];
    $invoice_date = $_GET['invoice_date'];
    $suppliers_name = ucwords($_GET['suppliers_name']);
    $min = $_GET['min'];
    $max = $_GET['max'];
    $product_id = $_GET['product_id'];
    echo"Hey";

    //$invoice_number = $_GET['invoice_number'];
    if($con) {
       $query = "SELECT * FROM medicines_stock WHERE UPPER(NAME) = '".strtoupper($name)."' 
       AND UPPER(BATCH_ID) = '$batch_id' ";
       $result = mysqli_query($con, $query);
       $row = mysqli_fetch_array($result);
       if($row) {
         $new_quantity = $row['QUANTITY'] + $quantity;
         $query = "UPDATE medicines_stock SET QUANTITY = '$new_quantity' WHERE UPPER(NAME) = '".strtoupper($name)."' AND UPPER(BATCH_ID) = '$batch_id'";
         $result = mysqli_query($con, $query);
       }
      else {
        $query = "INSERT INTO medicines_stock (PRODUCT_ID, NAME, EXPIRY_DATE, BATCH_ID, QUANTITY, MRP, RATE, MIN_STOCK_LVL, MAX_STOCK_LVL, STOCK_IN_DATE, SUPPLIER_NAME) 
        VALUES('$product_id', '$name', '$expiry_date', '$batch_id', '$quantity', '$mrp', '$rate', 
        '$min', '$max', '$invoice_date', '$suppliers_name')";
        $result = mysqli_query($con, $query);
        if ($result) {
          error_log("Stock added successfully.");
        } else {
          error_log("Failed to add stock: " . mysqli_error($con));
        }
        error_log("Add stock function executed.");
        if($result)
          echo "Hey";
        else
        echo "Failed";
      }
    }
  }

  function addNewPurchase() {
    require "db_connection.php";
    $suppliers_name = $_GET['suppliers_name'];
    $invoice_number = $_GET['invoice_number'];
    $payment_type = $_GET['payment_type'];
    $invoice_date = $_GET['invoice_date'];
    $grand_total = $_GET['grand_total'];
    $payment_status = ($payment_type == "Payment Due") ? "DUE" : "PAID";

    if($con) {
      $query = "INSERT INTO purchases (SUPPLIER_NAME, PURCHASE_DATE, TOTAL_AMOUNT, PAYMENT_STATUS) VALUES('$suppliers_name', '$invoice_date', '$grand_total', '$payment_status')";
      $result = mysqli_query($con, $query);
      if($result)
        echo "Purchase saved...";
      else
        echo "Failed to save purchase!";
    }
  }

  function addNewPurchaseInvoice() {
    require "db_connection.php";
    $suppliers_name = $_GET['suppliers_name'];
    $invoice_number = $_GET['invoice_number'];
    $product_id = $_GET['product_id'];

    if($con) {
      $query = "INSERT INTO purchase_invoice (SUPPLIER_NAME, INVOICE_NUMBER, PRODUCT_ID) VALUES('$suppliers_name', '$invoice_number', '$product_id')";
      $result = mysqli_query($con, $query);
      if($result)
        echo "Purchase Invooice saved...";
      else
        echo "Failed to save purchase invoice!";
    }
  }

  function createMedicineInfoRow() {
      $row_id = $_GET['row_id'];
      $row_number = $_GET['row_number'];
      ?>
      <div class="row col col-md-12">
        <div class="col col-md-2">
          <input id="medicine_name_<?php echo $row_number; ?>" name="medicine_name" class="form-control" list="medicine_list_<?php echo $row_number; ?>" placeholder="Select Medicine" onkeydown="medicineOptions(this.value, 'medicine_list_<?php echo $row_number; ?>');"
           onfocus="medicineOptions(this.value, 'medicine_list_<?php echo $row_number; ?>');" onchange="fillFields(this.value, '<?php echo $row_number; ?>');">
          <code class="text-danger small font-weight-bold float-right" id="medicine_name_error_<?php echo $row_number; ?>" style="display: none;"></code>
          <datalist id="medicine_list_<?php echo $row_number; ?>" style="display: none; max-height: 200px; overflow: auto;">
            <?php showMedicineList("") ?>
          </datalist>
          <!-- <input type="text" class="form-control" placeholder="Medicine Name" 
            name="medicines_name" id="medicines_name" onkeyup="showSuggestions(this.value, 'medicine');">
          <code class="text-danger small font-weight-bold float-right" id="medicines_name_error_<?php echo $row_number; ?>" style="display: none;"></code>
          <div id="medicine_suggestions" class="list-group position-fixed" style="z-index: 1; width: 18.30%; overflow: auto; max-height: 200px;"></div> -->
        </div>
        <div class="col col-md-2">
        <input type="text" class="form-control" id="batch_id_<?php echo $row_number; ?>">
          <code class="text-danger small font-weight-bold float-right" id="batch_id_error_<?php echo $row_number; ?>" style="display: none;"></code>
        </div>
        <div class="col col-md-2">
          <input type="date" class="form-control" name="expiry_date">
          <code class="text-danger small font-weight-bold float-right" id="expiry_date_error_<?php echo $row_number; ?>" style="display: none;"></code>
        </div>
  

        <div class="col col-md-1">
          <input type="number" class="form-control" placeholder="0" id="quantity_<?php echo $row_number; ?>" name="quantity" onkeyup="getAmount(<?php echo $row_number; ?>);">
          <code class="text-danger small font-weight-bold float-right" id="quantity_error_<?php echo $row_number; ?>" style="display: none;"></code>
        </div>
        <div class="col col-md-1">
          <input type="number" class="form-control" name="  ">
          <code class="text-danger small font-weight-bold float-right" id="mrp_error_<?php echo $row_number; ?>" style="display: none;"></code>
        </div>
        <div class="col col-md-1">
          <input type="number" class="form-control" id="rate_<?php echo $row_number; ?>" name="rate" onkeyup="getAmount(<?php echo $row_number; ?>);">
          <code class="text-danger small font-weight-bold float-right" id="rate_error_<?php echo $row_number; ?>" style="display: none;"></code>
        </div>
        <div class="row col col-md-3">
          <div class="col col-md-7"><input type="text" class="form-control" id="amount_<?php echo $row_number; ?>" disabled></div>
          <div class="col col-md-5">
            <button class="btn btn-primary" onclick="addRow();">
              <i class="fa fa-plus"></i>
            </button>
            <button class="btn btn-danger" onclick="removeRow('<?php echo $row_id ?>');">
              <i class="fa fa-trash"></i>
            </button>
          </div>
        </div>
      </div><br>
      <div class="row col col-md-8">
        <div class="col col-md-1"><label for="min_stock" class="font-weight-bold">&nbsp;Min Stock </label></div>
          <div class="col col-md-2">
            <input type="number" class="form-control" name="min_stock">
            <code class="text-danger small font-weight-bold float-right" id="min_error" style="display: none;"></code>
          </div>

          <div class="col col-md-1"><label for="max_stock" class="font-weight-bold">&nbsp;Max Stock </label></div>
          <div class="col col-md-2">
            <input type="number" class="form-control" name="max_stock">
            <code class="text-danger small font-weight-bold float-right" id="max_error" style="display: none;"></code>
          </div>
          <div class="col col-md-2">
            <input type="text" class="form-control" id="medicines_id_<?php echo $row_number; ?>" disabled >
          </div>
      </div>

    <div class="row col col-md-12">
      <div class="col col-md-5 font-weight-bold" style="color: green;cursor:pointer" onclick="document.getElementById('add_new_medicine_model').style.display = 'block';">
      <i class="fa fa-plus"></i>Add New Product
      </div>
    </div>
      <div class="col col-md-12">
        <hr class="col-md-12" style="padding: 0px;">
      </div>
      <?php
  }
?>