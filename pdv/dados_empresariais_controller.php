<?php
    if (!isset($_SESSION)){
        session_start();
    }
    
    require_once "conexao.php";
    require 'dados_empresariais_model.php';
    require 'dados_empresariais_service.php';

    $conexao = new Conexao();
    $dados_empresariais = new DadosEmpresariaisModel();
    $dados_empresariais_service = new DadosEmpresariaisService($conexao, $dados_empresariais);

    $cnpj_empresa = $_POST['cnpj_empresa'];
    $nome_empresa = $_POST['nome_empresa'];
    $cep_empresa = $_POST['cep_empresa'];
    $estado_empresa = $_POST['estado_empresa'];
    $endereco_empresa = $_POST['endereco_empresa'];
    $numero_empresa = $_POST['numero_empresa'];
    $bairro_empresa = $_POST['bairro_empresa'];
    $cidade_empresa = $_POST['cidade_empresa'];
    $telefone_empresa = $_POST['telefone_empresa'];
    $celular_empresa = $_POST['celular_empresa'];
    $email_empresa = $_POST['email_empresa'];

    $dados_empresariais->__set('cnpj', $cnpj_empresa);
    $dados_empresariais->__set('nome', $nome_empresa);
    $dados_empresariais->__set('cep', $cep_empresa);
    $dados_empresariais->__set('estado', $estado_empresa);
    $dados_empresariais->__set('endereco', $endereco_empresa);
    $dados_empresariais->__set('numero', $numero_empresa);
    $dados_empresariais->__set('bairro', $bairro_empresa);
    $dados_empresariais->__set('cidade', $cidade_empresa);
    $dados_empresariais->__set('telefone', $telefone_empresa);
    $dados_empresariais->__set('celular', $celular_empresa);
    $dados_empresariais->__set('email', $email_empresa);

    $consulta = $dados_empresariais_service->consultarDadosEmpresariais();

    if (count($consulta) > 0) {
        $dados_empresariais_service->atualizarDadosEmpresariais();
        header("Location: configuracoes.php?sucesso_dados_empresariais=1#nav_dados");
    } else {
        $dados_empresariais_service->salvarDadosEmpresariais();
        header("Location: configuracoes.php?sucesso_dados_empresariais=1#nav_dados");
    }

 



    

?>