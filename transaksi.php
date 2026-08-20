<?php
include 'includes/cek_session.php';
include 'config/koneksi.php';

if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = array();
}

$daftar_barang = mysqli_query(
    $koneksi,
    "SELECT * FROM tbl_barang WHERE stok > 0 ORDER BY nama_barang ASC"
);

$daftar_pelanggan = mysqli_query(
    $koneksi,
    "SELECT * FROM tbl_pelanggan ORDER BY nama_pelanggan ASC"
);

$total = 0;

foreach ($_SESSION['keranjang'] as $item) {
    $total += $item['subtotal'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Transaksi - Warung ABC</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="layout">

<aside class="sidebar">

<div class="logo">WARUNG ABC</div>

<nav>
<a href="dashboard.php">🏠 Dashboard</a>
<a href="transaksi.php" class="active">🛒 Transaksi</a>
<a href="pelanggan.php">👥 Data Pelanggan</a>
<a href="barang.php">📦 Data Barang</a>
<a href="riwayat_transaksi.php">📋 Riwayat Transaksi</a>

<div class="menu-title">LAPORAN</div>

<a href="laporan.php?jenis=harian">📅 Laporan Harian</a>
<a href="laporan.php?jenis=bulanan">📊 Laporan Bulanan</a>

<a href="logout.php" class="logout">🚪 Logout</a>
</nav>

</aside>

<main class="content">

<h1>Transaksi Penjualan</h1>

<?php
if (isset($_SESSION['pesan_error'])) {
    echo '<div class="alert error">'
        . htmlspecialchars($_SESSION['pesan_error'])
        . '</div>';

    unset($_SESSION['pesan_error']);
}
?>

<div class="panel">

<h3>Pilih Pelanggan</h3>

<form
    action="proses_simpan_transaksi.php"
    method="POST"
>

<select name="id_pelanggan" required>

<option value="">
-- Pilih Pelanggan --
</option>

<?php while ($p = mysqli_fetch_assoc($daftar_pelanggan)) { ?>

<option value="<?php echo $p['id_pelanggan']; ?>">

<?php
echo htmlspecialchars($p['nama_pelanggan']);

if (!empty($p['no_hp'])) {
    echo " - " . htmlspecialchars($p['no_hp']);
}
?>

</option>

<?php } ?>

</select>

<h3>Pilih Barang</h3>

</form>

<form
    action="proses_tambah_keranjang.php"
    method="POST"
>

<select name="id_barang" required>

<option value="">
-- Pilih Barang --
</option>

<?php while ($b = mysqli_fetch_assoc($daftar_barang)) { ?>

<option value="<?php echo $b['id_barang']; ?>">

<?php echo htmlspecialchars($b['nama_barang']); ?>

-
Rp <?php
echo number_format(
    $b['harga_satuan'],
    0,
    ',',
    '.'
);
?>

(Stok: <?php echo $b['stok']; ?>)

</option>

<?php } ?>

</select>

<label>Jumlah</label>

<input
    type="number"
    name="jumlah"
    min="1"
    required
>

<button
    type="submit"
    class="btn-primary"
>
Tambah ke Keranjang
</button>

</form>

</div>

<div class="panel">

<h3>Keranjang</h3>

<div class="table-responsive">

<table>

<tr>
<th>Nama Barang</th>
<th>Harga</th>
<th>Jumlah</th>
<th>Subtotal</th>
<th>Aksi</th>
</tr>

<?php foreach ($_SESSION['keranjang'] as $id_barang => $item) { ?>

<tr>

<td>
<?php echo htmlspecialchars($item['nama_barang']); ?>
</td>

<td>
Rp <?php
echo number_format(
    $item['harga'],
    0,
    ',',
    '.'
);
?>
</td>

<td>
<?php echo $item['jumlah']; ?>
</td>

<td>
Rp <?php
echo number_format(
    $item['subtotal'],
    0,
    ',',
    '.'
);
?>
</td>

<td>
<a
    class="btn-danger small"
    href="hapus_keranjang.php?id=<?php echo $id_barang; ?>"
>
Hapus
</a>
</td>

</tr>

<?php } ?>

<tr class="total-row">

<td colspan="3">
<strong>Total</strong>
</td>

<td colspan="2">

<strong>
Rp <?php
echo number_format(
    $total,
    0,
    ',',
    '.'
);
?>
</strong>

</td>

</tr>

</table>

</div>

<br>

<form
    action="proses_simpan_transaksi.php"
    method="POST"
>

<label>Pelanggan</label>

<select name="id_pelanggan" required>

<option value="">
-- Pilih Pelanggan --
</option>

<?php
mysqli_data_seek(
    $daftar_pelanggan,
    0
);

while (
    $p = mysqli_fetch_assoc(
        $daftar_pelanggan
    )
) {
?>

<option value="<?php echo $p['id_pelanggan']; ?>">

<?php
echo htmlspecialchars(
    $p['nama_pelanggan']
);
?>

</option>

<?php } ?>

</select>

<?php if (!empty($_SESSION['keranjang'])) { ?>

<button
    type="submit"
    class="btn-success"
>
Simpan Transaksi
</button>

<?php } ?>

</form>

</div>

</main>

</div>

</body>
</html>