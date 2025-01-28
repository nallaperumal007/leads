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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <?php include('includes/header.php'); ?>

    <div class="container mt-4">
        <h3>Lead Report</h3>

       

        <?php
        $fromDate = isset($_GET['fromDate']) ? $_GET['fromDate'] : '';
        $toDate = isset($_GET['toDate']) ? $_GET['toDate'] : '';
        $leadType = isset($_GET['leadType']) ? $_GET['leadType'] : '';

        $query = "SELECT * FROM leads WHERE 1=1";

        // Apply date filters
        if (!empty($fromDate)) {
            $query .= " AND date >= '$fromDate'";
        }

        if (!empty($toDate)) {
            $query .= " AND date <= '$toDate'";
        }

        // Apply leadType filter
        if (!empty($leadType)) {
            $query .= " AND leadType = '$leadType'";
        }

        $query .= " ORDER BY date DESC";

        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("Error fetching leads: " . mysqli_error($conn));
        }

        // Create a single table for all leads
        $leadsData = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $date = date('d-m-Y', strtotime($row['date']));
            $leadsData[$date][] = $row;  // Grouping leads by date
        }

        // Display the leads
        if (empty($leadsData)) {
            echo "<p class='text-danger'>No leads found for the selected filters.</p>";
        } else {
            foreach ($leadsData as $date => $leads) {
                echo "<h4 class='mt-4 text-primary'>Date: $date</h4>";
                echo "<table class='table table-bordered'>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Number</th>
                                <th>Lead Type</th>
                                <th>Description</th>
                                <th>Phone</th>
                                <th>WhatsApp</th>
                            </tr>
                        </thead>
                        <tbody>";

                foreach ($leads as $lead) {
                    echo "<tr>
                            <td>{$lead['name']}</td>
                            <td>{$lead['location']}</td>
                            <td>{$lead['number']}</td>
                            <td>{$lead['leadType']}</td>
                            <td>{$lead['description']}</td>
                            <td>
                                <a href='tel:{$lead['number']}' class='btn btn-success'><i class='fas fa-phone'></i></a>
                            </td>
                            <td>
                                <a href='https://wa.me/{$lead['number']}' target='_blank' class='btn btn-success'><i class='fab fa-whatsapp'></i></a>
                            </td>
                        </tr>";
                }

                echo "</tbody></table>";
            }
        }
        ?>
    </div>

    <?php include('includes/footer.php'); ?>
</body>
</html>
