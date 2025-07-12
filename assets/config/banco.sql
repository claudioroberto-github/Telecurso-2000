-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12/07/2025 às 22:08
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
  `pedido` int(255) NOT NULL,
  `data_venda` datetime NOT NULL,
  `produtos` varchar(255) NOT NULL,
  `quantVendida` int(7) NOT NULL,
  `preço` double NOT NULL,
  `gastos` int(11) NOT NULL,
  `lucro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `vendas_produtos`
--
ALTER TABLE `vendas_produtos`
  ADD PRIMARY KEY (`pedido`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `vendas_produtos`
--
ALTER TABLE `vendas_produtos`
  MODIFY `pedido` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
