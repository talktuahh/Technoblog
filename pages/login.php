<?php
include "../includes/init.php";

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (!empty($username) && !empty($password)) {
        $stmt = $conn->prepare("SELECT user_id, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id, $hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                session_start();
                $_SESSION["user_id"] = $user_id;
                $_SESSION["username"] = $username;

                $token = bin2hex(random_bytes(32));
                setcookie("login_token", $token, time() + (30 * 24 * 60 * 60), "/", "", true, true);

                $stmt = $conn->prepare("UPDATE users SET login_token = ? WHERE user_id = ?");
                $stmt->bind_param("si", $token, $user_id);
                $stmt->execute();

                header("Location: main.php");
                exit();
            } else {
                $error_message = "❌ Invalid password!";
            }
        } else {
            $error_message = "❌ Username not found!";
        }
    } else {
        $error_message = "❌ Both fields are required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Technoblog</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>

<div class="login-container">
    <img src="../assets/images/DataNautica_Logo.png" alt="Technoblog Logo" class="login-logo">
    
    <form action="login.php" method="POST" class="login-form">
        <h2>Login</h2>

        <?php if (!empty($error_message)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" class="button">Login</button>

        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </form>
</div>
<?php include '../includes/footer.php'; ?>
</body>
</html>
