<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['id_user'])) {
    header("Location: dashboard.php");
    exit;
}

header("Location: login.php");
exit;
?>