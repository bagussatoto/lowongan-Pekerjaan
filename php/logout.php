<?php
	session_start();
	session_destroy();
	echo"<script language=javascript>document.location.href='../index.php'</script>";
?>