<?php
// DB connection
include('includes/db.php');

// Admin login check
session_start();
if (!isset($_SESSION['adminName']) && basename($_SERVER['PHP_SELF']) !== 'login.php') {
    header('Location: login.php');
    exit;
}

// Admin login check (for login.php page)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && basename($_SERVER['PHP_SELF']) == 'login.php') {
    $adminName = $_POST['adminName'];
    $password = $_POST['password'];
    
    // SQL query to verify admin credentials
    $query = "SELECT * FROM `admin` WHERE `username`='$adminName' AND `password`='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['adminName'] = $adminName;
        header('Location: dashboard.php');
    } else {
        $error = "Invalid credentials.";
    }
}

// Handling Lead Insertion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && basename($_SERVER['PHP_SELF']) == 'leads.php') {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $number = $_POST['number'];
    $leadType = $_POST['leadType'];
    $description = $_POST['description'];
    
    // SQL query to insert a new lead
    $query = "INSERT INTO `leads` (`name`, `location`, `number`, `leadType`, `description`) 
              VALUES ('$name', '$location', '$number', '$leadType', '$description')";
    
    if (mysqli_query($conn, $query)) {
        $message = "Lead added successfully!";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}

// Query to fetch leads for report or dashboard
$query = "SELECT * FROM `leads` ORDER BY `date` DESC";
$leads_result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lead Management System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <link href="styles.css" rel="stylesheet">
</head>
<body>
<?php include('includes/header.php'); ?>


<br/> <br />

<!-- Content Area -->
<div class="content">
    <!-- Dashboard Content -->
    <?php if (basename($_SERVER['PHP_SELF']) == 'dashboard.php') { ?>
        <div class="container mt-4">
            <h3 class="text-center text-primary"><i class="fas fa-chart-bar"></i> Dashboard</h3>
            <canvas id="barChart" width="400" height="200"></canvas>
            <script>
                var ctx = document.getElementById('barChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Call', 'Medium', 'Not Call'],
                        datasets: [{
                            label: 'Leads by Type',
                            data: [12, 19, 3],  // Replace with dynamic data from your database
                            backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)'],
                            borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </div>
    <?php } ?>

    <!-- Lead Form (For Adding New Leads) -->
    <?php if (basename($_SERVER['PHP_SELF']) == 'leads.php') { ?>
        <div class="container mt-4">
            <h3 class="text-center text-primary"><i class="fas fa-user-plus"></i> Add Lead</h3>
            <?php if (isset($message)) { echo "<div class='alert alert-info'>$message</div>"; } ?>
            <form method="POST" action="leads.php">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" class="form-control" id="location" name="location" required>
                </div>
                <div class="form-group">
                    <label for="number">Number</label>
                    <input type="text" class="form-control" id="number" name="number" required>
                </div>
                <div class="form-group">
                    <label for="leadType">Lead Type</label>
                    <select class="form-control" id="leadType" name="leadType" required>
                        <option value="Call">Call</option>
                        <option value="Medium">Medium</option>
                        <option value="Not Call">Not Call</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Submit Lead</button>
            </form>
        </div>
    <?php } ?>
</div>

<!-- Footer -->
<footer>
    <span>&copy; 2025 Lead Management System | All rights reserved</span>
    <div class="social-icons">
        <a href="#" class="fab fa-facebook-f"></a>
        <a href="#" class="fab fa-twitter"></a>
        <a href="#" class="fab fa-linkedin-in"></a>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
