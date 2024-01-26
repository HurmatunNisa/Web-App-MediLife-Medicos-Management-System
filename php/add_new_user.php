<?php
require "db_connection.php";

if ($con) {
    $username = mysqli_real_escape_string($con, $_GET["username"]);
    $password = mysqli_real_escape_string($con, $_GET["password"]);
    $user_type = mysqli_real_escape_string($con, $_GET["userType"]);
    $address = mysqli_real_escape_string($con, $_GET["address"]);
    $email = mysqli_real_escape_string($con, $_GET["email"]);
    $contactNumber = mysqli_real_escape_string($con, $_GET["contactNumber"]);

    $checkQuery = "SELECT * FROM user WHERE USERNAME = '$username'";
    $checkResult = mysqli_query($con, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        echo "User $username already exists";
    } else {
        $insertQuery = "INSERT INTO user (USERNAME, PASSWORD, USER_TYPE,ADDRESS, EMAIL, CONTACT_NUMBER) VALUES ('$username', '$password', '$user_type','$address', '$email', '$contactNumber')";
        $insertResult = mysqli_query($con, $insertQuery);
        $insertQuery1 = "INSERT INTO admin_credentials (USERNAME, PASSWORD, TYPE, IS_LOGGED_IN) VALUES ('$username', '$password', '$user_type', '0')";
        $insertResult1 = mysqli_query($con, $insertQuery1);

        if ($insertResult) {
            echo "$username added successfully";
            
        } else {
            echo "Failed to add $username";
        }
    }
} else {
    echo "Database connection error";
}
?>
