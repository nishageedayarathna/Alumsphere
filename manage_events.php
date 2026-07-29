<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_dashboard.php");
    exit;
}

// Handle event creation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $description = $_POST['description'];

    $sql = "INSERT INTO events (title, event_date, description) VALUES ('$title', '$date', '$description')";
    if ($conn->query($sql)) {
        echo "<script>alert('✅ Event added successfully!'); window.location.href = 'manage_events.php';</script>";
    } else {
        echo "<script>alert('❌ Failed to add event.');</script>";
    }
}

// Fetch all events
$event_sql = "SELECT * FROM events ORDER BY event_date ASC";
$events = $conn->query($event_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Events - AlumSphere</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
    <div class="container">
        <h1>Manage Alumni Events</h1>

        <h2>Create New Event</h2>
        <form method="post">
            <input type="text" name="title" placeholder="Event Title" required>
            <input type="date" name="date" required>
            <textarea name="description" placeholder="Event Description" required></textarea>
            <button type="submit">Add Event</button>
        </form>

        <h2>Upcoming Events</h2>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Participants</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($event = $events->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $event['title']; ?></td>
                    <td><?php echo $event['event_date']; ?></td>
                    <td><?php echo $event['description']; ?></td>
                    <td>
                        <button>
                        <a href="view_participants.php?event_id=<?php echo $event['id']; ?>">View Responses</a>
                </botton>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <p><a href="admin_dashboard.php">Back to Dashboard</a></p>
    </div>
</body>
</html>
