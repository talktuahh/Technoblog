<?php
    $backgroundImage = "../assets/images/vaporwave.png";
?>
<style>
    body {
        background-image: url('<?php echo $backgroundImage; ?>');
        background-repeat: repeat;
        background-size: 1500px 1500px;
        color: white;
    }
    header {
        
        color: white;
        padding: 20px;
    }
</style>

<header>
    <link rel="stylesheet" type="text/css" href="../assets/styles.css">
    <?php $currentPage = basename($_SERVER['PHP_SELF']); ?>
    <div class="header-container">
        <a href="../pages/main.php" class="logo">
            <img src="../assets/images/DataNautica_Logo.png" alt="Technoblog Logo" width="100">
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