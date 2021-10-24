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
        <link href="../css/themify-icons.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Muli:300,400,600,800' rel='stylesheet' type='text/css'>
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
                                <li class="active">
                                    <a href="lowongan.php">
                                        Lowongan
                                    </a>
                                </li>
                                <li>
                                    <a href="lowongan_tambah.php">
                                        Tambah Lowongan
                                    </a>
                                </li>
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#search">Cari Lowongan</a>
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
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
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
                            <?php
                                if(isset($_GET['nama'])){
                                    $strQuery = "SELECT l.lowongan_id, p.perusahaan_id, p.perusahaan_nama, ko.kota_id, ko.kota_nama, k.kategori_id, k.kategori_nama,
                                    l.lowongan_judul, l.lowongan_deskripsi, l.lowongan_tgl_buka, l.lowongan_tgl_tutup
                                    FROM lowongan l INNER JOIN perusahaan p ON l.perusahaan_id = p.perusahaan_id
                                    INNER JOIN kategori k ON l.kategori_id = k.kategori_ID 
                                    INNER JOIN kota ko ON p.kota_id = ko.kota_id 
                                    WHERE lowongan_judul LIKE '%$_GET[nama]%' AND p.perusahaan_id = '$_SESSION[perusahaan_id]' ORDER BY lowongan_id DESC";
                                }else {
                                        $strQuery = "SELECT l.lowongan_id, p.perusahaan_id, p.perusahaan_nama, ko.kota_id, ko.kota_nama, k.kategori_id, k.kategori_nama,
                                        l.lowongan_judul, l.lowongan_deskripsi, l.lowongan_tgl_buka, l.lowongan_tgl_tutup
                                        FROM lowongan l INNER JOIN perusahaan p ON l.perusahaan_id = p.perusahaan_id
                                        INNER JOIN kategori k ON l.kategori_id = k.kategori_ID 
                                        INNER JOIN kota ko ON p.kota_id = ko.kota_id 
                                        WHERE p.perusahaan_id = '$_SESSION[perusahaan_id]' 
                                        ORDER BY lowongan_id DESC";
                                }
                                $query = mysqli_query($connection, $strQuery);
                                $i = 0;
                                while($result = mysqli_fetch_assoc($query)){
                            ?>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="card">
                                        <div class="content">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4 class="title">
                                                        <a href="lowongan_detail.php?id=<?php echo $result['lowongan_id'];?>"><?php echo $result['lowongan_judul']?></a>
                                                    </h4>
                                                </div>
                                                <div class="col-md-12">
                                                    <p class="category">
                                                        <?php echo $result['lowongan_tgl_buka'] ." s.d. ".$result['lowongan_tgl_tutup']?>
                                                    </p>
                                                    <p class="category">
                                                       <p class="category">           
                                                            <br/>
                                                            <i class="fa fa-map-marker icon-info"></i><?php echo $result['kota_nama']?> &nbsp;&nbsp;
                                                            <i class="fa fa-tags icon-info"></i><?php echo $result['kategori_nama']?> <br/>   
                                                        </p>
                                                    </p>
                                                </div>
                                                <div class="col-md-12" style="text-align: left;">
                                                    <p class="category">                                                        
                                                        <?php
                                                            echo "<a href=lowongan_edit.php?id=$result[lowongan_id]><i class=\"fa fa-pencil icon-success\"></i>Edit</a>&nbsp;&nbsp;&nbsp;";
                                                            echo "<a href=# data-toggle=modal data-target=#delete$i><i class=\"fa fa-trash icon-warning\"></i>Delete</a>";
                                                        ?>
                                                    </p>

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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    $i++;
                                }
                            ?>
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
            $('#delete<?php echo $j;?>').appendTo("body")
            <?php
            }
        ?>
            $('#search').appendTo("body")
        </script>
    </body>

    </html>