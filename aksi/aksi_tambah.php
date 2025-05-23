<?php
include "../function.php";
include "../koneksi.php";

// Ambil dan amankan data dari form
$kode     = mysqli_real_escape_string($koneksi, $_POST['kode']);
$nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
$kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
$stok     = mysqli_real_escape_string($koneksi, $_POST['stok']);
$harga    = mysqli_real_escape_string($koneksi, $_POST['harga']);

$foto_name = ""; // Inisialisasi nama foto

// Jika ambil dari kamera (base64)
if (!empty($_POST['foto_kamera'])) {
    $base64_image = $_POST['foto_kamera'];
    $image_parts = explode(";base64,", $base64_image);
    $image_base64 = base64_decode($image_parts[1]);
    $foto_name = 'kamera_' . time() . '.png';
    file_put_contents("../uploads/" . $foto_name, $image_base64);

// Jika ambil dari file upload
} elseif (!empty($_FILES['foto']['name'])) {
    $foto_name = time() . '_' . basename($_FILES['foto']['name']);
    $foto_tmp  = $_FILES['foto']['tmp_name'];
    $upload_dir = "../uploads/";
    $upload_path = $upload_dir . $foto_name;

    if (!move_uploaded_file($foto_tmp, $upload_path)) {
        echo "<script>alert('Gagal mengupload foto. Periksa folder uploads.');history.back();</script>";
        exit;
    }
}

// Validasi kode barang duplikat
$sql_check = "SELECT * FROM barang WHERE kode = '$kode'";
$check = mysqli_query($koneksi, $sql_check);
if (mysqli_num_rows($check) > 0) {
    echo "<script>alert('Kode barang sudah ada. Gunakan kode lain.');history.back();</script>";
    exit;
}

// Simpan data ke database
$query = "INSERT INTO barang (kode, nama, kategori, stok, harga, foto) 
          VALUES ('$kode', '$nama', '$kategori', '$stok', '$harga', '$foto_name')";
$result = mysqli_query($koneksi, $query);

if ($result) {
    echo "<script>alert('Data berhasil ditambahkan!');window.location.href='../admin/daftar_barang.php';</script>";
} else {
    echo "<script>alert('Gagal menambahkan data: " . mysqli_error($conn) . "');history.back();</script>";
}
?>
