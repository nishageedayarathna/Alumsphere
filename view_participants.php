<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_dashboard.php");
    exit;
}

$event_id = isset($_GET['event_id']) ? $_GET['event_id'] : 0;

// Fetch event details
$event_sql = "SELECT * FROM events WHERE id='$event_id'";
$event_result = $conn->query($event_sql);
$event = ($event_result && $event_result->num_rows > 0) ? $event_result->fetch_assoc() : null;

// Fetch participants
$participant_sql = "SELECT alumni.name, alumni.student_email, alumni.batch 
                    FROM event_responses 
                    JOIN alumni ON event_responses.user_id = alumni.reg_no 
                    WHERE event_responses.event_id='$event_id'";

$participants = $conn->query($participant_sql);

// **Fix: Check if the query failed**
if (!$participants) {
    echo "<p>Error fetching participants: " . $conn->error . "</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Event Participants - AlumSphere</title>
    <link rel="stylesheet" href="style4.css">
</head>
<body>
    <div class="container">
        <h1>Event Participants</h1>

        <?php if ($event) { ?>
            <h2><?php echo htmlspecialchars($event['title']); ?></h2>
            <p><strong>Date:</strong> <?php echo htmlspecialchars($event['event_date']); ?></p>
            <p><strong>Description:</strong> <?php echo htmlspecialchars($event['description']); ?></p>

            <h2>Confirmed Participants</h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Batch</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($participants->num_rows > 0) { ?>
                        <?php while ($row = $participants->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['student_email']); ?></td>
                            <td><?php echo htmlspecialchars($row['batch']); ?></td>
                        </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr><td colspan="3">No participants confirmed yet.</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>Error: Event not found.</p>
        <?php } ?>

        <p><a href="manage_events.php">Back to Events</a></p>
    </div>
</body>
</html>
