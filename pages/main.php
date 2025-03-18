<?php
    include "../includes/init.php";
    $sql = "SELECT * FROM articles ORDER BY article_id DESC LIMIT 4";
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
        <link rel="stylesheet" type="text/css" href="../assets/styles.css">
    </head>
    <body>
        <?php include '../includes/header.php'; ?>
        <div class="main-container">
        <?php if (!empty($articles)): ?>
            <?php $firstArticle = array_shift($articles); ?>
            <div class="latest-article">
                <a href="article.php?id=<?php echo $firstArticle['article_id']; ?>">
                <h1><?php echo htmlspecialchars($firstArticle['article_title']); ?></h1>
                <img src="data:image/jpeg;base64,<?php echo base64_encode($firstArticle['article_cover']); ?>" alt="Neuester Artikel">
                </a>
            </div>
            <div class="article-list">
                <?php foreach ($articles as $article): ?>
                    <div class="article-item">
                        <a href="article.php?id=<?php echo $article['article_id']; ?>">
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($article['article_cover']); ?>" 
                                 alt="Artikelbild">
                            <h2><?php echo htmlspecialchars($article['article_title']); ?></h2>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Keine Artikel gefunden.</p>
        <?php endif; ?>
        </div>
        <?php include '../includes/footer.php'; ?>
    </body>
</html>