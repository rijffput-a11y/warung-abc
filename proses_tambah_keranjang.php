<?php

include 'includes/cek_session.php';
include 'config/koneksi.php';

if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = array();
}

$id_barang = (int) $_POST['id_barang'];
$jumlah = (int) $_POST['jumlah'];

if ($jumlah < 1) {
    $_SESSION['pesan_error'] =
        "Jumlah barang tidak valid.";

    header("Location: transaksi.php");
    exit;
}

$sql = "SELECT * FROM tbl_barang
        WHERE id_barang='$id_barang'
        LIMIT 1";

$hasil = mysqli_query($koneksi, $sql);

if (!$hasil || mysqli_num_rows($hasil) == 0) {

    $_SESSION['pesan_error'] =
        "Barang tidak ditemukan.";

    header("Location: transaksi.php");
    exit;
}

$barang = mysqli_fetch_assoc($hasil);

if ($jumlah > $barang['stok']) {

    $_SESSION['pesan_error'] =
        "Jumlah melebihi stok barang.";

    header("Location: transaksi.php");
    exit;
}

$subtotal =
    $barang['harga_satuan'] * $jumlah;

$_SESSION['keranjang'][$id_barang] = array(
    'nama_barang' => $barang['nama_barang'],
    'harga' => $barang['harga_satuan'],
    'jumlah' => $jumlah,
    'subtotal' => $subtotal
);

header("Location: transaksi.php");
exit;
?>