<?php

include 'includes/cek_session.php';
include 'config/koneksi.php';

/*
|--------------------------------------------------------------------------
| SESSION
|--------------------------------------------------------------------------
| Gunakan fallback agar tidak muncul:
| Undefined array key "level"
|--------------------------------------------------------------------------
*/

$nama_lengkap = $_SESSION['nama_lengkap'] ?? 'User';
$level = $_SESSION['level'] ?? 'admin';


/*
|--------------------------------------------------------------------------
| DATA DASHBOARD
|--------------------------------------------------------------------------
*/

$jumlah_barang = 0;
$jumlah_pelanggan = 0;
$jumlah_transaksi = 0;
$total_pendapatan = 0;


/*
|--------------------------------------------------------------------------
| JUMLAH BARANG
|--------------------------------------------------------------------------
*/

$q_barang = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total FROM tbl_barang"
);

if ($q_barang) {
    $data_barang = mysqli_fetch_assoc($q_barang);
    $jumlah_barang = $data_barang['total'] ?? 0;
}


/*
|--------------------------------------------------------------------------
| JUMLAH PELANGGAN
|--------------------------------------------------------------------------
*/

$q_pelanggan = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total FROM tbl_pelanggan"
);

if ($q_pelanggan) {
    $data_pelanggan = mysqli_fetch_assoc($q_pelanggan);
    $jumlah_pelanggan = $data_pelanggan['total'] ?? 0;
}


/*
|--------------------------------------------------------------------------
| JUMLAH TRANSAKSI
|--------------------------------------------------------------------------
*/

$q_transaksi = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total FROM tbl_transaksi"
);

if ($q_transaksi) {
    $data_transaksi = mysqli_fetch_assoc($q_transaksi);
    $jumlah_transaksi = $data_transaksi['total'] ?? 0;
}


/*
|--------------------------------------------------------------------------
| TOTAL PENDAPATAN
|--------------------------------------------------------------------------
*/

$q_pendapatan = mysqli_query(
    $koneksi,
    "SELECT COALESCE(SUM(total_bayar),0) AS total
     FROM tbl_transaksi"
);

if ($q_pendapatan) {
    $data_pendapatan = mysqli_fetch_assoc($q_pendapatan);
    $total_pendapatan = $data_pendapatan['total'] ?? 0;
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard - Warung ABC</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="layout">

    <aside class="sidebar">

        <div class="logo">
            WARUNG ABC
        </div>

        <div class="user-box">

            <strong>
                <?php echo htmlspecialchars($nama_lengkap); ?>
            </strong>

            <small>
                <?php echo htmlspecialchars($level); ?>
            </small>

        </div>

        <nav>

            <a href="dashboard.php" class="active">
                🏠 Dashboard
            </a>

            <a href="transaksi.php">
                🛒 Transaksi
            </a>

            <a href="pelanggan.php">
                👥 Data Pelanggan
            </a>

            <a href="barang.php">
                📦 Data Barang
            </a>

            <a href="riwayat_transaksi.php">
                📋 Riwayat Transaksi
            </a>

            <div class="menu-title">
                LAPORAN
            </div>

            <a href="laporan.php?jenis=harian">
                📅 Laporan Harian
            </a>

            <a href="laporan.php?jenis=bulanan">
                📊 Laporan Bulanan
            </a>

            <a href="logout.php" class="logout">
                🚪 Logout
            </a>

        </nav>

    </aside>


    <main class="content">

        <div class="topbar">

            <div>

                <h1>Dashboard</h1>

                <p>
                    Selamat datang,
                    <?php echo htmlspecialchars($nama_lengkap); ?>
                </p>

            </div>

        </div>


        <div class="cards">


            <div class="card blue">

                <div>

                    <span>Data Barang</span>

                    <strong>
                        <?php echo $jumlah_barang; ?>
                    </strong>

                </div>

                <div class="card-icon">
                    📦
                </div>

            </div>


            <div class="card green">

                <div>

                    <span>Pelanggan</span>

                    <strong>
                        <?php echo $jumlah_pelanggan; ?>
                    </strong>

                </div>

                <div class="card-icon">
                    👥
                </div>

            </div>


            <div class="card orange">

                <div>

                    <span>Transaksi</span>

                    <strong>
                        <?php echo $jumlah_transaksi; ?>
                    </strong>

                </div>

                <div class="card-icon">
                    🛒
                </div>

            </div>


            <div class="card purple">

                <div>

                    <span>Pendapatan</span>

                    <strong>

                        Rp <?php

                        echo number_format(
                            $total_pendapatan,
                            0,
                            ',',
                            '.'
                        );

                        ?>

                    </strong>

                </div>

                <div class="card-icon">
                    💰
                </div>

            </div>


        </div>


        <div class="dashboard-grid">


            <div class="panel">

                <h2>Menu Cepat</h2>

                <div class="quick-menu">


                    <a href="transaksi.php">

                        🛒

                        <span>
                            Transaksi Baru
                        </span>

                    </a>


                    <a href="pelanggan.php">

                        👥

                        <span>
                            Kelola Pelanggan
                        </span>

                    </a>


                    <a href="barang.php">

                        📦

                        <span>
                            Kelola Barang
                        </span>

                    </a>


                    <a href="laporan.php?jenis=harian">

                        📅

                        <span>
                            Laporan Harian
                        </span>

                    </a>


                    <a href="laporan.php?jenis=bulanan">

                        📊

                        <span>
                            Laporan Bulanan
                        </span>

                    </a>


                    <a href="riwayat_transaksi.php">

                        📋

                        <span>
                            Riwayat Transaksi
                        </span>

                    </a>


                </div>

            </div>


            <div class="panel">

                <h2>Informasi Sistem</h2>

                <p>

                    Sistem Warung ABC digunakan untuk
                    mengelola transaksi penjualan,
                    pelanggan, barang, stok dan laporan.

                </p>

                <p>

                    Gunakan menu di sebelah kiri untuk
                    mengakses setiap fitur.

                </p>

            </div>


        </div>

    </main>

</div>

</body>
</html>