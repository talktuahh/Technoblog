<?php
include "../includes/init.php";

$sql = "SELECT * FROM articles ORDER BY article_date DESC LIMIT 4";
$result = $conn->query($sql);
$articles = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $articles[] = $row;
    }
}

$comment_sql = "SELECT comments.comment_text, comments.comment_date, users.username, 
                       articles.article_title, articles.article_id 
                FROM comments 
                JOIN users ON comments.user_id = users.user_id 
                JOIN articles ON comments.article_id = articles.article_id 
                ORDER BY comments.comment_date DESC 
                LIMIT 3";
$comment_result = $conn->query($comment_sql);

$trending_sql = "SELECT * FROM articles WHERE article_tag LIKE '%trending%' ORDER BY article_date DESC LIMIT 4";
$trending_result = $conn->query($trending_sql);

$mustread_sql = "SELECT * FROM articles WHERE article_tag LIKE '%must-read%' ORDER BY article_date DESC LIMIT 4";
$mustread_result = $conn->query($mustread_sql);
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

        <div class="comment-section">
            <h2>Neueste Kommentare</h2>
            <?php if ($comment_result->num_rows > 0): ?>
                <?php while ($row = $comment_result->fetch_assoc()): ?>
                    <div class="comment">
                        <b><?php echo htmlspecialchars($row["username"]); ?>:</b>
                        <p><?php echo nl2br(htmlspecialchars($row["comment_text"])); ?></p>
                        <small><?php echo $row["comment_date"]; ?> | 
                            <a href="article.php?id=<?php echo $row['article_id']; ?>">
                                Read Article: <?php echo htmlspecialchars($row["article_title"]); ?>
                            </a>
                        </small>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Keine Kommentare vorhanden.</p>
            <?php endif; ?>
        </div>

        <div class="magazine-container">
            <h2>🔥 Trending Artikel</h2>
            <?php if ($trending_result->num_rows > 0): ?>
                <?php while ($article = $trending_result->fetch_assoc()): ?>
                    <div class="article-row">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($article['article_cover']); ?>" alt="Artikelbild">
                        <div class="article-text">
                            <h2><a href="article.php?id=<?php echo $article['article_id']; ?>">
                                <?php echo htmlspecialchars($article['article_title']); ?>
                            </a></h2>
                            <div class="article-info">
                                <p><b>Author:</b> <?php echo htmlspecialchars($article['article_author']); ?> | 
                                <b>Date:</b> <?php echo htmlspecialchars($article['article_date']); ?> |
                                <b>Category:</b> <?php echo htmlspecialchars($article['article_category']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Keine trending Artikel.</p>
            <?php endif; ?>
        </div>

        <div class="magazine-container">
            <h2>📖 Must-Read Artikel</h2>
            <?php if ($mustread_result->num_rows > 0): ?>
                <?php while ($article = $mustread_result->fetch_assoc()): ?>
                    <div class="article-row">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($article['article_cover']); ?>" alt="Artikelbild">
                        <div class="article-text">
                            <h2><a href="article.php?id=<?php echo $article['article_id']; ?>">
                                <?php echo htmlspecialchars($article['article_title']); ?>
                            </a></h2>
                            <div class="article-info">
                                <p><b>Author:</b> <?php echo htmlspecialchars($article['article_author']); ?> | 
                                <b>Date:</b> <?php echo htmlspecialchars($article['article_date']); ?> |
                                <b>Category:</b> <?php echo htmlspecialchars($article['article_category']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Keine must-read Artikel.</p>
            <?php endif; ?>
        </div>

        </div>
        <?php include '../includes/footer.php'; ?>
    </body>
</html>
