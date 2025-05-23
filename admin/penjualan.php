<!DOCTYPE html>
<html>
<head>
    <title>Admin | Data Penjualan</title>
    <link rel="stylesheet" href="../style/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
include 'header.php';
?>
    <style>
        body {
            background-color: #f7f9fc;
        }
        .card-stat {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            transition: 0.3s;
        }
        .card-stat:hover {
            transform: translateY(-5px);
        }
        .card-header-custom {
            font-weight: bold;
            color: #fff;
            border-radius: 12px 12px 0 0;
            padding: 10px 20px;
        }
        .bg-gradient-blue {
            background: linear-gradient(45deg, #4e73df, #224abe);
        }
        .card-body h4 {
            font-size: 2.2rem;
            color: #4a4a4a;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .btn-logout {
            background-color: #dc3545;
            color: white !important;
            font-weight: bold;
            border-radius: 8px;
            padding: 5px 15px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
<div class="container mt-5 mb-5">
    <div class="text-center mb-4">
        <h2>Total Penjualan Barang</h2>
        <h5><small><?php echo date('l, d M Y'); ?></small></h5>
    </div>

    <?php 
    include '../function.php';
    $sql = "SELECT SUM(harga) as total FROM data_penjualan WHERE tanggal=DATE(NOW())";
    $a = select($sql);
    $total = $a[0]['total'] ?? 0;
    ?>

    <div class="row justify-content-center mb-4">
        <div class="col-md-6 col-lg-4">
            <div class="card card-stat">
                <div class="card-header-custom bg-gradient-blue">
                    Total Penjualan Hari Ini
                </div>
                <div class="card-body text-center">
                    <h4>Rp <?php echo number_format($total, 0, ',', '.'); ?></h4>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-3 text-right">
        <button class="btn btn-success" onclick="window.location.href = 'export_excel.php'">EXPORT EXCEL</button>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center">
            <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Tanggal</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            $sql = "SELECT * FROM `data_penjualan` WHERE tanggal=DATE(NOW())";
            $a = select($sql);
            $no = 1;
            foreach ($a as $data) {
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['kode']; ?></td>
                <td><?php echo $data['nama']; ?></td>
                <td><?php echo $data['jumlah']; ?></td>
                <td>Rp <?php echo number_format($data['harga'], 0, ',', '.'); ?></td>
                <td><?php echo $data['tanggal']; ?></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Script JS Bootstrap agar toggle navbar berfungsi -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
