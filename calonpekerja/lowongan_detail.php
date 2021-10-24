<?php
	require "../php/connection.php";
    session_start();
    if(!isset($_SESSION['login_role'])){
		    echo "<script language=javascript>document.location.href='login.php'</script>";
	}

    if(isset($_SESSION['login_role'])){
        if($_SESSION['login_role'] != 'Perusahaan')
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
            <div class="main-panel" style="float: none; width: 100%;">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar bar1"></span>
                                <span class="icon-bar bar2"></span>
                                <span class="icon-bar bar3"></span>
                            </button>
                            <a class="navbar-brand" href="#" style="font-weight: 800;">LOWKER</a>
                        </div>
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-left" style="margin-left: 56px;">
                                <li>
                                    <a href="lowongan.php">
                                        Lowongan
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a href="lowongan_tambah.php">
                                        <i class="fa fa-plus"></i>Tambah Lowongan
                                    </a>
                                </li>
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#search"><i class="fa fa-search"></i>Cari Lowongan</a>
                                    <!-- Modal Search -->
                                    <div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <form method="GET" action="lowongan.php">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Masukkan Judul Lowongan</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Judul Lowongan</label>
                                                            <input type="text" class="form-control border-input" name="nama" placeholder="Judul Lowongan" />
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
                                </li>
                                <li>
                                    <a href="profil_edit.php">
                                        <p>
                                            <i class="fa fa-user-circle" style="font-size: 18px;"></i> Hallo,
                                            <?php echo $_SESSION['perusahaan_nama'];?>
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
                                                                        <input type="submit" value="Yes" class="btn btn-primary btn-fill"/>
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
                                                    $k = 0;
                                                    while($result = mysqli_fetch_assoc($query)){
                                                        echo "<tr>";
                                                        echo "<td>$result[lowongan_syarat]</td>";
                                                        echo "&nbsp;&nbsp;&nbsp;";
                                                        echo "<td><a href=# data-toggle=modal data-target=#editsyarat$k>Edit</a>";
                                                        echo "&nbsp;&nbsp;&nbsp;";
                                                        echo "<a href=# data-toggle=modal data-target=#deletesyarat$k>Delete</a></td>";
                                                        echo "</tr>";
                                                ?>
                                                    <!--Modal Edit -->
                                                    <div class="modal fade " id="editsyarat<?php echo $k;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                                                        <input type="submit" value="Submit" class="btn btn-primary btn-fill"/>
                                                                        <button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- End Modal -->
                                                     <!--Modal Delete -->
                                                    <div class="modal fade " id="deletesyarat<?php echo $k;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                                                        <input type="submit" value="Yes" class="btn btn-primary btn-fill"/>
                                                                        <button type="button" class="btn btn-default btn-fill" data-dismiss="modal">No</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- End Modal -->
                                                    <?php
                                                        $k++;
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
                                                    $l = 0;
                                                    while($result = mysqli_fetch_assoc($query)){
                                                        echo "<tr>";
                                                        echo "<td>$result[lowongan_jobdesc_isi]</td>";
                                                        echo "&nbsp;&nbsp;&nbsp;";
                                                        echo "<td><a href=# data-toggle=modal data-target=#editjobdesc$l>Edit</a>";
                                                        echo "&nbsp;&nbsp;&nbsp;";
                                                        echo "<a href=# data-toggle=modal data-target=#deletejobdesc$l>Delete</a></td>";
                                                        echo "</tr>";
                                                ?>

                                                    <!--Modal Edit -->
                                                    <div class="modal fade " id="editjobdesc<?php echo $l;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                                                        <input type="submit" value="Submit" class="btn btn-primary btn-fill"/>
                                                                        <button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- End Modal -->
                                                     <!--Modal Delete -->
                                                    <div class="modal fade " id="deletejobdesc<?php echo $l;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                                                        <input type="submit" value="Yes" class="btn btn-primary btn-fill"/>
                                                                        <button type="button" class="btn btn-default btn-fill" data-dismiss="modal">No</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- End Modal -->
                                                    <?php
                                                        $l++;
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
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $strQuery = "SELECT la.lamaran_id, la.lowongan_id, cp.calon_pekerja_nama_lengkap, la.lamaran_status_lolos, cp.calon_pekerja_id, cp.calon_pekerja_alamat, k.kota_nama, cp.calon_pekerja_jenis_kelamin,
                                                        cp.calon_pekerja_tempat_lahir, cp.calon_pekerja_tanggal_lahir, cp.calon_pekerja_status_pernikahan,
                                                        cp.calon_pekerja_email, cp.calon_pekerja_telepon, cp.calon_pekerja_pendidikan_terakhir,
                                                        cp.calon_pekerja_tempat_pendidikan_terakhir, cp.calon_pekerja_tempat_bekerja_terakhir,
                                                        cp.calon_pekerja_pekerjaan_bekerja_terakhir, cp.calon_pekerja_file_cv
                                                        FROM lamaran la INNER JOIN calon_pekerja cp ON la.calon_pekerja_id = cp.calon_pekerja_id INNER JOIN kota k ON cp.kota_id = k.kota_id
                                                        WHERE lowongan_id = $id
                                                        ORDER BY lamaran_id DESC";
                                                    $query = mysqli_query($connection, $strQuery);
                                                    $m = 0;
                                                    while($result = mysqli_fetch_assoc($query)){
                                                        echo "<tr>";
                                                        echo "<td>$result[calon_pekerja_nama_lengkap]</td>";
                                                        echo "<td>$result[calon_pekerja_pendidikan_terakhir],di $result[calon_pekerja_tempat_pendidikan_terakhir]</td>";
                                                        echo "<td>$result[lamaran_status_lolos]</td>";
                                                        echo "<td><a href=# data-toggle=modal data-target=#detail$m>Detail</a>";
                                                        echo "&nbsp;&nbsp;&nbsp;";
                                                        echo "<a href=# data-toggle=modal data-target=#editstatus$m>Edit</a></td>";
                                                        echo "</tr>";
                                                ?>
                                                    <!-- Modal Detail-->
                                                    <div class="modal fade" id="detail<?php echo $m;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                                    <!--Modal Edit -->
                                                    <div class="modal fade" id="editstatus<?php echo $m;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog" role="document">
                                                            <form method="POST" action="php/lowongan_status_edit_proses.php">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        <h4 class="modal-title" id="myModalLabel">Status</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label>Status Lowongan</label>
                                                                            
                                                                            <select class="form-control border-input" name="status">
                                                                                <option value="Menunggu" <?php if($result['lamaran_status_lolos'] == 'Menunggu') echo "selected"?>>Menunggu</option>
                                                                                <option value="Lolos" <?php if($result['lamaran_status_lolos'] == 'Lolos') echo "selected"?>>Lolos</option>
                                                                                <option value="Tidak Lolos" <?php if($result['lamaran_status_lolos'] == 'Tidak Lolos') echo "selected"?>>Tidak Lolos</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <input type="hidden" name="id" value="<?php echo " $result[lamaran_id] ";?>" />
                                                                        <input type="hidden" name="lowongan_id" value="<?php echo " $result[lowongan_id] ";?>" />
                                                                        <input type="submit" value="Submit" class="btn btn-primary btn-fill"/>
                                                                        <button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Cancel</button>
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
                            </script>, Hak Cipta Dari <a href="#">Suku Gumai 3 | Universitas Amikom Yogyakarta</a>
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
            for($j= 0 ; $j <= $k; $j++){
        ?>
            $('#editsyarat<?php echo $j;?>').appendTo("body");
            $('#deletesyarat<?php echo $j;?>').appendTo("body");
            <?php
            }
        ?>
        <?php
            for($j= 0 ; $j <= $l; $j++){
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
            $('#editstatus<?php echo $j;?>').appendTo("body");
            <?php
            }
        ?>
            $('#search').appendTo("body")
        </script>
    </body>

    </html>