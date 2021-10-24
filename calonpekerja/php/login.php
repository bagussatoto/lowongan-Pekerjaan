<?php
	require "../../php/connection.php";
	session_start();
	$username = $_POST['username'];
	$password = $_POST['password'];
	$encPassword = md5($password);
	
	$strQuery = "SELECT * FROM login WHERE login_username = '$username' AND login_password='$encPassword'";
	$query = mysqli_query($connection, $strQuery);
	if($query){
		$thereIsAUser = mysqli_num_rows($query);
		if($thereIsAUser == 0){
			echo "<script language=javascript>alert('Username atau Password Tidak Cocok');</script>";
			echo "<script language=javascript>document.location.href='../login.php'</script>";
			mysqli_close($connection);
		}else{
			$result = mysqli_fetch_array($query, MYSQLI_ASSOC);
			$login_id = $result['login_id'];
			$login_role = $result['login_role'];
			if($login_role === "Calon Pekerja") {
				$strQuery = "SELECT * FROM calon_pekerja WHERE calon_pekerja_id = '$login_id'";
				$query = mysqli_query($connection, $strQuery);
				if($query) {
					$thereIsAnUser = mysqli_num_rows($query);
					if($thereIsAnUser == 0){
						echo "<script language=javascript>alert('Data Calon Pekerja tidak Ditemukan');</script>";
						echo "<script language=javascript>document.location.href='../login.php'</script>";
						mysqli_close($connection);
					}else {
						$_SESSION['login_role'] = $login_role;
						$result = mysqli_fetch_array($query, MYSQLI_ASSOC);
						$_SESSION['calon_pekerja_id'] = $result['calon_pekerja_id'];
						$_SESSION['calon_pekerja_nama_lengkap'] = $result['calon_pekerja_nama_lengkap'];
						echo "<script language=javascript>document.location.href='../dashboard.php'</script>";
					}
				}else {
					echo "<script language=javascript>alert('Terjadi Kesalahan');</script>";
					echo "<script language=javascript>document.location.href='../login.php'</script>";
				}
			} else {
				echo "<script language=javascript>alert('Anda Tidak Terdaftar Sebagai Calon Pekerja');</script>";
				echo "<script language=javascript>document.location.href='../login.php'</script>";
			}
			mysqli_close($connection);
		}
	}else {
		echo "<script language=javascript>alert('Terjadi Kesalahan');</script>";
		echo "<script language=javascript>document.location.href='../login.php'</script>";
	}
	
	mysqli_close($connection);
?>