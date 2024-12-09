<?php
session_start(); // Mulai sesi untuk notifikasi
require_once 'CustomerManager.php';

$customerManager = new CustomerManager();

// Tambah Pelanggan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah_customer'])) {
    $nama = $_POST['nama_customer'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $customerManager->tambahCustomer($nama, $alamat, $telepon);
    $_SESSION['message'] = "Pelanggan berhasil ditambahkan!";
    header('Location: datacustomer.php');
    exit;
}

// Hapus Pelanggan
if (isset($_GET['hapus_customer'])) {
    $id = $_GET['hapus_customer'];
    $customerManager->hapusCustomer($id);
    $_SESSION['message'] = "Pelanggan berhasil dihapus!";
    header('Location: datacustomer.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pelanggan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffe4e9; /* Pink muda untuk latar belakang */
            color: #333; /* Warna teks utama */
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff; /* Putih untuk kontras */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #d6336c; /* Warna pink cerah */
        }

        .dashboard-link {
            position: absolute;
            top: 10px;
            left: 10px;
            color: #d6336c;
            text-decoration: none;
            font-weight: bold;
            padding: 5px 10px;
            background-color: #fff;
            border: 1px solid #d6336c;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .dashboard-link:hover {
            background-color: #ffe6eb; /* Warna pink lembut saat hover */
            color: #c2185b; /* Warna pink lebih gelap */
        }

        .message {
            background-color: #f8d7da; /* Pink muda untuk pesan */
            color: #842029;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #f5c2c7;
            border-radius: 5px;
        }

        form div {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #d6336c;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            background-color: #d6336c;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #c2185b; /* Warna pink lebih gelap saat hover */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }

        th {
            background-color: #fcd4e0; /* Pink terang untuk header tabel */
            color: #d6336c;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #ffe6eb; /* Highlight warna pink lembut */
        }

        .btn {
            text-decoration: none;
            color: white;
            background-color: #d6336c;
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 14px;
        }

        .btn-delete {
            background-color: #e3342f; /* Warna merah untuk tombol hapus */
        }

        .btn-delete:hover {
            background-color: #c72c1d; /* Warna merah lebih gelap saat hover */
        }
    </style>
</head>
<body>
    <!-- Link Kembali ke Dashboard -->
    <a href="index.php" class="dashboard-link">Kembali ke Dashboard</a>

    <div class="container">
        <h1>Pencatatan Pelanggan</h1>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="message">
                <?= $_SESSION['message']; ?>
                <?php unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div>
                <label for="nama_customer">Nama Pelanggan:</label>
                <input type="text" id="nama_customer" name="nama_customer" required>
            </div>
            <div>
                <label for="alamat">Alamat:</label>
                <textarea id="alamat" name="alamat" required></textarea>
            </div>
            <div>
                <label for="telepon">Telepon:</label>
                <input type="text" id="telepon" name="telepon" required>
            </div>
            <button type="submit" name="tambah_customer">Tambah Pelanggan</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customerManager->getCustomers() as $customer): ?> 
                    <tr>
                        <td><?= $customer['id'] ?></td>
                        <td><?= $customer['nama'] ?></td>
                        <td><?= $customer['alamat'] ?></td>
                        <td><?= $customer['telepon'] ?></td>
                        <td>
                            <a href="?hapus_customer=<?= $customer['id'] ?>" class="btn btn-delete">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
