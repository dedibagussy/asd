<?php
session_start();

$koneksi = mysqli_connect("localhost","root","","db_skyresto");
$KERANJANG = $_SESSION['keranjang'];
if(!isset($_SESSION['pemesan'])){
    $_SESSION['pemesan'] = "";
}

if(isset($_POST['tambah_pemesan'])){
    $_SESSION['pemesan'] = $_POST['nama_pemesan'];
}

if (isset($_POST['tambah_keranjang'])) {
    $id = $_GET['id'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $pemesan = strtoupper($_POST['pemesan']);
    $jumlah = $_POST['jumlah'];
    $uniqueId = $id.$pemesan;
    
    if (isset($KERANJANG)){

        $session_array_id = array_column($KERANJANG, "uniqueId");

        if (!in_array($uniqueId, $session_array_id)) {

            $session_array = array(
                'id' => $id,
                "pemesan" => $pemesan,
                "uniqueId" => $uniqueId,
                "nama" => $nama,
                "harga" => $harga,
                "jumlah" => $jumlah
            );
            $_SESSION['keranjang'][] = $session_array;
        
        }else{
            $index = array_search($uniqueId, $session_array_id);
            $total_harga_baru = $KERANJANG[$index]["harga"] * $jumlah;
            $_SESSION['keranjang'][$index] = array(
                'id' => $id,
                "pemesan" => $pemesan,
                "nama" => $nama,
                "uniqueId" => $uniqueId,
                "harga" => $harga,
                "jumlah" => $jumlah + $KERANJANG[$index]["jumlah"]
            );

        }

    }else{

        $session_array = array(
            'id' => $id,
            "nama" => $nama,
            "pemesan" => $pemesan,
            "uniqueId" => $uniqueId,
            "harga" => $harga,
            "jumlah" => $jumlah
        );

        $_SESSION['keranjang'][] = $session_array;
    }
}

if(isset($_GET['action'])){
$aksi = $_GET['action'];

if($aksi == "remove"){
    $id = $_GET['id'];
    $pemesan = strtoupper($_GET['pemesan']);
    $uniqueId = $id.$pemesan;

    if(!isset($KERANJANG)) return;
    $session_array_id = array_column($KERANJANG, "uniqueId");
    
    if(!in_array($uniqueId, $session_array_id)) return;
    $index = array_search($id, $session_array_id);
    unset($_SESSION['keranjang'][$index]);

    $_SESSION['keranjang'] = array_values($_SESSION['keranjang']);

}

if($aksi == 'clearall'){
    $_SESSION['keranjang'] = [];
}

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>TreeTop SkyResto</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
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

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6"><br><br><br>
                    <h2 class="text-center">Data Produk</h2>
                    <div class="col-md-12">
                        <div class="row">
                        <div class="col-md-3">
                        <div id="emailHelp" class="form-text"></div>
                        <div class="row">
                        <button type="button" class="btn btn-primary btn-block my-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Makan Berat
                            </button><br>
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
                                $query = "SELECT * FROM produk
                                WHERE id_kategori='1';";
                                $result = mysqli_query($koneksi,$query);
                                
                                while ($row = mysqli_fetch_array($result)) { ?>
                                    <div class="col-md-4">
                                        <form method="post" action="cart.php?id=<?=$row['id'] ?>"  onsubmit="return check(this)">
                                        <h5 class="text-center"><?= $row['nama']; ?></h5>
                                        <h5 class="text-center">Rp. <?= number_format($row['harga'],2); ?></h5>
                                        <input type="hidden" name="nama" value="<?= $row['nama'] ?>">
                                        <input type="hidden" name="harga" value="<?= $row['harga'] ?>">
                                        <input type="number" name="jumlah" value="1" class="form-control">
                                        <input type="hidden" name="pemesan" value=""/>
                                        <input type="submit" name="tambah_keranjang" class="btn btn-primary btn-block my-2"  value="Tambah Pesanan">
                                    </form>
                                    </div>

                            <?php } ?>
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                        </div>
                        <div id="emailHelp" class="form-text"></div>
                        <div class="row">
                        <button type="button" class="btn btn-primary btn-block my-2" data-bs-toggle="modal" data-bs-target="#snack">
                            Snack
                            </button>
                            <!-- Modal -->
                        <div class="modal fade" id="snack" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Makan Berat</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <div class="row">
                            <?php
                                $query = "SELECT * FROM produk
                                WHERE id_kategori='2';";
                                $result = mysqli_query($koneksi,$query);
                                
                                while ($row = mysqli_fetch_array($result)) { ?>
                                    <div class="col-md-4">
                                        <form method="post" action="cart.php?id=<?=$row['id'] ?>"  onsubmit="return check(this)">
                                        <h5 class="text-center"><?= $row['nama']; ?></h5>
                                        <h5 class="text-center">Rp. <?= number_format($row['harga'],2); ?></h5>
                                        <input type="hidden" name="nama" value="<?= $row['nama'] ?>">
                                        <input type="hidden" name="harga" value="<?= $row['harga'] ?>">
                                        <input type="number" name="jumlah" value="1" class="form-control">
                                        <input type="hidden" name="pemesan" value=""/>
                                        <input type="submit" name="tambah_keranjang" class="btn btn-primary btn-block my-2"  value="Tambah Pesanan">
                                    </form>
                                    </div>

                            <?php } ?>
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                        </div>
                                </div>
                        <div id="emailHelp" class="form-text"></div>
                        <div class="row">
                        <button type="button" class="btn btn-primary btn-block my-2" data-bs-toggle="modal" data-bs-target="#minuman">
                            Minuman
                            </button>
                            <!-- Modal -->
                        <div class="modal fade" id="minuman" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Makan Berat</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <div class="row">
                            <?php
                                $query = "SELECT * FROM produk
                                WHERE id_kategori='3';";
                                $result = mysqli_query($koneksi,$query);
                                
                                while ($row = mysqli_fetch_array($result)) { ?>
                                    <div class="col-md-4">
                                        <form method="post" action="cart.php?id=<?=$row['id'] ?>"  onsubmit="return check(this)">
                                        <h5 class="text-center"><?= $row['nama']; ?></h5>
                                        <h5 class="text-center">Rp. <?= number_format($row['harga'],2); ?></h5>
                                        <input type="hidden" name="nama" value="<?= $row['nama'] ?>">
                                        <input type="hidden" name="harga" value="<?= $row['harga'] ?>">
                                        <input type="number" name="jumlah" value="1" class="form-control">
                                        <input type="hidden" name="pemesan" value=""/>
                                        <input type="submit" name="tambah_keranjang" class="btn btn-primary btn-block my-2"  value="Tambah Pesanan">
                                    </form>
                                    </div>

                            <?php } ?>
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                        </div></div>
                                </div>
                                </div>
                        <div class="col-md-6">
                            Atur nama pemesan sebelum membuat pesanan
                            <form method="post" action="cart.php" onsubmit="return set()">
                            <input type="text" id="nama_pemesan" name="nama_pemesan" value="<?= $_SESSION['pemesan']?>" placeholder="Masukkan nama pemesan ..." class="form-control">
                            <input type="submit" name="tambah_pemesan" class="btn btn-primary btn-block my-2"  value="Atur nama pemesan">
                            
                        </form>
                          </form>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-md-6"><br><br><br>
                    <h2 class="text-center">Transaksi</h2>
                    <div class="col-md-6">
                    <form method="post" action="">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" name="idpemesan">
                            ID Pesanan
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                        </div>
                        <label class="input-group-text" for="inputGroupSelect01">Metode Pembayaran</label>
                            <select class="form-select" id="inputGroupSelect01" name="pembayaran">
                                <option value="1"></option>
                                <option value="Dapur">Cash</option>
                                <option value="Kasir">Tiket</option>
                            </select></div>
                        <div id="emailHelp" class="form-text">Nama Pemesan</div>
                         <input type="text" class="form-control" name="pemesan"><br>
                        <div id="emailHelp" class="form-text">Uang Dibayarkan :</div>
                         <input type="text" class="form-control" name="jumlahuang"><br>
                         <button type="submit" class="btn btn-primary" name="submit" value="submit">Bayar</button>
                      </div>
                    </form>

                    </div>
                    <div class="col-md-6">
                    <?php
                    $total = 0;
                    $output = "";
                    $output .= "
                        <table class='table table-bordered table-striped'>
                            <tr>
                                <th>ID</th>
                                <th>Nama Item</th>
                                <th>Pemesan</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                    ";

                    if(!empty($_SESSION['keranjang'])){
                        $uniqueTotal = 0;
                        $uniqueName;
                        foreach ($_SESSION['keranjang'] as $key => $value) {
                            if(isset($uniqueName) && $uniqueName != $value['pemesan']){
                                $output .= "
                                <tr>
                                    <td colspan='4'></td>
                                    <td>Total Bayar</td>
                                    <td>Rp. ".number_format($uniqueTotal,2)."</td>
                                    <td>
                                        <a href='cart.php?action=clearall'>
                                    </td>
                                    </tr>
                            ";

                            $uniqueName = $value['pemesan'];
                            $uniqueTotal = 0;
                            }

                            if(!isset($uniqueName)){ $uniqueName =  $value['pemesan'];}

                            $output .= "
                            <tr>
                                <td>".$value['id']."</td>
                                <td>".$value['nama']."</td>
                                <td>".$value['pemesan']."</td>
                                <td>".$value['jumlah']."</td>
                                <td>".$value['harga']."</td>
                                <td>Rp. ".number_format($value['harga'] * $value['jumlah'],2)."</td>
                                <td>
                                <a href='cart.php?action=remove&id=".$value['id']."&pemesan=".$value['pemesan']."'>
                                <button class-'btn btn-danger btn-block'>Hapus</button>
                                </a>

                            </td>
                            </tr>
                                </div>";
                            $uniqueTotal = $uniqueTotal + ($value['jumlah'] * $value['harga']);
                            
                        }
                        $output .= "
                        <tr>
                            <td colspan='4'></td>
                            <td>Total Bayar</td>
                            <td>Rp. ".number_format($uniqueTotal,2)."</td>
                            <td>
                                <a href='cart.php?action=clearall'>
                            </td>
                            </tr>
                    ";
                     
                    }
                    $output .= "
                        <tr>
                            <td colspan='5'></td>
                            <td colspan='2'><center><button class-'btn btn-danger btn-block' name-'submit' value-'submit'>Bayar</button></center></td>
                            </tr>
                            ";
                    echo $output;
                    ?>
                    <?php
                            if(isset($_POST['submit'])){
                            $penjualan = $_POST['penjualan'];
                            include 'koneksi.php';
                    
                    // menangkap data yang di kirim dari form
                    $pemesan = $_POST['pemesan'];
                    $keranjang = $_POST['nama'];
                    $uniqueTotal = $_POST['total'];
                    $pembayaran = $_POST['pembayaran'];
                    $date = $_POST['waktu'];


                    // menginput data ke database
                    mysqli_query($koneksi,"insert into penjualan (pemesan,keranjang,total,pembayaran,waktu) values(?,?,?,?,?,?)");

                    // mengalihkan halaman kembali ke index.php
                    header("location:cart.php");
                            }
                        ?>        
                </div>
                </div>
            </div>
        </div>
        
    </div>
    
   <script>
    function check(form){

        let pemesan = document.querySelector('#nama_pemesan').value
       
        if(!pemesan){
            alert('Nama pemesan wajib diisi!')
            return false;
        }

        form.pemesan.value = pemesan;
        return true;
    }

    
    function set() {
        alert('Berhasil mengatur nama pemesan')   
    return true;
    }
    
    </script>

    

    <script src="js/bootstrap..min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>