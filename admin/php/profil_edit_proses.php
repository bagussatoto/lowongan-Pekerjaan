<?php
	require "../../php/connection.php";
	session_start();
	$id = $_POST['id'];
	$nama = $_POST['nama'];

	$login_id = $_POST['login_id'];
	$username = $_POST['username'];
	$password = $_POST['password'];
			
	mysqli_begin_transaction($connection, MYSQLI_TRANS_START_READ_WRITE);
	mysqli_autocommit($connection, FALSE);

	$strQuery = "UPDATE admin SET 
	admin_nama = '$nama'
	WHERE admin_id = $id";
	$query = mysqli_query($connection, $strQuery);
	if($query){
		$_SESSION['admin_nama'] = $nama;
		if(!empty($password)){
			$encPassword = md5($password);
			$strQuery = "UPDATE login SET login_username = '$username', login_password = '$encPassword' WHERE login_id = $login_id";
		}else {
			$strQuery = "UPDATE login SET login_username = '$username' WHERE login_id = $login_id";
		}	
		$query = mysqli_query($connection, $strQuery);
		if($query){
			$_SESSION['admin_nama'] = $nama;
			echo "<script language=javascript>alert('Profil Berhasil Diupdate');</script>";
			mysqli_commit($connection);
		}else {
			mysqli_rollback($connection);
			echo "<script language=javascript>alert('Terjadi Kesalahan Saat Mengupdate Data Login Admin');</script>";
		}
	}else{
		mysqli_rollback($connection);
		echo "<script language=javascript>alert('Terjadi Kesalahan Saat Mengupdate Data Admin');</script>";
	}
	
	mysqli_autocommit($connection, TRUE);
	echo "<script language=javascript>document.location.href='../profil_edit.php'</script>";
	mysqli_close($connection);
?>