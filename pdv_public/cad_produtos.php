<?php
    session_start();
    if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'SIM') {
        header("Location: login.php?login=2");
    }

    $acao = 'consultarTabelaProdutos';
    require 'cad_produto_controller.php';

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- cdn bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <!-- css -->
    <link rel="stylesheet" href="css/cad_produtos.css">

    <!-- jquery mask -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <!-- fontawesome-->
    <script src="https://kit.fontawesome.com/90a33d8225.js" crossorigin="anonymous"></script>

    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <title>Hórus PDV - Cadastro Fornecedores</title>
</head>

<body>
<header>
    
<nav class="navbar navbar-expand-lg navbar-light">
           
           <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" >
           <i class="fa-solid fa-ellipsis"></i>
           </button>

           <div class="collapse navbar-collapse" id="navbarNav">
               <ul class="navbar-nav ml-auto">
                
                       <div class="dropdown">                           
                       <img src="../pdv/img/usuarios/<?= $_SESSION['foto_usuario'] ?>" alt="" width="50" height="50" class="img-circulo"> 
                       <div class="dropdown-content mr-5">
                           <a><?php echo $_SESSION['nome_usuario'] ?></a>
                           <div class="dropdown-divider"></div>                              
                           <a href="perfil_usuario.php">Meu Perfil</a>
                           <?php if($_SESSION['perfil_usuario'] == 1): ?>
                               <a href="#">Configurações</a>
                           <?php endif; ?>
                           <a href="logout.php">Sair</a>
                       </div>
                       </div> 
                
               </ul>
             
           </div>
       </div>
   </nav>
     </header>

     <section class="container row col-md-12 centro">
        <!-- msg de retorno -->
        <?php
        if (isset($_GET['sucesso']) && $_GET['sucesso'] == '1') { ?>
            <div class='alert alert-success mt-2' role='alert'>
                <strong>Sucesso!</strong> Produto cadastrado com sucesso!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } else if (isset($_GET['sucesso']) && $_GET['sucesso'] == '2') { ?>
            <div class='alert alert-success mt-2' role='alert'>
                <strong>Sucesso!</strong> Produto removido com sucesso!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>

        <?php } else if (isset($_GET['sucesso']) && $_GET['sucesso'] == '3') { ?>
            <div class='alert alert-success mt-2' role='alert'>
                <strong>Sucesso!</strong> Produto alterado com sucesso!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>

        <?php } else if (isset($_GET['erro']) && $_GET['erro'] == '2') { ?>
            <div class='alert alert-warning mt-2' role='alert'>
                <strong>Atenção</strong> Produto já cadastrado!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

        <?php } else if (isset($_GET['erro']) && $_GET['erro'] == '3') { ?>
            <div class='alert alert-danger mt-2' role='alert'>
                <strong>Erro</strong> Senha master incorreta!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>   
        <?php } ?>
       
    </section>


    <section>
    <div class="container mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Cadastro de Produtos</h5>
                            <p class="card-text">
                                Cadastre os produtos que serão vendidos no PDV.
                            </p>
                            <button onclick="location.href='index.php'" class="btn btn-primary">Dashboard</button>
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Cadastros
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a href="cad_clientes.php" class="dropdown-item">Cadastrar Clientes</a>
                            <a href="cad_fornecedores.php" class="dropdown-item">Cadastrar Fornecedores</a>
                            <a href="cad_produtos.php" class="dropdown-item">Cadastrar Produtos</a>
                            </div>
                          
                            
                            <button onclick="location.href='#'" class="btn btn-primary">Histórico</button>
                            <button onclick="window.open('venda.php', '_blank')" class="btn btn-primary">Iniciar Venda</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <form id="formCadProduto" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                            <label for="inputImagemProduto" class="form-label">Carregue uma imagem do produto</label>
                            <input class="form-control" type="file" id="inputImagemProduto" name="inputImagemProduto">
                            </div>

                            <div class="form-group col-md-5">
                                <label for="inputNomeProduto">Nome do Produto</label>
                                <input type="text" class="form-control" id="inputNomeProduto" name="inputNomeProduto" required>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="inputCodigo">Código</label>
                                <input type="text" class="form-control" id="inputCodigo" name="inputCodigo" required>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputDescricaoProduto">Descrição do Produto</label>
                                <input type="text" class="form-control" id="inputDescricaoProduto" name="inputDescricaoProduto"  required>
                            </div>
                        </div>

                        <div class='form-row'>
                            <div class="form-group col-md-3">
                                    <label for="inputQuantidade">Quantidade</label>
                                    <input type="number" class="form-control" id="inputQuantidade" name="inputQuantidade" onfocus="somaPrecoTotalCadastro()" placeholder="0" required>
                                </div>
                            
                            <div class="form-group col-md-3">
                                <label for="inputPrecoUnitario">Preço Unitário</label>
                                <input type="text" class="form-control" id="inputPrecoUnitario" name="inputPrecoUnitario" placeholder="R$ 0,00" onblur="somaPrecoTotalCadastro()" required>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="inputPrecoVenda">Preço Venda</label>
                                <input type="text" class="form-control" id="inputPrecoVenda" name="inputPrecoVenda" placeholder="R$ 0,00" required>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="inputPrecoTotal">Total de Produto</label>
                                <input type="text" class="form-control" id="inputPrecoTotal" name="inputPrecoTotal" placeholder="R$ 0,00" readonly  required>
                            </div>

                          
                        </div>

                        <button type="button" onclick="validaCamposProdutos()" class="btn btn-primary">Cadastrar</button>
                        <button type="reset" class="btn btn-danger">Cancelar</button>
                    </form>
                </div>
            </div>
            <h5 class="card-title mt-5" style="cursor: pointer" id="txt_consultar_produtos" onclick="mostrarTabelaCadastros()">Consultar Produtos Cadastrados</h5>
            <table class="table table-sm table-hover table-responsive p-3" style="display: none" id="tabela_cad_produtos">
                <thead>
                    <tr>
                        <th scope="col">Imagem</th>
                        <th scope="col">Código</th>
                        <th scope="col">Produto</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Preço Unitário</th>
                        <th scope="col">Preço Venda</th>
                        <th scope="col">Total</th>                    
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($cadProdutos as $indice => $cadProduto) {?>
                        <tr>
                            <td><img src="../pdv/img/produtos/<?php echo $cadProduto->foto_produto; ?>" width="50" height="50"></td>
                            <td><?php echo $cadProduto->codigo_produto; ?></td>
                            <td><?php echo $cadProduto->nome_produto; ?></td>
                            <td><?php echo $cadProduto->descricao_produto; ?></td>
                            <td><?php echo $cadProduto->quantidade_produto; ?></td>
                            <td><?php echo $cadProduto->preco_unitario_produto; ?></td>
                            <td><?php echo $cadProduto->preco_venda_produto; ?></td>
                            <td><?php echo $cadProduto->preco_total_produto; ?></td>

                            <td><i class="fa-regular fa-pen-to-square icone_fontawesome" style="cursor:pointer"></i></td>
                            <td><i class="fas fa-trash-alt icone_fontawesome" onclick="excluirProduto(<?= $cadProduto->id_produto ?>, '<?= $cadProduto->foto_produto ?>')" style="cursor:pointer"></i></td>
                        </tr>
                        <?php                   
                        }
                    ?>
        
        </div>

      
    </section>

<script src="js/pdv.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>