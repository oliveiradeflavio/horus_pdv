<?php
session_start();
require __DIR__ . "/../database/db_connection.php";
require __DIR__ . "/../utils/mpdf/vendor/autoload.php";
require __DIR__ . "/../utils/phpspreadsheet/vendor/autoload.php";

$connect = new DbConnection();
$connect = $connect->getConnection();

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function redirect($msg)
{
    echo json_encode($msg);
    exit();
}

$action = $_GET['action'];
$csrf_token = $_GET['csrf_token'];

if ($csrf_token != $_SESSION['csrf_token']) {
    redirect(array("error" => "erro1", "message" => "Erro de autenticação."));
    exit();
} else {

    if ($action === "report_client") {
        if ($_GET["report_type"] === "pdf") {

            $reportingPeriod = $_GET['reporting_period'];

            //buscar todos os clientes onde o ano da coluna data_criacao seja igual ao da variavel $reportingPeriod
            $query = "SELECT * FROM tb_clientes WHERE YEAR(data_criacao) = :reportingPeriod ORDER BY nome ASC;";
            $stmt = $connect->prepare($query);
            $stmt->bindValue(':reportingPeriod', $reportingPeriod);
            $stmt->execute();
            $results_clients = $stmt->fetchAll(PDO::FETCH_OBJ);

            ob_start(); //inicia o buffer de saída
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
        
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        
        </style>
        ';

            $html .= '           
                <table width="100%" style="font-family: Arial; font-size: 10pt; text-align:center;">
                    <tr>                
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>RG</th>
                        <th>Dt. Nascimento</th>                      
                        <th>Idade</th>
                        <th>CEP</th>
                        <th>Cidade</th>
                        <th>UF</th>
                        <th>Endereço</th>
                        <th>Bairro</th>
                        <th>Complemento</th>
                        <th>Número</th>
                        <th>Ponto de Referência</th>
                        <th>Telefone</th>
                        <th>Celular</th>
                        <th>E-mail</th>
                    </tr>';

            foreach ($results_clients as $client) {
                $html .= '
                    <tr>
                        <td>' . $client->nome . '</td>
                        <td>' . $client->cpf . '</td>
                        <td>' . $client->rg . '</td>  
                        <td>' . date('d/m/Y', strtotime($client->data_nascimento)) . '</td>
                        <td>' . $client->idade . '</td>
                        <td>' . $client->cep . '</td>
                        <td>' . $client->cidade . '</td>
                        <td>' . $client->uf . '</td>
                        <td>' . $client->endereco . '</td>
                        <td>' . $client->bairro . '</td>
                        <td>' . $client->complemento . '</td>
                        <td>' . $client->numero . '</td>
                        <td>' . $client->ponto_referencia . '</td>
                        <td>' . $client->telefone . '</td>
                        <td>' . $client->celular . '</td>
                        <td>' . $client->email . '</td>
                    </tr>';
            }
            $html .= ' </table></div>
            <br>
            <span>Total de itens: ' . count($results_clients) . '</span>
             <br>';

            $mpdf->SetHTMLHeader('
                <div style="text-align: center;">Hórus PDV</div>
                <div style="text-align: center;">www.flaviodeoliveira.com.br</div>
                <br><br>
        <div style="text-align: center; font-size: 12px; font-weight: bold;">Relatório de Clientes</div>


        <hr>   
     
        ');

            // Define o rodapé no Mpdf
            $mpdf->setHTMLFooter('<div style="font-size: 8pt; width: 100%; text-align: center;">Gerado na data: {DATE j/m/Y} | {PAGENO}/{nbpg} | PDF gerado por: ' . $_SESSION['access_user'] . '</div>');

            $mpdf->WriteHTML($html);
            $mpdf->Output("relatorio_cliente.pdf", "I");
            exit();
            ob_end_flush(); //limpa o buffer e envia a saida para o navegador
        }
        if ($_GET["report_type"] === "excel") {

            $reportingPeriod = $_GET['reporting_period'];

            //buscar todos os clientes onde o ano da coluna data_criacao seja igual ao da variavel $reportingPeriod
            $query = "SELECT * FROM tb_clientes WHERE YEAR(data_criacao) = :reportingPeriod ORDER BY nome ASC;";
            $stmt = $connect->prepare($query);
            $stmt->bindValue(':reportingPeriod', $reportingPeriod);
            $stmt->execute();
            $results_clients = $stmt->fetchAll(PDO::FETCH_OBJ);

            //criar uma nova planilha
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            //definicar cabeçalho das colunas
            $columns = ['Nome', 'CPF', 'RG', 'Dt. Nascimento', 'Idade', 'CEP', 'Cidade', 'UF', 'Endereço', 'Bairro', 'Complemento', 'Número', 'Ponto de Referência', 'Telefone', 'Celular', 'E-mail'];
            $sheet->fromArray($columns, NULL, 'A1');

            // Definir os dados a serem preenchidos na planilha        
            $rowIndex = 2;
            foreach ($results_clients as $client) {
                $sheet->setCellValue('A' . $rowIndex, $client->nome);
                $sheet->setCellValue('B' . $rowIndex, $client->cpf);
                $sheet->setCellValue('C' . $rowIndex, $client->rg);
                $sheet->setCellValue('D' . $rowIndex, date('d/m/Y', strtotime($client->data_nascimento)));
                $sheet->setCellValue('E' . $rowIndex, $client->idade);
                $sheet->setCellValue('F' . $rowIndex, $client->cep);
                $sheet->setCellValue('G' . $rowIndex, $client->cidade);
                $sheet->setCellValue('H' . $rowIndex, $client->uf);
                $sheet->setCellValue('I' . $rowIndex, $client->endereco);
                $sheet->setCellValue('J' . $rowIndex, $client->bairro);
                $sheet->setCellValue('K' . $rowIndex, $client->complemento);
                $sheet->setCellValue('L' . $rowIndex, $client->numero);
                $sheet->setCellValue('M' . $rowIndex, $client->ponto_referencia);
                $sheet->setCellValue('N' . $rowIndex, $client->telefone);
                $sheet->setCellValue('O' . $rowIndex, $client->celular);
                $sheet->setCellValue('P' . $rowIndex, $client->email);

                $rowIndex++;
            }

            //configurar o nome do arquivo
            $filename = "relatorio_clientes.xlsx";

            //cabeçalhos para fazer o download
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');

            //salvar a planilha 
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }
    }
    if ($action === "report_product") {
        if ($_GET["report_type"] === "pdf") {

            $reportingPeriod = $_GET['reporting_period'];

            $query = "SELECT p.*, f.nome_fantasia FROM tb_produtos p JOIN tb_fornecedores f WHERE YEAR(p.data_criacao) = :reportingPeriod GROUP BY p.id ORDER BY p.nome_produto ASC;";
            $stmt = $connect->prepare($query);
            $stmt->bindValue(':reportingPeriod', $reportingPeriod);
            $stmt->execute();
            $results_products = $stmt->fetchAll(PDO::FETCH_OBJ);

            ob_start(); //inicia o buffer de saída
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
                    
                    table, th, td {
                        border: 1px solid black;
                        border-collapse: collapse;
                    }
                    
                    </style>';
            $html .= '           
                <table width="100%" style="font-family: Arial; font-size: 10pt; text-align:center;">
                    <tr>   
                    <th>Nome do Produto</th>
                    <th>Código do Produto</th>
                    <th>Fornecedor</th>
                    <th>Descrição</th>
                    <th>Quantidade</th>
                    <th>Preço Unitário</th>
                    <th>Preço de Venda</th>
                    <th>Preço em Estoque</th>
                    <th>Data de Criação</th>
                    <th>Data de Atualização</th>                      
                    </tr>';

            foreach ($results_products as $product) {
                $html .= '
                    <tr>
                        <td>' . $product->nome_produto . '</td>
                        <td>' . $product->codigo_produto . '</td>
                        <td>' . $product->nome_fantasia . '</td>  
                        <td>' . $product->descricao_produto . '</td>
                        <td>' . $product->quantidade_produto . '</td>
                        <td>' . $product->preco_unitario_produto . '</td>
                        <td>' . $product->preco_venda_produto . '</td>
                        <td>' . $product->preco_total_em_produto . '</td>
                        <td>' . date('d/m/Y', strtotime($product->data_criacao)) . '</td>
                        <td>' . date('d/m/Y', strtotime($product->data_modificacao)) . '</td>
                    </tr>';
            }

            $html .= ' </table></div>
            <br>
            <span>Total de itens: ' . count($results_products) . '</span>
             <br>';

            $mpdf->SetHTMLHeader('
                <div style="text-align: center;">Hórus PDV</div>
                <div style="text-align: center;">www.flaviodeoliveira.com.br</div>
                <br><br>
        <div style="text-align: center; font-size: 12px; font-weight: bold;">Relatório de Produtos</div>


        <hr>   
     
        ');

            // Define o rodapé no Mpdf
            $mpdf->setHTMLFooter('<div style="font-size: 8pt; width: 100%; text-align: center;">Gerado na data: {DATE j/m/Y} | {PAGENO}/{nbpg} | PDF gerado por: ' . $_SESSION['access_user'] . '</div>');

            $mpdf->WriteHTML($html);
            $mpdf->Output("relatorio_produtos.pdf", "I");
            exit();
            ob_end_flush(); //limpa o buffer e envia a saida para o navegador
        }
        if ($_GET["report_type"] === "excel") {

            $reportingPeriod = $_GET['reporting_period'];

            $query = "SELECT p.*, f.nome_fantasia FROM tb_produtos p JOIN tb_fornecedores f WHERE YEAR(p.data_criacao) = :reportingPeriod GROUP BY p.id ORDER BY p.nome_produto ASC;";
            $stmt = $connect->prepare($query);
            $stmt->bindValue(':reportingPeriod', $reportingPeriod);
            $stmt->execute();
            $results_products = $stmt->fetchAll(PDO::FETCH_OBJ);

            //criar uma nova planilha
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            //definicar cabeçalho das colunas
            $columns = ['Nome do Produto', 'Código do Produto', 'Fornecedor', 'Descrição', 'Quantidade', 'Preço Unitário', 'Preço de Venda', 'Preço em Estoque', 'Data de Criação', 'Data de Atualização'];
            $sheet->fromArray($columns, NULL, 'A1');

            // Definir os dados a serem preenchidos na planilha
            $rowIndex = 2;
            foreach ($results_products as $product) {
                $sheet->setCellValue('A' . $rowIndex, $product->nome_produto);
                $sheet->setCellValue('B' . $rowIndex, $product->codigo_produto);
                $sheet->setCellValue('C' . $rowIndex, $product->nome_fantasia);
                $sheet->setCellValue('D' . $rowIndex, $product->descricao_produto);
                $sheet->setCellValue('E' . $rowIndex, $product->quantidade_produto);
                $sheet->setCellValue('F' . $rowIndex, $product->preco_unitario_produto);
                $sheet->setCellValue('G' . $rowIndex, $product->preco_venda_produto);
                $sheet->setCellValue('H' . $rowIndex, $product->preco_total_em_produto);
                $sheet->setCellValue('I' . $rowIndex, date('d/m/Y', strtotime($product->data_criacao)));
                $sheet->setCellValue('J' . $rowIndex, date('d/m/Y', strtotime($product->data_modificacao)));

                $rowIndex++;
            }

            //configurar o nome do arquivo
            $filename = "relatorio_produtos.xlsx";
            //cabeçalhos para fazer o download
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');

            //salvar a planilha 
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }
    }
    if ($action === "report_provider") {
        if ($_GET["report_type"] === "pdf") {

            $reportingPeriod = $_GET['reporting_period'];

            $query = "SELECT * FROM tb_fornecedores WHERE YEAR(data_criacao) = :reportingPeriod ORDER BY nome_fantasia ASC;";
            $stmt = $connect->prepare($query);
            $stmt->bindValue(':reportingPeriod', $reportingPeriod);
            $stmt->execute();
            $results_providers = $stmt->fetchAll(PDO::FETCH_OBJ);

            ob_start(); //inicia o buffer de saída
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
                    
                    table, th, td {
                        border: 1px solid black;
                        border-collapse: collapse;
                    }
                    
                    </style>';

            $html .= '
                <table width="100%" style="font-family: Arial; font-size: 10pt; text-align:center;">
                    <tr>   
                    <th>Nome Fantasia</th>
                    <th>Razão Social</th>
                    <th>CNPJ</th>
                    <th>Telefone</th>
                    <th>Celular</th>
                    <th>E-mail</th>
                    <th>CEP</th>
                    <th>Cidade</th>
                    <th>UF</th>
                    <th>Endereço</th>
                    <th>Bairro</th>
                    <th>Complemento</th>
                    <th>Número</th>
                    <th>Ponto de Referência</th>
                    <th>Data de Criação</th>   
                    <th>Data de Atualização</th>                   
                    </tr>';

            foreach ($results_providers as $provider) {
                $html .= '
                    <tr>
                        <td>' . $provider->nome_fantasia . '</td>
                        <td>' . $provider->razao_social . '</td>
                        <td>' . $provider->cnpj . '</td>  
                        <td>' . $provider->telefone . '</td>
                        <td>' . $provider->celular . '</td>
                        <td>' . $provider->email . '</td>
                        <td>' . $provider->cep . '</td>
                        <td>' . $provider->cidade . '</td>
                        <td>' . $provider->uf . '</td>
                        <td>' . $provider->endereco . '</td>
                        <td>' . $provider->bairro . '</td>
                        <td>' . $provider->complemento . '</td>
                        <td>' . $provider->numero . '</td>
                        <td>' . $provider->ponto_referencia . '</td>
                        <td>' . date('d/m/Y', strtotime($provider->data_criacao)) . '</td>
                        <td>' . date('d/m/Y', strtotime($provider->data_modificacao)) . '</td>
                    </tr>';
            }

            $html .= ' </table></div>
            <br>
            <span>Total de itens: ' . count($results_providers) . '</span>
             <br>';

            $mpdf->SetHTMLHeader('
                <div style="text-align: center;">Hórus PDV</div>
                <div style="text-align: center;">www.flaviodeoliveira.com.br</div>
                <br><br>
        <div style="text-align: center; font-size: 12px; font-weight: bold;">Relatório de Fornecedores</div>


        <hr>   
     
        ');

            // Define o rodapé no Mpdf
            $mpdf->setHTMLFooter('<div style="font-size: 8pt; width: 100%; text-align: center;">Gerado na data: {DATE j/m/Y} | {PAGENO}/{nbpg} | PDF gerado por: ' . $_SESSION['access_user'] . '</div>');

            $mpdf->WriteHTML($html);
            $mpdf->Output("relatorio_fornecedores.pdf", "I");
            exit();
            ob_end_flush(); //limpa o buffer e envia a saida para o navegador
        }
        if ($_GET["report_type"] === "excel") {

            $reportingPeriod = $_GET['reporting_period'];

            $query = "SELECT * FROM tb_fornecedores WHERE YEAR(data_criacao) = :reportingPeriod ORDER BY nome_fantasia ASC;";
            $stmt = $connect->prepare($query);
            $stmt->bindValue(':reportingPeriod', $reportingPeriod);
            $stmt->execute();
            $results_providers = $stmt->fetchAll(PDO::FETCH_OBJ);

            //criar uma nova planilha
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            //definicar cabeçalho das colunas
            $columns = ['Nome Fantasia', 'Razão Social', 'CNPJ', 'Telefone', 'Celular', 'E-mail', 'CEP', 'Cidade', 'UF', 'Endereço', 'Bairro', 'Complemento', 'Número', 'Ponto de Referência', 'Data de Criação', 'Data de Atualização'];
            $sheet->fromArray($columns, NULL, 'A1');

            // Definir os dados a serem preenchidos na planilha
            $rowIndex = 2;
            foreach ($results_providers as $provider) {
                $sheet->setCellValue('A' . $rowIndex, $provider->nome_fantasia);
                $sheet->setCellValue('B' . $rowIndex, $provider->razao_social);
                $sheet->setCellValue('C' . $rowIndex, $provider->cnpj);
                $sheet->setCellValue('D' . $rowIndex, $provider->telefone);
                $sheet->setCellValue('E' . $rowIndex, $provider->celular);
                $sheet->setCellValue('F' . $rowIndex, $provider->email);
                $sheet->setCellValue('G' . $rowIndex, $provider->cep);
                $sheet->setCellValue('H' . $rowIndex, $provider->cidade);
                $sheet->setCellValue('I' . $rowIndex, $provider->uf);
                $sheet->setCellValue('J' . $rowIndex, $provider->endereco);
                $sheet->setCellValue('K' . $rowIndex, $provider->bairro);
                $sheet->setCellValue('L' . $rowIndex, $provider->complemento);
                $sheet->setCellValue('M' . $rowIndex, $provider->numero);
                $sheet->setCellValue('N' . $rowIndex, $provider->ponto_referencia);
                $sheet->setCellValue('O' . $rowIndex, date('d/m/Y', strtotime($provider->data_criacao)));
                $sheet->setCellValue('P' . $rowIndex, date('d/m/Y', strtotime($provider->data_modificacao)));

                $rowIndex++;
            }
            //configurar o nome do arquivo
            $filename = "relatorio_fornecedores.xlsx";
            //cabeçalhos para fazer o download
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');

            //salvar a planilha 
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }
    }
    if ($action === "report_sales") {
        if ($_GET["report_type"] === "pdf") {
            $reportingPeriod = $_GET['reporting_period'];
            $paymentOption = $_GET['payment_option'];

            if ($paymentOption === "all") {
                $query = "SELECT v.*, c.nome, p.nome_produto FROM tb_vendas v JOIN tb_clientes c ON v.cliente = c.id JOIN tb_produtos p ON v.produto = p.id WHERE YEAR(v.data_criacao) = :reportingPeriod ORDER BY v.numero_da_venda ASC;";
                $stmt = $connect->prepare($query);
                $stmt->bindValue(':reportingPeriod', $reportingPeriod);
                $stmt->execute();
                $results_sales = $stmt->fetchAll(PDO::FETCH_OBJ);
            } else {
                $query = "SELECT v.*, c.nome, p.nome_produto FROM tb_vendas v JOIN tb_clientes c ON v.cliente = c.id JOIN tb_produtos p ON v.produto = p.id WHERE YEAR(v.data_criacao) = :reportingPeriod AND v.tipo_de_pagamento = :paymentOption ORDER BY v.numero_da_venda ASC;";
                $stmt = $connect->prepare($query);
                $stmt->bindValue(':reportingPeriod', $reportingPeriod);
                $stmt->bindValue(':paymentOption', $paymentOption);
                $stmt->execute();
                $results_sales = $stmt->fetchAll(PDO::FETCH_OBJ);
            }

            ob_start(); //inicia o buffer de saída
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
                    
                    table, th, td {
                        border: 1px solid black;
                        border-collapse: collapse;
                    }
                    
                    </style>';

            $html .= '
                    <table width="100%" style="font-family: Arial; font-size: 10pt; text-align:center;">
                        <tr>   
                        <th>Numero da Venda</th>
                        <th>Cliente</th>
                        <th>Vendedor</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Preço Unitário</th>
                        <th>Desconto</th>
                        <th>Valor com Desconto</th>                        
                        <th>Preço Total</th>
                        <th>Forma de Pagamento</th>
                        <th>Codigo de Transação</th>
                        <th>Data da Venda</th>   
                        </tr>';

            foreach ($results_sales as $sale) {
                $html .= '
                        <tr>
                            <td>' . $sale->numero_da_venda . '</td>
                            <td>' . $sale->nome . '</td>
                            <td>' . $sale->vendedor . '</td>  
                            <td>' . $sale->nome_produto . '</td>
                            <td>' . $sale->quantidade . '</td>
                            <td>' . $sale->valor_unitario . '</td>
                            <td>' . $sale->desconto . '</td>
                            <td>' . $sale->valor_com_desconto . '</td>
                            <td>' . $sale->valor_a_ser_pago . '</td>
                            <td>' . $sale->tipo_de_pagamento . '</td>
                            <td>' . $sale->codigo_de_transacao_ou_chave_pix . '</td>
                            <td>' . date('d/m/Y', strtotime($sale->data_criacao)) . '</td>
                        </tr>';
            }
            $html .= ' </table></div>
            <br>
            <span>Total de itens: ' . count($results_sales) . '</span>
             <br>';

            $mpdf->SetHTMLHeader('
                <div style="text-align: center;">Hórus PDV</div>
                <div style="text-align: center;">www.flaviodeoliveira.com.br</div>
                <br><br>
        <div style="text-align: center; font-size: 12px; font-weight: bold;">Relatório de Vendas</div>


        <hr>   
     
        ');

            // Define o rodapé no Mpdf
            $mpdf->setHTMLFooter('<div style="font-size: 8pt; width: 100%; text-align: center;">Gerado na data: {DATE j/m/Y} | {PAGENO}/{nbpg} | PDF gerado por: ' . $_SESSION['access_user'] . '</div>');

            $mpdf->WriteHTML($html);
            $mpdf->Output("relatorio_vendas.pdf", "I");
            exit();
            ob_end_flush(); //limpa o buffer e envia a saida para o navegador
        }

        if ($_GET["report_type"] === "excel") {

            $reportingPeriod = $_GET['reporting_period'];
            $paymentOption = $_GET['payment_option'];

            if ($paymentOption === "all") {
                $query = "SELECT v.*, c.nome, p.nome_produto FROM tb_vendas v JOIN tb_clientes c ON v.cliente = c.id JOIN tb_produtos p ON v.produto = p.id WHERE YEAR(v.data_criacao) = :reportingPeriod ORDER BY v.numero_da_venda ASC;";
                $stmt = $connect->prepare($query);
                $stmt->bindValue(':reportingPeriod', $reportingPeriod);
                $stmt->execute();
                $results_sales = $stmt->fetchAll(PDO::FETCH_OBJ);
            } else {
                $query = "SELECT v.*, c.nome, p.nome_produto FROM tb_vendas v JOIN tb_clientes c ON v.cliente = c.id JOIN tb_produtos p ON v.produto = p.id WHERE YEAR(v.data_criacao) = :reportingPeriod AND v.tipo_de_pagamento = :paymentOption ORDER BY v.numero_da_venda ASC;";
                $stmt = $connect->prepare($query);
                $stmt->bindValue(':reportingPeriod', $reportingPeriod);
                $stmt->bindValue(':paymentOption', $paymentOption);
                $stmt->execute();
                $results_sales = $stmt->fetchAll(PDO::FETCH_OBJ);
            }

            //criar uma nova planilha
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            //definicar cabeçalho das colunas
            $columns = ['Numero da Venda', 'Cliente', 'Vendedor', 'Produto', 'Quantidade', 'Preço Unitário', 'Desconto', 'Valor com Desconto', 'Preço Total', 'Forma de Pagamento', 'Codigo de Transação', 'Data da Venda'];
            $sheet->fromArray($columns, NULL, 'A1');

            // Definir os dados a serem preenchidos na planilha
            $rowIndex = 2;
            foreach ($results_sales as $sale) {
                $sheet->setCellValue('A' . $rowIndex, $sale->numero_da_venda);
                $sheet->setCellValue('B' . $rowIndex, $sale->nome);
                $sheet->setCellValue('C' . $rowIndex, $sale->vendedor);
                $sheet->setCellValue('D' . $rowIndex, $sale->nome_produto);
                $sheet->setCellValue('E' . $rowIndex, $sale->quantidade);
                $sheet->setCellValue('F' . $rowIndex, $sale->valor_unitario);
                $sheet->setCellValue('G' . $rowIndex, $sale->desconto);
                $sheet->setCellValue('H' . $rowIndex, $sale->valor_com_desconto);
                $sheet->setCellValue('I' . $rowIndex, $sale->valor_a_ser_pago);
                $sheet->setCellValue('J' . $rowIndex, $sale->tipo_de_pagamento);
                $sheet->setCellValue('K' . $rowIndex, $sale->codigo_de_transacao_ou_chave_pix);
                $sheet->setCellValue('L' . $rowIndex, date('d/m/Y', strtotime($sale->data_criacao)));

                $rowIndex++;
            }
            //configurar o nome do arquivo
            $filename = "relatorio_vendas.xlsx";
            //cabeçalhos para fazer o download
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');

            //salvar a planilha 
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }
    }
}
