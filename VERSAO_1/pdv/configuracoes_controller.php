<?php
    if (!isset($_SESSION)) {
        session_start();
    }

    require_once "conexao.php";
    require "configuracoes_model.php";
    require "configuracoes_service.php";

    $configuracao = new Configuracoes();
    $conexao = new Conexao();
    $configuracoesService = new ConfiguracoesService($conexao, $configuracao);

    $configuracoes = $configuracoesService->consultaConfiguracoes();


    // ------ alteração de senha master. Dados vindos do formulário de alteração de senha master configurações.php ---- 
    $senha_master_antiga = md5($_POST['senha_master_antiga']);
    $senha_master_nova = md5($_POST['senha_master_nova']);

    foreach($configuracoes as $i => $config){
        if($config->senha_master_configuracoes == $senha_master_antiga){
            $configuracao->__set('senha_master_nova', $senha_master_nova);
            $configuracoesService->alterarSenhaMaster();
            header('Location: configuracoes.php?sucesso_senha=1');
        }else{
            header('Location: configuracoes.php?erro_senha=2');
        }
    }
    // ------ fim da alteração de senha master. Dados vindos do formulário de alteração de senha master configurações.php ----

  




?>