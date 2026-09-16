<?php
// logout.php
<<<<<<< HEAD
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
=======
session_start();
>>>>>>> d28c6cc0a801a4f3f5014f87350c57c95b381502

if (isset($_SESSION['id_user'])) {
    include 'config/koneksi.php';
    $id_user   = $_SESSION['id_user'];
    $waktu     = date('Y-m-d H:i:s');
<<<<<<< HEAD
    $log       = "INSERT INTO tbl_log (id_user, aktivitas, waktu) VALUES ('$id_user', 'Logout', '$waktu')";
=======
    $aktivitas = "Logout";
    $log       = "INSERT INTO tbl_log (id_user, aktivitas, waktu) VALUES ('$id_user', '$aktivitas', '$waktu')";
>>>>>>> d28c6cc0a801a4f3f5014f87350c57c95b381502
    mysqli_query($koneksi, $log);
}

session_unset();
session_destroy();

header('Location: login.php');
exit;