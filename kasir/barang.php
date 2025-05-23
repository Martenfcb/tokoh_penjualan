<?php 
session_start();
include "../function.php";

// Cek apakah kategori dipilih
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';

// Hindari SQL Injection dengan pengamanan input
$kategori = htmlspecialchars($kategori, ENT_QUOTES);

// Ambil data dari database berdasarkan kategori
$sql = "SELECT * FROM `barang` WHERE kategori LIKE '%$kategori%'";
$barangList = select($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .card {
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card img {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h3>Barang Kategori: <em><?= $kategori ?></em></h3>
    <div class="row">
        <?php if (count($barangList) > 0): ?>
            <?php foreach ($barangList as $data): ?>
                <div class="col-md-3">
                    <div class="card">
                        <img src="../uploads/<?= htmlspecialchars($data['foto']) ?>" class="card-img-top" alt="Foto Barang">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($data['nama']) ?></h5>
                            <p class="card-text">Stok: <?= htmlspecialchars($data['stok']) ?></p>
                            <p class="card-text">Harga: Rp<?= number_format($data['harga'], 0, ',', '.') ?></p>
                            <a href="beli.php?kode=<?= urlencode($data['kode']) ?>" class="btn btn-primary">Pilih</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    Data barang tidak ditemukan di kategori ini.
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
