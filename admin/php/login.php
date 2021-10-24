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
		}else{
			$result = mysqli_fetch_array($query, MYSQLI_ASSOC);
			$login_id = $result['login_id'];
			$login_role = $result['login_role'];
			if($login_role === "Admin") {
				$strQuery = "SELECT * FROM admin WHERE admin_id = '$login_id'";
				$query = mysqli_query($connection, $strQuery);
				if($query) {
					$thereIsAnAgen = mysqli_num_rows($query);
					if($thereIsAnAgen == 0){
						echo "<script language=javascript>alert('Data Admin tidak Ditemukan');</script>";
						echo "<script language=javascript>document.location.href='../login.php'</script>";
					}else {
						$_SESSION['login_role'] = $login_role;
						$result = mysqli_fetch_array($query, MYSQLI_ASSOC);
						$_SESSION['admin_id'] = $result['admin_id'];
						$_SESSION['admin_nama'] = $result['admin_nama'];
						echo "<script language=javascript>document.location.href='../dashboard.php'</script>";
					}
				}else {
					echo "<script language=javascript>alert('Terjadi Kesalahan Saat Login');</script>";
					echo "<script language=javascript>document.location.href='../login.php'</script>";
				}
			} else {
				echo "<script language=javascript>alert('Anda Tidak Terdaftar Sebagai Admin');</script>";
				echo "<script language=javascript>document.location.href='../login.php'</script>";
			}
		}
	}else {
		echo "<script language=javascript>alert('Terjadi Kesalahan');</script>";
		echo "<script language=javascript>document.location.href='../login.php'</script>";
	}
	
	mysqli_close($connection);
?>