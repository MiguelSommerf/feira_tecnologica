'-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26-Ago-2025 às 21:51
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `feira`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_aluno`
--

CREATE TABLE `tb_aluno` (
  `id_aluno` int(11) NOT NULL,
  `nome_aluno` varchar(100) NOT NULL,
  `serie_aluno` enum('1','2','3') NOT NULL,
  `curso_aluno` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_aluno`
--

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_feedback`
--

CREATE TABLE `tb_feedback` (
  `id_feedback` int(4) NOT NULL,
  `fk_id_usuario` int(11) NOT NULL,
  `nota_feedback` int(11) NOT NULL,
  `comentario_feedback` varchar(255) DEFAULT NULL,
  `data_envio_feedback` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_ods`
--

CREATE TABLE `tb_ods` (
  `id_ods` int(11) NOT NULL,
  `nome_ods` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_ods`
--

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_ods_projeto`
--

CREATE TABLE `tb_ods_projeto` (
  `fk_id_ods` int(11) NOT NULL,
  `fk_id_projeto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_ods_projeto`
--

INSERT INTO `tb_ods_projeto` (`fk_id_ods`, `fk_id_projeto`) VALUES
(7, 1),
(11, 1),
(2, 2),
(14, 2),
(15, 2),
(2, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_projeto`
--

CREATE TABLE `tb_projeto` (
  `id_projeto` int(11) NOT NULL,
  `titulo_projeto` varchar(100) NOT NULL,
  `descricao_projeto` varchar(255) NOT NULL,
  `bloco_projeto` enum('A','B') NOT NULL,
  `sala_projeto` varchar(20) NOT NULL,
  `posicao_projeto` int(11) NOT NULL,
  `stand_projeto` varchar(3) NOT NULL,
  `orientador_projeto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_projeto`
--

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_projeto_aluno`
--

CREATE TABLE `tb_projeto_aluno` (
  `fk_id_projeto` int(11) NOT NULL,
  `fk_id_aluno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_projeto_aluno`
--

INSERT INTO `tb_projeto_aluno` (`fk_id_projeto`, `fk_id_aluno`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuario`
--

CREATE TABLE `tb_usuario` (
  `id_usuario` int(11) NOT NULL,
  `is_admin` bit(1) NOT NULL DEFAULT b'0',
  `nome_usuario` varchar(50) NOT NULL,
  `email_usuario` varchar(255) NOT NULL,
  `senha_usuario` varchar(255) DEFAULT NULL,
  `data_nascimento_usuario` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_usuario`
--

INSERT INTO `tb_usuario` (`id_usuario`, `is_admin`, `nome_usuario`, `email_usuario`, `senha_usuario`, `data_nascimento_usuario`) VALUES
(1, b'0', 'teste1', 'teste1@gmail.com', '12345678', '2025-07-01'),
(2, b'0', 'teste2', 'teste2@gmail.com', '12345678', '2025-07-16'),
(3, b'0', 'teste3', 'teste3@gmail.com', '12345678', '2025-07-10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_voto`
--

CREATE TABLE `tb_voto` (
  `id_voto` int(11) NOT NULL,
  `data_hora_voto` datetime NOT NULL,
  `valor_voto` int(11) NOT NULL,
  `comentario_voto` varchar(200) DEFAULT NULL,
  `fk_id_usuario` int(11) NOT NULL,
  `fk_id_projeto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_voto`
--

INSERT INTO `tb_voto` (`id_voto`, `data_hora_voto`, `valor_voto`, `comentario_voto`, `fk_id_usuario`, `fk_id_projeto`) VALUES
(1, '2025-07-28 21:51:44', 100, NULL, 2, 3),
(2, '2025-07-28 21:51:44', 0, 'abcd', 3, 1),
(3, '2025-07-28 21:51:44', 50, '', 3, 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_aluno`
--
ALTER TABLE `tb_aluno`
  ADD PRIMARY KEY (`id_aluno`);

--
-- Índices para tabela `tb_feedback`
--
ALTER TABLE `tb_feedback`
  ADD PRIMARY KEY (`id_feedback`),
  ADD KEY `id_users` (`fk_id_usuario`);

--
-- Índices para tabela `tb_ods`
--
ALTER TABLE `tb_ods`
  ADD PRIMARY KEY (`id_ods`);

--
-- Índices para tabela `tb_ods_projeto`
--
ALTER TABLE `tb_ods_projeto`
  ADD KEY `id_ods` (`fk_id_ods`),
  ADD KEY `id_projetos` (`fk_id_projeto`);

--
-- Índices para tabela `tb_projeto`
--
ALTER TABLE `tb_projeto`
  ADD PRIMARY KEY (`id_projeto`);

--
-- Índices para tabela `tb_projeto_aluno`
--
ALTER TABLE `tb_projeto_aluno`
  ADD KEY `id_projetos_integrantes` (`fk_id_projeto`),
  ADD KEY `id_alunos_integrantes` (`fk_id_aluno`);

--
-- Índices para tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Índices para tabela `tb_voto`
--
ALTER TABLE `tb_voto`
  ADD PRIMARY KEY (`id_voto`),
  ADD KEY `id_projetos` (`fk_id_projeto`),
  ADD KEY `id_users` (`fk_id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_aluno`
--
ALTER TABLE `tb_aluno`
  MODIFY `id_aluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `tb_feedback`
--
ALTER TABLE `tb_feedback`
  MODIFY `id_feedback` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_ods`
--
ALTER TABLE `tb_ods`
  MODIFY `id_ods` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tb_feedback`
--
ALTER TABLE `tb_feedback`
  ADD CONSTRAINT `tb_feedback_ibfk_1` FOREIGN KEY (`fk_id_usuario`) REFERENCES `tb_usuario` (`id_usuario`);

--
-- Limitadores para a tabela `tb_ods_projeto`
--
ALTER TABLE `tb_ods_projeto`
  ADD CONSTRAINT `tb_ods_projeto_ibfk_1` FOREIGN KEY (`fk_id_ods`) REFERENCES `tb_ods` (`id_ods`),
  ADD CONSTRAINT `tb_ods_projeto_ibfk_2` FOREIGN KEY (`fk_id_projeto`) REFERENCES `tb_projeto` (`id_projeto`);

--
-- Limitadores para a tabela `tb_projeto_aluno`
--
ALTER TABLE `tb_projeto_aluno`
  ADD CONSTRAINT `id_alunos_integrantes` FOREIGN KEY (`fk_id_aluno`) REFERENCES `tb_aluno` (`id_aluno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_projetos_integrantes` FOREIGN KEY (`fk_id_projeto`) REFERENCES `tb_projeto` (`id_projeto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tb_voto`
--
ALTER TABLE `tb_voto`
  ADD CONSTRAINT `id_projetos` FOREIGN KEY (`fk_id_projeto`) REFERENCES `tb_projeto` (`id_projeto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_users` FOREIGN KEY (`fk_id_usuario`) REFERENCES `tb_usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
