<?php
	require "../../php/connection.php";
	$id = $_POST['id'];
			
	$strQuery = "DELETE FROM kota WHERE kota_id = $id";
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
		echo "<script language=javascript>alert('Terjadi Kesalahan Saat Menghapus Data Kota');</script>";	
	}
	
	echo "<script language=javascript>document.location.href='../kota.php'</script>";
	mysqli_close($connection);
?>