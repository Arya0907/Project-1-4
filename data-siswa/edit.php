<?php
session_start();

if (!isset($_SESSION['students'])) {
    header('Location: data-siswagw.php');
    exit();
}

$index = isset($_GET['index']) ? (int)$_GET['index'] : -1;

if ($index < 0 || $index >= count($_SESSION['students'])) {
    header('Location: data-siswagw.php');
    exit();
}

$editStudent = $_SESSION['students'][$index];

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $nis = $_POST['nis'];
    $rayon = $_POST['rayon'];

    $_SESSION['students'][$index] = [
        'nama' => $nama,
        'nis' => $nis,
        'rayon' => $rayon,
    ];

    header('Location: data-siswagw.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Siswa</title>
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

form table input[type="submit"], .print-button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
    margin-top: 10px;
}

form table input[type="submit"]:hover, .print-button:hover {
    background-color: #45a049;
}

.reset-button {
    background-color: red;
}

.reset-button:hover {
    background-color: #e53935;
}

.print-button {
    background-color: #008CBA;
    text-decoration: none;
}

.print-button:hover {
    background-color: #007bb5;
}

table.results {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table.results, table.results th, table.results td {
    border: 1px solid #ddd;
}

table.results th, table.results td {
    padding: 12px;
    text-align: left;
}

table.results th {
    background-color: #f2f2f2;
}

.delete-button, .edit-button {
    color: white;
    padding: 5px 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
    text-decoration: none;
    display: inline-block;
}

.delete-button {
    background-color: #f44336;
}

.delete-button:hover {
    background-color: #e53935;
}

.edit-button {
    background-color: #2196F3;
}

.edit-button:hover {
    background-color: #1976D2;
}

input ::placeholder{
    text-align: center;
}

.results td {
    text-align: center;
}





@media print {
            body,* {
                visibility: hidden;
            }
            .print-area, .print-area * {
                visibility: visible;
            }
            .print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }

            .hilang{
                visibility: hidden;
            }
        
        }

    </style>
</head>
<body>
<div class="container">
    <h1>Data Siswa</h1>
   <form action="" method="POST">
        <table>
            <tr>
                <td><input type="text" name="nama" required placeholder="Masukan Nama"></td>
            </tr>
            <tr>
                <td><input type="text" name="nis" required placeholder="Masukan Nis"></td>
            </tr>
            <tr>
                <td><input type="text" name="rayon" required placeholder="Masukan Rayon"></td>
            </tr>
            <tr>
                <td colspan="3">
                    <input type="submit" name="submit" value="Update">
                </td>
    </form>
</div>
</body>
</html>
