<?php
session_start();
include "../includes/db.php";

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
?>
<header>
    <link rel="stylesheet" type="text/css" href="../assets/styles.css">
    <?php $currentPage = basename($_SERVER['PHP_SELF']); ?>
    <?php if (isset($_SESSION["username"])): ?>
        <span>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</span>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    <?php endif; ?>
    <div class="header-container">
        <a href="../pages/main.php" class="logo">
            <img src="../assets/images/DataNautica_Logo.png" alt="Technoblog Logo">
            <h1>Technoblog</h1>
        </a>
        <nav class="nav-links">
            <a href="../pages/main.php" class="<?php echo ($currentPage == 'main.php') ? 'active' : ''; ?>">
                <button>Home Page</button>
            </a>
            <a href="../pages/hardware.php" class="<?php echo ($currentPage == 'hardware.php') ? 'active' : ''; ?>">
                <button>Hardware News</button>
            </a>
            <a href="../pages/software.php" class="<?php echo ($currentPage == 'software.php') ? 'active' : ''; ?>">
                <button>Software News</button>
            </a>
            <a href="../pages/lernen.php" class="<?php echo ($currentPage == 'lernen.php') ? 'active' : ''; ?>">
                <button>Coding Lernen</button>
            </a>
            <a href="../pages/community.php" class="<?php echo ($currentPage == 'community.php') ? 'active' : ''; ?>">
                <button>Community</button>
            </a>
        </nav>
    </div>
</header>