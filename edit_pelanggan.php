<?php
// edit_pelanggan.php
include 'includes/cek_session.php';
include 'config/koneksi.php';

$id    = $_GET['id'];
$sql   = "SELECT * FROM tbl_pelanggan WHERE id_pelanggan = '$id'";
$hasil = mysqli_query($koneksi, $sql);
$data  = mysqli_fetch_assoc($hasil);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Pelanggan - Warung ABC</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Edit Pelanggan</h2>
    <form action="proses_edit_pelanggan.php" method="POST">
        <input type="hidden" name="id_pelanggan" value="<?php echo $data['id_pelanggan']; ?>">
        Nama Pelanggan: <input type="text" name="nama_pelanggan" value="<?php echo $data['nama_pelanggan']; ?>" required>
        No. HP: <input type="text" name="no_hp" value="<?php echo $data['no_hp']; ?>">
        Alamat: <input type="text" name="alamat" value="<?php echo $data['alamat']; ?>">
        <input type="submit" value="Update">
    </form>
    <p><a href="data_pelanggan.php">Kembali</a></p>
</body>
</html>