-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           11.4.8-MariaDB - mariadb.org binary distribution
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `tb_aluno` (`nome_aluno`, `serie_aluno`, `curso_aluno`) VALUES
   -- Informática
   ('Lucas Silva', 1, 'Informática'),
   ('Ana Costa', 2, 'Informática'),
   ('Pedro Lima', 3, 'Informática'),
   ('Julia Martins', 1, 'Informática'),
   ('Felipe Gomes', 2, 'Informática'),
   
   -- Química
   ('Mariana Souza', 1, 'Química'),
   ('Rafael Oliveira', 2, 'Química'),
   ('Beatriz Fernandes', 3, 'Química'),
   ('Thiago Ribeiro', 1, 'Química'),
   ('Patrícia Carvalho', 2, 'Química'),

   -- Administração
   ('Gustavo Rocha', 1, 'Administração'),
   ('Camila Pereira', 2, 'Administração'),
   ('Bruno Alves', 3, 'Administração'),
   ('Fernanda Melo', 1, 'Administração'),
   ('Vitor Azevedo', 2, 'Administração'),

   -- Recursos Humanos
   ('Isabela Lima', 1, 'Recursos Humanos'),
   ('Eduardo Farias', 2, 'Recursos Humanos'),
   ('Carla Batista', 3, 'Recursos Humanos'),
   ('Ricardo Santos', 1, 'Recursos Humanos'),
   ('Marcos Pinto', 2, 'Recursos Humanos');

