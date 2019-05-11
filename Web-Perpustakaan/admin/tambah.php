<?php 
session_start();

if (!isset($_SESSION["login"])) {
	header("Location : index.php");
	exit;
}

require '../controller/functions.php';
$buku = query("SELECT * FROM buku");

if (isset($_POST["submit"])) {
	//cek berhasil atau tidak
	if (buku($_POST) > 0) {
		echo "<script>
			alert('data berhasil ditambah');
			document.location.href = 'index.php';
		</script>";
	}else {
		echo "<script>
			alert('data gagal ditambah');
			document.location.href = 'index.php';
		</script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Page</title>
	<link rel="stylesheet" href="../bootstrap.min.css">
	<style>
		#brand,#logout {color: white;}
		ul li{ list-style: none; display: inline; }
		.data_table{margin-top: 15px;margin-bottom: 15px;}
		#transaksi {margin-bottom: 100px;}
	</style>
</head>
<body class="container-fulid">

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

<div class="container" id="tambah-data">
	<form class="form-group col-md-6 col-md-offset-3" action="" method="post">
	<h1 class="text-center">Tambah Data</h1>
	<table class="table table-bordered" align="center" cellpadding="10" cellspacing="0">
		<tr class="active">
			<th>Buku</th>
		</tr>
		<tr>
			<td>
				
				<input type="text" name="kode" class="form-control data_table" required placeholder="Kode Buku">
	
				<input type="text" name="judul" class="form-control data_table" required placeholder="Judul Buku">
				
				<input type="text" name="pengarang" class="form-control data_table" required placeholder="Pengarang Buku">

				<input type="text" name="penerbit" class="form-control data_table" required placeholder="Penerbit Buku">

				<input type="text" name="kategori" class="form-control data_table" required placeholder="Kategori Buku">

				<input type="number" name="stock" class="form-control data_table" required placeholder="Stock Buku">

			</td>
		</tr>
		<tr>
			<td colspan="4" class="text-center">
				<button type="submit" name="submit" class="btn btn-success">Tambah Data</button> 
				<a href="index.php" class="btn btn-default">Kembali</a>
			</td>
		</tr>
	
	</table>
	</form>
</div>

</body>
</html>