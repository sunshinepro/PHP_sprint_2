-- MySQL dump 10.13  Distrib 8.0.23, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: sprint2
-- ------------------------------------------------------
-- Server version	8.0.18

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `emploees`
--

DROP TABLE IF EXISTS `emploees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `emploees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `f_name` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `l_name` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4027 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emploees`
--

LOCK TABLES `emploees` WRITE;
/*!40000 ALTER TABLE `emploees` DISABLE KEYS */;
INSERT INTO `emploees` VALUES (3001,'Rūta','Meilutytė'),(3002,'Živilė','Stonytė'),(3004,'Gražuolė','Pabaisaitė'),(3005,'Gerutė','Gerulaitė'),(4001,'Petras','Rastenis'),(4002,'Benediktas ','Vanagas'),(4004,'Vaidotas','Žala'),(4005,'Kristijonas','Kaikaris'),(4021,'Žiogas','Žvirblelis'),(4022,'Žiogas','Žvirblelis'),(4023,'Žiogas','Žvirblelis'),(4024,'Žiogas','Žvirblelis'),(4025,'Žiogas','Žvirblelis'),(4026,'Žiogas','Žvirblelis');
/*!40000 ALTER TABLE `emploees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emploees_projects`
--

DROP TABLE IF EXISTS `emploees_projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `emploees_projects` (
  `id_e_p` int(11) NOT NULL AUTO_INCREMENT,
  `id_emploees` int(11) DEFAULT NULL,
  `id_projects` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_e_p`),
  KEY `fk_e_idx` (`id_emploees`),
  KEY `fk_p_idx` (`id_projects`),
  CONSTRAINT `fk_e` FOREIGN KEY (`id_emploees`) REFERENCES `emploees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_p` FOREIGN KEY (`id_projects`) REFERENCES `projects` (`id_projects`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emploees_projects`
--

LOCK TABLES `emploees_projects` WRITE;
/*!40000 ALTER TABLE `emploees_projects` DISABLE KEYS */;
INSERT INTO `emploees_projects` VALUES (1,3001,1),(2,4001,2),(3,3002,3),(4,4002,4),(5,3004,5),(6,4004,6),(7,3005,1),(8,4005,2);
/*!40000 ALTER TABLE `emploees_projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects` (
  `id_projects` int(11) NOT NULL AUTO_INCREMENT,
  `p_name` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_projects`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,'Dakaras'),(2,'Katamaranas'),(3,'DreamTeam'),(4,'Gaming'),(5,'Reading'),(6,'Chopped'),(7,'ggg'),(8,'PHP'),(9,'ggg'),(10,'PHP'),(11,'');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `projects_list`
--

DROP TABLE IF EXISTS `projects_list`;
/*!50001 DROP VIEW IF EXISTS `projects_list`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `projects_list` AS SELECT 
 1 AS `id_projects`,
 1 AS `p_name`,
 1 AS `f_name`,
 1 AS `l_name`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `projects_list`
--

/*!50001 DROP VIEW IF EXISTS `projects_list`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `projects_list` AS select `projects`.`id_projects` AS `id_projects`,`projects`.`p_name` AS `p_name`,`emploees`.`f_name` AS `f_name`,`emploees`.`l_name` AS `l_name` from ((`projects` left join `emploees_projects` on((`projects`.`id_projects` = `emploees_projects`.`id_projects`))) left join `emploees` on((`emploees`.`id` = `emploees_projects`.`id_emploees`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-22 13:30:09
