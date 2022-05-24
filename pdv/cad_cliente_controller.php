<?php

if (!isset($_SESSION)) {
    session_start();
}

require "conexao.php";
require "cad_cliente_model.php";
require "cad_cliente_service.php";

//capturar o parametro ação que esta sendo passado como parametro via GET
$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

$cadCliente = new CadCliente();
$conexao = new Conexao();
$cadClienteService = new CadClienteService($conexao, $cadCliente);


if ($acao == 'consultarTabelaClientes') {
    $cadClientes = $cadClienteService->mostrarTodosClientes();
    // header('Location: cad_clientes.php');

} else {


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
