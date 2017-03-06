-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16 Mei 2016 pada 13.18
-- Versi Server: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `osce`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `grade`
--

CREATE TABLE `grade` (
  `id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `student_id` varchar(9) NOT NULL,
  `subject_id` varchar(6) NOT NULL,
  `lecturer_id` varchar(4) NOT NULL,
  `station_id` varchar(4) NOT NULL,
  `global_scale` varchar(2) NOT NULL,
  `comment` text NOT NULL,
  `date_exam` datetime NOT NULL,
  `editlog` datetime NOT NULL,
  `userlog` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `grade`
--

INSERT INTO `grade` (`id`, `session_id`, `student_id`, `subject_id`, `lecturer_id`, `station_id`, `global_scale`, `comment`, `date_exam`, `editlog`, `userlog`) VALUES
(1, 1, '0001', '1', '007', '1', '0', 'hahay', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(2, 1, '0002', '1', '007', '', '2', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(3, 1, '0003', '1', '007', '', '3', 'terakhir', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `grade_detail`
--

CREATE TABLE `grade_detail` (
  `id` int(4) NOT NULL,
  `grade_id` int(4) NOT NULL,
  `question_id` varchar(4) NOT NULL,
  `question_weight` int(1) NOT NULL,
  `question_score` int(1) NOT NULL,
  `editlog` datetime NOT NULL,
  `userlog` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `grade_detail`
--

INSERT INTO `grade_detail` (`id`, `grade_id`, `question_id`, `question_weight`, `question_score`, `editlog`, `userlog`) VALUES
(1, 1, '1', 5, 1, '0000-00-00 00:00:00', ''),
(2, 1, '2', 1, 2, '0000-00-00 00:00:00', ''),
(3, 1, '3', 2, 3, '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lecturer`
--

CREATE TABLE `lecturer` (
  `id` varchar(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pswd` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `hits` int(11) NOT NULL,
  `lastlog` datetime NOT NULL,
  `editlog` datetime NOT NULL,
  `userlog` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `lecturer`
--

INSERT INTO `lecturer` (`id`, `name`, `pswd`, `photo`, `hits`, `lastlog`, `editlog`, `userlog`) VALUES
('007', 'dr. James Bono', '14e1b600b1fd579f47433b88e8d85291', '', 21, '2016-05-16 17:59:05', '0000-00-00 00:00:00', ''),
('008', 'Ketoprak Humor', '14e1b600b1fd579f47433b88e8d85291', '', 1, '2016-05-16 18:00:31', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `participant`
--

CREATE TABLE `participant` (
  `id` int(11) NOT NULL,
  `student_id` varchar(9) NOT NULL,
  `session_id` int(4) NOT NULL,
  `editlog` datetime NOT NULL,
  `userlog` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `participant`
--

INSERT INTO `participant` (`id`, `student_id`, `session_id`, `editlog`, `userlog`) VALUES
(1, '0001', 1, '0000-00-00 00:00:00', ''),
(2, '0002', 1, '0000-00-00 00:00:00', ''),
(3, '0003', 1, '0000-00-00 00:00:00', ''),
(4, '1111', 2, '0000-00-00 00:00:00', ''),
(5, '1112', 2, '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `period`
--

CREATE TABLE `period` (
  `id` int(11) NOT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `question`
--

CREATE TABLE `question` (
  `id` int(4) NOT NULL,
  `subject_id` int(4) NOT NULL,
  `item` text NOT NULL,
  `editlog` datetime NOT NULL,
  `userlog` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `question`
--

INSERT INTO `question` (`id`, `subject_id`, `item`, `editlog`, `userlog`) VALUES
(1, 1, 'soal soal soal 1', '0000-00-00 00:00:00', ''),
(2, 1, 'soal soal soal 2', '0000-00-00 00:00:00', ''),
(3, 1, 'Soal soal soal 3', '0000-00-00 00:00:00', ''),
(4, 2, 'Pertanyaan pertanyaan 1', '0000-00-00 00:00:00', ''),
(5, 2, 'Pertanyaan pertanyaan 2', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `period_id` int(4) NOT NULL,
  `name` varchar(255) NOT NULL,
  `time_start` datetime NOT NULL,
  `time_end` datetime NOT NULL,
  `active` tinyint(1) NOT NULL,
  `editlog` datetime NOT NULL,
  `userlog` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `session`
--

INSERT INTO `session` (`id`, `period_id`, `name`, `time_start`, `time_end`, `active`, `editlog`, `userlog`) VALUES
(1, 1, 'Pertama', '2016-05-16 00:00:00', '2016-05-16 18:00:00', 1, '0000-00-00 00:00:00', ''),
(2, 1, 'Kedua', '2016-03-05 10:00:00', '2016-03-05 12:00:00', 0, '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `station`
--

CREATE TABLE `station` (
  `id` int(4) NOT NULL,
  `name` varchar(12) NOT NULL,
  `editlog` datetime NOT NULL,
  `userlog` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `student`
--

CREATE TABLE `student` (
  `id` varchar(9) NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `editlog` datetime NOT NULL,
  `userlog` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `student`
--

INSERT INTO `student` (`id`, `name`, `photo`, `editlog`, `userlog`) VALUES
('0001', 'Francesco Totti', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('0002', 'Gabriel Batistuta', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `subject`
--

CREATE TABLE `subject` (
  `id` int(4) NOT NULL,
  `name` varchar(250) NOT NULL,
  `desc` text NOT NULL,
  `editlog` datetime NOT NULL,
  `userlog` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `subject`
--

INSERT INTO `subject` (`id`, `name`, `desc`, `editlog`, `userlog`) VALUES
(1, 'Malarindu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Tetanus', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `userx`
--

CREATE TABLE `userx` (
  `id` varchar(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pswd` varchar(255) NOT NULL,
  `level` tinyint(1) NOT NULL,
  `priv` tinyint(1) NOT NULL,
  `lastlog` datetime NOT NULL,
  `hits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `userx`
--

INSERT INTO `userx` (`id`, `name`, `pswd`, `level`, `priv`, `lastlog`, `hits`) VALUES
('admin', 'Administrator', '14e1b600b1fd579f47433b88e8d85291', 1, 1, '2016-04-28 18:14:02', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade_detail`
--
ALTER TABLE `grade_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grade_fk_1_idx` (`grade_id`);

--
-- Indexes for table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `period`
--
ALTER TABLE `period`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userx`
--
ALTER TABLE `userx`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `grade_detail`
--
ALTER TABLE `grade_detail`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `participant`
--
ALTER TABLE `participant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
