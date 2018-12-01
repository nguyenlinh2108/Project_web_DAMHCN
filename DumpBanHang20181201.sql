CREATE DATABASE  IF NOT EXISTS `ban_hang` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `ban_hang`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: ban_hang
-- ------------------------------------------------------
-- Server version	5.7.22-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bill`
--

DROP TABLE IF EXISTS `bill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bill` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) unsigned DEFAULT NULL,
  `payment` int(10) unsigned DEFAULT NULL,
  `total` int(11) unsigned DEFAULT NULL COMMENT 'tổng tiền',
  `note` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('chưa thanh toán','hủy','đang chờ','đang giao hàng','đã thanh toán') NOT NULL DEFAULT 'chưa thanh toán',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `payment_idx` (`payment`),
  KEY `customer_idx` (`customer_id`),
  CONSTRAINT `customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `payment` FOREIGN KEY (`payment`) REFERENCES `payment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bill`
--

LOCK TABLES `bill` WRITE;
/*!40000 ALTER TABLE `bill` DISABLE KEYS */;
INSERT INTO `bill` VALUES (11,11,1,420000,'không chú','chưa thanh toán','2018-10-01 06:20:59','2018-10-01 06:20:59'),(12,12,1,520000,'Vui lòng chuyển đúng hạn','chưa thanh toán','2018-10-01 06:20:59','2018-10-01 06:20:59'),(13,13,2,400000,'Vui lòng giao hàng trước 5h','chưa thanh toán','2018-10-01 06:20:59','2018-10-01 06:20:59'),(14,14,1,160000,'k','chưa thanh toán','2018-10-01 06:20:59','2018-10-01 06:20:59'),(15,15,1,220000,'e','chưa thanh toán','2018-10-01 06:20:59','2018-10-01 06:20:59');
/*!40000 ALTER TABLE `bill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bill_detail`
--

DROP TABLE IF EXISTS `bill_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bill_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_bill` int(10) unsigned NOT NULL,
  `id_product` int(10) unsigned NOT NULL,
  `quantity` int(11) NOT NULL COMMENT 'số lượng',
  `price` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `bill_detail_ibfk_2` (`id_product`),
  KEY `bill_idx` (`id_bill`),
  CONSTRAINT `bill` FOREIGN KEY (`id_bill`) REFERENCES `bill` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `product` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bill_detail`
--

LOCK TABLES `bill_detail` WRITE;
/*!40000 ALTER TABLE `bill_detail` DISABLE KEYS */;
INSERT INTO `bill_detail` VALUES (11,11,57,2,150000,'2018-10-01 06:20:46','2018-10-01 06:20:47'),(12,11,61,1,120000,'2018-10-01 06:20:46','2018-10-01 06:20:47'),(13,12,61,1,120000,'2018-10-01 06:20:46','2018-10-01 06:20:47'),(14,12,60,2,200000,'2018-10-01 06:20:46','2018-10-01 06:20:47'),(15,13,59,1,200000,'2018-10-01 06:20:46','2018-10-01 06:20:47'),(16,13,60,1,200000,'2018-10-01 06:20:46','2018-10-01 06:20:47'),(17,14,2,1,160000,'2018-10-01 06:20:46','2018-10-01 06:20:47'),(18,15,62,5,220000,'2018-10-01 06:20:46','2018-10-01 06:20:47');
/*!40000 ALTER TABLE `bill_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `gender` enum('Nam','Nữ','Khác') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `note` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `point` int(10) unsigned NOT NULL DEFAULT '0',
  `time_block` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (11,'','Nữ','huongnguyenak96@gmail.com','Lê Thị Riêng, Quận 1','234567890-',NULL,'không chú',0,NULL,'2018-10-01 06:21:16','2018-10-01 06:21:16'),(12,'','Nam','khoapham@gmail.com','Lê thị riêng','1234567890',NULL,'Vui lòng chuyển đúng hạn',0,NULL,'2018-10-01 06:21:16','2018-10-01 06:21:16'),(13,'','Nữ','huongnguyenak96@gmail.com','Lê Thị Riêng, Quận 1','23456789',NULL,'Vui lòng giao hàng trước 5h',0,NULL,'2018-10-01 06:21:16','2018-10-01 06:21:16'),(14,'','Nam','huongnguyen@gmail.com','Lê thị riêng','99999999999999999',NULL,'k',0,NULL,'2018-10-01 06:21:16','2018-10-01 06:21:16'),(15,'','Nữ','huongnguyen@gmail.com','e','e',NULL,'e',0,NULL,'2018-10-01 06:21:16','2018-10-01 06:21:16');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(10) CHARACTER SET latin1 NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (1,'COD','2018-10-01 06:16:46','2018-10-01 06:16:46'),(2,'ATM','2018-10-01 06:16:46','2018-10-01 06:16:46');
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` int(10) unsigned DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `unit_price` int(10) unsigned NOT NULL,
  `unit_id` int(10) unsigned NOT NULL,
  `soluong` int(10) unsigned NOT NULL DEFAULT '0',
  `promotion_price` int(10) unsigned DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `products_id_type_foreign` (`type`),
  KEY `unit` (`unit_id`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`id`),
  CONSTRAINT `products_id_type_foreign` FOREIGN KEY (`type`) REFERENCES `type_product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'Bánh Crepe Sầu riêng',5,'Bánh crepe sầu riêng nhà làm',150000,1,0,120000,'1430967449-pancake-sau-rieng-6.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(2,'Bánh Crepe Chocolate',6,'',180000,1,0,160000,'crepe-chocolate.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(3,'Bánh Crepe Sầu riêng - Chuối',5,'',150000,1,0,120000,'crepe-chuoi.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(4,'Bánh Crepe Đào',5,'',160000,1,0,0,'crepe-dao.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(5,'Bánh Crepe Dâu',5,'',160000,1,0,0,'crepedau.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(6,'Bánh Crepe Pháp',5,'',200000,1,0,180000,'crepe-phap.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(7,'Bánh Crepe Táo',5,'',160000,1,0,0,'crepe-tao.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(8,'Bánh Crepe Trà xanh',5,'',160000,1,0,150000,'crepe-traxanh.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(9,'Bánh Crepe Sầu riêng và Dứa',5,'',160000,1,0,150000,'saurieng-dua.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(11,'Bánh Gato Trái cây Việt Quất',3,'',250000,1,0,0,'544bc48782741.png','2018-10-01 06:21:28','2018-10-01 06:35:44'),(12,'Bánh sinh nhật rau câu trái cây',3,'',200000,1,0,180000,'210215-banh-sinh-nhat-rau-cau-body- (6).jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(13,'Bánh kem Chocolate Dâu',3,'',300000,1,0,280000,'banh kem sinh nhat.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(14,'Bánh kem Dâu III',3,'',300000,1,0,280000,'Banh-kem (6).jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(15,'Bánh kem Dâu I',3,'',350000,1,0,320000,'banhkem-dau.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(16,'Bánh trái cây II',3,'',150000,1,0,120000,'banhtraicay.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(17,'Apple Cake',3,'',250000,1,0,240000,'Fruit-Cake_7979.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(18,'Bánh ngọt nhân cream táo',2,'',180000,1,0,0,'20131108144733.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(19,'Bánh Chocolate Trái cây',2,'',150000,1,0,0,'Fruit-Cake_7976.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(20,'Bánh Chocolate Trái cây II',2,'',150000,1,0,0,'Fruit-Cake_7981.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(21,'Peach Cake',2,'',160000,1,0,150000,'Peach-Cake_3294.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(22,'Bánh bông lan trứng muối I',1,'',160000,1,0,150000,'banhbonglantrung.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(23,'Bánh bông lan trứng muối II',1,'',180000,1,0,0,'banhbonglantrungmuoi.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(24,'Bánh French',1,'',180000,1,0,0,'banh-man-thu-vi-nhat-1.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(25,'Bánh mì Australia',1,'',80000,1,0,70000,'dung-khoai-tay-lam-banh-gato-man-cuc-ngon.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(26,'Bánh mặn thập cẩm',1,'',50000,1,0,0,'Fruit-Cake.png','2018-10-01 06:21:28','2018-10-01 06:35:44'),(27,'Bánh Muffins trứng',1,'',100000,1,0,80000,'maxresdefault.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(28,'Bánh Scone Peach Cake',1,'',120000,1,0,0,'Peach-Cake_3300.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(29,'Bánh mì Loaf I',1,'',100000,1,0,0,'sli12.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(30,'Bánh kem Chocolate Dâu I',4,'',380000,1,0,350000,'sli12.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(31,'Bánh kem Trái cây I',4,'',380000,1,0,350000,'Fruit-Cake.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(32,'Bánh kem Trái cây II',4,'',380000,1,0,350000,'Fruit-Cake_7971.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(33,'Bánh kem Doraemon',4,'',280000,1,0,250000,'p1392962167_banh74.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(34,'Bánh kem Caramen Pudding',4,'',280000,1,0,0,'Caramen-pudding636099031482099583.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(35,'Bánh kem Chocolate Fruit',4,'',320000,1,0,300000,'chocolate-fruit636098975917921990.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(36,'Bánh kem Coffee Chocolate GH6',4,'',320000,1,0,300000,'COFFE-CHOCOLATE636098977566220885.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(37,'Bánh kem Mango Mouse',4,'',320000,1,0,300000,'mango-mousse-cake.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(38,'Bánh kem Matcha Mouse',4,'',350000,1,0,330000,'MATCHA-MOUSSE.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(39,'Bánh kem Flower Fruit',4,'',350000,1,0,330000,'flower-fruits636102461981788938.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(40,'Bánh kem Strawberry Delight',4,'',350000,1,0,330000,'strawberry-delight636102445035635173.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(41,'Bánh kem Raspberry Delight',4,'',350000,1,0,330000,'raspberry.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(42,'Beefy Pizza',6,'Thịt bò xay, ngô, sốt BBQ, phô mai mozzarella',150000,1,0,130000,'40819_food_pizza.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(43,'Hawaii Pizza',6,'Sốt cà chua, ham , dứa, pho mai mozzarella',120000,1,0,0,'hawaiian paradise_large-900x900.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(44,'Smoke Chicken Pizza',6,'Gà hun khói,nấm, sốt cà chua, pho mai mozzarella.',120000,1,0,0,'chicken black pepper_large-900x900.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(45,'Sausage Pizza',6,'Xúc xích klobasa, Nấm, Ngô, sốtcà chua, pho mai Mozzarella.',120000,1,0,0,'pizza-miami.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(46,'Ocean Pizza',6,'Tôm , mực, xào cay,ớt xanh, hành tây, cà chua, phomai mozzarella.',120000,1,0,0,'seafood curry_large-900x900.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(47,'All Meaty Pizza',6,'Ham, bacon, chorizo, pho mai mozzarella.',140000,1,0,0,'all1).jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(48,'Tuna Pizza',6,'Cá Ngừ, sốt Mayonnaise,sốt càchua, hành tây, pho mai Mozzarella',140000,1,0,0,'54eaf93713081_-_07-germany-tuna.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(49,'Bánh su kem nhân dừa',7,'',120000,1,0,100000,'maxresdefault.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(50,'Bánh su kem sữa tươi',7,'',120000,1,0,100000,'sukem.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(51,'Bánh su kem sữa tươi chiên giòn',7,'',150000,1,0,0,'1434429117-banh-su-kem-chien-20.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(52,'Bánh su kem dâu sữa tươi',7,'',150000,1,0,0,'sukemdau.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(53,'Bánh su kem bơ sữa tươi',7,'',150000,1,0,0,'He-Thong-Banh-Su-Singapore-Chewy-Junior.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(54,'Bánh su kem nhân trái cây sữa tươi',7,'',150000,1,0,0,'foody-banh-su-que-635930347896369908.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(55,'Bánh su kem cà phê',7,'',150000,1,0,0,'banh-su-kem-ca-phe-1.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(56,'Bánh su kem phô mai',7,'',150000,1,0,0,'50020041-combo-20-banh-su-que-pho-mai-9.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(57,'Bánh su kem sữa tươi chocolate',7,'',150000,1,0,0,'combo-20-banh-su-que-kem-sua-tuoi-phu-socola.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(58,'Bánh Macaron Pháp',2,'Thưởng thức macaron, người ta có thể tìm thấy từ những hương vị truyền thống như mâm xôi, chocolate, cho đến những hương vị mới như nấm và trà xanh. Macaron với vị giòn tan của vỏ bánh, béo ngậy ngọt ngào của phần nhân, với vẻ ngoài đáng yêu và nhiều màu sắc đẹp mắt, đây là món bạn không nên bỏ qua khi khám phá nền ẩm thực Pháp.',200000,1,0,180000,'Macaron9.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(59,'Bánh Tiramisu - Italia',2,'Chỉ cần cắn một miếng, bạn sẽ cảm nhận được tất cả các hương vị đó hòa quyện cùng một chính vì thế người ta còn ví món bánh này là Thiên đường trong miệng của bạn',200000,1,0,0,'234.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(60,'Bánh Táo - Mỹ',2,'Bánh táo Mỹ với phần vỏ bánh mỏng, giòn mềm, ẩn chứa phần nhân táo thơm ngọt, điểm chút vị chua dịu của trái cây quả sẽ là một lựa chọn hoàn hảo cho những tín đồ bánh ngọt trên toàn thế giới.',200000,1,0,0,'1234.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(61,'Bánh Cupcake - Anh Quốc',6,'Những chiếc cupcake có cấu tạo gồm phần vỏ bánh xốp mịn và phần kem trang trí bên trên rất bắt mắt với nhiều hình dạng và màu sắc khác nhau. Cupcake còn được cho là chiếc bánh mang lại niềm vui và tiếng cười như chính hình dáng đáng yêu của chúng.',150000,1,0,120000,'cupcake.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44'),(62,'Bánh Sachertorte',6,'Sachertorte là một loại bánh xốp được tạo ra bởi loại&nbsp;chocholate&nbsp;tuyệt hảo nhất của nước Áo. Sachertorte có vị ngọt nhẹ, gồm nhiều lớp bánh được làm từ ruột bánh mì và bánh sữa chocholate, xen lẫn giữa các lớp bánh là mứt mơ. Món bánh chocholate này nổi tiếng tới mức thành phố Vienna của Áo đã ấn định&nbsp;tổ chức một ngày Sachertorte quốc gia, vào 5/12 hằng năm',250000,1,0,220000,'111.jpg','2018-10-01 06:21:28','2018-10-01 06:35:44');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slide`
--

DROP TABLE IF EXISTS `slide`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slide`
--

LOCK TABLES `slide` WRITE;
/*!40000 ALTER TABLE `slide` DISABLE KEYS */;
INSERT INTO `slide` VALUES (1,'','banner1.jpg','2018-10-01 06:21:54','2018-10-01 06:21:55'),(2,'','banner2.jpg','2018-10-01 06:21:54','2018-10-01 06:21:55'),(3,'','banner3.jpg','2018-10-01 06:21:54','2018-10-01 06:21:55'),(4,'','banner4.jpg','2018-10-01 06:21:54','2018-10-01 06:21:55');
/*!40000 ALTER TABLE `slide` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_product`
--

DROP TABLE IF EXISTS `type_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_product`
--

LOCK TABLES `type_product` WRITE;
/*!40000 ALTER TABLE `type_product` DISABLE KEYS */;
INSERT INTO `type_product` VALUES (1,'Bánh mặn','Nếu từng bị mê hoặc bởi các loại tarlet ngọt thì chắn chắn bạn không thể bỏ qua những loại tarlet mặn. Ngoài hình dáng bắt mắt, lớp vở bánh giòn giòn cùng với nhân mặn như thịt gà, nấm, thị heo ,… của bánh sẽ chinh phục bất cứ ai dùng thử.','banh-man-thu-vi-nhat-1.jpg','2018-10-01 06:22:06','2018-10-01 06:22:07'),(2,'Bánh ngọt','Bánh ngọt là một loại thức ăn thường dưới hình thức món bánh dạng bánh mì từ bột nhào, được nướng lên dùng để tráng miệng. Bánh ngọt có nhiều loại, có thể phân loại dựa theo nguyên liệu và kỹ thuật chế biến như bánh ngọt làm từ lúa mì, bơ, bánh ngọt dạng bọt biển. Bánh ngọt có thể phục vụ những mục đính đặc biệt như bánh cưới, bánh sinh nhật, bánh Giáng sinh, bánh Halloween..','20131108144733.jpg','2018-10-01 06:22:06','2018-10-01 06:22:07'),(3,'Bánh trái cây','Bánh trái cây, hay còn gọi là bánh hoa quả, là một món ăn chơi, không riêng gì của Huế nhưng khi \"lạc\" vào mảnh đất Cố đô, món bánh này dường như cũng mang chút tinh tế, cầu kỳ và đặc biệt. Lấy cảm hứng từ những loại trái cây trong vườn, qua bàn tay khéo léo của người phụ nữ Huế, món bánh trái cây ra đời - ngọt thơm, dịu nhẹ làm đẹp lòng biết bao người thưởng thức.','banhtraicay.jpg','2018-10-01 06:22:06','2018-10-01 06:22:07'),(4,'Bánh kem','Với người Việt Nam thì bánh ngọt nói chung đều hay được quy về bánh bông lan – một loại tráng miệng bông xốp, ăn không hoặc được phủ kem lên thành bánh kem. Tuy nhiên, cốt bánh kem thực ra có rất nhiều loại với hương vị, kết cấu và phương thức làm khác nhau chứ không chỉ đơn giản là “bánh bông lan” chung chung đâu nhé!','banhkem.jpg','2018-10-01 06:22:06','2018-10-01 06:22:07'),(5,'Bánh crepe','Crepe là một món bánh nổi tiếng của Pháp, nhưng từ khi du nhập vào Việt Nam món bánh đẹp mắt, ngon miệng này đã làm cho biết bao bạn trẻ phải “xiêu lòng”','crepe.jpg','2018-10-01 06:22:06','2018-10-01 06:22:07'),(6,'Bánh Pizza','Pizza đã không chỉ còn là một món ăn được ưa chuộng khắp thế giới mà còn được những nhà cầm quyền EU chứng nhận là một phần di sản văn hóa ẩm thực châu Âu. Và để được chứng nhận là một nhà sản xuất pizza không hề đơn giản. Người ta phải qua đủ mọi các bước xét duyệt của chính phủ Ý và liên minh châu Âu nữa… tất cả là để đảm bảo danh tiếng cho món ăn này.','pizza.jpg','2018-10-01 06:22:06','2018-10-01 06:22:07'),(7,'Bánh su kem','Bánh su kem là món bánh ngọt ở dạng kem được làm từ các nguyên liệu như bột mì, trứng, sữa, bơ.... đánh đều tạo thành một hỗn hợp và sau đó bằng thao tác ép và phun qua một cái túi để định hình thành những bánh nhỏ và cuối cùng được nướng chín. Bánh su kem có thể thêm thành phần Sô cô la để tăng vị hấp dẫn. Bánh có xuất xứ từ nước Pháp.','sukemdau.jpg','2018-10-01 06:22:06','2018-10-01 06:22:07');
/*!40000 ALTER TABLE `type_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unit`
--

DROP TABLE IF EXISTS `unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit`
--

LOCK TABLES `unit` WRITE;
/*!40000 ALTER TABLE `unit` DISABLE KEYS */;
INSERT INTO `unit` VALUES (1,'hộp','2018-10-01 13:32:22','2018-10-01 06:32:22'),(2,'cái','2018-10-01 13:32:27','2018-10-01 06:32:27'),(3,'kg','2018-10-01 13:32:34','2018-10-01 06:32:34');
/*!40000 ALTER TABLE `unit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gender` enum('Nam','Nữ','Khác') COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` enum('Quản trị viên','Biên tập viên') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Le Ngoc Long','20142659@student.hust.edu.vn','Nam',NULL,'6220cd02f3d5cf34cb5a0848659b2003','012465768983','Ha Noi, Viet Nam','Quản trị viên','2018-10-01 14:15:08','2018-12-01 15:29:41'),(2,'ALPhaHoai','alphahoai@gmail.com','Khác',NULL,'6220cd02f3d5cf34cb5a0848659b2003','0123456789','Cù Chính Lan, Thanh Xuân, Hà Nội','Quản trị viên','2018-12-01 21:26:22','2018-12-01 15:29:43');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'ban_hang'
--

--
-- Dumping routines for database 'ban_hang'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-12-01 22:31:00
