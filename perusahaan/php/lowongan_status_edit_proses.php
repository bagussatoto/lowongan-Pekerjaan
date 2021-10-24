<?php
	require "../../php/connection.php";
	$id = $_POST['id'];
	$lowongan_id = $_POST['lowongan_id'];
	$status = $_POST['status'];
			
	$strQuery = "UPDATE lamaran SET lamaran_status_lolos = '$status' WHERE lamaran_id = $id";
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
		echo "<script language=javascript>alert('Terjadi Kesalahan Saat Mengupdate Status Lamaran');</script>";
	}

	echo "<script language=javascript>document.location.href='../lowongan_detail.php?id=$lowongan_id'</script>";
	mysqli_close($connection);
?>