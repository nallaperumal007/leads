<?php
session_start();
if (!isset($_SESSION['adminName'])) {
    header('Location: login.php');
}
include('includes/db.php');

// Query to count the leads by type (Call, Medium, Not Call)
$callQuery = "SELECT COUNT(*) as total_calls FROM leads WHERE leadType = 'Call'";
$mediumQuery = "SELECT COUNT(*) as total_medium FROM leads WHERE leadType = 'Medium'";
$notCallQuery = "SELECT COUNT(*) as total_not_call FROM leads WHERE leadType = 'Not Call'";

$callResult = mysqli_query($conn, $callQuery);
$mediumResult = mysqli_query($conn, $mediumQuery);
$notCallResult = mysqli_query($conn, $notCallQuery);

if (!$callResult || !$mediumResult || !$notCallResult) {
    die("Error fetching lead counts: " . mysqli_error($conn));
}

$callData = mysqli_fetch_assoc($callResult);
$mediumData = mysqli_fetch_assoc($mediumResult);
$notCallData = mysqli_fetch_assoc($notCallResult);

$totalCalls = $callData['total_calls'];
$totalMedium = $mediumData['total_medium'];
$totalNotCall = $notCallData['total_not_call'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #f4f7fb;
            font-family: 'Arial', sans-serif;
        }
        .navbar {
            background-color: #3498db;
            color: white;
        }
        .navbar a {
            color: white;
        }
        .navbar a:hover {
            color: #f8f9fc;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background-color: #2c3e50;
            padding-top: 30px;
            color: white;
        }
        .sidebar a {
            color: white;
            padding: 15px 25px;
            text-decoration: none;
            display: block;
            font-size: 18px;
            margin-bottom: 10px;
        }
        .sidebar a:hover {
            background-color: #2980b9;
        }
        .content {
            margin-left: 250px;
            padding: 30px;
        }
        .card {
            border: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            margin-bottom: 30px;
        }
        .card-header {
            background-color: #3498db;
            color: white;
            font-size: 18px;
            font-weight: bold;
        }
        .card-body {
            padding: 30px;
        }
        .footer {
            background-color: #3498db;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        footer .social-icons a {
            margin: 0 10px;
            color: white;
            font-size: 20px;
        }
        footer .social-icons a:hover {
            color: #f8f9fc;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .content {
                margin-left: 0;
            }
            .navbar .nav-item {
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <?php include('includes/header.php'); ?>
    <?php include('includes/sidebar.php'); ?>

    <div class="content">
        <h3 class="text-center text-primary mb-4"><i class="fas fa-tachometer-alt"></i> Admin Dashboard</h3>

        <!-- Card for Lead Statistics -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-chart-bar"></i> Leads Overview
            </div>
            <div class="card-body">
                <canvas id="barChart" width="400" height="200"></canvas>
                <script>
                    var ctx = document.getElementById('barChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Call', 'Medium', 'Not Call'],
                            datasets: [{
                                label: 'Leads by Type',
                                data: [<?php echo $totalCalls; ?>, <?php echo $totalMedium; ?>, <?php echo $totalNotCall; ?>],
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
        </div>

        <!-- Card for Quick Stats -->
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <i class="fas fa-phone"></i> Total Calls
                    </div>
                    <div class="card-body text-center">
                        <h4><?php echo $totalCalls; ?></h4>
                        <p>Leads marked as Call</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-warning text-white">
                        <i class="fas fa-comments"></i> Medium Leads
                    </div>
                    <div class="card-body text-center">
                        <h4><?php echo $totalMedium; ?></h4>
                        <p>Leads marked as Medium</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <i class="fas fa-times-circle"></i> Not Call
                    </div>
                    <div class="card-body text-center">
                        <h4><?php echo $totalNotCall; ?></h4>
                        <p>Leads marked as Not Call</p>
                    </div>
                </div>
            </div>
        </div>
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
