<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-image :url(index.jpg);
  			background-repeat: no-repeat;
            color:#fff;">
	<?php 
	session_start();

	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['level']==""){
		header("location:index.php?pesan=gagal");
	}

	?>
<nav class="navbar navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="halaman_admin.php">SkyResto TreeTop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Dark offcanvas</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
      <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
      <a type="button" class="btn btn-dark" href="penjualan.php">Penjualan</a><br>
      <a type="button" class="btn btn-dark" href="pengeluaran.php">Pengeluaran</a><br>
      <a type="button" class="btn btn-dark" href="barang.php">Data Barang</a><br>
      <a type="button" class="btn btn-dark" href="karyawan.php">Data Karyawan</a><br>
      <a type="button" class="btn btn-dark" href="produk.php">Data Produk</a><br> <br> <br> <br>
      </div>
    </div>
  </div>
</nav>

<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Library</li>
  </ol>
</nav>
<br>
<p class="text-center">Selamat Datang</p>

<div class="container">
  <form action = "" method="POST">
    
        <div class="input-group mb-3"><br>
  <label class="input-group-text" for="inputGroupSelect01">Kategori Menu</label>
  <select class="form-select" id="inputGroupSelect01" name="id_kategori">
    <option value=""></option>
    <option value="1">Makan Berat</option>
    <option value="2">Snack</option>
    <option value="3">Minuman</option>
  </select>
</div>
    <div id="emailHelp" class="form-text">Nama Menu</div>
        <input type="text" class="form-control" name="nama">
    <div id="emailHelp" class="form-text">Harga</div>
        <input type="text" class="form-control" name="harga">
        <input type="submit" class="btn btn-primary" name="submit" value="LOGIN">Submit</input>
      </form>
      <?php
        if(isset($_POST['submit'])){
          $produk = $_POST['produk'];
          include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$id_kategori = $_POST['id_kategori'];
$nama = $_POST['nama'];
$harga = $_POST['harga'];
// menginput data ke database
mysqli_query($koneksi,"insert into produk values('','$id_kategori','$nama','$harga')");

// mengalihkan halaman kembali ke index.php
header("location:produk.php");
        }
      ?>
</div>

//tabel 
<div class="container">
<div class="box"> 
  <table id="pengeluaran" border="1" cellspacing="0" class="table">
    <thead>
      <tr>
        <th>No</th>
        <th>Kategori Menu</th>
        <th>Nama Menu</th>
        <th>Harga</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
    <?php 
      include "koneksi.php";
      $data =mysqli_query($koneksi, "SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori = kategori.id_kategori");
      while($result =mysqli_fetch_array($data)){ 
    ?>
    <tr>
        <td><?php echo $result['id']?></td>
        <td><?php echo $result['nama_kategori'];?></td>
        <td><?php echo $result['nama'];?></td>
        <td><?php echo $result['harga'];?></td>
        <td>
        <a href="editkaryawan.php?id=<?php echo $result['id']; ?>">EDIT</a> || <a href="hapuskaryawan.php?id=<?php echo $result['id']; ?>">HAPUS</a>
        </td>
      </tr>
      <?php 
      } 
      ?>
      </table>  
    </div>
    </div>

<script src="js/bootstrap..min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>