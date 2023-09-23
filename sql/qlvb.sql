-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2016 at 11:43 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qlvb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bieumau`
--

CREATE TABLE `bieumau` (
  `MaBM` int(1) NOT NULL,
  `TenBM` text NOT NULL,
  `SoLuong` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bieumau`
--

INSERT INTO `bieumau` (`MaBM`, `TenBM`, `SoLuong`) VALUES
(0, 'Không biểu mẫu', 0),
(2, 'biễu mẫu 1', 1),
(7, 'Biểu mẫu 2', 2),
(6, 'abc', 2),
(8, 'Biểu mẫu 21', 2),
(9, 'Bieu mau 20', 1),
(10, 'Bieu mau 2', 1),
(11, 'dsasd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `chucvu`
--

CREATE TABLE `chucvu` (
  `MaCV` int(11) NOT NULL,
  `TenCV` text NOT NULL,
  `GhiChu` text,
  `TrangThai` int(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chucvu`
--

INSERT INTO `chucvu` (`MaCV`, `TenCV`, `GhiChu`, `TrangThai`) VALUES
(1, 'Trưởng phòng', '', 1),
(2, 'Hiệu trưởng', '', 1),
(3, 'Phó hiệu trưởng', '', 1),
(4, 'Nhân viên', '', 1),
(5, 'Phó phòng', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `coquan`
--

CREATE TABLE `coquan` (
  `MaCQ` int(11) NOT NULL,
  `TenCQ` text NOT NULL,
  `DiaChi` text NOT NULL,
  `DienThoai` char(15) DEFAULT NULL,
  `Fax` char(15) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `CQSuDung` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coquan`
--

INSERT INTO `coquan` (`MaCQ`, `TenCQ`, `DiaChi`, `DienThoai`, `Fax`, `Email`, `CQSuDung`) VALUES
(1, 'Trường đại học Ngoại Ngữ', 'Thủ Đức', '07103861946', '07103861015', 'dh@hcmue.edu.vn', 1),
(2, 'Trường đại học Kinh Tế - Luật', 'Thủ Đức', '07106111222', '07103222113', 'dh@uel.edu.vn', 0),
(3, 'Trường đại học Bách Khoa', 'Quận 10', '07103222111', '07103222112', 'dh@hcmut.edu.vn', 0),
(4, 'Trường đại học Khoa Học Tự Nhiên', 'Thủ Đức', '07103222111', '07103861051', 'dh@hcmus.edu.vn', 0),
(5, 'Trường đại học Công Nghệ Thông Tin', 'Thủ Đức', '07016333333', '07103555666', 'dh@uit.edu.vn', 0);

-- --------------------------------------------------------

--
-- Table structure for table `groupusers`
--

CREATE TABLE `groupusers` (
  `idGr` int(11) NOT NULL,
  `GrName` tinytext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groupusers`
--

INSERT INTO `groupusers` (`idGr`, `GrName`) VALUES
(1, 'Quản trị hệ thống'),
(2, 'Người dùng');

-- --------------------------------------------------------

--
-- Table structure for table `loaivanban`
--

CREATE TABLE `loaivanban` (
  `MaLVB` int(11) NOT NULL,
  `TenLVB` text NOT NULL,
  `GhiChu` text,
  `TrangThai` int(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loaivanban`
--

INSERT INTO `loaivanban` (`MaLVB`, `TenLVB`, `GhiChu`, `TrangThai`) VALUES
(1, 'Thông tư','', 1),
(2, 'Nghị quyết', '', 1),
(3, 'Văn bản thường', '', 1),
(4, 'Quyết định', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nguoidung`
--

CREATE TABLE `nguoidung` (
  `MaNSD` int(11) NOT NULL,
  `TaiKhoan` varchar(25) NOT NULL,
  `MatKhau` varchar(100) NOT NULL,
  `HoTenDem` tinytext NOT NULL,
  `Ten` tinytext NOT NULL,
  `NamSinh` date NOT NULL DEFAULT '0000-00-00',
  `DiaChi` text NOT NULL,
  `GioiTinh` int(1) NOT NULL,
  `MaPB` int(11) NOT NULL,
  `MaCV` int(11) NOT NULL,
  `TrangThaiLamViec` int(1) NOT NULL,
  `idGr` int(11) NOT NULL,
  `DuyetLanhDao` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nguoidung`
--

INSERT INTO `nguoidung` (`MaNSD`, `TaiKhoan`, `MatKhau`, `HoTenDem`, `Ten`, `NamSinh`, `DiaChi`, `GioiTinh`, `MaPB`, `MaCV`, `TrangThaiLamViec`, `idGr`, `DuyetLanhDao`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Quản Trị Hệ', 'Thống', '2002-03-31', 'Thủ Đức', 1, 8, 4, 1, 1, 1),
(2, 'dmhoang', 'acfbeb1a4c1862482f11724402319db9', 'Đỗ Minh', 'Hoàng', '2002-09-09', 'Thủ Đức', 1, 8, 1, 1, 2, 1),
(3, 'nnpuyen', '47ff9aa13078d69f3edcc26281f7a261', 'Nguyễn Ngọc Phương', 'Uyên', '2002-09-09', 'Thủ Đức', 0, 4, 2, 1, 2, 1),
(4, 'pxdai', '8352425654221a38663f3a33aa7904b7', 'Phạm Xuân', 'Đài', '2002-09-09', 'Thủ Đức', 1, 2, 3, 1, 2, 1),
(5, 'lqtruong', '994a9f53461d53b8b515cf4e959aeec0', 'Lê Quang', 'Trường', '2002-09-09', 'Thủ Đức', 1, 3, 4, 0, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `phongban`
--

CREATE TABLE `phongban` (
  `MaPB` int(11) NOT NULL,
  `TenPhong` tinytext NOT NULL,
  `GhiChu` text,
  `TrangThai` int(1) NOT NULL,
  `MaCQ` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phongban`
--

INSERT INTO `phongban` (`MaPB`, `TenPhong`, `GhiChu`, `TrangThai`, `MaCQ`) VALUES
(2, 'Phòng Kế Hoạch Tổng Hợp', 'bvdkomon', 1, 1),
(8, 'Phòng Hành Chính', 'syt tpct', 1, 1),
(3, 'Phòng Văn Thư', 'bvdkomon', 1, 1),
(4, 'Ban Giám Hiệu', 'bvdkomon', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vanbanden`
--

CREATE TABLE `vanbanden` (
  `MaVB` int(11) NOT NULL,
  `TenVB` text NOT NULL,
  `SoHieu` int(11) NOT NULL,
  `KyHieu` tinytext NOT NULL,
  `NgayKy` date NOT NULL DEFAULT '0000-00-00',
  `NgayDen` date NOT NULL DEFAULT '0000-00-00',
  `MaLVB` int(11) NOT NULL,
  `MaCQ` int(11) NOT NULL,
  `MucDoKhan` int(1) NOT NULL,
  `MucDoMat` int(1) NOT NULL,
  `MaNSD` int(11) NOT NULL,
  `NoiDung` text NOT NULL,
  `TaiLieuDinhKem` text,
  `CVDTheoDuong` int(1) DEFAULT NULL,
  `TenNVDen` tinytext,
  `TinhTrangXuLy` int(1) DEFAULT NULL,
  `HanXuLy` date DEFAULT '0000-00-00',
  `NoiDungXuLy` text,
  `PhongBanXuLy` text,
  `DuyetLanhDao` tinytext,
  `NoiDungDuyet` text,
  `MaBM` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vanbanden`
--

INSERT INTO `vanbanden` (`MaVB`, `TenVB`, `SoHieu`, `KyHieu`, `NgayKy`, `NgayDen`, `MaLVB`, `MaCQ`, `MucDoKhan`, `MucDoMat`, `MaNSD`, `NoiDung`, `TaiLieuDinhKem`, `CVDTheoDuong`, `TenNVDen`, `TinhTrangXuLy`, `HanXuLy`, `NoiDungXuLy`, `PhongBanXuLy`, `DuyetLanhDao`, `NoiDungDuyet`, `MaBM`) VALUES
(1, 'Văn bản đến 1', 1, 'VBT/2023', '2023-03-23', '2023-03-28', 1, 1, 1, 1, 2, 'Văn bản thường 1', NULL, 1, NULL, 0, '2023-03-30', 'dsadasda', 'ádasdasd', 'dsadasdasd', 'đâsdasda', 0),
(5, 'Van ban den 4', 32, 'QĐ/2022', '2022-02-04', '2022-02-04', 4, 4, 1, 1, 1, 'FEWFEWWEEFWF 1', 'vbd_1459999478.doc', 2, 'FEWEFWFEFWFW 1', 1, '2023-04-05', 'EWFWEFEFE 1', 'WEFEWEFWFEW 1', 'Trần Quốc Toàn', 'EWFFEWWFW 1', 0),
(6, 'Van ban den 5', 5, 'QĐ/2023', '2023-01-03', '2023-01-04', 4, 3, 1, 1, 1, 'ADSSDASADDSASAD', NULL, 3, NULL, 0, '2023-04-18', 'ADSSDADSADSADSADA', 'FDFGFGFGGD', 'Quản Trị Hệ Thống', 'DFGGGFDGFGFD', 0),
(7, 'văn bản đến 1', 1, 'NQ/2022', '2022-01-03', '2022-01-04', 2, 3, 1, 1, 1, 'adsdsadsadsa', NULL, 1, NULL, 0, '2022-04-05', 'sadsdasdadsa', 'adssdadsadsadsasda', 'Quản Trị Hệ Thống', 'adssaddsasaddsaads', 0),
(14, 'Thông tư số 01', 1, 'TT/2021', '2021-04-09', '2021-04-11', 1, 2, 2, 1, 1, 'Thông tư số 01 Thông tư số 01 Thông tư số 01 Thông tư số 01 Thông tư số 01 Thông tư số 01 Thông tư số 01 Thông tư số 01 Thông tư số 01 Thông tư số 01 Thông tư số 01 Thông tư số 01', 'vbd_1460363583.doc', 3, NULL, 0, '2021-04-12', 'Xử lý theo thông tư', 'Phòng Kế Hoạch Tổng Hợp,Phòng Văn Thư,Phòng Hành Chính', 'Đỗ Minh Hoàng', 'sâsasa', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vanbandi`
--

CREATE TABLE `vanbandi` (
  `MaVB` int(11) NOT NULL,
  `TenVB` text NOT NULL,
  `SoHieu` int(11) NOT NULL,
  `KyHieu` tinytext NOT NULL,
  `NgayKy` date NOT NULL DEFAULT '0000-00-00',
  `NgayGoi` date NOT NULL DEFAULT '0000-00-00',
  `MaLVB` int(11) NOT NULL,
  `MucDoKhan` int(1) NOT NULL,
  `MucDoMat` int(1) NOT NULL,
  `MaNSD` int(11) NOT NULL,
  `NoiDung` text NOT NULL,
  `TailieuDinhKem` text,
  `CVDiTheoDuong` int(1) NOT NULL,
  `TenNV` tinytext,
  `CQNhan` text,
  `LanhDaoDuyet` tinytext,
  `NoiDungDuyet` text,
  `MaBM` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vanbandi`
--

INSERT INTO `vanbandi` (`MaVB`, `TenVB`, `SoHieu`, `KyHieu`, `NgayKy`, `NgayGoi`, `MaLVB`, `MucDoKhan`, `MucDoMat`, `MaNSD`, `NoiDung`, `TailieuDinhKem`, `CVDiTheoDuong`, `TenNV`, `CQNhan`, `LanhDaoDuyet`, `NoiDungDuyet`, `MaBM`) VALUES
(3, 'Quyết định nâng lương 12', 2, 'TT/2020', '2020-04-26', '2020-04-29', 1, 1, 1, 1, 'sadasdasd    ', 'vbdi_1461652177.xls', 1, NULL, 'UBND Quận Ô Môn, Quận Ủy Quận Ô Môn, Ban Chỉ Huy Quân Sự Quận Ô Môn, Công An Nhân Dân Quận Ô Môn', 'Quản Trị Hệ Thống', 'dasdasdasda', 11),
(4, 'dwdsadsadsa', 6, 'QD/2016/DU', '2023-02-26', '2023-02-26', 4, 1, 1, 1, 'saddsadsadas', 'vbdi_1461652290.xls', 2, 'dasdsad', 'Trường đại học Sư Phạm, Trường đại học Kinh Tế - Luật, Trường đại học Bách Khoa', 'Nguyễn Ngọc Uyên', 'dasddsadsa', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vanbannoibo`
--

CREATE TABLE `vanbannoibo` (
  `MaVB` int(11) NOT NULL,
  `TenVB` text NOT NULL,
  `SoHieu` int(11) NOT NULL,
  `KyHieu` tinytext NOT NULL,
  `NgayKy` date NOT NULL DEFAULT '0000-00-00',
  `NgayLuu` date DEFAULT '0000-00-00',
  `MaLVB` int(11) NOT NULL,
  `MaNSD` int(11) NOT NULL,
  `NoiDung` text NOT NULL,
  `TailieuDinhKem` text,
  `PBNhan` text,
  `LanhDaoDuyet` tinytext,
  `NoiDungDuyet` text,
  `Xoa` int(1) DEFAULT NULL,
  `NgayXoa` datetime DEFAULT NULL,
  `TaiKhoanXoa` varchar(25) DEFAULT NULL,
  `MaBM` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vanbannoibo`
--

INSERT INTO `vanbannoibo` (`MaVB`, `TenVB`, `SoHieu`, `KyHieu`, `NgayKy`, `NgayLuu`, `MaLVB`, `MaNSD`, `NoiDung`, `TailieuDinhKem`, `PBNhan`, `LanhDaoDuyet`, `NoiDungDuyet`, `Xoa`, `NgayXoa`, `TaiKhoanXoa`, `MaBM`) VALUES
(3, 'Quyết định nâng lương 1', 2, 'QĐ', '2021-03-26', '2021-03-26', 4, 2, 'Quyết định nâng lương 1', NULL, 'Phòng Kế Hoạch Tổng Hợp, Phòng Hành Chính, Phòng Văn Thư', 'Đỗ Minh Hoàng', 'Duyệt nâng lương', NULL, NULL, NULL, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bieumau`
--
ALTER TABLE `bieumau`
  ADD PRIMARY KEY (`MaBM`);

--
-- Indexes for table `chucvu`
--
ALTER TABLE `chucvu`
  ADD PRIMARY KEY (`MaCV`);

--
-- Indexes for table `coquan`
--
ALTER TABLE `coquan`
  ADD PRIMARY KEY (`MaCQ`);

--
-- Indexes for table `groupusers`
--
ALTER TABLE `groupusers`
  ADD PRIMARY KEY (`idGr`);

--
-- Indexes for table `loaivanban`
--
ALTER TABLE `loaivanban`
  ADD PRIMARY KEY (`MaLVB`);

--
-- Indexes for table `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`MaNSD`);

--
-- Indexes for table `phongban`
--
ALTER TABLE `phongban`
  ADD PRIMARY KEY (`MaPB`);

--
-- Indexes for table `vanbanden`
--
ALTER TABLE `vanbanden`
  ADD PRIMARY KEY (`MaVB`);

--
-- Indexes for table `vanbandi`
--
ALTER TABLE `vanbandi`
  ADD PRIMARY KEY (`MaVB`);

--
-- Indexes for table `vanbannoibo`
--
ALTER TABLE `vanbannoibo`
  ADD PRIMARY KEY (`MaVB`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bieumau`
--
ALTER TABLE `bieumau`
  MODIFY `MaBM` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `chucvu`
--
ALTER TABLE `chucvu`
  MODIFY `MaCV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `coquan`
--
ALTER TABLE `coquan`
  MODIFY `MaCQ` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `groupusers`
--
ALTER TABLE `groupusers`
  MODIFY `idGr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `loaivanban`
--
ALTER TABLE `loaivanban`
  MODIFY `MaLVB` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `MaNSD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `phongban`
--
ALTER TABLE `phongban`
  MODIFY `MaPB` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `vanbanden`
--
ALTER TABLE `vanbanden`
  MODIFY `MaVB` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `vanbandi`
--
ALTER TABLE `vanbandi`
  MODIFY `MaVB` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `vanbannoibo`
--
ALTER TABLE `vanbannoibo`
  MODIFY `MaVB` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
