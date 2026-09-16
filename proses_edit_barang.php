<?php
// proses_edit_barang.php
include 'includes/cek_session.php';
include 'config/koneksi.php';

$id    = $_POST['id_barang'];
$kode  = mysqli_real_escape_string($koneksi, $_POST['kode_barang']);
$nama  = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
$harga = $_POST['harga_satuan'];
$stok  = $_POST['stok'];
$exp   = $_POST['tanggal_kadaluarsa'];
$exp_sql = $exp === "" ? "NULL" : "'$exp'";

$sql = "UPDATE tbl_barang SET kode_barang='$kode', nama_barang='$nama', harga_satuan='$harga', stok='$stok', tanggal_kadaluarsa=$exp_sql WHERE id_barang='$id'";

if (mysqli_query($koneksi, $sql)) {
    $id_user   = $_SESSION['id_user'];
    $waktu     = date('Y-m-d H:i:s');
    $log       = "INSERT INTO tbl_log (id_user, aktivitas, waktu) VALUES ('$id_user', 'Edit barang: {$nama}', '$waktu')";
    mysqli_query($koneksi, $log);

    header('Location: data_barang.php');
    exit;
} else {
    echo "Gagal mengubah: " . mysqli_error($koneksi);
}