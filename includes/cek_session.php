<?php
// includes/cek_session.php
<<<<<<< HEAD
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
=======
session_start();
>>>>>>> d28c6cc0a801a4f3f5014f87350c57c95b381502

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('Location: login.php');
    exit;
}