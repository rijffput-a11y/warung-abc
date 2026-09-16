<?php

include 'includes/cek_session.php';
include 'config/koneksi.php';

$edit = false;

$data_edit = array(
    'id_barang' => '',
    'nama_barang' => '',
    'harga_satuan' => '',
    'stok' => ''
);

if (isset($_GET['hapus'])) {

    $id = (int) $_GET['hapus'];

    $cek = mysqli_query(
        $koneksi,
        "SELECT COUNT(*) AS total
         FROM tbl_detail_transaksi
         WHERE id_barang='$id'"
    );

    $dipakai =
        mysqli_fetch_assoc($cek)['total'];

    if ($dipakai > 0) {

        $_SESSION['pesan_error'] =
            "Barang sudah digunakan dalam transaksi dan tidak dapat dihapus.";

    } else {

        mysqli_query(
            $koneksi,
            "DELETE FROM tbl_barang
             WHERE id_barang='$id'"
        );
    }

    header("Location: barang.php");
    exit;
}

if (isset($_GET['edit'])) {

    $id = (int) $_GET['edit'];

    $q = mysqli_query(
        $koneksi,
        "SELECT * FROM tbl_barang
         WHERE id_barang='$id'"
    );

    if (
        $q &&
        mysqli_num_rows($q) > 0
    ) {

        $data_edit =
            mysqli_fetch_assoc($q);

        $edit = true;
    }
}

if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
) {

    $id =
        (int) $_POST['id_barang'];

    $nama =
        mysqli_real_escape_string(
            $koneksi,
            $_POST['nama_barang']
        );

    $harga =
        (float) $_POST['harga_satuan'];

    $stok =
        (int) $_POST['stok'];

    if ($id > 0) {

        mysqli_query(
            $koneksi,
            "UPDATE tbl_barang
             SET
                nama_barang='$nama',
                harga_satuan='$harga',
                stok='$stok'
             WHERE id_barang='$id'"
        );

    } else {

        mysqli_query(
            $koneksi,
            "INSERT INTO tbl_barang
            (
                nama_barang,
                harga_satuan,
                stok
            )
            VALUES
            (
                '$nama',
                '$harga',
                '$stok'
            )"
        );
    }

    header("Location: barang.php");
    exit;
}

$hasil = mysqli_query(
    $koneksi,
    "SELECT * FROM tbl_barang
     ORDER BY id_barang DESC"
);

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0"
>

<title>Data Barang</title>

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

<a href="barang.php" class="active">
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

<h1>Data Barang</h1>

<?php

if (isset($_SESSION['pesan_error'])) {

echo '<div class="alert error">'
. htmlspecialchars(
    $_SESSION['pesan_error']
)
. '</div>';

unset($_SESSION['pesan_error']);
}

?>

<div class="two-column">

<div class="panel">

<h2>
<?php
echo $edit
    ? 'Edit Barang'
    : 'Tambah Barang';
?>
</h2>

<form method="POST">

<input
type="hidden"
name="id_barang"
value="<?php
echo $data_edit['id_barang'];
?>"
>

<label>Nama Barang</label>

<input
type="text"
name="nama_barang"
value="<?php
echo htmlspecialchars(
    $data_edit['nama_barang']
);
?>"
required
>

<label>Harga Satuan</label>

<input
type="number"
name="harga_satuan"
min="0"
value="<?php
echo $data_edit['harga_satuan'];
?>"
required
>

<label>Stok</label>

<input
type="number"
name="stok"
min="0"
value="<?php
echo $data_edit['stok'];
?>"
required
>

<button
type="submit"
class="btn-primary"
>

<?php
echo $edit
    ? 'Update Barang'
    : 'Tambah Barang';
?>

</button>

<?php if ($edit) { ?>

<a
href="barang.php"
class="btn-secondary"
>
Batal
</a>

<?php } ?>

</form>

</div>

<div class="panel">

<h2>Daftar Barang</h2>

<div class="table-responsive">

<table>

<tr>

<th>ID</th>
<th>Nama Barang</th>
<th>Harga</th>
<th>Stok</th>
<th>Aksi</th>

</tr>

<?php

while (
    $row =
    mysqli_fetch_assoc($hasil)
) {

?>

<tr>

<td>
<?php
echo $row['id_barang'];
?>
</td>

<td>
<?php
echo htmlspecialchars(
    $row['nama_barang']
);
?>
</td>

<td>
Rp <?php
echo number_format(
    $row['harga_satuan'],
    0,
    ',',
    '.'
);
?>
</td>

<td>
<?php echo $row['stok']; ?>
</td>

<td>

<a
href="barang.php?edit=<?php echo $row['id_barang']; ?>"
class="btn-warning small"
>
Edit
</a>

<a
href="barang.php?hapus=<?php echo $row['id_barang']; ?>"
class="btn-danger small"
onclick="return confirm('Hapus barang ini?')"
>
Hapus
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</div>

</main>

</div>

</body>
</html>