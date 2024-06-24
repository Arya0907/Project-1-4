<!DOCTYPE html>
<html>
<head>
    <title>Project Bahan Bakar</title>
    <style>
        body {
            margin: 30px;
        }

        h1 {
            text-align: center;
        }

        form {
            text-align: center;
        }

        label {
            font-weight: bold;
        }

        select, input[type="number"], input[type="submit"] {
            padding: 6px 12px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: black;
            color: white;
            cursor: pointer;
        }

        center {
            margin-top: 20px;
            font-weight: bold;
        }

        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 500px;
        }

        table td {
            padding: 8px;
            border: 1px solid #ccc;
        }

        table td:first-child {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php
    class Shell {
        protected $ppn;
        private $SSuper,
                $SVPower,
                $SVPowerDiesel,
                $SVPowerNitro;
        public $jumlah ;
        public $jenis ;

        function __construct() {//untuk harga ppn
            $this->ppn = 0.1 ;
        }

        public function setHarga($tipe1,$tipe2,$tipe3,$tipe4) { //memisahkan jenis harga
            $this->SSuper = $tipe1 ;
            $this->SVPower = $tipe2 ;
            $this->SVPowerDiesel = $tipe3 ;
            $this->SVPowerNitro = $tipe4 ;
        }

        public function getHarga() {
            $data["SSuper"] = $this->SSuper;
            $data["SVPower"] = $this->SVPower;
            $data["SVPowerDiesel"] = $this->SVPowerDiesel;
            $data["SVPowerNitro"] = $this->SVPowerNitro;
            return $data;
        }
    }

    class Beli extends Shell { //mewarisi class pertama
        public function hargaBeli() { //untuk menghitung jumlah pembayaran
            $dataHarga = $this->getHarga();
            $hargaBeli = $this->jumlah * $dataHarga[$this->jenis];
            $hargaPPN = $hargaBeli * $this->ppn;
            $hargaBayar = $hargaBeli + $hargaPPN;
            return $hargaBayar;
        }
            public function cetakPembelian(){ //mencetak  struk
                echo "<center>"; 
                echo "<table>";
                echo "<tr><td colspan='3' style='text-align: center; font-weight: bold;'>Pembelian Bahan Bakar Minyak</td></tr>";
                echo "<tr><td>Jenis</td><td>:</td><td>" . $this->jenis . "</td></tr>";
                echo "<tr><td>Jumlah</td><td>:</td><td>" . $this->jumlah . "</td></tr>";
                echo "<tr><td>Total Harga</td><td>:</td><td>Rp. " . number_format($this->hargaBeli(),0,"",".") . "</td></tr>";
                echo "</table>";
                echo "</center>";
            }
    }

  
    ?>
    <h1></h1>
    <form method="post" action="">
        <label for="jumlah">Jumlah Liter:</label>
        <input type="number" name="jumlah" required><br><br>

        <label for="jenis">Pilih Jenis:</label>
        <select name="jenis" required>
            <option value="SSuper">Shell Super</option>
            <option value="SVPower">Shell V-Power</option>
            <option value="SVPowerDiesel">Shell V-Power Diesel</option>
            <option value="SVPowerNitro">Shell V-Power Nitro</option>
        </select><br><br>

        <input type="submit" name="kirim" value="Kirim">
    </form>
</body>
</html>

<?php
  $proses = new Beli();
  $proses->setHarga(15420, 16130, 18310, 16510); //memasang harga

  if(isset($_POST['kirim'])) {
      $proses->jumlah = $_POST['jumlah'];
      $proses->jenis = $_POST['jenis'];

      $proses->cetakPembelian();
  }
  ?>