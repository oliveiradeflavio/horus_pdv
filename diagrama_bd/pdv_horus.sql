CREATE TABLE `tb_usuarios` (
  `id_usuario` int(11) PRIMARY KEY NOT NULL,
  `cpf_usuario` char(14) NOT NULL,
  `nome_usuario` varchar(255) NOT NULL,
  `username_usuario` varchar(255) NOT NULL,
  `password_usuario` varchar(255) NOT NULL,
  `email_usuario` varchar(255) NOT NULL,
  `foto_usuario` varchar(255) NOT NULL DEFAULT "logo.png",
  `perfil_usuario` char(2) NOT NULL DEFAULT "2"
);

CREATE TABLE `tb_clientes` (
  `id_cliente` int(11) PRIMARY KEY NOT NULL,
  `cpf_cliente` char(14) NOT NULL,
  `dt_nascimento_cliente` date NOT NULL,
  `nome_cliente` varchar(255) NOT NULL,
  `cep_cliente` char(9) NOT NULL,
  `estado_cliente` char(2) NOT NULL,
  `cidade_cliente` varchar(255) NOT NULL,
  `endereco_cliente` varchar(255) NOT NULL,
  `numero_cliente` int(11) NOT NULL,
  `complemento_cliente` varchar(255),
  `bairro_cliente` varchar(255) NOT NULL,
  `celular_cliente` char(14) NOT NULL
);

CREATE TABLE `tb_fornecedores` (
  `id_fornecedor` int(11) PRIMARY KEY NOT NULL,
  `cnpj_fornecedor` char(18) NOT NULL,
  `razao_social_fornecedor` varchar(255) NOT NULL,
  `nome_fantasia_fornecedor` varchar(255) NOT NULL,
  `cep_fornecedor` char(11) NOT NULL,
  `estado_fornecedor` char(2) NOT NULL,
  `cidade_fornecedor` varchar(255) NOT NULL,
  `endereco_fornecedor` varchar(255) NOT NULL,
  `numero_fornecedor` int(11) NOT NULL,
  `complemento_fornecedor` varchar(255),
  `bairro_fornecedor` varchar(255) NOT NULL,
  `telefone_fornecedor` char(13),
  `celular_fornecedor` char(14) NOT NULL,
  `email_fornecedor` varchar(255) NOT NULL
);

CREATE TABLE `tb_produtos` (
  `id_produto` int(11) PRIMARY KEY NOT NULL,
  `foto_produto` varchar(255) NOT NULL DEFAULT "produto_sem_imagem.png",
  `nome_produto` varchar(255) NOT NULL,
  `codigo_produto` varchar(255) NOT NULL,
  `descricao_produto` varchar(255) NOT NULL,
  `quantidade_produto` int(11),
  `preco_unitario_produto` char(11) NOT NULL,
  `preco_venda_produto` char(11) NOT NULL,
  `preco_total_produto` char(11) NOT NULL
);

CREATE TABLE `tb_vendas` (
  `id_venda` int(11) PRIMARY KEY NOT NULL,
  `numero_da_venda_venda` int(11) NOT NULL,
  `nome_cliente_venda` varchar(255) NOT NULL,
  `produto_venda` varchar(255) NOT NULL,
  `quantidade_venda` int(11) NOT NULL,
  `valor_produto_unitario_venda` char(11) NOT NULL,
  `valor_produto_total_venda` char(11) NOT NULL,
  `total_venda_valor_bruto_venda` char(11) NOT NULL,
  `tipo_de_pagamento_venda` varchar(255) NOT NULL,
  `desconto_venda_venda` char(11),
  `total_venda_atual_com_desconto_venda` char(11),
  `codigo_pagamento_cartao_venda` varchar(255),
  `data_hora_venda` datetime NOT NULL DEFAULT "current_timestamp"
);

CREATE TABLE `tb_dados_empresariais` (
  `id_dados_empresariais` int(11) PRIMARY KEY NOT NULL,
  `cnpj_dados_empresariais` char(18) NOT NULL,
  `nome_empresa_dados_empresariais` varchar(255) NOT NULL,
  `cep_dados_empresariais` char(11) NOT NULL,
  `estado_dados_empresariais` char(2) NOT NULL,
  `cidade_dados_empresariais` varchar(255) NOT NULL,
  `endereco_dados_empresariais` varchar(255) NOT NULL,
  `numero_dados_empresariais` int(11) NOT NULL,
  `bairro_dados_empresariais` varchar(255) NOT NULL,
  `telefone_dados_empresariais` char(13),
  `celular_dados_empresariais` char(14) NOT NULL,
  `email_dados_empresariais` varchar(255) NOT NULL
);

CREATE TABLE `tb_configuracoes` (
  `id_configuracoes` int(11) PRIMARY KEY NOT NULL,
  `senha_master_configuracoes` varchar(255) NOT NULL
);
