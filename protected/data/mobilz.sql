CREATE DATABASE  IF NOT EXISTS `mobilz` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `mobilz`;
-- MySQL dump 10.13  Distrib 5.5.35, for debian-linux-gnu (i686)
--
-- Host: 127.0.0.1    Database: mobilz
-- ------------------------------------------------------
-- Server version	5.5.16

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `roles` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `quantity` tinyint(4) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status_id` tinyint(4) DEFAULT NULL,
  `tracking_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id_idx` (`product_id`),
  KEY `user_id_idx` (`user_id`),
  KEY `status_id` (`status_id`),
  CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `status_id` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (27,1,2,1,NULL,NULL),(29,3,2,1,NULL,NULL),(30,2,1,2,NULL,NULL),(31,3,1,2,NULL,NULL);
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `slug` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES (1,'Apple','apple'),(2,'Samsung','samsung'),(3,'Sony','sony'),(4,'Huawei','huawei');
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `price` decimal(5,0) DEFAULT NULL,
  `published` varchar(3) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `image_file` varchar(45) DEFAULT NULL,
  `slug` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `company_id_idx` (`company_id`),
  CONSTRAINT `company_id_fk` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'Apple iPhone 5',3500,'yes',1,'iphone5.jpg','apple-iphone-5'),(2,'Samsung Galaxy S4',3400,'yes',2,'galaxys3.jpg','samsung-galaxy-s4'),(3,'Sony Xperia Z',3600,'yes',3,'sony-xperia-z1.jpg','sony-xperia-z'),(4,'Ascend P6',3300,'yes',4,'ascend-p6.jpg','ascend-p6');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) DEFAULT NULL,
  `description` varchar(125) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (1,'ADDED_TO_CART','When the item is first added to Cart. Cart will only display items in this '),(2,'PAYSON_FORWARDED','Before the customer is forwarded to Payson,  purchase_id is obtained from purchase table and then status is set to this.'),(3,'PAYSON_RETURN_OK','If return action of the payson is ok then set this.'),(4,'PAYSON_RETURN_FAIL','If return action failed'),(5,'PAYSON_RETURN_CANCEL','If customer chose to cancel transaction of Payson site, and hence cancel action executed'),(6,'IPN_STATUS_OK','If IPN received successfully then set this'),(7,'IPN_STATUS_FAIL','If IPN is invalid then set this'),(8,'IPN_CCODE_OK','If IPN Currency code found OK'),(9,'IPN_CCODE_FAIL','If IPN Currency code is not OK'),(10,'IPN_AMOUNT_OK','If IPN amount value is OK'),(11,'IPN_AMOUNT_FAIL','If IPN amount value is not OK');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(25) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `lastname` varchar(25) DEFAULT NULL,
  `provider` varchar(15) DEFAULT NULL,
  `identifier` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Hazrat','123','iloveyii@yahoo.com','0763391076','Ali',NULL,NULL),(2,'Ali','123','tocomputerscientist@gmail.com',NULL,'Bth','Facebook','1778938380'),(4,'Hazrat ','12345678','ali.sweden@gmx.com','123','Ali',NULL,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-02-23  0:32:57
