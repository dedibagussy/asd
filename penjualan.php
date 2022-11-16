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
<div class="container" style="margin-top:80px;">
<?php 
    if(isset($_GET['halaman'])){
        $halaman = $_GET['halaman'];
        switch ($halaman) {
            case 'item':
                include "item.php";
                break;
            case 'cart':
                include "cart.php";
                break;
            default:
            echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
            break;
        }
    }else {
        include "item.php";
    }
?>
</div>
<script src="js/bootstrap..min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>