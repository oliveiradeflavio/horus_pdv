<?php

if (!isset($_SESSION)){
    session_start();
}

require_once "conexao.php";
require "cad_fornecedor_model.php";
require "cad_fornecedor_service.php";
require "configuracoes_controller.php";

//capturar o parametro ação que esta sendo passado como parametro via GET
$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

$cadFornecedor = new CadFornecedor();
$conexao = new Conexao();
$cadFornecedorService = new CadFornecedorService($conexao, $cadFornecedor);


if ($acao == 'consultarTabelaFornecedores' ){
    // ... desenvolvimento
}
else if ($acao == 'excluir'){
    // ... desenvolvimento
}
else if ($acao == 'alterar'){
    // ... desenvolvimento
}
else if($acao == 'inserir'){

    $cnpj = $_POST['inputCNPJ'];
    $razao_social = $_POST['inputRazaoSocial'];
    $nome_fantasia = $_POST['inputNomeFantasia'];
    $cep = $_POST['inputCEP'];
    $estado = $_POST['inputEstado'];
    $cidade = $_POST['inputCidade'];
    $endereco = $_POST['inputEndereco'];
    $numero = $_POST['inputNumero'];
    $complemento = $_POST['inputEnderecoComplemento'];
    $bairro = $_POST['inputBairro'];
    $telefone = $_POST['inputTelefone'];
    $celular = $_POST['inputCelular'];
    $email = $_POST['inputEmail'];

    $cadFornecedor->__set('cnpj', $cnpj);
    $cadFornecedor->__set('razao_social', $razao_social);
    $cadFornecedor->__set('nome_fantasia', $nome_fantasia);
    $cadFornecedor->__set('cep', $cep);
    $cadFornecedor->__set('estado', $estado);
    $cadFornecedor->__set('cidade', $cidade);
    $cadFornecedor->__set('endereco', $endereco);
    $cadFornecedor->__set('numero', $numero);
    $cadFornecedor->__set('complemento', $complemento);
    $cadFornecedor->__set('bairro', $bairro);
    $cadFornecedor->__set('telefone', $telefone);
    $cadFornecedor->__set('celular', $celular);
    $cadFornecedor->__set('email', $email);

    //consultar se não existe já no bd o cnpj   
    $cadFornecedores =  $cadFornecedorService->consultaCadFornecedor();

    if (empty($cadFornecedores)){
        $cadFornecedorService->inserirCadFornecedor();
        header('Location: cad_fornecedores.php?sucesso=1');
    }

    foreach ($cadFornecedores as $indice => $cadFornecedor){
        if ($cadFornecedor->cnpj_fornecedor == $cnpj){
            header('Location: cad_fornecedores.php?erro=2');
        }
        if ($cadFornecedor->razao_social_fornecedor == $razao_social){
            header('Location: cad_fornecedores.php?erro=3');
        }
        if ($cadFornecedor->cnpj_fornecedor != $cnpj && $cadFornecedor->razao_social_fornecedor != $razao_social){
            $cadFornecedorService->inserirCadFornecedor();
            header('Location: cad_fornecedores.php?sucesso=1');
        }
    }
}
?>