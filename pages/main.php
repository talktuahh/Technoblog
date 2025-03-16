<?php
    include "../includes/db.php";
    $sql = "SELECT * FROM articles ORDER BY article_id DESC";
    $result = $conn->query($sql);
    $articles = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $articles[] = $row;
        }
    }
?>

<html>
    <head>
        <title>Technoblog - Home</title>
        <?php include '../includes/header.php'; ?>
    </head>
    <body>
        <h1><b>Main Page</b></h1>
        <ul>
        <?php if (!empty($articles)): ?>
            <?php $firstArticle = array_shift($articles); ?>
            <div class="latest-article">
                <h2><?php echo htmlspecialchars($firstArticle['article_title']); ?></h2>
                <a href="article.php?id=<?php echo $firstArticle['article_id']; ?>">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($firstArticle['article_cover']); ?>" 
                         alt="Neuester Artikel">
                </a>
            </div>
            <div class="article-list">
                <?php foreach ($articles as $article): ?>
                    <div class="article-item">
                        <a href="article.php?id=<?php echo $article['article_id']; ?>">
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($article['article_cover']); ?>" 
                                 alt="Artikelbild">
                        </a>
                        <h3><?php echo htmlspecialchars($article['article_title']); ?></h3>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Keine Artikel gefunden.</p>
        <?php endif; ?>
    </ul>
    </body>
</html>