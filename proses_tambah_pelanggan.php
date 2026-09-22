<?php
include 'includes/cek_session.php';
include 'config/koneksi.php';

$nama   = mysqli_real_escape_string($koneksi, $_POST['nama_pelanggan']);
$hp     = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
$alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

if (mysqli_query($koneksi, "INSERT INTO tbl_pelanggan (nama_pelanggan, no_hp, alamat) VALUES ('$nama', '$hp', '$alamat')")) {
    $id_user = $_SESSION['id_user'];
    $waktu   = date('Y-m-d H:i:s');
    mysqli_query($koneksi, "INSERT INTO tbl_log (id_user, aktivitas, waktu) VALUES ('$id_user', 'Tambah pelanggan: {$nama}', '$waktu')");
    header('Location: data_pelanggan.php');
    exit;
} else { echo "Gagal: " . mysqli_error($koneksi); }
?>