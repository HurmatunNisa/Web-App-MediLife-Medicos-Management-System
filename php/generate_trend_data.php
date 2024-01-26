<?php
require "db_connection.php";

$query = "SELECT m.NAME AS MedicineName, SUM(i.QUANTITY) AS TotalSalesQuantity
          FROM invoices AS i
          JOIN medicines AS m ON i.PRODUCT_ID = m.PRODUCT_ID
          WHERE i.INVOICE_DATE >= DATE_SUB(NOW(), INTERVAL 3 MONTH)
          GROUP BY m.NAME
          ORDER BY TotalSalesQuantity DESC
          LIMIT 6";
// Include necessary database connection code

// Fetch sales data from your database and process it
// Example query:
// SELECT YEAR(INVOICE_DATE) as year, MONTH(INVOICE_DATE) as month, SUM(TOTAL_AMOUNT) as total_amount
// FROM invoices
// GROUP BY YEAR(INVOICE_DATE), MONTH(INVOICE_DATE)
// ORDER BY YEAR(INVOICE_DATE), MONTH(INVOICE_DATE)

// Format data into an array
$trend_data = array();
while ($row = mysqli_fetch_assoc($result)) {
  $trend_data[] = array(
    "year" => $row["year"],
    "month" => $row["month"],
    "total_amount" => $row["total_amount"]
  );
}

// Output data in JSON format
header('Content-Type: application/json');
echo json_encode($trend_data);
?>

?>
