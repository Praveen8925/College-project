-- MySQL dump 10.13  Distrib 9.1.0, for Win64 (x86_64)
--
-- Host: localhost    Database: collegedetails
-- ------------------------------------------------------
-- Server version	9.1.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `2014`
--

DROP TABLE IF EXISTS `2014`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2014` (
  `Batch` int DEFAULT NULL,
  `sem` int DEFAULT NULL,
  `exam_type` varchar(15) DEFAULT NULL,
  `RegNo` varchar(10) DEFAULT NULL,
  `mark` varchar(30) DEFAULT NULL,
  `decided` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `2014`
--

LOCK TABLES `2014` WRITE;
/*!40000 ALTER TABLE `2014` DISABLE KEYS */;
INSERT INTO `2014` VALUES (2014,6,'cycletest1','N4BIT0001','35-25-27-30','n'),(2014,6,'cycletest2','N4BIT0001','30-AB-34-43','n'),(2014,6,'cycletest2','N4BIT0002','32-32-23-32','n'),(2014,6,'modelexam','N4BIT0001','56-43-55-44','n'),(2014,6,'modelexam','N4BIT0002','AB-34-23-65','n'),(2014,6,'cycletest1','N4BIT0002','00-00-00-00','y');
/*!40000 ALTER TABLE `2014` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `2014assignment`
--

DROP TABLE IF EXISTS `2014assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2014assignment` (
  `Batch` int DEFAULT NULL,
  `sem` int DEFAULT NULL,
  `RegNo` varchar(10) DEFAULT NULL,
  `ass_mark` varchar(30) DEFAULT NULL,
  `decided` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `2014assignment`
--

LOCK TABLES `2014assignment` WRITE;
/*!40000 ALTER TABLE `2014assignment` DISABLE KEYS */;
INSERT INTO `2014assignment` VALUES (2014,6,'N4BIT0001','04-04-03-02','n'),(2014,6,'N4BIT0002','03-02-02-01','n');
/*!40000 ALTER TABLE `2014assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `2014attendance`
--

