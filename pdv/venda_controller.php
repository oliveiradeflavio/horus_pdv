<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once "conexao.php";
require "venda_model.php";
require "venda_service.php";

$venda = new Venda();
$conexao = new Conexao();
$vendaService = new VendaService($conexao, $venda);

//Pegando os dados enviado por ajax (formato json)
$dados = json_encode($_POST);
$dados_convertidos = json_decode($dados);

$nome_cliente = $dados_convertidos->cliente;
$total_venda_valor_bruto = $dados_convertidos->total_venda_valor_bruto;
$tipo_de_pagamento = $dados_convertidos->tipo_de_pagamento;
$desconto_venda = $dados_convertidos->desconto_venda;
$total_venda_atual_com_desconto = $dados_convertidos->total_venda_atual_com_desconto;
$codigo_pagamento_cartao = $dados_convertidos->codigo_pagamento_cartao;
$produtos_tabela = $dados_convertidos->produtos;

//contador para gerar o codigo da venda. A cada nova venda, o contador sera incrementado.
$vendaServices = $vendaService->contador();
if (count($vendaServices) > 0) {
    $contador = $vendaServices[0]->numero_da_venda_venda;
    $contador = $contador + 1;
} else {
    $contador = 1;
}

//Inserindo a venda no banco de dados
foreach(array_combine($produtos_tabela->id_produto, $produtos_tabela->quantidade) as $id_produto => $quantidade_produto) {
    $venda = new Venda();
    $conexao = new Conexao();
    $vendaService = new VendaService($conexao, $venda);    
 
    $venda->__set('id_produto', $id_produto);
    $vendaServices = $vendaService->consultarProduto();
   
    foreach($vendaServices as $i => $venda){
        $nome_produto = $venda->nome_produto;
        $precounitario = $venda->preco_unitario_produto;
        $preco_unitario = str_replace(',', '.', $precounitario);
        $preco_unitario = floatval($preco_unitario);
    }
    
    $venda = new Venda();
    $conexao = new Conexao();
    $vendaService = new VendaService($conexao, $venda);

    // preco_unitario do produto x quantidade do produto = preco_total do produto
    $valor_produto_total  =  $preco_unitario * $quantidade_produto;
    $valor_produto_total = number_format($valor_produto_total, 2, ',', '.');
 
    $venda->__set('numero_da_venda_venda', $contador);
    $venda->__set('nome_cliente_venda', $nome_cliente);
    $venda->__set('produto_venda', $nome_produto);
    $venda->__set('quantidade_venda', $quantidade_produto);
    $venda->__set('valor_produto_unitario_venda', $precounitario);
    $venda->__set('valor_produto_total_venda', $valor_produto_total);
    $venda->__set('total_venda_valor_bruto_venda', $total_venda_valor_bruto);
    $venda->__set('tipo_de_pagamento_venda', $tipo_de_pagamento);
    $venda->__set('desconto_venda_venda', $desconto_venda);
    $venda->__set('total_venda_atual_com_desconto_venda', $total_venda_atual_com_desconto);
    $venda->__set('codigo_pagamento_cartao_venda', $codigo_pagamento_cartao);

    #$vendaService->inserirVenda();
    //header('Location: venda.php?');
    print_r('Venda inserida com sucesso!');
    } 
?>