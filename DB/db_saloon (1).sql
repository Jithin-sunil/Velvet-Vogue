-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2024 at 11:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_saloon`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_email` varchar(30) NOT NULL,
  `admin_password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(27, 'Devika Narayanan', 'devika@gmail.com', '000009'),
(28, 'minnu', 'minnu@gmail.com', '123456789');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `booking_id` int(11) NOT NULL,
  `booking_status` int(11) NOT NULL DEFAULT 0,
  `booking_date` varchar(50) NOT NULL,
  `booking_amount` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`booking_id`, `booking_status`, `booking_date`, `booking_amount`, `customer_id`) VALUES
(1, 5, '2024-08-24', 912, 17),
(3, 1, '2024-08-30', 2000, 19),
(4, 1, '2024-09-01', 2000, 15),
(7, 1, '2024-08-30', 2000, 19),
(8, 5, '2024-08-30', 2000, 19),
(9, 5, '2024-09-01', 912, 20),
(10, 1, '2024-09-01', 2000, 15),
(11, 5, '2024-09-01', 2000, 15),
(12, 5, '2024-09-23', 2456, 35);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brand_id`, `brand_name`) VALUES
(1, 'Loreal Paris'),
(2, 'Dior'),
(4, 'mamaearth'),
(5, 'Colorbar'),
(6, 'Biotique'),
(7, 'Maybelline'),
(8, 'Nykaa'),
(9, 'Kay beauty'),
(10, 'RENEE');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(11) NOT NULL,
  `cart_status` int(11) NOT NULL DEFAULT 0,
  `cart_quantity` int(11) NOT NULL DEFAULT 1,
  `product_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `cart_status`, `cart_quantity`, `product_id`, `booking_id`) VALUES
(1, 1, 2, 2, 1),
(3, 0, 4, 8, 2),
(4, 0, 1, 2, 2),
(5, 0, 1, 9, 2),
(6, 1, 3, 8, 3),
(7, 1, 1, 3, 4),
(8, 1, 1, 3, 3),
(9, 0, 1, 8, 5),
(10, 0, 1, 3, 5),
(11, 0, 1, 3, 6),
(12, 1, 1, 9, 7),
(13, 1, 1, 9, 8),
(14, 1, 2, 3, 9),
(15, 1, 1, 9, 10),
(16, 1, 1, 9, 11),
(17, 1, 1, 3, 12),
(18, 1, 1, 9, 12);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`) VALUES
(7, 'hair'),
(28, 'face'),
(29, 'nails'),
(30, 'Facial'),
(31, 'Skin Treatment'),
(32, 'Tanning');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complaint`
--

CREATE TABLE `tbl_complaint` (
  `complaint_id` int(11) NOT NULL,
  `complaint_date` varchar(50) NOT NULL,
  `complaint_descrption` varchar(50) NOT NULL,
  `complaint_status` varchar(50) NOT NULL DEFAULT '0',
  `complaint_file` varchar(50) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `complaint_title` varchar(100) NOT NULL,
  `complaint_reply` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_complaint`
--

INSERT INTO `tbl_complaint` (`complaint_id`, `complaint_date`, `complaint_descrption`, `complaint_status`, `complaint_file`, `product_id`, `customer_id`, `complaint_title`, `complaint_reply`) VALUES
(18, '2024-09-23', 'Product damaged', '1', 'medium.webp', 3, 35, 'hair color', 'dfghjkl');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customerregistration`
--

CREATE TABLE `tbl_customerregistration` (
  `place_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_gender` varchar(50) NOT NULL,
  `customer_contact` varchar(50) NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  `customer_password` varchar(50) NOT NULL,
  `customer_photo` varchar(50) NOT NULL,
  `customer_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_customerregistration`
--

INSERT INTO `tbl_customerregistration` (`place_id`, `customer_id`, `customer_name`, `customer_gender`, `customer_contact`, `customer_email`, `customer_password`, `customer_photo`, `customer_address`) VALUES
(21, 29, 'Devika', 'Female', '9961328676', 'devikanarayanan456@gmail.com', 'Devika456', 'download.jpg', 'Mannath(H)Veloor'),
(23, 30, 'Parvana', 'Female', '8078701680', 'parvana78@gmail.com', 'Parvana456', 'medium.webp', 'Mannath House '),
(24, 32, 'Parvana', 'Female', '8078701680', 'parvana78@gmail.com', 'Dev45678', 'green dna.jpg', 'Mannath House'),
(21, 35, 'Jithin', 'Female', '8078701680', 'jithin2003@gmail.com', 'Jithin2003', 'leaf.jpg', 'Mannath House'),
(23, 36, 'Sandra', 'Female', '9961328674', 'sandrasaju@gmail.com', 'Sandra123', 'realistic-sunscreen-product-promo.zip', 'Panattu House');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_district`
--

