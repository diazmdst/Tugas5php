<?php 
//cek apakah ada session atau tidak
session_start();
if(!isset($_SESSION["login"])){
    header("location: login.php");
}

require 'function.php';
$id = $_GET["id"];

if(hapus($id)> 0 ){
    echo "<script>
    alert('data berhasil dihapus!');
    window.location.href = 'index.php';
  </script>";
}else{
    echo "<script>
    alert('data gagal dihapus!');
    window.location.href = 'index.php';
  </script>";
}