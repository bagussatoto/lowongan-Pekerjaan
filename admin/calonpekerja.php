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
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="header">
                                        <a href="calonpekerja_tambah.php" class="btn btn-info pull-right"><i class="fa fa-plus"></i></a>
                                        <a href="#" data-toggle="modal" data-target="#search" class="btn btn-info pull-right" style="margin-right: 8px;"><i class="fa fa-search"></i></a>
                                        <!-- Modal Search -->
                                        <div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <form method="GET" action="calonpekerja.php">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">Masukkan Nama Calon Pekerja</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>Nama Calon Pekerja</label>
                                                                <input type="text" class="form-control border-input" name="nama" placeholder="Nama Calon Pekerja" />
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-info btn-fill">Search</button>
                                                            <button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                        <?php
                                            if(isset($_GET['nama'])){
                                        ?>
                                            <a href="calonpekerja.php" class="btn btn-info pull-right" style="margin-right: 8px;"><i class="fa fa-arrow-left"></i></a>
                                            <?php
                                            }
                                        ?>
                                                <h4 class="title">Data Calon Pekerja</h4>
                                                <p class="category">List dari semua calon pekerja yang terdaftar</p>
                                    </div>
                                    <div class="content table-responsive table-full-width">
                                        <table class="table table-striped">
                                            <thead>
                                                <th>ID</th>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>Kota</th>
                                                <th>List Lamaran</th>
                                                <th>Actions</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    if(isset($_GET['nama'])){
                                                        $strQuery = "SELECT cp.calon_pekerja_id, cp.calon_pekerja_nama_lengkap, 
                                                        cp.calon_pekerja_alamat, k.kota_nama, cp.calon_pekerja_jenis_kelamin,
                                                        cp.calon_pekerja_tempat_lahir, cp.calon_pekerja_tanggal_lahir, cp.calon_pekerja_status_pernikahan,
                                                        cp.calon_pekerja_email, cp.calon_pekerja_telepon, cp.calon_pekerja_pendidikan_terakhir,
                                                        cp.calon_pekerja_tempat_pendidikan_terakhir, cp.calon_pekerja_tempat_bekerja_terakhir,
                                                        cp.calon_pekerja_pekerjaan_bekerja_terakhir, cp.calon_pekerja_file_cv
                                                        FROM calon_pekerja cp INNER JOIN kota k ON cp.kota_id = k.kota_id 
                                                        WHERE calon_pekerja_nama_lengkap LIKE '%$_GET[nama]%' ORDER BY calon_pekerja_id DESC";
                                                    }else {
                                                        $strQuery = "SELECT cp.calon_pekerja_id, cp.calon_pekerja_nama_lengkap, 
                                                        cp.calon_pekerja_alamat, k.kota_nama, cp.calon_pekerja_jenis_kelamin,
                                                        cp.calon_pekerja_tempat_lahir, cp.calon_pekerja_tanggal_lahir, cp.calon_pekerja_status_pernikahan,
                                                        cp.calon_pekerja_email, cp.calon_pekerja_telepon, cp.calon_pekerja_pendidikan_terakhir,
                                                        cp.calon_pekerja_tempat_pendidikan_terakhir, cp.calon_pekerja_tempat_bekerja_terakhir,
                                                        cp.calon_pekerja_pekerjaan_bekerja_terakhir, cp.calon_pekerja_file_cv
                                                        FROM calon_pekerja cp INNER JOIN kota k ON cp.kota_id = k.kota_id 
                                                        ORDER BY calon_pekerja_id DESC";
                                                    }
                                                    $query = mysqli_query($connection, $strQuery);
                                                    $i = 0;
                                                    while($result = mysqli_fetch_assoc($query)){
                                                        echo "<tr>";
                                                        echo "<td>$result[calon_pekerja_id]</td>";
                                                        echo "<td>$result[calon_pekerja_nama_lengkap]</td>";
                                                        echo "<td>$result[calon_pekerja_alamat]</td>";
                                                        echo "<td>$result[kota_nama]</td>";
                                                        echo "<td><a href=lamaran.php?calonpekerja=$result[calon_pekerja_id]>List Lamaran</a></td>";
                                                        echo "<td><a href=# data-toggle=modal data-target=#detail$i>Detail</a>";
                                                        echo "&nbsp;&nbsp;&nbsp;";
                                                        echo "<a href='calonpekerja_edit.php?id=$result[calon_pekerja_id]'>Edit</a>";
                                                        echo "&nbsp;&nbsp;&nbsp;";
                                                        echo "<a href=# data-toggle=modal data-target=#delete$i>Delete</a></td>";
                                                        echo "</tr>";
                                                ?>
                                                    <!-- Modal Detail-->
                                                    <div class="modal fade" id="detail<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title" id="myModalLabel">Detail Calon Pekerja</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <b>ID</b><br/>
                                                                    <?php
                                                                        echo "$result[calon_pekerja_id]";
                                                                    ?>
                                                                    <br/><br/>

                                                                    <b>Nama Lengkap</b><br/>
                                                                    <?php
                                                                        echo "$result[calon_pekerja_nama_lengkap]";
                                                                    ?>
                                                                    <br/><br/>

                                                                    <b>Alamat</b><br/>
                                                                    <?php
                                                                        echo "$result[calon_pekerja_alamat]";
                                                                    ?>
                                                                    <br/><br/>

                                                                    <b>Kota</b><br/>
                                                                    <?php
                                                                        echo "$result[kota_nama]";
                                                                    ?>
                                                                    <br/><br/>
                                                                    
                                                                    <b>Jenis Kelamin</b><br/>
                                                                    <?php
                                                                        echo "$result[calon_pekerja_jenis_kelamin]";
                                                                    ?>
                                                                    <br/><br/>

                                                                    <b>Tempat, Tanggal Lahir</b><br/>
                                                                    <?php
                                                                        echo "$result[calon_pekerja_tempat_lahir], $result[calon_pekerja_tanggal_lahir]";
                                                                    ?>
                                                                    <br/><br/>

                                                                    <b>Status Pernikahan</b><br/>
                                                                    <?php
                                                                        echo "$result[calon_pekerja_status_pernikahan]";
                                                                    ?>
                                                                    <br/><br/>

                                                                    <b>Email</b><br/>
                                                                    <?php
                                                                        echo "<a href=mailto:$result[calon_pekerja_email]>$result[calon_pekerja_email]</a>";
                                                                    ?>
                                                                    <br/><br/>

                                                                    <b>Telepon</b><br/>
                                                                    <?php
                                                                        echo "$result[calon_pekerja_telepon]";
                                                                    ?>
                                                                    <br/><br/>

                                                                    <b>Pendidikan Terakhir</b><br/>
                                                                    <?php
                                                                        echo "$result[calon_pekerja_pendidikan_terakhir], di $result[calon_pekerja_tempat_pendidikan_terakhir]";
                                                                    ?>
                                                                    <br/><br/>

                                                                    <b>Tempat Bekerja Terakhir</b><br/>
                                                                    <?php
                                                                        if(empty($result['calon_pekerja_tempat_bekerja_terakhir'])) $result['calon_pekerja_tempat_bekerja_terakhir'] = "-";
                                                                        if(empty($result['calon_pekerja_pekerjaan_bekerja_terakhir'])) $result['calon_pekerja_pekerjaan_bekerja_terakhir'] = "-";
                                                                        echo "$result[calon_pekerja_tempat_bekerja_terakhir], sebagai $result[calon_pekerja_pekerjaan_bekerja_terakhir]";
                                                                    ?>
                                                                    <br/><br/>

                                                                    <b>File CV</b><br/>
                                                                    <?php
                                                                        echo "<a href=../upload/cv/$result[calon_pekerja_file_cv] target=_blank>$result[calon_pekerja_file_cv]</a>";
                                                                    ?>
                                                                    <br/><br/>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Modal -->
                                                    <!-- Modal Delete -->
                                                    <div class="modal fade " id="delete<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog modal-sm" role="document">
                                                            <form method="POST" action="php/calonpekerja_delete_proses.php">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        <h4 class="modal-title" id="myModalLabel">Apakah Anda Yakin ?</h4>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <input type="hidden" name="id" value="<?php echo " $result[calon_pekerja_id] ";?>" />
                                                                        <input type="hidden" name="login_id" value="<?php echo " $result[calon_pekerja_id] ";?>" />
                                                                        <input type="submit" value="Yes" class="btn btn-info btn-fill"/>
                                                                        <button type="button" class="btn btn-default btn-fill" data-dismiss="modal">No</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- End Modal -->
                                                    <?php
                                                        $i++;
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="copyright pull-right">
                            &copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script>, Hak Cipta Dari <a href="#"> Suku Gumai 3 | Universitas Amikom Yogyakarta</a>
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
            $('#detail<?php echo $j;?>').appendTo("body")
            $('#delete<?php echo $j;?>').appendTo("body")
            <?php
            }
        ?>
            $('#search').appendTo("body")
        </script>
    </body>

    </html>