<?php
	require "../../php/connection.php";
	$id = $_POST['id'];
	$perusahaan_id = $_POST['perusahaan_id'];
	$judul = $_POST['judul'];
	$kategori_id = $_POST['kategori_id'];
	$tgl_buka = $_POST['tgl_buka'];
	$tgl_tutup = $_POST['tgl_tutup'];
	$deskripsi = $_POST['deskripsi'];
	$deskripsi = mysqli_real_escape_string($connection, $deskripsi);
			
	$strQuery = "UPDATE lowongan SET perusahaan_id = '$perusahaan_id', lowongan_judul = '$judul',
	kategori_id = '$kategori_id', lowongan_tgl_buka = '$tgl_buka', lowongan_tgl_tutup = '$tgl_tutup',
	lowongan_deskripsi = '$deskripsi'
	WHERE lowongan_id = $id";
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
		echo "<script language=javascript>alert('Terjadi Kesalahan Saat Mengupdate Data Lowongan');</script>";	
	}

	echo "<script language=javascript>document.location.href='../lowongan.php'</script>";
	mysqli_close($connection);
?>