-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2023 at 05:50 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmacy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_credentials`
--

CREATE TABLE `admin_credentials` (
  `USERNAME` varchar(50) COLLATE utf16_bin NOT NULL,
  `PASSWORD` varchar(50) COLLATE utf16_bin NOT NULL,
  `TYPE` varchar(50) COLLATE utf16_bin NOT NULL,
  `IS_LOGGED_IN` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `admin_credentials`
--

INSERT INTO `admin_credentials` (`USERNAME`, `PASSWORD`, `TYPE`, `IS_LOGGED_IN`) VALUES
('admin', 'admin123', 'admin', 0),
('ismail', 'ismail123', 'admin', 0),
('sabirali', 'sabiraliman', 'manager', 0),
('zainbabar', 'zainsales', 'salesperson', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(20) COLLATE utf16_bin NOT NULL,
  `CONTACT_NUMBER` varchar(10) COLLATE utf16_bin NOT NULL,
  `ADDRESS` varchar(100) COLLATE utf16_bin NOT NULL,
  `EMAIL` varchar(20) COLLATE utf16_bin NOT NULL,
  `GENDER` varchar(10) COLLATE utf16_bin NOT NULL,
  `DOCTOR_NAME` varchar(20) COLLATE utf16_bin NOT NULL,
  `DOCTOR_ADDRESS` varchar(100) COLLATE utf16_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`ID`, `NAME`, `CONTACT_NUMBER`, `ADDRESS`, `EMAIL`, `GENDER`, `DOCTOR_NAME`, `DOCTOR_ADDRESS`) VALUES
(4, 'Kiran Malik', '1123456789', 'Street 1 City Islamabad ', 'Kiran123@gmail.com', 'Female', 'Dr Abc', 'Sdg Gh Fh Fghgg'),
(6, 'Malik Abrar', '2349874561', 'Johar Town', 'Abrar@123.com', 'Male', 'Dr Amna', 'Strt 1,city Abc'),
(11, 'Waqas Khan', '0334567812', 'Wah Cantt,phase 3,strt 1', 'wqas123@gmail.com', 'Male', 'Dr Zeeshan', 'Wah Cantt,phaase 3,strt 1'),
(13, 'Jhan Dad Khan', '0345781342', 'Taxila Station,strt 5', 'Jhan45@gmail.com', 'Male', 'Dr Ali', 'Taxila Station'),
(14, 'Qasim Khan', '0357892451', 'Ghora Chowk,Hassan Colony', 'Qasim34@gmail.com', 'Male', 'Dr Nazish Knwal', 'Faisal Hills,Gt Road '),
(17, 'Aqsa Fareed', '0345234654', 'Street 123 City Islamabad', 'aqsa123@gmail.com', 'Female', 'Dr Naveed', 'Street 456 City Islamabad'),
(20, 'Qwerty', '1234567890', 'Adsf Dfgef Fg', 'qwerty@gmail.com', 'female', 'Dr Sajid', 'Dfrg Dfr Dfge'),
(21, 'Ahmed Siddiqui', '0336001234', 'Murad Abad Colony,peer Shah Road ', 'ahmad@gmail.com', 'male', 'Dr Irfan ', 'Basti Cantt Wah');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `ID` int(11) NOT NULL,
  `INVOICE_ID` int(11) NOT NULL,
  `PRODUCT_ID` int(11) NOT NULL,
  `NET_TOTAL` double NOT NULL DEFAULT 0,
  `INVOICE_DATE` date NOT NULL DEFAULT current_timestamp(),
  `CUSTOMER_ID` int(11) NOT NULL,
  `TOTAL_AMOUNT` double NOT NULL,
  `TOTAL_DISCOUNT` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`ID`, `INVOICE_ID`, `PRODUCT_ID`, `NET_TOTAL`, `INVOICE_DATE`, `CUSTOMER_ID`, `TOTAL_AMOUNT`, `TOTAL_DISCOUNT`) VALUES
(1, 1, 1, 30, '2021-10-19', 14, 30, 0),
(2, 2, 2, 2626, '2021-10-19', 6, 2626, 0),
(3, 3, 4, 5146.96, '2023-07-22', 4, 5252, 105.04),
(4, 4, 5, 29.7, '2023-07-22', 4, 30, 0.3),
(5, 5, 1, 15, '2023-07-22', 4, 15, 0),
(6, 6, 6, 15, '2023-07-22', 4, 15, 0),
(7, 7, 5, 15, '2023-07-22', 4, 15, 0),
(8, 8, 2, 2626, '2023-07-22', 4, 2626, 0),
(9, 9, 4, 2626, '2023-07-22', 4, 2626, 0),
(10, 10, 1, 2626, '2023-07-22', 4, 2626, 0),
(11, 11, 6, 45, '2023-07-24', 6, 45, 0),
(12, 12, 2, 333, '2023-08-18', 6, 333, 0),
(13, 13, 4, 55, '2023-08-18', 6, 55, 0),
(14, 14, 5, 32.01, '2023-08-19', 6, 33, 0.99),
(15, 15, 2, 219.78, '2023-08-19', 6, 222, 2.22),
(16, 16, 1, 109.89, '2023-08-19', 6, 111, 1.11),
(17, 17, 5, 24, '2023-08-19', 4, 24, 0),
(18, 18, 4, 33.78, '2023-08-19', 17, 34, 0.22),
(19, 19, 6, 12, '2023-08-19', 17, 12, 0),
(20, 20, 5, 34, '2023-08-19', 14, 34, 0),
(21, 21, 0, 30.69, '2023-08-20', 11, 31, 0.31),
(22, 22, 0, 140, '2023-08-20', 4, 140, 0),
(23, 23, 0, 22, '2023-08-20', 13, 22, 0),
(24, 24, 4, 55, '2023-08-20', 13, 55, 0),
(25, 25, 4, 22, '2023-08-20', 13, 22, 0),
(26, 26, 2, 46, '2023-08-20', 13, 46, 0),
(27, 27, 2, 12, '2023-08-20', 14, 12, 0),
(28, 28, 2, 12, '2023-08-20', 11, 12, 0),
(29, 29, 5, 20, '2023-08-20', 6, 20, 0),
(30, 30, 4, 22, '2023-08-20', 4, 22, 0),
(31, 31, 4, 11, '2023-08-20', 20, 11, 0),
(32, 32, 4, 11, '2023-08-20', 11, 11, 0),
(33, 33, 4, 11, '2023-08-20', 11, 11, 0),
(34, 34, 4, 11, '2023-08-20', 11, 11, 0),
(35, 35, 4, 11, '2023-08-20', 14, 11, 0),
(36, 36, 4, 22, '2023-08-20', 11, 22, 0),
(37, 37, 5, 73.96, '2023-08-20', 14, 75, 1.04),
(38, 38, 2, 45, '2023-08-20', 13, 45, 0),
(39, 39, 2, 33.77, '2023-08-20', 13, 34, 0.22999999999999998),
(40, 40, 1, 22, '2023-08-20', 17, 22, 0),
(44, 0, 2, 23, '2023-08-20', 14, 23, 0),
(45, 41, 1, 11, '2023-08-20', 14, 11, 0),
(46, 42, 4, 11, '2023-08-20', 11, 11, 0),
(47, 43, 1, 21.89, '2023-08-20', 17, 22, 0.11),
(48, 44, 1, 42, '2023-08-20', 4, 42, 0),
(49, 45, 5, 20, '2023-08-20', 6, 20, 0),
(50, 46, 2, 22.869, '2023-08-20', 14, 23, 0.131),
(51, 47, 1, 32.945, '2023-08-21', 14, 33, 0.05500000000000001),
(52, 48, 2, 58, '2023-08-21', 14, 58, 0),
(53, 49, 1, 35, '2023-08-21', 14, 35, 0),
(54, 50, 1, 35, '2023-08-21', 14, 35, 0);

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `PRODUCT_ID` int(11) NOT NULL,
  `NAME` varchar(100) COLLATE utf16_bin NOT NULL,
  `PACKING` varchar(20) COLLATE utf16_bin NOT NULL,
  `GENERIC_NAME` varchar(100) COLLATE utf16_bin NOT NULL,
  `PRODUCT_TYPE` varchar(100) COLLATE utf16_bin DEFAULT NULL,
  `STRENGTH` varchar(100) COLLATE utf16_bin DEFAULT NULL,
  `PRICE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`PRODUCT_ID`, `NAME`, `PACKING`, `GENERIC_NAME`, `PRODUCT_TYPE`, `STRENGTH`, `PRICE`) VALUES
