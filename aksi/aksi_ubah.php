<?php 
include "../function.php";

// Ambil data dari form
$kode = $_POST['kode'];
$nama = $_POST['nama'];
$stok = $_POST['stok'];
$harga = $_POST['harga'];
$kategori = $_POST['kategori']; // Tambahan kategori

// Query untuk update data barang termasuk kategori
$sql = "UPDATE `barang` 
        SET `nama` = '$nama', 
            `stok` = '$stok', 
            `harga` = '$harga',
            `kategori` = '$kategori' 
        WHERE `kode` = '$kode'";

$a = update($sql);

if($a == true) {
    echo "<script>alert('Barang berhasil diupdate!');window.location = '../admin/daftar_barang.php';</script>";
} else {
    echo "<script>alert('Terjadi kesalahan saat mengupdate barang.');history.back();</script>";
}
?>
