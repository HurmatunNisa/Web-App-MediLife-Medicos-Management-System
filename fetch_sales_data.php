<?php
// Include your database connection
require 'db_connection.php';

if ($con) {
    // Fetch top 6 most sold medicines in the last 3 months
    $query = "SELECT medicines.NAME, SUM(sales.QUANTITY) AS total_quantity 
              FROM sales 
              INNER JOIN medicines ON sales.PRODUCT_ID = medicines.PRODUCT_ID
              WHERE sales.INVOICE_DATE >= DATE_SUB(CURRENT_DATE, INTERVAL 3 MONTH)
              GROUP BY medicines.NAME
              ORDER BY total_quantity DESC
              LIMIT 6";

    $result = mysqli_query($con, $query);

    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[$row['NAME']] = $row['total_quantity'];
    }

    // Fetch data for each medicine
    foreach ($data as $medicineName => $quantity) {
        $query = "SELECT MONTH(sales.INVOICE_DATE) AS month, SUM(sales.QUANTITY) AS quantity
                  FROM sales 
                  INNER JOIN medicines ON sales.PRODUCT_ID = medicines.PRODUCT_ID
                  WHERE sales.INVOICE_DATE >= DATE_SUB(CURRENT_DATE, INTERVAL 3 MONTH)
                  AND medicines.NAME = '$medicineName'
                  GROUP BY MONTH(sales.INVOICE_DATE)
                  ORDER BY MONTH(sales.INVOICE_DATE)";
        
        $result = mysqli_query($con, $query);

        $monthData = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $monthData[$row['month']] = $row['quantity'];
        }

        // Populate the data array
        foreach ($monthData as $month => $quantity) {
            $data[$medicineName][$month] = $quantity;
        }
    }

    // Return the data as JSON
    echo json_encode($data);

    // Close the database connection
    mysqli_close($con);
}
?>
