<?php
include 'db_connect.php';

$registrationSuccess = false;
$error = "";

if ($_POST) {
    $reg_no = $_POST['reg_no'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Password validation: min 8 chars, 1 uppercase, 1 symbol
    if (!preg_match("/^(?=.*[A-Z])(?=.*[\W]).{8,}$/", $password)) {
        $error = "Password must be at least 8 characters long, contain one uppercase letter and one symbol.";
    } 
    // Email validation
    elseif (!preg_match("/^[a-zA-Z0-9]+@stu\.vau\.ac\.lk$/", $email)) {
        $error = "Invalid email! Use your university email (e.g., name@stu.vau.ac.lk).";
    } 
    // Check for existing user
    else {
        $check_sql = "SELECT * FROM users WHERE reg_no='$reg_no' OR email='$email'";
        $check_result = $conn->query($check_sql);
        if ($check_result->num_rows > 0) {
            $error = "User already exists with this registration number or email.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (reg_no, email, password) VALUES ('$reg_no', '$email', '$hashed_password')";
            if ($conn->query($sql) === TRUE) {
                $registrationSuccess = true;
            } else {
                $error = "Error: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign Up - AlumSphere</title>
    <link rel="stylesheet" href="style.css">
    <style>
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

        .popup-success {
            background-color: #388e3c;
        }

        @keyframes fadeAndSlide {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<?php if (!empty($error)) : ?>
    <div class="popup-overlay">
        <div class="popup-message"><?php echo $error; ?></div>
    </div>
<?php elseif ($registrationSuccess) : ?>
    <div class="popup-overlay">
        <div class="popup-message popup-success">Registration successful! You can now <a href='signin.php' style="color: #fff; text-decoration: underline;">Sign In</a>.</div>
    </div>
<?php endif; ?>

<div class="container">
    <h1>AlumSphere</h1>
    <h2>Student Sign-Up</h2>
    <form action="" method="post">
        <input type="text" name="reg_no" placeholder="University Registration No" required>
        <input type="email" name="email" placeholder="University Email" required>
        <input type="password" name="password" placeholder="Create Password" required>
        <button type="submit">Register</button>
    </form>
    <p>Already registered? <a href="signin.php">Sign In</a></p>
</div>

<script>
    // Close popup after 3 seconds
    setTimeout(() => {
        const popup = document.querySelector('.popup-overlay');
        if (popup) popup.remove();
    }, 3000);
</script>

</body>
</html>
