-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: revistas-eventos
-- ------------------------------------------------------
-- Server version	8.0.39

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
-- Position to start replication or point-in-time recovery from
--

-- CHANGE MASTER TO MASTER_LOG_FILE='CUPER-bin.000086', MASTER_LOG_POS=157;

--
-- Table structure for table `codigos`
--

DROP TABLE IF EXISTS `codigos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `codigos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `codigos`
--
-- ORDER BY:  `id`

LOCK TABLES `codigos` WRITE;
/*!40000 ALTER TABLE `codigos` DISABLE KEYS */;
INSERT INTO `codigos` VALUES (1,'UTPL');
/*!40000 ALTER TABLE `codigos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eventos`
--

DROP TABLE IF EXISTS `eventos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `eventos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) DEFAULT NULL,
  `acronimo` varchar(15) NOT NULL,
  `ranking` varchar(10) DEFAULT NULL,
  `enlace` varchar(150) DEFAULT NULL,
  `usuario_id` int DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `documento_url` varchar(100) DEFAULT NULL,
  `fechaAcep` date DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_id_eventos` (`usuario_id`),
  CONSTRAINT `fk_usuario_id_eventos` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eventos`
--
-- ORDER BY:  `id`

LOCK TABLES `eventos` WRITE;
/*!40000 ALTER TABLE `eventos` DISABLE KEYS */;
INSERT INTO `eventos` VALUES (1,' International Conference on Web Information Systems and Technologies','ICWIST','A*','https://webist.scitevents.org/ImportantDates.aspx',2,'2025-07-31','evento_67afaf36760091.71153913.docx','2025-09-08','2025-09-17'),(11,' ACM Conference on Computer and Communications Security 2025','IEEE ICC','A','https://www.sigsac.org/ccs/CCS2025/',2,'2025-02-25','','2025-05-30','2025-08-01'),(12,' European Conference on Computer Vision 2024','ECCV','A','https://eccv.ecva.net/',2,'2025-03-01','','2025-04-15','2025-06-01'),(13,' International Conference on Tourism, Transport, and Logistics','ICTTL-2025','A','https://conferencealert.com/eventdetail/1090219',2,'2025-02-14','','2025-03-01','2025-03-02');
/*!40000 ALTER TABLE `eventos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `revistas`
--

DROP TABLE IF EXISTS `revistas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `revistas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `categoria` varchar(11) NOT NULL,
  `enlace` varchar(255) NOT NULL,
  `accesibilidad` varchar(20) DEFAULT NULL,
  `pais` varchar(50) DEFAULT NULL,
  `tipo_revista` varchar(50) DEFAULT NULL,
  `usuario_id` int DEFAULT NULL,
  `documento_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_id` (`usuario_id`),
  CONSTRAINT `fk_usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `revistas`
--
-- ORDER BY:  `id`

LOCK TABLES `revistas` WRITE;
/*!40000 ALTER TABLE `revistas` DISABLE KEYS */;
INSERT INTO `revistas` VALUES (1,' International Journal of Educational Technology in Higher Education','Q1','https://educationaltechnologyjournal.springeropen.com/','si','Países Bajos','E-learning',2,'revista_67bda6acd67604.78898632.pdf'),(2,' Internet and Higher Education','Q1','https://www.sciencedirect.com/journal/the-internet-and-higher-education','no','Reino Unido','E-learning',2,'revista_67bda74b39b922.67764370.pdf'),(5,' Computers and Education','Q1','https://www.sciencedirect.com/journal/computers-and-education','no','Reino Unido','E-learning',2,' '),(6,' International Journal of Educational Technology in Higher Education','Q1','https://educationaltechnologyjournal.springeropen.com/','si','Países Bajos','E-learning',2,' '),(7,' Internet and Higher Education','Q1','https://www.sciencedirect.com/journal/the-internet-and-higher-education','no','Reino Unido','E-learning',2,' '),(8,' British Journal of Educational Technology','Q1','https://bera-journals.onlinelibrary.wiley.com/journal/14678535','no','Reino Unido','E-learning',2,' '),(9,' Government Information Quarterly','Q1','https://www.sciencedirect.com/journal/government-information-quarterly','no','Reino Unido','E-learning',2,' '),(10,' 	International Journal of Artificial Intelligence in Education','Q1','https://link.springer.com/journal/40593','no','Estados Unidos','E-learning',2,' '),(11,' Journal of Computer Assisted Learning','Q1','https://onlinelibrary.wiley.com/journal/13652729','no','Reino Unido','E-learning',2,' '),(12,' Distance Education','Q1','https://www.tandfonline.com/toc/cdie20/current','no','Reino Unido','E-learning',2,' '),(13,' Educational Technology and Society','Q1','https://www.j-ets.net/home','si','China','E-learning',2,' '),(14,' IEEE Transactions on Learning Technologies','Q1','https://ieeexplore.ieee.org/xpl/RecentIssue.jsp?punumber=4620076','no','Estados Unidos','E-learning',2,' '),(15,' Interactive Learning Environments','Q1','https://www.tandfonline.com/toc/nile20/current','no','Estados Unidos','E-learning',2,' '),(16,' Education and Information Technologies','Q1','https://link.springer.com/journal/10639','no','Estados Unidos','E-learning',2,' '),(17,' Information Technology for Development','Q1','https://www.tandfonline.com/toc/titd20/current','no','Reino Unido','E-learning',2,'revista_67bdb725dfc9f3.02096132.pdf'),(18,' Interactive Technology and Smart Education','Q1','https://www.emerald.com/insight/publication/issn/1741-5659','no','Reino Unido','E-learning',2,' '),(19,' Open Learning','Q1','https://www.tandfonline.com/toc/copl20/current','no','Reino Unido','E-learning',2,' '),(20,' Learning Environments Research','Q1','https://link.springer.com/journal/10984','no','Países Bajos','E-learning',2,' '),(21,' Australasian Journal of Educational Technology','Q1','https://ajet.org.au/index.php/AJET','si','Australia','E-learning',2,' '),(22,' International Review of Research in Open and Distance Learning','Q2','https://www.irrodl.org/index.php/irrodl','si','Canadá','E-learning',2,' '),(23,' 	Journal of Global Information Management','Q2','https://www.igi-global.com/journal/journal-global-information-management/1070','si','Estados Unidos','E-learning',2,'revista_67bdb6e075a226.61594040.pdf'),(24,' International Review of Education','Q2','https://link.springer.com/journal/11159','no','Países Bajos','E-learning',2,' '),(25,' 	Reference Services Review','Q2','https://www.emeraldgrouppublishing.com/journal/rsr','no','Reino Unido','E-learning',2,' '),(26,' International Journal of Distance Education Technologies','Q2','https://www.igi-global.com/journal/international-journal-distance-education-technologies/1078','no','Estados Unidos','E-learning',2,' '),(27,' Journal of Information Technology Education:Research','Q2','https://www.scimagojr.com/journalsearch.php?q=Informing%20Science%20Institute&tip=pub','si','Estados Unidos','E-learning',2,' '),(28,' Transforming Government: People, Process and Policy','Q2','https://www.emeraldgrouppublishing.com/journal/tg','no','Reino Unido','E-learning',2,' '),(29,' Adult Education Quarterly','Q2','https://journals.sagepub.com/home/aeq','no','Reino Unido','E-learning',2,' '),(30,' Electronic Journal of e-Learning','Q2','https://academic-publishing.org/index.php/ejel','si','Reino Unido','E-learning',2,' '),(31,' New Review of Academic Librarianship','Q2','https://www.tandfonline.com/loi/racl20','no','Reino Unido','E-learning',2,' '),(32,' Journal of Continuing Education in the Health Professions','Q2','https://journals.lww.com/jcehp/pages/default.aspx','no','Estados Unidos','E-learning',2,' '),(33,' International Journal of Lifelong Education','Q2','https://www.tandfonline.com/toc/tled20/current','no','Reino Unido','E-learning',2,' '),(34,' Nordic Journal of Digital Literacy','Q2','https://www.idunn.no/journal/njdl?languageId=2#/last_published','si','Noruega','E-learning',2,' '),(35,' Knowledge Management and E-Learning','Q2','https://www.kmel-journal.org/ojs/index.php/online-publication/index','si','China','E-learning',2,' '),(36,' International Journal of Mobile Learning and Organisation','Q2','https://www.inderscience.com/jhome.php?jcode=ijmlo','no','Suiza','E-learning',2,' '),(37,' Communications in Information Literacy','Q2','https://pdxscholar.library.pdx.edu/comminfolit/','si','Estados Unidos','E-learning',2,' '),(38,' Journal of Global Information Technology Management','Q2','https://www.tandfonline.com/loi/ugit20','no','Reino Unido','E-learning',2,' '),(39,' Internet Reference Services Quarterly','Q3','https://www.tandfonline.com/toc/wirs20/current','no','Estados Unidos','E-learning',2,' '),(40,' Electronic Journal of Information Systems in Developing Countries','Q3','https://onlinelibrary.wiley.com/journal/16814835','si','China','E-learning',2,' '),(41,' Journal of Information, Communication and Ethics in Society','Q3','https://www.emeraldgrouppublishing.com/journal/jices','no','Reino Unido','E-learning',2,' '),(42,' Journal of Information Systems Education','Q3','https://jise.org/','no','Estados Unidos','E-learning',2,' '),(43,' International Journal of Mobile and Blended Learning','Q3','https://www.igi-global.com/journal/international-journal-mobile-blended-learning/1115','no','Estados Unidos','E-learning',2,' '),(44,' https://www.scimagojr.com/journalsearch.php?q=21100394784&tip=sid&clean=0#google_vignette','Q3','https://online-journals.org/index.php/i-jim','si','Austria','E-learning',2,' '),(45,' 	Revista Iberoamericana de Tecnologias del Aprendizaje','Q3','https://vaep-rita.org/','no','Estados Unidos','E-learning',2,' '),(46,' International Journal of Technology Enhanced Learning','Q3','https://www.inderscience.com/jhome.php?jcode=ijtel','no','Suiza','E-learning',2,' '),(47,' International Information and Library Review','Q3','https://www.tandfonline.com/toc/ulbr20/current','no','Reino Unido','E-learning',2,' '),(48,' Journal of Library and Information Services in Distance Learning','Q3','https://www.tandfonline.com/toc/wlis20/current','no','Estados Unidos','E-learning',2,'revista_67bdb67d3d15f2.93515146.pdf'),(49,' International Journal of Information and Communication Technology Education','Q3','https://www.igi-global.com/journal/international-journal-information-communication-technology/1082','si','Estados Unidos','E-learning',2,'revista_67bdb4d23fbd37.18875252.pdf'),(50,' International Journal of Game-Based Learning','Q3','https://www.igi-global.com/journal/international-journal-game-based-learning/41019','no','Estados Unidos','E-learning',2,' '),(51,' Journal of Business and Finance Librarianship','Q3','https://www.tandfonline.com/toc/wbfl20/current','no','Estados Unidos','E-learning',2,'revista_67bdb413d5dca4.70398333.zip'),(52,' Journal of E-Learning and Knowledge Society','Q3','https://www.je-lks.org/ojs/index.php/Je-LKS_EN','si','Italia','E-learning',2,' '),(53,' College and Undergraduate Libraries','Q3','https://www.tandfonline.com/toc/wcul20/current','no','Estados Unidos','E-learning',2,'revista_67bdb45ede1aa5.58804926.zip'),(54,' International Journal of Electronic Government Research','Q3','https://www.igi-global.com/journal/international-journal-electronic-government-research/1091','no','Estados Unidos','E-learning',2,' ');
/*!40000 ALTER TABLE `revistas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--
-- ORDER BY:  `id`

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (2,' Liliana','lenciso@utpl.edu.ec','$2y$10$1N1Qft/S/OyEZZBE206PhuAPHCkk3SIrNtFoApr0wZsaJDqODQ5FO','Enciso','7002536',1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-02-25 14:18:40
