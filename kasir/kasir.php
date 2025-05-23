<?php 
session_start();
include "../function.php";

$name = $_SESSION['username'] ?? null;
$pass = $_SESSION['password'] ?? null;

if (!$name || !$pass) {
    echo "<script>alert('Anda belum login'); history.back();</script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kasir</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../style/bootstrap.min.css">
    <link rel="stylesheet" href="../style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background: #343a40;
            padding: 12px 20px;
        }

        .navbar-brand, .navbar-text a {
            color: #fff !important;
            font-weight: 600;
            font-size: 1.2rem;
        }

        .container {
            background: #fff;
            margin: 30px auto;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.08);
        }

        h3 {
            font-weight: 600;
            color: #007bff;
            border-left: 5px solid #007bff;
            padding-left: 12px;
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 10px;
            height: 45px;
        }

        .btn {
            border-radius: 10px;
            padding: 10px 18px;
            font-weight: 500;
            transition: 0.3s ease;
        }

        .btn:hover {
            transform: scale(1.03);
            opacity: 0.9;
        }

        .btn-info { background: #17a2b8; border: none; }
        .btn-danger { background: #dc3545; border: none; }

        .table th {
            background: #007bff;
            color: white;
        }

        .table td, .table th {
            text-align: center;
            vertical-align: middle;
        }

        @media screen and (max-width: 768px) {
            .form-row {
                flex-direction: column;
            }

            .form-row .col-md-4, .form-row .col-md-6 {
                width: 100% !important;
            }

            h3 {
                font-size: 1.2rem;
            }

            .navbar-brand {
                font-size: 1rem;
            }

            .table th, .table td {
                font-size: 0.85rem;
                padding: 6px;
            }

            .btn {
                padding: 6px 12px;
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
        <img src="../img/logo.png" width="30" height="30" class="d-inline-block align-top me-2" alt="">
        Kasir
    </a>
    <span class="navbar-text">
        <a href="../">Log Out</a>
    </span>
</nav>

<div class="container">
    <h3>Pilih Kategori Barang</h3>
    <div class="form-row">
        <div class="col-md-6 mb-3">
            <label>Kategori</label>
            <select class="form-control" id="kategori">
                <option value="">-- Pilih Kategori --</option>
                <?php 
                $kategori = select("SELECT DISTINCT kategori FROM barang");
                foreach ($kategori as $row): ?>
                    <option value="<?= $row['kategori']; ?>"><?= $row['kategori']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div id="barang"></div>

    <div id="beli" class="table-responsive mt-4">
        <table class="table table-bordered table-sm table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <!-- <th>Foto</th> -->
                    <th>Jumlah</th>
                    <th>Tambah</th>
                    <th>Kurang</th>
                    <th>Harga Barang</th>
                    <th>Batal</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $a = select("SELECT * FROM beli");
                $no = 1;
                foreach ($a as $data):
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $data['kode']; ?></td>
                    <td><?= $data['nama']; ?></td>
                    <!-- <td>
                    <?php
                    $fotoPath = "../uploads/" . $data['foto'];
                    if (file_exists($fotoPath) && !empty($data['foto'])) {
                        echo '<img src="' . $fotoPath . '" width="60">';
                    } else {
                        echo '<span class="text-danger">Tidak ada</span>';
                    }
                    ?>
                </td> -->
                    <td><input type="text" name="jml" value="<?= $data['jumlah']; ?>"></td>
                    <td><a class="btn btn-info" href="update_tambah.php?kode=<?= $data['kode']; ?>">+</a></td>
                    <td><a class="btn btn-info" href="update_kurang.php?kode=<?= $data['kode']; ?>">-</a></td>
                    <td><input type="text" name="harga" value="<?= $data['harga']; ?>"></td>
                    <td><a class="btn btn-danger" href="hapus.php?kode=<?= $data['kode']; ?>">X</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <h3>Pembayaran</h3>
    <form action="cetak.php" method="POST">
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label>Total</label>
                <?php
                    $totalData = select("SELECT SUM(harga) as total FROM beli");
                    $total = $totalData[0]['total'] ?? 0;
                ?>
                <input type="text" class="form-control" name="total" id="total" value="<?= $total; ?>" autocomplete="off">
            </div>
            <div class="col-md-4 mb-3">
                <label>Bayar</label>
                <input type="text" class="form-control" name="bayar" id="bayar" autocomplete="off">
            </div>
            <div class="col-md-4 mb-3">
                <label>Kembalian</label>
                <input type="text" class="form-control" name="kembali" id="kembali" autocomplete="off">
            </div>
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-info">Submit</button>
            <button type="button" onclick="reset()" class="btn btn-danger">Reset</button>
        </div>
    </form>
</div>

<script>
    const kategori = document.getElementById('kategori');
    const barang = document.getElementById('barang');

    kategori.addEventListener('change', function () {
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                barang.innerHTML = xhr.responseText;
            }
        };
        xhr.open('GET', 'barang.php?kategori=' + kategori.value, true);
        xhr.send();
    });

    // Fitur tambah barang ke daftar beli
    function beliBarang(kode) {
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById('beli').innerHTML = xhr.responseText;
            }
        };
        xhr.open('GET', 'add_beli.php?kode=' + kode, true);
        xhr.send();
    }

    const total = document.getElementById('total');
    const bayar = document.getElementById('bayar');
    const kembali = document.getElementById('kembali');

    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(angka);
    }

    function cleanNumber(str) {
        return parseInt(str.replace(/[^0-9]/g, '')) || 0;
    }

    bayar.addEventListener('keyup', function () {
        const totalVal = cleanNumber(total.value);
        const bayarVal = cleanNumber(bayar.value);
        const kembalian = bayarVal - totalVal;
        kembali.value = formatRupiah(kembalian >= 0 ? kembalian : 0);
    });

    window.addEventListener('DOMContentLoaded', () => {
        total.value = formatRupiah(cleanNumber(total.value));
    });

    function reset() {
        window.location = 'reset.php';
    }
</script>

</body>
</html>
