-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Jul 2020 pada 15.18
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `backup_db`
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
  `activity_data` text DEFAULT NULL,
  `activity_time` datetime NOT NULL,
  `activity_ip_address` varchar(15) DEFAULT NULL,
  `activity_device` varchar(32) DEFAULT NULL,
  `activity_os` varchar(16) DEFAULT NULL,
  `activity_browser` varchar(16) DEFAULT NULL,
  `activity_location` text DEFAULT NULL
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
  `jawaban` text DEFAULT NULL,
  `jawaban_matching_1` text DEFAULT NULL,
  `jawaban_matching_2` text DEFAULT NULL,
  `jawaban_matching_3` text DEFAULT NULL,
  `jawaban_matching_4` text DEFAULT NULL,
  `jawaban_matching_5` text DEFAULT NULL,
  `keyakinan_1` text DEFAULT NULL,
  `alasan` text DEFAULT NULL,
  `keyakinan_2` text DEFAULT NULL,
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
(1, 'Matching', '0');

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
  `instruksi` text NOT NULL,
  `jumlah_soal` int(11) DEFAULT NULL,
  `jumlah_peserta` text DEFAULT NULL,
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
  `no_hp` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `last_index` int(9) DEFAULT NULL,
  `waktu_normal_selesai` datetime DEFAULT NULL,
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
  `image` text DEFAULT NULL,
  `pilihan_1` text DEFAULT NULL,
  `pilihan_2` text DEFAULT NULL,
  `pilihan_3` text DEFAULT NULL,
  `pilihan_4` text DEFAULT NULL,
  `pilihan_5` text DEFAULT NULL,
  `random_pilihan_1` text DEFAULT NULL,
  `random_pilihan_2` text DEFAULT NULL,
  `random_pilihan_3` text DEFAULT NULL,
  `random_pilihan_4` text DEFAULT NULL,
  `random_pilihan_5` text DEFAULT NULL,
  `jawaban` text DEFAULT NULL,
  `jawaban_1` text DEFAULT NULL,
  `jawaban_2` text DEFAULT NULL,
  `jawaban_3` text DEFAULT NULL,
  `jawaban_4` text DEFAULT NULL,
  `jawaban_5` text DEFAULT NULL,
  `alasan_1` text NOT NULL,
  `alasan_2` text NOT NULL,
  `alasan_3` text DEFAULT NULL,
  `alasan_4` text DEFAULT NULL,
  `alasan_5` text DEFAULT NULL,
  `alasan_benar` text NOT NULL,
  `deleted` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal_to_modul`
--

CREATE TABLE `soal_to_modul` (
  `id_soal_to_modul` int(9) NOT NULL,
  `id_modul` int(9) NOT NULL,
  `id_soal` int(9) NOT NULL,
  `nomor_soal` int(9) DEFAULT NULL
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
  `photo` text DEFAULT NULL,
  `total_login` int(9) UNSIGNED NOT NULL DEFAULT 0,
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `login_attempts` int(9) UNSIGNED DEFAULT 0,
  `last_login_attempt` datetime DEFAULT NULL,
  `remember_time` datetime DEFAULT NULL,
  `remember_exp` text DEFAULT NULL,
  `ip_address` text DEFAULT NULL,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `verification_token` varchar(128) DEFAULT NULL,
  `recovery_token` varchar(128) DEFAULT NULL,
  `unlock_token` varchar(128) DEFAULT NULL,
  `created_by` int(9) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(9) UNSIGNED DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_by` int(9) UNSIGNED DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `pass`, `fullname`, `photo`, `total_login`, `last_login`, `last_activity`, `login_attempts`, `last_login_attempt`, `remember_time`, `remember_exp`, `ip_address`, `is_active`, `verification_token`, `recovery_token`, `unlock_token`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`, `deleted`) VALUES
(0, 'admin', '1', 'Administrator', NULL, 70, '2020-07-11 10:35:38', '2020-07-11 10:35:38', 70, '2020-07-11 10:35:38', NULL, NULL, '::1', 1, NULL, NULL, NULL, 0, '2019-12-07 22:15:17', NULL, NULL, NULL, NULL, 0),
(1, 'adm', '1', 'Administrator', NULL, 29, '2020-02-20 20:43:25', '2020-02-20 20:43:25', 29, '2020-02-20 20:43:25', NULL, NULL, '::1', 1, NULL, NULL, NULL, 0, '2019-12-08 23:32:46', NULL, NULL, NULL, NULL, 0);

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
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(9) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_by` int(9) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0
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
  `user_id` int(9) UNSIGNED NOT NULL DEFAULT 0,
  `role_id` int(9) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user_to_role`
--

INSERT INTO `user_to_role` (`user_id`, `role_id`) VALUES
(0, 0),
(1, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indeks untuk tabel `detail_ujian`
--
ALTER TABLE `detail_ujian`
  ADD PRIMARY KEY (`id_detail_ujian`),
  ADD KEY `id_soal` (`id_soal`),
  ADD KEY `id_soal_to_modul` (`id_soal_to_modul`),
  ADD KEY `id_modul` (`id_modul`),
  ADD KEY `id_siswa_to_modul` (`id_siswa_to_modul`);

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `kategori_soal`
--
ALTER TABLE `kategori_soal`
  ADD PRIMARY KEY (`id_kategori_soal`);

--
-- Indeks untuk tabel `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`id_modul`),
  ADD KEY `user_id` (`created_by`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `siswa_to_modul`
--
ALTER TABLE `siswa_to_modul`
  ADD PRIMARY KEY (`id_siswa_to_modul`),
  ADD KEY `id_modul` (`id_modul`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `id_soal` (`last_id_soal`);

--
-- Indeks untuk tabel `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`),
  ADD KEY `id_kategori_soal` (`id_kategori_soal`);

--
-- Indeks untuk tabel `soal_to_modul`
--
ALTER TABLE `soal_to_modul`
  ADD PRIMARY KEY (`id_soal_to_modul`),
  ADD KEY `id_modul` (`id_modul`),
  ADD KEY `id_soal` (`id_soal`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_index` (`username`),
  ADD KEY `is_active_index` (`is_active`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name_index` (`name`),
  ADD KEY `company_id_index` (`company_id`) USING BTREE;

--
-- Indeks untuk tabel `user_to_role`
--
ALTER TABLE `user_to_role`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_id_index` (`role_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `activity_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_ujian`
--
ALTER TABLE `detail_ujian`
  MODIFY `id_detail_ujian` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori_soal`
--
ALTER TABLE `kategori_soal`
  MODIFY `id_kategori_soal` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `modul`
--
ALTER TABLE `modul`
  MODIFY `id_modul` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `siswa_to_modul`
--
ALTER TABLE `siswa_to_modul`
  MODIFY `id_siswa_to_modul` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `soal_to_modul`
--
ALTER TABLE `soal_to_modul`
  MODIFY `id_soal_to_modul` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
