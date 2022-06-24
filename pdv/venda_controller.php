<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once "conexao.php";

//capturar o parametro ação que esta sendo passado como parametro via GET
//$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

$dados = json_encode($_POST);
$dados_convertidos = json_decode($dados, true);

$nome_cliente = $dados_convertidos->cliente;
$produtos_tabela = $dados_convertidos->produtos_tabela;
$total_venda_valor_bruto = $dados_convertidos->total_venda_valor_bruto;
$desconto_venda = $dados_convertidos->desconto_venda;
$total_venda_atual_com_desconto = $dados_convertidos->total_venda_atual_com_desconto;
$codigo_pagamento_cartao = $dados_convertidos->codigo_pagamento_cartao;


print_r($produtos_tabela);

for($i = 0; $i < count($produtos_tabela); $i++){
    $produto_nome = $produtos_tabela[$i]->nome_produto;
    $produto_quantidade = $produtos_tabela[$i]->quantidade;
    $produto_valor_unitario = $produtos_tabela[$i]->valor_unitario;
    $produto_valor_total = $produtos_tabela[$i]->valor_total;

    echo $produto_nome . " - " . $produto_quantidade . " - " . $produto_valor_unitario . " - " . $produto_valor_total . "<br>";
}



// foreach ($produtos_tabela as $key => $produto) {
//      $nome_produto = $produto[0];
//     // $quantidade_produto = $produto;
//     // $valor_unitario = $produto;
//     // $valor_total = $produto;

//     print_r($nome_produto);

//     //echo $nome_produto . " - " . $quantidade_produto . " - " . $valor_unitario . " - " . $valor_total . "<br>";
// }

   






// foreach($produtos_tabela as $key => $v){
//     if($key == 0){
//         $nome_produto = $v;
//     }
//     if($key == 1){
//         $quantidade_produto = $v;
//     }
//     if($key == 2){
//         $preco_unitario = $v;
//     }
//     if($key == 3){
//         $preco_total = $v;
//     }
// }

// echo '<br>';
// echo $nome_produto;
// echo '<br>';
// echo $quantidade_produto;
// echo '<br>';
// echo $preco_unitario;
// echo '<br>';
// echo $preco_total;



// echo '<br>';
// echo $total_venda_valor_bruto;
// echo '<br>';
// echo $desconto_venda;
// echo '<br>';
// echo $total_venda_atual_com_desconto;
// echo '<br>';
// echo $codigo_pagamento_cartao;
// echo '<br>';
