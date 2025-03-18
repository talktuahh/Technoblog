<?php
session_start();
include __DIR__ . "/db.php";

if (!isset($_SESSION["user_id"]) && isset($_COOKIE["login_token"])) {
    $token = $_COOKIE["login_token"];

    $stmt = $conn->prepare("SELECT user_id, username FROM users WHERE login_token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $username);
        $stmt->fetch();

        $_SESSION["user_id"] = $user_id;
        $_SESSION["username"] = $username;
    }
}

$currentPage = basename($_SERVER['PHP_SELF']);
?>