<?php
session_start();
include 'includes/cek_session.php';
include 'config/koneksi.php';

$id_barang = $_POST['id_barang'];
$jumlah = $_POST['jumlah'];

// Ambil data barang
$q = mysqli_query($koneksi, "SELECT * FROM tbl_barang WHERE id_barang = '$id_barang'");
$barang = mysqli_fetch_assoc($q);

// Cek stok
if ($jumlah > $barang['stok']) {
    $_SESSION['pesan_error'] = 'Stok tidak cukup!';
    header('Location: transaksi.php');
    exit;
}

$subtotal = $barang['harga_satuan'] * $jumlah;

// Simpan ke session pakai id_barang sebagai key
$_SESSION['keranjang'][$id_barang] = [
    'id_barang' => $id_barang,
    'nama_barang' => $barang['nama_barang'],
    'harga' => $barang['harga_satuan'],
    'jumlah' => $jumlah,
    'subtotal' => $subtotal
];

header('Location: transaksi.php');
exit;
?>