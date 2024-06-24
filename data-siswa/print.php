<?php
session_start();

// Inisialisasi $_SESSION['students'] jika belum diset
if (!isset($_SESSION['students'])) {
    $_SESSION['students'] = [];
}

$editIndex = isset($_POST['editIndex']) ? $_POST['editIndex'] : '';
$editStudent = ['nama' => '', 'nis' => '', 'rayon' => ''];

// Proses saat form ditambahkan atau diubah
if (isset($_POST["submit"])) {
    $nama = $_POST['nama'];
    $nis = $_POST['nis'];
    $rayon = $_POST['rayon'];

    $student = [
        'nama' => $nama,
        'nis' => $nis,
        'rayon' => $rayon,
    ];

    // Jika editIndex diset, maka edit data siswa yang ada
    if (isset($_POST['editIndex']) && $_POST['editIndex'] !== '') {
        $editIndex = $_POST['editIndex'];
        $_SESSION['students'][$editIndex] = $student;
    } else {
        // Jika tidak, tambahkan data siswa baru
        $_SESSION['students'][] = $student;
    }
}

// Proses saat tombol hapus ditekan
if (isset($_POST['delete'])) {
    $index = $_POST['index'];
    // Periksa apakah indeks siswa yang akan dihapus tersedia di $_SESSION['students']
    if (isset($_SESSION['students'][$index])) {
        // Hapus siswa dari $_SESSION['students']
        unset($_SESSION['students'][$index]);
        // Re-index array to maintain sequential keys
        $_SESSION['students'] = array_values($_SESSION['students']);
    }
}

// Proses saat tombol reset ditekan
if (isset($_POST['reset'])) {
    // Hapus semua data siswa dari $_SESSION['students']
    $_SESSION['students'] = [];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
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

form table input[type="submit"], .reset-button, .print-button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
    margin-top: 10px;
}

form table input[type="submit"]:hover, .reset-button:hover, .print-button:hover {
    background-color: #45a049;
}

.reset-button {
    background-color: #f44336;
}

.reset-button:hover {
    background-color: #e53935;
}

.print-button {
    background-color: #008CBA;
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

.kembali{
    background-color: gray;
    padding: 10px 20px;
    border-radius:5px ;
    color: white;
    text-decoration: none;
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
<body>
<button onclick="window.print()" class="print-button">Print</button>
<a class="kembali" href="data-siswagw.php">kembali</a>
<div class="print-area">
     <table class="results">
    <thead>
        <tr>
            <th style="text-align:center;">No</th>
            <th style="text-align:center;">Nama</th>
            <th style="text-align:center;">NIS</th>
            <th style="text-align:center;">Rayon</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($_SESSION['students'] as $index => $student): ?>
        <tr>
            <td style="text-align:center;"><?php echo $index + 1; ?></td>
            <td style="text-align:center;"><?php echo htmlspecialchars($student['nama']); ?></td>
            <td style="text-align:center;"><?php echo htmlspecialchars($student['nis']); ?></td>
            <td style="text-align:center;"><?php echo htmlspecialchars($student['rayon']); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>  
</body>
</html>