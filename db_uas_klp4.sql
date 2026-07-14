-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Des 2025 pada 03.46
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uas_klp4`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `id_karyawan` varchar(5) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `tanggal`, `id_karyawan`, `status`, `keterangan`) VALUES
('A001', '2025-12-02', 'K002', 'Hadir', 'Hadir'),
('A002', '2025-12-24', 'K001', 'Hadir', 'Hadir'),
('A003', '2025-12-25', 'K003', 'Hadir', 'Izin'),
('A004', '2025-12-29', 'K004', 'Hadir', 'Hadir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi_backup`
--

CREATE TABLE `absensi_backup` (
  `id_absensi` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `absensi_backup`
--

INSERT INTO `absensi_backup` (`id_absensi`, `tanggal`, `keterangan`) VALUES
('A001', '2025-12-19', 'Hadir'),
('A002', '2025-12-22', 'Sakit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_absensi`
--

CREATE TABLE `detail_absensi` (
  `id_detail` int(11) NOT NULL,
  `id_absensi` varchar(10) DEFAULT NULL,
  `id_karyawan` varchar(10) DEFAULT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_keluar` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_absensi`
--

INSERT INTO `detail_absensi` (`id_detail`, `id_absensi`, `id_karyawan`, `jam_masuk`, `jam_keluar`) VALUES
(36, 'A001', NULL, '07:10:00', '21:10:00'),
(40, 'A002', NULL, '12:10:00', '18:10:00'),
(42, 'A003', NULL, '07:15:00', '15:15:00'),
(44, 'A004', NULL, '10:35:00', '22:40:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_absensi_backup`
--

CREATE TABLE `detail_absensi_backup` (
  `id_detail` int(11) NOT NULL DEFAULT 0,
  `id_absensi` varchar(10) DEFAULT NULL,
  `id_karyawan` varchar(5) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_keluar` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_absensi_backup`
--

INSERT INTO `detail_absensi_backup` (`id_detail`, `id_absensi`, `id_karyawan`, `status`, `jam_masuk`, `jam_keluar`) VALUES
(1, 'A001', 'K001', 'Hadir', '08:00:00', '16:00:00'),
(24, 'A002', 'K002', 'Sakit', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` varchar(5) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
('J001', 'Manager'),
('J002', 'Staff'),
('J003', 'Admin'),
('J004', 'Sekretaris'),
('J005', 'HRD'),
('J006', 'Supervisor');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` varchar(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `id_jabatan` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama`, `no_telp`, `alamat`, `id_jabatan`) VALUES
('K001', 'Amanda Safira Bilqis', '081234567890', 'Jl. Bon Jeruk No.11', 'J002'),
('K002', 'Febriyana Triwijayanti', '081234567891', 'Jl. Sekbilora No.10', 'J005'),
('K003', 'Faras Putra', '086547890021', 'Jl. Inpres No.2', 'J006'),
('K004', 'Widi Maharani', '081234567893', 'Jl. Alsut No.11', 'J001'),
('K005', 'Jasmine Sevina', '087654789076', 'Jl. Prabu No.10', 'J003');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `fk_absensi_karyawan` (`id_karyawan`);

--
-- Indeks untuk tabel `detail_absensi`
--
ALTER TABLE `detail_absensi`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `fk_detail_absensi_absensi` (`id_absensi`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD KEY `fk_karyawan_jabatan` (`id_jabatan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_absensi`
--
ALTER TABLE `detail_absensi`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `fk_absensi_karyawan` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_absensi`
--
ALTER TABLE `detail_absensi`
  ADD CONSTRAINT `fk_detail_absensi_absensi` FOREIGN KEY (`id_absensi`) REFERENCES `absensi` (`id_absensi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `fk_karyawan_jabatan` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
