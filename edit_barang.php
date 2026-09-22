<?php
include 'includes/cek_session.php';
include 'config/koneksi.php';
$id   = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tbl_barang WHERE id_barang = '$id'"));
?>
<!DOCTYPE html>
<html>
<head><title>Edit Barang</title><link rel="stylesheet" href="style.css"></head>
<body>
    <h2>Edit Barang</h2>
    <form action="proses_edit_barang.php" method="POST">
        <input type="hidden" name="id_barang" value="<?php echo $data['id_barang']; ?>">
        Kode Barang: <input type="text" name="kode_barang" value="<?php echo $data['kode_barang']; ?>" required>
        Nama Barang: <input type="text" name="nama_barang" value="<?php echo $data['nama_barang']; ?>" required>
        Harga Satuan: <input type="number" name="harga_satuan" step="0.01" value="<?php echo $data['harga_satuan']; ?>" required>
        Stok: <input type="number" name="stok" value="<?php echo $data['stok']; ?>" required>
        Tanggal Kadaluarsa: <input type="date" name="tanggal_kadaluarsa" value="<?php echo $data['tanggal_kadaluarsa']; ?>">
        <input type="submit" value="Update">
    </form>
    <p><a href="data_barang.php">Kembali</a></p>
</body>
</html>