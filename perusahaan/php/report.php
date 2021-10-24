<?php
	require "../../php/connection.php";
	$judul = $_POST['judul_lowongan'];
	$alamat = $_POST['alamat'];
	$kota = $_POST['kota'];
	$telepon = $_POST['telepon'];
	$nama_pegawai = $_POST['nama_pegawai'];
	$tgl_lahir = $_POST['tgl_lahir'];
	$tmpt_lahir = $_POST['tmpt_lahir'];
	$email = $_POST['email'];
	$cv = $_POST['cv'];
	$tmpt_pendidikan_terakhir = $_POST['tmpt_pendidikan_terakhir'];
	$pendidikan_terakhir = $_POST['pendidikan_terakhir'];
	$tmpt_bekerja = $_POST['tmpt_bekerja'];
	$pekerjaan_terakhir = $_POST['pekerjaan_terakhir'];
	$jk = $_POST['jk'];
	$nama_perusahaan = $_POST['nama_perusahaan'];
	$kota_perusahaan = $_POST['kota_perusahaan'];
?>
	<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title><?php echo $data['lowongan_judul']; ?></title>
	</head>
		<body>
		<?php
		echo "<h1>".$judul."</h1>"; 
		echo '<table border="0">
		  <tr>
		    <td width="100">NAMA</td>
		    <td width="10">:</td>
		    <td width="250">'.$nama_pegawai.'</td>
		  </tr>
		  <tr>
		    <td>ALAMAT</td>
		    <td>:</td>
		    <td>'.$alamat.'</td>
		  </tr>
		  <tr>
		    <td>KOTA</td>
		    <td>:</td>
		    <td>'.$kota.'</td>
		  </tr>
		  <tr>
		    <td>JENIS KELAMIN</td>
		    <td>:</td>
		    <td>'.$jk.'</td>
		  </tr>
		  <tr>
		    <td>TANGGAL LAHIR</td>
		    <td>:</td>
		    <td>'.$tgl_lahir.', '.$tmpt_lahir.'</td>
		  </tr>
		   <tr>
		    <td>EMAIL</td>
		    <td>:</td>
		    <td>'.$email.'</td>
		  </tr>
		   <tr>
		    <td>TELEPON</td>
		    <td>:</td>
		    <td>'.$telepon.'</td>
		  </tr>
		  <tr>
		    <td>PENDIDIKAN TERAKHIR</td>
		    <td>:</td>
		    <td>'.$pendidikan_terakhir.', di '.$tmpt_pendidikan_terakhir.'</td>
		  </tr>
		  <tr>
		    <td>PEKERJAAN TERAKHIR</td>
		    <td>:</td>
		    <td>'.$tmpt_bekerja.', sebagai '.$pekerjaan_terakhir.'</td>
		  </tr>
		  <tr>
		    <td>FILE CV</td>
		    <td>:</td>
		    <td><a href=\'../../upload/cv/'.str_replace(' ','',$cv).'\'>'.$cv.'</a></td>
		  </tr>
		</table>';

		echo "<p>data yang tertera di atas adalah calon pegawai di ".$nama_perusahaan.".</p>";
		echo "<p align='right'>".$kota_perusahaan.", ".date('d-m-Y')."<br><!--<img src='#' width='120'>--><br>( ".$nama_perusahaan." )</p>";
		?>
		</body>
	</html>
	<!-- Akhir halaman HTML yang akan di konvert -->
	
	<?php
		$filename="".$nama_pegawai.".pdf";
		$content = ob_get_clean();
		$content = '<page style="font-family: freeserif">'.nl2br($content).'</page>';
		 require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
		 try
		 {
		  $html2pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15',array(30, 0, 20, 0));
		  $html2pdf->setDefaultFont('Arial');
		  $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		  $html2pdf->Output($filename);
		 }
		 catch(HTML2PDF_exception $e) { echo $e; }
	?>