DROP TABLE IF EXISTS `2014attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2014attendance` (
  `Batch` int DEFAULT NULL,
  `sem` int DEFAULT NULL,
  `RegNo` varchar(10) DEFAULT NULL,
  `tot_working_days` int DEFAULT NULL,
  `no_day_present` int DEFAULT NULL,
  `decided` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `2014attendance`
--

LOCK TABLES `2014attendance` WRITE;
/*!40000 ALTER TABLE `2014attendance` DISABLE KEYS */;
INSERT INTO `2014attendance` VALUES (2014,6,'N4BIT0001',100,90,'n'),(2014,6,'N4BIT0002',100,95,'n');
/*!40000 ALTER TABLE `2014attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `2014lab`
--

DROP TABLE IF EXISTS `2014lab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2014lab` (
  `Batch` int DEFAULT NULL,
  `sem` int DEFAULT NULL,
  `Type` varchar(15) DEFAULT NULL,
  `RegNo` varchar(10) DEFAULT NULL,
  `mark` varchar(30) DEFAULT NULL,
  `decided` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `2014lab`
--

LOCK TABLES `2014lab` WRITE;
/*!40000 ALTER TABLE `2014lab` DISABLE KEYS */;
/*!40000 ALTER TABLE `2014lab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `2015`
--

DROP TABLE IF EXISTS `2015`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2015` (
  `Batch` int DEFAULT NULL,
  `sem` int DEFAULT NULL,
  `exam_type` varchar(15) DEFAULT NULL,
  `RegNo` varchar(10) DEFAULT NULL,
  `mark` varchar(30) DEFAULT NULL,
  `decided` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `2015`
--

LOCK TABLES `2015` WRITE;
/*!40000 ALTER TABLE `2015` DISABLE KEYS */;
INSERT INTO `2015` VALUES (2015,5,'cycletest1','N5BIT0001','31-35-11-17-28-49-48','n'),(2015,5,'cycletest1','N5BIT0002','25-17-08-28-09-23-29','n'),(2015,5,'cycletest1','N5BIT0003','33-26-24-32-32-45-30','n'),(2015,5,'cycletest1','N5BIT0004','21-33-21-27-20-30-32','n'),(2015,5,'cycletest1','N5BIT0005','28-19-21-26-28-27-39','n'),(2015,5,'cycletest1','N5BIT0006','21-30-21-24-20-AB-21','n'),(2015,5,'cycletest1','N5BIT0007','28-22-14-26-23-AB-20','n'),(2015,5,'cycletest1','N5BIT0008','38-15-20-45-34-38-46','n'),(2015,5,'cycletest1','N5BIT0009','33-24-20-32-28-44-40','n'),(2015,5,'cycletest1','N5BIT0010','25-28-14-28-25-27-20','n'),(2015,5,'cycletest1','N5BIT0011','18-10-10-10-11-23-21','n'),(2015,5,'cycletest1','N5BIT0012','15-24-07-10-02-18-31','n'),(2015,5,'cycletest1','N5BIT0013','18-12-14-26-20-25-20','n'),(2015,5,'cycletest1','N5BIT0014','18-22-12-27-10-20-20','n'),(2015,5,'cycletest1','N5BIT0015','37-20-20-31-23-36-36','n'),(2015,5,'cycletest1','N5BIT0016','23-AB-13-26-13-23-20','n'),(2015,5,'cycletest1','N5BIT0017','22-16-10-20-12-25-32','n'),(2015,5,'cycletest1','N5BIT0018','27-17-20-28-27-29-20','n'),(2015,5,'cycletest1','N5BIT0019','27-09-07-20-23-31-38','n'),(2015,5,'cycletest1','N5BIT0020','25-21-20-30-22-37-21','n'),(2015,5,'cycletest1','N5BIT0021','36-26-20-30-24-45-28','n'),(2015,5,'cycletest1','N5BIT0022','29-19-12-20-31-37-38','n'),(2015,5,'cycletest1','N5BIT0023','20-16-11-20-20-30-20','n'),(2015,5,'cycletest1','N5BIT0024','24-14-12-08-10-12-20','n'),(2015,5,'cycletest1','N5BIT0025','38-22-23-28-27-35-20','n'),(2015,5,'cycletest1','N5BIT0026','28-21-20-24-22-30-38','n'),(2015,5,'cycletest1','N5BIT0027','28-21-09-21-26-34-44','n'),(2015,5,'cycletest1','N5BIT0028','27-AB-10-16-14-AB-36','n'),(2015,5,'cycletest1','N5BIT0031','21-18-14-31-22-32-20','n'),(2015,5,'cycletest1','N5BIT0032','15-14-08-15-11-25-20','n'),(2015,5,'cycletest1','N5BIT0034','23-13-12-12-15-24-25','n'),(2015,5,'cycletest1','N5BIT0035','18-17-15-20-12-15-20','n'),(2015,5,'cycletest1','N5BIT0036','20-15-15-19-16-AB-30','n'),(2015,5,'cycletest1','N5BIT0037','20-21-22-25-23-31-28','n'),(2015,5,'cycletest1','N5BIT0038','28-16-20-AB-24-32-38','n'),(2015,5,'cycletest1','N5BIT0039','39-22-23-29-40-37-46','n'),(2015,5,'cycletest1','N5BIT0040','29-20-20-38-23-30-26','n'),(2015,5,'cycletest1','N5BIT0041','20-14-13-AB-28-30-26','n'),(2015,5,'cycletest1','N5BIT0042','26-18-11-16-16-23-20','n'),(2015,5,'cycletest1','N5BIT0043','45-25-26-45-42-45-46','n'),(2015,5,'cycletest1','N5BIT0044','25-21-20-25-20-AB-44','n'),(2015,5,'cycletest1','N5BIT0046','40-25-35-40-32-47-48','n'),(2015,5,'cycletest1','N5BIT0047','21-12-25-31-38-37-42','n'),(2015,5,'cycletest1','N5BIT0048','18-17-12-15-20-AB-38','n'),(2015,5,'cycletest1','N5BIT0049','24-16-13-31-24-27-20','n'),(2015,5,'cycletest1','N5BIT0050','25-20-10-20-24-38-28','n'),(2015,5,'cycletest1','N5BIT0051','44-23-29-35-43-47-45','n'),(2015,5,'cycletest1','N5BIT0052','33-19-07-22-27-48-30','n'),(2015,5,'cycletest1','N5BIT0053','32-23-20-30-25-42-38','n'),(2015,5,'cycletest1','N5BIT0055','28-20-20-17-31-45-30','n'),(2015,5,'cycletest1','N5BIT0056','09-17-07-18-14-35-20','n'),(2015,5,'cycletest1','N5BIT0057','12-12-11-26-21-32-33','n'),(2015,5,'cycletest1','N5BIT0058','18-19-20-20-21-15-32','n'),(2015,5,'cycletest1','N5BIT0059','04-11-12-05-03-15-20','n'),(2015,5,'cycletest1','N5BIT0060','30-20-13-25-25-31-31','n'),(2015,5,'cycletest1','N5BIT0061','AB-AB-AB-AB-AB-AB-AB','n'),(2015,5,'cycletest1','N5BIT0062','27-18-20-31-22-30-42','n'),(2015,5,'cycletest1','N5BIT0063','36-19-12-25-24-38-35','n'),(2015,5,'cycletest2','N5BIT0001','25-20-22-35-35-48-49','n'),(2015,5,'cycletest2','N5BIT0002','18-25-15-30-25-35-35','n'),(2015,5,'cycletest2','N5BIT0003','25-35-15-28-39-41-25','n'),(2015,5,'cycletest2','N5BIT0004','29-36-15-24-16-39-40','n'),(2015,5,'cycletest2','N5BIT0005','25-15-47-35-25-20-25','n'),(2015,5,'cycletest2','N5BIT0006','40-36-27-29-30-45-49','n'),(2015,5,'cycletest2','N5BIT0007','35-25-45-36-45-49-45','n'),(2015,5,'cycletest2','N5BIT0008','29-28-35-42-45-35-48','n'),(2015,5,'cycletest2','N5BIT0009','21-28-38-27-25-35-45','n'),(2015,5,'cycletest2','N5BIT0010','27-20-37-45-35-36-45','n'),(2015,5,'cycletest2','N5BIT0011','25-36-47-28-39-48-49','n'),(2015,5,'cycletest2','N5BIT0012','21-32-43-15-26-37-48','n'),(2015,5,'cycletest2','N5BIT0013','18-28-45-37-26-45-49','n'),(2015,5,'cycletest2','N5BIT0014','20-25-26-24-30-28-38','n'),(2015,5,'cycletest2','N5BIT0015','34-25-36-24-38-37-39','n'),(2015,5,'cycletest2','N5BIT0016','24-21-25-35-34-40-39','n'),(2015,5,'cycletest2','N5BIT0017','21-31-32-42-35-42-38','n'),(2015,5,'cycletest2','N5BIT0018','31-25-25-34-25-25-35','n'),(2015,5,'cycletest2','N5BIT0019','28-29-34-40-38-41-31','n'),(2015,5,'cycletest2','N5BIT0020','25-36-28-48-37-46-45','n'),(2015,5,'cycletest2','N5BIT0021','24-35-36-28-37-45-37','n'),(2015,5,'cycletest2','N5BIT0022','25-24-26-31-20-38-37','n'),(2015,5,'cycletest2','N5BIT0023','25-21-22-32-45-40-37','n'),(2015,5,'cycletest2','N5BIT0024','20-32-40-22-34-48-31','n'),(2015,5,'cycletest2','N5BIT0025','20-21-22-31-22-49-34','n'),(2015,5,'cycletest2','N5BIT0026','24-26-35-45-32-45-47','n'),(2015,5,'cycletest2','N5BIT0027','34-24-31-27-28-38-49','n'),(2015,5,'cycletest2','N5BIT0028','25-41-30-20-31-42-38','n'),(2015,5,'cycletest2','N5BIT0031','34-21-34-28-37-46-47','n'),(2015,5,'cycletest2','N5BIT0032','22-25-34-24-21-20-37','n'),(2015,5,'cycletest2','N5BIT0034','24-26-34-27-35-40-37','n'),(2015,5,'cycletest2','N5BIT0035','34-20-30-18-27-27-35','n'),(2015,5,'cycletest2','N5BIT0036','33-22-45-37-28-21-45','n'),(2015,5,'cycletest2','N5BIT0037','24-28-37-45-37-29-49','n'),(2015,5,'cycletest2','N5BIT0038','21-22-34-26-27-28-30','n'),(2015,5,'cycletest2','N5BIT0039','20-34-26-31-29-38-28','n'),(2015,5,'cycletest2','N5BIT0040','35-46-38-49-48-49-47','n'),(2015,5,'cycletest2','N5BIT0041','25-34-38-24-29-39-49','n'),(2015,5,'cycletest2','N5BIT0042','20-21-28-37-24-39-28','n'),(2015,5,'cycletest2','N5BIT0043','45-35-49-47-48-46-45','n'),(2015,5,'cycletest2','N5BIT0044','38-37-36-37-34-36-45','n'),(2015,5,'cycletest2','N5BIT0046','40-42-41-43-45-46-48','n'),(2015,5,'cycletest2','N5BIT0047','20-21-25-31-38-24-36','n'),(2015,5,'cycletest2','N5BIT0048','24-28-26-27-23-45-16','n'),(2015,5,'cycletest2','N5BIT0049','35-37-46-28-27-39-37','n'),(2015,5,'cycletest2','N5BIT0050','45-42-46-47-49-42-35','n'),(2015,5,'cycletest2','N5BIT0051','35-45-46-37-49-32-47','n'),(2015,5,'cycletest2','N5BIT0052','20-32-45-38-49-49-49','n'),(2015,5,'cycletest2','N5BIT0053','45-48-47-39-29-41-46','n'),(2015,5,'cycletest2','N5BIT0055','38-49-27-43-38-34-28','n'),(2015,5,'cycletest2','N5BIT0056','27-38-15-29-37-29-38','n'),(2015,5,'cycletest2','N5BIT0057','20-24-38-24-30-21-20','n'),(2015,5,'cycletest2','N5BIT0058','38-45-31-25-45-39-49','n'),(2015,5,'cycletest2','N5BIT0059','20-20-20-20-20-35-20','n'),(2015,5,'cycletest2','N5BIT0060','24-35-44-33-20-28-26','n'),(2015,5,'cycletest2','N5BIT0061','27-38-49-24-35-46-21','n'),(2015,5,'cycletest2','N5BIT0062','28-24-35-45-37-45-37','n'),(2015,5,'cycletest2','N5BIT0063','26-35-24-42-30-37-39','n'),(2015,5,'modelexam','N5BIT0001','50-64-34-35-35-35-35','n'),(2015,5,'modelexam','N5BIT0002','54-45-65-71-35-60-54','n'),(2015,5,'modelexam','N5BIT0003','45-62-67-68-61-25-64','n'),(2015,5,'modelexam','N5BIT0004','34-65-68-68-49-57-68','n'),(2015,5,'modelexam','N5BIT0005','62-65-52-61-63-68-70','n'),(2015,5,'modelexam','N5BIT0006','50-64-68-39-49-47-68','n'),(2015,5,'modelexam','N5BIT0007','69-67-49-57-38-49-57','n'),(2015,5,'modelexam','N5BIT0008','38-59-58-68-68-56-68','n'),(2015,5,'modelexam','N5BIT0009','48-68-58-38-20-68-60','n'),(2015,5,'modelexam','N5BIT0010','38-49-37-59-67-58-42','n'),(2015,5,'modelexam','N5BIT0011','61-51-72-57-56-68-69','n'),(2015,5,'modelexam','N5BIT0012','54-56-58-57-57-56-76','n'),(2015,5,'modelexam','N5BIT0013','68-68-68-65-46-38-35','n'),(2015,5,'modelexam','N5BIT0014','25-35-26-35-68-35-53','n'),(2015,5,'modelexam','N5BIT0015','15-35-54-68-65-65-55','n'),(2015,5,'modelexam','N5BIT0016','64-68-68-25-52-68-68','n'),(2015,5,'modelexam','N5BIT0017','58-65-49-38-48-38-50','n'),(2015,5,'modelexam','N5BIT0018','60-40-48-67-59-50-55','n'),(2015,5,'modelexam','N5BIT0019','41-42-45-48-45-47-30','n'),(2015,5,'modelexam','N5BIT0020','80-52-48-57-49-46-52','n'),(2015,5,'modelexam','N5BIT0021','51-64-68-53-52-57-59','n'),(2015,5,'modelexam','N5BIT0022','58-58-53-53-65-56-65','n'),(2015,5,'modelexam','N5BIT0023','35-29-58-46-30-52-62','n'),(2015,5,'modelexam','N5BIT0024','54-65-68-54-58-58-53','n'),(2015,5,'modelexam','N5BIT0025','67-48-68-28-40-58-69','n'),(2015,5,'modelexam','N5BIT0026','68-48-57-49-38-57-68','n'),(2015,5,'modelexam','N5BIT0027','48-57-69-57-68-49-52','n'),(2015,5,'modelexam','N5BIT0028','38-49-38-49-72-58-68','n'),(2015,5,'modelexam','N5BIT0031','48-57-68-58-52-68-25','n'),(2015,5,'modelexam','N5BIT0032','10-65-68-64-57-59-28','n'),(2015,5,'modelexam','N5BIT0034','25-51-68-20-52-58-35','n'),(2015,5,'modelexam','N5BIT0035','54-37-29-38-49-38-49','n'),(2015,5,'modelexam','N5BIT0036','52-61-43-48-68-57-59','n'),(2015,5,'modelexam','N5BIT0037','58-57-52-65-35-45-65','n'),(2015,5,'modelexam','N5BIT0038','59-57-58-51-52-65-35','n'),(2015,5,'modelexam','N5BIT0039','49-68-68-58-65-46-56','n'),(2015,5,'modelexam','N5BIT0040','43-58-58-38-58-67-68','n'),(2015,5,'modelexam','N5BIT0041','68-38-36-25-25-52-62','n'),(2015,5,'modelexam','N5BIT0042','56-56-56-35-38-29-68','n'),(2015,5,'modelexam','N5BIT0043','29-68-49-57-29-38-49','n'),(2015,5,'modelexam','N5BIT0044','38-59-57-56-62-68-62','n'),(2015,5,'modelexam','N5BIT0046','49-57-62-58-59-56-30','n'),(2015,5,'modelexam','N5BIT0047','38-56-45-68-57-59-74','n'),(2015,5,'modelexam','N5BIT0048','38-59-57-50-39-59-71','n'),(2015,5,'modelexam','N5BIT0049','62-53-43-29-42-46-48','n'),(2015,5,'modelexam','N5BIT0050','52-46-72-36-45-65-68','n'),(2015,5,'modelexam','N5BIT0051','35-49-68-56-58-56-46','n'),(2015,5,'modelexam','N5BIT0052','56-69-45-68-59-33-29','n'),(2015,5,'modelexam','N5BIT0053','12-35-49-65-69-59-68','n'),(2015,5,'modelexam','N5BIT0055','39-61-68-59-62-45-68','n'),(2015,5,'modelexam','N5BIT0056','59-58-58-68-49-48-68','n'),(2015,5,'modelexam','N5BIT0057','49-57-59-56-29-38-49','n'),(2015,5,'modelexam','N5BIT0058','68-49-59-49-71-69-66','n'),(2015,5,'modelexam','N5BIT0059','44-55-66-33-66-45-68','n'),(2015,5,'modelexam','N5BIT0060','22-35-58-68-49-68-68','n'),(2015,5,'modelexam','N5BIT0061','49-68-59-59-49-70-35','n'),(2015,5,'modelexam','N5BIT0062','30-49-68-65-68-68-68','n'),(2015,5,'modelexam','N5BIT0063','28-28-68-68-68-58-69','n'),(2015,5,'semexam','N5BIT0001','45-76-35-43-45-28-60','n'),(2015,5,'semexam','N5BIT0002','17-60-32-32-19-23-54','n'),(2015,5,'semexam','N5BIT0003','41-76-42-48-51-30-58','n'),(2015,5,'semexam','N5BIT0004','39-77-38-52-49-23-44','n'),(2015,5,'semexam','N5BIT0005','42-74-37-35-48-29-51','n'),(2015,5,'semexam','N5BIT0006','34-64-38-58-49-20-42','n'),(2015,5,'semexam','N5BIT0007','38-66-36-50-42-23-47','n'),(2015,5,'semexam','N5BIT0008','54-83-53-51-57-26-59','n'),(2015,5,'semexam','N5BIT0009','36-67-40-41-56-24-55','n'),(2015,5,'semexam','N5BIT0010','31-83-36-40-36-20-46','n'),(2015,5,'semexam','N5BIT0011','32-60-30-42-43-22-36','n'),(2015,5,'semexam','N5BIT0012','34-60-30-37-30-18-40','n'),(2015,5,'semexam','N5BIT0013','40-60-46-39-42-23-42','n'),(2015,5,'semexam','N5BIT0014','35-65-30-42-44-30-58','n'),(2015,5,'semexam','N5BIT0015','52-67-44-46-53-24-48','n'),(2015,5,'semexam','N5BIT0016','34-60-44-57-40-24-48','n'),(2015,5,'semexam','N5BIT0017','31-59-30-21-20-26-50','n'),(2015,5,'semexam','N5BIT0018','44-76-46-54-50-24-40','n'),(2015,5,'semexam','N5BIT0019','31-67-30-33-47-25-58','n'),(2015,5,'semexam','N5BIT0020','36-72-33-48-45-28-57','n'),(2015,5,'semexam','N5BIT0021','35-66-46-50-44-27-59','n'),(2015,5,'semexam','N5BIT0022','32-70-34-41-48-27-58','n'),(2015,5,'semexam','N5BIT0023','35-48-33-30-41-22-49','n'),(2015,5,'semexam','N5BIT0024','23-46-30-24-19-24-52','n'),(2015,5,'semexam','N5BIT0025','45-66-45-45-49-23-46','n'),(2015,5,'semexam','N5BIT0026','34-54-32-45-45-27-44','n'),(2015,5,'semexam','N5BIT0027','31-64-30-49-39-30-58','n'),(2015,5,'semexam','N5BIT0028','30-41-36-30-37-27-60','n'),(2015,5,'semexam','N5BIT0031','45-51-44-55-45-23-36','n'),(2015,5,'semexam','N5BIT0032','31-57-30-34-33-20-36','n'),(2015,5,'semexam','N5BIT0034','30-50-32-31-34-24-50','n'),(2015,5,'semexam','N5BIT0035','30-55-35-37-30-23-38','n'),(2015,5,'semexam','N5BIT0036','30-54-30-33-34-24-40','n'),(2015,5,'semexam','N5BIT0037','31-63-39-51-50-23-41','n'),(2015,5,'semexam','N5BIT0038','39-71-41-49-45-21-50','n'),(2015,5,'semexam','N5BIT0039','43-77-54-58-61-29-57','n'),(2015,5,'semexam','N5BIT0040','35-71-46-44-56-23-42','n'),(2015,5,'semexam','N5BIT0041','33-57-41-48-48-21-41','n'),(2015,5,'semexam','N5BIT0042','22-61-21-30-35-26-50','n'),(2015,5,'semexam','N5BIT0043','51-83-58-55-62-28-58','n'),(2015,5,'semexam','N5BIT0044','32-72-41-33-35-28-55','n'),(2015,5,'semexam','N5BIT0046','40-69-56-50-62-28-59','n'),(2015,5,'semexam','N5BIT0047','44-72-54-55-59-27-56','n'),(2015,5,'semexam','N5BIT0048','32-49-36-39-43-22-42','n'),(2015,5,'semexam','N5BIT0049','50-65-45-42-48-24-43','n'),(2015,5,'semexam','N5BIT0050','35-61-36-32-37-25-32','n'),(2015,5,'semexam','N5BIT0051','62-86-59-56-60-29-59','n'),(2015,5,'semexam','N5BIT0052','50-67-34-50-41-30-60','n'),(2015,5,'semexam','N5BIT0053','41-70-56-41-56-30-46','n'),(2015,5,'semexam','N5BIT0055','38-57-34-52-41-30-58','n'),(2015,5,'semexam','N5BIT0056','12-52-30-23-21-21-44','n'),(2015,5,'semexam','N5BIT0057','36-60-38-43-40-30-45','n'),(2015,5,'semexam','N5BIT0058','40-64-39-59-41-23-52','n'),(2015,5,'semexam','N5BIT0059','11-52-30-39-35-19-44','n'),(2015,5,'semexam','N5BIT0060','40-54-34-37-43-25-54','n'),(2015,5,'semexam','N5BIT0061','30-50-30-38-35-27-50','n'),(2015,5,'semexam','N5BIT0062','35-79-48-54-42-25-53','n'),(2015,5,'semexam','N5BIT0063','44-55-48-59-52-24-60','n'),(2015,5,'cycletest1','N5BIT0001','31-35-11-17-28-49-48','n'),(2015,5,'cycletest1','N5BIT0002','25-17-08-28-09-23-29','n'),(2015,5,'cycletest1','N5BIT0003','33-26-24-32-32-45-30','n'),(2015,5,'cycletest1','N5BIT0004','21-33-21-27-20-30-32','n'),(2015,5,'cycletest1','N5BIT0005','28-19-21-26-28-27-39','n'),(2015,5,'cycletest1','N5BIT0006','21-30-21-24-20-AB-21','n'),(2015,5,'cycletest1','N5BIT0007','28-22-14-26-23-AB-20','n'),(2015,5,'cycletest1','N5BIT0008','38-15-20-45-34-38-46','n'),(2015,5,'cycletest1','N5BIT0009','33-24-20-32-28-44-40','n'),(2015,5,'cycletest1','N5BIT0010','25-28-14-28-25-27-20','n'),(2015,5,'cycletest1','N5BIT0011','18-10-10-10-11-23-21','n'),(2015,5,'cycletest1','N5BIT0012','15-24-07-10-02-18-31','n'),(2015,5,'cycletest1','N5BIT0013','18-12-14-26-20-25-20','n'),(2015,5,'cycletest1','N5BIT0014','18-22-12-27-10-20-20','n'),(2015,5,'cycletest1','N5BIT0015','37-20-20-31-23-36-36','n'),(2015,5,'cycletest1','N5BIT0016','23-AB-13-26-13-23-20','n'),(2015,5,'cycletest1','N5BIT0017','22-16-10-20-12-25-32','n'),(2015,5,'cycletest1','N5BIT0018','27-17-20-28-27-29-20','n'),(2015,5,'cycletest1','N5BIT0019','27-09-07-20-23-31-38','n'),(2015,5,'cycletest1','N5BIT0020','25-21-20-30-22-37-21','n'),(2015,5,'cycletest1','N5BIT0021','36-26-20-30-24-45-28','n'),(2015,5,'cycletest1','N5BIT0022','29-19-12-20-31-37-38','n'),(2015,5,'cycletest1','N5BIT0023','20-16-11-20-20-30-20','n'),(2015,5,'cycletest1','N5BIT0024','24-14-12-08-10-12-20','n'),(2015,5,'cycletest1','N5BIT0025','38-22-23-28-27-35-20','n'),(2015,5,'cycletest1','N5BIT0026','28-21-20-24-22-30-38','n'),(2015,5,'cycletest1','N5BIT0027','28-21-09-21-26-34-44','n'),(2015,5,'cycletest1','N5BIT0028','27-AB-10-16-14-AB-36','n'),(2015,5,'cycletest1','N5BIT0031','21-18-14-31-22-32-20','n'),(2015,5,'cycletest1','N5BIT0032','15-14-08-15-11-25-20','n'),(2015,5,'cycletest1','N5BIT0034','23-13-12-12-15-24-25','n'),(2015,5,'cycletest1','N5BIT0035','18-17-15-20-12-15-20','n'),(2015,5,'cycletest1','N5BIT0036','20-15-15-19-16-AB-30','n'),(2015,5,'cycletest1','N5BIT0037','20-21-22-25-23-31-28','n'),(2015,5,'cycletest1','N5BIT0038','28-16-20-AB-24-32-38','n'),(2015,5,'cycletest1','N5BIT0039','39-22-23-29-40-37-46','n'),(2015,5,'cycletest1','N5BIT0040','29-20-20-38-23-30-26','n'),(2015,5,'cycletest1','N5BIT0041','20-14-13-AB-28-30-26','n'),(2015,5,'cycletest1','N5BIT0042','26-18-11-16-16-23-20','n'),(2015,5,'cycletest1','N5BIT0043','45-25-26-45-42-45-46','n'),(2015,5,'cycletest1','N5BIT0044','25-21-20-25-20-AB-44','n'),(2015,5,'cycletest1','N5BIT0046','40-25-35-40-32-47-48','n'),(2015,5,'cycletest1','N5BIT0047','21-12-25-31-38-37-42','n'),(2015,5,'cycletest1','N5BIT0048','18-17-12-15-20-AB-38','n'),(2015,5,'cycletest1','N5BIT0049','24-16-13-31-24-27-20','n'),(2015,5,'cycletest1','N5BIT0050','25-20-10-20-24-38-28','n'),(2015,5,'cycletest1','N5BIT0051','44-23-29-35-43-47-45','n'),(2015,5,'cycletest1','N5BIT0052','33-19-07-22-27-48-30','n'),(2015,5,'cycletest1','N5BIT0053','32-23-20-30-25-42-38','n'),(2015,5,'cycletest1','N5BIT0055','28-20-20-17-31-45-30','n'),(2015,5,'cycletest1','N5BIT0056','09-17-07-18-14-35-20','n'),(2015,5,'cycletest1','N5BIT0057','12-12-11-26-21-32-33','n'),(2015,5,'cycletest1','N5BIT0058','18-19-20-20-21-15-32','n'),(2015,5,'cycletest1','N5BIT0059','04-11-12-05-03-15-20','n'),(2015,5,'cycletest1','N5BIT0060','30-20-13-25-25-31-31','n'),(2015,5,'cycletest1','N5BIT0061','AB-AB-AB-AB-AB-AB-AB','n'),(2015,5,'cycletest1','N5BIT0062','27-18-20-31-22-30-42','n'),(2015,5,'cycletest1','N5BIT0063','36-19-12-25-24-38-35','n'),(2015,6,'cycletest1','N5BIT0001','25-22-07-12-25-AB','n'),(2015,6,'cycletest1','N5BIT0002','07-33-AB-AB-20-28','n'),(2015,6,'cycletest1','N5BIT0003','33-20-22-15-38-29','n'),(2015,6,'cycletest1','N5BIT0004','28-19-20-14-AB-26','n'),(2015,6,'cycletest1','N5BIT0005','AB-AB-18-15-26-22','n'),(2015,6,'cycletest1','N5BIT0006','21-13-14-16-20-AB','n'),(2015,6,'cycletest1','N5BIT0007','29-15-17-15-46-28','n'),(2015,6,'cycletest1','N5BIT0008','34-18-31-20-25-36','n'),(2015,6,'cycletest1','N5BIT0009','AB-17-20-23-38-38','n'),(2015,6,'cycletest1','N5BIT0010','24-20-22-14-38-22','n'),(2015,6,'cycletest1','N5BIT0011','11-AB-16-16-AB-26','n'),(2015,6,'cycletest1','N5BIT0012','10-08-04-06-20-01','n'),(2015,6,'cycletest1','N5BIT0013','AB-18-27-15-25-32','n'),(2015,6,'cycletest1','N5BIT0014','18-13-20-21-25-33','n'),(2015,6,'cycletest1','N5BIT0015','AB-21-31-20-36-27','n'),(2015,6,'cycletest1','N5BIT0016','28-AB-23-23-20-21','n'),(2015,6,'cycletest1','N5BIT0017','21-19-08-12-38-23','n'),(2015,6,'cycletest1','N5BIT0018','26-17-23-21-25-21','n'),(2015,6,'cycletest1','N5BIT0019','18-12-11-09-36-22','n'),(2015,6,'cycletest1','N5BIT0020','25-25-20-21-34-25','n'),(2015,6,'cycletest1','N5BIT0021','34-15-31-23-46-40','n'),(2015,6,'cycletest1','N5BIT0022','25-AB-14-10-36-27','n'),(2015,6,'cycletest1','N5BIT0023','10-13-12-20-23-AB','n'),(2015,6,'cycletest1','N5BIT0024','25-13-09-08-32-10','n'),(2015,6,'cycletest1','N5BIT0025','40-23-AB-AB-39-30','n'),(2015,6,'cycletest1','N5BIT0026','25-22-20-21-34-30','n'),(2015,6,'cycletest1','N5BIT0027','12-10-06-14-39-23','n'),(2015,6,'cycletest1','N5BIT0028','16-09-07-05-20-23','n'),(2015,6,'cycletest1','N5BIT0031','25-15-21-20-25-28','n'),(2015,6,'cycletest1','N5BIT0032','11-AB-04-08-20-20','n'),(2015,6,'cycletest1','N5BIT0034','16-23-07-15-46-29','n'),(2015,6,'cycletest1','N5BIT0035','22-18-13-16-32-28','n'),(2015,6,'cycletest1','N5BIT0036','15-08-13-05-25-AB','n'),(2015,6,'cycletest1','N5BIT0037','17-24-31-20-33-39','n'),(2015,6,'cycletest1','N5BIT0038','28-22-20-24-AB-41','n'),(2015,6,'cycletest1','N5BIT0039','27-18-29-24-38-40','n'),(2015,6,'cycletest1','N5BIT0040','20-13-23-24-33-30','n'),(2015,6,'cycletest1','N5BIT0041','14-AB-24-20-24-23','n'),(2015,6,'cycletest1','N5BIT0042','14-16-16-14-AB-AB','n'),(2015,6,'cycletest1','N5BIT0043','39-19-36-32-42-46','n'),(2015,6,'cycletest1','N5BIT0044','21-25-20-20-AB-32','n'),(2015,6,'cycletest1','N5BIT0046','28-22-39-36-38-42','n'),(2015,6,'cycletest1','N5BIT0047','29-15-27-31-25-39','n'),(2015,6,'cycletest1','N5BIT0048','24-27-14-20-34-23','n'),(2015,6,'cycletest1','N5BIT0049','28-17-15-20-20-29','n'),(2015,6,'cycletest1','N5BIT0050','20-18-07-10-25-26','n'),(2015,6,'cycletest1','N5BIT0051','38-27-41-39-46-40','n'),(2015,6,'cycletest1','N5BIT0052','20-16-11-14-44-33','n'),(2015,6,'cycletest1','N5BIT0053','07-18-05-08-33-44','n'),(2015,6,'cycletest1','N5BIT0055','14-17-16-20-48-34','n'),(2015,6,'cycletest1','N5BIT0056','10-08-10-08-21-25','n'),(2015,6,'cycletest1','N5BIT0057','17-24-14-16-22-27','n'),(2015,6,'cycletest1','N5BIT0058','AB-AB-AB-AB-25-26','n'),(2015,6,'cycletest1','N5BIT0059','07-14-06-04-20-AB','n'),(2015,6,'cycletest1','N5BIT0060','16-22-24-20-34-41','n'),(2015,6,'cycletest1','N5BIT0061','16-22-14-20-38-AB','n'),(2015,6,'cycletest1','N5BIT0062','31-14-23-26-26-30','n'),(2015,6,'cycletest1','N5BIT0063','23-20-29-27-46-27','n'),(2015,6,'cycletest2','N5BIT0001','06-08-29-10-24-46','n'),(2015,6,'cycletest2','N5BIT0002','11-12-13-11-20-40','n'),(2015,6,'cycletest2','N5BIT0003','33-22-21-22-36-29','n'),(2015,6,'cycletest2','N5BIT0004','25-20-13-20-21-24','n'),(2015,6,'cycletest2','N5BIT0005','21-17-15-09-26-20','n'),(2015,6,'cycletest2','N5BIT0006','20-21-20-15-24-26','n'),(2015,6,'cycletest2','N5BIT0007','27-10-21-15-39-30','n'),(2015,6,'cycletest2','N5BIT0008','29-20-22-22-26-48','n'),(2015,6,'cycletest2','N5BIT0009','27-17-26-15-26-38','n'),(2015,6,'cycletest2','N5BIT0010','24-16-22-27-24-32','n'),(2015,6,'cycletest2','N5BIT0011','20-15-17-15-26-29','n'),(2015,6,'cycletest2','N5BIT0012','08-10-21-04-21-20','n'),(2015,6,'cycletest2','N5BIT0013','24-30-15-25-26-32','n'),(2015,6,'cycletest2','N5BIT0014','18-16-18-11-26-26','n'),(2015,6,'cycletest2','N5BIT0015','29-25-25-22-28-30','n'),(2015,6,'cycletest2','N5BIT0016','32-24-AB-26-AB-24','n'),(2015,6,'cycletest2','N5BIT0017','21-10-24-20-27-23','n'),(2015,6,'cycletest2','N5BIT0018','29-26-24-29-25-24','n'),(2015,6,'cycletest2','N5BIT0019','18-15-17-06-28-24','n'),(2015,6,'cycletest2','N5BIT0020','24-15-14-22-34-43','n'),(2015,6,'cycletest2','N5BIT0021','25-22-21-32-42-48','n'),(2015,6,'cycletest2','N5BIT0022','24-07-25-14-40-27','n'),(2015,6,'cycletest2','N5BIT0023','17-21-20-20-38-24','n'),(2015,6,'cycletest2','N5BIT0024','14-08-16-10-24-20','n'),(2015,6,'cycletest2','N5BIT0025','27-22-26-30-36-29','n'),(2015,6,'cycletest2','N5BIT0026','05-13-13-12-28-32','n'),(2015,6,'cycletest2','N5BIT0027','05-06-17-08-28-33','n'),(2015,6,'cycletest2','N5BIT0028','08-04-11-08-26-32','n'),(2015,6,'cycletest2','N5BIT0031','22-13-15-AB-32-22','n'),(2015,6,'cycletest2','N5BIT0032','06-10-17-09-20-23','n'),(2015,6,'cycletest2','N5BIT0034','26-AB-21-15-42-29','n'),(2015,6,'cycletest2','N5BIT0035','08-15-28-20-21-26','n'),(2015,6,'cycletest2','N5BIT0036','04-AB-AB-03-23-20','n'),(2015,6,'cycletest2','N5BIT0037','23-23-23-26-26-AB','n'),(2015,6,'cycletest2','N5BIT0038','20-21-25-29-25-36','n'),(2015,6,'cycletest2','N5BIT0039','28-23-23-33-28-34','n'),(2015,6,'cycletest2','N5BIT0040','17-20-15-28-26-40','n'),(2015,6,'cycletest2','N5BIT0041','20-12-22-26-24-26','n'),(2015,6,'cycletest2','N5BIT0042','06-04-27-10-32-AB','n'),(2015,6,'cycletest2','N5BIT0043','33-37-31-43-38-45','n'),(2015,6,'cycletest2','N5BIT0044','16-23-20-15-26-35','n'),(2015,6,'cycletest2','N5BIT0046','AB-39-22-40-43-50','n'),(2015,6,'cycletest2','N5BIT0047','24-25-21-36-46-39','n'),(2015,6,'cycletest2','N5BIT0048','20-23-23-24-24-36','n'),(2015,6,'cycletest2','N5BIT0049','22-21-19-27-25-31','n'),(2015,6,'cycletest2','N5BIT0050','14-06-19-08-22-28','n'),(2015,6,'cycletest2','N5BIT0051','44-40-36-45-50-48','n'),(2015,6,'cycletest2','N5BIT0052','20-10-28-17-28-AB','n'),(2015,6,'cycletest2','N5BIT0053','21-07-24-14-26-29','n'),(2015,6,'cycletest2','N5BIT0055','21-20-16-23-26-26','n'),(2015,6,'cycletest2','N5BIT0056','09-12-12-11-23-15','n'),(2015,6,'cycletest2','N5BIT0057','16-06-18-12-25-35','n'),(2015,6,'cycletest2','N5BIT0058','14-27-19-26-28-20','n'),(2015,6,'cycletest2','N5BIT0059','05-15-15-08-20-20','n'),(2015,6,'cycletest2','N5BIT0060','20-22-25-30-23-AB','n'),(2015,6,'cycletest2','N5BIT0061','21-14-27-20-30-20','n'),(2015,6,'cycletest2','N5BIT0062','30-25-18-32-29-32','n'),(2015,6,'cycletest2','N5BIT0063','36-31-18-26-26-43','n');
/*!40000 ALTER TABLE `2015` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `2015assignment`
--

DROP TABLE IF EXISTS `2015assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2015assignment` (
  `Batch` int DEFAULT NULL,
  `sem` int DEFAULT NULL,
  `RegNo` varchar(10) DEFAULT NULL,
  `ass_mark` varchar(30) DEFAULT NULL,
  `decided` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `2015assignment`
--

LOCK TABLES `2015assignment` WRITE;
/*!40000 ALTER TABLE `2015assignment` DISABLE KEYS */;
INSERT INTO `2015assignment` VALUES (2015,5,'N5BIT0001','03-04-04-05-04','n'),(2015,5,'N5BIT0002','03-04-05-04-05','n'),(2015,5,'N5BIT0003','05-05-04-05-05','n'),(2015,5,'N5BIT0004','05-04-05-04-03','n'),(2015,5,'N5BIT0005','04-02-05-04-03','n'),(2015,5,'N5BIT0006','05-04-05-05-04','n'),(2015,5,'N5BIT0007','03-05-04-02-03','n'),(2015,5,'N5BIT0008','04-05-05-05-05','n'),(2015,5,'N5BIT0009','05-04-05-05-05','n'),(2015,5,'N5BIT0010','05-03-05-05-05','n'),(2015,5,'N5BIT0011','05-04-03-02-05','n'),(2015,5,'N5BIT0012','02-03-04-03-02','n'),(2015,5,'N5BIT0013','04-05-04-05-05','n'),(2015,5,'N5BIT0014','04-02-03-04-05','n'),(2015,5,'N5BIT0015','02-03-04-05-02','n'),(2015,5,'N5BIT0016','02-05-03-04-03','n'),(2015,5,'N5BIT0017','05-02-04-03-05','n'),(2015,5,'N5BIT0018','05-02-05-02-05','n'),(2015,5,'N5BIT0019','03-05-04-05-04','n'),(2015,5,'N5BIT0020','03-04-03-04-05','n'),(2015,5,'N5BIT0021','05-05-05-05-02','n'),(2015,5,'N5BIT0022','03-05-03-05-04','n'),(2015,5,'N5BIT0023','04-04-04-04-03','n'),(2015,5,'N5BIT0024','04-03-04-02-05','n'),(2015,5,'N5BIT0025','05-04-03-05-04','n'),(2015,5,'N5BIT0026','05-05-05-04-04','n'),(2015,5,'N5BIT0027','03-05-04-04-02','n'),(2015,5,'N5BIT0028','03-05-04-05-03','n'),(2015,5,'N5BIT0031','05-03-05-05-04','n'),(2015,5,'N5BIT0032','05-04-05-04-05','n'),(2015,5,'N5BIT0034','03-05-05-03-05','n'),(2015,5,'N5BIT0035','04-03-05-02-04','n'),(2015,5,'N5BIT0036','05-04-05-04-02','n'),(2015,5,'N5BIT0037','03-05-02-01-04','n'),(2015,5,'N5BIT0038','02-05-04-03-05','n'),(2015,5,'N5BIT0039','03-05-04-05-02','n'),(2015,5,'N5BIT0040','05-05-05-04-04','n'),(2015,5,'N5BIT0041','02-03-05-02-04','n'),(2015,5,'N5BIT0042','05-04-05-03-04','n'),(2015,5,'N5BIT0043','01-03-04-05-02','n'),(2015,5,'N5BIT0044','03-04-05-04-05','n'),(2015,5,'N5BIT0046','05-04-05-03-05','n'),(2015,5,'N5BIT0047','05-05-02-04-03','n'),(2015,5,'N5BIT0048','04-03-05-04-02','n'),(2015,5,'N5BIT0049','02-03-05-02-04','n'),(2015,5,'N5BIT0050','05-03-04-02-05','n'),(2015,5,'N5BIT0051','05-02-03-04-05','n'),(2015,5,'N5BIT0052','05-02-04-03-04','n'),(2015,5,'N5BIT0053','05-03-04-02-05','n'),(2015,5,'N5BIT0055','03-04-02-05-03','n'),(2015,5,'N5BIT0056','04-05-03-05-02','n'),(2015,5,'N5BIT0057','04-05-02-03-05','n'),(2015,5,'N5BIT0058','02-04-03-05-02','n'),(2015,5,'N5BIT0059','05-03-05-02-04','n'),(2015,5,'N5BIT0060','05-03-05-02-05','n'),(2015,5,'N5BIT0061','05-03-05-02-05','n'),(2015,5,'N5BIT0062','03-05-04-02-03','n'),(2015,5,'N5BIT0063','05-03-05-02-04','n');
/*!40000 ALTER TABLE `2015assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `2015assignmentquestion`
--

DROP TABLE IF EXISTS `2015assignmentquestion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2015assignmentquestion` (
  `Batch` int DEFAULT NULL,
  `Dept` varchar(20) DEFAULT NULL,
  `semester` int DEFAULT NULL,
  `Course` varchar(20) DEFAULT NULL,
  `topic` varchar(100) DEFAULT NULL,
  `question` varchar(100) DEFAULT NULL,
  `anumber` int NOT NULL,
  `sdate` date DEFAULT NULL,
  `ldate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `2015assignmentquestion`
--

LOCK TABLES `2015assignmentquestion` WRITE;
/*!40000 ALTER TABLE `2015assignmentquestion` DISABLE KEYS */;
INSERT INTO `2015assignmentquestion` VALUES (2015,'B.Sc(IT)',5,'N5BIT5T92','pgm','upload/BASE LOGIC.ppt',2,'2017-10-09','2017-10-09'),(2015,'B.Sc(IT)',5,'N5BIT5T25','basic development concepts','upload/BASE LOGIC.ppt',1,'2017-10-24','2017-10-28');
/*!40000 ALTER TABLE `2015assignmentquestion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `2015attendance`
--

DROP TABLE IF EXISTS `2015attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2015attendance` (
  `Batch` int DEFAULT NULL,
  `sem` int DEFAULT NULL,
  `RegNo` varchar(10) DEFAULT NULL,
  `tot_working_days` int DEFAULT NULL,
  `no_day_present` int DEFAULT NULL,
  `decided` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `2015attendance`
--

LOCK TABLES `2015attendance` WRITE;
/*!40000 ALTER TABLE `2015attendance` DISABLE KEYS */;
INSERT INTO `2015attendance` VALUES (2015,5,'N5BIT0001',101,92,'n'),(2015,5,'N5BIT0002',101,88,'n'),(2015,5,'N5BIT0003',101,75,'n'),(2015,5,'N5BIT0004',101,96,'n'),(2015,5,'N5BIT0005',101,87,'n'),(2015,5,'N5BIT0006',101,92,'n'),(2015,5,'N5BIT0007',101,86,'n'),(2015,5,'N5BIT0008',101,72,'n'),(2015,5,'N5BIT0009',101,94,'n'),(2015,5,'N5BIT0010',101,88,'n'),(2015,5,'N5BIT0011',101,75,'n'),(2015,5,'N5BIT0012',101,86,'n'),(2015,5,'N5BIT0013',101,100,'n'),(2015,5,'N5BIT0014',101,94,'n'),(2015,5,'N5BIT0015',101,88,'n'),(2015,5,'N5BIT0016',101,78,'n'),(2015,5,'N5BIT0017',101,99,'n'),(2015,5,'N5BIT0018',101,78,'n'),(2015,5,'N5BIT0019',101,99,'n'),(2015,5,'N5BIT0020',101,87,'n'),(2015,5,'N5BIT0021',101,86,'n'),(2015,5,'N5BIT0022',101,97,'n'),(2015,5,'N5BIT0023',101,100,'n'),(2015,5,'N5BIT0024',101,97,'n'),(2015,5,'N5BIT0025',101,97,'n'),(2015,5,'N5BIT0026',101,101,'n'),(2015,5,'N5BIT0027',101,100,'n'),(2015,5,'N5BIT0028',101,89,'n'),(2015,5,'N5BIT0031',101,78,'n'),(2015,5,'N5BIT0032',101,98,'n'),(2015,5,'N5BIT0034',101,87,'n'),(2015,5,'N5BIT0035',101,86,'n'),(2015,5,'N5BIT0036',101,75,'n'),(2015,5,'N5BIT0037',101,72,'n'),(2015,5,'N5BIT0038',101,71,'n'),(2015,5,'N5BIT0039',101,87,'n'),(2015,5,'N5BIT0040',101,101,'n'),(2015,5,'N5BIT0041',101,98,'n'),(2015,5,'N5BIT0042',101,97,'n'),(2015,5,'N5BIT0043',101,87,'n'),(2015,5,'N5BIT0044',101,97,'n'),(2015,5,'N5BIT0046',101,86,'n'),(2015,5,'N5BIT0047',101,82,'n'),(2015,5,'N5BIT0048',101,84,'n'),(2015,5,'N5BIT0049',101,82,'n'),(2015,5,'N5BIT0050',101,95,'n'),(2015,5,'N5BIT0051',101,99,'n'),(2015,5,'N5BIT0052',101,101,'n'),(2015,5,'N5BIT0053',101,101,'n'),(2015,5,'N5BIT0055',101,73,'n'),(2015,5,'N5BIT0056',101,88,'n'),(2015,5,'N5BIT0057',101,84,'n'),(2015,5,'N5BIT0058',101,75,'n'),(2015,5,'N5BIT0059',101,95,'n'),(2015,5,'N5BIT0060',101,85,'n'),(2015,5,'N5BIT0061',101,96,'n'),(2015,5,'N5BIT0062',101,85,'n'),(2015,5,'N5BIT0063',101,101,'n');
/*!40000 ALTER TABLE `2015attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `2015lab`
--

DROP TABLE IF EXISTS `2015lab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2015lab` (
  `Batch` int DEFAULT NULL,
  `sem` int DEFAULT NULL,
  `Type` varchar(15) DEFAULT NULL,
  `RegNo` varchar(10) DEFAULT NULL,
  `mark` varchar(30) DEFAULT NULL,
  `decided` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `2015lab`
--

LOCK TABLES `2015lab` WRITE;
/*!40000 ALTER TABLE `2015lab` DISABLE KEYS */;
INSERT INTO `2015lab` VALUES (2015,5,'Record','N5BIT0001','45-60','n'),(2015,5,'Record','N5BIT0002','12-30','n'),(2015,5,'Record','N5BIT0003','10-35','n'),(2015,5,'Record','N5BIT0004','35-44','n'),(2015,5,'Record','N5BIT0005','56-65','n'),(2015,5,'Record','N5BIT0006','34-51','n'),(2015,5,'Record','N5BIT0007','32-48','n'),(2015,5,'Record','N5BIT0008','49-57','n'),(2015,5,'Record','N5BIT0009','34-56','n'),(2015,5,'Record','N5BIT0010','34-47','n'),(2015,5,'Record','N5BIT0011','27-39','n'),(2015,5,'Record','N5BIT0012','67-43','n'),(2015,5,'Record','N5BIT0013','49-48','n'),(2015,5,'Record','N5BIT0014','47-46','n'),(2015,5,'Record','N5BIT0015','60-38','n'),(2015,5,'Record','N5BIT0016','39-34','n'),(2015,5,'Record','N5BIT0017','58-29','n'),(2015,5,'Record','N5BIT0018','37-38','n'),(2015,5,'Record','N5BIT0019','34-38','n'),(2015,5,'Record','N5BIT0020','49-57','n'),(2015,5,'Record','N5BIT0021','65-37','n'),(2015,5,'Record','N5BIT0022','00-00','n'),(2015,5,'Record','N5BIT0023','00-00','n'),(2015,5,'Record','N5BIT0024','00-00','n'),(2015,5,'Record','N5BIT0025','00-00','n'),(2015,5,'Record','N5BIT0026','00-00','n'),(2015,5,'Record','N5BIT0027','00-00','n'),(2015,5,'Record','N5BIT0028','00-00','n'),(2015,5,'Record','N5BIT0031','00-00','n'),(2015,5,'Record','N5BIT0032','00-00','n'),(2015,5,'Record','N5BIT0034','00-00','n'),(2015,5,'Record','N5BIT0035','00-00','n'),(2015,5,'Record','N5BIT0036','00-00','n'),(2015,5,'Record','N5BIT0037','00-00','n'),(2015,5,'Record','N5BIT0038','00-00','n'),(2015,5,'Record','N5BIT0039','00-00','n'),(2015,5,'Record','N5BIT0040','00-00','n'),(2015,5,'Record','N5BIT0041','00-00','n'),(2015,5,'Record','N5BIT0042','00-00','n'),(2015,5,'Record','N5BIT0043','00-00','n'),(2015,5,'Record','N5BIT0044','00-00','n'),(2015,5,'Record','N5BIT0046','00-00','n'),(2015,5,'Record','N5BIT0047','00-00','n'),(2015,5,'Record','N5BIT0048','00-00','n'),(2015,5,'Record','N5BIT0049','00-00','n'),(2015,5,'Record','N5BIT0050','00-00','n'),(2015,5,'Record','N5BIT0051','00-00','n'),(2015,5,'Record','N5BIT0052','00-00','n'),(2015,5,'Record','N5BIT0053','00-00','n'),(2015,5,'Record','N5BIT0055','00-00','n'),(2015,5,'Record','N5BIT0056','00-00','n'),(2015,5,'Record','N5BIT0057','00-00','n'),(2015,5,'Record','N5BIT0058','00-00','n'),(2015,5,'Record','N5BIT0059','00-00','n'),(2015,5,'Record','N5BIT0060','00-00','n'),(2015,5,'Record','N5BIT0061','00-00','n'),(2015,5,'Record','N5BIT0062','00-00','n'),(2015,5,'Record','N5BIT0063','00-00','n'),(2015,5,'Lab Performance','N5BIT0001','32-24','n'),(2015,5,'Lab Performance','N5BIT0002','35-39','n'),(2015,5,'Lab Performance','N5BIT0003','37-34','n'),(2015,5,'Lab Performance','N5BIT0004','39-31','n'),(2015,5,'Lab Performance','N5BIT0005','32-34','n'),(2015,5,'Lab Performance','N5BIT0006','37-33','n'),(2015,5,'Lab Performance','N5BIT0007','36-34','n'),(2015,5,'Lab Performance','N5BIT0008','35-35','n'),(2015,5,'Lab Performance','N5BIT0009','34-37','n'),(2015,5,'Lab Performance','N5BIT0010','30-45','n'),(2015,5,'Lab Performance','N5BIT0011','34-06','n'),(2015,5,'Lab Performance','N5BIT0012','35-31','n'),(2015,5,'Lab Performance','N5BIT0013','20-15','n'),(2015,5,'Lab Performance','N5BIT0014','00-00','n'),(2015,5,'Lab Performance','N5BIT0015','00-00','n'),(2015,5,'Lab Performance','N5BIT0016','00-00','n'),(2015,5,'Lab Performance','N5BIT0017','00-00','n'),(2015,5,'Lab Performance','N5BIT0018','00-00','n'),(2015,5,'Lab Performance','N5BIT0019','00-00','n'),(2015,5,'Lab Performance','N5BIT0020','00-00','n'),(2015,5,'Lab Performance','N5BIT0021','00-00','n'),(2015,5,'Lab Performance','N5BIT0022','00-00','n'),(2015,5,'Lab Performance','N5BIT0023','00-00','n'),(2015,5,'Lab Performance','N5BIT0024','00-00','n'),(2015,5,'Lab Performance','N5BIT0025','00-00','n'),(2015,5,'Lab Performance','N5BIT0026','00-00','n'),(2015,5,'Lab Performance','N5BIT0027','00-00','n'),(2015,5,'Lab Performance','N5BIT0028','00-00','n'),(2015,5,'Lab Performance','N5BIT0031','00-00','n'),(2015,5,'Lab Performance','N5BIT0032','00-00','n'),(2015,5,'Lab Performance','N5BIT0034','00-00','n'),(2015,5,'Lab Performance','N5BIT0035','00-00','n'),(2015,5,'Lab Performance','N5BIT0036','00-00','n'),(2015,5,'Lab Performance','N5BIT0037','00-00','n'),(2015,5,'Lab Performance','N5BIT0038','00-00','n'),(2015,5,'Lab Performance','N5BIT0039','00-00','n'),(2015,5,'Lab Performance','N5BIT0040','00-00','n'),(2015,5,'Lab Performance','N5BIT0041','00-00','n'),(2015,5,'Lab Performance','N5BIT0042','00-00','n'),(2015,5,'Lab Performance','N5BIT0043','00-00','n'),(2015,5,'Lab Performance','N5BIT0044','00-00','n'),(2015,5,'Lab Performance','N5BIT0046','00-00','n'),(2015,5,'Lab Performance','N5BIT0047','00-00','n'),(2015,5,'Lab Performance','N5BIT0048','00-00','n'),(2015,5,'Lab Performance','N5BIT0049','00-00','n'),(2015,5,'Lab Performance','N5BIT0050','00-00','n'),(2015,5,'Lab Performance','N5BIT0051','00-00','n'),(2015,5,'Lab Performance','N5BIT0052','00-00','n'),(2015,5,'Lab Performance','N5BIT0053','00-00','n'),(2015,5,'Lab Performance','N5BIT0055','00-00','n'),(2015,5,'Lab Performance','N5BIT0056','00-00','n'),(2015,5,'Lab Performance','N5BIT0057','00-00','n'),(2015,5,'Lab Performance','N5BIT0058','00-00','n'),(2015,5,'Lab Performance','N5BIT0059','00-00','n'),(2015,5,'Lab Performance','N5BIT0060','00-00','n'),(2015,5,'Lab Performance','N5BIT0061','00-00','n'),(2015,5,'Lab Performance','N5BIT0062','00-00','n'),(2015,5,'Lab Performance','N5BIT0063','00-00','n');
/*!40000 ALTER TABLE `2015lab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `2015onemarkquestion`
--

DROP TABLE IF EXISTS `2015onemarkquestion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2015onemarkquestion` (
  `Batch` int DEFAULT NULL,
  `Department` varchar(20) DEFAULT NULL,
  `semester` int DEFAULT NULL,
  `courseID` varchar(30) DEFAULT NULL,
  `exam_type` varchar(20) DEFAULT NULL,
  `level` varchar(10) DEFAULT NULL,
  `question` varchar(100) DEFAULT NULL,
  `opta` varchar(20) DEFAULT NULL,
  `optb` varchar(20) DEFAULT NULL,
  `optc` varchar(20) DEFAULT NULL,
  `optd` varchar(20) DEFAULT NULL,
  `answer` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `2015onemarkquestion`
--

LOCK TABLES `2015onemarkquestion` WRITE;
/*!40000 ALTER TABLE `2015onemarkquestion` DISABLE KEYS */;
INSERT INTO `2015onemarkquestion` VALUES (2015,'B.Sc(IT)',5,'N5BIT5T25','cycletest1','remember','PHP stands for','Hypertext preprocess','Powerful Hypertext P','People Hypertext pre','None of these','a'),(2015,'B.Sc(IT)',5,'N5BIT5T25','cycletest1','understand','The filesize() function returns the  file size in','Bites','Bytes','Kilobytes','Gigabutes','b');
/*!40000 ALTER TABLE `2015onemarkquestion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `2015studassignmentmark`
--

DROP TABLE IF EXISTS `2015studassignmentmark`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2015studassignmentmark` (
  `Regno` varchar(20) DEFAULT NULL,
  `Batch` int DEFAULT NULL,
  `Dept` varchar(20) DEFAULT NULL,
  `semester` int DEFAULT NULL,
  `Course` varchar(20) DEFAULT NULL,
  `number` int DEFAULT NULL,
  `mark` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `2015studassignmentmark`
--

LOCK TABLES `2015studassignmentmark` WRITE;
/*!40000 ALTER TABLE `2015studassignmentmark` DISABLE KEYS */;
INSERT INTO `2015studassignmentmark` VALUES ('N5BIT0001',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0002',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0003',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0004',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0005',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0006',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0007',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0008',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0009',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0010',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0011',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0012',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0013',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0014',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0015',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0016',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0017',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0018',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0019',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0020',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0021',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0022',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0023',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0024',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0025',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0026',2015,'B.Sc(IT)',5,'N5BIT5T25',1,2),('N5BIT0027',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0028',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0031',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0032',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0034',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0035',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0036',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0037',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0038',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0039',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0040',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0041',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0042',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0043',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0044',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0046',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0047',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0048',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0049',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0050',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0051',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0052',2015,'B.Sc(IT)',5,'N5BIT5T25',1,4),('N5BIT0053',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0055',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0056',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0057',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0058',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0059',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0060',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0061',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0062',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0063',2015,'B.Sc(IT)',5,'N5BIT5T25',1,0),('N5BIT0001',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0002',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0003',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0004',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0005',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0006',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0007',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0008',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0009',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0010',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0011',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0012',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0013',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0014',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0015',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0016',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0017',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0018',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0019',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0020',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0021',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0022',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0023',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0024',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0025',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0026',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0027',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0028',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0031',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0032',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0034',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0035',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0036',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0037',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0038',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0039',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0040',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0041',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0042',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0043',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0044',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0046',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0047',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0048',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0049',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0050',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0051',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0052',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0053',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0055',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0056',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0057',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0058',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0059',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0060',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0061',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0062',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0063',2015,'B.Sc(IT)',5,'N5BIT5T92',2,0),('N5BIT0001',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0002',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0003',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0004',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0005',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0006',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0007',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0008',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0009',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0010',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0011',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0012',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0013',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0014',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0015',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0016',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0017',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0018',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0019',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0020',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0021',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0022',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0023',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0024',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0025',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0026',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0027',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0028',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0031',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0032',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0034',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0035',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0036',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0037',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0038',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0039',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0040',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0041',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0042',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0043',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0044',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0046',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0047',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0048',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0049',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0050',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0051',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0052',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0053',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0055',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0056',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0057',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0058',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0059',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0060',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0061',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0062',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0),('N5BIT0063',2015,'B.Sc(IT)',5,'N5BIT5T25',5,0);
/*!40000 ALTER TABLE `2015studassignmentmark` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `2015studassignmentreport`
--

DROP TABLE IF EXISTS `2015studassignmentreport`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2015studassignmentreport` (
  `Regno` varchar(20) DEFAULT NULL,
  `Batch` int DEFAULT NULL,
  `Dept` varchar(20) DEFAULT NULL,
  `semester` int DEFAULT NULL,
  `Course` varchar(20) DEFAULT NULL,
  `number` varchar(10) DEFAULT NULL,
  `assignment` varchar(100) DEFAULT NULL,
  `sdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `2015studassignmentreport`
--

LOCK TABLES `2015studassignmentreport` WRITE;
/*!40000 ALTER TABLE `2015studassignmentreport` DISABLE KEYS */;
INSERT INTO `2015studassignmentreport` VALUES ('N5BIT0052',2015,'B.Sc(IT)',5,'N5BIT5T92','2','assignment/BASE LOGIC.ppt','2017-10-25'),('N5BIT0052',2015,'B.Sc(IT)',5,'N5BIT5T25','1','assignment/BASE LOGIC.ppt','2017-10-25'),('N5BIT0012',2015,'B.Sc(IT)',5,'N5BIT5T25','1','assignment/CRT GEN.ppt','2017-10-27'),('N5BIT0026',2015,'B.Sc(IT)',5,'N5BIT5T25','1','assignment/c1.2comp org.PPT','2017-11-13');
/*!40000 ALTER TABLE `2015studassignmentreport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `2015yearattendance`
--

DROP TABLE IF EXISTS `2015yearattendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2015yearattendance` (
  `Batch` int NOT NULL,
  `Course` varchar(20) NOT NULL,
  `semester` int NOT NULL,
  `Date` date NOT NULL,
  `Ihour` blob NOT NULL,
  `IIhour` blob NOT NULL,
  `IIIhour` blob NOT NULL,
  `IVhour` blob NOT NULL,
  `Vhour` blob NOT NULL,
  `VIhour` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `2015yearattendance`
--

LOCK TABLES `2015yearattendance` WRITE;
/*!40000 ALTER TABLE `2015yearattendance` DISABLE KEYS */;
INSERT INTO `2015yearattendance` VALUES (2015,'B.Sc(IT)',1,'2018-01-25',_binary 'N5BIT0001-N5BIT0003',_binary 'N5BIT0001-N5BIT0003',_binary 'N5BIT0003',_binary 'N5BIT0006',_binary 'N5BIT0006',_binary 'N5BIT0006'),(2015,'B.Sc(IT)',5,'2017-09-01',_binary 'N5BIT0006-N5BIT0012-N5BIT0052-N5BIT0056',_binary 'N5BIT0006-N5BIT0012-N5BIT0052-N5BIT0056',_binary 'N5BIT0006-N5BIT0012-N5BIT0052-N5BIT0056',_binary 'N5BIT0006-N5BIT0012-N5BIT0052-N5BIT0056',_binary 'N5BIT0006-N5BIT0012-N5BIT0052-N5BIT0056',_binary 'N5BIT0006-N5BIT0012-N5BIT0052-N5BIT0056'),(2015,'B.Sc(IT)',5,'2017-08-31',_binary 'N5BIT0001-N5BIT0006-N5BIT0035-N5BIT0063','',_binary 'N5BIT0001-N5BIT0006',_binary 'N5BIT0035','',''),(2015,'B.Sc(IT)',5,'2017-08-30',_binary 'N5BIT0001','','','','',''),(2015,'B.Sc(IT)',5,'2017-09-05',_binary 'N5BIT0002-N5BIT0023-N5BIT0028-N5BIT0035-N5BIT0041-N5BIT0061',_binary 'N5BIT0002-N5BIT0023-N5BIT0028-N5BIT0035-N5BIT0041-N5BIT0061',_binary 'N5BIT0002-N5BIT0023-N5BIT0028-N5BIT0035-N5BIT0041-N5BIT0061',_binary 'N5BIT0002-N5BIT0023-N5BIT0028-N5BIT0035-N5BIT0041-N5BIT0061',_binary 'N5BIT0002-N5BIT0023-N5BIT0028-N5BIT0035-N5BIT0041-N5BIT0061',_binary 'N5BIT0002-N5BIT0023-N5BIT0028-N5BIT0035-N5BIT0041-N5BIT0061'),(2015,'B.Sc(IT)',5,'2017-09-06',_binary 'N5BIT0002-N5BIT0019-N5BIT0023-N5BIT0024-N5BIT0032-N5BIT0036-N5BIT0041-N5BIT0057-N5BIT0058',_binary 'N5BIT0002-N5BIT0019-N5BIT0023-N5BIT0024-N5BIT0032-N5BIT0036-N5BIT0041-N5BIT0057-N5BIT0058',_binary 'N5BIT0002-N5BIT0019-N5BIT0023-N5BIT0024-N5BIT0032-N5BIT0036-N5BIT0041-N5BIT0057-N5BIT0058',_binary 'N5BIT0020-N5BIT0023-N5BIT0041-N5BIT0058',_binary 'N5BIT0020-N5BIT0023-N5BIT0041-N5BIT0058',_binary 'N5BIT0020-N5BIT0023-N5BIT0041-N5BIT0058'),(2015,'B.Sc(IT)',5,'2017-09-07',_binary 'N5BIT0019-N5BIT0023-N5BIT0044',_binary 'N5BIT0019-N5BIT0023-N5BIT0044',_binary 'N5BIT0019-N5BIT0023-N5BIT0044',_binary 'N5BIT0023-N5BIT0044',_binary 'N5BIT0023-N5BIT0044',_binary 'N5BIT0023-N5BIT0044'),(2015,'B.Sc(IT)',5,'2017-09-08',_binary 'N5BIT0023-N5BIT0027-N5BIT0037-N5BIT0049',_binary 'N5BIT0023-N5BIT0027-N5BIT0037-N5BIT0049',_binary 'N5BIT0023-N5BIT0027-N5BIT0037-N5BIT0049',_binary 'N5BIT0023-N5BIT0027-N5BIT0037-N5BIT0049',_binary 'N5BIT0023-N5BIT0027-N5BIT0037-N5BIT0049',_binary 'N5BIT0023-N5BIT0027-N5BIT0037-N5BIT0049'),(2015,'B.Sc(IT)',5,'2017-09-09',_binary 'N5BIT0002-N5BIT0005-N5BIT0008-N5BIT0017-N5BIT0023-N5BIT0037',_binary 'N5BIT0005-N5BIT0008-N5BIT0017-N5BIT0023-N5BIT0037',_binary 'N5BIT0008-N5BIT0023-N5BIT0037',_binary 'N5BIT0001-N5BIT0008-N5BIT0023-N5BIT0037',_binary 'N5BIT0008-N5BIT0023-N5BIT0037',_binary 'N5BIT0008-N5BIT0023-N5BIT0037'),(2015,'B.Sc(IT)',5,'2017-09-11',_binary 'N5BIT0059','','','','',''),(2015,'B.Sc(IT)',5,'2017-09-12',_binary 'N5BIT0001-N5BIT0019-N5BIT0027-N5BIT0032-N5BIT0035-N5BIT0048-N5BIT0056-N5BIT0057-N5BIT0059',_binary 'N5BIT0001-N5BIT0019-N5BIT0027-N5BIT0032-N5BIT0035-N5BIT0048-N5BIT0056-N5BIT0057-N5BIT0059',_binary 'N5BIT0001-N5BIT0027-N5BIT0048',_binary 'N5BIT0001-N5BIT0027-N5BIT0048',_binary 'N5BIT0001-N5BIT0027-N5BIT0048',_binary 'N5BIT0001-N5BIT0027-N5BIT0048'),(2015,'B.Sc(IT)',5,'2017-09-13','','','',_binary 'N5BIT0026',_binary 'N5BIT0026',_binary 'N5BIT0017-N5BIT0024-N5BIT0026'),(2015,'B.Sc(IT)',5,'2017-09-14',_binary 'N5BIT0024-N5BIT0026-N5BIT0028-N5BIT0032-N5BIT0034-N5BIT0036-N5BIT0042',_binary 'N5BIT0024-N5BIT0026-N5BIT0028-N5BIT0032-N5BIT0034-N5BIT0036-N5BIT0042',_binary 'N5BIT0026',_binary 'N5BIT0026',_binary 'N5BIT0026-N5BIT0034',_binary 'N5BIT0026'),(2015,'B.Sc(IT)',5,'2017-09-15',_binary 'N5BIT0026-N5BIT0036-N5BIT0059',_binary 'N5BIT0026-N5BIT0036-N5BIT0059',_binary 'N5BIT0026-N5BIT0036-N5BIT0059',_binary 'N5BIT0026-N5BIT0036-N5BIT0059',_binary 'N5BIT0026-N5BIT0036-N5BIT0059',_binary 'N5BIT0026-N5BIT0036-N5BIT0059'),(2015,'B.Sc(IT)',5,'2017-09-18',_binary 'N5BIT0002-N5BIT0018-N5BIT0026-N5BIT0028-N5BIT0036-N5BIT0042',_binary 'N5BIT0002-N5BIT0017-N5BIT0018-N5BIT0024-N5BIT0026-N5BIT0036-N5BIT0042-N5BIT0057',_binary 'N5BIT0002-N5BIT0018-N5BIT0026-N5BIT0036-N5BIT0042',_binary 'N5BIT0002-N5BIT0006-N5BIT0018-N5BIT0019-N5BIT0024-N5BIT0032-N5BIT0034-N5BIT0036-N5BIT0042',_binary 'N5BIT0002-N5BIT0006-N5BIT0018-N5BIT0019-N5BIT0024-N5BIT0032-N5BIT0034-N5BIT0036-N5BIT0042',_binary 'N5BIT0002-N5BIT0006-N5BIT0018-N5BIT0019-N5BIT0024-N5BIT0032-N5BIT0034-N5BIT0036-N5BIT0042'),(2015,'B.Sc(IT)',5,'2017-09-19',_binary 'N5BIT0006-N5BIT0011-N5BIT0012-N5BIT0036',_binary 'N5BIT0006-N5BIT0011-N5BIT0012-N5BIT0036',_binary 'N5BIT0006-N5BIT0011-N5BIT0012-N5BIT0036',_binary 'N5BIT0006-N5BIT0011-N5BIT0012-N5BIT0036',_binary 'N5BIT0006-N5BIT0011-N5BIT0012-N5BIT0036',_binary 'N5BIT0006-N5BIT0011-N5BIT0012'),(2015,'B.Sc(IT)',5,'2017-10-03',_binary 'N5BIT0024-N5BIT0028-N5BIT0032-N5BIT0036-N5BIT0042-N5BIT0049',_binary 'N5BIT0024-N5BIT0028-N5BIT0032-N5BIT0036-N5BIT0042-N5BIT0049',_binary 'N5BIT0024-N5BIT0028-N5BIT0032-N5BIT0036-N5BIT0042-N5BIT0049',_binary 'N5BIT0028-N5BIT0032-N5BIT0036-N5BIT0042-N5BIT0049',_binary 'N5BIT0028-N5BIT0032-N5BIT0036-N5BIT0042-N5BIT0049',_binary 'N5BIT0028-N5BIT0032-N5BIT0036-N5BIT0042-N5BIT0049'),(2015,'B.Sc(IT)',5,'2017-09-20',_binary 'N5BIT0016-N5BIT0025-N5BIT0031-N5BIT0049-N5BIT0053',_binary 'N5BIT0016-N5BIT0025-N5BIT0031-N5BIT0049-N5BIT0053',_binary 'N5BIT0016-N5BIT0025-N5BIT0031-N5BIT0049-N5BIT0053',_binary 'N5BIT0016-N5BIT0025-N5BIT0031-N5BIT0049-N5BIT0053',_binary 'N5BIT0016-N5BIT0025-N5BIT0031-N5BIT0049-N5BIT0053',_binary 'N5BIT0016-N5BIT0025-N5BIT0031-N5BIT0049-N5BIT0053'),(2015,'B.Sc(IT)',5,'2017-09-21',_binary 'N5BIT0031',_binary 'N5BIT0031',_binary 'N5BIT0031',_binary 'N5BIT0031-N5BIT0036-N5BIT0061',_binary 'N5BIT0031-N5BIT0036-N5BIT0061',_binary 'N5BIT0031-N5BIT0036-N5BIT0061'),(2015,'B.Sc(IT)',5,'2017-09-22','','','','','',''),(2015,'B.Sc(IT)',5,'2017-09-23',_binary 'N5BIT0025-N5BIT0044',_binary 'N5BIT0025-N5BIT0044',_binary 'N5BIT0025-N5BIT0044',_binary 'N5BIT0025-N5BIT0044-N5BIT0060',_binary 'N5BIT0025-N5BIT0044-N5BIT0060',_binary 'N5BIT0025-N5BIT0044-N5BIT0060'),(2015,'B.Sc(IT)',5,'2017-09-25',_binary 'N5BIT0009',_binary 'N5BIT0009',_binary 'N5BIT0009',_binary 'N5BIT0009',_binary 'N5BIT0009',_binary 'N5BIT0009'),(2015,'B.Sc(IT)',5,'2017-10-26','','','','','',''),(2015,'B.Sc(IT)',5,'2017-09-27','','','',_binary 'N5BIT0025',_binary 'N5BIT0025',_binary 'N5BIT0025'),(2015,'B.Sc(IT)',5,'2017-09-28',_binary 'N5BIT0028',_binary 'N5BIT0028',_binary 'N5BIT0028',_binary 'N5BIT0024-N5BIT0028-N5BIT0035',_binary 'N5BIT0024-N5BIT0028-N5BIT0035',_binary 'N5BIT0024-N5BIT0028-N5BIT0035'),(2015,'B.Sc(IT)',5,'2017-10-23',_binary 'N5BIT0038',_binary 'N5BIT0038',_binary 'N5BIT0038',_binary 'N5BIT0038',_binary 'N5BIT0038',_binary 'N5BIT0038'),(2015,'B.Sc(IT)',5,'2017-10-21','','','','','',''),(2015,'B.Sc(IT)',5,'2017-10-20',_binary 'N5BIT0004-N5BIT0006-N5BIT0007-N5BIT0008-N5BIT0009-N5BIT0011-N5BIT0012-N5BIT0013-N5BIT0015-N5BIT0016-N5BIT0018-N5BIT0025-N5BIT0028-N5BIT0031-N5BIT0038-N5BIT0042-N5BIT0049-N5BIT0058-N5BIT0063',_binary 'N5BIT0004-N5BIT0006-N5BIT0007-N5BIT0008-N5BIT0009-N5BIT0011-N5BIT0012-N5BIT0013-N5BIT0015-N5BIT0016-N5BIT0018-N5BIT0025-N5BIT0028-N5BIT0031-N5BIT0038-N5BIT0042-N5BIT0049-N5BIT0058-N5BIT0063',_binary 'N5BIT0004-N5BIT0006-N5BIT0007-N5BIT0008-N5BIT0009-N5BIT0011-N5BIT0012-N5BIT0013-N5BIT0015-N5BIT0016-N5BIT0018-N5BIT0025-N5BIT0028-N5BIT0031-N5BIT0038-N5BIT0042-N5BIT0049-N5BIT0058-N5BIT0063',_binary 'N5BIT0004-N5BIT0006-N5BIT0007-N5BIT0008-N5BIT0009-N5BIT0011-N5BIT0012-N5BIT0013-N5BIT0015-N5BIT0016-N5BIT0018-N5BIT0025-N5BIT0028-N5BIT0031-N5BIT0036-N5BIT0038-N5BIT0042-N5BIT0049-N5BIT0058-N5BIT0063',_binary 'N5BIT0004-N5BIT0006-N5BIT0007-N5BIT0008-N5BIT0009-N5BIT0011-N5BIT0012-N5BIT0013-N5BIT0014-N5BIT0015-N5BIT0016-N5BIT0018-N5BIT0025-N5BIT0028-N5BIT0031-N5BIT0036-N5BIT0038-N5BIT0042-N5BIT0049-N5BIT0058-N5BIT0063',_binary 'N5BIT0004-N5BIT0006-N5BIT0007-N5BIT0008-N5BIT0009-N5BIT0011-N5BIT0012-N5BIT0013-N5BIT0015-N5BIT0016-N5BIT0018-N5BIT0025-N5BIT0028-N5BIT0031-N5BIT0036-N5BIT0038-N5BIT0042-N5BIT0049-N5BIT0058-N5BIT0063'),(2015,'B.Sc(IT)',1,'2017-10-17',_binary 'N5BIT0009-N5BIT0013-N5BIT0015-N5BIT0016-N5BIT0018-N5BIT0019-N5BIT0021-N5BIT0022-N5BIT0024-N5BIT0027-N5BIT0028-N5BIT0036-N5BIT0038-N5BIT0039-N5BIT0042-N5BIT0044-N5BIT0046-N5BIT0048-N5BIT0049-N5BIT0052-N5BIT0053-N5BIT0055-N5BIT0056-N5BIT0058-N5BIT0059-N5BIT0062',_binary 'N5BIT0009-N5BIT0013-N5BIT0015-N5BIT0016-N5BIT0018-N5BIT0019-N5BIT0021-N5BIT0022-N5BIT0024-N5BIT0027-N5BIT0028-N5BIT0036-N5BIT0038-N5BIT0039-N5BIT0042-N5BIT0044-N5BIT0046-N5BIT0048-N5BIT0049-N5BIT0052-N5BIT0053-N5BIT0055-N5BIT0056-N5BIT0058-N5BIT0059-N5BIT0062',_binary 'N5BIT0009-N5BIT0013-N5BIT0015-N5BIT0016-N5BIT0018-N5BIT0019-N5BIT0021-N5BIT0022-N5BIT0024-N5BIT0027-N5BIT0028-N5BIT0036-N5BIT0038-N5BIT0039-N5BIT0042-N5BIT0044-N5BIT0046-N5BIT0048-N5BIT0049-N5BIT0052-N5BIT0053-N5BIT0055-N5BIT0056-N5BIT0058-N5BIT0059-N5BIT0062',_binary 'N5BIT0009-N5BIT0013-N5BIT0015-N5BIT0016-N5BIT0018-N5BIT0019-N5BIT0021-N5BIT0022-N5BIT0024-N5BIT0027-N5BIT0028-N5BIT0036-N5BIT0038-N5BIT0039-N5BIT0042-N5BIT0044-N5BIT0046-N5BIT0048-N5BIT0049-N5BIT0052-N5BIT0053-N5BIT0055-N5BIT0056-N5BIT0058-N5BIT0059-N5BIT0062',_binary 'N5BIT0009-N5BIT0013-N5BIT0015-N5BIT0016-N5BIT0018-N5BIT0019-N5BIT0021-N5BIT0022-N5BIT0024-N5BIT0027-N5BIT0028-N5BIT0036-N5BIT0038-N5BIT0039-N5BIT0042-N5BIT0044-N5BIT0046-N5BIT0048-N5BIT0049-N5BIT0052-N5BIT0053-N5BIT0055-N5BIT0056-N5BIT0058-N5BIT0059-N5BIT0062',_binary 'N5BIT0009-N5BIT0013-N5BIT0015-N5BIT0016-N5BIT0018-N5BIT0019-N5BIT0021-N5BIT0022-N5BIT0024-N5BIT0027-N5BIT0028-N5BIT0036-N5BIT0038-N5BIT0039-N5BIT0042-N5BIT0044-N5BIT0046-N5BIT0048-N5BIT0049-N5BIT0052-N5BIT0053-N5BIT0055-N5BIT0056-N5BIT0058-N5BIT0059-N5BIT0062'),(2015,'B.Sc(IT)',5,'2017-10-16',_binary 'N5BIT0006-N5BIT0012-N5BIT0023-N5BIT0024-N5BIT0058-N5BIT0059',_binary 'N5BIT0006-N5BIT0012-N5BIT0023-N5BIT0024-N5BIT0058-N5BIT0059',_binary 'N5BIT0006-N5BIT0012-N5BIT0023-N5BIT0058-N5BIT0059',_binary 'N5BIT0006-N5BIT0012-N5BIT0023-N5BIT0058-N5BIT0059',_binary 'N5BIT0006-N5BIT0012-N5BIT0023-N5BIT0058-N5BIT0059',_binary 'N5BIT0006-N5BIT0012-N5BIT0023-N5BIT0058-N5BIT0059'),(2015,'B.Sc(IT)',5,'2017-10-14',_binary 'N5BIT0032-N5BIT0042-N5BIT0051',_binary 'N5BIT0032-N5BIT0042-N5BIT0051',_binary 'N5BIT0032-N5BIT0042-N5BIT0051',_binary 'N5BIT0032-N5BIT0042-N5BIT0051',_binary 'N5BIT0032-N5BIT0042-N5BIT0051',_binary 'N5BIT0032-N5BIT0042-N5BIT0051'),(2015,'B.Sc(IT)',5,'2017-10-13',_binary 'N5BIT0023-N5BIT0024-N5BIT0058',_binary 'N5BIT0023-N5BIT0024-N5BIT0058',_binary 'N5BIT0023-N5BIT0024-N5BIT0058',_binary 'N5BIT0023-N5BIT0024-N5BIT0058',_binary 'N5BIT0023-N5BIT0024-N5BIT0058',_binary 'N5BIT0023-N5BIT0024-N5BIT0058'),(2015,'B.Sc(IT)',5,'2017-10-12',_binary 'N5BIT0002-N5BIT0012-N5BIT0023-N5BIT0024-N5BIT0025',_binary 'N5BIT0002-N5BIT0012-N5BIT0023-N5BIT0024-N5BIT0025',_binary 'N5BIT0002-N5BIT0012-N5BIT0023-N5BIT0024-N5BIT0025',_binary 'N5BIT0002-N5BIT0012-N5BIT0023-N5BIT0024-N5BIT0025',_binary 'N5BIT0002-N5BIT0012-N5BIT0023-N5BIT0024-N5BIT0025',_binary 'N5BIT0002-N5BIT0012-N5BIT0023-N5BIT0024-N5BIT0025'),(2015,'B.Sc(IT)',5,'2017-10-11',_binary 'N5BIT0042-N5BIT0052-N5BIT0057',_binary 'N5BIT0042-N5BIT0052-N5BIT0057',_binary 'N5BIT0042-N5BIT0052-N5BIT0057',_binary 'N5BIT0042-N5BIT0052-N5BIT0057',_binary 'N5BIT0042-N5BIT0052-N5BIT0057',_binary 'N5BIT0042-N5BIT0052-N5BIT0057'),(2015,'B.Sc(IT)',5,'2017-10-10',_binary 'N5BIT0028-N5BIT0057',_binary 'N5BIT0028-N5BIT0057',_binary 'N5BIT0028-N5BIT0057',_binary 'N5BIT0028-N5BIT0032-N5BIT0057',_binary 'N5BIT0028-N5BIT0032-N5BIT0057',_binary 'N5BIT0028-N5BIT0032-N5BIT0057'),(2015,'B.Sc(IT)',5,'2017-10-09',_binary 'N5BIT0006-N5BIT0051-N5BIT0057',_binary 'N5BIT0006-N5BIT0051-N5BIT0057',_binary 'N5BIT0006-N5BIT0051-N5BIT0057',_binary 'N5BIT0006-N5BIT0051-N5BIT0057',_binary 'N5BIT0006-N5BIT0051-N5BIT0057',_binary 'N5BIT0006-N5BIT0051-N5BIT0057'),(2015,'B.Sc(IT)',5,'2017-10-07',_binary 'N5BIT0002-N5BIT0003-N5BIT0004-N5BIT0005-N5BIT0007-N5BIT0008-N5BIT0013-N5BIT0014-N5BIT0017-N5BIT0019-N5BIT0020-N5BIT0022-N5BIT0023-N5BIT0024-N5BIT0032-N5BIT0043-N5BIT0050-N5BIT0057',_binary 'N5BIT0002-N5BIT0003-N5BIT0004-N5BIT0005-N5BIT0007-N5BIT0008-N5BIT0013-N5BIT0014-N5BIT0017-N5BIT0019-N5BIT0020-N5BIT0022-N5BIT0023-N5BIT0024-N5BIT0032-N5BIT0043-N5BIT0050-N5BIT0057',_binary 'N5BIT0002-N5BIT0003-N5BIT0004-N5BIT0005-N5BIT0007-N5BIT0008-N5BIT0013-N5BIT0014-N5BIT0017-N5BIT0019-N5BIT0020-N5BIT0022-N5BIT0023-N5BIT0024-N5BIT0032-N5BIT0043-N5BIT0050-N5BIT0057',_binary 'N5BIT0002-N5BIT0003-N5BIT0004-N5BIT0005-N5BIT0007-N5BIT0008-N5BIT0013-N5BIT0014-N5BIT0017-N5BIT0019-N5BIT0020-N5BIT0022-N5BIT0023-N5BIT0024-N5BIT0032-N5BIT0043-N5BIT0050-N5BIT0057',_binary 'N5BIT0002-N5BIT0003-N5BIT0004-N5BIT0005-N5BIT0007-N5BIT0008-N5BIT0013-N5BIT0014-N5BIT0017-N5BIT0019-N5BIT0020-N5BIT0022-N5BIT0023-N5BIT0024-N5BIT0032-N5BIT0043-N5BIT0050-N5BIT0057',_binary 'N5BIT0002-N5BIT0003-N5BIT0004-N5BIT0005-N5BIT0007-N5BIT0008-N5BIT0013-N5BIT0014-N5BIT0017-N5BIT0019-N5BIT0020-N5BIT0022-N5BIT0023-N5BIT0024-N5BIT0032-N5BIT0043-N5BIT0050-N5BIT0057'),(2015,'B.Sc(IT)',5,'2017-10-06','','','','','',''),(2015,'B.Sc(IT)',5,'2017-10-05','','','','','',''),(2015,'B.Sc(IT)',5,'2017-10-04',_binary 'N5BIT0011',_binary 'N5BIT0011',_binary 'N5BIT0011',_binary 'N5BIT0011',_binary 'N5BIT0011',_binary 'N5BIT0011'),(2015,'B.Sc(IT)',5,'2017-10-17',_binary 'N5BIT0009-N5BIT0013-N5BIT0015-N5BIT0016-N5BIT0018-N5BIT0019',_binary 'N5BIT0009-N5BIT0013-N5BIT0015-N5BIT0016-N5BIT0018-N5BIT0019',_binary 'N5BIT0009-N5BIT0013-N5BIT0015-N5BIT0016-N5BIT0018-N5BIT0019',_binary 'N5BIT0009-N5BIT0013-N5BIT0015-N5BIT0016-N5BIT0018-N5BIT0019',_binary 'N5BIT0009-N5BIT0013-N5BIT0015-N5BIT0016-N5BIT0018-N5BIT0019',_binary 'N5BIT0009-N5BIT0013-N5BIT0015-N5BIT0016-N5BIT0018-N5BIT0019'),(2015,'B.Sc(IT)',6,'2017-12-04',_binary 'N5BIT0002-N5BIT0010-N5BIT0012-N5BIT0017-N5BIT0024-N5BIT0028-N5BIT0032-N5BIT0036-N5BIT0042-N5BIT0047-N5BIT0051-N5BIT0059',_binary 'N5BIT0012-N5BIT0017-N5BIT0024-N5BIT0028-N5BIT0032-N5BIT0036-N5BIT0042-N5BIT0059',_binary 'N5BIT0001-N5BIT0012-N5BIT0044',_binary 'N5BIT0012',_binary 'N5BIT0005-N5BIT0007-N5BIT0012-N5BIT0022-N5BIT0057',_binary 'N5BIT0012'),(2015,'B.Sc(IT)',6,'2017-12-05',_binary 'N5BIT0001-N5BIT0002-N5BIT0005-N5BIT0019-N5BIT0024-N5BIT0026-N5BIT0027-N5BIT0028-N5BIT0032-N5BIT0034-N5BIT0035-N5BIT0036-N5BIT0042-N5BIT0044-N5BIT0050-N5BIT0053-N5BIT0055-N5BIT0058-N5BIT0059',_binary 'N5BIT0024-N5BIT0027-N5BIT0042-N5BIT0061',_binary 'N5BIT0001-N5BIT0002-N5BIT0003-N5BIT0005-N5BIT0012-N5BIT0014-N5BIT0019-N5BIT0020-N5BIT0024-N5BIT0026-N5BIT0027-N5BIT0028-N5BIT0032-N5BIT0034-N5BIT0036-N5BIT0037-N5BIT0041-N5BIT0042-N5BIT0044-N5BIT0050-N5BIT0055-N5BIT0057-N5BIT0058-N5BIT0061',_binary 'N5BIT0002-N5BIT0012-N5BIT0014-N5BIT0017-N5BIT0019-N5BIT0024-N5BIT0026-N5BIT0027-N5BIT0028-N5BIT0032-N5BIT0036-N5BIT0042-N5BIT0059-N5BIT0061',_binary 'N5BIT0001-N5BIT0002-N5BIT0012-N5BIT0014-N5BIT0019-N5BIT0024-N5BIT0026-N5BIT0027-N5BIT0028-N5BIT0032-N5BIT0037-N5BIT0041-N5BIT0050-N5BIT0055',_binary 'N5BIT0001-N5BIT0002-N5BIT0027'),(2015,'B.Sc(IT)',6,'2017-12-06',_binary 'N5BIT0032',_binary 'N5BIT0032',_binary 'N5BIT0032',_binary 'N5BIT0001-N5BIT0002-N5BIT0012-N5BIT0019-N5BIT0024-N5BIT0026-N5BIT0028-N5BIT0032-N5BIT0050-N5BIT0055',_binary 'N5BIT0014-N5BIT0019-N5BIT0027-N5BIT0032',_binary 'N5BIT0032'),(2015,'B.Sc(IT)',6,'2017-12-07',_binary 'N5BIT0011-N5BIT0018-N5BIT0019-N5BIT0032-N5BIT0037-N5BIT0042',_binary 'N5BIT0032',_binary 'N5BIT0019-N5BIT0032',_binary 'N5BIT0002-N5BIT0005-N5BIT0017-N5BIT0024-N5BIT0028-N5BIT0032-N5BIT0034-N5BIT0036-N5BIT0055-N5BIT0061',_binary 'N5BIT0002-N5BIT0005-N5BIT0017-N5BIT0024-N5BIT0028-N5BIT0032-N5BIT0034-N5BIT0036-N5BIT0055-N5BIT0061',_binary 'N5BIT0032'),(2015,'B.Sc(IT)',6,'2017-12-08',_binary 'N5BIT0002','',_binary 'N5BIT0009-N5BIT0011-N5BIT0013-N5BIT0015-N5BIT0018-N5BIT0036-N5BIT0059','','',''),(2015,'B.Sc(IT)',6,'2017-12-09',_binary 'N5BIT0003-N5BIT0005-N5BIT0022-N5BIT0028-N5BIT0036-N5BIT0057',_binary 'N5BIT0003-N5BIT0005-N5BIT0022-N5BIT0028-N5BIT0036-N5BIT0057',_binary 'N5BIT0003-N5BIT0005-N5BIT0022-N5BIT0028-N5BIT0036-N5BIT0057',_binary 'N5BIT0003-N5BIT0005-N5BIT0022-N5BIT0028-N5BIT0036-N5BIT0057',_binary 'N5BIT0003-N5BIT0005-N5BIT0022-N5BIT0028-N5BIT0036-N5BIT0057',_binary 'N5BIT0003-N5BIT0005-N5BIT0022-N5BIT0028-N5BIT0036-N5BIT0057'),(2015,'B.Sc(IT)',6,'2017-12-11',_binary 'N5BIT0003-N5BIT0016-N5BIT0019-N5BIT0057',_binary 'N5BIT0003-N5BIT0005-N5BIT0016-N5BIT0019-N5BIT0032',_binary 'N5BIT0016-N5BIT0019',_binary 'N5BIT0016-N5BIT0019',_binary 'N5BIT0016-N5BIT0019',_binary 'N5BIT0001-N5BIT0002-N5BIT0003-N5BIT0004-N5BIT0005-N5BIT0006-N5BIT0008-N5BIT0009-N5BIT0010-N5BIT0011-N5BIT0012-N5BIT0013-N5BIT0015-N5BIT0016-N5BIT0017-N5BIT0018-N5BIT0019-N5BIT0020-N5BIT0021-N5BIT0022-N5BIT0023-N5BIT0024-N5BIT0025-N5BIT0027-N5BIT0028-N5BIT0031-N5BIT0032-N5BIT0034-N5BIT0035-N5BIT0036-N5BIT0037-N5BIT0038-N5BIT0039-N5BIT0040-N5BIT0041-N5BIT0042-N5BIT0043-N5BIT0044-N5BIT0047-N5BIT0048-N5BIT0049-N5BIT0050-N5BIT0051-N5BIT0052-N5BIT0053-N5BIT0055-N5BIT0056-N5BIT0057-N5BIT0058-N5BIT0059-N5BIT0060-N5BIT0061-N5BIT0062'),(2015,'B.Sc(IT)',5,'2017-12-12',_binary 'N5BIT0011-N5BIT0016-N5BIT0019-N5BIT0024-N5BIT0028-N5BIT0047-N5BIT0049-N5BIT0056',_binary 'N5BIT0011-N5BIT0016-N5BIT0019-N5BIT0024-N5BIT0028-N5BIT0047-N5BIT0049-N5BIT0056',_binary 'N5BIT0011-N5BIT0016-N5BIT0019-N5BIT0028-N5BIT0047-N5BIT0049-N5BIT0056',_binary 'N5BIT0002-N5BIT0005-N5BIT0007-N5BIT0010-N5BIT0011-N5BIT0016-N5BIT0019-N5BIT0021-N5BIT0028-N5BIT0034-N5BIT0035-N5BIT0036-N5BIT0047-N5BIT0049-N5BIT0056-N5BIT0058-N5BIT0059-N5BIT0061',_binary 'N5BIT0011-N5BIT0016-N5BIT0019-N5BIT0028-N5BIT0047-N5BIT0049-N5BIT0056',_binary 'N5BIT0011-N5BIT0016-N5BIT0019-N5BIT0028-N5BIT0047-N5BIT0049-N5BIT0056'),(2015,'B.Sc(IT)',6,'2017-12-13',_binary 'N5BIT0037',_binary 'N5BIT0037',_binary 'N5BIT0037',_binary 'N5BIT0037',_binary 'N5BIT0037',_binary 'N5BIT0037'),(2015,'B.Sc(IT)',6,'2017-12-14',_binary 'N5BIT0027-N5BIT0052',_binary 'N5BIT0027-N5BIT0052',_binary 'N5BIT0027-N5BIT0052',_binary 'N5BIT0027-N5BIT0052',_binary 'N5BIT0027-N5BIT0052',_binary 'N5BIT0027-N5BIT0052'),(2015,'B.Sc(IT)',6,'2017-12-15',_binary 'N5BIT0019-N5BIT0024-N5BIT0036-N5BIT0042-N5BIT0053',_binary 'N5BIT0036-N5BIT0042-N5BIT0053',_binary 'N5BIT0036-N5BIT0042-N5BIT0053',_binary 'N5BIT0036-N5BIT0042-N5BIT0053',_binary 'N5BIT0036-N5BIT0042-N5BIT0053',_binary 'N5BIT0036-N5BIT0042-N5BIT0053'),(2015,'B.Sc(IT)',6,'2017-12-18',_binary 'N5BIT0007-N5BIT0018-N5BIT0019-N5BIT0044',_binary 'N5BIT0007-N5BIT0018-N5BIT0019-N5BIT0044',_binary 'N5BIT0007-N5BIT0018-N5BIT0019-N5BIT0044',_binary 'N5BIT0001-N5BIT0002-N5BIT0007-N5BIT0017-N5BIT0018-N5BIT0024-N5BIT0036-N5BIT0044-N5BIT0055-N5BIT0057-N5BIT0060',_binary 'N5BIT0001-N5BIT0002-N5BIT0007-N5BIT0017-N5BIT0018-N5BIT0024-N5BIT0036-N5BIT0044-N5BIT0055-N5BIT0057-N5BIT0060',_binary 'N5BIT0007-N5BIT0018-N5BIT0044'),(2015,'B.Sc(IT)',6,'2017-12-19',_binary 'N5BIT0006-N5BIT0007-N5BIT0031-N5BIT0034-N5BIT0042-N5BIT0044-N5BIT0058-N5BIT0061',_binary 'N5BIT0006-N5BIT0007-N5BIT0031-N5BIT0034-N5BIT0042-N5BIT0044-N5BIT0058-N5BIT0061',_binary 'N5BIT0006-N5BIT0007-N5BIT0031-N5BIT0034-N5BIT0042-N5BIT0044-N5BIT0058-N5BIT0061',_binary 'N5BIT0006-N5BIT0007-N5BIT0031-N5BIT0034-N5BIT0042-N5BIT0044-N5BIT0058-N5BIT0061',_binary 'N5BIT0006-N5BIT0007-N5BIT0031-N5BIT0034-N5BIT0042-N5BIT0044-N5BIT0058-N5BIT0061',_binary 'N5BIT0001-N5BIT0002-N5BIT0006-N5BIT0007-N5BIT0012-N5BIT0019-N5BIT0024-N5BIT0028-N5BIT0031-N5BIT0032-N5BIT0034-N5BIT0036-N5BIT0042-N5BIT0044-N5BIT0050-N5BIT0056-N5BIT0057-N5BIT0058-N5BIT0061'),(2015,'B.Sc(IT)',6,'2017-12-20',_binary 'N5BIT0003-N5BIT0005-N5BIT0006-N5BIT0011-N5BIT0017-N5BIT0019-N5BIT0044-N5BIT0055-N5BIT0058',_binary 'N5BIT0003-N5BIT0005-N5BIT0006-N5BIT0011-N5BIT0017-N5BIT0019-N5BIT0044-N5BIT0055-N5BIT0058',_binary 'N5BIT0001-N5BIT0002-N5BIT0003-N5BIT0005-N5BIT0006-N5BIT0008-N5BIT0009-N5BIT0010-N5BIT0011-N5BIT0012-N5BIT0013-N5BIT0014-N5BIT0015-N5BIT0016-N5BIT0017-N5BIT0019-N5BIT0020-N5BIT0021-N5BIT0022-N5BIT0023-N5BIT0024-N5BIT0026-N5BIT0027-N5BIT0028-N5BIT0032-N5BIT0036-N5BIT0039-N5BIT0044-N5BIT0050-N5BIT0052-N5BIT0053-N5BIT0055-N5BIT0056-N5BIT0057-N5BIT0059-N5BIT0060',_binary 'N5BIT0006-N5BIT0011-N5BIT0019-N5BIT0044-N5BIT0055',_binary 'N5BIT0006-N5BIT0011-N5BIT0019-N5BIT0044-N5BIT0055',_binary 'N5BIT0006-N5BIT0011-N5BIT0019-N5BIT0044-N5BIT0055'),(2015,'B.Sc(IT)',6,'2017-12-21',_binary 'N5BIT0003-N5BIT0006-N5BIT0012-N5BIT0022-N5BIT0051-N5BIT0055',_binary 'N5BIT0003-N5BIT0006-N5BIT0012-N5BIT0022-N5BIT0051-N5BIT0055',_binary 'N5BIT0003-N5BIT0006-N5BIT0012-N5BIT0022-N5BIT0051-N5BIT0055',_binary 'N5BIT0003-N5BIT0006-N5BIT0012-N5BIT0022-N5BIT0051-N5BIT0055',_binary 'N5BIT0003-N5BIT0006-N5BIT0012-N5BIT0022-N5BIT0051-N5BIT0055',_binary 'N5BIT0003-N5BIT0006-N5BIT0012-N5BIT0022-N5BIT0051-N5BIT0055'),(2015,'B.Sc(IT)',6,'2017-12-22',_binary 'N5BIT0004-N5BIT0028-N5BIT0051-N5BIT0055-N5BIT0059',_binary 'N5BIT0004-N5BIT0028-N5BIT0051-N5BIT0055-N5BIT0059',_binary 'N5BIT0004-N5BIT0028-N5BIT0051-N5BIT0055-N5BIT0059',_binary 'N5BIT0004-N5BIT0028-N5BIT0051-N5BIT0055-N5BIT0059',_binary 'N5BIT0004-N5BIT0028-N5BIT0051-N5BIT0055-N5BIT0059',_binary 'N5BIT0004-N5BIT0028-N5BIT0051-N5BIT0055-N5BIT0059'),(2015,'B.Sc(IT)',6,'2017-12-23',_binary 'N5BIT0001-N5BIT0002-N5BIT0004-N5BIT0008-N5BIT0010-N5BIT0014-N5BIT0016-N5BIT0019-N5BIT0025-N5BIT0027-N5BIT0028-N5BIT0032-N5BIT0037-N5BIT0038-N5BIT0039-N5BIT0041-N5BIT0043-N5BIT0049-N5BIT0052-N5BIT0055-N5BIT0059-N5BIT0061',_binary 'N5BIT0001-N5BIT0004-N5BIT0008-N5BIT0014-N5BIT0016-N5BIT0025-N5BIT0028-N5BIT0043-N5BIT0049-N5BIT0052-N5BIT0055-N5BIT0059',_binary 'N5BIT0001-N5BIT0004-N5BIT0008-N5BIT0014-N5BIT0016-N5BIT0025-N5BIT0028-N5BIT0043-N5BIT0049-N5BIT0052-N5BIT0055-N5BIT0059',_binary 'N5BIT0001-N5BIT0004-N5BIT0008-N5BIT0014-N5BIT0016-N5BIT0025-N5BIT0028-N5BIT0043-N5BIT0049-N5BIT0052-N5BIT0055-N5BIT0059',_binary 'N5BIT0001-N5BIT0004-N5BIT0008-N5BIT0014-N5BIT0016-N5BIT0019-N5BIT0025-N5BIT0028-N5BIT0043-N5BIT0049-N5BIT0052-N5BIT0055-N5BIT0059',_binary 'N5BIT0001-N5BIT0004-N5BIT0008-N5BIT0014-N5BIT0016-N5BIT0025-N5BIT0028-N5BIT0043-N5BIT0049-N5BIT0052-N5BIT0055-N5BIT0059'),(2015,'B.Sc(IT)',6,'2017-12-26',_binary 'N5BIT0008-N5BIT0019-N5BIT0036-N5BIT0040-N5BIT0048-N5BIT0055-N5BIT0062',_binary 'N5BIT0008-N5BIT0019-N5BIT0036-N5BIT0040-N5BIT0048-N5BIT0055-N5BIT0062',_binary 'N5BIT0008-N5BIT0019-N5BIT0036-N5BIT0040-N5BIT0048-N5BIT0055-N5BIT0062',_binary 'N5BIT0008-N5BIT0019-N5BIT0036-N5BIT0037-N5BIT0040-N5BIT0048-N5BIT0055-N5BIT0062',_binary 'N5BIT0008-N5BIT0019-N5BIT0036-N5BIT0037-N5BIT0040-N5BIT0048-N5BIT0055-N5BIT0062',_binary 'N5BIT0008-N5BIT0019-N5BIT0036-N5BIT0037-N5BIT0040-N5BIT0048-N5BIT0055-N5BIT0058-N5BIT0062'),(2015,'B.Sc(IT)',6,'2017-12-27',_binary 'N5BIT0002-N5BIT0003-N5BIT0004-N5BIT0005-N5BIT0008-N5BIT0011-N5BIT0017-N5BIT0019-N5BIT0028-N5BIT0031-N5BIT0032-N5BIT0034-N5BIT0035-N5BIT0038-N5BIT0040-N5BIT0041-N5BIT0042-N5BIT0043-N5BIT0047-N5BIT0055-N5BIT0056-N5BIT0057-N5BIT0059-N5BIT0061',_binary 'N5BIT0003-N5BIT0004-N5BIT0005-N5BIT0008-N5BIT0028-N5BIT0032-N5BIT0035-N5BIT0038-N5BIT0040-N5BIT0043-N5BIT0055-N5BIT0056-N5BIT0057-N5BIT0059-N5BIT0061',_binary 'N5BIT0003-N5BIT0004-N5BIT0005-N5BIT0008-N5BIT0028-N5BIT0032-N5BIT0035-N5BIT0038-N5BIT0040-N5BIT0043-N5BIT0055-N5BIT0056-N5BIT0057-N5BIT0059-N5BIT0061',_binary 'N5BIT0003-N5BIT0004-N5BIT0005-N5BIT0007-N5BIT0008-N5BIT0012-N5BIT0017-N5BIT0020-N5BIT0028-N5BIT0032-N5BIT0035-N5BIT0038-N5BIT0039-N5BIT0040-N5BIT0043-N5BIT0047-N5BIT0050-N5BIT0055-N5BIT0056-N5BIT0057-N5BIT0059-N5BIT0060-N5BIT0061-N5BIT0063',_binary 'N5BIT0003-N5BIT0004-N5BIT0005-N5BIT0007-N5BIT0008-N5BIT0012-N5BIT0020-N5BIT0028-N5BIT0032-N5BIT0035-N5BIT0038-N5BIT0039-N5BIT0040-N5BIT0043-N5BIT0050-N5BIT0055-N5BIT0056-N5BIT0057-N5BIT0059-N5BIT0060-N5BIT0061-N5BIT0063',_binary 'N5BIT0003-N5BIT0004-N5BIT0005-N5BIT0007-N5BIT0008-N5BIT0012-N5BIT0020-N5BIT0028-N5BIT0032-N5BIT0035-N5BIT0038-N5BIT0039-N5BIT0040-N5BIT0043-N5BIT0050-N5BIT0055-N5BIT0056-N5BIT0057-N5BIT0059-N5BIT0060-N5BIT0061-N5BIT0063'),(2015,'B.Sc(IT)',6,'2017-12-28','','','','','',''),(2015,'B.Sc(IT)',6,'2017-12-29',_binary 'N5BIT0048-N5BIT0062',_binary 'N5BIT0048-N5BIT0062',_binary 'N5BIT0048-N5BIT0062',_binary 'N5BIT0048-N5BIT0062',_binary 'N5BIT0048-N5BIT0062',_binary 'N5BIT0048-N5BIT0062'),(2015,'B.Sc(IT)',6,'2017-12-30',_binary 'N5BIT0036-N5BIT0048-N5BIT0062',_binary 'N5BIT0036-N5BIT0048-N5BIT0062',_binary 'N5BIT0036-N5BIT0048-N5BIT0062',_binary 'N5BIT0001-N5BIT0002-N5BIT0003-N5BIT0004-N5BIT0005-N5BIT0006-N5BIT0007-N5BIT0008-N5BIT0009-N5BIT0010-N5BIT0011-N5BIT0012-N5BIT0013-N5BIT0015-N5BIT0016-N5BIT0017-N5BIT0018-N5BIT0019-N5BIT0020-N5BIT0021-N5BIT0022-N5BIT0023-N5BIT0024-N5BIT0025-N5BIT0026-N5BIT0027-N5BIT0028-N5BIT0031-N5BIT0032-N5BIT0034-N5BIT0035-N5BIT0036-N5BIT0037-N5BIT0038-N5BIT0039-N5BIT0040-N5BIT0041-N5BIT0042-N5BIT0043-N5BIT0044-N5BIT0046-N5BIT0047-N5BIT0048-N5BIT0049-N5BIT0050-N5BIT0051-N5BIT0052-N5BIT0053-N5BIT0055-N5BIT0056-N5BIT0057-N5BIT0058-N5BIT0059-N5BIT0060-N5BIT0061-N5BIT0062-N5BIT0063',_binary 'N5BIT0001-N5BIT0002-N5BIT0003-N5BIT0004-N5BIT0005-N5BIT0006-N5BIT0007-N5BIT0008-N5BIT0009-N5BIT0010-N5BIT0011-N5BIT0012-N5BIT0013-N5BIT0015-N5BIT0016-N5BIT0017-N5BIT0018-N5BIT0019-N5BIT0020-N5BIT0021-N5BIT0022-N5BIT0023-N5BIT0024-N5BIT0025-N5BIT0026-N5BIT0027-N5BIT0028-N5BIT0031-N5BIT0032-N5BIT0034-N5BIT0035-N5BIT0036-N5BIT0037-N5BIT0038-N5BIT0039-N5BIT0040-N5BIT0041-N5BIT0042-N5BIT0043-N5BIT0044-N5BIT0046-N5BIT0047-N5BIT0048-N5BIT0049-N5BIT0050-N5BIT0051-N5BIT0052-N5BIT0053-N5BIT0055-N5BIT0056-N5BIT0057-N5BIT0058-N5BIT0059-N5BIT0060-N5BIT0061-N5BIT0062-N5BIT0063',_binary 'N5BIT0001-N5BIT0002-N5BIT0003-N5BIT0004-N5BIT0005-N5BIT0006-N5BIT0007-N5BIT0008-N5BIT0009-N5BIT0010-N5BIT0011-N5BIT0012-N5BIT0013-N5BIT0015-N5BIT0016-N5BIT0017-N5BIT0018-N5BIT0019-N5BIT0020-N5BIT0021-N5BIT0022-N5BIT0023-N5BIT0024-N5BIT0025-N5BIT0026-N5BIT0027-N5BIT0028-N5BIT0031-N5BIT0032-N5BIT0034-N5BIT0035-N5BIT0036-N5BIT0037-N5BIT0038-N5BIT0039-N5BIT0040-N5BIT0041-N5BIT0042-N5BIT0043-N5BIT0044-N5BIT0046-N5BIT0047-N5BIT0048-N5BIT0049-N5BIT0050-N5BIT0051-N5BIT0052-N5BIT0053-N5BIT0055-N5BIT0056-N5BIT0057-N5BIT0058-N5BIT0059-N5BIT0060-N5BIT0061-N5BIT0062-N5BIT0063'),(2015,'B.Sc(IT)',6,'2017-12-12',_binary 'N5BIT0011-N5BIT0016-N5BIT0019-N5BIT0021-N5BIT0022-N5BIT0028-N5BIT0036-N5BIT0047-N5BIT0049-N5BIT0056',_binary 'N5BIT0011-N5BIT0016-N5BIT0019-N5BIT0021-N5BIT0022-N5BIT0028-N5BIT0036-N5BIT0047-N5BIT0049-N5BIT0056',_binary 'N5BIT0011-N5BIT0016-N5BIT0019-N5BIT0021-N5BIT0022-N5BIT0028-N5BIT0036-N5BIT0047-N5BIT0049-N5BIT0056',_binary 'N5BIT0011-N5BIT0016-N5BIT0019-N5BIT0021-N5BIT0022-N5BIT0028-N5BIT0036-N5BIT0047-N5BIT0049-N5BIT0056',_binary 'N5BIT0011-N5BIT0016-N5BIT0019-N5BIT0021-N5BIT0022-N5BIT0028-N5BIT0036-N5BIT0047-N5BIT0049-N5BIT0056',_binary 'N5BIT0011-N5BIT0016-N5BIT0019-N5BIT0021-N5BIT0022-N5BIT0028-N5BIT0036-N5BIT0047-N5BIT0049-N5BIT0056'),(2015,'B.Sc(IT)',6,'2018-01-02',_binary 'N5BIT0006-N5BIT0011-N5BIT0019-N5BIT0025-N5BIT0034-N5BIT0037-N5BIT0049-N5BIT0058-N5BIT0061',_binary 'N5BIT0006-N5BIT0011-N5BIT0019-N5BIT0025-N5BIT0034-N5BIT0037-N5BIT0058-N5BIT0061',_binary 'N5BIT0006-N5BIT0011-N5BIT0019-N5BIT0025-N5BIT0034-N5BIT0037-N5BIT0058-N5BIT0061',_binary 'N5BIT0006-N5BIT0011-N5BIT0019-N5BIT0024-N5BIT0025-N5BIT0034-N5BIT0037-N5BIT0042-N5BIT0058-N5BIT0061',_binary 'N5BIT0006-N5BIT0011-N5BIT0019-N5BIT0024-N5BIT0025-N5BIT0034-N5BIT0037-N5BIT0042-N5BIT0058-N5BIT0061',_binary 'N5BIT0006-N5BIT0011-N5BIT0019-N5BIT0024-N5BIT0025-N5BIT0034-N5BIT0037-N5BIT0042-N5BIT0058-N5BIT0061'),(2015,'B.Sc(IT)',6,'2018-01-03',_binary 'N5BIT0004-N5BIT0006-N5BIT0036-N5BIT0049-N5BIT0058-N5BIT0062',_binary 'N5BIT0004-N5BIT0006-N5BIT0036-N5BIT0049-N5BIT0058-N5BIT0062',_binary 'N5BIT0004-N5BIT0006-N5BIT0036-N5BIT0049-N5BIT0058-N5BIT0062',_binary 'N5BIT0004-N5BIT0006-N5BIT0036-N5BIT0049-N5BIT0058-N5BIT0062',_binary 'N5BIT0004-N5BIT0006-N5BIT0036-N5BIT0049-N5BIT0058-N5BIT0062',_binary 'N5BIT0004-N5BIT0006-N5BIT0036-N5BIT0049-N5BIT0058-N5BIT0062'),(2015,'B.Sc(IT)',6,'2018-01-04',_binary 'N5BIT0006-N5BIT0007-N5BIT0012-N5BIT0014-N5BIT0015-N5BIT0019-N5BIT0032-N5BIT0034-N5BIT0036-N5BIT0037-N5BIT0040-N5BIT0049-N5BIT0053-N5BIT0058-N5BIT0059-N5BIT0061',_binary 'N5BIT0006-N5BIT0007-N5BIT0012-N5BIT0014-N5BIT0015-N5BIT0019-N5BIT0032-N5BIT0034-N5BIT0036-N5BIT0037-N5BIT0040-N5BIT0049-N5BIT0053-N5BIT0058-N5BIT0059-N5BIT0061',_binary 'N5BIT0006-N5BIT0007-N5BIT0012-N5BIT0014-N5BIT0015-N5BIT0019-N5BIT0032-N5BIT0034-N5BIT0036-N5BIT0037-N5BIT0040-N5BIT0049-N5BIT0053-N5BIT0058-N5BIT0059-N5BIT0061',_binary 'N5BIT0006-N5BIT0007-N5BIT0012-N5BIT0014-N5BIT0015-N5BIT0032-N5BIT0034-N5BIT0036-N5BIT0037-N5BIT0040-N5BIT0049-N5BIT0053-N5BIT0058-N5BIT0059-N5BIT0061',_binary 'N5BIT0006-N5BIT0007-N5BIT0012-N5BIT0014-N5BIT0015-N5BIT0032-N5BIT0034-N5BIT0036-N5BIT0037-N5BIT0040-N5BIT0049-N5BIT0053-N5BIT0058-N5BIT0059-N5BIT0061',_binary 'N5BIT0006-N5BIT0007-N5BIT0012-N5BIT0014-N5BIT0015-N5BIT0032-N5BIT0034-N5BIT0036-N5BIT0037-N5BIT0040-N5BIT0049-N5BIT0053-N5BIT0058-N5BIT0059-N5BIT0061'),(2015,'B.Sc(IT)',6,'2018-01-05',_binary 'N5BIT0006-N5BIT0007-N5BIT0014-N5BIT0015-N5BIT0034-N5BIT0036-N5BIT0037-N5BIT0040-N5BIT0049-N5BIT0058-N5BIT0061',_binary 'N5BIT0006-N5BIT0007-N5BIT0014-N5BIT0015-N5BIT0034-N5BIT0036-N5BIT0037-N5BIT0040-N5BIT0049-N5BIT0058-N5BIT0061',_binary 'N5BIT0006-N5BIT0007-N5BIT0014-N5BIT0015-N5BIT0034-N5BIT0036-N5BIT0037-N5BIT0040-N5BIT0049-N5BIT0058-N5BIT0061',_binary 'N5BIT0006-N5BIT0007-N5BIT0014-N5BIT0015-N5BIT0034-N5BIT0036-N5BIT0037-N5BIT0040-N5BIT0049-N5BIT0058-N5BIT0061',_binary 'N5BIT0006-N5BIT0007-N5BIT0014-N5BIT0015-N5BIT0034-N5BIT0036-N5BIT0037-N5BIT0040-N5BIT0049-N5BIT0058-N5BIT0061',_binary 'N5BIT0006-N5BIT0007-N5BIT0014-N5BIT0015-N5BIT0034-N5BIT0036-N5BIT0037-N5BIT0040-N5BIT0049-N5BIT0058-N5BIT0061'),(2015,'B.Sc(IT)',6,'2018-01-08',_binary 'N5BIT0001-N5BIT0012-N5BIT0014-N5BIT0016-N5BIT0022-N5BIT0025-N5BIT0032-N5BIT0034-N5BIT0036-N5BIT0037-N5BIT0040-N5BIT0049-N5BIT0058-N5BIT0061',_binary 'N5BIT0001-N5BIT0012-N5BIT0014-N5BIT0016-N5BIT0022-N5BIT0025-N5BIT0032-N5BIT0034-N5BIT0036-N5BIT0037-N5BIT0040-N5BIT0049-N5BIT0058-N5BIT0061',_binary 'N5BIT0001-N5BIT0012-N5BIT0014-N5BIT0016-N5BIT0022-N5BIT0025-N5BIT0032-N5BIT0034-N5BIT0036-N5BIT0037-N5BIT0040-N5BIT0049-N5BIT0058-N5BIT0061',_binary 'N5BIT0001-N5BIT0012-N5BIT0014-N5BIT0016-N5BIT0022-N5BIT0025-N5BIT0032-N5BIT0034-N5BIT0036-N5BIT0037-N5BIT0040-N5BIT0049-N5BIT0058-N5BIT0061',_binary 'N5BIT0001-N5BIT0012-N5BIT0014-N5BIT0016-N5BIT0022-N5BIT0025-N5BIT0032-N5BIT0034-N5BIT0036-N5BIT0037-N5BIT0040-N5BIT0049-N5BIT0058-N5BIT0061',_binary 'N5BIT0001-N5BIT0012-N5BIT0014-N5BIT0016-N5BIT0022-N5BIT0025-N5BIT0032-N5BIT0034-N5BIT0036-N5BIT0037-N5BIT0040-N5BIT0049-N5BIT0058-N5BIT0061'),(2015,'B.Sc(IT)',6,'2018-01-09',_binary 'N5BIT0014-N5BIT0023-N5BIT0034-N5BIT0036-N5BIT0037-N5BIT0049-N5BIT0058-N5BIT0061',_binary 'N5BIT0014-N5BIT0023-N5BIT0034-N5BIT0036-N5BIT0037-N5BIT0049-N5BIT0058-N5BIT0061',_binary 'N5BIT0014-N5BIT0023-N5BIT0034-N5BIT0036-N5BIT0037-N5BIT0049-N5BIT0058-N5BIT0061',_binary 'N5BIT0014-N5BIT0023-N5BIT0034-N5BIT0036-N5BIT0037-N5BIT0049-N5BIT0058-N5BIT0061',_binary 'N5BIT0014-N5BIT0023-N5BIT0034-N5BIT0036-N5BIT0037-N5BIT0049-N5BIT0058-N5BIT0061',_binary 'N5BIT0014-N5BIT0023-N5BIT0034-N5BIT0036-N5BIT0037-N5BIT0049-N5BIT0058-N5BIT0061'),(2015,'B.Sc(IT)',6,'2018-01-10',_binary 'N5BIT0014-N5BIT0034-N5BIT0035-N5BIT0036-N5BIT0037-N5BIT0049-N5BIT0056-N5BIT0058-N5BIT0061',_binary 'N5BIT0014-N5BIT0034-N5BIT0035-N5BIT0036-N5BIT0037-N5BIT0049-N5BIT0056-N5BIT0058-N5BIT0061',_binary 'N5BIT0014-N5BIT0034-N5BIT0035-N5BIT0036-N5BIT0037-N5BIT0049-N5BIT0056-N5BIT0058-N5BIT0061',_binary 'N5BIT0014-N5BIT0034-N5BIT0035-N5BIT0036-N5BIT0037-N5BIT0049-N5BIT0056-N5BIT0058-N5BIT0061',_binary 'N5BIT0014-N5BIT0034-N5BIT0035-N5BIT0036-N5BIT0037-N5BIT0049-N5BIT0056-N5BIT0058-N5BIT0061',_binary 'N5BIT0014-N5BIT0034-N5BIT0035-N5BIT0036-N5BIT0037-N5BIT0049-N5BIT0056-N5BIT0058-N5BIT0061'),(2015,'B.Sc(IT)',6,'2018-01-11',_binary 'N5BIT0006-N5BIT0014-N5BIT0020-N5BIT0032-N5BIT0034-N5BIT0036-N5BIT0037-N5BIT0038-N5BIT0049-N5BIT0056-N5BIT0058-N5BIT0061',_binary 'N5BIT0006-N5BIT0014-N5BIT0020-N5BIT0032-N5BIT0034-N5BIT0036-N5BIT0037-N5BIT0038-N5BIT0049-N5BIT0056-N5BIT0058-N5BIT0061',_binary 'N5BIT0006-N5BIT0014-N5BIT0020-N5BIT0032-N5BIT0034-N5BIT0036-N5BIT0037-N5BIT0038-N5BIT0049-N5BIT0056-N5BIT0058-N5BIT0061',_binary 'N5BIT0006-N5BIT0014-N5BIT0020-N5BIT0032-N5BIT0034-N5BIT0036-N5BIT0037-N5BIT0038-N5BIT0049-N5BIT0056-N5BIT0058-N5BIT0061',_binary 'N5BIT0006-N5BIT0014-N5BIT0020-N5BIT0032-N5BIT0034-N5BIT0036-N5BIT0037-N5BIT0038-N5BIT0049-N5BIT0056-N5BIT0058-N5BIT0061',_binary 'N5BIT0006-N5BIT0014-N5BIT0020-N5BIT0032-N5BIT0034-N5BIT0036-N5BIT0037-N5BIT0038-N5BIT0049-N5BIT0056-N5BIT0058-N5BIT0061'),(2015,'B.Sc(IT)',6,'2018-01-17',_binary 'N5BIT0006-N5BIT0009-N5BIT0011-N5BIT0013-N5BIT0014-N5BIT0015-N5BIT0016-N5BIT0024-N5BIT0025-N5BIT0028-N5BIT0031-N5BIT0034-N5BIT0036-N5BIT0040-N5BIT0041-N5BIT0049-N5BIT0050-N5BIT0057-N5BIT0058-N5BIT0061',_binary 'N5BIT0006-N5BIT0009-N5BIT0011-N5BIT0013-N5BIT0014-N5BIT0015-N5BIT0016-N5BIT0024-N5BIT0025-N5BIT0028-N5BIT0031-N5BIT0034-N5BIT0036-N5BIT0040-N5BIT0041-N5BIT0049-N5BIT0050-N5BIT0057-N5BIT0058-N5BIT0061',_binary 'N5BIT0006-N5BIT0009-N5BIT0011-N5BIT0013-N5BIT0014-N5BIT0015-N5BIT0016-N5BIT0024-N5BIT0025-N5BIT0028-N5BIT0031-N5BIT0034-N5BIT0036-N5BIT0040-N5BIT0041-N5BIT0049-N5BIT0050-N5BIT0057-N5BIT0058-N5BIT0061',_binary 'N5BIT0006-N5BIT0009-N5BIT0011-N5BIT0013-N5BIT0014-N5BIT0015-N5BIT0016-N5BIT0024-N5BIT0025-N5BIT0028-N5BIT0031-N5BIT0034-N5BIT0036-N5BIT0040-N5BIT0041-N5BIT0049-N5BIT0050-N5BIT0057-N5BIT0058-N5BIT0061',_binary 'N5BIT0006-N5BIT0009-N5BIT0011-N5BIT0013-N5BIT0014-N5BIT0015-N5BIT0016-N5BIT0024-N5BIT0025-N5BIT0028-N5BIT0031-N5BIT0034-N5BIT0036-N5BIT0040-N5BIT0041-N5BIT0049-N5BIT0050-N5BIT0057-N5BIT0058-N5BIT0061',_binary 'N5BIT0006-N5BIT0009-N5BIT0011-N5BIT0013-N5BIT0014-N5BIT0015-N5BIT0016-N5BIT0024-N5BIT0025-N5BIT0028-N5BIT0031-N5BIT0034-N5BIT0036-N5BIT0040-N5BIT0041-N5BIT0049-N5BIT0050-N5BIT0057-N5BIT0058-N5BIT0061'),(2015,'B.Sc(IT)',6,'2018-01-18',_binary 'N5BIT0006-N5BIT0012-N5BIT0014-N5BIT0028-N5BIT0032-N5BIT0034-N5BIT0036-N5BIT0041-N5BIT0058-N5BIT0061',_binary 'N5BIT0006-N5BIT0012-N5BIT0014-N5BIT0028-N5BIT0032-N5BIT0034-N5BIT0036-N5BIT0041-N5BIT0058-N5BIT0061',_binary 'N5BIT0006-N5BIT0012-N5BIT0014-N5BIT0028-N5BIT0032-N5BIT0034-N5BIT0036-N5BIT0041-N5BIT0058-N5BIT0061',_binary 'N5BIT0004-N5BIT0006-N5BIT0012-N5BIT0014-N5BIT0028-N5BIT0032-N5BIT0034-N5BIT0036-N5BIT0041-N5BIT0058-N5BIT0061',_binary 'N5BIT0004-N5BIT0006-N5BIT0012-N5BIT0014-N5BIT0028-N5BIT0032-N5BIT0034-N5BIT0036-N5BIT0041-N5BIT0058-N5BIT0061',_binary 'N5BIT0004-N5BIT0006-N5BIT0012-N5BIT0014-N5BIT0028-N5BIT0032-N5BIT0034-N5BIT0036-N5BIT0041-N5BIT0058-N5BIT0061'),(2015,'B.Sc(IT)',6,'2018-01-19',_binary 'N5BIT0004-N5BIT0005-N5BIT0006-N5BIT0025-N5BIT0028-N5BIT0032-N5BIT0034-N5BIT0038-N5BIT0044-N5BIT0053-N5BIT0058-N5BIT0060-N5BIT0061',_binary 'N5BIT0004-N5BIT0005-N5BIT0006-N5BIT0025-N5BIT0028-N5BIT0032-N5BIT0034-N5BIT0038-N5BIT0044-N5BIT0053-N5BIT0058-N5BIT0060-N5BIT0061',_binary 'N5BIT0004-N5BIT0005-N5BIT0006-N5BIT0025-N5BIT0028-N5BIT0032-N5BIT0034-N5BIT0038-N5BIT0044-N5BIT0053-N5BIT0058-N5BIT0060-N5BIT0061',_binary 'N5BIT0004-N5BIT0005-N5BIT0006-N5BIT0025-N5BIT0028-N5BIT0032-N5BIT0034-N5BIT0038-N5BIT0042-N5BIT0044-N5BIT0053-N5BIT0058-N5BIT0060-N5BIT0061',_binary 'N5BIT0004-N5BIT0005-N5BIT0006-N5BIT0025-N5BIT0028-N5BIT0032-N5BIT0034-N5BIT0038-N5BIT0042-N5BIT0044-N5BIT0053-N5BIT0058-N5BIT0060-N5BIT0061',_binary 'N5BIT0004-N5BIT0005-N5BIT0006-N5BIT0025-N5BIT0028-N5BIT0032-N5BIT0034-N5BIT0038-N5BIT0042-N5BIT0044-N5BIT0053-N5BIT0058-N5BIT0060-N5BIT0061'),(2015,'B.Sc(IT)',6,'2018-01-31',_binary 'N5BIT0002-N5BIT0025-N5BIT0058',_binary 'N5BIT0002-N5BIT0025-N5BIT0058',_binary 'N5BIT0002-N5BIT0025-N5BIT0058',_binary 'N5BIT0002-N5BIT0025-N5BIT0058',_binary 'N5BIT0002-N5BIT0025-N5BIT0058',_binary 'N5BIT0002-N5BIT0025-N5BIT0058'),(2015,'B.Sc(IT)',6,'2018-01-30',_binary 'N5BIT0002-N5BIT0025-N5BIT0058',_binary 'N5BIT0002-N5BIT0025-N5BIT0058',_binary 'N5BIT0002-N5BIT0025-N5BIT0058',_binary 'N5BIT0002-N5BIT0025-N5BIT0058',_binary 'N5BIT0002-N5BIT0025-N5BIT0058',_binary 'N5BIT0002-N5BIT0025-N5BIT0058'),(2015,'B.Sc(IT)',6,'2018-01-29',_binary 'N5BIT0005-N5BIT0009-N5BIT0013-N5BIT0015-N5BIT0058',_binary 'N5BIT0005-N5BIT0009-N5BIT0013-N5BIT0015-N5BIT0058',_binary 'N5BIT0005-N5BIT0009-N5BIT0013-N5BIT0015-N5BIT0058',_binary 'N5BIT0005-N5BIT0009-N5BIT0013-N5BIT0015-N5BIT0058',_binary 'N5BIT0005-N5BIT0009-N5BIT0013-N5BIT0015-N5BIT0058',_binary 'N5BIT0005-N5BIT0009-N5BIT0013-N5BIT0015-N5BIT0058'),(2015,'B.Sc(IT)',6,'2018-01-22',_binary 'N5BIT0001-N5BIT0004-N5BIT0006-N5BIT0012-N5BIT0013-N5BIT0016-N5BIT0024-N5BIT0025-N5BIT0032-N5BIT0034-N5BIT0041-N5BIT0044-N5BIT0052-N5BIT0058-N5BIT0061',_binary 'N5BIT0001-N5BIT0004-N5BIT0006-N5BIT0012-N5BIT0013-N5BIT0016-N5BIT0024-N5BIT0025-N5BIT0032-N5BIT0034-N5BIT0041-N5BIT0044-N5BIT0052-N5BIT0058-N5BIT0061',_binary 'N5BIT0001-N5BIT0004-N5BIT0006-N5BIT0012-N5BIT0013-N5BIT0016-N5BIT0024-N5BIT0025-N5BIT0032-N5BIT0034-N5BIT0041-N5BIT0044-N5BIT0052-N5BIT0058-N5BIT0061',_binary 'N5BIT0001-N5BIT0004-N5BIT0006-N5BIT0012-N5BIT0013-N5BIT0016-N5BIT0024-N5BIT0025-N5BIT0032-N5BIT0034-N5BIT0041-N5BIT0044-N5BIT0052-N5BIT0058-N5BIT0061',_binary 'N5BIT0001-N5BIT0004-N5BIT0006-N5BIT0012-N5BIT0013-N5BIT0016-N5BIT0024-N5BIT0025-N5BIT0032-N5BIT0034-N5BIT0041-N5BIT0044-N5BIT0052-N5BIT0058-N5BIT0061',_binary 'N5BIT0001-N5BIT0004-N5BIT0006-N5BIT0012-N5BIT0013-N5BIT0016-N5BIT0024-N5BIT0025-N5BIT0032-N5BIT0034-N5BIT0041-N5BIT0044-N5BIT0052-N5BIT0058-N5BIT0061'),(2015,'B.Sc(IT)',6,'2018-01-23',_binary 'N5BIT0003-N5BIT0004-N5BIT0018-N5BIT0032-N5BIT0034-N5BIT0042-N5BIT0058-N5BIT0061',_binary 'N5BIT0003-N5BIT0004-N5BIT0018-N5BIT0032-N5BIT0034-N5BIT0042-N5BIT0058-N5BIT0061',_binary 'N5BIT0003-N5BIT0004-N5BIT0018-N5BIT0032-N5BIT0034-N5BIT0042-N5BIT0058-N5BIT0061',_binary 'N5BIT0003-N5BIT0004-N5BIT0018-N5BIT0032-N5BIT0034-N5BIT0042-N5BIT0058-N5BIT0061',_binary 'N5BIT0003-N5BIT0004-N5BIT0018-N5BIT0032-N5BIT0034-N5BIT0042-N5BIT0058-N5BIT0061',_binary 'N5BIT0003-N5BIT0004-N5BIT0018-N5BIT0032-N5BIT0034-N5BIT0042-N5BIT0058-N5BIT0061'),(2015,'B.Sc(IT)',6,'2018-01-24',_binary 'N5BIT0018-N5BIT0032-N5BIT0042-N5BIT0048-N5BIT0058-N5BIT0061',_binary 'N5BIT0018-N5BIT0032-N5BIT0042-N5BIT0048-N5BIT0058-N5BIT0061',_binary 'N5BIT0018-N5BIT0032-N5BIT0042-N5BIT0048-N5BIT0058-N5BIT0061',_binary 'N5BIT0018-N5BIT0032-N5BIT0042-N5BIT0048-N5BIT0058-N5BIT0061',_binary 'N5BIT0018-N5BIT0032-N5BIT0042-N5BIT0048-N5BIT0058-N5BIT0061',_binary 'N5BIT0018-N5BIT0032-N5BIT0042-N5BIT0048-N5BIT0058-N5BIT0061'),(2015,'B.Sc(IT)',6,'2018-01-25',_binary 'N5BIT0019-N5BIT0032-N5BIT0041-N5BIT0044-N5BIT0056-N5BIT0058-N5BIT0061',_binary 'N5BIT0019-N5BIT0032-N5BIT0041-N5BIT0044-N5BIT0056-N5BIT0058-N5BIT0061',_binary 'N5BIT0019-N5BIT0032-N5BIT0041-N5BIT0044-N5BIT0056-N5BIT0058-N5BIT0061',_binary 'N5BIT0019-N5BIT0032-N5BIT0044-N5BIT0056-N5BIT0058',_binary 'N5BIT0019-N5BIT0032-N5BIT0044-N5BIT0056-N5BIT0058',_binary 'N5BIT0019-N5BIT0032-N5BIT0044-N5BIT0056-N5BIT0058'),(2015,'B.Sc(IT)',6,'2018-01-27',_binary 'N5BIT0007-N5BIT0008-N5BIT0011-N5BIT0028-N5BIT0032-N5BIT0035-N5BIT0043-N5BIT0046-N5BIT0049-N5BIT0052-N5BIT0053-N5BIT0056-N5BIT0057-N5BIT0058-N5BIT0059-N5BIT0063',_binary 'N5BIT0007-N5BIT0008-N5BIT0011-N5BIT0028-N5BIT0032-N5BIT0035-N5BIT0043-N5BIT0046-N5BIT0049-N5BIT0052-N5BIT0053-N5BIT0056-N5BIT0057-N5BIT0058-N5BIT0059-N5BIT0063',_binary 'N5BIT0007-N5BIT0008-N5BIT0011-N5BIT0028-N5BIT0032-N5BIT0035-N5BIT0043-N5BIT0046-N5BIT0049-N5BIT0052-N5BIT0053-N5BIT0056-N5BIT0057-N5BIT0058-N5BIT0059-N5BIT0063',_binary 'N5BIT0007-N5BIT0008-N5BIT0011-N5BIT0028-N5BIT0032-N5BIT0035-N5BIT0043-N5BIT0046-N5BIT0049-N5BIT0052-N5BIT0053-N5BIT0056-N5BIT0057-N5BIT0058-N5BIT0059-N5BIT0063',_binary 'N5BIT0007-N5BIT0008-N5BIT0011-N5BIT0028-N5BIT0032-N5BIT0035-N5BIT0043-N5BIT0046-N5BIT0049-N5BIT0052-N5BIT0053-N5BIT0056-N5BIT0057-N5BIT0058-N5BIT0059-N5BIT0063',_binary 'N5BIT0007-N5BIT0008-N5BIT0011-N5BIT0028-N5BIT0032-N5BIT0035-N5BIT0043-N5BIT0046-N5BIT0049-N5BIT0052-N5BIT0053-N5BIT0056-N5BIT0057-N5BIT0058-N5BIT0059-N5BIT0063'),(2015,'B.Sc(IT)',6,'2018-02-01',_binary 'N5BIT0003-N5BIT0004-N5BIT0005-N5BIT0007-N5BIT0011-N5BIT0022-N5BIT0025-N5BIT0028-N5BIT0042-N5BIT0051-N5BIT0053-N5BIT0057-N5BIT0058',_binary 'N5BIT0003-N5BIT0004-N5BIT0005-N5BIT0007-N5BIT0011-N5BIT0022-N5BIT0025-N5BIT0028-N5BIT0042-N5BIT0051-N5BIT0053-N5BIT0057-N5BIT0058',_binary 'N5BIT0003-N5BIT0004-N5BIT0005-N5BIT0007-N5BIT0011-N5BIT0022-N5BIT0025-N5BIT0028-N5BIT0042-N5BIT0051-N5BIT0053-N5BIT0057-N5BIT0058',_binary 'N5BIT0003-N5BIT0004-N5BIT0005-N5BIT0007-N5BIT0011-N5BIT0022-N5BIT0025-N5BIT0028-N5BIT0042-N5BIT0051-N5BIT0053-N5BIT0057-N5BIT0058',_binary 'N5BIT0003-N5BIT0004-N5BIT0005-N5BIT0007-N5BIT0011-N5BIT0022-N5BIT0025-N5BIT0028-N5BIT0042-N5BIT0051-N5BIT0053-N5BIT0057-N5BIT0058',_binary 'N5BIT0003-N5BIT0004-N5BIT0005-N5BIT0007-N5BIT0011-N5BIT0022-N5BIT0025-N5BIT0028-N5BIT0042-N5BIT0051-N5BIT0053-N5BIT0057-N5BIT0058'),(2015,'B.Sc(IT)',6,'2018-02-02',_binary 'N5BIT0005-N5BIT0011-N5BIT0016-N5BIT0022-N5BIT0032-N5BIT0041-N5BIT0058',_binary 'N5BIT0005-N5BIT0011-N5BIT0016-N5BIT0022-N5BIT0032-N5BIT0041-N5BIT0058',_binary 'N5BIT0005-N5BIT0011-N5BIT0016-N5BIT0022-N5BIT0032-N5BIT0041-N5BIT0058',_binary 'N5BIT0005-N5BIT0011-N5BIT0016-N5BIT0022-N5BIT0032-N5BIT0041-N5BIT0058',_binary 'N5BIT0005-N5BIT0011-N5BIT0016-N5BIT0022-N5BIT0032-N5BIT0041-N5BIT0058',_binary 'N5BIT0005-N5BIT0011-N5BIT0016-N5BIT0022-N5BIT0032-N5BIT0041-N5BIT0058'),(2015,'B.Sc(IT)',6,'2018-02-05',_binary 'N5BIT0012-N5BIT0018-N5BIT0032-N5BIT0058',_binary 'N5BIT0012-N5BIT0018-N5BIT0032-N5BIT0058',_binary 'N5BIT0012-N5BIT0018-N5BIT0032-N5BIT0058',_binary 'N5BIT0012-N5BIT0018-N5BIT0032-N5BIT0058',_binary 'N5BIT0012-N5BIT0018-N5BIT0032-N5BIT0058',_binary 'N5BIT0012-N5BIT0018-N5BIT0032-N5BIT0058'),(2015,'B.Sc(IT)',6,'2018-02-06',_binary 'N5BIT0004-N5BIT0005-N5BIT0012-N5BIT0032-N5BIT0037-N5BIT0058',_binary 'N5BIT0004-N5BIT0005-N5BIT0012-N5BIT0032-N5BIT0037-N5BIT0058',_binary 'N5BIT0004-N5BIT0005-N5BIT0012-N5BIT0032-N5BIT0037-N5BIT0058',_binary 'N5BIT0004-N5BIT0005-N5BIT0012-N5BIT0032-N5BIT0037-N5BIT0058',_binary 'N5BIT0004-N5BIT0005-N5BIT0012-N5BIT0032-N5BIT0037-N5BIT0058',_binary 'N5BIT0004-N5BIT0005-N5BIT0012-N5BIT0032-N5BIT0037-N5BIT0058'),(2015,'B.Sc(IT)',6,'2018-02-07',_binary 'N5BIT0004-N5BIT0019-N5BIT0032-N5BIT0055-N5BIT0058-N5BIT0059',_binary 'N5BIT0004-N5BIT0019-N5BIT0032-N5BIT0055-N5BIT0058-N5BIT0059',_binary 'N5BIT0004-N5BIT0019-N5BIT0032-N5BIT0055-N5BIT0058-N5BIT0059',_binary 'N5BIT0004-N5BIT0019-N5BIT0032-N5BIT0055-N5BIT0058-N5BIT0059',_binary 'N5BIT0004-N5BIT0019-N5BIT0032-N5BIT0055-N5BIT0058-N5BIT0059',_binary 'N5BIT0004-N5BIT0019-N5BIT0032-N5BIT0055-N5BIT0058-N5BIT0059'),(2015,'B.Sc(IT)',6,'2018-02-08',_binary 'N5BIT0002-N5BIT0004-N5BIT0005-N5BIT0007-N5BIT0014-N5BIT0019-N5BIT0028-N5BIT0032-N5BIT0038-N5BIT0053-N5BIT0063',_binary 'N5BIT0002-N5BIT0004-N5BIT0005-N5BIT0007-N5BIT0014-N5BIT0019-N5BIT0028-N5BIT0032-N5BIT0038-N5BIT0053-N5BIT0063',_binary 'N5BIT0002-N5BIT0004-N5BIT0005-N5BIT0007-N5BIT0014-N5BIT0019-N5BIT0028-N5BIT0032-N5BIT0038-N5BIT0053-N5BIT0063',_binary 'N5BIT0002-N5BIT0004-N5BIT0005-N5BIT0007-N5BIT0014-N5BIT0019-N5BIT0028-N5BIT0032-N5BIT0038-N5BIT0053-N5BIT0063',_binary 'N5BIT0002-N5BIT0004-N5BIT0005-N5BIT0007-N5BIT0014-N5BIT0019-N5BIT0028-N5BIT0032-N5BIT0038-N5BIT0053-N5BIT0063',_binary 'N5BIT0002-N5BIT0004-N5BIT0005-N5BIT0007-N5BIT0014-N5BIT0019-N5BIT0028-N5BIT0032-N5BIT0038-N5BIT0053-N5BIT0063'),(2015,'B.Sc(IT)',6,'2018-02-09',_binary 'N5BIT0004-N5BIT0024-N5BIT0032-N5BIT0038-N5BIT0041',_binary 'N5BIT0004-N5BIT0024-N5BIT0032-N5BIT0038-N5BIT0041',_binary 'N5BIT0004-N5BIT0024-N5BIT0032-N5BIT0038-N5BIT0041',_binary 'N5BIT0004-N5BIT0024-N5BIT0032-N5BIT0038-N5BIT0041',_binary 'N5BIT0004-N5BIT0024-N5BIT0032-N5BIT0038-N5BIT0041',_binary 'N5BIT0004-N5BIT0024-N5BIT0032-N5BIT0038-N5BIT0041'),(2015,'B.Sc(IT)',6,'2018-02-10',_binary 'N5BIT0004-N5BIT0011-N5BIT0024-N5BIT0038-N5BIT0042-N5BIT0044',_binary 'N5BIT0004-N5BIT0011-N5BIT0024-N5BIT0038-N5BIT0042-N5BIT0044',_binary 'N5BIT0004-N5BIT0011-N5BIT0024-N5BIT0038-N5BIT0042-N5BIT0044',_binary 'N5BIT0004-N5BIT0011-N5BIT0024-N5BIT0038-N5BIT0042-N5BIT0044',_binary 'N5BIT0004-N5BIT0011-N5BIT0024-N5BIT0038-N5BIT0042-N5BIT0044',_binary 'N5BIT0004-N5BIT0011-N5BIT0024-N5BIT0038-N5BIT0042-N5BIT0044'),(2015,'B.Sc(IT)',6,'2018-02-12',_binary 'N5BIT0006-N5BIT0023-N5BIT0036-N5BIT0042-N5BIT0059',_binary 'N5BIT0006-N5BIT0023-N5BIT0036-N5BIT0042-N5BIT0059',_binary 'N5BIT0006-N5BIT0023-N5BIT0036-N5BIT0042-N5BIT0059',_binary 'N5BIT0004-N5BIT0006-N5BIT0010-N5BIT0023-N5BIT0036-N5BIT0042-N5BIT0059',_binary 'N5BIT0004-N5BIT0006-N5BIT0010-N5BIT0023-N5BIT0036-N5BIT0042-N5BIT0059',_binary 'N5BIT0004-N5BIT0006-N5BIT0010-N5BIT0023-N5BIT0036-N5BIT0042-N5BIT0059'),(2015,'B.Sc(IT)',6,'2018-02-13',_binary 'N5BIT0003-N5BIT0004-N5BIT0007-N5BIT0017-N5BIT0023-N5BIT0031-N5BIT0044-N5BIT0046-N5BIT0063',_binary 'N5BIT0003-N5BIT0004-N5BIT0007-N5BIT0017-N5BIT0023-N5BIT0031-N5BIT0044-N5BIT0046-N5BIT0063',_binary 'N5BIT0003-N5BIT0004-N5BIT0007-N5BIT0017-N5BIT0023-N5BIT0031-N5BIT0044-N5BIT0046-N5BIT0063',_binary 'N5BIT0003-N5BIT0004-N5BIT0007-N5BIT0017-N5BIT0023-N5BIT0031-N5BIT0044-N5BIT0046-N5BIT0063',_binary 'N5BIT0003-N5BIT0004-N5BIT0007-N5BIT0017-N5BIT0023-N5BIT0031-N5BIT0044-N5BIT0046-N5BIT0063',_binary 'N5BIT0003-N5BIT0004-N5BIT0007-N5BIT0017-N5BIT0023-N5BIT0031-N5BIT0044-N5BIT0046-N5BIT0063'),(2015,'B.Sc(IT)',6,'2018-02-14',_binary 'N5BIT0002-N5BIT0004-N5BIT0005-N5BIT0007-N5BIT0028-N5BIT0031-N5BIT0044-N5BIT0061-N5BIT0062',_binary 'N5BIT0002-N5BIT0004-N5BIT0005-N5BIT0007-N5BIT0028-N5BIT0031-N5BIT0044-N5BIT0061-N5BIT0062',_binary 'N5BIT0002-N5BIT0004-N5BIT0005-N5BIT0007-N5BIT0028-N5BIT0031-N5BIT0044-N5BIT0061-N5BIT0062',_binary 'N5BIT0002-N5BIT0004-N5BIT0005-N5BIT0007-N5BIT0028-N5BIT0031-N5BIT0044-N5BIT0061-N5BIT0062',_binary 'N5BIT0002-N5BIT0004-N5BIT0005-N5BIT0007-N5BIT0028-N5BIT0031-N5BIT0044-N5BIT0061-N5BIT0062',_binary 'N5BIT0002-N5BIT0004-N5BIT0005-N5BIT0007-N5BIT0028-N5BIT0031-N5BIT0044-N5BIT0061-N5BIT0062'),(2015,'B.Sc(IT)',6,'2018-02-15',_binary 'N5BIT0018-N5BIT0062',_binary 'N5BIT0018-N5BIT0062',_binary 'N5BIT0018-N5BIT0062',_binary 'N5BIT0018-N5BIT0062',_binary 'N5BIT0018-N5BIT0062',_binary 'N5BIT0018-N5BIT0062'),(2015,'B.Sc(IT)',6,'2018-02-16',_binary 'N5BIT0018-N5BIT0052-N5BIT0062',_binary 'N5BIT0018-N5BIT0052-N5BIT0062',_binary 'N5BIT0018-N5BIT0052-N5BIT0062',_binary 'N5BIT0018-N5BIT0052-N5BIT0062',_binary 'N5BIT0018-N5BIT0052-N5BIT0062',_binary 'N5BIT0018-N5BIT0052-N5BIT0062'),(2015,'B.Sc(IT)',6,'2018-02-19',_binary 'N5BIT0002-N5BIT0004-N5BIT0009-N5BIT0011-N5BIT0038-N5BIT0042-N5BIT0048',_binary 'N5BIT0002-N5BIT0004-N5BIT0009-N5BIT0011-N5BIT0038-N5BIT0042-N5BIT0048',_binary 'N5BIT0002-N5BIT0004-N5BIT0009-N5BIT0011-N5BIT0038-N5BIT0042-N5BIT0048',_binary 'N5BIT0002-N5BIT0004-N5BIT0009-N5BIT0011-N5BIT0038-N5BIT0042-N5BIT0048',_binary 'N5BIT0002-N5BIT0004-N5BIT0009-N5BIT0011-N5BIT0038-N5BIT0042-N5BIT0048',_binary 'N5BIT0002-N5BIT0004-N5BIT0009-N5BIT0011-N5BIT0038-N5BIT0042-N5BIT0048'),(2015,'B.Sc(IT)',6,'2018-02-21',_binary 'N5BIT0015-N5BIT0018-N5BIT0023-N5BIT0025-N5BIT0028-N5BIT0039-N5BIT0040-N5BIT0046-N5BIT0053-N5BIT0059-N5BIT0060',_binary 'N5BIT0015-N5BIT0018-N5BIT0023-N5BIT0025-N5BIT0028-N5BIT0039-N5BIT0040-N5BIT0046-N5BIT0053-N5BIT0059-N5BIT0060',_binary 'N5BIT0015-N5BIT0018-N5BIT0023-N5BIT0025-N5BIT0028-N5BIT0039-N5BIT0040-N5BIT0046-N5BIT0053-N5BIT0059-N5BIT0060',_binary 'N5BIT0014-N5BIT0015-N5BIT0018-N5BIT0023-N5BIT0025-N5BIT0028-N5BIT0039-N5BIT0040-N5BIT0046-N5BIT0053-N5BIT0059-N5BIT0060',_binary 'N5BIT0014-N5BIT0015-N5BIT0018-N5BIT0023-N5BIT0025-N5BIT0028-N5BIT0039-N5BIT0040-N5BIT0046-N5BIT0053-N5BIT0059-N5BIT0060',_binary 'N5BIT0014-N5BIT0015-N5BIT0018-N5BIT0023-N5BIT0025-N5BIT0028-N5BIT0039-N5BIT0040-N5BIT0046-N5BIT0053-N5BIT0059-N5BIT0060'),(2015,'B.Sc(IT)',6,'2018-02-23',_binary 'N5BIT0014-N5BIT0049',_binary 'N5BIT0014-N5BIT0049',_binary 'N5BIT0014-N5BIT0049',_binary 'N5BIT0014-N5BIT0049',_binary 'N5BIT0014-N5BIT0049',_binary 'N5BIT0014-N5BIT0049'),(2015,'B.Sc(IT)',6,'2018-02-27',_binary 'N5BIT0008-N5BIT0013-N5BIT0040-N5BIT0056',_binary 'N5BIT0008-N5BIT0013-N5BIT0040-N5BIT0056',_binary 'N5BIT0008-N5BIT0013-N5BIT0040-N5BIT0056',_binary 'N5BIT0008-N5BIT0013-N5BIT0040-N5BIT0056',_binary 'N5BIT0008-N5BIT0013-N5BIT0040-N5BIT0056',_binary 'N5BIT0008-N5BIT0013-N5BIT0040-N5BIT0056'),(2015,'B.Sc(IT)',6,'2018-02-28',_binary 'N5BIT0008-N5BIT0019-N5BIT0052',_binary 'N5BIT0008-N5BIT0019-N5BIT0052',_binary 'N5BIT0008-N5BIT0019-N5BIT0052',_binary 'N5BIT0008-N5BIT0019-N5BIT0052',_binary 'N5BIT0008-N5BIT0019-N5BIT0052',_binary 'N5BIT0008-N5BIT0019-N5BIT0052'),(2015,'B.Sc(IT)',6,'2018-02-20','','','','','',''),(2015,'B.Sc(IT)',6,'2018-02-24','','','','','',''),(2015,'B.Sc(IT)',6,'2018-03-02',_binary 'N5BIT0003-N5BIT0008-N5BIT0013-N5BIT0016-N5BIT0057',_binary 'N5BIT0003-N5BIT0008-N5BIT0013-N5BIT0016-N5BIT0057',_binary 'N5BIT0003-N5BIT0008-N5BIT0013-N5BIT0016-N5BIT0057',_binary 'N5BIT0003-N5BIT0008-N5BIT0013-N5BIT0016-N5BIT0057',_binary 'N5BIT0003-N5BIT0008-N5BIT0013-N5BIT0016-N5BIT0057',_binary 'N5BIT0003-N5BIT0008-N5BIT0013-N5BIT0016-N5BIT0057'),(2015,'B.Sc(IT)',6,'2018-03-01',_binary 'N5BIT0032-N5BIT0052',_binary 'N5BIT0032-N5BIT0052',_binary 'N5BIT0032-N5BIT0052',_binary 'N5BIT0032-N5BIT0052',_binary 'N5BIT0032-N5BIT0052',_binary 'N5BIT0032-N5BIT0052'),(2015,'B.Sc(IT)',6,'2018-03-05',_binary 'N5BIT0006-N5BIT0008-N5BIT0020-N5BIT0022-N5BIT0028-N5BIT0038',_binary 'N5BIT0006-N5BIT0008-N5BIT0020-N5BIT0022-N5BIT0028-N5BIT0038',_binary 'N5BIT0006-N5BIT0008-N5BIT0020-N5BIT0022-N5BIT0028-N5BIT0038',_binary 'N5BIT0006-N5BIT0008-N5BIT0020-N5BIT0022-N5BIT0028-N5BIT0038',_binary 'N5BIT0006-N5BIT0008-N5BIT0020-N5BIT0022-N5BIT0028-N5BIT0038',_binary 'N5BIT0006-N5BIT0008-N5BIT0020-N5BIT0022-N5BIT0028-N5BIT0038'),(2015,'B.Sc(IT)',6,'2018-03-06',_binary 'N5BIT0007-N5BIT0011-N5BIT0028-N5BIT0035-N5BIT0051-N5BIT0052-N5BIT0063',_binary 'N5BIT0007-N5BIT0011-N5BIT0028-N5BIT0035-N5BIT0051-N5BIT0052-N5BIT0063',_binary 'N5BIT0007-N5BIT0011-N5BIT0028-N5BIT0035-N5BIT0051-N5BIT0052-N5BIT0063',_binary 'N5BIT0007-N5BIT0011-N5BIT0028-N5BIT0035-N5BIT0051-N5BIT0052-N5BIT0063',_binary 'N5BIT0007-N5BIT0011-N5BIT0028-N5BIT0035-N5BIT0051-N5BIT0052-N5BIT0063',_binary 'N5BIT0007-N5BIT0011-N5BIT0028-N5BIT0035-N5BIT0051-N5BIT0052-N5BIT0063'),(2015,'B.Sc(IT)',6,'2018-03-07',_binary 'N5BIT0011-N5BIT0042-N5BIT0056',_binary 'N5BIT0011-N5BIT0042-N5BIT0056',_binary 'N5BIT0011-N5BIT0042-N5BIT0056',_binary 'N5BIT0011-N5BIT0042-N5BIT0056',_binary 'N5BIT0011-N5BIT0042-N5BIT0056',_binary 'N5BIT0011-N5BIT0042-N5BIT0056'),(2015,'B.Sc(IT)',6,'2018-03-08',_binary 'N5BIT0059',_binary 'N5BIT0059',_binary 'N5BIT0059',_binary 'N5BIT0059',_binary 'N5BIT0059',_binary 'N5BIT0059'),(2015,'B.Sc(IT)',6,'2018-03-09',_binary 'N5BIT0053',_binary 'N5BIT0053',_binary 'N5BIT0053',_binary 'N5BIT0053',_binary 'N5BIT0053',_binary 'N5BIT0053'),(2015,'B.Sc(IT)',6,'2018-03-10','','','','','',''),(2015,'B.Sc(IT)',6,'2018-03-12',_binary 'N5BIT0015-N5BIT0031-N5BIT0044-N5BIT0049',_binary 'N5BIT0015-N5BIT0031-N5BIT0044-N5BIT0049',_binary 'N5BIT0015-N5BIT0031-N5BIT0044-N5BIT0049',_binary 'N5BIT0015-N5BIT0031-N5BIT0044-N5BIT0049',_binary 'N5BIT0015-N5BIT0031-N5BIT0044-N5BIT0049',_binary 'N5BIT0015-N5BIT0031-N5BIT0044-N5BIT0049'),(2015,'B.Sc(IT)',6,'2018-03-13',_binary 'N5BIT0016',_binary 'N5BIT0016',_binary 'N5BIT0016',_binary 'N5BIT0016',_binary 'N5BIT0016',_binary 'N5BIT0016'),(2015,'B.Sc(IT)',6,'2018-03-14',_binary 'N5BIT0037-N5BIT0042-N5BIT0052-N5BIT0060',_binary 'N5BIT0037-N5BIT0042-N5BIT0052-N5BIT0060',_binary 'N5BIT0037-N5BIT0042-N5BIT0052-N5BIT0060',_binary 'N5BIT0037-N5BIT0042-N5BIT0052-N5BIT0060',_binary 'N5BIT0037-N5BIT0042-N5BIT0052-N5BIT0060',_binary 'N5BIT0037-N5BIT0042-N5BIT0052-N5BIT0060'),(2015,'B.Sc(IT)',6,'2018-03-15',_binary 'N5BIT0046',_binary 'N5BIT0046',_binary 'N5BIT0046',_binary 'N5BIT0046',_binary 'N5BIT0046',_binary 'N5BIT0046'),(2015,'B.Sc(IT)',6,'2018-03-16','','','','','',''),(2015,'B.Sc(IT)',6,'2018-03-19',_binary 'N5BIT0031',_binary 'N5BIT0031',_binary 'N5BIT0031',_binary 'N5BIT0031',_binary 'N5BIT0031',_binary 'N5BIT0031'),(2015,'B.Sc(IT)',6,'2018-03-20',_binary 'N5BIT0034-N5BIT0036',_binary 'N5BIT0034-N5BIT0036',_binary 'N5BIT0034-N5BIT0036',_binary 'N5BIT0034-N5BIT0036',_binary 'N5BIT0034-N5BIT0036',_binary 'N5BIT0034-N5BIT0036'),(2015,'B.Sc(IT)',6,'2018-03-21',_binary 'N5BIT0020-N5BIT0036-N5BIT0047',_binary 'N5BIT0020-N5BIT0036-N5BIT0047',_binary 'N5BIT0020-N5BIT0036-N5BIT0047',_binary 'N5BIT0020-N5BIT0036-N5BIT0047',_binary 'N5BIT0020-N5BIT0036-N5BIT0047',_binary 'N5BIT0020-N5BIT0036-N5BIT0047'),(2015,'B.Sc(IT)',6,'2018-03-22',_binary 'N5BIT0047-N5BIT0056',_binary 'N5BIT0047-N5BIT0056',_binary 'N5BIT0047-N5BIT0056',_binary 'N5BIT0047-N5BIT0056',_binary 'N5BIT0047-N5BIT0056',_binary 'N5BIT0047-N5BIT0056'),(2015,'B.Sc(IT)',6,'2018-03-23',_binary 'N5BIT0036-N5BIT0047',_binary 'N5BIT0036-N5BIT0047',_binary 'N5BIT0036-N5BIT0047',_binary 'N5BIT0036-N5BIT0047',_binary 'N5BIT0036-N5BIT0047',_binary 'N5BIT0036-N5BIT0047'),(2015,'B.Sc(IT)',6,'2018-03-24',_binary 'N5BIT0012-N5BIT0020-N5BIT0028-N5BIT0036-N5BIT0043-N5BIT0047',_binary 'N5BIT0012-N5BIT0020-N5BIT0028-N5BIT0036-N5BIT0043-N5BIT0047',_binary 'N5BIT0012-N5BIT0020-N5BIT0028-N5BIT0036-N5BIT0043-N5BIT0047',_binary 'N5BIT0012-N5BIT0020-N5BIT0028-N5BIT0036-N5BIT0043-N5BIT0047',_binary 'N5BIT0012-N5BIT0020-N5BIT0028-N5BIT0036-N5BIT0043-N5BIT0047',_binary 'N5BIT0012-N5BIT0020-N5BIT0028-N5BIT0036-N5BIT0043-N5BIT0047'),(2015,'B.Sc(IT)',6,'2018-03-26',_binary 'N5BIT0006-N5BIT0008-N5BIT0016-N5BIT0047',_binary 'N5BIT0006-N5BIT0008-N5BIT0016-N5BIT0047',_binary 'N5BIT0006-N5BIT0008-N5BIT0016-N5BIT0047',_binary 'N5BIT0006-N5BIT0008-N5BIT0016-N5BIT0047',_binary 'N5BIT0006-N5BIT0008-N5BIT0016-N5BIT0047',_binary 'N5BIT0006-N5BIT0008-N5BIT0016-N5BIT0047'),(2015,'B.Sc(IT)',6,'2018-03-27','','','','','',''),(2015,'B.Sc(IT)',6,'2018-03-28','','','','','',''),(2015,'B.Sc(IT)',6,'2018-04-02','','','','','',''),(2015,'B.Sc(IT)',6,'2018-04-03',_binary 'N5BIT0004-N5BIT0006-N5BIT0008-N5BIT0009-N5BIT0011-N5BIT0012-N5BIT0013-N5BIT0015-N5BIT0016-N5BIT0017-N5BIT0018-N5BIT0024-N5BIT0025-N5BIT0028-N5BIT0031-N5BIT0032-N5BIT0036-N5BIT0042-N5BIT0044-N5BIT0047-N5BIT0049-N5BIT0056-N5BIT0059-N5BIT0061-N5BIT0063',_binary 'N5BIT0004-N5BIT0006-N5BIT0008-N5BIT0009-N5BIT0011-N5BIT0012-N5BIT0013-N5BIT0015-N5BIT0016-N5BIT0017-N5BIT0018-N5BIT0024-N5BIT0025-N5BIT0028-N5BIT0031-N5BIT0032-N5BIT0036-N5BIT0042-N5BIT0044-N5BIT0047-N5BIT0049-N5BIT0056-N5BIT0059-N5BIT0061-N5BIT0063',_binary 'N5BIT0004-N5BIT0006-N5BIT0008-N5BIT0009-N5BIT0011-N5BIT0012-N5BIT0013-N5BIT0015-N5BIT0016-N5BIT0017-N5BIT0018-N5BIT0024-N5BIT0025-N5BIT0028-N5BIT0031-N5BIT0032-N5BIT0036-N5BIT0042-N5BIT0044-N5BIT0047-N5BIT0049-N5BIT0056-N5BIT0059-N5BIT0061-N5BIT0063',_binary 'N5BIT0004-N5BIT0006-N5BIT0008-N5BIT0009-N5BIT0011-N5BIT0012-N5BIT0013-N5BIT0015-N5BIT0016-N5BIT0017-N5BIT0018-N5BIT0024-N5BIT0025-N5BIT0028-N5BIT0031-N5BIT0032-N5BIT0036-N5BIT0042-N5BIT0044-N5BIT0047-N5BIT0049-N5BIT0056-N5BIT0059-N5BIT0061-N5BIT0063',_binary 'N5BIT0004-N5BIT0006-N5BIT0008-N5BIT0009-N5BIT0011-N5BIT0012-N5BIT0013-N5BIT0015-N5BIT0016-N5BIT0017-N5BIT0018-N5BIT0024-N5BIT0025-N5BIT0028-N5BIT0031-N5BIT0032-N5BIT0036-N5BIT0042-N5BIT0044-N5BIT0047-N5BIT0049-N5BIT0056-N5BIT0059-N5BIT0061-N5BIT0063',_binary 'N5BIT0004-N5BIT0006-N5BIT0008-N5BIT0009-N5BIT0011-N5BIT0012-N5BIT0013-N5BIT0015-N5BIT0016-N5BIT0017-N5BIT0018-N5BIT0024-N5BIT0025-N5BIT0028-N5BIT0031-N5BIT0032-N5BIT0036-N5BIT0042-N5BIT0044-N5BIT0047-N5BIT0049-N5BIT0056-N5BIT0059-N5BIT0061-N5BIT0063');
/*!40000 ALTER TABLE `2015yearattendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `2016`
--

DROP TABLE IF EXISTS `2016`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2016` (
  `Batch` int DEFAULT NULL,
  `sem` int DEFAULT NULL,
  `exam_type` varchar(15) DEFAULT NULL,
  `RegNo` varchar(10) DEFAULT NULL,
  `mark` varchar(30) DEFAULT NULL,
  `decided` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `2016`
--

LOCK TABLES `2016` WRITE;
/*!40000 ALTER TABLE `2016` DISABLE KEYS */;
/*!40000 ALTER TABLE `2016` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `2016assignment`
--

DROP TABLE IF EXISTS `2016assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2016assignment` (
  `Batch` int DEFAULT NULL,
  `sem` int DEFAULT NULL,
  `RegNo` varchar(10) DEFAULT NULL,
  `ass_mark` varchar(30) DEFAULT NULL,
  `decided` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `2016assignment`
--

LOCK TABLES `2016assignment` WRITE;
/*!40000 ALTER TABLE `2016assignment` DISABLE KEYS */;
/*!40000 ALTER TABLE `2016assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `2016attendance`
--

DROP TABLE IF EXISTS `2016attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2016attendance` (
  `Batch` int DEFAULT NULL,
  `sem` int DEFAULT NULL,
  `RegNo` varchar(10) DEFAULT NULL,
  `tot_working_days` int DEFAULT NULL,
  `no_day_present` int DEFAULT NULL,
  `decided` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `2016attendance`
--

LOCK TABLES `2016attendance` WRITE;
/*!40000 ALTER TABLE `2016attendance` DISABLE KEYS */;
/*!40000 ALTER TABLE `2016attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `2016lab`
--

DROP TABLE IF EXISTS `2016lab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2016lab` (
  `Batch` int DEFAULT NULL,
  `sem` int DEFAULT NULL,
  `Type` varchar(15) DEFAULT NULL,
  `RegNo` varchar(10) DEFAULT NULL,
  `mark` varchar(30) DEFAULT NULL,
  `decided` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `2016lab`
--

LOCK TABLES `2016lab` WRITE;
/*!40000 ALTER TABLE `2016lab` DISABLE KEYS */;
/*!40000 ALTER TABLE `2016lab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `2016studassignmentmark`
--

DROP TABLE IF EXISTS `2016studassignmentmark`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2016studassignmentmark` (
  `Regno` varchar(20) DEFAULT NULL,
  `Batch` int DEFAULT NULL,
  `Dept` varchar(20) DEFAULT NULL,
  `semester` int DEFAULT NULL,
  `Course` varchar(20) DEFAULT NULL,
  `number` int DEFAULT NULL,
  `mark` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `2016studassignmentmark`
--

LOCK TABLES `2016studassignmentmark` WRITE;
/*!40000 ALTER TABLE `2016studassignmentmark` DISABLE KEYS */;
INSERT INTO `2016studassignmentmark` VALUES ('N6BIT0001',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0002',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0003',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0004',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0005',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0006',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0007',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0008',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0009',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0010',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0011',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0012',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0013',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0014',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0015',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0016',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0017',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0018',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0019',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0020',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0021',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0023',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0025',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0026',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0027',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0029',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0031',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0032',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0033',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0034',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0035',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0036',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0037',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0038',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0039',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0040',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0041',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0042',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0043',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0044',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0046',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0047',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0048',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0049',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0050',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0051',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0052',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0053',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0054',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0055',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0056',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0057',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0058',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0059',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0060',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0061',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0),('N6BIT0062',2016,'B.Sc(IT)',3,'N5BIT3T75-0',1,0);
/*!40000 ALTER TABLE `2016studassignmentmark` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `2016yearattendance`
--

DROP TABLE IF EXISTS `2016yearattendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2016yearattendance` (
  `Batch` int DEFAULT NULL,
  `Course` varchar(20) DEFAULT NULL,
  `semester` int DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Ihour` blob,
  `IIhour` blob,
  `IIIhour` blob,
  `IVhour` blob,
  `Vhour` blob,
  `VIhour` blob
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `2016yearattendance`
--

LOCK TABLES `2016yearattendance` WRITE;
/*!40000 ALTER TABLE `2016yearattendance` DISABLE KEYS */;
INSERT INTO `2016yearattendance` VALUES (2016,'B.Sc(IT)',3,'2017-09-01',_binary 'N6BIT0004-N6BIT0008-N6BIT0026-N6BIT0036-N6BIT0046-N6BIT0056-N6BIT0058-N6BIT0059-N6BIT0060',_binary 'N6BIT0004-N6BIT0008-N6BIT0026-N6BIT0036-N6BIT0046-N6BIT0056-N6BIT0058-N6BIT0059-N6BIT0060',_binary 'N6BIT0004-N6BIT0008-N6BIT0026-N6BIT0036-N6BIT0046-N6BIT0056-N6BIT0058-N6BIT0059-N6BIT0060',_binary 'N6BIT0004-N6BIT0008-N6BIT0026-N6BIT0036-N6BIT0046-N6BIT0050-N6BIT0055-N6BIT0056-N6BIT0058-N6BIT0059-N6BIT0060',_binary 'N6BIT0004-N6BIT0008-N6BIT0026-N6BIT0036-N6BIT0046-N6BIT0050-N6BIT0055-N6BIT0056-N6BIT0058-N6BIT0059-N6BIT0060',_binary 'N6BIT0004-N6BIT0008-N6BIT0026-N6BIT0036-N6BIT0046-N6BIT0050-N6BIT0055-N6BIT0056-N6BIT0058-N6BIT0059-N6BIT0060'),(2016,'B.Sc(IT)',3,'2017-10-26','',_binary 'N6BIT0057','','','','');
/*!40000 ALTER TABLE `2016yearattendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `2017`
--

DROP TABLE IF EXISTS `2017`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2017` (
  `Batch` int DEFAULT NULL,
  `sem` int DEFAULT NULL,
  `exam_type` varchar(15) DEFAULT NULL,
  `RegNo` varchar(10) DEFAULT NULL,
  `mark` varchar(30) DEFAULT NULL,
  `decided` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `2017`
--

LOCK TABLES `2017` WRITE;
/*!40000 ALTER TABLE `2017` DISABLE KEYS */;
/*!40000 ALTER TABLE `2017` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `2017assignment`
--

DROP TABLE IF EXISTS `2017assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2017assignment` (
  `Batch` int DEFAULT NULL,
  `sem` int DEFAULT NULL,
  `RegNo` varchar(10) DEFAULT NULL,
  `ass_mark` varchar(30) DEFAULT NULL,
  `decided` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `2017assignment`
--

LOCK TABLES `2017assignment` WRITE;
/*!40000 ALTER TABLE `2017assignment` DISABLE KEYS */;
/*!40000 ALTER TABLE `2017assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `2017attendance`
--

DROP TABLE IF EXISTS `2017attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2017attendance` (
  `Batch` int DEFAULT NULL,
  `sem` int DEFAULT NULL,
  `RegNo` varchar(10) DEFAULT NULL,
  `tot_working_days` int DEFAULT NULL,
  `no_day_present` int DEFAULT NULL,
  `decided` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `2017attendance`
--

LOCK TABLES `2017attendance` WRITE;
/*!40000 ALTER TABLE `2017attendance` DISABLE KEYS */;
/*!40000 ALTER TABLE `2017attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `2017lab`
--

DROP TABLE IF EXISTS `2017lab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2017lab` (
  `Batch` int DEFAULT NULL,
  `sem` int DEFAULT NULL,
  `Type` varchar(15) DEFAULT NULL,
  `RegNo` varchar(10) DEFAULT NULL,
  `mark` varchar(30) DEFAULT NULL,
  `decided` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `2017lab`
--

LOCK TABLES `2017lab` WRITE;
/*!40000 ALTER TABLE `2017lab` DISABLE KEYS */;
/*!40000 ALTER TABLE `2017lab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `2017studassignmentmark`
--

DROP TABLE IF EXISTS `2017studassignmentmark`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2017studassignmentmark` (
  `Regno` varchar(20) DEFAULT NULL,
  `Batch` int DEFAULT NULL,
  `Dept` varchar(20) DEFAULT NULL,
  `semester` int DEFAULT NULL,
  `Course` varchar(20) DEFAULT NULL,
  `number` int DEFAULT NULL,
  `mark` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `2017studassignmentmark`
--

LOCK TABLES `2017studassignmentmark` WRITE;
/*!40000 ALTER TABLE `2017studassignmentmark` DISABLE KEYS */;
/*!40000 ALTER TABLE `2017studassignmentmark` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `2017yearattendance`
--

DROP TABLE IF EXISTS `2017yearattendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2017yearattendance` (
  `Batch` int DEFAULT NULL,
  `Course` varchar(20) DEFAULT NULL,
  `semester` int DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Ihour` blob,
  `IIhour` blob,
  `IIIhour` blob,
  `IVhour` blob,
  `Vhour` blob,
  `VIhour` blob
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `2017yearattendance`
--

LOCK TABLES `2017yearattendance` WRITE;
/*!40000 ALTER TABLE `2017yearattendance` DISABLE KEYS */;
INSERT INTO `2017yearattendance` VALUES (2017,'B.Sc(IT)',1,'2017-10-17',_binary 'N7BIT0001',_binary 'N7BIT0001','','','',''),(2017,'B.Sc(IT)',5,'2017-11-02',_binary 'N7BIT0003',_binary 'N7BIT0003',_binary 'N7BIT0003',_binary 'N7BIT0004',_binary 'N7BIT0004',_binary 'N7BIT0004'),(2017,'B.Sc(IT)',5,'2018-01-03','','','','','','');
/*!40000 ALTER TABLE `2017yearattendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `2018yearattendance`
--

DROP TABLE IF EXISTS `2018yearattendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2018yearattendance` (
  `Batch` int DEFAULT NULL,
  `Course` varchar(20) DEFAULT NULL,
  `semester` int DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Ihour` blob,
  `IIhour` blob,
  `IIIhour` blob,
  `IVhour` blob,
  `Vhour` blob,
  `VIhour` blob
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `2018yearattendance`
--

LOCK TABLES `2018yearattendance` WRITE;
/*!40000 ALTER TABLE `2018yearattendance` DISABLE KEYS */;
/*!40000 ALTER TABLE `2018yearattendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `2106attendance`
--

DROP TABLE IF EXISTS `2106attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2106attendance` (
  `Batch` int DEFAULT NULL,
  `sem` int DEFAULT NULL,
  `RegNo` varchar(10) DEFAULT NULL,
  `tot_working_days` int DEFAULT NULL,
  `no_day_present` int DEFAULT NULL,
  `decided` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `2106attendance`
--

LOCK TABLES `2106attendance` WRITE;
/*!40000 ALTER TABLE `2106attendance` DISABLE KEYS */;
/*!40000 ALTER TABLE `2106attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `achievement`
--

DROP TABLE IF EXISTS `achievement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `achievement` (
  `Name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `achievement`
--

LOCK TABLES `achievement` WRITE;
/*!40000 ALTER TABLE `achievement` DISABLE KEYS */;
INSERT INTO `achievement` VALUES ('Inter College meet'),('Workshop'),('Conference'),('online course');
/*!40000 ALTER TABLE `achievement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `addstaff`
--

DROP TABLE IF EXISTS `addstaff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `addstaff` (
  `SID` varchar(15) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Department` varchar(30) NOT NULL,
  `Designation` varchar(30) NOT NULL,
  `Emailid` varchar(30) NOT NULL,
  `Password` varchar(25) NOT NULL,
  PRIMARY KEY (`SID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addstaff`
--

LOCK TABLES `addstaff` WRITE;
/*!40000 ALTER TABLE `addstaff` DISABLE KEYS */;
INSERT INTO `addstaff` VALUES ('bit0023','ram kumar d','BSC(cs)','ap','ram@gmail.com','Arx6ThS%'),('BSCCS16','C.Akila','B.Sc(IT)','HOD','akila_cp@yahoo.co.in','akila'),('BSCCS39','Vignesh Ramamoorthy. H','B.Sc (CS)','Assistant Professor','vigneshramamoorthy@stc.ac.in','123456'),('bscct19','p.shobana','B.Sc(IT)','Assistant professor','shobanap@stc.ac.in','123'),('BSCIT002','Murugesan ','B.Sc(IT)','Assistant Professor','murugesan_g29@yahoo.com','2'),('MCA21','Dhanaraj','B.Sc(IT)','Ass.professor','dhanarajstc@stc.ac.in','UGQy34iL'),('MSC32','Parameswari','B.Sc(IT)','Asst Professor','parameswari@stc.ac.in','stcp'),('tpc01','karthi','placement','director','tpc01@stc.ac.in','tpc'),('tpc02','sridhar','placement','assistantstaff','tpc02@stc.ac.in','tpc');
/*!40000 ALTER TABLE `addstaff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `Username` varchar(25) NOT NULL,
  `Password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES ('admin','stc');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `association`
--

DROP TABLE IF EXISTS `association`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `association` (
  `Association_Name` varchar(20) NOT NULL,
  `Department` varchar(10) NOT NULL,
  `Description` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `association`
--

LOCK TABLES `association` WRITE;
/*!40000 ALTER TABLE `association` DISABLE KEYS */;
INSERT INTO `association` VALUES ('edit','B.Sc(IT)','best');
/*!40000 ALTER TABLE `association` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `associationactivities`
--

DROP TABLE IF EXISTS `associationactivities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `associationactivities` (
  `Association_Name` varchar(20) NOT NULL,
  `Department` varchar(10) NOT NULL,
  `Date` date NOT NULL,
  `Title` varchar(40) NOT NULL,
  `Resource_person` varchar(50) NOT NULL,
  `Designation` varchar(50) NOT NULL,
  `Address` varchar(60) NOT NULL,
  `Mobile` varchar(10) NOT NULL,
  `Type` varchar(15) NOT NULL,
  `photos` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `associationactivities`
--

LOCK TABLES `associationactivities` WRITE;
/*!40000 ALTER TABLE `associationactivities` DISABLE KEYS */;
/*!40000 ALTER TABLE `associationactivities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `associationmember`
--

DROP TABLE IF EXISTS `associationmember`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `associationmember` (
  `Association_Name` varchar(20) NOT NULL,
  `Department` varchar(10) NOT NULL,
  `Year` varchar(10) NOT NULL,
  `President` varchar(50) NOT NULL,
  `Vice_president` varchar(50) NOT NULL,
  `Secratary` varchar(50) NOT NULL,
  `Treasurer` varchar(80) NOT NULL,
  `Editor` varchar(80) NOT NULL,
  `President_photo` varchar(50) NOT NULL,
  `Vice_presidentphoto` varchar(50) NOT NULL,
  `Secrataryphoto` varchar(50) NOT NULL,
  `Treasurerphoto` varchar(100) NOT NULL,
  `Editorphoto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `associationmember`
--

LOCK TABLES `associationmember` WRITE;
/*!40000 ALTER TABLE `associationmember` DISABLE KEYS */;
INSERT INTO `associationmember` VALUES ('edit','B.Sc(IT)','2018','a','b','c','d','e','upload/nature-hd-background-preview-3.jpg','upload/nature-hd-background-preview-8.jpg','upload/nature-hd-background-preview-19.jpg','upload/nature-hd-background-preview-12.jpg','upload/nature-hd-background-preview-13.jpg');
/*!40000 ALTER TABLE `associationmember` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classincharge`
--

DROP TABLE IF EXISTS `classincharge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `classincharge` (
  `Batch` int NOT NULL,
  `Department` varchar(10) NOT NULL,
  `sem` int NOT NULL,
  `SID` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classincharge`
--

LOCK TABLES `classincharge` WRITE;
/*!40000 ALTER TABLE `classincharge` DISABLE KEYS */;
INSERT INTO `classincharge` VALUES (2016,'B.Sc(IT)',2,'MSC10'),(2014,'B.Sc(IT)',6,'bscct19'),(2015,'B.Sc(IT)',5,'BSCIT002'),(2015,'B.Sc(IT)',6,'BSCIT002');
/*!40000 ALTER TABLE `classincharge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coe`
--

DROP TABLE IF EXISTS `coe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coe` (
  `id` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coe`
--

LOCK TABLES `coe` WRITE;
/*!40000 ALTER TABLE `coe` DISABLE KEYS */;
INSERT INTO `coe` VALUES ('COE','stc');
/*!40000 ALTER TABLE `coe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `complaint`
--

DROP TABLE IF EXISTS `complaint`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `complaint` (
  `Complaint_ID` varchar(20) NOT NULL,
  `Batch` int NOT NULL,
  `Department` varchar(10) NOT NULL,
  `Type` varchar(10) NOT NULL,
  `Complaint_To` varchar(40) NOT NULL,
  `Description` varchar(70) NOT NULL,
  `class_no` varchar(5) NOT NULL,
  `Date` date NOT NULL,
  `Status` varchar(10) NOT NULL,
  `solved_description` varchar(60) NOT NULL,
  `rdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `complaint`
--

LOCK TABLES `complaint` WRITE;
/*!40000 ALTER TABLE `complaint` DISABLE KEYS */;
INSERT INTO `complaint` VALUES ('c1',2015,'B.Sc(IT)','clean','classincharge','not clean','306','2018-02-14','Resolved','Resolved by admin.','2026-03-17'),('c2',2015,'B.Sc(IT)','discipline','hod','prb','','2018-02-14','resolved','solv','2018-02-14'),('c4',2015,'B.Sc(IT)','discipline','classincharge','not good','','2018-02-14','resolved','jb','2018-02-14'),('c4',2015,'B.Sc(IT)','discipline','hod','not good','','2018-02-14','resolved','jb','2018-02-14'),('c5',2015,'B.Sc(IT)','clean','classincharge','not cleaned','306','2018-02-14','notsolved','','0000-00-00'),('c5',2015,'B.Sc(IT)','clean','hod','not cleaned','306','2018-02-14','notsolved','','0000-00-00'),('STCS394785',2026,'B.Sc (CS)','Infrastruc','HOD','broken desk','104','2026-03-17','Resolved','i fix it','2026-03-17');
/*!40000 ALTER TABLE `complaint` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coursedetails`
--

DROP TABLE IF EXISTS `coursedetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coursedetails` (
  `Programme` varchar(30) NOT NULL,
  `Department` varchar(30) NOT NULL,
  `Branchtype` varchar(30) NOT NULL,
  `Shortform` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coursedetails`
--

LOCK TABLES `coursedetails` WRITE;
/*!40000 ALTER TABLE `coursedetails` DISABLE KEYS */;
INSERT INTO `coursedetails` VALUES ('B.Sc(CS)','Computer Science','Regular','cs'),('B.Sc(IT)','Information Technology','Regular','BIT'),('B.Sc(CT)','COMPUTER TECHNOLOGY','Regular','BCT'),('Bcom','commerce','Regular','com'),('BCA','BCA','Regular','bca');
/*!40000 ALTER TABLE `coursedetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cycletest_1`
--

DROP TABLE IF EXISTS `cycletest_1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cycletest_1` (
  `Batch` int NOT NULL,
  `sem` int NOT NULL,
  `Programme_Name` varchar(30) NOT NULL,
  `CourseID` varchar(30) NOT NULL,
  `C1_Date` date NOT NULL,
  `max_mark` int NOT NULL,
  `pass_mark` int NOT NULL,
  `decided` varchar(2) NOT NULL,
  PRIMARY KEY (`CourseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cycletest_1`
--

LOCK TABLES `cycletest_1` WRITE;
/*!40000 ALTER TABLE `cycletest_1` DISABLE KEYS */;
INSERT INTO `cycletest_1` VALUES (2014,6,'B.Sc(IT)','BIT6T61','2017-03-06',50,20,'n'),(2014,6,'B.Sc(IT)','BIT6T62','2017-03-07',50,20,'n'),(2014,6,'B.Sc(IT)','BIT6T63','2017-03-08',50,20,'n'),(2014,6,'B.Sc(IT)','BIT6T64','2017-03-09',50,20,'n'),(2015,5,'B.Sc(IT)','N5BIT5P46','2017-08-04',50,20,'n'),(2015,5,'B.Sc(IT)','N5BIT5P93','2017-08-01',50,20,'n'),(2015,5,'B.Sc(IT)','N5BIT5T25','2017-08-03',50,20,'n'),(2015,5,'B.Sc(IT)','N5BIT5T27','2017-08-07',50,20,'n'),(2015,5,'B.Sc(IT)','N5BIT5T41','2017-07-31',50,20,'n'),(2015,5,'B.Sc(IT)','N5BIT5T44','2017-08-02',50,20,'n'),(2015,5,'B.Sc(IT)','N5BIT5T92','2017-08-01',50,20,'n'),(2015,6,'B.Sc(IT)','N5BIT6P42','2018-02-01',50,20,'n'),(2015,6,'B.Sc(IT)','N5BIT6P56','2018-02-02',50,20,'n'),(2015,6,'B.Sc(IT)','N5BIT6T41','2018-01-29',50,20,'n'),(2015,6,'B.Sc(IT)','N5BIT6T43','2018-01-30',50,20,'n'),(2015,6,'B.Sc(IT)','N5BIT6T44','2018-01-31',50,20,'n'),(2015,6,'B.Sc(IT)','N5BIT6T55','2018-01-30',50,20,'n');
/*!40000 ALTER TABLE `cycletest_1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cycletest_2`
--

DROP TABLE IF EXISTS `cycletest_2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cycletest_2` (
  `Batch` int NOT NULL,
  `sem` int NOT NULL,
  `Programme_Name` varchar(30) NOT NULL,
  `CourseID` varchar(30) NOT NULL,
  `C2_Date` date NOT NULL,
  `max_mark` int NOT NULL,
  `pass_mark` int NOT NULL,
  `decided` varchar(2) NOT NULL,
  PRIMARY KEY (`CourseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cycletest_2`
--

LOCK TABLES `cycletest_2` WRITE;
/*!40000 ALTER TABLE `cycletest_2` DISABLE KEYS */;
INSERT INTO `cycletest_2` VALUES (2014,6,'B.Sc(IT)','BIT6T61','2017-03-16',50,20,'n'),(2014,6,'B.Sc(IT)','BIT6T62','2017-03-17',50,20,'n'),(2014,6,'B.Sc(IT)','BIT6T63','2017-03-18',50,20,'n'),(2014,6,'B.Sc(IT)','BIT6T64','2017-03-20',50,20,'n'),(2015,5,'B.Sc(IT)','N5BIT5P46','2017-09-25',50,20,'n'),(2015,5,'B.Sc(IT)','N5BIT5P93','2017-09-14',50,20,'n'),(2015,5,'B.Sc(IT)','N5BIT5T25','2017-09-29',50,20,'n'),(2015,5,'B.Sc(IT)','N5BIT5T27','2017-09-21',50,20,'n'),(2015,5,'B.Sc(IT)','N5BIT5T41','2017-09-25',50,20,'n'),(2015,5,'B.Sc(IT)','N5BIT5T44','2017-09-23',50,20,'n'),(2015,5,'B.Sc(IT)','N5BIT5T92','2017-09-22',50,20,'n'),(2015,6,'B.Sc(IT)','N5BIT6P42','2018-03-13',50,20,'n'),(2015,6,'B.Sc(IT)','N5BIT6P56','2018-03-22',50,20,'n'),(2015,6,'B.Sc(IT)','N5BIT6T41','2018-03-15',50,20,'n'),(2015,6,'B.Sc(IT)','N5BIT6T43','2018-03-20',50,20,'n'),(2015,6,'B.Sc(IT)','N5BIT6T44','2018-03-13',50,20,'n'),(2015,6,'B.Sc(IT)','N5BIT6T55','2018-03-19',50,20,'n');
/*!40000 ALTER TABLE `cycletest_2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `EventID` int NOT NULL AUTO_INCREMENT,
  `EventsMsg` varchar(250) NOT NULL,
  PRIMARY KEY (`EventID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (5,'IT EXPO');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modelexam`
--

DROP TABLE IF EXISTS `modelexam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `modelexam` (
  `Batch` int NOT NULL,
  `sem` int NOT NULL,
  `Programme_Name` varchar(30) NOT NULL,
  `CourseID` varchar(30) NOT NULL,
  `ME_Date` date NOT NULL,
  `max_mark` int NOT NULL,
  `pass_mark` int NOT NULL,
  `decided` varchar(2) NOT NULL,
  PRIMARY KEY (`CourseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modelexam`
--

LOCK TABLES `modelexam` WRITE;
/*!40000 ALTER TABLE `modelexam` DISABLE KEYS */;
INSERT INTO `modelexam` VALUES (2014,6,'B.Sc(IT)','BIT6T61','2017-04-04',75,30,'n'),(2014,6,'B.Sc(IT)','BIT6T62','2017-04-05',75,30,'n'),(2014,6,'B.Sc(IT)','BIT6T63','2017-04-06',75,30,'n'),(2014,6,'B.Sc(IT)','BIT6T64','2017-04-07',75,30,'n'),(2015,5,'B.Sc(IT)','N5BIT5P46','2017-10-05',75,30,'n'),(2015,5,'B.Sc(IT)','N5BIT5P93','2017-10-06',75,30,'n'),(2015,5,'B.Sc(IT)','N5BIT5T25','2017-10-26',75,30,'n'),(2015,5,'B.Sc(IT)','N5BIT5T27','2017-10-21',75,30,'n'),(2015,5,'B.Sc(IT)','N5BIT5T41','2017-10-23',75,30,'n'),(2015,5,'B.Sc(IT)','N5BIT5T44','2017-10-25',75,30,'n'),(2015,5,'B.Sc(IT)','N5BIT5T92','2017-10-24',75,30,'n');
/*!40000 ALTER TABLE `modelexam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notes` (
  `Batch` varchar(12) NOT NULL,
  `Dept` varchar(20) NOT NULL,
  `sem` int NOT NULL,
  `subject` varchar(60) NOT NULL,
  `notes` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notes`
--

LOCK TABLES `notes` WRITE;
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
INSERT INTO `notes` VALUES ('2015','B.Sc(IT)',5,'N5BIT5T44-3','upload/BASE LOGIC.ppt');
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `otherdept`
--

DROP TABLE IF EXISTS `otherdept`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `otherdept` (
  `Department` varchar(25) NOT NULL,
  `Branchtype` varchar(15) NOT NULL,
  `Shortform` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `otherdept`
--

LOCK TABLES `otherdept` WRITE;
/*!40000 ALTER TABLE `otherdept` DISABLE KEYS */;
INSERT INTO `otherdept` VALUES ('Maintenance','Regular','Maintenance');
/*!40000 ALTER TABLE `otherdept` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `semexam`
--

DROP TABLE IF EXISTS `semexam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `semexam` (
  `Batch` int NOT NULL,
  `Sem` int NOT NULL,
  `Programme_Name` varchar(30) NOT NULL,
  `CourseID` varchar(30) NOT NULL,
  `Sem_Date` date NOT NULL,
  `max_mark` int NOT NULL,
  `pass_mark` int NOT NULL,
  `decided` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `semexam`
--

LOCK TABLES `semexam` WRITE;
/*!40000 ALTER TABLE `semexam` DISABLE KEYS */;
INSERT INTO `semexam` VALUES (2015,5,'B.Sc(IT)','N5BIT5P46','2017-10-11',50,20,'n'),(2015,5,'B.Sc(IT)','N5BIT5P93','2017-10-12',75,30,'n'),(2015,5,'B.Sc(IT)','N5BIT5T25','2017-10-13',75,30,'n'),(2015,5,'B.Sc(IT)','N5BIT5T27','2017-10-14',75,30,'n'),(2015,5,'B.Sc(IT)','N5BIT5T41','2017-10-16',75,30,'n'),(2015,5,'B.Sc(IT)','N5BIT5T44','2017-10-17',75,30,'n'),(2015,5,'B.Sc(IT)','N5BIT5T92','2017-10-18',75,30,'n');
/*!40000 ALTER TABLE `semexam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sixthhour`
--

DROP TABLE IF EXISTS `sixthhour`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sixthhour` (
  `Batch` int NOT NULL,
  `sem` int NOT NULL,
  `Program_Name` varchar(30) NOT NULL,
  `CourseID` varchar(30) NOT NULL,
  `Course_Name` varchar(50) NOT NULL,
  `Type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sixthhour`
--

LOCK TABLES `sixthhour` WRITE;
/*!40000 ALTER TABLE `sixthhour` DISABLE KEYS */;
INSERT INTO `sixthhour` VALUES (2015,5,'B.Sc(IT)','1','TALENTSPRINT','Lab');
/*!40000 ALTER TABLE `sixthhour` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staffallocation`
--

DROP TABLE IF EXISTS `staffallocation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `staffallocation` (
  `Batch` varchar(10) NOT NULL,
  `Academic_year` int NOT NULL,
  `Type` varchar(10) NOT NULL,
  `Department` varchar(10) NOT NULL,
  `Staff_Department` varchar(10) NOT NULL,
  `Sem` int NOT NULL,
  `CourseID` varchar(10) NOT NULL,
  `StaffID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staffallocation`
--

LOCK TABLES `staffallocation` WRITE;
/*!40000 ALTER TABLE `staffallocation` DISABLE KEYS */;
INSERT INTO `staffallocation` VALUES ('2015',2018,'even','B.Sc(IT)','B.Sc(IT)',5,'N5BIT5T25','BSCCS16'),('2015',2018,'even','B.Sc(IT)','B.Sc(IT)',5,'N5BIT5T27','BSCCS16');
/*!40000 ALTER TABLE `staffallocation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staffdetail`
--

DROP TABLE IF EXISTS `staffdetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `staffdetail` (
  `SID` varchar(10) NOT NULL,
  `Qualification` varchar(50) NOT NULL,
  `DOB` date NOT NULL,
  `Address` varchar(200) NOT NULL,
  `Mobileno` bigint NOT NULL,
  `DOJ` date NOT NULL,
  `UGExp` varchar(4) NOT NULL,
  `PGExp` varchar(4) NOT NULL,
  `Industryexp` varchar(4) NOT NULL,
  `Domain` varchar(100) NOT NULL,
  `StaffPhoto` varchar(50) NOT NULL,
  `staffsign` varchar(50) NOT NULL,
  PRIMARY KEY (`SID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staffdetail`
--

LOCK TABLES `staffdetail` WRITE;
/*!40000 ALTER TABLE `staffdetail` DISABLE KEYS */;
INSERT INTO `staffdetail` VALUES ('bscct19','Msc(IT),MPhil','1985-05-10','Pollachi',8877665544,'2012-12-01','0-0','0-0','0-0','Digital rights','upload/bscct19Photo0.jpg','upload/bscct19Sign0.jpg');
/*!40000 ALTER TABLE `staffdetail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staffpp`
--

DROP TABLE IF EXISTS `staffpp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `staffpp` (
  `SID` varchar(15) NOT NULL,
  `Level` varchar(30) NOT NULL,
  `Presentation_Participation` varchar(30) NOT NULL,
  `Program Name` varchar(30) NOT NULL,
  `Title` varchar(30) NOT NULL,
  `Institution Name` varchar(30) NOT NULL,
  `Date` date NOT NULL,
  `Certificate` varchar(50) NOT NULL,
  `Paper` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staffpp`
--

LOCK TABLES `staffpp` WRITE;
/*!40000 ALTER TABLE `staffpp` DISABLE KEYS */;
INSERT INTO `staffpp` VALUES ('bscct19','National','Presentation','Conference','Challenges and Computing Resea','STC','2017-01-11','upload/bscct19PPcer11-01-2017.jpg','upload/bscct19PPpap11-01-2017.jpg');
/*!40000 ALTER TABLE `staffpp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staffpublication`
--

DROP TABLE IF EXISTS `staffpublication`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `staffpublication` (
  `SID` varchar(15) NOT NULL,
  `jptype` varchar(30) NOT NULL,
  `Title` varchar(30) NOT NULL,
  `jpname` varchar(30) NOT NULL,
  `ISBN/ISSN_No` varchar(15) NOT NULL,
  `Impact_No` varchar(15) NOT NULL,
  `Volume` int NOT NULL,
  `Issue` date NOT NULL,
  `Page_No` varchar(15) NOT NULL,
  `Certificate` varchar(50) NOT NULL,
  `Paper` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staffpublication`
--

LOCK TABLES `staffpublication` WRITE;
/*!40000 ALTER TABLE `staffpublication` DISABLE KEYS */;
/*!40000 ALTER TABLE `staffpublication` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staffresearch`
--

DROP TABLE IF EXISTS `staffresearch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `staffresearch` (
  `SID` varchar(15) NOT NULL,
  `Project Type` varchar(30) NOT NULL,
  `Project Title` varchar(30) NOT NULL,
  `Date` date NOT NULL,
  `Agency` varchar(30) NOT NULL,
  `Status` varchar(30) NOT NULL,
  `Fund` int NOT NULL,
  `Date of Completion` date NOT NULL,
  PRIMARY KEY (`SID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staffresearch`
--

LOCK TABLES `staffresearch` WRITE;
/*!40000 ALTER TABLE `staffresearch` DISABLE KEYS */;
/*!40000 ALTER TABLE `staffresearch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staffresult`
--

DROP TABLE IF EXISTS `staffresult`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `staffresult` (
  `SID` varchar(15) NOT NULL,
  `Course Code` varchar(15) NOT NULL,
  `Course Name` varchar(30) NOT NULL,
  `Year` int NOT NULL,
  `Semister` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staffresult`
--

LOCK TABLES `staffresult` WRITE;
/*!40000 ALTER TABLE `staffresult` DISABLE KEYS */;
INSERT INTO `staffresult` VALUES ('bscct19','N4bit4T54','Computer Graphics',2016,'Even');
/*!40000 ALTER TABLE `staffresult` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stafftransfer`
--

DROP TABLE IF EXISTS `stafftransfer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stafftransfer` (
  `Staffid` varchar(15) NOT NULL,
  `Department` varchar(10) NOT NULL,
  `Transferedto` varchar(10) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stafftransfer`
--

LOCK TABLES `stafftransfer` WRITE;
/*!40000 ALTER TABLE `stafftransfer` DISABLE KEYS */;
INSERT INTO `stafftransfer` VALUES ('BSCIT002','B.Sc(IT)','B.Sc(CT)','2018-02-06'),('BSCIT002','B.Sc(CT)','B.Sc(IT)','2018-02-06');
/*!40000 ALTER TABLE `stafftransfer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staffworkshop`
--

DROP TABLE IF EXISTS `staffworkshop`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `staffworkshop` (
  `SID` varchar(15) NOT NULL,
  `Event` varchar(30) NOT NULL,
  `Program Name` varchar(30) NOT NULL,
  `Institution Name` varchar(30) NOT NULL,
  `Sdate` date NOT NULL,
  `Edate` date NOT NULL,
  `Certificate` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staffworkshop`
--

LOCK TABLES `staffworkshop` WRITE;
/*!40000 ALTER TABLE `staffworkshop` DISABLE KEYS */;
INSERT INTO `staffworkshop` VALUES ('BSCIT002','Workshop','Big Data Analytics','NGM','2017-08-24','2017-08-24','upload/BSCIT002WScer24-08-2017.jpg');
/*!40000 ALTER TABLE `staffworkshop` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student` (
  `RegNo` varchar(10) NOT NULL,
  `Batch` int NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Department` varchar(20) NOT NULL,
  `Email-id` varchar(35) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`RegNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES ('N4BIT0037',2014,'M.RANGANATHAN','B.Sc(IT)','n4bit0037@stc.ac.in','stc','Alumni'),('N5BIT0001',2015,'R.AADHITYA','B.Sc(IT)','aadhiadhi24@gmail.com','stc','Student'),('N5BIT0002',2015,'M.ABDUL MUTHALIF','B.Sc(IT)','abdulrz0715@gmail.com','stc','Student'),('N5BIT0003',2015,'S.AJITHKUMAR','B.Sc(IT)','ajithaji161993@gmail.com','stc','Student'),('N5BIT0004',2015,'A.AKILANDEESWARI','B.Sc(IT)','akilajan98@gmail.com','stc','Student'),('N5BIT0005',2015,'K.ARUN KUMAR','B.Sc(IT)','arunkumark9801@gmail.com','stc','Student'),('N5BIT0006',2015,'A.BABY','B.Sc(IT)','babyarumugama@gmail.com','stc','Student'),('N5BIT0007',2015,'S.BALAJI','B.Sc(IT)','balasundhar0007@gmail.com','stc','Student'),('N5BIT0008',2015,'S.BIRUNDHA','B.Sc(IT)','birundhasaminathan20@gmail.com','stc','Student'),('N5BIT0009',2015,'S.BIRUNDHA','B.Sc(IT)','brindhabindhuma3@gmail.com','stc','Student'),('N5BIT0010',2015,'R.CHALMAAN KHAAN','B.Sc(IT)','chalmaankhaan@gmail.com','stc','Student'),('N5BIT0011',2015,'M.DEEPIKA','B.Sc(IT)','n5bit0011@stc.ac.in','stc','Student'),('N5BIT0012',2015,'R.DEVARAJ','B.Sc(IT)','devaraj88836@gmail.com','stc','Student'),('N5BIT0013',2015,'S.DEVIDURGA','B.Sc(IT)','durgamani155@gmail.com','stc','Student'),('N5BIT0014',2015,'S.DHANUSH','B.Sc(IT)','rtrdhanush1997@gmail.com','stc','Student'),('N5BIT0015',2015,'B.DHARANI','B.Sc(IT)','dharniramaraj56@gmail.com','stc','Student'),('N5BIT0016',2015,'S.DIVYA','B.Sc(IT)','divyakowsi4@gmail.com','stc','Student'),('N5BIT0017',2015,'P.ELUVANAKUMAR','B.Sc(IT)','eluvana1097@gmail.com','stc','Student'),('N5BIT0018',2015,'K.GOKILA','B.Sc(IT)','nivedhajoe95@gmail.com','stc','Student'),('N5BIT0019',2015,'L.GOWTHAM','B.Sc(IT)','gowthamlamal@gmail.com','stc','Student'),('N5BIT0020',2015,'R.GOWTHAMRAJ','B.Sc(IT)','gowthamramraj007@gmail.com','stc','Student'),('N5BIT0021',2015,'S.HARINIJANDHAN','B.Sc(IT)','hnijandhan@gmail.com','stc','Student'),('N5BIT0022',2015,'V.HARIPRASATH','B.Sc(IT)','hariprasath090298@gmail.com','stc','Student'),('N5BIT0023',2015,'A.JAFFAR ARABIN','B.Sc(IT)','jaffararabin27@gmail.com','stc','Student'),('N5BIT0024',2015,'R.JEEVAN KUMAR','B.Sc(IT)','jevan1297@gmail.com','stc','Student'),('N5BIT0025',2015,'M.JEEVITHA','B.Sc(IT)','jeevithamanikandan16598@gmail.com','stc','Student'),('N5BIT0026',2015,'S.KAILASH','B.Sc(IT)','kailashselvanayagam001@gmail.com','stc','Student'),('N5BIT0027',2015,'A.KARTHIKEYAN','B.Sc(IT)','karthikeyanananth@gmail.com','stc','Student'),('N5BIT0028',2015,'T.KARTHIKEYAN','B.Sc(IT)','n5bit0028@stc.ac.in','stc','Student'),('N5BIT0031',2015,'M.MAHESWARI','B.Sc(IT)','mahesmalini98@gmail.com','stc','Student'),('N5BIT0032',2015,'N.MANIKANDAN','B.Sc(IT)','manikandan28898@gmail.com','stc','Student'),('N5BIT0034',2015,'R.MOTHIL NATHAN','B.Sc(IT)','mothilsm5@gmail.com','stc','Student'),('N5BIT0035',2015,'M.MUGUNTHAN','B.Sc(IT)','mugunthan2manoharan@gmail.com','stc','Student'),('N5BIT0036',2015,'B.MUTHURAMALINGAM','B.Sc(IT)','mraj04252@gmail.com','stc','Student'),('N5BIT0037',2015,'G.NANDHINI','B.Sc(IT)','n5bit0037@stc.ac.in','stc','Student'),('N5BIT0038',2015,'P.NAVANEETHA','B.Sc(IT)','navaneetha0497@gmail.com','stc','Student'),('N5BIT0039',2015,'S.NAVEENA','B.Sc(IT)','navinanavi6@gmail.com','stc','Student'),('N5BIT0040',2015,'N.PRITHIVI','B.Sc(IT)','n5bit0040@stc.ac.in','stc','Student'),('N5BIT0041',2015,'T.RIZVANA BEGAM','B.Sc(IT)','rizvanathajdeen15@gmail.com','stc','Student'),('N5BIT0042',2015,'V.SABARI RAJA','B.Sc(IT)','sabari1398@gmail.com','stc','Student'),('N5BIT0043',2015,'S.SAFNA','B.Sc(IT)','safna1296@gmail.com','stc','Student'),('N5BIT0044',2015,'B.SAKTHIVEL','B.Sc(IT)','sakthihp01@gmail.com','stc','Student'),('N5BIT0046',2015,'B.SANTHOSH KUMAR','B.Sc(IT)','santhoshkumar4598@gmail.com','stc','Student'),('N5BIT0047',2015,'M.SARANYA','B.Sc(IT)','saranya15ms@gmail.com','stc','Student'),('N5BIT0048',2015,'R.SARANYA','B.Sc(IT)','saranyamadhan3012017@gmail.com','stc','Student'),('N5BIT0049',2015,'S.SARMILA','B.Sc(IT)','sarmigavi@gmail.com','stc','Student'),('N5BIT0050',2015,'N.SATHISH KUMAR','B.Sc(IT)','sathishkns13@gmail.com','stc','Student'),('N5BIT0051',2015,'S.SHANMUGAPRIYA','B.Sc(IT)','shanmugapriyajasmineq997@gmail.com','stc','Student'),('N5BIT0052',2015,'V.SRIDHAR','B.Sc(IT)','sridharkrish0131@gmail.com','stc','Student'),('N5BIT0053',2015,'S.SURIYA KUMAR','B.Sc(IT)','suriyaw366@gmail.com','stc','Student'),('N5BIT0055',2015,'M.SURYA KUMAR','B.Sc(IT)','Suryakumar777csk@gmail.com','stc','Student'),('N5BIT0056',2015,'E.TAMILARASU','B.Sc(IT)','tamilarasu5677@gmail.com','stc','Student'),('N5BIT0057',2015,'M.UDHAYAKALIMUTHU','B.Sc(IT)','udhaiudhaya4833@gmail.com','stc','Student'),('N5BIT0058',2015,'V.VAIKUNDARAJ','B.Sc(IT)','vaikundaraj123@gmail.com','stc','Student'),('N5BIT0059',2015,'K.M.VENKATACHALAM','B.Sc(IT)','n5bit0059@stc.ac.in','stc','Student'),('N5BIT0060',2015,'K.VISHNU','B.Sc(IT)','vishnu02deva@gmail.com','stc','Student'),('N5BIT0061',2015,'WAYNE DOMINIC SHELDON PERIERA','B.Sc(IT)','wayneperiera80@gmail.com','stc','Student'),('N5BIT0062',2015,'N.YOGAVARSHINI','B.Sc(IT)','varshiniyy@gmail.com','stc','Student'),('N5BIT0063',2015,'B.YUVARANI','B.Sc(IT)','yuvarani8545@gmail.com','stc','Student'),('N6BIT0001',2016,'ABDULRAHMAN.S','B.Sc(IT)','n6bit0001@stc.ac.in','stc','Student'),('N6BIT0002',2016,'ANANDH KUMAR.S','B.Sc(IT)','n6bit0002@stc.ac.in','stc','Student'),('N6BIT0003',2016,'ANANDHA KUMAR.C','B.Sc(IT)','n6bit0003@stc.ac.in','stc','Student'),('N6BIT0004',2016,'ARCHANA.R','B.Sc(IT)','n6bit0004@stc.ac.in','stc','Student'),('N6BIT0005',2016,'ARULNAMBI.S.T','B.Sc(IT)','n6bit0005@stc.ac.in','stc','Student'),('N6BIT0006',2016,'ARUN PRABAKAR.M','B.Sc(IT)','n6bit0006@stc.ac.in','stc','Student'),('N6BIT0007',2016,'ASHIKA.P','B.Sc(IT)','n6bit0007@stc.ac.in','stc','Student'),('N6BIT0008',2016,'ASHOKKUMAR.S','B.Sc(IT)','n6bit0008@stc.ac.in','stc','Student'),('N6BIT0009',2016,'BALAMURUGAN.R','B.Sc(IT)','n6bit0009@stc.ac.in','stc','Student'),('N6BIT0010',2016,'DHANARAJ.T','B.Sc(IT)','n6bit0010@stc.ac.in','stc','Student'),('N6BIT0011',2016,'DHANYA.M.N','B.Sc(IT)','n6bit0011@stc.ac.in','stc','Student'),('N6BIT0012',2016,'DHAVAPRAKASH.S','B.Sc(IT)','n6bit0012@stc.ac.in','stc','Student'),('N6BIT0013',2016,'DINESH DEEPAKKUMAR.M','B.Sc(IT)','n6bit0013@stc.ac.in','stc','Student'),('N6BIT0014',2016,'DINESH KUMAR.K','B.Sc(IT)','n6bit0014@stc.acin','stc','Student'),('N6BIT0015',2016,'GIRISH.S','B.Sc(IT)','n6bit0015@stc.ac.in','stc','Student'),('N6BIT0016',2016,'GOKULAPRIYA.A','B.Sc(IT)','n6bit0016@stc.ac.in','stc','Student'),('N6BIT0017',2016,'GOVARDHINI.V','B.Sc(IT)','n6bit0017@stc.ac.in','stc','Student'),('N6BIT0018',2016,'GOWTHAMPRASATH.S','B.Sc(IT)','n6bit0018@stc.ac.in','stc','Student'),('N6BIT0019',2016,'ISWARYA.A','B.Sc(IT)','n6bit0019@stc.ac.in','stc','Student'),('N6BIT0020',2016,'JAGAN.J','B.Sc(IT)','n6bit0020@stc.ac.in','stc','Student'),('N6BIT0021',2016,'JANANI.P','B.Sc(IT)','n6bit0021@stc.ac.in','stc','Student'),('N6BIT0023',2016,'JENITHA.D','B.Sc(IT)','n6bit0023@stc.ac.in','stc','Student'),('N6BIT0025',2016,'KARTHIK RAJAN.R','B.Sc(IT)','n6bit0025@stc.ac.in','stc','Student'),('N6BIT0026',2016,'KOWCHIK.V','B.Sc(IT)','n6bit0026@stc.ac.in','stc','Student'),('N6BIT0027',2016,'KOWSALYA.T','B.Sc(IT)','n6bit0027@stc.ac.in','stc','Student'),('N6BIT0029',2016,'MAHALAKSHMI.P','B.Sc(IT)','n6bit0029@stc.ac.in','stc','Student'),('N6BIT0031',2016,'MOHANA.R','B.Sc(IT)','n6bit0031@stc.ac.in','stc','Student'),('N6BIT0032',2016,'MOHANPRABHU.S','B.Sc(IT)','n6bit0032@stc.ac.in','stc','Student'),('N6BIT0033',2016,'MOHANRAJ.S','B.Sc(IT)','n6bit0033@stc.ac.in','stc','Student'),('N6BIT0034',2016,'MONISHA.K','B.Sc(IT)','n6bit0034@stc.ac.in','stc','Student'),('N6BIT0035',2016,'MONOJ PRABAKAR.N','B.Sc(IT)','n6bit0035@stc.ac.in','stc','Student'),('N6BIT0036',2016,'NANDHAKUMAR.S','B.Sc(IT)','n6bit0036@stc.ac.in','stc','Student'),('N6BIT0037',2016,'NANDHINI.M','B.Sc(IT)','n6bit0037@stc.ac.in','stc','Student'),('N6BIT0038',2016,'NAVEEN KUMAR.D','B.Sc(IT)','n6bit0038@stc.ac.in','stc','Student'),('N6BIT0039',2016,'NETHAJI SUBASH CHANORABOS','B.Sc(IT)','n6bit0039@stc.ac.in','stc','Student'),('N6BIT0040',2016,'NITHINMEENAKSHISUNDHARAM','B.Sc(IT)','n6bit0040@stc.ac.in','stc','Student'),('N6BIT0041',2016,'PAVITHRA.P','B.Sc(IT)','n6bit0041@stc.ac.in','stc','Student'),('N6BIT0042',2016,'PAVITHRA.S','B.Sc(IT)','n6bit0042@stc.ac.in','stc','Student'),('N6BIT0043',2016,'PRAVEENKUMAR.R','B.Sc(IT)','n6bit0043@stc.ac.in','stc','Student'),('N6BIT0044',2016,'RAVEENABHARATHI.P','B.Sc(IT)','n6bit004@stc.ac.in','stc','Student'),('N6BIT0046',2016,'SANJAY.J','B.Sc(IT)','n6bit0046@stc.ac.in','stc','Student'),('N6BIT0047',2016,'SARAVANA PRIYAN.J.G','B.Sc(IT)','n6bit0047@stc.ac.in','stc','Student'),('N6BIT0048',2016,'SERMADURAI.C','B.Sc(IT)','n6bit0048@stc.ac.in','stc','Student'),('N6BIT0049',2016,'SHARMILA.V','B.Sc(IT)','n6bit0049@stc.ac.in','stc','Student'),('N6BIT0050',2016,'SITHARA PARVEEN.A','B.Sc(IT)','n6bit0050@stc.ac.in','stc','Student'),('N6BIT0051',2016,'SIVA.D','B.Sc(IT)','n6bit0051@stc.ac.in','stc','Student'),('N6BIT0052',2016,'SIVASANKAVI.N','B.Sc(IT)','n6bit0052@stc.ac.in','stc','Student'),('N6BIT0053',2016,'SIVAVAISHNAWH.N','B.Sc(IT)','n6bit0053@stc.ac.in','stc','Student'),('N6BIT0054',2016,'SORNALAKSHMI.M','B.Sc(IT)','n6bit0054@stc.ac.in','stc','Student'),('N6BIT0055',2016,'SRI RAGAVARSHINI.M','B.Sc(IT)','n6bit0055@stc.ac.in','stc','Student'),('N6BIT0056',2016,'SRIRAM.G.P','B.Sc(IT)','n6bit0056@stc.ac.in','stc','Student'),('N6BIT0057',2016,'SRITHAR.P','B.Sc(IT)','n6bit0057@stc.ac.in','stc','Student'),('N6BIT0058',2016,'VIGNESH KUMAR.M','B.Sc(IT)','n6bit0058@stc.ac.in','stc','Student'),('N6BIT0059',2016,'VIJESH KUMAR.D','B.Sc(IT)','n6bit0059@stc.ac.in','stc','Student'),('N6BIT0060',2016,'VIMALRAJ.C','B.Sc(IT)','n6bit0060@stc.ac.in','stc','Student'),('N6BIT0061',2016,'VISHNUPRASAD.R','B.Sc(IT)','n6bit0061@stc.ac.in','stc','Student'),('N6BIT0062',2016,'VIVEKANANTHAN. D','B.sc(IT)','n6bit0062@stc.ac.in','stc','student'),('N7BIT0001',2017,'AHAMAD SHAFEEQ.M','B.Sc(IT)','n7bit001@stc.ac.in','stc','Student'),('N7BIT0002',2017,'AKILANDEESWARI.S','B.Sc(IT)','n7bit0002@stc.ac.in','stc','Student'),('N7BIT0003',2017,'ANTONYASHIR.S','B.Sc(IT)','n7bit0003@stc.ac.in','stc','Student'),('N7BIT0004',2017,'ARAVINTH KUMAR S','B.Sc(IT)','n7bit0004@stc.ac.in','stc','Student'),('N7BIT0005',2017,'ARAVINTH.S','B.Sc(IT)','n7bit0005@stc.ac.in','stc','Student'),('N7BIT0006',2017,'BALAJI N','B.Sc(IT)','n7bit0006@stc.ac.in','stc','Student'),('N7BIT0007',2017,'BALAKRISHNAN.P','B.Sc(IT)','n7bit0007@stc.ac.in','stc','Student'),('N7BIT0008',2017,'BHUVANESH KUMAR B','B.Sc(IT)','n7bit0008@stc.ac.in','stc','Student'),('N7BIT0009',2017,'BOOBALAKRISHNAN K','B.Sc(IT)','n7bit0009@stc.ac.in','stc','Student'),('N7BIT0010',2017,'GAFFARKHAN.S','B.Sc(IT)','n7bit0010@stc.ac.in','stc','Student'),('N7BIT0011',2017,'GOWTHAMAPRASAD.S','B.Sc(IT)','n7bit0011@stc.ac.in','stc','Student'),('N7BIT0012',2017,'HARIBUVAN.S','B.Sc(IT)','n7bit0012@stc.ac.in','stc','Student'),('N7BIT0013',2017,'JEEVITHA.S','B.Sc(IT)','n7bit0013@stc.ac.in','stc','Student'),('N7BIT0014',2017,'KALAIVANI.S','B.Sc(IT)','n7bit0014@stc.ac.in','stc','Student'),('N7BIT0015',2017,'KANNAN.G','B.Sc(IT)','n7bit0015@stc.ac.in','stc','Student'),('N7BIT0016',2017,'KARTHIK.R','B.Sc(IT)','n7bit0016@stc.ac.in','stc','Student'),('N7BIT0017',2017,'KARUPPUSAMY K','B.Sc(IT)','n7bit0017@stc.ac.in','stc','Student'),('N7BIT0018',2017,'KAVYA.S','B.Sc(IT)','n7bit0018@stc.ac.in','stc','Student'),('N7BIT0019',2017,'KEERTHANA.M','B.Sc(IT)','n7bit0019@stc.ac.in','stc','Student'),('N7BIT0020',2017,'KEERTHANA.S','B.Sc(IT)','n7bit0020@stc.ac.in','stc','Student'),('N7BIT0021',2017,'KIRUTHIGA S','B.Sc(IT)','n7bit0021@stc.ac.in','stc','Student'),('N7BIT0022',2017,'KRISHNAKUMAR.V','B.Sc(IT)','n7bit0022@stc.ac.in','stc','Student'),('N7BIT0023',2017,'LOGABHARATHI.B','B.Sc(IT)','n7bit0023@stc.ac.in','stc','Student'),('N7BIT0024',2017,'LOGARAJ.C','B.Sc(IT)','n7bit0024@stc.ac.in','stc','Student'),('N7BIT0025',2017,'MADHANKUMAR.M','B.Sc(IT)','n7bit0025@stc.ac.in','stc','Student'),('N7BIT0026',2017,'MANIKANDAN.K','B.Sc(IT)','n7bit0026@stc.ac.in','stc','Student'),('N7BIT0027',2017,'MATHAN MURTHI.S','B.Sc(IT)','n7bit0027@stc.ac.in','stc','Student'),('N7BIT0028',2017,'MOHAMED SALEEM.J','B.Sc(IT)','n7bit0028@stc.ac.in','stc','Student'),('N7BIT0029',2017,'MOHAMMED ISHAQ.S.M','B.Sc(IT)','n7bit0029@stc.ac.in','stc','Student'),('N7BIT0030',2017,'MOHAMMED RASOOL.N','B.Sc(IT)','n7bit0030@stc.ac.in','stc','Student'),('N7BIT0031',2017,'MOWNITHA KRISHNAN.S','B.Sc(IT)','n7bit0031@stc.ac.in','stc','Student'),('N7BIT0032',2017,'NAVEENKUMAR.S','B.Sc(IT)','n7bit0032@stc.ac.in','stc','Student'),('N7BIT0033',2017,'PRABAKARAN G','B.Sc(IT)','n7bit0033@stc.ac.in','stc','Student'),('N7BIT0034',2017,'PRASANTH.N','B.Sc(IT)','n7bit0034@stc.ac.in','stc','Student'),('N7BIT0035',2017,'PRAVEENKUMAR.K','B.Sc(IT)','n7bit0035@stc.ac.in','stc','Student'),('N7BIT0036',2017,'PRIYADHARSHINI.T','B.Sc(IT)','n7bit0036@stc.ac.in','stc','Student'),('N7BIT0037',2017,'RAJESHKUMAR.M','B.Sc(IT)','n7bit0037@stc.ac.in','stc','Student'),('N7BIT0038',2017,'SABAREES.K','B.Sc(IT)','n7bit0038@stc.ac.in','stc','Student'),('N7BIT0039',2017,'SARAVANANRAJ.C','B.Sc(IT)','n7bit0039@stc.ac.in','stc','Student'),('N7BIT0040',2017,'SENBAGARAJ.N','B.Sc(IT)','n7bit0040@stc.ac.in','stc','Student'),('N7BIT0041',2017,'SENTHIL KUMAR.A','B.Sc(IT)','n7bit0041@stc.ac.in','stc','Student'),('N7BIT0042',2017,'SHAJANA RAJAN','B.Sc(IT)','n7bit0042@stc.ac.in','stc','Student'),('N7BIT0043',2017,'SHALINI.R.R','B.Sc(IT)','nbit0043@stc.ac.in','stc','Student'),('N7BIT0044',2017,'SHANKARMAHADEVAN.R','B.Sc(IT)','n7bit0044@stc.ac.in','stc','Student'),('N7BIT0045',2017,'SIVAGURU.A','B.Sc(IT)','n7bit0045@stc.ac.in','stc','Student'),('N7BIT0046',2017,'SRIDEVI.S','B.Sc(IT)','n7bit0046@stc.ac.in','stc','Student'),('N7BIT0047',2017,'SWATHI.L','B.Sc(IT)','n7bit0047@stc.ac.in','stc','Student'),('N7BIT0048',2017,'TAMILMANI.A','B.Sc(IT)','n7bit0048@stc.ac.in','stc','Student'),('N7BIT0049',2017,'VIGNESH KUMAR.M','B.Sc(IT)','n7bit0049@stc.ac.in','stc','Student'),('N7BIT0050',2017,'VIGNESH.S','B.Sc(IT)','n7bit0050@stc.ac.in','stc','Student'),('N7BIT0051',2017,'PRABAKAR.K','B.Sc(IT)','n7bit0051@stc.ac.in','stc','Student');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `studentconference`
--

DROP TABLE IF EXISTS `studentconference`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `studentconference` (
  `RegNo` varchar(10) NOT NULL,
  `Level` varchar(20) NOT NULL,
  `Institution_Name` varchar(20) NOT NULL,
  `Date` date NOT NULL,
  `Certificate` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studentconference`
--

LOCK TABLES `studentconference` WRITE;
/*!40000 ALTER TABLE `studentconference` DISABLE KEYS */;
/*!40000 ALTER TABLE `studentconference` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `studenticm`
--

DROP TABLE IF EXISTS `studenticm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `studenticm` (
  `RegNo` varchar(10) NOT NULL,
  `Event_Name` varchar(30) NOT NULL,
  `Place` varchar(30) NOT NULL,
  `Institution_Name` varchar(30) NOT NULL,
  `Date` date NOT NULL,
  `Certificate` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studenticm`
--

LOCK TABLES `studenticm` WRITE;
/*!40000 ALTER TABLE `studenticm` DISABLE KEYS */;
INSERT INTO `studenticm` VALUES ('N6BIT0054','KHO-KHO','II Place','STC','2017-08-28','upload/N6BIT0054icm28-08-2017.jpg');
/*!40000 ALTER TABLE `studenticm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `studentpersonal`
--

DROP TABLE IF EXISTS `studentpersonal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `studentpersonal` (
  `Regno` varchar(30) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Dob` date NOT NULL,
  `Parentsname` varchar(30) NOT NULL,
  `Occupation` varchar(30) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `Pincode` int NOT NULL,
  `Pmobileno` varchar(20) NOT NULL,
  `Mobileno` bigint NOT NULL,
  `AdmissionDate` date NOT NULL,
  `AdmissionNo` int NOT NULL,
  `Emailid` varchar(30) NOT NULL,
  `Nationality` varchar(30) NOT NULL,
  `Community` varchar(30) NOT NULL,
  `Caste` varchar(30) NOT NULL,
  `Gender` varchar(30) NOT NULL,
  `Bgroup` varchar(30) NOT NULL,
  `TenthMark` int NOT NULL,
  `TwelvethMark` int NOT NULL,
  `StudentPhoto` varchar(50) NOT NULL,
  `aadharno` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studentpersonal`
--

LOCK TABLES `studentpersonal` WRITE;
/*!40000 ALTER TABLE `studentpersonal` DISABLE KEYS */;
INSERT INTO `studentpersonal` VALUES ('N5BIT0052','V.SRIDHAR','1995-01-31','R.Venkitapathi','Farmer','Kappinipalayam,Andipalayam(post),Kinathukadavu(Taluk), Coimbatore',642120,'9788607930',7598697514,'0000-00-00',100,'sridharkrish0131@gmail.com','Indian','Hindu','Vadukar','Male','B+ve',419,764,'upload/N5BIT0052Photo0.jpg','640034463264'),('N5BIT0026','S.KAILASH','1997-10-22','D.SELVANAYAGAM','BUSINESS','5/3, NEHRU STREET EAST,\r\nKUMARNANTHAPURAM, TIRUPUR.\r\n',641602,'9894170399',8874966874,'0000-00-00',2218,'kailashselvanayagam001@gmail.c','INDIAN','HINDHU','NADAR','Male','A+',298,952,'upload/N5BIT0026Photo0.jpg','901624676684');
/*!40000 ALTER TABLE `studentpersonal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `studentworkshop`
--

DROP TABLE IF EXISTS `studentworkshop`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `studentworkshop` (
  `RegNo` varchar(10) NOT NULL,
  `Program_Name` varchar(30) NOT NULL,
  `Institution_Name` varchar(30) NOT NULL,
  `Starting_Date` date NOT NULL,
  `Ending_Date` date NOT NULL,
  `Certificate` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studentworkshop`
--

LOCK TABLES `studentworkshop` WRITE;
/*!40000 ALTER TABLE `studentworkshop` DISABLE KEYS */;
INSERT INTO `studentworkshop` VALUES ('N5BIT0001','Private Cloud Setup-OpenStack','MCET','2017-08-18','2017-08-19','upload/N5BIT0001WS18-08-2017.jpg'),('N5BIT0050','Private Cloud Setup-OpenStack','MCET','2017-08-18','2017-08-19','upload/N5BIT0052WS18-08-2017.jpg'),('N5BIT0001','Recent Research Problems in Co','Government of Arts college, Ud','2017-07-28','2017-07-28','upload/N5BIT0001WS28-07-2017.jpg'),('N5BIT0026','Aptitude Shortcut Method','Kongu Engineering College','2017-08-05','2017-08-05','upload/N5BIT0026WS05-08-2017.jpg'),('N5BIT0052','Digital Marketing','SNS college of Technology','2017-08-10','2017-08-11','upload/N5BIT0052WS10-08-2017.jpg'),('N5BIT0019','Private Cloud Setup-OpenStack','MCET','2017-08-18','2017-08-19','upload/N5BIT0019WS18-08-2017.jpg'),('N5BIT0019','Digital Marketing','SNS College of Technology','2017-08-10','2017-08-11','upload/N5BIT0019WS10-08-2017.jpg');
/*!40000 ALTER TABLE `studentworkshop` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subjectdetails`
--

DROP TABLE IF EXISTS `subjectdetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subjectdetails` (
  `Batch` int NOT NULL,
  `sem` int NOT NULL,
  `Programme_Name` varchar(30) NOT NULL,
  `CourseID` varchar(30) NOT NULL,
  `Course_Name` varchar(50) NOT NULL,
  `Type` varchar(30) NOT NULL,
  `Total_Mark` varchar(20) NOT NULL,
  `Credit` int NOT NULL,
  `Part` int NOT NULL,
  `decided` varchar(2) NOT NULL,
  PRIMARY KEY (`CourseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subjectdetails`
--

LOCK TABLES `subjectdetails` WRITE;
/*!40000 ALTER TABLE `subjectdetails` DISABLE KEYS */;
INSERT INTO `subjectdetails` VALUES (2014,6,'B.Sc(IT)','BIT6T61','VB.NET','Theory','75-2.5-2.5-10-5-5',4,3,'n'),(2014,6,'B.Sc(IT)','BIT6T62','POM','Theory','75-2.5-2.5-10-5-5',3,3,'n'),(2014,6,'B.Sc(IT)','BIT6T63','DATAMINING AND WAREHOUSE','Theory','75-2.5-2.5-10-5-5',3,3,'n'),(2014,6,'B.Sc(IT)','BIT6T64','PHP','Theory','75-2.5-2.5-10-5-5',2,4,'n'),(2016,3,'B.Sc(IT)','N5BIT3T75','WEB DEVLOPEMENT','Theory','75-2.5-2.5-10-5-5',2,4,'n'),(2015,5,'B.Sc(IT)','N5BIT5P46','PHP PROGRAMMING LAB','Practical','30-2.5-2.5-5-4-6',2,4,'n'),(2015,5,'B.Sc(IT)','N5BIT5P93','JAVA PROGRAMMING LAB','Practical','60-5-5-10-8-12',5,3,'n'),(2015,5,'B.Sc(IT)','N5BIT5T25','PHP PROGRAMMING','Theory','75-2.5-2.5-10-5-5',2,4,'n'),(2015,5,'B.Sc(IT)','N5BIT5T27','JOB ORIENTED COURSE:MATHEMATIC','Theory','-17.5-17.5-50-10-5',2,4,'n'),(2015,5,'B.Sc(IT)','N5BIT5T41','PRINCIPLES OF DATA COMMUNICATI','Theory','75-2.5-2.5-10-5-5',5,3,'n'),(2015,5,'B.Sc(IT)','N5BIT5T44','ELECTIVE - I','Theory','75-2.5-2.5-10-5-5',5,3,'n'),(2015,5,'B.Sc(IT)','N5BIT5T92','JAVA PROGRAMMING','Theory','75-2.5-2.5-10-5-5',5,3,'n'),(2015,6,'B.Sc(IT)','N5BIT6P42','DOT NET PROGRAMMING LAB','Practical','60-40-2.5-5-4-6',5,3,'n'),(2015,6,'B.Sc(IT)','N5BIT6P56','SOFTWARE TESTING LAB','Practical','60-5-5-10-8-12',2,4,'n'),(2015,6,'B.Sc(IT)','N5BIT6T41','DOT NET PROGRAMMING','Theory','75-2.5-2.5-10-5-5',5,3,'n'),(2015,6,'B.Sc(IT)','N5BIT6T43','DATA MINING AND WAREHOUSING','Theory',' 75-2.5-2.5-10-5-5',5,3,'n'),(2015,6,'B.Sc(IT)','N5BIT6T44','PRINCIPLES OF MANAGEMENT','Theory','75-2.5-2.5-10-5-5',5,3,'n'),(2015,6,'B.Sc(IT)','N5BIT6T55','SOFTWARE TESTING','Theory','75-2.5-2.5-10-5-5',2,5,'n'),(2016,3,'B.Sc(IT)','N6BIT3P43','RDBMS LAB','Practical','60-5-5-10-8-12',5,3,'n'),(2016,3,'B.Sc(IT)','N6BIT3T61','OPEATING SYSTEM','Theory','75-2.5-2.5-10-5-5',5,3,'n'),(2016,3,'B.Sc(IT)','N6BIT3T62','RELATIONAL DATABASE MANAGEMENT','Theory','75-2.5-2.5-10-5-5',3,1,'n'),(2016,3,'B.Sc(IT)','N6BIT3T64','DISCRETE MATHEMATICS','Theory','75-2.5-2.5-10-5-5',5,3,'n'),(2016,3,'B.Sc(IT)','N6BIT3T66-C','NON MAJOR ELECTIVE','Theory','75-----',2,4,'n');
/*!40000 ALTER TABLE `subjectdetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `syllabus`
--

DROP TABLE IF EXISTS `syllabus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `syllabus` (
  `Batch` int NOT NULL,
  `Department` varchar(10) NOT NULL,
  `Type` varchar(3) NOT NULL,
  `file` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `syllabus`
--

LOCK TABLES `syllabus` WRITE;
/*!40000 ALTER TABLE `syllabus` DISABLE KEYS */;
INSERT INTO `syllabus` VALUES (2015,'B.Sc(IT)','n','syllabus/KAILASH Aadhaar.pdf');
/*!40000 ALTER TABLE `syllabus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `upcompanies`
--

DROP TABLE IF EXISTS `upcompanies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `upcompanies` (
  `Company_Name` varchar(50) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `Degree` varchar(50) NOT NULL,
  `Nature_Job` varchar(50) NOT NULL,
  `Location` varchar(30) NOT NULL,
  `Recruitment_type` varchar(10) NOT NULL,
  `Venue_college` varchar(50) NOT NULL,
  `Vaddress` varchar(50) NOT NULL,
  `Elegibility` varchar(50) NOT NULL,
  `Arrears` varchar(10) NOT NULL,
  `ugpercentage` varchar(5) NOT NULL,
  `pgpercentage` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `upcompanies`
--

LOCK TABLES `upcompanies` WRITE;
/*!40000 ALTER TABLE `upcompanies` DISABLE KEYS */;
INSERT INTO `upcompanies` VALUES ('HyperTechz','2018-03-07','13:00:00','B.Sc(CS)-B.Sc(IT)','ST','Pollachi','OnCampus','','','ug-pg','allowed','50','60'),('ABC','2018-04-04','00:00:00','','','','OnCampus','','','','allowed','',''),('ABC','2018-04-04','22:57:00','B.Sc(CS)','anx','ans','OnCampus','','','ug','allowed','54','');
/*!40000 ALTER TABLE `upcompanies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workdiarys`
--

DROP TABLE IF EXISTS `workdiarys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `workdiarys` (
  `SID` varchar(15) NOT NULL,
  `DATE` date NOT NULL,
  `DayOrder` varchar(5) NOT NULL,
  `Class` varchar(15) NOT NULL,
  `Hour` varchar(5) NOT NULL,
  `subject` varchar(25) NOT NULL,
  `Topic` varchar(200) NOT NULL,
  `Asid` varchar(15) NOT NULL,
  `Remark` varchar(15) NOT NULL,
  `session` varchar(3) NOT NULL,
  `reason` varchar(45) NOT NULL,
  `tool` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workdiarys`
--

LOCK TABLES `workdiarys` WRITE;
/*!40000 ALTER TABLE `workdiarys` DISABLE KEYS */;
INSERT INTO `workdiarys` VALUES ('BSCIT002','2017-08-31','I','III-B.Sc(IT)','II','BIT6T61','full','MCA21','','','','Cholk and talk'),('BSCIT002','2017-09-01','I','III-B.Sc(IT)','I','N5BIT5T25','DB','BSCCS16','','','','LCD'),('BSCCS16','2017-09-02','I','II-B.Sc(IT)','I','N5BIT5T25','DB','','','','','LCD');
/*!40000 ALTER TABLE `workdiarys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'collegedetails'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-03-17 22:27:06