(1, 'Nicip Plus', '10tab', 'Paracetamole', 'Tablet', '500mg', 10),
(2, 'Amoxicillin ', '10tab', 'Hdsgvkvajkcbja', 'Syrup', '200mg', 20),
(4, 'Morphine', '15tab', 'paracetamole', 'Injection', '15 mg', 45),
(5, 'Acetaminophen', '10tab', 'mint fla', 'tablet/capsule', '500mg', 25),
(12, 'Paracetamol', '152bl', 'paracetamol', 'Tablet', '250mg', 20),
(13, 'Rigix', '125kb', 'rigixa', 'tablet', '120mg', 20),
(14, 'Brufin', '134ls', 'brufin', 'Syrup', '200mg', 0),
(15, 'Augmentin', 'Bottle of 100ml', 'Amoxicillin', 'Liquid', '125mg/5ml', 25),
(16, 'Ventolin', 'Inhaler', 'Albuterol', 'Inhaler', '100mcg', 15),
(17, 'Omeprazole', 'Box of 30 capsules', 'Omeprazole', 'Capsule', '20mg', 5);

-- --------------------------------------------------------

--
-- Table structure for table `medicines_stock`
--

CREATE TABLE `medicines_stock` (
  `ID` int(11) NOT NULL,
  `PRODUCT_ID` int(11) DEFAULT NULL,
  `NAME` varchar(100) COLLATE utf16_bin DEFAULT NULL,
  `EXPIRY_DATE` date DEFAULT NULL,
  `BATCH_ID` varchar(100) COLLATE utf16_bin DEFAULT NULL,
  `QUANTITY` int(11) DEFAULT NULL,
  `MRP` double DEFAULT NULL,
  `RATE` double DEFAULT NULL,
  `MIN_STOCK_LVL` int(11) DEFAULT NULL,
  `MAX_STOCK_LVL` int(11) DEFAULT NULL,
  `STOCK_IN_DATE` date DEFAULT NULL,
  `SUPPLIER_NAME` varchar(100) COLLATE utf16_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `medicines_stock`
--

INSERT INTO `medicines_stock` (`ID`, `PRODUCT_ID`, `NAME`, `EXPIRY_DATE`, `BATCH_ID`, `QUANTITY`, `MRP`, `RATE`, `MIN_STOCK_LVL`, `MAX_STOCK_LVL`, `STOCK_IN_DATE`, `SUPPLIER_NAME`) VALUES
(22, 1, 'Nicip Plus', '2023-08-24', 'PAF2023-002', 19, 11, 11, 11, 12, '2023-08-17', 'Kiran Pharma'),
(24, 2, 'Amoxicillin ', '2023-08-25', 'PAF/2022/003', 44, 12, 12, 12, 13, '2023-08-18', 'Tahir Khan'),
(25, 4, 'Morphine', '2023-08-18', 'PAF/2022/005', 40, 11, 10, 0, 3, '2023-08-18', 'ALi PHARMA'),
(29, 5, 'Acetaminophen', '2024-01-20', 'PAF/2022/003', 2, 20, 10, 5, 10, '2023-08-19', 'Kamran Khan'),
(42, 12, 'Paracetamol', '2024-05-23', 'PAR2022-123', 10, 20, 10, 10, 100, '2023-08-21', 'Ramish Waseem'),
(43, 13, 'Rigix', '2024-05-23', 'RIG2023-789', 30, 20, 10, 10, 80, '2023-08-21', 'Sulieman Amad'),
(44, 14, 'Brufin', '2024-05-23', 'BRU2022-456', 30, 60, 40, 10, 50, '2023-08-21', 'Tahir Khan'),
(45, 15, 'Augmentin', '2024-03-20', 'PAR2023-145', 20, 25, 3, 10, 30, '2023-08-21', 'Kamran Khan'),
(46, 16, 'Ventolin', '2024-03-22', 'PAR2023-545', 30, 15, 9, 10, 30, '2023-08-21', 'Sulieman Amad'),
(47, 17, 'Omeprazole', '2024-03-22', 'PAR2023-945', 30, 5, 4, 10, 30, '2023-08-21', 'Sulieman Amad');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `ID` int(11) NOT NULL,
  `SUPPLIER_NAME` varchar(100) COLLATE utf16_bin NOT NULL,
  `INVOICE_NUMBER` int(11) NOT NULL,
  `PURCHASE_DATE` varchar(10) COLLATE utf16_bin NOT NULL,
  `TOTAL_AMOUNT` double NOT NULL,
  `PAYMENT_STATUS` varchar(20) COLLATE utf16_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`ID`, `SUPPLIER_NAME`, `INVOICE_NUMBER`, `PURCHASE_DATE`, `TOTAL_AMOUNT`, `PAYMENT_STATUS`) VALUES
