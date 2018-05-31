-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Bulan Mei 2018 pada 00.00
-- Versi server: 10.1.31-MariaDB
-- Versi PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nkit_sirintik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_bidang`
--

CREATE TABLE `t_bidang` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL,
  `kode` varchar(255) NOT NULL,
  `nama_bidang` varchar(255) NOT NULL,
  `jabatan_ttd` varchar(255) NOT NULL,
  `pejabat_nama` varchar(255) NOT NULL,
  `pejabat_nip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_desa`
--

CREATE TABLE `t_desa` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL,
  `id_kecamatan` varchar(255) NOT NULL,
  `kode` varchar(255) NOT NULL,
  `nama_desa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_desa`
--

INSERT INTO `t_desa` (`id`, `created_at`, `updated_at`, `status`, `id_kecamatan`, `kode`, `nama_desa`) VALUES
(1, '2018-05-20 08:20:23', '2018-05-20 08:20:23', 1, '12', 'DS01', 'Asam Randah'),
(2, '2018-05-20 08:20:51', '2018-05-20 08:20:51', 1, '12', 'DS02', 'Bagak'),
(3, '2018-05-20 08:21:01', '2018-05-20 08:21:01', 1, '12', 'DS03', 'Batu Hapu'),
(4, '2018-05-20 08:21:25', '2018-05-20 08:21:25', 1, '12', 'DS04', 'Burakai'),
(5, '2018-05-20 08:21:40', '2018-05-20 08:21:40', 1, '12', 'DS05', 'Hatungun'),
(6, '2018-05-20 08:21:59', '2018-05-20 08:21:59', 1, '12', 'DS06', 'Kambang Kuning'),
(7, '2018-05-20 08:22:18', '2018-05-20 08:22:18', 1, '12', 'DS07', 'Matang Batas'),
(8, '2018-05-20 08:22:32', '2018-05-20 08:22:32', 1, '12', 'DS08', 'Tarungin'),
(9, '2018-05-20 08:22:42', '2018-05-20 08:22:42', 1, '12', 'DS09', 'Pandulangan'),
(10, '2018-05-20 08:23:24', '2018-05-20 08:23:24', 1, '11', 'DS10', 'Tungkap');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_kabupaten`
--

CREATE TABLE `t_kabupaten` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL,
  `id_provinsi` varchar(255) NOT NULL,
  `kode` varchar(255) NOT NULL,
  `nama_kabupaten` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_kabupaten`
--

INSERT INTO `t_kabupaten` (`id`, `created_at`, `updated_at`, `status`, `id_provinsi`, `kode`, `nama_kabupaten`) VALUES
(1, '2018-05-20 06:31:27', '2018-05-20 06:31:27', 1, '12', 'BAL', 'Balangan'),
(2, '2018-05-20 06:45:16', '2018-05-20 07:35:26', 1, '12', 'TAP', 'Tapin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_kecamatan`
--

CREATE TABLE `t_kecamatan` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL,
  `id_kabupaten` varchar(255) NOT NULL,
  `kode` varchar(255) NOT NULL,
  `nama_kecamatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_kecamatan`
--

