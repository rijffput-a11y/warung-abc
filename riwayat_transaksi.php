<?php

include 'includes/cek_session.php';
include 'config/koneksi.php';

$sql = "SELECT
            t.id_transaksi,
            t.no_transaksi,
            t.tanggal,
            t.total_bayar,
            u.nama_lengkap AS nama_kasir,
            COALESCE(
                p.nama_pelanggan,
                'Umum'
            ) AS nama_pelanggan

        FROM tbl_transaksi t

        JOIN tbl_user u
            ON t.id_kasir = u.id_user

        LEFT JOIN tbl_pelanggan p
            ON t.id_pelanggan =
               p.id_pelanggan

        ORDER BY t.tanggal DESC";

$hasil = mysqli_query(
    $koneksi,
    $sql
);

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Riwayat Transaksi - Warung ABC</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="layout">

<aside class="sidebar">

<div class="logo">
WARUNG ABC
</div>

<nav>

<a href="dashboard.php">
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

<a
href="riwayat_transaksi.php"
class="active"
>
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

<div class="page-header">

<div>

<h1>Riwayat Transaksi</h1>

<p>
Daftar seluruh transaksi penjualan.
</p>

</div>

<a
href="transaksi.php"
class="btn-primary"
>
+ Transaksi Baru
</a>

</div>

<?php

if (isset($_SESSION['pesan_sukses'])) {

echo '<div class="alert success">'
. htmlspecialchars(
    $_SESSION['pesan_sukses']
)
. '</div>';

unset($_SESSION['pesan_sukses']);
}

?>

<div class="panel">

<div class="table-responsive">

<table>

<tr>

<th>No. Transaksi</th>
<th>Tanggal</th>
<th>Pelanggan</th>
<th>Kasir</th>
<th>Total Bayar</th>
<th>Aksi</th>

</tr>

<?php

if (
    $hasil &&
    mysqli_num_rows($hasil) > 0
) {

while (
    $row =
    mysqli_fetch_assoc($hasil)
) {

?>

<tr>

<td>
<?php
echo htmlspecialchars(
    $row['no_transaksi']
);
?>
</td>

<td>
<?php
echo htmlspecialchars(
    $row['tanggal']
);
?>
</td>

<td>
<?php
echo htmlspecialchars(
    $row['nama_pelanggan']
);
?>
</td>

<td>
<?php
echo htmlspecialchars(
    $row['nama_kasir']
);
?>
</td>

<td>
Rp
<?php
echo number_format(
    $row['total_bayar'],
    0,
    ',',
    '.'
);
?>
</td>

<td>

<a
href="laporan.php?jenis=detail&id=<?php echo $row['id_transaksi']; ?>"
class="btn-secondary small"
>
Detail / Cetak
</a>

</td>

</tr>

<?php

}

} else {

?>

<tr>

<td
colspan="6"
class="empty"
>
Belum ada transaksi.
</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</main>

</div>

</body>
</html>