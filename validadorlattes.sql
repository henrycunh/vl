-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 06-Fev-2018 às 04:28
-- Versão do servidor: 5.7.14
-- PHP Version: 7.0.10

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
-- Estrutura da tabela `curriculo`
--

CREATE TABLE `curriculo` (
  `email` varchar(512) DEFAULT NULL,
  `curriculoId` int(11) NOT NULL,
  `nomePessoa` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `curriculo`
--

INSERT INTO `curriculo` (`email`, `curriculoId`, `nomePessoa`) VALUES
('henriquecunhawd@gmail.com', 2, 'José Augusto Andrade Filho');

-- --------------------------------------------------------

--
-- Estrutura da tabela `edital`
--

CREATE TABLE `edital` (
  `idEdital` int(11) NOT NULL,
  `nome` varchar(256) NOT NULL,
  `dataCriacao` date NOT NULL,
  `vigencia` date NOT NULL,
  `numero` varchar(64) NOT NULL,
  `descricao` text,
  `link` text,
  `visibilidade` int(11) NOT NULL DEFAULT '0',
  `pontMax` int(11) NOT NULL DEFAULT '100'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `edital`
--

INSERT INTO `edital` (`idEdital`, `nome`, `dataCriacao`, `vigencia`, `numero`, `descricao`, `link`, `visibilidade`, `pontMax`) VALUES
(3, 'PROGRAMA INSTITUCIONAL DE BOLSA DE INICIAÇÃO CIENTÍFICA NO ENSINO MÉDIO - PIBIC-EM', '2017-11-30', '2018-07-10', ' 05/2017/PROPEX/IFS/CNPq', '<p>O Instituto Federal de Educa&ccedil;&atilde;o, Ci&ecirc;ncia e Tecnologia de Sergipe - IFS torna p&uacute;blico atrav&eacute;s da Pr&oacute;- Reitoria de Pesquisa e Extens&atilde;o - PROPEX, a abertura do edital de sele&ccedil;&atilde;o de projetos para o Programa Institucional de Bolsas de Inicia&ccedil;&atilde;o Cient&iacute;fica no Ensino M&eacute;dio PIBIC EM/CNPq, vinculados ao Conselho Nacional de Desenvolvimento Cient&iacute;fico e Tecnol&oacute;gico &ndash; CNPq, aos alunos do ensino t&eacute;cnico integrado ao m&eacute;dio do IFS, com dura&ccedil;&atilde;o de 12 (doze) meses a contar da data de in&iacute;cio dos projetos, conforme disposi&ccedil;&otilde;es estipuladas a seguir:</p>', 'uploads/editais/3-edital.pdf', 0, 100),
(9, 'teste_de_regras', '2018-01-30', '2018-01-31', 'teste', NULL, NULL, 0, 100);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ic_artigo`
--

CREATE TABLE `ic_artigo` (
  `emailValidador` varchar(256) COLLATE utf8_bin DEFAULT NULL,
  `dataValidacao` date DEFAULT NULL,
  `validado` tinyint(1) DEFAULT '-1',
  `comprovante` text CHARACTER SET latin1,
  `curriculoId` int(11) NOT NULL,
  `idArtigo` int(11) NOT NULL,
  `titulo` varchar(512) CHARACTER SET latin1 NOT NULL,
  `ano` varchar(5) CHARACTER SET latin1 NOT NULL,
  `tituloPeriodico` varchar(256) CHARACTER SET latin1 NOT NULL,
  `issn` varchar(32) CHARACTER SET latin1 NOT NULL,
  `paginaInicial` varchar(6) CHARACTER SET latin1 NOT NULL,
  `paginaFinal` varchar(6) CHARACTER SET latin1 NOT NULL,
  `pais` varchar(64) CHARACTER SET latin1 NOT NULL,
  `idioma` varchar(32) CHARACTER SET latin1 NOT NULL,
  `autores` text CHARACTER SET latin1 NOT NULL,
  `volume` varchar(8) COLLATE utf8_bin NOT NULL,
  `extrato` varchar(32) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `ic_artigo`
--

INSERT INTO `ic_artigo` (`emailValidador`, `dataValidacao`, `validado`, `comprovante`, `curriculoId`, `idArtigo`, `titulo`, `ano`, `tituloPeriodico`, `issn`, `paginaInicial`, `paginaFinal`, `pais`, `idioma`, `autores`, `volume`, `extrato`) VALUES
(NULL, NULL, -1, NULL, 2, 22, 'Grid job scheduling using Route with Genetic Algorithm support', '2008', 'Telecommunication Systems', '10184864', '1', '', '', 'Inglês', '[\n    {\n        "nomeCompleto": "Rodrigo Fernandes de Mello",\n        "nomeCitacao": "Mello R. F.",\n        "numIdCNPQ": "6840478133476887"\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    },\n    {\n        "nomeCompleto": "Luciano José Senger",\n        "nomeCitacao": "SENGER, L. J.",\n        "numIdCNPQ": "6880696447532558"\n    },\n    {\n        "nomeCompleto": "Laurence T. Yang",\n        "nomeCitacao": "YANG, L. T.",\n        "numIdCNPQ": ""\n    }\n]', '38', ''),
(NULL, NULL, -1, NULL, 2, 23, 'Online behavior change detection in computer games', '2013', 'Expert Systems with Applications', '09574174', '6258', '6265', '', 'Português', '[\n    {\n        "nomeCompleto": "VALLIM, ROSANE M.M.",\n        "nomeCitacao": "VALLIM, ROSANE M.M.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, JOSÉ A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "DE MELLO, RODRIGO F.",\n        "nomeCitacao": "DE MELLO, RODRIGO F.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "DE CARVALHO, ANDRÉ C.P.L.F.",\n        "nomeCitacao": "DE CARVALHO, ANDRÉ C.P.L.F.",\n        "numIdCNPQ": "9674541381385819"\n    }\n]', '40', ''),
('propex@ifs.edu.br', '2017-11-04', 1, '00002-artigo-24.pdf', 2, 24, 'Outliers Detection Using Control Charts for Oil Wells', '2014', 'Asian Journal of Scientific Research', '19921454', '174', '181', '', 'Português', '[\n    {\n        "nomeCompleto": "Daniel Francisco Maranhão Evangelista",\n        "nomeCitacao": "EVANGELISTA, D. F. M.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Glaucio Jose Couri Machado",\n        "nomeCitacao": "MACHADO, G. J. C.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Gabriel Francisco da Silva",\n        "nomeCitacao": "SILVA, G. F.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Suzana Leitão Russo",\n        "nomeCitacao": "RUSSO, S. L.",\n        "numIdCNPQ": "8056542335438905"\n    }\n]', '4', 'b1'),
('propex@ifs.edu.br', '2017-11-04', 1, '00002-artigo-25.pdf', 2, 25, 'Statistical Control of Water Quality in the Aracaju, Sergipe, Brazil', '2014', 'Australian Journal of Basic and Applied Sciences', '19918178', '226', '230', '', 'Português', '[\n    {\n        "nomeCompleto": "Suzana Leitão Russo",\n        "nomeCitacao": "RUSSO, S. L.",\n        "numIdCNPQ": "8056542335438905"\n    },\n    {\n        "nomeCompleto": "SANTOS, M. V. V. dos",\n        "nomeCitacao": "SANTOS, M. V. V. dos",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Lázaro de Souto Araújo",\n        "nomeCitacao": "ARAUJO, L. S.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Ana Eleonora Almeida Paixão",\n        "nomeCitacao": "PAIXAO, A. E.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Maria Emília Camargo",\n        "nomeCitacao": "CAMARGO, M. E.",\n        "numIdCNPQ": "7617091280907670"\n    }\n]', '8', 'b2'),
('propex@ifs.edu.br', '2017-11-04', 1, '00002-artigo-26.pdf', 2, 26, 'Flow Behavior of Santa Maria Airport Landings through Intervention Models', '2014', 'Business Management Dynamics', '20477031', '01', '07', '', 'Inglês', '[\n    {\n        "nomeCompleto": "Daiane Costa Guimarães",\n        "nomeCitacao": "GUIMARAES, D. C.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, JOSÉ A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Ricardo de Santana",\n        "nomeCitacao": "SANTANA, J. R.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Suzana Leitão Russo",\n        "nomeCitacao": "RUSSO, S. L.",\n        "numIdCNPQ": "8056542335438905"\n    }\n]', '4', 'b3'),
(NULL, NULL, -1, NULL, 2, 27, 'Spectral Analysis Applied to Variables of Oil Wells Profiling', '2014', 'World Academy of Science, Engineering and Technology', '13076892', '327', '', '', 'Inglês', '[\n    {\n        "nomeCompleto": "Suzana Leitão Russo",\n        "nomeCitacao": "RUSSO, S. L.",\n        "numIdCNPQ": "8056542335438905"\n    },\n    {\n        "nomeCompleto": "Mayara Laysa de Oliveira Silva",\n        "nomeCitacao": "SILVA, M. L. O.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Vitor Hugo Simon",\n        "nomeCitacao": "SIMON, V. H.",\n        "numIdCNPQ": ""\n    }\n]', '1', ''),
(NULL, NULL, -1, NULL, 2, 28, 'Unsupervised density-based behavior change detection in data streams', '2014', 'Intelligent Data Analysis (Print)', '1088467X', '181', '201', '', 'Inglês', '[\n    {\n        "nomeCompleto": "Rosane M. M. Vallim",\n        "nomeCitacao": "VALLIM, R. M. M.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    },\n    {\n        "nomeCompleto": "Rodrigo Fernandes de Mello",\n        "nomeCitacao": "MELLO, R. F.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "André Carlos Ponce de Leon Carvalho",\n        "nomeCitacao": "CARVALHO, A. C. P. L.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "João Gama",\n        "nomeCitacao": "GAMA, J.",\n        "numIdCNPQ": ""\n    }\n]', '18', ''),
('propex@ifs.edu.br', '2017-11-04', 1, '00002-artigo-29.pdf', 2, 29, 'Technologic Information about Photovoltaic Applied in Urban Residences', '2016', 'World Academy of Science, Engineering and Technology (Online)', '20103778', '1198', '1201', '', 'Inglês', '[\n    {\n        "nomeCompleto": "Stephanie Fabris Russo",\n        "nomeCitacao": "RUSSO, S. F.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Daiane Costa Guimarães",\n        "nomeCitacao": "GUIMARAES, D. C.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Jonas Pedro Fabris",\n        "nomeCitacao": "FABRIS, J. P.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Maria Emília Camargo",\n        "nomeCitacao": "CAMARGO, M. E.",\n        "numIdCNPQ": "7617091280907670"\n    },\n    {\n        "nomeCompleto": "Suzana Leitão Russo",\n        "nomeCitacao": "RUSSO, S. L.",\n        "numIdCNPQ": "8056542335438905"\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.",\n        "numIdCNPQ": ""\n    }\n]', '10', 'a1'),
(NULL, NULL, -1, NULL, 2, 30, 'Redes de colaboração tecnológica através do estudo de co-titularidades de patentes', '2016', 'Interciencia (Caracas)', '03781844', '839', '843', '', 'Português', '[\n    {\n        "nomeCompleto": "Edmara Thaís Neres Menezes",\n        "nomeCitacao": "MENEZES, E. T. N.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Suzana Leitão Russo",\n        "nomeCitacao": "RUSSO, S. L.",\n        "numIdCNPQ": "8056542335438905"\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    },\n    {\n        "nomeCompleto": "Maria Emilia Camargo",\n        "nomeCitacao": "CAMARGO, M. E.",\n        "numIdCNPQ": ""\n    }\n]', '41', 'a2');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ic_banca`
--

CREATE TABLE `ic_banca` (
  `emailValidador` varchar(256) COLLATE utf8_bin DEFAULT NULL,
  `dataValidacao` date DEFAULT NULL,
  `validado` tinyint(1) DEFAULT '-1',
  `comprovante` text CHARACTER SET latin1,
  `curriculoId` int(11) NOT NULL,
  `idBanca` int(11) NOT NULL,
  `tipo` varchar(32) CHARACTER SET latin1 NOT NULL,
  `natureza` varchar(64) CHARACTER SET latin1 NOT NULL,
  `tipoBanca` varchar(64) CHARACTER SET latin1 NOT NULL,
  `titulo` varchar(256) CHARACTER SET latin1 NOT NULL,
  `ano` varchar(8) CHARACTER SET latin1 NOT NULL,
  `homepage` text CHARACTER SET latin1,
  `doi` text CHARACTER SET latin1,
  `nomeCandidato` varchar(128) CHARACTER SET latin1 NOT NULL,
  `nomeInstituicao` varchar(128) CHARACTER SET latin1 NOT NULL,
  `nomeCurso` varchar(128) CHARACTER SET latin1 NOT NULL,
  `participantes` text CHARACTER SET latin1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `ic_banca`
--

INSERT INTO `ic_banca` (`emailValidador`, `dataValidacao`, `validado`, `comprovante`, `curriculoId`, `idBanca`, `tipo`, `natureza`, `tipoBanca`, `titulo`, `ano`, `homepage`, `doi`, `nomeCandidato`, `nomeInstituicao`, `nomeCurso`, `participantes`) VALUES
(NULL, NULL, -1, NULL, 2, 57, '1', 'Graduação', '', 'Aplicação de técnica de esteganografia como ferramental da acessibilidade em sítios Web', '2008', '', '', 'Cristiano Souza de Oliveira', 'Universidade de São Paulo', 'Engenharia da Computação', '[\n    {\n        "nomeCompleto": "Alexandre Cláudio Botazzo Delbem",\n        "nomeCitacao": "DELBEM, A. C. B.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    }\n]'),
(NULL, NULL, -1, NULL, 2, 58, '1', 'Graduação', '', 'Implantação de um servidor de internet e de arquivos na plataforma Linux', '2010', '', '', 'Jair Colombo Filho', 'Universidade de São Paulo', 'Bacharelado em Informática', '[\n    {\n        "nomeCompleto": "José Carlos Maldonado",\n        "nomeCitacao": "MALDONADO, J. C.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    }\n]'),
('propex@ifs.edu.br', '2017-11-04', 1, '00002-banca-59.pdf', 2, 59, '1', 'Graduação', '', 'Aplicação de Redes em um Sistema Preditor de Horários - Um Estudo de Caso', '2010', '', '', 'Thiago Camargo Fernandes', 'Universidade de São Paulo', 'Bacharelado em Informática', '[\n    {\n        "nomeCompleto": "José Carlos Maldonado",\n        "nomeCitacao": "MALDONADO, J. C.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    }\n]'),
(NULL, NULL, -1, NULL, 2, 60, '1', 'Graduação', '', 'Virtualização de Servidores', '2010', '', '', 'Rodrigo Leitão Kehl', 'Universidade de São Paulo', 'Bacharelado em Informática', '[\n    {\n        "nomeCompleto": "Onofre Trindade Junior",\n        "nomeCitacao": "TRINDADE JUNIOR, O.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    }\n]'),
('propex@ifs.edu.br', '2017-11-04', 1, '00002-banca-61.pdf', 2, 61, '1', 'Graduação', '', 'A semiótica como base para criação de personagens de jogos eletrônicos: um estudo de caso', '2014', '', '', 'Amanda Rocha Santos', 'Universidade Federal de Sergipe', 'Design', '[\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Rogério Torres da Silva",\n        "nomeCitacao": "SILVA, R. T.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Márjorie Garrido Severo",\n        "nomeCitacao": "SEVERO, M. G.",\n        "numIdCNPQ": ""\n    }\n]'),
('propex@ifs.edu.br', '2017-11-04', 1, '00002-banca-62.pdf', 2, 62, '1', 'Graduação', '', 'Ajustamento da Série de Acidentes Aéreos Mundiais através do Modelos Holt-Winters', '2014', '', '', 'Antonio Henrique Barbosa Lima', 'Universidade Federal de Sergipe', 'Estatística', '[\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, JOSÉ A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Suzana Leitão Russo",\n        "nomeCitacao": "RUSSO, S. L.",\n        "numIdCNPQ": "8056542335438905"\n    },\n    {\n        "nomeCompleto": "Lázaro de Souto Araújo",\n        "nomeCitacao": "ARAUJO, L. S.",\n        "numIdCNPQ": ""\n    }\n]'),
('propex@ifs.edu.br', '2017-11-04', 1, '00002-banca-63.pdf', 2, 63, '1', 'Graduação', '', 'Arrecadação da Previdência Complementar Aberta: Uma Análise de Desempenho e Casualidade', '2014', '', '', 'Sandra Santos Santa Rosa', 'Universidade Federal de Sergipe', 'Ciências Atuariais', '[\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, JOSÉ A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Íkaro Daniel de Carvalho Barreto",\n        "nomeCitacao": "BARRETO, I. D. C.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Rosilda Benício de Souza",\n        "nomeCitacao": "SOUZA, R. B.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Juliana Kátia da Silva",\n        "nomeCitacao": "SILVA, J. K.",\n        "numIdCNPQ": ""\n    }\n]'),
('propex@ifs.edu.br', '2017-11-04', 1, '00002-banca-64.pdf', 2, 64, '3', 'Mestrado', '', 'DESENVOLVIMENTO TECNOLÓGICO: A PROPRIEDADE INDUSTRIAL NA PRODUÇÃO DA GUITARRA ELÉTRICA E CAPTADORES', '2016', '', '', 'VINICIUS NELSON LAGO SILVA', 'Universidade Federal de Sergipe', 'CIÊNCIA DA PROPRIEDADE INTELECTUAL', '[\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Suzana Leitão Russo",\n        "nomeCitacao": "RUSSO, S. L.",\n        "numIdCNPQ": "8056542335438905"\n    },\n    {\n        "nomeCompleto": "CRISTINA MARIA ASSIS LOPES TAVARES DA MATA HERMIDA QUINTELLA",\n        "nomeCitacao": "QUINTELLA, C.",\n        "numIdCNPQ": ""\n    }\n]'),
('propex@ifs.edu.br', '2017-11-04', 1, '00002-banca-65.pdf', 2, 65, '3', 'Mestrado', '', 'Mensuração da Produção Científica e Tecnológica de Pesquisadores da Universidade Federal de Sergipe Após a Lei de Inovação', '2016', '', '', 'EDMARA THAYS NERES MENEZES', 'Universidade Federal de Sergipe', 'CIÊNCIA DA PROPRIEDADE INTELECTUAL', '[\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, JOSÉ A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Suzana Leitão Russo",\n        "nomeCitacao": "RUSSO, S. L.",\n        "numIdCNPQ": "8056542335438905"\n    },\n    {\n        "nomeCompleto": "Iracema Machado de Aragão Gomes",\n        "nomeCitacao": "GOMES, I. M. A.",\n        "numIdCNPQ": ""\n    }\n]'),
('propex@ifs.edu.br', '2017-11-04', 1, '00002-banca-66.pdf', 2, 66, '3', 'Mestrado', '', 'Hardware Embarcado para Aquisição e Análise de Sinais Vitais usando o Protocolo de Comunicação ModBus', '2016', '', '', 'LUIS OTAVIO SANTOS DE ANDRADE', 'Universidade Federal de Sergipe', 'Ciência da Computação', '[\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "EDWARD DAVID MORENO ORDONEZ",\n        "nomeCitacao": "ORDONEZ, E. D. M.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "ADICINEIA APARECIDA DE OLIVEIRA",\n        "nomeCitacao": "OLIVEIRA, A. A.",\n        "numIdCNPQ": ""\n    }\n]');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ic_caplivro`
--

CREATE TABLE `ic_caplivro` (
  `emailValidador` varchar(256) COLLATE utf8_bin DEFAULT NULL,
  `dataValidacao` date DEFAULT NULL,
  `validado` tinyint(1) DEFAULT '-1',
  `comprovante` text CHARACTER SET latin1,
  `curriculoId` int(11) NOT NULL,
  `idCapLivro` int(11) NOT NULL,
  `tipo` varchar(64) CHARACTER SET latin1 NOT NULL,
  `tituloCap` varchar(256) CHARACTER SET latin1 NOT NULL,
  `ano` varchar(6) CHARACTER SET latin1 NOT NULL,
  `homepage` text CHARACTER SET latin1,
  `doi` text CHARACTER SET latin1,
  `tituloLivro` varchar(128) CHARACTER SET latin1 NOT NULL,
  `pagInicial` varchar(8) CHARACTER SET latin1 NOT NULL,
  `pagFinal` varchar(8) CHARACTER SET latin1 NOT NULL,
  `isbn` varchar(16) CHARACTER SET latin1 NOT NULL,
  `organizadores` varchar(256) CHARACTER SET latin1 NOT NULL,
  `autores` text CHARACTER SET latin1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ic_coordproj`
--

CREATE TABLE `ic_coordproj` (
  `emailValidador` varchar(256) COLLATE utf8_bin DEFAULT NULL,
  `dataValidacao` date DEFAULT NULL,
  `validado` tinyint(1) DEFAULT '-1',
  `comprovante` text CHARACTER SET latin1,
  `curriculoId` int(11) NOT NULL,
  `idCoordProj` int(11) NOT NULL,
  `nomeInstituicao` varchar(64) CHARACTER SET latin1 NOT NULL,
  `anoInicio` varchar(8) CHARACTER SET latin1 NOT NULL,
  `anoFim` varchar(8) CHARACTER SET latin1 NOT NULL,
  `nomeProj` varchar(256) CHARACTER SET latin1 NOT NULL,
  `situacao` varchar(32) CHARACTER SET latin1 NOT NULL,
  `natureza` varchar(32) CHARACTER SET latin1 NOT NULL,
  `descricao` text CHARACTER SET latin1,
  `responsavel` tinyint(1) NOT NULL,
  `equipe` text CHARACTER SET latin1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `ic_coordproj`
--

INSERT INTO `ic_coordproj` (`emailValidador`, `dataValidacao`, `validado`, `comprovante`, `curriculoId`, `idCoordProj`, `nomeInstituicao`, `anoInicio`, `anoFim`, `nomeProj`, `situacao`, `natureza`, `descricao`, `responsavel`, `equipe`) VALUES
('propex@ifs.edu.br', '2018-02-01', 1, '00002-coordProj-26.pdf', 2, 26, 'Universidade Federal de Sergipe', '2015', '2016', 'Incidência Tributária e a Sonegação do IPVA em Sergipe', 'CONCLUIDO', 'PESQUISA', 'Sabe-se que a Receita Pública é uma questão importante para o desenvolvimento dos estados. As recentes crises financeiras e o crescimento das demandas da sociedade configuram um cenário repleto de desafios para a gestão de finanças públicas, cabendo aos gestores aplicar de maneira eficiente os recursos que são arrecadados e geridos pelo estado. Neste sentido, o presente estudo busca analisar o comportamento incidência tributária na Secretaria de Estado da Fazenda de Sergipe (SEFAZ) com relação a sonegação do IPVA, e além disso, busca-se identificar ações que pudessem elucidar o motivo que levem a sonegação de IPVA pelos contribuintes.', 0, '[\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    },\n    {\n        "nomeCompleto": "Glaucio Jose Couri Machado",\n        "nomeCitacao": "MACHADO, G. J. C.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Suzana Leitão Russo",\n        "nomeCitacao": "RUSSO, S. L.",\n        "numIdCNPQ": "8056542335438905"\n    },\n    {\n        "nomeCompleto": "Maria Emília Camargo",\n        "nomeCitacao": "CAMARGO, M. E.",\n        "numIdCNPQ": "7617091280907670"\n    },\n    {\n        "nomeCompleto": "Jonas Pedro Fabris",\n        "nomeCitacao": "FABRIS, J. P.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Iracema Machado de Aragão Gomes",\n        "nomeCitacao": "GOMES, I. M. A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Adonis Reis de Medeiros Filho",\n        "nomeCitacao": "MEDEIROS FILHO, A. R.",\n        "numIdCNPQ": ""\n    }\n]'),
('propex@ifs.edu.br', '2018-02-01', 1, '00002-coordProj-27.pdf', 2, 27, 'Universidade de São Paulo', '2012', '2013', 'Desafios em Mineração de Dados', 'CONCLUIDO', 'PESQUISA', 'Com o volume cada vez maior de dados gerados e a importância crescente da economia baseada em conhecimento, a Descoberta de Conhecimento de Bases de Dados, principalmente sua etapa de Mineração de Dados, é cada vez mais adotada em empresas e órgãos governamentais. A complexidade dos problemas a serem tratados por Mineração de Dados leva a necessidade de novos métodos e ferramentas computacionais capazes de apoiar a análise dos dados pelos usuários. Duas das principais etapas de Mineração de Dados são as de pré-processamento e de construção de modelos. Desafios relacionados a essas duas etapas são investigados neste projeto. Dados com baixa qualidade ou com problemas de elevada dimensão pode afetar significativamente o desempenho de algoritmos para construção de modelos. A etapa de construção de modelos permite induzir modelos descritivos e preditivos, frequentemente por algoritmos de Aprendizado de Máquina. Este projeto investigará as principais alternativas existentes para lidar com esses desafios assim como irá propor e investigar novos métodos para tal. Os métodos investigados serão experimentalmente avaliados de acordo com a metodologia correntemente utilizada pela comunidade de pesquisa das duas subáreas. Dado o elevado custo computacional associado aos experimentos nessas subáreas, serão investigados o uso de arquiteturas GPU e computação em nuvens. Deve ser observado que esse projeto continua pesquisas realizadas em projetos anteriores, com novas abordagens e desafios.', 0, '[\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    },\n    {\n        "nomeCompleto": "Andre C P L F de Carvalho",\n        "nomeCitacao": "CARVALHO, Andre C. P. L. F. de",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Rosane Maria Maffei Vallim",\n        "nomeCitacao": "VALLIM, R. M. M.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Rodrigo Barros",\n        "nomeCitacao": "BARROS, R.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Alex Freitas",\n        "nomeCitacao": "FREITAS, A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Murilo Coelho Naldi",\n        "nomeCitacao": "NALDI, M. C.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "David S. dos Santos Jr",\n        "nomeCitacao": "SANTOS JR, D. S.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Bruno Feres",\n        "nomeCitacao": "FERES, B.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "João Gama",\n        "nomeCitacao": "GAMA, J.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Eduardo Hruschka",\n        "nomeCitacao": "HRUSCHKA, E.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "André Rossi",\n        "nomeCitacao": "ROSSI, A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Luis Paulo Garcia",\n        "nomeCitacao": "GARCIA, L. P.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Ricardo Cerri",\n        "nomeCitacao": "CERRI, R.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Ana Carolina Lorena",\n        "nomeCitacao": "LORENA, A. C.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Carlos M. Soares",\n        "nomeCitacao": "SOARES, C. M.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Elaine Ribeiro",\n        "nomeCitacao": "RIBEIRO, E.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Pablo Granitto",\n        "nomeCitacao": "GRANITTO, P.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Tiago Silva da Silva",\n        "nomeCitacao": "SILVA, T. S.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Jonathan de Andrade Silva",\n        "nomeCitacao": "SILVA, J. A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Luiz Fernando Sommaggio Coletta",\n        "nomeCitacao": "COLETTA, L. F. S.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Thiago Ferreira Covões",\n        "nomeCitacao": "COVOES, T. F.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Dino Ienco",\n        "nomeCitacao": "IENCO, D.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Maguelonne Teisseire",\n        "nomeCitacao": "TEISSEIRE, M.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Pascal Poncelet",\n        "nomeCitacao": "PONCELET, P.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Rogério Miguel Pascual",\n        "nomeCitacao": "PASCUAL, R. M.",\n        "numIdCNPQ": ""\n    }\n]'),
('propex@ifs.edu.br', '2018-02-01', 1, '00002-coordProj-28.pdf', 2, 28, 'Instituto Federal de Sergipe', '2015', '2016', 'Previsão de Arrecadação de ICMS no Estado de Sergipe Utilizando Modelos de Séries Temporais e Técnicas de Aprendizado de Máquina', 'CONCLUIDO', 'PESQUISA', 'A gestão da Receita Pública é de grande importância para o desenvolvimento dos Estados. Com as crises financeiras e o aumento das demandas da sociedade, forma-se um cenário de desafios para a gestão das finanças públicas. É de responsabilidade dos gestores definir de maneira eficiente os recursos arrecadados e geridos pelo Estado. Nesse sentido, a previsão das receitas com tributos e impostos apresenta-se como um desafio, pois dela depende a definição do orçamento. Assim, este projeto tem como objetivo analisar o comportamento da arrecadação do ICMS de modo a definir um modelo de predição ajustado à realidade do Estado de Sergipe, considerando fatores externos como variação de taxa de juros, previsão de inflação, dentre outros. Serão analisados modelos de Séries Temporais, em especial a metodologia Box-Jenkins, e técnicas de aprendizado de máquina, como as Redes Neurais.', 1, '[\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    },\n    {\n        "nomeCompleto": "Maria Emília Camargo",\n        "nomeCitacao": "CAMARGO, M. E.",\n        "numIdCNPQ": "7617091280907670"\n    },\n    {\n        "nomeCompleto": "Chirlaine Cristine Gonçalves",\n        "nomeCitacao": "GONCALVES, C. C.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Jonas Pedro Fabris",\n        "nomeCitacao": "FABRIS, J. P.",\n        "numIdCNPQ": ""\n    }\n]'),
('propex@ifs.edu.br', '2018-02-01', 1, '00002-coordProj-29.pdf', 2, 29, 'Instituto Federal de Sergipe', '2015', '', 'Cidade Tecnológica Sustentável do IFS', 'EM_ANDAMENTO', 'PESQUISA', 'Gerente do Projeto Cidade Tecnológica do IFS', 1, '[\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    },\n    {\n        "nomeCompleto": "Chirlaine Cristine Gonçalves",\n        "nomeCitacao": "GONCALVES, C. C.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Ailton Ribeiro de Oliveira",\n        "nomeCitacao": "OLIVEIRA, A. R.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Ruth Sales Gama de Andrade",\n        "nomeCitacao": "ANDRADE, R. S. G.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Pablo Gleydson de Sousa",\n        "nomeCitacao": "SOUSA, P. G.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Roberto da Silva Macena",\n        "nomeCitacao": "MACENA, R. S.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Espínola da Silva Júnior",\n        "nomeCitacao": "ESPINOLA JR, J.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Fabiana Faxina",\n        "nomeCitacao": "FAXINA, F.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Jaime José da Silveira Barros Neto",\n        "nomeCitacao": "BARROS NETO, J. J. S.",\n        "numIdCNPQ": ""\n    }\n]'),
('propex@ifs.edu.br', '2018-02-01', 1, '00002-coordProj-30.pdf', 2, 30, 'Instituto Federal de Sergipe', '2016', '', 'CRIAÇÃO DE WEBSITE PARA DIVULGAÇÃO E EXPOSIÇÃO DA MARCA, PRODUTOS E AÇÕES DESENVOLVIDOS NA ILHA MEM DE SÁ', 'EM_ANDAMENTO', 'EXTENSAO', 'Mundialmente, o turismo é visto como uma das principais fontes de receitas, competindo com grandes setores da economia. É considerado como uma atividade composta por várias cadeias produtivas e em alguns países, o turismo é visto como decisivo para os rumos do desenvolvimento da localidade. No Brasil, este setor econômico está dividido em oito segmentos, sendo que alguns têm se destacado pela sua intenção sustentável, como é o caso do Ecoturismo, no qual pode estar inserido o Turismo de Base Comunitária. No estado de Sergipe, na Ilha Mem de Sá, a pesca do aratu é uma das atividades econômicas da comunidade, realizada principalmente pelas mulheres e tem sido fortalecida nos últimos anos pela implementação de TBC, através da pesquisa-ação desenvolvida pelo Instituto Federal de Sergipe e parceiros.\nEm geral, a Ilha Mem de Sá tem pouca divulgação e o que é produzido tem sua divulgação restrita, pois essa é feita por meio do "boca-a-boca". Assim, é importante que os atrativos da Ilha Mem de Sá atinjam mais pessoas, uma possibilidade é a utilização de sites na Internet e em redes sociais. Dessa maneira, é possível atingir um público maior a baixo custo e com alcance que não respeita limites geográficos.', 1, '[\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    },\n    {\n        "nomeCompleto": "Chirlaine Cristine Gonçalves",\n        "nomeCitacao": "GONCALVES, C. C.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Luiz Carlos Gonçalves",\n        "nomeCitacao": "GONCALVES, L. C.",\n        "numIdCNPQ": ""\n    }\n]');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ic_corpoeditorial`
--

CREATE TABLE `ic_corpoeditorial` (
  `emailValidador` varchar(256) DEFAULT NULL,
  `dataValidacao` date DEFAULT NULL,
  `validado` tinyint(1) DEFAULT '-1',
  `comprovante` text,
  `curriculoId` int(11) NOT NULL,
  `idCorpoEditorial` int(11) NOT NULL,
  `nomeInstituicao` varchar(128) NOT NULL,
  `codInstituicao` varchar(32) NOT NULL,
  `dataInicio` varchar(8) NOT NULL,
  `dataFim` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ic_corpoeditorial`
--

INSERT INTO `ic_corpoeditorial` (`emailValidador`, `dataValidacao`, `validado`, `comprovante`, `curriculoId`, `idCorpoEditorial`, `nomeInstituicao`, `codInstituicao`, `dataInicio`, `dataFim`) VALUES
(NULL, NULL, -1, NULL, 2, 4, 'Expressão Científica', '000800000994', '06/2015', '/');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ic_livro`
--

CREATE TABLE `ic_livro` (
  `emailValidador` varchar(256) DEFAULT NULL,
  `dataValidacao` date DEFAULT NULL,
  `validado` tinyint(1) DEFAULT '-1',
  `comprovante` text,
  `curriculoId` int(11) NOT NULL,
  `idLivro` int(11) NOT NULL,
  `tipo` varchar(64) NOT NULL,
  `titulo` varchar(256) NOT NULL,
  `ano` varchar(8) NOT NULL,
  `homepage` text,
  `doi` text,
  `idioma` varchar(32) NOT NULL,
  `pais` varchar(32) NOT NULL,
  `meio` varchar(32) NOT NULL,
  `isbn` varchar(32) NOT NULL,
  `numPags` varchar(8) NOT NULL,
  `autores` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ic_marca`
--

CREATE TABLE `ic_marca` (
  `emailValidador` varchar(256) DEFAULT NULL,
  `dataValidacao` date DEFAULT NULL,
  `validado` tinyint(1) DEFAULT '-1',
  `comprovante` text,
  `curriculoId` int(11) NOT NULL,
  `idMarca` int(11) NOT NULL,
  `titulo` varchar(128) NOT NULL,
  `ano` varchar(8) NOT NULL,
  `natureza` varchar(64) NOT NULL,
  `tipo` varchar(64) NOT NULL,
  `codigo` varchar(64) NOT NULL,
  `tituloPatente` varchar(256) NOT NULL,
  `dataConcessao` varchar(16) NOT NULL,
  `instDeposito` varchar(64) NOT NULL,
  `autores` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ic_marca`
--

INSERT INTO `ic_marca` (`emailValidador`, `dataValidacao`, `validado`, `comprovante`, `curriculoId`, `idMarca`, `titulo`, `ano`, `natureza`, `tipo`, `codigo`, `tituloPatente`, `dataConcessao`, `instDeposito`, `autores`) VALUES
(NULL, NULL, -1, NULL, 2, 1, 'PPITA - Polo de Pesquisa e Inovação Tecnológica do IFS', '2016', 'Mista', 'MARCA_REGISTRADA_DE_SERVICO_MSV', 'BR909870616', 'PPITA - Polo de Pesquisa e Inovação Tecnológica do IFS', '', 'INPI - Instituto Nacional da Propriedade Industrial', '[\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, JOSÉ A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Amanda Rocha Santos",\n        "nomeCitacao": "SANTOS, A. R.",\n        "numIdCNPQ": ""\n    }\n]');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ic_organizacaoevento`
--

CREATE TABLE `ic_organizacaoevento` (
  `emailValidador` varchar(256) DEFAULT NULL,
  `dataValidacao` date DEFAULT NULL,
  `validado` tinyint(1) DEFAULT '-1',
  `comprovante` text,
  `curriculoId` int(11) NOT NULL,
  `idOrganizacaoEvento` int(11) NOT NULL,
  `tipo` varchar(64) NOT NULL,
  `natureza` varchar(64) NOT NULL,
  `titulo` varchar(128) NOT NULL,
  `ano` varchar(8) NOT NULL,
  `idioma` varchar(32) NOT NULL,
  `pais` varchar(32) NOT NULL,
  `homepage` text,
  `doi` text,
  `instituicaoPromotora` varchar(128) NOT NULL,
  `cidade` varchar(64) NOT NULL,
  `autores` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ic_organizacaoevento`
--

INSERT INTO `ic_organizacaoevento` (`emailValidador`, `dataValidacao`, `validado`, `comprovante`, `curriculoId`, `idOrganizacaoEvento`, `tipo`, `natureza`, `titulo`, `ano`, `idioma`, `pais`, `homepage`, `doi`, `instituicaoPromotora`, `cidade`, `autores`) VALUES
(NULL, NULL, -1, NULL, 2, 8, 'CONGRESSO', 'ORGANIZACAO', '5th International Symposium on Technological Innovation', '2014', 'Português', 'Brasil', '', '', 'AESPI / PPGPI-UFS', 'Aracaju - SE', '[\n    {\n        "nomeCompleto": "Suzana Leitão Russo",\n        "nomeCitacao": "RUSSO, S. L.",\n        "numIdCNPQ": "8056542335438905"\n    },\n    {\n        "nomeCompleto": "Renata Silva Mann",\n        "nomeCitacao": "MANN, R. S.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, JOSÉ A.",\n        "numIdCNPQ": ""\n    }\n]'),
(NULL, NULL, -1, NULL, 2, 9, 'CONGRESSO', 'ORGANIZACAO', '6th International Symposium on Technological Innovation', '2015', 'Português', 'Brasil', '', '', 'API - Associação de Propriedade Intelectual', 'SE', '[\n    {\n        "nomeCompleto": "Gabriel Francisco da Silva",\n        "nomeCitacao": "SILVA, G. F.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Suzana Leitão Russo",\n        "nomeCitacao": "RUSSO, S. L.",\n        "numIdCNPQ": "8056542335438905"\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Iracema Machado de Aragão Gomes",\n        "nomeCitacao": "GOMES, I. M. A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Glaucio Jose Couri Machado",\n        "nomeCitacao": "MACHADO, G. J. C.",\n        "numIdCNPQ": ""\n    }\n]'),
(NULL, NULL, -1, NULL, 2, 10, 'CONGRESSO', 'ORGANIZACAO', 'SEMPI 2014 - Semana Acadêmica de Propriedade Intelectual', '2014', 'Português', 'Brasil', '', '', 'Universidade Federal de Sergipe', 'Aracaju', '[\n    {\n        "nomeCompleto": "Gabriel Francisco da Silva",\n        "nomeCitacao": "SILVA, G. F.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Glaucio Jose Couri Machado",\n        "nomeCitacao": "MACHADO, G. J. C.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Iracema Machado de Aragão Gomes",\n        "nomeCitacao": "GOMES, I. M. A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Maria Emília Camargo",\n        "nomeCitacao": "CAMARGO, M. E.",\n        "numIdCNPQ": "7617091280907670"\n    },\n    {\n        "nomeCompleto": "Suzana Leitão Russo",\n        "nomeCitacao": "RUSSO, S. L.",\n        "numIdCNPQ": "8056542335438905"\n    }\n]');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ic_orientacao`
--

CREATE TABLE `ic_orientacao` (
  `emailValidador` varchar(256) DEFAULT NULL,
  `dataValidacao` date DEFAULT NULL,
  `validado` tinyint(1) DEFAULT '-1',
  `comprovante` text,
  `curriculoId` int(11) NOT NULL,
  `idOrientacao` int(11) NOT NULL,
  `natureza` varchar(128) NOT NULL,
  `tipo` varchar(64) NOT NULL,
  `titulo` varchar(256) NOT NULL,
  `ano` varchar(8) NOT NULL,
  `idioma` varchar(32) NOT NULL,
  `pais` varchar(32) NOT NULL,
  `homepage` text,
  `doi` text,
  `nomeOrientado` varchar(128) NOT NULL,
  `nomeInstituicao` varchar(128) NOT NULL,
  `nomeCurso` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ic_orientacao`
--

INSERT INTO `ic_orientacao` (`emailValidador`, `dataValidacao`, `validado`, `comprovante`, `curriculoId`, `idOrientacao`, `natureza`, `tipo`, `titulo`, `ano`, `idioma`, `pais`, `homepage`, `doi`, `nomeOrientado`, `nomeInstituicao`, `nomeCurso`) VALUES
(NULL, NULL, -1, NULL, 2, 38, 'Dissertação de mestrado', '4', 'Interface entre condições psicossocioambientais e qualidade de vida no município de Propriá-SE', '2017', 'Português', 'Brasil', '', '', 'Thiago Santos Siqueira', 'Universidade Federal da Paraíba', 'Desenvolvimento e Meio Ambiente'),
(NULL, NULL, -1, NULL, 2, 39, 'TRABALHO_DE_CONCLUSAO_DE_CURSO_GRADUACAO', '2', 'A semiótica como base para criação de personagens de jogos eletrônicos: um estudo de caso', '2014', 'Português', 'Brasil', '', '', 'Amanda Rocha Santos', 'Universidade Federal de Sergipe', 'Design'),
(NULL, NULL, -1, NULL, 2, 40, 'INICIACAO_CIENTIFICA', '1', 'A Probabilidade de Aprender em Jogo Digital', '2014', 'Português', 'Brasil', '', '', 'Mateus Cardoso da Silva', 'Universidade Federal de Sergipe', 'Bacharelado Ciência da Computação'),
(NULL, NULL, -1, NULL, 2, 41, 'INICIACAO_CIENTIFICA', '1', 'Evolução dos Depósitos de Propriedades Industriais no INPI', '2014', 'Português', 'Brasil', '', '', 'Alberth Almeida Amorim Souza', 'Universidade Federal de Sergipe', 'Estatística'),
(NULL, NULL, -1, NULL, 2, 42, 'INICIACAO_CIENTIFICA', '1', 'Análise Séries Temporais no Domínio da Frequência Aplicada em Variáveis de Perfilagem de Poços de Petróleo', '2013', 'Português', 'Brasil', '', '', 'Mayara Laysa de Oliveira Silva', 'Universidade Federal de Sergipe', 'Estatística'),
(NULL, NULL, -1, NULL, 2, 43, 'INICIACAO_CIENTIFICA', '1', 'Mapeamento do potencial de inovação dos resultados de pesquisa desenvolvidas pela UFS&#8207;&#8207;&#8207;&#8207;&#8207;', '2013', 'Português', 'Brasil', '', '', 'Alberth Almeida Amorim Souza', 'Universidade Federal de Sergipe', 'Estatística'),
(NULL, NULL, -1, NULL, 2, 44, 'INICIACAO_CIENTIFICA', '1', 'Análise do Fluxo Aéreo do Aeroporto Santa Maria através de Gráficos de Controle de Shewart', '2014', 'Português', 'Brasil', '', '', 'Daiane Costa Guimaraes', 'Universidade Federal de Sergipe', 'Estatística'),
(NULL, NULL, -1, NULL, 2, 45, 'INICIACAO_CIENTIFICA', '1', 'Previsão de Arrecadação de ICMS no Estado de Sergipe Utilizando Técnicas de Aprendizado de Máquina', '2015', 'Português', 'Brasil', '', '', 'Douglas Pereira Gomes', 'Instituto Federal de Sergipe', ''),
(NULL, NULL, -1, NULL, 2, 46, 'INICIACAO_CIENTIFICA', '1', 'FITPro Soluções', '2015', 'Português', 'Brasil', '', '', 'Carlos Henrique Andrade Cunha', 'Instituto Federal de Sergipe', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ic_partpos`
--

CREATE TABLE `ic_partpos` (
  `idPartPos` int(11) NOT NULL,
  `curriculoId` int(11) DEFAULT NULL,
  `emailValidador` varchar(256) DEFAULT NULL,
  `dataValidacao` date DEFAULT NULL,
  `validado` tinyint(1) DEFAULT NULL,
  `comprovante` text,
  `programa` varchar(128) DEFAULT NULL,
  `ingresso` date DEFAULT NULL,
  `atuacao` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ic_partpos`
--

INSERT INTO `ic_partpos` (`idPartPos`, `curriculoId`, `emailValidador`, `dataValidacao`, `validado`, `comprovante`, `programa`, `ingresso`, `atuacao`) VALUES
(10, 2, 'propex@ifs.edu.br', '2018-02-01', 1, '00002-partPos-10.pdf', 'Dois mil e dez', '2010-10-10', 'permanente'),
(11, 2, 'propex@ifs.edu.br', '2018-02-01', 1, '00002-partPos-11.pdf', 'Dois mil e cinco', '2005-05-05', 'permanente'),
(12, 2, 'propex@ifs.edu.br', '2018-02-01', 1, '00002-partPos-12.pdf', 'Dois mil e doze', '2012-02-01', 'colaborador');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ic_patente`
--

CREATE TABLE `ic_patente` (
  `emailValidador` varchar(256) DEFAULT NULL,
  `dataValidacao` date DEFAULT NULL,
  `validado` tinyint(1) DEFAULT '-1',
  `comprovante` text,
  `curriculoId` int(11) NOT NULL,
  `idPatente` int(11) NOT NULL,
  `titulo` varchar(256) NOT NULL,
  `ano` varchar(8) NOT NULL,
  `categoria` varchar(64) NOT NULL,
  `tipo` varchar(64) NOT NULL,
  `homepage` text,
  `nomeTitular` varchar(128) NOT NULL,
  `codigo` varchar(64) NOT NULL,
  `tituloPatente` varchar(512) NOT NULL,
  `dataConcessao` varchar(16) NOT NULL,
  `instituicaoDeposito` varchar(64) NOT NULL,
  `autores` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ic_software`
--

CREATE TABLE `ic_software` (
  `emailValidador` varchar(256) DEFAULT NULL,
  `dataValidacao` date DEFAULT NULL,
  `validado` tinyint(1) DEFAULT '-1',
  `comprovante` text,
  `curriculoId` int(11) NOT NULL,
  `idSoftware` int(11) NOT NULL,
  `natureza` varchar(64) NOT NULL,
  `titulo` varchar(256) NOT NULL,
  `ano` varchar(8) NOT NULL,
  `homepage` text,
  `doi` text,
  `finalidade` varchar(256) NOT NULL,
  `plataforma` varchar(128) NOT NULL,
  `ambiente` varchar(128) NOT NULL,
  `autores` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ic_titulacao`
--

CREATE TABLE `ic_titulacao` (
  `emailValidador` varchar(256) DEFAULT NULL,
  `dataValidacao` date DEFAULT NULL,
  `validado` tinyint(1) DEFAULT '-1',
  `comprovante` text,
  `curriculoId` int(11) NOT NULL,
  `idTitulacao` int(11) NOT NULL,
  `titulo` varchar(256) NOT NULL,
  `nomeCurso` varchar(128) NOT NULL,
  `instituicao` varchar(128) NOT NULL,
  `orientador` varchar(128) NOT NULL,
  `anoInicio` varchar(8) NOT NULL,
  `anoConclusao` varchar(8) NOT NULL,
  `tipo` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ic_titulacao`
--

INSERT INTO `ic_titulacao` (`emailValidador`, `dataValidacao`, `validado`, `comprovante`, `curriculoId`, `idTitulacao`, `titulo`, `nomeCurso`, `instituicao`, `orientador`, `anoInicio`, `anoConclusao`, `tipo`) VALUES
('propex@ifs.edu.br', '2017-11-04', 1, '00002-titulacao-7.pdf', 2, 7, 'Análise de Vulnerabilidades da Infra-Estrutura de Rede do DCCE', 'Bacharelado Ciência da Computação', 'Universidade Federal de Sergipe', 'Evandro Curvelo Hora', '2000', '2005', '1'),
('propex@ifs.edu.br', '2017-11-04', 1, '00002-titulacao-8.pdf', 2, 8, 'MidHPC: Um suporte para a execução transparente de aplicações em grids computacionais', 'Ciências da Computação e Matemática Computacional', 'Universidade de São Paulo', 'Rodrigo Fernandes de Mello', '2005', '2008', '3'),
('propex@ifs.edu.br', '2017-11-04', 1, '00002-titulacao-9.pdf', 2, 9, 'Definição automática da quantidade de atributos selecionados em tarefas de agrupamento de dados', 'Ciências da Computação e Matemática Computacional', 'Universidade de São Paulo', 'André Carlos Ponce de Leon Ferreira Carvalho', '2008', '2013', '4');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ic_trabevento`
--

CREATE TABLE `ic_trabevento` (
  `emailValidador` varchar(256) DEFAULT NULL,
  `dataValidacao` date DEFAULT NULL,
  `validado` tinyint(1) DEFAULT '-1',
  `comprovante` text,
  `curriculoId` int(11) NOT NULL,
  `idTrabEvento` int(11) NOT NULL,
  `tipoClass` varchar(16) NOT NULL DEFAULT '-1',
  `tipoPais` varchar(16) NOT NULL,
  `natureza` varchar(64) NOT NULL,
  `titulo` varchar(256) NOT NULL,
  `ano` varchar(8) NOT NULL,
  `isbn` varchar(32) NOT NULL,
  `homepage` text,
  `doi` text,
  `pais` varchar(32) NOT NULL,
  `idioma` varchar(32) NOT NULL,
  `classEvento` varchar(64) NOT NULL,
  `nomeEvento` varchar(256) NOT NULL,
  `cidadeEvento` varchar(64) NOT NULL,
  `anoRealizacao` varchar(8) NOT NULL,
  `nomeEditora` varchar(64) NOT NULL,
  `titulosAnais` varchar(256) NOT NULL,
  `pagInicial` varchar(16) NOT NULL,
  `pagFinal` varchar(16) NOT NULL,
  `autores` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ic_trabevento`
--

INSERT INTO `ic_trabevento` (`emailValidador`, `dataValidacao`, `validado`, `comprovante`, `curriculoId`, `idTrabEvento`, `tipoClass`, `tipoPais`, `natureza`, `titulo`, `ano`, `isbn`, `homepage`, `doi`, `pais`, `idioma`, `classEvento`, `nomeEvento`, `cidadeEvento`, `anoRealizacao`, `nomeEditora`, `titulosAnais`, `pagInicial`, `pagFinal`, `autores`) VALUES
(NULL, NULL, -1, NULL, 2, 135, '4', '3', 'COMPLETO', 'RouteGA: A Grid Load Balancing Algorithm with Genetic Support', '2007', '', '', '', 'Brasil', 'Português', 'INTERNACIONAL', 'The IEEE 21st International Conference on Advanced Information Networking and Applications (AINA-07)', 'Ontario', '2007', '', 'Proceedings of the IEEE 21st International Conference on Advanced Information Networking and Applications (AINA-07)', '1', '8', '[\n    {\n        "nomeCompleto": "Rodrigo Mello",\n        "nomeCitacao": "MELLO, R.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    },\n    {\n        "nomeCompleto": "Luciano José Senger",\n        "nomeCitacao": "SENGER, L. J.",\n        "numIdCNPQ": "6880696447532558"\n    },\n    {\n        "nomeCompleto": "Laurence T. Yang",\n        "nomeCitacao": "YANG, L. T.",\n        "numIdCNPQ": ""\n    }\n]'),
(NULL, NULL, -1, NULL, 2, 136, '4', '4', 'COMPLETO', 'Supporting the transparent execution of high performance application on grids', '2007', '', '', '', 'Coréia do Sul', 'Inglês', 'INTERNACIONAL', 'IEEE TENCON 2007', 'Taipei', '2007', '', 'Proceedings of the IEEE TENCON 2007', '1', '4', '[\n    {\n        "nomeCompleto": "Rodrigo Mello",\n        "nomeCitacao": "MELLO, R.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    },\n    {\n        "nomeCompleto": "Evgueni Dodonov",\n        "nomeCitacao": "DODONOV, E.",\n        "numIdCNPQ": "6435314467133626"\n    },\n    {\n        "nomeCompleto": "Kuang-Ching Li",\n        "nomeCitacao": "LI, K.-C.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Laurence T. Yang",\n        "nomeCitacao": "YANG, L. T.",\n        "numIdCNPQ": ""\n    }\n]'),
(NULL, NULL, -1, NULL, 2, 137, '4', '3', 'COMPLETO', 'Exigency-based real-time scheduling policy to provide absolute QoS for web services', '2007', '', '', '', 'Brasil', 'Inglês', 'INTERNACIONAL', 'SBAC-PAD 2007: 19th International Symposium on Computer Architecture and High Performance Computing', 'Gramado, RS, Brazil', '2007', '', 'Proceeding of the 19th International Symposium on Computer Architecture and High Performance Computing', '1', '8', '[\n    {\n        "nomeCompleto": "LUCAS DOS SANTOS CASAGRANDE",\n        "nomeCitacao": "CASAGRANDE, L. S.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Rodrigo Fernandes de Mello",\n        "nomeCitacao": "Mello R. F.",\n        "numIdCNPQ": "6840478133476887"\n    },\n    {\n        "nomeCompleto": "RICARDO BERTAGNA",\n        "nomeCitacao": "BERTAGNA, R.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    },\n    {\n        "nomeCompleto": "FRANCISCO JOSÉ MONACO",\n        "nomeCitacao": "MONACO, F. J.",\n        "numIdCNPQ": "7489482613903725"\n    }\n]'),
(NULL, NULL, -1, NULL, 2, 138, '4', '3', 'COMPLETO', 'Toward an Efficient Middleware for Multithreaded Applications in Computational Grid', '2008', '', '', '', 'Brasil', 'Inglês', 'INTERNACIONAL', '2008 IEEE 11th International Conference on Computational Science and Engineering (CSE-08)', 'São Paulo', '2008', '', 'Proceedings of the 2008 IEEE 11th International Conference on Computational Science and Engineering (CSE-08)', '1', '8', '[\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    },\n    {\n        "nomeCompleto": "Rodrigo Fernandes de Mello",\n        "nomeCitacao": "Mello R. F.",\n        "numIdCNPQ": "6840478133476887"\n    },\n    {\n        "nomeCompleto": "Evgueni Dodonov",\n        "nomeCitacao": "DODONOV, E.",\n        "numIdCNPQ": "6435314467133626"\n    },\n    {\n        "nomeCompleto": "Luciano José Senger",\n        "nomeCitacao": "SENGER, L. J.",\n        "numIdCNPQ": "6880696447532558"\n    },\n    {\n        "nomeCompleto": "Laurence T. Yang",\n        "nomeCitacao": "YANG, L. T.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Kuang-Ching Li",\n        "nomeCitacao": "LI, K.-C.",\n        "numIdCNPQ": ""\n    }\n]'),
(NULL, NULL, -1, NULL, 2, 139, '4', '4', 'COMPLETO', 'Quantifying Features Using False Nearest Neighbors: An Unsupervised Approach', '2011', '9780769545967', '[http://doi.ieeecomputersociety.org/10.1109/ICTAI.2011.170]', '', 'Estados Unidos', 'Inglês', 'INTERNACIONAL', '2011 IEEE 23rd International Conference on Tools with Artificial Intelligence', 'Boca Raton, FL', '2011', '', '2011 IEEE 23rd International Conference on Tools with Artificial Intelligence', '994', '997', '[\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    },\n    {\n        "nomeCompleto": "Andre C P L F de Carvalho",\n        "nomeCitacao": "CARVALHO, Andre C. P. L. F. de",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Rodrigo Fernandes de Mello",\n        "nomeCitacao": "Mello R. F.",\n        "numIdCNPQ": "6840478133476887"\n    },\n    {\n        "nomeCompleto": "Salem Alelyani",\n        "nomeCitacao": "ALELYANI, S.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Huan Liu",\n        "nomeCitacao": "LIU, H.",\n        "numIdCNPQ": ""\n    }\n]'),
(NULL, NULL, -1, NULL, 2, 140, '4', '4', 'COMPLETO', 'Lessons Learned in Using Social Media for Disaster Relief - ASU Crisis Response Game', '2012', '9783642290473', '[http://www.springerlink.com/content/5t7735568w62274h/]', '', 'Estados Unidos', 'Inglês', 'INTERNACIONAL', 'Social Computing, Behavioral - Cultural Modeling and Prediction - 5th International Conference', 'College Park, MD', '2012', '', 'Lecture Notes in Computer Science', '282', '289', '[\n    {\n        "nomeCompleto": "Mohammad Ali Abbasi",\n        "nomeCitacao": "ABBASI, M. A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Shamanth Kumar",\n        "nomeCitacao": "KUMAR, S",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    },\n    {\n        "nomeCompleto": "Huan Liu",\n        "nomeCitacao": "LIU, H.",\n        "numIdCNPQ": ""\n    }\n]'),
(NULL, NULL, -1, NULL, 2, 141, '3', '3', 'COMPLETO', 'A Density-Based Clustering Approach for Behavior Change Detection in Data Streams', '2012', '9781467326414', '', '10.1109/SBRN.2012.22', 'Brasil', 'Inglês', 'NACIONAL', '2012 Brazilian Symposium on Neural Networks (SBRN)', 'Curitiba', '2012', '', '2012 Brazilian Symposium on Neural Networks', '37', '', '[\n    {\n        "nomeCompleto": "VALLIM, ROSANE M.M.",\n        "nomeCitacao": "VALLIM, ROSANE M.M.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "CARVALHO, ANDRE C.P.L.F.",\n        "nomeCitacao": "CARVALHO, ANDRE C.P.L.F.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "GAMA, JOAO",\n        "nomeCitacao": "GAMA, JOAO",\n        "numIdCNPQ": ""\n    }\n]'),
('propex@ifs.edu.br', '2017-11-04', 1, '00002-trabEvento-142.pdf', 2, 142, '4', '3', 'COMPLETO', 'PERFIL DA INOVAÇÃO TECNOLÓGICA EM EMPRESAS SERGIPANAS', '2014', '', '[http://www.portalmites.com.br/conferences/index.php/ISTI/isti2014/paper/view/56]', '10.7198/s2318-3403201400020028', 'Brasil', 'Português', 'INTERNACIONAL', '5th International Symposium on Technological Innovation', '', '', '', '5th International Symposium on Technological Innovation', '229', '234', '[\n    {\n        "nomeCompleto": "SOUZA, A. A. A.",\n        "nomeCitacao": "SOUZA, A. A. A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Suzana Leitão Russo",\n        "nomeCitacao": "RUSSO, S. L.",\n        "numIdCNPQ": "8056542335438905"\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "PAIXÃO, A. E. A.",\n        "nomeCitacao": "PAIXÃO, A. E. A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Maria Emília Camargo",\n        "nomeCitacao": "CAMARGO, M. E.",\n        "numIdCNPQ": "7617091280907670"\n    }\n]'),
('propex@ifs.edu.br', '2017-11-04', 1, '00002-trabEvento-143.pdf', 2, 143, '1', '1', 'RESUMO_EXPANDIDO', 'Uma Aplicação de Séries Temporais e Inteligência Computacional na Previsão do Mercado de Seguros de Automóveis Sergipano', '2014', '', '', '', 'Brasil', 'Português', 'NACIONAL', 'III Congresso de Estatística / VII Semana Acadêmica de Estatística', 'Aracaju', '2014', '', 'Anais do III Congresso de Estatística', '', '', '[\n    {\n        "nomeCompleto": "Sandra Santos Santa Rosa",\n        "nomeCitacao": "ROSA, S. S. S.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Armoni da Cruz Santos",\n        "nomeCitacao": "SANTOS, A. C.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, JOSÉ A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Suzana Leitão Russo",\n        "nomeCitacao": "RUSSO, S. L.",\n        "numIdCNPQ": "8056542335438905"\n    },\n    {\n        "nomeCompleto": "Íkaro Daniel de Carvalho Barreto",\n        "nomeCitacao": "BARRETO, I. D. C.",\n        "numIdCNPQ": ""\n    }\n]'),
('propex@ifs.edu.br', '2017-11-04', 1, '00002-trabEvento-144.pdf', 2, 144, '4', '4', 'COMPLETO', 'Spectral Analysis Applied to Variables of Oil Wells Profiling', '2015', '1307-6892', '[http://waset.org/abstracts/Mathematical-and-Statistical-Sciences]', '', 'Estados Unidos', 'Inglês', 'INTERNACIONAL', 'ICAMOR 2015: International Conference on Applied Mathematics and Operation Research', 'Miami', '2015', '', 'Proceedings of the ICAMOR 2015: International Conference on Applied Mathematics and Operation Research', '', '', '[\n    {\n        "nomeCompleto": "Suzana Leitão Russo",\n        "nomeCitacao": "RUSSO, S. L.",\n        "numIdCNPQ": "8056542335438905"\n    },\n    {\n        "nomeCompleto": "Mayara Laysa de Oliveira Silva",\n        "nomeCitacao": "SILVA, M. L. O.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, JOSÉ A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Vitor Hugo Simon",\n        "nomeCitacao": "SIMON, V. H.",\n        "numIdCNPQ": ""\n    }\n]'),
('propex@ifs.edu.br', '2017-11-04', 1, '00002-trabEvento-145.pdf', 2, 145, '2', '1', 'RESUMO_EXPANDIDO', 'Technologic Information about Photovoltaic Applied in Urban Residences', '2016', '2010-376X', '', '', 'Brasil', 'Português', 'INTERNACIONAL', '18th International Conference on Industrial Engineering and Management', 'Barcelona', '2016', '', 'Proceddings of the 18th International Conference on Industrial Engineering and Management', '', '', '[\n    {\n        "nomeCompleto": "Stephanie Fabris Russo",\n        "nomeCitacao": "RUSSO, S. F.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Daiane Costa Guimarães",\n        "nomeCitacao": "GUIMARAES, D. C.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Jonas Pedro Fabris",\n        "nomeCitacao": "FABRIS, J. P.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Maria Emília Camargo",\n        "nomeCitacao": "CAMARGO, M. E.",\n        "numIdCNPQ": "7617091280907670"\n    },\n    {\n        "nomeCompleto": "Suzana Leitão Russo",\n        "nomeCitacao": "RUSSO, S. L.",\n        "numIdCNPQ": "8056542335438905"\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, JOSÉ A.",\n        "numIdCNPQ": ""\n    }\n]'),
(NULL, NULL, -1, NULL, 2, 146, '4', '4', 'COMPLETO', 'Optimizing distributed data access in Grid environments by using artificial intelligence techniques', '2007', '', '', '', 'Canadá', 'Inglês', 'INTERNACIONAL', 'The Fifth International Symposium on Parallel and Distributed Processing and Applications', 'Niagara Falls', '2007', '', 'Proceedings on The Fifth International Symposium on Parallel and Distributed Processing and Applications', '1', '12', '[\n    {\n        "nomeCompleto": "Rodrigo Mello",\n        "nomeCitacao": "MELLO, R.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    },\n    {\n        "nomeCompleto": "Evgueni Dodonov",\n        "nomeCitacao": "DODONOV, E.",\n        "numIdCNPQ": "6435314467133626"\n    },\n    {\n        "nomeCompleto": "Renato Ishii",\n        "nomeCitacao": "ISHII, R.",\n        "numIdCNPQ": "8992362063539452"\n    },\n    {\n        "nomeCompleto": "Laurence T. Yang",\n        "nomeCitacao": "YANG, L. T.",\n        "numIdCNPQ": ""\n    }\n]');

-- --------------------------------------------------------

--
-- Estrutura da tabela `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `atividade` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `tempo` datetime NOT NULL,
  `dados_sessao` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `log`
--

INSERT INTO `log` (`id_log`, `atividade`, `tempo`, `dados_sessao`) VALUES
(1, '{"atividade":"Login","dados":{"op":"usuario\\/autenticar","email":"propex@ifs.edu.br","senha":""}}', '2017-11-18 01:27:18', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(2, '{"atividade":"Desconexão"}', '2017-11-18 14:36:38', '[]'),
(3, '{"atividade":"Login","dados":{"op":"usuario\\/autenticar","email":"henriquecunhawd@gmail.com","senha":""}}', '2017-11-18 14:37:28', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true}}'),
(4, '{"atividade":"Enviando currículo"}', '2017-11-18 14:39:28', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true}}'),
(5, '{"atividade":"Envio de comprovante","dados":{"filename":"00001-titulacao-3"}}', '2017-11-18 14:40:06', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true},"filename":"00001-titulacao-3"}'),
(6, '{"atividade":"Deleção de currículo"}', '2017-11-18 14:40:25', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true},"filename":"00001-titulacao-3"}'),
(7, '{"atividade":"Desconexão"}', '2017-11-18 14:41:02', '[]'),
(8, '{"atividade":"Login","dados":{"op":"usuario\\/autenticar","email":"propex@ifs.edu.br","senha":""}}', '2017-11-18 14:41:29', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(9, '{"atividade":"Vinculação de validador","dados":{"op":"usuario\\/perfil","email":"henriquecunhawd@gmail.com","nivel":"validador"}}', '2017-11-18 14:48:59', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(10, '{"atividade":"Desconexão"}', '2017-11-18 14:49:05', '[]'),
(11, '{"atividade":"Login","dados":{"op":"usuario\\/autenticar","email":"henriquecunhawd@gmail.com","senha":""}}', '2017-11-18 14:49:16', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true,"validador":true}}'),
(12, '{"atividade":"Desconexão"}', '2017-11-18 14:49:26', '[]'),
(13, '{"atividade":"Login","dados":{"op":"usuario\\/autenticar","email":"propex@ifs.edu.br","senha":""}}', '2017-11-18 14:54:56', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(14, '{"atividade":"Vinculação de validador","dados":{"op":"usuario\\/perfil","email":"henriquecunhawd@gmail.com","nivel":"validador"}}', '2017-11-18 21:48:48', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(15, '{"atividade":"Vinculação de validador","dados":{"op":"usuario\\/perfil","email":"henriquecunhawd@gmail.com","nivel":"validador"}}', '2017-11-18 21:50:14', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(16, '{"atividade":"Vinculação de validador","dados":{"op":"usuario\\/perfil","email":"henriquecunhawd@gmail.com","nivel":"validador"}}', '2017-11-18 21:53:07', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(17, '{"atividade":"Criação de Edital","dados":{"op":"edital\\/criar","num":"2123","nome":"Teste","vig":"1111-08-05"}}', '2017-11-18 21:54:08', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(18, '{"atividade":"Criação de Edital","dados":{"op":"edital\\/criar","num":"1255","nome":"Outro Edital","vig":"4888-05-01"}}', '2017-11-18 21:56:05', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(19, '{"atividade":"Importando regras","dados":{"op":"edital\\/importar","numero_ref":"1255 ","numero_atual":"1"}}', '2017-11-20 00:07:31', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(20, '{"atividade":"Importando regras","dados":{"op":"edital\\/importar","numero_ref":"1255 ","numero_atual":"1"}}', '2017-11-20 00:07:46', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(21, '{"atividade":"Importando regras","dados":{"op":"edital\\/importar","numero_ref":"1255 ","numero_atual":"1"}}', '2017-11-20 00:08:06', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(22, '{"atividade":"Importando regras","dados":{"op":"edital\\/importar","numero_ref":"1255 ","numero_atual":"1"}}', '2017-11-20 00:08:19', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(23, '{"atividade":"Importando regras","dados":{"op":"edital\\/importar","numero_ref":"1255 ","numero_atual":"1"}}', '2017-11-20 00:09:03', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(24, '{"atividade":"Importando regras","dados":{"op":"edital\\/importar","numero_ref":"1255 ","numero_atual":"1"}}', '2017-11-20 00:09:23', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(25, '{"atividade":"Importando regras","dados":{"op":"edital\\/importar","numero_ref":"2 ","numero_atual":"1"}}', '2017-11-20 00:09:53', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(26, '{"atividade":"Importando regras","dados":{"op":"edital\\/importar","numero_ref":"2 ","numero_atual":"1"}}', '2017-11-20 00:10:00', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(27, '{"atividade":"Importando regras","dados":{"op":"edital\\/importar","numero_ref":"2 ","numero_atual":"1"}}', '2017-11-20 00:10:38', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(28, '{"atividade":"Importando regras","dados":{"op":"edital\\/importar","numero_ref":"2 ","numero_atual":"1"}}', '2017-11-20 00:13:42', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(29, '{"atividade":"Importando regras","dados":{"op":"edital\\/importar","numero_ref":"2 ","numero_atual":"1"}}', '2017-11-20 00:14:41', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(30, '{"atividade":"Importando regras","dados":{"op":"edital\\/importar","numero_ref":"2 ","numero_atual":"1"}}', '2017-11-20 00:14:56', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(31, '{"atividade":"Importando regras","dados":{"op":"edital\\/importar","numero_ref":"2 ","numero_atual":"1"}}', '2017-11-20 00:15:01', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(32, '{"atividade":"Importando regras","dados":{"op":"edital\\/importar","numero_ref":"2 ","numero_atual":"1"}}', '2017-11-20 00:15:10', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(33, '{"atividade":"Desconexão"}', '2017-11-27 01:02:53', '[]'),
(34, '{"atividade":"Login","dados":{"op":"usuario\\/autenticar","email":"henriquecunhawd@gmail.com","senha":""}}', '2017-11-27 01:03:01', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true}}'),
(35, '{"atividade":"Enviando currículo"}', '2017-11-27 01:03:57', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true}}'),
(36, '{"atividade":"Deleção de currículo"}', '2017-11-27 01:04:49', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true}}'),
(37, '{"atividade":"Enviando currículo"}', '2017-11-27 01:04:55', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true}}'),
(38, '{"atividade":"Envio de comprovante","dados":{"filename":"00002-titulacao-9"}}', '2017-11-27 01:05:27', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true},"filename":"00002-titulacao-9"}'),
(39, '{"atividade":"Envio de comprovante","dados":{"filename":"00002-banca-65"}}', '2017-11-27 01:08:39', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true},"filename":"00002-banca-65"}'),
(40, '{"atividade":"Envio de comprovante","dados":{"filename":"00002-banca-66"}}', '2017-11-27 01:08:47', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true},"filename":"00002-banca-66"}'),
(41, '{"atividade":"Envio de comprovante","dados":{"filename":"00002-banca-64"}}', '2017-11-27 01:09:02', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true},"filename":"00002-banca-64"}'),
(42, '{"atividade":"Envio de comprovante","dados":{"filename":"00002-banca-62"}}', '2017-11-27 01:09:10', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true},"filename":"00002-banca-62"}'),
(43, '{"atividade":"Envio de comprovante","dados":{"filename":"00002-banca-61"}}', '2017-11-27 01:09:35', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true},"filename":"00002-banca-61"}'),
(44, '{"atividade":"Envio de comprovante","dados":{"filename":"00002-banca-63"}}', '2017-11-27 01:09:49', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true},"filename":"00002-banca-63"}'),
(45, '{"atividade":"Envio de comprovante","dados":{"filename":"00002-banca-59"}}', '2017-11-27 01:10:23', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true},"filename":"00002-banca-59"}'),
(46, '{"atividade":"Envio de comprovante","dados":{"filename":"00002-titulacao-8"}}', '2017-11-27 01:10:39', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true},"filename":"00002-titulacao-8"}'),
(47, '{"atividade":"Envio de comprovante","dados":{"filename":"00002-titulacao-7"}}', '2017-11-27 01:10:48', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true},"filename":"00002-titulacao-7"}'),
(48, '{"atividade":"Envio de comprovante","dados":{"filename":"00002-artigo-29"}}', '2017-11-27 01:11:13', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true},"filename":"00002-artigo-29"}'),
(49, '{"atividade":"Envio de comprovante","dados":{"filename":"00002-artigo-24"}}', '2017-11-27 01:11:45', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true},"filename":"00002-artigo-24"}'),
(50, '{"atividade":"Envio de comprovante","dados":{"filename":"00002-artigo-25"}}', '2017-11-27 01:11:59', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true},"filename":"00002-artigo-25"}'),
(51, '{"atividade":"Envio de comprovante","dados":{"filename":"00002-artigo-25"}}', '2017-11-27 01:11:59', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true},"filename":"00002-artigo-25"}'),
(52, '{"atividade":"Envio de comprovante","dados":{"filename":"00002-artigo-26"}}', '2017-11-27 01:12:14', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true},"filename":"00002-artigo-26"}'),
(53, '{"atividade":"Envio de comprovante","dados":{"filename":"00002-trabEvento-144"}}', '2017-11-27 01:12:39', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true},"filename":"00002-trabEvento-144"}'),
(54, '{"atividade":"Envio de comprovante","dados":{"filename":"00002-trabEvento-145"}}', '2017-11-27 01:12:59', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true},"filename":"00002-trabEvento-145"}'),
(55, '{"atividade":"Envio de comprovante","dados":{"filename":"00002-trabEvento-142"}}', '2017-11-27 01:13:07', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true},"filename":"00002-trabEvento-142"}'),
(56, '{"atividade":"Envio de comprovante","dados":{"filename":"00002-trabEvento-143"}}', '2017-11-27 01:13:15', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true},"filename":"00002-trabEvento-143"}'),
(57, '{"atividade":"Desconexão"}', '2017-11-30 14:36:08', '[]'),
(58, '{"atividade":"Login","dados":{"op":"usuario\\/autenticar","email":"propex@ifs.edu.br","senha":""}}', '2017-11-30 14:42:12', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(59, '{"atividade":"Criação de Edital","dados":{"op":"edital\\/criar","num":" 05\\/2017\\/PROPEX\\/IFS\\/CNPq","nome":"PROGRAMA INSTITUCIONAL DE BOLSA DE INICIAÇÃO CIENTÍFICA NO ENSINO MÉDIO - PIBIC-EM","vig":"2018-07-10"}}', '2017-11-30 15:31:58', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(60, '{"atividade":"Alteração de Edital","dados":{"op":"edital\\/alterar","num":" 05\\/2017\\/PROPEX\\/IFS\\/CNPq","nome":"PROGRAMA INSTITUCIONAL DE BOLSA DE INICIAÇÃO CIENTÍFICA NO ENSINO MÉDIO - PIBIC-EM","vigencia":"2018-07-10","descricao":"<p>O Instituto Federal de Educa&ccedil;&atilde;o, Ci&ecirc;ncia e Tecnologia de Sergipe - IFS torna p&uacute;blico atrav&eacute;s da Pr&oacute;- Reitoria de Pesquisa e Extens&atilde;o - PROPEX, a abertura do edital de sele&ccedil;&atilde;o de projetos para o Programa Institucional de Bolsas de Inicia&ccedil;&atilde;o Cient&iacute;fica no Ensino M&eacute;dio PIBIC EM\\/CNPq, vinculados ao Conselho Nacional de Desenvolvimento Cient&iacute;fico e Tecnol&oacute;gico &ndash; CNPq, aos alunos do ensino t&eacute;cnico integrado ao m&eacute;dio do IFS, com dura&ccedil;&atilde;o de 12 (doze) meses a contar da data de in&iacute;cio dos projetos, conforme disposi&ccedil;&otilde;es estipuladas a seguir:<\\/p>","pontMax":"100","oldNum":" 05\\/2017\\/PROPEX\\/IFS\\/CNPq"}}', '2017-11-30 15:38:49', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(61, '{"atividade":"Enviando arquivo de edital","dados":{"filename":" 05\\/2017\\/PROPEX\\/IFS\\/CNPq"}}', '2017-11-30 15:40:36', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true},"pdfnum":" 05\\/2017\\/PROPEX\\/IFS\\/CNPq"}'),
(62, '{"atividade":"Enviando arquivo de edital","dados":{"filename":" 05\\/2017\\/PROPEX\\/IFS\\/CNPq"}}', '2017-11-30 15:45:09', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true},"pdfnum":" 05\\/2017\\/PROPEX\\/IFS\\/CNPq"}'),
(63, '{"atividade":"Enviando arquivo de edital","dados":{"filename":"3-edital.pdf"}}', '2017-11-30 15:51:02', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true},"pdfnum":" 05\\/2017\\/PROPEX\\/IFS\\/CNPq","idEdital":null}'),
(64, '{"atividade":"Enviando arquivo de edital","dados":{"filename":"3-edital.pdf"}}', '2017-11-30 15:54:22', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true},"pdfnum":" 05\\/2017\\/PROPEX\\/IFS\\/CNPq","idEdital":"3"}'),
(65, '{"atividade":"Enviando arquivo de edital","dados":{"filename":"3-edital.pdf"}}', '2017-11-30 15:56:56', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true},"pdfnum":" 05\\/2017\\/PROPEX\\/IFS\\/CNPq","idEdital":"3"}'),
(66, '{"atividade":"Enviando arquivo de edital","dados":{"filename":"3-edital.pdf"}}', '2017-11-30 15:57:56', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true},"pdfnum":" 05\\/2017\\/PROPEX\\/IFS\\/CNPq","idEdital":"3"}'),
(67, '{"atividade":"Mudança em estado de validação","data":{"curriculoId":"00002","ic":"titulacao","icId":"9","state":"1","date":"2017-11-04","emailVal":"propex@ifs.edu.br","op":"curriculo\\/ic\\/validar"}}', '2017-11-30 16:10:59', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true},"pdfnum":" 05\\/2017\\/PROPEX\\/IFS\\/CNPq","idEdital":"3"}'),
(68, '{"atividade":"Mudança em estado de validação","data":{"curriculoId":"00002","ic":"titulacao","icId":"8","state":"1","date":"2017-11-04","emailVal":"propex@ifs.edu.br","op":"curriculo\\/ic\\/validar"}}', '2017-11-30 16:11:00', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true},"pdfnum":" 05\\/2017\\/PROPEX\\/IFS\\/CNPq","idEdital":"3"}'),
(69, '{"atividade":"Mudança em estado de validação","data":{"curriculoId":"00002","ic":"titulacao","icId":"7","state":"1","date":"2017-11-04","emailVal":"propex@ifs.edu.br","op":"curriculo\\/ic\\/validar"}}', '2017-11-30 16:11:01', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true},"pdfnum":" 05\\/2017\\/PROPEX\\/IFS\\/CNPq","idEdital":"3"}'),
(70, '{"atividade":"Mudança em estado de validação","data":{"curriculoId":"00002","ic":"artigo","icId":"29","state":"1","date":"2017-11-04","emailVal":"propex@ifs.edu.br","op":"curriculo\\/ic\\/validar"}}', '2017-11-30 16:11:04', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true},"pdfnum":" 05\\/2017\\/PROPEX\\/IFS\\/CNPq","idEdital":"3"}'),
(71, '{"atividade":"Mudança em estado de validação","data":{"curriculoId":"00002","ic":"artigo","icId":"24","state":"1","date":"2017-11-04","emailVal":"propex@ifs.edu.br","op":"curriculo\\/ic\\/validar"}}', '2017-11-30 16:11:06', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true},"pdfnum":" 05\\/2017\\/PROPEX\\/IFS\\/CNPq","idEdital":"3"}'),
(72, '{"atividade":"Mudança em estado de validação","data":{"curriculoId":"00002","ic":"artigo","icId":"25","state":"1","date":"2017-11-04","emailVal":"propex@ifs.edu.br","op":"curriculo\\/ic\\/validar"}}', '2017-11-30 16:11:07', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true},"pdfnum":" 05\\/2017\\/PROPEX\\/IFS\\/CNPq","idEdital":"3"}'),
(73, '{"atividade":"Mudança em estado de validação","data":{"curriculoId":"00002","ic":"artigo","icId":"26","state":"1","date":"2017-11-04","emailVal":"propex@ifs.edu.br","op":"curriculo\\/ic\\/validar"}}', '2017-11-30 16:11:08', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true},"pdfnum":" 05\\/2017\\/PROPEX\\/IFS\\/CNPq","idEdital":"3"}'),
(74, '{"atividade":"Mudança em estado de validação","data":{"curriculoId":"00002","ic":"trabEvento","icId":"145","state":"1","date":"2017-11-04","emailVal":"propex@ifs.edu.br","op":"curriculo\\/ic\\/validar"}}', '2017-11-30 16:11:18', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true},"pdfnum":" 05\\/2017\\/PROPEX\\/IFS\\/CNPq","idEdital":"3"}'),
(75, '{"atividade":"Mudança em estado de validação","data":{"curriculoId":"00002","ic":"trabEvento","icId":"144","state":"1","date":"2017-11-04","emailVal":"propex@ifs.edu.br","op":"curriculo\\/ic\\/validar"}}', '2017-11-30 16:11:19', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true},"pdfnum":" 05\\/2017\\/PROPEX\\/IFS\\/CNPq","idEdital":"3"}'),
(76, '{"atividade":"Mudança em estado de validação","data":{"curriculoId":"00002","ic":"trabEvento","icId":"142","state":"1","date":"2017-11-04","emailVal":"propex@ifs.edu.br","op":"curriculo\\/ic\\/validar"}}', '2017-11-30 16:11:20', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true},"pdfnum":" 05\\/2017\\/PROPEX\\/IFS\\/CNPq","idEdital":"3"}'),
(77, '{"atividade":"Mudança em estado de validação","data":{"curriculoId":"00002","ic":"trabEvento","icId":"143","state":"1","date":"2017-11-04","emailVal":"propex@ifs.edu.br","op":"curriculo\\/ic\\/validar"}}', '2017-11-30 16:11:21', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true},"pdfnum":" 05\\/2017\\/PROPEX\\/IFS\\/CNPq","idEdital":"3"}'),
(78, '{"atividade":"Mudança em estado de validação","data":{"curriculoId":"00002","ic":"banca","icId":"64","state":"1","date":"2017-11-04","emailVal":"propex@ifs.edu.br","op":"curriculo\\/ic\\/validar"}}', '2017-11-30 16:11:29', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true},"pdfnum":" 05\\/2017\\/PROPEX\\/IFS\\/CNPq","idEdital":"3"}'),
(79, '{"atividade":"Mudança em estado de validação","data":{"curriculoId":"00002","ic":"banca","icId":"65","state":"1","date":"2017-11-04","emailVal":"propex@ifs.edu.br","op":"curriculo\\/ic\\/validar"}}', '2017-11-30 16:11:30', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true},"pdfnum":" 05\\/2017\\/PROPEX\\/IFS\\/CNPq","idEdital":"3"}'),
(80, '{"atividade":"Mudança em estado de validação","data":{"curriculoId":"00002","ic":"banca","icId":"66","state":"1","date":"2017-11-04","emailVal":"propex@ifs.edu.br","op":"curriculo\\/ic\\/validar"}}', '2017-11-30 16:11:31', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true},"pdfnum":" 05\\/2017\\/PROPEX\\/IFS\\/CNPq","idEdital":"3"}'),
(81, '{"atividade":"Mudança em estado de validação","data":{"curriculoId":"00002","ic":"banca","icId":"61","state":"1","date":"2017-11-04","emailVal":"propex@ifs.edu.br","op":"curriculo\\/ic\\/validar"}}', '2017-11-30 16:11:33', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true},"pdfnum":" 05\\/2017\\/PROPEX\\/IFS\\/CNPq","idEdital":"3"}'),
(82, '{"atividade":"Mudança em estado de validação","data":{"curriculoId":"00002","ic":"banca","icId":"62","state":"1","date":"2017-11-04","emailVal":"propex@ifs.edu.br","op":"curriculo\\/ic\\/validar"}}', '2017-11-30 16:11:35', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true},"pdfnum":" 05\\/2017\\/PROPEX\\/IFS\\/CNPq","idEdital":"3"}'),
(83, '{"atividade":"Mudança em estado de validação","data":{"curriculoId":"00002","ic":"banca","icId":"63","state":"1","date":"2017-11-04","emailVal":"propex@ifs.edu.br","op":"curriculo\\/ic\\/validar"}}', '2017-11-30 16:11:36', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true},"pdfnum":" 05\\/2017\\/PROPEX\\/IFS\\/CNPq","idEdital":"3"}'),
(84, '{"atividade":"Mudança em estado de validação","data":{"curriculoId":"00002","ic":"banca","icId":"59","state":"1","date":"2017-11-04","emailVal":"propex@ifs.edu.br","op":"curriculo\\/ic\\/validar"}}', '2017-11-30 16:11:53', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true},"pdfnum":" 05\\/2017\\/PROPEX\\/IFS\\/CNPq","idEdital":"3"}'),
(85, '{"atividade":"Desconexão"}', '2017-11-30 16:13:42', '[]'),
(86, '{"atividade":"Login","dados":{"op":"usuario\\/autenticar","email":"henriquecunhawd@gmail.com","senha":""}}', '2017-11-30 16:17:00', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true}}'),
(87, '{"atividade":"Criação de Sumário","dados":{"op":"sumario\\/criar","numero":" 05\\/2017\\/PROPEX\\/IFS\\/CNPq"}}', '2017-11-30 16:17:24', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true}}'),
(88, '{"atividade":"Desconexão"}', '2017-12-04 10:47:20', '[]'),
(89, '{"atividade":"Login","dados":{"op":"usuario\\/autenticar","email":"propex@ifs.edu.br","senha":""}}', '2017-12-04 10:47:36', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(90, '{"atividade":"Login","dados":{"op":"usuario\\/autenticar","email":"propex@ifs.edu.br","senha":""}}', '2017-12-14 09:52:03', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(91, '{"atividade":"Login","dados":{"op":"usuario\\/autenticar","email":"propex@ifs.edu.br","senha":""}}', '2017-12-14 14:36:49', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(92, '{"atividade":"Criação de Edital","dados":{"op":"edital\\/criar","num":"#","nome":"TESTE","vig":"2017-01-01"}}', '2017-12-14 14:37:46', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(93, '{"atividade":"Criação de Edital","dados":{"op":"edital\\/criar","num":"123","nome":"Teste","vig":"2017-01-01"}}', '2017-12-14 14:39:12', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(94, '{"atividade":"Login","dados":{"op":"usuario\\/autenticar","email":"propex@ifs.edu.br","senha":""}}', '2017-12-14 14:40:40', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(95, '{"atividade":"Criação de Edital","dados":{"op":"edital\\/criar","num":"12","nome":"fds","vig":"0005-08-05"}}', '2017-12-14 14:43:35', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(96, '{"atividade":"Criação de Edital","dados":{"op":"edital\\/criar","num":"123","nome":"fdsfdsfds","vig":"0099-08-05"}}', '2017-12-14 14:47:45', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(97, '{"atividade":"Criação de Edital","dados":{"op":"edital\\/criar","num":"123","nome":"hdsa","vig":"0004-05-05"}}', '2017-12-14 15:03:02', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(98, '{"atividade":"Criação de Edital","dados":{"op":"edital\\/criar","num":"teste","nome":"teste_de_regras","vig":"2018-01-31"}}', '2018-01-30 11:17:33', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(99, '{"atividade":"Desconexão"}', '2018-02-01 15:12:44', '[]'),
(100, '{"atividade":"Login","dados":{"op":"usuario\\/autenticar","email":"henriquecunhawd@gmail.com","senha":""}}', '2018-02-01 15:12:52', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true}}'),
(101, '{"atividade":"Desconexão"}', '2018-02-01 16:09:30', '[]'),
(102, '{"atividade":"Login","dados":{"op":"usuario\\/autenticar","email":"propex@ifs.edu.br","senha":""}}', '2018-02-01 16:09:47', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(103, '{"atividade":"Login","dados":{"op":"usuario\\/autenticar","email":"henriquecunhawd@gmail.com","senha":""}}', '2018-02-03 01:29:06', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true}}'),
(104, '{"atividade":"Desconexão"}', '2018-02-05 01:35:02', '[]'),
(105, '{"atividade":"Login","dados":{"op":"usuario\\/autenticar","email":"propex@ifs.edu.br","senha":""}}', '2018-02-05 01:35:13', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(106, '{"atividade":"Desconexão"}', '2018-02-05 01:55:49', '[]'),
(107, '{"atividade":"Login","dados":{"op":"usuario\\/autenticar","email":"henriquecunhawd@gmail.com","senha":""}}', '2018-02-05 01:56:03', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true}}'),
(108, '{"atividade":"Envio de comprovante","dados":{"filename":"00002-partPos-12"}}', '2018-02-05 01:56:25', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true},"filename":"00002-partPos-12"}'),
(109, '{"atividade":"Envio de comprovante","dados":{"filename":"00002-partPos-10"}}', '2018-02-05 01:56:32', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true},"filename":"00002-partPos-10"}'),
(110, '{"atividade":"Envio de comprovante","dados":{"filename":"00002-partPos-11"}}', '2018-02-05 01:56:38', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true},"filename":"00002-partPos-11"}'),
(111, '{"atividade":"Desconexão"}', '2018-02-05 01:56:43', '[]'),
(112, '{"atividade":"Login","dados":{"op":"usuario\\/autenticar","email":"propex@ifs.edu.br","senha":""}}', '2018-02-05 01:56:58', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(113, '{"atividade":"Mudança em estado de validação","data":{"curriculoId":"00002","ic":"partPos","icId":"12","state":"1","date":"2018-02-01","emailVal":"propex@ifs.edu.br","op":"curriculo\\/ic\\/validar"}}', '2018-02-05 01:59:35', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(114, '{"atividade":"Mudança em estado de validação","data":{"curriculoId":"00002","ic":"partPos","icId":"10","state":"1","date":"2018-02-01","emailVal":"propex@ifs.edu.br","op":"curriculo\\/ic\\/validar"}}', '2018-02-05 01:59:37', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(115, '{"atividade":"Mudança em estado de validação","data":{"curriculoId":"00002","ic":"partPos","icId":"11","state":"1","date":"2018-02-01","emailVal":"propex@ifs.edu.br","op":"curriculo\\/ic\\/validar"}}', '2018-02-05 01:59:38', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(116, '{"atividade":"Mudança em estado de validação","data":{"curriculoId":"00002","ic":"partPos","icId":"12","state":"0","date":"2018-02-01","emailVal":"propex@ifs.edu.br","op":"curriculo\\/ic\\/validar"}}', '2018-02-05 02:01:09', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(117, '{"atividade":"Mudança em estado de validação","data":{"curriculoId":"00002","ic":"partPos","icId":"12","state":"1","date":"2018-02-01","emailVal":"propex@ifs.edu.br","op":"curriculo\\/ic\\/validar"}}', '2018-02-05 02:01:10', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(118, '{"atividade":"Mudança em estado de validação","data":{"curriculoId":"00002","ic":"partPos","icId":"12","state":"0","date":"2018-02-01","emailVal":"propex@ifs.edu.br","op":"curriculo\\/ic\\/validar"}}', '2018-02-05 02:01:12', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(119, '{"atividade":"Mudança em estado de validação","data":{"curriculoId":"00002","ic":"partPos","icId":"12","state":"1","date":"2018-02-01","emailVal":"propex@ifs.edu.br","op":"curriculo\\/ic\\/validar"}}', '2018-02-05 02:01:13', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(120, '{"atividade":"Desconexão"}', '2018-02-05 23:43:25', '[]'),
(121, '{"atividade":"Login","dados":{"op":"usuario\\/autenticar","email":"henriquecunhawd@gmail.com","senha":""}}', '2018-02-05 23:43:36', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true}}'),
(122, '{"atividade":"Envio de comprovante","dados":{"filename":"00002-coordProj-30"}}', '2018-02-05 23:43:54', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true},"filename":"00002-coordProj-30"}'),
(123, '{"atividade":"Envio de comprovante","dados":{"filename":"00002-coordProj-26"}}', '2018-02-05 23:44:00', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true},"filename":"00002-coordProj-26"}'),
(124, '{"atividade":"Envio de comprovante","dados":{"filename":"00002-coordProj-28"}}', '2018-02-05 23:44:05', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true},"filename":"00002-coordProj-28"}'),
(125, '{"atividade":"Envio de comprovante","dados":{"filename":"00002-coordProj-29"}}', '2018-02-05 23:44:13', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true},"filename":"00002-coordProj-29"}'),
(126, '{"atividade":"Envio de comprovante","dados":{"filename":"00002-coordProj-27"}}', '2018-02-05 23:44:18', '{"email":"henriquecunhawd@gmail.com","ip":"::1","privilegios":{"pesquisador":true},"filename":"00002-coordProj-27"}'),
(127, '{"atividade":"Desconexão"}', '2018-02-05 23:44:30', '[]'),
(128, '{"atividade":"Login","dados":{"op":"usuario\\/autenticar","email":"propex@ifs.edu.br","senha":""}}', '2018-02-05 23:44:46', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(129, '{"atividade":"Mudança em estado de validação","data":{"curriculoId":"00002","ic":"coordProj","icId":"30","state":"1","date":"2018-02-01","emailVal":"propex@ifs.edu.br","op":"curriculo\\/ic\\/validar"}}', '2018-02-05 23:46:46', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(130, '{"atividade":"Mudança em estado de validação","data":{"curriculoId":"00002","ic":"coordProj","icId":"26","state":"1","date":"2018-02-01","emailVal":"propex@ifs.edu.br","op":"curriculo\\/ic\\/validar"}}', '2018-02-05 23:46:48', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(131, '{"atividade":"Mudança em estado de validação","data":{"curriculoId":"00002","ic":"coordProj","icId":"28","state":"1","date":"2018-02-01","emailVal":"propex@ifs.edu.br","op":"curriculo\\/ic\\/validar"}}', '2018-02-05 23:46:49', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(132, '{"atividade":"Mudança em estado de validação","data":{"curriculoId":"00002","ic":"coordProj","icId":"29","state":"1","date":"2018-02-01","emailVal":"propex@ifs.edu.br","op":"curriculo\\/ic\\/validar"}}', '2018-02-05 23:46:50', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}'),
(133, '{"atividade":"Mudança em estado de validação","data":{"curriculoId":"00002","ic":"coordProj","icId":"27","state":"1","date":"2018-02-01","emailVal":"propex@ifs.edu.br","op":"curriculo\\/ic\\/validar"}}', '2018-02-05 23:46:51', '{"email":"propex@ifs.edu.br","ip":"::1","privilegios":{"gerenciador":true,"validador":true}}');

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil`
--

CREATE TABLE `perfil` (
  `email` varchar(512) DEFAULT NULL,
  `nivel` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `perfil`
--

INSERT INTO `perfil` (`email`, `nivel`) VALUES
('propex@ifs.edu.br', 'gerenciador'),
('propex@ifs.edu.br', 'validador'),
('henriquecunhawd@gmail.com', 'pesquisador');

-- --------------------------------------------------------

--
-- Estrutura da tabela `regra`
--

CREATE TABLE `regra` (
  `idRegra` int(11) NOT NULL,
  `ptInd` float NOT NULL,
  `ptMax` float NOT NULL,
  `content` text,
  `ic` varchar(64) NOT NULL,
  `idEdital` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `regra`
--

INSERT INTO `regra` (`idRegra`, `ptInd`, `ptMax`, `content`, `ic`, `idEdital`) VALUES
(36, 0, 0, '{"maior":true,"tipo":"grad"}', 'titulacao', 3),
(37, 5, 5, '{"maior":true,"tipo":"esp"}', 'titulacao', 3),
(38, 10, 10, '{"maior":true,"tipo":"mest"}', 'titulacao', 3),
(39, 20, 20, '{"maior":true,"tipo":"doc"}', 'titulacao', 3),
(40, 3, 9, '{"ano":"2012","lim":false}', 'artigo', 3),
(41, 2, 4, '{"ano":"2012","lim":false}', 'livro', 3),
(42, 1, 2, '{"ano":"2012","lim":false}', 'capLivro', 3),
(50, 1, 3, '{"ano":"2012","lim":false}', 'organizacaoEvento', 3),
(52, 1.5, 4.5, '{"ano":"2012","tipo":"doc","lim":false}', 'banca', 3),
(53, 0.5, 2, '{"ano":"2012","tipo":"grad","lim":false}', 'banca', 3),
(54, 1, 3, '{"ano":"2012","tipo":"mest","lim":false}', 'banca', 3),
(61, 0.5, 1, '{"ano":"2012","tipo":"res_nac","class":"pais","lim":false}', 'trabEvento', 3),
(62, 1, 2, '{"ano":"2012","tipo":"res_inter","class":"pais","lim":false}', 'trabEvento', 3),
(63, 1.5, 3, '{"ano":"2012","tipo":"trab_nac","class":"pais","lim":false}', 'trabEvento', 3),
(64, 2, 4, '{"ano":"2012","tipo":"trab_inter","class":"pais","lim":false}', 'trabEvento', 3),
(65, 1, 3, '{"ano":"2012","lim":false}', 'corpoEditorial', 3),
(66, 2, 8, '{"ano":"2012","estado":true,"pontIndAnd":"1","pontMaxAnd":"3"}', 'coordProj', 3),
(67, 0, 0, '{"ano":"2012","tipo":"inic"}', 'orientacao', 3),
(68, 0.5, 2.5, '{"ano":"2012","tipo":"grad"}', 'orientacao', 3),
(69, 1, 3, '{"ano":"2012","tipo":"esp"}', 'orientacao', 3),
(70, 2, 4, '{"ano":"2012","tipo":"mest"}', 'orientacao', 3),
(71, 3, 9, '{"ano":"2012","tipo":"doc"}', 'orientacao', 3),
(72, 0, 0, '{"ano":"2012","tipo":"posdoc"}', 'orientacao', 3),
(73, 3, 6, '{"ano":"2012","lim":false}', 'patente', 3),
(74, 1, 2, '{"ano":"2012","lim":false}', 'marca', 3),
(75, 1, 2, '{"ano":"2012","lim":false}', 'software', 3),
(76, 6, 12, '{"ano":"2012","tipo":"inter","class":"class","lim":false}', 'trabEvento', 9),
(77, 4, 8, '{"ano":"2012","tipo":"nac","class":"class","lim":false}', 'trabEvento', 9),
(81, 3, 9, '{"ano":false,"lim":false,"extrato":"a1"}', 'artigo', 9),
(82, 5, 10, '{"ano":"2010","lim":false}', 'partPos', 9),
(89, 3, 9, '{"ano":false,"estado":false,"pontIndAnd":false,"pontMaxAnd":false}', 'coordProj', 9),
(90, 3, 9, '{"ano":false,"lim":false}', 'marca', 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sumario`
--

CREATE TABLE `sumario` (
  `idSumario` int(11) NOT NULL,
  `idEdital` int(11) NOT NULL,
  `pontTotal` double NOT NULL,
  `hashcode` text NOT NULL,
  `curriculoId` int(11) NOT NULL,
  `content` text NOT NULL,
  `dataPont` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `sumario`
--

INSERT INTO `sumario` (`idSumario`, `idEdital`, `pontTotal`, `hashcode`, `curriculoId`, `content`, `dataPont`) VALUES
(1, 3, 35, '0780a44e1e9551566402c43322d792a9', 2, '{"artigo":{"detail":{"pt":9,"itens":4,"ptInd":"3","ptMax":"9"},"generico":true},"capLivro":{"detail":{"pt":0,"itens":0,"ptInd":"1","ptMax":"2"},"generico":true},"corpoEditorial":{"detail":{"pt":0,"itens":0,"ptInd":"1","ptMax":"3"},"generico":true},"livro":{"detail":{"pt":0,"itens":0,"ptInd":"2","ptMax":"4"},"generico":true},"marca":{"detail":{"pt":0,"itens":0,"ptInd":"1","ptMax":"2"},"generico":true},"organizacaoEvento":{"detail":{"pt":0,"itens":0,"ptInd":"1","ptMax":"3"},"generico":true},"patente":{"detail":{"pt":0,"itens":0,"ptInd":"3","ptMax":"6"},"generico":true},"software":{"detail":{"pt":0,"itens":0,"ptInd":"1","ptMax":"2"},"generico":true},"titulacao":{"detail":{"pont":"20","details":{"1":{"tipo":1,"ptMax":"0","pt":0},"2":{"tipo":2,"ptMax":"5","pt":0},"3":{"tipo":3,"ptMax":"10","pt":0},"4":{"tipo":4,"ptMax":"20","pt":"20"}}},"generico":false},"banca":{"detail":{"pt":6,"grad":{"pt":4.5,"ptMax":"4.5","itens":4},"mest":{"pt":1.5,"ptMax":"2","itens":3},"doc":{"pt":0,"ptMax":"3","itens":0}},"generico":false},"coordProj":{"detail":{"ptAnd":0,"ptConcl":0,"itensAnd":0,"itensConcl":0,"ptMaxAnd":"3","ptMaxConcl":"8"},"generico":false},"orientacao":{"detail":{"1":{"tipo":"inic","itens":0,"pt":0,"max":"0"},"2":{"tipo":"grad","itens":0,"pt":0,"max":"0"},"3":{"tipo":"esp","itens":0,"pt":0,"max":"4"},"4":{"tipo":"mest","itens":0,"pt":0,"max":"9"},"5":{"tipo":"doc","itens":0,"pt":0,"max":"2.5"},"6":{"tipo":"posdoc","itens":0,"pt":0,"max":"3"},"total":0},"generico":false},"trabEvento":{"detail":{"1":{"tipo":"res_nac","itens":2,"total":1,"max":2,"rule":{"ptInd":"0.5","ptMax":"1","tipo":"res_nac"}},"2":{"tipo":"res_inter","itens":0,"total":0,"max":2,"rule":{"ptInd":"1","ptMax":"2","tipo":"res_inter"}},"3":{"tipo":"trab_nac","itens":1,"total":1.5,"max":2,"rule":{"ptInd":"1.5","ptMax":"3","tipo":"trab_nac"}},"4":{"tipo":"trab_inter","itens":1,"total":2,"max":2,"rule":{"ptInd":"2","ptMax":"4","tipo":"trab_inter"}}},"generico":false}}', '2017-11-30');

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
  `dataCriacao` date NOT NULL,
  `campus` varchar(64) COLLATE utf8_bin NOT NULL,
  `coordenadoria` varchar(64) COLLATE utf8_bin NOT NULL,
  `siape` varchar(32) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`email`, `senha`, `nomeCompleto`, `dataNascimento`, `genero`, `cpf`, `rg`, `endereco`, `cep`, `telefone`, `dataCriacao`, `campus`, `coordenadoria`, `siape`) VALUES
('henriquecunhawd@gmail.com', '$2y$10$/VaqwRT6Be4g2amjoBlNTuu4fn1B0pFG/x06uWYHAMeZ0u3UBrAFS', 'Carlos Henrique Andrade Cunha', '2017-11-18', ' ', '060.376.135-67', ' ', ' ', ' ', ' ', '2017-11-18', '', '', ''),
('propex@ifs.edu.br', '$2y$10$td2WyMJLdxPHw3cE3mDE6eXu0R1bmTojmZEJxlZxltRdw9Y6PYaE2', 'PROPEX - IFS', '0000-01-01', '-', '-', '-', '-', '-', '-', '0000-01-01', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `curriculo`
--
ALTER TABLE `curriculo`
  ADD PRIMARY KEY (`curriculoId`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `edital`
--
ALTER TABLE `edital`
  ADD PRIMARY KEY (`idEdital`),
  ADD UNIQUE KEY `numero` (`numero`);

--
-- Indexes for table `ic_artigo`
--
ALTER TABLE `ic_artigo`
  ADD PRIMARY KEY (`idArtigo`),
  ADD KEY `curriculoId` (`curriculoId`);

--
-- Indexes for table `ic_banca`
--
ALTER TABLE `ic_banca`
  ADD PRIMARY KEY (`idBanca`),
  ADD KEY `curriculoId` (`curriculoId`);

--
-- Indexes for table `ic_caplivro`
--
ALTER TABLE `ic_caplivro`
  ADD PRIMARY KEY (`idCapLivro`),
  ADD KEY `curriculoId` (`curriculoId`);

--
-- Indexes for table `ic_coordproj`
--
ALTER TABLE `ic_coordproj`
  ADD PRIMARY KEY (`idCoordProj`),
  ADD KEY `curriculoId` (`curriculoId`);

--
-- Indexes for table `ic_corpoeditorial`
--
ALTER TABLE `ic_corpoeditorial`
  ADD PRIMARY KEY (`idCorpoEditorial`),
  ADD KEY `curriculoId` (`curriculoId`);

--
-- Indexes for table `ic_livro`
--
ALTER TABLE `ic_livro`
  ADD PRIMARY KEY (`idLivro`),
  ADD KEY `curriculoId` (`curriculoId`);

--
-- Indexes for table `ic_marca`
--
ALTER TABLE `ic_marca`
  ADD PRIMARY KEY (`idMarca`),
  ADD KEY `curriculoId` (`curriculoId`);

--
-- Indexes for table `ic_organizacaoevento`
--
ALTER TABLE `ic_organizacaoevento`
  ADD PRIMARY KEY (`idOrganizacaoEvento`),
  ADD KEY `curriculoId` (`curriculoId`);

--
-- Indexes for table `ic_orientacao`
--
ALTER TABLE `ic_orientacao`
  ADD PRIMARY KEY (`idOrientacao`),
  ADD KEY `curriculoId` (`curriculoId`);

--
-- Indexes for table `ic_partpos`
--
ALTER TABLE `ic_partpos`
  ADD PRIMARY KEY (`idPartPos`),
  ADD KEY `curriculoId` (`curriculoId`);

--
-- Indexes for table `ic_patente`
--
ALTER TABLE `ic_patente`
  ADD PRIMARY KEY (`idPatente`),
  ADD KEY `curriculoId` (`curriculoId`);

--
-- Indexes for table `ic_software`
--
ALTER TABLE `ic_software`
  ADD PRIMARY KEY (`idSoftware`),
  ADD KEY `curriculoId` (`curriculoId`);

--
-- Indexes for table `ic_titulacao`
--
ALTER TABLE `ic_titulacao`
  ADD PRIMARY KEY (`idTitulacao`),
  ADD KEY `curriculoId` (`curriculoId`);

--
-- Indexes for table `ic_trabevento`
--
ALTER TABLE `ic_trabevento`
  ADD PRIMARY KEY (`idTrabEvento`),
  ADD KEY `curriculoId` (`curriculoId`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `perfil`
--
ALTER TABLE `perfil`
  ADD KEY `email` (`email`);

--
-- Indexes for table `regra`
--
ALTER TABLE `regra`
  ADD PRIMARY KEY (`idRegra`),
  ADD KEY `idEdital` (`idEdital`);

--
-- Indexes for table `sumario`
--
ALTER TABLE `sumario`
  ADD PRIMARY KEY (`idSumario`),
  ADD KEY `idEdital` (`idEdital`),
  ADD KEY `curriculoId` (`curriculoId`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `curriculo`
--
ALTER TABLE `curriculo`
  MODIFY `curriculoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `edital`
--
ALTER TABLE `edital`
  MODIFY `idEdital` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `ic_artigo`
--
ALTER TABLE `ic_artigo`
  MODIFY `idArtigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `ic_banca`
--
ALTER TABLE `ic_banca`
  MODIFY `idBanca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `ic_caplivro`
--
ALTER TABLE `ic_caplivro`
  MODIFY `idCapLivro` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ic_coordproj`
--
ALTER TABLE `ic_coordproj`
  MODIFY `idCoordProj` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `ic_corpoeditorial`
--
ALTER TABLE `ic_corpoeditorial`
  MODIFY `idCorpoEditorial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ic_livro`
--
ALTER TABLE `ic_livro`
  MODIFY `idLivro` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ic_marca`
--
ALTER TABLE `ic_marca`
  MODIFY `idMarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ic_organizacaoevento`
--
ALTER TABLE `ic_organizacaoevento`
  MODIFY `idOrganizacaoEvento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `ic_orientacao`
--
ALTER TABLE `ic_orientacao`
  MODIFY `idOrientacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `ic_partpos`
--
ALTER TABLE `ic_partpos`
  MODIFY `idPartPos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `ic_patente`
--
ALTER TABLE `ic_patente`
  MODIFY `idPatente` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ic_software`
--
ALTER TABLE `ic_software`
  MODIFY `idSoftware` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ic_titulacao`
--
ALTER TABLE `ic_titulacao`
  MODIFY `idTitulacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `ic_trabevento`
--
ALTER TABLE `ic_trabevento`
  MODIFY `idTrabEvento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;
--
-- AUTO_INCREMENT for table `regra`
--
ALTER TABLE `regra`
  MODIFY `idRegra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT for table `sumario`
--
ALTER TABLE `sumario`
  MODIFY `idSumario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `curriculo`
--
ALTER TABLE `curriculo`
  ADD CONSTRAINT `curriculo_ibfk_1` FOREIGN KEY (`email`) REFERENCES `usuario` (`email`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `ic_artigo`
--
ALTER TABLE `ic_artigo`
  ADD CONSTRAINT `ic_artigo_ibfk_1` FOREIGN KEY (`curriculoId`) REFERENCES `curriculo` (`curriculoId`);

--
-- Limitadores para a tabela `ic_banca`
--
ALTER TABLE `ic_banca`
  ADD CONSTRAINT `ic_banca_ibfk_1` FOREIGN KEY (`curriculoId`) REFERENCES `curriculo` (`curriculoId`);

--
-- Limitadores para a tabela `ic_caplivro`
--
ALTER TABLE `ic_caplivro`
  ADD CONSTRAINT `ic_capLivro_ibfk_1` FOREIGN KEY (`curriculoId`) REFERENCES `curriculo` (`curriculoId`);

--
-- Limitadores para a tabela `ic_coordproj`
--
ALTER TABLE `ic_coordproj`
  ADD CONSTRAINT `ic_coordProj_ibfk_1` FOREIGN KEY (`curriculoId`) REFERENCES `curriculo` (`curriculoId`);

--
-- Limitadores para a tabela `ic_corpoeditorial`
--
ALTER TABLE `ic_corpoeditorial`
  ADD CONSTRAINT `ic_corpoEditorial_ibfk_1` FOREIGN KEY (`curriculoId`) REFERENCES `curriculo` (`curriculoId`);

--
-- Limitadores para a tabela `ic_livro`
--
ALTER TABLE `ic_livro`
  ADD CONSTRAINT `ic_livro_ibfk_1` FOREIGN KEY (`curriculoId`) REFERENCES `curriculo` (`curriculoId`);

--
-- Limitadores para a tabela `ic_marca`
--
ALTER TABLE `ic_marca`
  ADD CONSTRAINT `ic_marca_ibfk_1` FOREIGN KEY (`curriculoId`) REFERENCES `curriculo` (`curriculoId`);

--
-- Limitadores para a tabela `ic_organizacaoevento`
--
ALTER TABLE `ic_organizacaoevento`
  ADD CONSTRAINT `ic_organizacaoEvento_ibfk_1` FOREIGN KEY (`curriculoId`) REFERENCES `curriculo` (`curriculoId`);

--
-- Limitadores para a tabela `ic_orientacao`
--
ALTER TABLE `ic_orientacao`
  ADD CONSTRAINT `ic_orientacao_ibfk_1` FOREIGN KEY (`curriculoId`) REFERENCES `curriculo` (`curriculoId`);

--
-- Limitadores para a tabela `ic_patente`
--
ALTER TABLE `ic_patente`
  ADD CONSTRAINT `ic_patente_ibfk_1` FOREIGN KEY (`curriculoId`) REFERENCES `curriculo` (`curriculoId`);

--
-- Limitadores para a tabela `ic_software`
--
ALTER TABLE `ic_software`
  ADD CONSTRAINT `ic_software_ibfk_1` FOREIGN KEY (`curriculoId`) REFERENCES `curriculo` (`curriculoId`);

--
-- Limitadores para a tabela `ic_titulacao`
--
ALTER TABLE `ic_titulacao`
  ADD CONSTRAINT `ic_titulacao_ibfk_1` FOREIGN KEY (`curriculoId`) REFERENCES `curriculo` (`curriculoId`);

--
-- Limitadores para a tabela `ic_trabevento`
--
ALTER TABLE `ic_trabevento`
  ADD CONSTRAINT `ic_trabEvento_ibfk_1` FOREIGN KEY (`curriculoId`) REFERENCES `curriculo` (`curriculoId`);

--
-- Limitadores para a tabela `perfil`
--
ALTER TABLE `perfil`
  ADD CONSTRAINT `perfil_ibfk_1` FOREIGN KEY (`email`) REFERENCES `usuario` (`email`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `regra`
--
ALTER TABLE `regra`
  ADD CONSTRAINT `regra_ibfk_1` FOREIGN KEY (`idEdital`) REFERENCES `edital` (`idEdital`);

--
-- Limitadores para a tabela `sumario`
--
ALTER TABLE `sumario`
  ADD CONSTRAINT `sumario_ibfk_1` FOREIGN KEY (`idEdital`) REFERENCES `edital` (`idEdital`),
  ADD CONSTRAINT `sumario_ibfk_2` FOREIGN KEY (`curriculoId`) REFERENCES `curriculo` (`curriculoId`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