INSERT INTO `t_kecamatan` (`id`, `created_at`, `updated_at`, `status`, `id_kabupaten`, `kode`, `nama_kecamatan`) VALUES
(1, '2018-05-20 07:28:35', '2018-05-20 07:28:35', 1, '2', 'CLU', 'Candi Laras Utara'),
(2, '2018-05-20 07:28:50', '2018-05-20 07:28:50', 1, '2', 'CLS', 'Candi Laras Selatan'),
(3, '2018-05-20 07:29:06', '2018-05-20 07:29:06', 1, '2', 'BAK', 'Bakarangan'),
(4, '2018-05-20 07:29:17', '2018-05-20 07:29:17', 1, '2', 'LOK', 'Lokpaikat'),
(5, '2018-05-20 07:29:36', '2018-05-20 07:29:36', 1, '2', 'PIA', 'Piani'),
(6, '2018-05-20 07:30:08', '2018-05-20 07:30:08', 1, '2', 'TAU', 'Tapin Utara'),
(7, '2018-05-20 07:30:22', '2018-05-20 07:30:22', 1, '2', 'TAT', 'Tapin Tengah'),
(8, '2018-05-20 07:30:33', '2018-05-20 07:39:25', 1, '2', 'TAS', 'Tapin Selatan'),
(9, '2018-05-20 07:39:47', '2018-05-20 07:39:47', 1, '2', 'BUN', 'Bungur'),
(10, '2018-05-20 07:39:58', '2018-05-20 07:39:58', 1, '2', 'SBA', 'Salam Babaris'),
(11, '2018-05-20 07:40:07', '2018-05-20 07:40:07', 1, '2', 'BIN', 'Binuang'),
(12, '2018-05-20 07:40:22', '2018-05-20 07:40:22', 1, '2', 'HAT', 'Hatungun');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_komoditas`
--

CREATE TABLE `t_komoditas` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL,
  `nama_komoditas` varchar(255) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `id_pengguna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_komoditas`
--

INSERT INTO `t_komoditas` (`id`, `created_at`, `updated_at`, `status`, `nama_komoditas`, `jenis`, `id_pengguna`) VALUES
(1, '2018-05-21 13:25:47', '2018-05-21 13:51:27', 1, 'BAWANG MERAH', 'Horti', 1),
(2, '2018-05-21 13:33:16', '2018-05-21 13:51:55', 1, 'CABE BESAR', 'Horti', 1),
(3, '2018-05-21 13:33:25', '2018-05-21 13:52:11', 1, 'CABE RAWIT', 'Horti', 1),
(4, '2018-05-21 13:33:33', '2018-05-21 13:52:26', 1, 'JERUK', 'Horti', 1),
(5, '2018-05-21 14:33:34', '2018-05-21 14:33:34', 1, 'BAWANG BOMBAY', 'Horti', 1),
(6, '2018-05-21 14:33:48', '2018-05-21 14:33:48', 1, 'KELAPA SAWIT', 'Perkebunan', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pengguna`
--

CREATE TABLE `t_pengguna` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `no_kontak` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_pengguna`
--

INSERT INTO `t_pengguna` (`id`, `created_at`, `updated_at`, `status`, `nama_user`, `user_password`, `nama_lengkap`, `no_kontak`, `level`, `avatar`) VALUES
(1, '2018-05-12 04:46:31', '2018-05-19 02:02:16', 1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin tu pang', '0811666111', '1', 'admin.jpg'),
(2, '2018-05-15 09:33:17', '2018-05-19 02:02:27', 1, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'nama user', '321', '2', 'user.jpg'),
(3, '2018-05-18 01:50:56', '2018-05-18 01:57:06', 1, 'admin1', 'e00cf25ad42683b3df678c61f42c6bda', 'admin satu', '0811', '1', 'admin1.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_penyuluh`
--

CREATE TABLE `t_penyuluh` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL,
  `nama_penyuluh` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_kontak` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_peternak`
--

CREATE TABLE `t_peternak` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL,
  `id_desa` varchar(255) NOT NULL,
  `nama_peternak` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_kontak` varchar(255) NOT NULL,
  `id_pengguna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_peternak`
--

INSERT INTO `t_peternak` (`id`, `created_at`, `updated_at`, `status`, `id_desa`, `nama_peternak`, `alamat`, `no_kontak`, `id_pengguna`) VALUES
(1, '2018-05-20 14:21:10', '2018-05-21 12:29:47', 1, '1', 'SARIMUN', 'Alamat Sarimun', '081101', 1),
(2, '2018-05-21 12:29:02', '2018-05-21 12:29:02', 1, '4', 'H. IMRON', 'Ron ron', '081105', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_poktan`
--

CREATE TABLE `t_poktan` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL,
  `id_desa` int(11) NOT NULL,
  `poktan` varchar(255) NOT NULL,
  `nama_petani` varchar(255) NOT NULL,
  `no_kontak` varchar(255) NOT NULL,
  `id_pengguna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_poktan`
--

