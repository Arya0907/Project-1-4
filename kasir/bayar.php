<?php
session_start();

if (!isset($_SESSION['kasir'])) {
    $_SESSION['kasir'] = [];
}

if (isset($_POST["submit_item"])) {
    $barang = $_POST['barang'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];

    $kasir = [
        'barang' => $barang,
        'harga' => $harga,
        'jumlah' => $jumlah,
    ];

    $_SESSION['kasir'][] = $kasir;
}

if (isset($_POST["delete"])) {
    $index = $_POST['index'];
    unset($_SESSION['kasir'][$index]);
    $_SESSION['kasir'] = array_values($_SESSION['kasir']);
}

$total = 0;
foreach ($_SESSION['kasir'] as $kasir) {
    $total += $kasir['harga'] * $kasir['jumlah'];
}

$uang = isset($_POST['uang']) ? $_POST['uang'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir</title>
    <style>
   body {
    font-family: Arial, sans-serif;
    background-color: #eef2f3;
    margin: 0;
    padding: 20px;
}

.container {
    max-width: 80%;
    margin: 0 auto;
    padding: 20px;
    background-color: #ffffff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

h1 {
    text-align: center;
    color: #333;
    font-size: 24px;
    margin-bottom: 20px;
}

form {
    text-align: center;
}

form input[type="number"],
form input[type="submit"] {
    width: 80%;
    padding: 10px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin: 10px 0;
}

form input[type="submit"] {
    background-color: #808080; /* gray */
    color: white;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s;
}

form input[type="submit"]:hover {
    background-color: #606060; /* darker gray on hover */
}

a {
    color: #0000ff; /* blue */
    text-decoration: none;
}

a:hover {
    text-decoration: underline; /* underline on hover */
}

    </style>
</head>
<body>

<div class="container">
    <h2>Total: <?= number_format($total) ?></h2>
    <h2>hanya bisa memasukan uang lebih dari sama dengan <?php echo number_format($total)?></h2>

    <form action="struck.php" method="post">
        <input type="number" name="uang" placeholder="Masukan uang" required min="<?= $total ?>">
        <input type="submit" name="submit_uang" value="Bayar">
    </form>
</div>

</body>
</html>
