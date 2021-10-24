<?php
	require "../../php/connection.php";
	$id = $_POST['id'];
			
	$strQuery = "DELETE FROM lowongan WHERE lowongan_id = $id";
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
		echo "<script language=javascript>alert('Terjadi Kesalahan Saat Menghapus Data Lowongan');</script>";	
	}
	
	echo "<script language=javascript>document.location.href='../lowongan.php'</script>";
	mysqli_close($connection);
?>