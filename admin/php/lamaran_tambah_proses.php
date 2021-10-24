<?php
	require "../../php/connection.php";
	$lowongan_id = $_POST['lowongan_id'];
	$calon_pekerja_id = $_POST['calon_pekerja_id'];
	$status = $_POST['status'];
			
	$strQuery = "INSERT INTO lamaran VALUES(null,'$lowongan_id', '$calon_pekerja_id', '$status')";
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
		echo "<script language=javascript>alert('Terjadi Kesalahan Saat Menambah Data Lamaran');</script>";	
	}
		
	echo "<script language=javascript>document.location.href='../lamaran.php'</script>";
	mysqli_close($connection);
?>