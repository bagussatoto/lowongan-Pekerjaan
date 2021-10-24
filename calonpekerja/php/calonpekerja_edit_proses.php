<?php
	require "../../php/connection.php";
	session_start();
	$id = $_POST['id'];
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

	$login_id = $_POST['login_id'];
	$username = $_POST['username'];
	$password = $_POST['password'];
			
	mysqli_begin_transaction($connection, MYSQLI_TRANS_START_READ_WRITE);
	mysqli_autocommit($connection, FALSE);
	if($_FILES['file_cv']['size'] == 0) {
		$strQuery = "UPDATE calon_pekerja SET 
		calon_pekerja_nama_lengkap = '$nama', 
		calon_pekerja_alamat = '$alamat', 
		kota_id = '$kota_id', 
		calon_pekerja_jenis_kelamin = '$jk', 
		calon_pekerja_tempat_lahir = '$tempat_lahir', 
		calon_pekerja_tanggal_lahir = '$tanggal_lahir', 
		calon_pekerja_status_pernikahan = '$status_pernikahan',
		calon_pekerja_email = '$email',  
		calon_pekerja_telepon = '$telepon',  
		calon_pekerja_pendidikan_terakhir = '$pendidikan_terakhir',  
		calon_pekerja_tempat_pendidikan_terakhir = '$tempat_pendidikan_terakhir',  
		calon_pekerja_tempat_bekerja_terakhir = '$tempat_bekerja_terakhir',  
		calon_pekerja_pekerjaan_bekerja_terakhir = '$pekerjaan_bekerja_terakhir'  
		WHERE calon_pekerja_id = $id";
		$query = mysqli_query($connection, $strQuery);
		if($query){
			if(!empty($password)){
				$encPassword = md5($password);
				$strQuery = "UPDATE login SET login_username = '$username', login_password = '$encPassword' WHERE login_id = $login_id";
			}else {
				$strQuery = "UPDATE login SET login_username = '$username' WHERE login_id = $login_id";
			}	
			
			$query = mysqli_query($connection, $strQuery);
			if($query){
				$_SESSION['calon_pekerja_nama_lengkap'] = $nama;
				echo "<script language=javascript>alert('Profil Berhasil Diupdate');</script>";
				mysqli_commit($connection);	
			}else {
				mysqli_rollback($connection);
				echo "<script language=javascript>alert('Terjadi Kesalahan Saat Mengupdate Data Login Calon Pekerja');</script>";
			}
		}else{
			mysqli_rollback($connection);
			echo "<script language=javascript>alert('Terjadi Kesalahan Saat Mengupdate Data Calon Pekerja');</script>";
		}
	}else {
		$target_dir = "../../upload/cv/";
		$cv = str_replace(" ","", $nama);
		$temp = explode(".", $_FILES["file_cv"]["name"]);
		$cv = strtolower($cv . date('YmdHis') . "." . end($temp));
		$target_file = $target_dir . basename($cv);
		if (move_uploaded_file($_FILES['file_cv']['tmp_name'], $target_file)) {
			$strQuery = "UPDATE calon_pekerja SET 
			calon_pekerja_nama_lengkap = '$nama', 
			calon_pekerja_alamat = '$alamat', 
			kota_id = '$kota_id', 
			calon_pekerja_jenis_kelamin = '$jk', 
			calon_pekerja_tempat_lahir = '$tempat_lahir', 
			calon_pekerja_tanggal_lahir = '$tanggal_lahir', 
			calon_pekerja_status_pernikahan = '$status_pernikahan',
			calon_pekerja_email = '$email',  
			calon_pekerja_telepon = '$telepon',  
			calon_pekerja_pendidikan_terakhir = '$pendidikan_terakhir',  
			calon_pekerja_tempat_pendidikan_terakhir = '$tempat_pendidikan_terakhir',  
			calon_pekerja_tempat_bekerja_terakhir = '$tempat_bekerja_terakhir',  
			calon_pekerja_pekerjaan_bekerja_terakhir = '$pekerjaan_bekerja_terakhir',
			calon_pekerja_file_cv = '$cv'  
			WHERE calon_pekerja_id = $id";
			$query = mysqli_query($connection, $strQuery);
			if($query){				
				if(!empty($password)){
					$encPassword = md5($password);
					$strQuery = "UPDATE login SET login_username = '$username', login_password = '$encPassword' WHERE login_id = $login_id";
				}else {
					$strQuery = "UPDATE login SET login_username = '$username' WHERE login_id = $login_id";
				}	
				
				$query = mysqli_query($connection, $strQuery);
				if($query){
					echo "<script language=javascript>alert('Profil Berhasil Diupdate');</script>";
					mysqli_commit($connection);	
				}else {
					mysqli_rollback($connection);
					echo "<script language=javascript>alert('Terjadi Kesalahan Saat Mengupdate Data Login Calon Pekerja');</script>";
				}
			}else{
				mysqli_rollback($connection);
				echo "<script language=javascript>alert('Terjadi Kesalahan Saat Mengupdate Data Calon Pekerja');</script>";	
			}
		}else{
			mysqli_rollback($connection);
			echo "<script language=javascript>alert('Terjadi Kesalahan Saat Mengupload file CV');</script>";
		}
	}

	mysqli_autocommit($connection, TRUE);
	echo "<script language=javascript>document.location.href='../profil_edit.php'</script>";
	mysqli_close($connection);
?>