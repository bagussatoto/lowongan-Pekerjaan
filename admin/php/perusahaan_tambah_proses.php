<?php
	require "../../php/connection.php";
	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$kota_id = $_POST['kota_id'];
	$email = $_POST['email'];
	$telepon = $_POST['telepon'];

	$username = $_POST['username'];
	$password = $_POST['password'];

	mysqli_begin_transaction($connection, MYSQLI_TRANS_START_READ_WRITE);
	mysqli_autocommit($connection, FALSE);

	$encPassword = md5($password);
	$strQuery = "INSERT INTO login VALUES(null,'$username', '$encPassword', 'Perusahaan')";
	$query = mysqli_query($connection, $strQuery);
	if($query){
		$login_id = mysqli_insert_id($connection);
		$strQuery = "INSERT INTO perusahaan VALUES( 
			'$login_id',
			'$nama', 
			'$alamat', 
			'$kota_id', 
			'$email',  
			'$telepon'
		)";
		$query = mysqli_query($connection, $strQuery);
		if($query){			
			mysqli_commit($connection);	
		}else{
			mysqli_rollback($connection);
			echo "<script language=javascript>alert('Terjadi Kesalahan Saat Menambah Data Perusahaan');</script>";
		}
	}else {
		mysqli_rollback($connection);
		echo "<script language=javascript>alert('Terjadi Kesalahan Saat Mengupdate Data Login Perusahaan');</script>";
	}
		
	mysqli_autocommit($connection, TRUE);
	echo "<script language=javascript>document.location.href='../perusahaan.php'</script>";
	mysqli_close($connection);
?>