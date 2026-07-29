<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: signin.php");
    exit;
}
include 'footer.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Dashboard - AlumSphere</title>
    <link rel="stylesheet" href="styledashboard.css">
</head>
<body>

    <!-- Minimal Header -->
    <header class="main-header">
        <div class="logo-title">
            <img src="logo5.png" alt="Logo" class="logo"> <!-- Replace with your logo file -->
            <span class="site-name">AlumSphere</span>
			
        </div>
		
        <div class="header-links">
            <a href="view_my_details.php">View My Details</a> |
            <a href="logout.php">Logout</a>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <h2>Welcome, <?php echo $_SESSION['user']['reg_no']; ?>!</h2>

        <p class="dashboard-description">
        As a valued member of AlumSphere, you can upload student data, view upcoming events, and stay connected with our alumni network.
    </p>

        <div class="dashboard-actions">
    <a href="upload_csv.php" class="action-btn">Upload CSV</a>
    <a href="view_events.php" class="action-btn">View Events</a>
</div>
    </div>

</body>
</html>
