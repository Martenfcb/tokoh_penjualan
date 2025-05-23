<?php
// Fungsi koneksi ke database
function koneksi() {
    $conn = mysqli_connect("localhost", "root", "", "kasir");
    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }
    return $conn;
}

// Fungsi select untuk mengambil data
function select($query) {
    $conn = koneksi();
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// Fungsi insert data
function insert($query) {
    $conn = koneksi();
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Insert Error: " . mysqli_error($conn));
    }
    return $result;
}

// Fungsi update data
function update($query) {
    $conn = koneksi();
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Update Error: " . mysqli_error($conn));
    }
    return $result;
}

// Fungsi delete data
function delete($query) {
    $conn = koneksi();
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Delete Error: " . mysqli_error($conn));
    }
    return $result;
}

// Fungsi untuk mengambil data barang berdasarkan kode
function getBarangByKode($kode) {
    $conn = koneksi();
    $query = "SELECT * FROM barang WHERE kode_barang = '" . mysqli_real_escape_string($conn, $kode) . "'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query Error: " . mysqli_error($conn));
    }
    return mysqli_fetch_assoc($result);
}
?>
