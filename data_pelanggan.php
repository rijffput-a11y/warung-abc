<?php
// data_pelanggan.php
include 'includes/cek_session.php';
include 'config/koneksi.php';

$sql   = "SELECT * FROM tbl_pelanggan ORDER BY nama_pelanggan ASC";
$hasil = mysqli_query($koneksi, $sql);
?>
<!DOCTYPE html>
<html>
<<<<<<< HEAD
<head>
    <title>Data Pelanggan - Warung ABC</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
=======
<head><title>Data Pelanggan - Warung ABC</title></head>
>>>>>>> d28c6cc0a801a4f3f5014f87350c57c95b381502
<body>
    <h2>Data Pelanggan</h2>
    <p><a href="dashboard.php">Kembali ke Dashboard</a> | 
       <a href="tambah_pelanggan.php">Tambah Pelanggan</a></p>
<<<<<<< HEAD
    <table>
=======
    <table border="1" cellpadding="6">
>>>>>>> d28c6cc0a801a4f3f5014f87350c57c95b381502
        <tr><th>Nama Pelanggan</th><th>No. HP</th><th>Alamat</th><th>Aksi</th></tr>
        <?php while ($row = mysqli_fetch_assoc($hasil)) { ?>
        <tr>
            <td><?php echo $row['nama_pelanggan']; ?></td>
            <td><?php echo $row['no_hp']; ?></td>
            <td><?php echo $row['alamat']; ?></td>
            <td>
                <a href="edit_pelanggan.php?id=<?php echo $row['id_pelanggan']; ?>">Edit</a> | 
                <a href="hapus_pelanggan.php?id=<?php echo $row['id_pelanggan']; ?>" onclick="return confirm('Yakin hapus pelanggan ini?');">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>