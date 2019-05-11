<?php 

session_start();
if (isset($_SESSION["login"])) {
	header("Location: admin/index.php");
	exit;
}

require 'controller/functions.php';

$buku = query("SELECT * FROM buku");

if (isset($_GET['cari'])) {
	$buku = cari($_GET['keyword']);
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Hasil Pencarian</title>
	<link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>

<h2 class="text-center">Hasil Pencarian Buku</h2><br>
<div class="container">
	<div class="col-md-6 col-md-offset-3">
	
	<a href="index.php" class="btn btn-default text-center">< Kembali</a> <br><br>
	
	<?php foreach ($buku as $row) : ?> 

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3><?= $row["judul"]; ?></h3>
			<p class="badge">Stock : <?= $row["stock"]; ?></p>
		</div>
		<div class="panel-body">
			Pengarang : <?= $row["pengarang"]; ?> <br>
			Penerbit : <?= $row["penerbit"]; ?> <br>
			Kategori : <?= $row["kategori"]; ?> <br>
		</div> 
	</div>

	<?php endforeach; ?>

	</div>
</div>

</body>
</html>