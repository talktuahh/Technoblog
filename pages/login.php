<?php
include "../includes/db.php";
session_start();

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
                echo "❌ Invalid password!";
            }
        } else {
            echo "❌ Username not found!";
        }
    } else {
        echo "❌ Both fields are required!";
    }
}
?>

<form action="login.php" method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>