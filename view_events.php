<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user'])) {
    header("Location: signin.php");
    exit;
}

$user_id = $_SESSION['user']['reg_no'];

// Handle participation confirmation and cancellation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_id = $_POST['event_id'];

    if (isset($_POST['action']) && $_POST['action'] === "cancel") {
        // Cancel participation
        $sql = "DELETE FROM event_responses WHERE event_id='$event_id' AND user_id='$user_id'";
        $conn->query($sql);
    } else {
        // Confirm participation
        $check_sql = "SELECT * FROM event_responses WHERE user_id='$user_id' AND event_id='$event_id'";
        $check_result = $conn->query($check_sql);

        if ($check_result->num_rows == 0) {
            $sql = "INSERT INTO event_responses (event_id, user_id) VALUES ('$event_id', '$user_id')";
            $conn->query($sql);
        }
    }

    header("Location: view_events.php");
    exit;
}

// Fetch events
$event_sql = "SELECT * FROM events ORDER BY event_date ASC";
$events = $conn->query($event_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Events - AlumSphere</title>
    <link rel="stylesheet" href="style3.css">
    <style>
        .confirmed-btn {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            font-weight: bold;
            cursor: default;
        }

        .cancel-btn {
            background-color: #e53935;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .cancel-btn:hover {
            background-color: #b71c1c;
        }

        .confirm-btn {
            background-color: #1976d2;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .confirm-btn:hover {
            background-color: #0d47a1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: center;
        }

        th {
            background-color: #1565c0;
            color: white;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #e1f0ff;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #0d47a1;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            color: #0d47a1;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Upcoming Alumni Events</h1>

        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Participation</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($event = $events->fetch_assoc()) {
                    $event_id = $event['id'];

                    $check_sql = "SELECT * FROM event_responses WHERE user_id='$user_id' AND event_id='$event_id'";
                    $check_result = $conn->query($check_sql);
                    $is_participating = $check_result->num_rows > 0;
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($event['title']); ?></td>
                    <td><?php echo htmlspecialchars($event['event_date']); ?></td>
                    <td><?php echo htmlspecialchars($event['description']); ?></td>
                    <td>
                        <?php if ($is_participating): ?>
                            <form method="post" style="margin:0;">
                                <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                                <input type="hidden" name="action" value="cancel">
                                <button type="submit" class="cancel-btn">Cancel Participation</button>
                            </form>
                        <?php else: ?>
                            <form method="post" style="margin:0;">
                                <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                                <button type="submit" class="confirm-btn">Confirm Participation</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <p><a href="dashboard.php">← Back to Dashboard</a></p>
    </div>
</body>
</html>
