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
        echo "<div class='alert alert-danger text-center'>Invalid credentials.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: yellow;
            color: white;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background: white;
            border-radius: 15px;
            padding: 30px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .login-container h2 {
            color: #6a11cb;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #6a11cb;
            border: none;
        }
        .btn-primary:hover {
            background-color: #2575fc;
        }
        .form-control {
            border-radius: 10px;
            border: 1px solid #ddd;
        }
        .form-label {
            color: #6a11cb;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="adminName" class="form-label">Admin Name</label>
                <input type="text" class="form-control" id="adminName" name="adminName" placeholder="Enter admin name" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</body>
</html>
