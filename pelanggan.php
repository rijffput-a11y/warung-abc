<?php

include 'includes/cek_session.php';
include 'config/koneksi.php';

$edit = false;

$data_edit = array(
    'id_pelanggan' => '',
    'nama_pelanggan' => '',
    'no_hp' => '',
    'alamat' => ''
);

if (
    isset($_GET['hapus'])
) {

    $id = (int) $_GET['hapus'];

    mysqli_query(
        $koneksi,
        "DELETE FROM tbl_pelanggan
         WHERE id_pelanggan='$id'"
    );

    header(
        "Location: pelanggan.php"
    );

    exit;
}

if (
    isset($_GET['edit'])
) {

    $id = (int) $_GET['edit'];

    $q = mysqli_query(
        $koneksi,
        "SELECT * FROM tbl_pelanggan
         WHERE id_pelanggan='$id'"
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
        isset($_POST['id_pelanggan'])
        ? (int) $_POST['id_pelanggan']
        : 0;

    $nama =
        mysqli_real_escape_string(
            $koneksi,
            $_POST['nama_pelanggan']
        );

    $no_hp =
        mysqli_real_escape_string(
            $koneksi,
            $_POST['no_hp']
        );

    $alamat =
        mysqli_real_escape_string(
            $koneksi,
            $_POST['alamat']
        );

    if ($id > 0) {

        mysqli_query(
            $koneksi,
            "UPDATE tbl_pelanggan
             SET
                nama_pelanggan='$nama',
                no_hp='$no_hp',
                alamat='$alamat'
             WHERE
                id_pelanggan='$id'"
        );

    } else {

        mysqli_query(
            $koneksi,
            "INSERT INTO tbl_pelanggan
            (
                nama_pelanggan,
                no_hp,
                alamat
            )
            VALUES
            (
                '$nama',
                '$no_hp',
                '$alamat'
            )"
        );
    }

    header(
        "Location: pelanggan.php"
    );

    exit;
}

$hasil = mysqli_query(
    $koneksi,
    "SELECT * FROM tbl_pelanggan
     ORDER BY id_pelanggan DESC"
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

<title>Data Pelanggan</title>

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

<a
href="pelanggan.php"
class="active"
>
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

<h1>Data Pelanggan</h1>

<div class="two-column">

<div class="panel">

<h2>
<?php
echo $edit
    ? 'Edit Pelanggan'
    : 'Tambah Pelanggan';
?>
</h2>

<form method="POST">

<input
type="hidden"
name="id_pelanggan"
value="<?php
echo $data_edit['id_pelanggan'];
?>"
>

<label>Nama Pelanggan</label>

<input
type="text"
name="nama_pelanggan"
value="<?php
echo htmlspecialchars(
    $data_edit['nama_pelanggan']
);
?>"
required
>

<label>No. HP</label>

<input
type="text"
name="no_hp"
value="<?php
echo htmlspecialchars(
    $data_edit['no_hp']
);
?>"
>

<label>Alamat</label>

<textarea
name="alamat"
rows="4"
><?php
echo htmlspecialchars(
    $data_edit['alamat']
);
?></textarea>

<button
type="submit"
class="btn-primary"
>

<?php
echo $edit
    ? 'Update Pelanggan'
    : 'Tambah Pelanggan';
?>

</button>

<?php if ($edit) { ?>

<a
href="pelanggan.php"
class="btn-secondary"
>
Batal
</a>

<?php } ?>

</form>

</div>

<div class="panel">

<h2>Daftar Pelanggan</h2>

<div class="table-responsive">

<table>

<tr>

<th>ID</th>
<th>Nama</th>
<th>No. HP</th>
<th>Alamat</th>
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
echo $row['id_pelanggan'];
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
    $row['no_hp']
);
?>
</td>

<td>
<?php
echo htmlspecialchars(
    $row['alamat']
);
?>
</td>

<td>

<a
href="pelanggan.php?edit=<?php echo $row['id_pelanggan']; ?>"
class="btn-warning small"
>
Edit
</a>

<a
href="pelanggan.php?hapus=<?php echo $row['id_pelanggan']; ?>"
class="btn-danger small"
onclick="return confirm('Hapus pelanggan ini?')"
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