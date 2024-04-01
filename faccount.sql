-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2024 at 06:10 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `faccount`
--

-- --------------------------------------------------------

--
-- Table structure for table `agusipan_report`
--

CREATE TABLE `agusipan_report` (
  `ID` int(255) NOT NULL,
  `farm_name` varchar(255) NOT NULL,
  `week_report` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `agutayan_report`
--

CREATE TABLE `agutayan_report` (
  `ID` int(255) NOT NULL,
  `farm_name` varchar(255) NOT NULL,
  `week_report` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bagumbayan_report`
--

CREATE TABLE `bagumbayan_report` (
  `ID` int(255) NOT NULL,
  `farm_name` varchar(255) NOT NULL,
  `week_report` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bagumbayan_report`
--

INSERT INTO `bagumbayan_report` (`ID`, `farm_name`, `week_report`, `date`) VALUES
(3, 'sugar farm', 'usfnae8yct8t4o8eab7aynsd', '2023-11-07'),
(4, 'berryls', 'afcaegaff', '2023-12-15');

-- --------------------------------------------------------

--
-- Table structure for table `balabag_report`
--

CREATE TABLE `balabag_report` (
  `ID` int(255) NOT NULL,
  `farm_name` varchar(255) NOT NULL,
  `week_report` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `balabag_report`
--

INSERT INTO `balabag_report` (`ID`, `farm_name`, `week_report`, `date`) VALUES
(2, 'eggplantation', 'somjg89eya87ey498wy 8ey a894y', '2023-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `banan_report`
--

CREATE TABLE `banan_report` (
  `ID` int(255) NOT NULL,
  `farm_name` varchar(255) NOT NULL,
  `week_report` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brgy_location`
--

CREATE TABLE `brgy_location` (
  `ID` int(255) NOT NULL,
  `barangay_location` varchar(255) NOT NULL DEFAULT 'Agusipan',
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brgy_location`
--

INSERT INTO `brgy_location` (`ID`, `barangay_location`, `lat`, `lng`) VALUES
(6, 'Agusipan', '10.811595', '122.561754'),
(7, 'Agutayan', '10.813321', '122.541285'),
(8, 'Bagumbayan', '10.844903', '122.524328'),
(9, 'Balabag', '10.769356', '122.505904\r\n'),
(10, 'Balibagan Este', '10.797742', '122.517131'),
(11, 'Balibagan Oeste', '10.806254', '122.513109'),
(12, 'Ban-ag', '10.849964', '122.544401'),
(13, 'Bantay', '10.870740', '122.535960'),
(14, 'Barangay Zone I (Poblacion)', '10.825794', '122.530244'),
(15, 'Barangay Zone II (Poblacion)', '10.829373', '122.535037'),
(16, 'Barangay Zone III (Poblacion)', '10.823446', '122.532078'),
(17, 'Barangay Zone IV (Poblacion)', '10.826445', '122.536227'),
(18, 'Barangay Zone V (Poblacion)', '10.823059', '122.535082'),
(19, 'Barangay Zone VI (Poblacion)', '10.820131', '122.541111'),
(20, 'Barasan Este', '10.827628', '122.564187'),
(21, 'Barasan Oeste', '10.855918', '122.551906'),
(22, 'Binangkilan', '10.835139', '122.574143'),
(23, 'Bitaog-Taytay', '10.829550', '122.592005'),
(24, 'Bolong Este', '10.809211', '122.532928'),
(25, 'Bolong Oeste', '10.816553', '122.532726'),
(26, 'Buayahon', '10.858587', '122.539712'),
(27, 'Buyo', '10.783235', '122.504657'),
(28, 'Cabugao Norte', '10.799919', '122.543211'),
(29, 'Cabugao Sur', '10.802042', '122.531064'),
(30, 'Cadagmayan Norte', '10.822353', '122.511193'),
(31, 'Cadagmayan Sur', '10.813247', '122.498783'),
(32, 'Cafe', '10.835707', '122.562630'),
(33, 'Calaboa Este', '10.815366', '122.580740'),
(34, 'Calaboa Oeste', '10.809587', '122.569611'),
(35, 'Camambugan', '10.833166', '122.515689'),
(36, 'Canipayan', '10.821186', '122.574904'),
(37, 'Conaynay', '10.820103', '122.586794'),
(38, 'Daga', '10.851085', '122.562786'),
(39, 'Dalid', '10.843788', '122.550462'),
(40, 'Duyanduyan', '10.834294', '122.524423'),
(41, 'Gen. Martin T. Delgado', '10.833496', '122.530041'),
(42, 'Guno', '10.839688', '122.544126'),
(43, 'Inangayan', '10.812235', '122.523429'),
(44, 'Jibao-an', '10.775622', '122.501744'),
(45, 'Lacadon', '10.853127', '122.529623'),
(46, 'Lanag', '10.831728', '122.546967'),
(47, 'Lupa', '10.806845', '122.550106'),
(48, 'Magancina', '10.813960', '122.595094'),
(49, 'Malawog', '10.804081', '122.500002'),
(50, 'Mambuyo', '10.827517', '122.583902'),
(51, 'Manhayang', '10.845499', '122.535623'),
(52, 'Miraga-Guibuangan', '10.822555', '122.550521'),
(53, 'Nasugban', '10.809372', '122.506059'),
(54, 'Omambog', '10.834640', '122.588000'),
(55, 'Pal-agon', '10.787441', '122.516994'),
(56, 'Pungsod', '10.858232', '122.547235'),
(57, 'San Sebastian', '10.822670', '122.521500'),
(58, 'Sangcate', '10.839901', '122.529412'),
(59, 'Tagsing', '10.789279', '122.503787'),
(60, 'Talanghauan', '10.842557', '122.518538'),
(61, 'Talongadian', '10.781327', '122.496164'),
(62, 'Tigtig', '10.821568', '122.563134'),
(63, 'Tungay', '10.835866', '122.535395'),
(64, 'Tuburan', '10.822314', '122.596623'),
(65, 'Tugas', '10.863321', '122.529756');

-- --------------------------------------------------------

--
-- Table structure for table `crophistory`
--

CREATE TABLE `crophistory` (
  `ID` int(255) NOT NULL,
  `farm_name` varchar(255) NOT NULL,
  `crop_name` varchar(255) NOT NULL,
  `crop_history` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crophistory`
--

INSERT INTO `crophistory` (`ID`, `farm_name`, `crop_name`, `crop_history`) VALUES
(39, 'Farmro', 'Rice', '2024-03-18'),
(40, '', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `crop_list`
--

CREATE TABLE `crop_list` (
  `ID` int(255) NOT NULL,
  `farm_n` varchar(255) NOT NULL DEFAULT '',
  `crop_name` varchar(255) NOT NULL DEFAULT '''rice''',
  `date_planted` date NOT NULL,
  `crop_history` date NOT NULL,
  `crop_status` text NOT NULL DEFAULT '\'seedling\'',
  `crop_lat` double NOT NULL,
  `crop_lng` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crop_list`
--

INSERT INTO `crop_list` (`ID`, `farm_n`, `crop_name`, `date_planted`, `crop_history`, `crop_status`, `crop_lat`, `crop_lng`) VALUES
(34, 'FarmVille', 'Rice', '2024-03-13', '0000-00-00', 'sprouting', 10.810473166449876, 122.56296577151409),
(35, 'Gardener', 'String Beans', '2024-01-30', '0000-00-00', 'seedling', 10.850365477920635, 122.54500144650837),
(36, 'Farmro', 'Rice', '2024-03-14', '0000-00-00', 'seedling', 10.845277423381159, 122.52433770320872),
(37, 'REX FARM', 'Sweet Potato', '2024-03-14', '0000-00-00', 'seedling', 10.813910097823298, 122.54295103922347),
(38, 'REX FARM', 'Sweet Potato', '2024-03-14', '2024-03-28', 'seedling', 10.813910097823298, 122.54295103922347);

-- --------------------------------------------------------

--
-- Table structure for table `crop_list_encode`
--

CREATE TABLE `crop_list_encode` (
  `ID` int(255) NOT NULL,
  `crop_name` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `date_received` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crop_list_encode`
--

INSERT INTO `crop_list_encode` (`ID`, `crop_name`, `quantity`, `date_received`) VALUES
(16, 'rice', 100, '2024-03-18'),
(17, 'rice', 100, '2024-03-18'),
(18, 'rice', 23, '2024-03-18'),
(19, 'rice', 23, '2024-03-18'),
(20, 'ALugbati', 0, '0000-00-00'),
(21, 'Corn', 0, '0000-00-00'),
(23, 'Water Spinach', 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `crop_status_icons`
--

CREATE TABLE `crop_status_icons` (
  `ID` int(255) NOT NULL,
  `crop_status` varchar(255) NOT NULL,
  `icon_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crop_status_icons`
--

INSERT INTO `crop_status_icons` (`ID`, `crop_status`, `icon_url`) VALUES
(1, 'seedling', 'https://www.dropbox.com/scl/fi/55dqr08byxr1u2j33kks7/seedling.jpg?rlkey=pk3w49eoore49jtryfsdy4g8z&dl=0'),
(2, 'sprouting', 'https://www.dropbox.com/scl/fi/adhcmw81wwhbwrt44ycjv/sprouting.jpg?rlkey=wsj4p4s70sj99l77jxbmom5jf&dl=0'),
(3, 'ripening', 'https://www.dropbox.com/scl/fi/7rnfeb8u2a3oilvgmk9i8/ripening.jpg?rlkey=w3dujhj7ebfhrbaox9xxlcbdw&dl=0'),
(4, 'harvesting', 'https://www.dropbox.com/scl/fi/paprq4kqrf5hrf0ofmo91/harvesting.jpg?rlkey=mfpogqv9y3k82mrers4gqaun8&dl=0');

-- --------------------------------------------------------

--
-- Table structure for table `distribute`
--

CREATE TABLE `distribute` (
  `ID` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `cropseed_n` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `farmer_acc`
--

CREATE TABLE `farmer_acc` (
  `ID` int(255) NOT NULL,
  `f_lastname` text NOT NULL,
  `f_firstname` text NOT NULL,
  `f_middlei` text NOT NULL,
  `age` int(255) NOT NULL,
  `sex` text NOT NULL,
  `contact` bigint(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `farm_n` varchar(255) NOT NULL,
  `status` text NOT NULL,
  `area` double NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farmer_acc`
--

INSERT INTO `farmer_acc` (`ID`, `f_lastname`, `f_firstname`, `f_middlei`, `age`, `sex`, `contact`, `barangay`, `farm_n`, `status`, `area`, `latitude`, `longitude`) VALUES
(21, 'Bolences', 'John Arvie', 'S', 22, 'male', 987546345, 'Agusipan', 'FarmVille', 'active', 4, 10.808112548571566, 122.56605567629924),
(22, 'Gelilang', 'Jynel', 'A', 22, 'male', 909654632, 'Bagumbayan', 'FarmVille', 'active', 7, 10.848649310578951, 122.52124779842356);

-- --------------------------------------------------------

--
-- Table structure for table `farmer_acc2`
--

CREATE TABLE `farmer_acc2` (
  `ID` int(255) NOT NULL,
  `f_lastname` text NOT NULL,
  `f_firstname` text NOT NULL,
  `f_middlei` text NOT NULL,
  `age` int(255) NOT NULL,
  `sex` text NOT NULL DEFAULT 'male',
  `farm_n` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `f_area` double NOT NULL,
  `barangay` varchar(255) NOT NULL DEFAULT 'Agusipan',
  `contact` bigint(11) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farmer_acc2`
--

INSERT INTO `farmer_acc2` (`ID`, `f_lastname`, `f_firstname`, `f_middlei`, `age`, `sex`, `farm_n`, `status`, `f_area`, `barangay`, `contact`, `latitude`, `longitude`) VALUES
(14, 'Bolences', 'John Arvie', 'S', 22, 'male', 'FarmVille', 'Active', 5, 'Agusipan', 876745687, 10.812833765756816, 122.56021918948284),
(16, 'Gelilang', 'Jynel', 'A', 22, 'male', 'corn farm', 'Active', 52, 'Ban-ag', 9847583276, 10.840249760331716, 122.5467180602779),
(19, 'Gardose', 'Justine', 'K', 23, 'male', 'Gardener', 'Active', 12, 'Agutayan', 9876554333, 10.811212278206641, 122.5402044571922),
(20, 'Faro', 'Jeriel', 'H', 24, 'male', 'Farmro', 'Active', 8, 'Bagumbayan', 9879089765, 10.848649310578951, 122.52056115291575),
(21, 'Bato', 'Delto', 'J', 26, 'male', 'BATO FARM', 'Active', 18, 'Balabag', 98755435463, 10.782167508253908, 122.5122565435279),
(22, 'Degobaton', 'Rex', 'J', 23, 'male', 'REX FARM', 'Active', 500, 'Agutayan', 9579473829, 10.812519037613113, 122.54338019266584);

-- --------------------------------------------------------

--
-- Table structure for table `tech_acc`
--

CREATE TABLE `tech_acc` (
  `ID` int(255) NOT NULL,
  `tname` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL DEFAULT 'sex',
  `tcontact` varchar(255) NOT NULL,
  `tdesignation` varchar(255) NOT NULL DEFAULT 'Agusipan',
  `role` varchar(255) NOT NULL DEFAULT 'admin',
  `tech_username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirm_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tech_acc`
--

INSERT INTO `tech_acc` (`ID`, `tname`, `age`, `sex`, `tcontact`, `tdesignation`, `role`, `tech_username`, `password`, `confirm_pass`) VALUES
(24, 'default', '1', 'male', '0987564432', 'Agusipan', 'admin', 'admin', 'admin', 'admin'),
(36, 'yokyok', '23', 'male', '09786753821', 'Ban-ag', 'technician', 'jynel', '12345', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agusipan_report`
--
ALTER TABLE `agusipan_report`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `agutayan_report`
--
ALTER TABLE `agutayan_report`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `bagumbayan_report`
--
ALTER TABLE `bagumbayan_report`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `balabag_report`
--
ALTER TABLE `balabag_report`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `banan_report`
--
ALTER TABLE `banan_report`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `brgy_location`
--
ALTER TABLE `brgy_location`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `crophistory`
--
ALTER TABLE `crophistory`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `crop_list`
--
ALTER TABLE `crop_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `crop_list_encode`
--
ALTER TABLE `crop_list_encode`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `crop_status_icons`
--
ALTER TABLE `crop_status_icons`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `distribute`
--
ALTER TABLE `distribute`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `farmer_acc`
--
ALTER TABLE `farmer_acc`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `farmer_acc2`
--
ALTER TABLE `farmer_acc2`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tech_acc`
--
ALTER TABLE `tech_acc`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agusipan_report`
--
ALTER TABLE `agusipan_report`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `agutayan_report`
--
ALTER TABLE `agutayan_report`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bagumbayan_report`
--
ALTER TABLE `bagumbayan_report`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `balabag_report`
--
ALTER TABLE `balabag_report`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `banan_report`
--
ALTER TABLE `banan_report`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brgy_location`
--
ALTER TABLE `brgy_location`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `crophistory`
--
ALTER TABLE `crophistory`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `crop_list`
--
ALTER TABLE `crop_list`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `crop_list_encode`
--
ALTER TABLE `crop_list_encode`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `crop_status_icons`
--
ALTER TABLE `crop_status_icons`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `distribute`
--
ALTER TABLE `distribute`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `farmer_acc`
--
ALTER TABLE `farmer_acc`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `farmer_acc2`
--
ALTER TABLE `farmer_acc2`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tech_acc`
--
ALTER TABLE `tech_acc`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
