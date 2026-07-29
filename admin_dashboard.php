<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard - AlumSphere</title>
    <link rel="stylesheet" href="styledashboard.css"> <!-- Use your uploaded CSS file -->
</head>
<body>

<header class="main-header">
    <div class="logo-title">
        <img src="logo5.png" alt="Logo" class="logo"> <!-- Replace with your logo path -->
        <span class="site-name">AlumSphere</span>
    </div>
    <div class="header-links">
        <a href="admin_logout.php">Logout</a>
    </div>
</header>

<div class="container">
    <h2>Welcome, Admin!</h2>
    <p class="dashboard-description">As an administrator of AlumSphere, you have full control over managing alumni records, organizing and updating events, overseeing participation, and configuring system settings to ensure smooth operation. 
    Use the tools below to efficiently maintain the alumni database, communicate upcoming activities, and enhance the engagement within our alumni community.</p>

    <div class="dashboard-actions">
        <a href="manage_events.php" class="action-btn">Manage Events</a>
        <a href="view_alumni.php" class="action-btn">View Alumni</a>
    </div>
</div>

<footer class="footer">
    &copy; 2025 AlumSphere. All rights reserved. | Contact Us:alumsphere@vau.ac.lk
</footer>

</body>
</html>
