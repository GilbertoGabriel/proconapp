-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 13-Abr-2022 às 13:00
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `proconapp`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(80) NOT NULL,
  `foto` varchar(40) NOT NULL,
  `cadastrado` datetime NOT NULL,
  `modificado` datetime NOT NULL,
  `cor` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cor` (`cor`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `foto`, `cadastrado`, `modificado`, `cor`) VALUES
(1, 'Alimentos', '20b6a536da86b3e8a1da992cab3ee470.jpg', '2022-04-12 10:57:04', '2022-04-12 10:57:04', 3),
(2, 'Gás cozinha', '10b9d23dd0a3cb19a93d1290be05c23f.jpg', '2022-04-12 11:22:49', '2022-04-12 11:22:49', 2),
(3, 'qqqq', 'f23434c836b71fa4a33a68848249c9f7.jpg', '2022-04-12 11:30:44', '2022-04-12 11:30:44', 1),
(4, 'eeee', 'a993bec934d2dc1f7d07903040b42983.jpg', '2022-04-12 11:30:50', '2022-04-12 11:30:50', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cores`
--

DROP TABLE IF EXISTS `cores`;
CREATE TABLE IF NOT EXISTS `cores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cor` varchar(80) NOT NULL,
  `hexadecimal` varchar(20) NOT NULL,
  `cadastrado` datetime NOT NULL,
  `modificado` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cores`
--

INSERT INTO `cores` (`id`, `cor`, `hexadecimal`, `cadastrado`, `modificado`) VALUES
(1, 'gz-red-tag', '#cc2b2b', '1900-01-01 00:00:00', '1900-01-01 00:00:00'),
(2, 'gz-green-tag', '#00695c', '1900-01-01 00:00:00', '1900-01-01 00:00:00'),
(3, 'gz-blue-tag', '#0057ff', '1900-01-01 00:00:00', '1900-01-01 00:00:00'),
(4, 'gz-yellow-tag', '#f4b400', '1900-01-01 00:00:00', '1900-01-01 00:00:00'),
(5, 'gz-gray-tag', '#eeeeee', '1900-01-01 00:00:00', '1900-01-01 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `enderecos`
--

DROP TABLE IF EXISTS `enderecos`;
CREATE TABLE IF NOT EXISTS `enderecos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logradouro` varchar(160) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `bairro` varchar(80) NOT NULL,
  `cidade` varchar(80) NOT NULL,
  `complemento` varchar(80) NOT NULL,
  `cep` int(11) NOT NULL,
  `cadastrado` datetime NOT NULL,
  `modificado` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `estabelecimentos`
--

DROP TABLE IF EXISTS `estabelecimentos`;
CREATE TABLE IF NOT EXISTS `estabelecimentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estabelecimento` varchar(160) NOT NULL,
  `cnpj` varchar(20) NOT NULL,
  `endereco` int(11) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `celular2` varchar(20) NOT NULL,
  `email` varchar(160) NOT NULL,
  `cadastrado` datetime NOT NULL,
  `modificado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cep` (`endereco`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `marcas`
--

DROP TABLE IF EXISTS `marcas`;
CREATE TABLE IF NOT EXISTS `marcas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(80) NOT NULL,
  `cadastrado` datetime NOT NULL,
  `modificado` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `marcas`
--

INSERT INTO `marcas` (`id`, `marca`, `cadastrado`, `modificado`) VALUES
(1, 'Marca 1', '2022-04-12 10:55:04', '2022-04-12 10:55:04');

-- --------------------------------------------------------

--
-- Estrutura da tabela `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(80) NOT NULL,
  `cadastrado` datetime NOT NULL,
  `modificado` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `menus`
--

INSERT INTO `menus` (`id`, `menu`, `cadastrado`, `modificado`) VALUES
(1, 'Barra de menu', '1900-01-01 00:00:00', '1900-01-01 00:00:00'),
(2, 'Cadastros', '1900-01-01 00:00:00', '1900-01-01 00:00:00'),
(3, 'Configurações', '1900-01-01 00:00:00', '1900-01-01 00:00:00'),
(4, 'Subpasta', '1900-01-01 00:00:00', '1900-01-01 00:00:00'),
(5, 'Não aplicável', '1900-01-01 00:00:00', '1900-01-01 00:00:00'),
(6, 'Relatórios', '1900-01-01 00:00:00', '1900-01-01 00:00:00'),
(7, 'Pré-cadastrados', '1900-01-01 00:00:00', '1900-01-01 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil_tela`
--

