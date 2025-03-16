<?php
    include "../includes/db.php";
    if (isset($_GET['id'])) {
        $article_id = intval($_GET['id']);
        $sql = "SELECT article_title, article_text, article_cover FROM articles WHERE article_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $article_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $article = $result->fetch_assoc();
        } else {
            die("Artikel nicht gefunden.");
        }
    } else {
        die("Keine Artikel-ID angegeben.");
    }
?>
<html>
    <head>
        <title><?php echo htmlspecialchars($article['article_title']); ?></title>
        <?php include '../includes/header.php'; ?>
    </head>
    <body>
        <h1><?php echo htmlspecialchars($article['article_title']); ?></h1>
        <p><?php echo nl2br(htmlspecialchars($article['article_text'])); ?></p>
        <?php if (!empty($article['article_cover'])): ?>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($article['article_cover']); ?>" 
                alt="Artikelbild" width="400"><br>
        <?php endif; ?>
    </body>
</html>