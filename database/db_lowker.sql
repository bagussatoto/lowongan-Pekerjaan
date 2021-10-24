-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2021 at 08:51 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lowker`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_nama` varchar(51) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `admin`
--
DELIMITER $$
CREATE TRIGGER `check_role_admin` BEFORE INSERT ON `admin` FOR EACH ROW BEGIN
		IF (SELECT login_role FROM login WHERE login_id = NEW.admin_id) != 'Admin' THEN 
			SIGNAL SQLSTATE '45000';
		END IF;
	END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `calon_pekerja`
--

CREATE TABLE `calon_pekerja` (
  `calon_pekerja_id` int(11) NOT NULL,
  `calon_pekerja_nama_lengkap` varchar(51) NOT NULL,
  `calon_pekerja_alamat` varchar(101) DEFAULT NULL,
  `kota_id` int(11) DEFAULT NULL,
  `calon_pekerja_jenis_kelamin` enum('L','P') DEFAULT NULL,
  `calon_pekerja_tempat_lahir` varchar(51) DEFAULT NULL,
  `calon_pekerja_tanggal_lahir` date DEFAULT NULL,
  `calon_pekerja_status_pernikahan` enum('Lajang','Menikah','Janda/Duda') DEFAULT NULL,
  `calon_pekerja_email` varchar(51) NOT NULL,
  `calon_pekerja_telepon` varchar(13) DEFAULT NULL,
  `calon_pekerja_pendidikan_terakhir` enum('SD','SMP','SMA','S1','S2') DEFAULT NULL,
  `calon_pekerja_tempat_pendidikan_terakhir` varchar(51) DEFAULT NULL,
  `calon_pekerja_tempat_bekerja_terakhir` varchar(51) DEFAULT NULL,
  `calon_pekerja_pekerjaan_bekerja_terakhir` varchar(51) DEFAULT NULL,
  `calon_pekerja_file_cv` varchar(101) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `calon_pekerja`
--

INSERT INTO `calon_pekerja` (`calon_pekerja_id`, `calon_pekerja_nama_lengkap`, `calon_pekerja_alamat`, `kota_id`, `calon_pekerja_jenis_kelamin`, `calon_pekerja_tempat_lahir`, `calon_pekerja_tanggal_lahir`, `calon_pekerja_status_pernikahan`, `calon_pekerja_email`, `calon_pekerja_telepon`, `calon_pekerja_pendidikan_terakhir`, `calon_pekerja_tempat_pendidikan_terakhir`, `calon_pekerja_tempat_bekerja_terakhir`, `calon_pekerja_pekerjaan_bekerja_terakhir`, `calon_pekerja_file_cv`) VALUES
(30, 'Aldo', '', 1, 'L', '', '0000-00-00', 'Lajang', 'aldo', '', 'SD', '', '', '', ''),
(33, 'BAGUS BUDI SATOTO', '', 1, 'L', '', '0000-00-00', 'Lajang', 'bagusbudi1308@gmail.com', '', 'SD', '', '', '', ''),
(36, 'Aldo', '', 1, 'L', '', '0000-00-00', 'Lajang', 'aldo@z', '', 'SD', '', '', '', ''),
(37, 'Contoh', '', 1, 'L', '', '0000-00-00', 'Lajang', 'contoh', '', 'SD', '', '', '', ''),
(38, 'budi', '', 1, 'L', '', '0000-00-00', 'Lajang', 'budi123', '', 'SD', '', '', '', ''),
(39, 'JokoWI', '', 1, 'L', '', '0000-00-00', 'Lajang', 'jokowi@gmail.com', '', 'SD', '', '', '', '');

--
-- Triggers `calon_pekerja`
--
DELIMITER $$
CREATE TRIGGER `check_role_calon_pekerja` BEFORE INSERT ON `calon_pekerja` FOR EACH ROW BEGIN
		IF (SELECT login_role FROM login WHERE login_id = NEW.calon_pekerja_id) != 'Calon Pekerja' THEN 
			SIGNAL SQLSTATE '45000';
		END IF;
	END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori_nama` varchar(21) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `kategori_nama`) VALUES
(5, 'Administrasi'),
(6, 'Asuransi'),
(7, 'Hotel'),
(8, 'Kecantikan'),
(9, 'Kesehatan'),
(10, 'Kontruksi Dan Banguna'),
(1, 'Marketing'),
(11, 'Pendidikan'),
(12, 'Perbankan'),
(2, 'Perminyakan'),
(3, 'Pertambangan'),
(4, 'Teknologi Informasi'),
(13, 'Transportasi');

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `kota_id` int(11) NOT NULL,
  `kota_nama` varchar(51) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`kota_id`, `kota_nama`) VALUES
(1, 'Aceh'),
(32, 'Ambon'),
(13, 'Bandung'),
(22, 'Banjarmasin'),
(12, 'Banten'),
(7, 'Bengkulu'),
(17, 'Denpasar'),
(11, 'DKI Jakarta'),
(26, 'Golrongtalo'),
(6, 'Jambi'),
(34, 'Jayapura'),
(30, 'Kendari'),
(5, 'Kepulauan Riau'),
(31, 'Kepulauan Tidore'),
(19, 'Kupang'),
(10, 'Lampung'),
(29, 'Makasar'),
(25, 'Manado'),
(33, 'Manokwari'),
(28, 'Manuju'),
(18, 'Mataram'),
(8, 'Palembang'),
(27, 'Palu'),
(9, 'Pangkal Pinang'),
(21, 'Pangkal Raya'),
(20, 'Pontianak'),
(4, 'Riau'),
(23, 'Samarinda'),
(14, 'Semarang'),
(3, 'Sumatra Barat'),
(2, 'Sumatra Utara'),
(16, 'Surabaya'),
(24, 'Tanjung Kelor'),
(15, 'Yogyakarta');

-- --------------------------------------------------------

--
-- Table structure for table `lamaran`
--

CREATE TABLE `lamaran` (
  `lamaran_id` int(11) NOT NULL,
  `lowongan_id` int(11) NOT NULL,
  `calon_pekerja_id` int(11) NOT NULL,
  `lamaran_status_lolos` enum('Menunggu','Lolos','Tidak Lolos') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lamaran`
--

INSERT INTO `lamaran` (`lamaran_id`, `lowongan_id`, `calon_pekerja_id`, `lamaran_status_lolos`) VALUES
(22, 19, 38, 'Menunggu'),
(23, 20, 38, 'Menunggu'),
(24, 25, 39, 'Menunggu'),
(26, 22, 39, 'Menunggu');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` int(11) NOT NULL,
  `login_username` varchar(26) NOT NULL,
  `login_password` varchar(101) NOT NULL,
  `login_role` enum('Admin','Perusahaan','Calon Pekerja') NOT NULL DEFAULT 'Calon Pekerja'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `login_username`, `login_password`, `login_role`) VALUES
(30, 'aldo123', '9d1ec50ba9ceb580b76d015dbd49c17e', 'Calon Pekerja'),
(31, 'amikom1', '5dff486265aba54f208746a70b90dd57', 'Perusahaan'),
(32, 'kemendikbud', 'e8eb532791a8d8a1096e7c09f8f9c4a3', 'Perusahaan'),
(33, 'bagus1', '7c457429df01c6b7eb2d921178f839f3', 'Calon Pekerja'),
(34, 'surya1', '7b60abc0ee9578b7967511fbc15dd93f', 'Perusahaan'),
(36, 'aldo12', 'a93adb944da930dc654d862da1739f56', 'Calon Pekerja'),
(37, 'contoh1', '30097045d61b412e13350c9d37221329', 'Calon Pekerja'),
(38, 'budi2', 'cc119701be06f8de7c4e87acfc504723', 'Calon Pekerja'),
(39, 'jokowi', '7d00ff54a263fe80825b9297804a982c', 'Calon Pekerja'),
(40, 'amikomjogja', 'afe8f002b9c5f8bc07d0080816887ec1', 'Perusahaan');

-- --------------------------------------------------------

--
-- Table structure for table `lowongan`
--

CREATE TABLE `lowongan` (
  `lowongan_id` int(11) NOT NULL,
  `perusahaan_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `lowongan_judul` varchar(51) NOT NULL,
  `lowongan_deskripsi` text NOT NULL,
  `lowongan_tgl_buka` date NOT NULL,
  `lowongan_tgl_tutup` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lowongan`
--

INSERT INTO `lowongan` (`lowongan_id`, `perusahaan_id`, `kategori_id`, `lowongan_judul`, `lowongan_deskripsi`, `lowongan_tgl_buka`, `lowongan_tgl_tutup`) VALUES
(19, 31, 4, 'Programmmer', 'Join Sluur', '2021-09-22', '2021-09-26'),
(20, 31, 4, 'Web Developer', '', '2021-09-22', '2021-09-26'),
(21, 32, 11, 'Guru', '', '2021-09-22', '2021-09-24'),
(22, 32, 11, 'Dosen', '', '2021-09-22', '2021-09-24'),
(23, 34, 13, 'Supir', '', '2021-09-22', '2021-09-25'),
(24, 34, 5, 'Admin Kantor', '', '2021-09-22', '2021-09-30'),
(25, 34, 10, 'Mandor', '', '2021-09-22', '2021-09-25'),
(26, 34, 12, 'Satpam', '', '2021-09-22', '2021-09-22'),
(27, 34, 2, 'Peneliti', '', '2021-09-22', '2021-09-22'),
(28, 34, 9, 'Dokter', '', '2021-09-22', '2021-09-22'),
(29, 34, 8, 'Tata Rias', '', '2021-09-22', '2021-09-22'),
(30, 34, 1, 'Chef', '', '2021-09-22', '2021-09-22'),
(31, 34, 3, 'Pekerja Keras', '', '2021-09-22', '2021-09-22'),
(32, 40, 11, 'Dosen Tetap', '', '2021-09-22', '2021-09-30');

-- --------------------------------------------------------

--
-- Table structure for table `lowongan_jobdesc`
--

CREATE TABLE `lowongan_jobdesc` (
  `lowongan_jobdesc_id` int(11) NOT NULL,
  `lowongan_id` int(11) NOT NULL,
  `lowongan_jobdesc_isi` varchar(101) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lowongan_jobdesc`
--

INSERT INTO `lowongan_jobdesc` (`lowongan_jobdesc_id`, `lowongan_id`, `lowongan_jobdesc_isi`) VALUES
(19, 19, ''),
(20, 20, ''),
(21, 21, ''),
(22, 22, ''),
(23, 23, ''),
(24, 24, ''),
(25, 25, ''),
(26, 26, ''),
(27, 27, ''),
(28, 28, ''),
(29, 29, ''),
(30, 30, ''),
(31, 31, ''),
(32, 32, 'Pendidikan');

-- --------------------------------------------------------

--
-- Table structure for table `lowongan_syarat`
--

CREATE TABLE `lowongan_syarat` (
  `lowongan_syarat_id` int(11) NOT NULL,
  `lowongan_id` int(11) NOT NULL,
  `lowongan_syarat` varchar(101) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lowongan_syarat`
--

INSERT INTO `lowongan_syarat` (`lowongan_syarat_id`, `lowongan_id`, `lowongan_syarat`) VALUES
(10, 19, 'Bebas'),
(11, 20, ''),
(12, 21, 'S1 Pendidikan'),
(13, 22, 'S2 Pendidikan'),
(14, 23, ''),
(15, 24, ''),
(16, 25, ''),
(17, 26, ''),
(18, 27, ''),
(19, 28, ''),
(20, 29, ''),
(21, 30, ''),
(22, 31, ''),
(23, 32, 'S2 Pendidikan');

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `perusahaan_id` int(11) NOT NULL,
  `perusahaan_nama` varchar(51) NOT NULL,
  `perusahaan_alamat` varchar(101) DEFAULT NULL,
  `kota_id` int(11) DEFAULT NULL,
  `perusahaan_email` varchar(51) NOT NULL,
  `perusahaan_telepon` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`perusahaan_id`, `perusahaan_nama`, `perusahaan_alamat`, `kota_id`, `perusahaan_email`, `perusahaan_telepon`) VALUES
(31, 'PT Amikom', 'Palu', 27, 'amikom@ac.id', '08997654565'),
(32, 'Kemendikbud', 'Papua', 20, 'guru@id', '0987677777'),
(34, 'PT Surya', '', 1, 'surya@yahoo,com', ''),
(40, 'PT Amikom Jogja', 'Yogyakarta', 15, 'Amikom', '09876577');

--
-- Triggers `perusahaan`
--
DELIMITER $$
CREATE TRIGGER `check_role_perusahaan` BEFORE INSERT ON `perusahaan` FOR EACH ROW BEGIN
		IF (SELECT login_role FROM login WHERE login_id = NEW.perusahaan_id) != 'Perusahaan' THEN 
			SIGNAL SQLSTATE '45000';
		END IF;
	END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_nama` (`admin_nama`);

--
-- Indexes for table `calon_pekerja`
--
ALTER TABLE `calon_pekerja`
  ADD PRIMARY KEY (`calon_pekerja_id`),
  ADD KEY `fk_calon_pekerja_kota` (`kota_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`),
  ADD UNIQUE KEY `kategori_nama` (`kategori_nama`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`kota_id`),
  ADD UNIQUE KEY `kota_nama` (`kota_nama`);

--
-- Indexes for table `lamaran`
--
ALTER TABLE `lamaran`
  ADD PRIMARY KEY (`lamaran_id`),
  ADD UNIQUE KEY `lowongan_id` (`lowongan_id`,`calon_pekerja_id`),
  ADD KEY `calon_pekerja_id` (`calon_pekerja_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`),
  ADD UNIQUE KEY `login_username` (`login_username`);

--
-- Indexes for table `lowongan`
--
ALTER TABLE `lowongan`
  ADD PRIMARY KEY (`lowongan_id`),
  ADD KEY `fk_lowongan_perusahaan` (`perusahaan_id`),
  ADD KEY `fk_lowongan_kategori` (`kategori_id`);

--
-- Indexes for table `lowongan_jobdesc`
--
ALTER TABLE `lowongan_jobdesc`
  ADD PRIMARY KEY (`lowongan_jobdesc_id`),
  ADD KEY `fk_jobdesc_lowongan` (`lowongan_id`);

--
-- Indexes for table `lowongan_syarat`
--
ALTER TABLE `lowongan_syarat`
  ADD PRIMARY KEY (`lowongan_syarat_id`),
  ADD KEY `fk_syarat_lowongan` (`lowongan_id`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`perusahaan_id`),
  ADD UNIQUE KEY `perusahaan_nama` (`perusahaan_nama`),
  ADD KEY `fk_perusahaan_kota` (`kota_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `kota`
--
ALTER TABLE `kota`
  MODIFY `kota_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `lamaran`
--
ALTER TABLE `lamaran`
  MODIFY `lamaran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `lowongan`
--
ALTER TABLE `lowongan`
  MODIFY `lowongan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `lowongan_jobdesc`
--
ALTER TABLE `lowongan_jobdesc`
  MODIFY `lowongan_jobdesc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `lowongan_syarat`
--
ALTER TABLE `lowongan_syarat`
  MODIFY `lowongan_syarat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_admin_login` FOREIGN KEY (`admin_id`) REFERENCES `login` (`login_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `calon_pekerja`
--
ALTER TABLE `calon_pekerja`
  ADD CONSTRAINT `fk_calon_pekerja_kota` FOREIGN KEY (`kota_id`) REFERENCES `kota` (`kota_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_calon_pekerja_login` FOREIGN KEY (`calon_pekerja_id`) REFERENCES `login` (`login_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lamaran`
--
ALTER TABLE `lamaran`
  ADD CONSTRAINT `lamaran_ibfk_1` FOREIGN KEY (`calon_pekerja_id`) REFERENCES `calon_pekerja` (`calon_pekerja_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lamaran_ibfk_2` FOREIGN KEY (`lowongan_id`) REFERENCES `lowongan` (`lowongan_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lowongan`
--
ALTER TABLE `lowongan`
  ADD CONSTRAINT `fk_lowongan_kategori` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`kategori_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_lowongan_perusahaan` FOREIGN KEY (`perusahaan_id`) REFERENCES `perusahaan` (`perusahaan_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lowongan_jobdesc`
--
ALTER TABLE `lowongan_jobdesc`
  ADD CONSTRAINT `fk_jobdesc_lowongan` FOREIGN KEY (`lowongan_id`) REFERENCES `lowongan` (`lowongan_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lowongan_syarat`
--
ALTER TABLE `lowongan_syarat`
  ADD CONSTRAINT `fk_syarat_lowongan` FOREIGN KEY (`lowongan_id`) REFERENCES `lowongan` (`lowongan_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD CONSTRAINT `fk_perusahaan_kota` FOREIGN KEY (`kota_id`) REFERENCES `kota` (`kota_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_perusahaan_login` FOREIGN KEY (`perusahaan_id`) REFERENCES `login` (`login_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
