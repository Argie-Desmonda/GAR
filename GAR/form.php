<?php
include("database.php");
require('page/head.inc.php');
include('page/navbar.inc.php');
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body class="bg-light mt-5 pt-5">
  <div class="container mt-5">
    <div class="row my-4 mt-5">
      <div class="col-lg-12 mx-auto mb-5">
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" enctype="multipart/form-data">
          <div class="card shadow gradient">
            <div class="card-header my-auto">
              <h4 class="my-auto" style="color: white">Form Pengajuan Kredit</h4>
            </div>
            <div class="card-body p-4">
              <form action="action.php" method="post" id="add_form">
                <div class="row">
                  <div class="col-md-6 mb-3" style="color: white">
                    Nama Lengkap : <br>
                    <input type="text" name="nama" class="form-control"> <br>
                    Alamat : <br>
                    <textarea type="text" name="alamat" class="form-control"> </textarea> <br>
                    Nomor KTP : <br>
                    <input type="number" name="noKTP" class="form-control"> <br> <br>
                  </div>
                </div>
                <div id="show_item">
                  <div class="row">
                    <div class="col-md-3 mb-3">
                      <input type="text" name="jenis_barang[]" class="form-control" placeholder="Jenis Barang" required>
                    </div>
                    <div class="col-md-2 mb-3">
                      <input type="text" name="merk_barang[]" class="form-control" placeholder="Merk Barang" required>
                    </div>
                    <div class="col-md-2 mb-3">
                      <input type="text" name="tipe_barang[]" class="form-control" placeholder="Tipe Barang" required>
                    </div>
                    <div class="col-md-3 mb-3">
                      <input type="number" name="harga_barang[]" class="form-control" placeholder="Harga Kredit" required>
                    </div>
                    <div class="col-md-2 mb-3 d-grid">
                      <button class="btn btn-success add_item_btn">Tambah</button>
                    </div>
                  </div>
                </div>
                <div class="md-6 pt-2" style="color: white">
                  Upload Dokumen kredit: <br>
                  <input type="file" id="document" class="form-control" name="document">
                </div>
                <div class="md-6 pt-2" style="color: white">
                  Upload KTP : <br>
                  <input type="file" id="KTP" class="form-control" name="KTP">
                </div>
                <div class="md-6 pt-2" style="color: white">
                  Upload STNK : <br>
                  <input type="file" id="STNK" class="form-control" name="STNK">
                </div>
                <div class="md-6 pt-2" style="color: white">
                  Upload Kartu Keluarga : <br>
                  <input type="file" id="KK" class="form-control" name="KK">
                </div>
                <div>
                  <input type="submit" name="submit" value="Tambah" class="btn btn-light w-25 mt-5" id="add-btn">
                </div>
              </form>
            </div>
          </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
      $(document).ready(function() {
        $(".add_item_btn").click(function(e) {
          e.preventDefault();
          $("#show_item").prepend('<div class="row"><div class="col-md-3 mb-3"><input type="text" name="jenis_barang[]" class="form-control" placeholder="Jenis Barang" required></div><div class="col-md-2 mb-3"><input type="text" name="merk_barang[]" class="form-control" placeholder="Merk Barang" required></div><div class="col-md-2 mb-3"><input type="text" name="tipe_barang[]" class="form-control" placeholder="Tipe Barang" required></div><div class="col-md-3 mb-3"><input type="number" name="harga_barang[]" class="form-control" placeholder="Harga Kredit" required></div><div class="col-md-2 mb-3 d-grid"><button class="btn btn-danger remove_item_btn">Hapus</button></div></div>');
        });
        $(document).on('click', '.remove_item_btn', function(e) {
          e.preventDefault();
          let row_item = $(this).parent().parent();
          $(row_item).remove();
        })
      });
    </script>
</body>

</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_POST["submit"])) {
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $noKTP = $_POST["noKTP"];

    function uploadFile($fileTypeName, $ownerName, $conn)
    {
      $document = $_FILES[$fileTypeName];

      $docName = $_FILES[$fileTypeName]['name'];
      $docTmpName = $_FILES[$fileTypeName]['tmp_name'];
      $docSize = $_FILES[$fileTypeName]['size'];
      $docError = $_FILES[$fileTypeName]['error'];
      $docType = $_FILES[$fileTypeName]['type'];

      $docExt = explode('.', $docName);
      $docActualExt = strtolower(end($docExt));

      $allowed = array('jpg', 'jpeg', 'png', 'pdf', 'zip', 'rar');

      if (in_array($docActualExt, $allowed)) {
        if ($docError === 0) {
          if ($docSize < 5000000) {
            $fileDestination = 'uploads/' . $docName;
            move_uploaded_file($docTmpName, $fileDestination);
            $sqlFile = "INSERT INTO file_upload(fileName, filePath, ownerName)
            VALUE ('$docName','$fileDestination', '$ownerName')";
            mysqli_query($conn, $sqlFile);
          } else {
            echo "file to big";
          }
        } else {
          echo "Error uploading file!";
        }
      } else {
        echo "Wrong File Type";
      }
    }

    uploadFile("document", $nama, $conn);
    uploadFile("KTP", $nama, $conn);
    uploadFile("STNK", $nama, $conn);
    uploadFile("KK", $nama, $conn);


    $jumlahBarang = count($_POST["jenis_barang"]);
    for ($i = 0; $i < $jumlahBarang; $i++) {
      $jenisBarang = $_POST["jenis_barang"][$i];
      $merkBarang = $_POST["merk_barang"][$i];
      $tipeBarang = $_POST["tipe_barang"][$i];
      $hargaBarang = $_POST["harga_barang"][$i];

      $sql = "INSERT INTO kredit (nama, alamat, noKTP, jenisBarang, merkBarang, tipeBarang, hargaBarang)
    VALUES ('$nama', '$alamat', '$noKTP', '$jenisBarang', '$merkBarang', '$tipeBarang', '$hargaBarang')";
      mysqli_query($conn, $sql);
    }
  }
}
mysqli_close($conn);
?>