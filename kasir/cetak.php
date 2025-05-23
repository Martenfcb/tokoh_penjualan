<?php 
session_start();
include "../function.php";
$kode;
$nama;
$harga;

$bayar = $_POST['bayar'];

if($bayar == '')
{
    echo "<script>alert('pembayaran belum diinputkan');history.back()</script>";
}
else
{
    $sql = "SELECT * FROM `beli`";
    $a = select($sql);
    $no = 1;
    foreach ($a as $data)
    {
        $kode = $data['kode'];
        $nama = $data['nama'];
        $jumlah = $data['jumlah'];
        $harga = $data['harga'];

        $sql_barang = "SELECT * FROM `barang` WHERE kode = '$kode'";
        $a = update($sql_barang);
        $data = mysqli_fetch_array($a);
        $stok_awal = $data['stok'];

        if($stok_awal < $jumlah)
        {
            echo "<script>alert('stok $nama kurang');history.back()</script>";
        }
        else
        {
            $stok_akhir = $stok_awal - $jumlah;
            $sqlstok = "UPDATE `barang` SET `stok`= '$stok_akhir' WHERE kode = '$kode'";
            $a = update($sqlstok);

            $sql_insert_pembeli = "INSERT INTO `data_penjualan`(`kode`, `nama`, `jumlah`, `harga`,`tanggal`) VALUES ('$kode','$nama','$jumlah','$harga',now())";
            $insert = insert($sql_insert_pembeli);
        }
    }

    $total = $_POST['total'];
    $bayar = $_POST['bayar'];
    $kembali = $_POST['kembali'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Pembelian</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f4f8;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            text-align: center;
            color: #4CAF50;
            font-size: 2.5rem;
            margin-bottom: 30px;
        }

        /* Card Styling */
        .card {
            background: #ffffff;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            width: 100%;
            margin: 20px;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0px 20px 40px rgba(0, 0, 0, 0.15);
            transform: translateY(-10px);
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            text-align: left;
            font-size: 16px;
        }

        th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        td {
            background-color: #fff;
            color: #333;
            border-bottom: 1px solid #ddd;
        }

        tr:hover td {
            background-color: #f1f8f6;
        }

        /* Total Info Styling */
        .total-info {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            max-width: 900px;
            width: 100%;
        }

        .total-info table {
            width: 100%;
            font-size: 18px;
        }

        .total-info td {
            padding: 12px;
            color: #333;
        }

        .total-info td:first-child {
            font-weight: bold;
            color: #4CAF50;
        }

        .total-info td:last-child {
            font-weight: bold;
            color: #4CAF50;
        }

        /* Button Styling */
        a {
            display: inline-block;
            padding: 12px 25px;
            background-color: #4CAF50;
            color: white;
            font-size: 18px;
            text-decoration: none;
            border-radius: 30px;
            margin-top: 30px;
            transition: all 0.3s ease-in-out;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        a:hover {
            background-color: #45a049;
            transform: translateY(-3px);
            box-shadow: 0px 6px 18px rgba(0, 0, 0, 0.15);
        }

        /* Mobile Responsiveness */
        @media screen and (max-width: 768px) {
            h1 {
                font-size: 2rem;
                margin-bottom: 20px;
            }

            .card {
                padding: 15px;
            }

            th, td {
                font-size: 14px;
                padding: 10px;
            }

            .total-info td {
                font-size: 16px;
                padding: 8px;
            }

            a {
                font-size: 16px;
                padding: 10px 20px;
            }
        }

        /* Neumorphism Effect */
        .neumorphic {
            background: #e0e5ec;
            border-radius: 20px;
            box-shadow: 8px 8px 16px rgba(0, 0, 0, 0.2), -8px -8px 16px rgba(255, 255, 255, 0.7);
        }
    </style>
</head>
<body>
    <h1>Transaksi Pembelian - Bukti Pembayaran</h1>

    <div class="card neumorphic">
        <table>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Harga</th>
            </tr>
            <?php 
                $sql = "SELECT * FROM `beli`";
                $a = select($sql);
                $no = 1;
                foreach ($a as $data)
                {
            ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $data['nama']; ?></td>
                <td><?php echo $data['jumlah']; ?></td>
                <td><?php echo $data['harga']; ?></td>
            </tr>
            <?php  
                $no++;
                }
            ?>
        </table>
    </div>

    <div class="total-info neumorphic">
        <table>
            <tr>
                <td>Total :</td>
                <td><?php echo $total; ?></td>
            </tr>
            <tr>
                <td>Bayar :</td>
                <td><?php echo $bayar; ?></td>
            </tr>
            <tr>
                <td>Kembali :</td>
                <td><?php echo $kembali; ?></td>
            </tr>
        </table>
    </div>

    <a href="reset.php">Terimakasih</a>
</body>
</html>

<?php 

?>
