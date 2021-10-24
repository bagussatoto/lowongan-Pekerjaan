<?php
	require "../../php/connection.php";
	$lowongan_id = $_POST['lowongan_id'];
	$calon_pekerja_id = $_POST['calon_pekerja_id'];
	$status = $_POST['status'];
			
	$strQuery = "INSERT INTO lamaran VALUES(null,'$lowongan_id', '$calon_pekerja_id', '$status')";
	$query = mysqli_query($connection, $strQuery);
	if($query){
		echo "<script language=javascript>alert('Lowongan Berhasil Di-apply.');</script>";
	}else{
		echo "<script language=javascript>alert('Lowongan Sudah Di-apply.');</script>";
	}
		
	echo "<script language=javascript>document.location.href='../dashboard.php'</script>";
	mysqli_close($connection);
?>