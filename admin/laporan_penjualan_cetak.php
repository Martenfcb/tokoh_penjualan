<?php
include '../function.php';
$where = [];

if (!empty($_GET['tanggal'])) {
	$where[] = "dp.tanggal = '" . $_GET['tanggal'] . "'";
}
if (!empty($_GET['bulan'])) {
	$where[] = "MONTH(dp.tanggal) = " . intval($_GET['bulan']);
}
if (!empty($_GET['tahun'])) {
	$where[] = "YEAR(dp.tanggal) = " . intval($_GET['tahun']);
}

$filterSql = $where ? "WHERE " . implode(' AND ', $where) : "";

$sql = "SELECT dp.kode, dp.nama, dp.jumlah, dp.harga, dp.tanggal,
			b.kategori, b.foto, b.stok
		FROM data_penjualan dp
		LEFT JOIN barang b ON dp.kode = b.kode
		$filterSql
		ORDER BY dp.tanggal DESC";

$data = select($sql);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cetak Laporan Penjualan</title>
	<style>
		table { width: 100%; border-collapse: collapse; }
		th, td { border: 1px solid #000; padding: 8px; text-align: center; }
		img { width: 50px; height: 50px; object-fit: cover; }
	</style>
</head>
<body onload="window.print()">
	<h2 align="center">Laporan Penjualan</h2>
	<table>
		<tr>
			<th>No</th>
			<th>Foto</th>
			<th>Kode</th>
			<th>Nama</th>
			<th>Kategori</th>
			<th>Stok</th>
			<th>Jumlah</th>
			<th>Harga</th>
			<th>Tanggal Terjual</th>
		</tr>
		<?php
		$no = 1;
		foreach ($data as $row) {
		?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td>
				<?php if (!empty($row['foto'])): ?>
					<img src="../uploads/<?php echo $row['foto']; ?>">
				<?php else: ?>
					-
				<?php endif; ?>
			</td>
			<td><?php echo $row['kode']; ?></td>
			<td><?php echo $row['nama']; ?></td>
			<td><?php echo $row['kategori']; ?></td>
			<td><?php echo $row['stok']; ?></td>
			<td><?php echo $row['jumlah']; ?></td>
			<td><?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
			<td><?php echo $row['tanggal']; ?></td>
		</tr>
		<?php } ?>
	</table>
</body>
</html>
