<?php
include "../includes/init.php";

if (isset($_GET['id'])) {
    $article_id = intval($_GET['id']);
    $sql = "SELECT article_title, article_author, article_date, article_category, article_cover, article_content 
            FROM articles WHERE article_id = ?";
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

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($article['article_title']); ?></title>
    <link rel="stylesheet" type="text/css" href="../assets/styles.css">
</head>
<body>

    <?php include '../includes/header.php'; ?>

    <div class="article-container">
        <div class="article-header">
            <img src="data:image/jpeg;base64,<?php echo base64_encode($article['article_cover']); ?>" alt="Artikelbild">
            <div class="article-meta">
                <h1><?php echo htmlspecialchars($article['article_title']); ?></h1>
                <div class="article-info">
                    <p><b>Author:</b> <?php echo htmlspecialchars($article['article_author']); ?></p>
                    <p><b>Date:</b> <?php echo htmlspecialchars($article['article_date']); ?></p>
                    <p><b>Category:</b> <?php echo htmlspecialchars($article['article_category']); ?></p>
                </div>
            </div>
        </div>
        <div class="article-content">
            <?php echo $article['article_content']; ?>
        </div>

        <div class="comment-section">
            <h2>Kommentare</h2>

            <?php if (isset($_SESSION["user_id"])): ?>
                <form action="add_comment.php" method="POST">
                    <input type="hidden" name="article_id" value="<?php echo $article_id; ?>">
                    <textarea name="comment_text" placeholder="Schreibe deinen Kommentar..." required></textarea>
                    <button type="submit">Kommentar Abschicken</button>
                </form>
            <?php else: ?>
                <p><a href="login.php">Melde dich an</a>, um einen Kommentar zu schreiben.</p>
            <?php endif; ?>

            <div class="comments">
                <?php
                $comment_sql = "SELECT users.username, comments.comment_text, comments.comment_date 
                                FROM comments 
                                JOIN users ON comments.user_id = users.user_id 
                                WHERE comments.article_id = ? 
                                ORDER BY comments.comment_date DESC";
                $comment_stmt = $conn->prepare($comment_sql);
                $comment_stmt->bind_param("i", $article_id);
                $comment_stmt->execute();
                $comment_result = $comment_stmt->get_result();

                if ($comment_result->num_rows > 0) {
                    while ($comment = $comment_result->fetch_assoc()) {
                        echo "<div class='comment'>";
                        echo "<b>" . htmlspecialchars($comment['username']) . "</b> (" . $comment['comment_date'] . ")";
                        echo "<p>" . htmlspecialchars($comment['comment_text']) . "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>Noch keine Kommentare.</p>";
                }
                ?>
            </div>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>
</html>
