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
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('includes/header.php'); ?>
   

    <div class="container mt-4">
        <h3>Add Lead</h3>
        <form method="POST" action="insert_lead.php">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" required>
            </div>
            <div class="mb-3">
                <label for="number" class="form-label">Number</label>
                <input type="text" class="form-control" id="number" name="number" required>
            </div>
            <div class="mb-3">
                <label for="leadType" class="form-label">Lead Type</label>
                <select class="form-select" id="leadType" name="leadType" required>
                    <option value="Call">Call</option>
                    <option value="Medium">Medium</option>
                    <option value="Not Call">Not Call</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Lead</button>
        </form>
    </div>

    <?php include('includes/footer.php'); ?>
</body>
</html>
