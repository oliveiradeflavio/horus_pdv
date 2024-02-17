<?php

if (!isset($_SESSION)){
     session_start();
}

require_once "conexao.php";
require "cad_produto_model.php";
require "cad_produto_service.php";
require "configuracoes_model.php";
require "configuracoes_service.php";

$cadProduto = new CadProduto();
$conexao = new Conexao();
$cadProdutoService = new CadProdutoService($conexao, $cadProduto);

//capturar o parametro ação que esta sendo passado como parametro via GET
$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

if ($acao == 'consultarTabelaProdutos') {
    $cadProdutos = $cadProdutoService->mostrarTodosProdutos();

}else if ($acao == 'excluir'){
    /* 
    Quando o usuário com nível padrão for fazer algo que não tem acesso, por exemplo
    excluir um produto, o sistema irá pedir uma senha master que na teoria somente as pessoas de nível 
    master tem acesso a essa função.
    */
    $pass = isset($_GET['p']) ? $_GET['p'] : $pass;
    $pass = md5($pass);
    echo "<br>";  
    $configuracao = new Configuracoes();
    $configuracoesService = new ConfiguracoesService($conexao, $configuracao);  
    $configuracoes = $configuracoesService->consultaConfiguracoes();
    foreach($configuracoes as $i => $config){
        if($config->senha_master_configuracoes == $pass){
            $id = $_GET['id'];
            $foto_produto = $_GET['img'];

            if ($foto_produto != "produto_sem_imagem.png" && file_exists("../pdv/img/produtos/$foto_produto")) {
                $pasta_produtos = "../pdv/img/produtos/";
                unlink($pasta_produtos.$foto_produto);
            }
            $cadProduto->__set('id', $id);
            $cadProdutoService->excluirProduto();
            header('Location: cad_produtos.php?sucesso=2'); 

        }else{       
            header('Location: cad_produtos.php?erro=3');   
        }
    }   
}  
else if ($acao == 'alterar'){
    $id_produto = $_GET['id'];
    $foto_produto_original = $_GET['img'];
    $foto_produto_nova = $_FILES['inputImagemProduto'];
    $nome_produto = $_POST['inputNomeProduto'];
    $codigo_produto = $_POST['inputCodigo'];
    $descricao_produto = $_POST['inputDescricaoProduto'];
    $quantidade_produto = $_POST['inputQuantidade'];
    $preco_unitario_produto = $_POST['inputPrecoUnitario'];
    $preco_venda_produto = $_POST['inputPrecoVenda'];
    $preco_total_produto = $_POST['inputPrecoTotal'];

    if(empty($foto_produto_nova['name'])){
        $cadProduto->__set('id', $id_produto);
        $cadProduto->__set('nome', $nome_produto);
        $cadProduto->__set('codigo', $codigo_produto);
        $cadProduto->__set('descricao', $descricao_produto);
        $cadProduto->__set('quantidade', $quantidade_produto);
        $cadProduto->__set('preco_unitario', $preco_unitario_produto);
        $cadProduto->__set('preco_venda', $preco_venda_produto);
        $cadProduto->__set('preco_total', $preco_total_produto);
        $cadProduto->__set('foto', $foto_produto_original);

        $cadProdutoService->alterarProduto();
        header('Location: cad_produtos.php?sucesso=3');
    
    }else{
        $tamanho = 2048;
        $error = array();
        if(!preg_match("/^image\/(pjpeg|jpeg|jpg|png|gif|bmp)$/", $foto_produto_nova["type"])){
            $error[1] = "Isso não é uma imagem.";
            header('Location: cad_produtos.php?erro=4');
            }

        if(count($error) == 0){
            $foto_produto_nova_alterada = $foto_produto_nova['name'];

            $extensao = strtolower(substr($foto_produto_nova['name'], -4));
            $novo_nome = md5($foto_produto_nova_alterada) . $extensao;

             if ($novo_nome == $foto_produto_original ){
                header('Location: cad_produtos.php?erro=5'); //já existe uma imagem com esse nome
            
            }else{
                $diretorio = "../pdv/img/produtos/";
                move_uploaded_file($foto_produto_nova['tmp_name'], $diretorio.$novo_nome);

                $cadProduto->__set('id', $id_produto);
                $cadProduto->__set('nome', $nome_produto);
                $cadProduto->__set('codigo', $codigo_produto);
                $cadProduto->__set('descricao', $descricao_produto);
                $cadProduto->__set('quantidade', $quantidade_produto);
                $cadProduto->__set('preco_unitario', $preco_unitario_produto);
                $cadProduto->__set('preco_venda', $preco_venda_produto);
                $cadProduto->__set('preco_total', $preco_total_produto);
                $cadProduto->__set('foto', $novo_nome);
        
                $cadProdutoService->alterarProduto();
                header('Location: cad_produtos.php?sucesso=3');
             }
        }
        
    }

}else {

    $foto_produto = $_FILES['inputImagemProduto'];
    $nome_produto = $_POST['inputNomeProduto'];
    $codigo_produto = $_POST['inputCodigo'];
    $descricao_produto = $_POST['inputDescricaoProduto'];
    $quantidade_produto = $_POST['inputQuantidade'];
    $preco_unitario_produto = $_POST['inputPrecoUnitario'];
    $preco_venda_produto = $_POST['inputPrecoVenda'];
    $preco_total_produto = $_POST['inputPrecoTotal'];

    if(empty($foto_produto['name']))
    {
        $novo_nome = 'produto_sem_imagem.png';

        $cadProduto->__set('foto', $novo_nome);
        $cadProduto->__set('nome', $nome_produto);
        $cadProduto->__set('codigo', $codigo_produto);
        $cadProduto->__set('descricao', $descricao_produto);
        $cadProduto->__set('quantidade', $quantidade_produto);
        $cadProduto->__set('preco_unitario', $preco_unitario_produto);
        $cadProduto->__set('preco_venda', $preco_venda_produto);
        $cadProduto->__set('preco_total', $preco_total_produto);
    
        $cadProdutoService->cadastrarProduto();
        header('Location: cad_produtos.php?sucesso=1');
    }
    else{
        $tamanho = 2048;
        $error = array();
        if(!preg_match("/^image\/(pjpeg|jpeg|jpg|png|gif|bmp)$/", $foto_produto["type"])){
            $error[1] = "Isso não é uma imagem.";
            }
        if(count($error) == 0){

        $foto_produto_alterada = $foto_produto['name'];
        $extensao = strtolower(substr($foto_produto['name'], -4));
        $novo_nome = md5($foto_produto_alterada) . $extensao;

        if (file_exists("../pdv/img/produtos/$novo_nome")) {
            header('Location: cad_produtos.php?erro=5'); //já existe uma imagem com esse nome
            //echo "$novo_nome";
        }
        else {
        $diretorio = "../pdv/img/produtos/";
        move_uploaded_file($foto_produto['tmp_name'], $diretorio.$novo_nome);

        $cadProduto->__set('foto', $novo_nome);
        $cadProduto->__set('nome', $nome_produto);
        $cadProduto->__set('codigo', $codigo_produto);
        $cadProduto->__set('descricao', $descricao_produto);
        $cadProduto->__set('quantidade', $quantidade_produto);
        $cadProduto->__set('preco_unitario', $preco_unitario_produto);
        $cadProduto->__set('preco_venda', $preco_venda_produto);
        $cadProduto->__set('preco_total', $preco_total_produto);
    
        $cadProdutoService->cadastrarProduto();
        header('Location: cad_produtos.php?sucesso=1');
        }
        }
    }

}

?>