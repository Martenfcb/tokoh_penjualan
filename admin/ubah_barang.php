<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once "../function.php";

$name = $_SESSION['username'];
$pass = $_SESSION['password'];
$kode = $_GET['kode'];

if(!isset($name) || !isset($pass)) {
    echo "<script>alert('Anda belum login');history.back()</script>";
    exit;
}

// Ambil data barang berdasarkan kode
$sql = "SELECT * FROM `barang` WHERE kode = '$kode'";
$result = select($sql);

if (count($result) == 0) {
    echo "<script>alert('Data barang tidak ditemukan');history.back()</script>";
    exit;
}

$data = $result[0];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin | Update Barang</title>
    <link rel="stylesheet" type="text/css" href="../style/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="container">
    <br><br>
    <h3 align="center">Update Barang</h3><br>
    <form action="../aksi/aksi_ubah.php" method="POST">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Kode</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="kode" readonly value="<?php echo $data['kode']; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="nama" autocomplete="off" value="<?php echo $data['nama']; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Stok</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name="stok" autocomplete="off" value="<?php echo $data['stok']; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Harga/pcs</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name="harga" autocomplete="off" value="<?php echo $data['harga']; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Kategori</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="kategori" autocomplete="off" value="<?php echo $data['kategori']; ?>">
            </div>
        </div>
        <div class="form-group row">
    <label class="col-sm-2 col-form-label">Foto</label>
    <div class="col-sm-10">
        <input type="file" class="form-control" name="foto" accept="image/*">
        <img src="../uploads/<?php echo $data['foto']; ?>" alt="Foto Barang" style="width: 150px; height: 150px; margin-top: 10px;">
    </div>
</div>

        <div align="right">
            <button class="btn btn-info" type="submit">Ubah</button>
            <button class="btn btn-danger" type="reset">Reset</button>
        </div>
    </form>
</div>
</body>
</html>