(1, 'Ahmad Khan', 1, '12/23', 500, 'DUE'),
(2, 'Desai Pharma', 2, '2023-08-16', 15, 'PAID'),
(3, 'Kiran Pharma', 3, '2023-08-16', 1100, 'PAID'),
(4, 'ALi PHARMA', 4, '2023-08-16', 1250, 'PAID'),
(5, 'Kiran Pharma', 5, '2023-08-17', 10, 'PAID'),
(6, 'Kiran Pharma', 6, '2023-08-17', 10, 'PAID'),
(7, 'Kiran Pharma', 7, '2023-08-17', 15, 'PAID'),
(8, 'Kiran Pharma', 8, '2023-08-17', 24, 'PAID'),
(9, 'ALi PHARMA', 9, '2023-08-17', 30, 'PAID'),
(10, 'ALi PHARMA', 10, '2023-08-17', 25, 'PAID'),
(11, 'Kiran Pharma', 11, '2023-08-17', 15, 'PAID'),
(12, 'Kiran Pharma', 12, '2023-08-17', 36, 'PAID'),
(13, 'Kiran Pharma', 13, '2023-08-17', 20, 'PAID'),
(14, 'Kiran Pharma', 14, '2023-08-17', 25, 'PAID'),
(15, 'Kiran Pharma', 15, '2023-08-17', 25, 'PAID'),
(16, 'Kiran Pharma', 16, '2023-08-17', 36, 'PAID'),
(17, 'Kiran Pharma', 17, '2023-08-18', 110, 'PAID'),
(18, 'Kiran Pharma', 18, '2023-08-18', 132, 'PAID'),
(19, 'Kiran Pharma', 19, '2023-08-18', 60, 'PAID'),
(20, 'Kiran Pharma', 20, '2023-08-18', 25, 'PAID'),
(21, 'Kiran Pharma', 21, '2023-08-18', 50, 'PAID'),
(22, 'ALi PHARMA', 22, '2023-08-18', 120, 'PAID'),
(23, 'Avceve', 23, '2023-08-18', 49, 'PAID'),
(24, 'Kiran Pharma', 24, '2023-08-18', 6, 'PAID'),
(25, 'ALi PHARMA', 25, '2023-08-18', 110, 'PAID'),
(26, 'ALi PHARMA', 26, '2023-08-18', 45, 'PAID'),
(27, 'chaudry ali', 27, '2023-08-18', 32, 'PAID'),
(28, 'd', 28, '2023-08-18', 36, 'PAID'),
(29, 'Kiran Pharma', 29, '2023-08-19', 10, 'PAID'),
(30, 'trt', 30, '2023-08-20', 36, 'PAID'),
(31, 'Sulieman Amad', 31, '2023-08-20', 30, 'PAID'),
(32, 'Ahmad Pharma', 32, '2023-08-19', 16, 'PAID'),
(33, 'Sulieman Amad', 33, '2023-08-19', 49, 'PAID'),
(34, 'Ramish Waseem', 34, '2023-08-21', 450, 'DUE'),
(35, 'Tahir Khan', 35, '2023-08-21', 160, 'PAID'),
(36, 'Ahmad Pharma', 36, '2023-08-21', 105, 'PAID'),
(37, 'Sulieman Amad', 37, '2023-08-21', 44, 'PAID'),
(45, 'Ramish Waseem', 0, '2023-08-21', 50, 'PAID');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `ID` int(11) NOT NULL,
  `INVOICE_ID` int(11) NOT NULL,
  `CUSTOMER_ID` int(11) NOT NULL,
  `PRODUCT_ID` int(11) NOT NULL,
  `QUANTITY` int(11) DEFAULT NULL,
  `DISCOUNT` double DEFAULT NULL,
  `TOTAL` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`ID`, `INVOICE_ID`, `CUSTOMER_ID`, `PRODUCT_ID`, `QUANTITY`, `DISCOUNT`, `TOTAL`) VALUES
