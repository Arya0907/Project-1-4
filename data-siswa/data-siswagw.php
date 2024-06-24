`<?php
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

    // Cek apakah NIS sudah ada
    $nisExist = false;
    foreach ($_SESSION['students'] as $existingStudent) {
        if ($existingStudent['nis'] === $nis) {
            $nisExist = true;
            break;
        }
    }

    if ($nisExist) {
        $_SESSION['errorMessage'] = '<div class="alert alert-danger" role="alert">NIS sudah ada dalam daftar siswa!</div>';
    } else {
        // Jika editIndex diset, maka edit data siswa yang ada
        if (isset($_POST['editIndex']) && $_POST['editIndex'] !== '') {
            $editIndex = $_POST['editIndex'];
            $_SESSION['students'][$editIndex] = $student;
        } else {
            // Jika tidak, tambahkan data siswa baru
            $_SESSION['students'][] = $student;
        }

        $_SESSION['successMessage'] = '<div class="alert alert-success" role="alert">Data siswa berhasil ditambahkan!</div>';
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
        $_SESSION['successMessage'] = '<div class="alert alert-success" role="alert">Data siswa berhasil dihapus!</div>';
    }
}

// Proses saat tombol reset ditekan
if (isset($_POST['reset'])) {
    // Hapus semua data siswa dari $_SESSION['students']
    $_SESSION['students'] = [];
    $_SESSION['successMessage'] = '<div class="alert alert-success" role="alert">Semua data siswa berhasil direset!</div>';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #eef2f3;
    margin: 0;
    padding: 20px;
}

.pesan{
    width: 100%;
    padding: 20px 0px;
    text-align: center;
    font-size:20px;
    color: white;
}


.error-message {
            background-color: rgba(204,0,0, 0.8); /* Warna merah */
            padding: 15px 0px;
        }

        .success-message {
            background-color: rgba(0,204,0, 0.4); /* Warna hijau */
            padding: 15px 0px;
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const messages = document.querySelectorAll(".error-message, .success-message");
            if (messages.length) {
                setTimeout(() => {
                    messages.forEach(message => message.style.display = 'none');
                }, 3000); // Adjust the time (3000ms = 3s) as needed
            }
        });
    </script>
</head>
<body>
<div class="container">
    <h1>Data Siswa</h1>

    <!-- Form Input Data Siswa -->
    <form action="" method="POST">
        <table>
            <tr>
                <td><input type="text" name="nama" required placeholder="Masukkan Nama"></td>
            </tr>
            <tr>
                <td><input type="text" name="nis" required placeholder="Masukkan NIS"></td>
            </tr>
            <tr>
                <td><input type="text" name="rayon" required placeholder="Masukkan Rayon"></td>
            </tr>
            <tr>
                <td colspan="3">
                    <input type="submit" name="submit" value="Tambah Siswa" style="background-color: #577B8D; color: white;">
                    <input type="submit" name="reset" value="Reset Semua Data" class="reset-button" style="background-color: red; color: white;">
                    <?php if (isset($_SESSION['students']) && count($_SESSION['students']) > 0): ?>
                        <a class="print-button" href="print.php">Print</a>
                    <?php endif; ?>
                </td>
            </tr>
        </table>
    </form>

    <!-- Pesan Kesalahan dan Sukses -->
    <div class="pesan">
        <?php
        if (isset($_SESSION['errorMessage'])) {
            echo '<div class="error-message">' . $_SESSION['errorMessage'] . '</div>';
            unset($_SESSION['errorMessage']);
        }
        if (isset($_SESSION['successMessage'])) {
            echo '<div class="success-message">' . $_SESSION['successMessage'] . '</div>';
            unset($_SESSION['successMessage']);
        }
        ?>
    </div>

    <!-- Tabel Data Siswa -->
    <div class="print-area">
        <table class="results">
            <thead>
            <tr>
                <th style="text-align:center;">No</th>
                <th style="text-align:center;">Nama</th>
                <th style="text-align:center;">NIS</th>
                <th style="text-align:center;">Rayon</th>
                <th style="text-align:center;">Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($_SESSION['students'] as $index => $student): ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td style="text-align:center;"><?php echo htmlspecialchars($student['nama']); ?></td>
                    <td style="text-align:center;"><?php echo htmlspecialchars($student['nis']); ?></td>
                    <td style="text-align:center;"><?php echo htmlspecialchars($student['rayon']); ?></td>
                    <td>
                        <form style="text-align:center;" class="hilang" action="" method="POST" style="display:inline;">
                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                            <input type="submit" name="delete" value="Hapus" class="delete-button" style="background-color: red; color: white; ">
                            <button type="button" onclick="window.location.href='edit.php?index=<?php echo $index; ?>'" class="edit-button" style="color: white; padding: 5px 15px; margin-top: 2px; background-color: #2196F3; border: none; cursor: pointer;">Edit</button>

                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
`