<?php require('page/head.inc.php'); ?>
<?php include('page/navbar.inc.php'); ?>

<header class="page-header gradient mt-5 pt-5">
  <h1 class="text-center pt-5" id="header-title">SIMULASI KREDIT</h1>
      <div class="container">
        <div class="row gx-5 align-items-center justify-content-center">
          <div class="col-md-5">

          <form action="calculator.php" method="post">
            <div class="mb-3">
              <label for="jumlahPinjaman" class="form-label">Jumlah Pinjaman</label>
              <div class="input-group mb-3">
                <span class="input-group-text">Rp</span>
                <input type="number" class="form-control" name="inputJumlahPinjaman"> 
              </div>
       
            </div>
            <div class="mb-3">
              <label for="Tenor" class="form-label">Lama Pinjaman (Tenor)</label>
              <div class="input-group mb-3">
                <input type="number" class="form-control" name="inputTenor">
                <span class="input-group-text">Bulan</span>
              </div>
            
            </div>
            <div class="mb-3">
              <label for="Bunga" class="form-label">Bunga Pinjaman</label>
              <div class="input-group mb-3">
                <input type="number" class="form-control" name="bunga">
                <span class="input-group-text">% / tahun</span>
              </div>
              
            </div>
            <button type="submit" name="submit" class="btn btn-light">Hitung</button>
          </form>
          </div>
          <div class="col-md-7">
            <div class="row">
              <div class="col-md-6">
                Jumlah pinjaman <br>
                Lama Pinjaman (Tenor) <br>
                Bunga / tahun <br>
                Bunga / bulan <br>
                Angsuran Pokok / BULAN <br>
                Angsuran Bunga / BULAN <br><br>

                <h4>Total Angsuran / BULAN <br></h4>
              </div>
              <div class="col-md-6">
              <?php
                if (isset($_POST["submit"])){

                  $jumlahPinjaman = $_POST["inputJumlahPinjaman"];
                  $tenor = $_POST["inputTenor"];
                  $bungaPersen = $_POST["bunga"];
                  $bunga = $bungaPersen/100;
                  $bungaPerBulan = $bunga/12;
                  $bungaPerBulanPersen = $bungaPerBulan*100;
                  $angsuranPokokPerBulan = $jumlahPinjaman/$tenor;
                  $angsuranBungaPerBulan = $angsuranPokokPerBulan * $bungaPerBulan;
                  $totalAngsuran = $angsuranPokokPerBulan + $angsuranBungaPerBulan;

                  $jumlahPinjamanFormat = number_format($jumlahPinjaman,0,",",".");
                  $angsuranPokokPerBulanFormat = number_format($angsuranPokokPerBulan,0,",",".");
                  $angsuranBungaPerBulanFormat = number_format($angsuranBungaPerBulan,0,",",".");
                  $totalAngsuranFormat = number_format($totalAngsuran,0,",",".");

                  echo ": Rp {$jumlahPinjamanFormat} <br>";
                  echo ": {$tenor} bulan <br>";
                  echo ": {$bungaPersen} % / tahun <br>";
                  echo ": {$bungaPerBulanPersen} % / bulan <br>";
                  echo ": Rp {$angsuranPokokPerBulanFormat} <br>";
                  echo ": Rp {$angsuranBungaPerBulanFormat} <br><br>";


                  echo  "<h4> : Rp {$totalAngsuranFormat} <br><h4> ";
                }
                else {
                  echo ": <br>";
                  echo ": <br>";
                  echo ": <br>";
                  echo ": <br>";
                  echo ": <br>";
                  echo ": <br><br>";
                  echo "<h4> : <br><h4>";
                }

                  
                ?>
              </div>
            </div>
            <div class="contaner">
              <div class="row align-items-center justify-content-center">
                
              </div>
            </div>
          </div>
        </div>
        <div class="container mt-5">
          <p>Simulasi ini untuk kredit secara umum. Silahkan masukkan angka-angka yang sesuai dengan kolom-kolom berikut. Tekan tombol HITUNG untuk mengkalkulasikan kredit anda. Jumlah cicilan tiap bulan atau tiap tahun akan diketahui kemudian.</p>
        </div>
      </div>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#fff" fill-opacity="1" d="M0,192L48,208C96,224,192,256,288,250.7C384,245,480,203,576,165.3C672,128,768,96,864,85.3C960,75,1056,85,1152,112C1248,139,1344,181,1392,202.7L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
</svg>
</header>






<?php include('page/footer.inc.php'); ?>

