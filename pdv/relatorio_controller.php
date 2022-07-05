<?php
session_start();
require_once "conexao.php";

$tipo_de_relatorios = $_POST['categoria_relatorio'];
$periodo_relatorio = $_POST['periodo_relatorio'];



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
            $conexao = new PDO('mysql:host=localhost;dbname=pdv_horus', 'root', '');

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

}





?>