<?php

//     $senha = isset($_POST['inputSenha']) ? $_POST['inputSenha'] : '';
//     $senha = md5($senha);
//     echo $senha;


//     // require "../pdv/configuracoes_controller.php";

//     // $configuracoes = $configuracoesService->consultaConfiguracoes();

//     // foreach ($configuracoes as $i => $config){
//     //     print_r($config->senha_master_configuracoes);
//     // }
// 




$quantidade = '20000';
$preco_unitario = '10,11';
$preco_unitario = str_replace(',', '.', $preco_unitario);
$preco_unitario = floatval($preco_unitario);
echo $preco_unitario;

$preco_total_produto = $preco_unitario * $quantidade;
$preco_total_produto = number_format($preco_total_produto, 2, ',', '.');
echo $preco_total_produto;


?>

<!-- // <html>
//     <form action="teste.php" method="post">
//     <input type="text" name="inputSenha" id="">
//     <button type="submit">Enviar</button>
//     </form> -->

</html>