<?php 

$db = mysqli_connect("localhost", "root", "", "web_perpustakaan"); //koneksi ke database

// READ
function query($query) {
	global $db; //variabel scope (global)
	$result = mysqli_query($db, $query);
	$rows = [];
	while($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

// CREATE
function buku($data){
	global $db;
	$kode = htmlspecialchars($data["kode"]);
	$judul = htmlspecialchars($data["judul"]);
	$pengarang = htmlspecialchars($data["pengarang"]);
	$kategori = htmlspecialchars($data["kategori"]);
	$penerbit = htmlspecialchars($data["penerbit"]);
	$stock = htmlspecialchars($data["stock"]);

	$query = "INSERT INTO buku 
				VALUES 
			  ('', '$kode', '$judul', '$pengarang',
			  '$kategori', '$penerbit', '$stock')";

	mysqli_query($db, $query);
	return mysqli_affected_rows($db);
}

// DELETE
function hapus($id){
	global $db;
	mysqli_query($db, "DELETE FROM buku WHERE id = $id");
	return mysqli_affected_rows($db);
}

// UBAH/DELETE
function ubah($data){
	global $db;
	$id = $data["id"];
	$kode = htmlspecialchars($data["kode"]);
	$judul = htmlspecialchars($data["judul"]);
	$pengarang = htmlspecialchars($data["pengarang"]);
	$kategori = htmlspecialchars($data["kategori"]);
	$penerbit = htmlspecialchars($data["penerbit"]);
	$stock = htmlspecialchars($data["stock"]);

	$query = "UPDATE buku SET
				id = '$id',
				kode = '$kode',
				judul = '$judul',
				pengarang = '$pengarang',
				kategori = '$kategori',
				penerbit = '$penerbit',
				stock = '$stock'

				WHERE id = $id";

	mysqli_query($db, $query);
	return mysqli_affected_rows($db);
}

function register($data){
	global $db;
	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($db, $data["password"]); 
	$password2 = mysqli_real_escape_string($db, $data["password2"]);

	//cek kemiripan username
	$result = mysqli_query($db, "SELECT username FROM users WHERE username = '$username'");
	
	if (mysqli_fetch_assoc($result)) {
		echo "<script>
				alert('username sudah terdaftar');
			</script>";
		return false;
	}

	//cek konfirmasi password
	if ($password !== $password2) {
		echo "<script>
				alert('password tidak sesuai');
			</script>";
		return false;
	}

	//enkripsi
	// $password = md5($password); // jangan pake md5
	$password = password_hash($password, PASSWORD_DEFAULT);
	mysqli_query($db, "INSERT INTO users VALUES('','$username','$password')");

	return mysqli_affected_rows($db); // if > 0
}

function cari($keyword) {
	$query = "SELECT * FROM buku WHERE
		kode LIKE '%$keyword%' OR
		judul LIKE '%$keyword%'
		";
	return query($query); // filter function query() sesuai $query
}


?>