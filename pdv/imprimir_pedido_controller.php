<?php
    require_once 'conexao.php';
    require_once __DIR__ . '_public/plugins/vendor/autoload.php';
    use Mpdf\Mpdf;

    $mpdf = new Mpdf();

    $numero_pedido_impressao = $_GET['nv'];

    $conexao = new Conexao();
    $conexao = $conexao->conectar();

    //$output = "<meta charset='utf-8' />";
    $pagina = "
    <html>
    <head>
    <title>Pedido</title>
    <meta charset='utf-8' />
    </head>
    <body>
    <h1>Pedido</h1>
    <h2>Numero do Pedido: $numero_pedido_impressao</h2>
    <table border='1'>
    <tr>
    <th>Produto</th>
    <th>Quantidade</th>
    <th>Preço Unitário</th>
    <th>Preço Total</th>
    </tr>
    ";
    

    // $numero_pedido_impressao = json_encode($_POST);
    // $numero_pedido_impressao = json_decode($numero_pedido_impressao);

    $query = "SELECT * FROM tb_vendas WHERE `numero_da_venda_venda` = :numero_pedido_impressao";
    $stmt = $conexao->prepare($query);
    $stmt->bindValue(':numero_pedido_impressao', $numero_pedido_impressao);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);

    foreach($resultado as $key => $n_pedido_venda){

        $pagina .= " <tr>
        <td>teste</td>
        <td>$n_pedido_venda->quantidade_venda</td>
        <td>$n_pedido_venda->preco_unitario_venda</td>
        <td>$n_pedido_venda->preco_total_venda</td>
        </tr>";
        // echo $n_pedido_venda->id_venda . '<br>';
        // echo $n_pedido_venda->numero_da_venda_venda . '<br>';
        // echo $n_pedido_venda->produto_venda . '<br>';
        // echo $n_pedido_venda->quantidade_venda . '<br>';
        // echo $n_pedido_venda->valor_produto_unitario_venda . '<br>';
        // echo $n_pedido_venda->valor_produto_total_venda . '<br>';
        // echo $n_pedido_venda->total_venda_valor_bruto_venda . '<br>';
        // echo $n_pedido_venda->tipo_de_pagamento_venda . '<br>';
        // echo $n_pedido_venda->desconto_venda_venda. '<br>';
        // echo $n_pedido_venda->total_venda_atual_com_desconto_venda . '<br>';
        // echo $n_pedido_venda->codigo_pagamento_cartao_venda . '<br>';
        // echo $n_pedido_venda->data_hora_venda. '<br>';
    }

   
    $mpdf->WriteHTML($pagina);
    $mpdf->Output();
?>

