<?php
    session_start();
    if(!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'SIM'){
        header("Location: login.php?login=2");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- cdn bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    
    <!-- sweetalert2 -->
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <script src="js/sweetalert2.all.min.js"></script>  

    <!-- fontawesome-->
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">

    <!-- css -->
    <link rel="stylesheet" href="css/venda.css">

    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <title>Hórus PDV - Venda</title>
</head>
<body>
<i class="fa-solid fa-circle-question icone_fontawesome ml-3 mt-3" id="ajuda_venda" style="cursor: pointer" onclick="ajuda()"></i>
 
<div class="container">
    <div class="row">
    <div class='col-md-6 mt-2'>
    

            <select class="form-control" name="selecao_cliente" id="selecao_cliente">
                <option value="">Selecione um cliente</option>
                <?php
                    require_once '../pdv/conexao.php';
                    $conexao = new Conexao();
                    $conexao = $conexao->conectar();                    
                    $query = "SELECT * FROM tb_clientes";
                    $stmt = $conexao->prepare($query);
                    $stmt->execute();
                    $clientes = $stmt->fetchAll();
                    foreach($clientes as $cliente){
                        echo "<option value='{$cliente['nome_cliente']}'>{$cliente['nome_cliente']}</option>";
                    }
                ?>
            </select>
            
            <select class="form-control" name="selecao_produto" id="selecao_produto">
                <option value="">Selecione um produto</option>
                <?php
                    $query = "SELECT * FROM tb_produtos";
                    $stmt = $conexao->prepare($query);
                    $stmt->execute();
                    $produtos = $stmt->fetchAll(PDO::FETCH_OBJ);
                    foreach($produtos as $produto){
                        echo "<option value='$produto->id_produto' data-id='$produto->id_produto' data-valor='$produto->preco_venda_produto' data-imagem='$produto->foto_produto' data-quantidade='$produto->quantidade_produto'>$produto->nome_produto</option>";
                    }          
                ?>
            </select>
            
            <input type="number" class="form-control" name="quantidade_produto" id="quantidade_produto" value="1" placeholder="Quantidade">

        <div class="row">
            <div class="col-md-6">
                <label for="">Preço Unitário</label>
                <input type="text" class="form-control" name="preco_unitario_produto" id="preco_unitario_produto" value="R$ 0,00" readonly>
            
            </div>
            <div class="col-md-6">
                <label for="">Preço Total</label>
                <input type="text" class="form-control" name="preco_total_produto" id="preco_total_produto" value="R$ 0,00" readonly>
            </div>
        </div>

            <div class="row">
                <div class="col-md-6">
                    <button onclick="adicionarItens()" class="btn btn-success btn-block" id="btn_adicionar_itens">Adicionar</button>
                </div>
                <div class="col-md-6">
                    <button onclick="limpaCampos()" class="btn btn-danger btn-block">Remover</button>
                </div>
            </div>
    </div>              

    <div class="col-md-6 centro">
            <div>
                <img src="../pdv/img/produtos/produto_sem_imagem.png" class="imagem_produto" id="preview_imagem_produto">
            </div>       
        </div>
    
</div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-responsive  tabela_lista_itens" style="display:none" id="lista_itens">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Preço Unitário</th>
                            <th>Preço Total</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="col-md-6" id="div_fechamento_conta" style="display: none">
                <div class="row">              
                        <div class="col-md-12 ml-3">
                            <label for="">Total da Venda</label>
                            <input type="text" class="form-control" name="total_venda" id="total_venda" value="0,00"  readonly>
                        </div>  
            
                    <div class="col-md-12 ml-3" >
                        <button onclick="fecharPedido()" id="botaoFecharPedido"class="btn btn-info btn-block">Fechar Pedido</button>
                    </div>
                </div>

            <div class="row">
                <div class="col-md-12 mt-3 ml-3">
                    <select name="selecao_pagamento" id="selecao_pagamento" class="form-control" style="display: none">
                    </select>
                </div>
                    <div class="col-md-3 mt-2 ml-3" id="div_desconto_venda">
                </div>
                    <div class="col-md-3 mt-2 ml-3" id="div_total_com_desconto">
                </div>
                    <div class="col-md-4 mt-2 ml-3" id="div_pagamento_cartao">
                </div>
            </div>

            <div class="container mb-3" style="display: none" id="div_fechar_conta">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <button onclick="fecharVenda()"  id='botaoFecharVenda' class="btn btn-success btn-block">Fechar Venda</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>   
  
    </div>          


<div class="container footer">
    <div class="row">
       <div class="col-md-12">
           
       </div>

    <div class="col-md-6">
           
       </div>
    </div>
</div>

<script src="js/venda.js"></script>
</body>
</html>