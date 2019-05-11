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

if (isset($_GET['cari'])) {
	$buku = cari($_GET['keyword']);
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

<div class="container" id="transaksi">
<h1 class="text-center">Daftar Buku</h1><br><br>

<div class="col-md-12">
		<a href="tambah.php" class="btn btn-primary col-md-2">Tambah Data</a>

		<form method="get">
			<div class="col-md-3">
				<input type="text" class="form-control" name="keyword"
				placeholder="Cari Kode dan Judul Buku">
			</div>
			<button type="submit" name="cari" class="btn btn-primary col-md-1">Cari Buku</button>
		</form>
</div>
<br><br><br>


<table class="table table-hover container" align="center" cellpadding="10" cellspacing="0">
	<tr class="active">
		<th>No</th>
		<th algin="center">Kode</th>
		<th algin="center">Judul</th>
		<th algin="center">Pengarang</th>
		<th algin="center">Penerbit</th>
		<th algin="center">Kategori</th>
		<th algin="center">Stock</th>
		<th>Ubah</a></th>
		<th>Hapus</a></th>
	</tr>

	<?php $i=1; ?>
	<?php foreach ($buku as $row):  ?> 
	<tr>
		<td><?= $i; ?></td>
		<td><?= $row["kode"]; ?></td>
		<td><?= $row["judul"]; ?></td>
		<td><?= $row["pengarang"]; ?></td>
		<td><?= $row["penerbit"]; ?></td>
		<td><?= $row["kategori"]; ?></td>
		<td><?= $row["stock"]; ?></td>

		<td><a class="btn btn-warning" href="ubah.php?id=<?= $row["id"]; ?>">Ubah</a></td>
		<td><a class="btn btn-danger" href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Yakin?');">Hapus</a></td> 
	</tr>
	<?php $i++; ?>
	<?php endforeach; ?>
</table>
</div>

</body>
</html>