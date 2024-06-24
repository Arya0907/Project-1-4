<?php

session_start();

if (!isset($_SESSION['kasir'])){
    $_SESSION['kasir'] = [];
}

if (isset($_POST["submit"]))
{
    $barang = $_POST['barang'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];

    $kasir = [
        'barang'=> $barang,
        'harga'=> $harga,
        'jumlah' => $jumlah,
    ];

    $_SESSION['kasir'][] = $kasir;
}

if (isset($_POST["delete"]))
{
    $index = $_POST['index'];
    unset($_SESSION['kasir'][$index]);
    $_SESSION['kasir'] = array_values($_SESSION['kasir']);
}

$total = 0;
foreach ($_SESSION['kasir'] as $kasir) {
    $total += $kasir['harga'] * $kasir['jumlah'];
}

$total_barang = count($_SESSION['kasir']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

form table {
    width: 100%;
    margin-bottom: 20px;
}

form table td {
    padding: 10px;
}

form table input[type="text"] {
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

form table input[type="number"] {
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

form table input[type="submit"] {
    background-color: gray; /* Green color */
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
    margin-top: 10px;
}

form table input[type="submit"]:hover {
    background-color: gray; /* Darker green color on hover */
}

table.results {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table.results,
table.results th,
table.results td {
    border: 1px solid #ddd;
}

table.results th,
table.results td {
    padding: 12px;
    text-align: left;
}

table.results th {
    background-color: #f2f2f2;
}

.delete-button {
    color: white;
    padding: 5px 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
    text-decoration: none;
    display: inline-block;
    background-color: #f44336; /* Red color */
}

.delete-button:hover {
    background-color: #e53935; /* Darker red color on hover */
}

a {
    background-color: #4CAF50; /* Green color */
    color: white;
    padding: 9px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
    margin-top: 10px;
    text-decoration: none;
}

a:hover {
    background-color: #45a049; /* Darker green color on hover */
}

</style>
</head>
<body>
    <div class="container">
        <h1>Kasir</h1>

        <form action="" method="POST">
            <table>
                <tr>
                    <td><input type="text" name="barang" placeholder="Masukkan nama barang"></td>
                </tr>
                <tr>
                    <td><input type="number" name="harga" placeholder="Harga"></td>
                </tr>
                <tr>
                    <td><input type="number" name="jumlah" placeholder="Jumlah"></td>
                </tr>
                
                <tr>
                    <td colspan="3">
                        <input type="submit" name="submit" value="Tambahkan">
                        <a href="bayar.php" class="print-button">Bayar</a>
                    </td>
                </tr>
            </table>
        </form>

        <table class="results">
            <thead>
                <tr>
                    <th style="text-align:center;">No</th>
                    <th style="text-align:center;">Nama Barang</th>
                    <th style="text-align:center;">Harga</th>
                    <th style="text-align:center;">Jumlah</th>
                    <th style="text-align:center;">Total</th>
                    <th style="text-align:center;">Aktion</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['kasir'] as $index => $kasir): ?>
                    <tr>
                        <td style="text-align:center;"><?php echo $index + 1; ?></td>
                        <td style="text-align:center;"><?php echo htmlspecialchars($kasir['barang']); ?></td>
                        <td style="text-align:center;"><?php echo number_format(htmlspecialchars($kasir['harga'])); ?></td>
                        <td style="text-align:center;"><?php echo htmlspecialchars($kasir['jumlah']); ?></td>
                        <td style="text-align:center;"><?php echo number_format(htmlspecialchars($kasir['harga'] * $kasir['jumlah'])); ?></td>
                        <td>
                            <form style="text-align:center;" action="" method="POST">
                                <input type="hidden" name="index" value="<?php echo $index; ?>">
                                <input type="submit" name="delete" value="Hapus" class="delete-button" style="background-color: red; color: white;">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tr>
        <td style="text-align:center;">
            total 
            <td style="text-align:center;"colspan="5"><?php echo number_format($total) ;?></td>
        </td>
        </tr>
    <tr>
    <td style="text-align:center;">
            jumlah jenis
            <td style="text-align:center;" colspan="5"><?php echo $total_barang; ?></td>
        </td>
    </tr>
        </table>
    </div>
</body>
</html>
