<?php
include "../includes/init.php";

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    if (!empty($username) && !empty($password) && !empty($confirm_password)) {
        if ($password !== $confirm_password) {
            $error_message = "❌ Passwords do not match!";
        } else {
            $stmt = $conn->prepare("SELECT user_id FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $error_message = "❌ Username already taken!";
            } else {
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
                $stmt->bind_param("ss", $username, $hashed_password);
                
                if ($stmt->execute()) {
                    header("Location: login.php?success=registered");
                    exit();
                } else {
                    $error_message = "❌ Something went wrong, please try again.";
                }
            }
        }
    } else {
        $error_message = "❌ All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Technoblog</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>

<div class="login-container">
    <img src="../assets/images/DataNautica_Logo.png" alt="Technoblog Logo" class="login-logo">
    
    <form action="register.php" method="POST" class="login-form">
        <h2>Register</h2>

        <?php if (!empty($error_message)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <label for="confirm_password">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" required>

        <button type="submit" class="button">Register</button>

        <p>Already have an account? <a href="login.php">Login here</a></p>
    </form>
</div>
<?php include '../includes/footer.php'; ?>
</body>
</html>
