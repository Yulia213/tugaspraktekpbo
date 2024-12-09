<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        /* Reset Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #ffe4e6; /* Soft pink background */
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }

        /* Container Styles */
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            border: 2px solid #ffc0cb; /* Light pink border */
        }

        /* Heading Styles */
        h1 {
            font-size: 30px;
            color: #ff69b4; /* Hot pink */
            margin-bottom: 25px;
        }

        /* Link Styles */
        a {
            display: inline-block;
            background-color: #ff69b4; /* Hot pink */
            color: white;
            text-decoration: none;
            padding: 15px 25px;
            border-radius: 25px;
            font-size: 18px;
            font-weight: bold;
            margin: 10px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        a:hover {
            background-color: #e75480; /* Deep pink on hover */
            transform: scale(1.05); /* Slight zoom effect */
        }

        a:active {
            transform: scale(0.95); /* Press down effect */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Dashboard</h1>
        <a href="databarang.php">Kelola Barang</a>
        <a href="datacustomer.php">Kelola Pelanggan</a>
    </div>
</body>
</html>
