-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Bulan Mei 2025 pada 12.48
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `kategori` enum('admin','kasir') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`username`, `password`, `kategori`) VALUES
('admin', '123', 'admin'),
('qq', '1234', 'kasir'),
('toko 1', 'kasir', 'kasir'),
('yogi', '123', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `kode` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `stok` int(100) DEFAULT NULL,
  `harga` int(50) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT curdate(),
  `terjual` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`kode`, `nama`, `kategori`, `stok`, `harga`, `foto`, `tanggal`, `terjual`) VALUES
('BRG001', 'siswaa', 'jam', 305, 270000, 'foto.jpg', '2025-05-08', 0),
('BRG002', 'jamaaa', 'jam', 29, 22, 'foto.jpg', '2025-05-08', 0),
('BRG003', 's', 'jam', 2, 2000000, 'background.jpeg', '2025-05-08', 0),
('BRG006', 'ss', 'jam', 221, 222, 'download.jpg', '2025-05-08', 0),
('BRG007', 'siswa', 'TOPI', 1, 270000, '1746771929_1 (7).jpeg', '2025-05-09', 0),
('BRG008', 'siswa', 'JAM TANGAN', 1, 270000, '1746773401_1 (7).jpeg', '2025-05-09', 0),
('BRG009', 'topi koboi', 'MASKER', 2, 270000, '1746779649_WhatsApp Image 2024-09-02 at 06.30.14.jpeg', '2025-05-09', 0),
('BRG010', 'ssssssss', 'ss', 222, 2222, '1746784538_WhatsApp Image 2024-09-02 at 06.30.14.jpeg', '2025-05-09', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `beli`
--

CREATE TABLE `beli` (
  `kode` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `jumlah` int(50) NOT NULL,
  `harga` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_penjualan`
--

CREATE TABLE `data_penjualan` (
  `kode` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jumlah` int(50) NOT NULL,
  `harga` int(50) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `data_penjualan`
--

INSERT INTO `data_penjualan` (`kode`, `nama`, `jumlah`, `harga`, `tanggal`) VALUES
('BRG002', 'jam', 3, 66, '2025-05-08'),
('BRG006', 'ss', 1, 222, '2025-05-09'),
('BRG002', 'jamaaa', 1, 22, '2025-05-09'),
('BRG007', 'siswa', 1, 270000, '2025-05-09'),
('BRG008', 'siswa', 1, 270000, '2025-05-09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `items`
--

CREATE TABLE `items` (
  `kode` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `items`
--

INSERT INTO `items` (`kode`, `nama`, `stok`, `harga`, `created_at`, `updated_at`) VALUES
('101', 'semen gresik/sak', 5, 53000, NULL, '2021-01-17 13:02:52'),
('102', 'semen tiga roda/sak', 25, 49000, NULL, NULL),
('103', 'semen bima/sak', 33, 46000, NULL, NULL),
('201', 'paku 2cm/kg', 24, 15000, NULL, '2021-01-17 13:06:08'),
('202', 'paku 3cm/kg', 14, 15000, NULL, NULL),
('203', 'paku 5cm/kg', 56, 15000, NULL, NULL),
('301', 'cat tembok paragon 1kg', 10, 790000, NULL, NULL),
('302', 'cat tembok paragon 0.5kg', 14, 45000, NULL, NULL),
('311', 'cat tembok deco 1kg', 22, 78000, NULL, NULL),
('312', 'cat tembok deco 0.5kg', 19, 45000, NULL, NULL),
('401', 'asbes 1.5m x 6m', 56, 60000, NULL, NULL),
('402', 'seng 1.5m x 6m', 33, 47000, NULL, NULL),
('501', 'tong d 30cm', 15, 15000, NULL, NULL),
('601', 'kuas 25', 9, 25000, NULL, NULL),
('701', 'pacul', 11, 50000, '2021-01-09 07:09:04', '2021-01-17 13:15:29'),
('s', 'ss', 2, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('s', 'ss', 2, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('s', 'ss', 2, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2014_10_12_000000_create_users_table', 1),
(5, '2014_10_12_100000_create_password_resets_table', 1),
(6, '2019_08_19_000000_create_failed_jobs_table', 1),
(7, '2021_01_09_102337_create_items_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode`);

--
-- Indeks untuk tabel `beli`
--
ALTER TABLE `beli`
  ADD KEY `kode` (`kode`);

--
-- Indeks untuk tabel `data_penjualan`
--
ALTER TABLE `data_penjualan`
  ADD KEY `kode` (`kode`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `beli`
--
ALTER TABLE `beli`
  ADD CONSTRAINT `beli_ibfk_1` FOREIGN KEY (`kode`) REFERENCES `barang` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_penjualan`
--
ALTER TABLE `data_penjualan`
  ADD CONSTRAINT `data_penjualan_ibfk_1` FOREIGN KEY (`kode`) REFERENCES `barang` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
