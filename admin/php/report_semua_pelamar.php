<?php
	require "../../php/connection.php";
    session_start();
    $strQuery = "SELECT l.lowongan_id, p.perusahaan_id, p.perusahaan_nama, k.kategori_id, k.kategori_nama,
                                                        l.lowongan_judul, l.lowongan_deskripsi, l.lowongan_tgl_buka, l.lowongan_tgl_tutup
                                                        FROM lowongan l INNER JOIN perusahaan p ON l.perusahaan_id = p.perusahaan_id
                                                        INNER JOIN kategori k ON l.kategori_id = k.kategori_ID 
                                                        WHERE lowongan_id = '$_GET[id]'
                                                        ORDER BY lowongan_id DESC";
    $query = mysqli_query($connection, $strQuery);
    $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
?>
	<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Lowker</title>
	</head>
		<body>
        <br/>
		<?php
		echo "<h1>Lowker</h1>"; 
		echo '<table border="0">
		  <tr>
		    <td width="100">Perusahaan</td>
		    <td width="10">:</td>
		    <td width="250">'.$result['perusahaan_nama'].'</td>
		  </tr>
          <tr>
		    <td width="100">Judul Lowongan</td>
		    <td width="10">:</td>
		    <td width="250">'.$result['lowongan_judul'].'</td>
		  </tr>
          <tr>
		    <td width="100">Tanggal Buka</td>
		    <td width="10">:</td>
		    <td width="250">'.$result['lowongan_tgl_buka'].' s/d '.$result['lowongan_tgl_tutup'].'</td>
		  </tr>
		</table>';
        ?>
        <br/>
        <table border="1">
            <tr>
                <td width="200"><b>Calon Pekerja</b></td>
                <td width="200"><b>Pendidikan Terakhir</b></td>
                <td width="200"><b>Tempat Bekerja Terakhir</b></td>
                <td width="100"><b>Status</b></td>
            </tr>
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
                                                        WHERE l.lowongan_id = '$_GET[id]'
                                                        ORDER BY lamaran_id DESC";
                $query = mysqli_query($connection, $strQuery);     
                $total_dari_segala_total = mysqli_num_rows($query);                   
                while($result = mysqli_fetch_assoc($query)){
                    echo "<tr>";
                        echo "<td>$result[calon_pekerja_nama_lengkap]</td>";
                        echo "<td>$result[calon_pekerja_pendidikan_terakhir],di $result[calon_pekerja_tempat_pendidikan_terakhir]</td>";
                        if(empty($result['calon_pekerja_tempat_bekerja_terakhir'])) $result['calon_pekerja_tempat_bekerja_terakhir'] = "-";
                        if(empty($result['calon_pekerja_pekerjaan_bekerja_terakhir'])) $result['calon_pekerja_pekerjaan_bekerja_terakhir'] = "-";
                        echo "<td>$result[calon_pekerja_tempat_bekerja_terakhir], sebagai $result[calon_pekerja_pekerjaan_bekerja_terakhir]</td>";
                        echo "<td>$result[lamaran_status_lolos]</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <?php
            echo '<table border="0">
                <tr>
                    <td width="100">Total Pelamar</td>
                    <td width="10">:</td>
                    <td width="250">'.$total_dari_segala_total.'</td>
                </tr>
            </table>';
        ?>
		</body>
	</html>
	<!-- Akhir halaman HTML yang akan di konvert -->
	
	<?php
		$filename="".$result[nota_id].".pdf";
		$content = ob_get_clean();
		$content = '<page style="font-family: freeserif">'.nl2br($content).'</page>';
		 require_once('html2pdf/html2pdf.class.php');
		 try
		 {
		  $html2pdf = new HTML2PDF('L','A4','en', false, 'ISO-8859-15',array(30, 0, 20, 0));
		  $html2pdf->setDefaultFont('Arial');
		  $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		  $html2pdf->Output($filename);
		 }
		 catch(HTML2PDF_exception $e) { echo $e; }
	?>