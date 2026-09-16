<?php
// hapus_barang.php
include 'includes/cek_session.php';
include 'config/koneksi.php';

$id   = $_GET['id'];
$res  = mysqli_query($koneksi, "SELECT nama_barang FROM tbl_barang WHERE id_barang = '$id'");
$data = mysqli_fetch_assoc($res);

$sql = "DELETE FROM tbl_barang WHERE id_barang = '$id'";

if (mysqli_query($koneksi, $sql)) {
    $id_user   = $_SESSION['id_user'];
    $waktu     = date('Y-m-d H:i:s');
    $log       = "INSERT INTO tbl_log (id_user, aktivitas, waktu) VALUES ('$id_user', 'Hapus barang: " . $data['nama_barang'] . "', '$waktu')";
    mysqli_query($koneksi, $log);

    header('Location: data_barang.php');
    exit;
}