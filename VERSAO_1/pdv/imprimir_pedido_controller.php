<?php
    session_start();
    if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'SIM') {
        header("Location: login.php?login=2");
    }

    require_once 'conexao.php';
    require 'dados_empresariais_model.php';
    require 'dados_empresariais_service.php';

    require_once __DIR__ . '_public/plugins/vendor/autoload.php';
    use Mpdf\Mpdf;

    $mpdf = new Mpdf();

     //Esses dois parâmetros vem da página de histórico e venda. Na página de histórico o download é true já na página de venda o download é false. Na página de venda.php será para impressão.
    $download = $_GET['download'];
    $numero_pedido_impressao = $_GET['nv'];

    $conexao = new Conexao();
    $conexao2 = $conexao;
    $conexao = $conexao->conectar();

    $mpdf->forcePortraitHeaders = true;
    $mpdf->SetDisplayMode('fullpage');

    $mpdf->SetHTMLHeader('
    <div style="text-align: right; font-weight: bold;">
        <img src="img/logo.png" width="100" height="100" alt="Logo">

    ');   

    $mpdf->SetHTMLFooter('
    <table width="100%">
        <tr>
            <td width="33%">{DATE d/m/Y}</td>
            <td width="33%" align="center">{PAGENO}/{nbpg}</td>
            <td width="33%" style="text-align: right;">Hórus PDV - por Flávio Oliveira</td>
        </tr>
    </table>');

    $dados_empresariais = new DadosEmpresariaisModel();
    $dados_empresariais_service = new DadosEmpresariaisService($conexao2, $dados_empresariais);

    $consulta_dados_empresarias = $dados_empresariais_service->consultarDadosEmpresariais();
    foreach($consulta_dados_empresarias as $key => $dados_empresariais){
        $mpdf->WriteHTML('<h5 align=center>'.$dados_empresariais->nome_empresa_dados_empresariais.'</h5>
        <h5 align=center>'.$dados_empresariais->endereco_dados_empresariais.', '.$dados_empresariais->numero_dados_empresariais. ' - ' .$dados_empresariais->bairro_dados_empresariais.' - '. $dados_empresariais->cidade_dados_empresariais.'/'.$dados_empresariais->estado_dados_empresariais.'</h5>
        <h5 align=center>CNPJ:'.$dados_empresariais->cnpj_dados_empresariais.' Fone: '.$dados_empresariais->telefone_dados_empresariais.'/'.$dados_empresariais->celular_dados_empresariais.'</h5>
        <hr>');
    } 

   
    
    $pagina = "
    <html>
    <head>
    <title>Pedido</title>
    <meta charset='utf-8' />
    </head>
    <body>
    Vendedor: ".$_SESSION['nome_usuario']."
    <h4>Numero do Pedido: $numero_pedido_impressao</h4><br>
    <table align=center width=100% border=1>
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

        $pagina .= " <tbody>
        <tr>
        <td align=left>$n_pedido_venda->produto_venda</td>
        <td align=right>$n_pedido_venda->quantidade_venda</td>
        <td align=right>$n_pedido_venda->valor_produto_unitario_venda</td>
        <td align=right>$n_pedido_venda->valor_produto_total_venda</td>
        </tr> ";
       
    }
    $pagina .= "</tbody>";
    $pagina .= "</table>";
     
    
    $pagina .= "<br><br>Valor total do pedido:<strong> R$ ".$n_pedido_venda->total_venda_valor_bruto_venda."</strong><br><br>";
    $pagina .= "Desconto: " .$n_pedido_venda->desconto_venda_venda."%<br><br>";
    $pagina .= "Valor total com desconto:<strong> R$ ".$n_pedido_venda->total_venda_atual_com_desconto_venda."</strong><br><br>";
    $pagina .= "Forma de pagamento:<strong> ".$n_pedido_venda->tipo_de_pagamento_venda."</strong><br><br>";

    if ($n_pedido_venda->tipo_de_pagamento_venda != "dinheiro") {
        $pagina .= "Codigo da Transação:<strong> ".$n_pedido_venda->codigo_pagamento_cartao_venda."</strong><br><br>";
    }
        
    $data_br = date('d/m/Y H:i:s', strtotime($n_pedido_venda->data_hora_venda));
    
    $pagina .= "Data e hora do pedido:<strong> ".$data_br."</strong><br><br>";

    $pagina .= "Cliente: <strong>".$n_pedido_venda->nome_cliente_venda."</strong><br><br>";
    
    $pagina .= "</body>"; 
    $pagina .= "</html>";
    
    $mpdf->WriteHTML($pagina); 
    
    if ($download == 's') {
        $mpdf->Output('horus_pdv_numero_pedido_'. strval($numero_pedido_impressao) .'.pdf', 'D');
    } else {
        $mpdf->Output();
    }
?>

