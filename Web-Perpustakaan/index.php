<?php 

session_start();
if (isset($_SESSION["login"])) {
	header("Location: admin/index.php");
	exit;
}

require 'controller/functions.php';

if (isset($_POST['submit'])) {
		$username = $_POST["username"];
		$password = $_POST["password"];
		
		$kueri = mysqli_query($db,
			"SELECT * FROM users WHERE username='$username'");

	//cek username
	if (mysqli_num_rows($kueri) == 1) {
		//cek password
		$row = mysqli_fetch_assoc($kueri);
		if( password_verify($password, $row["password"]) ){
			
			// set session
			$_SESSION["login"] = true;
			 
			header("Location: admin/index.php");
			exit;
		}else{
			echo "<script>alert('login gagal');</script>";
		}
	}

	$error = true;
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Page</title>
	<link rel="stylesheet" href="bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<nav class="container">
    
    <div class="text-center" id="search">
     	<h2 id="judul">Cari Buku Sekarang</h2>
    </div>
</nav>

<form method="get" action="result-search.php" id="form-cari">

	<div class="col-md-5 col-md-offset-3">
		<input type="text" class="form-control" name="keyword" id="cari" 
		placeholder="Masukan Judul Buku" autofocus required autocomplete="off">
	</div>
	<div id="tombol-cari" class="col-md-1">
		<button type="submit" name="cari" class="btn btn-primary btn-lg">Cek Sekarang</button>
	</div>

</form>


<footer class="container col-md-12 navbar-inverse">
	
<div class="col-md-6 col-md-offset-3 text-center"><br><br>

	<form action="" method="post" class="navbar-form text-center">
        
        <div class="form-group">
          <input type="text" name="username" class="form-control" placeholder="Username" required autocomplete="off">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <button type="submit" name="submit" class="btn btn-primary" class="btn">Login</button>
        </div>
       
    </form><br>
	<h5>Copyright 2019 | Created by MBL</h5>

</div>

</footer>

</body>
</html>