CREATE TABLE `tbl_district` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_district`
--

INSERT INTO `tbl_district` (`district_id`, `district_name`) VALUES
(26, 'Alapuzha'),
(27, 'Eranakulam'),
(28, 'Idukki'),
(29, 'Kannur'),
(30, 'Kasaragod'),
(31, 'Kollam'),
(32, 'Kozhicode'),
(34, 'Malappuram'),
(35, 'Palakkad'),
(36, 'Patanamthitta'),
(37, 'Thriuvananthapuram'),
(39, 'Thrissur'),
(40, 'Wayanad'),
(41, 'Kottayam');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_place`
--

CREATE TABLE `tbl_place` (
  `place_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `place_name` varchar(50) NOT NULL,
  `place_pincode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_place`
--

INSERT INTO `tbl_place` (`place_id`, `district_id`, `place_name`, `place_pincode`) VALUES
(1, 0, '', ''),
(2, 0, '', ''),
(3, 0, '', ''),
(4, 0, '', ''),
(5, 0, '', ''),
(6, 11, 'Nechoor', ''),
(9, 9, 'Nechoor', '686664'),
(10, 27, 'Nechoor', '686664'),
(11, 18, 'Edapally', '682021'),
(12, 17, 'Vadakara', '673101'),
(15, 23, 'Banasura', '673101'),
(18, 14, 'Kadachira', '642309'),
(19, 13, 'Banasura', '234578'),
(20, 15, 'Banasura', '234578'),
(21, 26, 'Kuttanad', '688561'),
(23, 26, 'Kumarakom', '686003'),
(24, 27, 'Thriponitura', '682030'),
(25, 39, 'Kodakara', '680684');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_price` varchar(50) NOT NULL,
  `product_details` varchar(50) NOT NULL,
  `product_photo` varchar(50) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `Category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `product_price`, `product_details`, `product_photo`, `subcategory_id`, `brand_id`, `Category_id`) VALUES
(3, 'sunscreen', '456', 'spf50+', 'medium.webp', 3, 0, 0),
(7, 'sunscreen', '456', 'spf50+', 'Untitled.jpg', 2, 0, 0),
(8, 'sunscreen', '456', 'spf50+', 'Untitled.jpg', 1, 0, 0),
(9, 'Hair color', '2000', 'permanent', 'Ombre Hair Colour.jpg', 4, 2, 0),
(10, 'spa cream', '240', 'permanent', 'api.js.download', 1, 2, 0),
(11, 'sunscreen', '470', 'spf50++', 'realistic-sunscreen-product-promo.zip', 8, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_review`
--

CREATE TABLE `tbl_review` (
  `review_id` int(11) NOT NULL,
  `review_datetime` varchar(50) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_rating` varchar(50) NOT NULL,
  `customer_review` varchar(50) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_review`
--

INSERT INTO `tbl_review` (`review_id`, `review_datetime`, `customer_name`, `customer_rating`, `customer_review`, `product_id`) VALUES
(1, '2024-08-28 14:50:14', 'njn', '4', 'njn', 8),
(2, '2024-08-28 14:51:08', 'hi', '5', 'hi', 8),
(3, '2024-08-28 14:52:31', 'hh', '3', 'hh\n', 8);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_servicebooking`
--

CREATE TABLE `tbl_servicebooking` (
  `servicebooking_id` int(11) NOT NULL,
  `servicebooking_date` varchar(50) NOT NULL,
  `servicebooking_fordate` varchar(50) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `servicebooking_time` varchar(50) NOT NULL,
  `servicebooking_status` int(11) NOT NULL,
  `service_newtime` varchar(50) NOT NULL,
  `staff_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_servicebooking`
--

INSERT INTO `tbl_servicebooking` (`servicebooking_id`, `servicebooking_date`, `servicebooking_fordate`, `customer_id`, `service_id`, `servicebooking_time`, `servicebooking_status`, `service_newtime`, `staff_id`) VALUES
(2, '2024-09-01', '2024-09-20', 15, 1, '15:28', 1, '', 0),
(3, '2024-09-01', '2024-05-07', 15, 1, '12:10', 2, '18:30', 0),
(4, '2024-09-19', '2024-10-12', 22, 1, '12:30', 0, '', 0),
(6, '2024-09-21', '2024-09-23', 29, 1, '13:07', 0, '', 7),
(7, '2024-09-21', '2024-09-22', 29, 1, '13:09', 0, '', 7),
(8, '2024-09-21', '2024-09-22', 29, 1, '13:09', 0, '', 7),
(9, '2024-09-21', '2024-09-22', 29, 1, '13:09', 0, '', 7),
(10, '2024-09-21', '2024-09-22', 29, 1, '13:09', 1, '', 7),
(11, '2024-09-21', '2024-09-28', 29, 1, '15:23', 3, '14:23', 8),
(12, '2024-09-23', '2024-09-24', 35, 1, '09:30', 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_services`
--

CREATE TABLE `tbl_services` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(50) NOT NULL,
  `service_rate` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_services`
--

INSERT INTO `tbl_services` (`service_id`, `service_name`, `service_rate`) VALUES
(1, 'hair cutting', '400'),
(2, '', ''),
(3, '', ''),
(4, '', ''),
(5, '', ''),
(6, '', ''),
(7, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff`
--

CREATE TABLE `tbl_staff` (
  `staff_id` int(11) NOT NULL,
  `staff_name` varchar(50) NOT NULL,
  `staff_gender` varchar(50) NOT NULL,
  `service_id` int(11) NOT NULL,
  `staff_photo` varchar(50) NOT NULL,
  `staff_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_staff`
--

INSERT INTO `tbl_staff` (`staff_id`, `staff_name`, `staff_gender`, `service_id`, `staff_photo`, `staff_status`) VALUES
(2, 'Devika', 'female', 0, '', 0),
(3, 'Devika', 'female', 0, '', 0),
(4, 'alan', 'male', 0, '', 0),
(5, 'Alan', 'male', 0, '', 0),
(6, 'Geethu', 'female', 0, '', 0),
(7, 'xczxv', 'female', 1, '', 1),
(8, 'Minnu', 'female', 1, 'green dna.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock`
--

CREATE TABLE `tbl_stock` (
  `stock_id` int(11) NOT NULL,
  `stock_date` varchar(50) NOT NULL,
  `stock_quantity` varchar(50) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_stock`
--

INSERT INTO `tbl_stock` (`stock_id`, `stock_date`, `stock_quantity`, `product_id`) VALUES
(1, '2024-08-24', '6', 2),
(2, '2024-08-24', '6', 2),
(3, '2024-08-24', '6', 0),
(4, '2024-08-24', '6', 0),
(6, '2024-08-24', '8', 8),
(7, '2024-08-25', '12', 3),
(8, '2024-08-25', '10', 9);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subcategory`
--

CREATE TABLE `tbl_subcategory` (
  `subcategory_id` int(11) NOT NULL,
  `subcategory_name` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_subcategory`
--

INSERT INTO `tbl_subcategory` (`subcategory_id`, `subcategory_name`, `category_id`) VALUES
(1, 'color', 7),
(2, 'cutting', 7),
(3, 'facial', 28),
(4, 'haircuts', 7),
(5, 'manicures', 29),
(6, 'pedicures', 29),
(7, 'acrylic', 29),
(8, 'tanning', 28);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `tbl_customerregistration`
--
ALTER TABLE `tbl_customerregistration`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `tbl_district`
--
ALTER TABLE `tbl_district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `tbl_place`
--
ALTER TABLE `tbl_place`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_review`
--
ALTER TABLE `tbl_review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `tbl_servicebooking`
--
ALTER TABLE `tbl_servicebooking`
  ADD PRIMARY KEY (`servicebooking_id`);

--
-- Indexes for table `tbl_services`
--
ALTER TABLE `tbl_services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  ADD PRIMARY KEY (`subcategory_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_customerregistration`
--
ALTER TABLE `tbl_customerregistration`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_district`
--
ALTER TABLE `tbl_district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_place`
--
ALTER TABLE `tbl_place`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_review`
--
ALTER TABLE `tbl_review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_servicebooking`
--
ALTER TABLE `tbl_servicebooking`
  MODIFY `servicebooking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_services`
--
ALTER TABLE `tbl_services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
