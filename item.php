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
<a></a><br>
<a></a><br>
<a></a><br>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Makan Berat
    </button>
    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Makan Berat</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="row">
    <?php   
    include 'koneksi.php';
    $sql="SELECT * FROM produk
    WHERE id_kategori='1';";
    $hasil=mysqli_query($koneksi,$sql);
    $jumlah = mysqli_num_rows($hasil);
    if ($jumlah>0){
        while ($data = mysqli_fetch_array($hasil)):
    ?>
        <div class="col-sm-3">
            <div class="thumbnail">
                <div class="caption">
                <p class="text-muted"><?php echo $data['nama'];?></p>
                    <p><a href="penjualan.php?halaman=cart&id=<?php echo $data['id'];?>&aksi=tambah_produk&jumlah=1" class="btn btn-primary btn-block" role="button">Tambah Pesanan</a></p>
                </div>
            </div>
        </div>
        <?php 
        endwhile;
    }else {
        echo "<div class='alert alert-warning'> Tidak ada produk pada kategori ini.</div>";
    };
    ?>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#snack">
    Snack
</button>
    <!-- Modal -->
<div class="modal fade" id="snack" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <?php   
    include 'koneksi.php';
    $sql="SELECT * FROM produk
    WHERE id_kategori='2';";
    $hasil=mysqli_query($koneksi,$sql);
    $jumlah = mysqli_num_rows($hasil);
    if ($jumlah>0){
        while ($data = mysqli_fetch_array($hasil)):
    ?>
        <div class="col-sm-3">
            <div class="thumbnail">
                <div class="caption">
                <p class="text-muted"><?php echo $data['nama'];?></p>
                    <p><a href="penjualan.php?halaman=cart&id=<?php echo $data['id'];?>&aksi=tambah_produk&jumlah=1" class="btn btn-primary btn-block" role="button">Tambah Pesanan</a></p>
                </div>
            </div>
        </div>
        <?php 
        endwhile;
    }else {
        echo "<div class='alert alert-warning'> Tidak ada produk pada kategori ini.</div>";
    };
    ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#minuman">
    Minuman
    </button>
    <!-- Modal -->
<div class="modal fade" id="minuman" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <?php   
    include 'koneksi.php';
    $sql="SELECT * FROM produk
    WHERE id_kategori='3';";
    $hasil=mysqli_query($koneksi,$sql);
    $jumlah = mysqli_num_rows($hasil);
    if ($jumlah>0){
        while ($data = mysqli_fetch_array($hasil)):
    ?>
        <div class="col-sm-3">
            <div class="thumbnail">
                <div class="caption">
                <p class="text-muted"><?php echo $data['nama'];?></p>
                    <p><a href="penjualan.php?halaman=cart&id=<?php echo $data['id'];?>&aksi=tambah_produk&jumlah=1" class="btn btn-primary btn-block" role="button">Tambah Pesanan</a></p>
                </div>
            </div>
        </div>
        <?php 
        endwhile;
    }else {
        echo "<div class='alert alert-warning'> Tidak ada produk pada kategori ini.</div>";
    };
    ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<script src="js/bootstrap..min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>