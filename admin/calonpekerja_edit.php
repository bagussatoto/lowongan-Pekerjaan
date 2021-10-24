<?php
	require "../php/connection.php";
    session_start();
    if(!isset($_SESSION['login_role'])){
		    echo "<script language=javascript>document.location.href='login.php'</script>";
	}

    if(isset($_SESSION['login_role'])){
        if($_SESSION['login_role'] != 'Admin')
		    echo "<script language=javascript>document.location.href='login.php'</script>";
	}

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $nama = "";
        $alamat = "";
        $kota_id = "";
        $jk = "";
        $tempat_lahir = "";
        $tanggal_lahir = "";
        $status_pernikahan = "";
        $email = "";
        $telepon = "";
        $pendidikan_terakhir = "";
        $tempat_pendidikan_terakhir = "";
        $tempat_bekerja_terakhir = "";
        $pekerjaan_bekerja_terakhir = "";
        $cv = "";
        $login_id = "";
        $username = "";
        $password = "";
        $strQuery = "SELECT cp.calon_pekerja_id, cp.calon_pekerja_nama_lengkap, 
                    cp.calon_pekerja_alamat, k.kota_id, k.kota_nama, cp.calon_pekerja_jenis_kelamin,
                    cp.calon_pekerja_tempat_lahir, cp.calon_pekerja_tanggal_lahir, cp.calon_pekerja_status_pernikahan,
                    cp.calon_pekerja_email, cp.calon_pekerja_telepon, cp.calon_pekerja_pendidikan_terakhir,
                    cp.calon_pekerja_tempat_pendidikan_terakhir, cp.calon_pekerja_tempat_bekerja_terakhir,
                    cp.calon_pekerja_pekerjaan_bekerja_terakhir, cp.calon_pekerja_file_cv, l.login_id, l.login_username, l.login_password
                    FROM calon_pekerja cp INNER JOIN kota k ON cp.kota_id = k.kota_id
                    INNER JOIN login l ON cp.calon_pekerja_id = l.login_id
                    WHERE cp.calon_pekerja_id = '$id'";
        $query = mysqli_query($connection, $strQuery);
        if($query){
            $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
            $id = $result['calon_pekerja_id'];
            $nama = $result['calon_pekerja_nama_lengkap'];
            $alamat = $result['calon_pekerja_alamat'];
            $kota_id = $result['kota_id'];
            $jk = $result['calon_pekerja_jenis_kelamin'];
            $tempat_lahir = $result['calon_pekerja_tempat_lahir'];
            $tanggal_lahir = $result['calon_pekerja_tanggal_lahir'];
            $status_pernikahan = $result['calon_pekerja_status_pernikahan'];
            $email = $result['calon_pekerja_email'];
            $telepon = $result['calon_pekerja_telepon'];
            $pendidikan_terakhir = $result['calon_pekerja_pendidikan_terakhir'];
            $tempat_pendidikan_terakhir = $result['calon_pekerja_tempat_pendidikan_terakhir'];
            $tempat_bekerja_terakhir = $result['calon_pekerja_tempat_bekerja_terakhir'];
            $pekerjaan_bekerja_terakhir = $result['calon_pekerja_pekerjaan_bekerja_terakhir'];
            $cv = $result['calon_pekerja_file_cv'];
            $login_id = $result['login_id'];
            $username = $result['login_username'];
            $password = $result['login_password'];
        }
    }
