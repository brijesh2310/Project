-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2018 at 11:02 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(20) NOT NULL,
  `category_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_img`) VALUES
(6, 'Men', 'image/blue plain Shirt.jpeg'),
(7, 'Woman', 'image/Amayra Womens Cotton Blue Printed Straight Kurti.jpg'),
(8, 'Kids', 'image/AJ Dezines kids festive and party wear Sherwani for boys.jpg'),
(9, 'Mobiles', 'image/apple-iphone-8-colors.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_code` varchar(10) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_price` decimal(10,0) NOT NULL,
  `product_img` varchar(255) NOT NULL,
  `subcategory_name` varchar(20) NOT NULL,
  `category_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_code`, `product_name`, `product_price`, `product_img`, `subcategory_name`, `category_name`) VALUES
(1, 'M001', 'Akaas Cotton', '500', 'image/Akaas Cotton Blend Full Sleeve Men Shirt.jpg', 'Shirt', 'Men'),
(2, 'M002', 'RayBan Sunglass ', '1520', 'image/24 shops Branded Blue Aviator Sunglasses for Men.jpg', 'Sunglasses', 'Men'),
(3, 'M003', 'Woodland', '604', 'image/Accezory Brown Mens Wallet.jpg', 'Wallet', 'Men'),
(4, 'M004', 'Accezory Style', '502', 'image/Accezory Stylish Brown Wallet For Men.jpg', 'Wallet', 'Men'),
(5, 'M005', 'Addic Digital Watch', '1050', 'image/Addic Digital Multi-functional Blue Outdoor Sports Watch for Mens & Boys.jpg', 'Watch', 'Men'),
(6, 'W001', 'Addic Uber Watch', '1200', 'image/Addic Uber Cool Designer Dual Tone Silver & Rose Gold Girls & Womens Watch.jpg', 'Watch', 'Women'),
(8, 'W002', 'Aelo White Watch', '802', 'image/Aelo Silver Analogue White Dial Womens Watch - Jww1067.jpg', 'Watch', 'Woman'),
(9, 'M006', 'AISLIN Non Breakable Gogles', '420', 'image/AISLIN Non-Breakable Rectangular Sunglasses For Men.jpg', 'Sunglasses', 'Men'),
(10, 'M007', 'Akass Cotton Red Shirt', '560', 'image/Akaas Cotton Blend Full Sleeve Mens Shirt.jpg', 'Shirt', 'Men'),
(11, 'M008', 'Alan Jones Men T-Shirt', '620', 'image/Alan Jones Mens Cotton Printed T-Shirt.jpg', 'Shirt', 'Men'),
(12, 'M009', 'White Formal shirt', '680', 'image/Albela Mens Formal Shirt White.jpg', 'Shirt', 'Men'),
(13, 'W003', 'ALC creation Top', '890', 'image/ALC Creations Womens Chiffon A-Line Short Top.jpg', 'Dress', 'Woman'),
(14, 'W004', 'ALC Creation T-Shirt', '780', 'image/ALC Creations Womens Cotton Round Neck T-Shirt.jpg', 'T-Shirt', 'Woman'),
(15, 'w005', 'ALC Creation Kurtis', '960', 'image/ALC Creations Womens Faux Crepe A-Line Kurti.jpg', 'Krurti', 'Woman'),
(16, 'W006', 'ALC Creation T-Shirts', '750', 'image/ALC Creations Womenss Cotton Round Neck T-Shirt.jpg', 'T-Shirt', 'Woman'),
(17, '010', 'Alfami men Belts', '250', 'image/Alfami Mens PU Leather Reversible Belt Black Brown Formal Casual Free Size upto 44.jpg', 'Belt', 'Men'),
(18, 'M011', 'LAX Perfume', '140', 'image/All Good Scents Urbane Nights Eau De Toilette For Men 50 ml.jpg', 'Perfume', 'Men'),
(19, 'W007', 'Amayra Woman Kurtis', '690', 'image/Amayra Womens Cotton Blue Printed Straight Kurti.jpg', 'Krurti', 'Woman'),
(20, 'M012', 'Americal POLO T-Shirt', '860', 'image/American Crew Mens Polo Solid T Shirt.jpg', 'T-Shirt', 'Men'),
(21, 'W008', 'American Crow Pents', '900', 'image/American Crew Womens Skinny Fit Jeans (White).jpg', 'Jeans', 'Woman'),
(22, 'M013', 'American Tourister', '560', 'image/american tourister.jpg', 'Krurti', 'Men'),
(23, 'W009', 'American Legis', '950', 'image/American-Elm Womens Grey Solid Skirt.jpg', 'Legis', 'Woman'),
(24, 'W010', 'American Jogges Pents', '980', 'image/American-Elm Womens Slim Fit Dark Melange Printed Jogger for Workout.jpg', 'Jeans', 'Woman'),
(25, 'W011', 'ANJUSHREE Legis', '480', 'image/AnjuShree Choice Womens Black Stitched Cotton Kurti Kurta.jpg', 'Legis', 'Woman'),
(26, 'W012', 'Anshul LoFERS', '1050', 'image/Anshul Fashion mens denim casual loafers.jpg', 'shoes', 'Woman'),
(27, 'P001', 'IPhone7', '21000', 'image/apple-iphone-7-red-gallery-img-1.jpg', 'Phone', 'Mobiles'),
(28, 'P002', 'IPhone8', '56000', 'image/apple-iphone-8-colors.jpg', 'Phone', 'Mobiles'),
(29, 'M014', 'Arvind Blue Shirt', '450', 'image/Arihant Mens Plain Cotton Full Sleeves Regular Fit Formal Shirt.jpg', 'Shirt', 'Men'),
(30, 'M015', 'Arrow Shirt', '590', 'image/Arrow Mens Printed Slim Fit Business Shirt.jpg', 'Shirt', 'Men'),
(31, 'M016', 'Feation gogles', '120', 'image/Arzonai Frame Brown Round Shape UV Protected Sunglasses for Men & Women (MA-666-S3).jpg', 'Sunglasses', 'Men'),
(32, 'M018', 'Ashdan Outlook Jeans', '803', 'image/Ashdan Outdoor Solid Cargos  Regular Fit  Multi-Utility Pockets  Sturdy Polyester-Cotton Blended Cargo Trousers.jpg', 'Jeans', 'Men'),
(33, 'M019', 'AXE Dark Spray', '325', 'image/AXE Dark Temptation Deodorant 150 ml.jpg', 'Perfume', 'Men'),
(34, 'M021', 'AXE Signature', '360', 'image/AXE Signature Mysterious Body Perfume 122ml.jpg', 'Perfume', 'Men'),
(35, 'M021', 'Azzaro Spray', '125', 'image/Azzaro Chrome Legend for Men 125ml.jpg', 'Perfume', 'Men'),
(36, 'M022', 'Denim Jeans', '860', 'image/Ben Martin Mens Regular Fit Denim J.jpg', 'Jeans', 'Men'),
(37, 'M023', 'Denim Black Jeans', '1050', 'image/Ben Martin Mens Regular Fit Denim Jea.jpg', 'Jeans', 'Men'),
(38, 'M024', 'Ben Martin Black Jeans ', '860', 'image/Ben Martin Mens Regular Fit Denim Jeans.jpg', 'Jeans', 'Men'),
(39, 'M025', ' Ben Denim Blue Jeans Pent', '960', 'image/Ben Martin Mens Regular Fit Denim.jpg', 'Jeans', 'Men'),
(40, 'M026', 'Big Fox Shoes', '890', 'image/Big Fox Suede Leather Sandals For Men.jpg', 'shoes', 'Men'),
(41, 'M027', 'Black Belt', '150', 'image/Black 35 mm Stylish Formal Leather Belt For Men.jpg', 'Belt', 'Men'),
(42, 'W013', 'Black Krurti', '560', 'image/Black Krurti.jpg', 'Krurti', 'Woman'),
(43, 'P003', 'BlackBerry Phone', '26900', 'image/blackberry.jpg', 'Phone', 'Men'),
(44, 'W014', 'BLUE DIAMOND WATCH', '890', 'image/BLUE DIAMOND Analogue black dial watches combo set for womens and girls.jpg', 'Watch', 'Woman'),
(45, 'M028', 'Blue Leptop Backpack', '860', 'image/Blue Laptop backpack.jpg', 'Handbeg', 'Men'),
(46, 'M029', 'Blue Plain Shirt', '860', 'image/blue plain Shirt.jpeg', 'Shirt', 'Men'),
(47, 'M030', 'Lavis blue Wallet', '590', 'image/Bogesi Blue MenS Wallet.jpg', 'Wallet', 'Men'),
(48, 'W015', 'Bollywood Diamond Combo Watch', '860', 'image/Bollywood Designer Digital Multi Colour Dial Womens Watch diamond13.jpg', 'Watch', 'Woman'),
(49, 'W016', 'Bright Cotton Kurto', '890', 'image/Bright Cotton Kurti for Women Black Kurta Cotton.jpg', 'Dress', 'Woman'),
(50, 'W017', 'CheroKee Women', '890', 'image/Cherokee Womens Slim Jeans.jpg', 'Dress', 'Woman'),
(51, 'W018', 'Damen Model ', '200', 'image/DAMEN MODE Light Blue Denim Jeggings.jpg', 'Jeans', 'Woman'),
(52, 'W020', 'DAMEN MODELS SHIRT', '490', 'image/DAMEN MODE WOMEN RED CHECK SHIRT.jpg', 'Shirt', 'Woman'),
(53, 'W021', 'Dhruvi Trendz ', '450', 'image/Dhruvi Trendz Womens Tops for Women Girls Ladies Latest t-shirt Stylish Designer Partywear Western Collection.jpg', 'Shirt', 'Woman'),
(54, 'W022', 'RayBun sunglasses', '600', 'image/sunglasswomen.jpg', 'Sunglasses', 'Woman'),
(55, 'K001', 'Kids T-shirt', '500', 'image/09ace1b13f96dad7a0e931250966be4301023ee0.jpg', 'T-Shirt', 'Kids'),
(56, 'K002', 'Kids Addidas ', '860', 'image/2018-canvas-children-shoes-sport-breathable.jpg', 'shoes', 'Kids'),
(57, 'K003', 'Kids Sparay', '860', 'image/73000w.jpg', 'Perfume', 'Kids'),
(58, 'K004', 'Spyder Men', '890', 'image/c84092916f7a77022f23c56043cdd7b3_350x350.jpg', 'Shirt', 'Kids'),
(59, 'K005', 'Patel Sparay', '850', 'image/D5F6BT-HERO.jpg', 'Perfume', 'Kids'),
(60, 'k006', 'Fasttrack Watch', '952', 'image/new-kids-watch-talking-watches-for-kids.jpg', 'Watch', 'Kids'),
(61, 'K007', 'Lamex', '750', 'image/eaea9dae-9609-48a3-83c3-46f36b01b68a_1.da07eeaff507e5ec70db0358bf16833b.jpeg', 'Watch', 'Kids'),
(62, 'K008', 'Lemon Watch', '790', 'image/GUEST_0f7db896-36d1-45b7-aaaf-a682c949200b.jpg', 'Watch', 'Kids'),
(63, 'K009', 'K H Cloth', '890', 'image/6-7-years-sbngown02-sbn-original-imaf7nhwct8jfcvg.jpeg', 'Dress', 'Kids'),
(64, 'K010', 'Chaudhary ', '875', 'image/Chaudhary-Kidswear-Multicolor-Long-Party-SDL964686490-1-88119.jpg', 'Dress', 'Kids'),
(65, 'K011', 'Patel Watch', '465', 'image/watch.jpg', 'Watch', 'Kids'),
(66, 'K012', 'Blue shirt', '360', 'image/efx3-kids-party-wear-dresses-kids-dresses-boys-dress_500x500_0.jpg', 'Shirt', 'Kids'),
(67, 'K013', 'Knya feshion', '350', 'image/images (1).jpg', 'T-Shirt', 'Kids'),
(68, 'K014', 'Macho T-Shirt', '950', 'image/SWEAT10-_-PANT32_1400x.jpg', 'T-Shirt', 'Kids'),
(69, 'K015', 'Amul T-Shirt', '856', 'image/images (2).jpg', 'T-Shirt', 'Kids'),
(70, 'P004', 'Iphone X', '81000', 'image/phone1.jpg', 'Phone', 'Mobiles'),
(71, 'P005', 'Google Pixel', '36000', 'image/phone2.jpg', 'Phone', 'Mobiles'),
(72, 'P006', 'Xmate', '56000', 'image/phone3.jpg', 'Phone', 'Mobiles'),
(73, 'P007', 'Honor', '29000', 'image/phone4.jpg', 'Phone', 'Mobiles'),
(74, 'P008', 'HUWAI', '25900', 'image/phone6.jpg', 'Phone', 'Mobiles'),
(75, 'P009', 'Sumsung a3', '12000', 'image/phone7.jpg', 'Phone', 'Mobiles'),
(76, 'P010', 'Nokia Y2', '8900', 'image/phone9.jpg', 'Belt', 'Men'),
(77, 'P011', 'Jio 2', '4500', 'image/phone11.jpg', 'Phone', 'Mobiles'),
(78, 'P012', 'Oppo A3S', '15920', 'image/phone12.jpg', 'Phone', 'Mobiles');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `subcategory_id` int(11) NOT NULL,
  `subcategory_name` varchar(20) NOT NULL,
  `subcategory_img` varchar(255) NOT NULL,
  `category_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`subcategory_id`, `subcategory_name`, `subcategory_img`, `category_name`) VALUES
(1, 'Shirt', 'image/Akaas Cotton Blend Full Sleeve Men Shirt.jpg', 'Men'),
(2, 'T-Shirt', 'image/Alan Jones Mens Cotton Printed T-Shirt.jpg', 'Men'),
(4, 'Jeans', 'image/Ben Martin Mens Regular Fit Denim J.jpg', 'Men'),
(5, 'Watch', 'image/Addic Digital Multi-functional Blue Outdoor Sports Watch for Mens & Boys.jpg', 'Men'),
(7, 'Wallet', 'image/Accezory Stylish Brown Wallet For Men.jpg', 'Men'),
(9, 'Sunglasses', 'image/24 shops Branded Blue Aviator Sunglasses for Men.jpg', 'Men'),
(10, 'shoes', 'image/Anshul Fashion mens denim casual loafers.jpg', 'Men'),
(12, 'Dress', 'image/ALC Creations Womens Chiffon A-Line Short Top.jpg', 'Women'),
(14, 'Legis', 'image/American-Elm Womens Slim Fit Dark Melange Printed Jogger for Workout.jpg', 'Women'),
(15, 'Krurti', 'image/Black Krurti.jpg', 'Women'),
(16, 'Handbeg', 'image/womenhandbeg.jpg', 'Women'),
(17, 'Perfume', 'image/Azzaro Chrome Legend for Men 125ml.jpg', 'Men'),
(18, 'Belt', 'image/Alfami Mens PU Leather Reversible Belt Black Brown Formal Casual Free Size upto 44.jpg', 'Men'),
(19, 'Phone', 'image/apple-iphone-7-red-gallery-img-1.jpg', 'Mobiles');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`subcategory_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
