<?php

include 'includes/cek_session.php';
include 'config/koneksi.php';

$jenis =
    isset($_GET['jenis'])
    ? $_GET['jenis']
    : 'harian';

$tanggal =
    isset($_GET['tanggal'])
    ? $_GET['tanggal']
    : date('Y-m-d');

$bulan =
    isset($_GET['bulan'])
    ? $_GET['bulan']
    : date('m');

$tahun =
    isset($_GET['tahun'])
    ? $_GET['tahun']
    : date('Y');

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0"
>

<title>Laporan - Warung ABC</title>

<link
rel="stylesheet"
href="style.css"
>

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

<a href="riwayat_transaksi.php">
📋 Riwayat Transaksi
</a>

<div class="menu-title">
LAPORAN
</div>

<a
href="laporan.php?jenis=harian"
class="<?php echo $jenis == 'harian' ? 'active' : ''; ?>"
>
📅 Laporan Harian
</a>

<a
href="laporan.php?jenis=bulanan"
class="<?php echo $jenis == 'bulanan' ? 'active' : ''; ?>"
>
📊 Laporan Bulanan
</a>

<a href="logout.php" class="logout">
🚪 Logout
</a>

</nav>

</aside>

<main class="content">

<h1>
<?php
echo $jenis == 'bulanan'
    ? 'Laporan Bulanan'
    : 'Laporan Harian';
?>
</h1>

<?php if ($jenis == 'harian') { ?>

<div class="panel">

<form method="GET">

<input
type="hidden"
name="jenis"
value="harian"
>

<label>Pilih Tanggal</label>

<input
type="date"
name="tanggal"
value="<?php echo $tanggal; ?>"
>

<button
type="submit"
class="btn-primary"
>
Tampilkan
</button>

<button
type="button"
class="btn-secondary"
onclick="window.print()"
>
Cetak
</button>

</form>

</div>

<?php

$sql = "SELECT
            COUNT(*) AS jumlah_transaksi,
            COALESCE(
                SUM(total_bayar),
                0
            ) AS total
        FROM tbl_transaksi
        WHERE DATE(tanggal)='$tanggal'";

$q = mysqli_query(
    $koneksi,
    $sql
);

$summary =
    mysqli_fetch_assoc($q);

$sql_data =
    "SELECT
        t.no_transaksi,
        t.tanggal,
        t.total_bayar,
        COALESCE(
            p.nama_pelanggan,
            'Umum'
        ) AS nama_pelanggan,
        u.nama_lengkap AS kasir

    FROM tbl_transaksi t

    LEFT JOIN tbl_pelanggan p
        ON t.id_pelanggan =
           p.id_pelanggan

    JOIN tbl_user u
        ON t.id_kasir =
           u.id_user

    WHERE DATE(t.tanggal)='$tanggal'

    ORDER BY t.tanggal DESC";

$data = mysqli_query(
    $koneksi,
    $sql_data
);

?>

<div class="cards">

<div class="card blue">

<div>
<span>Jumlah Transaksi</span>
<strong>
<?php
echo $summary['jumlah_transaksi'];
?>
</strong>
</div>

</div>

<div class="card green">

<div>
<span>Pendapatan</span>

<strong>
Rp <?php
echo number_format(
    $summary['total'],
    0,
    ',',
    '.'
);
?>
</strong>

</div>

</div>

</div>

<div class="panel">

<h2>
Tanggal:
<?php
echo date(
    'd-m-Y',
    strtotime($tanggal)
);
?>
</h2>

<div class="table-responsive">

<table>

<tr>

<th>No. Transaksi</th>
<th>Jam</th>
<th>Pelanggan</th>
<th>Kasir</th>
<th>Total</th>

</tr>

<?php

while (
    $row =
    mysqli_fetch_assoc($data)
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
echo date(
    'H:i:s',
    strtotime($row['tanggal'])
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
    $row['kasir']
);
?>
</td>

<td>
Rp <?php
echo number_format(
    $row['total_bayar'],
    0,
    ',',
    '.'
);
?>
</td>

</tr>

<?php } ?>

</table>

</div>

</div>

<?php } elseif ($jenis == 'bulanan') { ?>

<div class="panel">

<form method="GET">

<input
type="hidden"
name="jenis"
value="bulanan"
>

<label>Bulan</label>

<select name="bulan">

<?php

for (
    $i = 1;
    $i <= 12;
    $i++
) {

$selected =
    ($i == $bulan)
    ? 'selected'
    : '';

?>

<option
value="<?php echo $i; ?>"
<?php echo $selected; ?>
>

<?php

echo date(
    'F',
    mktime(
        0,
        0,
        0,
        $i,
        1
    )
);

?>

</option>

<?php } ?>

</select>

<label>Tahun</label>

<select name="tahun">

<?php

for (
    $i = date('Y') - 5;
    $i <= date('Y') + 1;
    $i++
) {

$selected =
    ($i == $tahun)
    ? 'selected'
    : '';

?>

<option
value="<?php echo $i; ?>"
<?php echo $selected; ?>
>

<?php echo $i; ?>

</option>

<?php } ?>

</select>

<button
type="submit"
class="btn-primary"
>
Tampilkan
</button>

<button
type="button"
class="btn-secondary"
onclick="window.print()"
>
Cetak
</button>

</form>

</div>

<?php

$sql =
"SELECT

COUNT(*) AS jumlah_transaksi,

COALESCE(
SUM(total_bayar),
0
) AS total

FROM tbl_transaksi

WHERE MONTH(tanggal)='$bulan'

AND YEAR(tanggal)='$tahun'";

$q = mysqli_query(
    $koneksi,
    $sql
);

$summary =
    mysqli_fetch_assoc($q);

$sql_data =
"SELECT

DATE(tanggal) AS tanggal,

COUNT(*) AS jumlah_transaksi,

SUM(total_bayar) AS total

FROM tbl_transaksi

WHERE MONTH(tanggal)='$bulan'

AND YEAR(tanggal)='$tahun'

GROUP BY DATE(tanggal)

ORDER BY tanggal DESC";

$data = mysqli_query(
    $koneksi,
    $sql_data
);

?>

<div class="cards">

<div class="card blue">

<div>

<span>
Jumlah Transaksi
</span>

<strong>
<?php
echo $summary[
    'jumlah_transaksi'
];
?>
</strong>

</div>

</div>

<div class="card green">

<div>

<span>
Total Pendapatan
</span>

<strong>
Rp <?php
echo number_format(
    $summary['total'],
    0,
    ',',
    '.'
);
?>
</strong>

</div>

</div>

</div>

<div class="panel">

<h2>
Rekap Bulanan
</h2>

<div class="table-responsive">

<table>

<tr>

<th>Tanggal</th>
<th>Jumlah Transaksi</th>
<th>Pendapatan</th>

</tr>

<?php

while (
    $row =
    mysqli_fetch_assoc($data)
) {

?>

<tr>

<td>
<?php
echo date(
    'd-m-Y',
    strtotime($row['tanggal'])
);
?>
</td>

<td>
<?php
echo $row['jumlah_transaksi'];
?>
</td>

<td>
Rp <?php
echo number_format(
    $row['total'],
    0,
    ',',
    '.'
);
?>
</td>

</tr>

<?php } ?>

<tr class="total-row">

<td>
<strong>TOTAL</strong>
</td>

<td>
<strong>
<?php
echo $summary[
    'jumlah_transaksi'
];
?>
</strong>
</td>

<td>
<strong>
Rp <?php
echo number_format(
    $summary['total'],
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

</div>

<?php } ?>

</main>

</div>

</body>
</html>