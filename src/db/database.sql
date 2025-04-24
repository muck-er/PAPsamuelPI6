DROP DATABASE IF EXISTS `othrysfit`;
CREATE DATABASE IF NOT EXISTS `othrysfit`;
USE `othrysfit`;

DROP TABLE IF EXISTS `planos_treino`;
CREATE TABLE IF NOT EXISTS `planos_treino` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `descricao` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `planos_treino_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DELETE FROM `planos_treino`;

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `idade` int(11) DEFAULT NULL,
  `peso` float DEFAULT NULL,
  `altura` float DEFAULT NULL,
  `contato` varchar(50) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DELETE FROM `users`;
INSERT INTO `users` (`id`, `nome`, `email`, `password`, `idade`, `peso`, `altura`, `contato`, `token`) VALUES
	(6, 'test', 'test@test.com', '$2y$10$nUMBHGqyCU2U1sX3Cm3uAuJXhnEivwlUuT/JT5A.KZHFE3E24TUEK', 12, 123, 155, '123123123', NULL),
	(7, 'test', 'test@test.pt', '$2y$10$8VNICPrYJOtTeKQkWDlOzORwGhSv9TsP18hx95qKM1aKh9ZcgSoVS', 17, 60, 170, '123123123', NULL);