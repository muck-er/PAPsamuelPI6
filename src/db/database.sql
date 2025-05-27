-- --------------------------------------------------------
-- Anfitrião:                    127.0.0.1
-- Versão do servidor:           10.4.32-MariaDB - mariadb.org binary distribution
-- SO do servidor:               Win64
-- HeidiSQL Versão:              12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- A despejar estrutura da base de dados para othrysfit
CREATE DATABASE IF NOT EXISTS `othrysfit` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `othrysfit`;

-- A despejar estrutura para tabela othrysfit.objetivos_padrao
CREATE TABLE IF NOT EXISTS `objetivos_padrao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- A despejar dados para tabela othrysfit.objetivos_padrao: ~4 rows (aproximadamente)
DELETE FROM `objetivos_padrao`;
INSERT INTO `objetivos_padrao` (`id`, `descricao`) VALUES
	(1, 'Treinar 3x por semana'),
	(2, 'Beber 2L de água por dia'),
	(3, 'Atingir 10.000 passos por dia'),
	(4, 'Dormir 7h por noite');

-- A despejar estrutura para tabela othrysfit.objetivos_user
CREATE TABLE IF NOT EXISTS `objetivos_user` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `concluido` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`,`user_id`),
  KEY `fk_objetivos_user_user` (`user_id`),
  CONSTRAINT `fk_objetivos_user_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- A despejar dados para tabela othrysfit.objetivos_user: ~0 rows (aproximadamente)
DELETE FROM `objetivos_user`;

-- A despejar estrutura para tabela othrysfit.treinos_ganho_massa
CREATE TABLE IF NOT EXISTS `treinos_ganho_massa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `treino` varchar(5) NOT NULL,
  `tipo` enum('ganho_massa','perda_peso') NOT NULL,
  `exercicios` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- A despejar dados para tabela othrysfit.treinos_ganho_massa: ~4 rows (aproximadamente)
DELETE FROM `treinos_ganho_massa`;
INSERT INTO `treinos_ganho_massa` (`id`, `treino`, `tipo`, `exercicios`) VALUES
	(1, 'A', 'ganho_massa', 'Supino na barra, Flys na máquina, Supino inclinado com halteres, Peck deck, Tríceps na polia, Tríceps com corda, Tríceps francês, Abdominais'),
	(2, 'B', 'ganho_massa', 'Agachamento com barra, Leg press, Cadeira extensora, Stiff, Cadeira flexora, Gêmeos sentado, Gêmeos em pé'),
	(3, 'C', 'ganho_massa', 'Puxada frente, Remada baixa, Remada unilateral, Pulldown, Bíceps com barra, Bíceps alternado, Bíceps concentrado, Abdominais'),
	(4, 'D', 'ganho_massa', 'Desenvolvimento com barra, Elevação lateral, Elevação frontal, Crucifixo inverso, Encolhimento com halteres, Prancha, Abdominais oblíquos');

-- A despejar estrutura para tabela othrysfit.treinos_perda_peso
CREATE TABLE IF NOT EXISTS `treinos_perda_peso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `treino` varchar(5) NOT NULL,
  `tipo` enum('ganho_massa','perda_peso') NOT NULL,
  `exercicios` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- A despejar dados para tabela othrysfit.treinos_perda_peso: ~4 rows (aproximadamente)
DELETE FROM `treinos_perda_peso`;
INSERT INTO `treinos_perda_peso` (`id`, `treino`, `tipo`, `exercicios`) VALUES
	(1, 'A', 'perda_peso', 'Esteira 15 min, Supino máquina, Peck deck, Tríceps polia, Abdominais'),
	(2, 'B', 'perda_peso', 'Bike 15 min, Leg press, Cadeira extensora, Stiff, Gêmeos em pé, Abdominais'),
	(3, 'C', 'perda_peso', 'Transport 15 min, Puxada frente, Remada baixa, Bíceps barra, Abdominais'),
	(4, 'D', 'perda_peso', 'Corrida 15 min, Desenvolvimento, Elevação lateral, Abdominais oblíquos, Prancha');

-- A despejar estrutura para tabela othrysfit.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `peso` decimal(5,2) NOT NULL,
  `altura` int(11) NOT NULL,
  `idade` int(11) NOT NULL,
  `contacto` varchar(20) DEFAULT NULL,
  `objetivo` enum('perda_peso','ganho_massa') NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- A despejar dados para tabela othrysfit.users: ~0 rows (aproximadamente)
DELETE FROM `users`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
