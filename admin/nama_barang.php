<?php
include '../koneksi.php';
include '../function.php';

$data_barang = select("SELECT kode, nama, harga, foto FROM barang");

?>
<?php
include 'header.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar Barang</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
  body {
    background: linear-gradient(to right, #f9f9f9, #e6eaf1);
    font-family: 'Poppins', sans-serif;
    margin-bottom: 50px;
  }

  .container {
    padding-top: 40px;
  }

  h2 {
    font-size: 32px;
    color: #333;
  }

  .card-img-top {
  max-height: 200px;
  width: 100%;
  object-fit: contain;
  background-color: #f9f9f9;
  padding: 10px;
  border-bottom: 1px solid #eee;
}


  .card {
    border: none;
    border-radius: 15px;
    transition: all 0.3s ease-in-out;
    background-color: #ffffff;
    overflow: hidden;
    height: 100%;
  }

  .card:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
  }

  .card-img-top {
    height: 180px;
    object-fit: cover;
    width: 100%;
    transition: transform 0.3s ease;
    border-bottom: 1px solid #eee;
  }

  .card-img-top:hover {
    transform: scale(1.05);
  }

  .card-body {
    padding: 15px;
  }

  .card-title {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 8px;
    color: #333;
  }

  .card-text {
    color: #198754;
    font-size: 16px;
    font-weight: 500;
  }

  .btn-detail {
    background-color: #0d6efd;
    color: white;
    border-radius: 20px;
    padding: 8px 20px;
    font-size: 14px;
    text-decoration: none;
    transition: background-color 0.3s ease;
  }

  .btn-detail:hover {
    background-color: #0b5ed7;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  }

  @media (max-width: 576px) {
    .card-img-top {
      height: 150px;
    }

    .card-title {
      font-size: 16px;
    }

    .card-text {
      font-size: 14px;
    }

    .btn-detail {
      font-size: 13px;
    }
  }

  @media (min-width: 768px) and (max-width: 991px) {
    .card-img-top {
      height: 160px;
    }
  }
</style>

</head>
<body>

<div class="container">
  <h2 class="text-center mb-5 fw-bold">Daftar Barang</h2>
  <div class="row justify-content-center">
    <?php foreach ($data_barang as $barang): ?>
        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
        <div class="card h-100 shadow-sm">
        <img src="../uploads/<?= $barang['foto']; ?>" class="card-img-top" alt="<?= htmlspecialchars($barang['nama']); ?>">
          <div class="card-body text-center">
            <h5 class="card-title"><?= htmlspecialchars($barang['nama']); ?></h5>
            <p class="card-text">Rp <?= number_format($barang['harga'], 0, ',', '.'); ?></p>
            <a href="detail_barang.php?kode=<?= urlencode($barang['kode']); ?>" class="btn btn-detail mt-2">Lihat Detail</a>

          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

</body>
</html>
