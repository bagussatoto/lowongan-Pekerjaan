<?php
	require "../../php/connection.php";
	$id = $_POST['id'];
	$syarat = $_POST['array_syarat'];
	$syarat = explode("---",$syarat);
	$keys = array_keys($syarat);
	$last = end($keys);
	unset($syarat[$last]);

	foreach ($syarat as $s) {
		$strQuery = "INSERT INTO lowongan_syarat VALUES(null, '$id','$s')";
		$query = mysqli_query($connection, $strQuery);
	}

	if(!isset($_POST['from'])){
		echo "<script language=javascript>document.location.href='../lowongan_tambah_jobdesc.php?id=$id'</script>";
	}else {
		echo "<script language=javascript>document.location.href='../lowongan_detail.php?id=$id'</script>";
	}
	
	mysqli_close($connection);
?>