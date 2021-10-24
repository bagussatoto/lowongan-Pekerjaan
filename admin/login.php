<?php
	session_start();
	if(isset($_SESSION['login_role'])){
        if($_SESSION['login_role'] === "admin")
		    echo "<script language=javascript>document.location.href='dashboard.php'</script>";
        else if($_SESSION['login_role'] === "agen")
		    echo "<script language=javascript>document.location.href='../index.php'</script>";
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/login.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="login-text">
            <h3>Halaman Admin</h3>
            <p>
                <font size="2">Silahkan masuk ke dalam akun admin anda</font>
            </p>
        </div>
        <form class="form-signin" method="POST" action="php/login.php">
            <!--<img src="img/logo.png" width="90px" style="margin-bottom: 20px;"/>-->
            <input class="form-control" type="text" name="username" placeholder="Username" required/>
            <input class="form-control" type="password" name="password" placeholder="Password" required/>
            <input class="btn btn-primary" type="submit" value="Login" style="padding: 14px 20px; margin-top: 20px;"
                required/>
        </form>
    </div>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>