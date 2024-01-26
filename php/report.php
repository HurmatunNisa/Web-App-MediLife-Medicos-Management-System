<?php

if(isset($_GET['action']) && $_GET['action'] == "purchase")
  showPurchases($_GET['start_date'], $_GET['end_date']);

if(isset($_GET['action']) && $_GET['action'] == "sales")
  showSales($_GET['start_date'], $_GET['end_date']);

if(isset($_GET['action']) && $_GET['action'] == "stock")
  showStock($_GET['start_date'], $_GET['end_date']);

if(isset($_GET['action']) && $_GET['action'] == "expired")
  showExpired($_GET['start_date'], $_GET['end_date']);

function showPurchases($start_date, $end_date) {
  ?>
  <thead>
    <tr>
      <th>SL</th>
      <th>Purchase Date</th>
      <!-- <th>Voucher Number</th> -->
      <th>Invoice No</th>
      <th>Supplier Name</th>
      <th>Total Amount</th>
    </tr>
  </thead>
  <tbody>
  <?php
  require "db_connection.php";
  if($con) {
    $seq_no = 0;
    $total = 0;
    if($start_date == "" || $end_date == "")
      $query = "SELECT * FROM purchases";
    else
      $query = "SELECT * FROM purchases WHERE PURCHASE_DATE BETWEEN '$start_date' AND '$end_date'";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
      $seq_no++;
      showPurchaseRow($seq_no, $row);
      $total = $total + $row['TOTAL_AMOUNT'];
    }
    ?>
    </tbody>
    <tfoot class="font-weight-bold">
      <tr style="text-align: right; font-size: 24px;">
        <td colspan="5" style="color: green;">&nbsp;Total Purchases =</td>
        <td style="color: red;"><?php echo $total; ?></td>
      </tr>
    </tfoot>
    <?php
  }
}

function showPurchaseRow($seq_no, $row) {
  ?>
  <tr>
    <td><?php echo $seq_no; ?></td>
    <td><?php echo $row['PURCHASE_DATE']; ?></td>
    <td><?php echo $row['INVOICE_NUMBER']; ?></td>
    <td><?php echo $row['SUPPLIER_NAME'] ?></td>
    <td><?php echo $row['TOTAL_AMOUNT']; ?></td>
  </tr>
  <?php
}

function showSales($start_date, $end_date) {
  ?>
  <thead>
    <tr>
      <th>SL</th>
      <th>Sales Date</th>
      <th>Invoice Number</th>
      <th>Customer Name</th>
      <th>Total Amount</th>
    </tr>
  </thead>
  <tbody>
  <?php
  require "db_connection.php";
  if($con) {
    $seq_no = 0;
    $total = 0;
    if($start_date == "" || $end_date == "")
      $query = "SELECT * FROM invoices INNER JOIN customers ON invoices.CUSTOMER_ID = customers.ID";
    else
      $query = "SELECT * FROM invoices INNER JOIN customers ON invoices.CUSTOMER_ID = customers.ID WHERE INVOICE_DATE BETWEEN '$start_date' AND '$end_date'";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
      $seq_no++;
      //print_r($row);
      showSalesRow($seq_no, $row);
      $total = $total + $row['NET_TOTAL'];
    }
    ?>
    </tbody>
    <tfoot class="font-weight-bold">
      <tr style="text-align: right; font-size: 24px;">
        <td colspan="4" style="color: green;">&nbsp;Total Sales =</td>
        <td class="text-primary"><?php echo $total; ?></td>
      </tr>
    </tfoot>
    <?php
  }
}

function showSalesRow($seq_no, $row) {
  ?>
  <tr>
    <td><?php echo $seq_no; ?></td>
    <td><?php echo $row['INVOICE_DATE']; ?></td>
    <td><?php echo $row['INVOICE_ID']; ?></td>
    <td><?php echo $row['NAME']; ?></td>
    <td><?php echo $row['NET_TOTAL'] ?></td>
  </tr>
  <?php
}

function showStock($start_date, $end_date) {
  ?>
  <thead>
    <tr>
      <th>ID</th>
      <th>Product Name</th>
      <th>Expiry Date</th>
      <th>Batch ID</th>
      <th>Quantity</th>
      <th>MRP</th>
      <th>Rate</th>
      <th>Min Stock Level</th>
      <th>Max Stock Level</th>
      <th>Stock In Date</th>
      <th>Supplier Name</th>
    </tr>
  </thead>
  <tbody>
    <?php
    require "db_connection.php";

    if ($con) {
      $query = "SELECT * FROM medicines_stock";
      
      if (!empty($start_date) && !empty($end_date)) {
        $query .= " WHERE STOCK_IN_DATE BETWEEN '$start_date' AND '$end_date'";
      }
    
      $result = mysqli_query($con, $query);
      
      while ($row = mysqli_fetch_array($result)) {
        showStockRow($row);
      }
    }
    ?>
  </tbody>
<?php
}

function showStockRow($row) {
  ?>
  <tr>
    <td><?php echo $row['ID']; ?></td>
    <td><?php echo $row['NAME']; ?></td>
    <td><?php echo $row['EXPIRY_DATE']; ?></td>
    <td><?php echo $row['BATCH_ID']; ?></td>
    <td><?php echo $row['QUANTITY']; ?></td>
    <td><?php echo $row['MRP']; ?></td>
    <td><?php echo $row['RATE']; ?></td>
    <td><?php echo $row['MIN_STOCK_LVL']; ?></td>
    <td><?php echo $row['MAX_STOCK_LVL']; ?></td>
    <td><?php echo $row['STOCK_IN_DATE']; ?></td>
    <td><?php echo $row['SUPPLIER_NAME']; ?></td>
    
  </tr>
  <?php
}

