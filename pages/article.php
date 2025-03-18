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

<?php
session_start();
include "../includes/db.php";

$article_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["user_id"])) {
    $comment_text = trim($_POST["comment"]);
    $user_id = $_SESSION["user_id"];

    if (!empty($comment_text)) {
        $stmt = $conn->prepare("INSERT INTO comments (article_id, user_id, comment_text) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $article_id, $user_id, $comment_text);
        $stmt->execute();
        header("Location: article.php?id=" . $article_id);
        exit();
    }
}

$stmt = $conn->prepare("SELECT comments.comment_text, comments.comment_date, users.username 
                        FROM comments 
                        JOIN users ON comments.user_id = users.user_id 
                        WHERE comments.article_id = ? 
                        ORDER BY comments.comment_date DESC");
$stmt->bind_param("i", $article_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<html>
    <head>
        <title><?php echo htmlspecialchars($article['article_title']); ?></title>
        <?php include '../includes/header.php'; ?>
    </head>
    <body style="color: white;">
        <h2><?php echo htmlspecialchars($article['article_title']); ?></h2>
        <p><?php echo nl2br(htmlspecialchars($article['article_text'])); ?></p>
        <?php if (!empty($article['article_cover'])): ?>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($article['article_cover']); ?>" 
                alt="Artikelbild" width="400"><br>
        <?php endif; ?>
        <h2>Comments</h2>

        <?php if (isset($_SESSION["user_id"])): ?>
            <form method="post">
                <textarea name="comment" placeholder="Write a comment..." required></textarea>
                <button type="submit">Submit</button>
            </form>
        <?php else: ?>
            <p><a href="login.php">Login</a> to leave a comment.</p>
        <?php endif; ?>

        <div class="comment-section">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="comment">
                    <p><?php echo htmlspecialchars($row["username"]); ?>:</p>
                    <p><?php echo nl2br(htmlspecialchars($row["comment_text"])); ?></p>
                    <small><?php echo $row["comment_date"]; ?></small>
                    <br><br>
                </div>
            <?php endwhile; ?>
        </div>
    </body>
</html>




