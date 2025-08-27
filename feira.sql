-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           11.7.2-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.11.0.7065
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para feira
CREATE DATABASE IF NOT EXISTS `feira` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci */;
USE `feira`;

-- Copiando estrutura para tabela feira.tb_aluno
CREATE TABLE IF NOT EXISTS `tb_aluno` (
  `id_aluno` int(11) NOT NULL AUTO_INCREMENT,
  `nome_aluno` varchar(100) NOT NULL,
  `serie_aluno` enum('1','2','3') NOT NULL,
  `curso_aluno` varchar(50) NOT NULL,
  PRIMARY KEY (`id_aluno`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela feira.tb_feedback
CREATE TABLE IF NOT EXISTS `tb_feedback` (
  `id_feedback` int(4) NOT NULL AUTO_INCREMENT,
  `fk_id_usuario` int(11) NOT NULL,
  `nota_feedback` int(11) NOT NULL,
  `comentario_feedback` varchar(255) DEFAULT NULL,
  `data_envio_feedback` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_feedback`),
  KEY `id_users` (`fk_id_usuario`),
  CONSTRAINT `tb_feedback_ibfk_1` FOREIGN KEY (`fk_id_usuario`) REFERENCES `tb_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela feira.tb_ods
CREATE TABLE IF NOT EXISTS `tb_ods` (
  `id_ods` int(11) NOT NULL AUTO_INCREMENT,
  `nome_ods` varchar(255) NOT NULL,
  PRIMARY KEY (`id_ods`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela feira.tb_ods_projeto
CREATE TABLE IF NOT EXISTS `tb_ods_projeto` (
  `fk_id_ods` int(11) NOT NULL,
  `fk_id_projeto` int(11) NOT NULL,
  KEY `id_ods` (`fk_id_ods`),
  KEY `id_projetos` (`fk_id_projeto`),
  CONSTRAINT `tb_ods_projeto_ibfk_1` FOREIGN KEY (`fk_id_ods`) REFERENCES `tb_ods` (`id_ods`),
  CONSTRAINT `tb_ods_projeto_ibfk_2` FOREIGN KEY (`fk_id_projeto`) REFERENCES `tb_projeto` (`id_projeto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela feira.tb_projeto
CREATE TABLE IF NOT EXISTS `tb_projeto` (
  `id_projeto` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_projeto` varchar(100) NOT NULL,
  `descricao_projeto` varchar(255) NOT NULL,
  `bloco_projeto` enum('A','B') NOT NULL,
  `sala_projeto` varchar(20) NOT NULL,
  `posicao_projeto` int(11) NOT NULL,
  `stand_projeto` varchar(3) NOT NULL,
  `orientador_projeto` varchar(100) NOT NULL,
  PRIMARY KEY (`id_projeto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela feira.tb_projeto_aluno
CREATE TABLE IF NOT EXISTS `tb_projeto_aluno` (
  `fk_id_projeto` int(11) NOT NULL,
  `fk_id_aluno` int(11) NOT NULL,
  KEY `id_projetos_integrantes` (`fk_id_projeto`),
  KEY `id_alunos_integrantes` (`fk_id_aluno`),
  CONSTRAINT `id_alunos_integrantes` FOREIGN KEY (`fk_id_aluno`) REFERENCES `tb_aluno` (`id_aluno`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_projetos_integrantes` FOREIGN KEY (`fk_id_projeto`) REFERENCES `tb_projeto` (`id_projeto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela feira.tb_usuario
CREATE TABLE IF NOT EXISTS `tb_usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `is_admin` bit(1) NOT NULL DEFAULT 0,
  `nome_usuario` varchar(50) NOT NULL,
  `email_usuario` varchar(255) NOT NULL,
  `senha_usuario` varchar(255) DEFAULT NULL,
  `data_nascimento_usuario` date NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela feira.tb_voto
CREATE TABLE IF NOT EXISTS `tb_voto` (
  `id_voto` int(11) NOT NULL AUTO_INCREMENT,
  `data_hora_voto` datetime NOT NULL,
  `valor_voto` int(11) NOT NULL,
  `comentario_voto` varchar(200) DEFAULT NULL,
  `fk_id_usuario` int(11) NOT NULL,
  `fk_id_projeto` int(11) NOT NULL,
  PRIMARY KEY (`id_voto`),
  KEY `id_projetos` (`fk_id_projeto`),
  KEY `id_users` (`fk_id_usuario`),
  CONSTRAINT `id_projetos` FOREIGN KEY (`fk_id_projeto`) REFERENCES `tb_projeto` (`id_projeto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_users` FOREIGN KEY (`fk_id_usuario`) REFERENCES `tb_usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Exportação de dados foi desmarcado.

INSERT INTO `tb_aluno` (`id_aluno`, `nome_aluno`, `serie_aluno`, `curso_aluno`) VALUES
(1, 'aluno1', '1', 'informatíca'),
(2, 'aluno2', '2', 'informatíca'),
(3, 'aluno3', '3', 'informatíca'),
(4, 'aluno4', '1', 'química'),
(5, 'aluno5', '2', 'química'),
(6, 'aluno6', '3', 'química'),
(7, 'aluno7', '1', 'Administração'),
(8, 'aluno8', '2', 'Administração'),
(9, 'aluno9', '3', 'Administração'),
(10, 'aluno10', '1', 'Recursos Humanos'),
(11, 'aluno11', '2', 'Recursos Humanos'),
(12, 'aluno12', '3', 'Recursos Humanos');

INSERT INTO `tb_ods` (`id_ods`, `nome_ods`) VALUES
(1, 'Erradicação da pobreza'),
(2, 'Fome zero e agricultura sustentável'),
(3, 'Saúde e bem-estar'),
(4, 'Educação de qualidade'),
(5, 'Igualdade de gênero'),
(6, 'Água potável e saneamento'),
(7, 'Energia limpa e acessível'),
(8, 'Trabalho decente e crescimento econômico'),
(9, 'Indústria, inovação e infraestrutura'),
(10, 'Redução das desigualdades'),
(11, 'Cidades e comunidades sustentáveis'),
(12, 'Consumo e produção responsáveis'),
(13, 'Ação contra a mudança global do clima'),
(14, 'Vida na água'),
(15, 'Vida terrestre'),
(16, 'Paz, justiça e instituições eficazes'),
(17, 'Parcerias e meios de implementação');

INSERT INTO `tb_ods_projeto` (`fk_id_ods`, `fk_id_projeto`) VALUES
(7, 1),
(11, 1),
(2, 2),
(14, 2),
(15, 2),
(2, 3);

INSERT INTO `tb_projeto` (`id_projeto`, `titulo_projeto`, `descricao_projeto`, `bloco_projeto`, `sala_projeto`, `posicao_projeto`, `stand_projeto`, `orientador_projeto`) VALUES
(1, 'titulo1', 'projeto1', 'A', '5', 56, '5', 'fulano1'),
(2, 'titulo2', 'projeto2', 'B', '2', 78, '8', 'fulano2'),
(3, 'titulo3', 'projeto3', 'A', '7', 34, '3', 'fulano3'),
(4, 'titulo4', 'projeto4', 'A', '1', 42, '9', 'fulano4'),
(5, 'titulo5', 'projeto5', 'A', '2', 1, '1', 'fulano5'),
(6, 'titulo6', 'projeto6', 'A', '3', 2, '2', 'fulano6'),
(7, 'titulo7', 'projeto7', 'A', '4', 3, '3', 'fulano7'),
(8, 'titulo8', 'projeto8', 'A', '6', 4, '4', 'fulano8'),
(9, 'titulo9', 'projeto9', 'A', '8', 5, '5', 'fulano9'),
(10, 'titulo10', 'projeto10', 'B', '1', 6, '6', 'fulano10'),
(11, 'titulo11', 'projeto11', 'B', '3', 7, '7', 'fulano11'),
(12, 'titulo12', 'projeto12', 'B', '4', 8, '8', 'fulano12'),
(13, 'titulo13', 'projeto13', 'B', '5', 9, '9', 'fulano13');

INSERT INTO `tb_projeto_aluno` (`fk_id_projeto`, `fk_id_aluno`) VALUES
(1, 1),
(2, 2);

INSERT INTO `tb_voto` (`id_voto`, `data_hora_voto`, `valor_voto`, `comentario_voto`, `fk_id_usuario`, `fk_id_projeto`) VALUES
(1, '2025-07-28 21:51:44', 100, NULL, 2, 3),
(2, '2025-07-28 21:51:44', 0, 'abcd', 3, 1),
(3, '2025-07-28 21:51:44', 50, '', 3, 2);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