(1, 0, 17, 0, 1, 0, 12),
(2, 20, 14, 12, 14, 0, 12),
(4, 21, 11, 14, 20, 1, 10.89),
(6, 22, 4, 13, 5, 0, 140),
(7, 23, 13, 12, 11, 0, 22),
(8, 24, 13, 0, 2, 0, 22),
(10, 25, 13, 5, 8, 0, 22),
(11, 26, 13, 0, 2, 0, 22),
(13, 27, 14, 12, 10, 0, 12),
(14, 29, 6, 5, 20, 0, 20),
(15, 30, 4, 1, 30, 0, 22),
(16, 31, 20, 4, 1, 0, 11),
(17, 32, 11, 4, 1, 0, 11),
(18, 33, 11, 4, 1, 0, 11),
(19, 34, 11, 4, 1, 0, 11),
(20, 35, 14, 4, 1, 0, 11),
(21, 36, 11, 4, 2, 0, 22),
(22, 37, 14, 4, 2, 1, 21.78),
(23, 37, 14, 1, 24, 2, 32.34),
(24, 37, 14, 5, 13, 0.8, 19.84),
(25, 38, 13, 4, 3, 0, 33),
(26, 38, 13, 2, 17, 0, 12),
(27, 39, 13, 4, 30, 0.5, 21.89),
(28, 39, 13, 2, 20, 1, 11.88),
(29, 40, 17, 4, 20, 0, 11),
(30, 40, 17, 1, 1, 0, 11),
(35, 41, 14, 4, 1, 0, 11),
(38, 42, 11, 4, 1, 0, 11),
(39, 43, 17, 4, 1, 1, 10.89),
(40, 43, 17, 1, 1, 0, 11),
(41, 44, 4, 4, 1, 0, 11),
(42, 44, 4, 5, 1, 0, 20),
(43, 44, 4, 1, 1, 0, 11),
(44, 45, 6, 5, 1, 0, 20),
(45, 46, 14, 4, 1, 0.1, 10.989),
(46, 46, 14, 2, 1, 1, 11.88),
(47, 47, 14, 4, 1, 0.1, 10.989),
(48, 47, 14, 1, 2, 0.2, 21.956),
(49, 48, 14, 1, 2, 0, 22),
(50, 48, 14, 2, 3, 0, 36),
(51, 49, 14, 2, 2, 0, 24),
(52, 49, 14, 1, 1, 0, 11),
(53, 50, 14, 2, 2, 0, 24),
(54, 50, 14, 1, 1, 0, 11);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(100) COLLATE utf16_bin NOT NULL,
  `EMAIL` varchar(100) COLLATE utf16_bin NOT NULL,
  `CONTACT_NUMBER` varchar(10) COLLATE utf16_bin NOT NULL,
  `ADDRESS` varchar(100) COLLATE utf16_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`ID`, `NAME`, `EMAIL`, `CONTACT_NUMBER`, `ADDRESS`) VALUES
