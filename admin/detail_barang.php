<?php
include '../koneksi.php';
include '../function.php';

// Memeriksa apakah parameter kode ada dalam URL
if (!isset($_GET['kode'])) {
  echo "Kode barang tidak ditemukan.";
  exit;
}

// Mengambil kode barang dari parameter URL
$kode_barang = $_GET['kode'];

// Mengambil data barang berdasarkan kode
$barang = select("SELECT * FROM barang WHERE kode = '$kode_barang'");

if (count($barang) == 0) {
  // Jika barang tidak ditemukan
  echo "Barang tidak ditemukan.";
  exit;
}

$barang = $barang[0]; // Ambil data pertama (karena query mengembalikan array)
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Detail Barang</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #f9f9f9, #e6eaf1);
      font-family: 'Poppins', sans-serif;
    }

    .container {
      padding-top: 60px;
      padding-bottom: 60px;
    }

    .card {
      border: none;
      border-radius: 20px;
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
      background-color: #ffffff;
    }

    .card-img-top {
      height: 400px;
      object-fit: cover;
      border-top-left-radius: 20px;
      border-top-right-radius: 20px;
    }

    .card-body {
      padding: 30px;
    }

    .card-title {
      font-size: 24px;
      font-weight: 600;
      margin-bottom: 20px;
    }

    .card-text {
      font-size: 18px;
      font-weight: 500;
      margin-bottom: 15px;
    }

    .btn-back {
      background-color: #0d6efd;
      color: white;
      border-radius: 25px;
      padding: 10px 25px;
      font-size: 16px;
      text-decoration: none;
      transition: 0.3s;
    }

    .btn-back:hover {
      background-color: #0b5ed7;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }
  </style>
</head>
<body>

<div class="container">
  <h2 class="text-center mb-5 fw-bold">Detail Barang</h2>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <img src="../gambar/<?= $barang['foto']; ?>" class="card-img-top" alt="<?= htmlspecialchars($barang['nama']); ?>">
        <div class="card-body">
          <h5 class="card-title"><?= htmlspecialchars($barang['nama']); ?></h5>
          <p class="card-text"><strong>Kode:</strong> <?= htmlspecialchars($barang['kode']); ?></p>
          <p class="card-text"><strong>Kategori:</strong> <?= htmlspecialchars($barang['kategori']); ?></p>
          <p class="card-text"><strong>Stok:</strong> <?= htmlspecialchars($barang['stok']); ?></p>
          <p class="card-text"><strong>Harga:</strong> Rp <?= number_format($barang['harga'], 0, ',', '.'); ?></p>
          <p class="card-text"><strong>Tanggal Masuk:</strong> <?= date("d-m-Y", strtotime($barang['tanggal'])); ?></p>
          <p class="card-text"><strong>Terjual:</strong> <?= htmlspecialchars($barang['terjual']); ?> unit</p>
          <a href="javascript:history.back()" class="btn btn-back">Kembali ke Daftar Barang</a>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
