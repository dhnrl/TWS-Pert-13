<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "pustaka";
$con = mysqli_connect($server, $username, $password) or die("<h1>Koneksi Mysqli Error : </h1>" . mysqli_connect_error());
mysqli_select_db($con, $database) or die ("<h1>Koneksi Kedatabse Error : </h1>". mysqli_error($con));

@$sistembuku = $_GET['sistembuku'];

switch ($sistembuku) {

	case "lihatbuku":

	$query_tampil_buku = mysqli_query($con,"SELECT * FROM buku") or die (mysqli_error($con));
	$data_array = array();

	while ($data = mysqli_fetch_assoc($query_tampil_buku)) {
		$data_array[]=$data;
	}
	echo json_encode($data_array);

	break;

	case "tambah_buku":
	@$id = $_POST['id'];
	@$judul_buku = $_POST['judul_buku'];
	@$id_kategori = $_POST['id_kategori'];
	@$pengarang = $_POST['pengarang'];
	@$penerbit = $_POST['penerbit'];
	@$tahun_terbit = $_POST['tahun_terbit'];
	@$isbn = $_POST['isbn'];
	@$stok = $_POST['stok'];
	@$dipinjam = $_POST['dipinjam'];
	@$dibooking = $_POST['dibooking'];
	@$image = $_POST['image'];

	$query_tambah_buku = mysqli_query($con, "INSERT INTO buku (id, judul_buku, id_kategori, pengarang, penerbit, tahun_terbit, isbn, stok, dipinjam, dibooking,image) VALUES('$id', '$judul_buku', '$id_kategori', '$pengarang', '$penerbit', '$tahun_terbit', '$isbn', '$stok', '$dipinjam', '$dibooking', '$image')");

	if ($query_tambah_buku) {
		echo "Data Berhasil Disimpan YEAAYY";
	}
	else {
		echo "Maaf Data yang ditambahkan ke dalam database ERROR" . mysqli_error($con);
	}

	break;

	case "get_buku_by_id":
	@$id =(int)$_GET['id'];
	$query_tampil_buku = mysqli_query($con, "SELECT * FROM buku WHERE id='$id'") or die (mysqli_error($con));
	$data_array = array();
	$data_array = mysqli_fetch_assoc($query_tampil_buku);
	echo "[" .json_encode ($data_array) . "]";
	break;

	case "edit_buku":
	@$id = $_GET['id'];
	@$judul_buku = $_GET['judul_buku'];
	@$id_kategori = $_GET['id_kategori'];
	@$pengarang = $_GET['pengarang'];
	@$penerbit = $_GET['penerbit'];
	@$tahun_terbit = $_GET['tahun_terbit'];
	@$isbn = $_GET['isbn'];
	@$stok = $_GET['stok'];
	@$dipinjam = $_GET['dipinjam'];
	@$dibooking = $_GET['dibooking'];
	@$image = $_GET['image'];

	$query_edit_buku = mysqli_query($con, "UPDATE user SET id='$id', judul_buku='$judul_buku', id_kategori='$id_kategori', pengarang='$pengarang', penerbit='$penerbit', tahun_terbit='$tahun_terbit', isbn='$isbn', stok='$stok', dipinjam='$dipinjam', dibooking='$dibooking', image ='$image'");


	if ($query_edit_buku) {
			echo " Update Data Berhasil YEAAAAYY";
	}
	else {
		echo mysqli_error($con);
	}
	break;

	case "hapus_buku":
	@$id = $_GET['id'];
	$query_delete_buku = mysqli_query($con, "DELETE FROM buku WHERE id='$id'");

	if ($query_delete_buku) {
		echo "Data Berhasil Dihapus :((";
	}
	else {
		echo mysqli_error($con);
	}
	break;

default:
break;
}
?>
