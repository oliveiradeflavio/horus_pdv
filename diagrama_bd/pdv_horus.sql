-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 17/03/2023 às 14:19
-- Versão do servidor: 8.0.32
-- Versão do PHP: 8.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pdv_horus`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_clientes`
--

CREATE TABLE `tb_clientes` (
  `id_cliente` int NOT NULL,
  `cpf_cliente` char(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dt_nascimento_cliente` date NOT NULL,
  `nome_cliente` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cep_cliente` char(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado_cliente` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cidade_cliente` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `endereco_cliente` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_cliente` int NOT NULL,
  `complemento_cliente` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bairro_cliente` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `celular_cliente` char(14) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_configuracoes`
--

CREATE TABLE `tb_configuracoes` (
  `id_configuracoes` int NOT NULL,
  `senha_master_configuracoes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_dados_empresariais`
--

CREATE TABLE `tb_dados_empresariais` (
  `id_dados_empresariais` int NOT NULL,
  `cnpj_dados_empresariais` char(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome_empresa_dados_empresariais` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cep_dados_empresariais` char(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado_dados_empresariais` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cidade_dados_empresariais` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `endereco_dados_empresariais` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_dados_empresariais` int NOT NULL,
  `bairro_dados_empresariais` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone_dados_empresariais` char(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `celular_dados_empresariais` char(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_dados_empresariais` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_fornecedores`
--

CREATE TABLE `tb_fornecedores` (
  `id_fornecedor` int NOT NULL,
  `cnpj_fornecedor` char(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `razao_social_fornecedor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome_fantasia_fornecedor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cep_fornecedor` char(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado_fornecedor` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cidade_fornecedor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `endereco_fornecedor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_fornecedor` int NOT NULL,
  `complemento_fornecedor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bairro_fornecedor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone_fornecedor` char(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `celular_fornecedor` char(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_fornecedor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_produtos`
--

CREATE TABLE `tb_produtos` (
  `id_produto` int NOT NULL,
  `foto_produto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'produto_sem_imagem.png',
  `nome_produto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo_produto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao_produto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantidade_produto` int DEFAULT NULL,
  `preco_unitario_produto` char(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preco_venda_produto` char(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preco_total_produto` char(11) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `id_usuario` int NOT NULL,
  `cpf_usuario` char(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome_usuario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_usuario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_usuario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_usuario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_usuario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'logo.png',
  `perfil_usuario` char(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_vendas`
--

CREATE TABLE `tb_vendas` (
  `id_venda` int NOT NULL,
  `numero_da_venda_venda` int NOT NULL,
  `nome_cliente_venda` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `produto_venda` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantidade_venda` int NOT NULL,
  `valor_produto_unitario_venda` char(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor_produto_total_venda` char(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_venda_valor_bruto_venda` char(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_de_pagamento_venda` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desconto_venda_venda` char(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_venda_atual_com_desconto_venda` char(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codigo_pagamento_cartao_venda` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_hora_venda` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_clientes`
--
ALTER TABLE `tb_clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Índices de tabela `tb_configuracoes`
--
ALTER TABLE `tb_configuracoes`
  ADD PRIMARY KEY (`id_configuracoes`);

--
-- Índices de tabela `tb_dados_empresariais`
--
ALTER TABLE `tb_dados_empresariais`
  ADD PRIMARY KEY (`id_dados_empresariais`);

--
-- Índices de tabela `tb_fornecedores`
--
ALTER TABLE `tb_fornecedores`
  ADD PRIMARY KEY (`id_fornecedor`);

--
-- Índices de tabela `tb_produtos`
--
ALTER TABLE `tb_produtos`
  ADD PRIMARY KEY (`id_produto`);

--
-- Índices de tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Índices de tabela `tb_vendas`
--
ALTER TABLE `tb_vendas`
  ADD PRIMARY KEY (`id_venda`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_clientes`
--
ALTER TABLE `tb_clientes`
  MODIFY `id_cliente` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_configuracoes`
--
ALTER TABLE `tb_configuracoes`
  MODIFY `id_configuracoes` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_dados_empresariais`
--
ALTER TABLE `tb_dados_empresariais`
  MODIFY `id_dados_empresariais` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_fornecedores`
--
ALTER TABLE `tb_fornecedores`
  MODIFY `id_fornecedor` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_produtos`
--
ALTER TABLE `tb_produtos`
  MODIFY `id_produto` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `id_usuario` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_vendas`
--
ALTER TABLE `tb_vendas`
  MODIFY `id_venda` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
