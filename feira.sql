CREATE DATABASE IF NOT EXISTS `feira`;
USE `feira`;

CREATE TABLE IF NOT EXISTS `tb_aluno` (
  `id_aluno` int(11) NOT NULL AUTO_INCREMENT,
  `nome_aluno` varchar(100) NOT NULL,
  `serie_aluno` enum('1','2','3') NOT NULL,
  `curso_aluno` varchar(50) NOT NULL,
  PRIMARY KEY (`id_aluno`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8MB4;

INSERT INTO `tb_aluno` (`id_aluno`, `nome_aluno`, `serie_aluno`, `curso_aluno`) VALUES
	(1, 'Lucas Silva', '1', 'Informática'),
	(2, 'Ana Costa', '2', 'Informática'),
	(3, 'Pedro Lima', '3', 'Informática'),
	(4, 'Julia Martins', '1', 'Informática'),
	(5, 'Felipe Gomes', '2', 'Informática'),
	(6, 'Mariana Souza', '1', 'Química'),
	(7, 'Rafael Oliveira', '2', 'Química'),
	(8, 'Beatriz Fernandes', '3', 'Química'),
	(9, 'Thiago Ribeiro', '1', 'Química'),
	(10, 'Patrícia Carvalho', '2', 'Química'),
	(11, 'Gustavo Rocha', '1', 'Administração'),
	(12, 'Camila Pereira', '2', 'Administração'),
	(13, 'Bruno Alves', '3', 'Administração'),
	(14, 'Fernanda Melo', '1', 'Administração'),
	(15, 'Vitor Azevedo', '2', 'Administração'),
	(16, 'Isabela Lima', '1', 'Recursos Humanos'),
	(17, 'Eduardo Farias', '2', 'Recursos Humanos'),
	(18, 'Carla Batista', '3', 'Recursos Humanos'),
	(19, 'Ricardo Santos', '1', 'Recursos Humanos'),
	(20, 'Marcos Pinto', '2', 'Recursos Humanos');

CREATE TABLE IF NOT EXISTS `tb_bloco` (
  `id_bloco` int(11) NOT NULL AUTO_INCREMENT,
  `nome_bloco` char(1) NOT NULL,
  PRIMARY KEY (`id_bloco`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8MB4;

INSERT INTO `tb_bloco` (`id_bloco`, `nome_bloco`) VALUES
	(1, 'A'),
	(2, 'B');

CREATE TABLE IF NOT EXISTS `tb_log_usuario` (
  `id_log_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `email_admin` varchar(255) NOT NULL,
  `email_usuario` varchar(255) NOT NULL,
  `data_log` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_log_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8MB4;

CREATE TABLE IF NOT EXISTS `tb_ods` (
  `id_ods` int(11) NOT NULL AUTO_INCREMENT,
  `nome_ods` varchar(255) NOT NULL,
  PRIMARY KEY (`id_ods`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=UTF8MB4;

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

CREATE TABLE IF NOT EXISTS `tb_projeto` (
  `id_projeto` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_projeto` varchar(100) NOT NULL,
  `descricao_projeto` text NOT NULL,
  `orientador_projeto` varchar(100) NOT NULL,
  PRIMARY KEY (`id_projeto`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=UTF8MB4;

INSERT INTO `tb_projeto` (`id_projeto`, `titulo_projeto`, `descricao_projeto`, `orientador_projeto`) VALUES
	(1, 'Sistema de Biblioteca', 'Sistema para controle de empréstimos e devoluções de livros', 'Prof. João Silva'),
	(2, 'E-commerce de Roupas', 'Loja virtual para vendas de roupas com carrinho de compras', 'Profª Maria Souza'),
	(3, 'Gestão de Restaurante', 'Sistema para controle de pedidos e mesas de um restaurante', 'Prof. Carlos Pereira'),
	(4, 'Agenda Online', 'Aplicativo para agendamento de compromissos com notificações', 'Profª Ana Oliveira'),
	(5, 'Controle de Estoque', 'Sistema para gerenciamento de entrada e saída de produtos', 'Prof. Paulo Mendes'),
	(6, 'Plataforma de Cursos', 'Portal online para cadastro e acompanhamento de cursos', 'Profª Juliana Costa'),
	(7, 'Sistema de Votação', 'Aplicativo para votação eletrônica com relatórios de resultados', 'Prof. Ricardo Gomes'),
	(8, 'Rede Social Acadêmica', 'Plataforma de interação entre estudantes e professores', 'Profª Fernanda Lima'),
	(9, 'App de Saúde', 'Aplicativo para monitoramento de atividades físicas e saúde', 'Prof. Marcelo Santos'),
	(10, 'Controle Financeiro', 'Sistema para controle de contas pessoais e relatórios', 'Profª Patrícia Rocha'),
	(11, 'Gerenciador de Tarefas', 'Aplicação para organização de tarefas e projetos', 'Prof. André Martins'),
	(12, 'Sistema de Hotel', 'Software para reservas, check-in e check-out de hóspedes', 'Profª Beatriz Nunes'),
	(13, 'Marketplace Local', 'Plataforma para vendas de produtos locais online', 'Prof. Gustavo Ferreira'),
	(14, 'Sistema de Chamados', 'Aplicação para abertura e acompanhamento de tickets de suporte', 'Profª Camila Ramos'),
	(15, 'Monitor de Tráfego', 'Sistema para análise e monitoramento de tráfego urbano', 'Prof. Eduardo Barbosa'),
	(16, 'Loja de Música Online', 'Portal para compra e streaming de músicas', 'Profª Cláudia Mendes'),
	(17, 'Aplicativo de Viagens', 'App para planejamento de roteiros e reservas de viagens', 'Prof. Fábio Almeida'),
	(18, 'Controle Escolar', 'Sistema de notas, faltas e relatórios escolares', 'Profª Daniela Castro'),
	(19, 'Gerenciador de Eventos', 'Plataforma para cadastro e divulgação de eventos', 'Prof. Leonardo Vieira'),
	(20, 'Sistema de Doações', 'Aplicativo para intermediar doações entre pessoas e ONGs', 'Profª Renata Carvalho');

CREATE TABLE IF NOT EXISTS `tb_sala` (
  `id_sala` int(11) NOT NULL AUTO_INCREMENT,
  `nome_sala` varchar(30) NOT NULL,
  PRIMARY KEY (`id_sala`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=UTF8MB4;

INSERT INTO `tb_sala` (`id_sala`, `nome_sala`) VALUES
	(1, 'Sala 1'),
	(2, 'Sala 2'),
	(3, 'Sala 3'),
	(4, 'Sala 4'),
	(5, 'Sala 5'),
	(6, 'Sala 6'),
	(7, 'Sala 7'),
	(8, 'Sala 8'),
	(9, 'Biblioteca'),
	(10, 'Pátio'),
	(11, 'Laboratório de Química 1'),
	(12, 'Laboratório de Química 2'),
	(13, 'Laboratório de Química 3'),
	(14, 'Laboratório de Química 4');

CREATE TABLE IF NOT EXISTS `tb_usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `is_admin` bit(1) NOT NULL DEFAULT b'0',
  `nome_usuario` varchar(50) NOT NULL,
  `email_usuario` varchar(255) NOT NULL UNIQUE,
  `senha_usuario` varchar(255) DEFAULT NULL,
  `data_nascimento_usuario` date NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=UTF8MB4;

INSERT INTO `tb_usuario` (`id_usuario`, `is_admin`, `nome_usuario`, `email_usuario`, `senha_usuario`, `data_nascimento_usuario`) VALUES
	(1, b'1', 'Miguel Sommerfeld', 'miguel.sommerfeldluiz@gmail.com', '$2y$10$d1dtWpjR7p0e54bdnddO0elRGp8DVSju0.nyLcyNKO15M39Z4TlLO', '2007-10-27'),
	(2, b'1', 'Enzo', 'prenzo0001@gmail.com', '$2y$10$5PoYUmQpaw8OnapygZtt1.Cnq5AQiaeqWucYP2Vca/s7CqgN1kbfi', '2008-02-06');
	(3, b'1', 'Eduardo', 'eduardoataidemelo@gmail.com', '$2y$10$JO/XVvv7MXgxU6NSRDbugeVTdODGTKjkpr5dhwk0XgeqYdhOIT7Pe', '2008-05-18'),

CREATE TABLE IF NOT EXISTS `tb_feedback` (
  `id_feedback` int(4) NOT NULL AUTO_INCREMENT,
  `fk_id_usuario` int(11) NOT NULL,
  `nota_feedback` int(11) NOT NULL,
  `comentario_feedback` varchar(255) DEFAULT NULL,
  `data_envio_feedback` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_feedback`),
  KEY `id_usuario` (`fk_id_usuario`),
  CONSTRAINT `tb_feedback_ibfk_1` FOREIGN KEY (`fk_id_usuario`) REFERENCES `tb_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8MB4;

CREATE TABLE IF NOT EXISTS `tb_ods_projeto` (
  `fk_id_ods` int(11) NOT NULL,
  `fk_id_projeto` int(11) NOT NULL,
  KEY `id_ods` (`fk_id_ods`),
  KEY `id_projeto` (`fk_id_projeto`),
  CONSTRAINT `tb_ods_projeto_ibfk_1` FOREIGN KEY (`fk_id_ods`) REFERENCES `tb_ods` (`id_ods`),
  CONSTRAINT `tb_ods_projeto_ibfk_2` FOREIGN KEY (`fk_id_projeto`) REFERENCES `tb_projeto` (`id_projeto`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8MB4;

INSERT INTO `tb_ods_projeto` (`fk_id_ods`, `fk_id_projeto`) VALUES
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

CREATE TABLE IF NOT EXISTS `tb_voto` (
  `id_voto` int(11) NOT NULL AUTO_INCREMENT,
  `data_hora_voto` datetime NOT NULL DEFAULT current_timestamp(),
  `valor_voto` int(11) NOT NULL,
  `comentario_voto` varchar(200) DEFAULT NULL,
  `fk_id_usuario` int(11) NOT NULL,
  `fk_id_projeto` int(11) NOT NULL,
  PRIMARY KEY (`id_voto`),
  KEY `id_projeto` (`fk_id_projeto`),
  KEY `id_usuario` (`fk_id_usuario`),
  CONSTRAINT `id_projeto` FOREIGN KEY (`fk_id_projeto`) REFERENCES `tb_projeto` (`id_projeto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_usuario` FOREIGN KEY (`fk_id_usuario`) REFERENCES `tb_usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=UTF8MB4;

CREATE TABLE IF NOT EXISTS `tb_voto_backup` (
  `id_voto` int(11) NOT NULL AUTO_INCREMENT,
  `data_hora_voto` datetime NOT NULL,
  `valor_voto` int(11) NOT NULL,
  `comentario_voto` varchar(200) DEFAULT NULL,
  `fk_id_usuario` int(11) NOT NULL,
  `fk_id_projeto` int(11) NOT NULL,
  PRIMARY KEY (`id_voto`)
 )

CREATE TABLE IF NOT EXISTS `tb_projeto_aluno` (
  `fk_id_projeto` int(11) NOT NULL,
  `fk_id_aluno` int(11) NOT NULL,
  KEY `id_projeto_integrantes` (`fk_id_projeto`),
  KEY `id_alunos_integrantes` (`fk_id_aluno`),
  CONSTRAINT `id_alunos_integrantes` FOREIGN KEY (`fk_id_aluno`) REFERENCES `tb_aluno` (`id_aluno`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_projeto_integrantes` FOREIGN KEY (`fk_id_projeto`) REFERENCES `tb_projeto` (`id_projeto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=UTF8MB4;

INSERT INTO `tb_projeto_aluno` (`fk_id_projeto`, `fk_id_aluno`) VALUES
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

CREATE TABLE IF NOT EXISTS `tb_localizacao_projeto` (
  `fk_id_bloco` int(11) NOT NULL,
  `fk_id_sala` int(11) NOT NULL,
  `fk_id_projeto` int(11) NOT NULL,
  KEY `fk_id_bloco` (`fk_id_bloco`),
  KEY `fk_id_sala` (`fk_id_sala`),
  KEY `fk_id_projeto` (`fk_id_projeto`),
  CONSTRAINT `tb_localizacao_projeto_ibfk_1` FOREIGN KEY (`fk_id_bloco`) REFERENCES `tb_bloco` (`id_bloco`),
  CONSTRAINT `tb_localizacao_projeto_ibfk_2` FOREIGN KEY (`fk_id_sala`) REFERENCES `tb_sala` (`id_sala`),
  CONSTRAINT `tb_localizacao_projeto_ibfk_4` FOREIGN KEY (`fk_id_projeto`) REFERENCES `tb_projeto` (`id_projeto`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8MB4;

INSERT INTO `tb_localizacao_projeto` (`fk_id_bloco`, `fk_id_sala`, `fk_id_projeto`) VALUES
	(1, 6, 1),
	(1, 6, 2),
	(1, 5, 3),
	(1, 5, 4),
	(1, 5, 5),
	(1, 7, 6),
	(1, 8, 7),
	(1, 4, 8),
	(1, 4, 9),
	(1, 3, 10),
	(2, 5, 11),
	(2, 5, 12),
	(2, 5, 13),
	(2, 3, 14),
	(2, 3, 15),
	(2, 3, 16),
	(2, 2, 17),
	(2, 2, 18),
	(2, 4, 19),
	(2, 9, 20);