<?php
    $backgroundImage = "vaporwave.png"; // Hier kannst du den Pfad ändern
?>
<style>
    body {
        background-image: url('<?php echo $backgroundImage; ?>');
        background-repeat: repeat; /* Wiederholt das Bild */
        background-size: 1500px 1500px; /* Standardgröße */
        color: white;
    }
    header {
        
        color: white;
        padding: 20px;
    }
</style>

<header>
    <h1><b>Technoblog</b></h1>
        <a href="main.php"><button>Home Page</button></a>
        <a href="hardware.php"><button>Hardware News</button></a>
        <a href="software.php"><button>Software & Tools</button></a>
        <a href="lernen.php"><button>Programmieren Lernen</button></a>
        <a href="community.php"><button>Community</button></a>
</header>