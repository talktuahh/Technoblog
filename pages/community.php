<?php
include "../includes/init.php";

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
    <link rel="stylesheet" type="text/css" href="../assets/styles.css">
</head>
<body>
    
    <?php include '../includes/header.php'; ?>

    <div class="magazine-container">
        <h1><b>Community Page</b></h1>
        <p>Hier findest du alle neuste Kommentare von unseren lieben Community.</p>
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
    </div>

    <?php include '../includes/footer.php'; ?>

</body>
</html>