INSERT INTO `t_poktan` (`id`, `created_at`, `updated_at`, `status`, `id_desa`, `poktan`, `nama_petani`, `no_kontak`, `id_pengguna`) VALUES
(1, '2018-05-21 12:14:10', '2018-05-21 12:31:39', 1, 3, 'KEBUN JAYA', 'Mohamad Ruki', '081102', 1),
(2, '2018-05-21 12:14:30', '2018-05-21 12:31:49', 1, 4, 'CAHAYA INDAH', 'Busani', '081103', 1),
(3, '2018-05-21 12:15:46', '2018-05-21 12:31:53', 1, 3, 'TUNAS MUDA', 'M. Taha', '081104', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_provinsi`
--

CREATE TABLE `t_provinsi` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL,
  `kode` varchar(255) NOT NULL,
  `nama_provinsi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_provinsi`
--

INSERT INTO `t_provinsi` (`id`, `created_at`, `updated_at`, `status`, `kode`, `nama_provinsi`) VALUES
(12, '2018-05-18 23:54:09', '2018-05-19 02:09:43', 1, '', 'Kalimantan Selatan'),
(13, '2018-05-18 23:56:27', '2018-05-19 02:09:47', 1, '', 'Kalimantan Timur'),
(14, '2018-05-19 00:53:40', '2018-05-19 00:53:40', 1, '', 'Kalimantan Barat'),
(15, '2018-05-19 00:53:57', '2018-05-20 07:35:14', 1, '', 'Kalimantan Utara');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_tahunkomoditas`
--

CREATE TABLE `t_tahunkomoditas` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL,
  `tahun` varchar(255) NOT NULL,
  `id_komoditas` varchar(255) NOT NULL,
  `id_pengguna` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_tahunkomoditas`
--

INSERT INTO `t_tahunkomoditas` (`id`, `created_at`, `updated_at`, `status`, `tahun`, `id_komoditas`, `id_pengguna`) VALUES
(1, '2018-05-21 14:30:46', '2018-05-21 14:40:50', 1, '2018', '1', '1'),
(2, '2018-05-21 14:30:57', '2018-05-21 14:42:34', 1, '2018', '2', '1'),
(3, '2018-05-21 14:31:03', '2018-05-21 14:41:13', 1, '2018', '3', '1'),
(4, '2018-05-21 14:32:26', '2018-05-21 14:41:20', 1, '2018', '4', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_upsus`
--

CREATE TABLE `t_upsus` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL,
  `id_pengguna` varchar(255) NOT NULL,
  `id_penyuluh` varchar(255) NOT NULL,
  `id_komoditas` varchar(255) NOT NULL,
  `bulan` varchar(255) NOT NULL,
  `tahun` varchar(255) NOT NULL,
  `tanam_tanggal` varchar(255) NOT NULL,
  `tanam_luas` varchar(255) NOT NULL,
  `panen_tanggal` varchar(255) NOT NULL,
  `panen_luas` varchar(255) NOT NULL,
  `produksi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `t_bidang`
--
ALTER TABLE `t_bidang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_desa`
--
ALTER TABLE `t_desa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_kabupaten`
--
ALTER TABLE `t_kabupaten`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_kecamatan`
--
ALTER TABLE `t_kecamatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_komoditas`
--
ALTER TABLE `t_komoditas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_pengguna`
--
ALTER TABLE `t_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_penyuluh`
--
ALTER TABLE `t_penyuluh`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_peternak`
--
ALTER TABLE `t_peternak`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_poktan`
--
ALTER TABLE `t_poktan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_provinsi`
--
ALTER TABLE `t_provinsi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_tahunkomoditas`
--
ALTER TABLE `t_tahunkomoditas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_upsus`
--
ALTER TABLE `t_upsus`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `t_bidang`
--
ALTER TABLE `t_bidang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_desa`
--
ALTER TABLE `t_desa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `t_kabupaten`
--
ALTER TABLE `t_kabupaten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `t_kecamatan`
--
ALTER TABLE `t_kecamatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `t_komoditas`
--
ALTER TABLE `t_komoditas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `t_pengguna`
--
ALTER TABLE `t_pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `t_penyuluh`
--
ALTER TABLE `t_penyuluh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_peternak`
--
ALTER TABLE `t_peternak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `t_poktan`
--
ALTER TABLE `t_poktan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `t_provinsi`
--
ALTER TABLE `t_provinsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `t_tahunkomoditas`
--
ALTER TABLE `t_tahunkomoditas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `t_upsus`
--
ALTER TABLE `t_upsus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
