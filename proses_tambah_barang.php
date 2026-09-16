<?php
// proses_tambah_barang.php
include 'includes/cek_session.php';
include 'config/koneksi.php';

$kode  = mysqli_real_escape_string($koneksi, $_POST['kode_barang']);
$nama  = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
$harga = $_POST['harga_satuan'];
$stok  = $_POST['stok'];
$exp   = $_POST['tanggal_kadaluarsa'];
$exp_sql = $exp === "" ? "NULL" : "'$exp'";

$sql = "INSERT INTO tbl_barang (kode_barang, nama_barang, harga_satuan, stok, tanggal_kadaluarsa) 
        VALUES ('$kode', '$nama', '$harga', '$stok', $exp_sql)";

if (mysqli_query($koneksi, $sql)) {
    $id_user   = $_SESSION['id_user'];
    $waktu     = date('Y-m-d H:i:s');
    $log       = "INSERT INTO tbl_log (id_user, aktivitas, waktu) VALUES ('$id_user', 'Tambah barang: {$nama}', '$waktu')";
    mysqli_query($koneksi, $log);

    header('Location: data_barang.php');
    exit;
} else {
    echo "Gagal menyimpan: " . mysqli_error($koneksi);
}