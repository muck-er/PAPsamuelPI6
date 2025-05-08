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

-- A despejar estrutura para tabela othrysfit.planos_treino
CREATE TABLE IF NOT EXISTS `planos_treino` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `objetivo` enum('perda_peso','ganho_massa') NOT NULL,
  `dia_treino` char(1) NOT NULL,
  `ordem_exercicio` int(11) NOT NULL,
  `nome_exercicio` varchar(255) NOT NULL,
  `repeticoes` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `planos_treino_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- A despejar dados para tabela othrysfit.planos_treino: ~48 rows (aproximadamente)
DELETE FROM `planos_treino`;
INSERT INTO `planos_treino` (`id`, `user_id`, `objetivo`, `dia_treino`, `ordem_exercicio`, `nome_exercicio`, `repeticoes`) VALUES
	(1, 0, 'perda_peso', 'A', 1, 'Supino na barra', '3 Séries 15 repetições'),
	(2, 0, 'perda_peso', 'A', 2, 'Flys na máquina', '3 Séries 15 repetições'),
	(3, 0, 'perda_peso', 'A', 3, 'Supino inclinado com halteres', '3 Séries 15 repetições'),
	(4, 0, 'perda_peso', 'A', 4, 'Tríceps Francês', '3 Séries 15 repetições'),
	(5, 0, 'perda_peso', 'A', 5, 'Tríceps deitado no banco com barra W', '3 Séries 15 repetições'),
	(6, 0, 'perda_peso', 'A', 6, 'Tríceps com cordas', '3 Séries 15 repetições'),
	(7, 0, 'perda_peso', 'B', 1, 'Pulldown com abertura larga', '3 Séries 15 repetições'),
	(8, 0, 'perda_peso', 'B', 2, 'Puxada com triângulo', '3 Séries 15 repetições'),
	(9, 0, 'perda_peso', 'B', 3, 'Remada baixa com barra', '3 Séries 15 repetições'),
	(10, 0, 'perda_peso', 'B', 4, 'Bíceps curl', '3 Séries 15 repetições'),
	(11, 0, 'perda_peso', 'B', 5, 'Bíceps martelo', '3 Séries 15 repetições'),
	(12, 0, 'perda_peso', 'B', 6, 'Bíceps com barra W pegada fechada', '3 Séries 15 repetições'),
	(13, 0, 'perda_peso', 'C', 1, 'Leg curl', '3 Séries 15 repetições'),
	(14, 0, 'perda_peso', 'C', 2, 'Leg Press', '3 Séries 15 repetições'),
	(15, 0, 'perda_peso', 'C', 3, 'Abdutor na máquina', '3 Séries 15 repetições'),
	(16, 0, 'perda_peso', 'C', 4, 'Adutor na máquina', '3 Séries 15 repetições'),
	(17, 0, 'perda_peso', 'C', 5, 'Agachamento com barra', '3 Séries 15 repetições'),
	(18, 0, 'perda_peso', 'C', 6, 'Leg extension', '3 Séries 15 repetições'),
	(19, 0, 'perda_peso', 'D', 1, 'Elevação lateral com halteres', '3 Séries 15 repetições'),
	(20, 0, 'perda_peso', 'D', 2, 'Elevação frontal com halteres', '3 Séries 15 repetições'),
	(21, 0, 'perda_peso', 'D', 3, 'Supino de ombro com halteres', '3 Séries 15 repetições'),
	(22, 0, 'perda_peso', 'D', 4, 'Encolhimento com halteres', '3 Séries 15 repetições'),
	(23, 0, 'perda_peso', 'D', 5, 'Retrações de omoplatas', '3 Séries 15 repetições'),
	(24, 0, 'perda_peso', 'D', 6, 'Encolhimento com barra por trás', '3 Séries 15 repetições'),
	(25, 0, 'ganho_massa', 'A', 1, 'Supino na barra', '3 Séries 10 a 12 repetições'),
	(26, 0, 'ganho_massa', 'A', 2, 'Flys na máquina', '3 Séries 10 a 12 repetições'),
	(27, 0, 'ganho_massa', 'A', 3, 'Supino inclinado com halteres', '3 Séries 10 a 12 repetições'),
	(28, 0, 'ganho_massa', 'A', 4, 'Tríceps Francês', '3 Séries 10 a 12 repetições'),
	(29, 0, 'ganho_massa', 'A', 5, 'Tríceps deitado no banco com barra W', '3 Séries 10 a 12 repetições'),
	(30, 0, 'ganho_massa', 'A', 6, 'Tríceps com cordas', '3 Séries 10 a 12 repetições'),
	(31, 0, 'ganho_massa', 'B', 1, 'Pulldown com abertura larga', '3 Séries 10 a 12 repetições'),
	(32, 0, 'ganho_massa', 'B', 2, 'Puxada com triângulo', '3 Séries 10 a 12 repetições'),
	(33, 0, 'ganho_massa', 'B', 3, 'Remada baixa com barra', '3 Séries 10 a 12 repetições'),
	(34, 0, 'ganho_massa', 'B', 4, 'Bíceps curl', '3 Séries 10 a 12 repetições'),
	(35, 0, 'ganho_massa', 'B', 5, 'Bíceps martelo', '3 Séries 10 a 12 repetições'),
	(36, 0, 'ganho_massa', 'B', 6, 'Bíceps com barra W pegada fechada', '3 Séries 10 a 12 repetições'),
	(37, 0, 'ganho_massa', 'C', 1, 'Leg curl', '3 Séries 10 a 12 repetições'),
	(38, 0, 'ganho_massa', 'C', 2, 'Leg Press', '3 Séries 10 a 12 repetições'),
	(39, 0, 'ganho_massa', 'C', 3, 'Abdutor na máquina', '3 Séries 10 a 12 repetições'),
	(40, 0, 'ganho_massa', 'C', 4, 'Adutor na máquina', '3 Séries 10 a 12 repetições'),
	(41, 0, 'ganho_massa', 'C', 5, 'Agachamento com barra', '3 Séries 10 a 12 repetições'),
	(42, 0, 'ganho_massa', 'C', 6, 'Leg extension', '3 Séries 10 a 12 repetições'),
	(43, 0, 'ganho_massa', 'D', 1, 'Elevação lateral com halteres', '3 Séries 10 a 12 repetições'),
	(44, 0, 'ganho_massa', 'D', 2, 'Elevação frontal com halteres', '3 Séries 10 a 12 repetições'),
	(45, 0, 'ganho_massa', 'D', 3, 'Supino de ombro com halteres', '3 Séries 10 a 12 repetições'),
	(46, 0, 'ganho_massa', 'D', 4, 'Encolhimento com halteres', '3 Séries 10 a 12 repetições'),
	(47, 0, 'ganho_massa', 'D', 5, 'Retrações de omoplatas', '3 Séries 10 a 12 repetições'),
	(48, 0, 'ganho_massa', 'D', 6, 'Encolhimento com barra por trás', '3 Séries 10 a 12 repetições');

-- A despejar estrutura para tabela othrysfit.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `peso` decimal(5,2) DEFAULT NULL,
  `altura` int(11) DEFAULT NULL,
  `idade` int(11) DEFAULT NULL,
  `contacto` varchar(20) DEFAULT NULL,
  `objetivo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- A despejar dados para tabela othrysfit.users: ~3 rows (aproximadamente)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `email`, `password`, `nome`, `peso`, `altura`, `idade`, `contacto`, `objetivo`) VALUES
	(1, 'test1@test.com', '$2y$10$dpTPTtIMB8rFko/0HirlceR0gltL0EA6g7V4S/Wu8Ggs74RZmB/Ma', 'asd', 44.00, 111, 12, '123456789', NULL),
	(2, 'test2@test.com', '$2y$10$PBv89aQcTShi7JgFk3DJGOPy792OzLVtBoSl6h3pe7c2b1EKznW/.', 'adas', 55.00, 111, 55, '123456789', NULL),
	(3, 'test3@test.com', '$2y$10$Fw7CIWCTpiTyfWNa0jDPLuYYQml7XnY1St3yaIxNP2nThycJ7Gyt.', NULL, NULL, NULL, NULL, NULL, NULL),
	(4, 'test@test.pt', '$2y$10$AzMaCAiHPRNJNc5rBWVOW.3HLUnLLhNj84imrp7wdiJxuJ/dbrJv2', NULL, NULL, NULL, NULL, NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