DROP TABLE IF EXISTS `perfil_tela`;
CREATE TABLE IF NOT EXISTS `perfil_tela` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cadastrado` datetime NOT NULL,
  `modificado` datetime NOT NULL,
  `perfil` int(11) NOT NULL,
  `tela` int(11) NOT NULL,
  `permissao` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `perfil` (`perfil`),
  KEY `tela` (`tela`),
  KEY `permissao` (`permissao`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `perfil_tela`
--

INSERT INTO `perfil_tela` (`id`, `cadastrado`, `modificado`, `perfil`, `tela`, `permissao`) VALUES
(1, '1900-01-01 00:00:00', '1900-01-01 00:00:00', 1, 1, 4),
(2, '1900-01-01 00:00:00', '1900-01-01 00:00:00', 1, 2, 4),
(3, '1900-01-01 00:00:00', '1900-01-01 00:00:00', 1, 3, 4),
(4, '1900-01-01 00:00:00', '1900-01-01 00:00:00', 1, 4, 4),
(5, '1900-01-01 00:00:00', '1900-01-01 00:00:00', 1, 5, 4),
(6, '2022-04-12 10:51:57', '2022-04-12 10:51:57', 1, 17, 4),
(7, '2022-04-12 10:52:05', '2022-04-12 10:52:05', 1, 16, 4),
(8, '2022-04-12 10:52:08', '2022-04-12 10:52:08', 1, 15, 4),
(9, '2022-04-12 10:52:15', '2022-04-12 10:52:15', 1, 14, 4),
(10, '2022-04-12 10:52:18', '2022-04-12 10:52:18', 1, 13, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfis`
--

DROP TABLE IF EXISTS `perfis`;
CREATE TABLE IF NOT EXISTS `perfis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perfil` varchar(80) NOT NULL,
  `cadastrado` datetime NOT NULL,
  `modificado` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `perfis`
--

