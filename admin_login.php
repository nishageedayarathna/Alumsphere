<?php
include 'db_connect.php';
session_start();

if ($_POST) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admins WHERE username='$username'";
    $result = $conn->query($sql);
    $admin = $result->fetch_assoc();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin'] = $admin;
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $error = "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login - AlumSphere</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Popup overlay for error */
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.3);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .popup-message {
            background-color: #d32f2f;
            color: white;
            padding: 20px 30px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
            animation: fadeAndSlide 0.4s ease-out;
        }

        @keyframes fadeAndSlide {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

<?php if (isset($error)) : ?>
    <div class="popup-overlay">
        <div class="popup-message">
            <?php echo $error; ?>
        </div>
    </div>
<?php endif; ?>

<div class="container">
    <h1>AlumSphere</h1>
    <h2>Admin Login</h2>
    <form action="" method="post">
        <input type="text" name="username" placeholder="Admin Username" required>
        <input type="password" name="password" placeholder="Admin Password" required>
        <button type="submit">Login</button>
    </form>
</div>

<script>
    // Auto-close popup after 3 seconds
    setTimeout(() => {
        const popup = document.querySelector('.popup-overlay');
        if (popup) popup.remove();
    }, 3000);
</script>

</body>
</html>
