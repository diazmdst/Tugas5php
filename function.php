<?php

//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "tugas_php");

function query($query)
{
    global $conn;
    // ambil data mahasiswa
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{
    //ambil dta dari tiap elemenn
    $kontent = htmlspecialchars($data["kontent"]);

    global $conn;
    //query insert data
    $query = "INSERT INTO konten
    VALUES 
    ('', '$kontent')";
    mysqli_query($conn, $query);

    //cek apakah berhasl ditambah    
    return (mysqli_affected_rows($conn));
}

function hapus($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM konten WHERE id = $id");
    return (mysqli_affected_rows($conn));
}


function ubah($data)
{
    //ambil dta dari tiap elemenn
    $id = $data["id"];
    $isi = htmlspecialchars($data["list"]);   

    global $conn;
    //query UPDATE data
    $query = "UPDATE konten SET 
                list = '$isi'            
                WHERE id = $id
                ";
    mysqli_query($conn,$query);          

    //cek apakah berhasl ditambah    
    return (mysqli_affected_rows($conn));
}


function registrasi($data){
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_escape_string($conn, $data["password2"]);

    //cek username sudah ada atau belum
   $result =  mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if(mysqli_fetch_assoc($result)){
        echo "<script>alert('username telah di gunakan')</script>";
        return false;
    }

    //cek konfirmasi password
    if($password != $password2){
        echo "<script>alert('password tidak sesuai')</script>";
        return false;
    }
    
    //enkripsi password nya
    $password = password_hash($password, PASSWORD_DEFAULT);    

    //tambah user baru kedalam data base
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

    return mysqli_affected_rows($conn);




}