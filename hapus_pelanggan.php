<?php
// hapus_pelanggan.php
<<<<<<< HEAD
=======
session_start();
>>>>>>> d28c6cc0a801a4f3f5014f87350c57c95b381502
include 'includes/cek_session.php';
include 'config/koneksi.php';

$id      = $_GET['id'];
$sql_cek = "SELECT nama_pelanggan FROM tbl_pelanggan WHERE id_pelanggan = '$id'";
$res     = mysqli_query($koneksi, $sql_cek);
$data    = mysqli_fetch_assoc($res);

$sql = "DELETE FROM tbl_pelanggan WHERE id_pelanggan = '$id'";

if (mysqli_query($koneksi, $sql)) {
    $id_user   = $_SESSION['id_user'];
    $waktu     = date('Y-m-d H:i:s');
    $aktivitas = "Hapus pelanggan: " . $data['nama_pelanggan'];
    $log       = "INSERT INTO tbl_log (id_user, aktivitas, waktu) VALUES ('$id_user', '$aktivitas', '$waktu')";
    mysqli_query($koneksi, $log);

    header('Location: data_pelanggan.php');
    exit;
<<<<<<< HEAD
}
=======
}
?>
>>>>>>> d28c6cc0a801a4f3f5014f87350c57c95b381502
