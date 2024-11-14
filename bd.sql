-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 14/11/2024 às 00:52
-- Versão do servidor: 8.3.0
-- Versão do PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `helpfw`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `amigos_cliente`
--

DROP TABLE IF EXISTS `amigos_cliente`;
CREATE TABLE IF NOT EXISTS `amigos_cliente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_cliente` int NOT NULL,
  `id_amigo` varchar(45) DEFAULT NULL,
  `aceito` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`),
  KEY `fk_AMIGOS_CLIENTES1_idx` (`id_cliente`)
);

--
-- Despejando dados para a tabela `amigos_cliente`
--

INSERT INTO `amigos_cliente` (`id`, `id_cliente`, `id_amigo`, `aceito`) VALUES
(1, 1, '2', b'1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `amigos_prestador`
--

DROP TABLE IF EXISTS `amigos_prestador`;
CREATE TABLE IF NOT EXISTS `amigos_prestador` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_amigo` varchar(45) DEFAULT NULL,
  `id_prestador` int NOT NULL,
  `aceito` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`),
  KEY `fk_AMIGOS_copy1_PRESTADOR1_idx` (`id_prestador`)
);

-- --------------------------------------------------------

--
-- Estrutura para tabela `casa`
--

DROP TABLE IF EXISTS `casa`;
CREATE TABLE IF NOT EXISTS `casa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `telefone` varchar(45) DEFAULT NULL,
  `rua` varchar(45) DEFAULT NULL,
  `bairro` varchar(45) DEFAULT NULL,
  `numero` varchar(45) DEFAULT NULL,
  `cidade` varchar(45) DEFAULT NULL,
  `estado` varchar(255) NOT NULL,
  `cep` varchar(45) DEFAULT NULL,
  `complemento` varchar(45) DEFAULT NULL,
  `id_cliente` int NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_CASA_CLIENTES1_idx` (`id_cliente`)
);

--
-- Despejando dados para a tabela `casa`
--

INSERT INTO `casa` (`id`, `telefone`, `rua`, `bairro`, `numero`, `cidade`, `estado`, `cep`, `complemento`, `id_cliente`, `latitude`, `longitude`) VALUES
(1, '(31) 99999-9999', 'Rua Domingos Francisco', 'Nossa Senhora da Conceição', '38', 'Sabará', 'MG', '34505770', 'Casa', 1, '41.9113712', '-88.67400699999999'),
(2, '', 'Rua do Carmo', 'Centro', '52', 'Sabará', 'MG', '34505-460', 'Casa', 1, '38.6342521', '-78.6845688'),
(3, '', 'Rua Serra do Caraça', 'Conjunto Morada da Serra', '194', 'Sabará', 'MG', '34515-690', 'Casa', 1, '36.2379379', '-81.7495442'),
(4, '', 'Rua Domingos Francisco', 'Nossa Senhora da Conceição', '32', 'Sabará', 'MG', '34505-770', 'casa', 1, '39.1291053', '-76.79628989999999');

-- --------------------------------------------------------

--
-- Estrutura para tabela `chamados`
--

DROP TABLE IF EXISTS `chamados`;
CREATE TABLE IF NOT EXISTS `chamados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_cliente` int NOT NULL,
  `id_prestador` int DEFAULT NULL,
  `id_servicos` varchar(255) NOT NULL,
  `id_casa` int NOT NULL,
  `adicionais` text,
  `avaliacao` int DEFAULT NULL,
  `comentario` text,
  `ativo` int NOT NULL,
  `data_aberto` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_fim` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Estrutura para tabela `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_u1` int NOT NULL,
  `id_u2` int NOT NULL,
  PRIMARY KEY (`id`)
);

--
-- Despejando dados para a tabela `chat`
--

