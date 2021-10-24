<?php
	require "../../php/connection.php";
	$id = $_POST['id'];
	$nama = $_POST['nama'];
			
	$strQuery = "UPDATE kategori SET kategori_nama = '$nama' WHERE kategori_id = $id";
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
		echo "<script language=javascript>alert('Terjadi Kesalahan Saat Mengupdate Data Kategori');</script>";		
	}
	
	echo "<script language=javascript>document.location.href='../kategori.php'</script>";
	mysqli_close($connection);
?>