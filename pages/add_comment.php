<?php
include "../includes/init.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION["user_id"])) {
        die("Fehler: Du musst angemeldet sein, um zu kommentieren.");
    }

    $user_id = $_SESSION["user_id"];
    $article_id = intval($_POST["article_id"]);
    $comment_text = trim($_POST["comment_text"]);

    if (!empty($comment_text)) {
        $stmt = $conn->prepare("INSERT INTO comments (article_id, user_id, comment_text) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $article_id, $user_id, $comment_text);

        if ($stmt->execute()) {
            header("Location: article.php?id=" . $article_id);
            exit();
        } else {
            echo "Fehler beim Speichern des Kommentars.";
        }
    } else {
        echo "Dein Kommentar darf nicht leer sein!";
    }
}
?>
