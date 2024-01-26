<?php
require 'db_connection.php';

if ($con) {
  $query = "SELECT medicine_name, SUM(quantity) AS totalQuantity FROM sales WHERE sale_date >= DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK) GROUP BY medicine_name ORDER BY totalQuantity DESC LIMIT 7";
  $result = mysqli_query($con, $query);

  $topSellingData = array();

  while ($row = mysqli_fetch_assoc($result)) {
    $medicineName = $row['medicine_name'];
    $totalQuantity = intval($row['totalQuantity']);

    $topSellingData[$medicineName] = array(
      "totalQuantity" => $totalQuantity
    );
  }

  echo json_encode($topSellingData);
} else {
  echo "Database connection error";
}
?>
