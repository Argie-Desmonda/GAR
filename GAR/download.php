<?php
include("database.php");
require('page/head.inc.php');
include('page/navbar.inc.php');

$sql = "SELECT * FROM file_upload";
$result = mysqli_query($conn, $sql);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body class="bg-light mt-5 pt-5">
  <div class="container">
    <h1>Document</h1>
    <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Nama File</th>
            <th>action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $count = 1;
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<td>" . $count . "</td>";
              echo "<td>" . $row["ownerName"] . "</td>";
              echo "<td>" . $row["fileName"] . "</td>";
              echo '<td> <a href="uploads/' . $row["fileName"] . '" class="btn btn-info" download>Download</a></td>';
              echo "</tr>";
              $count++;
            }
          } else {
            echo "<tr><td colspan = '3'> No data found. </td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>