INSERT INTO `perfis` (`id`, `perfil`, `cadastrado`, `modificado`) VALUES
(1, 'Developer', '1900-01-01 00:00:00', '1900-01-01 00:00:00'),
(2, 'User', '1900-01-01 00:00:00', '1900-01-01 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissoes`
--

DROP TABLE IF EXISTS `permissoes`;
CREATE TABLE IF NOT EXISTS `permissoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permissao` varchar(80) NOT NULL,
  `cadastrado` datetime NOT NULL,
  `modificado` datetime NOT NULL,
  `cor` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cor` (`cor`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `permissoes`
--

INSERT INTO `permissoes` (`id`, `permissao`, `cadastrado`, `modificado`, `cor`) VALUES
(1, 'Somente leitura', '1900-01-01 00:00:00', '1900-01-01 00:00:00', 5),
(2, 'Leitura e escrita', '1900-01-01 00:00:00', '1900-01-01 00:00:00', 3),
(3, 'Leitura, escrita e edição', '1900-01-01 00:00:00', '1900-01-01 00:00:00', 4),
(4, 'Controle total', '1900-01-01 00:00:00', '1900-01-01 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produto` varchar(80) NOT NULL,
  `cadastrado` datetime NOT NULL,
  `modificado` datetime NOT NULL,
  `categoria` int(11) NOT NULL,
  `marca` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categoria` (`categoria`),
  KEY `marca` (`marca`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `produto`, `cadastrado`, `modificado`, `categoria`, `marca`) VALUES
(1, 'Arroz', '2022-04-12 10:57:14', '2022-04-12 10:57:14', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto_precos`
--

DROP TABLE IF EXISTS `produto_precos`;
CREATE TABLE IF NOT EXISTS `produto_precos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produto_preco` double NOT NULL,
  `cadastrado` datetime NOT NULL,
  `modificado` datetime NOT NULL,
  `produto` int(11) NOT NULL,
  `estabelecimento` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `produto` (`produto`),
  KEY `estabelecimento` (`estabelecimento`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `situacoes_registros`
--

DROP TABLE IF EXISTS `situacoes_registros`;
CREATE TABLE IF NOT EXISTS `situacoes_registros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `situacao_registro` varchar(80) NOT NULL,
  `cadastrado` datetime NOT NULL,
  `modificado` datetime NOT NULL,
  `cor` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cor` (`cor`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `situacoes_registros`
--

INSERT INTO `situacoes_registros` (`id`, `situacao_registro`, `cadastrado`, `modificado`, `cor`) VALUES
(1, 'Ativo', '1900-01-01 00:00:00', '1900-01-01 00:00:00', 2),
(2, 'Desativado', '1900-01-01 00:00:00', '1900-01-01 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `telas`
--

DROP TABLE IF EXISTS `telas`;
CREATE TABLE IF NOT EXISTS `telas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tela` varchar(80) NOT NULL,
  `identificador` varchar(80) NOT NULL,
  `cadastrado` datetime NOT NULL,
  `modificado` datetime NOT NULL,
  `menu` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `menu` (`menu`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `telas`
--

INSERT INTO `telas` (`id`, `tela`, `identificador`, `cadastrado`, `modificado`, `menu`) VALUES
(1, 'Menus', 'menus', '1900-01-01 00:00:00', '1900-01-01 00:00:00', 5),
(2, 'Telas', 'telas', '1900-01-01 00:00:00', '1900-01-01 00:00:00', 3),
(3, 'Perfis', 'perfis', '1900-01-01 00:00:00', '1900-01-01 00:00:00', 3),
(4, 'Telas do perfil', 'perfil_tela', '1900-01-01 00:00:00', '1900-01-01 00:00:00', 4),
(5, 'Usuários', 'usuarios', '1900-01-01 00:00:00', '1900-01-01 00:00:00', 3),
(6, 'Situações de registros', 'situacoes_registros', '1900-01-01 00:00:00', '1900-01-01 00:00:00', 5),
(7, 'Permissões', 'permissoes', '1900-01-01 00:00:00', '1900-01-01 00:00:00', 5),
(8, 'Dashboard', 'dashboard', '1900-01-01 00:00:00', '1900-01-01 00:00:00', 1),
(9, 'Minha conta', 'minha_conta', '1900-01-01 00:00:00', '1900-01-01 00:00:00', 1),
(10, 'Mudar foto', 'mudar_foto', '1900-01-01 00:00:00', '1900-01-01 00:00:00', 1),
(11, 'Cores', 'cores', '1900-01-01 00:00:00', '1900-01-01 00:00:00', 5),
(13, 'Categorias', 'categorias', '2022-04-12 10:48:56', '2022-04-12 10:48:56', 2),
(14, 'Estabelecimentos', 'estabelecimentos', '2022-04-12 10:49:34', '2022-04-12 10:49:34', 2),
(15, 'Marcas', 'marcas', '2022-04-12 10:49:44', '2022-04-12 10:49:44', 2),
(16, 'Produtos', 'produtos', '2022-04-12 10:49:55', '2022-04-12 10:49:55', 2),
(17, 'Preços de produtos', 'produto_precos', '2022-04-12 10:50:21', '2022-04-12 10:50:21', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `senha` varchar(80) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `access_token` varchar(80) NOT NULL,
  `access_token_expiration` datetime NOT NULL,
  `password_token` varchar(80) NOT NULL,
  `password_token_expiration` datetime NOT NULL,
  `activation_token` varchar(80) NOT NULL,
  `activation_token_expiration` datetime NOT NULL,
  `cadastrado` datetime NOT NULL,
  `modificado` datetime NOT NULL,
  `perfil` int(11) NOT NULL,
  `situacao_registro` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `situacao_registro` (`situacao_registro`),
  KEY `perfil` (`perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `email`, `senha`, `foto`, `access_token`, `access_token_expiration`, `password_token`, `password_token_expiration`, `activation_token`, `activation_token_expiration`, `cadastrado`, `modificado`, `perfil`, `situacao_registro`) VALUES
(1, 'Root', 'root@wtag.com.br', '21232f297a57a5a743894a0e4a801fc3', '', '', '1900-01-01 00:00:00', '', '1900-01-01 00:00:00', '', '1900-01-01 00:00:00', '1900-01-01 00:00:00', '1900-01-01 00:00:00', 1, 1);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `categorias_ibfk_1` FOREIGN KEY (`cor`) REFERENCES `cores` (`id`);

--
-- Limitadores para a tabela `estabelecimentos`
--
ALTER TABLE `estabelecimentos`
  ADD CONSTRAINT `estabelecimentos_ibfk_1` FOREIGN KEY (`endereco`) REFERENCES `enderecos` (`id`);

--
-- Limitadores para a tabela `perfil_tela`
--
ALTER TABLE `perfil_tela`
  ADD CONSTRAINT `perfil_tela_ibfk_1` FOREIGN KEY (`perfil`) REFERENCES `perfis` (`id`),
  ADD CONSTRAINT `perfil_tela_ibfk_2` FOREIGN KEY (`permissao`) REFERENCES `permissoes` (`id`),
  ADD CONSTRAINT `perfil_tela_ibfk_3` FOREIGN KEY (`tela`) REFERENCES `telas` (`id`);

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `produtos_ibfk_2` FOREIGN KEY (`marca`) REFERENCES `marcas` (`id`);

--
-- Limitadores para a tabela `produto_precos`
--
ALTER TABLE `produto_precos`
  ADD CONSTRAINT `produto_precos_ibfk_1` FOREIGN KEY (`produto`) REFERENCES `produtos` (`id`),
  ADD CONSTRAINT `produto_precos_ibfk_2` FOREIGN KEY (`estabelecimento`) REFERENCES `estabelecimentos` (`id`);

--
-- Limitadores para a tabela `situacoes_registros`
--
ALTER TABLE `situacoes_registros`
  ADD CONSTRAINT `situacoes_registros_ibfk_1` FOREIGN KEY (`cor`) REFERENCES `cores` (`id`);

--
-- Limitadores para a tabela `telas`
--
ALTER TABLE `telas`
  ADD CONSTRAINT `telas_ibfk_1` FOREIGN KEY (`menu`) REFERENCES `menus` (`id`);

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_3` FOREIGN KEY (`situacao_registro`) REFERENCES `situacoes_registros` (`id`),
  ADD CONSTRAINT `usuarios_ibfk_6` FOREIGN KEY (`perfil`) REFERENCES `perfis` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
