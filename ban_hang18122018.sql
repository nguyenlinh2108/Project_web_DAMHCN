-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 18, 2018 lúc 09:23 AM
-- Phiên bản máy phục vụ: 10.1.36-MariaDB
-- Phiên bản PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ban_hang`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill`
--

CREATE TABLE `bill` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(11) UNSIGNED DEFAULT NULL,
  `payment` int(10) UNSIGNED DEFAULT NULL,
  `total` int(11) UNSIGNED DEFAULT NULL COMMENT 'tổng tiền',
  `note` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('chưa thanh toán','hủy','đang chờ','đang giao hàng','đã thanh toán') NOT NULL DEFAULT 'chưa thanh toán',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `bill`
--

INSERT INTO `bill` (`id`, `customer_id`, `payment`, `total`, `note`, `status`, `created_at`, `updated_at`) VALUES
(11, 11, 1, 420000, 'không chú', 'chưa thanh toán', '2018-10-01 06:20:59', '2018-10-01 06:20:59'),
(12, 12, 1, 520000, 'Vui lòng chuyển đúng hạn', 'chưa thanh toán', '2018-10-01 06:20:59', '2018-10-01 06:20:59'),
(13, 13, 2, 400000, 'Vui lòng giao hàng trước 5h', 'chưa thanh toán', '2018-10-01 06:20:59', '2018-10-01 06:20:59'),
(14, 14, 1, 160000, 'k', 'chưa thanh toán', '2018-10-01 06:20:59', '2018-10-01 06:20:59'),
(15, 15, 1, 220000, 'không có ghi chú gì', 'chưa thanh toán', '2018-10-01 06:20:59', '2018-12-12 08:30:54'),
(16, 11, 1, 10000, 'không có ghi chú gì', '', '2018-12-09 11:47:42', '2018-12-09 04:47:42'),
(17, 11, 1, 6000, 'không có ghi chú gì', 'chưa thanh toán', '2018-12-09 21:35:08', '2018-12-09 14:35:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill_detail`
--

CREATE TABLE `bill_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_bill` int(10) UNSIGNED NOT NULL,
  `id_product` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL COMMENT 'số lượng',
  `price` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `bill_detail`
--

INSERT INTO `bill_detail` (`id`, `id_bill`, `id_product`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(13, 12, 61, 1, 120000, '2018-10-01 06:20:46', '2018-10-01 06:20:47'),
(14, 12, 60, 2, 200000, '2018-10-01 06:20:46', '2018-10-01 06:20:47'),
(15, 11, 57, 1, 200000, '2018-10-01 06:20:46', '2018-12-12 14:06:25'),
(16, 13, 60, 1, 200000, '2018-10-01 06:20:46', '2018-10-01 06:20:47'),
(17, 14, 2, 1, 160000, '2018-10-01 06:20:46', '2018-10-01 06:20:47'),
(18, 15, 62, 5, 220000, '2018-10-01 06:20:46', '2018-10-01 06:20:47'),
(19, 15, 9, 12, 25000, '2018-12-11 19:29:15', '2018-12-11 12:29:15'),
(20, 14, 12, 10, 20000, '2018-12-11 19:31:19', '2018-12-11 12:31:19');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact`
--

CREATE TABLE `contact` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `phone`, `message`) VALUES
(4, 'Nguyen Thi Linh', 'cauolacuato2121@gmail.com', '01234', 'hihihih');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` enum('Nam','Nữ','Khác') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `note` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `point` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `time_block` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`id`, `name`, `gender`, `email`, `password`, `address`, `phone`, `birthday`, `note`, `point`, `time_block`, `created_at`, `updated_at`) VALUES
(11, 'Nguyễn Hương Thị', 'Nữ', 'huongnguyenak96@gmail.com', '@@123', 'Lê Thị Riêng, Quận 1', '234567890', '2016-08-21', 'không chú', 0, NULL, '2018-10-01 06:21:16', '2018-12-15 10:38:48'),
(12, 'Phạm Văn Khoa', 'Nam', 'khoapham@gmail.com', '@@1254', 'Lê thị riêng', '1234567890', NULL, 'Vui lòng chuyển đúng hạn', 0, NULL, '2018-10-01 06:21:16', '2018-12-09 04:04:09'),
(13, 'Nguyễn Hương', 'Nữ', 'huongnguyenak96@gmail.com', '', 'Lê Thị Riêng, Quận 1', '23456789', NULL, 'Vui lòng giao hàng trước 5h', 0, NULL, '2018-10-01 06:21:16', '2018-12-09 04:03:41'),
(14, 'Hương Nguyễn', 'Nam', 'huongnguyen@gmail.com', '', 'Lê thị riêng', '99999999999999999', NULL, 'k', 0, NULL, '2018-10-01 06:21:16', '2018-12-09 04:03:46'),
(15, 'Nguyễn Thị Hương', 'Nữ', 'huongnguyen@gmail.com', '', 'e', '123456789', '1995-08-21', 'e', 0, NULL, '2018-10-01 06:21:16', '2018-12-14 09:28:41'),
(16, 'Nguyen Thi Linh', 'Nam', 'cauolacuato2121@gmail.com', 'f3f1e7998907a0c15b1f764e26e9743a', 'Xuân Thủy - Cầu Giấy', '012345768', '2016-08-21', 'không có ghi chú gì', 0, '0000-00-00 00:00:00', '2018-12-12 12:49:25', '2018-12-14 09:27:48'),
(17, 'Nguyen Thi Linh', 'Nữ', 'cauolacuato@gmail.com', 'f3f1e7998907a0c15b1f764e26e9743a', 'Xuân Thủy - Cầu Giấy', '0123456789', '2018-12-26', 'không có ghi chú gì', 0, NULL, '2018-12-12 13:05:27', '2018-12-12 06:05:27'),
(18, 'Nguyen Thi Linh', 'Nữ', 'cauolacuato21@gmail.com', 'f3f1e7998907a0c15b1f764e26e9743a', 'Xuân Thủy - Cầu Giấy', '01254789', '2018-12-26', 'không có ghi chú gì', 0, NULL, '2018-12-13 21:47:08', '2018-12-13 14:47:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payment`
--

CREATE TABLE `payment` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(10) CHARACTER SET latin1 NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `payment`
--

INSERT INTO `payment` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'COD', '2018-10-01 06:16:46', '2018-12-12 08:24:21'),
(2, 'ATM', '2018-10-01 06:16:46', '2018-12-08 02:36:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` int(10) UNSIGNED DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `unit_price` int(10) UNSIGNED NOT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL,
  `soluong` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `promotion_price` int(10) UNSIGNED DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `type`, `description`, `unit_price`, `unit_id`, `soluong`, `promotion_price`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Bánh rán\'s Long', 5, 'Bánh crepe sầu riêng nhà làm', 150000, 1, 0, 120000, '1280x720-BAV 14_12_2018 14_19_38.png', '2018-10-01 06:21:28', '2018-12-14 07:19:38'),
(2, 'Bánh Crepe Chocolate', 6, 'không có gì', 180000, 1, 0, 160000, 'Cat Street Art by SMOK 14_12_2018 14_20_08.jpg', '2018-10-01 06:21:28', '2018-12-14 07:20:08'),
(4, 'Bánh Crepe Đào', 5, 'Bánh Crepe Đào', 160000, 1, 0, 0, 'tạ đình phong 14_12_2018 18_29_24.jpg', '2018-10-01 06:21:28', '2018-12-14 11:29:24'),
(5, 'Bánh Crepe Dâu', 5, '', 160000, 1, 0, 0, 'product-3 17_12_2018 21_21_02.png', '2018-10-01 06:21:28', '2018-12-17 14:21:02'),
(6, 'Bánh Crepe Pháp', 5, '', 200000, 1, 0, 180000, '139499 14_12_2018 18_56_08.jpg', '2018-10-01 06:21:28', '2018-12-14 11:56:08'),
(7, 'Bánh Crepe Táo', 5, '', 160000, 1, 0, 0, '8667 14_12_2018 21_16_01.jpg', '2018-10-01 06:21:28', '2018-12-14 14:16:01'),
(8, 'Bánh Crepe Trà xanh', 5, '', 160000, 1, 0, 150000, '4_284 14_12_2018 21_24_35.jpg', '2018-10-01 06:21:28', '2018-12-14 14:24:35'),
(9, 'Bánh Crepe Sầu riêng và Dứa', 5, '', 160000, 1, 0, 150000, 'product-2 17_12_2018 21_21_31.png', '2018-10-01 06:21:28', '2018-12-17 14:21:31'),
(11, 'Bánh Gato Trái cây Việt Quất', 3, '', 250000, 1, 0, 0, 'maxresdefault 14_12_2018 19_10_40.jpg', '2018-10-01 06:21:28', '2018-12-14 12:10:40'),
(12, 'Bánh sinh nhật rau câu trái cây', 3, '', 200000, 1, 0, 180000, 'product-12 17_12_2018 21_19_47.png', '2018-10-01 06:21:28', '2018-12-17 14:19:47'),
(13, 'Bánh kem Chocolate Dâu', 3, '', 300000, 1, 0, 280000, '1280x720-BAV 14_12_2018 19_15_50.png', '2018-10-01 06:21:28', '2018-12-14 12:15:50'),
(14, 'Bánh kem Dâu III', 3, '', 300000, 1, 0, 280000, 'Roam couch’s new mural “Midnight Recital” in Japan 14_12_2018 21_00_59.jpg', '2018-10-01 06:21:28', '2018-12-14 14:00:59'),
(15, 'Bánh kem Dâu I', 3, '', 350000, 1, 0, 320000, 'IMG_0214 14_12_2018 20_33_27.JPG', '2018-10-01 06:21:28', '2018-12-14 13:33:27'),
(16, 'Bánh trái cây II', 3, '', 150000, 1, 0, 120000, 'meo meo 14_12_2018 21_01_20.jpg', '2018-10-01 06:21:28', '2018-12-14 14:01:20'),
(17, 'Apple Cake', 3, '', 250000, 1, 0, 240000, 'IMG_20180610_173712 14_12_2018 21_14_11.jpg', '2018-10-01 06:21:28', '2018-12-14 14:14:11'),
(18, 'Bánh ngọt nhân cream táo', 2, '', 180000, 1, 0, 0, 'IMG_20180511_144645 14_12_2018 21_22_54.jpg', '2018-10-01 06:21:28', '2018-12-14 14:22:54'),
(19, 'Bánh Chocolate Trái cây', 2, '', 150000, 1, 0, 0, 'product-13 17_12_2018 21_19_33.png', '2018-10-01 06:21:28', '2018-12-17 14:19:33'),
(20, 'Bánh Chocolate Trái cây II', 2, '', 150000, 1, 0, 0, 'Fruit-Cake_7981.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(21, 'Peach Cake', 2, '', 160000, 1, 0, 150000, 'Peach-Cake_3294.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(22, 'Bánh bông lan trứng muối I', 1, '', 160000, 1, 0, 150000, 'banhbonglantrung.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(23, 'Bánh bông lan trứng muối II', 1, '', 180000, 1, 0, 0, 'banhbonglantrungmuoi.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(24, 'Bánh French', 1, '', 180000, 1, 0, 0, 'banh-man-thu-vi-nhat-1.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(25, 'Bánh mì Australia', 1, '', 80000, 1, 0, 70000, 'dung-khoai-tay-lam-banh-gato-man-cuc-ngon.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(26, 'Bánh mặn thập cẩm', 1, '', 50000, 1, 0, 0, 'Fruit-Cake.png', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(27, 'Bánh Muffins trứng', 1, '', 100000, 1, 0, 80000, 'maxresdefault.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(28, 'Bánh Scone Peach Cake', 1, '', 120000, 1, 0, 0, 'product-15 17_12_2018 21_20_19.png', '2018-10-01 06:21:28', '2018-12-17 14:20:19'),
(29, 'Bánh mì Loaf I', 1, '', 100000, 1, 0, 0, 'sli12.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(30, 'Bánh kem Chocolate Dâu I', 4, '', 380000, 1, 0, 350000, 'sli12.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(31, 'Bánh kem Trái cây I', 4, '', 380000, 1, 0, 350000, 'Fruit-Cake.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(32, 'Bánh kem Trái cây II', 4, '', 380000, 1, 0, 350000, 'Fruit-Cake_7971.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(33, 'Bánh kem Doraemon', 4, '', 280000, 1, 0, 250000, 'p1392962167_banh74.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(34, 'Bánh kem Caramen Pudding', 4, '', 280000, 1, 0, 0, 'Caramen-pudding636099031482099583.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(35, 'Bánh kem Chocolate Fruit', 4, '', 320000, 1, 0, 300000, 'chocolate-fruit636098975917921990.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(36, 'Bánh kem Coffee Chocolate GH6', 4, '', 320000, 1, 0, 300000, 'COFFE-CHOCOLATE636098977566220885.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(37, 'Bánh kem Mango Mouse', 4, '', 320000, 1, 0, 300000, 'mango-mousse-cake.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(38, 'Bánh kem Matcha Mouse', 4, '', 350000, 1, 0, 330000, 'MATCHA-MOUSSE.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(39, 'Bánh kem Flower Fruit', 4, '', 350000, 1, 0, 330000, 'flower-fruits636102461981788938.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(40, 'Bánh kem Strawberry Delight', 4, '', 350000, 1, 0, 330000, 'strawberry-delight636102445035635173.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(41, 'Bánh kem Raspberry Delight', 4, '', 350000, 1, 0, 330000, 'raspberry.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(42, 'Beefy Pizza', 6, 'Thịt bò xay, ngô, sốt BBQ, phô mai mozzarella', 150000, 1, 0, 130000, '40819_food_pizza.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(43, 'Hawaii Pizza', 6, 'Sốt cà chua, ham , dứa, pho mai mozzarella', 120000, 1, 0, 0, 'hawaiian paradise_large-900x900.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(44, 'Smoke Chicken Pizza', 6, 'Gà hun khói,nấm, sốt cà chua, pho mai mozzarella.', 120000, 1, 0, 0, 'chicken black pepper_large-900x900.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(45, 'Sausage Pizza', 6, 'Xúc xích klobasa, Nấm, Ngô, sốtcà chua, pho mai Mozzarella.', 120000, 1, 0, 0, 'pizza-miami.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(46, 'Ocean Pizza', 6, 'Tôm , mực, xào cay,ớt xanh, hành tây, cà chua, phomai mozzarella.', 120000, 1, 0, 0, 'seafood curry_large-900x900.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(47, 'All Meaty Pizza', 6, 'Ham, bacon, chorizo, pho mai mozzarella.', 140000, 1, 0, 0, 'all1).jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(48, 'Tuna Pizza', 6, 'Cá Ngừ, sốt Mayonnaise,sốt càchua, hành tây, pho mai Mozzarella', 140000, 1, 0, 0, '54eaf93713081_-_07-germany-tuna.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(49, 'Bánh su kem nhân dừa', 7, '', 120000, 1, 0, 100000, 'maxresdefault.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(50, 'Bánh su kem sữa tươi', 7, '', 120000, 1, 0, 100000, 'sukem.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(51, 'Bánh su kem sữa tươi chiên giòn', 7, '', 150000, 1, 0, 0, '1434429117-banh-su-kem-chien-20.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(52, 'Bánh su kem dâu sữa tươi', 7, '', 150000, 1, 0, 0, 'sukemdau.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(53, 'Bánh su kem bơ sữa tươi', 7, '', 150000, 1, 0, 0, 'He-Thong-Banh-Su-Singapore-Chewy-Junior.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(54, 'Bánh su kem nhân trái cây sữa tươi', 7, '', 150000, 1, 0, 0, 'foody-banh-su-que-635930347896369908.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(55, 'Bánh su kem cà phê', 7, '', 150000, 1, 0, 0, 'banh-su-kem-ca-phe-1.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(56, 'Bánh su kem phô mai', 7, '', 150000, 1, 0, 0, '50020041-combo-20-banh-su-que-pho-mai-9.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(57, 'Bánh su kem sữa tươi chocolate', 7, '', 150000, 1, 0, 0, 'combo-20-banh-su-que-kem-sua-tuoi-phu-socola.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(58, 'Bánh Macaron Pháp', 2, 'Thưởng thức macaron, người ta có thể tìm thấy từ những hương vị truyền thống như mâm xôi, chocolate, cho đến những hương vị mới như nấm và trà xanh. Macaron với vị giòn tan của vỏ bánh, béo ngậy ngọt ngào của phần nhân, với vẻ ngoài đáng yêu và nhiều màu sắc đẹp mắt, đây là món bạn không nên bỏ qua khi khám phá nền ẩm thực Pháp.', 200000, 1, 0, 180000, 'Macaron9.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(59, 'Bánh Tiramisu - Italia', 2, 'Chỉ cần cắn một miếng, bạn sẽ cảm nhận được tất cả các hương vị đó hòa quyện cùng một chính vì thế người ta còn ví món bánh này là Thiên đường trong miệng của bạn', 200000, 1, 0, 0, '234.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(60, 'Bánh Táo - Mỹ', 2, 'Bánh táo Mỹ với phần vỏ bánh mỏng, giòn mềm, ẩn chứa phần nhân táo thơm ngọt, điểm chút vị chua dịu của trái cây quả sẽ là một lựa chọn hoàn hảo cho những tín đồ bánh ngọt trên toàn thế giới.', 200000, 1, 0, 0, '1234.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(61, 'Bánh Cupcake - Anh Quốc', 6, 'Những chiếc cupcake có cấu tạo gồm phần vỏ bánh xốp mịn và phần kem trang trí bên trên rất bắt mắt với nhiều hình dạng và màu sắc khác nhau. Cupcake còn được cho là chiếc bánh mang lại niềm vui và tiếng cười như chính hình dáng đáng yêu của chúng.', 150000, 1, 0, 120000, 'cupcake.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(62, 'Bánh Sachertorte', 6, 'Sachertorte là một loại bánh xốp được tạo ra bởi loại&nbsp;chocholate&nbsp;tuyệt hảo nhất của nước Áo. Sachertorte có vị ngọt nhẹ, gồm nhiều lớp bánh được làm từ ruột bánh mì và bánh sữa chocholate, xen lẫn giữa các lớp bánh là mứt mơ. Món bánh chocholate này nổi tiếng tới mức thành phố Vienna của Áo đã ấn định&nbsp;tổ chức một ngày Sachertorte quốc gia, vào 5/12 hằng năm', 250000, 1, 0, 220000, '111.jpg', '2018-10-01 06:21:28', '2018-10-01 06:35:44'),
(63, 'cheesecake ', 2, 'Bánh phô mai', 9000, 1, 12, 2000, 'product-16 17_12_2018 21_20_08.png', '2018-12-08 22:57:02', '2018-12-17 14:20:08'),
(64, 'adsdas', 1, 'đâsd', 9000, 1, 12, 2000, 'IMG_20181105_082348 14_12_2018 14_21_52.jpg', '2018-12-09 13:32:27', '2018-12-14 07:21:52'),
(65, 'Nguyen Thi Linh', 3, 'Bánh phô mai', 9000, 2, 21212, 2000, '5-20k 14_12_2018 11_54_55.jpg', '2018-12-14 11:54:55', '2018-12-14 04:54:55'),
(66, 'sinh nhật', 1, 'sinh nhật', 25000, 2, 20, 5000, '16-50k 14_12_2018 11_55_27.jpg', '2018-12-14 11:55:27', '2018-12-14 04:55:27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slide`
--

CREATE TABLE `slide` (
  `id` int(11) NOT NULL,
  `link` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `slide`
--

INSERT INTO `slide` (`id`, `link`, `image`, `created_at`, `updated_at`) VALUES
(8, 'linh', 'IMG_20181214_103122 17_12_2018 20_11_00.jpg', '2018-12-09 23:03:11', '2018-12-17 14:43:31'),
(9, 'https://www.youtube.com/watch?v=_aghWPzkB7M', 'oe cai... 17_12_2018 20_52_41.png', '2018-12-10 08:29:27', '2018-12-17 13:52:41'),
(10, 'hihi', '23(2) 17_12_2018 18_33_50.jpg', '2018-12-17 18:33:50', '2018-12-17 11:33:50'),
(12, 'hihihih', 'IMG_20180610_173712 17_12_2018 18_41_15.jpg', '2018-12-17 18:41:15', '2018-12-17 11:41:15'),
(14, 'linh mc', 'mcs 17_12_2018 20_54_34.jpg', '2018-12-17 20:18:39', '2018-12-17 13:54:34');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `type_product`
--

CREATE TABLE `type_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `type_product`
--

INSERT INTO `type_product` (`id`, `name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Bánh mặn', 'Nếu từng bị mê hoặc bởi các loại tarlet ngọt thì chắn chắn bạn không thể bỏ qua những loại tarlet mặn. Ngoài hình dáng bắt mắt, lớp vở bánh giòn giòn cùng với nhân mặn như thịt gà, nấm, thị heo ,… của bánh sẽ chinh phục bất cứ ai dùng thử.', 'banh-man-thu-vi-nhat-1.jpg', '2018-10-01 06:22:06', '2018-10-01 06:22:07'),
(2, 'Bánh ngọt', 'Bánh ngọt là một loại thức ăn thường dưới hình thức món bánh dạng bánh mì từ bột nhào, được nướng lên dùng để tráng miệng. Bánh ngọt có nhiều loại, có thể phân loại dựa theo nguyên liệu và kỹ thuật chế biến như bánh ngọt làm từ lúa mì, bơ, bánh ngọt dạng bọt biển. Bánh ngọt có thể phục vụ những mục đính đặc biệt như bánh cưới, bánh sinh nhật, bánh Giáng sinh, bánh Halloween..', '20131108144733.jpg', '2018-10-01 06:22:06', '2018-10-01 06:22:07'),
(3, 'Bánh trái cây', 'Bánh trái cây, hay còn gọi là bánh hoa quả, là một món ăn chơi, không riêng gì của Huế nhưng khi \"lạc\" vào mảnh đất Cố đô, món bánh này dường như cũng mang chút tinh tế, cầu kỳ và đặc biệt. Lấy cảm hứng từ những loại trái cây trong vườn, qua bàn tay khéo léo của người phụ nữ Huế, món bánh trái cây ra đời - ngọt thơm, dịu nhẹ làm đẹp lòng biết bao người thưởng thức.', 'banhtraicay.jpg', '2018-10-01 06:22:06', '2018-10-01 06:22:07'),
(4, 'Bánh kem', 'Với người Việt Nam thì bánh ngọt nói chung đều hay được quy về bánh bông lan – một loại tráng miệng bông xốp, ăn không hoặc được phủ kem lên thành bánh kem. Tuy nhiên, cốt bánh kem thực ra có rất nhiều loại với hương vị, kết cấu và phương thức làm khác nhau chứ không chỉ đơn giản là “bánh bông lan” chung chung đâu nhé!', 'banhkem.jpg', '2018-10-01 06:22:06', '2018-10-01 06:22:07'),
(5, 'Bánh crepe', 'Crepe là một món bánh nổi tiếng của Pháp, nhưng từ khi du nhập vào Việt Nam món bánh đẹp mắt, ngon miệng này đã làm cho biết bao bạn trẻ phải “xiêu lòng”', 'crepe.jpg', '2018-10-01 06:22:06', '2018-10-01 06:22:07'),
(6, 'Bánh Pizza', 'Pizza đã không chỉ còn là một món ăn được ưa chuộng khắp thế giới mà còn được những nhà cầm quyền EU chứng nhận là một phần di sản văn hóa ẩm thực châu Âu. Và để được chứng nhận là một nhà sản xuất pizza không hề đơn giản. Người ta phải qua đủ mọi các bước xét duyệt của chính phủ Ý và liên minh châu Âu nữa… tất cả là để đảm bảo danh tiếng cho món ăn này.', 'pizza.jpg', '2018-10-01 06:22:06', '2018-10-01 06:22:07'),
(7, 'Bánh su kem', 'Bánh su kem là món bánh ngọt ở dạng kem được làm từ các nguyên liệu như bột mì, trứng, sữa, bơ.... đánh đều tạo thành một hỗn hợp và sau đó bằng thao tác ép và phun qua một cái túi để định hình thành những bánh nhỏ và cuối cùng được nướng chín. Bánh su kem có thể thêm thành phần Sô cô la để tăng vị hấp dẫn. Bánh có xuất xứ từ nước Pháp.', 'sukemdau.jpg', '2018-10-01 06:22:06', '2018-10-01 06:22:07'),
(8, 'bánh kếp 1', 'bánh kếp', '5_272 14_12_2018 22_10_18.jpg', '2018-12-14 22:10:18', '2018-12-17 15:08:54');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `unit`
--

CREATE TABLE `unit` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `unit`
--

INSERT INTO `unit` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'hộp', '2018-10-01 13:32:22', '2018-10-01 06:32:22'),
(2, 'cái', '2018-10-01 13:32:27', '2018-12-14 14:51:49'),
(3, 'kg', '2018-10-01 13:32:34', '2018-10-01 06:32:34'),
(5, 'lít', '2018-12-14 21:53:20', '2018-12-14 14:53:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gender` enum('Nam','Nữ','Khác') COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` enum('Quản trị viên','Biên tập viên') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `gender`, `avatar`, `password`, `phone`, `address`, `level`, `created_at`, `updated_at`) VALUES
(1, 'Le Ngoc Long', '20142659@student.hust.edu.vn', 'Nam', '5_272 17_12_2018 21_57_09.jpg', '6220cd02f3d5cf34cb5a0848659b2003', '012465768983', 'Ha Noi, Viet Nam', 'Biên tập viên', '2018-10-01 14:15:08', '2018-12-17 14:57:09'),
(4, 'Nguyễn Thị Linh', 'cauolacuato2121@gmail.com', 'Nữ', 'IMG_20181105_082348 18_12_2018 11_09_34.jpg', 'a0a74396c5dda288796cce380a73b2af', '0923541958', 'Cầu Giấy - Hà nội', 'Quản trị viên', '2018-12-02 23:37:40', '2018-12-18 05:28:37'),
(7, 'Chung Thanh Sơn', 'cauolacuato@yahoo.com', 'Nam', 'tạ đình phong 15_12_2018 15_17_48.jpg', 'f3f1e7998907a0c15b1f764e26e9743a', '0977597535', 'Trương Định - Hai Bà Trưng', 'Biên tập viên', '2018-12-15 15:17:48', '2018-12-15 08:17:48'),
(8, 'Nguyễn Văn Phú', 'phu1005@gmail.com', 'Nam', '4_284 17_12_2018 22_03_10.jpg', 'f3f1e7998907a0c15b1f764e26e9743a', '01645961556', 'Xuân Thủy - Cầu Giấy', 'Quản trị viên', '2018-12-15 15:52:48', '2018-12-17 15:03:10'),
(9, 'Nguyễn Thị Quỳnh', 'quynhgiao0308@gmail.com', 'Nữ', 'IMG_20181122_182809 2 15_12_2018 16_06_31.jpg', 'f3f1e7998907a0c15b1f764e26e9743a', '01645961557', 'Xuân Thủy - Cầu Giấy', 'Biên tập viên', '2018-12-15 16:06:31', '2018-12-15 09:06:31');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_idx` (`payment`),
  ADD KEY `customer_idx` (`customer_id`);

--
-- Chỉ mục cho bảng `bill_detail`
--
ALTER TABLE `bill_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_detail_ibfk_2` (`id_product`),
  ADD KEY `bill_idx` (`id_bill`);

--
-- Chỉ mục cho bảng `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_id_type_foreign` (`type`),
  ADD KEY `unit` (`unit_id`);

--
-- Chỉ mục cho bảng `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `type_product`
--
ALTER TABLE `type_product`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `bill_detail`
--
ALTER TABLE `bill_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT cho bảng `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `type_product`
--
ALTER TABLE `type_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `payment` FOREIGN KEY (`payment`) REFERENCES `payment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `bill_detail`
--
ALTER TABLE `bill_detail`
  ADD CONSTRAINT `bill` FOREIGN KEY (`id_bill`) REFERENCES `bill` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `product` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`id`),
  ADD CONSTRAINT `products_id_type_foreign` FOREIGN KEY (`type`) REFERENCES `type_product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
