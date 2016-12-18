-- MySQL dump 10.13  Distrib 5.7.16, for Linux (i686)
--
-- Host: localhost    Database: ITB
-- ------------------------------------------------------
-- Server version	5.7.16-0ubuntu0.16.04.1

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
-- Table structure for table `gedung`
--

DROP TABLE IF EXISTS `gedung`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gedung` (
  `id_gedung` int(11) NOT NULL AUTO_INCREMENT,
  `namagedung` varchar(255) NOT NULL,
  `lat` varchar(200) NOT NULL,
  `lon` varchar(200) NOT NULL,
  `wilayah` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_gedung`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gedung`
--

LOCK TABLES `gedung` WRITE;
/*!40000 ALTER TABLE `gedung` DISABLE KEYS */;
INSERT INTO `gedung` VALUES (1,'Labtek I','-6.889224','107.611218',''),(2,'Labtek II','-6.890014','107.608528','FTMD'),(3,'Labtek III','-6.888521','107.608745',''),(4,'Labtek IV','-6.888377','107.611937','Tambang'),(5,'Labtek V','-6.890565','107.609955','IF'),(6,'Labtek VI','-6.890163','107.6097','Fisika Teknik'),(7,'Labtek VII','-6.890137','107.610735','Farmasi'),(8,'Labtek VIII','-6.890677','107.610556','Elektro'),(9,'Labtek IX A','-6.891568','107.611341','Plano'),(10,'Labtek IX B','-6.891535','107.611894','Arsitektur'),(11,'Labtek IX C','-6.891163','107.611894','Geodesi, Lingkungan'),(12,'Labtek X','-6.888994','107.609577','Tekkim'),(13,'Labtek XI','-6.889468','107.609475','SITH'),(14,'Aula Barat','-6.89241','107.609821',''),(15,'Aula Timur','-6.892368','107.611038',''),(16,'Teknik Sipil','-6.892051','107.609239',''),(17,'LFM','-6.892038','107.610982',''),(18,'GKU Barat','-6.890408','107.60885',''),(19,'GKU Timur','-6.890328','107.611795',''),(20,'TVST','-6.889503','107.610059',''),(21,'Gedung Kerjasama PLN-ITB','-6.889489','107.610666',''),(22,'Oktagon','-6.889058','107.610054',''),(23,'Comlabs','-6.889063','107.610577',''),(24,'Lab Fisika Dasar','-6.889085','107.610813',''),(25,'Basic Science A','-6.891791','107.608482',''),(26,'Basic Science B','-6.889063','107.611859',''),(27,'Campus Center Barat','-6.891258','107.61',''),(28,'Campus Center Timur','-6.89125','107.610722',''),(29,'Fisika','-6.891231','107.609343',''),(30,'FSRD','-6.888408','107.609587',''),(31,'Lab Doping','-6.890587','107.612278',''),(32,'CRCS (Center for Research and Community Services)','-6.887721','107.611771',''),(33,'CAS (Center for Advanced Studies)','-6.888312','107.61135',''),(34,'CADL (Centre of Arts, Design, and Language)','-6.888302','107.60959',''),(35,'CIBE (Center for Infrastructure and Built Environment)','-6.891391','107.608472',''),(36,'Lab Radar','-6.890597','107.608431',''),(37,'Gedung Kimia','-6.889628','107.611921',''),(38,'Lab Konversi','-6.890837','107.609134',''),(39,'Perpusatakaan','-6.888307','107.610757',''),(40,'Perminyakan','-6.888685','107.612286',''),(41,'SBM','-6.888094','107.608901',''),(42,'Teknik Lingkungan','-6.891194','107.611355','');
/*!40000 ALTER TABLE `gedung` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ruangan`
--

