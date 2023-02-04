<?php 

//fungsi menampilkan Data
function select($query){
	global $koneksi;
	$result = mysqli_query($koneksi, $query);
	$rows = [];

	while($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}

	return $rows;
}

function create_data($post){
	global $koneksi;

	$foto = upload_file();
	$keterangan = $post['keterangan'];
	$tanggal = $post['tanggal'];
	
	//query tambah data 
	$query = "INSERT INTO  db_kegiatan VALUES(NULL, '$foto', '$keterangan','$tanggal')";
	mysqli_query($koneksi, $query);
	return mysqli_affected_rows($koneksi);
}

function upload_file(){
	$namefile = $_FILES['foto']['name'];
	$fotosize = $_FILES['foto']['size'];
	$error = $_FILES['foto']['error'];
	$tmpname = $_FILES['foto']['tmp_name'];

	$ektensionfileValid = ['jpg', 'jpeg', 'png'];
	$ektensifile = explode('.', $namefile);
	$ektensifile = strtolower(end($ektensifile));

	if(!in_array($ektensifile, $ektensionfileValid)){
		echo 
		"<script>
		alert ('FORMAT TIDAK FALID')
		document.location.href = 'index.php';
		</script>";
		die();
	}
	if ($fotosize > 2048000){
		echo 
		"<script>
		alert ('FILE TERLALU BESAR MAX 2MB ')
		document.location.href = 'index.php';
		</script>";
		die();
	}
	//generate file baru 
	$namafileBaru = uniqid();
	$namafileBaru .= '.';
	$namafileBaru .= $ektensifile;
	
	//pindahkan file lokal 
	move_uploaded_file($tmpname, 'assets/img/'.$namafileBaru);
	return $namafileBaru;
}

function edit_kegiatan($id){
	global $koneksi;
}

function delete_barang($id)
{
	global $koneksi;

	$query = "DELETE FROM db_kegiatan WHERE id = $id";
	mysqli_query($koneksi, $query);
	return mysqli_affected_rows($koneksi);
}

//karyawan 

function create_karyawan($post){
	global $koneksi;

	$foto = upload_file();
	$nama = $post['nama'];
	$keterangan = $post['keterangan'];
	$tanggal = $post['tanggal'];
	
	//query tambah data 
	$query = "INSERT INTO  db_kegiatan VALUES(NULL, '$foto', '$keterangan','$tanggal')";
	mysqli_query($koneksi, $query);
	return mysqli_affected_rows($koneksi);
}
?>