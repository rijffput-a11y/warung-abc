<?php
// data_pelanggan.php
include 'includes/cek_session.php';
include 'config/koneksi.php';

$sql   = "SELECT * FROM tbl_pelanggan ORDER BY nama_pelanggan ASC";
$hasil = mysqli_query($koneksi, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Pelanggan - Warung ABC</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Data Pelanggan</h2>
    <p><a href="dashboard.php">Dashboard</a> | <a href="tambah_pelanggan.php">Tambah Pelanggan</a></p>
    <table>
        <tr><th>Nama Pelanggan</th><th>No. HP</th><th>Alamat</th><th>Aksi</th></tr>
        <?php while ($row = mysqli_fetch_assoc($hasil)) { ?>
        <tr>
            <td><?php echo $row['nama_pelanggan']; ?></td>
            <td><?php echo $row['no_hp']; ?></td>
            <td><?php echo $row['alamat']; ?></td>
            <td>
                <a href="edit_pelanggan.php?id=<?php echo $row['id_pelanggan']; ?>">Edit</a> | 
                <a href="hapus_pelanggan.php?id=<?php echo $row['id_pelanggan']; ?>" onclick="return confirm('Hapus pelanggan ini?');">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>