(1, 'Ahmad Pharma', 'ahmad@gmail.com', '0348724242', 'Kohistan Enclave'),
(2, 'ALi PHARMA', 'ali@gmail.com', '0336791478', 'Faisal Hill,Taxila'),
(9, 'Sulieman Amad', 'suleiman35@gmail.com', '7638683637', ' Wah Cantt'),
(10, 'Kamran Khan', 'Kami56@gmail.com', '3737355538', 'RawalPindi '),
(11, 'Ramish Waseem', 'Ramish@gmail.com', '0367891592', 'CDA B17'),
(12, 'SS Distributors', 'ssdis@gamil.com', '3867868752', 'MargallahHills '),
(13, 'Tahir Khan', 'TahirK@gmail.com', '0346662622', 'Basti,wah cantt');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `USERNAME` varchar(20) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL,
  `USER_TYPE` varchar(20) NOT NULL,
  `ADDRESS` varchar(100) NOT NULL,
  `EMAIL` varchar(20) NOT NULL,
  `CONTACT_NUMBER` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `USERNAME`, `PASSWORD`, `USER_TYPE`, `ADDRESS`, `EMAIL`, `CONTACT_NUMBER`) VALUES
(1, 'admin', 'admin123', 'admin', 'House 4 Street 9 ', 'admin@gmail.com', '03333519702'),
(13, 'danyalowner', 'danyal123', 'admin', 'House 3 street Dhok Ali Akbar, Rawalpindi - Sadiqabad, Punjab', 'danyalchowdary@gmail', '03365554673'),
(14, 'zainbabar', 'zainsales', 'salesperson', 'Street 9 Kurri Road Area', 'zain199@gmail.com', '03244535347'),
(15, 'sabirali', 'sabiraliman', 'manager', 'Street 16 wah Taxila', 'sabiraliofficial@gma', '03546789532');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_credentials`
--
ALTER TABLE `admin_credentials`
  ADD PRIMARY KEY (`USERNAME`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`PRODUCT_ID`);

--
-- Indexes for table `medicines_stock`
--
ALTER TABLE `medicines_stock`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `INVOICE_ID` (`INVOICE_ID`,`CUSTOMER_ID`,`PRODUCT_ID`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `PRODUCT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `medicines_stock`
--
ALTER TABLE `medicines_stock`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
