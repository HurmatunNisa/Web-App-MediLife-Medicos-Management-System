<?php
// Start the session to access session data
session_start();

// Check if the 'role' session variable is set
if (isset($_SESSION['TYPE'])) {
    $userRole = $_SESSION['TYPE'];

    // Manager side nav
    if ($userRole === "admin") {
        include "sections/sidenav.html";
    }
    elseif ($userRole === "manager") {
        include "sections/sidenav_manager.html";
    }
    
    elseif ($userRole === "salesperson") {
        include "sections/sidenav_salesperson.html";
    } 
} else {
    // If the 'role' session variable is not set, redirect the user to the login page.
    include "sections/sidenav.html";;
    exit(); // Exit to prevent further execution
}
