-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2025 at 07:38 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ajmalfurniturehouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', 'admin123', '2025-05-12 17:24:22');

-- --------------------------------------------------------

--
-- Table structure for table `bellagiomeasurements`
--

CREATE TABLE `bellagiomeasurements` (
  `id` int(11) NOT NULL,
  `Depth` varchar(50) DEFAULT NULL,
  `Height` varchar(50) DEFAULT NULL,
  `Weight` varchar(50) DEFAULT NULL,
  `MaximumWeightLoad` varchar(50) DEFAULT NULL,
  `Width` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bellagiomeasurements`
--

INSERT INTO `bellagiomeasurements` (`id`, `Depth`, `Height`, `Weight`, `MaximumWeightLoad`, `Width`) VALUES
(1, '35½\"', '16¾\"', '37 lb', '276 lb', '35½\"');

-- --------------------------------------------------------

--
-- Table structure for table `bellagioproductdetails`
--

CREATE TABLE `bellagioproductdetails` (
  `id` int(11) NOT NULL,
  `Upholstery` varchar(255) DEFAULT NULL,
  `DesignedBy` varchar(255) DEFAULT NULL,
  `LegStyle` varchar(255) DEFAULT NULL,
  `SurfaceFinish` varchar(255) DEFAULT NULL,
  `UpholsteryComposition` varchar(255) DEFAULT NULL,
  `Manufacturer` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bellagioproductdetails`
--

INSERT INTO `bellagioproductdetails` (`id`, `Upholstery`, `DesignedBy`, `LegStyle`, `SurfaceFinish`, `UpholsteryComposition`, `Manufacturer`) VALUES
(1, 'golden beige Avellino fabric 3251', 'Anders Nørgaard', 'black lacquered', 'lacquered', '70% cotton/15% acrylic/8% polyester/6% wool/1% polyamid', 'Ajmal Furniture House');

-- --------------------------------------------------------

--
-- Table structure for table `bergamomeasurements`
--

CREATE TABLE `bergamomeasurements` (
  `id` int(11) NOT NULL,
  `Depth` varchar(20) DEFAULT NULL,
  `Height` varchar(20) DEFAULT NULL,
  `SeatingHeight` varchar(20) DEFAULT NULL,
  `Weight` varchar(20) DEFAULT NULL,
  `LegsHeight` varchar(20) DEFAULT NULL,
  `ArmrestHeight` varchar(20) DEFAULT NULL,
  `Width` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bergamomeasurements`
--

INSERT INTO `bergamomeasurements` (`id`, `Depth`, `Height`, `SeatingHeight`, `Weight`, `LegsHeight`, `ArmrestHeight`, `Width`) VALUES
(1, '100½', '32¾', '17¾', '342lb', '2\"', '25¾\"', '165½');

-- --------------------------------------------------------

--
-- Table structure for table `bergamoproductdetails`
--

CREATE TABLE `bergamoproductdetails` (
  `id` int(11) NOT NULL,
  `Upholstery` varchar(255) DEFAULT NULL,
  `DesignedBy` varchar(255) DEFAULT NULL,
  `Armrest` text DEFAULT NULL,
  `Back` text DEFAULT NULL,
  `BackCushion` text DEFAULT NULL,
  `Frame` text DEFAULT NULL,
  `Seat` text DEFAULT NULL,
  `Suspension` text DEFAULT NULL,
  `FabricLining` text DEFAULT NULL,
  `SurfaceFinish` varchar(255) DEFAULT NULL,
  `UpholsteryComposition` text DEFAULT NULL,
  `Manufacturer` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bergamoproductdetails`
--

INSERT INTO `bergamoproductdetails` (`id`, `Upholstery`, `DesignedBy`, `Armrest`, `Back`, `BackCushion`, `Frame`, `Seat`, `Suspension`, `FabricLining`, `SurfaceFinish`, `UpholsteryComposition`, `Manufacturer`) VALUES
(1, 'white Lazio fabric 3090', 'Morten Georgsen', 'Top 28kg/m3 foam Inside 28 kg/m3 foam Outside 28 kg/m3 foam, polyester wadding', '25 kg/m3 foam polyester wadding', 'Fiber balls , 25 kg/m3 foam', 'LVL board/plywood/Metal brace', '35 kg/m3 HR foam, 35kgs/m3 HR foam, 25 kg/m3 foam, polyester wadding', 'Nozag springs metal', 'Jacquard fabric with BC logo, Ployester fabric, Non-woven fabric with BC logo, Fibertex (100% PP)', 'lacquered', '34% acrylic, 24% cotton, 14% wool, 12% viscose, 12% polyester, 4% linen', 'Ajmal Furniture House');

-- --------------------------------------------------------

--
-- Table structure for table `bolzonemeasurements`
--

CREATE TABLE `bolzonemeasurements` (
  `id` int(11) NOT NULL,
  `Depth` varchar(10) DEFAULT NULL,
  `Height` varchar(10) DEFAULT NULL,
  `SeatingHeight` varchar(10) DEFAULT NULL,
  `Weight` varchar(10) DEFAULT NULL,
  `MaxWeightLoad` varchar(10) DEFAULT NULL,
  `Width` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bolzonemeasurements`
--

INSERT INTO `bolzonemeasurements` (`id`, `Depth`, `Height`, `SeatingHeight`, `Weight`, `MaxWeightLoad`, `Width`) VALUES
(1, '34\"', '28¾\"', '16¾\"', '64 lb', '276 lb', '35¼\"');

-- --------------------------------------------------------

--
-- Table structure for table `bolzoneproductdetails`
--

CREATE TABLE `bolzoneproductdetails` (
  `id` int(11) NOT NULL,
  `Upholstery` varchar(255) DEFAULT NULL,
  `DesignedBy` varchar(100) DEFAULT NULL,
  `Back` text DEFAULT NULL,
  `Seat` text DEFAULT NULL,
  `UpholsteryComposition` varchar(100) DEFAULT NULL,
  `Manufacturer` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bolzoneproductdetails`
--

INSERT INTO `bolzoneproductdetails` (`id`, `Upholstery`, `DesignedBy`, `Back`, `Seat`, `UpholsteryComposition`, `Manufacturer`) VALUES
(1, 'burgundy Tuscany fabric 3207', 'Morten Georgsen', '28kg/m3 foam (CA280), 25kg/m3 foam (C2513A), D135 kg/m3 bonded foam, 25kg/m3 foam (RE253), poly wadding', '35kg/m3 HR Foam (CH3535A), 32g/m3 foam (T107), 25kg/m3 foam (C2513A), poly wadding', '100% polyester', 'Ajmal Furniture House');

-- --------------------------------------------------------

--
-- Table structure for table `carmomeasurements`
--

CREATE TABLE `carmomeasurements` (
  `id` int(11) NOT NULL,
  `depth` varchar(50) DEFAULT NULL,
  `height` varchar(50) DEFAULT NULL,
  `seating_height` varchar(50) DEFAULT NULL,
  `weight` varchar(50) DEFAULT NULL,
  `legs_height` varchar(50) DEFAULT NULL,
  `width` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carmomeasurements`
--

INSERT INTO `carmomeasurements` (`id`, `depth`, `height`, `seating_height`, `weight`, `legs_height`, `width`) VALUES
(1, '232 cm', '71 cm', '42 cm', '999.999 kg', '5 cm', '286 cm');

-- --------------------------------------------------------

--
-- Table structure for table `carmoproductdetails`
--

CREATE TABLE `carmoproductdetails` (
  `id` int(11) NOT NULL,
  `upholstery` varchar(255) DEFAULT NULL,
  `designed_by` varchar(255) DEFAULT NULL,
  `leg_style` varchar(255) DEFAULT NULL,
  `armrest_materials` text DEFAULT NULL,
  `back_materials` text DEFAULT NULL,
  `frame_materials` text DEFAULT NULL,
  `seat_materials` text DEFAULT NULL,
  `upholstery_composition` varchar(255) DEFAULT NULL,
  `manufacturer` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carmoproductdetails`
--

INSERT INTO `carmoproductdetails` (`id`, `upholstery`, `designed_by`, `leg_style`, `armrest_materials`, `back_materials`, `frame_materials`, `seat_materials`, `upholstery_composition`, `manufacturer`) VALUES
(1, 'green Skagen fabric 3165', 'Anders Nørgaard', 'black lacquered', 'Top wadding 200 g. VB2540 Inside EV1830 wadding 200 g Outside EV1830 wadding 200 g', 'Top wadding 200 g. VB2540 Inside wadding 200 g. EV2220 Outside wadding 200 g. EV1830', 'Solid pine, particleboard, plywood, hardboard', 'foam R4442 / foam HR3030 / wadding 200 g.', '100% polyester', 'Ajmal Furniture House');

-- --------------------------------------------------------

--
-- Table structure for table `diningchairmeasurements`
--

CREATE TABLE `diningchairmeasurements` (
  `id` int(11) NOT NULL,
  `depth` varchar(10) DEFAULT NULL,
  `height` varchar(10) DEFAULT NULL,
  `armrest_height` varchar(10) DEFAULT NULL,
  `seating_height` varchar(10) DEFAULT NULL,
  `weight` varchar(10) DEFAULT NULL,
  `max_weight_load` varchar(10) DEFAULT NULL,
  `width` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diningchairmeasurements`
--

INSERT INTO `diningchairmeasurements` (`id`, `depth`, `height`, `armrest_height`, `seating_height`, `weight`, `max_weight_load`, `width`) VALUES
(1, '21½ \"', '30', '30', '18½', '19 lb', '276 lb', '23¾ \"');

-- --------------------------------------------------------

--
-- Table structure for table `diningchairproductdetails`
--

CREATE TABLE `diningchairproductdetails` (
  `id` int(11) NOT NULL,
  `leg` varchar(100) DEFAULT NULL,
  `designed_by` varchar(100) DEFAULT NULL,
  `upholstery` varchar(100) DEFAULT NULL,
  `frame_material` varchar(100) DEFAULT NULL,
  `seat_material` varchar(100) DEFAULT NULL,
  `upholstery_composition` varchar(255) DEFAULT NULL,
  `surface_finish` varchar(100) DEFAULT NULL,
  `manufacturer` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diningchairproductdetails`
--

INSERT INTO `diningchairproductdetails` (`id`, `leg`, `designed_by`, `upholstery`, `frame_material`, `seat_material`, `upholstery_composition`, `surface_finish`, `manufacturer`) VALUES
(1, 'natural solid oak', 'Henrik Pedersen', 'caramel Nordic Vintage leather 5150', 'Pbirch plywood', '40kg/m3, T4090', 'Aniline leather, slightly polished.', 'lacquered', 'Ajmal Furniture House');

-- --------------------------------------------------------

--
-- Table structure for table `furnitureinfo`
--

CREATE TABLE `furnitureinfo` (
  `id` int(10) UNSIGNED NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `href` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `furnitureinfo`
--

INSERT INTO `furnitureinfo` (`id`, `Name`, `image`, `href`) VALUES
(1, 'Sofas', 'sofa.jpg', '../project/project/sofa.php'),
(2, 'Chair', 'Chair.jpg', '../project/project/Chairs.php'),
(3, 'Table', 'Table.jpg', '../project/project/table.php'),
(4, 'Bed', 'Bed.jpg', '../project/project/Beds.php'),
(5, 'Storage', 'lamps.jpg', '../project/project/storage.php'),
(6, 'Outdoor', 'Study.jpg', '../project/project/outdoor.php');

-- --------------------------------------------------------

--
-- Table structure for table `madridmeasurements`
--

CREATE TABLE `madridmeasurements` (
  `id` int(11) NOT NULL,
  `diameter` varchar(10) DEFAULT NULL,
  `height` varchar(10) DEFAULT NULL,
  `height_to_table_top` varchar(10) DEFAULT NULL,
  `tabletop_thickness` varchar(10) DEFAULT NULL,
  `weight` varchar(10) DEFAULT NULL,
  `max_weight_load` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `madridmeasurements`
--

INSERT INTO `madridmeasurements` (`id`, `diameter`, `height`, `height_to_table_top`, `tabletop_thickness`, `weight`, `max_weight_load`) VALUES
(1, '39', '16¼', '15½', '1', '68lb', '44 lb');

-- --------------------------------------------------------

--
-- Table structure for table `madridproductdetails`
--

CREATE TABLE `madridproductdetails` (
  `id` int(11) NOT NULL,
  `size` varchar(50) DEFAULT NULL,
  `leg` varchar(100) DEFAULT NULL,
  `tabletop` varchar(100) DEFAULT NULL,
  `designed_by` varchar(100) DEFAULT NULL,
  `shape` varchar(50) DEFAULT NULL,
  `tabletop_finish` varchar(255) DEFAULT NULL,
  `manufacturer` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `madridproductdetails`
--

INSERT INTO `madridproductdetails` (`id`, `size`, `leg`, `tabletop`, `designed_by`, `shape`, `tabletop_finish`, `manufacturer`) VALUES
(1, 'H16¼xØ39\"', 'matte black structure lacquered', 'ash ceramic', 'Morten Georgsen', 'Round', 'edge sanded/lacquered/edge sanded/lacquered', 'Ajmal Furniture House');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cart_items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`cart_items`)),
  `shipping_address` text NOT NULL,
  `delivery_date` date NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `order_date` date NOT NULL,
  `status` varchar(20) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `cart_items`, `shipping_address`, `delivery_date`, `total_price`, `payment_method`, `order_date`, `status`) VALUES
(1, 2, '[{\"name\":\"Modena 3 seater\",\"price\":102000,\"image\":\".\\/Modena3Seater.jpg\",\"quantity\":1}]', 'Buffer zone sector 15B country tower new khi', '2025-05-11', 102000.00, 'Cash on Delivery', '2025-05-04', 'Pending'),
(2, 2, '[{\"name\":\"Lap Chair\",\"price\":5387.3,\"image\":\".\\/lapchair.jpg\",\"quantity\":1}]', 'Buffer zone sector 15B country tower new khi', '2025-05-14', 5387.30, 'Cash on Delivery', '2025-05-07', 'Pending'),
(3, 2, '[{\"name\":\"Taylor Sofa sleeper\",\"price\":53454.799999999996,\"image\":\".\\/TaylorSofasleeper.jpg\",\"quantity\":1}]', 'Buffer zone sector 15B country tower new khi', '2025-05-14', 53454.80, 'Cash on Delivery', '2025-05-07', 'Pending'),
(4, 2, '[{\"name\":\"Oryn Sofa Chair\",\"price\":45167.299999999996,\"image\":\".\\/Orynsofachair.jpg\",\"quantity\":1}]', 'Buffer zone sector 15B country tower new khi', '2025-05-14', 45167.30, 'Cash on Delivery', '2025-05-07', 'Pending'),
(5, 2, '[{\"name\":\"Antonin Executive Chair\",\"price\":48896.25,\"image\":\".\\/AntoninExecutiveChair.jpg\",\"quantity\":1}]', 'Buffer zone sector 15B country tower new khi', '2025-05-14', 48896.25, 'Cash on Delivery', '2025-05-07', 'Pending'),
(6, 2, '[{\"name\":\"Trysil dining table\",\"price\":5387.3,\"image\":\".\\/Trysil dining table.jpg\",\"quantity\":1}]', 'Buffer zone sector 15B country tower new khi', '2025-05-14', 5387.30, 'Credit Card', '2025-05-07', 'Pending'),
(7, 2, '[{\"name\":\"Chic Sofa Chair\",\"price\":53454.799999999996,\"image\":\".\\/ChicSofaChair.jpg\",\"quantity\":1}]', 'Buffer zone sector 15B country tower new khi', '2025-05-14', 53454.80, 'Cash on Delivery', '2025-05-07', 'Pending'),
(8, 2, '{\"70\":{\"name\":\"Sweet Art Ottoman\",\"price\":\"599.00\",\"quantity\":1,\"image\":\"..\\/Images\\/ArtOttoman1.jpg\",\"material\":\"Fabric\"}}', 'Buffer zone sector 15B country tower new khi', '2025-05-14', 599.00, 'Credit Card', '2025-05-07', 'Pending'),
(9, 2, '{\"71\":{\"name\":\"Bolzano chair with swivel base\",\"price\":\"3899.00\",\"quantity\":1,\"image\":\"..\\/Images\\/BolzanoChair5.jpg\",\"material\":\"Fabric\"}}', 'Buffer zone sector 15B country tower new khi', '2025-05-14', 3899.00, 'Cash on Delivery', '2025-05-07', 'Pending'),
(10, 2, '{\"73\":{\"name\":\"Bergamo sofa with round lounging unit, right\",\"price\":\"12790.00\",\"quantity\":1,\"image\":\"..\\/Images\\/BergamoSofa5.jpg\",\"material\":\"Fabric.Lacquered\"}}', 'Buffer zone sector 15B country tower new khi', '2025-05-14', 12790.00, 'Credit Card', '2025-05-07', 'Pending'),
(11, 1, '{\"73\":{\"name\":\"Bergamo sofa with round lounging unit, right\",\"price\":\"12790.00\",\"quantity\":1,\"image\":\"..\\/Images\\/BergamoSofa5.jpg\",\"material\":\"Fabric.Lacquered\"}}', 'Buffer zone sector 15B country tower new khi', '2025-05-14', 12790.00, 'PayPal', '2025-05-07', 'Pending'),
(12, 1, '[{\"name\":\"Lap Chair\",\"price\":5387.3,\"image\":\".\\/lapchair.jpg\",\"quantity\":1}]', 'Buffer zone sector 15B country tower new khi', '2025-05-14', 5387.30, 'Credit Card', '2025-05-07', 'Pending'),
(13, 1, '[{\"name\":\"Tivolo coffe table\",\"price\":53454.799999999996,\"image\":\".\\/TivoliCoffetable.jpg\",\"quantity\":1}]', 'Buffer zone sector 15B country tower new khi', '2025-05-14', 53454.80, 'Cash on Delivery', '2025-05-07', 'Pending'),
(14, 1, '{\"70\":{\"name\":\"Sweet Art Ottoman\",\"price\":\"599.00\",\"quantity\":1,\"image\":\"..\\/Images\\/ArtOttoman1.jpg\",\"material\":\"Fabric\"}}', 'Buffer zone sector 15B country tower new khi', '2025-05-14', 599.00, 'Cash on Delivery', '2025-05-07', 'Pending'),
(15, 2, '{\"70\":{\"name\":\"Sweet Art Ottoman\",\"price\":\"599.00\",\"quantity\":1,\"image\":\"..\\/Images\\/ArtOttoman1.jpg\",\"material\":\"Fabric\"}}', 'Buffer zone sector 15B country tower new khi', '2025-05-19', 599.00, 'Credit Card', '2025-05-12', 'Delivered'),
(16, 2, '{\"69\":{\"name\":\"Sweet Art chair with swivel base\",\"price\":\"1499.00\",\"quantity\":1,\"image\":\"..\\/Images\\/ArtChair1.jpg\",\"material\":\"Fabric\"}}', 'Buffer zone sector 15B country tower new khi', '2025-05-19', 1499.00, 'Credit Card', '2025-05-12', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `ottomanmeasurements`
--

CREATE TABLE `ottomanmeasurements` (
  `id` int(11) NOT NULL,
  `Depth` varchar(50) DEFAULT NULL,
  `Height` varchar(50) DEFAULT NULL,
  `Weight` varchar(50) DEFAULT NULL,
  `MaximumWeightLoad` varchar(50) DEFAULT NULL,
  `Width` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ottomanmeasurements`
--

INSERT INTO `ottomanmeasurements` (`id`, `Depth`, `Height`, `Weight`, `MaximumWeightLoad`, `Width`) VALUES
(1, '25\"', '15(1/2)\"', '19lb', '276lb', '25\"');

-- --------------------------------------------------------

--
-- Table structure for table `ottomanproductdetails`
--

CREATE TABLE `ottomanproductdetails` (
  `id` int(11) NOT NULL,
  `Upholstery` varchar(255) DEFAULT NULL,
  `DesignedBy` varchar(255) DEFAULT NULL,
  `Frame` text DEFAULT NULL,
  `Seat` text DEFAULT NULL,
  `FabricLining` varchar(255) DEFAULT NULL,
  `UpholsteryComposition` varchar(255) DEFAULT NULL,
  `Manufacturer` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ottomanproductdetails`
--

INSERT INTO `ottomanproductdetails` (`id`, `Upholstery`, `DesignedBy`, `Frame`, `Seat`, `FabricLining`, `UpholsteryComposition`, `Manufacturer`) VALUES
(1, 'White Rimini fabric 3083', 'Charlotte Høncke', 'Plywood / LVL / fiberboard', '32 kg/m3 foam (T107) 35 kg/m3 HR foam (CA353) 25 kg/m3 foam (C2513A) poly wadding', 'Non-woven fabric (80g/m2)', '100% polyester', 'Ajmal Furniture House');

-- --------------------------------------------------------

--
-- Table structure for table `picks`
--

CREATE TABLE `picks` (
  `id` int(10) UNSIGNED NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `StartingPrice` decimal(10,2) DEFAULT NULL,
  `Material` varchar(100) DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `picks`
--

INSERT INTO `picks` (`id`, `Name`, `Price`, `StartingPrice`, `Material`, `Image`) VALUES
(1, 'Sweet Art Chair with swivel base', 1499.00, 899.00, 'Fabric', 'SweetChair.jpg'),
(2, 'Sweet Art ottoman', 599.00, 299.00, 'Fabric', 'Ottoman.jpg'),
(3, 'Bergamo sofa with round lounging unit,right', 12790.00, 8299.00, 'Fabric.Lacquered', 'Bergamo.jpg'),
(4, 'Bolzano chair with swivel base', 3899.00, 2849.00, 'Fabric', 'Bolzano.jpg'),
(5, 'Bellagio pouf', 2299.00, 1249.00, 'Fabric.Lacquered', 'Bellagio.jpg'),
(6, 'Madrid coffee table', 1749.00, 1249.00, 'Ceremic', 'CoffeeTable.jpg'),
(7, 'Seoul dining chair', 1749.00, 1249.00, 'Leather.Wood', 'DiningChair.jpg'),
(8, 'Carmo corner sofa', 7899.00, 5639.00, 'Fabric.Lacquered', 'CornerSofa.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `StartingPrice` varchar(50) DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `Material` varchar(100) DEFAULT NULL,
  `Category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `Name`, `Price`, `StartingPrice`, `Image`, `Material`, `Category`) VALUES
(1, 'Sydney King size bed', 60000.00, NULL, './SydneyKingsizebed.jpg', NULL, 'Bed'),
(2, 'chelsea king size bed', 6338.00, NULL, './chelseakingsizebed.jpg', NULL, 'Bed'),
(3, 'Taylor Sofa sleeper', 62888.00, NULL, './TaylorSofasleeper.jpg', NULL, 'Bed'),
(4, 'Austin Bed', 13163.00, NULL, './Austinbed.jpg', NULL, 'Bed'),
(5, 'Houston bed with storage', 38513.00, NULL, './Houstonbedwithstorage.jpg', NULL, 'Bed'),
(6, 'Camden L shape cum bed', 49238.00, NULL, './CamdenLshapesofacumbed.jpg', NULL, 'Bed'),
(7, 'Lugano bed with storage', 53138.00, NULL, './Luganobed.jpg', NULL, 'Bed'),
(8, 'Storage bed', 10335.00, NULL, './storagebed.jpg', NULL, 'Bed'),
(9, 'Rio Bunk Bed', 8288.00, NULL, './RioBunkbed.jpg', NULL, 'Bed'),
(10, 'Oropesa single bed', 60000.00, NULL, './Oropesasinglebed.jpg', NULL, 'Bed'),
(11, 'Montrel Bed', 54000.00, NULL, './MontrelBed.jpg', NULL, 'Bed'),
(12, 'Lorenz Bed', 57525.00, NULL, './LorenzBed.jpg', NULL, 'Bed'),
(13, 'Vigo Sofa Chair', 60000.00, NULL, './VigoSofachair.jpg', 'Fabric • Oak', 'Chair'),
(14, 'Lap Chair', 6338.00, NULL, './lapchair.jpg', 'Fabric • Oak', 'Chair'),
(15, 'Chic Sofa Chair', 62888.00, NULL, './ChicSofaChair.jpg', 'Fabric • Oak', 'Chair'),
(16, 'Lux Chair', 13163.00, NULL, './luxChair.jpg', 'Fabric • Oak', 'Chair'),
(17, 'Oryn Arm Chair', 38513.00, NULL, './Orynarmchair.jpg', 'Fabric • Oak', 'Chair'),
(18, 'Roy Sofa Chair', 49238.00, NULL, './RoySofachair.jpg', 'Fabric • Oak', 'Chair'),
(19, 'Oryn Sofa Chair', 53138.00, NULL, './Orynsofachair.jpg', 'Fabric • Oak', 'Chair'),
(20, 'Ovo Chair', 10335.00, NULL, './OvoChair.jpg', 'Fabric • Oak', 'Chair'),
(21, 'Riff Chair', 8288.00, NULL, './RiffChair.jpg', 'Fabric • Oak', 'Chair'),
(22, 'Marlon Manager Chair', 60000.00, NULL, './Marlonmanager.jpg', 'Fabric • Oak', 'Chair'),
(23, 'Executive Chair', 54000.00, NULL, './ExecutiveChair.jpg', 'Fabric • Oak', 'Chair'),
(24, 'Antonin Executive Chair', 57525.00, NULL, './AntoninExecutiveChair.jpg', 'Fabric • Oak', 'Chair'),
(25, 'Cancun cafe table', 6338.00, NULL, './Cancúndiningchair.jpg', NULL, 'Outdoor'),
(26, 'Slim sun lounger', 62888.00, NULL, './Slimsunlounger.jpg', NULL, 'Outdoor'),
(27, 'Windsor chair', 13163.00, NULL, './outdoordiningchair.jpg', NULL, 'Outdoor'),
(28, 'Garden swing', 38513.00, NULL, './gardenswing.jpg', NULL, 'Outdoor'),
(29, 'Patio swing', 49238.00, NULL, './Patioswing.jpg', NULL, 'Outdoor'),
(30, 'Wooden garden table', 53138.00, NULL, './woodengardentable.jpg', NULL, 'Outdoor'),
(31, 'Patio sofa set', 10335.00, NULL, './Patiosofaset.jpg', NULL, 'Outdoor'),
(32, 'Outdoor table', 8288.00, NULL, './outdoortable.jpg', NULL, 'Outdoor'),
(33, 'Santiago side board', 60000.00, NULL, './santiagosideboard.jpg', NULL, 'Storage'),
(34, 'Como wall system', 6338.00, NULL, './comowallsystem.jpg', NULL, 'Storage'),
(35, 'Lugano media unit', 62888.00, NULL, './luganomediaunit.jpg', NULL, 'Storage'),
(36, 'Sydney bookshelf', 13163.00, NULL, './Sydneybookshelf.jpg', NULL, 'Storage'),
(37, 'Arbour cabinet', 38513.00, NULL, './Arbourcabinet.jpg', NULL, 'Storage'),
(38, 'Lugano night stand', 49238.00, NULL, './luganonightstand.jpg', NULL, 'Storage'),
(39, 'Fermo media unit', 53138.00, NULL, './Fermomediaunit.jpg', NULL, 'Storage'),
(40, 'Galaxy shelf', 10335.00, NULL, './galaxyshelf.jpg', NULL, 'Storage'),
(41, 'Office filing cabinet', 8288.00, NULL, './Officefilingcabinet.jpg', NULL, 'Storage'),
(42, 'Como bookcase', 60000.00, NULL, './comobookcase.jpg', NULL, 'Storage'),
(43, 'Bordeaux console table', 54000.00, NULL, './Bordeauxconsoletable.jpg', NULL, 'Storage'),
(44, 'Fresco cabinet', 57525.00, NULL, './Frescocabinet.jpg', NULL, 'Storage'),
(45, 'Wavy center table', 60000.00, NULL, './Wavycentertable.jpg', NULL, 'Table'),
(46, 'Trysil dining table', 6338.00, NULL, './Trysil dining table.jpg', NULL, 'Table'),
(47, 'Tivolo coffe table', 62888.00, NULL, './TivoliCoffetable.jpg', NULL, 'Table'),
(48, 'Sieena table', 13163.00, NULL, './Sienna table.jpg', NULL, 'Table'),
(49, 'Side table', 38513.00, NULL, './Sidetable.jpg', NULL, 'Table'),
(50, 'Chelsea table', 49238.00, NULL, './chelsea table.jpg', NULL, 'Table'),
(51, 'Coffe table', 53138.00, NULL, './Coffetable.jpg', NULL, 'Table'),
(52, 'Santiago Coffee table', 10335.00, NULL, './SantiagoCoffetable.jpg', NULL, 'Table'),
(53, 'Madrid Coffee table', 8288.00, NULL, './MadridCoffetable.jpg', NULL, 'Table'),
(54, 'Melody dining table', 60000.00, NULL, './Melodydiningtable.jpg', NULL, 'Table'),
(55, 'Kingston Coffee table', 54000.00, NULL, './KingstonCoffetable.jpg', NULL, 'Table'),
(56, 'Costco table', 57525.00, NULL, './Costco table.jpg', NULL, 'Table'),
(57, 'Modena 2.5 seater', 60000.00, 'Rs23000', './Moden2.5Seater.jpg', 'Fabric • Oak', 'Sofa'),
(58, 'Modena 3 seater', 120000.00, 'Rs80000', './Modena3Seater.jpg', 'Fabric • Lacquered', 'Sofa'),
(59, 'Indivi corner sofa left', 230000.00, 'Rs1899.00', './Indivicornersofa.jpg', 'Fabric • Oak', 'Sofa'),
(60, 'Berne 2.5 seater', 2159.00, 'Rs1599.00', './berne2.5seater.jpg', 'Fabric • Oak', 'Sofa'),
(61, 'Corner sofa', 3259.00, 'Rs2499.00', './CornerSofa.jpg', 'Fabric • Oak', 'Sofa'),
(62, 'Bellagio Sofa', 2359.00, 'Rs1799.00', './BellagioSofa.jpg', 'Fabric • Oak', 'Sofa'),
(63, 'Bergamo Sofa', 3459.00, 'Rs2699.00', './bergamoSofa.jpg', 'Fabric • Oak', 'Sofa'),
(64, 'Bolzano 3-seater', 2859.00, 'Rs2199.00', './Bolzano3seater.jpg', 'Fabric • Oak', 'Sofa'),
(65, 'Taylor Sofa', 2559.00, 'Rs1899.00', './TaylorSofa.jpg', 'Fabric • Oak', 'Sofa'),
(66, 'Osaka Sofa', 2759.00, 'Rs2099.00', './OsakaSofa.jpg', 'Fabric • Oak', 'Sofa'),
(67, 'Noble Sofa Set', 3159.00, 'Rs2399.00', './NoblesofaSet.jpg', 'Fabric • Oak', 'Sofa'),
(68, 'Urban Sofa Set', 3359.00, 'Rs2599.00', './urbansofaset.jpg', 'Fabric • Oak', 'Sofa'),
(69, 'Sweet Art chair with swivel base', 1499.00, '949.00', '../Images/ArtChair1.jpg', 'Fabric', 'Chair'),
(70, 'Sweet Art Ottoman', 599.00, '349.00', '../Images/ArtOttoman1.jpg', 'Fabric', 'Ottoman'),
(71, 'Bolzano chair with swivel base', 3899.00, '29849.00', '../Images/BolzanoChair5.jpg', 'Fabric', 'Chair'),
(72, 'Bellagio Pouf', 2299.00, '1249.00', '../Images/BellagioImage1.jpg', 'Fabric.Lacquered', 'Pouf'),
(73, 'Bergamo sofa with round lounging unit, right', 12790.00, '8299.00', '../Images/BergamoSofa5.jpg', 'Fabric.Lacquered', 'Sofa'),
(74, 'CarmoCorner', 7899.00, '5639.00', '../Images/CarmoSofa1.jpg', 'Fabric.Lacquered', 'Sofa'),
(75, 'Seoul Dining Chair', 1749.00, '1249.00', '../Images/DiningChair1.jpg', 'Leather.Wood', 'Chair'),
(76, 'MadridTable', 1749.00, '1249.00', '../Images/MadridImage5.jpg', 'Ceremic', 'Table');

-- --------------------------------------------------------

--
-- Table structure for table `sweetartchairmeasurements`
--

CREATE TABLE `sweetartchairmeasurements` (
  `id` int(11) NOT NULL,
  `Depth` varchar(100) DEFAULT NULL,
  `Height` varchar(100) DEFAULT NULL,
  `SeatingHeight` varchar(100) DEFAULT NULL,
  `Weight` varchar(100) DEFAULT NULL,
  `MaximumWeightLoad` varchar(100) DEFAULT NULL,
  `Width` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sweetartchairmeasurements`
--

INSERT INTO `sweetartchairmeasurements` (`id`, `Depth`, `Height`, `SeatingHeight`, `Weight`, `MaximumWeightLoad`, `Width`) VALUES
(1, '33(1/2)', '28(3/4)X28(3/4)', '16(1/2)', '53lb', '276lb', '36(1/2)');

-- --------------------------------------------------------

--
-- Table structure for table `sweetartchairproductdetails`
--

CREATE TABLE `sweetartchairproductdetails` (
  `id` int(11) NOT NULL,
  `Upholstery` varchar(255) DEFAULT NULL,
  `DesignedBy` varchar(255) DEFAULT NULL,
  `Back` text DEFAULT NULL,
  `Frame` text DEFAULT NULL,
  `Seat` text DEFAULT NULL,
  `FabricLining` text DEFAULT NULL,
  `UpholsteryComposition` text DEFAULT NULL,
  `Manufacturer` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sweetartchairproductdetails`
--

INSERT INTO `sweetartchairproductdetails` (`id`, `Upholstery`, `DesignedBy`, `Back`, `Frame`, `Seat`, `FabricLining`, `UpholsteryComposition`, `Manufacturer`) VALUES
(1, 'White Rimini fabric 3083', 'Charlotte Høncke', '28kg/m3 foam (RE390) 39kg/m3 HR foam (CA40S) 25 kg/m3 foam (C2513A) poly wadding', 'Plywood / LVL / fibreboard', '28kg/m3 foam (RE390) 35kg/m3 HR foam(CH3526A) 25 kg/m3 foam (C2513A) poly wadding', 'Non-woven fabric (80g/m2)', '100% polyester', 'Ajmal Furniture House');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `phone`, `address`, `password`, `created_at`) VALUES
(1, 'moiz', 'khan ', 'p229131@pwr.nu.edu.pk', 'abc@gmail.com', '03705188662', 'Buffer zone sector 15B country tower new khi', '$2y$10$ucJUYBhKhsf998b9WwmNEuGDclbJFreqH5uMCNI/.wyUNyQpLkn1y', '2025-05-01 05:04:58'),
(2, 'nasir', 'khan', 'nasir@gmail.com', 'nasir@gmail.com', '03123714499', 'Buffer zone sector 15B country tower new khi', '$2y$10$GOu.pNYfKh2yLadsQr3NJ.lqcTeNpYjbUQCoM0VasF.rIHJtkLGFS', '2025-05-01 05:41:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `bellagiomeasurements`
--
ALTER TABLE `bellagiomeasurements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bellagioproductdetails`
--
ALTER TABLE `bellagioproductdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bergamomeasurements`
--
ALTER TABLE `bergamomeasurements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bergamoproductdetails`
--
ALTER TABLE `bergamoproductdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bolzonemeasurements`
--
ALTER TABLE `bolzonemeasurements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bolzoneproductdetails`
--
ALTER TABLE `bolzoneproductdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carmomeasurements`
--
ALTER TABLE `carmomeasurements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carmoproductdetails`
--
ALTER TABLE `carmoproductdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diningchairmeasurements`
--
ALTER TABLE `diningchairmeasurements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diningchairproductdetails`
--
ALTER TABLE `diningchairproductdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `furnitureinfo`
--
ALTER TABLE `furnitureinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `madridmeasurements`
--
ALTER TABLE `madridmeasurements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `madridproductdetails`
--
ALTER TABLE `madridproductdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ottomanmeasurements`
--
ALTER TABLE `ottomanmeasurements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ottomanproductdetails`
--
ALTER TABLE `ottomanproductdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `picks`
--
ALTER TABLE `picks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sweetartchairmeasurements`
--
ALTER TABLE `sweetartchairmeasurements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sweetartchairproductdetails`
--
ALTER TABLE `sweetartchairproductdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bellagiomeasurements`
--
ALTER TABLE `bellagiomeasurements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bellagioproductdetails`
--
ALTER TABLE `bellagioproductdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bergamomeasurements`
--
ALTER TABLE `bergamomeasurements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bergamoproductdetails`
--
ALTER TABLE `bergamoproductdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bolzonemeasurements`
--
ALTER TABLE `bolzonemeasurements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bolzoneproductdetails`
--
ALTER TABLE `bolzoneproductdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `carmomeasurements`
--
ALTER TABLE `carmomeasurements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `carmoproductdetails`
--
ALTER TABLE `carmoproductdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `diningchairmeasurements`
--
ALTER TABLE `diningchairmeasurements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `diningchairproductdetails`
--
ALTER TABLE `diningchairproductdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `furnitureinfo`
--
ALTER TABLE `furnitureinfo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `madridmeasurements`
--
ALTER TABLE `madridmeasurements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `madridproductdetails`
--
ALTER TABLE `madridproductdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ottomanmeasurements`
--
ALTER TABLE `ottomanmeasurements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ottomanproductdetails`
--
ALTER TABLE `ottomanproductdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `picks`
--
ALTER TABLE `picks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `sweetartchairmeasurements`
--
ALTER TABLE `sweetartchairmeasurements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sweetartchairproductdetails`
--
ALTER TABLE `sweetartchairproductdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
