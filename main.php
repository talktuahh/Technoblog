<?php
    include "db.php";
    $sql = "SELECT * FROM articles";
    $result = $conn->query($sql);
?>

<html>
    <head>
        <title>Technoblog - Home</title>
        <?php include 'header.php'; ?>
    </head>
    <body>
        <h1><b>Main Page</b></h1>
        <ul>
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<a href="article.php?id=' . $row['article_id'] . '">';
                echo '<button>' . htmlspecialchars($row['article_title']) . '</button>';
                echo '</a><br>';
            }
        } else {
            echo "<p>Keine Artikel gefunden.</p>";
        }
        ?>
    </ul>
    </body>
</html>