DROP TABLE IF EXISTS `ruangan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ruangan` (
  `id_ruangan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_ruangan` varchar(100) NOT NULL,
  `id_gedung` int(11) DEFAULT NULL,
  `lantai` int(11) DEFAULT NULL,
  `kapasitas` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_ruangan`)
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ruangan`
--

LOCK TABLES `ruangan` WRITE;
/*!40000 ALTER TABLE `ruangan` DISABLE KEYS */;
INSERT INTO `ruangan` VALUES (1,'1201',29,2,80),(2,'1318',37,3,45),(3,'1401',13,4,33),(4,'2104',37,1,50),(5,'2201',13,2,45),(6,'2202',13,2,40),(7,'2203',13,2,43),(8,'3101',16,1,72),(9,'3102',16,1,74),(10,'3103',16,1,70),(11,'3104',16,1,68),(12,'3105',16,1,72),(13,'3201',16,2,90),(14,'3202',16,2,92),(15,'3203',16,2,95),(16,'3204',16,2,94),(17,'3205',16,2,100),(18,'3206',16,2,97),(19,'3209',16,2,96),(20,'3210',16,2,102),(21,'3211',16,2,98),(22,'3213',16,2,107),(23,'3214',16,2,104),(24,'4101',2,1,80),(25,'4102',2,1,82),(26,'4103',2,4,80),(27,'4104',2,4,84),(28,'4105',2,4,76),(29,'4106',2,4,76),(30,'4201',9,2,80),(31,'5201',12,2,82),(32,'5202',12,2,75),(33,'6101',10,1,76),(34,'6102',10,1,78),(35,'6302',9,3,74),(36,'6303',9,3,89),(37,'6305',9,3,64),(38,'6306',9,3,64),(39,'7601',5,1,104),(40,'7602',5,3,170),(41,'7603',5,3,60),(42,'7604',5,3,60),(43,'7606',5,3,65),(44,'7607',5,3,65),(45,'7608',5,3,65),(46,'7609',5,3,65),(47,'7610',5,3,65),(48,'9008',42,1,65),(49,'9009',17,1,272),(50,'9011',8,2,50),(51,'9012',7,1,195),(52,'9013',7,1,87),(53,'9014',7,1,75),(54,'9015',8,2,75),(55,'9016',22,1,116),(56,'9017',22,1,116),(57,'9018',22,1,116),(58,'9019',22,2,218),(59,'9020',22,2,215),(60,'9021',22,2,215),(61,'9022',20,1,108),(62,'9023',20,1,108),(63,'9024',20,1,108),(64,'9025',22,2,68),(65,'9026',22,2,75),(66,'9027',22,2,55),(67,'9103',18,1,113),(68,'9104',18,1,112),(69,'9106',18,1,118),(70,'9107',18,1,110),(71,'9108',18,1,110),(72,'9114',18,1,20),(73,'9115',18,1,20),(74,'9116',18,1,20),(75,'9121',18,2,116),(76,'9122',18,2,125),(77,'9123',18,2,111),(78,'9124',18,2,120),(79,'9125',18,2,117),(80,'9126',18,2,116),(81,'9127',18,2,116),(82,'9128',18,2,115),(83,'9131',18,3,118),(84,'9132',18,3,114),(85,'9133',18,3,115),(86,'9134',18,3,117),(87,'9135',18,3,113),(88,'9136',18,3,118),(89,'9137',18,3,115),(90,'9138',18,3,115),(91,'9212',19,2,111),(92,'9213',19,2,117),(93,'9214',19,2,112),(94,'9221',19,3,115),(95,'9222',19,3,115),(96,'9223',19,3,106),(97,'9224',19,3,108),(98,'9231',19,4,341),(99,'9232',19,4,325),(100,'9233',19,4,60),(101,'9234',19,4,60),(102,'9301',5,1,114),(103,'9302',5,1,120),(104,'9303',5,1,66),(105,'9304',5,1,66),(106,'9305',5,1,51),(107,'9306',5,1,71),(108,'9307',6,1,108),(109,'9308',6,1,112),(110,'9309',6,1,143),(111,'9311',6,1,75),(112,'9312',6,1,64),(113,'9313',6,1,44),(114,'9314',6,1,67),(115,'9315',5,1,45),(116,'9316',6,1,70),(117,'9401',1,2,65),(118,'9402',1,2,65),(119,'9403',1,2,65),(120,'9404',1,2,65),(121,'9405',1,2,65),(122,'TVST-A',20,2,130),(123,'TVST-B',20,2,226),(124,'TVST-C',20,2,226),(125,'BSC-A',25,4,200),(126,'9501',31,3,22),(127,'9502',31,3,38),(128,'9513',32,2,49),(129,'9514',32,2,49),(130,'9515',32,2,25),(131,'9521',33,3,21),(132,'9522',33,3,40),(133,'9531',34,2,30),(134,'9532',34,2,30),(135,'9533',34,2,20);
/*!40000 ALTER TABLE `ruangan` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-08 16:55:18
