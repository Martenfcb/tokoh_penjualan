<?php
include '../koneksi.php';
include 'header.php';

if (!$koneksi) {
    die("Koneksi ke database gagal.");
}

// Ambil data jumlah
$jumlah_barang = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM barang"))['total'];
$total_stok = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(stok) as total FROM barang"))['total'];
$jumlah_terjual = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(jumlah) as total FROM data_penjualan"))['total'];
$jumlah_kategori = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(DISTINCT kategori) as total FROM barang"))['total'];

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        .card-header {
            font-weight: bold;
            color: white;
        }
        .card-footer a {
            text-decoration: none;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .btn-link {
            text-decoration: none;
            font-weight: 500;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h3 class="mb-4">Dashboard Barang</h3>
    <div class="row">
        <!-- Nama Barang -->
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-header bg-primary">
                    <i class="fas fa-boxes"></i> Nama Barang
                </div>
                <div class="card-body text-center">
                    <h2><?= $jumlah_barang ?></h2>
                </div>
                <div class="card-footer text-center">
                    <a href="nama_barang.php" class="btn-link text-primary">Tabel Barang <i class="fas fa-angle-double-right"></i></a>
                </div>
            </div>
        </div>

        <!-- Stok Barang -->
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-header bg-success">
                    <i class="fas fa-chart-bar"></i> Stok Barang
                </div>
                <div class="card-body text-center">
                    <h2><?= $total_stok ?></h2>
                </div>
                <div class="card-footer text-center">
                    <a href="barang.php" class="btn-link text-success">Tabel Barang <i class="fas fa-angle-double-right"></i></a>
                </div>
            </div>
        </div>

        <!-- Barang Terjual -->
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-header bg-info">
                    <i class="fas fa-truck-loading"></i> Telah Terjual
                </div>
                <div class="card-body text-center">
                    <h2><?= $jumlah_terjual ?></h2>
                </div>
                <div class="card-footer text-center">
                    <a href="data_penjualan.php" class="btn-link text-info">Tabel Laporan <i class="fas fa-angle-double-right"></i></a>
                </div>
            </div>
        </div>

        <!-- Kategori Barang -->
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <i class="fas fa-bookmark"></i> Kategori Barang
                </div>
                <div class="card-body text-center">
                    <h2><?= $jumlah_kategori ?></h2>
                </div>
                <div class="card-footer text-center">
                    <a href="kategori.php" class="btn-link text-warning">Tabel Kategori <i class="fas fa-angle-double-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
