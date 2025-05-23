<?php
session_start();
include '../koneksi.php';
include 'header.php';

$edit = null; // Tambahkan ini untuk menghindari warning
if (isset($_GET['edit'])) {
    $username_edit = $_GET['edit'];
    $query_edit = mysqli_query($koneksi, "SELECT * FROM akun WHERE username='$username_edit'");
    if (mysqli_num_rows($query_edit) === 1) {
        $edit = mysqli_fetch_assoc($query_edit);
    }
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($koneksi, "SELECT * FROM akun WHERE username='$username'");
    if (mysqli_num_rows($result) === 1) {
        $akun = mysqli_fetch_assoc($result);

        if (password_verify($password, $akun['password'])) {
            // langsung cocokkan string
            $_SESSION['username'] = $akun['username'];
            $_SESSION['kategori'] = $akun['kategori'];

            if ($akun['kategori'] == 'admin') {
                header("Location: admin/dashboard.php");
            } else {
                header("Location: petugas/dashboard.php");
            }
            exit;
        } else {
            echo "<script>alert('Password salah');</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan');</script>";
    }
}


if (isset($_POST['tambah'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; // langsung ambil tanpa hash
    $kategori = $_POST['kategori'];

    mysqli_query($koneksi, "INSERT INTO akun (username, password, kategori) VALUES ('$username', '$password', '$kategori')");
    header("Location: akun.php");
    exit;
}


if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $new_username = $_POST['new_username']; // Username baru untuk update
    $password = $_POST['password']; // Tidak meng-hash password
    $kategori = $_POST['kategori'];

    // Jika password tidak diubah (kosongkan form password), maka tidak perlu update password
    if (empty($password)) {
        $update_query = "UPDATE akun SET username='$new_username', kategori='$kategori' WHERE username='$username'";
    } else {
        $update_query = "UPDATE akun SET username='$new_username', password='$password', kategori='$kategori' WHERE username='$username'";
    }

    mysqli_query($koneksi, $update_query);
    header("Location: akun.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Akun</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7f8fa;
            padding-top: 30px;
            margin: 0;
        }

        h2 {
            text-align: center;
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
        }

        .form-container, .edit-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 500px;
        }

        .form-container h3, .edit-form h3 {
            color: #333;
            margin-bottom: 15px;
            font-size: 22px;
        }

        input[type=text], input[type=password], select {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            transition: 0.2s ease;
        }

        input[type=text]:focus, input[type=password]:focus, select:focus {
            border-color: #007bff;
        }

        button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.2s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .table-container {
            max-width: 1000px;
            margin: 20px auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
            background-color: #fff;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tbody tr:hover {
            background-color: #f7f7f7;
        }

        td a {
            color: #007bff;
            text-decoration: none;
            font-weight: 600;
        }

        td a:hover {
            text-decoration: underline;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            input[type=text], input[type=password], select, button {
                font-size: 14px;
                padding: 10px;
            }

            table {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Manajemen Akun</h2>

    <?php if ($edit): ?>

        <!-- Form Edit -->
        <div class="edit-form">
            <h3>Edit Akun</h3>
            <form method="POST">
                <input type="hidden" name="username" value="<?= htmlspecialchars($edit['username']) ?>">
                <input type="text" name="new_username" value="<?= htmlspecialchars($edit['username']) ?>" placeholder="Username Baru" required><br>
                <input type="password" name="password" placeholder="Kosongkan jika tidak ubah password"><br>
                <select name="kategori" required>
                    <option value="admin" <?= $edit['kategori'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="kasir" <?= $edit['kategori'] == 'kasir' ? 'selected' : '' ?>>Kasir</option>
                </select><br>

                <button type="submit" name="update">Simpan Perubahan</button>
                <a href="akun.php">Batal</a>
            </form>
        </div>
    <?php else: ?>
        <!-- Form Tambah -->
        <div class="form-container">
            <form method="POST">
                <h3>Tambah Akun Baru</h3>
                <input type="text" name="username" placeholder="Username" required><br>
                <input type="password" name="password" placeholder="Password" required><br>
                <select name="kategori" required>
                    <option value="">Pilih Kategori</option>
                    <option value="admin">Admin</option>
                    <option value="kasir">Kasir</option>
                </select><br>

                <button type="submit" name="tambah">Tambah</button>
            </form>
        </div>
    <?php endif; ?>

    <!-- Tabel Data Akun -->
    <div class="table-container">
        <table>
            <tr>
                <th>Username</th>
                <th>Password</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
            <?php
            $data = mysqli_query($koneksi, "SELECT * FROM akun");
            while ($row = mysqli_fetch_assoc($data)):
            ?>
            <tr>
                <td><?= htmlspecialchars($row['username']) ?></td>
                <td><?= htmlspecialchars($row['password']) ?></td>
                <td><?= htmlspecialchars($row['kategori']) ?></td>
                <td>
                    <a href="?edit=<?= urlencode($row['username']) ?>">Edit</a> |
                    <a href="?hapus=<?= urlencode($row['username']) ?>" onclick="return confirm('Hapus akun ini?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>

</body>
</html>
