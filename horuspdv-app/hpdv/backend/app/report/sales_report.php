<?php
session_start();
require __DIR__ . "/../database/db_connection.php";
require __DIR__ . "/../utils/mpdf/vendor/autoload.php";

$connect = new DbConnection();
$connect = $connect->getConnection();

function redirect($msg)
{
    echo json_encode($msg);
    exit();
}

//os parametros de action e id da venda viram via GET
//verificando se foram passados
if (!isset($_GET['action']) || !isset($_GET['id'])) {
    redirect(array("error" => "erro1", "message" => "Erro de autenticação."));
    exit();
} else {
    ob_start(); //inicia o buffer de saída

    $action = $_GET['action'];
    if ($action === "print_sale") {
        $sale_id = $_GET['id'];

        $query = "SELECT v.*, c.nome, c.cpf, p.nome_produto FROM tb_vendas v JOIN tb_clientes c ON v.cliente = c.id JOIN tb_produtos p ON v.produto = p.id WHERE v.numero_da_venda = :sale_id";
        $stmt = $connect->prepare($query);
        $stmt->bindValue(':sale_id', $sale_id);
        $stmt->execute();
        $results_sales = $stmt->fetchAll(PDO::FETCH_OBJ);

        $mpdf = new \Mpdf\Mpdf(
            [
                'mode' => 'utf-8',
                'orientation' => 'L',
                'margin_left' => 10,
                'margin_right' => 10,
                'margin_top' => 10,
                'margin_bottom' => 10,
                'margin_header' => 10,
                'margin_footer' => 10,
                'setAutoTopMargin' => 'stretch',
                'setAutoBottomMargin' => 'stretch',
                'default_font_size' => 10,
                'default_font' => 'sans-serif',
                'autoScriptToLang' => true,
                'autoLangToFont' => true,
                'autoVietnamese' => true,
            ]
        );

        $html = '      
        <style>
        table{
            font-size:10px;
        }   

        .table,  .table th,  .table td{
            border: 1px solid black;
            border-collapse: collapse;
        }
        
        </style>
        ';

        $html .= '
            <div class="container">
            <h3>Cliente: ' . $results_sales[0]->nome . '</h3>
            <h3>CPF: ' . $results_sales[0]->cpf . '</h3><br>
            ';

        $html .= '           
                <table class="table" width="100%" style="font-family: Arial; font-size: 10pt; text-align:center; border-collapse: collapse;">
                    <tr>                
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Pr.Unitário</th>
                        <th>Tipo de Pg</th>                      
                        <th>Código de Transação</th>
                        <th>Data</th>
                        <th>Vendedor</th>
                        </tr>';

        foreach ($results_sales as $key => $sale) {
            $html .= '
            <tr>               
                <td>' . $sale->nome_produto . '</td>
                <td>' . $sale->quantidade . '</td>
                <td>' . $sale->valor_unitario . '</td>
                <td>' . $sale->tipo_de_pagamento . '</td>';

            // Bloco condicional para coluna de código de transação
            if ($sale->tipo_de_pagamento != "dinheiro") {
                $html .= '<td>' . $sale->codigo_de_transacao_ou_chave_pix . '</td>';
            } else {
                $html .= '<td> - </td>';
            }

            $html .= '<td>' .
                // Formata a data para o padrão brasileiro
                date('d/m/Y H:i:s', strtotime($sale->data_criacao)) . '</td>             
              <td>' . $sale->vendedor . '</td>
            </tr>';
        }

        $html .= ' </table></div> <br>';

        $mpdf->SetHTMLHeader('
        <table width="100%" style="font-family: Arial; font-size: 10pt; border-collapse: collapse;">
        <tr>
            <td width="33%" style="text-align: left;">Venda #' . $sale_id . '</td>          
            <td width="33%" style="text-align: center;">Hórus PDV
                <br>                
                www.flaviodeoliveira.com.br
            </td>
             <td width="33%" style="text-align: right;">Venda #' . $sale_id . '</td>   
          

        </tr>                    
        </table>  
        <br>
        <hr>   
     
        ');

        //bloco de informações de subtotal, desconto e total
        $html .=
            '<div class="container">
            <div>
                <label>Subtotal:</label>
                <span>' . $sale->subtotal . '</span>
            </div>';

        //colocar o total no fim da tabela
        // Bloco condicional para coluna de desconto
        if (empty($sale->desconto)) {
            $html .= '
             <div>
                <label>Desconto:</label>
                <span> R$00,00  </span>
                <label>Valor com desconto:</label>
                 <span> R$00,00  </span>
            </div>';
        } else {
            $html .= '
             <div>
                <label>Desconto:</label>
                <span>' . $sale->desconto . '%' . '</span>
                <label>Valor com desconto:</label>
                <span>' . $sale->valor_com_desconto . '</span>
            </div>';
        }
        $html .= '
            <div>
                <label>Total:</label>
                <span>' . $sale->valor_a_ser_pago . '</span>
            </div>
        </div>';

        // Define o rodapé no Mpdf
        $mpdf->setHTMLFooter('<table width="100%" style="font-size: 8pt"><tr><td width="33%">Gerado na data: {DATE j/m/Y}</td><td width="33%" align="center">{PAGENO}/{nbpg}</td><td width="33%" style="text-align: right;">PDF gerado por: ' . $_SESSION['access_user'] . '</td></tr></table>');

        $mpdf->WriteHTML($html);
        $mpdf->Output("venda_" . $sale_id . ".pdf", "I");
        exit();
        ob_end_flush(); //limpa o buffer e envia a saida para o navegador
    }
}
