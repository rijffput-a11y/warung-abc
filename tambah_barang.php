<?php 
// tambah_barang.php
include 'includes/cek_session.php'; 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Barang - Warung ABC</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Tambah Barang</h2>
    <form action="proses_tambah_barang.php" method="POST">
        Kode Barang: <input type="text" name="kode_barang" required>
        Nama Barang: <input type="text" name="nama_barang" required>
        Harga Satuan: <input type="number" name="harga_satuan" step="0.01" required>
        Stok: <input type="number" name="stok" required>
        Tanggal Kadaluarsa: <input type="date" name="tanggal_kadaluarsa">
        <input type="submit" value="Simpan">
    </form>
    <p><a href="data_barang.php">Kembali</a></p>
</body>
</html>