INSERT INTO `chat` (`id`, `id_u1`, `id_u2`) VALUES
(2, 1, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `sobrenome` varchar(45) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  `cpf` varchar(45) DEFAULT NULL,
  `rg` varchar(45) DEFAULT NULL,
  `avaliacoes` int DEFAULT NULL,
  `foto` varchar(255) NOT NULL DEFAULT './img/perfil/padrao.jpg',
  PRIMARY KEY (`id`)
);

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `sobrenome`, `email`, `telefone`, `cpf`, `rg`, `avaliacoes`, `foto`) VALUES
(1, 'JoÃ£o Victor', 'Lopes', 'joaovictorloprt@gmail.com', '(31) 99999-9999', '000.000.000-00', 'XX.000.000-0', 0, 'img/perfil/f8d3daf205d2229e3261c1e0e33dd126.jpeg'),
(2, 'NOME', 'SOBRENOME', '123@gmail.com', NULL, NULL, NULL, 0, './img/perfil/padrao.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentarios`
--

DROP TABLE IF EXISTS `comentarios`;
CREATE TABLE IF NOT EXISTS `comentarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_conta` int NOT NULL,
  `id_postagem` int NOT NULL,
  `conteudo` text NOT NULL,
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

--
-- Despejando dados para a tabela `comentarios`
--

INSERT INTO `comentarios` (`id`, `id_conta`, `id_postagem`, `conteudo`, `data`) VALUES
(1, 1, 1, 'dcsafsadsa', '2017-09-19 10:58:41'),
(5, 1, 1, 'teste', '2024-11-13 20:59:47'),
(6, 1, 1, 'teste 23', '2024-11-13 21:02:22');

-- --------------------------------------------------------

--
-- Estrutura para tabela `contas`
--

DROP TABLE IF EXISTS `contas`;
CREATE TABLE IF NOT EXISTS `contas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` text NOT NULL,
  `login` varchar(45) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `id_cliente` int NOT NULL,
  `tipo_conta` enum('1','2') DEFAULT NULL,
  `admin` enum('0','1') DEFAULT '0',
  `data_criado` datetime DEFAULT CURRENT_TIMESTAMP,
  `online` enum('0','1') DEFAULT '0',
  `foto` varchar(255) NOT NULL DEFAULT './img/perfil/padrao.jpg',
  `novato` enum('0','1') NOT NULL DEFAULT '1',
  `biografia` text,
  `informacoes` text,
  `id_casa` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_CONTAS_CLIENTES1_idx` (`id_cliente`)
);

--
-- Despejando dados para a tabela `contas`
--

INSERT INTO `contas` (`id`, `nome`, `login`, `senha`, `id_cliente`, `tipo_conta`, `admin`, `data_criado`, `online`, `foto`, `novato`, `biografia`, `informacoes`, `id_casa`) VALUES
(1, 'JoÃ£o Victor Lopes', 'joaovictorloprt@gmail.com', '850a82cede1bc491dfc9acf1d0fd360b', 1, '1', '1', '2017-08-07 11:20:02', '1', 'img/perfil/f8d3daf205d2229e3261c1e0e33dd126.jpeg', '0', '...qwewe', '...asdasdasd', 1),
(2, 'Gabriel Martins', 'gabriel@gmail.com', '202cb962ac59075b964b07152d234b70', 1, '2', '0', '2017-10-07 17:14:43', '1', './img/perfil/padrao.jpg', '1', '...', '...', NULL),
(3, 'JoÃ£o Victor', '123@gmail.com', '202cb962ac59075b964b07152d234b70', 2, '1', '0', '2017-10-15 22:14:32', '1', './img/perfil/padrao.jpg', '1', '...', '...', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `contasb_prestador`
--

DROP TABLE IF EXISTS `contasb_prestador`;
CREATE TABLE IF NOT EXISTS `contasb_prestador` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `banco` text,
  `numero` text,
  `agencia` text,
  `digito_agencia` int DEFAULT NULL,
  `conta` text,
  `digito_conta` int DEFAULT NULL,
  `validade` text,
  `nome_conta` text,
  `id_prestador` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_CONTASB_PRESTADOR_PRESTADOR1_idx` (`id_prestador`)
);

-- --------------------------------------------------------

--
-- Estrutura para tabela `conversas`
--

DROP TABLE IF EXISTS `conversas`;
CREATE TABLE IF NOT EXISTS `conversas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_envia` int DEFAULT NULL,
  `texto` text,
  `id_chat` int DEFAULT NULL,
  `data` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

--
-- Despejando dados para a tabela `conversas`
--

INSERT INTO `conversas` (`id`, `id_envia`, `texto`, `id_chat`, `data`) VALUES
(32, 1, 'oi', 2, '2024-11-13 19:45:55');

-- --------------------------------------------------------

--
-- Estrutura para tabela `notificacoes`
--

DROP TABLE IF EXISTS `notificacoes`;
CREATE TABLE IF NOT EXISTS `notificacoes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `id_referencia` int NOT NULL,
  `conteudo` text NOT NULL,
  `url` text NOT NULL,
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Estrutura para tabela `postagem`
--

DROP TABLE IF EXISTS `postagem`;
CREATE TABLE IF NOT EXISTS `postagem` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_conta` int NOT NULL,
  `conteudo` text NOT NULL,
  `curtidas` int NOT NULL,
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tipo` int NOT NULL,
  PRIMARY KEY (`id`)
);

--
-- Despejando dados para a tabela `postagem`
--

INSERT INTO `postagem` (`id`, `id_conta`, `conteudo`, `curtidas`, `data`, `tipo`) VALUES
(1, 1, '<p>&nbsp;nytrmj</p>\r\n', 0, '2017-09-19 10:58:19', 1),
(2, 1, '<p>teste</p>\r\n', 0, '2024-11-13 20:02:15', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `prestador`
--

DROP TABLE IF EXISTS `prestador`;
CREATE TABLE IF NOT EXISTS `prestador` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `sobrenome` varchar(45) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  `cpf` varchar(45) DEFAULT NULL,
  `rg` varchar(45) DEFAULT NULL,
  `avaliacoes` int DEFAULT NULL,
  `foto` varchar(255) NOT NULL DEFAULT './img/perfil/padrao.jpg',
  PRIMARY KEY (`id`)
);

--
-- Despejando dados para a tabela `prestador`
--

INSERT INTO `prestador` (`id`, `nome`, `sobrenome`, `email`, `telefone`, `cpf`, `rg`, `avaliacoes`, `foto`) VALUES
(1, 'Gabriel', 'Martins', 'gabriel@gmail.com', NULL, NULL, NULL, 0, './img/perfil/padrao.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `propostas`
--

DROP TABLE IF EXISTS `propostas`;
CREATE TABLE IF NOT EXISTS `propostas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_chamado` int NOT NULL,
  `id_cliente` int NOT NULL,
  `id_prestador` int NOT NULL,
  `proposta` double NOT NULL,
  `comentario` text NOT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Estrutura para tabela `servicos_prestados`
--

DROP TABLE IF EXISTS `servicos_prestados`;
CREATE TABLE IF NOT EXISTS `servicos_prestados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `imagem` text NOT NULL,
  `total` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
);

--
-- Despejando dados para a tabela `servicos_prestados`
--

INSERT INTO `servicos_prestados` (`id`, `nome`, `imagem`, `total`) VALUES
(1, 'Manicure', 'https://ameninadoblog.com/wp-content/uploads/2017/02/Manicure-Profissional.jpg', 0),
(2, 'Cabeleireiro', 'https://commondatastorage.googleapis.com/crazyfdfiles/crazyfiles/uploads/deal/logo/345/app_blowdry.jpg', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
