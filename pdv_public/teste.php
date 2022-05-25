<?php

    $senha = isset($_POST['inputSenha']) ? $_POST['inputSenha'] : '';
    $senha = md5($senha);
    echo $senha;


    // require "../pdv/configuracoes_controller.php";

    // $configuracoes = $configuracoesService->consultaConfiguracoes();

    // foreach ($configuracoes as $i => $config){
    //     print_r($config->senha_master_configuracoes);
    // }
?>

<html>
    <form action="teste.php" method="post">
    <input type="text" name="inputSenha" id="">
    <button type="submit">Enviar</button>
    </form>
</html>