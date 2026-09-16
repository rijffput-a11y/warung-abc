<?php
// logout.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['id_user'])) {
    include 'config/koneksi.php';
    $id_user   = $_SESSION['id_user'];
    $waktu     = date('Y-m-d H:i:s');
    $log       = "INSERT INTO tbl_log (id_user, aktivitas, waktu) VALUES ('$id_user', 'Logout', '$waktu')";
    mysqli_query($koneksi, $log);
}

session_unset();
session_destroy();

header('Location: login.php');
exit;