<?php
class Sewa {

        protected $diskon,
                  $Pajak;
        private $Scoter,
                $Vario,
                $Aerox,
                $NinjaSS;
        public $DurasiHari ;
        public $nama;
        public $jenis;

        function __construct() {//untuk harga diskon
            $this->diskon = 0.05 ;
            $this->Pajak = 10000;
        }

        

       

        

        public function setHarga($tipe1,$tipe2,$tipe3,$tipe4) { //memisahkan jenis harga
            $this->Scoter = $tipe1 ;
            $this->Vario = $tipe2 ;
            $this->Aerox = $tipe3 ;
            $this->NinjaSS = $tipe4 ;
        }

        public function getHarga() {
            $data["Scoter"] = $this->Scoter;
            $data["Vario"] = $this->Vario;
            $data["Aerox"] = $this->Aerox;
            $data["NinjaSS"] = $this->NinjaSS;
            return $data;
        }
    }

    

   if(isset($_POST['nama'])) {  
    

        if((@$_POST['nama']=="arya") || (@$_POST['nama']=="agus") || (@$_POST['nama']=="jeki") ){
            class Gengsi extends Sewa { //mewarisi class pertama
        
                public function hargaBeli() {
                     //untuk menghitung jumlah pembayaran
                    $dataHarga = $this->getHarga();
                    $hargaBeli = $this-> DurasiHari * $dataHarga[$this->jenis];
                    $hargaDiskon = $hargaBeli * $this->diskon;
                    $hargaBayar = ($hargaBeli-$hargaDiskon)  +  $this->Pajak ;
                    return $hargaBayar;
                }
                public function cetakPembelian(){
                    $dataHarga = $this->getHarga(); //mencetak  struk
                    echo "<center>";
                   echo $this->nama ." anda adalah member mendapat diskon 5% jenis motor yang anda rental adalah ".$this->jenis ."    Selama " . $this->DurasiHari . " hari Harga rental per harinya adalah Rp.". $dataHarga[$this->jenis];
                   echo " harga yang harus di bayar adalah Rp.". $this->hargaBeli();
                   echo "<br>";
                   echo "(sudah termasuk pajak)";
                   echo "</center>";
                }
                
            }
        }else{
            class Gengsi extends Sewa { //mewarisi class pertama
         
                public function hargaBeli() {
                     //untuk menghitung jumlah pembayaran
                    $dataHarga = $this->getHarga();
                    $hargaBeli = $this-> DurasiHari * $dataHarga[$this->jenis];
                    $hargaBayar =  $hargaBeli + $this->Pajak;
                    return $hargaBayar;
                }
                public function cetakPembelian(){
                    $dataHarga = $this->getHarga(); //mencetak  struk
                    echo "<center>";
                   echo $this->nama ." jenis motor yang anda rental adalah ".$this->jenis ." Selama " . $this->DurasiHari . " hari Harga rental per harinya adalah Rp.". $dataHarga[$this->jenis];
                   echo " harga yang harus di bayar adalah Rp.". $this->hargaBeli() ;
                   echo "<br>";
                   echo "(sudah termasuk pajak)";
                   echo "</center>";
                }
               
            }
        }
       
    }else{
        class Gengsi extends Sewa { //mewarisi class pertama
        
            public function hargaBeli() {
                 //untuk menghitung jumlah pembayaran
                $dataHarga = $this->getHarga();
                $hargaBeli = $this-> DurasiHari * $dataHarga[$this->jenis];
                $hargaBayar = $hargaBeli + $this->Pajak;
                return $hargaBayar;
            }
            public function cetakPembelian(){
                $dataHarga = $this->getHarga(); //mencetak  struk
              echo "<center>";
               echo $this->nama ." jenis motor yang anda rental adalah ".$this->jenis ." Selama " . $this->DurasiHari . " hari Harga rental per harinya adalah Rp.". $dataHarga[$this->jenis];
               echo " harga yang harus di bayar adalah Rp.". $this->hargaBeli() ;
               echo "<br>";
               echo "(sudah termasuk pajak)";
               echo "</center>";
            }
           
        }
    }


  
    ?>

    
    
    <style>
        html {
    width: 98%;
    font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}

body {
    width: 100%;
    margin: 0;
    padding: 20px;
    background-color: #f9f9f9;
}

h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

form {
    width: 100%;
    max-width: 80%;
    margin: auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

input[type="text"],
input[type="number"],
select {
    width: calc(100% - 20px);
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin: 10px 10px;
    box-sizing: border-box;
}

input[type="submit"] {
    width: calc(100% - 20px);
    padding: 15px;
    border: none;
    border-radius: 5px;
    margin: 10px 10px;
    background-color: #333;
    color: #fff;
    cursor: pointer;
    font-size: 16px;
}

input[type="submit"]:hover {
    background-color: #555;
}

.posisi {
    text-align: center;
    margin: auto;
}

.output {
    text-align: center;
    width: 100%;
    max-width: 80%;
    font-size: 20px;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 10px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

select {
    width: calc(100% - 20px);
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin: 10px 10px;
    box-sizing: border-box;
}

option {
    text-align: center;
}


        
        
    </style>
   
   <!DOCTYPE html>
   <html lang="en">
   <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   </head>
   <body>
   <div class="posisi">
    <h1>Rental Motor</h1>
    <form method="post" action="">
        <input type="text" name="nama" placeholder="Masukan Nama">
        <input type="number" name="DurasiHari" placeholder="Lama Sewa (perhari)" required ><br><br>

        <select name="jenis" required>
            <option value="no value">Pilih Motor</option>
            <option value="Scoter">Scoter</option>
            <option value="Vario">Vario</option>
            <option value="Aerox">Aerox</option>
            <option value="NinjaSS">NinjaSS</option>
        </select><br><br>

        <input type="submit" name="kirim" value="Kirim">
    </form>

    <div class="output">
    <?php
  $proses = new Gengsi();
  $proses->setHarga(70000, 80000, 100000, 165100); //memasang harga

  if(isset($_POST['kirim'])) {
    $proses->nama = $_POST ['nama'];
      $proses->DurasiHari = $_POST['DurasiHari'];
      $proses->jenis = $_POST['jenis'];

      $proses->cetakPembelian();
  }
  ?>
    </div>
    </div>
   </body>
   </html>