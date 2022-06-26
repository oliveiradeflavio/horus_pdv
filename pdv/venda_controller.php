<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once "conexao.php";

//capturar o parametro ação que esta sendo passado como parametro via GET
//$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

$dados = json_encode($_POST);
$dados_convertidos = json_decode($dados);

//print_r($dados_convertidos);

$nome_cliente = $dados_convertidos->cliente;
// $produtos_tabela = $dados_convertidos->produtos;
$total_venda_valor_bruto = $dados_convertidos->total_venda_valor_bruto;
$desconto_venda = $dados_convertidos->desconto_venda;
$total_venda_atual_com_desconto = $dados_convertidos->total_venda_atual_com_desconto;
$codigo_pagamento_cartao = $dados_convertidos->codigo_pagamento_cartao;

$produtos_tabela = $dados_convertidos->produtos;
//print_r($produtos_tabela->nome_produto);

foreach($produtos_tabela->nome_produto as $nome_produto){
    echo $nome_produto."<br>";
    echo $nome_cliente."<br>";
    echo $total_venda_valor_bruto."<br>";
    echo $desconto_venda."<br>";
    echo $total_venda_atual_com_desconto."<br>";
    echo $codigo_pagamento_cartao."<br>";

    echo 'cliente: '.$nome_cliente. ' salvo com sucesso' .'<br>';
    
}