<?php
// riwayat_transaksi.php
include 'includes/cek_session.php';
include 'config/koneksi.php';

$sql = "SELECT t.id_transaksi, t.no_transaksi, t.tanggal, t.total_bayar, u.nama_lengkap AS nama_kasir 
        FROM tbl_transaksi t 
        JOIN tbl_user u ON t.id_user = u.id_user 
        ORDER BY t.tanggal DESC";
$hasil = mysqli_query($koneksi, $sql);
?>
<!DOCTYPE html>
<html>
<<<<<<< HEAD
<head>
    <title>Riwayat Transaksi - Warung ABC</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Riwayat Transaksi</h2>
    <table>
=======
<head><title>Riwayat Transaksi - Warung ABC</title></head>
<body>
    <h2>Riwayat Transaksi</h2>
    <table border="1" cellpadding="6">
>>>>>>> d28c6cc0a801a4f3f5014f87350c57c95b381502
        <tr><th>No. Transaksi</th><th>Tanggal</th><th>Kasir</th><th>Total Bayar</th><th>Aksi</th></tr>
        <?php while ($row = mysqli_fetch_assoc($hasil)) { ?>
        <tr>
            <td><?php echo $row['no_transaksi']; ?></td>
            <td><?php echo $row['tanggal']; ?></td>
            <td><?php echo $row['nama_kasir']; ?></td>
<<<<<<< HEAD
            <td>Rp <?php echo number_format($row['total_bayar'], 0, ',', '.'); ?></td>
=======
            <td><?php echo number_format($row['total_bayar'], 0, ',', '.'); ?></td>
>>>>>>> d28c6cc0a801a4f3f5014f87350c57c95b381502
            <td><a href="struk.php?id=<?php echo $row['id_transaksi']; ?>">Cetak</a></td>
        </tr>
        <?php } ?>
    </table>
    <p><a href="dashboard.php">Kembali ke Dashboard</a></p>
</body>
</html>