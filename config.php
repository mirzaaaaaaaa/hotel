<?php

// Database configuration
$db_host = 'localhost';  // Your MySQL host
$db_user = 'root';   // Your MySQL username
$db_pass = '';   // Your MySQL password
$db_name = 'hotel_db';   // Your MySQL database name

// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
