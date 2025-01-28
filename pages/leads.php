<?php
session_start();
if (!isset($_SESSION['adminName'])) {
    header('Location: login.php');
}
include('includes/db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Leads</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="styles.css" rel="stylesheet">
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        

        /* Content Section */
        .content {
            margin-left: 250px;
            padding: 20px;
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        .container {
            max-width: 600px; /* ✅ Restrict form width */
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: auto; /* ✅ Center the form */
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .content {
                margin-left: 0;
                padding: 10px;
            }

            .container {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <!-- Include Header -->
    <?php include('includes/header.php'); ?>

    <!-- Sidebar -->


    <!-- Content Section -->
    <div class="content">
        <div class="container mt-4">
            <h3 class="text-center">Add Lead</h3>
            <form method="POST" action="insert_lead.php">
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
    </div>

    <!-- Include Footer -->
    <?php include('includes/footer.php'); ?>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
