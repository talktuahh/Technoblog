<header>
    <div class="header-container">
        <a href="../pages/main.php" class="logo">
            <img src="../assets/images/DataNautica_Logo.png" alt="Technoblog Logo">
            <h1>Technoblog</h1>
        </a>
        <?php if (isset($_SESSION["username"])): ?>
            <p>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</p>
        <?php endif; ?>
        <nav class="nav-links">
            <a href="../pages/main.php" class="<?php echo ($currentPage == 'main.php') ? 'active' : ''; ?>">
                <button>Home Page</button>
            </a>
            <a href="../pages/magazine.php" class="<?php echo ($currentPage == 'magazine.php') ? 'active' : ''; ?>">
                <button>Magazine</button>
            </a>
            <a href="../pages/lernen.php" class="<?php echo ($currentPage == 'lernen.php') ? 'active' : ''; ?>">
                <button>Coding Lernen</button>
            </a>
            <a href="../pages/community.php" class="<?php echo ($currentPage == 'community.php') ? 'active' : ''; ?>">
                <button>Community</button>
            </a>
        </nav>
        <div class="auth-buttons">
            <?php if (isset($_SESSION["username"])): ?>
                <a href="logout.php">
                    <button>Logout</button>
                </a>
            <?php else: ?>
                <a href="login.php">
                    <button>Login</button>
                </a>
                <a href="register.php">
                    <button>Register</button>
                </a>
            <?php endif; ?>
        </div>
    </div>
</header>