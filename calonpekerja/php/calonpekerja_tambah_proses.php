<?php
	require "../../php/connection.php";
	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$kota_id = $_POST['kota_id'];
	$jk = $_POST['jk'];
	$tempat_lahir = $_POST['tempat_lahir'];
	$tanggal_lahir = $_POST['tanggal_lahir'];
	$status_pernikahan = $_POST['status_pernikahan'];
	$email = $_POST['email'];
	$telepon = $_POST['telepon'];
	$pendidikan_terakhir = $_POST['pendidikan_terakhir'];
	$tempat_pendidikan_terakhir = $_POST['tempat_pendidikan_terakhir'];
	$tempat_bekerja_terakhir = $_POST['tempat_bekerja_terakhir'];
	$pekerjaan_bekerja_terakhir = $_POST['pekerjaan_bekerja_terakhir'];

	$username = $_POST['username'];
	$password = $_POST['password'];
	$confirm_password = $_POST['konfirmasi_password'];

	mysqli_begin_transaction($connection, MYSQLI_TRANS_START_READ_WRITE);
	mysqli_autocommit($connection, FALSE);

	if($password == $confirm_password){
		$encPassword = md5($password);
		$strQuery = "INSERT INTO login VALUES(null,'$username', '$encPassword', 'Calon Pekerja')";
		$query = mysqli_query($connection, $strQuery);
		if($query){
			$login_id = mysqli_insert_id($connection);
			$strQuery = "INSERT INTO calon_pekerja(
				calon_pekerja_id,
				calon_pekerja_nama_lengkap,
				calon_pekerja_alamat,
				kota_id,
				calon_pekerja_jenis_kelamin,
				calon_pekerja_tempat_lahir,
				calon_pekerja_tanggal_lahir,
				calon_pekerja_status_pernikahan,
				calon_pekerja_email,
				calon_pekerja_telepon,
				calon_pekerja_pendidikan_terakhir,
				calon_pekerja_tempat_pendidikan_terakhir,
				calon_pekerja_tempat_bekerja_terakhir,
				calon_pekerja_pekerjaan_bekerja_terakhir,
				calon_pekerja_file_cv
			) VALUES( 
				'$login_id',
				'$nama', 
				'$alamat', 
				'$kota_id', 
				'$jk', 
				'$tempat_lahir', 
				'$tanggal_lahir', 
				'$status_pernikahan',
				'$email',  
				'$telepon',  
				'$pendidikan_terakhir',  
				'$tempat_pendidikan_terakhir',  
				'$tempat_bekerja_terakhir',  
				'$pekerjaan_bekerja_terakhir',  
				''
			)";
			$query = mysqli_query($connection, $strQuery);
			if($query){	
				mysqli_commit($connection);
				echo "<script language=javascript>alert('Registrasi Berhasil');</script>";
				echo "<script language=javascript>document.location.href='../login.php'</script>";
			}else{
				mysqli_rollback($connection);
				echo "<script language=javascript>alert('Registrasi Gagal');</script>";
				echo "<script language=javascript>document.location.href='../signup.php'</script>";
			}		
		}else {
			mysqli_rollback($connection);
			echo "<script language=javascript>alert('Username Sudah Dipakai');</script>";
			echo "<script language=javascript>document.location.href='../signup.php'</script>";
		}
	}else {
		echo "<script language=javascript>alert('Password Tidak Cocok');</script>";
		echo "<script language=javascript>document.location.href='../signup.php'</script>";
	}
	
	mysqli_autocommit($connection, TRUE);
	mysqli_close($connection);
?>