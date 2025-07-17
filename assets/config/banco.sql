-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17/07/2025 às 02:04
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `banco`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cores`
--

CREATE TABLE `cores` (
  `cor_principal` varchar(7) DEFAULT NULL,
  `cor_secundaria` varchar(7) DEFAULT NULL,
  `cor_fundo` varchar(7) DEFAULT NULL,
  `cor_texto` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id_produto` int(11) NOT NULL,
  `nome_produto` varchar(100) NOT NULL,
  `preco_produto` double(10,2) NOT NULL,
  `classe_produto` varchar(100) NOT NULL,
  `img_produto` varchar(255) DEFAULT NULL,
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id_produto`, `nome_produto`, `preco_produto`, `classe_produto`, `img_produto`, `id`) VALUES
(20, 'Suco', 8.99, 'Bebidas', 'assets/uploads/68762dda27650_6875c9922bb55_suco-laranja-freepik-800x533.webp', 38),
(21, 'Almoço', 39.99, 'Prato Principal', 'assets/uploads/68762de918ba7_687462acd0815_home.png', 38),
(22, 'Suco Prats', 9.99, 'Bebidas', 'assets/uploads/68762dfa4e5d3_6874eaaca231d_Suco_exemplo.jpg', 38),
(23, 'caipirinha', 15.99, 'Bebidas alcoolicas', 'assets/uploads/68762f0adc747_caipirinhaExemplo.jpeg', 38),
(24, 'Lanche', 19.99, 'Prato Principal', 'assets/uploads/68762fc47c587_lanches-gourmet.webp', 38),
(25, 'Batata Frita', 9.99, 'Entrada', 'assets/uploads/68763023e5e81_images.jpeg', 38),
(26, 'Cerveja', 16.99, 'Bebidas alcoolicas', 'assets/uploads/68781a2b19bcc_cerveja.jpg', 38),
(27, 'Patês com Torradas', 11.99, 'Entrada', 'assets/uploads/68781a73989db_patês com torradas.jpg', 38);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `user` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `cnpj` int(14) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` int(13) DEFAULT NULL,
  `dwelling` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `passwords` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `user`, `company`, `cnpj`, `email`, `telephone`, `dwelling`, `city`, `province`, `birth`, `img`, `passwords`) VALUES
(37, 'DEBORA ROSMANN CORDEIRO RUI', 'claudio', 545454, 'claudiorobertocordeirorui@gmail.com', 2147483647, 'Rua José Bonifácio', 'Presidente Prudente', 'SP', '2121-12-12', 'CLAUDIO RUI - currículo.pdf (1).png', '123'),
(38, 'Cláudio Roberto', 'Kopas Engenering', 12316532, 'Diretoria@kopas.engeneer.sp.gov.br', 2147483647, 'Rua José Bonifácio', 'Presidente Prudente', 'SP', '1212-12-12', '', '123');

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas_produtos`
--

CREATE TABLE `vendas_produtos` (
  `pedido` int(11) NOT NULL,
  `data_venda` datetime NOT NULL,
  `produtos` varchar(255) NOT NULL,
  `quantVendida` int(11) NOT NULL,
  `preco` float NOT NULL,
  `gasto` float NOT NULL,
  `lucro` float NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `vendas_produtos`
--

INSERT INTO `vendas_produtos` (`pedido`, `data_venda`, `produtos`, `quantVendida`, `preco`, `gasto`, `lucro`, `id_usuario`) VALUES
(6878174, '2025-07-16 18:19:09', 'Suco', 4, 8.99, 6.7425, 2.2475, 38),
(6878174, '2025-07-16 18:19:09', 'Batata Frita', 3, 9.99, 7.4925, 2.4975, 38),
(687817758, '2025-07-16 18:19:49', 'Lanche', 4, 19.99, 14.9925, 4.9975, 38),
(687817758, '2025-07-16 18:19:49', 'caipirinha', 4, 15.99, 11.9925, 3.9975, 38),
(687817758, '2025-07-16 18:19:49', 'Batata Frita', 3, 9.99, 7.4925, 2.4975, 38),
(687817758, '2025-07-16 18:19:49', 'Suco Prats', 3, 9.99, 7.4925, 2.4975, 38),
(687817758, '2025-07-16 18:19:49', 'Almoço', 2, 39.99, 29.9925, 9.9975, 38),
(687817758, '2025-07-16 18:19:49', 'Suco', 3, 8.99, 6.7425, 2.2475, 38),
(6878178, '2025-07-16 18:20:13', 'Suco', 1, 8.99, 6.7425, 2.2475, 38),
(68781, '2025-07-16 18:41:27', 'Almoço', 4, 39.99, 29.9925, 9.9975, 38),
(68781, '2025-07-16 18:41:27', 'Patês com Torradas', 3, 11.99, 8.9925, 2.9975, 38),
(68781, '2025-07-16 18:41:27', 'Cerveja', 5, 16.99, 12.7425, 4.2475, 38),
(2147483647, '2025-07-16 18:49:58', 'Cerveja', 3, 16.99, 12.7425, 4.2475, 38);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_produto`),
  ADD KEY `id` (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
