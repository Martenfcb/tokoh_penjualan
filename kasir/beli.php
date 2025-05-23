<?php 
session_start();
include "../function.php";

$key = $_GET['kode']; // BRG001 atau semacamnya
$kode = $nama = $harga = "";

$sql = "SELECT * FROM `barang` WHERE kode = '$key'";
$a = select($sql);
$no = 1;
foreach ($a as $data) {
    $kode = $data['kode'];
    $nama = $data['nama'];
    $harga = $data['harga'];
}

$sql_insert_beli = "INSERT INTO `beli`(`kode`, `nama`, `jumlah`, `harga`) VALUES ('$kode','$nama',1,'$harga')";
$insert = insert($sql_insert_beli);

if ($insert == true) {
    header("Location: kasir.php");
}
?>
