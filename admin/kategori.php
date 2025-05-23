<?php 
session_start();
include "../function.php";
include "header.php";

// Cek login
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    echo "<script>alert('Anda belum login');history.back()</script>";
    exit;
}

// Ambil semua kategori unik dari database
$kategori_list = select("SELECT DISTINCT kategori FROM barang");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Kategori Barang</title>
    <link rel="stylesheet" href="../style/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #f0f4f8, #ffffff);
            padding-top: 80px;
            margin: 0;
        }

        .table-wrapper {
            max-width: 800px;
            margin: auto;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            padding: 40px 30px;
        }

        h3 {
            font-weight: 600;
            text-align: center;
            margin-bottom: 30px;
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #2c3e50;
            color: #fff;
        }

        th, td {
            padding: 14px 16px;
            text-align: center;
        }

        tbody tr {
            transition: all 0.3s ease;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
            transform: scale(1.01);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .icon {
            color: #3498db;
            margin-right: 8px;
        }

        @media (max-width: 576px) {
            th, td {
                font-size: 14px;
                padding: 10px;
            }

            h3 {
                font-size: 22px;
            }
        }
    </style>
</head>
<body>

<div class="table-wrapper">
    <h3><i class="fas fa-list-alt icon"></i>Daftar Kategori Barang</h3>
    <div class="table-responsive">
        <table class="table align-middle table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th><i class="fas fa-box icon"></i>Kategori</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($kategori_list as $kategori): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td class="text-capitalize"><?= htmlspecialchars($kategori['kategori']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
