<!DOCTYPE html>
<html>
<head>
	<title>Admin | Laporan Data Penjualan</title>
	<link rel="stylesheet" type="text/css" href="../style/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		.img-thumbnail {
			width: 60px;
			height: 60px;
			object-fit: cover;
		}
	</style>
</head>
<?php include 'header.php'; ?>
<body>
<div class="container"><br>

	<div style="text-align: center;">
		<h2>Laporan Data Penjualan</h2>
	</div>

	<!-- Filter Form -->
	<form method="GET" class="form-inline mb-4">
		<label class="mr-2">Tanggal:</label>
		<input type="date" name="tanggal" class="form-control mr-3" value="<?php echo $_GET['tanggal'] ?? ''; ?>">

		<label class="mr-2">Bulan:</label>
		<select name="bulan" class="form-control mr-3">
			<option value="">--Pilih--</option>
			<?php
				for ($i = 1; $i <= 12; $i++) {
					$selected = (isset($_GET['bulan']) && $_GET['bulan'] == $i) ? "selected" : "";
					echo "<option value='$i' $selected>".date("F", mktime(0, 0, 0, $i, 10))."</option>";
				}
			?>
		</select>

		<label class="mr-2">Tahun:</label>
		<select name="tahun" class="form-control mr-3">
			<option value="">--Pilih--</option>
			<?php
				$yearNow = date('Y');
				for ($y = 2020; $y <= $yearNow; $y++) {
					$selected = (isset($_GET['tahun']) && $_GET['tahun'] == $y) ? "selected" : "";
					echo "<option value='$y' $selected>$y</option>";
				}
			?>
		</select>

		<button type="submit" class="btn btn-primary mr-2">Tampilkan</button>
		<a href="laporan_penjualan_cetak.php?<?php echo http_build_query($_GET); ?>" class="btn btn-success" target="_blank">Cetak</a>
	</form>

	<table class="table table-bordered table-striped">
		<thead class="thead-dark">
			<tr>
				<th>No</th>
				<th>Foto</th>
				<th>Kode</th>
				<th>Nama</th>
				<th>Kategori</th>
				<th>Stok</th>
				<th>Jumlah</th>
				<th>Harga</th>
				<th>Tanggal</th>
			</tr>
		</thead>
		<tbody>
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

			$filterSql = $where ? "WHERE " . implode(' AND ', $where) : "WHERE dp.tanggal = CURDATE()";

			$sql = "SELECT dp.kode, dp.nama, dp.jumlah, dp.harga, dp.tanggal,
						b.kategori, b.foto, b.stok
					FROM data_penjualan dp
					LEFT JOIN barang b ON dp.kode = b.kode
					$filterSql
					ORDER BY dp.tanggal DESC";

			$dataPenjualan = select($sql);
			$no = 1;
			foreach ($dataPenjualan as $data) {
			?>
			<tr>
				<td><?php echo $no++; ?></td>
				<td>
					<?php if (!empty($data['foto'])): ?>
						<img src="../uploads/<?php echo htmlspecialchars($data['foto']); ?>" class="img-thumbnail">
					<?php else: ?>
						<small>Tidak ada gambar</small>
					<?php endif; ?>
				</td>
				<td><?php echo $data['kode']; ?></td>
				<td><?php echo $data['nama']; ?></td>
				<td><?php echo htmlspecialchars($data['kategori']); ?></td>
				<td><?php echo $data['stok']; ?></td>
				<td><?php echo $data['jumlah']; ?></td>
				<td><?php echo number_format($data['harga'], 0, ',', '.'); ?></td>
				<td><?php echo $data['tanggal']; ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
</body>
</html>
