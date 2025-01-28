<?php
session_start();
include('includes/db.php');
if (isset($_POST['login'])) {
    $adminName = $_POST['adminName'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admin WHERE username='$adminName' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['adminName'] = $adminName;
        header('Location: dashboard.php');
    } else {
        echo "Invalid credentials.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="text-center mt-5">Admin Login</h2>
        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="adminName" class="form-label">Admin Name</label>
                <input type="text" class="form-control" id="adminName" name="adminName" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</body>
</html>
