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
<<<<<<< HEAD
<head>
    <title>Edit Pelanggan - Warung ABC</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
=======
<head><title>Edit Pelanggan - Warung ABC</title></head>
>>>>>>> d28c6cc0a801a4f3f5014f87350c57c95b381502
<body>
    <h2>Edit Pelanggan</h2>
    <form action="proses_edit_pelanggan.php" method="POST">
        <input type="hidden" name="id_pelanggan" value="<?php echo $data['id_pelanggan']; ?>">
        <table>
            <tr>
                <td>Nama Pelanggan</td>
                <td><input type="text" name="nama_pelanggan" value="<?php echo $data['nama_pelanggan']; ?>" required></td>
            </tr>
            <tr>
                <td>No. HP</td>
                <td><input type="text" name="no_hp" value="<?php echo $data['no_hp']; ?>"></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><input type="text" name="alamat" value="<?php echo $data['alamat']; ?>"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Update"></td>
            </tr>
        </table>
    </form>
    <p><a href="data_pelanggan.php">Kembali</a></p>
</body>
</html>