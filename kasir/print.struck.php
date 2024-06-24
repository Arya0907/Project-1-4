<?php
session_start();

// Calculate the total amount
$total = 0;
foreach ($_SESSION['kasir'] as $kasir) {
    $total += $kasir['harga'] * $kasir['jumlah'];
}

$uang = isset($_POST['uang']) ? $_POST['uang'] : 0;
$kembalian = $uang - $total;

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
    <title>Struck Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef2f3;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }
        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            text-transform: capitalize  ;
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .total, .kembalian {
            font-size: 18px;
            font-weight: bold;
        }

        .struck2{
            display: flex;
            justify-content: space-around;
        }

        .penjumlahan{
            display: flex;
            justify-content: space-around;
        }

        .nama-barang-kanan{
            display: block;
        }

        .btn-a {
    display: flex;
    justify-content: center; /* Centers the buttons horizontally */
    gap: 20px; /* Adds space between the buttons */
    margin-top: 20px; /* Adds some space above the button container */
}

.btn-a a {
    background-color: #4CAF50; /* Green background */
    color: white; /* White text */
    padding: 10px 20px; /* Some padding */
    text-decoration: none; /* Removes the underline */
    border-radius: 4px; /* Rounded corners */
    transition: background-color 0.3s; /* Smooth transition for background color */
    display: inline-block; /* Ensures padding applies properly */
}

.btn-a a:hover {
    background-color: #45a049; /* Darker green on hover */
}


        
    </style>
</head>
<body>
    <div class="container">
        <h1>Struck Pembayaran</h1>
        
        <table class="results">
            <thead>
                <tr>
                    <th style="text-align:center;">Nama Barang</th>
                    <th style="text-align:center;">Harga</th>
                    <th style="text-align:center;">Jumlah</th>
                    <th style="text-align:center;">Total</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['kasir'] as $index => $kasir): ?>
                    <tr>
                        <td style="text-align:center;"><?php echo htmlspecialchars($kasir['barang']); ?></td>
                        <td style="text-align:center;"><?php echo number_format(htmlspecialchars($kasir['harga'])); ?></td>
                        <td style="text-align:center;"><?php echo htmlspecialchars($kasir['jumlah']); ?></td>
                        <td style="text-align:center;"><?php echo number_format(htmlspecialchars($kasir['harga'] * $kasir['jumlah'])); ?></td>
                        <td>
                            <form style="text-align:center;" action="" method="POST">
                                <input type="hidden" name="index" value="<?php echo $index; ?>">
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tr>
        <td style="text-align:center;">
            total semua
            <td style="text-align:center;"colspan="3"><?php echo number_format($total) ;?></td>
        </td>
        </tr>
        <tr>
        <td style="text-align:center;">
            Uang anda 
            <td style="text-align:center;"colspan="3"><?php echo number_format($uang) ;?></td>
        </td>
        </tr>
        <tr>
        <td style="text-align:center;">
            kembalian
            <td style="text-align:center;"colspan="3"><?php echo number_format( $uang-$total) ;?></td>
        </td>
        </tr>
        </table>
        <div class="btn-a">
        <a href="bayar.php">kembali</a>
        <a href="kasir.php">kembali ke menu awal</a>
        
        </div>
    </div>
</body>
</html>
