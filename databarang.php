<?php
session_start(); // Mulai sesi untuk notifikasi
require_once 'barang.php';
require_once 'barangManager.php';

$barangManager = new BarangManager();

// Tambah Barang
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $barangManager->tambahBarang($nama, $harga, $stok);
    $_SESSION['message'] = "Barang berhasil ditambahkan!";
    header('Location: databarang.php');
    exit;
}

// Hapus Barang
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $barangManager->hapusBarang($id);
    $_SESSION['message'] = "Barang berhasil dihapus!";
    header('Location: databarang.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Barang</title>
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

    </style>
</head>
<body>
    <div class="container">
        <h1>Pencatatan Barang</h1>
        <a href="index.php">Kembali ke Dashboard</a>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="message">
                <?= $_SESSION['message']; ?>
                <?php unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div>
                <label for="nama">Nama Barang:</label><br>
                <input type="text" id="nama" name="nama" required>
            </div>
            <div>
                <label for="harga">Harga Barang:</label><br>
                <input type="number" id="harga" name="harga" required>
            </div>
            <div>
                <label for="stok">Stok Barang:</label><br>
                <input type="number" id="stok" name="stok" required>
            </div>
            <button type="submit" name="tambah">Tambah Barang</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($barangManager->getBarang() as $barang): ?> 
                    <tr>
                        <td><?= $barang['id'] ?></td>
                        <td><?= $barang['nama'] ?></td>
                        <td><?= $barang['harga'] ?></td>
                        <td><?= $barang['stok'] ?></td>
                        <td>
                            <a href="?hapus=<?= $barang['id'] ?>" class="btn btn-delete">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
