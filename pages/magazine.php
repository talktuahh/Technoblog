<?php
include "../includes/init.php";

$category = isset($_GET['category']) ? $_GET['category'] : 'all';

if ($category === 'all') {
    $sql = "SELECT article_id, article_title, article_author, article_date, article_category, article_cover 
            FROM articles ORDER BY article_id DESC";
} else {
    $sql = "SELECT article_id, article_title, article_author, article_date, article_category, article_cover 
            FROM articles WHERE article_category = ? ORDER BY article_id DESC";
}

$stmt = $conn->prepare($sql);
if ($category !== 'all') {
    $stmt->bind_param("s", $category);
}
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Technoblog - Magazine</title>
    <link rel="stylesheet" type="text/css" href="../assets/styles.css">
</head>
<body>

    <?php include '../includes/header.php'; ?>

    <div class="magazine-container">
        <h1>Magazine Articles</h1>
        <p>Hier findest du eine filtrierbare Liste von allen unseren Artikeln.</p>
        <div class="category-filters">
            <a href="magazine.php?category=all" class="<?php echo ($category === 'all') ? 'active' : ''; ?>">
                <button>All Articles</button>
            </a>
            <a href="magazine.php?category=Hardware" class="<?php echo ($category === 'Hardware') ? 'active' : ''; ?>">
                <button>Hardware</button>
            </a>
            <a href="magazine.php?category=Gaming" class="<?php echo ($category === 'Gaming') ? 'active' : ''; ?>">
                <button>Gaming</button>
            </a>
        </div>

        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($article = $result->fetch_assoc()): ?>
                <div class="article-row">
                    <a href="article.php?id=<?php echo $article['article_id']; ?>">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($article['article_cover']); ?>" alt="Artikelbild">
                    </a>
                    <div class="article-text">
                        <h2>
                            <a href="article.php?id=<?php echo $article['article_id']; ?>">
                                <?php echo htmlspecialchars($article['article_title']); ?>
                            </a>
                        </h2>
                        <p class="article-meta">
                            <b>Author:</b> <?php echo htmlspecialchars($article['article_author']); ?> | 
                            <b>Date:</b> <?php echo htmlspecialchars($article['article_date']); ?> | 
                            <b>Category:</b> <?php echo htmlspecialchars($article['article_category']); ?>
                        </p>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No articles found in this category.</p>
        <?php endif; ?>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>
</html>
