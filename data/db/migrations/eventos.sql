-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 10-Set-2014 às 17:27
-- Versão do servidor: 5.6.12-log
-- versão do PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `eventos`
--
CREATE DATABASE IF NOT EXISTS `eventos` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `eventos`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `caixa`
--

CREATE TABLE IF NOT EXISTS `caixa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_evento` int(11) NOT NULL,
  `id_inscricao` int(11) DEFAULT NULL,
  `dataTransacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` int(11) NOT NULL,
  `valor` decimal(15,2) DEFAULT NULL,
  `historico` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_evento` (`id_evento`),
  KEY `id_inscricao` (`id_inscricao`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `caixa`
--

INSERT INTO `caixa` (`id`, `id_evento`, `id_inscricao`, `dataTransacao`, `id_usuario`, `valor`, `historico`) VALUES
(2, 1, 2, '2014-09-09 20:15:12', 1, '35.50', 'Valor ref. Pagamento de Inscricao do(a) EMERSON RODRIGO DARIO'),
(10, 1, 2, '2014-09-10 16:45:15', 1, '-35.50', 'Valor ref. Estorno de pagamento de Inscricao do(a) EMERSON RODRIGO DARIO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `divulgador`
--

CREATE TABLE IF NOT EXISTS `divulgador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `id_evento` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_evento` (`id_evento`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `divulgador`
--

INSERT INTO `divulgador` (`id`, `nome`, `id_evento`) VALUES
(1, 'Emerson Dário', 1),
(2, 'Fabiana Dário', 1),
(3, 'Hugo Campos', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `evento`
--

CREATE TABLE IF NOT EXISTS `evento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `situacao` int(11) NOT NULL DEFAULT '0',
  `maximoInscricoes` int(11) DEFAULT NULL,
  `realizacao` date NOT NULL,
  `horaInicio` time NOT NULL,
  `previsaoTermino` time NOT NULL,
  `local` varchar(255) DEFAULT NULL,
  `responsavel` varchar(255) NOT NULL,
  `valor` decimal(15,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `evento`
--

INSERT INTO `evento` (`id`, `nome`, `situacao`, `maximoInscricoes`, `realizacao`, `horaInicio`, `previsaoTermino`, `local`, `responsavel`, `valor`) VALUES
(1, 'Chá Mulheres que amam a Deus', 1, 500, '2014-08-23', '16:00:00', '20:00:00', 'Coliseu Eventos', 'Heidy Campos', '35.50'),
(3, 'Evento para testar a inclusão de dados no sistema', 0, 400, '2014-08-30', '15:00:00', '20:00:00', 'Igreja Metodista em Marialva', 'Emerson Dário', '100.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `inscricao`
--

CREATE TABLE IF NOT EXISTS `inscricao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `cpf` varchar(15) DEFAULT NULL,
  `rg` varchar(15) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `id_evento` int(11) NOT NULL,
  `id_divulgador` int(11) NOT NULL,
  `situacao` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_evento` (`id_evento`),
  KEY `id_divulgador` (`id_divulgador`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `inscricao`
--

INSERT INTO `inscricao` (`id`, `nome`, `cpf`, `rg`, `telefone`, `email`, `id_evento`, `id_divulgador`, `situacao`) VALUES
(2, 'EMERSON RODRIGO DARIO', '075.434.009-01', '9.965.399-4', '(44) 9965-5416 ', 'emersonrodrigod@gmail.com', 1, 1, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `lancamento`
--

CREATE TABLE IF NOT EXISTS `lancamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dataInclusao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dataVencimento` date NOT NULL,
  `valor` decimal(15,2) NOT NULL,
  `tipo` int(11) NOT NULL DEFAULT '0',
  `id_usuario` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `situacao` int(11) NOT NULL DEFAULT '0',
  `descricao` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_evento` (`id_evento`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `lancamento`
--

INSERT INTO `lancamento` (`id`, `dataInclusao`, `dataVencimento`, `valor`, `tipo`, `id_usuario`, `id_evento`, `situacao`, `descricao`) VALUES
(1, '2014-09-10 17:17:18', '2014-09-10', '100.00', 0, 1, 1, 0, 'Aluguel do salao');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `ativo` int(11) NOT NULL DEFAULT '1',
  `dataCadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `ativo`, `dataCadastro`, `role`) VALUES
(1, 'Emerson Dário', 'emersonrodrigod@gmail.com', 'f0709631ebf8ef667b07bea8cfae9201ad1092b4', 1, '2014-08-22 19:12:33', 'admin');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `caixa`
--
ALTER TABLE `caixa`
  ADD CONSTRAINT `caixa_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id`),
  ADD CONSTRAINT `caixa_ibfk_2` FOREIGN KEY (`id_inscricao`) REFERENCES `inscricao` (`id`),
  ADD CONSTRAINT `caixa_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Limitadores para a tabela `divulgador`
--
ALTER TABLE `divulgador`
  ADD CONSTRAINT `divulgador_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id`);

--
-- Limitadores para a tabela `inscricao`
--
ALTER TABLE `inscricao`
  ADD CONSTRAINT `inscricao_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id`),
  ADD CONSTRAINT `inscricao_ibfk_2` FOREIGN KEY (`id_divulgador`) REFERENCES `divulgador` (`id`);

--
-- Limitadores para a tabela `lancamento`
--
ALTER TABLE `lancamento`
  ADD CONSTRAINT `lancamento_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `lancamento_ibfk_2` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
