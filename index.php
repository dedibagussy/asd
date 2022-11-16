<!doctype html>
<html lang="en">
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
	if(isset($_GET['pesan'])){
		if($_GET['pesan']=="gagal"){
			echo "<div class='alert'>Username dan Password tidak sesuai !</div>";
		}
	}
	?>
 <form action="cek_login.php" method="post">
 <div class="container">
 <div class="text-center">
  <img src="logo.png" class="rounded">
</div>
  <div class="mb-3">
  <div id="emailHelp" class="form-text">Username</div>
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="username" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
  <div id="emailHelp" class="form-text">Password</div>
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
  </div>
  <button type="submit" class="btn btn-primary" name="proses" value="LOGIN">Submit</button>
</div>
</form>

  
    <script src="js/bootstrap..min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>