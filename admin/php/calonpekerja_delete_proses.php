<?php
	require "../../php/connection.php";
	$id = $_POST['id'];
	$login_id = $_POST['login_id'];
	
	$strQuery = "DELETE FROM login WHERE login_id = $login_id";
	$query = mysqli_query($connection, $strQuery);
	if($query){
		mysqli_commit($connection);
	}else {
		mysqli_rollback($connection);
		echo "<script language=javascript>alert('Terjadi Kesalahan Saat Menghapus Data Calon Pekerja');</script>";
	}
	
	echo "<script language=javascript>document.location.href='../calonpekerja.php'</script>";
	mysqli_close($connection);
?>