<?php
	require "../../php/connection.php";
	$id = $_POST['id'];
	$lowongan_id = $_POST['lowongan_id'];
			
	$strQuery = "DELETE FROM lowongan_syarat WHERE lowongan_syarat_id = $id";
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
		echo "<script language=javascript>alert('Terjadi Kesalahan Saat Menghapus Data Syarat Lowongan');</script>";	
	}
		
	echo "<script language=javascript>document.location.href='../lowongan_detail.php?id=$lowongan_id'</script>";
	mysqli_close($connection);
?>