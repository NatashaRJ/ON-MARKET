-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/11/2024 às 20:18
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
(1, 'Maria Lopes Souza', '1990-05-15', 'fem', 'Ana Lopes', '123.456.789-01', 'maria@gmail.com', '(+55) 11-91234-5678', '(+55) 11-1234-5678', 'Rua A, 123;Centro', '12345-678', 'São Paulo', 'maria.lope', '$2y$10$NMKJ5QvjOHBv8tqp1hxJK.fgNNkKrl4o2qG0jZjFrg2w3Q3OLhZ02', 'master', '2024-11-21 12:14:19', NULL, NULL),
(2, 'Carlos Silva Pontes', '1985-08-20', 'masc', 'Joana Silva', '987.654.321-00', 'carlos@gmail.com', '(+55) 21-99876-5432', '(+55) 21-2345-6789', 'Av. B, 456; Bairro X', '91011-121', 'Rio de Janeiro', 'carlos.sil', '$2y$10$6JrH81BEkmQKfYI6.FcOWeqitxVLZ3PCWaRWAYCHmtC6g/5aOrwoO', 'comum', '2024-11-21 12:19:05', NULL, NULL),
(3, 'Joana Almeida', '1992-12-30', 'fem', 'Mariana Almeida  ', '123.987.654-32', 'joana@gmail.com', '(+55) 31-91234-6543', '(+55) 31-4567-7829', 'Praça C, 789; Bairro Y', '87643-234', 'Belo Horizonte', 'joana.alme', '$2y$10$XkqavxRo0G/7d8fMRiTaOuntZ8WiKLsYnSlKYIg0cH4hkN8btirye', 'master', '2024-11-21 12:26:47', NULL, NULL),
(4, 'João Gonçalves', '1988-03-10', 'masc', 'Maria Gonçalves', '111.222.333-44', 'joao@gmail.com', '(+55) 41-92345-6789', '(+55) 41-3456-4568', 'Rua D, 456; Bairro Z', '97034-265', 'Curitiba', 'joao.gonca', '$2y$10$VJRaGLyaOr865.fQ1ofZpO1gvmWDjrCGgQKT44NAGA4j/fejwRSGy', 'comum', '2024-11-21 12:33:41', NULL, NULL),
(5, 'Ana Lucia Moreira', '1995-07-25', 'fem', 'Clara Lucia', '222.333.444-55', 'ana@gmail.com', '(+55) 85-95432-7689', '(+55) 85-4567-5421', 'Rua F, 101; Bairro V', '23456-546', 'Salvador', 'ana.lucia', '$2y$10$fK/THvSztjAe8YUUQhRnie3aVSmFHXIFE.F2iQQ0zANts6sIDXAfu', 'master', '2024-11-21 13:05:47', NULL, NULL),
(6, 'Jorge Monteiro Souza', '1992-11-15', 'masc', 'Luiza Monteiro', '333.444.555-66', 'jorge@gmail.com', '(+55) 71-94532-7896', '(+55) 71-2345-4589', 'Av. E, 657; Bairro W', '12765-890', 'Fortaleza', 'jorge.mont', '$2y$10$3AxEOMocvfEr0ABvgxfrwOTTSvpKw2tpeE7Ya8MvSJTvCAGkoj2ve', 'comum', '2024-11-21 13:09:56', NULL, NULL),
(7, 'Natasha Moreira do Nascimento', '1997-01-08', 'fem', 'Maria Lucia ', '121.272.577-82', 'natasharj07@gmail.com', '(+55) 21-98949-4224', '(+55) 21-98796-4260', 'Beco Santa Luzia Número 4 Estrada Do Dendê', '21920-000', 'Rio de Janeiro', 'Nat', '$2y$10$3wDBvFib3To/r6XyQfeGTuPj36ejKtbkFjDe31EmuLHMnIHQ7tXaW', 'master', '2024-11-23 11:09:04', NULL, NULL);

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
  MODIFY `id_cad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
