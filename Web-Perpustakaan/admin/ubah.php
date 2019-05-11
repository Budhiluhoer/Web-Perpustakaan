<?php 

session_start();

if (!isset($_SESSION["login"])) {
	header("Location : index.php");
	exit;
}


require '../controller/functions.php';

//ambil data di url
$id = $_GET["id"];
//query data mahasiswa berdasarkan id
$kueri = query("SELECT * FROM buku WHERE id = $id")[0];
// var_dump($kueri["nama"]);

if (isset($_POST["submit"])) {
	//cek berhasil atau tidak
	if (ubah($_POST) > 0) {
		echo "<script>
			alert('data berhasil diubah');
			document.location.href = 'index.php';
		</script>";
	}else {
		echo "<script>
			alert('data gagal diubah');
		</script>";
			//document.location.href = 'index.php';
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>UBAH DATA</title>
	<link rel="stylesheet" href="../bootstrap.min.css">
</head>
<body class="container">

<div class="col-md-4 col-md-offset-4">
	<form action="" method="post" class="form-group">

		<input type="hidden" name="id" value="<?= $kueri["id"]; ?>">
		
		<h1 class="text-center">Ubah Data</h1><br>

		<label for="kode">Kode : </label>
		<input class="form-control" type="text" name="kode" id="kode" required value="<?= $kueri["kode"] ?>"><br>
			
		<label for="judul">Judul : </label>
		<input class="form-control" type="text" name="judul" id="judul" required value="<?= $kueri["judul"] ?>"><br>
			
		<label for="pengarang">Pengarang : </label>
		<input class="form-control" type="text" name="pengarang" id="pengarang" required value="<?= $kueri["pengarang"] ?>"><br>
			
		<label for="penerbit">Penerbit : </label>
		<input class="form-control" type="text" name="penerbit" id="penerbit" required value="<?= $kueri["penerbit"] ?>"><br>
		
		<label for="kategori">Kategori : </label>
		<input class="form-control" type="text" name="kategori" id="kategori" required value="<?= $kueri["kategori"] ?>"><br>
			
		<label for="stock">Stock : </label>
		<input class="form-control" type="number" name="stock" id="stock" required value="<?= $kueri["stock"] ?>"><hr>

		<button class="btn btn-success" type="submit" name="submit">Ubah Data</button>
		<a href="index.php" class="btn btn-default">Kembali</a>
	</form>

</div>	
</body>
</html>