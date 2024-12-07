-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07/12/2024 às 20:27
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `on_market`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `id_cad` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `sexo` enum('fem','masc','outro') NOT NULL,
  `nome_materno` varchar(100) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefone_celular` varchar(50) DEFAULT NULL,
  `telefone_fixo` varchar(50) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `cep` varchar(9) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `login` varchar(10) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `nivel_acesso` enum('comum','master') DEFAULT NULL,
  `data_cadastro` datetime DEFAULT current_timestamp(),
  `codigo_verificacao` varchar(255) DEFAULT NULL,
  `codigo_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cadastro`
--

INSERT INTO `cadastro` (`id_cad`, `nome`, `data_nascimento`, `sexo`, `nome_materno`, `cpf`, `email`, `telefone_celular`, `telefone_fixo`, `endereco`, `cep`, `cidade`, `login`, `senha`, `nivel_acesso`, `data_cadastro`, `codigo_verificacao`, `codigo_expiry`) VALUES
(2, 'Carlos Silva Pontes', '1985-08-20', 'masc', 'Joana Silva', '987.654.321-00', 'carlos@gmail.com', '(+55) 21-99876-5432', '(+55) 21-2345-6789', 'Av. B, 456; Bairro X', '91011-121', 'Rio de Janeiro', 'carlos.sil', '$2y$10$3dWyQdgG4cKDpt27rTlZcu1T8LgS8lYuaTxTs9Hhc6LHIgR9uc9n.', 'comum', '2024-11-21 12:19:05', NULL, NULL),
(9, 'NATASHA MOREIRA DO NASCIMENTO', '1997-01-08', 'fem', 'maria lucia', '121.272.577-82', 'natasharj07@gmail.com', '(+55) 21-987964260', '(+55) 21-989494224', 'Beco Santa Luzia Número 4 Estrada Do Dendê', '21920-000', 'Rio de Janeiro', 'Nat', '$2y$10$JbeTik0LJOe6V/gpIvCj7ecTxx36WqZXwbItLjppAE3qc46LeLavW', 'comum', '2024-12-07 11:34:09', NULL, NULL),
(10, 'Maria Lopes Souza', '1990-05-15', 'fem', 'Ana Lopes', '123.456.789-01', 'maria@gmail.com', '(+55) 11-91234-5678', '(+55) 11-1234-5678', 'Rua A, 123;Centro', '12345-678', 'São Paulo', 'maria.lope', '$2y$10$d7Qv/RxvolSDnU2YYPp4aO2tGsmGhHf3/4Ji4sMM5kXl5qaf2eqoy', 'master', '2024-12-07 15:41:46', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `compras`
--

CREATE TABLE `compras` (
  `id_prod` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `id_ped` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `compras`
--

INSERT INTO `compras` (`id_prod`, `quantidade`, `id_ped`) VALUES
(100, 100, 1000),
(101, 200, 1001),
(102, 300, 1002),
(103, 400, 1003),
(104, 500, 1004),
(105, 600, 1005),
(106, 700, 1006),
(107, 800, 1007);

-- --------------------------------------------------------

--
-- Estrutura para tabela `login`
--

CREATE TABLE `login` (
  `id_log` int(11) NOT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL,
  `tipo` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `login`
--

INSERT INTO `login` (`id_log`, `usuario`, `senha`, `tipo`) VALUES
(1, 'maria.lope', '$2y$10$BMwxwK/Dt.0cozFDEFsI..j5TBQqXJhuq.F9CtFTAl3aNTVTlmvTu', 'master'),
(2, 'carlos.sil', '$2y$10$izxmnf..SOAJBkfaIc5H0eWVJZSzStKf1Vbk/iqJRm8SR0Fh/saEy', 'comum'),
(3, 'joana.alme', '$2y$10$TZPsp2brZZ2Uaap8AFmWs.tsUma1M94sUFkpvV6mgN0tecEtRv3GK', 'master'),
(4, 'joao.gonca', '$2y$10$fhuRQ8DhdWul.ejEwYl3IOXsAuxSQDebz3xJekPwuTDajj0zZKPba', 'comum'),
(5, 'ana.lucia', '$2y$10$D1yDHOut2s/pBTgJZrYrmOf34iWQhtL/x19MiPnZakhWx6AEpwAYG', 'master'),
(6, 'jorge.mont', '$2y$10$.XyuQZv1ogkZQWz8d3Ni..YvLMYDuzTZK1377k1bci0CGe83l4AaC', 'comum');

-- --------------------------------------------------------

--
-- Estrutura para tabela `nota_fiscal`
--

CREATE TABLE `nota_fiscal` (
  `id_nf` int(100) NOT NULL,
  `valor_nf` decimal(15,2) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  `id_ped` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `nota_fiscal`
--

INSERT INTO `nota_fiscal` (`id_nf`, `valor_nf`, `uf`, `id_ped`) VALUES
(1, 299.99, 'SP', 1000),
(2, 255.51, 'RJ', 1001),
(3, 1199.00, 'MG', 1002),
(4, 149.99, 'MS', 1003),
(5, 149.99, 'RJ', 1004),
(6, 2500.00, 'RN', 1005),
(7, 3879.00, 'BA', 1006),
(8, 22289.00, 'SP', 1007);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido`
--

