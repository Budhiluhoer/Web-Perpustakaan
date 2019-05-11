<?php 

session_start();

if (!isset($_SESSION["login"])) {
	header("Location : index.php");
	exit;
}

require '../controller/functions.php';

if(isset($_POST['submit'])) {

		if (register($_POST) > 0) { // user baru / pertambahan user
			echo "<script>
				alert('buat akun berhasil');
				document.location.href = 'index.php';
			</script>";
		} else {
			echo "<script>
				alert('buat akun gagal');
			</script>";
		}
		
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registrasi</title>
	<style>
		.bg {
			background-color: #fff;
			width: 500px;
			height: 380px;
			padding: 25px;
			padding-top: 30px;
			margin:auto;
			margin-top: 10px;
			border-radius: 10px;
		}
		button {
			padding-left: 100px;
		}
		#brand a {
			color: white;
			text-decoration: none;
		}
		#brand,#logout {color: white;}
		ul li{ list-style: none; display: inline; }
		.data_table{margin-top: 15px;margin-bottom: 15px;}
		#transaksi {margin-bottom: 100px;}
	</style>
	<link rel="stylesheet" href="../bootstrap.min.css">
</head>
<body>

	<nav class="nav navbar navbar-inverse">
		  <div class="container">	
			<ul>
				<h3 id="brand">Administrator</h3>
				<li><a href="index.php" class="btn btn-link">Home</a></li>
				<li><a href="registrasi.php" class="btn btn-link">New Account</a></li>
				<li><a class="btn btn-link" href="logout.php" onclick="return confirm('Yakin?');">Logout</a></li>
			</ul>
		  </div>
	</nav>

	<div class="bg">

		<h1>Registrasi</h1><hr>
		<form action="" method="post" class="form-group">

			<input type="text" name="username" id="username" class="form-control" autofocus placeholder="Username" required><br>

			<input type="password" name="password" class="form-control" id="password" placeholder="Password" required><br>
			
			<input type="password" name="password2" class="form-control" id="password2" placeholder="Konfirmasi Password" required><br>
			
			<button type="submit" class="btn btn-primary" name="submit">Daftar</button>
			<a href="index.php" class="btn btn-default">Kembali</a>
		
		</form>

	</div>

</body>
</html>