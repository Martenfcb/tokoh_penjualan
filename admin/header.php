<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>

<style>
/* Gradient background dan efek hover */
.bg-gradient-custom {
    background: linear-gradient(90deg, #141e30 0%, #243b55 100%);
}

.navbar .nav-link {
    color: #f1f1f1;
    transition: all 0.3s ease;
}

.navbar .nav-link:hover {
    color: #00d4ff;
    transform: translateY(-2px);
}

.logout-btn {
    background-color: #dc3545;
    color: white !important;
    transition: background 0.3s ease;
}

.logout-btn:hover {
    background-color: #bd2130;
}

/* Beri padding pada konten utama agar tidak tertutup header */
body {
    padding-top: 75px; /* Atur sesuai tinggi navbar */
}
/* Navbar */
.navbar {
    background-color: #343a40;
    padding: 1rem 2rem;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
}

.navbar-brand {
    font-weight: bold;
    color: #fff;
    font-size: 1.4rem;
}

.navbar-nav .nav-link {
    color: #fff !important;
    margin-left: 1rem;
    transition: color 0.3s ease;
}

.navbar-nav .nav-link:hover {
    color: #ffc107 !important;
}


</style>

<body>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<nav class="navbar navbar-expand-lg navbar-dark bg-gradient-custom shadow-sm py-3 fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
            <i class="fas fa-user-shield me-2"></i> Admin 
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="home.php"><i class="fas fa-chart-line me-1"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="penjualan.php"><i class="fas fa-chart-line me-1"></i>Total Penjualan</a>
                </li>
                <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="barangDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-boxes me-1"></i> Barang
    </a>
    <ul class="dropdown-menu" aria-labelledby="barangDropdown">
        <li><a class="dropdown-item" href="daftar_barang.php">Data Barang</a></li>
        <li><a class="dropdown-item" href="tambah.php">Tambah Barang</a></li>
    </ul>
</li>

                <li class="nav-item">
                    <a class="nav-link" href="akun.php"><i class="fas fa-boxes me-1"></i>Pengguna</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link logout-btn px-3 py-1 rounded" href="../"><i class="fas fa-sign-out-alt me-1"></i> Log Out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


</body>
</html>