?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>Lowker</title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <link href="../css/bootstrap.min.css" rel="stylesheet" />
        <link href="../css/style.css" rel="stylesheet" />
        <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Muli:300,400' rel='stylesheet' type='text/css'>
    </head>

    <body>
        <div class="wrapper">
            <div class="sidebar" data-background-color="white" data-active-color="info">
                <div class="sidebar-wrapper">
                    <div class="logo">
                        <!--<img src="../img/logo.png" width="60px" />-->
                        <a href="#" class="simple-text">
                        Lowker Admin
                    </a>
                    </div>
                    <ul class="nav">
                        <li>
                            <a href="dashboard.php">
                                <i class="fa fa-dashboard" style="font-size: 18px;"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="active">
                            <a href="calonpekerja.php">
                                <i class="fa fa-user" style="font-size: 18px;"></i>
                                <p>Calon Pekerja</p>
                            </a>
                        </li>
                        <li>
                            <a href="perusahaan.php">
                                <i class="fa fa-industry" style="font-size: 18px;"></i>
                                <p>Perusahaan</p>
                            </a>
                        </li>
                        <li>
                            <a href="kategori.php">
                                <i class="fa fa-tags" style="font-size: 18px;"></i>
                                <p>Kategori</p>
                            </a>
                        </li>
                        <li>
                            <a href="lowongan.php">
                                <i class="fa fa-info" style="font-size: 18px;"></i>
                                <p>Lowongan</p>
                            </a>
                        </li>
                        <li>
                            <a href="lamaran.php">
                                <i class="fa fa-paperclip" style="font-size: 18px;"></i>
                                <p>Lamaran</p>
                            </a>
                        </li>
                        <li>
                            <a href="kota.php">
                                <i class="fa fa-bank" style="font-size: 18px;"></i>
                                <p>Kota</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-panel">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar bar1"></span>
                                <span class="icon-bar bar2"></span>
                                <span class="icon-bar bar3"></span>
                            </button>
                            <a class="navbar-brand" href="#">Calon Pekerja</a>
                        </div>
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a href="profil_edit.php">
                                        <p>
                                            <i class="fa fa-user-circle" style="font-size: 18px;"></i> Hallo,
                                            <?php echo $_SESSION['admin_nama'];?>
                                        </p>
                                    </a>
                                </li>
                                <li>
                                    <a href="../php/logout.php">
                                        <i class="fa fa-sign-out"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="content">
                    <form method="POST" action="php/calonpekerja_edit_proses.php" enctype="multipart/form-data" >
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="header">
                                            <h4 class="title">Login Info</h4>
                                        </div>
                                        <div class="content">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Username</label>
                                                        <input type="text" class="form-control border-input" name="username" placeholder="Username" value="<?php echo $username;?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-12" style="margin-bottom: 34px;">
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input type="password" class="form-control border-input" name="password" placeholder="Biarkan kosong jika anda tidak ingin mengganti passwornya" />
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="header">
                                            <h4 class="title">Data Calon Pekerja</h4>
                                        </div>
                                        <div class="content">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Nama Lengkap</label>
                                                        <input type="text" class="form-control border-input" name="nama" placeholder="Nama Lengkap"  value="<?php echo $nama;?>"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Alamat</label>
                                                        <input type="text" class="form-control border-input" name="alamat" placeholder="Alamat" value="<?php echo $alamat;?>"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Kota</label>
                                                        <select class="form-control border-input" name="kota_id">
                                                            <?php
                                                                $strQuery = "SELECT kota_id, kota_nama FROM kota";
                                                                $query = mysqli_query($connection, $strQuery);
                                                                while($subresult = mysqli_fetch_assoc($query)){
                                                                    if($subresult['kota_id'] == $kota_id)
                                                                        echo "<option value=$subresult[kota_id] selected>$subresult[kota_nama]</option>";
                                                                    else
                                                                        echo "<option value=$subresult[kota_id]>$subresult[kota_nama]</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Jenis Kelamin</label>
                                                        <select class="form-control border-input" name="jk">
                                                            <option value="L" <?php if($jk == 'L') echo "selected"?>>Laki-laki</option>
                                                            <option value="P" <?php if($jk == 'P') echo "selected"?>>Perempuan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Tempat Lahir</label>
                                                                <input type="text" class="form-control border-input" name="tempat_lahir" placeholder="Tempat Lahir" value="<?php echo $tempat_lahir;?>"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Tanggal Lahir</label>
                                                                <input type="date" class="form-control border-input" name="tanggal_lahir" placeholder="Tanggal Lahir" value="<?php echo $tanggal_lahir;?>"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Status</label>
                                                        <select class="form-control border-input" name="status_pernikahan">
                                                            <option value="Lajang" <?php if($jk == 'Lajang') echo "selected"?>>Lajang</option>
                                                            <option value="Menikah" <?php if($jk == 'Menikah') echo "selected"?>>Menikah</option>
                                                            <option value="Janda/Duda" <?php if($jk == 'Janda/Duda') echo "selected"?>>Janda/Duda</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="text" class="form-control border-input" name="email" placeholder="Email" value="<?php echo $email;?>"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Telepon</label>
                                                        <input type="text" class="form-control border-input" name="telepon" placeholder="Telepon" value="<?php echo $telepon;?>"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Pendidikan Terakhir</label>
                                                                <select class="form-control border-input" name="pendidikan_terakhir">
                                                                    <option value="SD" <?php if($jk == 'SD') echo "selected"?>>SD</option>
                                                                    <option value="SMP" <?php if($jk == 'SMP') echo "selected"?>>SMP Sederajat</option>
                                                                    <option value="SMA" <?php if($jk == 'SMA') echo "selected"?>>SMA Sederajat</option>
                                                                    <option value="Diploma" <?php if($jk == 'Diploma') echo "selected"?>>Diploma</option>
                                                                    <option value="S1" <?php if($jk == 'S1') echo "selected"?>>S1</option>
                                                                    <option value="S2" <?php if($jk == 'S2') echo "selected"?>>S2</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Tempat Pendidikan Terakhir</label>
                                                                <input type="text" class="form-control border-input" name="tempat_pendidikan_terakhir" placeholder="Tempat Pendidikan Terakhir" value="<?php echo $tempat_pendidikan_terakhir;?>"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Tempat Bekerja Terakhir</label>
                                                                <input type="text" class="form-control border-input" name="tempat_bekerja_terakhir" placeholder="Tempat Bekerja Terakhir" value="<?php echo $tempat_bekerja_terakhir;?>"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Posisi Pekerjaan Terakhir</label>
                                                                <input type="text" class="form-control border-input" name="pekerjaan_bekerja_terakhir" placeholder="Posisi Pekerjaan Terakhir" value="<?php echo $pekerjaan_bekerja_terakhir;?>"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12" style="margin-bottom: 34px;">
                                                    <div class="form-group">
                                                        <label>File CV (Anda sudah mempunyai CV <?php echo $cv;?>)</label>
                                                        <input type="file" class="form-control border-input" name="file_cv" />
                                                    </div>
                                                </div>
                                                
                                                <div class="text-center" style="margin-bottom: 34px;">
                                                    <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
                                                    <input type="hidden" name="id" value="<?php echo $id;?>" />
                                                    <input type="hidden" name="login_id" value="<?php echo $login_id;?>" />
                                                    <button type="submit" class="btn btn-info btn-fill btn-wd">Submit Data</button>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="copyright pull-right">
                            &copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script>, Hak Cipta Dari<a href="#">Suku Gumai 3 | Universitas Amikom Yogyakarta</a>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="../js/jquery.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../js/dashboard.js" type="text/javascript"></script>
        <!--  Modal  -->
        <script>
            <?php
            for($j= 0 ; $j <= $i; $j++){
        ?>
            $('#delete<?php echo $j;?>').appendTo("body")
            <?php
            }
        ?>
            $('#search').appendTo("body")
        </script>
    </body>

    </html>