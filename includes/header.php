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

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light" style="padding: 0 20px;">
    <a class="navbar-brand" href="index.php">
        <i class="fas fa-cogs"></i> Lead Management
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto" style="display: flex; align-items: center; flex-wrap: wrap; justify-content: space-between;">
            <!-- Home Link -->
            <li class="nav-item" style="margin-right: 15px;">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-home"></i> Home
                </a>
            </li>
            <!-- About Link -->
            <li class="nav-item" style="margin-right: 15px;">
                <a class="nav-link" href="about.php">
                    <i class="fas fa-info-circle"></i> About
                </a>
            </li>
            <!-- Contact Us Link -->
            <li class="nav-item" style="margin-right: 15px;">
                <a class="nav-link" href="contact.php">
                    <i class="fas fa-address-book"></i> Contact Us
                </a>
            </li>
            
            <!-- Additional Admin Links -->
            <li class="nav-item" style="margin-right: 15px;">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="nav-item" style="margin-right: 15px;">
                <a class="nav-link" href="leads.php">
                    <i class="fas fa-user-plus"></i> Add Leads
                </a>
            </li>
            <li class="nav-item" style="margin-right: 15px;">
                <a class="nav-link" href="report.php">
                    <i class="fas fa-file-alt"></i> Reports
                </a>
            </li>
           
            <li class="nav-item" style="margin-right: 15px;">
                <a class="nav-link" href="contacts.php">
                    <i class="fas fa-address-book"></i> Contacts
                </a>
            </li>
            
            <!-- Logout (only visible when user is logged in) -->
            <?php if (isset($_SESSION['adminName'])) { ?>
                <li class="nav-item" style="margin-right: 15px;">
                    <a class="nav-link" href="logout.php">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>

</body>
