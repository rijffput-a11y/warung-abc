<<<<<<< HEAD
<?php 
// tambah_pelanggan.php
include 'includes/cek_session.php'; 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pelanggan - Warung ABC</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
=======
<!-- tambah_pelanggan.php -->
<?php include 'includes/cek_session.php'; ?>
<!DOCTYPE html>
<html>
<head><title>Tambah Pelanggan - Warung ABC</title></head>
>>>>>>> d28c6cc0a801a4f3f5014f87350c57c95b381502
<body>
    <h2>Tambah Pelanggan</h2>
    <form action="proses_tambah_pelanggan.php" method="POST">
        <table>
            <tr><td>Nama Pelanggan</td><td><input type="text" name="nama_pelanggan" required></td></tr>
            <tr><td>No. HP</td><td><input type="text" name="no_hp"></td></tr>
            <tr><td>Alamat</td><td><input type="text" name="alamat"></td></tr>
            <tr><td colspan="2"><input type="submit" value="Simpan"></td></tr>
        </table>
    </form>
    <p><a href="data_pelanggan.php">Kembali</a></p>
</body>
</html>