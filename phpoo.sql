-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07/08/2023 às 18:10
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `phpoo`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `descricao` varchar(70) NOT NULL,
  `preco` float NOT NULL,
  `imagem` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `descricao`, `preco`, `imagem`) VALUES
(1, 'Milk-Shake 500ml', 'Milk shake de baunilha, produtos frescos e naturais, contém gluten.', 15, 'sorvete.png'),
(2, 'Milk-shake 750ml', 'Milk shake de baunilha, produtos frescos e naturais, contém gluten.', 20.5, 'sorvete.png'),
(3, 'Picolé de limão', 'Picolé de limão, feito com água de coco, sabor garantido', 6, 'sorvete.png'),
(4, 'Milk-shake 1L', 'Milk shake de baunilha, produtos frescos e naturais, contém gluten.', 30.25, 'sorvete.png'),
(5, 'teste', 'Produto feito de teste', 60, 'sorvete.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `is_admin` varchar(10) DEFAULT 'nao'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `is_admin`) VALUES
(1, 'teste', 'monica-amorim@hotmail.com.br', '698dc19d489c4e4db73e28a713eab07b', 'nao'),
(2, 'teste', 'deleoncurso@gmail.com', '698dc19d489c4e4db73e28a713eab07b', 'nao'),
(4, 'testestes', 'teste@hotmail.com', '20df78a5a44aa23e209c263c4d248e9a', 'nao'),
(5, 'testestest', 'testestetess@gmail.com', 'ed86550378a1390f3559b8b12884b77c', 'nao'),
(6, 'Teste User 2', 'teste123@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'admin'),
(7, 'Teste User 5', 'teste321@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'nao');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