CREATE TABLE `pedido` (
  `id_ped` int(100) NOT NULL,
  `n°_do_pedido` varchar(20) DEFAULT NULL,
  `data_do_pedido` datetime NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `id_cad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedido`
--

INSERT INTO `pedido` (`id_ped`, `n°_do_pedido`, `data_do_pedido`, `status`, `id_cad`) VALUES
(1000, '123410', '2024-10-05 14:30:00', 'pendente', 1),
(1001, '123411', '2024-10-05 15:00:00', 'enviado', 2),
(1002, '123412', '2024-09-06 09:15:00', 'entregue', 3),
(1003, '123413', '2024-08-07 10:45:00', 'cancelado', 4),
(1004, '123414', '2024-07-08 12:00:00', 'pendente', 5),
(1005, '123415', '2024-06-09 16:00:00', 'entregue', 6),
(1006, '123416', '2024-05-10 08:00:00', 'enviado', 2),
(1007, '123417', '2024-04-11 07:00:00', 'cancelado', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id_prod` int(100) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `fornecedor` varchar(255) NOT NULL,
  `modelo` varchar(255) DEFAULT NULL,
  `sit` enum('ativo','inativo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id_prod`, `nome`, `valor`, `fornecedor`, `modelo`, `sit`) VALUES
(100, 'Fone de ouvido sem fio', 299.99, 'Casas Bahia', 'TWS Philips TAT 1108 BK/00', 'ativo'),
(101, 'TV Stick Life', 255.51, 'Ponto Frio', 'Streaming em Full HD com Alexa', 'ativo'),
(102, 'Celular XIAOM Redmi Note 13', 1199.00, 'C&A', '8+256G Global Version Powerful Snapdragon', 'ativo'),
(103, 'Carregador Portátil (Power Bank)', 149.99, 'Shopee', 'Ultra Rápido 1000mAh Power Delivery 20W', 'ativo'),
(104, 'Gabinete Gamer', 149.99, 'Mercado livre', 'Rise Mode Glass 06X', 'ativo'),
(105, 'Processador AMD', 2500.00, 'Casa e Vídeo', 'Ryzen 7 5700X 3.4GHz', 'ativo'),
(106, 'Samsung Lava e Seca 11kg Branco', 3879.00, 'Extra', 'WD11M4473PW - 127V', 'ativo'),
(107, 'Refrigerador 260L 2 Portas', 2289.00, 'Amazon Prime', 'Classe A 220 Volts, Branco, Electrolux\r\n', 'ativo');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD PRIMARY KEY (`id_cad`);

--
-- Índices de tabela `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id_prod`),
  ADD KEY `id_ped` (`id_ped`);

--
-- Índices de tabela `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_log`);

--
-- Índices de tabela `nota_fiscal`
--
ALTER TABLE `nota_fiscal`
  ADD PRIMARY KEY (`id_nf`),
  ADD KEY `fk_cadastro` (`id_ped`);

--
-- Índices de tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_ped`),
  ADD KEY `fk_cadastro` (`id_cad`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_prod`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cadastro`
--
ALTER TABLE `cadastro`
  MODIFY `id_cad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `login`
--
ALTER TABLE `login`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `nota_fiscal`
--
ALTER TABLE `nota_fiscal`
  MODIFY `id_nf` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_ped` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1008;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_prod` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`id_ped`) REFERENCES `pedido` (`id_ped`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
