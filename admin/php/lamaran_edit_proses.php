<?php
	require "../../php/connection.php";
	$id = $_POST['id'];
	$status = $_POST['status'];
			
	$strQuery = "UPDATE lamaran SET lamaran_status_lolos = '$status' WHERE lamaran_id = $id";
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
		echo "<script language=javascript>alert('Terjadi Kesalahan Saat Mengupdate Data Lamaran');</script>";	
	}
	
	echo "<script language=javascript>document.location.href='../lamaran.php'</script>";
	mysqli_close($connection);
?>