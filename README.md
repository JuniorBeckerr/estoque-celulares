-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23-Fev-2024 às 21:18
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `controle_celular`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `entradas`
--

CREATE TABLE `entradas` (
  `MARCA` varchar(100) NOT NULL,
  `MODELO` varchar(100) NOT NULL,
  `QUANTIDADE` int(11) NOT NULL,
  `EMPRESA` varchar(20) NOT NULL,
  `ESTADO` varchar(20) NOT NULL,
  `OBSERVACAO` text DEFAULT NULL,
  `DATA_ENTRADA` date NOT NULL,
  `ID_ENTRADA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `entradas`
--

INSERT INTO `entradas` (`MARCA`, `MODELO`, `QUANTIDADE`, `EMPRESA`, `ESTADO`, `OBSERVACAO`, `DATA_ENTRADA`, `ID_ENTRADA`) VALUES
('APPLE', 'IPHONE 13', 1, 'BP', 'USADO', 'MOTTA', '2023-10-17', 12),
('APPLE', 'IPHONE 14', 1, 'BP', 'NOVO', 'PRO', '2023-10-17', 13),
('SAMSUNG', 'A346', 2, 'BP', 'NOVO', '', '2023-10-17', 14),
('SAMSUNG', 'A346', 7, 'PREA', 'NOVO', '', '2023-10-24', 15),
('SAMSUNG', 'A346', 11, 'PREA', 'NOVO', '', '2023-10-24', 16),
('MOTOROLA', 'MOTO E1', 3, 'MTR', 'USADO', 'RECEP', '2023-10-27', 17),
('MOTOROLA', 'MOTO G10', 1, 'MTR', 'USADO', '', '2023-11-06', 18),
('APPLE', 'IPHONE 14', 1, 'MCB', 'NOVO', 'PRO', '2023-11-28', 19),
('SAMSUNG', 'A346', 12, 'MCB', 'NOVO', '', '2023-11-28', 20),
('SAMSUNG', 'A346', 12, 'MCB', 'NOVO', '', '2023-11-28', 21),
('SAMSUNG', 'S23', 8, 'MCB', 'NOVO', '', '2023-11-28', 22),
('SAMSUNG', 'S23 Ultra', 1, 'MCB', 'NOVO', '', '2023-11-28', 23),
('APPLE', 'IPHONE 12', 1, 'MTR', 'USADO', '', '2023-12-06', 24),
('MOTOROLA', 'MOTO G10', 1, 'MTR', 'USADO', '', '2023-12-06', 25),
('MOTOROLA', 'MOTO G10', 1, 'MTR', 'USADO', 'Miluzzi', '2023-12-06', 26),
('MOTOROLA', 'MOTO G10', 1, 'PREA', 'USADO', '', '2023-12-07', 27),
('MOTOROLA', 'MOTO ONE', 1, 'MTR', 'USADO', 'Karla', '2023-12-07', 29),
('MOTOROLA', 'MOTO G10', 1, 'MCB', 'USADO', 'Douglas G', '2023-12-18', 30),
('SAMSUNG', 'S21 Plus', 1, 'MTR', 'USADO', 'Elvio', '2024-01-03', 31),
('SAMSUNG', 'S21 Plus', 1, 'MTR', 'USADO', 'Thiago mkt', '2024-01-03', 32),
('SAMSUNG', 'S21 Plus', 1, 'MTR', 'USADO', 'Nasser', '2024-01-03', 33),
('MOTOROLA', 'MOTO G10', 7, 'PREA', 'NOVO', '', '2023-11-01', 34),
('MOTOROLA', 'MOTO E40', 2, 'MTR', 'USADO', 'Deposito', '2023-11-01', 35),
('MOTOROLA', 'MOTO G10', 1, 'BP', 'USADO', 'Carol Bilhet.', '2024-02-06', 36),
('SAMSUNG', 'S21 Plus', 1, 'MTR', 'USADO', 'Karol A.', '2024-02-13', 37),
('APPLE', 'IPHONE 15', 1, 'MTR', 'NOVO', 'pro', '2024-02-07', 38);

-- --------------------------------------------------------

--
-- Estrutura da tabela `estoque`
--

CREATE TABLE `estoque` (
  `marca` varchar(100) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `ID_ESTOQUE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `estoque`
--

INSERT INTO `estoque` (`marca`, `modelo`, `quantidade`, `estado`, `ID_ESTOQUE`) VALUES
('APPLE', 'IPHONE 13', 0, 'USADO', 5),
('APPLE', 'IPHONE 14', 0, 'NOVO', 6),
('SAMSUNG', 'A346', 40, 'NOVO', 7),
('MOTOROLA', 'MOTO E1', 3, 'USADO', 8),
('MOTOROLA', 'MOTO G10', 3, 'USADO', 9),
('SAMSUNG', 'S23', 2, 'NOVO', 10),
('SAMSUNG', 'S23 Ultra', 0, 'NOVO', 11),
('APPLE', 'IPHONE 12', 1, 'USADO', 12),
('MOTOROLA', 'MOTO ONE', 3, 'USADO', 14),
('SAMSUNG', 'S21 Plus', 4, 'USADO', 15),
('MOTOROLA', 'MOTO G10', 1, 'NOVO', 16),
('MOTOROLA', 'MOTO E40', 2, 'USADO', 17),
('APPLE', 'IPHONE 15', 0, 'NOVO', 18),
('LG', 'K9', 12, 'USADO', 19),
('MOTOROLA', 'G4 PLUS', 4, 'USADO', 20),
('MOTOROLA', 'G2', 2, 'USADO', 21),
('MOTOROLA', 'G5', 2, 'USADO', 22),
('ALCATEL', 'PIXI', 5, 'USADO', 23),
('SAMSING', 'J1', 6, 'USADO', 24),
('MOTOROLA', 'E2', 5, 'USADO', 25),
('BLU', 'BOLD', 2, 'USADO', 26);

-- --------------------------------------------------------

--
-- Estrutura da tabela `saidas`
--

CREATE TABLE `saidas` (
  `marca` varchar(100) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `responsavel` varchar(100) NOT NULL,
  `observacao` text DEFAULT NULL,
  `data_saida` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `saidas`
--

INSERT INTO `saidas` (`marca`, `modelo`, `quantidade`, `responsavel`, `observacao`, `data_saida`) VALUES
('APPLE', 'IPHONE 13 - USADO', 1, 'Rodrigo Miluzzi', 'chip: 45999661861', '2023-10-26'),
('APPLE', 'IPHONE 13 - NOVO', 1, 'Marketing Mabu\r\n', 'chip: 45991346602', '0000-00-00'),
('APPLE', 'IPHONE 14 - NOVO', 1, 'Jorge Della Via', 'chip: 11985887957', '0000-00-00'),
('APPLE', 'IPHONE 15 - NOVO', 1, 'Welligton', 'chip: 41999507888', '2024-02-07'),
('APPLE', 'IPHONE 14 - NOVO', 1, 'Luciano Motta ', 'chip: 41998993130', '2023-10-17'),
('MOTOROLA', 'MOTO G10 - NOVO', 3, 'Elton Luis', 'chip: my mabu', '2023-10-25'),
('MOTOROLA', 'MOTO G10 - NOVO', 1, 'Tiago', 'chip: 45991510929', '2023-11-03'),
('MOTOROLA', 'MOTO G10 - NOVO', 1, 'Philipe', 'chip: 45991220483', '0000-00-00'),
('MOTOROLA', 'MOTO G10 - NOVO', 1, 'Breno', 'chip: 45991370661', '0000-00-00'),
('SAMSUNG', 'A346 - NOVO', 1, 'Sladson', 'chip: 45991230928', '2024-02-12'),
('SAMSUNG', 'A346 - NOVO', 1, 'Lorena', 'chip: 45999991647', '2024-02-12'),
('SAMSUNG', 'S23 - NOVO', 1, 'Christiano Nasser', 'chip: 45991220483', '2024-12-01'),
('SAMSUNG', 'S23 - NOVO', 1, 'Elvio Andrade', 'chip: 45991346602', '2024-12-05'),
('SAMSUNG', 'S23 - NOVO', 1, 'Karla Amaral', 'chip: 45991370661', '2024-12-08'),
('SAMSUNG', 'S23 - NOVO', 1, 'Thiago Desiderio', 'chip: 45991348044', '2024-12-08'),
('SAMSUNG', 'S23 - NOVO', 1, 'Raimundo Pimenta', 'chip: 991230928', '2024-12-06'),
('SAMSUNG', 'A346 - NOVO', 1, 'Fabricia', 'chip: 4535212052', '2024-01-09');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`ID_ENTRADA`);

--
-- Índices para tabela `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`ID_ESTOQUE`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `entradas`
--
ALTER TABLE `entradas`
  MODIFY `ID_ENTRADA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `estoque`
--
ALTER TABLE `estoque`
  MODIFY `ID_ESTOQUE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
