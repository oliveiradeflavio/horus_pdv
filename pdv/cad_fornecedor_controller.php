<?php

if (!isset($_SESSION)){
    session_start();
}

require_once "conexao.php";
require "cad_fornecedor_model.php";
require "cad_fornecedor_service.php";
require "configuracoes_model.php";
require "configuracoes_service.php";

//capturar o parametro ação que esta sendo passado como parametro via GET
$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

$cadFornecedor = new CadFornecedor();
$conexao = new Conexao();
$cadFornecedorService = new CadFornecedorService($conexao, $cadFornecedor);


if ($acao == 'consultarTabelaFornecedores' ){
    $cadFornecedores = $cadFornecedorService->consultaCadFornecedor();
}
else if ($acao == 'excluir'){
     /* 
    Quando o usuário com nível padrão for fazer algo que não tem acesso, por exemplo
    excluir um fornecedor, o sistema irá pedir uma senha master que na teoria somente as pessoas de nível 
    master tem acesso a essa função.
    */
    $pass = isset($_GET['p']) ? $_GET['p'] : $pass;
    $pass = md5($pass);   
    $configuracao = new Configuracoes();
    $configuracoesService = new ConfiguracoesService($conexao, $configuracao); 
    $configuracoes = $configuracoesService->consultaConfiguracoes();
    foreach($configuracoes as $i => $config){
        if($config->senha_master_configuracoes == $pass){
            $id = $_GET['id'];
            $cadFornecedor->__set('id', $id);
            $cadFornecedorService->excluirFornecedor();
            header('Location: cad_fornecedores.php?sucesso=2');
           
        }else{
            header('Location: cad_fornecedores.php?erro=4');
            
        }
    }   
}
else if ($acao == 'alterar'){
    $id = $_GET['id'];
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

    $cadFornecedor->__set('id', $id);
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

    $cadFornecedorService->alterarFornecedor();
    header('Location: cad_fornecedores.php?sucesso=3');

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