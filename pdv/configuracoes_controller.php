<?php
    if (!isset($_SESSION)) {
        session_start();
    }

    require_once "conexao.php";
    require "configuracoes_model.php";
    require "configuracoes_service.php";

    $configuracoes = new Configuracoes();
    $conexao = new Conexao();
    $configuracoesService = new ConfiguracoesService($conexao, $configuracoes);

    $configuracoes = $configuracoesService->consultaConfiguracoes();




?>