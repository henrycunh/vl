-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 14, 2017 at 08:01 PM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 7.0.18-0ubuntu0.16.04.1

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
-- Table structure for table `curriculo`
--

CREATE TABLE `curriculo` (
  `email` varchar(512) DEFAULT NULL,
  `curriculoId` int(11) NOT NULL,
  `nomePessoa` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `curriculo`
--

INSERT INTO `curriculo` (`email`, `curriculoId`, `nomePessoa`) VALUES
('teste@teste.com', 3, 'José Augusto Andrade Filho');

-- --------------------------------------------------------

--
-- Table structure for table `edital`
--

CREATE TABLE `edital` (
  `idEdital` int(11) NOT NULL,
  `nome` varchar(64) NOT NULL,
  `dataCriacao` date NOT NULL,
  `vigencia` date NOT NULL,
  `numero` varchar(16) NOT NULL,
  `descricao` text,
  `link` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `edital`
--

INSERT INTO `edital` (`idEdital`, `nome`, `dataCriacao`, `vigencia`, `numero`, `descricao`, `link`) VALUES
(1, 'Teste', '2017-05-31', '2017-05-02', '7865', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque tortor leo, ultricies sed sem vel, sodales aliquet lectus. Fusce aliquam diam diam, a volutpat erat rhoncus et. Morbi neque massa, accumsan at neque vitae, consectetur tempor mauris. Nunc ornare volutpat nisi, in aliquam nibh gravida ac. Aliquam luctus justo eros, eget semper tellus vulputate in. Nulla nisl metus, laoreet a placerat et, aliquet varius magna. Etiam commodo sollicitudin sem non placerat. Vivamus vehicula leo in accumsan convallis. Aenean euismod molestie ligula, et vulputate nunc fringilla non. Mauris facilisis a ipsum ac pellentesque.</p><p>Praesent turpis dui, venenatis vel aliquam varius, malesuada ac libero. Pellentesque id tristique orci. Nullam dapibus libero et nulla sodales convallis. Mauris volutpat, est sed congue convallis, orci velit tincidunt mauris, vel viverra eros eros id ante. Curabitur faucibus vel ligula vitae consequat. Aliquam mi lectus, tincidunt id augue eget, tempus elementum dui. Pellentesque eu metus vitae magna viverra euismod sed eu nulla. In cursus nulla vitae quam facilisis, nec vulputate purus sagittis.</p><p>Donec eu mauris turpis. Fusce ut est elit. Aliquam aliquet diam a interdum pulvinar. Donec vitae metus et eros interdum tempor. Suspendisse sagittis, libero at eleifend tristique, dui lectus viverra sapien, eget pharetra lectus massa at libero. Praesent eget purus dictum, eleifend odio in, egestas sapien. Nam aliquam ex nec magna mattis ultrices.</p><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam tristique est eget enim varius, lacinia suscipit orci pellentesque. Morbi facilisis sapien in tempus laoreet. Sed et porta enim, eget tincidunt elit. Vivamus diam arcu, luctus ac neque id, blandit commodo lacus. Duis consequat sagittis tellus. Suspendisse id tristique lorem, eu ullamcorper quam. Etiam pulvinar lacus vel risus lobortis, sit amet imperdiet massa aliquet. Etiam convallis nisi sed nunc viverra, et eleifend elit euismod. Quisque nec magna eget dui pharetra consequat. Nunc lacus leo, pharetra ut commodo non, iaculis sit amet neque. Nulla eget nisl vel mi viverra auctor et sit amet ligula. Nulla lobortis, sapien et ultrices feugiat, lacus nulla molestie leo, at mollis nisi arcu ut ipsum.</p><p>Fusce egestas libero eu justo consequat sodales. Nunc non lectus blandit, ultricies nisl in, congue nibh. Quisque sollicitudin, sapien rutrum lobortis dignissim, felis ipsum venenatis elit, sit amet luctus orci ligula eu erat. Nullam non sodales risus. Nam commodo, massa bibendum blandit maximus, velit sem tincidunt leo, a gravida mi dolor at nulla. Nulla at magna hendrerit, auctor massa et, tincidunt lectus. Aliquam non leo rutrum, pellentesque dolor et, ornare nisl. Suspendisse dictum at augue eget semper. Donec egestas volutpat sem, nec tristique justo euismod fringilla. Vivamus vitae porta sem. Nunc nisi eros, vulputate a scelerisque eget, varius eget arcu. Donec metus orci, vestibulum vitae nulla ac, efficitur sodales ipsum. Proin interdum ante vel velit sodales sodales. Morbi placerat lobortis elit, in dignissim erat consequat dapibus.</p>', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ic_artigo`
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
  `volume` varchar(8) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ic_artigo`
--

INSERT INTO `ic_artigo` (`emailValidador`, `dataValidacao`, `validado`, `comprovante`, `curriculoId`, `idArtigo`, `titulo`, `ano`, `tituloPeriodico`, `issn`, `paginaInicial`, `paginaFinal`, `pais`, `idioma`, `autores`, `volume`) VALUES
(NULL, NULL, 1, NULL, 3, 122, 'Grid job scheduling using Route with Genetic Algorithm support', '2008', 'Telecommunication Systems', '10184864', '1', '', '', 'Inglês', '[\n    {\n        "nomeCompleto": "Rodrigo Fernandes de Mello",\n        "nomeCitacao": "Mello R. F.",\n        "numIdCNPQ": "6840478133476887"\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    },\n    {\n        "nomeCompleto": "Luciano José Senger",\n        "nomeCitacao": "SENGER, L. J.",\n        "numIdCNPQ": "6880696447532558"\n    },\n    {\n        "nomeCompleto": "Laurence T. Yang",\n        "nomeCitacao": "YANG, L. T.",\n        "numIdCNPQ": ""\n    }\n]', '38'),
(NULL, NULL, 1, NULL, 3, 123, 'Online behavior change detection in computer games', '2013', 'Expert Systems with Applications', '09574174', '6258', '6265', '', 'Português', '[\n    {\n        "nomeCompleto": "VALLIM, ROSANE M.M.",\n        "nomeCitacao": "VALLIM, ROSANE M.M.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, JOSÉ A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "DE MELLO, RODRIGO F.",\n        "nomeCitacao": "DE MELLO, RODRIGO F.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "DE CARVALHO, ANDRÉ C.P.L.F.",\n        "nomeCitacao": "DE CARVALHO, ANDRÉ C.P.L.F.",\n        "numIdCNPQ": "9674541381385819"\n    }\n]', '40'),
(NULL, NULL, 1, NULL, 3, 124, 'Outliers Detection Using Control Charts for Oil Wells', '2014', 'Asian Journal of Scientific Research', '19921454', '174', '181', '', 'Português', '[\n    {\n        "nomeCompleto": "Daniel Francisco Maranhão Evangelista",\n        "nomeCitacao": "EVANGELISTA, D. F. M.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Glaucio Jose Couri Machado",\n        "nomeCitacao": "MACHADO, G. J. C.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Gabriel Francisco da Silva",\n        "nomeCitacao": "SILVA, G. F.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Suzana Leitão Russo",\n        "nomeCitacao": "RUSSO, S. L.",\n        "numIdCNPQ": "8056542335438905"\n    }\n]', '4'),
(NULL, NULL, 1, NULL, 3, 125, 'Statistical Control of Water Quality in the Aracaju, Sergipe, Brazil', '2014', 'Australian Journal of Basic and Applied Sciences', '19918178', '226', '230', '', 'Português', '[\n    {\n        "nomeCompleto": "Suzana Leitão Russo",\n        "nomeCitacao": "RUSSO, S. L.",\n        "numIdCNPQ": "8056542335438905"\n    },\n    {\n        "nomeCompleto": "SANTOS, M. V. V. dos",\n        "nomeCitacao": "SANTOS, M. V. V. dos",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Lázaro de Souto Araújo",\n        "nomeCitacao": "ARAUJO, L. S.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Ana Eleonora Almeida Paixão",\n        "nomeCitacao": "PAIXAO, A. E.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Maria Emília Camargo",\n        "nomeCitacao": "CAMARGO, M. E.",\n        "numIdCNPQ": "7617091280907670"\n    }\n]', '8'),
(NULL, NULL, 1, NULL, 3, 126, 'Flow Behavior of Santa Maria Airport Landings through Intervention Models', '2014', 'Business Management Dynamics', '20477031', '01', '07', '', 'Inglês', '[\n    {\n        "nomeCompleto": "Daiane Costa Guimarães",\n        "nomeCitacao": "GUIMARAES, D. C.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, JOSÉ A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Ricardo de Santana",\n        "nomeCitacao": "SANTANA, J. R.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Suzana Leitão Russo",\n        "nomeCitacao": "RUSSO, S. L.",\n        "numIdCNPQ": "8056542335438905"\n    }\n]', '4'),
(NULL, NULL, 1, NULL, 3, 127, 'Spectral Analysis Applied to Variables of Oil Wells Profiling', '2014', 'World Academy of Science, Engineering and Technology', '13076892', '327', '', '', 'Inglês', '[\n    {\n        "nomeCompleto": "Suzana Leitão Russo",\n        "nomeCitacao": "RUSSO, S. L.",\n        "numIdCNPQ": "8056542335438905"\n    },\n    {\n        "nomeCompleto": "Mayara Laysa de Oliveira Silva",\n        "nomeCitacao": "SILVA, M. L. O.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Vitor Hugo Simon",\n        "nomeCitacao": "SIMON, V. H.",\n        "numIdCNPQ": ""\n    }\n]', '1'),
(NULL, NULL, 1, NULL, 3, 128, 'Unsupervised density-based behavior change detection in data streams', '2014', 'Intelligent Data Analysis (Print)', '1088467X', '181', '201', '', 'Inglês', '[\n    {\n        "nomeCompleto": "Rosane M. M. Vallim",\n        "nomeCitacao": "VALLIM, R. M. M.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    },\n    {\n        "nomeCompleto": "Rodrigo Fernandes de Mello",\n        "nomeCitacao": "MELLO, R. F.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "André Carlos Ponce de Leon Carvalho",\n        "nomeCitacao": "CARVALHO, A. C. P. L.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "João Gama",\n        "nomeCitacao": "GAMA, J.",\n        "numIdCNPQ": ""\n    }\n]', '18'),
(NULL, NULL, 1, NULL, 3, 129, 'Technologic Information about Photovoltaic Applied in Urban Residences', '2016', 'World Academy of Science, Engineering and Technology (Online)', '20103778', '1198', '1201', '', 'Inglês', '[\n    {\n        "nomeCompleto": "Stephanie Fabris Russo",\n        "nomeCitacao": "RUSSO, S. F.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Daiane Costa Guimarães",\n        "nomeCitacao": "GUIMARAES, D. C.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Jonas Pedro Fabris",\n        "nomeCitacao": "FABRIS, J. P.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Maria Emília Camargo",\n        "nomeCitacao": "CAMARGO, M. E.",\n        "numIdCNPQ": "7617091280907670"\n    },\n    {\n        "nomeCompleto": "Suzana Leitão Russo",\n        "nomeCitacao": "RUSSO, S. L.",\n        "numIdCNPQ": "8056542335438905"\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.",\n        "numIdCNPQ": ""\n    }\n]', '10'),
(NULL, NULL, 1, NULL, 3, 130, 'Redes de colaboração tecnológica através do estudo de co-titularidades de patentes', '2016', 'Interciencia (Caracas)', '03781844', '839', '843', '', 'Português', '[\n    {\n        "nomeCompleto": "Edmara Thaís Neres Menezes",\n        "nomeCitacao": "MENEZES, E. T. N.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Suzana Leitão Russo",\n        "nomeCitacao": "RUSSO, S. L.",\n        "numIdCNPQ": "8056542335438905"\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    },\n    {\n        "nomeCompleto": "Maria Emilia Camargo",\n        "nomeCitacao": "CAMARGO, M. E.",\n        "numIdCNPQ": ""\n    }\n]', '41');

-- --------------------------------------------------------

--
-- Table structure for table `ic_banca`
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
-- Dumping data for table `ic_banca`
--

INSERT INTO `ic_banca` (`emailValidador`, `dataValidacao`, `validado`, `comprovante`, `curriculoId`, `idBanca`, `tipo`, `natureza`, `tipoBanca`, `titulo`, `ano`, `homepage`, `doi`, `nomeCandidato`, `nomeInstituicao`, `nomeCurso`, `participantes`) VALUES
(NULL, NULL, -1, NULL, 3, 95, '1', 'Graduação', '', 'Aplicação de técnica de esteganografia como ferramental da acessibilidade em sítios Web', '2008', '', '', 'Cristiano Souza de Oliveira', 'Universidade de São Paulo', 'Engenharia da Computação', '[\n    {\n        "nomeCompleto": "Alexandre Cláudio Botazzo Delbem",\n        "nomeCitacao": "DELBEM, A. C. B.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    }\n]'),
(NULL, NULL, -1, NULL, 3, 96, '1', 'Graduação', '', 'Implantação de um servidor de internet e de arquivos na plataforma Linux', '2010', '', '', 'Jair Colombo Filho', 'Universidade de São Paulo', 'Bacharelado em Informática', '[\n    {\n        "nomeCompleto": "José Carlos Maldonado",\n        "nomeCitacao": "MALDONADO, J. C.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    }\n]'),
(NULL, NULL, -1, NULL, 3, 97, '1', 'Graduação', '', 'Aplicação de Redes em um Sistema Preditor de Horários - Um Estudo de Caso', '2010', '', '', 'Thiago Camargo Fernandes', 'Universidade de São Paulo', 'Bacharelado em Informática', '[\n    {\n        "nomeCompleto": "José Carlos Maldonado",\n        "nomeCitacao": "MALDONADO, J. C.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    }\n]'),
(NULL, NULL, -1, NULL, 3, 98, '1', 'Graduação', '', 'Virtualização de Servidores', '2010', '', '', 'Rodrigo Leitão Kehl', 'Universidade de São Paulo', 'Bacharelado em Informática', '[\n    {\n        "nomeCompleto": "Onofre Trindade Junior",\n        "nomeCitacao": "TRINDADE JUNIOR, O.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    }\n]'),
(NULL, NULL, -1, NULL, 3, 99, '1', 'Graduação', '', 'A semiótica como base para criação de personagens de jogos eletrônicos: um estudo de caso', '2014', '', '', 'Amanda Rocha Santos', 'Universidade Federal de Sergipe', 'Design', '[\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Rogério Torres da Silva",\n        "nomeCitacao": "SILVA, R. T.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Márjorie Garrido Severo",\n        "nomeCitacao": "SEVERO, M. G.",\n        "numIdCNPQ": ""\n    }\n]'),
(NULL, NULL, -1, NULL, 3, 100, '1', 'Graduação', '', 'Ajustamento da Série de Acidentes Aéreos Mundiais através do Modelos Holt-Winters', '2014', '', '', 'Antonio Henrique Barbosa Lima', 'Universidade Federal de Sergipe', 'Estatística', '[\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, JOSÉ A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Suzana Leitão Russo",\n        "nomeCitacao": "RUSSO, S. L.",\n        "numIdCNPQ": "8056542335438905"\n    },\n    {\n        "nomeCompleto": "Lázaro de Souto Araújo",\n        "nomeCitacao": "ARAUJO, L. S.",\n        "numIdCNPQ": ""\n    }\n]'),
(NULL, NULL, -1, NULL, 3, 101, '1', 'Graduação', '', 'Arrecadação da Previdência Complementar Aberta: Uma Análise de Desempenho e Casualidade', '2014', '', '', 'Sandra Santos Santa Rosa', 'Universidade Federal de Sergipe', 'Ciências Atuariais', '[\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, JOSÉ A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Íkaro Daniel de Carvalho Barreto",\n        "nomeCitacao": "BARRETO, I. D. C.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Rosilda Benício de Souza",\n        "nomeCitacao": "SOUZA, R. B.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Juliana Kátia da Silva",\n        "nomeCitacao": "SILVA, J. K.",\n        "numIdCNPQ": ""\n    }\n]'),
(NULL, NULL, -1, NULL, 3, 102, '3', 'Mestrado', '', 'DESENVOLVIMENTO TECNOLÓGICO: A PROPRIEDADE INDUSTRIAL NA PRODUÇÃO DA GUITARRA ELÉTRICA E CAPTADORES', '2016', '', '', 'VINICIUS NELSON LAGO SILVA', 'Universidade Federal de Sergipe', 'CIÊNCIA DA PROPRIEDADE INTELECTUAL', '[\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Suzana Leitão Russo",\n        "nomeCitacao": "RUSSO, S. L.",\n        "numIdCNPQ": "8056542335438905"\n    },\n    {\n        "nomeCompleto": "CRISTINA MARIA ASSIS LOPES TAVARES DA MATA HERMIDA QUINTELLA",\n        "nomeCitacao": "QUINTELLA, C.",\n        "numIdCNPQ": ""\n    }\n]'),
(NULL, NULL, -1, NULL, 3, 103, '3', 'Mestrado', '', 'Mensuração da Produção Científica e Tecnológica de Pesquisadores da Universidade Federal de Sergipe Após a Lei de Inovação', '2016', '', '', 'EDMARA THAYS NERES MENEZES', 'Universidade Federal de Sergipe', 'CIÊNCIA DA PROPRIEDADE INTELECTUAL', '[\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, JOSÉ A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Suzana Leitão Russo",\n        "nomeCitacao": "RUSSO, S. L.",\n        "numIdCNPQ": "8056542335438905"\n    },\n    {\n        "nomeCompleto": "Iracema Machado de Aragão Gomes",\n        "nomeCitacao": "GOMES, I. M. A.",\n        "numIdCNPQ": ""\n    }\n]'),
(NULL, NULL, -1, NULL, 3, 104, '3', 'Mestrado', '', 'Hardware Embarcado para Aquisição e Análise de Sinais Vitais usando o Protocolo de Comunicação ModBus', '2016', '', '', 'LUIS OTAVIO SANTOS DE ANDRADE', 'Universidade Federal de Sergipe', 'Ciência da Computação', '[\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "EDWARD DAVID MORENO ORDONEZ",\n        "nomeCitacao": "ORDONEZ, E. D. M.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "ADICINEIA APARECIDA DE OLIVEIRA",\n        "nomeCitacao": "OLIVEIRA, A. A.",\n        "numIdCNPQ": ""\n    }\n]');

-- --------------------------------------------------------

--
-- Table structure for table `ic_capLivro`
--

CREATE TABLE `ic_capLivro` (
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
-- Table structure for table `ic_coordProj`
--

CREATE TABLE `ic_coordProj` (
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
-- Dumping data for table `ic_coordProj`
--

INSERT INTO `ic_coordProj` (`emailValidador`, `dataValidacao`, `validado`, `comprovante`, `curriculoId`, `idCoordProj`, `nomeInstituicao`, `anoInicio`, `anoFim`, `nomeProj`, `situacao`, `natureza`, `descricao`, `responsavel`, `equipe`) VALUES
(NULL, NULL, -1, NULL, 3, 98, 'Universidade Federal de Sergipe', '2015', '2016', 'Incidência Tributária e a Sonegação do IPVA em Sergipe', 'CONCLUIDO', 'PESQUISA', 'Sabe-se que a Receita Pública é uma questão importante para o desenvolvimento dos estados. As recentes crises financeiras e o crescimento das demandas da sociedade configuram um cenário repleto de desafios para a gestão de finanças públicas, cabendo aos gestores aplicar de maneira eficiente os recursos que são arrecadados e geridos pelo estado. Neste sentido, o presente estudo busca analisar o comportamento incidência tributária na Secretaria de Estado da Fazenda de Sergipe (SEFAZ) com relação a sonegação do IPVA, e além disso, busca-se identificar ações que pudessem elucidar o motivo que levem a sonegação de IPVA pelos contribuintes.', 0, '[\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    },\n    {\n        "nomeCompleto": "Glaucio Jose Couri Machado",\n        "nomeCitacao": "MACHADO, G. J. C.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Suzana Leitão Russo",\n        "nomeCitacao": "RUSSO, S. L.",\n        "numIdCNPQ": "8056542335438905"\n    },\n    {\n        "nomeCompleto": "Maria Emília Camargo",\n        "nomeCitacao": "CAMARGO, M. E.",\n        "numIdCNPQ": "7617091280907670"\n    },\n    {\n        "nomeCompleto": "Jonas Pedro Fabris",\n        "nomeCitacao": "FABRIS, J. P.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Iracema Machado de Aragão Gomes",\n        "nomeCitacao": "GOMES, I. M. A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Adonis Reis de Medeiros Filho",\n        "nomeCitacao": "MEDEIROS FILHO, A. R.",\n        "numIdCNPQ": ""\n    }\n]'),
(NULL, NULL, -1, NULL, 3, 99, 'Universidade de São Paulo', '2012', '2013', 'Desafios em Mineração de Dados', 'CONCLUIDO', 'PESQUISA', 'Com o volume cada vez maior de dados gerados e a importância crescente da economia baseada em conhecimento, a Descoberta de Conhecimento de Bases de Dados, principalmente sua etapa de Mineração de Dados, é cada vez mais adotada em empresas e órgãos governamentais. A complexidade dos problemas a serem tratados por Mineração de Dados leva a necessidade de novos métodos e ferramentas computacionais capazes de apoiar a análise dos dados pelos usuários. Duas das principais etapas de Mineração de Dados são as de pré-processamento e de construção de modelos. Desafios relacionados a essas duas etapas são investigados neste projeto. Dados com baixa qualidade ou com problemas de elevada dimensão pode afetar significativamente o desempenho de algoritmos para construção de modelos. A etapa de construção de modelos permite induzir modelos descritivos e preditivos, frequentemente por algoritmos de Aprendizado de Máquina. Este projeto investigará as principais alternativas existentes para lidar com esses desafios assim como irá propor e investigar novos métodos para tal. Os métodos investigados serão experimentalmente avaliados de acordo com a metodologia correntemente utilizada pela comunidade de pesquisa das duas subáreas. Dado o elevado custo computacional associado aos experimentos nessas subáreas, serão investigados o uso de arquiteturas GPU e computação em nuvens. Deve ser observado que esse projeto continua pesquisas realizadas em projetos anteriores, com novas abordagens e desafios.', 0, '[\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    },\n    {\n        "nomeCompleto": "Andre C P L F de Carvalho",\n        "nomeCitacao": "CARVALHO, Andre C. P. L. F. de",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Rosane Maria Maffei Vallim",\n        "nomeCitacao": "VALLIM, R. M. M.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Rodrigo Barros",\n        "nomeCitacao": "BARROS, R.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Alex Freitas",\n        "nomeCitacao": "FREITAS, A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Murilo Coelho Naldi",\n        "nomeCitacao": "NALDI, M. C.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "David S. dos Santos Jr",\n        "nomeCitacao": "SANTOS JR, D. S.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Bruno Feres",\n        "nomeCitacao": "FERES, B.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "João Gama",\n        "nomeCitacao": "GAMA, J.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Eduardo Hruschka",\n        "nomeCitacao": "HRUSCHKA, E.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "André Rossi",\n        "nomeCitacao": "ROSSI, A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Luis Paulo Garcia",\n        "nomeCitacao": "GARCIA, L. P.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Ricardo Cerri",\n        "nomeCitacao": "CERRI, R.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Ana Carolina Lorena",\n        "nomeCitacao": "LORENA, A. C.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Carlos M. Soares",\n        "nomeCitacao": "SOARES, C. M.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Elaine Ribeiro",\n        "nomeCitacao": "RIBEIRO, E.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Pablo Granitto",\n        "nomeCitacao": "GRANITTO, P.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Tiago Silva da Silva",\n        "nomeCitacao": "SILVA, T. S.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Jonathan de Andrade Silva",\n        "nomeCitacao": "SILVA, J. A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Luiz Fernando Sommaggio Coletta",\n        "nomeCitacao": "COLETTA, L. F. S.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Thiago Ferreira Covões",\n        "nomeCitacao": "COVOES, T. F.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Dino Ienco",\n        "nomeCitacao": "IENCO, D.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Maguelonne Teisseire",\n        "nomeCitacao": "TEISSEIRE, M.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Pascal Poncelet",\n        "nomeCitacao": "PONCELET, P.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Rogério Miguel Pascual",\n        "nomeCitacao": "PASCUAL, R. M.",\n        "numIdCNPQ": ""\n    }\n]'),
(NULL, NULL, -1, NULL, 3, 100, 'Instituto Federal de Sergipe', '2015', '2016', 'Previsão de Arrecadação de ICMS no Estado de Sergipe Utilizando Modelos de Séries Temporais e Técnicas de Aprendizado de Máquina', 'CONCLUIDO', 'PESQUISA', 'A gestão da Receita Pública é de grande importância para o desenvolvimento dos Estados. Com as crises financeiras e o aumento das demandas da sociedade, forma-se um cenário de desafios para a gestão das finanças públicas. É de responsabilidade dos gestores definir de maneira eficiente os recursos arrecadados e geridos pelo Estado. Nesse sentido, a previsão das receitas com tributos e impostos apresenta-se como um desafio, pois dela depende a definição do orçamento. Assim, este projeto tem como objetivo analisar o comportamento da arrecadação do ICMS de modo a definir um modelo de predição ajustado à realidade do Estado de Sergipe, considerando fatores externos como variação de taxa de juros, previsão de inflação, dentre outros. Serão analisados modelos de Séries Temporais, em especial a metodologia Box-Jenkins, e técnicas de aprendizado de máquina, como as Redes Neurais.', 1, '[\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    },\n    {\n        "nomeCompleto": "Maria Emília Camargo",\n        "nomeCitacao": "CAMARGO, M. E.",\n        "numIdCNPQ": "7617091280907670"\n    },\n    {\n        "nomeCompleto": "Chirlaine Cristine Gonçalves",\n        "nomeCitacao": "GONCALVES, C. C.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Jonas Pedro Fabris",\n        "nomeCitacao": "FABRIS, J. P.",\n        "numIdCNPQ": ""\n    }\n]'),
(NULL, NULL, -1, NULL, 3, 101, 'Instituto Federal de Sergipe', '2015', '', 'Cidade Tecnológica Sustentável do IFS', 'EM_ANDAMENTO', 'PESQUISA', 'Gerente do Projeto Cidade Tecnológica do IFS', 1, '[\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    },\n    {\n        "nomeCompleto": "Chirlaine Cristine Gonçalves",\n        "nomeCitacao": "GONCALVES, C. C.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Ailton Ribeiro de Oliveira",\n        "nomeCitacao": "OLIVEIRA, A. R.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Ruth Sales Gama de Andrade",\n        "nomeCitacao": "ANDRADE, R. S. G.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Pablo Gleydson de Sousa",\n        "nomeCitacao": "SOUSA, P. G.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Roberto da Silva Macena",\n        "nomeCitacao": "MACENA, R. S.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Espínola da Silva Júnior",\n        "nomeCitacao": "ESPINOLA JR, J.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Fabiana Faxina",\n        "nomeCitacao": "FAXINA, F.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Jaime José da Silveira Barros Neto",\n        "nomeCitacao": "BARROS NETO, J. J. S.",\n        "numIdCNPQ": ""\n    }\n]'),
(NULL, NULL, -1, NULL, 3, 102, 'Instituto Federal de Sergipe', '2016', '', 'CRIAÇÃO DE WEBSITE PARA DIVULGAÇÃO E EXPOSIÇÃO DA MARCA, PRODUTOS E AÇÕES DESENVOLVIDOS NA ILHA MEM DE SÁ', 'EM_ANDAMENTO', 'EXTENSAO', 'Mundialmente, o turismo é visto como uma das principais fontes de receitas, competindo com grandes setores da economia. É considerado como uma atividade composta por várias cadeias produtivas e em alguns países, o turismo é visto como decisivo para os rumos do desenvolvimento da localidade. No Brasil, este setor econômico está dividido em oito segmentos, sendo que alguns têm se destacado pela sua intenção sustentável, como é o caso do Ecoturismo, no qual pode estar inserido o Turismo de Base Comunitária. No estado de Sergipe, na Ilha Mem de Sá, a pesca do aratu é uma das atividades econômicas da comunidade, realizada principalmente pelas mulheres e tem sido fortalecida nos últimos anos pela implementação de TBC, através da pesquisa-ação desenvolvida pelo Instituto Federal de Sergipe e parceiros.\nEm geral, a Ilha Mem de Sá tem pouca divulgação e o que é produzido tem sua divulgação restrita, pois essa é feita por meio do "boca-a-boca". Assim, é importante que os atrativos da Ilha Mem de Sá atinjam mais pessoas, uma possibilidade é a utilização de sites na Internet e em redes sociais. Dessa maneira, é possível atingir um público maior a baixo custo e com alcance que não respeita limites geográficos.', 1, '[\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    },\n    {\n        "nomeCompleto": "Chirlaine Cristine Gonçalves",\n        "nomeCitacao": "GONCALVES, C. C.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Luiz Carlos Gonçalves",\n        "nomeCitacao": "GONCALVES, L. C.",\n        "numIdCNPQ": ""\n    }\n]');

-- --------------------------------------------------------

--
-- Table structure for table `ic_corpoEditorial`
--

CREATE TABLE `ic_corpoEditorial` (
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
-- Dumping data for table `ic_corpoEditorial`
--

INSERT INTO `ic_corpoEditorial` (`emailValidador`, `dataValidacao`, `validado`, `comprovante`, `curriculoId`, `idCorpoEditorial`, `nomeInstituicao`, `codInstituicao`, `dataInicio`, `dataFim`) VALUES
(NULL, NULL, -1, NULL, 3, 2, 'Expressão Científica', '000800000994', '06/2015', '/');

-- --------------------------------------------------------

--
-- Table structure for table `ic_livro`
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
-- Table structure for table `ic_marca`
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
-- Dumping data for table `ic_marca`
--

INSERT INTO `ic_marca` (`emailValidador`, `dataValidacao`, `validado`, `comprovante`, `curriculoId`, `idMarca`, `titulo`, `ano`, `natureza`, `tipo`, `codigo`, `tituloPatente`, `dataConcessao`, `instDeposito`, `autores`) VALUES
(NULL, NULL, -1, NULL, 3, 2, 'PPITA - Polo de Pesquisa e Inovação Tecnológica do IFS', '2016', 'Mista', 'MARCA_REGISTRADA_DE_SERVICO_MSV', 'BR909870616', 'PPITA - Polo de Pesquisa e Inovação Tecnológica do IFS', '', 'INPI - Instituto Nacional da Propriedade Industrial', '[\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, JOSÉ A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Amanda Rocha Santos",\n        "nomeCitacao": "SANTOS, A. R.",\n        "numIdCNPQ": ""\n    }\n]');

-- --------------------------------------------------------

--
-- Table structure for table `ic_organizacaoEvento`
--

CREATE TABLE `ic_organizacaoEvento` (
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
-- Dumping data for table `ic_organizacaoEvento`
--

INSERT INTO `ic_organizacaoEvento` (`emailValidador`, `dataValidacao`, `validado`, `comprovante`, `curriculoId`, `idOrganizacaoEvento`, `tipo`, `natureza`, `titulo`, `ano`, `idioma`, `pais`, `homepage`, `doi`, `instituicaoPromotora`, `cidade`, `autores`) VALUES
(NULL, NULL, -1, NULL, 3, 40, 'CONGRESSO', 'ORGANIZACAO', '5th International Symposium on Technological Innovation', '2014', 'Português', 'Brasil', '', '', 'AESPI / PPGPI-UFS', 'Aracaju - SE', '[\n    {\n        "nomeCompleto": "Suzana Leitão Russo",\n        "nomeCitacao": "RUSSO, S. L.",\n        "numIdCNPQ": "8056542335438905"\n    },\n    {\n        "nomeCompleto": "Renata Silva Mann",\n        "nomeCitacao": "MANN, R. S.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, JOSÉ A.",\n        "numIdCNPQ": ""\n    }\n]'),
(NULL, NULL, -1, NULL, 3, 41, 'CONGRESSO', 'ORGANIZACAO', '6th International Symposium on Technological Innovation', '2015', 'Português', 'Brasil', '', '', 'API - Associação de Propriedade Intelectual', 'SE', '[\n    {\n        "nomeCompleto": "Gabriel Francisco da Silva",\n        "nomeCitacao": "SILVA, G. F.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Suzana Leitão Russo",\n        "nomeCitacao": "RUSSO, S. L.",\n        "numIdCNPQ": "8056542335438905"\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Iracema Machado de Aragão Gomes",\n        "nomeCitacao": "GOMES, I. M. A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Glaucio Jose Couri Machado",\n        "nomeCitacao": "MACHADO, G. J. C.",\n        "numIdCNPQ": ""\n    }\n]'),
(NULL, NULL, -1, NULL, 3, 42, 'CONGRESSO', 'ORGANIZACAO', 'SEMPI 2014 - Semana Acadêmica de Propriedade Intelectual', '2014', 'Português', 'Brasil', '', '', 'Universidade Federal de Sergipe', 'Aracaju', '[\n    {\n        "nomeCompleto": "Gabriel Francisco da Silva",\n        "nomeCitacao": "SILVA, G. F.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Glaucio Jose Couri Machado",\n        "nomeCitacao": "MACHADO, G. J. C.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Iracema Machado de Aragão Gomes",\n        "nomeCitacao": "GOMES, I. M. A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Maria Emília Camargo",\n        "nomeCitacao": "CAMARGO, M. E.",\n        "numIdCNPQ": "7617091280907670"\n    },\n    {\n        "nomeCompleto": "Suzana Leitão Russo",\n        "nomeCitacao": "RUSSO, S. L.",\n        "numIdCNPQ": "8056542335438905"\n    }\n]');

-- --------------------------------------------------------

--
-- Table structure for table `ic_orientacao`
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
-- Dumping data for table `ic_orientacao`
--

INSERT INTO `ic_orientacao` (`emailValidador`, `dataValidacao`, `validado`, `comprovante`, `curriculoId`, `idOrientacao`, `natureza`, `tipo`, `titulo`, `ano`, `idioma`, `pais`, `homepage`, `doi`, `nomeOrientado`, `nomeInstituicao`, `nomeCurso`) VALUES
(NULL, NULL, -1, NULL, 3, 150, 'Dissertação de mestrado', 'ACADEMICO', 'Interface entre condições psicossocioambientais e qualidade de vida no município de Propriá-SE', '2017', 'Português', 'Brasil', '', '', 'Thiago Santos Siqueira', 'Universidade Federal da Paraíba', 'Desenvolvimento e Meio Ambiente'),
(NULL, NULL, -1, NULL, 3, 151, 'TRABALHO_DE_CONCLUSAO_DE_CURSO_GRADUACAO', '', 'A semiótica como base para criação de personagens de jogos eletrônicos: um estudo de caso', '2014', 'Português', 'Brasil', '', '', 'Amanda Rocha Santos', 'Universidade Federal de Sergipe', 'Design'),
(NULL, NULL, -1, NULL, 3, 152, 'INICIACAO_CIENTIFICA', '', 'A Probabilidade de Aprender em Jogo Digital', '2014', 'Português', 'Brasil', '', '', 'Mateus Cardoso da Silva', 'Universidade Federal de Sergipe', 'Bacharelado Ciência da Computação'),
(NULL, NULL, -1, NULL, 3, 153, 'INICIACAO_CIENTIFICA', '', 'Evolução dos Depósitos de Propriedades Industriais no INPI', '2014', 'Português', 'Brasil', '', '', 'Alberth Almeida Amorim Souza', 'Universidade Federal de Sergipe', 'Estatística'),
(NULL, NULL, -1, NULL, 3, 154, 'INICIACAO_CIENTIFICA', '', 'Análise Séries Temporais no Domínio da Frequência Aplicada em Variáveis de Perfilagem de Poços de Petróleo', '2013', 'Português', 'Brasil', '', '', 'Mayara Laysa de Oliveira Silva', 'Universidade Federal de Sergipe', 'Estatística'),
(NULL, NULL, -1, NULL, 3, 155, 'INICIACAO_CIENTIFICA', '', 'Mapeamento do potencial de inovação dos resultados de pesquisa desenvolvidas pela UFS&#8207;&#8207;&#8207;&#8207;&#8207;', '2013', 'Português', 'Brasil', '', '', 'Alberth Almeida Amorim Souza', 'Universidade Federal de Sergipe', 'Estatística'),
(NULL, NULL, -1, NULL, 3, 156, 'INICIACAO_CIENTIFICA', '', 'Análise do Fluxo Aéreo do Aeroporto Santa Maria através de Gráficos de Controle de Shewart', '2014', 'Português', 'Brasil', '', '', 'Daiane Costa Guimaraes', 'Universidade Federal de Sergipe', 'Estatística'),
(NULL, NULL, -1, NULL, 3, 157, 'INICIACAO_CIENTIFICA', '', 'Previsão de Arrecadação de ICMS no Estado de Sergipe Utilizando Técnicas de Aprendizado de Máquina', '2015', 'Português', 'Brasil', '', '', 'Douglas Pereira Gomes', 'Instituto Federal de Sergipe', ''),
(NULL, NULL, -1, NULL, 3, 158, 'INICIACAO_CIENTIFICA', '', 'FITPro Soluções', '2015', 'Português', 'Brasil', '', '', 'Carlos Henrique Andrade Cunha', 'Instituto Federal de Sergipe', '');

-- --------------------------------------------------------

--
-- Table structure for table `ic_patente`
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
-- Table structure for table `ic_software`
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
-- Table structure for table `ic_titulacao`
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
-- Dumping data for table `ic_titulacao`
--

INSERT INTO `ic_titulacao` (`emailValidador`, `dataValidacao`, `validado`, `comprovante`, `curriculoId`, `idTitulacao`, `titulo`, `nomeCurso`, `instituicao`, `orientador`, `anoInicio`, `anoConclusao`, `tipo`) VALUES
(NULL, NULL, -1, NULL, 3, 34, 'Análise de Vulnerabilidades da Infra-Estrutura de Rede do DCCE', 'Bacharelado Ciência da Computação', 'Universidade Federal de Sergipe', 'Evandro Curvelo Hora', '2000', '2005', '1'),
(NULL, NULL, -1, NULL, 3, 35, 'MidHPC: Um suporte para a execução transparente de aplicações em grids computacionais', 'Ciências da Computação e Matemática Computacional', 'Universidade de São Paulo', 'Rodrigo Fernandes de Mello', '2005', '2008', '3'),
('teste@teste.com', '2017-06-03', 1, '00003-titulacao-36.pdf', 3, 36, 'Definição automática da quantidade de atributos selecionados em tarefas de agrupamento de dados', 'Ciências da Computação e Matemática Computacional', 'Universidade de São Paulo', 'André Carlos Ponce de Leon Ferreira Carvalho', '2008', '2013', '4');

-- --------------------------------------------------------

--
-- Table structure for table `ic_trabEvento`
--

CREATE TABLE `ic_trabEvento` (
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
-- Dumping data for table `ic_trabEvento`
--

INSERT INTO `ic_trabEvento` (`emailValidador`, `dataValidacao`, `validado`, `comprovante`, `curriculoId`, `idTrabEvento`, `tipoClass`, `tipoPais`, `natureza`, `titulo`, `ano`, `isbn`, `homepage`, `doi`, `pais`, `idioma`, `classEvento`, `nomeEvento`, `cidadeEvento`, `anoRealizacao`, `nomeEditora`, `titulosAnais`, `pagInicial`, `pagFinal`, `autores`) VALUES
(NULL, NULL, -1, NULL, 3, 16, '4', '3', 'COMPLETO', 'RouteGA: A Grid Load Balancing Algorithm with Genetic Support', '2007', '', '', '', 'Brasil', 'Português', 'INTERNACIONAL', 'The IEEE 21st International Conference on Advanced Information Networking and Applications (AINA-07)', 'Ontario', '2007', '', 'Proceedings of the IEEE 21st International Conference on Advanced Information Networking and Applications (AINA-07)', '1', '8', '[\n    {\n        "nomeCompleto": "Rodrigo Mello",\n        "nomeCitacao": "MELLO, R.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    },\n    {\n        "nomeCompleto": "Luciano José Senger",\n        "nomeCitacao": "SENGER, L. J.",\n        "numIdCNPQ": "6880696447532558"\n    },\n    {\n        "nomeCompleto": "Laurence T. Yang",\n        "nomeCitacao": "YANG, L. T.",\n        "numIdCNPQ": ""\n    }\n]'),
(NULL, NULL, -1, NULL, 3, 17, '4', '4', 'COMPLETO', 'Supporting the transparent execution of high performance application on grids', '2007', '', '', '', 'Coréia do Sul', 'Inglês', 'INTERNACIONAL', 'IEEE TENCON 2007', 'Taipei', '2007', '', 'Proceedings of the IEEE TENCON 2007', '1', '4', '[\n    {\n        "nomeCompleto": "Rodrigo Mello",\n        "nomeCitacao": "MELLO, R.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    },\n    {\n        "nomeCompleto": "Evgueni Dodonov",\n        "nomeCitacao": "DODONOV, E.",\n        "numIdCNPQ": "6435314467133626"\n    },\n    {\n        "nomeCompleto": "Kuang-Ching Li",\n        "nomeCitacao": "LI, K.-C.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Laurence T. Yang",\n        "nomeCitacao": "YANG, L. T.",\n        "numIdCNPQ": ""\n    }\n]'),
(NULL, NULL, -1, NULL, 3, 18, '4', '3', 'COMPLETO', 'Exigency-based real-time scheduling policy to provide absolute QoS for web services', '2007', '', '', '', 'Brasil', 'Inglês', 'INTERNACIONAL', 'SBAC-PAD 2007: 19th International Symposium on Computer Architecture and High Performance Computing', 'Gramado, RS, Brazil', '2007', '', 'Proceeding of the 19th International Symposium on Computer Architecture and High Performance Computing', '1', '8', '[\n    {\n        "nomeCompleto": "LUCAS DOS SANTOS CASAGRANDE",\n        "nomeCitacao": "CASAGRANDE, L. S.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Rodrigo Fernandes de Mello",\n        "nomeCitacao": "Mello R. F.",\n        "numIdCNPQ": "6840478133476887"\n    },\n    {\n        "nomeCompleto": "RICARDO BERTAGNA",\n        "nomeCitacao": "BERTAGNA, R.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    },\n    {\n        "nomeCompleto": "FRANCISCO JOSÉ MONACO",\n        "nomeCitacao": "MONACO, F. J.",\n        "numIdCNPQ": "7489482613903725"\n    }\n]'),
(NULL, NULL, -1, NULL, 3, 19, '4', '3', 'COMPLETO', 'Toward an Efficient Middleware for Multithreaded Applications in Computational Grid', '2008', '', '', '', 'Brasil', 'Inglês', 'INTERNACIONAL', '2008 IEEE 11th International Conference on Computational Science and Engineering (CSE-08)', 'São Paulo', '2008', '', 'Proceedings of the 2008 IEEE 11th International Conference on Computational Science and Engineering (CSE-08)', '1', '8', '[\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    },\n    {\n        "nomeCompleto": "Rodrigo Fernandes de Mello",\n        "nomeCitacao": "Mello R. F.",\n        "numIdCNPQ": "6840478133476887"\n    },\n    {\n        "nomeCompleto": "Evgueni Dodonov",\n        "nomeCitacao": "DODONOV, E.",\n        "numIdCNPQ": "6435314467133626"\n    },\n    {\n        "nomeCompleto": "Luciano José Senger",\n        "nomeCitacao": "SENGER, L. J.",\n        "numIdCNPQ": "6880696447532558"\n    },\n    {\n        "nomeCompleto": "Laurence T. Yang",\n        "nomeCitacao": "YANG, L. T.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Kuang-Ching Li",\n        "nomeCitacao": "LI, K.-C.",\n        "numIdCNPQ": ""\n    }\n]'),
(NULL, NULL, -1, NULL, 3, 20, '4', '4', 'COMPLETO', 'Quantifying Features Using False Nearest Neighbors: An Unsupervised Approach', '2011', '9780769545967', '[http://doi.ieeecomputersociety.org/10.1109/ICTAI.2011.170]', '', 'Estados Unidos', 'Inglês', 'INTERNACIONAL', '2011 IEEE 23rd International Conference on Tools with Artificial Intelligence', 'Boca Raton, FL', '2011', '', '2011 IEEE 23rd International Conference on Tools with Artificial Intelligence', '994', '997', '[\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    },\n    {\n        "nomeCompleto": "Andre C P L F de Carvalho",\n        "nomeCitacao": "CARVALHO, Andre C. P. L. F. de",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Rodrigo Fernandes de Mello",\n        "nomeCitacao": "Mello R. F.",\n        "numIdCNPQ": "6840478133476887"\n    },\n    {\n        "nomeCompleto": "Salem Alelyani",\n        "nomeCitacao": "ALELYANI, S.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Huan Liu",\n        "nomeCitacao": "LIU, H.",\n        "numIdCNPQ": ""\n    }\n]'),
(NULL, NULL, -1, NULL, 3, 21, '4', '4', 'COMPLETO', 'Lessons Learned in Using Social Media for Disaster Relief - ASU Crisis Response Game', '2012', '9783642290473', '[http://www.springerlink.com/content/5t7735568w62274h/]', '', 'Estados Unidos', 'Inglês', 'INTERNACIONAL', 'Social Computing, Behavioral - Cultural Modeling and Prediction - 5th International Conference', 'College Park, MD', '2012', '', 'Lecture Notes in Computer Science', '282', '289', '[\n    {\n        "nomeCompleto": "Mohammad Ali Abbasi",\n        "nomeCitacao": "ABBASI, M. A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Shamanth Kumar",\n        "nomeCitacao": "KUMAR, S",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    },\n    {\n        "nomeCompleto": "Huan Liu",\n        "nomeCitacao": "LIU, H.",\n        "numIdCNPQ": ""\n    }\n]'),
(NULL, NULL, -1, NULL, 3, 22, '3', '3', 'COMPLETO', 'A Density-Based Clustering Approach for Behavior Change Detection in Data Streams', '2012', '9781467326414', '', '10.1109/SBRN.2012.22', 'Brasil', 'Inglês', 'NACIONAL', '2012 Brazilian Symposium on Neural Networks (SBRN)', 'Curitiba', '2012', '', '2012 Brazilian Symposium on Neural Networks', '37', '', '[\n    {\n        "nomeCompleto": "VALLIM, ROSANE M.M.",\n        "nomeCitacao": "VALLIM, ROSANE M.M.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "CARVALHO, ANDRE C.P.L.F.",\n        "nomeCitacao": "CARVALHO, ANDRE C.P.L.F.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "GAMA, JOAO",\n        "nomeCitacao": "GAMA, JOAO",\n        "numIdCNPQ": ""\n    }\n]'),
(NULL, NULL, -1, NULL, 3, 23, '4', '3', 'COMPLETO', 'PERFIL DA INOVAÇÃO TECNOLÓGICA EM EMPRESAS SERGIPANAS', '2014', '', '[http://www.portalmites.com.br/conferences/index.php/ISTI/isti2014/paper/view/56]', '10.7198/s2318-3403201400020028', 'Brasil', 'Português', 'INTERNACIONAL', '5th International Symposium on Technological Innovation', '', '', '', '5th International Symposium on Technological Innovation', '229', '234', '[\n    {\n        "nomeCompleto": "SOUZA, A. A. A.",\n        "nomeCitacao": "SOUZA, A. A. A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Suzana Leitão Russo",\n        "nomeCitacao": "RUSSO, S. L.",\n        "numIdCNPQ": "8056542335438905"\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "PAIXÃO, A. E. A.",\n        "nomeCitacao": "PAIXÃO, A. E. A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Maria Emília Camargo",\n        "nomeCitacao": "CAMARGO, M. E.",\n        "numIdCNPQ": "7617091280907670"\n    }\n]'),
(NULL, NULL, -1, NULL, 3, 24, '1', '1', 'RESUMO_EXPANDIDO', 'Uma Aplicação de Séries Temporais e Inteligência Computacional na Previsão do Mercado de Seguros de Automóveis Sergipano', '2014', '', '', '', 'Brasil', 'Português', 'NACIONAL', 'III Congresso de Estatística / VII Semana Acadêmica de Estatística', 'Aracaju', '2014', '', 'Anais do III Congresso de Estatística', '', '', '[\n    {\n        "nomeCompleto": "Sandra Santos Santa Rosa",\n        "nomeCitacao": "ROSA, S. S. S.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Armoni da Cruz Santos",\n        "nomeCitacao": "SANTOS, A. C.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, JOSÉ A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Suzana Leitão Russo",\n        "nomeCitacao": "RUSSO, S. L.",\n        "numIdCNPQ": "8056542335438905"\n    },\n    {\n        "nomeCompleto": "Íkaro Daniel de Carvalho Barreto",\n        "nomeCitacao": "BARRETO, I. D. C.",\n        "numIdCNPQ": ""\n    }\n]'),
(NULL, NULL, -1, NULL, 3, 25, '4', '4', 'COMPLETO', 'Spectral Analysis Applied to Variables of Oil Wells Profiling', '2015', '1307-6892', '[http://waset.org/abstracts/Mathematical-and-Statistical-Sciences]', '', 'Estados Unidos', 'Inglês', 'INTERNACIONAL', 'ICAMOR 2015: International Conference on Applied Mathematics and Operation Research', 'Miami', '2015', '', 'Proceedings of the ICAMOR 2015: International Conference on Applied Mathematics and Operation Research', '', '', '[\n    {\n        "nomeCompleto": "Suzana Leitão Russo",\n        "nomeCitacao": "RUSSO, S. L.",\n        "numIdCNPQ": "8056542335438905"\n    },\n    {\n        "nomeCompleto": "Mayara Laysa de Oliveira Silva",\n        "nomeCitacao": "SILVA, M. L. O.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, JOSÉ A.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Vitor Hugo Simon",\n        "nomeCitacao": "SIMON, V. H.",\n        "numIdCNPQ": ""\n    }\n]'),
(NULL, NULL, -1, NULL, 3, 26, '2', '1', 'RESUMO_EXPANDIDO', 'Technologic Information about Photovoltaic Applied in Urban Residences', '2016', '2010-376X', '', '', 'Brasil', 'Português', 'INTERNACIONAL', '18th International Conference on Industrial Engineering and Management', 'Barcelona', '2016', '', 'Proceddings of the 18th International Conference on Industrial Engineering and Management', '', '', '[\n    {\n        "nomeCompleto": "Stephanie Fabris Russo",\n        "nomeCitacao": "RUSSO, S. F.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Daiane Costa Guimarães",\n        "nomeCitacao": "GUIMARAES, D. C.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Jonas Pedro Fabris",\n        "nomeCitacao": "FABRIS, J. P.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "Maria Emília Camargo",\n        "nomeCitacao": "CAMARGO, M. E.",\n        "numIdCNPQ": "7617091280907670"\n    },\n    {\n        "nomeCompleto": "Suzana Leitão Russo",\n        "nomeCitacao": "RUSSO, S. L.",\n        "numIdCNPQ": "8056542335438905"\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, JOSÉ A.",\n        "numIdCNPQ": ""\n    }\n]'),
(NULL, NULL, -1, NULL, 3, 27, '4', '4', 'COMPLETO', 'Optimizing distributed data access in Grid environments by using artificial intelligence techniques', '2007', '', '', '', 'Canadá', 'Inglês', 'INTERNACIONAL', 'The Fifth International Symposium on Parallel and Distributed Processing and Applications', 'Niagara Falls', '2007', '', 'Proceedings on The Fifth International Symposium on Parallel and Distributed Processing and Applications', '1', '12', '[\n    {\n        "nomeCompleto": "Rodrigo Mello",\n        "nomeCitacao": "MELLO, R.",\n        "numIdCNPQ": ""\n    },\n    {\n        "nomeCompleto": "José Augusto Andrade Filho",\n        "nomeCitacao": "ANDRADE FILHO, J. A.;ANDRADE FILHO, JOSÉ A.;FILHO, JOSE A. ANDRADE",\n        "numIdCNPQ": "5167675629028279"\n    },\n    {\n        "nomeCompleto": "Evgueni Dodonov",\n        "nomeCitacao": "DODONOV, E.",\n        "numIdCNPQ": "6435314467133626"\n    },\n    {\n        "nomeCompleto": "Renato Ishii",\n        "nomeCitacao": "ISHII, R.",\n        "numIdCNPQ": "8992362063539452"\n    },\n    {\n        "nomeCompleto": "Laurence T. Yang",\n        "nomeCitacao": "YANG, L. T.",\n        "numIdCNPQ": ""\n    }\n]');

-- --------------------------------------------------------

--
-- Table structure for table `perfil`
--

CREATE TABLE `perfil` (
  `email` varchar(512) DEFAULT NULL,
  `nivel` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perfil`
--

INSERT INTO `perfil` (`email`, `nivel`) VALUES
('propex@ifs.edu.br', 'validador\r\n'),
('teste@teste.com', 'validador'),
('propex@ifs.edu.br', 'gerenciador'),
('teste@teste.com', 'pesquisador');

-- --------------------------------------------------------

--
-- Table structure for table `regra`
--

CREATE TABLE `regra` (
  `idRegra` int(11) NOT NULL,
  `ptInd` float NOT NULL,
  `ptMax` float NOT NULL,
  `content` text,
  `ic` varchar(64) NOT NULL,
  `idEdital` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sumario`
--

CREATE TABLE `sumario` (
  `idSumario` int(11) NOT NULL,
  `idEdital` int(11) NOT NULL,
  `pontTotal` double NOT NULL,
  `hashcode` text NOT NULL,
  `curriculoId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
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
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`email`, `senha`, `nomeCompleto`, `dataNascimento`, `genero`, `cpf`, `rg`, `endereco`, `cep`, `telefone`, `dataCriacao`, `campus`, `coordenadoria`, `siape`) VALUES
('propex@ifs.edu.br', '$2y$10$td2WyMJLdxPHw3cE3mDE6eXu0R1bmTojmZEJxlZxltRdw9Y6PYaE2', 'PROPEX - IFS', '0000-01-01', '-', '-', '-', '-', '-', '-', '0000-01-01', '', '', ''),
('teste@teste.com', '$2y$10$cxIO63Lh96kML4iHyrFQheQ0sSgb21ut8R2i5JIDmrrIqQoV8tWoa', 'Testezão', '2017-05-31', '', '151.210.895-20', '', ' ', '', '(', '2017-05-31', 'Aracaju', '12345', 'COINF');

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
-- Indexes for table `ic_capLivro`
--
ALTER TABLE `ic_capLivro`
  ADD PRIMARY KEY (`idCapLivro`),
  ADD KEY `curriculoId` (`curriculoId`);

--
-- Indexes for table `ic_coordProj`
--
ALTER TABLE `ic_coordProj`
  ADD PRIMARY KEY (`idCoordProj`),
  ADD KEY `curriculoId` (`curriculoId`);

--
-- Indexes for table `ic_corpoEditorial`
--
ALTER TABLE `ic_corpoEditorial`
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
-- Indexes for table `ic_organizacaoEvento`
--
ALTER TABLE `ic_organizacaoEvento`
  ADD PRIMARY KEY (`idOrganizacaoEvento`),
  ADD KEY `curriculoId` (`curriculoId`);

--
-- Indexes for table `ic_orientacao`
--
ALTER TABLE `ic_orientacao`
  ADD PRIMARY KEY (`idOrientacao`),
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
-- Indexes for table `ic_trabEvento`
--
ALTER TABLE `ic_trabEvento`
  ADD PRIMARY KEY (`idTrabEvento`),
  ADD KEY `curriculoId` (`curriculoId`);

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
  MODIFY `curriculoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `edital`
--
ALTER TABLE `edital`
  MODIFY `idEdital` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ic_artigo`
--
ALTER TABLE `ic_artigo`
  MODIFY `idArtigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;
--
-- AUTO_INCREMENT for table `ic_banca`
--
ALTER TABLE `ic_banca`
  MODIFY `idBanca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
--
-- AUTO_INCREMENT for table `ic_capLivro`
--
ALTER TABLE `ic_capLivro`
  MODIFY `idCapLivro` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ic_coordProj`
--
ALTER TABLE `ic_coordProj`
  MODIFY `idCoordProj` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
--
-- AUTO_INCREMENT for table `ic_corpoEditorial`
--
ALTER TABLE `ic_corpoEditorial`
  MODIFY `idCorpoEditorial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ic_livro`
--
ALTER TABLE `ic_livro`
  MODIFY `idLivro` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ic_marca`
--
ALTER TABLE `ic_marca`
  MODIFY `idMarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ic_organizacaoEvento`
--
ALTER TABLE `ic_organizacaoEvento`
  MODIFY `idOrganizacaoEvento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `ic_orientacao`
--
ALTER TABLE `ic_orientacao`
  MODIFY `idOrientacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;
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
  MODIFY `idTitulacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `ic_trabEvento`
--
ALTER TABLE `ic_trabEvento`
  MODIFY `idTrabEvento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `regra`
--
ALTER TABLE `regra`
  MODIFY `idRegra` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sumario`
--
ALTER TABLE `sumario`
  MODIFY `idSumario` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `curriculo`
--
ALTER TABLE `curriculo`
  ADD CONSTRAINT `curriculo_ibfk_1` FOREIGN KEY (`email`) REFERENCES `usuario` (`email`) ON DELETE CASCADE;

--
-- Constraints for table `ic_artigo`
--
ALTER TABLE `ic_artigo`
  ADD CONSTRAINT `ic_artigo_ibfk_1` FOREIGN KEY (`curriculoId`) REFERENCES `curriculo` (`curriculoId`);

--
-- Constraints for table `ic_banca`
--
ALTER TABLE `ic_banca`
  ADD CONSTRAINT `ic_banca_ibfk_1` FOREIGN KEY (`curriculoId`) REFERENCES `curriculo` (`curriculoId`);

--
-- Constraints for table `ic_capLivro`
--
ALTER TABLE `ic_capLivro`
  ADD CONSTRAINT `ic_capLivro_ibfk_1` FOREIGN KEY (`curriculoId`) REFERENCES `curriculo` (`curriculoId`);

--
-- Constraints for table `ic_coordProj`
--
ALTER TABLE `ic_coordProj`
  ADD CONSTRAINT `ic_coordProj_ibfk_1` FOREIGN KEY (`curriculoId`) REFERENCES `curriculo` (`curriculoId`);

--
-- Constraints for table `ic_corpoEditorial`
--
ALTER TABLE `ic_corpoEditorial`
  ADD CONSTRAINT `ic_corpoEditorial_ibfk_1` FOREIGN KEY (`curriculoId`) REFERENCES `curriculo` (`curriculoId`);

--
-- Constraints for table `ic_livro`
--
ALTER TABLE `ic_livro`
  ADD CONSTRAINT `ic_livro_ibfk_1` FOREIGN KEY (`curriculoId`) REFERENCES `curriculo` (`curriculoId`);

--
-- Constraints for table `ic_marca`
--
ALTER TABLE `ic_marca`
  ADD CONSTRAINT `ic_marca_ibfk_1` FOREIGN KEY (`curriculoId`) REFERENCES `curriculo` (`curriculoId`);

--
-- Constraints for table `ic_organizacaoEvento`
--
ALTER TABLE `ic_organizacaoEvento`
  ADD CONSTRAINT `ic_organizacaoEvento_ibfk_1` FOREIGN KEY (`curriculoId`) REFERENCES `curriculo` (`curriculoId`);

--
-- Constraints for table `ic_orientacao`
--
ALTER TABLE `ic_orientacao`
  ADD CONSTRAINT `ic_orientacao_ibfk_1` FOREIGN KEY (`curriculoId`) REFERENCES `curriculo` (`curriculoId`);

--
-- Constraints for table `ic_patente`
--
ALTER TABLE `ic_patente`
  ADD CONSTRAINT `ic_patente_ibfk_1` FOREIGN KEY (`curriculoId`) REFERENCES `curriculo` (`curriculoId`);

--
-- Constraints for table `ic_software`
--
ALTER TABLE `ic_software`
  ADD CONSTRAINT `ic_software_ibfk_1` FOREIGN KEY (`curriculoId`) REFERENCES `curriculo` (`curriculoId`);

--
-- Constraints for table `ic_titulacao`
--
ALTER TABLE `ic_titulacao`
  ADD CONSTRAINT `ic_titulacao_ibfk_1` FOREIGN KEY (`curriculoId`) REFERENCES `curriculo` (`curriculoId`);

--
-- Constraints for table `ic_trabEvento`
--
ALTER TABLE `ic_trabEvento`
  ADD CONSTRAINT `ic_trabEvento_ibfk_1` FOREIGN KEY (`curriculoId`) REFERENCES `curriculo` (`curriculoId`);

--
-- Constraints for table `perfil`
--
ALTER TABLE `perfil`
  ADD CONSTRAINT `perfil_ibfk_1` FOREIGN KEY (`email`) REFERENCES `usuario` (`email`) ON DELETE CASCADE;

--
-- Constraints for table `regra`
--
ALTER TABLE `regra`
  ADD CONSTRAINT `regra_ibfk_1` FOREIGN KEY (`idEdital`) REFERENCES `edital` (`idEdital`);

--
-- Constraints for table `sumario`
--
ALTER TABLE `sumario`
  ADD CONSTRAINT `sumario_ibfk_1` FOREIGN KEY (`idEdital`) REFERENCES `edital` (`idEdital`),
  ADD CONSTRAINT `sumario_ibfk_2` FOREIGN KEY (`curriculoId`) REFERENCES `curriculo` (`curriculoId`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
