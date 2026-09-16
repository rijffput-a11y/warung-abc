<?php
// struk.php
include 'includes/cek_session.php';
include 'config/koneksi.php';

$id_transaksi = $_GET['id'];

$sql_header = "SELECT t.*, u.nama_lengkap AS nama_kasir, p.nama_pelanggan 
              FROM tbl_transaksi t 
              JOIN tbl_user u ON t.id_user = u.id_user 
              LEFT JOIN tbl_pelanggan p ON t.id_pelanggan = p.id_pelanggan 
              WHERE t.id_transaksi = '$id_transaksi'";
$transaksi = mysqli_fetch_assoc(mysqli_query($koneksi, $sql_header));

$sql_detail = "SELECT d.jumlah, d.subtotal, b.nama_barang, b.harga_satuan 
              FROM tbl_detail_transaksi d 
              JOIN tbl_barang b ON d.id_barang = b.id_barang 
              WHERE d.id_transaksi = '$id_transaksi'";
$detail = mysqli_query($koneksi, $sql_detail);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Struk Transaksi - Warung ABC</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Warung ABC</h2>
    <p>
        No Transaksi: <?php echo $transaksi['no_transaksi']; ?><br>
        Tanggal: <?php echo $transaksi['tanggal']; ?><br>
        Kasir: <?php echo $transaksi['nama_kasir']; ?><br>
        Pelanggan: <?php echo $transaksi['nama_pelanggan'] ? $transaksi['nama_pelanggan'] : 'Umum'; ?>
    </p>
    <table>
        <tr><th>Barang</th><th>Harga</th><th>Jumlah</th><th>Subtotal</th></tr>
        <?php while ($item = mysqli_fetch_assoc($detail)) { ?>
        <tr>
            <td><?php echo $item['nama_barang']; ?></td>
            <td>Rp <?php echo number_format($item['harga_satuan'], 0, ',', '.'); ?></td>
            <td><?php echo $item['jumlah']; ?></td>
            <td>Rp <?php echo number_format($item['subtotal'], 0, ',', '.'); ?></td>
        </tr>
        <?php } ?>
        <tr>
            <td colspan="3"><strong>Total Bayar</strong></td>
            <td><strong>Rp <?php echo number_format($transaksi['total_bayar'], 0, ',', '.'); ?></strong></td>
        </tr>
    </table>
    <p>
        <button onclick="window.print();">Cetak Struk</button>
        <a href="riwayat_transaksi.php">Kembali ke Riwayat Transaksi</a>
    </p>
</body>
</html>