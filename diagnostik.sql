-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 29 Feb 2020 pada 13.10
-- Versi Server: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testes`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `activity_logs`
--

CREATE TABLE `activity_logs` (
  `activity_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `company_id` int(11) UNSIGNED NOT NULL,
  `activity_type` varchar(64) NOT NULL,
  `activity_data` text,
  `activity_time` datetime NOT NULL,
  `activity_ip_address` varchar(15) DEFAULT NULL,
  `activity_device` varchar(32) DEFAULT NULL,
  `activity_os` varchar(16) DEFAULT NULL,
  `activity_browser` varchar(16) DEFAULT NULL,
  `activity_location` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_ujian`
--

CREATE TABLE `detail_ujian` (
  `id_detail_ujian` int(9) NOT NULL,
  `id_siswa_to_modul` int(9) NOT NULL,
  `id_modul` int(9) NOT NULL,
  `id_soal_to_modul` int(9) NOT NULL,
  `id_soal` int(9) NOT NULL,
  `jawaban` text,
  `keyakinan_1` text,
  `alasan` text,
  `keyakinan_2` text,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(9) NOT NULL,
  `user_id` int(9) NOT NULL,
  `nama` text NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_soal`
--

CREATE TABLE `kategori_soal` (
  `id_kategori_soal` int(9) NOT NULL,
  `kategori_soal` text NOT NULL,
  `deleted` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_soal`
--

INSERT INTO `kategori_soal` (`id_kategori_soal`, `kategori_soal`, `deleted`) VALUES
(0, 'Pilihan ganda', '0'),
(1, 'Essay', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `modul`
--

CREATE TABLE `modul` (
  `id_modul` int(9) NOT NULL,
  `judul` text NOT NULL,
  `jumlah_soal` int(11) DEFAULT NULL,
  `jumlah_peserta` text,
  `durasi` text NOT NULL,
  `waktu_pelaksanaan` text NOT NULL,
  `locked` enum('0','1') NOT NULL,
  `created_by` int(9) NOT NULL,
  `deleted` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(9) NOT NULL,
  `user_id` int(9) NOT NULL,
  `nama` text NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `user_id`, `nama`, `alamat`, `no_hp`) VALUES
(0, 2, 'Susi Handayani', 'Jln. dr. Cipto 61, Proyonanggan Tengah, Batang 51211', NULL),
(1, 4, 'Drs. Teten Masduki', 'Jl. H.R. Rasuna Said Kav. 3-4, Kuningan, Jakarta 12940', NULL),
(2, 6, 'Letnan Jenderal TNI (Purn.) Dr. dr. Terawan Agus Putranto, Sp.Rad(K)', 'Jl. H.R. Rasuna Said Blok X.5 Kav. 4-9, Kota Jakarta Selatan, Daerah Khusus Ibu Kota Jakarta 12950', NULL),
(3, 5, 'Dr. Ir. Siti Nurbaya Bakar, M.Sc.', 'Gedung Manggala Wanabakti Blok I lt. 2 Jl. Jenderal Gatot Subroto - Jakarta 10270, Po Box 6505, Indonesia', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa_to_modul`
--

CREATE TABLE `siswa_to_modul` (
  `id_siswa_to_modul` int(9) NOT NULL,
  `id_modul` int(9) NOT NULL,
  `id_siswa` int(9) NOT NULL,
  `user_id` int(9) NOT NULL,
  `waktu_pelaksanaan` datetime DEFAULT NULL,
  `last_id_soal` int(9) DEFAULT NULL,
  `waktu_selesai` datetime DEFAULT NULL,
  `paham_konsep` int(11) DEFAULT NULL,
  `kurang_paham_konsep` int(11) DEFAULT NULL,
  `false_positive` int(11) DEFAULT NULL,
  `false_negative` int(11) DEFAULT NULL,
  `miskonsepsi` int(11) DEFAULT NULL,
  `tidak_paham_konsep` int(11) DEFAULT NULL,
  `total_skor` int(11) DEFAULT NULL,
  `soal_kosong` int(11) DEFAULT NULL,
  `soal_terjawab` int(11) DEFAULT NULL,
  `status` enum('0','1','2') NOT NULL COMMENT '0 = Belum ujian, 1 = Sedang ujian, 2 = Selesai ujian'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal`
--

CREATE TABLE `soal` (
  `id_soal` int(9) NOT NULL,
  `id_kategori_soal` int(9) NOT NULL,
  `pertanyaan` text NOT NULL,
  `pilihan_1` text,
  `pilihan_2` text,
  `pilihan_3` text,
  `pilihan_4` text,
  `pilihan_5` text,
  `jawaban` text,
  `alasan_1` text NOT NULL,
  `alasan_2` text NOT NULL,
  `alasan_3` text,
  `alasan_4` text,
  `alasan_5` text,
  `alasan_benar` text NOT NULL,
  `deleted` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `soal`
--

INSERT INTO `soal` (`id_soal`, `id_kategori_soal`, `pertanyaan`, `pilihan_1`, `pilihan_2`, `pilihan_3`, `pilihan_4`, `pilihan_5`, `jawaban`, `alasan_1`, `alasan_2`, `alasan_3`, `alasan_4`, `alasan_5`, `alasan_benar`, `deleted`) VALUES
(0, 0, 'Siapakah presiden pertama Indonesia?', 'Dr. Ir. H. Soekarno', 'Jenderal Besar TNI H. M. Soeharto', 'Prof. Dr. Ing. H. Bacharuddin Jusuf Habibie, FREng', 'Dr.(H.C.) Hj. Dyah Permata Megawati Setyawati Soekarnoputri', 'Jenderal TNI (HOR.) (Purn.) Prof. Dr. H. Susilo Bambang Yudhoyono, M.A., GCB., AC.', 'A', 'Karena jawaban E benar', 'Karena jawaban A benar', 'Karena jawaban C benar', 'Karena jawaban B benar', 'Karena jawaban D benar', 'B', '0'),
(1, 0, 'Siapakah penemu lampu listrik?', 'Nikola Tesla', 'Mark Elliot Zuckerberg', 'Thomas Alva Edison', 'Oprah Gail Winfrey', NULL, 'C', 'Karena jawaban D benar', 'Karena jawaban B benar', 'Karena jawaban A benar', 'Karena jawaban C benar', NULL, 'D', '0'),
(2, 0, 'Siapakah pendiri Google?', 'Robert John Downey Sr. dan Elsie Ann Downey', 'Lawrence Edward Page dan Sergey Mikhaylovich Brin', 'Dwayne Douglas Johnson dan John Felix Anthony Cena Jr.', NULL, NULL, 'B', 'Karena jawaban B benar', 'Karena jawaban A benar', 'Karena jawaban C benar', NULL, NULL, 'A', '0'),
(3, 0, 'Dimanakah ibu kota negara Australia?', 'Brisbane', 'Sydney', 'Canberra', 'Melbourne', NULL, 'C', 'Karena jawaban C benar', 'Karena jawaban A benar', 'Karena jawaban B benar', 'Karena jawaban D benar', NULL, 'A', '0'),
(4, 0, 'Negara manakah yang menjuarai Piala Eropa 2016?', 'Inggris', 'Belanda', 'Portugal', 'Spanyol', 'Swiss', 'C', 'Karena jawaban A benar', 'Karena jawaban C benar', 'Karena jawaban B benar', 'Karena jawaban D benar', 'Karena jawaban E benar', 'B', '0'),
(5, 0, 'Kapan PBB didirikan?', '24 Oktober 1945', '24 Oktober 1946', '24 Agustus 1945', NULL, NULL, 'A', 'Karena jawaban A benar', 'Karena jawaban C benar', 'Karena jawaban B benar', NULL, NULL, 'A', '0'),
(6, 0, '<p>Sampah plastik sangat berbahaya jika dibuang dengan sembarangan. Sampah plastik tidak bisa membusuk. Ini berarti bahwa sampah plastik tidak dapat didaur ulang secara alami. Ketika dibawa oleh air sungai, itu mengganggu ekosistem. Banyak hewan mati karena tertelan limbah plastik.</p><p>Gagasan utama dari bacaan di atas adalah …</p>', 'Akibat dari rusaknya jalan', 'Penyebab kerusakan jalan', 'Banyak jalan yang dilewati kendaraan', 'Aspal jalan mulai rusak karena tak dirawat', NULL, 'C', 'Karena jawaban A benar', 'Karena jawaban B benar', 'Karena jawaban C benar', 'Karena jawaban D benar', NULL, 'C', '0'),
(7, 0, '1+1=?', '12', '122', '31', '2', '21', 'D', 'Karena jawaban E benar', 'Karena jawaban A benar', 'Karena jawaban C benar', 'Karena jawaban B benar', 'Karena jawaban D benar', 'E', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal_to_modul`
--

CREATE TABLE `soal_to_modul` (
  `id_soal_to_modul` int(9) NOT NULL,
  `id_modul` int(9) NOT NULL,
  `id_soal` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(9) UNSIGNED NOT NULL,
  `username` varchar(200) DEFAULT NULL,
  `pass` varchar(64) DEFAULT NULL,
  `fullname` text NOT NULL,
  `photo` text,
  `total_login` int(9) UNSIGNED NOT NULL DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `login_attempts` int(9) UNSIGNED DEFAULT '0',
  `last_login_attempt` datetime DEFAULT NULL,
  `remember_time` datetime DEFAULT NULL,
  `remember_exp` text,
  `ip_address` text,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `verification_token` varchar(128) DEFAULT NULL,
  `recovery_token` varchar(128) DEFAULT NULL,
  `unlock_token` varchar(128) DEFAULT NULL,
  `created_by` int(9) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(9) UNSIGNED DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_by` int(9) UNSIGNED DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `pass`, `fullname`, `photo`, `total_login`, `last_login`, `last_activity`, `login_attempts`, `last_login_attempt`, `remember_time`, `remember_exp`, `ip_address`, `is_active`, `verification_token`, `recovery_token`, `unlock_token`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`, `deleted`) VALUES
(0, 'admin', '1', 'Administrator', NULL, 18, '2020-02-28 21:54:40', '2020-02-28 21:54:40', 18, '2020-02-28 21:54:40', NULL, NULL, '::1', 1, NULL, NULL, NULL, 0, '2019-12-07 22:15:17', NULL, NULL, NULL, NULL, 0),
(1, 'adm', '1', 'Administrator', NULL, 29, '2020-02-20 20:43:25', '2020-02-20 20:43:25', 29, '2020-02-20 20:43:25', NULL, NULL, '::1', 1, NULL, NULL, NULL, 0, '2019-12-08 23:32:46', NULL, NULL, NULL, NULL, 0),
(2, 'susi', '1234', 'Susi Handayani', NULL, 7, '2020-02-11 16:08:12', '2020-02-11 16:08:12', 7, '2020-02-11 16:08:12', NULL, NULL, '::1', 1, NULL, NULL, NULL, 0, '2020-01-27 20:01:22', NULL, NULL, NULL, NULL, 0),
(3, 'yasonna', '1', 'Prof. Yasonna Hamonangan Laoly, S.H., M.Sc., Ph.D.', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 0, '2020-02-14 22:21:25', NULL, NULL, NULL, NULL, 0),
(4, 'teten', '1', 'Drs. Teten Masduki', NULL, 13, '2020-02-23 20:51:14', '2020-02-23 20:51:14', 13, '2020-02-23 20:51:14', NULL, NULL, '::1', 1, NULL, NULL, NULL, 0, '2020-02-16 17:11:08', NULL, NULL, NULL, NULL, 0),
(5, 'siti', '1', 'Dr. Ir. Siti Nurbaya Bakar, M.Sc.', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 0, '2020-02-16 17:13:26', NULL, NULL, NULL, NULL, 0),
(6, 'terawan', '1', 'Letnan Jenderal TNI (Purn.) Dr. dr. Terawan Agus Putranto, Sp.Rad(K)', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 0, '2020-02-16 17:13:26', NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) UNSIGNED NOT NULL,
  `company_id` int(9) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `definition` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `route` varchar(32) DEFAULT NULL,
  `created_by` int(9) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(9) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_by` int(9) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `company_id`, `name`, `definition`, `description`, `route`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`, `deleted`) VALUES
(0, NULL, 'Super Admin', 'Super Administrator', NULL, 'admin_side/beranda', 0, '2018-10-27 17:52:08', NULL, NULL, NULL, NULL, 0),
(1, NULL, 'Admin', 'Administrator (Owner)', NULL, 'admin_side/beranda', 0, '2017-03-06 01:19:26', 2, '2018-10-27 18:55:37', NULL, NULL, 0),
(2, NULL, 'Guru', 'Guru Sekolah', NULL, 'member_side/beranda', 0, '2017-03-06 01:19:26', NULL, NULL, NULL, NULL, 0),
(3, NULL, 'Siswa', 'Siswa Sekolah', NULL, 'member_side/beranda', 0, '2020-02-14 22:11:59', NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_to_role`
--

CREATE TABLE `user_to_role` (
  `user_id` int(9) UNSIGNED NOT NULL DEFAULT '0',
  `role_id` int(9) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user_to_role`
--

INSERT INTO `user_to_role` (`user_id`, `role_id`) VALUES
(0, 0),
(1, 1),
(2, 3),
(3, 2),
(4, 3),
(5, 3),
(6, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `detail_ujian`
--
ALTER TABLE `detail_ujian`
  ADD PRIMARY KEY (`id_detail_ujian`),
  ADD KEY `id_soal` (`id_soal`),
  ADD KEY `id_soal_to_modul` (`id_soal_to_modul`),
  ADD KEY `id_modul` (`id_modul`),
  ADD KEY `id_siswa_to_modul` (`id_siswa_to_modul`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `kategori_soal`
--
ALTER TABLE `kategori_soal`
  ADD PRIMARY KEY (`id_kategori_soal`);

--
-- Indexes for table `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`id_modul`),
  ADD KEY `user_id` (`created_by`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `siswa_to_modul`
--
ALTER TABLE `siswa_to_modul`
  ADD PRIMARY KEY (`id_siswa_to_modul`),
  ADD KEY `id_modul` (`id_modul`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `id_soal` (`last_id_soal`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`),
  ADD KEY `id_kategori_soal` (`id_kategori_soal`);

--
-- Indexes for table `soal_to_modul`
--
ALTER TABLE `soal_to_modul`
  ADD PRIMARY KEY (`id_soal_to_modul`),
  ADD KEY `id_modul` (`id_modul`),
  ADD KEY `id_soal` (`id_soal`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_index` (`username`),
  ADD KEY `is_active_index` (`is_active`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name_index` (`name`),
  ADD KEY `company_id_index` (`company_id`) USING BTREE;

--
-- Indexes for table `user_to_role`
--
ALTER TABLE `user_to_role`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_id_index` (`role_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `activity_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `detail_ujian`
--
ALTER TABLE `detail_ujian`
  MODIFY `id_detail_ujian` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kategori_soal`
--
ALTER TABLE `kategori_soal`
  MODIFY `id_kategori_soal` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `modul`
--
ALTER TABLE `modul`
  MODIFY `id_modul` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `siswa_to_modul`
--
ALTER TABLE `siswa_to_modul`
  MODIFY `id_siswa_to_modul` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `soal_to_modul`
--
ALTER TABLE `soal_to_modul`
  MODIFY `id_soal_to_modul` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
