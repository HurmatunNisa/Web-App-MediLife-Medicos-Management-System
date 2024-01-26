<?php
// Start the session to access session data
session_start();
echo $_SESSION['USERNAME'];
// Check if the 'role' session variable is set
if (isset($_SESSION['TYPE'])) {
    $userRole = $_SESSION['TYPE'];
    
   
    // Based on the user role, redirect to the respective dashboard page
    if ($userRole === "salesperson") {
        updateIsLoggedInAttribute($_SESSION['USERNAME'], true);
        header("Location: home_salesperson.php");
        exit(); // Exit to prevent further execution
    } elseif ($userRole === "manager") {
        updateIsLoggedInAttribute($_SESSION['USERNAME'], true);
        header("Location: home_manager.php");
        exit(); // Exit to prevent further execution
    } elseif ($userRole === "admin") {
        updateIsLoggedInAttribute($_SESSION['USERNAME'], true);
        header("Location: home.php");
        exit(); // Exit to prevent further execution
    } else {
        // If the role is not one of the expected values, handle it accordingly
        header("Location: manage_purchase.php");
        exit(); // Exit to prevent further execution
    }
} else {
    // If the role session variable is not set, redirect to the login page
    header("Location: login.php");
    exit(); // Exit to prevent further execution
}

function updateIsLoggedInAttribute($username, $isLoggedIn) {
    require "db_connection.php"; // Include your database connection

    // Create and execute the update query
    $query = "UPDATE admin_credentials SET IS_LOGGED_IN = $isLoggedIn WHERE USERNAME = '$username'";
    $result = mysqli_query($con, $query);

    if (!$result) {
        // Handle the update error
        echo "Error updating 'is_loggedin' attribute: " . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);
}
?>
