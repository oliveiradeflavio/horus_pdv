<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once "conexao.php";
require "cad_cliente_model.php";
require "cad_cliente_service.php";
require "configuracoes_model.php";
require "configuracoes_service.php";

//capturar o parametro ação que esta sendo passado como parametro via GET
$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

$cadCliente = new CadCliente();
$conexao = new Conexao();
$cadClienteService = new CadClienteService($conexao, $cadCliente);


if ($acao == 'consultarTabelaClientes') {
    $cadClientes = $cadClienteService->mostrarTodosClientes();

}else if ($acao == 'excluir'){
    /* 
    Quando o usuário com nível padrão for fazer algo que não tem acesso, por exemplo
    excluir um cliente, o sistema irá pedir uma senha master que na teoria somente as pessoas de nível 
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
            $cadCliente->__set('id', $id);
            $cadClienteService->excluirCliente();
            header('Location: cad_clientes.php?sucesso=2');
           
        }else{
            header('Location: cad_clientes.php?erro=3');
            
        }
    }   

}else if ($acao == 'alterar'){
    $id = $_GET['id'];
    $cpf = $_POST['inputCPF'];
    $dt_nascimento = $_POST['inputDtNascimento'];
    $nome = $_POST['inputNome'];
    $cep = $_POST['inputCEP'];
    $estado = $_POST['inputEstado'];
    $cidade = $_POST['inputCidade'];
    $endereco = $_POST['inputEndereco'];
    $numero = $_POST['inputNumero'];
    $complemento = $_POST['inputEnderecoComplemento'];
    $bairro = $_POST['inputBairro'];
    $celular = $_POST['inputCelular'];

    $cadCliente->__set('id', $id);
    $cadCliente->__set('cpf', $cpf);
    $cadCliente->__set('dt_nascimento', $dt_nascimento);
    $cadCliente->__set('nome', $nome);
    $cadCliente->__set('cep', $cep);
    $cadCliente->__set('estado', $estado);
    $cadCliente->__set('cidade', $cidade);
    $cadCliente->__set('endereco', $endereco);
    $cadCliente->__set('numero', $numero);
    $cadCliente->__set('complemento', $complemento);
    $cadCliente->__set('bairro', $bairro);
    $cadCliente->__set('celular', $celular);
    
    $cadCliente = $cadClienteService->alterarCliente();
    header('Location: cad_clientes.php?sucesso=3');
}
else {

    $cpf = $_POST['inputCPF'];
    $dt_nascimento = $_POST['inputDtNascimento'];
    $nome = $_POST['inputNome'];
    $cep = $_POST['inputCEP'];
    $estado = $_POST['inputEstado'];
    $cidade = $_POST['inputCidade'];
    $endereco = $_POST['inputEndereco'];
    $numero = $_POST['inputNumero'];
    $complemento = $_POST['inputEnderecoComplemento'];
    $bairro = $_POST['inputBairro'];
    $celular = $_POST['inputCelular'];


    $cadCliente->__set('cpf', $cpf);
    $cadCliente->__set('dt_nascimento', $dt_nascimento);
    $cadCliente->__set('nome', $nome);
    $cadCliente->__set('cep', $cep);
    $cadCliente->__set('estado', $estado);
    $cadCliente->__set('cidade', $cidade);
    $cadCliente->__set('endereco', $endereco);
    $cadCliente->__set('numero', $numero);
    $cadCliente->__set('complemento', $complemento);
    $cadCliente->__set('bairro', $bairro);
    $cadCliente->__set('celular', $celular);

    //consultar se o cliente já existe
    $cadClientes = $cadClienteService->consultaCadCliente();

    if (empty($cadClientes)) {
        $cadClienteService->inserirCliente();
        header('Location: cad_clientes.php?sucesso=1');
    }

    foreach ($cadClientes as $indice => $cadCliente) {
        if ($cadCliente->cpf_cliente == $cpf) {
            header('Location: cad_clientes.php?erro=2');
        }
        if ($cadCliente->cpf_cliente != $cpf) {
            $cadClienteService->inserirCliente();
            header('Location: cad_clientes.php?sucesso=1');
        }
    }
}
