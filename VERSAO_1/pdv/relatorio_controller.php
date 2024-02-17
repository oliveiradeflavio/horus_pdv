<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'SIM') {
    header("Location: login.php?login=2");
}

require_once "conexao.php";
require_once __DIR__ . '_public/plugins/vendor/autoload.php';
use Mpdf\Mpdf;
$mpdf = new Mpdf();

$tipo_de_relatorios = $_POST['categoria_relatorio'];
$periodo_relatorio = $_POST['periodo_relatorio'];

$conexao = new Conexao();
$conexao = $conexao->conectar();

//se os relatorios forem do tipo clientes, fornecedores, produtos ou vendas exporto para excel, caso contrário exporto para pdf que seria o relatório de vendas
if ($tipo_de_relatorios == "rel_clientes" || $tipo_de_relatorios == "rel_fornecedores" || $tipo_de_relatorios == "rel_produtos"){
    header("Content-type: application/xls");
   
    header("Pragma: no-cache");
    header("Expires: 0");


        if($tipo_de_relatorios == "rel_clientes"){
            header("Content-Disposition: attachment; filename=horus_pdv_". $tipo_de_relatorios . ".xls");

            $output = "<meta charset='utf-8' />";
            $output .= '<table class="table table-lg table-hover table-responsive p-3" id="tabela_cad_clientes">
            <thead>
                <tr>
                    <th scope="col">CPF</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Data de Nascimento</th>
                    <th scope="col">CEP</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">Número</th>
                    <th scope="col">Bairro</th>
                    <th scope="col">Complemento</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Celular/WhatsApp</th>
                </tr>
            </thead>';           

            $query = "SELECT * FROM tb_clientes";
            $stmt = $conexao->prepare($query);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);

            foreach ($resultado as $key => $cliente) {

                $output .= '<tbody>
                
                    <tr>
                    <td>'. $cliente->cpf_cliente  .' </td>
                    <td>'. $cliente->nome_cliente  .' </td>
                    <td>'. $dt_nascimento_br = date("d/m/Y", strtotime($cliente->dt_nascimento_cliente )) .' </td>
                    <td>'. $cliente->cep_cliente  .' </td>
                    <td>'. $cliente->endereco_cliente  .' </td>
                    <td>'. $cliente->numero_cliente  .' </td>
                    <td>'. $cliente->bairro_cliente  .' </td>
                    <td>'. $cliente->complemento_cliente  .' </td>
                    <td>'. $cliente->estado_cliente  .' </td>
                    <td>'. $cliente->cidade_cliente  .' </td>
                    <td>'. $cliente->celular_cliente  .' </td>
                    </tr>
                    </tbody>';
            }
            $output .= '</table>';
            echo $output;

        }
        if($tipo_de_relatorios == 'rel_fornecedores'){
            header("Content-Disposition: attachment; filename=horus_pdv_". $tipo_de_relatorios . ".xls");

            $output = "<meta charset='utf-8' />";
            $output .= ' <table class="table table-sm table-hover table-responsive p-3" id="tabela_cad_fornecedores">
            <thead>
                <tr>
                    <th scope="col">CNPJ</th>
                    <th scope="col">Razão Social</th>
                    <th scope="col">Nome Fantasia</th>
                    <th scope="col">CEP</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">Número</th>
                    <th scope="col">Bairro</th>
                    <th scope="col">Complemento</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Celular/WhatsApp</th>
                    <th scope="col">Email</th>
                </tr>
            </thead>';

            $query = "SELECT * FROM tb_fornecedores";
            $stmt = $conexao->prepare($query);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);

            foreach ($resultado as $key => $fornecedor) {

                $output .= '<tbody>
                
                    <tr>
                    <td>'. $fornecedor->cnpj_fornecedor  .' </td>
                    <td>'. $fornecedor->razao_social_fornecedor  .' </td>
                    <td>'. $fornecedor->nome_fantasia_fornecedor  .' </td>
                    <td>'. $fornecedor->cep_fornecedor  .' </td>
                    <td>'. $fornecedor->endereco_fornecedor  .' </td>
                    <td>'. $fornecedor->numero_fornecedor  .' </td>
                    <td>'. $fornecedor->bairro_fornecedor  .' </td>
                    <td>'. $fornecedor->complemento_fornecedor  .' </td>
                    <td>'. $fornecedor->estado_fornecedor  .' </td>
                    <td>'. $fornecedor->cidade_fornecedor  .' </td>
                    <td>'. $fornecedor->telefone_fornecedor  .' </td>
                    <td>'. $fornecedor->celular_fornecedor  .' </td>
                    <td>'. $fornecedor->email_fornecedor  .' </td>
                    </tr>
                    </tbody>';
            }
            $output .= '</table>';
            echo $output;
        }
        if ($tipo_de_relatorios == 'rel_produtos'){
            header("Content-Disposition: attachment; filename=horus_pdv_". $tipo_de_relatorios . ".xls");

            $output = "<meta charset='utf-8' />";
            $output .= '<table class="table table-sm table-hover table-responsive p-3 mt-3" id="tabela_cad_produtos">
            <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Produto</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Preço Unitário</th>
                    <th scope="col">Preço Venda</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>';

            $query = "SELECT * FROM tb_produtos";
            $stmt = $conexao->prepare($query);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);

            foreach ($resultado as $key => $produto) {

                $output .= '<tbody>
                
                    <tr>                  
                    <td>'. $produto->codigo_produto  .' </td>
                    <td>'. $produto->nome_produto  .' </td>
                    <td>'. $produto->descricao_produto  .' </td>
                    <td>'. $produto->quantidade_produto  .' </td>
                    <td>'. $produto->preco_unitario_produto  .' </td>
                    <td>'. $produto->preco_venda_produto  .' </td>
                    <td>'. $produto->preco_total_produto  .' </td>
                    </tr>
                    </tbody>';
            }
            $output .= '</table>';
            echo $output;        
        }

}else {
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

    $mpdf->WriteHTML('<h5 align=center>Hórus PDV
    <h1 align=center>Relatório de Vendas</h1>
    <hr>');

    $pagina = "
    <html>
    <head>
    <title>Relatório de Vendas</title>
    <link rel='shortcut icon' href='/pdv_public/img/favicon.ico' type='image/x-icon'>
    </head>
    <body>
    Período: <h3>". $periodo_relatorio . "</h3><br><br>
    <table align=center width=100% border=1>
    <tr>
    <th>Número do Pedido</th>
    <th>Nome do Cliente</th>
    <th>Produto</th>
    <th>Quantidade</th>
    <th>Valor Produto Unitário</th>
    <th>Valor Total Produto</th>
    <th>Total Venda Bruto</th>
    <th>Tipo de Pagamento</th>
    <th>Desconto</th>
    <th>Total Venda com Desconto</th>
    <th>Código Pagamento Cartão</th>
    <th>Data e Hora Venda</th>
    </tr>";

    if ($tipo_de_relatorios == 'rel_vendas' && $periodo_relatorio == 'todos_anos'){
        $query = 'SELECT * FROM tb_vendas ORDER BY data_hora_venda DESC';
        $stmt = $conexao->prepare($query);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);

        foreach ($resultado as $key => $venda) {

            $pagina .= '<tr>
            <td>'. $venda->numero_da_venda_venda  .' </td>
            <td>'. $venda->nome_cliente_venda  .' </td>
            <td>'. $venda->produto_venda  .' </td>
            <td>'. $venda->quantidade_venda  .' </td>
            <td>'. $venda->valor_produto_unitario_venda  .' </td>
            <td>'. $venda->valor_produto_total_venda  .' </td>
            <td>'. $venda->total_venda_valor_bruto_venda  .' </td>
            <td>'. $venda->tipo_de_pagamento_venda  .' </td>
            <td>'. $venda->desconto_venda_venda  .' </td>
            <td>'. $venda->total_venda_atual_com_desconto_venda  .' </td>
            <td>'. $venda->codigo_pagamento_cartao_venda  .' </td>
            <td>'. date('d/m/Y H:i:s', strtotime($venda->data_hora_venda)) .' </td>
            </tr>';
        }
        $pagina .= '</tbody>';
        $pagina .= "</table>";
        $pagina .= "</body>";
        $pagina .= "</html>";

        $mpdf->WriteHTML($pagina);
        $mpdf->Output('horus_pdv_rel_vendas_todosAnos.pdf', 'D');       
    }
    else {
        $query = 'SELECT * FROM tb_vendas WHERE YEAR(data_hora_venda) = :periodo_relatorio ORDER BY data_hora_venda DESC';
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':periodo_relatorio', $periodo_relatorio);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);

        foreach ($resultado as $key => $venda) {

            $pagina .= '<tr>
            <td>'. $venda->numero_da_venda_venda  .' </td>
            <td>'. $venda->nome_cliente_venda  .' </td>
            <td>'. $venda->produto_venda  .' </td>
            <td>'. $venda->quantidade_venda  .' </td>
            <td>'. $venda->valor_produto_unitario_venda  .' </td>
            <td>'. $venda->valor_produto_total_venda  .' </td>
            <td>'. $venda->total_venda_valor_bruto_venda  .' </td>
            <td>'. $venda->tipo_de_pagamento_venda  .' </td>
            <td>'. $venda->desconto_venda_venda  .' </td>
            <td>'. $venda->total_venda_atual_com_desconto_venda  .' </td>
            <td>'. $venda->codigo_pagamento_cartao_venda  .' </td>
            <td>'. date('d/m/Y H:i:s', strtotime($venda->data_hora_venda)) .' </td>
            </tr>';
        }
        $pagina .= '</tbody>';
        $pagina .= "</table>";
        $pagina .= "</body>";
        $pagina .= "</html>";

        $mpdf->WriteHTML($pagina);
        $mpdf->Output('horus_pdv_rel_vendas_anual_'.strval($periodo_relatorio) .'.pdf', 'D');
    }
}
?>