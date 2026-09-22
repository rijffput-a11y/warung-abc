<?php include 'includes/cek_session.php'; ?>
<!DOCTYPE html>
<html>
<head><title>Dashboard</title><link rel="stylesheet" href="style.css"></head>
<body>
    <h1>Selamat Datang, <?php echo $_SESSION['nama_lengkap']; ?>!</h1>
    <p>Role: <strong><?php echo strtoupper($_SESSION['role']); ?></strong></p>

    <div class="card-container">
        <?php if (in_array($_SESSION['role'], ['admin', 'gudang'])) { ?>
            <div class="card"><h3>📦 Inventaris</h3><a href="data_barang.php">Data Barang</a></div>
        <?php } ?>
        <?php if (in_array($_SESSION['role'], ['admin', 'kasir'])) { ?>
            <div class="card"><h3>🛒 Transaksi</h3><a href="transaksi.php">Kasir</a></div>
            <div class="card"><h3>📜 Riwayat</h3><a href="riwayat_transaksi.php">Riwayat</a></div>
            <div class="card"><h3>👥 Pelanggan</h3><a href="data_pelanggan.php">Pelanggan</a></div>
            <div class="card"><h3>📊 Laporan</h3><a href="laporan_harian.php">Harian</a> | <a href="laporan_bulanan.php">Bulanan</a></div>
        <?php } ?>
    </div>

    <br><a href="logout.php" style="color:#c53030;">🚪 Logout</a>
</body>
</html>