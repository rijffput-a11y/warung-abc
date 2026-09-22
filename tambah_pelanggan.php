<?php include 'includes/cek_session.php'; ?>
<!DOCTYPE html>
<html>
<head><title>Tambah Pelanggan</title><link rel="stylesheet" href="style.css"></head>
<body>
    <h2>Tambah Pelanggan</h2>
    <form action="proses_tambah_pelanggan.php" method="POST">
        Nama Pelanggan: <input type="text" name="nama_pelanggan" required>
        No. HP: <input type="text" name="no_hp">
        Alamat: <input type="text" name="alamat">
        <input type="submit" value="Simpan">
    </form>
    <p><a href="data_pelanggan.php">Kembali</a></p>
</body>
</html>