<?php
include 'includes/cek_session.php';
include 'config/koneksi.php';
$id   = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT nama_barang FROM tbl_barang WHERE id_barang = '$id'"));

if (mysqli_query($koneksi, "DELETE FROM tbl_barang WHERE id_barang = '$id'")) {
    $id_user = $_SESSION['id_user'];
    $waktu   = date('Y-m-d H:i:s');
    mysqli_query($koneksi, "INSERT INTO tbl_log (id_user, aktivitas, waktu) VALUES ('$id_user', 'Hapus barang: " . $data['nama_barang'] . "', '$waktu')");
    header('Location: data_barang.php');
    exit;
}
?>