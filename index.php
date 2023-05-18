<?php
//cek apakah ada session atau tidak
session_start();
if(!isset($_SESSION["login"])){
    header("location: login.php");
}

require "function.php";
//cek apakah sdh ditekah ato belum
if (isset($_POST["submit"])) {
  if (tambah($_POST) > 0) {
    echo "<script> 
           alert('data berhasil ditambahkan!');
           document.location.href = 'index.php';
         </script>";
  } else {
    echo "<script> 
    alert('data gagal ditambahkan!');    
  </script>";
  }
}

$data = query("SELECT * FROM konten");


?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="stylei.css" />
  <!-- Latest compiled and minified CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

  <div id="myDIV" class="header">
    <h2 style="margin:5px">List Pembelajaran</h2>

    <a href="logout.php"><button class="btn btn-warning">logout</button></a>
    <br><br>

    <form action="" method="post">
      <input type="text" id="myInput" placeholder="Silahkan isi" name="kontent">
      <button type="submit" name="submit" class="btn btn-primary btn-lg">Tambah</button>
      <!-- <span onclick="newElement()" class="addBtn">Tambah</span> -->
    </form>

  </div>
  <div class="container-md">
    <table class="table table-dark table-striped">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Konten</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1; ?>
        <?php foreach ($data as $dt) : ?>
          <tr>
            <td><?= $i ?></td>
            <td><?= $dt["list"]; ?></td>
            <td>           
              <a href="ubah.php?id=<?= $dt["id"]; ?>"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Edit</button></a>
              <a href="hapus.php?id=<?= $dt["id"]; ?>" onclick="return confirm('Yaking ingin menghapus data ini?');"><button type="button" class="btn btn-danger">Delete</button></a>
            </td>
          </tr>
          <?php $i++; ?>
        <?php endforeach; ?>
      </tbody>
  </div>
  </table> 




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>