-- Copiando estrutura para tabela feira.tb_bloco
CREATE TABLE IF NOT EXISTS `tb_bloco` (
  `id_bloco` int(11) NOT NULL AUTO_INCREMENT,
  `nome_bloco` char(1) NOT NULL,
  PRIMARY KEY (`id_bloco`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Copiando dados para a tabela feira.tb_bloco: ~2 rows (aproximadamente)
INSERT INTO `tb_bloco` (`nome_bloco`) VALUES
	('A'),
	('B');

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Copiando dados para a tabela feira.tb_feedback: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela feira.tb_localizacao_projeto
CREATE TABLE IF NOT EXISTS `tb_localizacao_projeto` (
  `fk_id_bloco` int(11) NOT NULL,
  `fk_id_sala` int(11) NOT NULL,
  `fk_id_stand` int(11) NOT NULL,
  `fk_id_projeto` int(11) NOT NULL,
  KEY `fk_id_bloco` (`fk_id_bloco`),
  KEY `fk_id_sala` (`fk_id_sala`),
  KEY `fk_id_stand` (`fk_id_stand`),
  KEY `fk_id_projeto` (`fk_id_projeto`),
  CONSTRAINT `tb_localizacao_projeto_ibfk_1` FOREIGN KEY (`fk_id_bloco`) REFERENCES `tb_bloco` (`id_bloco`),
  CONSTRAINT `tb_localizacao_projeto_ibfk_2` FOREIGN KEY (`fk_id_sala`) REFERENCES `tb_sala` (`id_sala`),
  CONSTRAINT `tb_localizacao_projeto_ibfk_3` FOREIGN KEY (`fk_id_stand`) REFERENCES `tb_stand` (`id_stand`),
  CONSTRAINT `tb_localizacao_projeto_ibfk_4` FOREIGN KEY (`fk_id_projeto`) REFERENCES `tb_projeto` (`id_projeto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO tb_localizacao_projeto (fk_id_bloco, fk_id_sala, fk_id_stand, fk_id_projeto) VALUES 
	(1, 6, 8, 1),
	(1, 6, 7, 2),
	(1, 5, 8, 3),
	(1, 5, 7, 4),
	(1, 5, 5, 5),
	(1, 7, 8, 6),
	(1, 8, 8, 7),
	(1, 4, 3, 8),
	(1, 4, 5, 9),
	(1, 3, 6, 10),
	(2, 5, 7, 11),
	(2, 5, 8, 12),
	(2, 5, 4, 13),
	(2, 3, 1, 14),
	(2, 3, 5, 15),
	(2, 3, 8, 16),
	(2, 2, 7, 17),
	(2, 2, 8, 18),
	(2, 4, 3, 19),
	(2, 9, 2, 20);

-- Copiando estrutura para tabela feira.tb_ods
CREATE TABLE IF NOT EXISTS `tb_ods` (
  `id_ods` int(11) NOT NULL AUTO_INCREMENT,
  `nome_ods` varchar(255) NOT NULL,
  PRIMARY KEY (`id_ods`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Copiando dados para a tabela feira.tb_ods: ~17 rows (aproximadamente)
INSERT INTO `tb_ods` (`nome_ods`) VALUES
	('Erradicação da pobreza'),
	('Fome zero e agricultura sustentável'),
	('Saúde e bem-estar'),
	('Educação de qualidade'),
	('Igualdade de gênero'),
	('Água potável e saneamento'),
	('Energia limpa e acessível'),
	('Trabalho decente e crescimento econômico'),
	('Indústria, inovação e infraestrutura'),
	('Redução das desigualdades'),
	('Cidades e comunidades sustentáveis'),
	('Consumo e produção responsáveis'),
	('Ação contra a mudança global do clima'),
	('Vida na água'),
	('Vida terrestre'),
	('Paz, justiça e instituições eficazes'),
	('Parcerias e meios de implementação');

-- Copiando estrutura para tabela feira.tb_ods_projeto
CREATE TABLE IF NOT EXISTS `tb_ods_projeto` (
  `fk_id_ods` int(11) NOT NULL,
  `fk_id_projeto` int(11) NOT NULL,
  KEY `id_ods` (`fk_id_ods`),
  KEY `id_projetos` (`fk_id_projeto`),
  CONSTRAINT `tb_ods_projeto_ibfk_1` FOREIGN KEY (`fk_id_ods`) REFERENCES `tb_ods` (`id_ods`),
  CONSTRAINT `tb_ods_projeto_ibfk_2` FOREIGN KEY (`fk_id_projeto`) REFERENCES `tb_projeto` (`id_projeto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO tb_ods_projeto (fk_id_ods, fk_id_projeto) VALUES 
	(5, 1),
	(3, 2),
	(1, 3),
	(2, 4),
	(4, 5),
	(7, 6),
	(6, 7),
	(2, 8),
	(3, 9),
	(8, 10),
	(11, 11),
	(7, 12),
	(16, 13),
	(14, 14),
	(17, 15),
	(12, 16),
	(13, 17),
	(15, 18),
	(9, 19),
	(10, 20);

-- Copiando estrutura para tabela feira.tb_projeto
CREATE TABLE IF NOT EXISTS `tb_projeto` (
  `id_projeto` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_projeto` varchar(100) NOT NULL,
  `descricao_projeto` varchar(200) NOT NULL,
  `orientador_projeto` varchar(100) NOT NULL,
  PRIMARY KEY (`id_projeto`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Copiando dados para a tabela feira.tb_projeto: ~20 rows (aproximadamente)
INSERT INTO `tb_projeto` (`titulo_projeto`, `descricao_projeto`, `orientador_projeto`) VALUES
	('Sistema de Biblioteca', 'Sistema para controle de empréstimos e devoluções de livros', 'Prof. João Silva'),
	('E-commerce de Roupas', 'Loja virtual para vendas de roupas com carrinho de compras', 'Profª Maria Souza'),
	('Gestão de Restaurante', 'Sistema para controle de pedidos e mesas de um restaurante', 'Prof. Carlos Pereira'),
	('Agenda Online', 'Aplicativo para agendamento de compromissos com notificações', 'Profª Ana Oliveira'),
	('Controle de Estoque', 'Sistema para gerenciamento de entrada e saída de produtos', 'Prof. Paulo Mendes'),
	('Plataforma de Cursos', 'Portal online para cadastro e acompanhamento de cursos', 'Profª Juliana Costa'),
	('Sistema de Votação', 'Aplicativo para votação eletrônica com relatórios de resultados', 'Prof. Ricardo Gomes'),
	('Rede Social Acadêmica', 'Plataforma de interação entre estudantes e professores', 'Profª Fernanda Lima'),
	('App de Saúde', 'Aplicativo para monitoramento de atividades físicas e saúde', 'Prof. Marcelo Santos'),
	('Controle Financeiro', 'Sistema para controle de contas pessoais e relatórios', 'Profª Patrícia Rocha'),
	('Gerenciador de Tarefas', 'Aplicação para organização de tarefas e projetos', 'Prof. André Martins'),
	('Sistema de Hotel', 'Software para reservas, check-in e check-out de hóspedes', 'Profª Beatriz Nunes'),
	('Marketplace Local', 'Plataforma para vendas de produtos locais online', 'Prof. Gustavo Ferreira'),
	('Sistema de Chamados', 'Aplicação para abertura e acompanhamento de tickets de suporte', 'Profª Camila Ramos'),
	('Monitor de Tráfego', 'Sistema para análise e monitoramento de tráfego urbano', 'Prof. Eduardo Barbosa'),
	('Loja de Música Online', 'Portal para compra e streaming de músicas', 'Profª Cláudia Mendes'),
	('Aplicativo de Viagens', 'App para planejamento de roteiros e reservas de viagens', 'Prof. Fábio Almeida'),
	('Controle Escolar', 'Sistema de notas, faltas e relatórios escolares', 'Profª Daniela Castro'),
	('Gerenciador de Eventos', 'Plataforma para cadastro e divulgação de eventos', 'Prof. Leonardo Vieira'),
	('Sistema de Doações', 'Aplicativo para intermediar doações entre pessoas e ONGs', 'Profª Renata Carvalho');

-- Copiando estrutura para tabela feira.tb_projeto_aluno
CREATE TABLE IF NOT EXISTS `tb_projeto_aluno` (
  `fk_id_projeto` int(11) NOT NULL,
  `fk_id_aluno` int(11) NOT NULL,
  KEY `id_projetos_integrantes` (`fk_id_projeto`),
  KEY `id_alunos_integrantes` (`fk_id_aluno`),
  CONSTRAINT `id_alunos_integrantes` FOREIGN KEY (`fk_id_aluno`) REFERENCES `tb_aluno` (`id_aluno`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_projetos_integrantes` FOREIGN KEY (`fk_id_projeto`) REFERENCES `tb_projeto` (`id_projeto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO tb_projeto_aluno (fk_id_projeto, fk_id_aluno) VALUES
   (1, 5),
   (2, 3),
   (3, 7),
   (4, 1),
   (5, 8),
   (6, 2),
   (7, 10),
   (8, 12),
   (9, 4),
   (10, 6),
   (11, 11),
   (12, 9),
   (13, 14),
   (14, 13),
   (15, 15),
   (16, 17),
   (17, 16),
   (18, 19),
   (19, 18),
   (20, 20);

-- Copiando estrutura para tabela feira.tb_sala
CREATE TABLE IF NOT EXISTS `tb_sala` (
  `id_sala` int(11) NOT NULL AUTO_INCREMENT,
  `nome_sala` varchar(30) NOT NULL,
  PRIMARY KEY (`id_sala`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Copiando dados para a tabela feira.tb_sala: ~14 rows (aproximadamente)
INSERT INTO `tb_sala` (`nome_sala`) VALUES
	('Sala 1'),
	('Sala 2'),
	('Sala 3'),
	('Sala 4'),
	('Sala 5'),
	('Sala 6'),
	('Sala 7'),
	('Sala 8'),
	('Biblioteca'),
	('Pátio'),
	('Laboratório de Química 1'),
	('Laboratório de Química 2'),
	('Laboratório de Química 3'),
	('Laboratório de Química 4');

-- Copiando estrutura para tabela feira.tb_stand
CREATE TABLE IF NOT EXISTS `tb_stand` (
  `id_stand` int(11) NOT NULL AUTO_INCREMENT,
  `numero_stand` int(2) NOT NULL,
  PRIMARY KEY (`id_stand`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Copiando dados para a tabela feira.tb_stand: ~10 rows (aproximadamente)
INSERT INTO `tb_stand` (`numero_stand`) VALUES
	(1),
	(2),
	(3),
	(4),
	(5),
	(6),
	(7),
	(8),
	(9),
	(10);

-- Copiando estrutura para tabela feira.tb_usuario
CREATE TABLE IF NOT EXISTS `tb_usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `is_admin` bit(1) NOT NULL DEFAULT b'0',
  `nome_usuario` varchar(50) NOT NULL,
  `email_usuario` varchar(255) NOT NULL,
  `senha_usuario` varchar(255) DEFAULT NULL,
  `data_nascimento_usuario` date NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Copiando dados para a tabela feira.tb_usuario: ~0 rows (aproximadamente)

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Copiando dados para a tabela feira.tb_voto: ~0 rows (aproximadamente)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
