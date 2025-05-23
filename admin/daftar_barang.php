<?php
include 'header.php';
?>
<?php 
session_start();
include "../function.php";
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
<link rel="stylesheet" href="path/to/style.css">
<style>
/* Global Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Base Styling */
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f0f2f5;
    color: #333;
    line-height: 1.6;
}


/* Filter Form */
.filter-form {
    background-color: #fff;
    padding: 25px;
    margin: 30px auto;
    border-radius: 16px;
    max-width: 1000px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.filter-form .form-group {
    margin-bottom: 1rem;
}

.filter-form .form-control {
    border-radius: 10px;
    border: 1px solid #ccc;
    padding: 10px 14px;
    font-size: 1rem;
}

.filter-form .btn {
    border-radius: 10px;
    padding: 10px 18px;
    font-size: 1rem;
}

/* Table Section */
.table-section {
    padding: 20px;
    max-width: 1300px;
    margin: auto;
}

.table-section .card {
    background: #ffffff;
    border-radius: 18px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.07);
    margin-bottom: 40px;
    overflow: hidden;
}

.card-header {
    background-color: #343a40;
    color: white;
    padding: 15px 20px;
    font-size: 1.2rem;
    font-weight: 600;
}

.card-body {
    padding: 20px;
}

.card-body .card-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 10px;
}

.card-footer {
    background-color: #f8f9fa;
    padding: 15px 20px;
    border-top: 1px solid #eee;
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

.card-footer .btn {
    font-size: 0.875rem;
    border-radius: 8px;
}

/* Table Styling */
.table-responsive {
    border-radius: 12px;
    overflow-x: auto;
    margin-top: 20px;
}

.table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
}

.table thead {
    background-color: #212529;
    color: white;
}

.table th, .table td {
    padding: 14px 18px;
    text-align: left;
    border-bottom: 1px solid #e9ecef;
    font-size: 0.95rem;
    vertical-align: middle;
}

.table td img {
    max-width: 80px;
    height: auto;
    border-radius: 8px;
}

.table td:last-child {
    text-align: right;
}

/* Buttons */
.btn-warning, .btn-danger {
    padding: 6px 14px;
    font-size: 0.85rem;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.btn-warning:hover {
    background-color: #e0a800;
    color: #fff;
}

.btn-danger:hover {
    background-color: #c82333;
    color: #fff;
}

@media (max-width: 768px) {
    .table thead {
        background-color: #212529;
        color: white;
        display: table-header-group !important; /* PENTING: tetap tampilkan thead */
    }

    .table tr {
        display: table-row;
        margin-bottom: 0;
        background: transparent;
        border-radius: 0;
        box-shadow: none;
    }

    .table td, .table th {
        font-size: 0.9rem;
        padding: 10px 8px;
        text-align: left;
    }

    .table td {
        display: table-cell;
        border-bottom: 1px solid #e9ecef;
    }

    .table td::before {
        content: none !important; /* Matikan label mobile karena kita tetap pakai <thead> */
    }
}


</style>

</head>
<body>
  <div class="filter-form">
        <form method="GET" class="form-inline">
            <label class="mr-2 font-weight-bold">Pencarian Barang:</label>
            <select name="kategori" class="form-control mr-2">
                <option value="">-- Pilih Kategori Barang --</option>
                <?php foreach ($kategori_list as $kat): ?>
                    <option value="<?= $kat['kategori']; ?>" <?= $filter_kategori === $kat['kategori'] ? 'selected' : ''; ?>>
                        <?= $kat['kategori']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-dark"><i class="fas fa-search"></i> Cari</button>
            <?php if ($filter_kategori): ?>
                <a href="daftar_barang.php" class="btn btn-secondary ml-2">Reset</a>
            <?php endif; ?>
        </form>
    </div>

    <div class="table-section">
        <div class="card p-4">
            <h4 class="text-center mb-4">Daftar Barang</h4>
            <?php 
            $sql = "SELECT * FROM barang" . $filter_query;
            $barang = select($sql);
            ?>

            <?php if ($filter_kategori): ?>
                <div class="row">
                    <?php foreach ($barang as $data): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                <?php
                                $fotoPath = "../uploads/" . $data['foto'];
                                if (file_exists($fotoPath) && !empty($data['foto'])) {
                                    echo '<img src="' . $fotoPath . '" class="card-img-top" style="height:200px; object-fit:cover;" alt="Foto Barang">';
                                } else {
                                    echo '<div class="text-center text-danger pt-4">Foto tidak ditemukan</div>';
                                }
                                ?>
                                <div class="card-body">
                                    <h5 class="card-title"><?= $data['nama']; ?></h5>
                                    <p class="card-text mb-1"><strong>Kode:</strong> <?= $data['kode']; ?></p>
                                    <p class="card-text mb-1"><strong>Kategori:</strong> <?= $data['kategori']; ?></p>
                                    <p class="card-text mb-1"><strong>Stok:</strong> <?= $data['stok']; ?></p>
                                    <p class="card-text"><strong>Harga:</strong> Rp <?= number_format($data['harga'], 0, ',', '.'); ?></p>
                                </div>
                                <div class="card-footer bg-white text-right">
                                    <a href="ubah_barang.php?kode=<?= $data['kode']; ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Ubah
                                    </a>
                                    <a href="hapus_barang.php?kode=<?= $data['kode']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus barang ini?');">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php if (count($barang) === 0): ?>
                        <div class="col-12 text-muted text-center">Tidak ada data barang untuk kategori ini.</div>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($barang as $data): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $data['kode']; ?></td>
                                    <td><?= $data['nama']; ?></td>
                                    <td><?= $data['kategori']; ?></td>
                                    <td><?= $data['stok']; ?></td>
                                    <td>Rp <?= number_format($data['harga'], 0, ',', '.'); ?></td>
                                    <td>
                                        <?php
                                        $fotoPath = "../uploads/" . $data['foto'];
                                        if (file_exists($fotoPath) && !empty($data['foto'])) {
                                            echo '<img src="' . $fotoPath . '" width="60">';
                                        } else {
                                            echo '<span class="text-danger">Tidak ada</span>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="ubah_barang.php?kode=<?= $data['kode']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                        <a href="hapus_barang.php?kode=<?= $data['kode']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus barang ini?');"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>