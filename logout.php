<?php
// logout.php
session_start();

if (isset($_SESSION['id_user'])) {
    include 'config/koneksi.php';
    $id_user   = $_SESSION['id_user'];
    $waktu     = date('Y-m-d H:i:s');
    $aktivitas = "Logout";
    $log       = "INSERT INTO tbl_log (id_user, aktivitas, waktu) VALUES ('$id_user', '$aktivitas', '$waktu')";
    mysqli_query($koneksi, $log);
}

session_unset();
session_destroy();

header('Location: login.php');
exit;
?>