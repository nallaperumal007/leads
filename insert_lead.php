<?php
session_start();
if (!isset($_SESSION['adminName'])) {
    header('Location: login.php');
    exit();
}

include('includes/db.php'); // Ensure db.php contains a valid database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user inputs
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $leadType = mysqli_real_escape_string($conn, $_POST['leadType']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Validate inputs
    if (!empty($name) && !empty($location) && !empty($number) && !empty($leadType) && !empty($description)) {
        // Insert query
        $query = "INSERT INTO leads (name, location, number, leadType, description) 
                  VALUES ('$name', '$location', '$number', '$leadType', '$description')";
        
        if (mysqli_query($conn, $query)) {
            $_SESSION['success'] = "Lead added successfully!";
        } else {
            $_SESSION['error'] = "Error: " . mysqli_error($conn);
        }
    } else {
        $_SESSION['error'] = "All fields are required!";
    }
    
    // Redirect to the leads page
    header("Location: leads.php");
    exit();
} else {
    $_SESSION['error'] = "Invalid request!";
    header("Location: leads.php");
    exit();
}
?>
