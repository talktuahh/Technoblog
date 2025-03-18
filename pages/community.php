<?php
session_start();
include "../includes/db.php";

$sql = "SELECT comments.comment_text, comments.comment_date, users.username, 
               articles.article_title, articles.article_id 
        FROM comments 
        JOIN users ON comments.user_id = users.user_id 
        JOIN articles ON comments.article_id = articles.article_id 
        ORDER BY comments.comment_date DESC";

$result = $conn->query($sql);
?>

<html>
    <head>
        <title>Technoblog - Community</title>
        <?php include '../includes/header.php'; ?>
    </head>
    <body style="color: white;">
        <h1><b>community page</b></h1>
        <div class="comment-section">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
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
                <p>No comments yet. Be the first to comment!</p>
            <?php endif; ?>
        </div>
    </body>
</html>