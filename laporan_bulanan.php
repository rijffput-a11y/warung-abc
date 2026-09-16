<?php
// laporan_bulanan.php
include 'includes/cek_session.php';
include 'config/koneksi.php';

$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('Y-m');
$bulan = mysqli_real_escape_string($koneksi, $bulan);

$sql = "SELECT t.no_transaksi, t.tanggal, t.total_bayar, u.nama_lengkap AS nama_kasir 
        FROM tbl_transaksi t JOIN tbl_user u ON t.id_user = u.id_user 
        WHERE DATE_FORMAT(t.tanggal, '%Y-%m') = '$bulan' ORDER BY t.tanggal ASC";
$hasil = mysqli_query($koneksi, $sql);

$total_bulanan    = 0;
$jumlah_transaksi = 0;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Bulanan - Warung ABC</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Laporan Transaksi Bulanan</h2>
    <form method="GET">
        Bulan: <input type="month" name="bulan" value="<?php echo $bulan; ?>">
        <input type="submit" value="Tampilkan">
    </form>
    <table>
        <tr><th>No. Transaksi</th><th>Tanggal</th><th>Kasir</th><th>Total Bayar</th></tr>
        <?php while ($row = mysqli_fetch_assoc($hasil)) { 
            $total_bulanan += $row['total_bayar'];
            $jumlah_transaksi++;
        ?>
        <tr>
            <td><?php echo $row['no_transaksi']; ?></td>
            <td><?php echo $row['tanggal']; ?></td>
            <td><?php echo $row['nama_kasir']; ?></td>
            <td>Rp <?php echo number_format($row['total_bayar'], 0, ',', '.'); ?></td>
        </tr>
        <?php } ?>
    </table>
    <p>Jumlah Transaksi: <strong><?php echo $jumlah_transaksi; ?></strong></p>
    <p>Total Pendapatan Bulan Ini: <strong>Rp <?php echo number_format($total_bulanan, 0, ',', '.'); ?></strong></p>
    <p><a href="dashboard.php">Kembali ke Dashboard</a></p>
</body>
</html>