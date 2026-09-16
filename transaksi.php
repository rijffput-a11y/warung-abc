<?php
// transaksi.php
include 'includes/cek_session.php';
include 'config/koneksi.php';

if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = array();
}

$daftar_barang   = mysqli_query($koneksi, "SELECT * FROM tbl_barang WHERE stok > 0");
$hasil_pelanggan = mysqli_query($koneksi, "SELECT * FROM tbl_pelanggan ORDER BY nama_pelanggan ASC");

$total = 0;
foreach ($_SESSION['keranjang'] as $item) {
    $total += $item['subtotal'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Transaksi - Warung ABC</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Transaksi Penjualan</h2>

    <?php if (isset($_SESSION['pesan_error'])) { 
        echo "<p style='color:red;'>" . $_SESSION['pesan_error'] . "</p>";
        unset($_SESSION['pesan_error']);
    } ?>

    <form action="proses_tambah_keranjang.php" method="POST">
        Pilih Barang:
        <select name="id_barang" required>
            <option value="">-- Pilih Barang --</option>
            <?php while ($b = mysqli_fetch_assoc($daftar_barang)) { ?>
                <option value="<?php echo $b['id_barang']; ?>">
                    <?php echo $b['nama_barang']; ?> (Stok: <?php echo $b['stok']; ?>)
                </option>
            <?php } ?>
        </select>
        Jumlah: <input type="number" name="jumlah" min="1" required>
        <input type="submit" value="Tambah ke Keranjang">
    </form>

    <h3>Keranjang Belanja</h3>
    <table>
        <tr><th>Nama Barang</th><th>Harga</th><th>Jumlah</th><th>Subtotal</th></tr>
        <?php foreach ($_SESSION['keranjang'] as $id_barang => $item) { ?>
        <tr>
            <td><?php echo $item['nama_barang']; ?></td>
            <td>Rp <?php echo number_format($item['harga_satuan'], 0, ',', '.'); ?></td>
            <td><?php echo $item['jumlah']; ?></td>
            <td>Rp <?php echo number_format($item['subtotal'], 0, ',', '.'); ?></td>
        </tr>
        <?php } ?>
        <tr>
            <td colspan="3"><strong>Total Bayar</strong></td>
            <td><strong>Rp <?php echo number_format($total, 0, ',', '.'); ?></strong></td>
        </tr>
    </table>

    <form action="proses_simpan_transaksi.php" method="POST">
        Pelanggan:
        <select name="id_pelanggan">
            <option value="">-- Pelanggan Umum --</option>
            <?php while ($p = mysqli_fetch_assoc($hasil_pelanggan)) { ?>
                <option value="<?php echo $p['id_pelanggan']; ?>"><?php echo $p['nama_pelanggan']; ?></option>
            <?php } ?>
        </select>
        <input type="submit" value="Simpan Transaksi">
    </form>
    <p><a href="dashboard.php">Kembali ke Dashboard</a></p>
</body>
</html>