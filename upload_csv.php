<?php
include 'db_connect.php';

$popupMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["csv_file"])) {
    $file = $_FILES["csv_file"]["tmp_name"];

    if (($handle = fopen($file, "r")) !== FALSE) {
        $rowCount = 0;
        $inserted = 0;
        $skipped = 0;

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $rowCount++;

            // Skip header row if present
            if ($rowCount == 1 && strtolower(trim($data[0])) == "name") continue;

            if (count($data) != 10 || in_array('', $data)) {
                $skipped++;
                continue;
            }

            $name = trim($data[0]);
            $personal_email = trim($data[1]);
            $student_email = trim($data[2]);
            $birthdate = trim($data[3]);
            $reg_no = trim($data[4]);
            $faculty = trim($data[5]);
            $batch = trim($data[6]);
            $designation = trim($data[7]);
            $address = trim($data[8]);
            $contact_number = trim($data[9]);

            // Check if student_email exists
            $check_stmt = $conn->prepare("SELECT student_email FROM alumni WHERE student_email = ?");
            $check_stmt->bind_param("s", $student_email);
            $check_stmt->execute();
            $check_stmt->store_result();

            if ($check_stmt->num_rows == 0) {
                $insert_stmt = $conn->prepare("INSERT INTO alumni (name, personal_email, student_email, birthdate, reg_no, faculty, batch, designation, address, contact_number)
                                               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $insert_stmt->bind_param("ssssssssss", $name, $personal_email, $student_email, $birthdate, $reg_no, $faculty, $batch, $designation, $address, $contact_number);
                $insert_stmt->execute();
                $insert_stmt->close();
                $inserted++;
            } else {
                $skipped++;
            }

            $check_stmt->close();
        }

        fclose($handle);
        $popupMessage = "$inserted record(s) inserted. $skipped skipped.";

        // Optional: Uncomment this if you prefer redirect instead of alert
        // header("Location: view_my_details.php");
        // exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Upload Alumni CSV - AlumSphere</title>
    <link rel="stylesheet" href="style7.css">
</head>
<body>
    <div class="container">
        <h1>AlumSphere</h1>
        <h2>Upload Alumni Details</h2>

        <div class="instruction-box">
            <h3>Required CSV Format</h3>
            <p>Please make sure your CSV file includes the following 10 fields in the exact order:</p>
            <ul>
                <li>Name</li>
                <li>Personal Email</li>
                <li>Student Email</li>
                <li>Birthdate (YYYY-MM-DD)</li>
                <li>Registration Number</li>
                <li>Faculty</li>
                <li>Batch</li>
                <li>Designation</li>
                <li>Address</li>
                <li>Contact Number</li>
            </ul>
            <p><strong>Note:</strong> All fields are required. Rows with missing values will not be added.</p>
        </div>

        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="csv_file" accept=".csv" required>
            <button type="submit">Upload CSV</button>
        </form>
        <p><a href="dashboard.php">Back to Dashboard</a></p>
    </div>

    <?php if (!empty($popupMessage)): ?>
        <script>
            alert("<?php echo addslashes($popupMessage); ?>");
        </script>
    <?php endif; ?>
</body>
</html>
