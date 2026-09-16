<?php
// dashboard.php
include 'includes/cek_session.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Warung ABC</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Selamat Datang, <?php echo $_SESSION['nama_lengkap']; ?>!</h1>
    <p>Status Login: <strong><?php echo strtoupper($_SESSION['role']); ?></strong></p>

    <div class="card-container">
        <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'gudang') { ?>
            <div class="card">
                <h3>📦 Inventaris</h3>
                <p>Kelola stok & data barang</p>
                <a href="data_barang.php">Buka Data Barang</a>
            </div>
        <?php } ?>

        <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'kasir') { ?>
            <div class="card">
                <h3>🛒 Transaksi</h3>
                <p>Proses penjualan kasir</p>
                <a href="transaksi.php">Mulai Transaksi</a>
            </div>
            <div class="card">
                <h3>📜 Riwayat</h3>
                <p>Cetak struk & histori</p>
                <a href="riwayat_transaksi.php">Lihat Riwayat</a>
            </div>
            <div class="card">
                <h3>👥 Pelanggan</h3>
                <p>Data member warung</p>
                <a href="data_pelanggan.php">Data Pelanggan</a>
            </div>
            <div class="card">
                <h3>📊 Laporan</h3>
                <p>Rekap harian & bulanan</p>
                <a href="laporan_harian.php">Harian</a> | 
                <a href="laporan_bulanan.php">Bulanan</a>
            </div>
        <?php } ?>
    </div>

    <br><br>
    <p><a href="logout.php" style="color:#c53030;">🚪 Logout dari Sistem</a></p>
</body>
</html>