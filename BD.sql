-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 27-Mar-2017 às 05:52
-- Versão do servidor: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `validadorlattes`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `email` varchar(256) CHARACTER SET latin1 NOT NULL,
  `senha` varchar(256) CHARACTER SET latin1 NOT NULL,
  `nomeCompleto` varchar(128) CHARACTER SET latin1 NOT NULL,
  `dataNascimento` date NOT NULL,
  `genero` varchar(16) CHARACTER SET latin1 NOT NULL,
  `cpf` varchar(16) CHARACTER SET latin1 NOT NULL,
  `rg` varchar(16) CHARACTER SET latin1 NOT NULL,
  `endereco` varchar(256) CHARACTER SET latin1 NOT NULL,
  `cep` varchar(16) CHARACTER SET latin1 NOT NULL,
  `telefone` varchar(32) CHARACTER SET latin1 NOT NULL,
  `dataCriacao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`email`, `senha`, `nomeCompleto`, `dataNascimento`, `genero`, `cpf`, `rg`, `endereco`, `cep`, `telefone`, `dataCriacao`) VALUES
('henriquecunhawd@gmail.com', '$2y$10$9untiQsRAVZt6iSxpe3Sjemm3Dx3ye9y0OFEjkxdSaDrkdOJItdO2', 'Carlos Henrique Andrade Cunha', '1999-08-05', 'M', '060.376.135-67', '34454632', 'Rua L', '49000-483', '(79) 99628-8344', '2017-03-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
