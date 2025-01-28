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
    <title>Lead Report</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('includes/header.php'); ?>
    <?php include('includes/sidebar.php'); ?>

    <div class="container mt-4">
        <h3>Lead Report</h3>
        <form method="GET" class="mb-3">
            <div class="input-group">
                <input type="date" class="form-control" name="dateFilter" value="<?= isset($_GET['dateFilter']) ? $_GET['dateFilter'] : '' ?>">
                <button class="btn btn-primary" type="submit">Filter by Date</button>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Number</th>
                    <th>Lead Type</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $dateFilter = isset($_GET['dateFilter']) ? $_GET['dateFilter'] : '';
                $query = "SELECT * FROM leads WHERE date LIKE '%$dateFilter%'";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['name']}</td>
                        <td>{$row['location']}</td>
                        <td>{$row['number']}</td>
                        <td>{$row['leadType']}</td>
                        <td>{$row['description']}</td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php include('includes/footer.php'); ?>
</body>
</html>
