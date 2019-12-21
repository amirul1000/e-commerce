-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2019 at 08:35 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `github_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(10) NOT NULL,
  `content` text,
  `date_time_created` datetime DEFAULT NULL,
  `date_time_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `content`, `date_time_created`, `date_time_updated`) VALUES
(1, '<p>Renewed US sanctions had led to worse economic conditions than during the country''s 1980-88 war with neighbouring Iraq, Mr Rouhani said.</p>\r\n<p>His comments came amid rising tensions with the US, which last week deployed warships and warplanes to the Gulf.</p>\r\n<p>Mr Rouhani, who has come under domestic political pressure, called for political unity to face down sanctions.</p>\r\n<p>"During the war we did not have a problem with our banks, oil sales or imports and exports, and there were only sanctions on arms purchases," Mr Rouhani told political activists in the capital, Tehran.</p>\r\n<p>"The pressures by enemies is a war unprecedented in the history of our Islamic revolution ... but I do not despair and have great hope for the future and believe that we can move past these difficult conditions provided that we are united," he said.</p>', '2019-05-12 11:56:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `affiliate`
--

CREATE TABLE `affiliate` (
  `id` int(10) NOT NULL,
  `content` text,
  `date_time_created` datetime DEFAULT NULL,
  `date_time_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `affiliate`
--

INSERT INTO `affiliate` (`id`, `content`, `date_time_created`, `date_time_updated`) VALUES
(1, '<p>Renewed US sanctions had led to worse economic conditions than during the country''s 1980-88 war with neighbouring Iraq, Mr Rouhani said.</p>\r\n<p>His comments came amid rising tensions with the US, which last week deployed warships and warplanes to the Gulf.</p>\r\n<p>Mr Rouhani, who has come under domestic political pressure, called for political unity to face down sanctions.</p>\r\n<p>"During the war we did not have a problem with our banks, oil sales or imports and exports, and there were only sanctions on arms purchases," Mr Rouhani told political activists in the capital, Tehran.</p>\r\n<p>"The pressures by enemies is a war unprecedented in the history of our Islamic revolution ... but I do not despair and have great hope for the future and believe that we can move past these difficult conditions provided that we are united," he said.</p>', '2019-05-13 09:32:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `file_picture` varchar(256) DEFAULT NULL,
  `display_position` enum('left','top','middle','bottom') DEFAULT NULL,
  `products_id` int(10) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `file_picture`, `display_position`, `products_id`, `status`) VALUES
(1, 'banner_images/1_download_(7).jpg', 'left', 26, 'active'),
(2, 'banner_images/2_images_(1).jpg', 'left', 21, 'active'),
(3, 'banner_images/3_download_(6).jpg', 'top', 26, 'active'),
(4, 'banner_images/4_images.jpg', 'top', 23, 'active'),
(5, 'banner_images/5_images_(2).jpg', 'top', 26, 'active'),
(7, 'banner_images/7_download_(4).jpg', 'middle', 23, 'active'),
(8, 'banner_images/8_images_(2).jpg', 'middle', 23, 'active'),
(9, 'banner_images/9_download_(1).jpg', 'bottom', 25, 'active'),
(10, 'banner_images/10_download_(2).jpg', 'bottom', 25, 'active'),
(11, 'banner_images/11_download_(3).jpg', 'bottom', 18, 'active'),
(12, 'banner_images/12_download_(5).jpg', 'bottom', 26, 'active'),
(13, 'banner_images/13_images_(1).jpg', 'bottom', 15, 'active'),
(14, 'banner_images/14_images_(9).jpg', 'bottom', 26, 'active'),
(15, 'banner_images/15_images.jpg', 'bottom', 21, 'active'),
(16, 'banner_images/16_images_(3).jpg', 'bottom', 21, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `billing_information`
--

CREATE TABLE `billing_information` (
  `id` int(10) NOT NULL,
  `first_name` varchar(127) NOT NULL,
  `last_name` varchar(127) NOT NULL,
  `country` varchar(127) NOT NULL,
  `adress1` varchar(127) NOT NULL,
  `adress2` varchar(127) NOT NULL,
  `city` varchar(127) NOT NULL,
  `state` varchar(127) NOT NULL,
  `zip_code` varchar(127) NOT NULL,
  `contact_phone` varchar(127) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing_information`
--

INSERT INTO `billing_information` (`id`, `first_name`, `last_name`, `country`, `adress1`, `adress2`, `city`, `state`, `zip_code`, `contact_phone`) VALUES
(1, 'gfdgfdg', 'gfdgfdg', 'US', 'fgfgfdg', 'dgfdgfdgfd', 'fdgfdgf', 'fdgfgfd', 'fdgfdgfdg', NULL),
(2, 'gfdgfdg', 'gfdgfdg', 'US', 'fgfgfdg', 'dgfdgfdgfd', 'fdgfdgf', 'fdgfgfd', 'fdgfdgfdg', NULL),
(3, 'Amirul', 'Momenin', 'BD', 'C-20,JAkir Hossain Road,Block-E', 'Md-pur', 'Dhaka', 'Dhaka Division', '1207', '66565656'),
(4, 'Amirul', 'Momenin', 'BD', 'C-20,JAkir Hossain Road,Block-E', 'Md-pur', 'Dhaka', 'Dhaka Division', '1207', '066565656'),
(5, 'Amirul', 'Momenin', 'BD', 'C-20,JAkir Hossain Road,Block-E', 'Md-pur', 'Dhaka', 'Dhaka Division', '1207', '066565656'),
(6, 'Amirul', 'Momenin', 'BD', 'C-20,JAkir Hossain Road,Block-E', 'Md-pur', 'Dhaka', 'Dhaka Division', '1207', '066565656'),
(7, 'Amirul', 'Momenin', 'BD', 'C-20,JAkir Hossain Road,Block-E', 'Md-pur', 'Dhaka', 'Dhaka Division', '1207', '066565656'),
(8, 'Amirul', 'Momenin', 'BD', 'C-20,JAkir Hossain Road,Block-E', 'Md-pur', 'Dhaka', 'Dhaka Division', '1207', '066565656'),
(9, 'Amirul', 'Momenin', 'BD', 'C-20,JAkir Hossain Road,Block-E', 'Md-pur', 'Dhaka', 'Dhaka Division', '1207', '66565656'),
(10, 'Amirul', 'Momenin', 'BD', 'C-20,JAkir Hossain Road,Block-E', 'Md-pur', 'Dhaka', 'Dhaka Division', '1207', '66565656'),
(11, 'Amirul', 'Momenin', 'BD', 'C-20,JAkir Hossain Road,Block-E', 'Md-pur', 'Dhaka', 'Dhaka Division', '1207', '66565656'),
(12, 'Amirul', 'Momenin', 'BD', 'C-20,JAkir Hossain Road,Block-E', 'Md-pur', 'Dhaka', 'Dhaka Division', '1207', '66565656'),
(13, 'Amirul', 'Momenin', 'BD', 'C-20,JAkir Hossain Road,Block-E', 'Md-pur', 'Dhaka', 'Dhaka Division', '1207', '66565656'),
(14, 'Amirul', 'Momenin', 'BD', 'C-20,JAkir Hossain Road,Block-E', 'Md-pur', 'Dhaka', 'Dhaka Division', '1207', '66565656'),
(15, 'Amirul', 'Momenin', 'BD', 'C-20,JAkir Hossain Road,Block-E', 'Md-pur', 'Dhaka', 'Dhaka Division', '1207', '66565656'),
(16, 'Amirul', 'Momenin', 'BD', 'C-20,JAkir Hossain Road,Block-E', 'Md-pur', 'Dhaka', 'Dhaka Division', '1207', '66565656'),
(17, 'Amirul', 'Momenin', 'BD', 'C-20,JAkir Hossain Road,Block-E', 'Md-pur', 'Dhaka', 'Dhaka Division', '1207', '66565656');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `file_icon` varchar(127) DEFAULT NULL,
  `parent_category_id` int(10) DEFAULT NULL,
  `cat_name` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `file_icon`, `parent_category_id`, `cat_name`) VALUES
(47, NULL, 0, 'Agriculture & Food'),
(48, NULL, 47, 'Agriculture '),
(49, NULL, 47, 'Food & Beverage '),
(50, NULL, 48, 'Agricultural Growing Media'),
(51, NULL, 48, 'Agricultural Waste'),
(52, NULL, 48, 'Animal Products'),
(53, NULL, 48, 'Beans'),
(54, NULL, 48, 'Cocoa Beans'),
(55, NULL, 48, 'Coffee Beans'),
(56, NULL, 48, 'Farm Machinery & Equipment'),
(57, NULL, 48, 'Feed'),
(58, NULL, 48, 'Fresh Seafood'),
(59, NULL, 48, 'Fruit'),
(60, NULL, 48, 'Grain'),
(61, NULL, 48, 'Herbal Cigars & Cigarettes'),
(62, NULL, 48, 'Mushrooms & Truffles'),
(63, NULL, 48, 'Nuts & Kernels'),
(64, NULL, 48, 'Organic Produce'),
(65, NULL, 48, 'Ornamental Plants'),
(66, NULL, 48, 'Other Agriculture Products'),
(67, NULL, 48, 'Plant & Animal Oil'),
(68, NULL, 48, 'Plant Seeds & Bulbs'),
(69, NULL, 48, 'Timber Raw Materials'),
(70, NULL, 49, 'Alcoholic Beverage'),
(71, NULL, 49, 'Baby Food'),
(72, NULL, 49, 'Baked Goods'),
(73, NULL, 49, 'Bean Products'),
(74, NULL, 49, 'Canned Food'),
(75, NULL, 49, 'Coffee'),
(76, NULL, 49, 'Confectionery'),
(77, NULL, 49, 'Dairy'),
(78, NULL, 49, 'Drinking Water'),
(79, NULL, 49, 'Egg & Egg Products'),
(80, NULL, 49, 'Food Ingredients'),
(81, NULL, 49, 'Fruit Products'),
(82, NULL, 49, 'Grain Products'),
(83, NULL, 49, 'Honey Products'),
(84, NULL, 49, 'Instant Food'),
(85, NULL, 49, 'Meat & Poultry'),
(86, NULL, 49, 'Other Food & Beverage'),
(87, NULL, 49, 'Seafood'),
(88, NULL, 49, 'Seasonings & Condiments'),
(89, NULL, 49, 'Slimming Food'),
(90, NULL, 49, 'Snack Food'),
(91, NULL, 49, 'Soft Drinks'),
(92, NULL, 49, 'Tea'),
(93, NULL, 49, 'Vegetable Products'),
(94, NULL, 48, 'Vanilla Beans'),
(95, NULL, 48, 'Vegetables'),
(97, NULL, 0, 'Apparel,Textiles & Accessories'),
(98, NULL, 97, 'Apparel'),
(99, NULL, 97, 'Textile & Leather Product '),
(100, NULL, 97, 'Fashion Accessories '),
(126, NULL, 97, 'Timepieces, Jewelry, Eyewear '),
(127, NULL, 98, 'Apparel Design Services'),
(128, NULL, 98, 'Apparel Processing Services'),
(129, NULL, 98, 'Apparel Stock'),
(130, NULL, 98, 'Boyâ€™s Clothing'),
(131, NULL, 98, 'Childrenâ€™s Clothing'),
(132, NULL, 98, 'Coats'),
(133, NULL, 98, 'Costumes'),
(134, NULL, 98, 'Dresses'),
(135, NULL, 98, 'Ethnic Clothing'),
(136, NULL, 98, 'Garment Accessories'),
(137, NULL, 98, 'Girlsâ€™ Clothing'),
(138, NULL, 98, 'Hoodies & Sweatshirts'),
(139, NULL, 98, 'Hosiery'),
(140, NULL, 98, 'Infant & Toddlers Clothing'),
(141, NULL, 98, 'Jackets'),
(142, NULL, 98, 'Jeans'),
(143, NULL, 98, 'Ladiesâ€™ Blouses & Tops'),
(144, NULL, 98, 'Mannequins'),
(145, NULL, 98, 'Maternity Clothing'),
(146, NULL, 98, 'Menâ€™s Clothing'),
(147, NULL, 98, 'Menâ€™s Shirts'),
(148, NULL, 98, 'Organic Cotton Clothing'),
(149, NULL, 98, 'Other Apparel'),
(150, NULL, 98, 'Pants & Trousers'),
(151, NULL, 98, 'Plus Size Clothing'),
(152, NULL, 98, 'Sewing Supplies'),
(153, NULL, 98, 'Shorts'),
(154, NULL, 98, 'Skirts'),
(155, NULL, 98, 'Sleepwear'),
(156, NULL, 98, 'Sportswear'),
(157, NULL, 98, 'Stage & Dance Wear'),
(158, NULL, 98, 'Suits & Tuxedo'),
(159, NULL, 98, 'Sweaters'),
(160, NULL, 98, 'Tag Guns'),
(161, NULL, 98, 'Tank Tops'),
(162, NULL, 98, 'T-Shirts'),
(163, NULL, 98, 'Underwear'),
(164, NULL, 98, 'Uniforms'),
(165, NULL, 98, 'Used Clothes'),
(166, NULL, 98, 'Vests & Waistcoats'),
(167, NULL, 98, 'Wedding Apparel & Accessories'),
(168, NULL, 98, 'Womenâ€™s Clothing'),
(169, NULL, 98, 'Workwear'),
(170, NULL, 99, 'Down & Feather'),
(171, NULL, 99, 'Fabric'),
(172, NULL, 99, 'Fiber'),
(173, NULL, 99, 'Fur'),
(174, NULL, 99, 'Grey Fabric'),
(175, NULL, 99, 'Home Textile'),
(176, NULL, 99, 'Leather'),
(177, NULL, 99, 'Leather Product'),
(178, NULL, 99, 'Other Textiles & Leather Products'),
(179, NULL, 99, 'Textile Accessories'),
(180, NULL, 99, 'Textile Processing'),
(181, NULL, 99, 'Textile Stock'),
(182, NULL, 99, 'Thread'),
(183, NULL, 99, 'Yarn'),
(184, NULL, 99, '100% Cotton Fabric'),
(185, NULL, 99, '100% Polyester Fabric'),
(186, NULL, 99, 'Bedding Set'),
(187, NULL, 99, 'Towel'),
(188, NULL, 99, 'Chair Cover'),
(189, NULL, 99, 'Genuine Leather'),
(190, NULL, 100, 'Belt Accessories'),
(191, NULL, 100, 'Belts'),
(192, NULL, 100, 'Fashion Accessories Design Services'),
(193, NULL, 100, 'Fashion Accessories Processing Services'),
(194, NULL, 100, 'Fashion Accessories Stock'),
(195, NULL, 100, 'Gloves & Mittens'),
(196, NULL, 100, 'Headwear'),
(197, NULL, 100, 'Neckwear'),
(198, NULL, 100, 'Scarf, Hat & Glove Sets'),
(199, NULL, 100, 'Hats & Caps'),
(200, NULL, 100, 'Scarves & Shawls'),
(201, NULL, 100, 'Hair Accessories'),
(202, NULL, 100, 'Genuine Leather Belts'),
(203, NULL, 100, 'Leather Gloves & Mittens'),
(204, NULL, 100, 'Ties & Accessories'),
(205, NULL, 100, 'Belt Buckles'),
(206, NULL, 100, 'PU Belts'),
(207, NULL, 100, 'Belt Chains'),
(208, NULL, 100, 'Metal Belts'),
(209, NULL, 100, 'Suspenders'),
(210, NULL, 126, 'Eyewear'),
(211, NULL, 126, 'Jewelry'),
(212, NULL, 126, 'Watches'),
(213, NULL, 126, 'Eyeglasses Frames'),
(214, NULL, 126, 'Sunglasses'),
(215, NULL, 126, 'Sports Eyewear'),
(216, NULL, 126, 'Body Jewelry'),
(217, NULL, 126, 'Bracelets & Bangles'),
(218, NULL, 126, 'Brooches'),
(219, NULL, 126, 'Cuff Links & Tie Clips'),
(220, NULL, 126, 'Earrings'),
(221, NULL, 126, 'Jewelry Boxes'),
(222, NULL, 126, 'Jewelry Sets'),
(223, NULL, 126, 'Jewelry Tools & Equipment'),
(224, NULL, 126, 'Loose Beads'),
(225, NULL, 126, 'Loose Gemstone'),
(226, NULL, 126, 'Necklaces'),
(227, NULL, 126, 'Pendants & Charms'),
(228, NULL, 126, 'Rings'),
(229, NULL, 126, 'Wristwatches'),
(230, NULL, 0, 'Auto & Transportation'),
(231, NULL, 230, 'Automobiles & Motorcycles'),
(233, NULL, 230, 'Transportation'),
(234, NULL, 231, 'Air Intakes'),
(235, NULL, 231, 'ATV'),
(236, NULL, 231, 'ATV Parts'),
(237, NULL, 231, 'Auto Chassis Parts'),
(238, NULL, 231, 'Auto Clutch'),
(239, NULL, 231, 'Auto Electrical System'),
(240, NULL, 231, 'Auto Electronics'),
(241, NULL, 231, 'Auto Engine'),
(242, NULL, 231, 'Auto Ignition System'),
(243, NULL, 231, 'Auto Steering System'),
(244, NULL, 231, 'Automobiles'),
(245, NULL, 231, 'Axles'),
(246, NULL, 231, 'Body Parts'),
(247, NULL, 231, 'Brake System'),
(248, NULL, 231, 'Car Care & Cleaning'),
(249, NULL, 231, 'Cooling System'),
(250, NULL, 231, 'Crank Mechanism'),
(251, NULL, 231, 'Exhaust System'),
(252, NULL, 231, 'Exterior Accessories'),
(253, NULL, 231, 'Fuel System'),
(254, NULL, 231, 'Interior Accessories'),
(255, NULL, 231, 'Lubrication System'),
(256, NULL, 231, 'Motorcycle Accessories'),
(257, NULL, 231, 'Motorcycle Parts'),
(258, NULL, 231, 'Motorcycles'),
(259, NULL, 231, 'Other Auto Parts'),
(260, NULL, 231, 'Suspension System'),
(261, NULL, 231, 'Transmission'),
(262, NULL, 231, 'Tricycles'),
(263, NULL, 231, 'Universal Parts'),
(264, NULL, 231, 'UTV'),
(265, NULL, 231, 'Valve Train'),
(266, NULL, 231, 'Vehicle Equipment'),
(267, NULL, 231, 'Vehicle Tools'),
(268, NULL, 233, 'Aircraft'),
(269, NULL, 233, 'Aviation Accessories'),
(270, NULL, 233, 'Aviation Parts'),
(271, NULL, 233, 'Bicycle'),
(272, NULL, 233, 'Bicycle Accessories'),
(273, NULL, 233, 'Bicycle Parts'),
(274, NULL, 233, 'Boats & Ships'),
(275, NULL, 233, 'Bus'),
(276, NULL, 233, 'Bus Accessories'),
(277, NULL, 233, 'Bus Parts'),
(278, NULL, 233, 'Container'),
(279, NULL, 233, 'Electric Bicycle'),
(280, NULL, 233, 'Electric Bicycle Part'),
(281, NULL, 233, 'Emergency Vehicles'),
(282, NULL, 233, 'Golf Carts'),
(283, NULL, 233, 'Locomotive'),
(284, NULL, 233, 'Marine Supplies'),
(285, NULL, 233, 'Personal Watercraft'),
(286, NULL, 233, 'Railway Supplies'),
(287, NULL, 233, 'Snowmobile'),
(288, NULL, 233, 'Special Transportation'),
(289, NULL, 233, 'Trailers'),
(290, NULL, 233, 'Train Carriage'),
(291, NULL, 233, 'Train Parts'),
(292, NULL, 233, 'Truck'),
(293, NULL, 233, 'Truck Accessories'),
(294, NULL, 233, 'Truck Parts'),
(295, NULL, 0, 'Bags, Shoes & Accessories'),
(296, NULL, 295, 'Luggage, Bags & Cases'),
(297, NULL, 295, 'Shoes & Accessories'),
(298, NULL, 296, 'Bag & Luggage Making Materials'),
(299, NULL, 296, 'Bag Parts & Accessories'),
(300, NULL, 296, 'Business Bags & Cases'),
(301, NULL, 296, 'Digital Gear & Camera Bags'),
(302, NULL, 296, 'Handbags & Messenger Bags'),
(303, NULL, 296, 'Luggage & Travel Bags'),
(304, NULL, 296, 'Luggage Cart'),
(305, NULL, 296, 'Other Luggage, Bags & Cases'),
(306, NULL, 296, 'Special Purpose Bags & Cases'),
(307, NULL, 296, 'Sports & Leisure Bags'),
(308, NULL, 296, 'Wallets & Holders'),
(309, NULL, 296, 'Carry-on Luggage'),
(310, NULL, 296, 'Luggage Sets'),
(311, NULL, 296, 'Trolley Bags'),
(312, NULL, 296, 'Briefcases'),
(313, NULL, 296, 'Cosmetic Bags & Cases'),
(314, NULL, 296, 'Shopping Bags'),
(315, NULL, 296, 'Handbags'),
(316, NULL, 296, 'Backpacks'),
(317, NULL, 296, 'Wallets'),
(318, NULL, 297, 'Baby Shoes'),
(319, NULL, 297, 'Boots'),
(320, NULL, 297, 'Casual Shoes'),
(321, NULL, 297, 'Childrenâ€™s Shoes'),
(322, NULL, 297, 'Clogs'),
(323, NULL, 297, 'Dance Shoes'),
(324, NULL, 297, 'Dress Shoes'),
(325, NULL, 297, 'Genuine Leather Shoes'),
(326, NULL, 297, 'Menâ€™s Shoes'),
(327, NULL, 297, 'Other Shoes'),
(328, NULL, 297, 'Sandals'),
(329, NULL, 297, 'Shoe Materials'),
(330, NULL, 297, 'Shoe Parts & Accessories'),
(331, NULL, 297, 'Shoe Repairing Equipment'),
(332, NULL, 297, 'Shoes Design Services'),
(333, NULL, 297, 'Shoes Processing Services'),
(334, NULL, 297, 'Shoes Stock'),
(335, NULL, 297, 'Slippers'),
(336, NULL, 297, 'Special Purpose Shoes'),
(337, NULL, 297, 'Sports Shoes'),
(338, NULL, 0, 'Electronics'),
(339, NULL, 338, 'Computer Hardware & Software'),
(340, NULL, 338, 'Consumer Electronic'),
(341, NULL, 338, 'Home Appliance'),
(342, NULL, 338, 'Security & Protection'),
(343, NULL, 339, 'All-In-One PC'),
(344, NULL, 339, 'Barebone System'),
(345, NULL, 339, 'Blank Media'),
(346, NULL, 339, 'Computer Cables & Connectors'),
(347, NULL, 339, 'Computer Cases & Towers'),
(348, NULL, 339, 'Computer Cleaners'),
(349, NULL, 339, 'Desktops'),
(352, NULL, 339, 'Fans & Cooling'),
(353, NULL, 339, 'Firewall & VPN'),
(354, NULL, 339, 'Floppy Drives'),
(355, NULL, 339, 'Graphics Cards'),
(356, NULL, 339, 'Hard Drives'),
(357, NULL, 339, 'HDD Enclosure'),
(358, NULL, 339, 'Industrial Computer & Accessories'),
(359, NULL, 339, 'Keyboard Covers'),
(360, NULL, 339, 'KVM Switches'),
(361, NULL, 339, 'Laptop Accessories'),
(362, NULL, 339, 'Laptop Cooling Pads'),
(363, NULL, 339, 'Laptops'),
(364, NULL, 339, 'Memory'),
(365, NULL, 339, 'Modems'),
(366, NULL, 339, 'Monitors'),
(367, NULL, 339, 'Motherboards'),
(368, NULL, 339, 'Mouse & Keyboards'),
(369, NULL, 339, 'Mouse Pads'),
(370, NULL, 339, 'Netbooks & UMPC'),
(371, NULL, 339, 'Network Cabinets'),
(372, NULL, 339, 'Network Cards'),
(373, NULL, 339, 'Network Hubs'),
(374, NULL, 339, 'Network Switches'),
(375, NULL, 339, 'Networking Storage'),
(376, NULL, 339, 'Optical Drives'),
(377, NULL, 339, 'Other Computer Accessories'),
(378, NULL, 339, 'Other Computer Parts'),
(379, NULL, 339, 'Other Computer Products'),
(380, NULL, 339, 'Other Drive & Storage Devices'),
(381, NULL, 339, 'Other Networking Devices'),
(382, NULL, 339, 'PC Stations'),
(383, NULL, 339, 'PDAs'),
(384, NULL, 339, 'Power Supply Units'),
(385, NULL, 339, 'Printers'),
(386, NULL, 339, 'Processors'),
(387, NULL, 339, 'Routers'),
(388, NULL, 339, 'Scanners'),
(389, NULL, 339, 'Servers'),
(390, NULL, 339, 'Software'),
(391, NULL, 339, 'Sound Cards'),
(392, NULL, 339, 'Tablet PC'),
(393, NULL, 339, 'Tablet PC Stands'),
(394, NULL, 339, 'Tablet Stylus Pen'),
(395, NULL, 346, 'USB Flash Drives'),
(396, NULL, 346, 'USB Gadgets'),
(397, NULL, 346, 'USB Hubs'),
(398, NULL, 346, 'Used Computers & Accessories'),
(399, NULL, 346, 'Webcams'),
(400, NULL, 346, 'Wireless Networking'),
(401, NULL, 346, 'Workstations'),
(402, NULL, 340, 'Accessories & Parts'),
(403, NULL, 340, 'Camera, Photo & Accessories'),
(404, NULL, 340, 'Electronic Publications'),
(405, NULL, 340, 'Home Audio, Video & Accessories'),
(406, NULL, 340, 'Mobile Phone & Accessories'),
(407, NULL, 340, 'Other Consumer Electronics'),
(408, NULL, 340, 'Portable Audio, Video & Accessories'),
(409, NULL, 340, 'Video Game & Accessories'),
(410, NULL, 340, 'Mobile Phones'),
(411, NULL, 340, 'Earphone & Headphone'),
(412, NULL, 340, 'Power Banks'),
(413, NULL, 340, 'Digital Camera'),
(414, NULL, 340, 'Radio & TV Accessories'),
(415, NULL, 340, 'Speaker'),
(416, NULL, 340, 'Television'),
(417, NULL, 340, 'Cables'),
(418, NULL, 340, 'Charger'),
(419, NULL, 340, 'Digital Battery'),
(420, NULL, 340, 'Digital Photo Frame'),
(421, NULL, 340, '3D Glasses'),
(422, NULL, 341, 'Air Conditioning Appliances'),
(423, NULL, 341, 'Cleaning Appliances'),
(424, NULL, 341, 'Hand Dryers'),
(425, NULL, 341, 'Home Appliance Parts'),
(426, NULL, 341, 'Home Appliances Stocks'),
(427, NULL, 341, 'Home Heaters'),
(428, NULL, 341, 'Kitchen Appliances'),
(429, NULL, 341, 'Laundry Appliances'),
(430, NULL, 341, 'Other Home Appliances'),
(431, NULL, 341, 'Refrigerators & Freezers'),
(432, NULL, 341, 'Water Heaters'),
(433, NULL, 341, 'Water Treatment Appliances'),
(434, NULL, 341, 'Wet Towel Dispensers'),
(435, NULL, 341, 'Air Conditioners'),
(436, NULL, 341, 'Fans'),
(437, NULL, 341, 'Vacuum Cleaners'),
(438, NULL, 341, 'Solar Water Heaters'),
(439, NULL, 341, 'Cooking Appliances'),
(440, NULL, 341, 'Coffee Makers'),
(441, NULL, 341, 'Blenders'),
(442, NULL, 342, 'Access Control Systems & Products'),
(443, NULL, 342, 'Alarm'),
(444, NULL, 342, 'CCTV Products'),
(445, NULL, 342, 'Firefighting Supplies'),
(446, NULL, 342, 'Key'),
(447, NULL, 342, 'Lock Parts'),
(448, NULL, 342, 'Locks'),
(449, NULL, 342, 'Locksmith Supplies'),
(450, NULL, 342, 'Other Security & Protection Products'),
(451, NULL, 342, 'Police & Military Supplies'),
(452, NULL, 342, 'Roadway Safety'),
(453, NULL, 342, 'Safes'),
(454, NULL, 342, 'Security Services'),
(455, NULL, 342, 'Self Defense Supplies'),
(456, NULL, 342, 'Water Safety Products'),
(457, NULL, 342, 'Workplace Safety Supplies'),
(458, NULL, 342, 'CCTV Camera'),
(459, NULL, 342, 'Bullet Proof Vest'),
(460, NULL, 342, 'Alcohol Tester'),
(461, NULL, 342, 'Fire Alarm'),
(462, NULL, 0, 'Electrical Equipment, Components & Telecoms'),
(463, NULL, 462, 'Electrical Equipment & Supplies '),
(464, NULL, 462, 'Electronic Compnents & Supplies '),
(465, NULL, 462, 'Telecommunication '),
(466, NULL, 463, 'Batteries'),
(467, NULL, 463, 'Circuit Breakers'),
(468, NULL, 463, 'Connectors & Terminals'),
(469, NULL, 463, 'Contactors'),
(470, NULL, 463, 'Electrical Plugs & Sockets'),
(471, NULL, 463, 'Electronic & Instrument Enclosures'),
(472, NULL, 463, 'Fuse Components'),
(473, NULL, 463, 'Fuses'),
(474, NULL, 463, 'Generators'),
(475, NULL, 463, 'Other Electrical Equipment'),
(476, NULL, 463, 'Power Accessories'),
(477, NULL, 463, 'Power Distribution Equipment'),
(478, NULL, 463, 'Power Supplies'),
(479, NULL, 463, 'Professional Audio, Video & Lighting'),
(480, NULL, 463, 'Relays'),
(481, NULL, 463, 'Switches'),
(482, NULL, 463, 'Transformers'),
(483, NULL, 463, 'Wires, Cables & Cable Assemblies'),
(484, NULL, 463, 'Wiring Accessories'),
(485, NULL, 463, 'Solar Cells, Solar Panel'),
(486, NULL, 464, 'Active Components'),
(487, NULL, 464, 'EL Products'),
(488, NULL, 464, 'Electronic Accessories & Supplies'),
(489, NULL, 464, 'Electronic Data Systems'),
(490, NULL, 464, 'Electronic Signs'),
(491, NULL, 464, 'Electronics Production Machinery'),
(492, NULL, 464, 'Electronics Stocks'),
(493, NULL, 464, 'Optoelectronic Displays'),
(494, NULL, 464, 'Other Electronic Components'),
(495, NULL, 464, 'Passive Components'),
(496, NULL, 464, 'LCD Modules'),
(497, NULL, 464, 'LED Displays'),
(498, NULL, 464, 'PCB & PCBA'),
(499, NULL, 464, 'PCB & PCBA'),
(500, NULL, 464, 'Keypads & Keyboards'),
(501, NULL, 464, 'Insulation Materials & Elements'),
(502, NULL, 464, 'Integrated Circuits'),
(503, NULL, 464, 'Diodes'),
(504, NULL, 464, 'Transistors'),
(505, NULL, 464, 'Capacitors'),
(506, NULL, 464, 'Resistors'),
(507, NULL, 465, 'Antennas for Communications'),
(508, NULL, 465, 'Communication Equipment'),
(509, NULL, 465, 'Telephones & Accessories'),
(510, NULL, 465, 'Communication Cables'),
(511, NULL, 465, 'Fiber Optic Equipment'),
(512, NULL, 465, 'Fixed Wireless Terminals'),
(514, NULL, 465, 'WiFi Finder'),
(515, NULL, 465, 'Telephone Accessories'),
(516, NULL, 465, 'Corded Telephones'),
(517, NULL, 465, 'Cordless Telephones'),
(518, NULL, 465, 'Wireless Networking Equipment'),
(519, NULL, 465, 'Telephone Headsets'),
(520, NULL, 465, 'VoIP Products'),
(521, NULL, 465, 'Repeater'),
(522, NULL, 465, 'PBX'),
(523, NULL, 465, 'Telecom Parts'),
(524, NULL, 465, 'PBX'),
(525, NULL, 465, 'Phone Cards'),
(526, NULL, 465, 'Telephone Cords'),
(527, NULL, 465, 'Answering Machines'),
(528, NULL, 465, 'Caller ID Boxes'),
(529, NULL, 0, 'Gifts, Sports & Toys'),
(530, NULL, 529, 'Sports & Entertainment'),
(531, NULL, 529, 'Gifts & Crafts '),
(532, NULL, 529, 'Toys & Hobbies '),
(533, NULL, 530, 'Amusement Park'),
(534, NULL, 530, 'Artificial Grass & Sports Flooring'),
(535, NULL, 530, 'Fitness & Body Building'),
(536, NULL, 530, 'Gambling'),
(537, NULL, 530, 'Golf'),
(538, NULL, 530, 'Indoor Sports'),
(539, NULL, 530, 'Musical Instruments'),
(540, NULL, 530, 'Other Sports & Entertainment Products'),
(541, NULL, 530, 'Outdoor Sports'),
(542, NULL, 530, 'Sports Gloves'),
(543, NULL, 530, 'Sports Safety'),
(544, NULL, 530, 'Sports Souvenirs'),
(545, NULL, 530, 'Team Sports'),
(546, NULL, 530, 'Tennis'),
(547, NULL, 530, 'Team Sports'),
(548, NULL, 530, 'Water Sports'),
(549, NULL, 530, 'Winter Sports'),
(550, NULL, 530, 'Camping & Hiking'),
(551, NULL, 530, 'Scooters'),
(552, NULL, 530, 'Gym Equipment'),
(553, NULL, 530, 'Swimming & Diving'),
(554, NULL, 532, 'Action Figure'),
(555, NULL, 532, 'Baby Toys'),
(556, NULL, 532, 'Balloons'),
(557, NULL, 532, 'Candy Toys'),
(558, NULL, 532, 'Classic Toys'),
(559, NULL, 532, 'Dolls'),
(560, NULL, 532, 'Educational Toys'),
(561, NULL, 532, 'Baby Toys'),
(562, NULL, 532, 'Electronic Toys'),
(563, NULL, 532, 'Glass Marbles'),
(564, NULL, 532, 'Inflatable Toys'),
(565, NULL, 532, 'Light-Up Toys'),
(566, NULL, 532, 'Noise Maker'),
(568, NULL, 532, 'Other Toys & Hobbies'),
(569, NULL, 532, 'Outdoor Toys & Structures'),
(570, NULL, 532, 'Other Toys & Hobbies'),
(571, NULL, 532, 'Plastic Toys'),
(572, NULL, 532, 'Pretend Play & Preschool'),
(573, NULL, 532, 'Solar Toys'),
(574, NULL, 532, 'Toy Accessories'),
(575, NULL, 532, 'Toy Animal'),
(576, NULL, 532, 'Toy Guns'),
(577, NULL, 532, 'Toy Parts');

-- --------------------------------------------------------

--
-- Table structure for table `chatbot`
--

CREATE TABLE `chatbot` (
  `id` int(11) NOT NULL,
  `question` text,
  `answer` text,
  `date_time_created` datetime DEFAULT NULL,
  `date_time_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chatbot`
--

INSERT INTO `chatbot` (`id`, `question`, `answer`, `date_time_created`, `date_time_updated`) VALUES
(1, 'Hi', 'Welcome to O2. How can I help you today?\r\n', '2019-06-07 06:39:34', '2019-06-07 10:28:11'),
(2, 'How may I buy a product?', 'Register & Login add product and do online order ', '2019-06-07 06:40:33', NULL),
(3, 'what about delivery', 'Delivery is within 7 days from your orders', '2019-06-07 06:41:11', NULL),
(4, 'hello', 'Hi, How can I help you?\r\n\r\n', '2019-06-07 10:53:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` bigint(20) NOT NULL,
  `users_id` int(10) DEFAULT NULL,
  `company_name` varchar(127) DEFAULT NULL,
  `description` text,
  `file_logo` varchar(127) DEFAULT NULL,
  `business_type` varchar(127) DEFAULT NULL,
  `main_products` varchar(127) DEFAULT NULL,
  `total_annual_revenue` varchar(127) DEFAULT NULL,
  `total_employees` varchar(127) DEFAULT NULL,
  `year_established` varchar(127) DEFAULT NULL,
  `social_link` varchar(127) DEFAULT NULL,
  `email` varchar(127) DEFAULT NULL,
  `cell_phone` varchar(20) DEFAULT NULL,
  `land_phone` varchar(20) DEFAULT NULL,
  `country_id` int(10) DEFAULT NULL,
  `country_txt` varchar(64) DEFAULT NULL,
  `state` varchar(127) DEFAULT NULL,
  `city_town` varchar(127) DEFAULT NULL,
  `area` varchar(127) DEFAULT NULL,
  `zip_code` varchar(20) DEFAULT NULL,
  `address` text,
  `latitude` varchar(127) DEFAULT NULL,
  `longitude` varchar(127) DEFAULT NULL,
  `status` enum('active','inactive','decline','pending') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `users_id`, `company_name`, `description`, `file_logo`, `business_type`, `main_products`, `total_annual_revenue`, `total_employees`, `year_established`, `social_link`, `email`, `cell_phone`, `land_phone`, `country_id`, `country_txt`, `state`, `city_town`, `area`, `zip_code`, `address`, `latitude`, `longitude`, `status`) VALUES
(107, 32, 'Test', 'Test', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 227, '', '', '', '', '', '', '', '', ''),
(108, 33, 'fsdfsdf', '<p>sdfsd</p>', 'company_images/_108_2.jpg', '', '', '', '', '', '', '', '', '', 18, 'Bangladesh', 'Dhaka', 'Dhaka', 'Dhaka', 'Dhaka', 'Dhaka', '23.810332', '90.41251809999994', ''),
(109, 33, 'hgfhgfhf', '<p>hfghfh</p>', 'company_images/_109_logo2.png', 'gfhgfh', 'gfhfgh', 'gfhfgh', 'fghfghfg', 'gfhgf', 'hfh', 'hgfhfg', '', '', 231, 'United States', '', '', 'hghgfh', 'hgfhgf', 'ghghh', '37.09024', '-95.71289100000001', '');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(10) NOT NULL,
  `content` text,
  `date_time_created` datetime DEFAULT NULL,
  `date_time_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `content`, `date_time_created`, `date_time_updated`) VALUES
(2, '<p>Renewed US sanctions had led to worse economic conditions than during the country''s 1980-88 war with neighbouring Iraq, Mr Rouhani said.</p>\r\n<p>His comments came amid rising tensions with the US, which last week deployed warships and warplanes to the Gulf.</p>\r\n<p>Mr Rouhani, who has come under domestic political pressure, called for political unity to face down sanctions.</p>\r\n<p>"During the war we did not have a problem with our banks, oil sales or imports and exports, and there were only sanctions on arms purchases," Mr Rouhani told political activists in the capital, Tehran.</p>\r\n<p>"The pressures by enemies is a war unprecedented in the history of our Islamic revolution ... but I do not despair and have great hope for the future and believe that we can move past these difficult conditions provided that we are united," he said.</p>', '2019-05-12 12:05:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `country` varchar(200) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `country`) VALUES
(1, 'Afghanistan'),
(2, 'Åland Islands'),
(3, 'Albania'),
(4, 'Algeria'),
(5, 'American Samoa'),
(6, 'Andorra'),
(7, 'Angola'),
(8, 'Anguilla'),
(9, 'Antarctica'),
(10, 'Antigua and Barbuda'),
(11, 'Argentina'),
(12, 'Armenia'),
(13, 'Aruba'),
(14, 'Australia'),
(15, 'Austria'),
(16, 'Azerbaijan'),
(17, 'Bahamas'),
(18, 'Bahrain'),
(19, 'Bangladesh'),
(20, 'Barbados'),
(21, 'Belarus'),
(22, 'Belgium'),
(23, 'Belize'),
(24, 'Benin'),
(25, 'Bermuda'),
(26, 'Bhutan'),
(27, 'Bolivia'),
(28, 'Bosnia and Herzegovina'),
(29, 'Botswana'),
(30, 'Bouvet Island'),
(31, 'Brazil'),
(32, 'British Indian Ocean Territory'),
(33, 'Brunei Darussalam'),
(34, 'Bulgaria'),
(35, 'Burkina Faso'),
(36, 'Burundi'),
(37, 'Cambodia'),
(38, 'Cameroon'),
(39, 'Canada'),
(40, 'Cape Verde'),
(41, 'Cayman Islands'),
(42, 'Central African Republic'),
(43, 'Chad'),
(44, 'Chile'),
(45, 'China'),
(46, 'Christmas Island'),
(47, 'Cocos (Keeling) Islands'),
(48, 'Colombia'),
(49, 'Comoros'),
(50, 'Congo'),
(51, 'Congo, The Democratic Republic of the'),
(52, 'Cook Islands'),
(53, 'Costa Rica'),
(54, 'Côte D''Ivoire'),
(55, 'Croatia'),
(56, 'Cuba'),
(57, 'Cyprus'),
(58, 'Czech Republic'),
(59, 'Denmark'),
(60, 'Djibouti'),
(61, 'Dominica'),
(62, 'Dominican Republic'),
(63, 'Ecuador'),
(64, 'Egypt'),
(65, 'El Salvador'),
(66, 'Equatorial Guinea'),
(67, 'Eritrea'),
(68, 'Estonia'),
(69, 'Ethiopia'),
(70, 'Falkland Islands (Malvinas)'),
(71, 'Faroe Islands'),
(72, 'Fiji'),
(73, 'Finland'),
(74, 'France'),
(75, 'French Guiana'),
(76, 'French Polynesia'),
(77, 'French Southern Territories'),
(78, 'Gabon'),
(79, 'Gambia'),
(80, 'Georgia'),
(81, 'Germany'),
(82, 'Ghana'),
(83, 'Gibraltar'),
(84, 'Greece'),
(85, 'Greenland'),
(86, 'Grenada'),
(87, 'Guadeloupe'),
(88, 'Guam'),
(89, 'Guatemala'),
(90, 'Guernsey'),
(91, 'Guinea'),
(92, 'Guinea-Bissau'),
(93, 'Guyana'),
(94, 'Haiti'),
(95, 'Heard Island and McDonald Islands'),
(96, 'Holy See (Vatican City State)'),
(97, 'Honduras'),
(98, 'Hong Kong'),
(99, 'Hungary'),
(100, 'Iceland'),
(101, 'India'),
(102, 'Indonesia'),
(103, 'Iran, Islamic Republic of'),
(104, 'Iraq'),
(105, 'Ireland'),
(106, 'Isle of Man'),
(107, 'Israel'),
(108, 'Italy'),
(109, 'Jamaica'),
(110, 'Japan'),
(111, 'Jersey'),
(112, 'Jordan'),
(113, 'Kazakhstan'),
(114, 'Kenya'),
(115, 'Kiribati'),
(116, 'Korea, Democratic People''s Republic of'),
(117, 'Korea, Republic of'),
(118, 'Kuwait'),
(119, 'Kyrgyzstan'),
(120, 'Lao People''s Democratic Republic'),
(121, 'Latvia'),
(122, 'Lebanon'),
(123, 'Lesotho'),
(124, 'Liberia'),
(125, 'Libyan Arab Jamahiriya'),
(126, 'Liechtenstein'),
(127, 'Lithuania'),
(128, 'Luxembourg'),
(129, 'Macao'),
(130, 'Macedonia, The Former Yugoslav Republic of'),
(131, 'Madagascar'),
(132, 'Malawi'),
(133, 'Malaysia'),
(134, 'Maldives'),
(135, 'Mali'),
(136, 'Malta'),
(137, 'Marshall Islands'),
(138, 'Martinique'),
(139, 'Mauritania'),
(140, 'Mauritius'),
(141, 'Mayotte'),
(142, 'Mexico'),
(143, 'Micronesia, Federated States of'),
(144, 'Moldova, Republic of'),
(145, 'Monaco'),
(146, 'Mongolia'),
(147, 'Montenegro'),
(148, 'Montserrat'),
(149, 'Morocco'),
(150, 'Mozambique'),
(151, 'Myanmar'),
(152, 'Namibia'),
(153, 'Nauru'),
(154, 'Nepal'),
(155, 'Netherlands'),
(156, 'Netherlands Antilles'),
(157, 'New Caledonia'),
(158, 'New Zealand'),
(159, 'Nicaragua'),
(160, 'Niger'),
(161, 'Nigeria'),
(162, 'Niue'),
(163, 'Norfolk Island'),
(164, 'Northern Mariana Islands'),
(165, 'Norway'),
(166, 'Oman'),
(167, 'Pakistan'),
(168, 'Palau'),
(169, 'Palestinian Territory, Occupied'),
(170, 'Panama'),
(171, 'Papua New Guinea'),
(172, 'Paraguay'),
(173, 'Peru'),
(174, 'Philippines'),
(175, 'Pitcairn'),
(176, 'Poland'),
(177, 'Portugal'),
(178, 'Puerto Rico'),
(179, 'Qatar'),
(180, 'Reunion'),
(181, 'Romania'),
(182, 'Russian Federation'),
(183, 'Rwanda'),
(184, 'Saint Barthélemy'),
(185, 'Saint Helena'),
(186, 'Saint Kitts and Nevis'),
(187, 'Saint Lucia'),
(188, 'Saint Martin'),
(189, 'Saint Pierre and Miquelon'),
(190, 'Saint Vincent and the Grenadines'),
(191, 'Samoa'),
(192, 'San Marino'),
(193, 'Sao Tome and Principe'),
(194, 'Saudi Arabia'),
(195, 'Senegal'),
(196, 'Serbia'),
(197, 'Seychelles'),
(198, 'Sierra Leone'),
(199, 'Singapore'),
(200, 'Slovakia'),
(201, 'Slovenia'),
(202, 'Solomon Islands'),
(203, 'Somalia'),
(204, 'South Africa'),
(205, 'South Georgia and the South Sandwich Islands'),
(206, 'Spain'),
(207, 'Sri Lanka'),
(208, 'Sudan'),
(209, 'Suriname'),
(210, 'Svalbard and Jan Mayen'),
(211, 'Swaziland'),
(212, 'Sweden'),
(213, 'Switzerland'),
(214, 'Syrian Arab Republic'),
(215, 'Taiwan, Province Of China'),
(216, 'Tajikistan'),
(217, 'Tanzania, United Republic of'),
(218, 'Thailand'),
(219, 'Timor-Leste'),
(220, 'Togo'),
(221, 'Tokelau'),
(222, 'Tonga'),
(223, 'Trinidad and Tobago'),
(224, 'Tunisia'),
(225, 'Turkey'),
(226, 'Turkmenistan'),
(227, 'Turks and Caicos Islands'),
(228, 'Tuvalu'),
(229, 'Uganda'),
(230, 'Ukraine'),
(231, 'United Arab Emirates'),
(232, 'United Kingdom'),
(233, 'United States'),
(234, 'United States Minor Outlying Islands'),
(235, 'Uruguay'),
(236, 'Uzbekistan'),
(237, 'Vanuatu'),
(238, 'Venezuela'),
(239, 'Viet Nam'),
(240, 'Virgin Islands, British'),
(241, 'Virgin Islands, U.S.'),
(242, 'Wallis And Futuna'),
(243, 'Western Sahara'),
(244, 'Yemen'),
(245, 'Zambia'),
(246, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_information`
--

CREATE TABLE `delivery_information` (
  `id` int(10) NOT NULL,
  `content` text,
  `date_time_created` datetime DEFAULT NULL,
  `date_time_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_information`
--

INSERT INTO `delivery_information` (`id`, `content`, `date_time_created`, `date_time_updated`) VALUES
(1, '<p>Renewed US sanctions had led to worse economic conditions than during the country''s 1980-88 war with neighbouring Iraq, Mr Rouhani said.</p>\r\n<p>His comments came amid rising tensions with the US, which last week deployed warships and warplanes to the Gulf.</p>\r\n<p>Mr Rouhani, who has come under domestic political pressure, called for political unity to face down sanctions.</p>\r\n<p>"During the war we did not have a problem with our banks, oil sales or imports and exports, and there were only sanctions on arms purchases," Mr Rouhani told political activists in the capital, Tehran.</p>\r\n<p>"The pressures by enemies is a war unprecedented in the history of our Islamic revolution ... but I do not despair and have great hope for the future and believe that we can move past these difficult conditions provided that we are united," he said.</p>', '2019-05-13 10:02:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fb_app`
--

CREATE TABLE `fb_app` (
  `id` int(10) NOT NULL,
  `users_id` int(10) DEFAULT NULL,
  `appid` varchar(255) DEFAULT NULL,
  `appsecret` varchar(255) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fb_post`
--

CREATE TABLE `fb_post` (
  `id` int(11) NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `message` text,
  `title` text,
  `link` varchar(255) DEFAULT NULL,
  `description` text,
  `picture` varchar(255) DEFAULT NULL,
  `last_post_date_time` datetime DEFAULT NULL,
  `is_posted` enum('yes','no') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gift_voucher`
--

CREATE TABLE `gift_voucher` (
  `id` int(10) NOT NULL,
  `content` text,
  `date_time_created` datetime DEFAULT NULL,
  `date_time_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gift_voucher`
--

INSERT INTO `gift_voucher` (`id`, `content`, `date_time_created`, `date_time_updated`) VALUES
(1, '<p>Renewed US sanctions had led to worse economic conditions than during the country''s 1980-88 war with neighbouring Iraq, Mr Rouhani said.</p>\r\n<p>His comments came amid rising tensions with the US, which last week deployed warships and warplanes to the Gulf.</p>\r\n<p>Mr Rouhani, who has come under domestic political pressure, called for political unity to face down sanctions.</p>\r\n<p>"During the war we did not have a problem with our banks, oil sales or imports and exports, and there were only sanctions on arms purchases," Mr Rouhani told political activists in the capital, Tehran.</p>\r\n<p>"The pressures by enemies is a war unprecedented in the history of our Islamic revolution ... but I do not despair and have great hope for the future and believe that we can move past these difficult conditions provided that we are united," he said.</p>', '2019-05-13 09:36:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `home_page_category`
--

CREATE TABLE `home_page_category` (
  `id` int(11) NOT NULL,
  `category_id` int(10) DEFAULT NULL,
  `parent_category_txt` varchar(256) DEFAULT NULL,
  `category_txt` varchar(127) DEFAULT NULL,
  `display_position` enum('1st','2nd','3rd') DEFAULT NULL,
  `products_id` int(10) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `home_page_category`
--

INSERT INTO `home_page_category` (`id`, `category_id`, `parent_category_txt`, `category_txt`, `display_position`, `products_id`, `status`) VALUES
(1, 182, 'Apparel,Textiles & Accessories;Textile & Leather Product ;Thread', 'Thread', '2nd', 25, 'active'),
(2, 66, 'Agriculture & Food;Agriculture ;Other Agriculture Products', 'Other Agriculture Products', '1st', 26, 'active'),
(3, 250, 'Auto & Transportation;Automobiles & Motorcycles;Crank Mechanism', 'Crank Mechanism', '1st', 25, 'active'),
(4, 317, 'Bags, Shoes & Accessories;Luggage, Bags & Cases;Wallets', 'Wallets', '1st', 26, 'active'),
(5, 415, 'Electronics;Consumer Electronic;Speaker', 'Speaker', '3rd', 18, 'active'),
(6, 415, 'Electronics;Consumer Electronic;Speaker', 'Speaker', '3rd', 18, 'active'),
(7, 311, 'Bags, Shoes & Accessories;Luggage, Bags & Cases;Trolley Bags', 'Trolley Bags', '2nd', 44, 'active'),
(8, 545, 'Gifts, Sports & Toys;Sports & Entertainment;Team Sports', 'Team Sports', '2nd', 46, 'active'),
(9, 334, 'Bags, Shoes & Accessories;Shoes & Accessories;Shoes Stock', 'Shoes Stock', '2nd', 46, 'active'),
(10, 252, 'Auto & Transportation;Automobiles & Motorcycles;Exterior Accessories', 'Exterior Accessories', '2nd', 43, 'active'),
(11, 415, 'Electronics;Consumer Electronic;Speaker', 'Speaker', '2nd', 44, 'active'),
(12, 307, 'Bags, Shoes & Accessories;Luggage, Bags & Cases;Sports & Leisure Bags', 'Sports & Leisure Bags', '3rd', 47, 'active'),
(13, 482, 'Electrical Equipment, Components & Telecoms;Electrical Equipment & Supplies ;Transformers', 'Transformers', '3rd', 46, 'active'),
(14, 340, 'Electronics;Consumer Electronic', 'Consumer Electronic', '3rd', 44, 'active'),
(15, 519, 'Electrical Equipment, Components & Telecoms;Telecommunication ;Telephone Headsets', 'Telephone Headsets', '3rd', 45, 'active'),
(16, 67, 'Agriculture & Food;Agriculture ;Plant & Animal Oil', 'Plant & Animal Oil', '1st', 48, 'active'),
(17, 286, 'Auto & Transportation;Transportation;Railway Supplies', 'Railway Supplies', '3rd', 46, 'active'),
(18, 145, 'Apparel,Textiles & Accessories;Apparel;Maternity Clothing', 'Maternity Clothing', '1st', 46, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(10) NOT NULL,
  `orders_id` int(100) DEFAULT NULL,
  `products_id` int(10) DEFAULT NULL,
  `os0` varchar(100) DEFAULT NULL,
  `os1` varchar(100) DEFAULT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `item_number` varchar(100) DEFAULT NULL,
  `quantity` varchar(100) DEFAULT NULL,
  `currency` varchar(20) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `orders_id`, `products_id`, `os0`, `os1`, `item_name`, `item_number`, `quantity`, `currency`, `amount`) VALUES
(5, 6, 15, 'Body  : Chiffon Georgette with Embrodered\r\nDupatta  : Peure add Paar\r\nSleeve  : Peure\r\n', NULL, 'Fiona Neha Sharma', '- -', '1', '55', '3500.00'),
(6, 6, 21, '456546 4565465 5465465465 456', NULL, '565665', '46646 5464646', '1', 'AFA', '55.00'),
(7, 7, 18, '2323', NULL, '2323', '323 ', '1', 'ANG', '323.00'),
(8, 7, 21, '456546 4565465 5465465465 456', NULL, '565665', '46646 5464646', '1', 'AFA', '55.00'),
(9, 8, 18, '2323', NULL, '2323', '323 ', '1', 'ANG', '323.00'),
(10, 8, 21, '456546 4565465 5465465465 456', NULL, '565665', '46646 5464646', '1', 'AFA', '55.00'),
(11, 9, 18, '2323', NULL, '2323', '323 ', '1', 'ANG', '323.00'),
(12, 9, 21, '456546 4565465 5465465465 456', NULL, '565665', '46646 5464646', '1', 'AFA', '55.00');

-- --------------------------------------------------------

--
-- Table structure for table `news_letter`
--

CREATE TABLE `news_letter` (
  `id` int(10) NOT NULL,
  `name` varchar(127) NOT NULL,
  `content` text NOT NULL,
  `date_time_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news_letter`
--

INSERT INTO `news_letter` (`id`, `name`, `content`, `date_time_created`) VALUES
(1, 'ffffffffd', '<p>fgfgfggfgf</p>', '2019-05-12 19:59:33');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) NOT NULL,
  `products_id` int(10) DEFAULT NULL,
  `users_id` int(10) DEFAULT NULL,
  `shipping_address_id` int(10) DEFAULT NULL,
  `billing_information_id` int(10) DEFAULT NULL,
  `order_number` varchar(127) DEFAULT NULL,
  `invoice_number` varchar(127) DEFAULT NULL,
  `transactionid` varchar(127) DEFAULT NULL,
  `currency` varchar(20) DEFAULT NULL,
  `shipping_cost` decimal(10,2) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `transaction_fee` decimal(10,2) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `delivery_status` enum('escrow','pending','completed','return') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `products_id`, `users_id`, `shipping_address_id`, `billing_information_id`, `order_number`, `invoice_number`, `transactionid`, `currency`, `shipping_cost`, `total_amount`, `transaction_fee`, `date_created`, `delivery_status`) VALUES
(9, NULL, 9, 9, 17, '20190523145226', '20190523145226', '20190523145226', 'ANG', '60.00', '438.00', '13.14', '2019-05-23 14:52:26', 'pending'),
(8, NULL, 13, 8, 16, '20190523144903', '20190523144903', '20190523144903', 'ANG', '60.00', '438.00', '13.14', '2019-05-23 14:49:03', 'pending'),
(7, NULL, 9, 7, 15, '20190523143519', '20190523143519', '20190523143519', 'ANG', '60.00', '438.00', '13.14', '2019-05-23 14:35:19', 'pending'),
(6, NULL, 13, 6, 14, '20190507170047', '20190507170047', '20190507170047', '55', '60.00', '3615.00', '108.45', '2019-05-07 17:00:47', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) NOT NULL,
  `id_users` int(10) NOT NULL,
  `user_id` bigint(10) NOT NULL,
  `user_name` varchar(244) NOT NULL,
  `access_token` text NOT NULL,
  `type` smallint(5) NOT NULL,
  `message` longblob NOT NULL,
  `link` text NOT NULL,
  `picture` text NOT NULL,
  `picture_fbid` text NOT NULL,
  `name` longblob NOT NULL,
  `caption` text NOT NULL,
  `description` longblob NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `delete` enum('0','1') NOT NULL DEFAULT '0',
  `interval` int(10) NOT NULL,
  `timestamp` varchar(50) NOT NULL,
  `timestamp_repeat` varchar(30) NOT NULL,
  `timestamp_pause` varchar(30) NOT NULL,
  `cntposts` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `privacy_policy`
--

CREATE TABLE `privacy_policy` (
  `id` int(10) NOT NULL,
  `content` text,
  `date_time_created` datetime DEFAULT NULL,
  `date_time_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `privacy_policy`
--

INSERT INTO `privacy_policy` (`id`, `content`, `date_time_created`, `date_time_updated`) VALUES
(1, '<p>Renewed US sanctions had led to worse economic conditions than during the country''s 1980-88 war with neighbouring Iraq, Mr Rouhani said.</p>\r\n<p>His comments came amid rising tensions with the US, which last week deployed warships and warplanes to the Gulf.</p>\r\n<p>Mr Rouhani, who has come under domestic political pressure, called for political unity to face down sanctions.</p>\r\n<p>"During the war we did not have a problem with our banks, oil sales or imports and exports, and there were only sanctions on arms purchases," Mr Rouhani told political activists in the capital, Tehran.</p>\r\n<p>"The pressures by enemies is a war unprecedented in the history of our Islamic revolution ... but I do not despair and have great hope for the future and believe that we can move past these difficult conditions provided that we are united," he said.</p>', '2019-05-12 12:24:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) NOT NULL,
  `category_id` int(10) DEFAULT NULL,
  `parent_category_txt` varchar(256) DEFAULT NULL,
  `category_txt` varchar(64) DEFAULT NULL,
  `product_name` varchar(64) DEFAULT NULL,
  `product_title` varchar(64) DEFAULT NULL,
  `brand` varchar(64) DEFAULT NULL,
  `model` varchar(64) DEFAULT NULL,
  `sku` varchar(127) DEFAULT NULL,
  `description` text,
  `product_condition` varchar(127) DEFAULT NULL,
  `sticker` varchar(64) DEFAULT NULL,
  `gender_for` varchar(127) DEFAULT NULL,
  `age_for` varchar(127) DEFAULT NULL,
  `occasions` varchar(127) DEFAULT NULL,
  `material_used` varchar(127) DEFAULT NULL,
  `size` varchar(64) DEFAULT NULL,
  `color` varchar(127) DEFAULT NULL,
  `width` varchar(64) DEFAULT NULL,
  `height` varchar(64) DEFAULT NULL,
  `length` varchar(64) DEFAULT NULL,
  `width_height_length_unit` varchar(64) DEFAULT NULL,
  `weight` varchar(64) DEFAULT NULL,
  `weight_unit` varchar(64) DEFAULT NULL,
  `price` varchar(64) DEFAULT NULL,
  `discount` varchar(64) DEFAULT NULL,
  `net_price` varchar(64) DEFAULT NULL,
  `currency` varchar(20) DEFAULT NULL,
  `affiliate_commission` decimal(10,2) DEFAULT NULL,
  `file_products` varchar(127) DEFAULT NULL,
  `term_condition` text,
  `delivery_info` text,
  `damage_return` text,
  `product_display_position` varchar(256) DEFAULT NULL,
  `created_at` varchar(64) DEFAULT NULL,
  `updated_at` varchar(64) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `parent_category_txt`, `category_txt`, `product_name`, `product_title`, `brand`, `model`, `sku`, `description`, `product_condition`, `sticker`, `gender_for`, `age_for`, `occasions`, `material_used`, `size`, `color`, `width`, `height`, `length`, `width_height_length_unit`, `weight`, `weight_unit`, `price`, `discount`, `net_price`, `currency`, `affiliate_commission`, `file_products`, `term_condition`, `delivery_info`, `damage_return`, `product_display_position`, `created_at`, `updated_at`, `status`) VALUES
(15, 194, 'Apparel,Textiles & Accessories;Fashion Accessories ;Fashion Accessories Stock', 'Fashion Accessories Stock', 'Fiona Neha Sharma', 'FNS - 1901 ', 'India', '-', '-', 'Body  : Chiffon Georgette with Embrodered\r\nDupatta  : Peure add Paar\r\nSleeve  : Peure\r\n', 'Used', 'new', 'Female,Everyone', '3 -12 years old,18+,19+', '4545', 'rerer,fgfgdg,gfgfg', 'Free Size', 'WHITE,Not Specific,BLUE', '55', '55', '55', 'Meter', '55', 'GRAM', '3500', '10', '3500', '55', '1.10', 'products_images/15_1.jpg', '555', '555', '', '', NULL, '2019-05-26 13:56:34', 'active'),
(18, 85, 'Agriculture & Food;Food & Beverage ;Meat & Poultry', 'Meat & Poultry', '2323', '2323', '2323', '323', '', '<p>2323</p>', 'Used', '', 'Male,Everyone,Other', '13+ and above,3 -12 years old', '', '32323', 'M,L', 'BLACK,RED,BLUE', '33', '33', '33', 'Meter', '33', 'GRAM', '33', '323', '323', 'ANG', '1.10', 'products_images/18_2.jpg', '', '', '', 'Featured,Specials', NULL, '2019-05-26 14:20:49', 'active'),
(21, 668, 'Health & Beauty;Health & Medical;Medicines', 'Medicines', '565665', '646466', '464646', '46646', '5464646', '456546 4565465 5465465465 456', 'Used', 'new', 'Male,Female', '3 -12 years old,13+ and above', '4545', '54545', 'Free Size,L,M', 'WHITE,BLACK', '33', '33', '33', 'Meter', '33', 'CGRAM', '55', '55', '55', 'AFA', '1.10', 'products_images/21_33.jpg', '4543543535', '3454545', '54354535', 'Featured,Bestsellers,Latest', NULL, '2019-04-27 18:29:15', 'active'),
(23, 359, 'Electronics;Computer Hardware & Software;Keyboard Covers', 'Keyboard Covers', '565665', '646466', '464646', '46646', '5464646', 'Description  DescriptionDescriptionDe scriptionDescriptionDescrip ionDescriptionD escription DescriptionDescription', 'Used', 'sale', 'Everyone,Female,Other', 'Any,13+ and above,3 -12 years old', '4545', '54545', 'Free Size,S,M', 'Not Specific,ALL Color,BLACK,BLUE', '55', '55', '55', 'Meter', '55', 'GRAM', '11', '1', '10', 'BDT', '1.10', 'products_images/23_download_(4).jpg', '', '', '', 'Featured,Bestsellers,Latest', '2019-04-28 17:24:33', NULL, 'active'),
(24, 86, 'Agriculture & Food;Food & Beverage ;Other Food & Beverage', 'Other Food & Beverage', '565665', '646466', '464646', '46646', '5464646', 'dada sd ds dsds sdsdsd sdsdsd', 'Old', 'sale', 'Male,Female,Everyone,Other', 'Any,3 -12 years old,13+ and above,18+,19+,21+,25-28 years old,29-35 years old,36-40 years old,41-50 years old,50-60 years old', '4545', '54545', 'Free Size,S,M,L,XL,XXL,XXXL', 'ALL Color,Not Specific,WHITE,BLACK,RED,BLUE', '33', '33', '33', 'Meter', '33', 'GRAM', '44', '44', '44', '44', '1.10', 'products_images/24_download_(3).jpg', '444444444', 'ddd', 'ddd', 'Featured,Bestsellers,Latest', '2019-04-28 17:25:44', '2019-05-14 14:49:47', 'active'),
(25, 198, 'Apparel,Textiles & Accessories;Fashion Accessories ;Scarf, Hat & Glove Sets', 'Scarf, Hat & Glove Sets', '565665', '646466', '464646', '46646', '5464646', 'h fhfhfgh h hfhfgh hh hh fhfhfgh h hfhfgh hh hh fhfhfgh h hfhfgh hh hh fhfhfgh h hfhfgh hh hh fhfhfgh h hfhfgh hh hh fhfhfgh h hfhfgh hh hh fhfhfgh h hfhfgh hh hh fhfhfgh h hfhfgh hh hh fhfhfgh h hfhfgh hh hh fhfhfgh h hfhfgh hh h', 'Used', 'sale', 'Male,Female,Other,Everyone', 'Any,3 -12 years old,13+ and above', '4545', '54545', 'Free Size,Any,M,L,S,XXL,XXXL,XL', 'Not Specific,WHITE,BLACK,RED,GREEN,YELLOW,BLUE', '77', '77', '77', 'Meter', '77', 'GRAM', '77', '7', '77', 'BDT', '1.10', 'products_images/25_download.jpg', '', '', '', 'Featured,Bestsellers,Latest,Specials', '2019-04-28 17:27:44', '2019-05-26 14:20:28', 'active'),
(26, 466, 'Electrical Equipment, Components & Telecoms;Electrical Equipment & Supplies ;Batteries', 'Batteries', 'Energizer AA Batteries, Max Alkaline (8 Count)', 'Energizer AA Batteries', 'Energizer', 'Max Alkaline', 'AA0001', 'About the product\r\n8-pack of Energizer MAX alkaline AA batteries\r\nOur #1 Longest Lasting MAX AA battery powers everyday devices\r\nLeak resistant-construction protects your devices from leakage of fully used batteries for up to 2 years. Bonus: Itâ€™s guaranteed.\r\nPower for your nonstop familyâ€™s must-have devices like toys, flashlights, clocks, remotes, and more\r\nHolds power up to 10 years in storageâ€”so youâ€™re never left powerless\r\nFrom the makers of the #1 longest lasting AA battery (Energizer Ultimate Lithium), and the Energizer Bunny\r\nEnergizer created the worldâ€™s first zero mercury alkaline battery (commercially available since 1991), and it hasnâ€™t stopped innovating since.', 'New', '', '', '', '', '', '', '', '', '', '', 'Meter', '', 'GRAM', '11', '1', '10', '', '1.10', 'products_images/26_712zdlw-qql._sx522_.jpg', '', '', '', 'Specials', '2019-04-29 04:55:45', '2019-05-26 14:20:10', 'active'),
(27, 85, 'Agriculture & Food;Food & Beverage ;Meat & Poultry', 'Meat & Poultry', '565665', '646466', '464646', '46646', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Meter', '', 'GRAM', '', '', '', '', '1.10', 'products_images/27_meat.jpg.hashed.188ae3f5.desktop.story.inline.jpg', '', '', '', 'Featured,Bestsellers,Latest', '2019-05-14 14:52:33', '2019-05-14 15:04:08', 'active'),
(28, 85, 'Agriculture & Food;Food & Beverage ;Meat & Poultry', 'Meat & Poultry', 'Meat', 'fresh', 'Best', '46646', '5464646', '100% new high quality\r\n\r\nColor as shown\r\n\r\nStyle: as shown\r\n\r\nUses: home, kitchen supplies\r\n\r\nMaterial: ABS plastic\r\n\r\nPacking: 1pcs meat separator\r\n\r\nSize: 11cm*10.6cm\r\n\r\nFeature:\r\n\r\nEasy to clean without any food residue.\r\n\r\nStrong heat resistance, non-stick\r\n\r\nIt is easy to chop turkey, pork and beef. Turn the oven to bake.\r\n\r\nProtect your hands and prevent burns\r\n\r\nHigh quality plastic material', 'New', 'new', 'Everyone', '', 'Eid', '54545', 'Free Size,Any', '', '', '', '', 'Meter', '10', 'KG', '5000', '25', '3000', 'ff', '1.10', 'products_images/28_red-meat.jpg', 'ddd', 'ddds', 'sss', 'Featured', '2019-05-14 15:03:17', NULL, 'active'),
(29, 71, 'Agriculture & Food;Food & Beverage ;Baby Food', 'Baby Food', 'baby food', 'ok', 'best ', 'ffff', 'eeee', 'Hamburger patties mold maker\r\nDurable and easy to clean\r\nMade from high quality material PVC, safe and no harm to people.\r\nPut the meat in the Hamburger Press, and then it will do pretty shape for you.\r\nMaterial: PVC\r\nShape: Round\r\nColour: white\r\nMold Diameter: 13.2cm\r\nPressing Plate Diameter: 10.6cm\r\n', 'New', 'new', 'Everyone', '', '4545', '54545', 'Any,XXXL,L,M,S,XL', '', '33', '33', '33', 'Meter', '10', 'KG', '200', '44', '150', '44', '1.10', 'products_images/29_972a6540-bf32-4564-9df3-bb2dbca8e61e_1.bab079867e1ab77a7fbcda4058827ba4.jpeg', 'jjjj', 'jjj', ',,,', 'Featured,Bestsellers,Specials,Latest', '2019-05-14 15:07:50', NULL, 'active'),
(30, 70, 'Agriculture & Food;Food & Beverage ;Alcoholic Beverage', 'Alcoholic Beverage', 'Vodka', 'ok', 'smirnoff', '10', 'eee', '1) We will ship the goods within 3 business days after confirmed full payment. If the payment is not available, your order will be closed automatically.\r\n\r\n2) The buyer   are responsible for   any insurance, problems and damage which caused by shipping service such as accidents, delays or other issues. Also please check your parcel first  before you sign, if it has been damaged badly please do not sign for it and inform us. Thus we could make a claim to the shipping companies. If you are sign before checking the condition of the goods, any dispute regard to the damage during transportation, which raised after receiving the goods we could not compensate, since the goods has been signed, and the shipping company will not admit the damage. Hope you could understand this. Besides the buyer should to be responsible for  any tax or duty charged by their country. \r\n\r\n3) The goods will be   Marked as "gife" or "sample" for your easy customs clearance   and less charge.( If you want to declare the goods as other item name, or specify an value for custom, please inform us when making the order. )\r\n\r\n4) The   shipping time during Holiday Season   (Christmas, Chinese New Year etc) could be longer than usual time. Please add another 8-15 days as a delay.', 'New', 'sale', 'Female', '18+,25-28 years old,36-40 years old', '', '', 'Any,L', '', '', '', '', 'Meter', '33', 'CGRAM', '6000', '200', '5000', '55', '1.10', 'products_images/30_download.jpg', 'Good', 'N/A', 'beck', 'Bestsellers', '2019-05-14 15:12:12', NULL, 'active'),
(31, 75, 'Agriculture & Food;Food & Beverage ;Coffee', 'Coffee', 'Drink', 'Best', 'Nestle', 'fg', '5464646', '400ml Insulated Coffee Mug With Handle Stainless Steel Vacuum Office Coffeee Milk Water Cup Thermos Cup\r\n\r\nDescription:\r\nMaterial: 304 stainless steel + food grad PP\r\nColor: black,white\r\nCapacity: 400ml\r\nSize about: 10.5*9.5cm\r\nPortable,easy to take,this coffee mug with a handgrip,have a lid,can keep your coffee heat, perfect for drink tea ,milk,coffee etc.\r\n\r\nNotice:\r\n\r\nPlease allow 1-3mm error due to manual measurement and make sure you do not mind before ordering.\r\nPlease understand that colors may exist chromatic aberration as the different placement of pictures.', 'New', 'new', 'Everyone', '25-28 years old,21+', '4545', '54545', 'f,XXL', '', '33', '33', '', 'Meter', '33', 'GRAM', '200', '25', '44', '44', '1.10', 'products_images/31_download_(1).jpg', 'gh', 'hhhh', 'hhhh', '', '2019-05-14 15:15:27', NULL, 'active'),
(32, 458, 'Electronics;Security & Protection;CCTV Camera', 'CCTV Camera', 'Hot 4Ch Super Full HD 4MP AHD CCTV Camera DVR Video Recorder Hom', 'eee', 'fff', '46646', '5464646', 'HD AHD Camera Features\r\nMain Chip	High performance\r\nNVP2475H Latest Super processor \r\nImage Sensor	1/3ï¼‚OV4689 4MP\r\n4MP Effective Pixel	 PAL :2688(H)*1520(V)@25fps\r\nNTSC :2688(H)*1520(V)@30fps\r\nSignal System	PAL/NTSC\r\nMax Transmission Distance	Common 75-3 Cable can be up to 500m\r\nHD Lens size	4mm/6mm/8mm Default:6mm  (If need to replace other lens,Please give me a message in order )\r\n4MP HD IR-CUT	Auto switch\r\nMinimum illumination	0.01Lux F1.2AGC\r\nLED 	6pcs Array IR LEDs\r\nIR Distance	20-50meter\r\nShutter Speed	4/25s-1/45,000s\r\nWhite Balance	Auto White Balance\r\nHLC	Spport\r\nNoise Reduction	3D\r\nOperation Temperature	+55Â°C,-35Â°C\r\nHousing Material	Metal\r\nIP Grade	IP66', 'New', '', 'Everyone', '13+ and above,25-28 years old,36-40 years old', '4545', '54545', 'Any', '', '33', '33', '33', 'Meter', '33', 'KG', '9000', '200', '5000', '44', '1.10', 'products_images/32_cctv-camera-250x250.jpg', 'nnn', 'nnnn', 'nnn', 'Bestsellers,Specials,Latest', '2019-05-14 15:18:22', NULL, 'active'),
(33, 211, 'Apparel,Textiles & Accessories;Timepieces, Jewelry, Eyewear ;Jewelry', 'Jewelry', 'New 2018 Zinc Alloy Key Chain Women Girl Enamel Keychain Bag Tre', '646466', '464646', '46646', '5464646', 'Brand Name:Cring CocoFine or Fashion:FashionItem Type:Key ChainsCompatibility:All CompatibleMetal color:Light Yellow Gold Color,Silveris_customized:NoGender:WomenStyle:TrendyMetals Type:Zinc AlloyModel Number:K0011Material:MetalShape\\pattern:bag shapeStyle1:Enamel Key ChainsStyle2:Women Key ChainsStyle3:Girl Key ChainsStyle4:CuteStyle5:womens jewelleryStyle6:Girls jewelleryStyle7:jewellery for GirlStyle8:Key Chains for Girls', 'New', '', 'Everyone', '', '4545', '54545', 'XXL', 'ALL Color', '44', '55', '66', 'Meter', '33', 'KG', '15000', '252', '899', '44', '1.10', 'products_images/33_900x900_23.gif', 'kkk', 'kkkkkkkkkkk', 'jjjjjjjjjjjjjj', 'Featured', '2019-05-14 15:23:10', NULL, 'active'),
(34, 190, 'Apparel,Textiles & Accessories;Fashion Accessories ;Belt Accessories', 'Belt Accessories', 'FANGE men belt leather belt men automatic buckle high quality ma', 'ff', 'ff', 'ddd', 'eee', 'Brand Name:FANGEItem Type:BeltsGender:MenDepartment Name:AdultBelts Material:Split LeatherStyle:CasualPattern Type:SolidBuckle Width:4.0Buckle Length:8.0Belt Width:3.5Model Number:FG3506color:blackquality:good qualitystyle:classic vintage fashion stylePlace of Origin:GuangDong, China (Mainland)material:leather belts for menBelts Material:belts for menbuckle shape:automatic buckleName:belts for menBelts cummerbunds:Luxury automatic buckleCinturones hombre:Mens belts luxuryMen belt:genuine leather belts for menBelt Length:110cm,115cm,120cm,125cm,130cm', 'New', '', 'Everyone,Female,Male', '25-28 years old', '4545', 'gggg', '', 'BLUE,Not Specific,ALL Color,RED,GREEN,YELLOW,BLACK,WHITE', '999', '222', '444', 'Meter', '9999', 'KG', '09099', '777', '9999', '999', '1.10', 'products_images/34_71+zu2zy4rl._ux679_.jpg', 'lkjkljl', 'jkkljjkkllkj', 'jljkl', 'Featured,Specials,Bestsellers', '2019-05-14 15:26:42', NULL, 'active'),
(35, 211, 'Apparel,Textiles & Accessories;Timepieces, Jewelry, Eyewear ;Jewelry', 'Jewelry', 'New 2018 Zinc Alloy Key Chain Women Girl Enamel Keychain Bag Tre', 'Best', 'ersd', 'dfgdf', 'fgd', 'Brand Name:FANGEItem Type:BeltsGender:MenDepartment Name:AdultBelts Material:Split LeatherStyle:CasualPattern Type:SolidBuckle Width:4.0Buckle Length:8.0Belt Width:3.5Model Number:FG3506color:blackquality:good qualitystyle:classic vintage fashion stylePlace of Origin:GuangDong, China (Mainland)material:leather belts for menBelts Material:belts for menbuckle shape:automatic buckleName:belts for menBelts cummerbunds:Luxury automatic buckleCinturones hombre:Mens belts luxuryMen belt:genuine leather belts for menBelt Length:110cm,115cm,120cm,125cm,130cm', 'New', '', 'Everyone,Female', '3 -12 years old', '4545', '54545', 'Any,Free Size,XL,XXXL', '', '2623123', '23', '', 'Meter', '', 'GRAM', '', '', '', '', '1.10', 'products_images/35_3.jpg', '', '', '', '', '2019-05-14 15:27:53', '2019-05-18 09:20:00', 'active'),
(36, 298, 'Bags, Shoes & Accessories;Luggage, Bags & Cases;Bag & Luggage Making Materials', 'Bag & Luggage Making Materials', 'Hot 4Ch Super Full HD 4MP AHD CCTV Camera DVR Video Recorder Hom', '555', '5', '46646', 'fgd', 'gBrand Name:FANGEItem Type:BeltsGender:MenDepartment Name:AdultBelts Material:Split LeatherStyle:CasualPattern Type:SolidBuckle Width:4.0Buckle Length:8.0Belt Width:3.5Model Number:FG3506color:blackquality:good qualitystyle:classic vintage fashion stylePlace of Origin:GuangDong, China (Mainland)material:leather belts for menBelts Material:belts for menbuckle shape:automatic buckleName:belts for menBelts cummerbunds:Luxury automatic buckleCinturones hombre:Mens belts luxuryMen belt:genuine leather belts for menBelt Length:110cm,115cm,120cm,125cm,130cm', 'Used', '', 'Male,Other', '3 -12 years old', '4545', '54545', 'Free Size', 'ALL Color', '564', '54545', '5454', 'Meter', '4545', 'KG', '454', '4545', '4454', '54', '1.10', 'products_images/36_download_(2).jpg', 'tggf', 'fghfhdfh', '5545', 'Featured,Latest,Specials,Bestsellers', '2019-05-14 15:29:56', NULL, 'active'),
(37, 312, 'Bags, Shoes & Accessories;Luggage, Bags & Cases;Briefcases', 'Briefcases', 'WESTAL Bag men''s Genuine Leather briefcase Male man laptop bag n', '646466', 'ersd', '46646', '5464646', 'fsdddddddddddddddddddddddd', 'New', '', 'Everyone,Female,Other', '18+', '4545', '54545', 'Any,L,XXXL', '', '444', '555', '666', 'Meter', '888', 'GRAM', '5000', '7777', '8888', '999', '1.10', 'products_images/37_download_(3).jpg', 'yuyu', 'yujjjjfghhjj', '888', 'Featured,Specials,Bestsellers', '2019-05-14 15:32:44', NULL, 'active'),
(38, 323, 'Bags, Shoes & Accessories;Shoes & Accessories;Dance Shoes', 'Dance Shoes', '2017 Black Swallowtail Ds Stage Dress Broadway Magician costumes', 'Best', 'Nestle', '46646', '5464646', '2017 Black Swallowtail Ds Stage Dress Broadway Magician costumes Bar Nightclub Start Dance Costume Show clothing', '', '', 'Everyone,Female,Other', '18+,13+ and above,21+', '4545', '54545', 'M,XL,XXXL', 'ALL Color,Not Specific', '33', '444', '555', 'Meter', '66', 'GRAM', '15000', '4545', '7777', '7', '1.10', 'products_images/38_bloch_s0499m_-_elasta_bootie_slip_on_leather_jazz_shoes_mens_black_900x.jpg', 'yyuhggh', 'jjjjjjjjjjjjj', 'jjjjjjjjjjkkkkkkkkkkk', 'Featured,Specials,Latest,Bestsellers', '2019-05-14 15:35:56', NULL, 'active'),
(39, 466, 'Electrical Equipment, Components & Telecoms;Electrical Equipment & Supplies ;Batteries', 'Batteries', '3 Pcs LP-E6 LP E6 LP-E6N Battery Japan Sanyo Cell + 3 Battery ca', 'ddd', 'eee', 'eee', '333', '3333', '', '', '', '13+ and above,21+,29-35 years old,36-40 years old,50-60 years old,Senior Citizen (65+)', '', '', 'Free Size,M,XL,XXL,XXXL', '', '33', '332', '2222', 'Meter', '2333', 'KG', '44444', '44', '5555', '54', '1.10', 'products_images/39_download_(4).jpg', 'reqwwwwwwwwwwwwwwww', 'qrewwwwwwwwwwwwwwwwwwwwww', 'rrrrrrrrrrrrrrrrrqqqqqqq', 'rrrrrr,Bestsellers,Specials,Latest,Featured', '2019-05-14 15:38:10', NULL, 'active'),
(40, 435, 'Electronics;Home Appliance;Air Conditioners', 'Air Conditioners', 'Hot 4Ch Super Full HD 4MP AHD CCTV Camera DVR Video Recorder Hom', '555', 'Nestle', '46646', '5464646', '3 Pcs LP-E6 LP E6 LP-E6N Battery Japan Sanyo Cell + 3 Battery case for Canon EOS 6D 7D 5DS 5DSR 5D Mark II 5D 60D 60Da 70D 80D', 'New', '', 'Everyone,Female,Other,Male', '21+,25-28 years old,13+ and above,19+,18+', '4545', '54545', 'Any,M,XL,XXXL,XXL,L,S', 'ALL Color', '11', '222', '333', 'Meter', '66', 'GRAM', '5000', '44', '9999', '7', '1.10', 'products_images/40_rca-window-air-conditioners-racm5005-64_1000.jpg', '0099', '888', '88ii', 'Featured,Specials,Latest', '2019-05-14 15:52:54', NULL, 'active'),
(41, 587, 'Gifts, Sports & Toys;Gifts & Crafts ;Bamboo Crafts', 'Bamboo Crafts', 'Hot 4Ch Super Full HD 4MP AHD CCTV Camera DVR Video Recorder Hom', 'eee', 'best ', '46646', '5464646', '3 Pcs LP-E6 LP E6 LP-E6N Battery Japan Sanyo Cell + 3 Battery case for Canon EOS 6D 7D 5DS 5DSR 5D Mark II 5D 60D 60Da 70D 80D', 'Used', '', 'Everyone,Female,Other,Male', '25-28 years old', '4545', '54545', 'Any,Free Size,S,L,XL,XXL,XXXL', 'ALL Color,WHITE,BLACK,BLUE,YELLOW', '', '', '', 'Meter', '33', 'GRAM', '9000', '44', '899', '44', '1.10', 'products_images/41_maxresdefault.jpg', 'ggg', 'fggggggggg', 'ggggggggggg', 'Featured,Bestsellers,Specials,Latest', '2019-05-14 15:55:23', NULL, 'active'),
(42, 194, 'Apparel,Textiles & Accessories;Fashion Accessories ;Fashion Accessories Stock', 'Fashion Accessories Stock', 'Fiona Neha Sharma', 'FNS - 1901 ', 'India', '-', '-', 'Body  : Chiffon Georgette with Embrodered\r\nDupatta  : Peure add Paar\r\nSleeve  : Peure\r\n', 'Used', 'new', 'Female,Everyone', '3 -12 years old,18+,19+', '4545', 'rerer,fgfgdg,gfgfg', 'Free Size', 'WHITE,Not Specific,BLUE', '55', '55', '55', 'Meter', '55', 'GRAM', '3500', '10', '3500', '55', '1.10', 'products_images/15_1.jpg', '555', '555', '', '', NULL, '2019-05-14 14:56:19', 'active'),
(43, 85, 'Agriculture & Food;Food & Beverage ;Meat & Poultry', 'Meat & Poultry', '2323', '2323', '2323', '323', '', '<p>2323</p>', 'Used', '', 'Male,Everyone,Other', '13+ and above,3 -12 years old', '', '32323', 'M,L', 'BLACK,RED,BLUE', '33', '33', '33', 'Meter', '33', 'GRAM', '33', '323', '323', 'ANG', '1.10', 'products_images/18_2.jpg', '', '', '', 'Featured,Specials', NULL, '2019-04-29 05:45:24', 'active'),
(44, 668, 'Health & Beauty;Health & Medical;Medicines', 'Medicines', '565665', '646466', '464646', '46646', '5464646', '456546 4565465 5465465465 456', 'Used', 'new', 'Male,Female', '3 -12 years old,13+ and above', '4545', '54545', 'Free Size,L,M', 'WHITE,BLACK', '33', '33', '33', 'Meter', '33', 'CGRAM', '55', '55', '55', 'AFA', '1.10', 'products_images/21_33.jpg', '4543543535', '3454545', '54354535', 'Featured,Bestsellers,Latest', NULL, '2019-04-27 18:29:15', 'active'),
(45, 359, 'Electronics;Computer Hardware & Software;Keyboard Covers', 'Keyboard Covers', '565665', '646466', '464646', '46646', '5464646', 'Description  DescriptionDescriptionDe scriptionDescriptionDescrip ionDescriptionD escription DescriptionDescription', 'Used', 'sale', 'Everyone,Female,Other', 'Any,13+ and above,3 -12 years old', '4545', '54545', 'Free Size,S,M', 'Not Specific,ALL Color,BLACK,BLUE', '55', '55', '55', 'Meter', '55', 'GRAM', '11', '1', '10', 'BDT', '1.10', 'products_images/23_download_(4).jpg', '', '', '', 'Featured,Bestsellers,Latest', '2019-04-28 17:24:33', NULL, 'active'),
(46, 86, 'Agriculture & Food;Food & Beverage ;Other Food & Beverage', 'Other Food & Beverage', '565665', '646466', '464646', '46646', '5464646', 'dada sd ds dsds sdsdsd sdsdsd', 'Old', 'sale', 'Male,Female,Everyone,Other', 'Any,3 -12 years old,13+ and above,18+,19+,21+,25-28 years old,29-35 years old,36-40 years old,41-50 years old,50-60 years old', '4545', '54545', 'Free Size,S,M,L,XL,XXL,XXXL', 'ALL Color,Not Specific,WHITE,BLACK,RED,BLUE', '33', '33', '33', 'Meter', '33', 'GRAM', '44', '44', '44', '44', '1.10', 'products_images/24_download_(3).jpg', '444444444', 'ddd', 'ddd', 'Featured,Bestsellers,Latest', '2019-04-28 17:25:44', '2019-05-14 14:49:47', 'active'),
(47, 198, 'Apparel,Textiles & Accessories;Fashion Accessories ;Scarf, Hat & Glove Sets', 'Scarf, Hat & Glove Sets', '565665', '646466', '464646', '46646', '5464646', 'h fhfhfgh h hfhfgh hh hh fhfhfgh h hfhfgh hh hh fhfhfgh h hfhfgh hh hh fhfhfgh h hfhfgh hh hh fhfhfgh h hfhfgh hh hh fhfhfgh h hfhfgh hh hh fhfhfgh h hfhfgh hh hh fhfhfgh h hfhfgh hh hh fhfhfgh h hfhfgh hh hh fhfhfgh h hfhfgh hh h', 'Used', 'sale', 'Male,Female,Other,Everyone', 'Any,3 -12 years old,13+ and above', '4545', '54545', 'Free Size,Any,M,L,S,XXL,XXXL,XL', 'Not Specific,WHITE,BLACK,RED,GREEN,YELLOW,BLUE', '77', '77', '77', 'Meter', '77', 'GRAM', '77', '7', '77', 'BDT', '1.10', 'products_images/25_download.jpg', '', '', '', 'Featured,Bestsellers,Latest,Specials', '2019-04-28 17:27:44', '2019-05-26 14:01:46', 'active'),
(48, 466, 'Electrical Equipment, Components & Telecoms;Electrical Equipment & Supplies ;Batteries', 'Batteries', 'Energizer AA Batteries, Max Alkaline (8 Count)', 'Energizer AA Batteries', 'Energizer', 'Max Alkaline', 'AA0001', 'About the product\r\n8-pack of Energizer MAX alkaline AA batteries\r\nOur #1 Longest Lasting MAX AA battery powers everyday devices\r\nLeak resistant-construction protects your devices from leakage of fully used batteries for up to 2 years. Bonus: Itâ€™s guaranteed.\r\nPower for your nonstop familyâ€™s must-have devices like toys, flashlights, clocks, remotes, and more\r\nHolds power up to 10 years in storageâ€”so youâ€™re never left powerless\r\nFrom the makers of the #1 longest lasting AA battery (Energizer Ultimate Lithium), and the Energizer Bunny\r\nEnergizer created the worldâ€™s first zero mercury alkaline battery (commercially available since 1991), and it hasnâ€™t stopped innovating since.', 'New', '', '', '', '', '', '', '', '', '', '', 'Meter', '', 'GRAM', '11', '1', '10', '', '1.10', 'products_images/26_712zdlw-qql._sx522_.jpg', '', '', '', 'Specials', '2019-04-29 04:55:45', '2019-05-26 14:02:08', 'active'),
(49, 85, 'Agriculture & Food;Food & Beverage ;Meat & Poultry', 'Meat & Poultry', '565665', '646466', '464646', '46646', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Meter', '', 'GRAM', '', '', '', '', '1.10', 'products_images/27_meat.jpg.hashed.188ae3f5.desktop.story.inline.jpg', '', '', '', 'Featured,Bestsellers,Latest', '2019-05-14 14:52:33', '2019-05-14 15:04:08', 'active'),
(50, 85, 'Agriculture & Food;Food & Beverage ;Meat & Poultry', 'Meat & Poultry', 'Meat', 'fresh', 'Best', '46646', '5464646', '100% new high quality\r\n\r\nColor as shown\r\n\r\nStyle: as shown\r\n\r\nUses: home, kitchen supplies\r\n\r\nMaterial: ABS plastic\r\n\r\nPacking: 1pcs meat separator\r\n\r\nSize: 11cm*10.6cm\r\n\r\nFeature:\r\n\r\nEasy to clean without any food residue.\r\n\r\nStrong heat resistance, non-stick\r\n\r\nIt is easy to chop turkey, pork and beef. Turn the oven to bake.\r\n\r\nProtect your hands and prevent burns\r\n\r\nHigh quality plastic material', 'New', 'new', 'Everyone', '', 'Eid', '54545', 'Free Size,Any', '', '', '', '', 'Meter', '10', 'KG', '5000', '25', '3000', 'ff', '1.10', 'products_images/28_red-meat.jpg', 'ddd', 'ddds', 'sss', 'Featured', '2019-05-14 15:03:17', NULL, 'active'),
(51, 71, 'Agriculture & Food;Food & Beverage ;Baby Food', 'Baby Food', 'baby food', 'ok', 'best ', 'ffff', 'eeee', 'Hamburger patties mold maker\r\nDurable and easy to clean\r\nMade from high quality material PVC, safe and no harm to people.\r\nPut the meat in the Hamburger Press, and then it will do pretty shape for you.\r\nMaterial: PVC\r\nShape: Round\r\nColour: white\r\nMold Diameter: 13.2cm\r\nPressing Plate Diameter: 10.6cm\r\n', 'New', 'new', 'Everyone', '', '4545', '54545', 'Any,XXXL,L,M,S,XL', '', '33', '33', '33', 'Meter', '10', 'KG', '200', '44', '150', '44', '1.10', 'products_images/29_972a6540-bf32-4564-9df3-bb2dbca8e61e_1.bab079867e1ab77a7fbcda4058827ba4.jpeg', 'jjjj', 'jjj', ',,,', 'Featured,Bestsellers,Specials,Latest', '2019-05-14 15:07:50', NULL, 'active'),
(52, 70, 'Agriculture & Food;Food & Beverage ;Alcoholic Beverage', 'Alcoholic Beverage', 'Vodka', 'ok', 'smirnoff', '10', 'eee', '1) We will ship the goods within 3 business days after confirmed full payment. If the payment is not available, your order will be closed automatically.\r\n\r\n2) The buyer   are responsible for   any insurance, problems and damage which caused by shipping service such as accidents, delays or other issues. Also please check your parcel first  before you sign, if it has been damaged badly please do not sign for it and inform us. Thus we could make a claim to the shipping companies. If you are sign before checking the condition of the goods, any dispute regard to the damage during transportation, which raised after receiving the goods we could not compensate, since the goods has been signed, and the shipping company will not admit the damage. Hope you could understand this. Besides the buyer should to be responsible for  any tax or duty charged by their country. \r\n\r\n3) The goods will be   Marked as "gife" or "sample" for your easy customs clearance   and less charge.( If you want to declare the goods as other item name, or specify an value for custom, please inform us when making the order. )\r\n\r\n4) The   shipping time during Holiday Season   (Christmas, Chinese New Year etc) could be longer than usual time. Please add another 8-15 days as a delay.', 'New', 'sale', 'Female', '18+,25-28 years old,36-40 years old', '', '', 'Any,L', '', '', '', '', 'Meter', '33', 'CGRAM', '6000', '200', '5000', '55', '1.10', 'products_images/30_download.jpg', 'Good', 'N/A', 'beck', 'Bestsellers', '2019-05-14 15:12:12', NULL, 'active'),
(53, 75, 'Agriculture & Food;Food & Beverage ;Coffee', 'Coffee', 'Drink', 'Best', 'Nestle', 'fg', '5464646', '400ml Insulated Coffee Mug With Handle Stainless Steel Vacuum Office Coffeee Milk Water Cup Thermos Cup\r\n\r\nDescription:\r\nMaterial: 304 stainless steel + food grad PP\r\nColor: black,white\r\nCapacity: 400ml\r\nSize about: 10.5*9.5cm\r\nPortable,easy to take,this coffee mug with a handgrip,have a lid,can keep your coffee heat, perfect for drink tea ,milk,coffee etc.\r\n\r\nNotice:\r\n\r\nPlease allow 1-3mm error due to manual measurement and make sure you do not mind before ordering.\r\nPlease understand that colors may exist chromatic aberration as the different placement of pictures.', 'New', 'new', 'Everyone', '25-28 years old,21+', '4545', '54545', 'XXL', '', '33', '33', '', 'Meter', '33', 'GRAM', '200', '25', '44', '44', '1.10', 'products_images/31_download_(1).jpg', 'gh', 'hhhh', 'hhhh', '', '2019-05-14 15:15:27', '2019-05-26 14:01:14', 'active'),
(54, 458, 'Electronics;Security & Protection;CCTV Camera', 'CCTV Camera', 'Hot 4Ch Super Full HD 4MP AHD CCTV Camera DVR Video Recorder Hom', 'eee', 'fff', '46646', '5464646', 'HD AHD Camera Features\r\nMain Chip	High performance\r\nNVP2475H Latest Super processor \r\nImage Sensor	1/3ï¼‚OV4689 4MP\r\n4MP Effective Pixel	 PAL :2688(H)*1520(V)@25fps\r\nNTSC :2688(H)*1520(V)@30fps\r\nSignal System	PAL/NTSC\r\nMax Transmission Distance	Common 75-3 Cable can be up to 500m\r\nHD Lens size	4mm/6mm/8mm Default:6mm  (If need to replace other lens,Please give me a message in order )\r\n4MP HD IR-CUT	Auto switch\r\nMinimum illumination	0.01Lux F1.2AGC\r\nLED 	6pcs Array IR LEDs\r\nIR Distance	20-50meter\r\nShutter Speed	4/25s-1/45,000s\r\nWhite Balance	Auto White Balance\r\nHLC	Spport\r\nNoise Reduction	3D\r\nOperation Temperature	+55Â°C,-35Â°C\r\nHousing Material	Metal\r\nIP Grade	IP66', 'New', '', 'Everyone', '13+ and above,25-28 years old,36-40 years old', '4545', '54545', 'Any', '', '33', '33', '33', 'Meter', '33', 'GRAM', '9000', '200', '5000', '44', '1.10', 'products_images/32_cctv-camera-250x250.jpg', 'nnn', 'nnnn', 'nnn', 'Bestsellers,Specials,Latest', '2019-05-14 15:18:22', '2019-05-26 14:00:51', 'active'),
(55, 211, 'Apparel,Textiles & Accessories;Timepieces, Jewelry, Eyewear ;Jewelry', 'Jewelry', 'New 2018 Zinc Alloy Key Chain Women Girl Enamel Keychain Bag Tre', '646466', '464646', '46646', '5464646', 'Brand Name:Cring CocoFine or Fashion:FashionItem Type:Key ChainsCompatibility:All CompatibleMetal color:Light Yellow Gold Color,Silveris_customized:NoGender:WomenStyle:TrendyMetals Type:Zinc AlloyModel Number:K0011Material:MetalShape\\pattern:bag shapeStyle1:Enamel Key ChainsStyle2:Women Key ChainsStyle3:Girl Key ChainsStyle4:CuteStyle5:womens jewelleryStyle6:Girls jewelleryStyle7:jewellery for GirlStyle8:Key Chains for Girls', 'New', '', 'Everyone', '', '4545', '54545', 'XXL', 'ALL Color', '44', '55', '66', 'Meter', '33', 'GRAM', '15000', '252', '899', '44', '1.10', 'products_images/33_900x900_23.gif', 'kkk', 'kkkkkkkkkkk', 'jjjjjjjjjjjjjj', 'Featured', '2019-05-14 15:23:10', '2019-05-26 14:00:33', 'active'),
(56, 190, 'Apparel,Textiles & Accessories;Fashion Accessories ;Belt Accessories', 'Belt Accessories', 'FANGE men belt leather belt men automatic buckle high quality ma', 'ff', 'ff', 'ddd', 'eee', 'Brand Name:FANGEItem Type:BeltsGender:MenDepartment Name:AdultBelts Material:Split LeatherStyle:CasualPattern Type:SolidBuckle Width:4.0Buckle Length:8.0Belt Width:3.5Model Number:FG3506color:blackquality:good qualitystyle:classic vintage fashion stylePlace of Origin:GuangDong, China (Mainland)material:leather belts for menBelts Material:belts for menbuckle shape:automatic buckleName:belts for menBelts cummerbunds:Luxury automatic buckleCinturones hombre:Mens belts luxuryMen belt:genuine leather belts for menBelt Length:110cm,115cm,120cm,125cm,130cm', 'New', '', 'Everyone,Female,Male', '25-28 years old', '4545', 'gggg', '', 'BLUE,Not Specific,ALL Color,RED,GREEN,YELLOW,BLACK,WHITE', '999', '222', '444', 'Meter', '9999', 'GRAM', '09099', '777', '9999', '999', '1.10', 'products_images/34_71+zu2zy4rl._ux679_.jpg', 'lkjkljl', 'jkkljjkkllkj', 'jljkl', 'Featured,Specials,Bestsellers', '2019-05-14 15:26:42', '2019-05-26 13:58:36', 'active'),
(57, 211, 'Apparel,Textiles & Accessories;Timepieces, Jewelry, Eyewear ;Jewelry', 'Jewelry', 'Jewelry ', 'Best', 'ersd', 'dfgdf', 'fgd', 'Brand Name:FANGEItem Type:BeltsGender:MenDepartment Name:AdultBelts Material:Split LeatherStyle:CasualPattern Type:SolidBuckle Width:4.0Buckle Length:8.0Belt Width:3.5Model Number:FG3506color:blackquality:good qualitystyle:classic vintage fashion stylePlace of Origin:GuangDong, China (Mainland)material:leather belts for menBelts Material:belts for menbuckle shape:automatic buckleName:belts for menBelts cummerbunds:Luxury automatic buckleCinturones hombre:Mens belts luxuryMen belt:genuine leather belts for menBelt Length:110cm,115cm,120cm,125cm,130cm', 'Used', 'new', 'Everyone,Female,Other,Male', '3 -12 years old,25-28 years old,36-40 years old,29-35 years old,50-60 years old,41-50 years old,18+,21+', 'Crismaus', 'Aluminium', 'Any,Free Size,XL,XXXL', 'Not Specific,WHITE,BLACK,RED,BLUE,YELLOW,GREEN', '20', '23', '20', 'Meter', '1', 'GRAM', '500', '100', '190', '44', '1.10', 'products_images/57_download_(1).jpg', 'yes', '252 Pieces Min. Order\r\nMaterial: Brass\r\nPlating: Brass polishe or Gold colour\r\nBrand Name: Jewallary\r\nPlace of Origin: Uttar Pradesh,India\r\nModel Number: 1366\r\nTechnics: Brass Sheet', 'Return', 'Bestsellers,Latest,Specials,Featured', '2019-05-14 15:27:53', '2019-05-24 08:16:27', 'active'),
(58, 298, 'Bags, Shoes & Accessories;Luggage, Bags & Cases;Bag & Luggage Making Materials', 'Bag & Luggage Making Materials', 'Hot 4Ch Super Full HD 4MP AHD CCTV Camera DVR Video Recorder Hom', '555', '5', '46646', 'fgd', 'gBrand Name:FANGEItem Type:BeltsGender:MenDepartment Name:AdultBelts Material:Split LeatherStyle:CasualPattern Type:SolidBuckle Width:4.0Buckle Length:8.0Belt Width:3.5Model Number:FG3506color:blackquality:good qualitystyle:classic vintage fashion stylePlace of Origin:GuangDong, China (Mainland)material:leather belts for menBelts Material:belts for menbuckle shape:automatic buckleName:belts for menBelts cummerbunds:Luxury automatic buckleCinturones hombre:Mens belts luxuryMen belt:genuine leather belts for menBelt Length:110cm,115cm,120cm,125cm,130cm', 'Used', '', 'Male,Other', '3 -12 years old', '4545', '54545', 'Free Size', 'ALL Color', '564', '54545', '5454', 'Meter', '4545', 'GRAM', '454', '4545', '4454', '54', '1.10', 'products_images/36_download_(2).jpg', 'tggf', 'fghfhdfh', '5545', 'Featured,Latest,Specials,Bestsellers', '2019-05-14 15:29:56', '2019-05-26 13:57:37', 'active'),
(59, 312, 'Bags, Shoes & Accessories;Luggage, Bags & Cases;Briefcases', 'Briefcases', 'WESTAL Bag men''s Genuine Leather briefcase Male man laptop bag n', '646466', 'ersd', '46646', '5464646', 'fsdddddddddddddddddddddddd', 'New', '', 'Everyone,Female,Other', '18+', '4545', '54545', 'Any,L,XXXL', '', '444', '555', '666', 'Meter', '888', 'GRAM', '5000', '7777', '8888', '999', '1.10', 'products_images/37_download_(3).jpg', 'yuyu', 'yujjjjfghhjj', '888', 'Featured,Specials,Bestsellers', '2019-05-14 15:32:44', '2019-05-26 13:58:16', 'active'),
(60, 323, 'Bags, Shoes & Accessories;Shoes & Accessories;Dance Shoes', 'Dance Shoes', '2017 Black Swallowtail Ds Stage Dress Broadway Magician costumes', 'Best', 'Nestle', '46646', '5464646', '2017 Black Swallowtail Ds Stage Dress Broadway Magician costumes Bar Nightclub Start Dance Costume Show clothing', '', '', 'Everyone,Female,Other', '18+,13+ and above,21+', '4545', '54545', 'M,XL,XXXL', 'ALL Color,Not Specific', '33', '444', '555', 'Meter', '66', 'GRAM', '15000', '4545', '7777', '7', '1.10', 'products_images/38_bloch_s0499m_-_elasta_bootie_slip_on_leather_jazz_shoes_mens_black_900x.jpg', 'yyuhggh', 'jjjjjjjjjjjjj', 'jjjjjjjjjjkkkkkkkkkkk', 'Featured,Specials,Latest,Bestsellers', '2019-05-14 15:35:56', '2019-05-26 13:57:56', 'active'),
(61, 466, 'Electrical Equipment, Components & Telecoms;Electrical Equipment & Supplies ;Batteries', 'Batteries', 'Cheap price deep cycle storage battery 12v 7ah 20hr sealed lead ', 'dd64144HGFAd', 'Platinam', '789FGSRTS12', '25', 'Quick Details\r\nPlace of Origin:\r\nGuangdong, China (Mainland)\r\nBrand Name:\r\nPKCELL\r\nModel Number:\r\nPK1270\r\nUsage:\r\nUPS\r\nSealed Type:\r\nSealed\r\nMaintenance Type:\r\nFree\r\nWeight:\r\n2.05 kg\r\nName:\r\ndeep cycle storage battery 12v 7ah 20hr sealed lead acid battery\r\nBattery type:\r\nSealed Lead Acid Battery\r\nBrand:\r\nPKCELL or OEM\r\nIf rechargeable:\r\nyes\r\nColor:\r\nBlack & Grey or other colors\r\nPackage:\r\n8pcs/CTN\r\nStocks:\r\n300000pcs\r\nMain market:\r\n80% to Eu & South America & North Amercia\r\nApplication:\r\nUPS,solar system. power storage,security system', 'REPAIRED', 'new', 'Everyone,Female,Other,Male', '13+ and above,21+,29-35 years old,36-40 years old,50-60 years old,Senior Citizen (65+)', 'Crismas Day', 'Silicon', 'Free Size,M,XL,XXL,XXXL', 'ALL Color,Not Specific,BLACK,RED,BLUE,YELLOW,GREEN,WHITE', '33', '332', '2222', 'Meter', '20', 'GRAM', '1500', '300', '1200', '54', '1.10', 'products_images/61_download.jpg', 'Good', 'Quick Details\r\nPlace of Origin:\r\nGuangdong, China (Mainland)\r\nBrand Name:\r\nPKCELL\r\nModel Number:\r\nPK1270\r\nUsage:\r\nUPS\r\nSealed Type:\r\nSealed\r\nMaintenance Type:\r\nFree\r\nWeight:\r\n2.05 kg\r\nName:\r\ndeep cycle storage battery 12v 7ah 20hr sealed lead acid battery\r\nBattery type:\r\nSealed Lead Acid Battery\r\nBrand:\r\nPKCELL or OEM\r\nIf rechargeable:\r\nyes\r\nColor:\r\nBlack & Grey or other colors\r\nPackage:\r\n8pcs/CTN\r\nStocks:\r\n300000pcs\r\nMain market:\r\n80% to Eu & South America & North Amercia\r\nApplication:\r\nUPS,solar system. power storage,security system', 'Yes', 'Bestsellers,Specials,Latest,Featured', '2019-05-14 15:38:10', '2019-05-26 13:57:12', 'active'),
(62, 435, 'Electronics;Home Appliance;Air Conditioners', 'Air Conditioners', 'Double outlet output solar window air conditioner ', 'Window Mounted Air Conditioners', 'Nestle', 'HGH&89JNK', 'dfsgggf', '3 Pcs LP-E6 LP E6 LP-E6N Battery Japan Sanyo Cell + 3 Battery case for Canon EOS 6D 7D 5DS 5DSR 5D Mark II 5D 60D 60Da 70D 80D', 'Old', 'new', 'Everyone,Female,Other,Male', '21+,25-28 years old,13+ and above,19+,18+', 'Eid', 'Silicon', 'Any,M,XL,XXXL,XXL,L,S', 'ALL Color', '11', '222', '333', 'Meter', '66', 'GRAM', '1000', '200', '800', '54', '1.10', 'products_images/62_71+a9hzsibl._sx425_.jpg', 'Quick Details\r\nCondition:\r\nNew\r\nBrand Name:\r\nSANG\r\nPlace of Origin:\r\nShandong, China (Mainland)\r\nUse:\r\nRoom\r\nPower Source:\r\nElectrical\r\nPower Type:\r\nAC\r\nType:\r\nWindow Mounted Air Conditioners\r\nCooling/Heating:\r\nCooling Only\r\nCertification:\r\nCB, CE, GS, RoHS, SASO\r\nCapacity (btu):\r\n5000\r\nCOP:\r\nN.A\r\nEER:\r\n2.81\r\nPower (W):\r\n540\r\nVoltage (V):\r\n230\r\nModel Number:\r\n5000BTU\r\nProduct Name:\r\nWindow Air Conditioner\r\nPower supply:\r\n230V~ 60Hz, 1Ph\r\nControl type:\r\nMECHANICAL & REMOTE CONTROL\r\nCompressor:\r\nRotary\r\nIndoor noise level:\r\n54/51/48dB(A)\r\nColor:\r\nWhite and other\r\nNet dimensions (WxHxD):\r\n407*401*319mm\r\nPacking dimensions (WxHxD):\r\n455*428*378mm\r\nNet/Gross weight:\r\n19/ 21Kg', 'Any time', 'Yes', 'Featured,Specials,Latest', '2019-05-14 15:52:54', '2019-05-26 13:56:55', 'active'),
(63, 587, 'Gifts, Sports & Toys;Gifts & Crafts ;Bamboo Crafts', 'Bamboo Crafts', 'Fashion Wool 3PC Women Hat Scarf Glov', 'Good', 'best Brand', '4HBNN', '5464646', 'Fashion Wool 3PC Women Hat Scarf Glove Sets Autumn Winter Lady Warm Wool Scarf Hat Glove Knitted Hat Female Diamond Beanies Caps.', 'New', 'new', 'Everyone,Female,Other,Male', '25-28 years old', '4545', '54545', 'Any,Free Size,S,L,XL,XXL,XXXL', 'ALL Color,WHITE,BLACK,BLUE,YELLOW,GREEN', '10', '20', '10', 'Meter', '2.5', 'GRAM', '450', '44', '510', '44', '1.10', 'products_images/63_510im7wriul._ux385_.jpg', 'product Name	Factory price newest fashion winter ladies scarf and hat sets\r\nMaterial	100% Acrylic\r\nWeight	220g\r\nColor	pink\r\nMOQ	500 pieces per design\r\nDelivery Time	IN STOCK \r\n30-45days: More than10,000pcs\r\nPacking Info:	1pcs/PE bag/box,100pcs/CTN \r\nG.W.:11KGS, N.W: 10KGS \r\nMeasurement: 60x40x40cm\r\nPORT	SHANGHAI/NINGBO', '30-45days: More than10,000pcs', 'yes', 'Featured,Bestsellers,Specials,Latest', '2019-05-14 15:55:23', '2019-05-24 08:17:59', 'active'),
(64, 599, 'Gifts, Sports & Toys;Gifts & Crafts ;Glass Crafts', 'Glass Crafts', 'Christmas tree glass crafts for Christmas', 'Hand Made', 'best Brand', 'BRLIGHTING', 'best', 'Material:\r\nGlass\r\nProduct Type:\r\nLamp & Accessories\r\nTechnique:\r\nBlown\r\nStyle:\r\nAntique Imitation\r\nUse:\r\nArt & Collectible\r\nTheme:\r\nMusic\r\nRegional Feature:\r\nEurope\r\nPlace of Origin:\r\nGuangdong, China (Mainland)\r\nBrand Name:\r\nGEMEI\r\nModel Number:\r\nGM-C06\r\nProduct name:\r\nchristmas tree glass crafts\r\nColor:\r\nTransparent\r\nUsage:\r\nHouse Decoration\r\nName:\r\nGlass Giftware\r\nApplication:\r\nTabletop Decoration\r\nSize:\r\n85mm*200mm\r\nShape:\r\nalien\r\nType:\r\nHand Made\r\nPacking:\r\nCarton\r\nFeature:\r\nEnvironmental', 'New', 'new', 'Everyone,Male,Female,Other', '25-28 years old,13+ and above,19+,21+,36-40 years old,50-60 years old,Senior Citizen (65+)', '', '', 'Any,S,L,XXL,XXXL', '', '10', '15', '5', 'Meter', '3', 'GRAM', '200', '10', '190', '44', '1.10', 'products_images/_67_3.jpg', 'The product name	GM - C06\r\nOd	85 mm\r\nThe length of the size	 200mm\r\nThickness	1mm\r\nThe tolerance range	+ / - 0.5 mm\r\nResistance to temperature	580 degrees Celsius\r\nThe material	Borosilicate glass\r\nThe surface color	transparent\r\nThe mouth processing	Smooth and unscratched', 'The product name	GM - C06', 'yes', 'Bestsellers,Latest,Specials,Featured', '2019-05-17 17:06:08', '2019-05-22 05:09:59', 'active'),
(65, 599, 'Gifts, Sports & Toys;Gifts & Crafts ;Glass Crafts', 'Glass Crafts', 'glass crafts for Christmas', '455YHHNNNN5', 'best Brand', 'Single bubble, inner box and outer box', 'best', 'The product name	GM - C06\r\nOd	85 mm\r\nThe length of the size	 200mm\r\nThickness	1mm\r\nThe tolerance range	+ / - 0.5 mm\r\nResistance to temperature	580 degrees Celsius\r\nThe material	Borosilicate glass\r\nThe surface color	transparent\r\nThe mouth processing	Smooth and unscratched', 'New', 'new', 'Everyone,Male,Female,Other', '25-28 years old,13+ and above,19+,29-35 years old,36-40 years old,50-60 years old', '', '', 'Free Size,Any,M,XL,XXL', 'Not Specific,WHITE,BLACK,BLUE,GREEN', '32', '12', '52', 'Meter', '2.5', 'GRAM', '150', '80', '30', '45', '1.10', 'products_images/65_ryukyu_glass_craft.jpg', 'The product name	GM - C06\r\nOd	85 mm\r\nThe length of the size	 200mm\r\nThickness	1mm\r\nThe tolerance range	+ / - 0.5 mm\r\nResistance to temperature	580 degrees Celsius\r\nThe material	Borosilicate glass\r\nThe surface color	transparent\r\nThe mouth processing	Smooth and unscratched', 'ok', 'yes', 'Featured,Bestsellers,Specials,Latest', '2019-05-17 17:18:18', '2019-05-18 12:58:19', 'active'),
(66, 762, 'Home, Lights & Construction;Furniture ;Outdoor Furniture', 'Outdoor Furniture', 'Artificial Flower Butterfly Handicrafts DIY Craft Decoration', 'Miracleart11', 'Artificial Flower Butterfly Handicrafts DIY Craft Decoration', '4HBNN', 'best', '1	Product Name	Artificial Flower Butterfly Handicrafts DIY Craft Decoration\r\n2	Raw Material	Textile, paper\r\n3	Color	Pantone color\r\n4	Size	5.3cm, 3.5cm, 2cm, Customed size\r\n5	MOQ	1000sets (trial orderâ€™s quantity is negotiable)\r\n6	Payment	T/T,Western Union,Paypal.\r\n7	Lead time	20 days after confirmed the payment (Up to order quantity)\r\n8	Shipping	DHL,Fedex,TNT,EMS,UPS or HK Post\r\n9	Sample offer	Free sample available\r\n10	OEM & ODM	OEM/ODM design is welcome\r\n11	Supplier type	Manufacturer\r\n12	Certification	IS09001:2008\r\n13	Packaging	OPP bag/carton packaing', 'Used', 'new', 'Everyone,Male,Female', '3 -12 years old,13+ and above,29-35 years old,41-50 years old,50-60 years old', 'Crismus', 'Escherichia', 'Any,S,M,XL,L', 'Not Specific,BLACK,RED,BLUE,YELLOW,GREEN', '10', '25', '12', 'Meter', '1', 'GRAM', '100', '20', '30', '45', '1.10', 'products_images/66_2.jpg', 'yes / ', 'return', 'yes', 'Bestsellers,Specials,Latest', '2019-05-17 17:31:09', '2019-05-23 08:05:42', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `products_images`
--

CREATE TABLE `products_images` (
  `id` bigint(20) NOT NULL,
  `users_id` int(10) DEFAULT NULL,
  `products_id` int(10) DEFAULT NULL,
  `file_name` varchar(256) DEFAULT NULL,
  `order_no` int(10) DEFAULT NULL,
  `uploaded` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_images`
--

INSERT INTO `products_images` (`id`, `users_id`, `products_id`, `file_name`, `order_no`, `uploaded`) VALUES
(7, 9, 66, 'products_more_images/_7_3.jpg', 2, '2019-05-18 12:41:02'),
(8, 9, 66, 'products_more_images/_8_2.jpg', 2, '2019-05-18 12:41:02'),
(9, 9, 66, 'products_more_images/_9_1.jpg', 2, '2019-05-18 12:41:02'),
(10, 9, 66, 'products_more_images/_10_3.jpg', 2, '2019-05-18 12:41:02'),
(12, 9, 65, 'products_more_images/_12_33.jpg', 1, '2019-05-18 12:57:16'),
(13, 9, 65, 'products_more_images/_13_22.jpg', 2, '2019-05-18 12:57:16'),
(14, 9, 65, 'products_more_images/_14_2.jpg', 2, '2019-05-18 12:57:16'),
(15, 9, 64, 'products_more_images/_15_1.jpg', 1, '2019-05-22 05:09:59'),
(16, 9, 64, 'products_more_images/_16_2.jpg', 2, '2019-05-22 05:09:59'),
(17, 9, 64, 'products_more_images/_17_3.jpg', 2, '2019-05-22 05:09:59'),
(18, 9, 64, 'products_more_images/_18_22.jpg', 2, '2019-05-22 05:09:59'),
(19, 9, 57, 'products_more_images/_19_2.jpg', 1, '2019-05-24 08:16:27'),
(20, 9, 57, 'products_more_images/_20_1.jpg', 2, '2019-05-24 08:16:27'),
(21, 9, 57, 'products_more_images/_21_33.jpg', 2, '2019-05-24 08:16:27'),
(22, 9, 63, 'products_more_images/_22_2.jpg', 1, '2019-05-24 08:16:47'),
(23, 9, 63, 'products_more_images/_23_1.jpg', 2, '2019-05-24 08:16:47'),
(24, 9, 63, 'products_more_images/_24_3.jpg', 2, '2019-05-24 08:16:47'),
(25, 9, 63, 'products_more_images/_25_22.jpg', 2, '2019-05-24 08:16:47'),
(26, 9, 15, 'products_more_images/_26_1.jpg', 1, '2019-05-26 13:56:34'),
(27, 9, 15, 'products_more_images/_27_3.jpg', 2, '2019-05-26 13:56:34'),
(28, 9, 15, 'products_more_images/_28_2.jpg', 2, '2019-05-26 13:56:34'),
(29, 9, 62, 'products_more_images/_29_33.jpg', 1, '2019-05-26 13:56:55'),
(30, 9, 62, 'products_more_images/_30_2.jpg', 2, '2019-05-26 13:56:55'),
(31, 9, 61, 'products_more_images/_31_1.jpg', 1, '2019-05-26 13:57:12'),
(32, 9, 61, 'products_more_images/_32_2.jpg', 2, '2019-05-26 13:57:12'),
(33, 9, 58, 'products_more_images/_33_2.jpg', 1, '2019-05-26 13:57:37'),
(34, 9, 58, 'products_more_images/_34_1.jpg', 2, '2019-05-26 13:57:37'),
(35, 9, 60, 'products_more_images/_35_33.jpg', 1, '2019-05-26 13:57:56'),
(36, 9, 60, 'products_more_images/_36_2.jpg', 2, '2019-05-26 13:57:56'),
(37, 9, 59, 'products_more_images/_37_1.jpg', 1, '2019-05-26 13:58:16'),
(38, 9, 59, 'products_more_images/_38_33.jpg', 2, '2019-05-26 13:58:16'),
(39, 9, 56, 'products_more_images/_39_33.jpg', 1, '2019-05-26 13:58:36'),
(40, 9, 56, 'products_more_images/_40_2.jpg', 2, '2019-05-26 13:58:36'),
(41, 9, 55, 'products_more_images/_41_2.jpg', 1, '2019-05-26 14:00:33'),
(42, 9, 55, 'products_more_images/_42_33.jpg', 2, '2019-05-26 14:00:33'),
(43, 9, 54, 'products_more_images/_43_2.jpg', 1, '2019-05-26 14:00:51'),
(44, 9, 54, 'products_more_images/_44_33.jpg', 2, '2019-05-26 14:00:51'),
(45, 9, 53, 'products_more_images/_45_1.jpg', 1, '2019-05-26 14:01:14'),
(46, 9, 53, 'products_more_images/_46_2.jpg', 2, '2019-05-26 14:01:14'),
(47, 9, 47, 'products_more_images/_47_33.jpg', 1, '2019-05-26 14:01:46'),
(48, 9, 47, 'products_more_images/_48_2.jpg', 2, '2019-05-26 14:01:46'),
(49, 9, 47, 'products_more_images/_49_1.jpg', 2, '2019-05-26 14:01:46'),
(50, 9, 48, 'products_more_images/_50_2.jpg', 1, '2019-05-26 14:02:08'),
(51, 9, 48, 'products_more_images/_51_33.jpg', 2, '2019-05-26 14:02:08'),
(52, 9, 26, 'products_more_images/_52_2.jpg', 1, '2019-05-26 14:20:10'),
(53, 9, 26, 'products_more_images/_53_33.jpg', 2, '2019-05-26 14:20:10'),
(54, 9, 25, 'products_more_images/_54_33.jpg', 1, '2019-05-26 14:20:28'),
(55, 9, 25, 'products_more_images/_55_2.jpg', 2, '2019-05-26 14:20:28'),
(56, 9, 18, 'products_more_images/_56_2.jpg', 1, '2019-05-26 14:20:49'),
(57, 9, 18, 'products_more_images/_57_1.jpg', 2, '2019-05-26 14:20:49');

-- --------------------------------------------------------

--
-- Table structure for table `recover_password`
--

CREATE TABLE `recover_password` (
  `id` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `code` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` int(10) NOT NULL,
  `affiliate_users_id` int(10) DEFAULT NULL,
  `buyer_users_id` int(10) DEFAULT NULL,
  `products_id` int(10) DEFAULT NULL,
  `commission` decimal(10,2) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `referrals`
--

INSERT INTO `referrals` (`id`, `affiliate_users_id`, `buyer_users_id`, `products_id`, `commission`, `date_created`) VALUES
(4, 13, 9, 18, '1.10', '2019-05-23 14:52:26'),
(5, 13, 9, 21, '1.10', '2019-05-23 14:52:26');

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `id` int(10) NOT NULL,
  `content` text,
  `date_time_created` datetime DEFAULT NULL,
  `date_time_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `returns`
--

INSERT INTO `returns` (`id`, `content`, `date_time_created`, `date_time_updated`) VALUES
(1, '<p>Renewed US sanctions had led to worse economic conditions than during the country''s 1980-88 war with neighbouring Iraq, Mr Rouhani said.</p>\r\n<p>His comments came amid rising tensions with the US, which last week deployed warships and warplanes to the Gulf.</p>\r\n<p>Mr Rouhani, who has come under domestic political pressure, called for political unity to face down sanctions.</p>\r\n<p>"During the war we did not have a problem with our banks, oil sales or imports and exports, and there were only sanctions on arms purchases," Mr Rouhani told political activists in the capital, Tehran.</p>\r\n<p>"The pressures by enemies is a war unprecedented in the history of our Islamic revolution ... but I do not despair and have great hope for the future and believe that we can move past these difficult conditions provided that we are united," he said.</p>', '2019-05-13 09:32:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(10) NOT NULL,
  `products_id` int(10) DEFAULT NULL,
  `name` varchar(127) DEFAULT NULL,
  `review` text,
  `rating` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `products_id`, `name`, `review`, `rating`, `date_created`) VALUES
(1, 23, 'ssfsrewrwr wrewr', 'erere rewrerewr', 5, '2019-05-27 18:50:41'),
(2, 23, 'er errewre', 'eerewrewr', 4, '2019-05-27 18:50:56'),
(3, 21, 'dfdfdf', 'dfdfdfdf', 5, '2019-05-27 22:31:18'),
(4, 21, 'sdsdsds', 'dsdsdsd', 5, '2019-05-27 22:31:31'),
(5, 21, 'fgfgfg', 'fgfgfgfgf', 3, '2019-05-27 22:33:11'),
(6, 21, 'erere', 'rewrerewr', 2, '2019-05-28 04:53:28'),
(7, 18, 'hghghh', 'hghghg', 5, '2019-12-21 20:23:08');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_address`
--

CREATE TABLE `shipping_address` (
  `id` int(10) NOT NULL,
  `ship_first_name` varchar(127) NOT NULL,
  `ship_last_name` varchar(127) NOT NULL,
  `ship_adress1` varchar(127) NOT NULL,
  `ship_adress2` varchar(127) NOT NULL,
  `ship_zip_code` varchar(127) NOT NULL,
  `ship_city` varchar(127) NOT NULL,
  `ship_state` varchar(127) NOT NULL,
  `ship_country` varchar(127) NOT NULL,
  `ship_contact_phone` varchar(127) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipping_address`
--

INSERT INTO `shipping_address` (`id`, `ship_first_name`, `ship_last_name`, `ship_adress1`, `ship_adress2`, `ship_zip_code`, `ship_city`, `ship_state`, `ship_country`, `ship_contact_phone`) VALUES
(1, 'Amirul', 'Momenin', 'C-20,JAkir Hossain Road,Block-E', 'Md-pur', '1207', 'Dhaka', 'Dhaka Division', 'Bangladesh', '66565656'),
(2, 'Amirul', 'Momenin', 'C-20,JAkir Hossain Road,Block-E', 'Md-pur', '1207', 'Dhaka', 'Dhaka Division', 'Bangladesh', '66565656'),
(3, 'Amirul', 'Momenin', 'C-20,JAkir Hossain Road,Block-E', 'Md-pur', '1207', 'Dhaka', 'Dhaka Division', 'Bangladesh', '66565656'),
(4, 'Amirul', 'Momenin', 'C-20,JAkir Hossain Road,Block-E', 'Md-pur', '1207', 'Dhaka', 'Dhaka Division', 'Bangladesh', '66565656'),
(5, 'Amirul', 'Momenin', 'C-20,JAkir Hossain Road,Block-E', 'Md-pur', '1207', 'Dhaka', 'Dhaka Division', 'Bangladesh', '66565656'),
(6, 'Amirul', 'Momenin', 'C-20,JAkir Hossain Road,Block-E', 'Md-pur', '1207', 'Dhaka', 'Dhaka Division', 'Bangladesh', '66565656'),
(7, 'Amirul', 'Momenin', 'C-20,JAkir Hossain Road,Block-E', 'Md-pur', '1207', 'Dhaka', 'Dhaka Division', 'Bangladesh', '66565656'),
(8, 'Amirul', 'Momenin', 'C-20,JAkir Hossain Road,Block-E', 'Md-pur', '1207', 'Dhaka', 'Dhaka Division', 'Bangladesh', '66565656'),
(9, 'Amirul', 'Momenin', 'C-20,JAkir Hossain Road,Block-E', 'Md-pur', '1207', 'Dhaka', 'Dhaka Division', 'Bangladesh', '66565656');

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE `slide` (
  `id` int(11) NOT NULL,
  `file_picture` varchar(256) DEFAULT NULL,
  `products_id` int(10) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`id`, `file_picture`, `products_id`, `status`) VALUES
(2, 'slide_images/2_images.jpg', 21, 'active'),
(3, 'slide_images/3_download.jpg', 18, 'active'),
(4, 'slide_images/4_images_(8).jpg', 21, 'active'),
(5, 'slide_images/5_images_(5).jpg', 21, 'active'),
(6, 'slide_images/6_images_(4).jpg', 18, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(10) NOT NULL,
  `email` varchar(127) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `date_subscribed` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `email`, `status`, `date_subscribed`) VALUES
(1, 'lijanislamlijanislam@gmail.com', 'active', '2019-05-12'),
(3, 'amirrucst@gmail.com', 'active', '2019-05-16'),
(4, 'amirrucst1@gmail.com', 'active', '2019-05-16');

-- --------------------------------------------------------

--
-- Table structure for table `terms_condition`
--

CREATE TABLE `terms_condition` (
  `id` int(10) NOT NULL,
  `content` text,
  `date_time_created` datetime DEFAULT NULL,
  `date_time_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terms_condition`
--

INSERT INTO `terms_condition` (`id`, `content`, `date_time_created`, `date_time_updated`) VALUES
(2, '<p>Renewed US sanctions had led to worse economic conditions than during the country''s 1980-88 war with neighbouring Iraq, Mr Rouhani said.</p>\r\n<p>His comments came amid rising tensions with the US, which last week deployed warships and warplanes to the Gulf.</p>\r\n<p>Mr Rouhani, who has come under domestic political pressure, called for political unity to face down sanctions.</p>\r\n<p>"During the war we did not have a problem with our banks, oil sales or imports and exports, and there were only sanctions on arms purchases," Mr Rouhani told political activists in the capital, Tehran.</p>\r\n<p>"The pressures by enemies is a war unprecedented in the history of our Islamic revolution ... but I do not despair and have great hope for the future and believe that we can move past these difficult conditions provided that we are united," he said.</p>', '2019-05-12 12:29:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(127) NOT NULL,
  `password` varchar(127) NOT NULL,
  `title` varchar(127) NOT NULL,
  `first_name` varchar(127) NOT NULL,
  `last_name` varchar(127) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `fb_user_id` varchar(255) DEFAULT NULL,
  `fb_id` varchar(255) DEFAULT NULL,
  `gmt` varchar(255) DEFAULT NULL,
  `gmt_zone` varchar(255) DEFAULT NULL,
  `access` varchar(255) DEFAULT NULL,
  `timestamp_login` varchar(255) DEFAULT NULL,
  `timestamp` varchar(255) DEFAULT NULL,
  `company` varchar(127) NOT NULL,
  `address` varchar(127) NOT NULL,
  `city` varchar(127) NOT NULL,
  `state` varchar(127) NOT NULL,
  `zip` varchar(127) NOT NULL,
  `country_id` varchar(127) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `user_type` enum('super','staff','client','visitor') NOT NULL,
  `status` enum('active','inactive') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `title`, `first_name`, `last_name`, `username`, `fb_user_id`, `fb_id`, `gmt`, `gmt_zone`, `access`, `timestamp_login`, `timestamp`, `company`, `address`, `city`, `state`, `zip`, `country_id`, `created_at`, `updated_at`, `user_type`, `status`) VALUES
(9, NULL, 'xx', 'xx', 'Mr.', 'Anil', 'kumar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '231', '2011-10-19 00:00:00', '2011-10-19 00:00:00', 'super', 'active'),
(10, NULL, 'fdfdf@dfdfdf.com', '123456', '', 'dfdfdf', 'fdffdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'active'),
(11, NULL, 'dddf@gggf.com', '123456', '', 'ffeeere', 'rerere', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '2019-04-17 13:02:33', '0000-00-00 00:00:00', '', 'active'),
(12, NULL, 'winsuresure@hotmail.com', 'yyyy', '', 'Tg', 'Sq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'Gghj', 'Fhhhjk', '', '568', '81', '2019-04-30 23:08:27', '0000-00-00 00:00:00', 'client', 'active'),
(13, NULL, 'amirrucst@gmail.com', '123456', '', 'Amirul', 'Momenin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'C-20,JAkir Hossain Road,Block-E', 'Dhaka', '', '1207', '19', '2019-05-07 15:31:16', '0000-00-00 00:00:00', 'client', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `affiliate`
--
ALTER TABLE `affiliate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing_information`
--
ALTER TABLE `billing_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chatbot`
--
ALTER TABLE `chatbot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_information`
--
ALTER TABLE `delivery_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fb_app`
--
ALTER TABLE `fb_app`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fb_post`
--
ALTER TABLE `fb_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gift_voucher`
--
ALTER TABLE `gift_voucher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_page_category`
--
ALTER TABLE `home_page_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_letter`
--
ALTER TABLE `news_letter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_users` (`id_users`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `id_users_2` (`id_users`),
  ADD KEY `user_id_2` (`user_id`);

--
-- Indexes for table `privacy_policy`
--
ALTER TABLE `privacy_policy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_images`
--
ALTER TABLE `products_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recover_password`
--
ALTER TABLE `recover_password`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_user_2` (`id_user`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_address`
--
ALTER TABLE `shipping_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms_condition`
--
ALTER TABLE `terms_condition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `affiliate`
--
ALTER TABLE `affiliate`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `billing_information`
--
ALTER TABLE `billing_information`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1164;
--
-- AUTO_INCREMENT for table `chatbot`
--
ALTER TABLE `chatbot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;
--
-- AUTO_INCREMENT for table `delivery_information`
--
ALTER TABLE `delivery_information`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `fb_app`
--
ALTER TABLE `fb_app`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fb_post`
--
ALTER TABLE `fb_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gift_voucher`
--
ALTER TABLE `gift_voucher`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `home_page_category`
--
ALTER TABLE `home_page_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `news_letter`
--
ALTER TABLE `news_letter`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `privacy_policy`
--
ALTER TABLE `privacy_policy`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `products_images`
--
ALTER TABLE `products_images`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `recover_password`
--
ALTER TABLE `recover_password`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `shipping_address`
--
ALTER TABLE `shipping_address`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `terms_condition`
--
ALTER TABLE `terms_condition`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
