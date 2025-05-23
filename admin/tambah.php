<?php 
session_start();
include "../function.php";
include 'header.php';
$name = $_SESSION['username'];
$pass = $_SESSION['password'];
if (!isset($name) || !isset($pass)) {
    echo "<script>alert('Anda belum login');history.back()</script>";
}

// Generate kode otomatis
$last = select("SELECT MAX(kode) as maxkode FROM barang");
$kodebaru = "BRG001";
if ($last[0]['maxkode']) {
    $urutan = (int)substr($last[0]['maxkode'], 3) + 1;
    $kodebaru = "BRG" . str_pad($urutan, 3, "0", STR_PAD_LEFT);
}

// Ambil semua kategori unik dari database
$kategori_list = select("SELECT DISTINCT kategori FROM barang");

// Tangani filter kategori
$filter_kategori = isset($_GET['kategori']) ? $_GET['kategori'] : "";
$filter_query = $filter_kategori ? " WHERE kategori = '$filter_kategori'" : "";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin | Data Barang</title>
    <link rel="stylesheet" href="../style/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        * { font-family: 'Poppins', sans-serif; }
        body { background-color: #f8f9fc; }
        .navbar { background: linear-gradient(90deg, #343a40, #212529); box-shadow: 0 4px 10px rgba(0,0,0,0.2); }
        .navbar-brand { font-weight: 600; letter-spacing: 1px; }
        .nav-link:hover { color: #ffc107 !important; }
        .form-section, .table-section { margin-top: 40px; }
        .card { border-radius: 20px; border: none; box-shadow: 0 8px 16px rgba(0,0,0,0.1); }
        .form-control { border-radius: 12px; }
        .btn { border-radius: 30px; padding: 8px 25px; font-weight: 500; transition: 0.3s ease; }
        .btn-info { background-color: #17a2b8; border-color: #17a2b8; }
        .btn-info:hover { background-color: #138496; border-color: #117a8b; }
        .table { margin-top: 20px; background-color: #fff; border-radius: 10px; overflow: hidden; }
        .table th { background-color: #343a40; color: #fff; }
        .table tbody tr:hover { background-color: #f1f1f1; }
        @media (max-width: 768px) {
            .form-group.row { flex-direction: column; text-align: left; }
            .form-group .col-sm-2, .form-group .col-sm-10 { width: 100%; }
        }
       
/* Bagian Filter Kategori */
.filter-container {
    display: flex;
    flex-wrap: wrap;
    margin: 20px 0;
    justify-content: space-between;
}

.filter-item {
    flex: 1 1 200px; /* Flex dengan ukuran dasar 200px */
    margin: 10px;
    min-width: 180px; /* Minimal lebar filter item */
}

.filter-item label {
    font-weight: bold;
    margin-bottom: 5px;
    display: block;
}

/* Mengatur agar dropdown (select) dan input tetap responsif */
.filter-item select,
.filter-item input[type="text"],
.filter-item button {
    width: 100%; /* Pastikan elemen mengisi seluruh lebar kontainer */
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ddd;
    margin-top: 5px;
    box-sizing: border-box; /* Menghindari permasalahan overflow */
    appearance: none; /* Menyembunyikan default style dropdown */
    -webkit-appearance: none;
    -moz-appearance: none;
}

/* Responsif untuk ukuran layar lebih kecil */
@media (max-width: 768px) {
    .filter-container {
        flex-direction: column;
        align-items: stretch;
    }

    .filter-item {
        width: 100%;
        margin: 10px 0;
    }

    .filter-item select,
    .filter-item input[type="text"],
    .filter-item button {
        width: 100%;
        padding: 12px;
    }
}

/* Styling untuk button filter */
.filter-item button {
    background-color: #007bff;
    color: white;
    cursor: pointer;
}

.filter-item button:hover {
    background-color: #0056b3;
}

/* Styling untuk input select saat di klik */
.filter-item select:focus {
    border-color: #0056b3;
    box-shadow: 0 0 5px rgba(0, 86, 179, 0.5);
}

/* Add this to ensure tables are scrollable on smaller screens */
.table-responsive {
    overflow-x: auto;
}

@media (max-width: 768px) {
    .table-responsive {
        -webkit-overflow-scrolling: touch; /* Adds smooth scrolling on mobile devices */
    }
    
    .table th, .table td {
        padding: 8px; /* Adjust padding for smaller screens */
        font-size: 14px;
    }
    
    /* Ensure filter container is properly adjusted on mobile */
    .filter-container {
        flex-direction: column;
        align-items: stretch;
    }

    .filter-item {
        width: 100%;
    }

    /* Ensure buttons don't overflow */
    .filter-item button {
        width: 100%;
        padding: 12px;
    }
}

    </style>
</head>
<body>

<div class="container">
    <div class="form-section">
        <div class="card p-4">
            <h4 class="text-center mb-4">Tambah Barang Baru</h4>
            <form action="../aksi/aksi_tambah.php" method="POST" enctype="multipart/form-data">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kode Barang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="kode" value="<?= $kodebaru; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama" placeholder="Nama barang" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kategori Barang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="kategori" placeholder="Kategori barang" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Stok Barang</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="stok" placeholder="Jumlah stok" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Harga/pcs</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="harga" placeholder="Harga per pcs" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Foto Barang</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" name="foto" accept="image/*" required>
                    </div>
                </div>
                <div class="text-right">
                    <button class="btn btn-info" type="submit"><i class="fas fa-plus"></i> Tambah</button>
                    <button class="btn btn-secondary" type="reset"><i class="fas fa-sync-alt"></i> Reset</button>
                </div>
            </form>
        </div>
    </div>

   

</body>
</html>