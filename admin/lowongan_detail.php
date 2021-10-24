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

    if(isset($_GET['id']))
        $id = $_GET['id'];
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
                        <li>
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
                        <li class="active">
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
                            <a class="navbar-brand" href="#">Lowongan</a>
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
                                        <a href="php/report_semua_pelamar.php?id=<?php echo $_GET['id'];?>" target="_blank" class="btn btn-info pull-right" style="margin-right: 8px;"><i class="fa fa-print"></i>Print Data Pelamar</a>
                                        <h4 class="title">Detail Lowongan</h4>
                                        <p class="category">Detail lowongan dari lowongan yang dipilih</p>
                                    </div>
                                    <div class="content table-responsive table-full-width">
                                        <table class="table table-striped">
                                            <thead>
                                                <th>ID</th>
                                                <th>Perusahaan</th>
                                                <th>Judul</th>
                                                <th>Kategori</th>
                                                <th>Tanggal Buka</th>
                                                <th>Tanggal Tutup</th>
                                                <th>Actions</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $strQuery = "SELECT l.lowongan_id, p.perusahaan_id, p.perusahaan_nama, k.kategori_id, k.kategori_nama,
                                                        l.lowongan_judul, l.lowongan_deskripsi, l.lowongan_tgl_buka, l.lowongan_tgl_tutup
                                                        FROM lowongan l INNER JOIN perusahaan p ON l.perusahaan_id = p.perusahaan_id
                                                        INNER JOIN kategori k ON l.kategori_id = k.kategori_ID 
                                                        WHERE lowongan_id = $id
                                                        ORDER BY lowongan_id DESC";
                                                    
                                                    $query = mysqli_query($connection, $strQuery);
                                                    $i = 0;
                                                    while($result = mysqli_fetch_assoc($query)){
                                                        echo "<tr>";
                                                        echo "<td>$result[lowongan_id]</td>";
                                                        echo "<td>$result[perusahaan_nama]</td>";
                                                        echo "<td>$result[lowongan_judul]</td>";
                                                        echo "<td>$result[kategori_nama]</td>";
                                                        echo "<td>$result[lowongan_tgl_buka]</td>";
                                                        echo "<td>$result[lowongan_tgl_tutup]</td>";
                                                        echo "&nbsp;&nbsp;&nbsp;";
                                                        echo "<td><a href='lowongan_edit.php?id=$result[lowongan_id]'>Edit</a>";
                                                        echo "&nbsp;&nbsp;&nbsp;";
                                                        echo "<a href=# data-toggle=modal data-target=#delete$i>Delete</a></td>";
                                                        echo "</tr>";
                                                ?>
                                                    <!-- Modal Delete -->
                                                    <div class="modal fade " id="delete<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog modal-sm" role="document">
                                                            <form method="POST" action="php/lowongan_delete_proses.php">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        <h4 class="modal-title" id="myModalLabel">Apakah Anda Yakin ?</h4>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <input type="hidden" name="id" value="<?php echo " $result[lowongan_id] ";?>" />
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
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">Deskripsi Lowongan</h4>
                                    </div>
                                    <div class="content table-responsive table-full-width">
                                        <table class="table">
                                            <tbody>
                                                <?php
                                                    $strQuery = "SELECT l.lowongan_id, p.perusahaan_id, p.perusahaan_nama, k.kategori_id, k.kategori_nama,
                                                        l.lowongan_judul, l.lowongan_deskripsi, l.lowongan_tgl_buka, l.lowongan_tgl_tutup
                                                        FROM lowongan l INNER JOIN perusahaan p ON l.perusahaan_id = p.perusahaan_id
                                                        INNER JOIN kategori k ON l.kategori_id = k.kategori_ID 
                                                        WHERE lowongan_id = $id
                                                        ORDER BY lowongan_id DESC";
                                                    
                                                    $query = mysqli_query($connection, $strQuery);
                                                    $i = 0;
                                                    while($result = mysqli_fetch_assoc($query)){
                                                        echo "<tr>";
                                                        echo "<td>$result[lowongan_deskripsi]</td>";echo "</tr>";
                                                        $i++;
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="header">
                                        <a href="lowongan_tambah_syarat.php?from=detail&id=<?php echo $id;?>" class="btn btn-info pull-right"><i class="fa fa-plus"></i></a>
                                        <h4 class="title">Syarat Lowongan</h4>
                                        <p class="category">Syarat lowongan dari lowongan yang dipilih</p>
                                    </div>
                                    <div class="content table-responsive table-full-width">
                                        <table class="table table-striped">
                                            <thead>
                                                <th>Syarat</th>
                                                <th>Actions</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $strQuery = "SELECT lowongan_syarat_id, lowongan_id, lowongan_syarat FROM lowongan_syarat WHERE lowongan_id = '$id'";
                                                    
                                                    $query = mysqli_query($connection, $strQuery);
                                                    $q = 0;
                                                    while($result = mysqli_fetch_assoc($query)){
                                                        echo "<tr>";
                                                        echo "<td>$result[lowongan_syarat]</td>";
                                                        echo "&nbsp;&nbsp;&nbsp;";
                                                        echo "<td><a href=# data-toggle=modal data-target=#editsyarat$i>Edit</a>";
                                                        echo "&nbsp;&nbsp;&nbsp;";
                                                        echo "<a href=# data-toggle=modal data-target=#deletesyarat$i>Delete</a></td>";
                                                        echo "</tr>";
                                                ?>
                                                    <!--Modal Edit -->
                                                    <div class="modal fade " id="editsyarat<?php echo $q;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog" role="document">
                                                            <form method="POST" action="php/lowongan_syarat_edit_proses.php">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        <h4 class="modal-title" id="myModalLabel">Syarat Lowongan</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label>Syarat Lowongan</label>
                                                                            <input type="text" class="form-control border-input" name="syarat" placeholder="Syarat Lowongan" value="<?php echo $result['lowongan_syarat'];?>"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <input type="hidden" name="id" value="<?php echo " $result[lowongan_syarat_id] ";?>" />
                                                                        <input type="hidden" name="lowongan_id" value="<?php echo " $result[lowongan_id] ";?>" />
                                                                        <input type="submit" value="Submit" class="btn btn-info btn-fill"/>
                                                                        <button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- End Modal -->
                                                     <!--Modal Delete -->
                                                    <div class="modal fade " id="deletesyarat<?php echo $q;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog modal-sm" role="document">
                                                            <form method="POST" action="php/lowongan_syarat_delete_proses.php">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        <h4 class="modal-title" id="myModalLabel">Apakah Anda Yakin ?</h4>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <input type="hidden" name="id" value="<?php echo " $result[lowongan_syarat_id] ";?>" />
                                                                        <input type="hidden" name="lowongan_id" value="<?php echo " $result[lowongan_id] ";?>" />
                                                                        <input type="submit" value="Yes" class="btn btn-info btn-fill"/>
                                                                        <button type="button" class="btn btn-default btn-fill" data-dismiss="modal">No</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- End Modal -->
                                                    <?php
                                                        $q++;
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="header">
                                        <a href="lowongan_tambah_jobdesc.php?id=<?php echo $id;?>" class="btn btn-info pull-right"><i class="fa fa-plus"></i></a>
                                        <h4 class="title">Job Desc Lowongan</h4>
                                        <p class="category">Job Desc lowongan dari lowongan yang dipilih</p>
                                    </div>
                                    <div class="content table-responsive table-full-width">
                                        <table class="table table-striped">
                                            <thead>
                                                <th>Job Desc</th>
                                                <th>Actions</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $strQuery = "SELECT lowongan_jobdesc_id, lowongan_id, lowongan_jobdesc_isi FROM lowongan_jobdesc WHERE lowongan_id = '$id'";
                                                    
                                                    $query = mysqli_query($connection, $strQuery);
                                                    $w = 0;
                                                    while($result = mysqli_fetch_assoc($query)){
                                                        echo "<tr>";
                                                        echo "<td>$result[lowongan_jobdesc_isi]</td>";
                                                        echo "&nbsp;&nbsp;&nbsp;";
                                                        echo "<td><a href=# data-toggle=modal data-target=#editjobdesc$i>Edit</a>";
                                                        echo "&nbsp;&nbsp;&nbsp;";
                                                        echo "<a href=# data-toggle=modal data-target=#deletejobdesc$i>Delete</a></td>";
                                                        echo "</tr>";
                                                ?>

                                                    <!--Modal Edit -->
                                                    <div class="modal fade " id="editjobdesc<?php echo $w;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog" role="document">
                                                            <form method="POST" action="php/lowongan_jobdesc_edit_proses.php">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        <h4 class="modal-title" id="myModalLabel">Syarat Lowongan</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label>Job Desc Lowongan</label>
                                                                            <input type="text" class="form-control border-input" name="jobdesc" placeholder="Job Desc Lowongan" value="<?php echo $result['lowongan_jobdesc_isi'];?>"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <input type="hidden" name="id" value="<?php echo " $result[lowongan_jobdesc_id] ";?>" />
                                                                        <input type="hidden" name="lowongan_id" value="<?php echo " $result[lowongan_id] ";?>" />
                                                                        <input type="submit" value="Submit" class="btn btn-info btn-fill"/>
                                                                        <button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- End Modal -->
                                                     <!--Modal Delete -->
                                                    <div class="modal fade " id="deletejobdesc<?php echo $w;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog modal-sm" role="document">
                                                            <form method="POST" action="php/lowongan_jobdesc_delete_proses.php">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        <h4 class="modal-title" id="myModalLabel">Apakah Anda Yakin ?</h4>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <input type="hidden" name="id" value="<?php echo " $result[lowongan_jobdesc_id] ";?>" />
                                                                        <input type="hidden" name="lowongan_id" value="<?php echo " $result[lowongan_id] ";?>" />
                                                                        <input type="submit" value="Yes" class="btn btn-info btn-fill"/>
                                                                        <button type="button" class="btn btn-default btn-fill" data-dismiss="modal">No</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- End Modal -->
                                                    <?php
                                                        $w++;
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">Pelamar</h4>
                                    </div>
                                    <div class="content table-responsive table-full-width">
                                        <table class="table">
                                            <thead>
                                                <th>Calon Pekerja</th>
                                                <th>Pendidikan Terakhir</th>
                                                <th>Tempat Bekerja Terakhir</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $strQuery = "SELECT la.lamaran_id, la.lowongan_id, cp.calon_pekerja_nama_lengkap, la.lamaran_status_lolos, cp.calon_pekerja_id, cp.calon_pekerja_alamat, cp.calon_pekerja_jenis_kelamin, k.kota_nama, l.lowongan_judul,
                                                        cp.calon_pekerja_tempat_lahir, cp.calon_pekerja_tanggal_lahir, cp.calon_pekerja_status_pernikahan,
                                                        cp.calon_pekerja_email, cp.calon_pekerja_telepon, cp.calon_pekerja_pendidikan_terakhir,
                                                        cp.calon_pekerja_tempat_pendidikan_terakhir, cp.calon_pekerja_tempat_bekerja_terakhir, kp.kota_nama as kota_perusahaan,
                                                        cp.calon_pekerja_pekerjaan_bekerja_terakhir, cp.calon_pekerja_file_cv, p.perusahaan_nama 
                                                        FROM lamaran la INNER JOIN calon_pekerja cp ON la.calon_pekerja_id = cp.calon_pekerja_id 
                                                        INNER JOIN kota k ON cp.kota_id = k.kota_id
                                                        INNER JOIN lowongan l ON la.lowongan_id = l.lowongan_id
                                                        INNER JOIN perusahaan p ON l.perusahaan_id = p.perusahaan_id
                                                        INNER JOIN kota kp ON p.kota_id = kp.kota_id
                                                        WHERE l.lowongan_id = $id
                                                        ORDER BY lamaran_id DESC";
                                                    $query = mysqli_query($connection, $strQuery);
                                                    $m = 0;
                                                    while($result = mysqli_fetch_assoc($query)){
                                                        echo "<tr>";
                                                        echo "<td>$result[calon_pekerja_nama_lengkap]</td>";
                                                        echo "<td>$result[calon_pekerja_pendidikan_terakhir],di $result[calon_pekerja_tempat_pendidikan_terakhir]</td>";
                                                        if(empty($result['calon_pekerja_tempat_bekerja_terakhir'])) $result['calon_pekerja_tempat_bekerja_terakhir'] = "-";
                                                        if(empty($result['calon_pekerja_pekerjaan_bekerja_terakhir'])) $result['calon_pekerja_pekerjaan_bekerja_terakhir'] = "-";
                                                        echo "<td>$result[calon_pekerja_tempat_bekerja_terakhir], sebagai $result[calon_pekerja_pekerjaan_bekerja_terakhir]</td>";
                                                                    
                                                        echo "<td>$result[lamaran_status_lolos]</td>";
                                                        echo "<td><a href=# data-toggle=modal data-target=#detail$m>Detail</a>";
                                                        echo "&nbsp;&nbsp;&nbsp;";
                                                        echo "</tr>";
                                                ?>
                                                    <!-- Modal Detail-->
                                                    <div class="modal fade" id="detail<?php echo $m;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog" role="document">
                                                        <form method="POST" action="php/report.php">
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
                                                                    <input type="hidden" name="judul_lowongan" value="<?php echo " $result[lowongan_judul] ";?>" />
                                                                    <input type="hidden" name="alamat" value="<?php echo " $result[calon_pekerja_alamat] ";?>" />
                                                                    <input type="hidden" name="telepon" value="<?php echo " $result[calon_pekerja_telepon] ";?>" />
                                                                    <input type="hidden" name="email" value="<?php echo " $result[calon_pekerja_email] ";?>" />
                                                                    <input type="hidden" name="nama_pegawai" value="<?php echo " $result[calon_pekerja_nama_lengkap] ";?>" />
                                                                    <input type="hidden" name="tgl_lahir" value="<?php echo " $result[calon_pekerja_tanggal_lahir] ";?>" />
                                                                    <input type="hidden" name="tmpt_lahir" value="<?php echo " $result[calon_pekerja_tempat_lahir] ";?>" />
                                                                    <input type="hidden" name="tmpt_pendidikan_terakhir" value="<?php echo " $result[calon_pekerja_tempat_pendidikan_terakhir] ";?>" />
                                                                    <input type="hidden" name="pendidikan_terakhir" value="<?php echo " $result[calon_pekerja_pendidikan_terakhir] ";?>" />
                                                                    <input type="hidden" name="tmpt_bekerja" value="<?php echo " $result[calon_pekerja_tempat_bekerja_terakhir] ";?>" />
                                                                    <input type="hidden" name="pekerjaan_terakhir" value="<?php echo " $result[calon_pekerja_pekerjaan_bekerja_terakhir] ";?>" />
                                                                    <input type="hidden" name="jk" value="<?php echo " $result[calon_pekerja_jenis_kelamin] ";?>" />
                                                                    <input type="hidden" name="nama_perusahaan" value="<?php echo " $result[perusahaan_nama] ";?>" />
                                                                    <input type="hidden" name="kota_perusahaan" value="<?php echo " $result[kota_perusahaan] ";?>" />
                                                                    <input type="hidden" name="cv" value="<?php echo " $result[calon_pekerja_file_cv] ";?>" />
                                                                    <input type="hidden" name="kota" value="<?php echo " $result[kota_nama] ";?>" />
                                                                    <input type="submit" value="PDF" class="btn btn-info btn-fill"/>
                                                                    <button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- End Modal -->
                                                <?php
                                                        $m++;
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
                            </script>, Hak Cita Dari  <a href="#"> Suku Gumai 3 | Universitas Amikom Yogyakarta </a>
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
            $('#delete<?php echo $j;?>').appendTo("body");
            <?php
            }
        ?>
        <?php
            for($j= 0 ; $j <= $q; $j++){
        ?>
            $('#editsyarat<?php echo $j;?>').appendTo("body");
            $('#deletesyarat<?php echo $j;?>').appendTo("body");
            <?php
            }
        ?>
        <?php
            for($j= 0 ; $j <= $w; $j++){
        ?>
            $('#editjobdesc<?php echo $j;?>').appendTo("body");
            $('#deletejobdesc<?php echo $j;?>').appendTo("body");
            <?php
            }
        ?>
        <?php
            for($j= 0 ; $j <= $m; $j++){
        ?>
            $('#detail<?php echo $j;?>').appendTo("body");
            <?php
            }
        ?>
            $('#search').appendTo("body")
        </script>
    </body>

    </html>