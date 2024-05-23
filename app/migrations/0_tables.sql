--
-- Table structure for table `car_mark`
--

/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE IF NOT EXISTS `car_mark` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `car_mark_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Table structure for table `car_body_type`
--

/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE IF NOT EXISTS `car_body_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `body_type_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Table structure for table `car_model`
--

/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE IF NOT EXISTS `car_model` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mark_id` int NOT NULL,
  `body_type_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date_start` timestamp NOT NULL,
  `date_end` timestamp NOT NULL DEFAULT '2038-01-19 00:14:07',
  PRIMARY KEY (`id`),
  KEY `car_model_car_mark_FK` (`mark_id`),
  KEY `car_model_car_body_type_FK` (`body_type_id`),
  CONSTRAINT `car_model_car_body_type_FK` FOREIGN KEY (`body_type_id`) REFERENCES `car_body_type` (`id`) ON DELETE CASCADE,
  CONSTRAINT `car_model_car_mark_FK` FOREIGN KEY (`mark_id`) REFERENCES `car_mark` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Table structure for table `car_work`
--

/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE IF NOT EXISTS `car_work` (
  `id` int NOT NULL AUTO_INCREMENT,
  `model_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `cost` float NOT NULL,
  `time` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `car_work_model_FK` (`model_id`),
  CONSTRAINT `car_work_model_FK` FOREIGN KEY (`model_id`) REFERENCES `car_model` (`id`)  ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
