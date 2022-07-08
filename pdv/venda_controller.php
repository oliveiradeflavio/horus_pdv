<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once "conexao.php";
require "../pdv/venda_model.php";
require "../pdv/venda_service.php";

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
foreach(array_combine($produtos_tabela->id_produto, $produtos_tabela->quantidade) as $id_produto => $quantidade_produto){
 
    $venda->__set('id_produto', $id_produto);
    $vendaServices = $vendaService->consultarProduto();
   
    foreach($vendaServices as $key => $venda_p){   
       
        $quantidade_produto_bd = $venda_p->quantidade_produto;
        if($quantidade_produto_bd < $quantidade_produto){
            echo "Quantidade insuficiente no estoque";
            exit;
        }else{
            /*
            Atualizando a quantidade do produto no banco de dados na tabela tb_produtos
            também atualizando o preco_total_produto na tablela tb_produtos. 
            */
            $baixa_quantidade_bd = $quantidade_produto_bd - $quantidade_produto;
            $preco_unitario_produto_bd = $venda_p->preco_unitario_produto;
            $preco_total_produto_bd = str_replace(',', '.', $preco_unitario_produto_bd);
            $preco_total_produto_bd = floatval($preco_total_produto_bd); 
            $preco_total_produto_bd = $baixa_quantidade_bd * $preco_total_produto_bd;
            $preco_total_produto_bd = number_format($preco_total_produto_bd, 2, ',', '.');

            $venda->__set('id_produto', $id_produto);
            $venda->__set('quantidade_produto', $baixa_quantidade_bd );
            $venda->__set('preco_total_produto', $preco_total_produto_bd);
            $vendaService->atualizarQuantidadeProduto();
       
            $nome_produto = $venda_p->nome_produto;
            $precounitario = $venda_p->preco_venda_produto;
            $preco_unitario = str_replace(',', '.', $precounitario);
            $preco_unitario = str_replace('.', '', $precounitario);
            //$preco_unitario = floatval($preco_unitario);
        }      
        
        // preco_unitario do produto x quantidade do produto = preco_total do produto
        $valor_produto_total  =  intval($preco_unitario) * $quantidade_produto; 
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

        $vendaService->inserirVenda();  
       }
       
    }
    $retorno = json_encode('sucesso?' . strval($contador) );
    print_r($retorno); 
?>
