-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2023 at 10:46 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data_web2`
--

-- --------------------------------------------------------

--
-- Table structure for table `action_group`
--

CREATE TABLE `action_group` (
  `action_group_ID` int(15) NOT NULL,
  `Name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `action_group`
--

INSERT INTO `action_group` (`action_group_ID`, `Name`) VALUES
(0, 'user'),
(1, 'Admin'),
(2, 'NhanVien');

-- --------------------------------------------------------

--
-- Table structure for table `action_table`
--

CREATE TABLE `action_table` (
  `action_group_ID` int(11) NOT NULL,
  `action_ID` int(11) NOT NULL,
  `Status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `action_table`
--

INSERT INTO `action_table` (`action_group_ID`, `action_ID`, `Status`) VALUES
(1, 3, 1),
(2, 1, 1),
(1, 2, 1),
(2, 3, 0),
(1, 1, 1),
(2, 2, 1),
(1, 4, 1),
(2, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`ID`, `Name`) VALUES
(1, 'Nike'),
(2, 'Blo'),
(4, 'Adidas'),
(5, 'Vans'),
(6, 'Reedbok'),
(7, 'New Balance');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `Product_ID` int(11) DEFAULT NULL,
  `User_ID` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`Product_ID`, `User_ID`, `Quantity`, `size`) VALUES
(3, 56, 1, 1),
(4, 56, 4, 2),
(2, 10, 2, 1),
(3, 10, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ID`, `Name`) VALUES
(1, 'Sneaker'),
(2, 'Boots'),
(4, 'Crocs'),
(5, 'Huaraches'),
(6, 'Oxfords'),
(7, 'Slippers'),
(8, 'Cleats');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('active','inactive','pending') NOT NULL,
  `user_type` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `OTP` varchar(6) NOT NULL,
  `picture` varchar(255) NOT NULL DEFAULT '',
  `token` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `username`, `email`, `phone`, `address`, `password`, `status`, `user_type`, `created_at`, `OTP`, `picture`, `token`) VALUES
