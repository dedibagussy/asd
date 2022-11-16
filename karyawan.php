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
<form method="post" action="">
    <div id="emailHelp" class="form-text">ID Karyawan</div>
        <input type="text" class="form-control" name="id_karyawan">
    <div id="emailHelp" class="form-text">Nama</div>
        <input type="text" class="form-control" name="nama"><br>
        <div class="input-group mb-3"><br>
  <label class="input-group-text" for="inputGroupSelect01">Jenis Kelamin</label>
  <select class="form-select" id="inputGroupSelect01" name="jenkel">
    <option value="1"></option>
    <option value="Laki-Laki">Laki-Laki</option>
    <option value="Perempuan">Perempuan</option>
  </select>
</div>
    <div id="emailHelp" class="form-text">No. Whatsapps</div>
        <input type="text" class="form-control" name="nohp">
    <div id="emailHelp" class="form-text">Alamat</div>
        <input type="text" class="form-control" name="alamat"><br>
        <div class="input-group mb-3"><br>
  <label class="input-group-text" for="inputGroupSelect01">Bagian</label>
  <select class="form-select" id="inputGroupSelect01" name="status">
    <option value="1"></option>
    <option value="Dapur">Dapur</option>
    <option value="Kasir">Kasir</option>
    <option value="Deck">Deck</option>
  </select></div><br>
        <button type="submit" class="btn btn-primary" name="submit" value="submit">Simpan</button>
</div>
</form>
<?php
        if(isset($_POST['submit'])){
          $karyawan = $_POST['karyawan'];
          include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$id_karyawan = $_POST['id_karyawan'];
$nama = $_POST['nama'];
$jenkel = $_POST['jenkel'];
$nohp = $_POST['nohp'];
$alamat = $_POST['alamat'];
$status = $_POST['status'];
// menginput data ke database
mysqli_query($koneksi,"insert into karyawan values('','$id_karyawan','$nama','$jenkel','$nohp','$alamat','$status')");

// mengalihkan halaman kembali ke index.php
header("location:karyawan.php");
        }
      ?>
//tabel 
<div class="container">
<div class="box"> 
  <table id="pengeluaran" border="1" cellspacing="0" class="table">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Jenis Kelamin</th>
        <th>No HP</th>
        <th>Alamat</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
    <?php 
      include "koneksi.php";
      $data =mysqli_query($koneksi, "SELECT * FROM karyawan");
      while($result =mysqli_fetch_array($data)){ 
    ?>
    <tr>
        <td><?php echo $result['id']?></td>
        <td><?php echo $result['nama'];?></td>
        <td><?php echo $result['jenkel'];?></td>
        <td><?php echo $result['nohp'];?></td>
        <td><?php echo $result['alamat'];?></td>
        <td><?php echo $result['status'];?></td>
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