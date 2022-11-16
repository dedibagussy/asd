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


<div class="container">
<form method="post" action="">
    <div id="emailHelp" class="form-text">Tanggal</div>
        <input type="text" class="form-control" name="tgl" value="<?php echo  date("j F Y, G:i");?>">
    <div id="emailHelp" class="form-text">Nama Barang</div>
        <input type="text" class="form-control" name="nama_barang">
    <div id="emailHelp" class="form-text">Jumlah</div>
        <input type="text" class="form-control" name="jumlah">
    <div id="emailHelp" class="form-text">Harga</div>
        <input type="text" class="form-control" name="harga">
    <div id="emailHelp" class="form-text">Total</div>
        <input type="text" class="form-control" name="total"><br>
        <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button><br>
</div>
</form>
<?php
        if(isset($_POST['submit'])){
          $pengeluaran = $_POST['pengeluaran'];
          include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$tgl = $_POST['tgl'];
$nama_barang = $_POST['nama_barang'];
$jumlah = $_POST['jumlah'];
$harga = $_POST['harga'];
$total = $_POST['total'];
{$total=$jumlah*$harga;}
// menginput data ke database
mysqli_query($koneksi,"insert into pengeluaran values('','$tgl','$nama_barang','$jumlah','$harga','$total')");

// mengalihkan halaman kembali ke index.php
header("location:pengeluaran.php");
        }
      ?>

<div class="container">
<div class="box"> 
  <table id="pengeluaran" border="1" cellspacing="0" class="table">
    <thead>
      <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Nama Barang</th>
        <th>Jumlah</th>
        <th>Harga</th>
        <th>Total</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
    <?php include "koneksi.php";
      $id =2;
      $pengeluaran = mysqli_query($koneksi, "SELECT * FROM pengeluaran");
      while($row = mysqli_fetch_array($pengeluaran)){ ?>
      <tr>
        <td><?php echo $row['id'];?></td>
        <td><?php echo $row['tgl']; ?></td>
        <td><?php echo $row['nama_barang']; ?></td>
        <td><?php echo $row['jumlah']; ?></td>
        <td><?php echo $row['harga']; ?></td>
        <td><?php echo $row['total']; ?></td>
        <td>
          <a href="">Edit</a> || <a href="">Hapus</a>
        </td>
      </tr>
    <?php } ?>  
    </tbody>  

  </table>
</div>
</div>


<script src="js/bootstrap..min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>