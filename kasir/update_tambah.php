<?php 
include "../function.php";

$kode = $_GET['kode'];
$jml = 1;
$harga = 0;

// Ambil data dari tabel beli berdasarkan kode
$sql = "SELECT * FROM `beli` WHERE kode = '$kode'";
$a = select($sql);
foreach ($a as $data) {
    $jml = $data['jumlah'] + 1;
}

// Ambil harga satuan dari tabel barang
$sql = "SELECT * FROM `barang` WHERE kode = '$kode'";
$a = select($sql);
foreach ($a as $data) {
    $harga = $data['harga'] * $jml;
}

// Update data beli
$sql = "UPDATE `beli` SET `jumlah` = '$jml', `harga` = '$harga' WHERE kode = '$kode'";
$a = update($sql);

if ($a === true) {
    header('Location: kasir.php');
    exit;
}
?>
