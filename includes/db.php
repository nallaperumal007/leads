<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lead_management";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Optionally, set the character set for the connection (to avoid encoding issues)
mysqli_set_charset($conn, "utf8");

// Return the connection object for use in other files
return $conn;
?>
