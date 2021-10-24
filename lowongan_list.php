<?php
	require "php/connection.php";
?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>Lowker</title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet" />
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
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
                            <a class="navbar-brand" href="index.php" style="font-weight: 800;">LOWKER</a>
                        </div>
                        <div class="collapse navbar-collapse">

                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right navbar-uppercase">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true"
                                aria-expanded="false" style="margin-right: 12px; color: #FFFFFF; background-color: #D24D57; border-radius: 10px;">
                                Perusahaan
                            </a>
                            <ul class="dropdown-menu dropdown-info" aria-labelledby="dLabel">
                                <li>
                                    <a href="perusahaan/login.php">Sign In</a>
                                </li>
                                <li>
                                    <a href="perusahaan/signup.php">Sign Up</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true"
                                aria-expanded="false" style="color: #FFFFFF; background-color: #00B16A; border-radius: 10px;">
                                Calon Pekerja
                            </a>
                            <ul class="dropdown-menu dropdown-info" aria-labelledby="dLabel">
                                <li>
                                    <a href="calonpekerja/login.php">Sign In</a>
                                </li>
                                <li>
                                    <a href="calonpekerja/signup.php">Sign Up</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                        </div>
                    </div>
                </nav>
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <?php
                                if(isset($_GET['nama']) && isset($_GET['kota_id'])){
                                    $strQuery = "SELECT l.lowongan_id, p.perusahaan_id, p.perusahaan_nama, k.kategori_id, k.kategori_nama, c.kota_id, c.kota_nama,
                                    l.lowongan_judul, l.lowongan_deskripsi, l.lowongan_tgl_buka, l.lowongan_tgl_tutup
                                    FROM lowongan l INNER JOIN perusahaan p ON l.perusahaan_id = p.perusahaan_id
                                    INNER JOIN kategori k ON l.kategori_id = k.kategori_ID 
                                    INNER JOIN kota c ON p.kota_id = c.kota_id
                                    WHERE l.lowongan_judul LIKE '%$_GET[nama]%' AND c.kota_id = '$_GET[kota_id]' AND l.lowongan_tgl_tutup >= CURDATE()
                                    ORDER BY lowongan_id DESC";
                                }else {
                                        $strQuery = "SELECT l.lowongan_id, p.perusahaan_id, p.perusahaan_nama, k.kategori_id, k.kategori_nama, c.kota_nama,
                                        l.lowongan_judul, l.lowongan_deskripsi, l.lowongan_tgl_buka, l.lowongan_tgl_tutup
                                        FROM lowongan l INNER JOIN perusahaan p ON l.perusahaan_id = p.perusahaan_id
                                        INNER JOIN kategori k ON l.kategori_id = k.kategori_ID
                                        INNER JOIN kota c ON p.kota_id = c.kota_id 
                                        WHERE l.lowongan_tgl_tutup >= CURDATE()
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
                                                        <?php echo "<a href=# data-toggle=modal data-target=#detail$i>$result[lowongan_judul]</a>";?>
                                                    </h4>
                                                </div>
                                                <div class="col-md-12">
                                                    <p class="category">
                                                        <?php echo $result['perusahaan_nama'];?> 
                                                        <br/>
                                                        <?php echo $result['lowongan_tgl_buka'] ." s.d. ".$result['lowongan_tgl_tutup']?>
                                                    </p><br/>
                                                    <p class="category">
                                                        </i><?php echo substr($result['lowongan_deskripsi'], 0, 50)."...";?>
                                                    </p>
                                                </div>
                                                <div class="col-md-12" style="text-align: left;">
                                                    <p class="category">           
                                                        <br/>
                                                        <i class="fa fa-map-marker icon-info"></i><?php echo $result['kota_nama']?> &nbsp;&nbsp;
                                                        <i class="fa fa-tags icon-info"></i><?php echo $result['kategori_nama']?> <br/>   
                                                    </p>

                                                    <!-- Modal Detail -->
                                                    <div class="modal fade" id="detail<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog" role="document">
                                                        <form method="POST" action="php/lamaran_tambah_proses.php">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title" id="myModalLabel">Detail Lowongan</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <b>Nama Perusahaan</b><br/>
                                                                    <?php
                                                                        echo "$result[perusahaan_nama]";
                                                                    ?>
                                                                    <br/><br/>

                                                                    <b>Kota</b><br/>
                                                                    <?php
                                                                        echo "$result[kota_nama]";
                                                                    ?>
                                                                    <br/><br/>

                                                                    <b>Judul Lowongan</b><br/>
                                                                    <?php
                                                                        echo "$result[lowongan_judul]";
                                                                    ?>
                                                                    <br/><br/>

                                                                    <b>Jobdesc Lowongan</b><br/>
                                                                    <?php
                                                                        $strJobdescQuery = "SELECT j.lowongan_jobdesc_id, j.lowongan_jobdesc_isi FROM lowongan_jobdesc j INNER JOIN lowongan l ON j.lowongan_jobdesc_id = l.lowongan_id WHERE l.lowongan_id = $result[lowongan_id]  ORDER BY j.lowongan_jobdesc_id ASC";
                                                                        
                                                                        $jobdescQuery = mysqli_query($connection, $strJobdescQuery);
                                                                        $j = 1;
                                                                        while($jobdescResult = mysqli_fetch_assoc($jobdescQuery)){
                                                                            echo $j.". $jobdescResult[lowongan_jobdesc_isi]<br/>";
                                                                            $j++;
                                                                        }
                                                                    ?><br/>

                                                                    <b>Syarat Lowongan</b><br/>
                                                                    <?php
                                                                        $strSyaratQuery = "SELECT s.lowongan_syarat_id, s.lowongan_syarat FROM lowongan_syarat s INNER JOIN lowongan l ON s.lowongan_id = l.lowongan_id WHERE l.lowongan_id = $result[lowongan_id]  ORDER BY s.lowongan_syarat_id ASC";
                                                                        
                                                                        $syaratQuery = mysqli_query($connection, $strSyaratQuery);
                                                                        $j = 1;
                                                                        while($syaratResult = mysqli_fetch_assoc($syaratQuery)){
                                                                            echo $j.". $syaratResult[lowongan_syarat]<br/>";
                                                                            $j++;
                                                                        }
                                                                    ?>
                                                                    <br/>

                                                                    <b>Deskripsi</b><br/>
                                                                    <?php
                                                                        echo "$result[lowongan_deskripsi]";
                                                                    ?>
                                                                    <br/><br/>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input type="hidden" name="lowongan_id" value="<?php echo $result['lowongan_id'];?>"/>
                                                                    <input type="hidden" name="calon_pekerja_id" value="<?php echo $_SESSION['calon_pekerja_id'];?>"/>
                                                                    <input type="hidden" name="status" value="Menunggu"/>
                                                                    <button type="submit" class="btn btn-info btn-fill" disabled>Login to Apply</button>
                                                                    <button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Close</button>
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
                            </script>, Hak Cipta Dari<a href="#"> Suku Gumai 3 | Universitas Amikom Yogyakarta</a>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/dashboard.js" type="text/javascript"></script>
        <!--  Modal  -->
        <script>
            <?php
            for($j= 0 ; $j <= $i; $j++){
        ?>
            $('#detail<?php echo $j;?>').appendTo("body")
            <?php
            }
        ?>
            $('#search').appendTo("body")
        </script>
    </body>

    </html>