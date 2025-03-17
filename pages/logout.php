<?php
session_start();
session_unset();
session_destroy();

setcookie("login_token", "", time() - 3600, "/");

header("Location: main.php");
exit();
?>
