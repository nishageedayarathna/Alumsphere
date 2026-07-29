<?php
include 'db_connect.php';
session_start();


// Fetch alumni details
$sql = "SELECT * FROM alumni";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Alumni - AlumSphere</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="container">
        <h1>AlumSphere</h1>
        <h2>Alumni Records</h2>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Personal_Email</th>
					<th>Student_Email</th>
                    <th>Birthdate</th>
                    <th>Registartion Number</th>
                    <th>Faculty</th>
                    <th>Batch</th>
                    <th>Designation</th>
					<th>Address</th>
					<th>Conatct Number</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0) { ?>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['personal_email']; ?></td>
						<td><?php echo $row['student_email']; ?></td>
						<td><?php echo $row['birthdate']; ?></td>
						<td><?php echo $row['reg_no']; ?></td>
                        <td><?php echo $row['faculty']; ?></td>
						<td><?php echo $row['batch']; ?></td>
                        <td><?php echo $row['designation']; ?></td>
						<td><?php echo $row['address']; ?></td>
						<td><?php echo $row['contact_number']; ?></td>
                        
                            
                    </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr><td colspan="10">No alumni details found.</td></tr>
                <?php } ?>
            </tbody>
        </table>

        <p><a href="admin_dashboard.php">Back to Dashboard</a></p>
    </div>
</body>
</html>
