-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25-Jun-2022 às 03:24
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
-- SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pdv_horus`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_clientes`
--

CREATE TABLE `tb_clientes` (
  `id_cliente` int(11) NOT NULL,
  `cpf_cliente` char(14) NOT NULL,
  `dt_nascimento_cliente` date NOT NULL,
  `nome_cliente` varchar(255) NOT NULL,
  `cep_cliente` char(9) NOT NULL,
  `estado_cliente` char(2) NOT NULL,
  `cidade_cliente` varchar(255) NOT NULL,
  `endereco_cliente` varchar(255) NOT NULL,
  `numero_cliente` int(11) NOT NULL,
  `complemento_cliente` varchar(255) DEFAULT NULL,
  `bairro_cliente` varchar(255) NOT NULL,
  `celular_cliente` char(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_clientes`
--

INSERT INTO `tb_clientes` (`id_cliente`, `cpf_cliente`, `dt_nascimento_cliente`, `nome_cliente`, `cep_cliente`, `estado_cliente`, `cidade_cliente`, `endereco_cliente`, `numero_cliente`, `complemento_cliente`, `bairro_cliente`, `celular_cliente`) VALUES
(5, '370.042.528-76', '1987-09-03', 'Flávio Oliveira', '13930-000', 'SP', 'Serra Negra', 'Rua teste ', 108, 'Casa A', 'Alto das Palmeiras', '(19)91919-1191'),
(6, '635.121.814-49', '1988-09-03', 'José Antônio', '13940-000', 'SP', 'Serra Negra', 'Rua teste', 42, 'perto do teste', 'teste', '(19)99999-9999');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_configuracoes`
--

CREATE TABLE `tb_configuracoes` (
  `id_configuracoes` int(11) NOT NULL,
  `senha_master_configuracoes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_configuracoes`
--

INSERT INTO `tb_configuracoes` (`id_configuracoes`, `senha_master_configuracoes`) VALUES
(1, '921062fdc5fa90aa9adc25075e963bbb');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_fornecedores`
--

CREATE TABLE `tb_fornecedores` (
  `id_fornecedor` int(11) NOT NULL,
  `cnpj_fornecedor` char(18) NOT NULL,
  `razao_social_fornecedor` varchar(255) NOT NULL,
  `nome_fantasia_fornecedor` varchar(255) NOT NULL,
  `cep_fornecedor` char(11) NOT NULL,
  `estado_fornecedor` char(2) NOT NULL,
  `cidade_fornecedor` varchar(255) NOT NULL,
  `endereco_fornecedor` varchar(255) NOT NULL,
  `numero_fornecedor` int(11) NOT NULL,
  `complemento_fornecedor` varchar(255) DEFAULT NULL,
  `bairro_fornecedor` varchar(255) NOT NULL,
  `telefone_fornecedor` char(13) DEFAULT NULL,
  `celular_fornecedor` char(13) NOT NULL,
  `email_fornecedor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_fornecedores`
--

INSERT INTO `tb_fornecedores` (`id_fornecedor`, `cnpj_fornecedor`, `razao_social_fornecedor`, `nome_fantasia_fornecedor`, `cep_fornecedor`, `estado_fornecedor`, `cidade_fornecedor`, `endereco_fornecedor`, `numero_fornecedor`, `complemento_fornecedor`, `bairro_fornecedor`, `telefone_fornecedor`, `celular_fornecedor`, `email_fornecedor`) VALUES
(1, '46.016.962/0001-30', 'Aut fuga Fugit sim', 'Empresa Teste', '13930-000', 'SP', 'Serra Negra', 'Maxime fugit nobis ', 23, 'Consequatur quae err', 'Labore minim ea fugi', '(19)3892-1212', '(19)98979-797', 'vawe@mailinator.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_produtos`
--

CREATE TABLE `tb_produtos` (
  `id_produto` int(11) NOT NULL,
  `foto_produto` varchar(255) NOT NULL DEFAULT 'produto_sem_imagem.png',
  `nome_produto` varchar(255) NOT NULL,
  `codigo_produto` varchar(255) NOT NULL,
  `descricao_produto` varchar(255) NOT NULL,
  `quantidade_produto` int(11) NOT NULL,
  `preco_unitario_produto` char(11) NOT NULL,
  `preco_venda_produto` char(11) NOT NULL,
  `preco_total_produto` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_produtos`
--

INSERT INTO `tb_produtos` (`id_produto`, `foto_produto`, `nome_produto`, `codigo_produto`, `descricao_produto`, `quantidade_produto`, `preco_unitario_produto`, `preco_venda_produto`, `preco_total_produto`) VALUES
(12, 'b3e3017713f5e5d29a7e0025d0cb6835.png', 'Coca Cola', '0001cc', 'Coca Cola Lata ', 34, '2,50', '13,00', '85,00'),
(14, 'cb97df3ec30f86b6a52d884c5feada36.png', 'Camiseta', 'cp', 'Camiseta Preta ', 56, '8,50', '800,00', '476,00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `cpf_usuario` char(14) NOT NULL,
  `nome_usuario` varchar(255) NOT NULL,
  `email_usuario` varchar(255) NOT NULL,
  `username_usuario` varchar(255) NOT NULL,
  `password_usuario` varchar(255) NOT NULL,
  `foto_usuario` varchar(255) NOT NULL DEFAULT 'logo.png',
  `perfil_usuario` char(2) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id_usuario`, `cpf_usuario`, `nome_usuario`, `email_usuario`, `username_usuario`, `password_usuario`, `foto_usuario`, `perfil_usuario`) VALUES
(1, '872.564.882-97', 'Flávio Oliveira', 'flaviooliveira@horuspdv.com.br', 'foliveira', '25f9e794323b453885f5181f1b624d0b', 'e2cb056ede3469067593c2a8545b7c62.jpg', '1'),
(2, '551.338.455-88', 'Usuário Teste', 'usuarioteste@horuspdv.com.br', 'usuarioteste', 'e10adc3949ba59abbe56e057f20f883e', '56e26086ee3feb548de3e7a4f1607296.png', '2');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_clientes`
--
ALTER TABLE `tb_clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Índices para tabela `tb_configuracoes`
--
ALTER TABLE `tb_configuracoes`
  ADD PRIMARY KEY (`id_configuracoes`);

--
-- Índices para tabela `tb_fornecedores`
--
ALTER TABLE `tb_fornecedores`
  ADD PRIMARY KEY (`id_fornecedor`);

--
-- Índices para tabela `tb_produtos`
--
ALTER TABLE `tb_produtos`
  ADD PRIMARY KEY (`id_produto`);

--
-- Índices para tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_clientes`
--
ALTER TABLE `tb_clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tb_configuracoes`
--
ALTER TABLE `tb_configuracoes`
  MODIFY `id_configuracoes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tb_fornecedores`
--
ALTER TABLE `tb_fornecedores`
  MODIFY `id_fornecedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `tb_produtos`
--
ALTER TABLE `tb_produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
