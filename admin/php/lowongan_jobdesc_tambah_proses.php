<?php
	require "../../php/connection.php";
	$id = $_POST['id'];
	$jobdesc = $_POST['array_jobdesc'];
	$jobdesc = explode("---",$jobdesc);
	$keys = array_keys($jobdesc);
	$last = end($keys);
	unset($jobdesc[$last]);

	foreach ($jobdesc as $j) {
		$strQuery = "INSERT INTO lowongan_jobdesc VALUES(null, '$id','$j')";
		$query = mysqli_query($connection, $strQuery);
	}
	
	echo "<script language=javascript>document.location.href='../lowongan_detail.php?id=$id'</script>";
	mysqli_close($connection);
?>