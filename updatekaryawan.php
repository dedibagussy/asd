<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$id = $_POST['id'];
$nama = $_POST['nama'];
$jenkel = $_POST['jenkel'];
$alamat = $_POST['alamat'];
 
// update data ke database
mysqli_query($koneksi,"update karyawan set nama='$nama', jenkel='$jenkel', alamat='$alamat' where id='$id'");
 
// mengalihkan halaman kembali ke index.php
header("location:karyawan.php");
 
?>