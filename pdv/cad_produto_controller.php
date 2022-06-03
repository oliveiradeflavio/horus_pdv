<?php

if (!isset($_SESSION)){
     session_start();
}

require_once "conexao.php";
require "cad_produto_model.php";
require "cad_produto_service.php";
require "configuracoes_controller.php";

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
    $configuracoes = $configuracoesService->consultaConfiguracoes();
    foreach($configuracoes as $i => $config){
        if($config->senha_master_configuracoes == $pass){
            $id = $_GET['id'];
            $foto_produto = $_GET['img'];


            // if ($foto_produto != "produto_sem_imagem.png" && file_exists("../img/produtos/$foto_produto")) {
            //     unlink("../img/produtos/$foto_produto");
            //     //EM DESENVOLVIMENTO
            // }
            $cadProduto->__set('id', $id);
            //$cadProdutoService->excluirProduto();
            //header('Location: cad_produtos.php?sucesso=2'); 

            
        }else{
            header('Location: cad_produtos.php?erro=3');   
        }
    }   
}  
else if ($acao == 'alterar'){

    //em desenvolvimento

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
    }
    else{
        $tamanho = 2048;
        $error = array();
        if(!preg_match("/^image\/(pjpeg|jpeg|jpg|png|gif|bmp)$/", $foto_produto["type"])){
            $error[1] = "Isso não é uma imagem.";
            }
        if(count($error) == 0){

        $extensao = strtolower(substr($foto_produto['name'], -4));
        $novo_nome = md5(time()) . $extensao;
        $diretorio = "../pdv/img/produtos/";
        move_uploaded_file($foto_produto['tmp_name'], $diretorio.$novo_nome);
        }
    }

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

?>