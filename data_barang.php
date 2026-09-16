<?php
// data_barang.php
include 'includes/cek_session.php';
include 'config/koneksi.php';

$sql   = "SELECT * FROM tbl_barang ORDER BY nama_barang ASC";
$hasil = mysqli_query($koneksi, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Barang - Warung ABC</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Data Barang</h2>
    <p><a href="dashboard.php">Dashboard</a> | <a href="tambah_barang.php">Tambah Barang</a></p>
    <table>
        <tr>
            <th>Kode</th><th>Nama Barang</th><th>Harga Satuan</th>
            <th>Stok</th><th>Kadaluarsa</th><th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($hasil)) { ?>
        <tr>
            <td><?php echo $row['kode_barang']; ?></td>
            <td><?php echo $row['nama_barang']; ?></td>
            <td>Rp <?php echo number_format($row['harga_satuan'], 0, ',', '.'); ?></td>
            <td><?php echo $row['stok']; ?></td>
            <td><?php echo $row['tanggal_kadaluarsa']; ?></td>
            <td>
                <a href="edit_barang.php?id=<?php echo $row['id_barang']; ?>">Edit</a> | 
                <a href="hapus_barang.php?id=<?php echo $row['id_barang']; ?>" onclick="return confirm('Hapus barang ini?');">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>