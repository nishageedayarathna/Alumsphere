<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user'])) {
    header("Location: signin.php");
    exit;
}

$reg_no = $_SESSION['user']['reg_no'];

$sql = "SELECT * FROM alumni WHERE reg_no='$reg_no'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Alumni Details</title>
    <link rel="stylesheet" href="style6.css">
</head>
<body>
    <div class="container">
        <h1>My Details</h1>

        <?php if ($result->num_rows > 0): ?>
            <?php $row = $result->fetch_assoc(); ?>
           <div class="table-wrapper">
  <table class="profile-table">
    <tbody>
      <tr><th>Name</th><td><?php echo htmlspecialchars($row['name']); ?></td></tr>
      <tr><th>Email</th><td><?php echo htmlspecialchars($row['personal_email']); ?></td></tr>
      <tr><th>Student Email</th><td><?php echo htmlspecialchars($row['student_email']); ?></td></tr>
      <tr><th>Birthdate</th><td><?php echo htmlspecialchars($row['birthdate']); ?></td></tr>
      <tr><th>RegNo</th><td><?php echo htmlspecialchars($row['reg_no']); ?></td></tr>
      <tr><th>Faculty</th><td><?php echo htmlspecialchars($row['faculty']); ?></td></tr>
      <tr><th>Batch</th><td><?php echo htmlspecialchars($row['batch']); ?></td></tr>
      <tr><th>Designation</th><td><?php echo htmlspecialchars($row['designation']); ?></td></tr>
      <tr><th>Address</th><td><?php echo htmlspecialchars($row['address']); ?></td></tr>
      <tr><th>Contact</th><td><?php echo htmlspecialchars($row['contact_number']); ?></td></tr>
    </tbody>
  </table>
</div>

            </div>
        <?php else: ?>
            <p>No details found.</p>
        <?php endif; ?>

<div class="center-link">
  <a href="dashboard.php" >← Back to Dashboard</a>
</div>

    </div>
</body>
</html>
