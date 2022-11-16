<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$id = $_POST['id'];
$nama_barang = $_POST['nama_barang'];
$stock = $_POST['stock'];
 
// update data ke database
mysqli_query($koneksi,"update barang set nama='$nama', nama_barang='$barang', nama_barang='$stock' where id='$id'");
 
// mengalihkan halaman kembali ke index.php
header("location:barang.php");
 
?>