(10, 'client3', 'dannguyen112003@gmail.com', '+84937488684', '12/3 Nguyen Hue Street', '123', 'active', 0, '2023-05-12 16:12:23', '555595', '', ''),
(46, 'client9', 'linhdan112003@gmail.com', '+84964908127', '54/4 Nguyen Binh Khiem', '1233', 'active', 0, '2023-05-12 10:56:44', '871564', '', ''),
(49, 'client3', 'tranmaianh31012003@gmail.com', '+84984715357', '524 XVNT Street', '1', 'active', 0, '2023-05-12 14:18:49', '746842', '', ''),
(56, 'Đan Nguyễn', 'linhdan11003@gmail.com', '+84986555899', '123 Le Duan Street', '', 'active', 0, '2023-05-13 13:26:53', '', 'https://lh3.googleusercontent.com/a/AGNmyxbE-6TP9JFaV58_t6eWXqX-bAlGmW3dGFA7q5m6=s96-c', '109703823040961170674'),
(57, 'Huỳnh Hàn Uyên', 'uyenlep0109@gmail.com', '+84964908123', '62/4 Ton Duc Thang Street', '', 'active', NULL, '2023-05-13 17:02:18', '', 'https://lh3.googleusercontent.com/a/AGNmyxYkuALXG7YjFyxNRcrrptY6iisbBMuU9VcUWu6IaA=s96-c', '108010203575969725631'),
(59, 'client2', 'dannguyen11022203@gmail.com', '+84961234412', 'Nguyen Binh Khiem Street / Quan 1 / HCMC', '1', 'active', 0, '2023-05-15 06:57:55', '827319', '', ''),
(61, 'abc', 'abc@gmail.com', '+84964908124', 'abc', 'abc', 'active', 0, '2023-05-15 09:07:29', '842927', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `myaction`
--

CREATE TABLE `myaction` (
  `action_ID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `myaction`
--

INSERT INTO `myaction` (`action_ID`, `Name`) VALUES
(1, 'QuanlySanPham'),
(2, 'QuanlyOrder'),
(3, 'QuanlyTaiKhoan'),
(4, 'Thongke');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ID` int(11) NOT NULL,
  `Customer_ID` int(11) NOT NULL,
  `BuyDate` date NOT NULL,
  `Status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ID`, `Customer_ID`, `BuyDate`, `Status`) VALUES
(2, 1, '2014-12-11', 'Yes'),
(25, 10, '2014-12-24', 'Yes'),
(26, 10, '2015-01-12', 'Yes'),
(27, 10, '2015-01-15', 'Yes'),
(28, 10, '2015-01-17', 'Yes'),
(29, 10, '2016-03-20', 'Yes'),
(30, 56, '2016-03-23', 'Yes'),
(31, 56, '2017-12-31', 'Yes'),
(32, 56, '2018-02-04', 'Yes'),
(33, 56, '2018-02-14', 'No'),
(34, 56, '2019-04-10', 'Yes'),
(35, 55, '2019-04-30', 'Yes'),
(36, 10, '2020-05-14', 'Yes'),
(37, 10, '2021-01-25', 'No'),
(38, 10, '2023-05-01', 'No'),
(39, 10, '2023-05-14', 'No'),
(40, 55, '2023-05-14', 'No'),
(41, 46, '2023-05-15', 'No'),
(42, 59, '2023-05-15', 'No'),
(43, 59, '2023-05-15', 'No'),
(44, 61, '2023-05-15', 'No'),
(45, 61, '2023-05-15', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `Order_ID` int(11) NOT NULL,
  `Product_ID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`Order_ID`, `Product_ID`, `Quantity`, `size`) VALUES
(2, 2, 2, 0),
(2, 6, 2, 0),
(28, 3, 1, 1),
(29, 2, 1, 1),
(31, 2, 1, 1),
(35, 2, 7, 2),
(36, 1, 15, 1),
(36, 1, 3, 2),
(36, 2, 1, 2),
(37, 3, 3, 1),
(37, 4, 1, 2),
(38, 3, 1, 1),
(38, 7, 1, 1),
(39, 2, 1, 1),
(39, 4, 2, 2),
(40, 2, 2, 1),
(40, 1, 1, 2),
(40, 3, 1, 1),
(41, 3, 1, 1),
(42, 3, 1, 1),
(43, 2, 1, 1),
(43, 2, 1, 2),
(43, 1, 1, 1),
(43, 4, 1, 2),
(44, 1, 1, 1),
(44, 4, 2, 2),
(45, 6, 1, 3),
(45, 8, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ID` int(11) NOT NULL,
  `Price` float NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Category_ID` int(11) NOT NULL,
  `Brand_ID` int(11) NOT NULL,
  `Description` text DEFAULT NULL,
  `status` int(11) NOT NULL,
  `Img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ID`, `Price`, `Name`, `Category_ID`, `Brand_ID`, `Description`, `status`, `Img`) VALUES
(1, 200, 'Shoe11112111', 7, 4, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit dolor porro accusantium illum laborum\r\n                    voluptates? Dolores, suscipit magnam porro animi praesentium repudiandae blanditiis qui consequuntur\r\n                    ipsam, nobis quia dicta, fugiat nulla quaerat in optio veniam tempore iure sequi? Magnam, deserunt\r\n                    voluptatibus ipsam culpa voluptate tempore molestias in veritatis! Officia cupiditate in totam\r\n                    dolorem praesentium unde corrupti ipsam, dolores iusto necessitatibus rerum debitis minus? Dolores\r\n                    reprehenderit, asperiores animi hic repudiandae facilis labore iusto praesentium fuga iste corporis\r\n                    quia nihil rerum quae adipisci perferendis earum minima id consectetur possimus nostrum doloremque\r\n                    veniam nulla ad. Iste unde sunt totam optio deleniti. Placeat, amet!', 1, 'shoe.jpg'),
(2, 100, 'Shoe2', 4, 4, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit dolor porro accusantium illum laborum\r\n                    voluptates? Dolores, suscipit magnam porro animi praesentium repudiandae blanditiis qui consequuntur\r\n                    ipsam, nobis quia dicta, fugiat nulla quaerat in optio veniam tempore iure sequi? Magnam, deserunt\r\n                    voluptatibus ipsam culpa voluptate tempore molestias in veritatis! Officia cupiditate in totam\r\n                    dolorem praesentium unde corrupti ipsam, dolores iusto necessitatibus rerum debitis minus? Dolores\r\n                    reprehenderit, asperiores animi hic repudiandae facilis lab. Iste unde sunt totam optio deleniti. Placeat, amet!', 0, 'shoe4.png'),
(3, 100, 'shoe3', 1, 6, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit dolor porro accusantium illum laborum\n                    voluptates? Dolores, suscipit magnam porro animi praesentium repudiandae blanditiis qui consequuntur\n                    ipsam, nobis quia dicta, fugiat nulla quaerat in optio veniam tempore iure sequi? Magnam, deserunt\n                    voluptatibus ipsam culpa voluptate tempore molestias in veritatis! Officia cupiditate in totam\n                    dolorem praesentium unde corrupti ipsam, dolores iusto necessitatibus rerum debitis minus? Dolores\n          \n                    veniam nulla ad. Iste unde sunt totam optio deleniti. Placeat, amet!', 1, 'shoe2.png'),
(4, 1666, 'shoe 4', 1, 4, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit dolor porro accusantium illum laborum\r\n                    voluptates? Dolores, suscipit magnam porro animi praesentium repudiandae blanditiis qui consequuntur\r\n                    ipsam, nobis quia dicta, fugiat nulla quaerat in optio veniam tempore iure sequi? Magnam, deserunt\r\n                    voluptatibus ipsam culpa voluptate tempore molestias in veritatis! Officia cupiditate in totam\r\n                    dolorem praesentium unde corrupti ipsam, dolores iusto necessitatibus rerum debitis minus? Dolores\r\n                    reprehenderit, asperiores animi hic repudiandae facilis labore iusto praesentium fuga iste corporis\r\n                    quia nihil rerum quae adipisci perferendis earum minima id consectetur possimus nostrum doloremque\r\n                    veniam nulla ad. Iste unde sunt totam optio deleniti. Placeat, amet!', 1, 'shoe3.png'),
(5, 1622, 'shoe 5', 1, 4, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit dolor porro accusantium illum laborum\r\n                    voluptates? Dolores, suscipit magnam porro animi praesentium repudiandae blanditiis qui consequuntur\r\n                    ipsam, nobis quia dicta, fugiat nulla quaerat in optio veniam tempore iure sequi? Magnam, deserunt\r\n                    voluptatibus ipsam culpa voluptate tempore molestias in veritatis! Officia cupiditate in totam\r\n                    dolorem praesentium unde corrupti ipsam, dolores iusto necessitatibus rerum debitis minus? Dolores\r\n                    reprehenderit, asperiores animi hic repudiandae facilis labore iusto praesentium fuga iste corporis\r\n                    quia nihil rerum quae adipisci perferendis earum minima id consectetur possimus nostrum doloremque\r\n                    veniam nulla ad. Iste unde sunt totam optio deleniti. Placeat, amet!', 1, 'shoe5.png'),
(6, 1623, 'shoe 6', 7, 7, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit dolor porro accusantium illum laborum\r\n                    voluptates? Dolores, suscipit magnam porro animi praesentium repudiandae blanditiis qui consequuntur\r\n                    ipsam, nobis quia dicta, fugiat nulla quaerat in optio veniam tempore iure sequi? Magnam, deserunt\r\n                    voluptatibus ipsam culpa voluptate tempore molestias in veritatis! Officia cupiditate in totam\r\n                    dolorem praesentium unde corrupti ipsam, dolores iusto necessitatibus rerum debitis minus? Dolores\r\n                    reprehenderit, asperiores animi hic repudiandae facilis labore iusto praesentium fuga iste corporis\r\n                    quia nihil rerum quae adipisci perferendis earum minima id consectetur possimus nostrum doloremque\r\n                    veniam nulla ad. Iste unde sunt totam optio deleniti. Placeat, amet!', 1, 'shoe6.png'),
(7, 16233, 'shoe 7', 2, 1, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit dolor porro accusantium illum laborum\n                    voluptates? Dolores, suscipit magnam porro animi praesentium repudiandae blanditiis qui consequuntur\n                    ipsam, nobis quia dicta, fugiat nulla quaerat in optio veniam tempore iure sequi? Magnam, deserunt\n                    voluptatibus ipsam culpa voluptate tempore molestias in veritatis! Officia cupiditate in totam\n                    dolorem praesentium unde corrupti ipsam, dolores iusto necessitatibus rerum debitis minus? Dolores\n                    reprehenderit, asperiores animi hic repudiandae facilis labore iusto praesentium fuga iste corporis\n                    quia nihil rerum quae adipisci perferendis earum minima id consectetur possimus nostrum doloremque\n                    veniam nulla ad. Iste unde sunt totam optio deleniti. Placeat, amet!', 1, 'shoe7.png'),
(8, 16233, 'shoe 8', 2, 1, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit dolor porro accusantium illum laborum\r\n                    voluptates? Dolores, suscipit magnam porro animi praesentium repudiandae blanditiis qui consequuntur\r\n                    ipsam, nobis quia dicta, fugiat nulla quaerat in optio veniam tempore iure sequi? Magnam, deserunt\r\n                    voluptatibus ipsam culpa voluptate tempore molestias in veritatis! Officia cupiditate in totam\r\n                    dolorem praesentium unde corrupti ipsam, dolores iusto necessitatibus rerum debitis minus? Dolores\r\n                    reprehenderit, asperiores animi hic repudiandae facilis labore iusto praesentium fuga iste corporis\r\n                    quia nihil rerum quae adipisci perferendis earum minima id consectetur possimus nostrum doloremque\r\n                    veniam nulla ad. Iste unde sunt totam optio deleniti. Placeat, amet!', 1, 'shoe8.png'),
(9, 16233, 'shoe 9', 2, 1, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit dolor porro accusantium illum laborum\r\n                    voluptates? Dolores, suscipit magnam porro animi praesentium repudiandae blanditiis qui consequuntur\r\n                    ipsam, nobis quia dicta, fugiat nulla quaerat in optio veniam tempore iure sequi? Magnam, deserunt\r\n                    voluptatibus ipsam culpa voluptate tempore molestias in veritatis! Officia cupiditate in totam\r\n                    dolorem praesentium unde corrupti ipsam, dolores iusto necessitatibus rerum debitis minus? Dolores\r\n                    reprehenderit, asperiores animi hic repudiandae facilis labore iusto praesentium fuga iste corporis\r\n                    quia nihil rerum quae adipisci perferendis earum minima id consectetur possimus nostrum doloremque\r\n                    veniam nulla ad. Iste unde sunt totam optio deleniti. Placeat, amet!', 1, 'shoe9.png'),
(10, 16233, 'shoe 10', 2, 1, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit dolor porro accusantium illum laborum\r\n voluptates? Dolores, suscipit magnam porro animi praesentium repudiandae blanditiis qui consequuntur\r\n ipsam, nobis quia dicta, fugiat nulla quaerat in optio veniam tempore iure sequi? Magnam, deserunt\r\n voluptatibus ipsam culpa voluptate tempore molestias in veritatis! Officia cupiditate in totam\r\n dolorem praesentium unde corrupti ipsam, dolores iusto necessitatibus rerum debitis minus? Dolores\r\n reprehenderit, asperiores animi hic repudiandae facilis labore iusto praesentium fuga iste corporis\r\n quia nihil rerum quae adipisci perferendi', 1, 'shoe10.png'),
(12, 1000, 'Shoe69', 4, 1, 'des01', 1, 'shoe11.png'),
(19, 200, 'S1', 1, 1, '1223', 1, ''),
(20, 200123, 'S2', 1, 1, '123', 1, ''),
(21, 200, 'Shoe11001', 1, 5, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit dolor porro accusantium illum laborum\r\n', 1, 'shoe1.png'),
(22, 111, 'Shoe100102', 1, 1, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit dolor porro accusantium illum laborum\r\n', 1, 'shoe9.png'),
(23, 400, 'Shoe100301', 1, 1, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit dolor porro accusantium illum laborum\r\n', 1, 'shoe7.png'),
(24, 340, 'Shoe4011', 1, 1, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit dolor porro accusantium illum laborum\r\n', 1, 'shoe10.png'),
(25, 7999, 'Shoe120141', 1, 1, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit dolor porro accusantium illum laborum\r\n', 1, 'shoe10.png'),
(26, 57774, 'Shoe1501381', 1, 1, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit dolor porro accusantium illum laborum\r\n', 1, 'shoe6.png'),
(27, 400, 'Shoe1231312312', 1, 5, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit dolor porro accusantium illum laborum\r\n', 1, 'shoe3.png'),
(28, 7999, 'Shoe11001', 1, 4, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit dolor porro accusantium illum laborum\r\n', 1, 'shoe.jpg'),
(29, 12333, 'abc', 1, 1, 'abc', 1, 'logo_person.png');

-- --------------------------------------------------------

--
-- Table structure for table `size_detail`
--

CREATE TABLE `size_detail` (
  `size` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `size_detail`
--

INSERT INTO `size_detail` (`size`, `product_id`, `quantity`) VALUES
(1, 1, 8),
(1, 2, 25),
(1, 3, 5),
(1, 7, 12),
(2, 1, 11),
(2, 2, 4),
(2, 3, 12),
(2, 4, 6),
(3, 2, 13),
(3, 3, 13),
(3, 5, 11),
(3, 6, 10),
(3, 8, 11),
(3, 9, 12),
(3, 10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `username` varchar(30) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `user_type` int(11) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fullname`, `birthday`, `gender`, `email`, `phone`, `address`, `password`, `user_type`, `Status`, `created_at`) VALUES
(1, 'admin', 'Admin User', '1990-01-01', 'Female', 'admin@example.com', '+84937351176', '234 Main St, Anytown USA', '123', 1, 'active', '2023-05-10 16:17:32'),
(2, 'NhanVien', 'LinhDan', '2023-05-17', 'female', 'linhdan11003@gmail.com', '+84961234478', 'Nguyen Binh Khiem Street / Quan 1 / HCMC', '2', 2, 'active', '2023-05-10 16:18:17'),
(3, 'NhanVien2', 'HM', '2001-05-03', 'Female', 'dimmi020007@gmail.com', '+84379874922', 'Hai Ba Trung Street', '1', 2, 'active', '2023-05-14 18:35:46'),
(4, '123', 'LinhDan', '2023-05-26', 'female', 'linhdan1122003@gmail.com', '+84964908121', 'Nguyen Binh Khiem Street / Quan 1 / HCMC', '1', 1, 'active', '2023-05-15 08:39:41'),
(5, 'admin', 'LinhDan', '2023-05-03', 'female', 'dannguyen1122003@gmail.com', '+84964908122', 'Nguyen Binh Khiem Street / Quan 1 / HCMC', '1', 2, 'active', '2023-05-15 08:40:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action_group`
--
ALTER TABLE `action_group`
  ADD PRIMARY KEY (`action_group_ID`);

--
-- Indexes for table `action_table`
--
ALTER TABLE `action_table`
  ADD KEY `INDEX` (`action_group_ID`,`action_ID`),
  ADD KEY `FRK2` (`action_ID`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD KEY `FK2_Cart` (`User_ID`),
  ADD KEY `FK3_Cart` (`Product_ID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK2_actionGroup` (`user_type`);

--
-- Indexes for table `myaction`
--
ALTER TABLE `myaction`
  ADD PRIMARY KEY (`action_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD KEY `FK1_Order_Detail` (`Order_ID`),
  ADD KEY `FK2_Order_Detail` (`Product_ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK1_Product` (`Category_ID`),
  ADD KEY `FK2_Product` (`Brand_ID`);

--
-- Indexes for table `size_detail`
--
ALTER TABLE `size_detail`
  ADD UNIQUE KEY `unique_size_detail` (`size`,`product_id`),
  ADD KEY `FK2_size_detail` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_actionGroup` (`user_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `myaction`
--
ALTER TABLE `myaction`
  MODIFY `action_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `action_table`
--
ALTER TABLE `action_table`
  ADD CONSTRAINT `FRK1` FOREIGN KEY (`action_group_ID`) REFERENCES `action_group` (`action_group_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FRK2` FOREIGN KEY (`action_ID`) REFERENCES `myaction` (`action_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK1_Cart` FOREIGN KEY (`User_ID`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `FK3_Cart` FOREIGN KEY (`Product_ID`) REFERENCES `product` (`ID`);

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `FK2_actionGroup` FOREIGN KEY (`user_type`) REFERENCES `action_group` (`action_group_ID`);

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `FK1_Order_Detail` FOREIGN KEY (`Order_ID`) REFERENCES `orders` (`ID`),
  ADD CONSTRAINT `FK2_Order_Detail` FOREIGN KEY (`Product_ID`) REFERENCES `product` (`ID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK1_Product` FOREIGN KEY (`Category_ID`) REFERENCES `category` (`ID`),
  ADD CONSTRAINT `FK2_Product` FOREIGN KEY (`Brand_ID`) REFERENCES `brand` (`ID`);

--
-- Constraints for table `size_detail`
--
ALTER TABLE `size_detail`
  ADD CONSTRAINT `FK2_size_detail` FOREIGN KEY (`product_id`) REFERENCES `product` (`ID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_actionGroup` FOREIGN KEY (`user_type`) REFERENCES `action_group` (`action_group_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
