<?php
include 'includes/cek_session.php';
include 'config/koneksi.php';
$bulan = isset($_GET['bulan']) ? mysqli_real_escape_string($koneksi, $_GET['bulan']) : date('Y-m');
$hasil = mysqli_query($koneksi, "SELECT t.no_transaksi, t.tanggal, t.total_bayar, u.nama_lengkap AS nama_kasir FROM tbl_transaksi t JOIN tbl_user u ON t.id_user = u.id_user WHERE DATE_FORMAT(t.tanggal, '%Y-%m') = '$bulan' ORDER BY t.tanggal ASC");
$total_bulanan = 0; $jumlah = 0;
?>
<!DOCTYPE html>
<html>
<head><title>Laporan Bulanan</title><link rel="stylesheet" href="style.css"></head>
<body>
    <h2>Laporan Transaksi Bulanan</h2>
    <form method="GET">
        Bulan: <input type="month" name="bulan" value="<?php echo $bulan; ?>">
        <input type="submit" value="Tampilkan">
    </form>
    <table>
        <tr><th>No. Transaksi</th><th>Tanggal</th><th>Kasir</th><th>Total Bayar</th></tr>
        <?php while ($row = mysqli_fetch_assoc($hasil)) { $total_bulanan += $row['total_bayar']; $jumlah++; ?>
        <tr>
            <td><?php echo $row['no_transaksi']; ?></td>
            <td><?php echo $row['tanggal']; ?></td>
            <td><?php echo $row['nama_kasir']; ?></td>
            <td>Rp <?php echo number_format($row['total_bayar'], 0, ',', '.'); ?></td>
        </tr>
        <?php } ?>
    </table>
    <p>Jumlah Transaksi: <strong><?php echo $jumlah; ?></strong> | Total Pendapatan: <strong>Rp <?php echo number_format($total_bulanan, 0, ',', '.'); ?></strong></p>
    <p><a href="dashboard.php">Dashboard</a></p>
</body>
</html>